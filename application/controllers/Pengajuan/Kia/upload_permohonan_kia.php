<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class upload_permohonan_kia extends CI_Controller
{
	// function simpan_permohonan_kia(){
	//     $input_data =file_get_contents('php://input');
	// 	$data_post=json_decode($input_data, true);
	// 	$hasil=[];
	// 	//var_dump($data_post);
	// 	if($data_post['SIMPANKIA']["NIK"] =="" || $data_post['SIMPANKIA']["NO_KK"] =="" || $data_post['SIMPANKIA']["NAMA_LGKP"] =="" || $data_post['SIMPANKIA']["NO_KEC"] =="" || $data_post['SIMPANKIA']["NO_KEL"] =="" || $data_post['SIMPANKIA']["ALASAN"] =="" || $data_post['SIMPANKIA']["PENGAMBILAN"] =="" || $data_post['SIMPANKIA']["DAFTARID"] =="" || $data_post['SIMPANKIA']["SC_KIA"] ==""){
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	}else{
	// 		$numRecords = count(Daftar_kia_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKIA']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_kia_model::get_criteria(array("NIK"=>$data_post['SIMPANKIA']["NIK"],"STATUS"=>array(1,2)));
	// 		if(count($checkRecordAktif) > 0){
	// 			if($checkRecordAktif[0]->status == 1){
	// 				$hasil=3;
	// 			}elseif($checkRecordAktif[0]->status == 2){
	// 				$hasil=4;
	// 			}

	// 		}else{
	// 			if($numRecords==0){
	// 				//$data_ktp['SIMPANKIA']['DAFTARID'] = $data_post['SIMPANKIA']["DAFTARID"];
	// 				//$data_ktp['SIMPANKIA']['NIK'] = $data_post['SIMPANKIA']["NIK"];
	// 				//$data_ktp['SIMPANKIA']['NO_KK'] = $data_post['SIMPANKIA']["NO_KK"];
	// 				//$data_ktp['SIMPANKIA']['NAMA_LGKP'] = $data_post['SIMPANKIA']["NAMA"];
	// 				//$data_ktp['SIMPANKIA']['NO_KEC'] = $data_post['SIMPANKIA']["KEC"];
	// 				//$data_ktp['SIMPANKIA']['NO_KEL'] = $data_post['SIMPANKIA']["KEL"];
	// 				//$data_ktp['SIMPANKIA']['ALASAN'] = $data_post['SIMPANKIA']["ALASAN"];
	// 				//$data_ktp['SIMPANKIA']['NO_AKTA_LAHIR'] = $data_post['SIMPANKIA']["NO_AKTA_LAHIR"];
	// 				//$data_ktp['SIMPANKIA']['SC_KIA'] = 'upload/permohonan/kia/'.$data_post['SIMPANKIA']["SC_KIA"];
	// 				//$data_ktp['SIMPANKIA']['PAS_FOTO'] = 'upload/permohonan/kia/'.$data_post['SIMPANKIA']["PAS_FOTO"];
	// 				//$data_ktp['SIMPANKIA']['PENGAMBILAN'] = $data_post['SIMPANKIA']["PENGAMBILAN"];
	// 				//$data_ktp['SIMPANKIA']['AKUN'] = $data_post['SIMPANKIA']["AKUN"];
	// 				//$data_ktp['SIMPANKIA']['STATUS'] = 1;
	// 				$record=new Daftar_kia_model($data_post['SIMPANKIA']);
	// 				$affected_rows=$record->save();
	// 				if(!$affected_rows){
	// 					$hasil=0;
	// 				}else{
	// 					$hasil=1;
	// 				}
	// 			}else{
	// 				$hasil = 2;
	// 			}
	// 		}

	// 	}
	// 	$this->output->set_content_type('application/json')->set_output($hasil);
	// }


	function simpan_permohonan_kia()
	{
		$data_post = $_POST;
		$hasil = [];

		$headers = apache_request_headers();

		if (!isset($headers['Authorization'])) {
			$hasil = [
				'status' => false,
				'message' => 'Authorization token not found in headers',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		$jwt_token = str_replace('Bearer ', '', $headers['Authorization']);

		if (!$jwt_token) {
			$hasil = [
				'status' => false,
				'message' => 'Invalid token format',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		if (
			$data_post["NIK"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["NAMA_LGKP"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["ALASAN"] == "" ||
			$data_post["PENGAMBILAN"] == "" ||
			$data_post["DAFTARID"] == "" ||
			$data_post["NO_AKTA_LAHIR"] == "" ||
			$data_post["AKUN"] == "" ||
			empty($_FILES["SC_KIA"]) ||
			empty($_FILES["PAS_FOTO"])
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$numRecords = count(Daftar_kia_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
			$checkRecordAktif = Daftar_kia_model::get_criteria(array("NIK" => $data_post["NIK"], "STATUS" => array(1, 2)));

			if (count($checkRecordAktif) > 0) {
				if ($checkRecordAktif[0]->status == 1) {
					$hasil = [
						'status' => false,
						'message' => 'Record with NIK already has an active application',
						'data' => null
					];
				} elseif ($checkRecordAktif[0]->status == 2) {
					$hasil = [
						'status' => false,
						'message' => 'Record with NIK already has a pending application',
						'data' => null
					];
				}
			} else {
				if ($numRecords == 0) {
					$photo_file_sc_kia = $_FILES['SC_KIA'];
					$photo_file_pas_foto = $_FILES['PAS_FOTO'];

					$upload_dir = './assets/pengajuan/kia/';
					$photo_path_sc_kia = $upload_dir . $data_post['DAFTARID'] . '_SC_KIA.jpg';
					$photo_path_pas_foto = $upload_dir . $data_post['DAFTARID'] . '_PAS_FOTO.jpg';

					// Check if file uploads are successful
					if (
						move_uploaded_file($photo_file_sc_kia['tmp_name'], $photo_path_sc_kia) &&
						move_uploaded_file($photo_file_pas_foto['tmp_name'], $photo_path_pas_foto)
					) {
						$data_kia['DAFTARID'] = $data_post["DAFTARID"];
						$data_kia['NIK'] = $data_post["NIK"];
						$data_kia['NO_KK'] = $data_post["NO_KK"];
						$data_kia['NAMA_LGKP'] = $data_post["NAMA_LGKP"];
						$data_kia['NO_KEC'] = $data_post["KEC"];
						$data_kia['NO_KEL'] = $data_post["KEL"];
						$data_kia['ALASAN'] = $data_post["ALASAN"];
						$data_kia['NO_AKTA_LAHIR'] = $data_post["NO_AKTA_LAHIR"];
						$data_kia['SC_KIA'] = $photo_path_sc_kia;
						$data_kia['PAS_FOTO'] = $photo_path_pas_foto;
						$data_kia['PENGAMBILAN'] = $data_post["PENGAMBILAN"];
						$data_kia['DAFTARID'] = $data_post["DAFTARID"];
						$data_kia['AKUN'] = $data_post["AKUN"];
						$data_kia['STATUS'] = 1;

						$record = new Daftar_kia_model($data_kia);
						$affected_rows = $record->save();

						if (!$affected_rows) {
							$hasil = [
								'status' => false,
								'message' => 'Failed to save record',
								'data' => null
							];
						} else {
							$hasil = [
								'status' => true,
								'message' => 'Record saved successfully',
								'data' => $data_kia
							];
						}
					} else {
						$hasil = [
							'status' => false,
							'message' => 'Failed to upload one of the photo proofs',
							'data' => null
						];
					}
				} else {
					$hasil = [
						'status' => false,
						'message' => 'Duplicate record found',
						'data' => null
					];
				}
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function detailPengajuanKia()
	{
		$headers = apache_request_headers();

		if (!isset($headers['Authorization'])) {
			$hasil = [
				'status' => false,
				'message' => 'Authorization token not found in headers',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		$jwt_token = str_replace('Bearer ', '', $headers['Authorization']);

		if (!$jwt_token) {
			$hasil = [
				'status' => false,
				'message' => 'Invalid token format',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		$jwt_secret = "sitepak2023";

		try {
			$token_data = JWT::decode($jwt_token, new Key($jwt_secret, 'HS256'));

			$nik = $token_data->nik;

			// Fetch pengajuanKtp data for the logged-in user
			$pengajuanKia = Daftar_kia_model::get_criteria(['where' => ['nik' => $nik]]);

			if (empty($pengajuanKia)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan KIA data found for the logged-in user',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $pengajuanKia[0]->daftarid,
					'nik' => $pengajuanKia[0]->nik,
					'no_kk' => $pengajuanKia[0]->no_kk,
					'nama_lgkp' => $pengajuanKia[0]->nama_lgkp,
					'alasan' => $pengajuanKia[0]->alasan,
					'status' => $pengajuanKia[0]->status,
					'alasan' => $pengajuanKia[0]->alasan,
					'no_kec' => $pengajuanKia[0]->no_kec,
					'no_kel' => $pengajuanKia[0]->no_kel,
					'pengambilan' => $pengajuanKia[0]->pengambilan,
					'tgl_permohonan' => $pengajuanKia[0]->tgl_permohonan,
					'sc_kia' => $pengajuanKia[0]->sc_kia,
					'pas_foto' => $pengajuanKia[0]->pas_foto,
				];
				$hasil = [
					'status' => true,
					'message' => 'Success',
					'data' => $display_data
				];
			}
		} catch (Exception $e) {
			error_log("Error decoding token: " . $e->getMessage());
			$hasil = [
				'status' => false,
				'message' => 'Invalid token: ' . $e->getMessage(),
				'data' => null
			];
		}

		// Set the response content type and output the result as JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function update_pengajuan_kia()
	{
		$data_post = $_POST;
		$hasil = [];

		$headers = apache_request_headers();

		if (!isset($headers['Authorization'])) {
			$hasil = [
				'status' => false,
				'message' => 'Authorization token not found in headers',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		$jwt_token = str_replace('Bearer ', '', $headers['Authorization']);

		if (!$jwt_token) {
			$hasil = [
				'status' => false,
				'message' => 'Invalid token format',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		// Check if required fields are not empty
		if (
			$data_post["NIK"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["NAMA_LGKP"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["ALASAN"] == "" ||
			$data_post["PENGAMBILAN"] == "" ||
			$data_post["DAFTARID"] == "" ||
			$data_post["NO_AKTA_LAHIR"] == "" ||
			$data_post["AKUN"] == "" ||
			empty($_FILES["SC_KIA"]) ||
			empty($_FILES["PAS_FOTO"])
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Update Permohonan, Silahkan Lengkapi Semua Data',
				'data' => null
			];
		} else {
			// Find the record based on NIK
			$existingRecords = Daftar_kia_model::get_criteria(['where' => ['NIK' => $data_post["NIK"]]]);

			if (empty($existingRecords)) {
				$hasil = [
					'status' => false,
					'message' => 'Record not found for the given NIK',
					'data' => null
				];
			} else {
				// Assuming there might be multiple records with the same NIK, update all of them
				foreach ($existingRecords as $existingRecord) {
					// Update the record with the new data
					$existingRecord->nik = $data_post["NIK"];
					$existingRecord->no_kk = $data_post["NO_KK"];
					$existingRecord->nama_lgkp = $data_post["NAMA_LGKP"];
					$existingRecord->no_kec = $data_post["KEC"];
					$existingRecord->no_kel = $data_post["KEL"];
					$existingRecord->alasan = $data_post["ALASAN"];
					$existingRecord->pengambilan = $data_post["PENGAMBILAN"];
					$existingRecord->no_akta_lahir = $data_post["NO_AKTA_LAHIR"];
					$existingRecord->akun = $data_post["AKUN"];

					$photo_file_sc_kia = $_FILES['SC_KIA'];
					$photo_file_pas_foto = $_FILES['PAS_FOTO'];

					$upload_dir = './assets/pengajuan/kia/';
					$photo_path_sc_kia = $upload_dir . $data_post['DAFTARID'] . '_SC_KIA.jpg';
					$photo_path_pas_foto = $upload_dir . $data_post['DAFTARID'] . '_PAS_FOTO.jpg';

					if (
						move_uploaded_file($photo_file_sc_kia['tmp_name'], $photo_path_sc_kia) &&
						move_uploaded_file($photo_file_pas_foto['tmp_name'], $photo_path_pas_foto)
					) {
						$existingRecord->sc_kia = $photo_path_sc_kia;
						$existingRecord->pas_foto = $photo_path_pas_foto;
					} else {
						$hasil = [
							'status' => false,
							'message' => 'Gagal mengunggah foto bukti',
							'data' => null
						];
					}

					// Save the updated record
					$affected_rows = $existingRecord->save();

					if (!$affected_rows) {
						$hasil = [
							'status' => false,
							'message' => 'Failed to update KIA application',
							'data' => null
						];
					} else {
						$display_data = [
							'daftarid' => $existingRecord->daftarid,
							'nik' => $existingRecord->nik,
							'no_kk' => $existingRecord->no_kk,
							'nama_lgkp' => $existingRecord->nama_lgkp,
							'alasan' => $existingRecord->alasan,
							'status' => $existingRecord->status,
							'alasan' => $existingRecord->alasan,
							'no_kec' => $existingRecord->no_kec,
							'no_kel' => $existingRecord->no_kel,
							'no_akta_lahir' => $existingRecord->no_akta_lahir,
							'pengambilan' => $existingRecord->pengambilan,
							'tgl_permohonan' => $existingRecord->tgl_permohonan,
							'sc_kia' => $existingRecord->sc_kia,
							'pas_foto' => $existingRecord->pas_foto,
						];

						$hasil = [
							'status' => true,
							'message' => 'Permohonan KIA berhasil diupdate',
							'data' => $display_data  // Include the updated data in the response
						];
					}
				}
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
}

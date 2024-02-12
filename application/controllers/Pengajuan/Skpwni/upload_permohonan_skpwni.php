<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


class upload_permohonan_skpwni extends CI_Controller
{
	// function simpan_permohonan_skpwni(){
	//     $input_data =file_get_contents('php://input');
	// 	$data_post=json_decode($input_data, true);
	// 	$hasil=[];
	// 	//var_dump($data_post);
	// 	if($data_post['SIMPANSKPWNI']["NIK"] =="" || $data_post['SIMPANSKPWNI']["NO_KK"] =="" || $data_post['SIMPANSKPWNI']["NAMA_LGKP"] =="" || $data_post['SIMPANSKPWNI']["NO_KEC"] =="" || $data_post['SIMPANSKPWNI']["NO_KEL"] =="" || $data_post['SIMPANSKPWNI']["JENIS_KEPINDAHAN"] =="" || $data_post['SIMPANSKPWNI']["DAFTARID"] =="" || $data_post['SIMPANSKPWNI']["SC_F103"] =="" || $data_post['SIMPANSKPWNI']["SC_KTP"] ==""){
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	}else{
	// 		$numRecords = count(Daftar_skpwni_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANSKPWNI']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_skpwni_model::get_criteria(array("NIK"=>$data_post['SIMPANSKPWNI']["NIK"],"STATUS"=>array(1,2)));
	// 		if(count($checkRecordAktif) > 0){
	// 			if($checkRecordAktif[0]->status == 1){
	// 				$hasil=3;
	// 			}elseif($checkRecordAktif[0]->status == 2){
	// 				$hasil=4;
	// 			}

	// 		}else{
	// 			if($numRecords==0){
	// 				//$data_ktp['SIMPANSKPWNI']['DAFTARID'] = $data_post['SIMPANSKPWNI']["DAFTARID"];
	// 				//$data_ktp['SIMPANSKPWNI']['NIK'] = $data_post['SIMPANSKPWNI']["NIK"];
	// 				//$data_ktp['SIMPANSKPWNI']['NO_KK'] = $data_post['SIMPANSKPWNI']["NO_KK"];
	// 				//$data_ktp['SIMPANSKPWNI']['NAMA_LGKP'] = $data_post['SIMPANSKPWNI']["NAMA"];
	// 				//$data_ktp['SIMPANSKPWNI']['NO_KEC'] = $data_post['SIMPANSKPWNI']["KEC"];
	// 				//$data_ktp['SIMPANSKPWNI']['NO_KEL'] = $data_post['SIMPANSKPWNI']["KEL"];
	// 				//$data_ktp['SIMPANSKPWNI']['ALASAN'] = $data_post['SIMPANSKPWNI']["ALASAN"];
	// 				//$data_ktp['SIMPANSKPWNI']['NO_AKTA_LAHIR'] = $data_post['SIMPANSKPWNI']["NO_AKTA_LAHIR"];
	// 				//$data_ktp['SIMPANSKPWNI']['SC_KIA'] = 'upload/permohonan/kia/'.$data_post['SIMPANSKPWNI']["SC_KIA"];
	// 				//$data_ktp['SIMPANSKPWNI']['PAS_FOTO'] = 'upload/permohonan/kia/'.$data_post['SIMPANSKPWNI']["PAS_FOTO"];
	// 				//$data_ktp['SIMPANSKPWNI']['PENGAMBILAN'] = $data_post['SIMPANSKPWNI']["PENGAMBILAN"];
	// 				//$data_ktp['SIMPANSKPWNI']['AKUN'] = $data_post['SIMPANSKPWNI']["AKUN"];
	// 				//$data_ktp['SIMPANSKPWNI']['STATUS'] = 1;
	// 				$record=new Daftar_skpwni_model($data_post['SIMPANSKPWNI']);
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


	function simpan_permohonan_skpwni()
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
		$jwt_secret = $this->config->item('jwt_secret');

		$token_data = JWT::decode($jwt_token, new Key($jwt_secret, 'HS256'));


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
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["JENIS_KEPINDAHAN"] == "" ||
			$data_post["DAFTARID"] == "" ||
			$data_post["AKUN"] == "" ||
			$data_post["DESKRIPSI_FORMULIR_F103"] == "" ||
			$data_post["DESKRIPSI_FOTO_KTP"] == "" ||
			$_FILES["SC_F103"] == "" ||
			$_FILES["SC_KTP"] == ""
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$numRecords = count(Daftar_skpwni_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
			$checkRecordAktif = Daftar_skpwni_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"], "STATUS" => array(1, 2)));
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
						'message' => 'Record with DAFTARID already has a pending application',
						'data' => null
					];
				}
			} else {
				if ($numRecords == 0) {

					$photo_file_sc_ktp = $_FILES['SC_KTP'];
					$photo_file_sc_f103 = $_FILES['SC_F103'];

					$upload_dir = './assets/pengajuan/skp/';
					$photo_path_sc_ktp = $upload_dir . $data_post['DAFTARID'] . '_SC_KTP.jpg';
					$photo_path_pas_sc_f103 = $upload_dir . $data_post['DAFTARID'] . '_F103.jpg';

					if (
						move_uploaded_file($photo_file_sc_ktp['tmp_name'], $photo_path_sc_ktp) &&
						move_uploaded_file($photo_file_sc_f103['tmp_name'], $photo_path_pas_sc_f103)
					) {
						$data_skp['DAFTARID'] = $data_post["DAFTARID"];
						$data_skp['NIK'] = $token_data->nik;
						$data_skp['NO_KK'] = $data_post["NO_KK"];
						$data_skp['NO_KEC'] = $data_post["KEC"];
						$data_skp['NO_KEL'] = $data_post["KEL"];
						$data_skp['DESKRIPSI_FORMULIR_F103'] = $data_post["DESKRIPSI_FORMULIR_F103"];
						$data_skp['DESKRIPSI_FOTO_KTP'] = $data_post["DESKRIPSI_FOTO_KTP"];
						$data_skp['SC_KTP'] = $photo_path_sc_ktp;
						$data_skp['SC_F103'] = $photo_path_pas_sc_f103;
						$data_skp['JENIS_KEPINDAHAN'] = $data_post["JENIS_KEPINDAHAN"];
						$data_skp['AKUN'] = $data_post["AKUN"];
						$data_skp['STATUS'] = 1;
						$record = new Daftar_skpwni_model($data_skp);
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
								'data' => $data_skp
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


	function detailPengajuanSkpwni()
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

		$jwt_secret = $this->config->item('jwt_secret');

		try {
			$token_data = JWT::decode($jwt_token, new Key($jwt_secret, 'HS256'));

			$nik = $token_data->nik;

			$pengajuanSkpwni = Daftar_skpwni_model::get_criteria(['where' => ['nik' => $nik]]);

			if (empty($pengajuanSkpwni)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan SKP data found for the logged-in user',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $pengajuanSkpwni[0]->daftarid,
					'nik' => $pengajuanSkpwni[0]->nik,
					'no_kk' => $pengajuanSkpwni[0]->no_kk,
					'nama_lgkp' => $pengajuanSkpwni[0]->nama_lgkp,
					'status' => $pengajuanSkpwni[0]->status,
					'no_kec' => $pengajuanSkpwni[0]->no_kec,
					'no_kel' => $pengajuanSkpwni[0]->no_kel,
					'jenis_kepindahan' => $pengajuanSkpwni[0]->jenis_kepindahan,
					'tgl_permohonan' => $pengajuanSkpwni[0]->tgl_permohonan,
					'akun' => $pengajuanSkpwni[0]->akun,
					'deskripsi_formulir_f103' => $pengajuanSkpwni[0]->deskripsi_formulir_f103,
					'deskripsi_foto_ktp' => $pengajuanSkpwni[0]->deskripsi_foto_ktp,
					'sc_ktp' => $pengajuanSkpwni[0]->sc_ktp,
					'sc_f103' => $pengajuanSkpwni[0]->sc_f103,
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

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}


	function update_pengajuan_Skpwni()
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
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["JENIS_KEPINDAHAN"] == "" ||
			$data_post["DAFTARID"] == "" ||
			$data_post["AKUN"] == "" ||
			$data_post["DESKRIPSI_FORMULIR_F103"] == "" ||
			$data_post["DESKRIPSI_FOTO_KTP"] == "" ||
			empty($_FILES["SC_F103"]) ||
			empty($_FILES["SC_KTP"])
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Update Permohonan, Silahkan Lengkapi Semua Data',
				'data' => null
			];
		} else {
			// Find the record based on NIK
			$existingRecords = Daftar_skpwni_model::get_criteria(['where' => ['DAFTARID' => $data_post["DAFTARID"]]]);

			if (empty($existingRecords)) {
				$hasil = [
					'status' => false,
					'message' => 'Record not found for the given DAFTARID',
					'data' => null
				];
			} else {
				// Assuming there might be multiple records with the same NIK, update all of them
				foreach ($existingRecords as $existingRecord) {
					// Update the record with the new data
					$existingRecord->no_kk = $data_post["NO_KK"];
					$existingRecord->no_kec = $data_post["KEC"];
					$existingRecord->no_kel = $data_post["KEL"];
					$existingRecord->jenis_kepindahan = $data_post["JENIS_KEPINDAHAN"];
					$existingRecord->akun = $data_post["AKUN"];
					$existingRecord->deskripsi_formulir_f103 = $data_post["DESKRIPSI_FORMULIR_F103"];
					$existingRecord->deskripsi_foto_ktp = $data_post["DESKRIPSI_FOTO_KTP"];

					$photo_file_sc_F103 = $_FILES['SC_F103'];
					$photo_file_sc_KTP = $_FILES['SC_KTP'];

					$upload_dir = './assets/pengajuan/skp/';
					$photo_path_sc_f103 = $upload_dir . $data_post['DAFTARID'] . '_SC_F103.jpg';
					$photo_path_sc_ktp = $upload_dir . $data_post['DAFTARID'] . '_SC_KTP.jpg';

					if (
						move_uploaded_file($photo_file_sc_F103['tmp_name'], $photo_path_sc_f103) &&
						move_uploaded_file($photo_file_sc_KTP['tmp_name'], $photo_path_sc_ktp)
					) {
						$existingRecord->sc_f103 = $photo_path_sc_f103;
						$existingRecord->sc_ktp = $photo_path_sc_ktp;
					} else {
						$hasil = [
							'status' => false,
							'message' => 'Gagal mengunggah foto bukti',
							'data' => null
						];
					}

					$affected_rows = $existingRecord->save();

					if (!$affected_rows) {
						$hasil = [
							'status' => false,
							'message' => 'Failed to update SKPWNI application',
							'data' => null
						];
					} else {
						$display_data = [
							'daftarid' => $existingRecord->daftarid,
							'no_kk' => $existingRecord->no_kk,
							'status' => $existingRecord->status,
							'no_kec' => $existingRecord->no_kec,
							'no_kel' => $existingRecord->no_kel,
							'tgl_permohonan' => $existingRecord->tgl_permohonan,
							'deskripsi_formulir_f103' => $existingRecord->deskripsi_formulir_f103,
							'deskripsi_foto_ktp' => $existingRecord->deskripsi_foto_ktp,
							'sc_f103' => $existingRecord->sc_f103,
							'sc_ktp' => $existingRecord->sc_ktp,
						];

						$hasil = [
							'status' => true,
							'message' => 'Permohonan SKP berhasil diupdate',
							'data' => $display_data  // Include the updated data in the response
						];
					}
				}
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


class upload_permohonan_akte_kelahiran extends CI_Controller
{

	// function simpan_permohonan_akte_kelahiran(){
	//     $input_data =file_get_contents('php://input');
	// 	$data_post=json_decode($input_data, true);
	// 	$hasil=[];
	// 	//var_dump($data_post);
	// 	if($data_post["NO_KK"] =="" || $data_post['SIMPANAKTALAHIR']["KEC"] =="" || $data_post['SIMPANAKTALAHIR']["KEL"] =="" || $data_post['SIMPANAKTALAHIR']["DAFTARID"] =="" || $data_post['SIMPANAKTALAHIR']["AKUN"] =="" || $data_post['SIMPANAKTALAHIR']["NIK_BAYI"] =="" || $data_post['SIMPANAKTALAHIR']["NAMA_BAYI"] =="" || $data_post['SIMPANAKTALAHIR']["ANAK_KE"] =="" || $data_post['SIMPANAKTALAHIR']["BERAT_BAYI"] =="" || $data_post['SIMPANAKTALAHIR']["JENIS_KELAHIRAN"] =="" || $data_post['SIMPANAKTALAHIR']["TEMPAT_KELAHIRAN"] =="" || $data_post['SIMPANAKTALAHIR']["PENOLONG_KELAHIRAN"] =="" || $data_post['SIMPANAKTALAHIR']["FORMULIR"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_NIKAH"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_KTPEL_ORTU"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_SKL"] ==""){
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	}else{
	// 		$numRecords = count(Daftar_akta_lahir_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANAKTALAHIR']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_akta_lahir_model::get_criteria(array("NIK"=>$data_post['SIMPANAKTALAHIR']["NIK_BAYI"],"STATUS"=>array(1,2)));
	// 		if(count($checkRecordAktif) > 0){
	// 			if($checkRecordAktif[0]->status == 1){
	// 				$hasil=3;
	// 			}elseif($checkRecordAktif[0]->status == 2){
	// 				$hasil=4;
	// 			}

	// 		}else{
	// 			if($numRecords==0){
	// 				$data_ktp['SIMPANAKTALAHIR']['DAFTARID'] = $data_post['SIMPANAKTALAHIR']["DAFTARID"];
	// 				$data_ktp['SIMPANAKTALAHIR']['NO_KK'] = $data_post['SIMPANAKTALAHIR']["NO_KK"];
	// 				$data_ktp['SIMPANAKTALAHIR']['NO_KEC'] = $data_post['SIMPANAKTALAHIR']["KEC"];
	// 				$data_ktp['SIMPANAKTALAHIR']['NO_KEL'] = $data_post['SIMPANAKTALAHIR']["KEL"];
	// 				$data_ktp['SIMPANAKTALAHIR']['NIK'] = $data_post['SIMPANAKTALAHIR']["NIK_BAYI"];
	// 				$data_ktp['SIMPANAKTALAHIR']['NAMA_LGKP'] = $data_post['SIMPANAKTALAHIR']["NAMA_BAYI"];
	// 				$data_ktp['SIMPANAKTALAHIR']['ANAK_KE'] = $data_post['SIMPANAKTALAHIR']["ANAK_KE"];
	// 				$data_ktp['SIMPANAKTALAHIR']['BERAT_BAYI'] = $data_post['SIMPANAKTALAHIR']["BERAT_BAYI"];
	// 				$data_ktp['SIMPANAKTALAHIR']['JENIS_LAHIR'] = $data_post['SIMPANAKTALAHIR']["JENIS_KELAHIRAN"];
	// 				$data_ktp['SIMPANAKTALAHIR']['TEMPAT_LHR'] = $data_post['SIMPANAKTALAHIR']["TEMPAT_KELAHIRAN"];
	// 				$data_ktp['SIMPANAKTALAHIR']['PENOLONG_LHR'] = $data_post['SIMPANAKTALAHIR']["PENOLONG_KELAHIRAN"];
	// 				$data_ktp['SIMPANAKTALAHIR']['FORMULIR'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["FORMULIR"];
	// 				$data_ktp['SIMPANAKTALAHIR']['BUKTI_NIKAH_FOTO'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_NIKAH"];
	// 				$data_ktp['SIMPANAKTALAHIR']['KTP_ORTU_FOTO'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_KTPEL_ORTU"];
	// 				$data_ktp['SIMPANAKTALAHIR']['BUKTI_LAHIR_FOTO'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_SKL"];
	// 				$data_ktp['SIMPANAKTALAHIR']['AKUN'] = $data_post['SIMPANAKTALAHIR']["AKUN"];
	// 				$data_ktp['SIMPANAKTALAHIR']['STATUS'] = 1;
	// 				$record=new Daftar_akta_lahir_model($data_ktp['SIMPANAKTALAHIR']);
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


	// function simpan_permohonan_akte_kelahiran()
	// {
	// 	$data_post = $_POST;
	// 	$hasil = [];


	// 	if ($data_post["NO_KK"] == "" || $data_post["KEC"] == "" || $data_post["KEL"] == "" || $data_post["DAFTARID"] == "" || $data_post["AKUN"] == "" || $data_post["NIK_BAYI"] == "" || $data_post["NAMA_BAYI"] == "" || $data_post["ANAK_KE"] == "" || $data_post["BERAT_BAYI"] == "" || $data_post["JENIS_KELAHIRAN"] == "" || $data_post["TEMPAT_KELAHIRAN"] == "" || $data_post["PENOLONG_KELAHIRAN"] == "" || $_FILES["FORMULIR"] == "" || $_FILES["BUKTI_NIKAH_FOTO"] == "" || $_FILES["KTP_ORTU_FOTO"] == "" || $_FILES["BUKTI_LAHIR_FOTO"] == "") {
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	} else {
	// 		$numRecords = count(Daftar_akta_lahir_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_akta_lahir_model::get_criteria(array("NIK" => $data_post["NIK_BAYI"], "STATUS" => array(1, 2)));

	// 		if (count($checkRecordAktif) > 0) {
	// 			if ($checkRecordAktif[0]->status == 1) {
	// 				$hasil = [
	// 					'status' => false,
	// 					'message' => 'Record with NIK already has an active application',
	// 					'data' => null
	// 				];
	// 			} elseif ($checkRecordAktif[0]->status == 2) {
	// 				$hasil = [
	// 					'status' => false,
	// 					'message' => 'Record with NIK already has a pending application',
	// 					'data' => null
	// 				];
	// 			}
	// 		} else {
	// 			if ($numRecords == 0) {
	// 				$photo_file_F201 = $_FILES['FORMULIR'];
	// 				$photo_file_NIKAH = $_FILES['BUKTI_NIKAH_FOTO'];
	// 				$photo_file_KTPEL_ORTU = $_FILES['KTP_ORTU_FOTO'];
	// 				$photo_file_SKL = $_FILES['BUKTI_LAHIR_FOTO'];

	// 				$upload_dir = './assets/pengajuan/akte/';
	// 				$photo_path_formulir = $upload_dir . $data_post['DAFTARID'] . '_formulir.jpg';
	// 				$photo_path_bukti_nikah = $upload_dir . $data_post['DAFTARID'] . '_bukti_nikah.jpg';
	// 				$photo_path_ktp_ortu = $upload_dir . $data_post['DAFTARID'] . '_ktp_ortu.jpg';
	// 				$photo_path_bukti_lahir = $upload_dir . $data_post['DAFTARID'] . '_bukti_lahir.jpg';


	// 				$data_ktp['DAFTARID'] = $data_post["DAFTARID"];
	// 				$data_ktp['NO_KK'] = $data_post["NO_KK"];
	// 				$data_ktp['NO_KEC'] = $data_post["KEC"];
	// 				$data_ktp['NO_KEL'] = $data_post["KEL"];
	// 				$data_ktp['NIK'] = $data_post["NIK_BAYI"];
	// 				$data_ktp['NAMA_LGKP'] = $data_post["NAMA_BAYI"];
	// 				$data_ktp['ANAK_KE'] = $data_post["ANAK_KE"];
	// 				$data_ktp['BERAT_BAYI'] = $data_post["BERAT_BAYI"];
	// 				$data_ktp['JENIS_LAHIR'] = $data_post["JENIS_KELAHIRAN"];
	// 				$data_ktp['TEMPAT_LHR'] = $data_post["TEMPAT_KELAHIRAN"];
	// 				$data_ktp['PENOLONG_LHR'] = $data_post["PENOLONG_KELAHIRAN"];
	// 				$data_ktp['FORMULIR'] = $photo_path_formulir;
	// 				$data_ktp['BUKTI_NIKAH_FOTO'] = $photo_path_bukti_nikah;
	// 				$data_ktp['KTP_ORTU_FOTO'] = $photo_path_ktp_ortu;
	// 				$data_ktp['BUKTI_LAHIR_FOTO'] = $photo_path_bukti_lahir;
	// 				$data_ktp['AKUN'] = $data_post["AKUN"];
	// 				$data_ktp['STATUS'] = 1;
	// 				// print_r($data_ktp);die;

	// 				if (
	// 					move_uploaded_file($photo_file_F201['tmp_name'], $photo_path_formulir) &&
	// 					move_uploaded_file($photo_file_NIKAH['tmp_name'], $photo_path_bukti_nikah) &&
	// 					move_uploaded_file($photo_file_KTPEL_ORTU['tmp_name'], $photo_path_ktp_ortu) &&
	// 					move_uploaded_file($photo_file_SKL['tmp_name'], $photo_path_bukti_lahir)
	// 				) {
	// 					$record = new Daftar_akta_lahir_model($data_ktp);
	// 					$affected_rows = $record->save();
	// 					if (!$affected_rows) {
	// 						$hasil = 0;
	// 					} else {
	// 						$hasil = [
	// 							'status' => true,
	// 							'message' => 'Permohonan KTP berhasil diajukan',
	// 							'data' => $data_ktp
	// 						];
	// 					}
	// 				} else {
	// 					$hasil = "Gagal mengunggah salah satu foto bukti";
	// 				}
	// 			} else {
	// 				$hasil = 2;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	// }

	function simpan_permohonan_akte_kelahiran()
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

		if ($data_post["NO_KK"] == "" ||
		 	$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["DAFTARID"] == "" ||
			$data_post["AKUN"] == "" ||
			$data_post["NIK_BAYI"] == "" ||
			$data_post["NAMA_BAYI"] == "" ||
			$data_post["ANAK_KE"] == "" ||
			$data_post["BERAT_BAYI"] == "" ||
			$data_post["JENIS_KELAHIRAN"] == "" ||
			$data_post["TEMPAT_KELAHIRAN"] == "" ||
			$data_post["PENOLONG_KELAHIRAN"] == "" ||
			$data_post["DESKRIPSI_FORMULIR_F201"] == "" ||
			$data_post["DESKRIPSI_BUKU_NIKAH"] == "" ||
			$data_post["DESKRIPSI_FOTO_KTP"] == "" ||
			$data_post["DESKRIPSI_FOTO_BUKTI_LAHIR"] == "" ||
			$_FILES["FORMULIR"] == "" || 
			$_FILES["BUKTI_NIKAH_FOTO"] == "" || 
			$_FILES["KTP_ORTU_FOTO"] == "" || 
			$_FILES["BUKTI_LAHIR_FOTO"] == "") {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$numRecords = count(Daftar_akta_lahir_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
			$checkRecordAktif = Daftar_akta_lahir_model::get_criteria(array("NIK" => $data_post["NIK_BAYI"], "STATUS" => array(1, 2)));

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
					$photo_file_F201 = $_FILES['FORMULIR'];
					$photo_file_NIKAH = $_FILES['BUKTI_NIKAH_FOTO'];
					$photo_file_KTPEL_ORTU = $_FILES['KTP_ORTU_FOTO'];
					$photo_file_SKL = $_FILES['BUKTI_LAHIR_FOTO'];

					$upload_dir = './assets/pengajuan/akte/';
					$photo_path_formulir = $upload_dir . $data_post['DAFTARID'] . '_formulir.jpg';
					$photo_path_bukti_nikah = $upload_dir . $data_post['DAFTARID'] . '_bukti_nikah.jpg';
					$photo_path_ktp_ortu = $upload_dir . $data_post['DAFTARID'] . '_ktp_ortu.jpg';
					$photo_path_bukti_lahir = $upload_dir . $data_post['DAFTARID'] . '_bukti_lahir.jpg';

					$data_ktp['DAFTARID'] = $data_post["DAFTARID"];
					$data_ktp['NO_KK'] = $data_post["NO_KK"];
					$data_ktp['NO_KEC'] = $data_post["KEC"];
					$data_ktp['NO_KEL'] = $data_post["KEL"];
					$data_ktp['NIK'] = $data_post["NIK_BAYI"];
					$data_ktp['NAMA_LGKP'] = $data_post["NAMA_BAYI"];
					$data_ktp['ANAK_KE'] = $data_post["ANAK_KE"];
					$data_ktp['BERAT_BAYI'] = $data_post["BERAT_BAYI"];
					$data_ktp['JENIS_LAHIR'] = $data_post["JENIS_KELAHIRAN"];
					$data_ktp['TEMPAT_LHR'] = $data_post["TEMPAT_KELAHIRAN"];
					$data_ktp['PENOLONG_LHR'] = $data_post["PENOLONG_KELAHIRAN"];
					$data_ktp['DESKRIPSI_FORMULIR_F201'] = $data_post["DESKRIPSI_FORMULIR_F201"];
					$data_ktp['DESKRIPSI_BUKU_NIKAH'] = $data_post["DESKRIPSI_BUKU_NIKAH"];
					$data_ktp['DESKRIPSI_FOTO_KTP'] = $data_post["DESKRIPSI_FOTO_KTP"];
					$data_ktp['DESKRIPSI_FOTO_BUKTI_LAHIR'] = $data_post["DESKRIPSI_FOTO_BUKTI_LAHIR"];
					$data_ktp['FORMULIR'] = $photo_path_formulir;
					$data_ktp['BUKTI_NIKAH_FOTO'] = $photo_path_bukti_nikah;
					$data_ktp['KTP_ORTU_FOTO'] = $photo_path_ktp_ortu;
					$data_ktp['BUKTI_LAHIR_FOTO'] = $photo_path_bukti_lahir;
					$data_ktp['AKUN'] = $data_post["AKUN"];
					$data_ktp['STATUS'] = 1;

					if (
						move_uploaded_file($photo_file_F201['tmp_name'], $photo_path_formulir) &&
						move_uploaded_file($photo_file_NIKAH['tmp_name'], $photo_path_bukti_nikah) &&
						move_uploaded_file($photo_file_KTPEL_ORTU['tmp_name'], $photo_path_ktp_ortu) &&
						move_uploaded_file($photo_file_SKL['tmp_name'], $photo_path_bukti_lahir)
					) {
						$record = new Daftar_akta_lahir_model($data_ktp);
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
								'data' => $data_ktp
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

	function detailPengajuanAkte()
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

			// Fetch pengajuanKtp data for the logged-in user
			$pengajuanKtp = Daftar_akta_lahir_model::get_criteria(['where' => ['nik' => $nik]]);
			// print_r($pengajuanKtp);die;

			if (empty($pengajuanKtp)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan Akte data found for the logged-in user',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $pengajuanKtp[0]->daftarid,
					'nik' => $pengajuanKtp[0]->nik,
					'tgl_permohonan' => $pengajuanKtp[0]->tgl_permohonan,
					'no_kk' => $pengajuanKtp[0]->no_kk,
					'nama_lgkp' => $pengajuanKtp[0]->nama_lgkp,
					'anak_ke' => $pengajuanKtp[0]->anak_ke,
					'berat_bayi' => $pengajuanKtp[0]->berat_bayi,
					'jenis_lahir' => $pengajuanKtp[0]->jenis_lahir,
					'penolong_lhr' => $pengajuanKtp[0]->penolong_lhr,
					'status' => $pengajuanKtp[0]->status,
					'no_kec' => $pengajuanKtp[0]->no_kec,
					'no_kel' => $pengajuanKtp[0]->no_kel,
					'deskripsi_formulir_f201' => $pengajuanKtp[0]->deskripsi_formulir_f201,
					'deskripsi_buku_nikah' => $pengajuanKtp[0]->deskripsi_buku_nikah,
					'deskripsi_foto_ktp' => $pengajuanKtp[0]->deskripsi_foto_ktp,
					'deskripsi_foto_bukti_lahir' => $pengajuanKtp[0]->deskripsi_foto_bukti_lahir,
					'formulir' => $pengajuanKtp[0]->formulir,
					'bukti_nikah_foto' => $pengajuanKtp[0]->bukti_nikah_foto,
					'bukti_lahir_foto' => $pengajuanKtp[0]->bukti_lahir_foto,
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


	function update_permohonan_akte_kelahiran()
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
		if ($data_post["NO_KK"] == "" ||
		$data_post["KEC"] == "" ||
		$data_post["KEL"] == "" ||
		$data_post["DAFTARID"] == "" ||
		$data_post["AKUN"] == "" ||
		$data_post["NIK_BAYI"] == "" ||
		$data_post["NAMA_BAYI"] == "" ||
		$data_post["ANAK_KE"] == "" ||
		$data_post["BERAT_BAYI"] == "" ||
		$data_post["JENIS_KELAHIRAN"] == "" ||
		$data_post["TEMPAT_KELAHIRAN"] == "" ||
		$data_post["PENOLONG_KELAHIRAN"] == "" ||
		$data_post["DESKRIPSI_FORMULIR_F201"] == "" ||
		$data_post["DESKRIPSI_BUKU_NIKAH"] == "" ||
		$data_post["DESKRIPSI_FOTO_KTP"] == "" ||
		$data_post["DESKRIPSI_FOTO_BUKTI_LAHIR"] == "" ||
		$_FILES["FORMULIR"] == "" ||
		$_FILES["BUKTI_NIKAH_FOTO"] == "" ||
		$_FILES["KTP_ORTU_FOTO"] == "" ||
		$_FILES["BUKTI_LAHIR_FOTO"] == "") {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Update Permohonan, Silahkan Lengkapi Semua Data',
				'data' => null
			];
		} else {
			// Find the record based on NIK
			$existingRecords = Daftar_akta_lahir_model::get_criteria(['where' => ['NIK' => $data_post["NIK_BAYI"]]]);

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
					$existingRecord->nik = $data_post["NIK_BAYI"];
					$existingRecord->no_kk = $data_post["NO_KK"];
					$existingRecord->nama_lgkp = $data_post["NAMA_BAYI"];
					$existingRecord->no_kec = $data_post["KEC"];
					$existingRecord->no_kel = $data_post["KEL"];
					$existingRecord->akun = $data_post["AKUN"];
					$existingRecord->berat_bayi = $data_post["BERAT_BAYI"];
					$existingRecord->jenis_lahir = $data_post["JENIS_KELAHIRAN"];
					$existingRecord->tempat_lhr = $data_post["TEMPAT_KELAHIRAN"];
					$existingRecord->penolong_lhr = $data_post["PENOLONG_KELAHIRAN"];
					$existingRecord->deskripsi_formulir_f201 = $data_post["DESKRIPSI_FORMULIR_F201"];
					$existingRecord->deskripsi_buku_nikah = $data_post["DESKRIPSI_BUKU_NIKAH"];
					$existingRecord->deskripsi_foto_ktp = $data_post["DESKRIPSI_FOTO_KTP"];
					$existingRecord->deskripsi_foto_bukti_lahir = $data_post["DESKRIPSI_FOTO_BUKTI_LAHIR"];

					$photo_file_F201 = $_FILES['FORMULIR'];
					$photo_file_NIKAH = $_FILES['BUKTI_NIKAH_FOTO'];
					$photo_file_KTPEL_ORTU = $_FILES['KTP_ORTU_FOTO'];
					$photo_file_SKL = $_FILES['BUKTI_LAHIR_FOTO'];

					$upload_dir = './assets/pengajuan/akte/';
					$photo_path_formulir = $upload_dir . $data_post['DAFTARID'] . '_formulir.jpg';
					$photo_path_bukti_nikah = $upload_dir . $data_post['DAFTARID'] . '_bukti_nikah.jpg';
					$photo_path_ktp_ortu = $upload_dir . $data_post['DAFTARID'] . '_ktp_ortu.jpg';
					$photo_path_bukti_lahir = $upload_dir . $data_post['DAFTARID'] . '_bukti_lahir.jpg';


					if (
						move_uploaded_file($photo_file_F201['tmp_name'], $photo_path_formulir) &&
						move_uploaded_file($photo_file_NIKAH['tmp_name'], $photo_path_bukti_nikah) &&
						move_uploaded_file($photo_file_KTPEL_ORTU['tmp_name'], $photo_path_ktp_ortu) &&
						move_uploaded_file($photo_file_SKL['tmp_name'], $photo_path_bukti_lahir)
					) {
						$existingRecord->formulir = $photo_path_formulir;
						$existingRecord->bukti_nikah_foto = $photo_path_bukti_nikah;
						$existingRecord->ktp_ortu_foto = $photo_path_ktp_ortu;
						$existingRecord->bukti_lahir_foto = $photo_path_bukti_lahir;
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
							'message' => 'Failed to update Akte application',
							'data' => null
						];
					} else {
						$display_data = [
							'daftarid' => $existingRecord->daftarid,
							'nik' => $existingRecord->nik,
							'tgl_permohonan' => $existingRecord->tgl_permohonan,
							'no_kk' => $existingRecord->no_kk,
							'nama_lgkp' => $existingRecord->nama_lgkp,
							'anak_ke' => $existingRecord->anak_ke,
							'berat_bayi' => $existingRecord->berat_bayi,
							'jenis_lahir' => $existingRecord->jenis_lahir,
							'penolong_lhr' => $existingRecord->penolong_lhr,
							'status' => $existingRecord->status,
							'no_kec' => $existingRecord->no_kec,
							'no_kel' => $existingRecord->no_kel,
							'deskripsi_formulir_f201' => $existingRecord->deskripsi_formulir_f201,
							'deskripsi_buku_nikah' => $existingRecord->deskripsi_buku_nikah,
							'deskripsi_foto_ktp' => $existingRecord->deskripsi_foto_ktp,
							'deskripsi_foto_bukti_lahir' => $existingRecord->deskripsi_foto_bukti_lahir,
							'formulir' => $existingRecord->formulir,
							'bukti_nikah_foto' => $existingRecord->bukti_nikah_foto,
							'bukti_lahir_foto' => $existingRecord->bukti_lahir_foto,
						];
						$hasil = [
							'status' => true,
							'message' => 'Permohonan Akte berhasil diupdate',
							'data' => $display_data
						];
					}
				}
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
}

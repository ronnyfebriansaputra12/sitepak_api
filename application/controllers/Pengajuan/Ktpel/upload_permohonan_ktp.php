<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


class upload_permohonan_ktp extends CI_Controller
{
	// function simpan_permohonan_ktp(){
	//     $input_data =file_get_contents('php://input');
	// 	$data_post=json_decode($input_data, true);
	// 	$hasil=[];
	// 	//var_dump($data_post);
	// 	if($data_post["NIK"] =="" || $data_post["NO_KK"] =="" || $data_post["NAMA"] =="" || $data_post["KEC"] =="" || $data_post["KEL"] =="" || $data_post["ALASAN"] =="" || $data_post["PENGAMBILAN"] =="" || $data_post["DAFTARID"] =="" || $data_post["SC_KTP"] ==""){
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	}else{
	// 		$numRecords = count(Daftar_ktp_model::get_criteria(array("DAFTARID"=>$data_post["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_ktp_model::get_criteria(array("NIK"=>$data_post["NIK"],"STATUS"=>array(1,2)));
	// 		if(count($checkRecordAktif) > 0){
	// 			if($checkRecordAktif[0]->status == 1){
	// 				$hasil=3;
	// 			}elseif($checkRecordAktif[0]->status == 2){
	// 				$hasil=4;
	// 			}

	// 		}else{
	// 			if($numRecords==0){
	// 				$data_ktp['DAFTARID'] = $data_post["DAFTARID"];
	// 				$data_ktp['NIK'] = $data_post["NIK"];
	// 				$data_ktp['NO_KK'] = $data_post["NO_KK"];
	// 				$data_ktp['NAMA_LGKP'] = $data_post["NAMA"];
	// 				$data_ktp['NO_KEC'] = $data_post["KEC"];
	// 				$data_ktp['NO_KEL'] = $data_post["KEL"];
	// 				$data_ktp['ALASAN'] = $data_post["ALASAN"];
	// 				$data_ktp['SC_KTP'] = 'upload/permohonan/ktpel/'.$data_post["SC_KTP"];
	// 				$data_ktp['PENGAMBILAN'] = $data_post["PENGAMBILAN"];
	// 				$data_ktp['AKUN'] = $data_post["AKUN"];
	// 				$data_ktp['STATUS'] = 1;
	// 				$record=new Daftar_ktp_model($data_ktp);
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
	// 	 $this->output->set_content_type('application/json')->set_output($hasil);
	// }

	function simpan_permohonan_ktp()
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

		// print_r($data_post);die;

		// Check if required fields are not empty
		if (empty($data_post["NIK"]) || empty($data_post["NO_KK"]) || empty($data_post["NAMA_LGKP"]) || empty($data_post["KEC"]) || empty($data_post["KEL"]) || empty($data_post["ALASAN"]) || empty($data_post["PENGAMBILAN"]) || empty($data_post["DAFTARID"]) || empty($_FILES['SC_KTP'])) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Lengkapi Semua Data',
				'data' => null
			];
		} else {
			$numRecords = count(Daftar_ktp_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
			$checkRecordAktif = Daftar_ktp_model::get_criteria(array("NIK" => $data_post["NIK"], "STATUS" => array(1, 2)));

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
					$photo_file = $_FILES['SC_KTP'];
					$upload_dir = './assets/pengajuan/ktp/';
					$photo_path = $upload_dir . $data_post['NIK'] . '_pengajuan_ktp.jpg';

					if (move_uploaded_file($photo_file['tmp_name'], $photo_path)) {
						$data_ktp['DAFTARID'] = $data_post["DAFTARID"];
						$data_ktp['NIK'] = $data_post["NIK"];
						$data_ktp['NO_KK'] = $data_post["NO_KK"];
						$data_ktp['NAMA_LGKP'] = $data_post["NAMA_LGKP"];
						$data_ktp['NO_KEC'] = $data_post["KEC"];
						$data_ktp['NO_KEL'] = $data_post["KEL"];
						$data_ktp['ALASAN'] = $data_post["ALASAN"];
						$data_ktp['SC_KTP'] = $photo_path;
						$data_ktp['PENGAMBILAN'] = $data_post["PENGAMBILAN"];
						// $data_ktp['AKUN'] = $data_post["AKUN"];
						$data_ktp['STATUS'] = 1;

						// print_r($data_ktp);die;

						$record = new Daftar_ktp_model($data_ktp);
						$affected_rows = $record->save();

						if (!$affected_rows) {
							$hasil = [
								'status' => false,
								'message' => 'Failed to save KTP application',
								'data' => null
							];
						} else {
							$hasil = [
								'status' => true,
								'message' => 'Permohonan KTP berhasil diajukan',
								'data' => $data_ktp
							];
						}
					} else {
						$hasil = [
							'status' => false,
							'message' => 'Gagal mengunggah foto bukti',
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

	function detailPengajuanKtp()
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
			$pengajuanKtp = Daftar_ktp_model::get_criteria(['where' => ['nik' => $nik]]);

			if (empty($pengajuanKtp)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuanKtp data found for the logged-in user',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $pengajuanKtp[0]->daftarid,
					'nik' => $pengajuanKtp[0]->nik,
					'no_kk' => $pengajuanKtp[0]->no_kk,
					'nama_lgkp' => $pengajuanKtp[0]->nama_lgkp,
					'alasan' => $pengajuanKtp[0]->alasan,
					'status' => $pengajuanKtp[0]->status,
					'alasan' => $pengajuanKtp[0]->alasan,
					'no_kec' => $pengajuanKtp[0]->no_kec,
					'no_kel' => $pengajuanKtp[0]->no_kel,
					'tgl_permohonan' => $pengajuanKtp[0]->tgl_permohonan,
					'pengambilan' => $pengajuanKtp[0]->pengambilan,
					'sc_ktp' => $pengajuanKtp[0]->sc_ktp,
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
}

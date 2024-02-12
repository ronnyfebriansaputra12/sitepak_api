<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


class upload_permohonan_kk extends CI_Controller
{

	function simpan_permohonan_tambah_jiwa()
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
		$nik = $token_data->nik;
	
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
			$data_post["DAFTARID"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_F101"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_NIKAH"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_SKL"] == "" ||
			$_FILES["SC_F101"] == "" ||
			$_FILES["SC_NIKAH"] == "" ||
			$_FILES["SC_SKL"] == ""
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
			$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK" => $data_post["NO_KK"], "STATUS" => array(1, 2)));
	
			if (count($checkRecordAktif) > 0) {
				if ($checkRecordAktif[0]->status == 1) {
					$hasil = [
						'status' => false,
						'message' => 'Record with NO KK already has an active application',
						'data' => null
					];
				} elseif ($checkRecordAktif[0]->status == 2) {
					$hasil = [
						'status' => false,
						'message' => 'Record with NO KK already has a pending application',
						'data' => null
					];
				}
			} else {
				if ($numRecords == 0) {
					$photo_file_sc_f101 = $_FILES['SC_F101'];
					$photo_file_sc_nikah = $_FILES['SC_NIKAH'];
					$photo_file_sc_skl = $_FILES['SC_SKL'];
	
					$upload_dir = './assets/pengajuan/kk/penambahan_jiwa/';
					$photo_path_sc_f101 = $upload_dir . $token_data->nik . '_SC_F101.jpg';
					$photo_path_pas_sc_nikah = $upload_dir . $token_data->nik . '_NIKAH.jpg';
					$photo_path_pas_sc_skl = $upload_dir . $token_data->nik . '_SKL.jpg';
	
					if (
						move_uploaded_file($photo_file_sc_f101['tmp_name'], $photo_path_sc_f101) &&
						move_uploaded_file($photo_file_sc_nikah['tmp_name'], $photo_path_pas_sc_nikah) &&
						move_uploaded_file($photo_file_sc_skl['tmp_name'], $photo_path_pas_sc_skl)
					) {
						$data_kk['DAFTARID'] = $data_post["DAFTARID"];
						$data_kk['NO_KK'] = $data_post["NO_KK"];
						$data_kk['NIK'] = $nik;
						$data_kk['NO_KEC'] = $data_post["KEC"];
						$data_kk['NO_KEL'] = $data_post["KEL"];
						$data_kk['DESKRIPSI_DOC_SC_F101'] = $data_post["DESKRIPSI_DOC_SC_F101"];
						$data_kk['DESKRIPSI_DOC_SC_NIKAH'] = $data_post["DESKRIPSI_DOC_SC_NIKAH"];
						$data_kk['DESKRIPSI_DOC_SC_SKL'] = $data_post["DESKRIPSI_DOC_SC_SKL"];
						$data_kk['SC_F101'] = $photo_path_sc_f101;
						$data_kk['SC_NIKAH'] = $photo_path_pas_sc_nikah;
						$data_kk['SC_SKL'] = $photo_path_pas_sc_skl;
						$data_kk['AKUN'] = $data_post["AKUN"];
						$data_kk['STATUS'] = 1;
						$data_kk['TYPE'] = 1;

						$record = new Daftar_kk_model($data_kk);
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
								'data' => $data_kk
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
						'message' => 'Gagal mengunggah foto bukti',
						'data' => null
					];
				}
			}
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}


	function detail_permohonan_tambah_jiwa() {
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
	
			// Fetch pengajuanKtp data for the logged-in user with type == 1
			$penambahan_jiwa = Daftar_kk_model::get_criteria(['where' => ['nik' => $nik, 'type' => 1]]);
	
			if (empty($penambahan_jiwa)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan KK data found for the logged-in user with type 1',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $penambahan_jiwa[0]->daftarid,
					'nik' => $penambahan_jiwa[0]->nik,
					'no_kk' => $penambahan_jiwa[0]->no_kk,
					'nama_lgkp' => $penambahan_jiwa[0]->nama_lgkp,
					'status' => $penambahan_jiwa[0]->status,
					'deskripsi_doc_sc_f101' => $penambahan_jiwa[0]->deskripsi_doc_sc_f101,
					'deskripsi_doc_sc_nikah' => $penambahan_jiwa[0]->deskripsi_doc_sc_nikah,
					'deskripsi_doc_sc_skl' => $penambahan_jiwa[0]->deskripsi_doc_sc_skl,
					'no_kec' => $penambahan_jiwa[0]->no_kec,
					'no_kel' => $penambahan_jiwa[0]->no_kel,
					'tgl_permohonan' => $penambahan_jiwa[0]->tgl_permohonan,
					'sc_f101' => $penambahan_jiwa[0]->sc_f101,
					'sc_nikah' => $penambahan_jiwa[0]->sc_nikah,
					'sc_skl' => $penambahan_jiwa[0]->sc_skl,
					'type' => $penambahan_jiwa[0]->type,
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
	
	function simpan_permohonan_kurang_jiwa()
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
		$nik = $token_data->nik;
	
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
			$data_post["DAFTARID"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_F101"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_NIKAH"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_KEMATIAN"] == "" ||
			$_FILES["SC_F101"] == "" ||
			$_FILES["SC_NIKAH"] == "" ||
			$_FILES["SC_KEMATIAN"] == ""
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$photo_file_sc_f101 = $_FILES['SC_F101'];
			$photo_file_sc_nikah = $_FILES['SC_NIKAH'];
			$photo_file_sc_kematian = $_FILES['SC_KEMATIAN'];
	
			$upload_dir = './assets/pengajuan/kk/pengurangan_jiwa/';
			$photo_path_sc_f101 = $upload_dir . $token_data->nik . '_SC_F101.jpg';
			$photo_path_pas_sc_nikah = $upload_dir . $token_data->nik . '_NIKAH.jpg';
			$photo_path_pas_sc_kematian = $upload_dir . $token_data->nik . '_NIKAH.jpg';
	
			if (
				move_uploaded_file($photo_file_sc_f101['tmp_name'], $photo_path_sc_f101) &&
				move_uploaded_file($photo_file_sc_nikah['tmp_name'], $photo_path_pas_sc_nikah) &&
				move_uploaded_file($photo_file_sc_kematian['tmp_name'], $photo_path_pas_sc_kematian)
			) {
				$data_kk['DAFTARID'] = $data_post["DAFTARID"];
				$data_kk['NO_KK'] = $data_post["NO_KK"];
				$data_kk['NIK'] = $nik;
				$data_kk['NO_KEC'] = $data_post["KEC"];
				$data_kk['NO_KEL'] = $data_post["KEL"];
				$data_kk['DESKRIPSI_DOC_SC_F101'] = $data_post["DESKRIPSI_DOC_SC_F101"];
				$data_kk['DESKRIPSI_DOC_SC_NIKAH'] = $data_post["DESKRIPSI_DOC_SC_NIKAH"];
				$data_kk['DESKRIPSI_DOC_SC_KEMATIAN'] = $data_post["DESKRIPSI_DOC_SC_KEMATIAN"];
				$data_kk['SC_F101'] = $photo_path_sc_f101;
				$data_kk['SC_NIKAH'] = $photo_path_pas_sc_nikah;
				$data_kk['SC_KEMATIAN'] = $photo_path_pas_sc_kematian;
				$data_kk['AKUN'] = $data_post["AKUN"];
				$data_kk['STATUS'] = 1;
				$data_kk['TYPE'] = 2;
	
				$record = new Daftar_kk_model($data_kk);
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
						'data' => $data_kk
					];
				}
			} else {
				$hasil = [
					'status' => false,
					'message' => 'Failed to upload one of the photo proofs',
					'data' => null
				];
			}
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
	
	function detail_permohonan_kurang_jiwa() {
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
	
			// Fetch pengajuanKtp data for the logged-in user with type == 1
			$penambahan_jiwa = Daftar_kk_model::get_criteria(['where' => ['nik' => $nik, 'type' => 2]]);
	
			if (empty($penambahan_jiwa)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan KK data found for the logged-in user with type 1',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $penambahan_jiwa[0]->daftarid,
					'nik' => $penambahan_jiwa[0]->nik,
					'no_kk' => $penambahan_jiwa[0]->no_kk,
					'nama_lgkp' => $penambahan_jiwa[0]->nama_lgkp,
					'status' => $penambahan_jiwa[0]->status,
					'deskripsi_doc_sc_f101' => $penambahan_jiwa[0]->deskripsi_doc_sc_f101,
					'deskripsi_doc_sc_nikah' => $penambahan_jiwa[0]->deskripsi_doc_sc_nikah,
					'deskripsi_doc_sc_kematian' => $penambahan_jiwa[0]->deskripsi_doc_sc_kematian,
					'no_kec' => $penambahan_jiwa[0]->no_kec,
					'no_kel' => $penambahan_jiwa[0]->no_kel,
					'tgl_permohonan' => $penambahan_jiwa[0]->tgl_permohonan,
					'sc_f101' => $penambahan_jiwa[0]->sc_f101,
					'sc_nikah' => $penambahan_jiwa[0]->sc_nikah,
					'sc_kematian' => $penambahan_jiwa[0]->sc_kematian,
					'type' => $penambahan_jiwa[0]->type,
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


	function simpan_permohonan_kk_rusak()
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
		$nik = $token_data->nik;

	
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
			$data_post["DAFTARID"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_F101"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_NIKAH"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_KK_RUSAK"] == "" ||
			$_FILES["SC_F101"] == "" ||
			$_FILES["SC_NIKAH"] == "" ||
			$_FILES["SC_BUKTI_KK_RUSAK"] == ""
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$photo_file_sc_f101 = $_FILES['SC_F101'];
			$photo_file_sc_nikah = $_FILES['SC_NIKAH'];
			$photo_file_kk_rusak = $_FILES['SC_BUKTI_KK_RUSAK'];
	
			$upload_dir = './assets/pengajuan/kk/kk_rusak/';
			$photo_path_sc_f101 = $upload_dir . $token_data->nik . '_SC_F101.jpg';
			$photo_path_pas_sc_nikah = $upload_dir . $token_data->nik . '_NIKAH.jpg';
			$photo_path_pas_sc_kk_rusak = $upload_dir . $token_data->nik . '_SKL.jpg';
	
			if (
				move_uploaded_file($photo_file_sc_f101['tmp_name'], $photo_path_sc_f101) &&
				move_uploaded_file($photo_file_sc_nikah['tmp_name'], $photo_path_pas_sc_nikah) &&
				move_uploaded_file($photo_file_kk_rusak['tmp_name'], $photo_path_pas_sc_kk_rusak)
			) {
				$data_kk['DAFTARID'] = $data_post["DAFTARID"];
				$data_kk['NO_KK'] = $data_post["NO_KK"];
				$data_kk['NIK'] = $nik;
				$data_kk['NO_KEC'] = $data_post["KEC"];
				$data_kk['NO_KEL'] = $data_post["KEL"];
				$data_kk['DESKRIPSI_DOC_SC_F101'] = $data_post["DESKRIPSI_DOC_SC_F101"];
				$data_kk['DESKRIPSI_DOC_SC_NIKAH'] = $data_post["DESKRIPSI_DOC_SC_NIKAH"];
				$data_kk['DESKRIPSI_DOC_SC_KK_RUSAK'] = $data_post["DESKRIPSI_DOC_SC_KK_RUSAK"];
				$data_kk['SC_F101'] = $photo_path_sc_f101;
				$data_kk['SC_NIKAH'] = $photo_path_pas_sc_nikah;
				$data_kk['SC_BUKTI_KK_RUSAK'] = $photo_path_pas_sc_kk_rusak;
				$data_kk['AKUN'] = $data_post["AKUN"];
				$data_kk['STATUS'] = 1;
				$data_kk['TYPE'] = 3;
	
				$record = new Daftar_kk_model($data_kk);
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
						'data' => $data_kk
					];
				}
			} else {
				$hasil = [
					'status' => false,
					'message' => 'Failed to upload one of the photo proofs',
					'data' => null
				];
			}
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function detail_permohonan_kk_rusak() {
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
	
			// Fetch pengajuanKtp data for the logged-in user with type == 1
			$penambahan_jiwa = Daftar_kk_model::get_criteria(['where' => ['nik' => $nik, 'type' => 3]]);
	
			if (empty($penambahan_jiwa)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan KK data found for the logged-in user with type 1',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $penambahan_jiwa[0]->daftarid,
					'nik' => $penambahan_jiwa[0]->nik,
					'no_kk' => $penambahan_jiwa[0]->no_kk,
					'nama_lgkp' => $penambahan_jiwa[0]->nama_lgkp,
					'status' => $penambahan_jiwa[0]->status,
					'deskripsi_doc_sc_f101' => $penambahan_jiwa[0]->deskripsi_doc_sc_f101,
					'deskripsi_doc_sc_nikah' => $penambahan_jiwa[0]->deskripsi_doc_sc_nikah,
					'deskripsi_doc_sc_kk_rusak' => $penambahan_jiwa[0]->deskripsi_doc_sc_kk_rusak,
					'no_kec' => $penambahan_jiwa[0]->no_kec,
					'no_kel' => $penambahan_jiwa[0]->no_kel,
					'tgl_permohonan' => $penambahan_jiwa[0]->tgl_permohonan,
					'sc_f101' => $penambahan_jiwa[0]->sc_f101,
					'sc_nikah' => $penambahan_jiwa[0]->sc_nikah,
					'sc_bukti_kk_rusak' => $penambahan_jiwa[0]->sc_bukti_kk_rusak,
					'type' => $penambahan_jiwa[0]->type,
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


	function simpan_permohonan_kk_hilang()
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
		$nik = $token_data->nik;
	
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
			$data_post["DAFTARID"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_F101"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_NIKAH"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_KK_HILANG"] == "" ||
			$_FILES["SC_F101"] == "" ||
			$_FILES["SC_NIKAH"] == "" ||
			$_FILES["SC_KK_HILANG"] == ""
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$photo_file_sc_f101 = $_FILES['SC_F101'];
			$photo_file_sc_nikah = $_FILES['SC_NIKAH'];
			$photo_file_kk_hilang = $_FILES['SC_KK_HILANG'];
	
			$upload_dir = './assets/pengajuan/kk/kk_rusak/';
			$photo_path_sc_f101 = $upload_dir . $token_data->nik . '_SC_F101.jpg';
			$photo_path_pas_sc_nikah = $upload_dir . $token_data->nik . '_NIKAH.jpg';
			$photo_path_pas_sc_kk_hilang = $upload_dir . $token_data->nik . '_SKL.jpg';
	
			if (
				move_uploaded_file($photo_file_sc_f101['tmp_name'], $photo_path_sc_f101) &&
				move_uploaded_file($photo_file_sc_nikah['tmp_name'], $photo_path_pas_sc_nikah) &&
				move_uploaded_file($photo_file_kk_hilang['tmp_name'], $photo_path_pas_sc_kk_hilang)
			) {
				$data_kk['DAFTARID'] = $data_post["DAFTARID"];
				$data_kk['NO_KK'] = $data_post["NO_KK"];
				$data_kk['NIK'] = $nik;
				$data_kk['NO_KEC'] = $data_post["KEC"];
				$data_kk['NO_KEL'] = $data_post["KEL"];
				$data_kk['DESKRIPSI_DOC_SC_F101'] = $data_post["DESKRIPSI_DOC_SC_F101"];
				$data_kk['DESKRIPSI_DOC_SC_NIKAH'] = $data_post["DESKRIPSI_DOC_SC_NIKAH"];
				$data_kk['DESKRIPSI_DOC_SC_KK_HILANG'] = $data_post["DESKRIPSI_DOC_SC_KK_HILANG"];
				$data_kk['SC_F101'] = $photo_path_sc_f101;
				$data_kk['SC_NIKAH'] = $photo_path_pas_sc_nikah;
				$data_kk['SC_KK_HILANG'] = $photo_path_pas_sc_kk_hilang;
				$data_kk['AKUN'] = $data_post["AKUN"];
				$data_kk['STATUS'] = 1;
				$data_kk['TYPE'] = 4;
	
				$record = new Daftar_kk_model($data_kk);
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
						'data' => $data_kk
					];
				}
			} else {
				$hasil = [
					'status' => false,
					'message' => 'Failed to upload one of the photo proofs',
					'data' => null
				];
			}
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function detail_permohonan_kk_hilang() {
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
	
			// Fetch pengajuanKtp data for the logged-in user with type == 1
			$penambahan_jiwa = Daftar_kk_model::get_criteria(['where' => ['nik' => $nik, 'type' => 4]]);
	
			if (empty($penambahan_jiwa)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan KK data found for the logged-in user with type 1',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $penambahan_jiwa[0]->daftarid,
					'nik' => $penambahan_jiwa[0]->nik,
					'no_kk' => $penambahan_jiwa[0]->no_kk,
					'nama_lgkp' => $penambahan_jiwa[0]->nama_lgkp,
					'status' => $penambahan_jiwa[0]->status,
					'deskripsi_doc_sc_f101' => $penambahan_jiwa[0]->deskripsi_doc_sc_f101,
					'deskripsi_doc_sc_nikah' => $penambahan_jiwa[0]->deskripsi_doc_sc_nikah,
					'deskripsi_doc_sc_kk_hilang' => $penambahan_jiwa[0]->deskripsi_doc_sc_kk_hilang,
					'no_kec' => $penambahan_jiwa[0]->no_kec,
					'no_kel' => $penambahan_jiwa[0]->no_kel,
					'tgl_permohonan' => $penambahan_jiwa[0]->tgl_permohonan,
					'sc_f101' => $penambahan_jiwa[0]->sc_f101,
					'sc_nikah' => $penambahan_jiwa[0]->sc_nikah,
					'sc_kk_hilang' => $penambahan_jiwa[0]->sc_kk_hilang,
					'type' => $penambahan_jiwa[0]->type,
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
	

	function simpan_permohonan_ubah_data()
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
		$nik = $token_data->nik;
	
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
			$data_post["DAFTARID"] == "" ||
			$data_post["NIK_DIAJUKAN"] == "" ||
			$data_post["NAMA_DIAJUKAN"] == "" ||
			$data_post["NO_KK"] == "" ||
			$data_post["KEC"] == "" ||
			$data_post["KEL"] == "" ||
			$data_post["DATA_YANG_DIUBAH"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_F106"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_NIKAH"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_PENDIDIKAN"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_PEKERJAAN"] == "" ||
			$data_post["DESKRIPSI_DOC_SC_AGAMA"] == "" ||
			$_FILES["SC_F106"] == "" ||
			$_FILES["SC_NIKAH"] == "" ||
			$_FILES["SC_PENDIDIKAN"] == "" ||
			$_FILES["SC_PEKERJAAN"] == "" ||
			$_FILES["SC_AGAMA"] == "" 
		) {
			$hasil = [
				'status' => false,
				'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
				'data' => null
			];
		} else {
			$photo_file_sc_f106 = $_FILES['SC_F106'];
			$photo_file_sc_nikah = $_FILES['SC_NIKAH'];
			$photo_file_kk_pendidikan = $_FILES['SC_PENDIDIKAN'];
			$photo_file_kk_pekerjaan = $_FILES['SC_PEKERJAAN'];
			$photo_file_kk_agama = $_FILES['SC_AGAMA'];
	
			$upload_dir = './assets/pengajuan/kk/ubah_data/';
			$photo_path_sc_f101 = $upload_dir . $data_post['NIK_DIAJUKAN'] . '_SC_F101.jpg';
			$photo_path_pas_sc_nikah = $upload_dir . $data_post['NIK_DIAJUKAN'] . '_NIKAH.jpg';
			$photo_path_pas_sc_pendidikan = $upload_dir . $data_post['NIK_DIAJUKAN'] . '_PENDIDIKAN.jpg';
			$photo_path_pas_sc_pekerjaan = $upload_dir . $data_post['NIK_DIAJUKAN'] . '_PEKERJAAN.jpg';
			$photo_path_pas_sc_agama = $upload_dir . $data_post['NIK_DIAJUKAN'] . '_AGAMA.jpg';
	
			if (
				move_uploaded_file($photo_file_sc_f106['tmp_name'], $photo_path_sc_f101) &&
				move_uploaded_file($photo_file_sc_nikah['tmp_name'], $photo_path_pas_sc_nikah) &&
				move_uploaded_file($photo_file_kk_pendidikan['tmp_name'], $photo_path_pas_sc_pendidikan) &&
				move_uploaded_file($photo_file_kk_pekerjaan['tmp_name'], $photo_path_pas_sc_pekerjaan) &&
				move_uploaded_file($photo_file_kk_agama['tmp_name'], $photo_path_pas_sc_agama) 
			) {
				$data_kk['DAFTARID'] = $data_post["DAFTARID"];
				$data_kk['NIK'] = $nik;
				$data_kk['NIK_DIAJUKAN'] = $data_post["NIK_DIAJUKAN"];
				$data_kk['NAMA_LGKP'] = $data_post["NAMA_DIAJUKAN"];
				$data_kk['NO_KK'] = $data_post["NO_KK"];
				$data_kk['NO_KEC'] = $data_post["KEC"];
				$data_kk['NO_KEL'] = $data_post["KEL"];
				$data_kk['DESKRIPSI_DOC_SC_F106'] = $data_post["DESKRIPSI_DOC_SC_F106"];
				$data_kk['DESKRIPSI_DOC_SC_NIKAH'] = $data_post["DESKRIPSI_DOC_SC_NIKAH"];
				$data_kk['DESKRIPSI_DOC_SC_PENDIDIKAN'] = $data_post["DESKRIPSI_DOC_SC_PENDIDIKAN"];
				$data_kk['DESKRIPSI_DOC_SC_PEKERJAAN'] = $data_post["DESKRIPSI_DOC_SC_PEKERJAAN"];
				$data_kk['DESKRIPSI_DOC_SC_AGAMA'] = $data_post["DESKRIPSI_DOC_SC_AGAMA"];
				$data_kk['SC_F101'] = $photo_path_sc_f101;
				$data_kk['SC_NIKAH'] = $photo_path_pas_sc_nikah;
				$data_kk['SC_PENDIDIKAN'] = $photo_path_pas_sc_pendidikan;
				$data_kk['SC_PEKERJAAN'] = $photo_path_pas_sc_pekerjaan;
				$data_kk['SC_AGAMA'] = $photo_path_pas_sc_agama;
				$data_kk['AKUN'] = $data_post["AKUN"];
				$data_kk['STATUS'] = 1;
				$data_kk['TYPE'] = 5;
	
				$record = new Daftar_kk_model($data_kk);
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
						'data' => $data_kk
					];
				}
			} else {
				$hasil = [
					'status' => false,
					'message' => 'Failed to upload one of the photo proofs',
					'data' => null
				];
			}
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function detail_permohonan_ubah_data() {
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
	
			// Fetch pengajuanKtp data for the logged-in user with type == 1
			$penambahan_jiwa = Daftar_kk_model::get_criteria(['where' => ['nik' => $nik, 'type' => 5]]);
	
			if (empty($penambahan_jiwa)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan KK data found for the logged-in user with type 1',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $penambahan_jiwa[0]->daftarid,
					'nik' => $penambahan_jiwa[0]->nik,
					'no_kk' => $penambahan_jiwa[0]->no_kk,
					'nama_lgkp' => $penambahan_jiwa[0]->nama_lgkp,
					'status' => $penambahan_jiwa[0]->status,
					'deskripsi_doc_sc_f106' => $penambahan_jiwa[0]->deskripsi_doc_sc_f106,
					'deskripsi_doc_sc_nikah' => $penambahan_jiwa[0]->deskripsi_doc_sc_nikah,
					'deskripsi_doc_sc_pendidikan' => $penambahan_jiwa[0]->deskripsi_doc_sc_pendidikan,
					'deskripsi_doc_sc_pekerjaan' => $penambahan_jiwa[0]->deskripsi_doc_sc_pekerjaan,
					'deskripsi_doc_sc_agama' => $penambahan_jiwa[0]->deskripsi_doc_sc_agama,
					'no_kec' => $penambahan_jiwa[0]->no_kec,
					'no_kel' => $penambahan_jiwa[0]->no_kel,
					'tgl_permohonan' => $penambahan_jiwa[0]->tgl_permohonan,
					'sc_f101' => $penambahan_jiwa[0]->sc_f101,
					'sc_nikah' => $penambahan_jiwa[0]->sc_nikah,
					'sc_pendidikan' => $penambahan_jiwa[0]->sc_pendidikan,
					'sc_pekerjaan' => $penambahan_jiwa[0]->sc_pekerjaan,
					'sc_agama' => $penambahan_jiwa[0]->sc_agama,
					'type' => $penambahan_jiwa[0]->type,
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




	// function simpan_permohonan_tambah_jiwa()
	// {
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];
	// 	//var_dump($data_post);
	// 	if (
	// 		$data_post['SIMPANKK']["NO_KK"] == "" ||
	// 		$data_post['SIMPANKK']["KEC"] == "" ||
	// 		$data_post['SIMPANKK']["KEL"] == "" ||
	// 		$data_post['SIMPANKK']["ALASAN"] == "" ||
	// 		$data_post['SIMPANKK']["DAFTARID"] == "" ||
	// 		$data_post['SIMPANKK']["SC_F101"] == "" ||
	// 		$data_post['SIMPANKK']["SC_NIKAH"] == "" ||
	// 		$data_post['SIMPANKK']["SC_SKL"] == ""
	// 	) {
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	} else {
	// 		$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID" => $data_post['SIMPANKK']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK" => $data_post['SIMPANKK']["NO_KK"], "STATUS" => array(1, 2)));
	// 		if (count($checkRecordAktif) > 0) {
	// 			if ($checkRecordAktif[0]->status == 1) {
	// 				$hasil = 3;
	// 			} elseif ($checkRecordAktif[0]->status == 2) {
	// 				$hasil = 4;
	// 			}
	// 		} else {
	// 			if ($numRecords == 0) {
	// 				$data_ktp['SIMPANKK']['DAFTARID'] = $data_post['SIMPANKK']["DAFTARID"];
	// 				$data_ktp['SIMPANKK']['NIK'] = $data_post['SIMPANKK']["NIK"];
	// 				$data_ktp['SIMPANKK']['NO_KK'] = $data_post['SIMPANKK']["NO_KK"];
	// 				$data_ktp['SIMPANKK']['NAMA_LGKP'] = $data_post['SIMPANKK']["NAMA_LGKP"];
	// 				$data_ktp['SIMPANKK']['NO_KEC'] = $data_post['SIMPANKK']["KEC"];
	// 				$data_ktp['SIMPANKK']['NO_KEL'] = $data_post['SIMPANKK']["KEL"];
	// 				$data_ktp['SIMPANKK']['ALASAN'] = $data_post['SIMPANKK']["ALASAN"];
	// 				$data_ktp['SIMPANKK']['SC_F101'] = 'upload/permohonan/kk/tambah_jiwa/' . $data_post['SIMPANKK']["SC_F101"];
	// 				$data_ktp['SIMPANKK']['SC_NIKAH'] = 'upload/permohonan/kk/tambah_jiwa/' . $data_post['SIMPANKK']["SC_NIKAH"];
	// 				$data_ktp['SIMPANKK']['SC_SKL'] = 'upload/permohonan/kk/tambah_jiwa/' . $data_post['SIMPANKK']["SC_SKL"];
	// 				$data_ktp['SIMPANKK']['AKUN'] = $data_post['SIMPANKK']["AKUN"];
	// 				$data_ktp['SIMPANKK']['STATUS'] = 1;
	// 				$record = new Daftar_kk_model($data_ktp['SIMPANKK']);
	// 				$affected_rows = $record->save();
	// 				if (!$affected_rows) {
	// 					$hasil = 0;
	// 				} else {
	// 					$hasil = 1;
	// 				}
	// 			} else {
	// 				$hasil = 2;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output($hasil);
	// }


	// function simpan_permohonan_kurang_jiwa()
	// {
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];
	// 	//var_dump($data_post);
	// 	if ($data_post['SIMPANKK']["NO_KK"] == "" || $data_post['SIMPANKK']["KEC"] == "" || $data_post['SIMPANKK']["KEL"] == "" || $data_post['SIMPANKK']["ALASAN"] == "" || $data_post['SIMPANKK']["DAFTARID"] == "" || $data_post['SIMPANKK']["SC_F101"] == "" || $data_post['SIMPANKK']["SC_NIKAH"] == "" || $data_post['SIMPANKK']["SC_KEMATIAN"] == "") {
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	} else {
	// 		$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID" => $data_post['SIMPANKK']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK" => $data_post['SIMPANKK']["NO_KK"], "STATUS" => array(1, 2)));
	// 		if (count($checkRecordAktif) > 0) {
	// 			if ($checkRecordAktif[0]->status == 1) {
	// 				$hasil = 3;
	// 			} elseif ($checkRecordAktif[0]->status == 2) {
	// 				$hasil = 4;
	// 			}
	// 		} else {
	// 			if ($numRecords == 0) {
	// 				$data_ktp['SIMPANKK']['DAFTARID'] = $data_post['SIMPANKK']["DAFTARID"];
	// 				$data_ktp['SIMPANKK']['NO_KK'] = $data_post['SIMPANKK']["NO_KK"];
	// 				$data_ktp['SIMPANKK']['NO_KEC'] = $data_post['SIMPANKK']["KEC"];
	// 				$data_ktp['SIMPANKK']['NO_KEL'] = $data_post['SIMPANKK']["KEL"];
	// 				$data_ktp['SIMPANKK']['ALASAN'] = $data_post['SIMPANKK']["ALASAN"];
	// 				$data_ktp['SIMPANKK']['SC_F101'] = 'upload/permohonan/kk/kurang_jiwa/' . $data_post['SIMPANKK']["SC_F101"];
	// 				$data_ktp['SIMPANKK']['SC_NIKAH'] = 'upload/permohonan/kk/kurang_jiwa/' . $data_post['SIMPANKK']["SC_NIKAH"];
	// 				$data_ktp['SIMPANKK']['SC_KEMATIAN'] = 'upload/permohonan/kk/kurang_jiwa/' . $data_post['SIMPANKK']["SC_KEMATIAN"];
	// 				$data_ktp['SIMPANKK']['AKUN'] = $data_post['SIMPANKK']["AKUN"];
	// 				$data_ktp['SIMPANKK']['STATUS'] = 1;
	// 				$record = new Daftar_kk_model($data_ktp['SIMPANKK']);
	// 				$affected_rows = $record->save();
	// 				if (!$affected_rows) {
	// 					$hasil = 0;
	// 				} else {
	// 					$hasil = 1;
	// 				}
	// 			} else {
	// 				$hasil = 2;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output($hasil);
	// }

	// function simpan_permohonan_kk_rusak()
	// {
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];
	// 	//var_dump($data_post);
	// 	if ($data_post['SIMPANKK']["NO_KK"] == "" || $data_post['SIMPANKK']["KEC"] == "" || $data_post['SIMPANKK']["KEL"] == "" || $data_post['SIMPANKK']["ALASAN"] == "" || $data_post['SIMPANKK']["DAFTARID"] == "" || $data_post['SIMPANKK']["SC_F101"] == "" || $data_post['SIMPANKK']["SC_NIKAH"] == "" || $data_post['SIMPANKK']["SC_KK"] == "") {
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	} else {
	// 		$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID" => $data_post['SIMPANKK']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK" => $data_post['SIMPANKK']["NO_KK"], "STATUS" => array(1, 2)));
	// 		if (count($checkRecordAktif) > 0) {
	// 			if ($checkRecordAktif[0]->status == 1) {
	// 				$hasil = 3;
	// 			} elseif ($checkRecordAktif[0]->status == 2) {
	// 				$hasil = 4;
	// 			}
	// 		} else {
	// 			if ($numRecords == 0) {
	// 				$data_ktp['SIMPANKK']['DAFTARID']	= $data_post['SIMPANKK']["DAFTARID"];
	// 				$data_ktp['SIMPANKK']['NO_KK']		= $data_post['SIMPANKK']["NO_KK"];
	// 				$data_ktp['SIMPANKK']['NO_KEC']		= $data_post['SIMPANKK']["KEC"];
	// 				$data_ktp['SIMPANKK']['NO_KEL']		= $data_post['SIMPANKK']["KEL"];
	// 				$data_ktp['SIMPANKK']['ALASAN']		= $data_post['SIMPANKK']["ALASAN"];
	// 				$data_ktp['SIMPANKK']['SC_F101']	= 'upload/permohonan/kk/kk_rusak/' . $data_post['SIMPANKK']["SC_F101"];
	// 				$data_ktp['SIMPANKK']['SC_NIKAH']	= 'upload/permohonan/kk/kk_rusak/' . $data_post['SIMPANKK']["SC_NIKAH"];
	// 				$data_ktp['SIMPANKK']['SC_KK']		= 'upload/permohonan/kk/kk_rusak/' . $data_post['SIMPANKK']["SC_KK"];
	// 				$data_ktp['SIMPANKK']['AKUN']		= $data_post['SIMPANKK']["AKUN"];
	// 				$data_ktp['SIMPANKK']['STATUS']		= 1;
	// 				$record = new Daftar_kk_model($data_ktp['SIMPANKK']);
	// 				$affected_rows = $record->save();
	// 				if (!$affected_rows) {
	// 					$hasil = 0;
	// 				} else {
	// 					$hasil = 1;
	// 				}
	// 			} else {
	// 				$hasil = 2;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output($hasil);
	// }

	// function simpan_permohonan_kk_hilang()
	// {
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];
	// 	//var_dump($data_post);
	// 	if ($data_post['SIMPANKK']["NO_KK"] == "" || $data_post['SIMPANKK']["KEC"] == "" || $data_post['SIMPANKK']["KEL"] == "" || $data_post['SIMPANKK']["ALASAN"] == "" || $data_post['SIMPANKK']["DAFTARID"] == "" || $data_post['SIMPANKK']["SC_F101"] == "" || $data_post['SIMPANKK']["SC_NIKAH"] == "" || $data_post['SIMPANKK']["SC_KK_HILANG"] == "") {
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	} else {
	// 		$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID" => $data_post['SIMPANKK']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK" => $data_post['SIMPANKK']["NO_KK"], "STATUS" => array(1, 2)));
	// 		if (count($checkRecordAktif) > 0) {
	// 			if ($checkRecordAktif[0]->status == 1) {
	// 				$hasil = 3;
	// 			} elseif ($checkRecordAktif[0]->status == 2) {
	// 				$hasil = 4;
	// 			}
	// 		} else {
	// 			if ($numRecords == 0) {
	// 				$data_ktp['SIMPANKK']['DAFTARID']		= $data_post['SIMPANKK']["DAFTARID"];
	// 				$data_ktp['SIMPANKK']['NO_KK']			= $data_post['SIMPANKK']["NO_KK"];
	// 				$data_ktp['SIMPANKK']['NO_KEC']			= $data_post['SIMPANKK']["KEC"];
	// 				$data_ktp['SIMPANKK']['NO_KEL']			= $data_post['SIMPANKK']["KEL"];
	// 				$data_ktp['SIMPANKK']['ALASAN']			= $data_post['SIMPANKK']["ALASAN"];
	// 				$data_ktp['SIMPANKK']['SC_F101']		= 'upload/permohonan/kk/kk_hilang/' . $data_post['SIMPANKK']["SC_F101"];
	// 				$data_ktp['SIMPANKK']['SC_NIKAH']		= 'upload/permohonan/kk/kk_hilang/' . $data_post['SIMPANKK']["SC_NIKAH"];
	// 				$data_ktp['SIMPANKK']['SC_KK_HILANG']	= 'upload/permohonan/kk/kk_hilang/' . $data_post['SIMPANKK']["SC_KK_HILANG"];
	// 				$data_ktp['SIMPANKK']['AKUN']			= $data_post['SIMPANKK']["AKUN"];
	// 				$data_ktp['SIMPANKK']['STATUS']			= 1;
	// 				$record = new Daftar_kk_model($data_ktp['SIMPANKK']);
	// 				$affected_rows = $record->save();
	// 				if (!$affected_rows) {
	// 					$hasil = 0;
	// 				} else {
	// 					$hasil = 1;
	// 				}
	// 			} else {
	// 				$hasil = 2;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output($hasil);
	// }

	// function simpan_permohonan_ubah_data()
	// {
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];
	// 	//var_dump($data_post);
	// 	if ($data_post['SIMPANKK']["NIK"] == "" || $data_post['SIMPANKK']["NAMA_LGKP"] == "" || $data_post['SIMPANKK']["NO_KK"] == "" || $data_post['SIMPANKK']["NO_KEC"] == "" || $data_post['SIMPANKK']["NO_KEL"] == "" || $data_post['SIMPANKK']["ALASAN"] == "" || $data_post['SIMPANKK']["DAFTARID"] == "" || $data_post['SIMPANKK']["SC_F106"] == "" || $data_post['SIMPANKK']["DATA_UBAH"] == "") {
	// 		$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
	// 	} else {
	// 		$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID" => $data_post['SIMPANKK']["DAFTARID"])));
	// 		$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK" => $data_post['SIMPANKK']["NO_KK"], "NIK" => $data_post['SIMPANKK']["NIK"], "STATUS" => array(1, 2)));
	// 		if (count($checkRecordAktif) > 0) {
	// 			if ($checkRecordAktif[0]->status == 1) {
	// 				$hasil = 3;
	// 			} elseif ($checkRecordAktif[0]->status == 2) {
	// 				$hasil = 4;
	// 			}
	// 		} else {
	// 			if ($numRecords == 0) {
	// 				//$data_ktp['SIMPANKK']['DAFTARID'] = $data_post['SIMPANKK']["DAFTARID"];
	// 				//$data_ktp['SIMPANKK']['NO_KK'] = $data_post['SIMPANKK']["NO_KK"];
	// 				//$data_ktp['SIMPANKK']['NIK'] = $data_post['SIMPANKK']["NIK"];
	// 				//$data_ktp['SIMPANKK']['NAMA_LGKP'] = $data_post['SIMPANKK']["NAMA_LGKP"];
	// 				//$data_ktp['SIMPANKK']['NO_KEC'] = $data_post['SIMPANKK']["KEC"];
	// 				//$data_ktp['SIMPANKK']['NO_KEL'] = $data_post['SIMPANKK']["KEL"];
	// 				//$data_ktp['SIMPANKK']['ALASAN'] = $data_post['SIMPANKK']["ALASAN"];
	// 				//$data_ktp['SIMPANKK']['SC_F106'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_F106"];
	// 				//$data_ktp['SIMPANKK']['SC_PEKERJAAN'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_PEKERJAAN"];
	// 				//$data_ktp['SIMPANKK']['SC_PENDIDIKAN'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_PENDIDIKAN"];
	// 				//$data_ktp['SIMPANKK']['SC_AGAMA'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_AGAMA"];
	// 				//$data_ktp['SIMPANKK']['AKUN'] = $data_post['SIMPANKK']["AKUN"];
	// 				//$data_ktp['SIMPANKK']['DATA_UBAH'] = $data_post['SIMPANKK']["DATA_UBAH"];
	// 				//$data_ktp['SIMPANKK']['STATUS'] = 1;
	// 				$record = new Daftar_kk_model($data_post['SIMPANKK']);
	// 				$affected_rows = $record->save();
	// 				if (!$affected_rows) {
	// 					$hasil = 0;
	// 				} else {
	// 					$hasil = 1;
	// 				}
	// 			} else {
	// 				$hasil = 2;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output($hasil);
	// }




}

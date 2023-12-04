<?php
defined('BASEPATH') or exit('No direct script access allowed');

class daftar extends CI_Controller
{
	function registrasi()
	{
		$input_data = file_get_contents('php://input');
		$data_post = json_decode($input_data, true);
		$hasil = [];

		if ($data_post["nik"] == "" || $data_post["no_kk"] == "" || $data_post["nama"] == "" || $data_post["alamat"] == "" || $data_post["kec"] == "" || $data_post["kel"] == "" || $data_post["no_hp"] == "" || $data_post["email"] == "" || $data_post["password"] == "") {
			$hasil = [
				'status' => false,
				'message' => 'Tidak Boleh Ada Yang Kosong',
				'data' => null
			];
		} else {
			$numRecords = count(User_sitepak_model::get_criteria(array("nik" => $data_post["nik"])));
			if ($numRecords > 0) {
				$hasil = [
					'status' => false,
					'message' => 'NIK sudah terdaftar',
					'data' => null
				];
			} else {
				$numRecordsEmail = count(User_sitepak_model::get_criteria(array("email" => $data_post["email"])));
				if ($numRecordsEmail > 0) {
					$hasil = [
						'status' => false,
						'message' => 'Email sudah terdaftar',
						'data' => null
					];
				} else {
					$numRecordsHp = count(User_sitepak_model::get_criteria(array("no_hp" => $data_post["no_hp"])));
					if ($numRecordsHp > 0) {
						$hasil = [
							'status' => false,
							'message' => 'Nomor HP sudah terdaftar',
							'data' => null
						];
					} else {
						$timestamp = time() - 86400;
						$date = strtotime("+7 day", $timestamp);
						$exp = date('d-m-Y', $date);

						$data_post['exp_aktivasi'] = $exp;
						$data_post['password'] = md5($data_post["password"]);
						$data_post['status'] = 0;
						$record = new User_sitepak_model($data_post);
						$affected_rows = $record->save();

						if (!$affected_rows) {
							$hasil = [
								'status' => false,
								'message' => 'Gagal menyimpan data',
								'data' => null
							];
						} else {
							$hasil = [
								'status' => true,
								'message' => 'Success input data',
								'data' => $data_post
							];
						}
					}
				}
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function aktivasiUser()
	{
		$input_data = file_get_contents('php://input');
		$data_post = json_decode($input_data, true);
		$hasil = [];

		if ($data_post['status'] == "") {
			$hasil = [
				'status' => false,
				'message' => 'Tidak Boleh Ada Yang Kosong',
				'data' => null
			];
		} else {
			$userModel = User_sitepak_model::get_criteria(array(
				"select" => "nik,status",
				"where" => array("nik" => $data_post["nik"])
			));

			if (!empty($userModel) && $data_post['nik'] == $userModel[0]->nik) {
				$userModel[0]->status = $data_post['status'];
				$userModel[0]->save();

				$hasil = [
					'status' => true,
					'message' => 'Akun Telah Terverifikasi',
					'data' => $userModel
				];
			} else {
				$hasil = [
					'status' => false,
					'message' => 'User dengan NIK ' . $data_post["nik"] . ' tidak ditemukan',
					'data' => null
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}



	function generateRandomString()
	{
		$length = 128;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	function generateRandomStringPassword()
	{
		$length = 16;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	function lupa_password()
	{
		// tambahkan table untuk history NIK token dan tgl token, kemudian buat jegatan perhari maksimal request token
		$input_data = file_get_contents('php://input');
		$data_post = json_decode($input_data, true);
		$hasil = [];
		//print_r($data_post['REGISTRASI']['nik']);
		if ($data_post['LUPA_PASS']["NIK"] == "" || $data_post['LUPA_PASS']["EMAIL"] == "") {
			$hasil = "ada yg kosong";
		} else {
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" => $data_post['LUPA_PASS']["NIK"], "EMAIL" => $data_post['LUPA_PASS']["EMAIL"])));
			if ($numRecords == 0) {
				//$hasil = "Tidak ditemukan";
				$hasil = 2;
			} else {
				$_EXISTED = TRUE;
				$_USERNAME = "";

				while ($_EXISTED) {
					$_NUM = $this->generateRandomString();
					$cekNUM = count(User_sitepak_model::get_criteria(array('TOKEN' => $_NUM)));
					if ($cekNUM == 0) {
						$TOKEN = $_NUM;
						$_EXISTED = FALSE;
					}
				}
				$newPass = $this->generateRandomStringPassword();
				$passDecrypt = md5($newPass);
				$date = date('d-m-Y H:i:s');
				$data_post['LUPA_PASS']['PASSWORD'] = $passDecrypt;
				$data_post['LUPA_PASS']['TGL_TOKEN'] = $date;
				$data_post['LUPA_PASS']['TOKEN'] = $TOKEN;
				$recUser = User_sitepak_model::get_criteria(array("NIK" => $data_post['LUPA_PASS']["NIK"], "EMAIL" => $data_post['LUPA_PASS']["EMAIL"]));
				$affected_rows = $recUser[0]->update_attributes($data_post['LUPA_PASS']);

				if (!$affected_rows) {
					$hasil = 0;
				} else {
					$pesan = "Password Baru Anda adalah : " . $newPass;
					$configEmail = $this->config->item('email');
					$this->email->initialize($configEmail);
					$this->email->from($configEmail['smtp_user']);
					$this->email->to($recUser[0]->email);
					$this->email->subject('RESET PASSWORD');
					$this->email->message($pesan);

					if (!$this->email->send()) {
						echo $this->email->print_debugger();
					}
					$hasil = 1;
				}
			}
		}
		$this->output->set_content_type('application/json')
			->set_output($hasil);
	}

	function aktivasi()
	{
		$input_data = file_get_contents('php://input');
		$data_post = json_decode($input_data, true);
		$hasil = [];

		if ($data_post['AKTIVASI']["NIK"] == "" || $data_post['AKTIVASI']["NO_KK"] == "" || $data_post['AKTIVASI']["EMAIL"] == "" || $data_post['AKTIVASI']["KODE_VERIFIKASI"] == "") {
			$hasil = "Tidak Boleh Ada Yang Kosong";
		} else {

			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" => $data_post['AKTIVASI']["NIK"], "KODE_AKTIVASI" => $data_post['AKTIVASI']["KODE_VERIFIKASI"], "NO_KK" => $data_post['AKTIVASI']["NO_KK"], "EMAIL" => $data_post['AKTIVASI']["EMAIL"])));
			if ($numRecords == 0) {
				$hasil = 2;
			} else {
				$date = date('d-m-Y H:i:s');
				$data_post['UPDATE']['TGL_AKTIVASI'] = $date;
				$data_post['UPDATE']['STATUS'] = 1;
				$recUser = User_sitepak_model::get_criteria(array("NIK" => $data_post['AKTIVASI']["NIK"], "KODE_AKTIVASI" => $data_post['AKTIVASI']["KODE_VERIFIKASI"], "NO_KK" => $data_post['AKTIVASI']["NO_KK"], "EMAIL" => $data_post['AKTIVASI']["EMAIL"]));
				$affected_rows = $recUser[0]->update_attributes($data_post['UPDATE']);
				if (!$affected_rows) {
					$hasil = 2;
				} else {
					$hasil = 1;
				}
			}
		}
		$this->output->set_content_type('application/json')
			->set_output($hasil);
	}

	function update_password()
	{
		// tambahkan table untuk history NIK token dan tgl token, kemudian buat jegatan perhari maksimal request token
		$input_data = file_get_contents('php://input');
		$data_post = json_decode($input_data, true);
		$hasil = [];
		//print_r($data_post['REGISTRASI']['nik']);
		if ($data_post['LUPA_PASS']["NIK"] == "" || $data_post['LUPA_PASS']["OLD_PASSWORD"] == "") {
			$hasil = "ada yg kosong";
		} else {
			$oldPassword = md5($data_post['LUPA_PASS']["OLD_PASSWORD"]);
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" => $data_post['LUPA_PASS']["NIK"], "PASSWORD" => $oldPassword)));
			if ($numRecords == 0) {
				//$hasil = "Tidak ditemukan";
				$hasil = 2;
			} else {
				$data_post['RESET']['PASSWORD'] = md5($data_post['LUPA_PASS']["RENEW_PASSWORD"]);
				$recUser = User_sitepak_model::get_criteria(array("NIK" => $data_post['LUPA_PASS']["NIK"], "PASSWORD" => $oldPassword));
				$affected_rows = $recUser[0]->update_attributes($data_post['RESET']);

				if (!$affected_rows) {
					$hasil = 0;
				} else {

					$hasil = 1;
				}
			}
		}
		$this->output->set_content_type('application/json')
			->set_output($hasil);
	}
}

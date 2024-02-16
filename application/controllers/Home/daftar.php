<?php
defined('BASEPATH') or exit('No direct script access allowed');

class daftar extends CI_Controller
{

	public function captcha()
	{
		$this->load->helper('captcha');

		$config = [
			'img_path' => './assets/captcha/',
			'img_url' => base_url('/assets/captcha/'),
			'img_width' => 250,
			'img_height' => 40,
			'border' => 1,
			'expiration' => 3600,
			'font_path' => './path/to/your/font.ttf',
		];

		// Create captcha
		$captcha = create_captcha($config);

		if ($captcha !== false) {
			// Set captcha word in session
			$this->session->set_userdata('captcha_word', $captcha['word']);

			$json_response = [
				'word' => $captcha['word'],
				'image' => $captcha['image'],
				'url' =>$captcha['url'],
			];

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json_response));
		} else {
			// Handle the case when create_captcha fails
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['error' => 'Captcha generation failed. ']));
		}
	}
	function registrasi()
	{
		$data_post = $_POST;
		$hasil = [];

		$userCaptcha = $data_post["CAPTCHA"];
		$captchaWord = $this->session->userdata('captcha_word');

		if ($userCaptcha !== $captchaWord) {
			$hasil = [
				'status' => false,
				'message' => 'Captcha validation failed',
				'data' => null
			];
		} else {
			unset($data_post['CAPTCHA']);

			if ($data_post["NIK"] == "" || $data_post["NO_KK"] == "" || $data_post["NAMA"] == "" || $data_post["ALAMAT"] == "" || $data_post["KEC"] == "" || $data_post["KEL"] == "" || $data_post["NO_HP"] == "" || $data_post["EMAIL"] == "" || $data_post["PASSWORD"] == "") {
				$hasil = [
					'status' => false,
					'message' => 'Tidak Boleh Ada Yang Kosong',
					'data' => null
				];
			} else {
				$numRecords = count(User_sitepak_model::get_criteria(array("NIK" => $data_post["NIK"])));
				if ($numRecords > 0) {
					$hasil = [
						'status' => false,
						'message' => 'NIK sudah terdaftar',
						'data' => null
					];
				} else {
					$numRecordsEmail = count(User_sitepak_model::get_criteria(array("EMAIL" => $data_post["EMAIL"])));
					if ($numRecordsEmail > 0) {
						$hasil = [
							'status' => false,
							'message' => 'Email sudah terdaftar',
							'data' => null
						];
					} else {
						$numRecordsHp = count(User_sitepak_model::get_criteria(array("NO_HP" => $data_post["NO_HP"])));
						if ($numRecordsHp > 0) {
							$hasil = [
								'status' => false,
								'message' => 'Nomor HP sudah terdaftar',
								'data' => null
							];
						} else {
							if (isset($_FILES['FOTO'])) {
								$upload_dir = './assets/images/';
								$temp_name = $_FILES['FOTO']['tmp_name'];
								$new_name = $upload_dir . $data_post['NIK'] . '_foto-profile.jpg';

								if (move_uploaded_file($temp_name, $new_name)) {
									$data_post['FOTO'] = $new_name;
								} else {
									$hasil = [
										'status' => false,
										'message' => 'Failed to upload profile image',
										'data' => null
									];

									$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
									return;
								}
							}

							$timestamp = time() - 86400;
							$date = strtotime("+7 day", $timestamp);
							$exp = date('d-m-Y', $date);

							$data_post['EXP_AKTIVASI'] = $exp;
							$data_post['PASSWORD'] = md5($data_post["PASSWORD"]);
							$data_post['STATUS'] = 0;
							// print_r($data_post);die;


							$record = new User_sitepak_model($data_post);
							$affected_rows = $record->save();

							if (!$affected_rows) {
								$hasil = [
									'status' => false,
									'message' => 'Gagal menyimpan data',
									'data' => null
								];
							} else {
								// Remove existing captcha images
								$imagePath = './assets/captcha';
								if (file_exists($imagePath)) {
									$files = glob($imagePath . '/*');
									foreach ($files as $file) {
										unlink($file);
									}
								}

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
		}

		// Clear the captcha word from the session
		$this->session->unset_userdata('captcha_word');

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}

	function aktivasiUser()
	{
		$data_post = $_POST;
		$hasil = [];

		// Captcha verification
		$captcha_word_session = $this->session->userdata('captcha_word');
		if (empty($captcha_word_session) || $data_post['CAPTCHA'] !== $captcha_word_session) {
			$hasil = [
				'status' => false,
				'message' => 'Captcha tidak valid',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}
		if ($data_post["NIK"] == "" || $data_post["EMAIL"] == "" || $data_post["CAPTCHA"] == "") {
			$hasil = "Tidak Boleh Ada Yang Kosong";
		} else {
			$userModel = User_sitepak_model::get_criteria(array(
				"select" => "nik,status",
				"where" => array("nik" => $data_post["NIK"])
			));

			if (!empty($userModel) && $data_post['NIK'] == $userModel[0]->nik) {
				$userModel[0]->status = 1;
				$userModel[0]->save();

				$imagePath = './assets/captcha';

				if (file_exists($imagePath)) {
					$files = glob($imagePath . '/*');
					foreach ($files as $file) {
						unlink($file);
					}
				}

				$hasil = [
					'status' => true,
					'message' => 'Akun Telah Terverifikasi',
					'data' => $userModel
				];
			} else {
				$hasil = [
					'status' => false,
					'message' => 'User dengan NIK ' . $data_post["NIK"] . ' tidak ditemukan',
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

	// function lupa_password()
	// {
	// 	// tambahkan table untuk history NIK token dan tgl token, kemudian buat jegatan perhari maksimal request token
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];



	// 	$captcha_word_session = $this->session->userdata('captcha_word');
	// 	if (empty($captcha_word_session) || $data_post['captcha'] !== $captcha_word_session) {
	// 		$hasil = [
	// 			'status' => false,
	// 			'message' => 'Captcha tidak valid',
	// 			'data' => null
	// 		];
	// 		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	// 		return;
	// 	}

	// 	if ($data_post["nik"] == "" || $data_post["email"] == "") {
	// 		$hasil = "ada yg kosong";
	// 	} else {
	// 		$numRecords = count(User_sitepak_model::get_criteria(array("nik" => $data_post["nik"], "email" => $data_post["email"])));
	// 		if ($numRecords == 0) {
	// 			//$hasil = "Tidak ditemukan";
	// 			$hasil = 2;
	// 		} else {
	// 			$_EXISTED = TRUE;
	// 			$_USERNAME = "";

	// 			while ($_EXISTED) {
	// 				$_NUM = $this->generateRandomString();
	// 				$cekNUM = count(User_sitepak_model::get_criteria(array('TOKEN' => $_NUM)));
	// 				if ($cekNUM == 0) {
	// 					$TOKEN = $_NUM;
	// 					$_EXISTED = FALSE;
	// 				}
	// 			}
	// 			$newPass = $this->generateRandomStringPassword();
	// 			$passDecrypt = md5($newPass);
	// 			$date = date('d-m-Y H:i:s');
	// 			$data_post['password'] = $passDecrypt;
	// 			$data_post['tgl_token'] = $date;
	// 			$data_post['token'] = $TOKEN;
	// 			$recUser = User_sitepak_model::get_criteria(array("nik" => $data_post["nik"], "email" => $data_post["email"]));
	// 			$affected_rows = $recUser[0]->update_attributes($data_post);

	// 			if (!$affected_rows) {
	// 				$hasil = 0;
	// 			} else {
	// 				$pesan = "Password Baru Anda adalah : " . $newPass;
	// 				$configEmail = $this->config->item('email');
	// 				$this->email->initialize($configEmail);
	// 				$this->email->from($configEmail['smtp_user']);
	// 				$this->email->to($recUser[0]->email);
	// 				$this->email->subject('RESET PASSWORD');
	// 				$this->email->message($pesan);

	// 				if (!$this->email->send()) {
	// 					echo $this->email->print_debugger();
	// 				}
	// 				$hasil = 1;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')
	// 		->set_output($hasil);
	// }

	function lupa_password()
	{
		$data_post = $_POST;
		$hasil = [];

		$captcha_word_session = $this->session->userdata('captcha_word');
		if (empty($captcha_word_session) || $data_post['CAPTCHA'] !== $captcha_word_session) {
			$hasil = [
				'status' => false,
				'message' => 'Captcha tidak valid',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		if ($data_post["NIK"] == "" || $data_post["EMAIL"] == "") {
			$hasil = "ada yang kosong";
		} else {
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" => $data_post["NIK"], "EMAIL" => $data_post["EMAIL"])));
			if ($numRecords == 0) {
				$hasil = 2; // User not found
			} else {
				$recUser = User_sitepak_model::get_criteria(array("NIK" => $data_post["NIK"], "EMAIL" => $data_post["EMAIL"]));
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

				$recUser[0]->password = $passDecrypt;
				$recUser[0]->tgl_token = $date;
				$recUser[0]->token = $TOKEN;

				if ($recUser[0]->save()) {
					$pesan = "Password Baru Anda adalah : " . $newPass;

					// Send email with the new password
					$configEmail = $this->config->item('email');
					$this->email->initialize($configEmail);
					$this->email->from($configEmail['smtp_user']);
					$this->email->to($recUser[0]->email);
					$this->email->subject('RESET PASSWORD');
					$this->email->message($pesan);

					if (!$this->email->send()) {
						echo $this->email->print_debugger();
					}

					$hasil = 1; // Success
				} else {
					$hasil = 0; // Failed to update password
				}
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
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

	// function update_password()
	// {
	// 	// tambahkan table untuk history NIK token dan tgl token, kemudian buat jegatan perhari maksimal request token
	// 	$input_data = file_get_contents('php://input');
	// 	$data_post = json_decode($input_data, true);
	// 	$hasil = [];
	// 	//print_r($data_post['REGISTRASI']['nik']);
	// 	if ($data_post["nik"] == "" || $data_post["old_password"] == "") {
	// 		$hasil = "ada yg kosong";
	// 	} else {
	// 		$oldPassword = md5($data_post["old_password"]);
	// 		$numRecords = count(User_sitepak_model::get_criteria(array("nik" => $data_post["nik"], "password" => $oldPassword)));
	// 		if ($numRecords == 0) {
	// 			$hasil = [
	// 				'status' => false,
	// 				'message' => 'Data Not Found',
	// 				'data' => null
	// 			];
	// 		} else {
	// 			$data_post['password'] = md5($data_post["password_baru"]);
	// 			$recUser = User_sitepak_model::get_criteria(array("nik" => $data_post["nik"], "password" => $oldPassword));
	// 			$affected_rows = $recUser[0]->update_attributes($data_post);

	// 			if (!$affected_rows) {
	// 				$hasil = 0;
	// 			} else {

	// 				$hasil = 1;
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')
	// 		->set_output($hasil);
	// }

	function update_password()
	{
		// Periksa apakah ada data yang dikirimkan
		$data_post = $_POST;
		$hasil = [];
	
		if (empty($data_post)) {
			http_response_code(400); // Bad Request
			return;
		}

		// $data_post = json_decode($input_data, true);

		// Periksa apakah data yang diperlukan ada
		if (empty($data_post["NIK"]) || empty($data_post["PASSWORD_LAMA"]) || empty($data_post["PASSWORD_BARU"]) || empty($data_post["PASSWORD_CONFIRMATION"])) {
			$hasil = [
				'status' => false,
				'message' => 'Ada data yang kosong',
				'data' => null
			];
		} else {
			$password_lama = md5($data_post["PASSWORD_LAMA"]);
			$password_baru = md5($data_post["PASSWORD_BARU"]);
			$password_confirmasi = md5($data_post["PASSWORD_CONFIRMATION"]);

			// Periksa apakah data pengguna ditemukan berdasarkan NIK
			$userCriteria = array("nik" => $data_post["NIK"]);
			$recUser = User_sitepak_model::get_criteria($userCriteria);
			$numRecords = count($recUser);

			if ($numRecords == 0) {
				$hasil = [
					'status' => false,
					'message' => 'Data pengguna tidak ditemukan',
					'data' => null
				];
			} else {
				// Periksa apakah password lama sesuai
				if ($recUser[0]->password != $password_lama) {
					$hasil = [
						'status' => false,
						'message' => 'Password lama tidak sesuai',
						'data' => null
					];
				} else {
					// Periksa apakah password baru sesuai dengan konfirmasi
					if ($password_baru != $password_confirmasi) {
						$hasil = [
							'status' => false,
							'message' => 'Password baru tidak sesuai dengan konfirmasi',
							'data' => null
						];
					} else {
						// Update password
						$recUser[0]->password = $password_baru;

						// Simpan perubahan
						if ($recUser[0]->save()) {
							$hasil = [
								'status' => true,
								'message' => 'Kata sandi berhasil diubah',
								'data' => null
							];
						} else {
							$hasil = [
								'status' => false,
								'message' => 'Gagal mengubah kata sandi',
								'data' => null
							];
						}
					}
				}
			}
		}

		// Set response sebagai JSON
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class home extends CI_Controller
{
	function login()
	{
		$input_data = file_get_contents('php://input');
		$data_post = json_decode($input_data, true);
		$hasil = [];


		$captcha_word_session = $this->session->userdata('captcha_word');
		if (empty($captcha_word_session) || $data_post['captcha'] !== $captcha_word_session) {
			$hasil = [
				'status' => false,
				'message' => 'Captcha tidak valid',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}

		$user = User_sitepak_model::get_criteria(array(
			"select" => "nik, nama, no_kk, kec, kel, no_hp, email, status",
			"where" => array("nik" => $data_post["nik"], "PASSWORD" => md5($data_post["password"]))
		));
		$numRecords = count($user);

		if ($numRecords == 0) {
			$hasil = [
				'status' => false,
				'message' => 'User atau Password Tidak Valid',
				'data' => null
			];
		} else {
			if ($user[0]->status != 1) {
				$hasil = [
					'status' => false,
					'message' => 'User Anda Tidak Aktif',
					'data' => null
				];
			} else {
				// Generate JWT Token
				$jwt_secret = "sitepak2023";
				$token_data = [
					'nik' => $user[0]->nik,
					'nama' => $user[0]->nama,
					'email' => $user[0]->email,
					// tambahkan informasi lain yang diperlukan
				];
				$jwt_token = JWT::encode($token_data, $jwt_secret, 'HS256');

				// Display user data
				$user_data = [
					'nik' => $user[0]->nik,
					'nama' => $user[0]->nama,
					'no_kk' => $user[0]->no_kk,
					'kec' => $user[0]->kec,
					'kel' => $user[0]->kel,
					'no_hp' => $user[0]->no_hp,
					'email' => $user[0]->email,
					'status' => $user[0]->status,
				];

				$imagePath = './application/assets/captcha';

				if (file_exists($imagePath)) {
					$files = glob($imagePath . '/*');
					foreach ($files as $file) {
						unlink($file);
					}
				}

				$hasil = [
					'status' => true,
					'message' => 'Login berhasil',
					'data' => [
						'user' => $user_data,
						'token' => $jwt_token
					]
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
}

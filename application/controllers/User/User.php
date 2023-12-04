<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User extends CI_Controller
{

    public function listUserRegistration()
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

            $user_nik = $token_data->nik;

            $user_data = User_sitepak_model::get_criteria(['where' => ['nik' => $user_nik]]);

            if (!empty($user_data)) {
                $display_data = [
                    'nik' => $user_data[0]->nik,
                    'nama' => $user_data[0]->nama,
                    'alamat' => $user_data[0]->alamat,
                    'no_hp' => $user_data[0]->no_hp,
                    'kec' => $user_data[0]->kec,
                    'kel' => $user_data[0]->kel,
                    'email' => $user_data[0]->email,
                ];

                $hasil = [
                    'status' => true,
                    'message' => 'Success',
                    'data' => $display_data
                ];
            } else {
                $hasil = [
                    'status' => false,
                    'message' => 'User data not found',
                    'data' => null
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

    function userUpdate()
    {
        $input_data = file_get_contents('php://input');
        $data_post = json_decode($input_data, true);
        $hasil = [];

        if (
            $data_post['status'] == "" || $data_post['nik'] == "" || $data_post['no_kk'] == "" || $data_post['nama'] == "" ||
            $data_post['alamat'] == "" || $data_post['kec'] == "" || $data_post['kel'] == "" || $data_post['no_hp'] == "" ||
            $data_post['email'] == ""
        ) {
            $hasil = [
                'status' => false,
                'message' => 'Tidak Boleh Ada Yang Kosong',
                'data' => null
            ];
        } else {
            $userModel = User_sitepak_model::get_criteria(array(
                "select" => "nik,no_kk,nama,alamat,kec,kel,no_hp,email,status",
                "where" => array("nik" => $data_post["nik"])
            ));

            if (!empty($userModel) && $data_post['nik'] == $userModel[0]->nik) {
                $userModel[0]->nik = $data_post['nik'];
                $userModel[0]->no_kk = $data_post['no_kk'];
                $userModel[0]->nama = $data_post['nama'];
                $userModel[0]->alamat = $data_post['alamat'];
                $userModel[0]->kec = $data_post['kec'];
                $userModel[0]->kel = $data_post['kel'];
                $userModel[0]->no_hp = $data_post['no_hp'];
                $userModel[0]->email = $data_post['email'];
                $userModel[0]->status = $data_post['status'];
                $userModel[0]->save();

                $hasil = [
                    'status' => true,
                    'message' => 'Akun Telah Terverifikasi',
                    'data' => array(
                        'nik' => $userModel[0]->nik,
                        'no_kk' => $userModel[0]->no_kk,
                        'nama' => $userModel[0]->nama,
                        'alamat' => $userModel[0]->alamat,
                        'kec' => $userModel[0]->kec,
                        'kel' => $userModel[0]->kel,
                        'no_hp' => $userModel[0]->no_hp,
                        'email' => $userModel[0]->email,
                        'status' => $userModel[0]->status
                    )
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
}

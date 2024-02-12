<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User extends CI_Controller
{

    function listUser()
    {
        $users = $this->db->get('USER_SITEPAK')->result_array();

        if (!empty($users)) {
            $hasil = [
                'status' => true,
                'message' => 'Data Found',
                'data' => $users
            ];
        } else {
            $hasil = [
                'status' => false,
                'message' => 'Data not Found',
                'data' => null
            ];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($hasil));
    }

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

        $jwt_secret = $this->config->item('jwt_secret');


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
		$data_post = $_POST;
		$hasil = [];

        if (
            $data_post['STATUS'] == "" || $data_post['NIK'] == "" || $data_post['NO_KK'] == "" || $data_post['NAMA'] == "" ||
            $data_post['ALAMAT'] == "" || $data_post['KEC'] == "" || $data_post['KEL'] == "" || $data_post['NO_HP'] == "" ||
            $data_post['EMAIL'] == ""
        ) {
            $hasil = [
                'status' => false,
                'message' => 'Tidak Boleh Ada Yang Kosong',
                'data' => null
            ];
        } else {
            $userModel = User_sitepak_model::get_criteria(array(
                "select" => "nik,no_kk,nama,alamat,kec,kel,no_hp,email,status",
                "where" => array("nik" => $data_post["NIK"])
            ));

            if (!empty($userModel) && $data_post['NIK'] == $userModel[0]->nik) {
                $userModel[0]->nik = $data_post['NIK'];
                $userModel[0]->no_kk = $data_post['NO_KK'];
                $userModel[0]->nama = $data_post['NAMA'];
                $userModel[0]->alamat = $data_post['ALAMAT'];
                $userModel[0]->kec = $data_post['KEC'];
                $userModel[0]->kel = $data_post['KEL'];
                $userModel[0]->no_hp = $data_post['NO_HP'];
                $userModel[0]->email = $data_post['EMAIL'];
                $userModel[0]->status = $data_post['STATUS'];
                $userModel[0]->save();

                $hasil = [
                    'status' => true,
                    'message' => 'Data User Berhasil di Update',
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
                    'message' => 'User dengan NIK ' . $data_post["NIK"] . ' tidak ditemukan',
                    'data' => null
                ];
            }
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($hasil));
    }



    function uploadKK()
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

        if (empty($_FILES['foto_kk'])) {
            $hasil = [
                'status' => false,
                'message' => 'Gagal Upload KK, Silahkan Lengkapi Semua Data',
                'data' => null
            ];
        } else {
            $existingRecords = User_sitepak_model::get_criteria(['where' => ['NIK' => $token_data->nik]]);

            if (empty($existingRecords)) {
                $hasil = [
                    'status' => false,
                    'message' => 'Record not found for the given NIK',
                    'data' => null
                ];
            } else {
                foreach ($existingRecords as $existingRecord) {
                    // Process the 'foto_kk' file
                    $photo_file = $_FILES['foto_kk'];
                    $upload_dir = './assets/pengajuan/user/';
                    $photo_path = $upload_dir . $data_post['NIK'] . 'KK.jpg';

                    if (move_uploaded_file($photo_file['tmp_name'], $photo_path)) {
                        $existingRecord->foto_kk = $photo_path; // Update 'foto_kk' field
                        $affected_rows = $existingRecord->save();

                        if (!$affected_rows) {
                            $hasil = [
                                'status' => false,
                                'message' => 'Failed to upload KK',
                                'data' => null
                            ];
                        } else {
                            $display_data = [
                                'foto_kk' => $existingRecord->foto_kk,
                            ];

                            $hasil = [
                                'status' => true,
                                'message' => 'KK berhasil di upload',
                                'data' => $display_data
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
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($hasil));
    }


}

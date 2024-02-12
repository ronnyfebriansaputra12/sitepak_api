<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;


class upload_permohonan_ikan_gaul extends CI_Controller
{
	
	// function simpan_permohonan_ikan_gaul()
	// {
	// 	$data_post = $_POST;
	// 	$hasil = [];
	
	// 	$headers = apache_request_headers();
	
	// 	if (!isset($headers['Authorization'])) {
	// 		$hasil = [
	// 			'status' => false,
	// 			'message' => 'Authorization token not found in headers',
	// 			'data' => null
	// 		];
	// 		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	// 		return;
	// 	}
	
	// 	$jwt_token = str_replace('Bearer ', '', $headers['Authorization']);
	
	// 	if (!$jwt_token) {
	// 		$hasil = [
	// 			'status' => false,
	// 			'message' => 'Invalid token format',
	// 			'data' => null
	// 		];
	// 		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	// 		return;
	// 	}
	
	// 	if (
	// 		$data_post["DAFTARID"] == "" ||
	// 		$data_post["NIK"] == "" ||
	// 		$data_post["NAMA_LENGKAP"] == "" ||
	// 		$data_post["NOMOR_WHATSAPP"] == "" ||
	// 		$data_post["EMAIL"] == "" ||
	// 		$data_post["ID_JADWAL_IKAN_GAUL"] == ""
	// 	) {
	// 		$hasil = [
	// 			'status' => false,
	// 			'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
	// 			'data' => null
	// 		];
	// 	} else {
	// 		$numRecords = count(Daftar_ikan_gaul::get_criteria(array("DAFTARID" => $data_post["DAFTARID"])));
	
	// 		if ($numRecords > 0) {
	// 			$hasil = [
	// 				'status' => false,
	// 				'message' => 'Duplicate record found',
	// 				'data' => null
	// 			];
	// 		} else {
	// 			$data['DAFTARID'] = $data_post["DAFTARID"];
	// 			$data['NIK'] = $data_post["NIK"];
	// 			$data['NAMA_LENGKAP'] = $data_post["NAMA_LENGKAP"];
	// 			$data['EMAIL'] = $data_post["EMAIL"];
	// 			$data['NOMOR_WHATSAPP'] = $data_post["NOMOR_WHATSAPP"];
	// 			$data['ID_JADWAL_IKAN_GAUL'] = $data_post["ID_JADWAL_IKAN_GAUL"];
	// 			$record = new Daftar_ikan_gaul($data);
	// 			$affected_rows = $record->save();
	
	// 			if (!$affected_rows) {
	// 				$hasil = [
	// 					'status' => false,
	// 					'message' => 'Failed to save record',
	// 					'data' => null
	// 				];
	// 			} else {
	// 				$hasil = [
	// 					'status' => true,
	// 					'message' => 'Record saved successfully',
	// 					'data' => $data
	// 				];
	// 			}
	// 		}
	// 	}
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	// }


	function simpan_permohonan_ikan_gaul()
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
        $data_post["DAFTARID"] == "" ||
        $data_post["NIK"] == "" ||
        $data_post["NAMA_LENGKAP"] == "" ||
        $data_post["NOMOR_WHATSAPP"] == "" ||
        $data_post["EMAIL"] == "" ||
        $data_post["ID_JADWAL_IKAN_GAUL"] == ""
    ) {
        $hasil = [
            'status' => false,
            'message' => 'Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang',
            'data' => null
        ];
    } else {
		$id_jadwal_ikan_gaul = $data_post["ID_JADWAL_IKAN_GAUL"];
		$jadwal_record = Jadwal_ikan_gaul::find_by_id($id_jadwal_ikan_gaul);		
		// print_r($jadwal_record);die;

		if (!$jadwal_record) {
			$hasil = [
				'status' => false,
				'message' => 'Jadwal not found',
				'data' => null
			];
		} elseif (empty($jadwal_record->attributes())) {
			$hasil = [
				'status' => false,
				'message' => 'Error fetching Jadwal record',
				'data' => null
			];
		} elseif ($jadwal_record->kuota <= 0) {
			$hasil = [
				'status' => false,
				'message' => 'Kuota for selected Jadwal is full',
				'data' => null
			];
		} else {
            $jadwal_record->kuota -= 1;

            $jadwal_record->save();

            $data['DAFTARID'] = $data_post["DAFTARID"];
            $data['NIK'] = $data_post["NIK"];
            $data['NAMA_LENGKAP'] = $data_post["NAMA_LENGKAP"];
            $data['EMAIL'] = $data_post["EMAIL"];
            $data['NOMOR_WHATSAPP'] = $data_post["NOMOR_WHATSAPP"];
            $data['ID_JADWAL_IKAN_GAUL'] = $id_jadwal_ikan_gaul;
            $record = new Daftar_ikan_gaul($data);
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
                    'data' => $data
                ];
            }
        }
    }
    $this->output->set_content_type('application/json')->set_output(json_encode($hasil));
}

	
	

	function detailPengajuanIkanGaul()
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
			$pengajuanIkanGaul = Daftar_ikan_gaul::get_criteria(['where' => ['nik' => $nik]]);

			if (empty($pengajuanIkanGaul)) {
				$hasil = [
					'status' => true,
					'message' => 'No pengajuan Ikan Gaul data found for the logged-in user',
					'data' => null
				];
			} else {
				$display_data = [
					'daftarid' => $pengajuanIkanGaul[0]->daftarid,
					'nik' => $pengajuanIkanGaul[0]->nik,
					'nama_lengkap' => $pengajuanIkanGaul[0]->nama_lengkap,
					'nomor_whatsapp' => $pengajuanIkanGaul[0]->nomor_whatsapp,
					'email' => $pengajuanIkanGaul[0]->email,
					'jadwal' => $pengajuanIkanGaul[0]->jadwal,
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


	function update_pengajuan_ikan_gaul()
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
		$required_fields = ['DAFTARID', 'NIK', 'NAMA_LENGKAP', 'NOMOR_WHATSAPP', 'EMAIL', 'JADWAL'];
	
		foreach ($required_fields as $field) {
			if (empty($data_post[$field])) {
				$hasil = [
					'status' => false,
					'message' => 'Gagal Update Permohonan, Silahkan Lengkapi Semua Data',
					'data' => null
				];
				$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
				return;
			}
		}
	
		// Find the record based on DAFTARID
		$existingRecords = Daftar_ikan_gaul::get_criteria(['where' => ['DAFTARID' => $data_post["DAFTARID"]]]);
	
		if (empty($existingRecords)) {
			$hasil = [
				'status' => false,
				'message' => 'Record not found for the given DAFTARID',
				'data' => null
			];
			$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			return;
		}
	
		// Iterate through existing records and update
		foreach ($existingRecords as $existingRecord) {
			// Update the record with the new data
			$existingRecord->nik = $data_post["NIK"];
			$existingRecord->nama_lengkap = $data_post["NAMA_LENGKAP"];
			$existingRecord->nomor_whatsapp = $data_post["NOMOR_WHATSAPP"];
			$existingRecord->email = $data_post["EMAIL"];
			$existingRecord->jadwal = $data_post["JADWAL"];
	
			// Save the updated record
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
					'nik' => $existingRecord->nik,
					'nama_lengkap' => $existingRecord->nama_lengkap,
					'nomor_whatsapp' => $existingRecord->nomor_whatsapp,
					'email' => $existingRecord->email,
					'jadwal' => $existingRecord->jadwal,
					'tgl_permohonan' => $existingRecord->tgl_permohonan,
				];
	
				$hasil = [
					'status' => true,
					'message' => 'Permohonan Ikan Gaul berhasil diupdate',
					'data' => $display_data
				];
			}
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
	

}

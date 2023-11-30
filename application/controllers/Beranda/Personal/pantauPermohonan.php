<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pantauPermohonan extends CI_Controller {
    function cekPermohonan(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		
		if($data_post['CEK_PERMOHONAN']["JENIS_PERMOHONAN"] == 1){
			$numRecords = count(Daftar_ktp_model::get_criteria(array("AKUN"=>$data_post['CEK_PERMOHONAN']["AKUN"])));
			if($numRecords>0){
				$where["AKUN"]=$data_post['CEK_PERMOHONAN']["AKUN"];
				$order = "TGL_PERMOHONAN DESC";
				$dataPermohonan = Daftar_ktp_model::get_criteria(array('where'=>$where,'order'=>$order));
				$data = $dataPermohonan;
				foreach ($data as $results) {
					$hasil[] = array(
					   'id_permohonan' => $results->daftarid,
					   'nik' => $results->nik,
					   'nama_lgkp' => $results->nama_lgkp,
					   'no_kk' => $results->no_kk,
					   'status' => $results->status,
					   'akun' => $results->akun,
					   'tgl_permohonan'=>$results->tgl_permohonan,
					   'alasan_penolakan'=>$results->alasan_penolakan,
					   'pesan'=>$results->pesan,
					   'pengambilan'=>$results->pengambilan,
					   'alasan'=>$results->alasan,
					   'no_resi'=>$results->no_resi,
					   'jenis_permohonan'=>'RIWAYAT PENGAJUAN PERMOHONAN KTP-EL'
					);
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			}else{
				$hasil = 1;
				$this->output->set_content_type('application/json')->set_output($hasil);
			}
		}elseif($data_post['CEK_PERMOHONAN']["JENIS_PERMOHONAN"] == 2){
			$numRecords = count(Daftar_kia_model::get_criteria(array("AKUN"=>$data_post['CEK_PERMOHONAN']["AKUN"])));
			if($numRecords>0){
				$where["AKUN"]=$data_post['CEK_PERMOHONAN']["AKUN"];
				$order = "TGL_PERMOHONAN DESC";
				$dataPermohonan = Daftar_kia_model::get_criteria(array('where'=>$where,'order'=>$order));
				$data = $dataPermohonan;
				foreach ($data as $results) {
					$hasil[] = array(
					   'id_permohonan' => $results->daftarid,
					   'nik' => $results->nik,
					   'nama_lgkp' => $results->nama_lgkp,
					   'no_kk' => $results->no_kk,
					   'status' => $results->status,
					   'akun' => $results->akun,
					   'tgl_permohonan'=>$results->tgl_permohonan,
					   'alasan_penolakan'=>$results->alasan_penolakan,
					   'pesan'=>$results->pesan,
					   'pengambilan'=>$results->pengambilan,
					   'alasan'=>$results->alasan,
					   'no_resi'=>$results->no_resi,
					   'jenis_permohonan'=>'RIWAYAT PENGAJUAN PERMOHONAN KIA'
					);
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			}else{
				$hasil = 2;
				$this->output->set_content_type('application/json')->set_output($hasil);
			}
		}elseif($data_post['CEK_PERMOHONAN']["JENIS_PERMOHONAN"] == 3){
			$numRecords = count(Daftar_kk_model::get_criteria(array("AKUN"=>$data_post['CEK_PERMOHONAN']["AKUN"])));
			if($numRecords>0){
				$where["AKUN"]=$data_post['CEK_PERMOHONAN']["AKUN"];
				$order = "TGL_PERMOHONAN DESC";
				$dataPermohonan = Daftar_kk_model::get_criteria(array('where'=>$where,'order'=>$order));
				$data = $dataPermohonan;
				foreach ($data as $results) {
					$hasil[] = array(
					   'id_permohonan' => $results->daftarid,
					   'nik' => $results->nik,
					   'nama_lgkp' => $results->nama_lgkp,
					   'no_kk' => $results->no_kk,
					   'status' => $results->status,
					   'akun' => $results->akun,
					   'tgl_permohonan'=>$results->tgl_permohonan,
					   'alasan_penolakan'=>$results->alasan_penolakan,
					   'pesan'=>$results->pesan,
					   'alasan'=>$results->alasan,
					   'jenis_permohonan'=>'RIWAYAT PENGAJUAN PERMOHONAN KARTU KELUARGA'
					);
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			}else{
				$hasil = 3;
				$this->output->set_content_type('application/json')->set_output($hasil);
			}
		}elseif($data_post['CEK_PERMOHONAN']["JENIS_PERMOHONAN"] == 4){
			$numRecords = count(Daftar_akta_lahir_model::get_criteria(array("AKUN"=>$data_post['CEK_PERMOHONAN']["AKUN"])));
			if($numRecords>0){
				$where["AKUN"]=$data_post['CEK_PERMOHONAN']["AKUN"];
				$order = "TGL_PERMOHONAN DESC";
				$dataPermohonan = Daftar_akta_lahir_model::get_criteria(array('where'=>$where,'order'=>$order));
				$data = $dataPermohonan;
				foreach ($data as $results) {
					$hasil[] = array(
					   'id_permohonan' => $results->daftarid,
					   'nik' => $results->nik,
					   'nama_lgkp' => $results->nama_lgkp,
					   'no_kk' => $results->no_kk,
					   'status' => $results->status,
					   'akun' => $results->akun,
					   'tgl_permohonan'=>$results->tgl_permohonan,
					   'alasan_penolakan'=>$results->alasan_penolakan,
					   'pesan'=>$results->pesan,
					   'jenis_permohonan'=>'RIWAYAT PENGAJUAN PERMOHONAN AKTA KELAHIRAN'
					);
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			}else{
				$hasil = 4;
				$this->output->set_content_type('application/json')->set_output($hasil);
			}
		}elseif($data_post['CEK_PERMOHONAN']["JENIS_PERMOHONAN"] == 5){
			$numRecords = count(Daftar_skpwni_model::get_criteria(array("AKUN"=>$data_post['CEK_PERMOHONAN']["AKUN"])));
			if($numRecords>0){
				$where["AKUN"]=$data_post['CEK_PERMOHONAN']["AKUN"];
				$order = "TGL_PERMOHONAN DESC";
				$dataPermohonan = Daftar_skpwni_model::get_criteria(array('where'=>$where,'order'=>$order));
				$data = $dataPermohonan;
				foreach ($data as $results) {
					$hasil[] = array(
					   'id_permohonan' => $results->daftarid,
					   'nik' => $results->nik,
					   'nama_lgkp' => $results->nama_lgkp,
					   'no_kk' => $results->no_kk,
					   'status' => $results->status,
					   'akun' => $results->akun,
					   'tgl_permohonan'=>$results->tgl_permohonan,
					   'alasan_penolakan'=>$results->alasan_penolakan,
					   'pesan'=>$results->pesan,
					   'alasan'=>$results->jenis_kepindahan,
					   'jenis_permohonan'=>'RIWAYAT PENGAJUAN PERMOHONAN SURAT KETERANGAN PINDAH'
					);
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
			}else{
				$hasil = 5;
				$this->output->set_content_type('application/json')->set_output($hasil);
			}
		}else{
			$hasil = 6;
			$this->output->set_content_type('application/json')->set_output($hasil);
		}
		
    }
}
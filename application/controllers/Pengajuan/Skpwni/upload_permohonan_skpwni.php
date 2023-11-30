<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_permohonan_skpwni extends CI_Controller {
    function simpan_permohonan_skpwni(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANSKPWNI']["NIK"] =="" || $data_post['SIMPANSKPWNI']["NO_KK"] =="" || $data_post['SIMPANSKPWNI']["NAMA_LGKP"] =="" || $data_post['SIMPANSKPWNI']["NO_KEC"] =="" || $data_post['SIMPANSKPWNI']["NO_KEL"] =="" || $data_post['SIMPANSKPWNI']["JENIS_KEPINDAHAN"] =="" || $data_post['SIMPANSKPWNI']["DAFTARID"] =="" || $data_post['SIMPANSKPWNI']["SC_F103"] =="" || $data_post['SIMPANSKPWNI']["SC_KTP"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_skpwni_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANSKPWNI']["DAFTARID"])));
			$checkRecordAktif = Daftar_skpwni_model::get_criteria(array("NIK"=>$data_post['SIMPANSKPWNI']["NIK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					//$data_ktp['SIMPANSKPWNI']['DAFTARID'] = $data_post['SIMPANSKPWNI']["DAFTARID"];
					//$data_ktp['SIMPANSKPWNI']['NIK'] = $data_post['SIMPANSKPWNI']["NIK"];
					//$data_ktp['SIMPANSKPWNI']['NO_KK'] = $data_post['SIMPANSKPWNI']["NO_KK"];
					//$data_ktp['SIMPANSKPWNI']['NAMA_LGKP'] = $data_post['SIMPANSKPWNI']["NAMA"];
					//$data_ktp['SIMPANSKPWNI']['NO_KEC'] = $data_post['SIMPANSKPWNI']["KEC"];
					//$data_ktp['SIMPANSKPWNI']['NO_KEL'] = $data_post['SIMPANSKPWNI']["KEL"];
					//$data_ktp['SIMPANSKPWNI']['ALASAN'] = $data_post['SIMPANSKPWNI']["ALASAN"];
					//$data_ktp['SIMPANSKPWNI']['NO_AKTA_LAHIR'] = $data_post['SIMPANSKPWNI']["NO_AKTA_LAHIR"];
					//$data_ktp['SIMPANSKPWNI']['SC_KIA'] = 'upload/permohonan/kia/'.$data_post['SIMPANSKPWNI']["SC_KIA"];
					//$data_ktp['SIMPANSKPWNI']['PAS_FOTO'] = 'upload/permohonan/kia/'.$data_post['SIMPANSKPWNI']["PAS_FOTO"];
					//$data_ktp['SIMPANSKPWNI']['PENGAMBILAN'] = $data_post['SIMPANSKPWNI']["PENGAMBILAN"];
					//$data_ktp['SIMPANSKPWNI']['AKUN'] = $data_post['SIMPANSKPWNI']["AKUN"];
					//$data_ktp['SIMPANSKPWNI']['STATUS'] = 1;
					$record=new Daftar_skpwni_model($data_post['SIMPANSKPWNI']);
					$affected_rows=$record->save();
					if(!$affected_rows){
						$hasil=0;
					}else{
						$hasil=1;
					}
				}else{
					$hasil = 2;
				}
			}
			
		}
		$this->output->set_content_type('application/json')->set_output($hasil);
    }
}
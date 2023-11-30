<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_permohonan_kia extends CI_Controller {
    function simpan_permohonan_kia(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKIA']["NIK"] =="" || $data_post['SIMPANKIA']["NO_KK"] =="" || $data_post['SIMPANKIA']["NAMA_LGKP"] =="" || $data_post['SIMPANKIA']["NO_KEC"] =="" || $data_post['SIMPANKIA']["NO_KEL"] =="" || $data_post['SIMPANKIA']["ALASAN"] =="" || $data_post['SIMPANKIA']["PENGAMBILAN"] =="" || $data_post['SIMPANKIA']["DAFTARID"] =="" || $data_post['SIMPANKIA']["SC_KIA"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_kia_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKIA']["DAFTARID"])));
			$checkRecordAktif = Daftar_kia_model::get_criteria(array("NIK"=>$data_post['SIMPANKIA']["NIK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					//$data_ktp['SIMPANKIA']['DAFTARID'] = $data_post['SIMPANKIA']["DAFTARID"];
					//$data_ktp['SIMPANKIA']['NIK'] = $data_post['SIMPANKIA']["NIK"];
					//$data_ktp['SIMPANKIA']['NO_KK'] = $data_post['SIMPANKIA']["NO_KK"];
					//$data_ktp['SIMPANKIA']['NAMA_LGKP'] = $data_post['SIMPANKIA']["NAMA"];
					//$data_ktp['SIMPANKIA']['NO_KEC'] = $data_post['SIMPANKIA']["KEC"];
					//$data_ktp['SIMPANKIA']['NO_KEL'] = $data_post['SIMPANKIA']["KEL"];
					//$data_ktp['SIMPANKIA']['ALASAN'] = $data_post['SIMPANKIA']["ALASAN"];
					//$data_ktp['SIMPANKIA']['NO_AKTA_LAHIR'] = $data_post['SIMPANKIA']["NO_AKTA_LAHIR"];
					//$data_ktp['SIMPANKIA']['SC_KIA'] = 'upload/permohonan/kia/'.$data_post['SIMPANKIA']["SC_KIA"];
					//$data_ktp['SIMPANKIA']['PAS_FOTO'] = 'upload/permohonan/kia/'.$data_post['SIMPANKIA']["PAS_FOTO"];
					//$data_ktp['SIMPANKIA']['PENGAMBILAN'] = $data_post['SIMPANKIA']["PENGAMBILAN"];
					//$data_ktp['SIMPANKIA']['AKUN'] = $data_post['SIMPANKIA']["AKUN"];
					//$data_ktp['SIMPANKIA']['STATUS'] = 1;
					$record=new Daftar_kia_model($data_post['SIMPANKIA']);
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
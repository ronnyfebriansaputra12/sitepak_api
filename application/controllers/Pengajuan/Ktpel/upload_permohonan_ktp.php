<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_permohonan_ktp extends CI_Controller {
    function simpan_permohonan_ktp(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKTP']["NIK"] =="" || $data_post['SIMPANKTP']["NO_KK"] =="" || $data_post['SIMPANKTP']["NAMA"] =="" || $data_post['SIMPANKTP']["KEC"] =="" || $data_post['SIMPANKTP']["KEL"] =="" || $data_post['SIMPANKTP']["ALASAN"] =="" || $data_post['SIMPANKTP']["PENGAMBILAN"] =="" || $data_post['SIMPANKTP']["DAFTARID"] =="" || $data_post['SIMPANKTP']["SC_KTP"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_ktp_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKTP']["DAFTARID"])));
			$checkRecordAktif = Daftar_ktp_model::get_criteria(array("NIK"=>$data_post['SIMPANKTP']["NIK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					$data_ktp['SIMPANKTP']['DAFTARID'] = $data_post['SIMPANKTP']["DAFTARID"];
					$data_ktp['SIMPANKTP']['NIK'] = $data_post['SIMPANKTP']["NIK"];
					$data_ktp['SIMPANKTP']['NO_KK'] = $data_post['SIMPANKTP']["NO_KK"];
					$data_ktp['SIMPANKTP']['NAMA_LGKP'] = $data_post['SIMPANKTP']["NAMA"];
					$data_ktp['SIMPANKTP']['NO_KEC'] = $data_post['SIMPANKTP']["KEC"];
					$data_ktp['SIMPANKTP']['NO_KEL'] = $data_post['SIMPANKTP']["KEL"];
					$data_ktp['SIMPANKTP']['ALASAN'] = $data_post['SIMPANKTP']["ALASAN"];
					$data_ktp['SIMPANKTP']['SC_KTP'] = 'upload/permohonan/ktpel/'.$data_post['SIMPANKTP']["SC_KTP"];
					$data_ktp['SIMPANKTP']['PENGAMBILAN'] = $data_post['SIMPANKTP']["PENGAMBILAN"];
					$data_ktp['SIMPANKTP']['AKUN'] = $data_post['SIMPANKTP']["AKUN"];
					$data_ktp['SIMPANKTP']['STATUS'] = 1;
					$record=new Daftar_ktp_model($data_ktp['SIMPANKTP']);
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
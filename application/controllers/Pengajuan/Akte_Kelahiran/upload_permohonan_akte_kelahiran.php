<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_permohonan_akte_kelahiran extends CI_Controller {
    function simpan_permohonan_akte_kelahiran(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANAKTALAHIR']["NO_KK"] =="" || $data_post['SIMPANAKTALAHIR']["KEC"] =="" || $data_post['SIMPANAKTALAHIR']["KEL"] =="" || $data_post['SIMPANAKTALAHIR']["DAFTARID"] =="" || $data_post['SIMPANAKTALAHIR']["AKUN"] =="" || $data_post['SIMPANAKTALAHIR']["NIK_BAYI"] =="" || $data_post['SIMPANAKTALAHIR']["NAMA_BAYI"] =="" || $data_post['SIMPANAKTALAHIR']["ANAK_KE"] =="" || $data_post['SIMPANAKTALAHIR']["BERAT_BAYI"] =="" || $data_post['SIMPANAKTALAHIR']["JENIS_KELAHIRAN"] =="" || $data_post['SIMPANAKTALAHIR']["TEMPAT_KELAHIRAN"] =="" || $data_post['SIMPANAKTALAHIR']["PENOLONG_KELAHIRAN"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_F201"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_NIKAH"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_KTPEL_ORTU"] =="" || $data_post['SIMPANAKTALAHIR']["DOC_SKL"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_akta_lahir_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANAKTALAHIR']["DAFTARID"])));
			$checkRecordAktif = Daftar_akta_lahir_model::get_criteria(array("NIK"=>$data_post['SIMPANAKTALAHIR']["NIK_BAYI"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					$data_ktp['SIMPANAKTALAHIR']['DAFTARID'] = $data_post['SIMPANAKTALAHIR']["DAFTARID"];
					$data_ktp['SIMPANAKTALAHIR']['NO_KK'] = $data_post['SIMPANAKTALAHIR']["NO_KK"];
					$data_ktp['SIMPANAKTALAHIR']['NO_KEC'] = $data_post['SIMPANAKTALAHIR']["KEC"];
					$data_ktp['SIMPANAKTALAHIR']['NO_KEL'] = $data_post['SIMPANAKTALAHIR']["KEL"];
					$data_ktp['SIMPANAKTALAHIR']['NIK'] = $data_post['SIMPANAKTALAHIR']["NIK_BAYI"];
					$data_ktp['SIMPANAKTALAHIR']['NAMA_LGKP'] = $data_post['SIMPANAKTALAHIR']["NAMA_BAYI"];
					$data_ktp['SIMPANAKTALAHIR']['ANAK_KE'] = $data_post['SIMPANAKTALAHIR']["ANAK_KE"];
					$data_ktp['SIMPANAKTALAHIR']['BERAT_BAYI'] = $data_post['SIMPANAKTALAHIR']["BERAT_BAYI"];
					$data_ktp['SIMPANAKTALAHIR']['JENIS_LAHIR'] = $data_post['SIMPANAKTALAHIR']["JENIS_KELAHIRAN"];
					$data_ktp['SIMPANAKTALAHIR']['TEMPAT_LHR'] = $data_post['SIMPANAKTALAHIR']["TEMPAT_KELAHIRAN"];
					$data_ktp['SIMPANAKTALAHIR']['PENOLONG_LHR'] = $data_post['SIMPANAKTALAHIR']["PENOLONG_KELAHIRAN"];
					$data_ktp['SIMPANAKTALAHIR']['FORMULIR'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_F201"];
					$data_ktp['SIMPANAKTALAHIR']['BUKTI_NIKAH_FOTO'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_NIKAH"];
					$data_ktp['SIMPANAKTALAHIR']['KTP_ORTU_FOTO'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_KTPEL_ORTU"];
					$data_ktp['SIMPANAKTALAHIR']['BUKTI_LAHIR_FOTO'] = 'upload/permohonan/akte_kelahiran/'.$data_post['SIMPANAKTALAHIR']["DOC_SKL"];
					$data_ktp['SIMPANAKTALAHIR']['AKUN'] = $data_post['SIMPANAKTALAHIR']["AKUN"];
					$data_ktp['SIMPANAKTALAHIR']['STATUS'] = 1;
					$record=new Daftar_akta_lahir_model($data_ktp['SIMPANAKTALAHIR']);
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
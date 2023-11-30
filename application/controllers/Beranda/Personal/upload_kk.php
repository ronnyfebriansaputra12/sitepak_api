<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_kk extends CI_Controller {
    function simpan_kk(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANDOC']["PATH_KK"] == ""){
			$hasil = "Gagal Upload, Silahkan Coba Upload Ulang";
		}else{
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK"=>$data_post['SIMPANDOC']["NIK"])));
			if($numRecords>0){
				$data_post['SIMPANDOC']['PATH_KK'] = 'upload/kk/'.$data_post['SIMPANDOC']["PATH_KK"];
				$recUser=User_sitepak_model::find([$data_post['SIMPANDOC']["NIK"]]);	
				$affected_rows=$recUser->update_attributes($data_post['SIMPANDOC']);
				if(!$affected_rows){
					$hasil=0;
				}else{
					$hasil=1;
				}
			}else{
				$hasil = 3;
			}
		}
		$this->output->set_content_type('application/json')->set_output($hasil);
    }
	
	function cek_dokumen(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		$numRecords = count(User_sitepak_model::get_criteria(array("NIK"=>$data_post['CEK_DOC_KK']["NIK"])));
		if($numRecords>0){
			$dataUser = User_sitepak_model::get_criteria(["where"=>["NIK" => $data_post['CEK_DOC_KK']["NIK"]],]);
			$hasil = $dataUser[0];
			$this->output->set_content_type('application/json')->set_output($hasil->to_json());
		}else{
			$hasil = "";
		}
    }
	
	function cek_tgl_libur(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		$numRecords = count(Tgl_libur_model::get_criteria(array("TANGGAL"=>MY_model::create_date($data_post['CEK_TGL_LIBUR']["TANGGAL"]))));
		if($numRecords>0){
			$dataTanggal = Tgl_libur_model::get_criteria(["where"=>["TANGGAL" => MY_model::create_date($data_post['CEK_TGL_LIBUR']["TANGGAL"])],]);
			$hasil = $dataTanggal[0];
			$this->output->set_content_type('application/json')->set_output($hasil->to_json());
		}else{
			$hasil = "";
		}
    }
}
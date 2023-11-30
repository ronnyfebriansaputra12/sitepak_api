<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar extends CI_Controller {
    function registrasi(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		
		//print_r($data_post['REGISTRASI']['nik']);
		if($data_post['REGISTRASI']["NIK"] =="" || $data_post['REGISTRASI']["NO_KK"] =="" || $data_post['REGISTRASI']["NAMA"] =="" || $data_post['REGISTRASI']["ALAMAT"] =="" || $data_post['REGISTRASI']["KEC"] =="" || $data_post['REGISTRASI']["KEL"] =="" || $data_post['REGISTRASI']["NO_HP"] =="" || $data_post['REGISTRASI']["EMAIL"] =="" || $data_post['REGISTRASI']["PASSWORD"] ==""){
			$hasil = "Tidak Boleh Ada Yang Kosong";
		}else{
			
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" =>$data_post['REGISTRASI']["NIK"])));
			if($numRecords >0){
				//$hasil = "NIK sudah terdaftar";
				$hasil=2;
			}else{
				$numRecordsEmail = count(User_sitepak_model::get_criteria(array("EMAIL" =>$data_post['REGISTRASI']["EMAIL"])));
				if($numRecordsEmail > 0){
					//$hasil = "Email sudah terdaftar";
					$hasil = 3;
				}else{
					$numRecordsHp = count(User_sitepak_model::get_criteria(array("NO_HP" =>$data_post['REGISTRASI']["NO_HP"])));
					if($numRecordsHp > 0){
						//$hasil = "HP sudah terdaftar";
						$hasil = 4;
					}else{
						$timestamp = time()-86400;

						$date = strtotime("+7 day", $timestamp);
						$exp = date('d-m-Y', $date);
						
						$data_post['REGISTRASI']['EXP_AKTIVASI'] = $exp;
						$data_post['REGISTRASI']['PASSWORD'] = md5($data_post['REGISTRASI']["PASSWORD"]);
						$data_post['REGISTRASI']['STATUS'] = 0;
						$record=new User_sitepak_model($data_post['REGISTRASI']);
						$affected_rows=$record->save();				
						if(!$affected_rows){
							$hasil=0;
							
						}else{
							$hasil=1;
						}
					}
					
				}
				
			}
			
		}
		 $this->output->set_content_type('application/json')
            ->set_output($hasil);
    }
	
	function generateRandomString() {
		$length = 128;
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
	
	 function lupa_password(){
		// tambahkan table untuk history NIK token dan tgl token, kemudian buat jegatan perhari maksimal request token
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//print_r($data_post['REGISTRASI']['nik']);
		if($data_post['LUPA_PASS']["NIK"] =="" || $data_post['LUPA_PASS']["EMAIL"] ==""){
			$hasil = "ada yg kosong";
		}else{
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" =>$data_post['LUPA_PASS']["NIK"],"EMAIL" =>$data_post['LUPA_PASS']["EMAIL"])));
			if($numRecords == 0){
				//$hasil = "Tidak ditemukan";
				$hasil=2;
			}else{				
				$_EXISTED = TRUE; $_USERNAME = "";
			
				while($_EXISTED){
					$_NUM = $this->generateRandomString();
					$cekNUM = count(User_sitepak_model::get_criteria(array('TOKEN'=>$_NUM)));
					if($cekNUM == 0){
						$TOKEN = $_NUM;
						$_EXISTED = FALSE;
					}
					
				}
				$date = date('d-m-Y H:i:s');
				$data_post['LUPA_PASS']['TGL_TOKEN'] = $date;
				$data_post['LUPA_PASS']['TOKEN'] = $TOKEN;
				$recUser=User_sitepak_model::get_criteria(array("NIK" =>$data_post['LUPA_PASS']["NIK"],"EMAIL" =>$data_post['LUPA_PASS']["EMAIL"]));
				$affected_rows=$recUser[0]->update_attributes($data_post['LUPA_PASS']);	
				
				if(!$affected_rows){
					$hasil=0;
					
				}else{
					$configEmail = $this->config->item('email');
					$this->email->initialize($configEmail);
					$this->email->from($configEmail['smtp_user']);
					$this->email->to($cekUser[0]->email);
					$this->email->subject('AKTIVASI USER SITEPAK');
					$this->email->message($pesan);

					if(!$this->email->send()){
						echo $this->email->print_debugger();
					}
					$hasil=1;
				}
			}
		}
		 $this->output->set_content_type('application/json')
            ->set_output($hasil);
    }
	
	 function aktivasi(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		
		//print_r($data_post['REGISTRASI']['nik']);
		if($data_post['AKTIVASI']["NIK"] =="" || $data_post['AKTIVASI']["NO_KK"] =="" || $data_post['AKTIVASI']["EMAIL"] =="" || $data_post['AKTIVASI']["KODE_VERIFIKASI"] ==""){
			$hasil = "Tidak Boleh Ada Yang Kosong";
		}else{
			
			$numRecords = count(User_sitepak_model::get_criteria(array("NIK" =>$data_post['AKTIVASI']["NIK"],"KODE_AKTIVASI"=>$data_post['AKTIVASI']["KODE_VERIFIKASI"], "NO_KK"=>$data_post['AKTIVASI']["NO_KK"],"EMAIL"=>$data_post['AKTIVASI']["EMAIL"])));
			if($numRecords == 0){
				//$hasil = "NIK sudah terdaftar";
				$hasil=2;
			}else{
				$date = date('d-m-Y H:i:s');
				$data_post['UPDATE']['TGL_AKTIVASI'] = $date;
				$data_post['UPDATE']['STATUS'] = 1;
				$recUser=User_sitepak_model::get_criteria(array("NIK" =>$data_post['AKTIVASI']["NIK"],"KODE_AKTIVASI"=>$data_post['AKTIVASI']["KODE_VERIFIKASI"], "NO_KK"=>$data_post['AKTIVASI']["NO_KK"],"EMAIL"=>$data_post['AKTIVASI']["EMAIL"]));
				$affected_rows=$recUser[0]->update_attributes($data_post['UPDATE']);	
				if(!$affected_rows){
					$hasil=2;
				}else{
					$hasil=1;
				}
			}
		}
		 $this->output->set_content_type('application/json')
            ->set_output($hasil);
    }
    
}
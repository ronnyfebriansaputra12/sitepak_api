<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upload_permohonan_kk extends CI_Controller {
    function simpan_permohonan_tambah_jiwa(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKK']["NO_KK"] =="" || $data_post['SIMPANKK']["KEC"] =="" || $data_post['SIMPANKK']["KEL"] =="" || $data_post['SIMPANKK']["ALASAN"] =="" || $data_post['SIMPANKK']["DAFTARID"] =="" || $data_post['SIMPANKK']["SC_F101"] =="" || $data_post['SIMPANKK']["SC_NIKAH"] =="" || $data_post['SIMPANKK']["SC_SKL"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKK']["DAFTARID"])));
			$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK"=>$data_post['SIMPANKK']["NO_KK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					$data_ktp['SIMPANKK']['DAFTARID'] = $data_post['SIMPANKK']["DAFTARID"];
					$data_ktp['SIMPANKK']['NIK'] = $data_post['SIMPANKK']["NIK"];
					$data_ktp['SIMPANKK']['NO_KK'] = $data_post['SIMPANKK']["NO_KK"];
					$data_ktp['SIMPANKK']['NAMA_LGKP'] = $data_post['SIMPANKK']["NAMA_LGKP"];
					$data_ktp['SIMPANKK']['NO_KEC'] = $data_post['SIMPANKK']["KEC"];
					$data_ktp['SIMPANKK']['NO_KEL'] = $data_post['SIMPANKK']["KEL"];
					$data_ktp['SIMPANKK']['ALASAN'] = $data_post['SIMPANKK']["ALASAN"];
					$data_ktp['SIMPANKK']['SC_F101'] = 'upload/permohonan/kk/tambah_jiwa/'.$data_post['SIMPANKK']["SC_F101"];
					$data_ktp['SIMPANKK']['SC_NIKAH'] = 'upload/permohonan/kk/tambah_jiwa/'.$data_post['SIMPANKK']["SC_NIKAH"];
					$data_ktp['SIMPANKK']['SC_SKL'] = 'upload/permohonan/kk/tambah_jiwa/'.$data_post['SIMPANKK']["SC_SKL"];
					$data_ktp['SIMPANKK']['AKUN'] = $data_post['SIMPANKK']["AKUN"];
					$data_ktp['SIMPANKK']['STATUS'] = 1;
					$record=new Daftar_kk_model($data_ktp['SIMPANKK']);
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
	
	function simpan_permohonan_kurang_jiwa(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKK']["NO_KK"] =="" || $data_post['SIMPANKK']["KEC"] =="" || $data_post['SIMPANKK']["KEL"] =="" || $data_post['SIMPANKK']["ALASAN"] =="" || $data_post['SIMPANKK']["DAFTARID"] =="" || $data_post['SIMPANKK']["SC_F101"] =="" || $data_post['SIMPANKK']["SC_NIKAH"] =="" || $data_post['SIMPANKK']["SC_KEMATIAN"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKK']["DAFTARID"])));
			$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK"=>$data_post['SIMPANKK']["NO_KK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					$data_ktp['SIMPANKK']['DAFTARID'] = $data_post['SIMPANKK']["DAFTARID"];
					$data_ktp['SIMPANKK']['NO_KK'] = $data_post['SIMPANKK']["NO_KK"];
					$data_ktp['SIMPANKK']['NO_KEC'] = $data_post['SIMPANKK']["KEC"];
					$data_ktp['SIMPANKK']['NO_KEL'] = $data_post['SIMPANKK']["KEL"];
					$data_ktp['SIMPANKK']['ALASAN'] = $data_post['SIMPANKK']["ALASAN"];
					$data_ktp['SIMPANKK']['SC_F101'] = 'upload/permohonan/kk/kurang_jiwa/'.$data_post['SIMPANKK']["SC_F101"];
					$data_ktp['SIMPANKK']['SC_NIKAH'] = 'upload/permohonan/kk/kurang_jiwa/'.$data_post['SIMPANKK']["SC_NIKAH"];
					$data_ktp['SIMPANKK']['SC_KEMATIAN'] = 'upload/permohonan/kk/kurang_jiwa/'.$data_post['SIMPANKK']["SC_KEMATIAN"];
					$data_ktp['SIMPANKK']['AKUN'] = $data_post['SIMPANKK']["AKUN"];
					$data_ktp['SIMPANKK']['STATUS'] = 1;
					$record=new Daftar_kk_model($data_ktp['SIMPANKK']);
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
	
	function simpan_permohonan_kk_rusak(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKK']["NO_KK"] =="" || $data_post['SIMPANKK']["KEC"] =="" || $data_post['SIMPANKK']["KEL"] =="" || $data_post['SIMPANKK']["ALASAN"] =="" || $data_post['SIMPANKK']["DAFTARID"] =="" || $data_post['SIMPANKK']["SC_F101"] =="" || $data_post['SIMPANKK']["SC_NIKAH"] =="" || $data_post['SIMPANKK']["SC_KK"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKK']["DAFTARID"])));
			$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK"=>$data_post['SIMPANKK']["NO_KK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					$data_ktp['SIMPANKK']['DAFTARID']	= $data_post['SIMPANKK']["DAFTARID"];
					$data_ktp['SIMPANKK']['NO_KK']		= $data_post['SIMPANKK']["NO_KK"];
					$data_ktp['SIMPANKK']['NO_KEC']		= $data_post['SIMPANKK']["KEC"];
					$data_ktp['SIMPANKK']['NO_KEL']		= $data_post['SIMPANKK']["KEL"];
					$data_ktp['SIMPANKK']['ALASAN']		= $data_post['SIMPANKK']["ALASAN"];
					$data_ktp['SIMPANKK']['SC_F101']	= 'upload/permohonan/kk/kk_rusak/'.$data_post['SIMPANKK']["SC_F101"];
					$data_ktp['SIMPANKK']['SC_NIKAH']	= 'upload/permohonan/kk/kk_rusak/'.$data_post['SIMPANKK']["SC_NIKAH"];
					$data_ktp['SIMPANKK']['SC_KK']		= 'upload/permohonan/kk/kk_rusak/'.$data_post['SIMPANKK']["SC_KK"];
					$data_ktp['SIMPANKK']['AKUN']		= $data_post['SIMPANKK']["AKUN"];
					$data_ktp['SIMPANKK']['STATUS']		= 1;
					$record=new Daftar_kk_model($data_ktp['SIMPANKK']);
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
	
	function simpan_permohonan_kk_hilang(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKK']["NO_KK"] =="" || $data_post['SIMPANKK']["KEC"] =="" || $data_post['SIMPANKK']["KEL"] =="" || $data_post['SIMPANKK']["ALASAN"] =="" || $data_post['SIMPANKK']["DAFTARID"] =="" || $data_post['SIMPANKK']["SC_F101"] =="" || $data_post['SIMPANKK']["SC_NIKAH"] =="" || $data_post['SIMPANKK']["SC_KK_HILANG"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKK']["DAFTARID"])));
			$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK"=>$data_post['SIMPANKK']["NO_KK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
			}else{
				if($numRecords==0){
					$data_ktp['SIMPANKK']['DAFTARID']		= $data_post['SIMPANKK']["DAFTARID"];
					$data_ktp['SIMPANKK']['NO_KK']			= $data_post['SIMPANKK']["NO_KK"];
					$data_ktp['SIMPANKK']['NO_KEC']			= $data_post['SIMPANKK']["KEC"];
					$data_ktp['SIMPANKK']['NO_KEL']			= $data_post['SIMPANKK']["KEL"];
					$data_ktp['SIMPANKK']['ALASAN']			= $data_post['SIMPANKK']["ALASAN"];
					$data_ktp['SIMPANKK']['SC_F101']		= 'upload/permohonan/kk/kk_hilang/'.$data_post['SIMPANKK']["SC_F101"];
					$data_ktp['SIMPANKK']['SC_NIKAH']		= 'upload/permohonan/kk/kk_hilang/'.$data_post['SIMPANKK']["SC_NIKAH"];
					$data_ktp['SIMPANKK']['SC_KK_HILANG']	= 'upload/permohonan/kk/kk_hilang/'.$data_post['SIMPANKK']["SC_KK_HILANG"];
					$data_ktp['SIMPANKK']['AKUN']			= $data_post['SIMPANKK']["AKUN"];
					$data_ktp['SIMPANKK']['STATUS']			= 1;
					$record=new Daftar_kk_model($data_ktp['SIMPANKK']);
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
	
	function simpan_permohonan_ubah_data(){
        $input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$hasil=[];
		//var_dump($data_post);
		if($data_post['SIMPANKK']["NIK"] =="" || $data_post['SIMPANKK']["NAMA_LGKP"] =="" || $data_post['SIMPANKK']["NO_KK"] =="" || $data_post['SIMPANKK']["NO_KEC"] =="" || $data_post['SIMPANKK']["NO_KEL"] =="" || $data_post['SIMPANKK']["ALASAN"] =="" || $data_post['SIMPANKK']["DAFTARID"] =="" || $data_post['SIMPANKK']["SC_F106"] =="" || $data_post['SIMPANKK']["DATA_UBAH"] ==""){
			$hasil = "Gagal Ajukan Permohonan, Silahkan Coba Ajukan Permohonan Ulang";
		}else{
			$numRecords = count(Daftar_kk_model::get_criteria(array("DAFTARID"=>$data_post['SIMPANKK']["DAFTARID"])));
			$checkRecordAktif = Daftar_kk_model::get_criteria(array("NO_KK"=>$data_post['SIMPANKK']["NO_KK"],"NIK"=>$data_post['SIMPANKK']["NIK"],"STATUS"=>array(1,2)));
			if(count($checkRecordAktif) > 0){
				if($checkRecordAktif[0]->status == 1){
					$hasil=3;
				}elseif($checkRecordAktif[0]->status == 2){
					$hasil=4;
				}
				
			}else{
				if($numRecords==0){
					//$data_ktp['SIMPANKK']['DAFTARID'] = $data_post['SIMPANKK']["DAFTARID"];
					//$data_ktp['SIMPANKK']['NO_KK'] = $data_post['SIMPANKK']["NO_KK"];
					//$data_ktp['SIMPANKK']['NIK'] = $data_post['SIMPANKK']["NIK"];
					//$data_ktp['SIMPANKK']['NAMA_LGKP'] = $data_post['SIMPANKK']["NAMA_LGKP"];
					//$data_ktp['SIMPANKK']['NO_KEC'] = $data_post['SIMPANKK']["KEC"];
					//$data_ktp['SIMPANKK']['NO_KEL'] = $data_post['SIMPANKK']["KEL"];
					//$data_ktp['SIMPANKK']['ALASAN'] = $data_post['SIMPANKK']["ALASAN"];
					//$data_ktp['SIMPANKK']['SC_F106'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_F106"];
					//$data_ktp['SIMPANKK']['SC_PEKERJAAN'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_PEKERJAAN"];
					//$data_ktp['SIMPANKK']['SC_PENDIDIKAN'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_PENDIDIKAN"];
					//$data_ktp['SIMPANKK']['SC_AGAMA'] = 'upload/permohonan/kk/ubah_data/'.$data_post['SIMPANKK']["SC_AGAMA"];
					//$data_ktp['SIMPANKK']['AKUN'] = $data_post['SIMPANKK']["AKUN"];
					//$data_ktp['SIMPANKK']['DATA_UBAH'] = $data_post['SIMPANKK']["DATA_UBAH"];
					//$data_ktp['SIMPANKK']['STATUS'] = 1;
					$record=new Daftar_kk_model($data_post['SIMPANKK']);
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
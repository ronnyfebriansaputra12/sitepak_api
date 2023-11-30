<?php
Class wilayah extends CI_Controller{
	function getProp(){
		$data=Propinsi_model::get_criteria(["order"=>"no_prop"]);
		$hasil=["prop"=>[]];
		for($i=0;$i<count($data);$i++){
			$hasil["prop"][$i]=[$data[$i]->no_prop=>$data[$i]->no_prop." - ".$data[$i]->nama_prop];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
	function getKab(){
		$input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$prov=$data_post["prov"];
		$data=Kabupaten_model::get_criteria(["order"=>"no_kab","where"=>["no_prop"=>$prov],"select"=>"no_kab,nama_kab"]);
		$hasil=["kab"=>[]];
		for($i=0;$i<count($data);$i++){
			$hasil["kab"][$i]=[$data[$i]->no_kab=>$data[$i]->no_kab." - ".$data[$i]->nama_kab];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
	function getKec(){
		$input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$prov=$data_post["prov"];
		$kab=$data_post["kab"];
		$data=Kecamatan_model::get_criteria(["order"=>"no_kec","where"=>["no_prop"=>$prov,"no_kab"=>$kab],"select"=>"no_kec,nama_kec"]);
		$hasil=["kec"=>[]];
		for($i=0;$i<count($data);$i++){
			$hasil["kec"][$i]=[$data[$i]->no_kec=>$data[$i]->no_kec." - ".$data[$i]->nama_kec];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
	function getKel(){
		$input_data =file_get_contents('php://input');
		$data_post=json_decode($input_data, true);
		$prov=$data_post["prov"];
		$kab=$data_post["kab"];
		$kec=$data_post["kec"];
		$data=Kelurahan_model::get_criteria(["order"=>"no_kel","where"=>["no_prop"=>$prov,"no_kab"=>$kab,"no_kec"=>$kec],"select"=>"no_kel,nama_kel"]);
		$hasil=["kel"=>[]];
		for($i=0;$i<count($data);$i++){
			$hasil["kel"][$i]=[$data[$i]->no_kel=>$data[$i]->no_kel." - ".$data[$i]->nama_kel];
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
	}
}
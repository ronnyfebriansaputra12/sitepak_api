<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {	
	public function __construct(){
		call_user_func_array(array('parent', '__construct'), func_get_args());
	}
	
	function validateDateTime($dateStr, $format)
	{
		date_default_timezone_set('UTC');
		$date = DateTime::createFromFormat($format, $dateStr);
		return $date && ($date->format($format) === $dateStr);
	}
	
	public function check_nik_nkk($nik,$no_kk){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	NIK";
			$where = array();
			$where['NIK'] =$nik;
			$where['NO_KK'] =$no_kk;
			$where['FLAG_STATUS'] ="0";
			$all = Biodata_wni_model::count_criteria(array('select' => $select, 'where' => $where));
			if ($all == 1) {
				$criteria = array(
					'select' => $select,
					'where' => $where
				);
				$datum = Biodata_wni_model::get_criteria($criteria);
				
				/* $response['rtn'] = 1;
				$response['result'] = 'aa';
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($response); */
				return true;
			}else{
				/* $hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Data tidak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil); */
					return false;
			}
		}
	}
	
	public function get_nik_orang_tua($no_kk){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	NIK_KK";
			$where = array();
			$where['NO_KK'] =$no_kk;
			$all = Data_keluarga_model::count_criteria(array('select' => $select, 'where' => $where));
			if ($all == 1) {
				$criteria = array(
					'select' => $select,
					'where' => $where
				);
				$datum = Data_keluarga_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}

				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Data tidak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil);
					return;
			}
		}
	}

	public function get_anggota_keluarga($no_kk){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	NO_KK, NIK, NAMA_LGKP,
						TMPT_LHR, TO_CHAR(TGL_LHR, 'DD-MM-YYYY') AS TGLLHR,
						JENIS_KLMIN, DECODE (JENIS_KLMIN,  1, 'LAKI-LAKI',  2, 'PEREMPUAN') JK,
						STAT_KWN, UPPER (f5_get_ref_wni (stat_kwn, 601)) STAT_KWIN,
						PDDK_AKH, UPPER (f5_get_ref_wni (pddk_akh, 101)) PENDIDIKAN,
						AGAMA, UPPER (f5_get_ref_wni (f5_to_number (agama, 7), 501)) DAGAMA,
						JENIS_PKRJN, UPPER (f5_get_ref_wni (jenis_pkrjn, 201)) PEKERJAAN,
						GOL_DRH, UPPER (f5_get_ref_wni (f5_to_number (gol_drh, 7), 401)) GOLDRH,
						STAT_HBKEL, UPPER (f5_get_ref_wni (stat_hbkel, 301)) HBKEL,
						NO_PROP, NO_KAB, NO_KEC, NO_KEL,
						NAMA_LGKP_IBU, NAMA_LGKP_AYAH,
						getnamaprop(NO_PROP) AS PROP,
						getnamakab(NO_KAB, NO_PROP) AS KAB,
						getnamakec(NO_KEC, NO_KAB, NO_PROP) AS KEC_NAME,
						getnamakel(NO_KEL, NO_KEC, NO_KAB, NO_PROP) AS KEL_NAME";
			$where = array();
			$where['NO_KK'] =$no_kk;
			$where['FLAG_STATUS'] ="0";
			$order = "TGL_LHR ASC";
			$all = Biodata_wni_model::count_criteria(array('select' => $select, 'where' => $where, 'order' => $order));
			if ($all > 0) {
				$th = array();
				$criteria = array(
					'select' => $select,
					'where' => $where,
					'order' => $order
				);
				$datum = Biodata_wni_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}

				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Datatidfak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil);
					return;
			}
		}
	}
	
	public function get_biodata($nik){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	NO_KK, NIK, NAMA_LGKP,
						TMPT_LHR, TO_CHAR(TGL_LHR, 'DD-MM-YYYY') AS TGLLHR,
						JENIS_KLMIN, DECODE (JENIS_KLMIN,  1, 'LAKI-LAKI',  2, 'PEREMPUAN') JK,
						STAT_KWN, UPPER (f5_get_ref_wni (stat_kwn, 601)) STAT_KWIN,
						PDDK_AKH, UPPER (f5_get_ref_wni (pddk_akh, 101)) PENDIDIKAN,
						AGAMA, UPPER (f5_get_ref_wni (f5_to_number (agama, 7), 501)) DAGAMA,
						JENIS_PKRJN, UPPER (f5_get_ref_wni (jenis_pkrjn, 201)) PEKERJAAN,
						GOL_DRH, UPPER (f5_get_ref_wni (f5_to_number (gol_drh, 7), 401)) GOLDRH,
						STAT_HBKEL, UPPER (f5_get_ref_wni (stat_hbkel, 301)) HBKEL,
						NO_PROP, NO_KAB, NO_KEC, NO_KEL,
						NAMA_LGKP_IBU, NAMA_LGKP_AYAH,
						getnamaprop(NO_PROP) AS PROP,
						getnamakab(NO_KAB, NO_PROP) AS KAB,
						getnamakec(NO_KEC, NO_KAB, NO_PROP) AS KEC_NAME,
						getnamakel(NO_KEL, NO_KEC, NO_KAB, NO_PROP) AS KEL_NAME";
			$where = array();
			$where['NIK'] =$nik;
			$where['FLAG_STATUS'] ="0";
			$order = "TGL_LHR ASC";
			$all = Biodata_wni_model::count_criteria(array('select' => $select, 'where' => $where, 'order' => $order));
			if ($all > 0) {
				$th = array();
				$criteria = array(
					'select' => $select,
					'where' => $where,
					'order' => $order
				);
				$datum = Biodata_wni_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}

				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Datatidfak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil);
					return;
			}
		}
	}
	
	public function get_anggota_biodata_row($no_kk){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	NO_KK, NIK, NAMA_LGKP,
						TMPT_LHR, TO_CHAR(TGL_LHR, 'DD-MM-YYYY') AS TGLLHR,
						JENIS_KLMIN, DECODE (JENIS_KLMIN,  1, 'LAKI-LAKI',  2, 'PEREMPUAN') JK,
						STAT_KWN, UPPER (f5_get_ref_wni (stat_kwn, 601)) STAT_KWIN,
						PDDK_AKH, UPPER (f5_get_ref_wni (pddk_akh, 101)) PENDIDIKAN,
						AGAMA, UPPER (f5_get_ref_wni (f5_to_number (agama, 7), 501)) DAGAMA,
						JENIS_PKRJN, UPPER (f5_get_ref_wni (jenis_pkrjn, 201)) PEKERJAAN,
						GOL_DRH, UPPER (f5_get_ref_wni (f5_to_number (gol_drh, 7), 401)) GOLDRH,
						STAT_HBKEL, UPPER (f5_get_ref_wni (stat_hbkel, 301)) HBKEL,
						NO_PROP, NO_KAB, NO_KEC, NO_KEL,
						NAMA_LGKP_IBU, NAMA_LGKP_AYAH,
						getnamaprop(NO_PROP) AS PROP_NAME,
						getnamakab(NO_KAB, NO_PROP) AS KAB_NAME,
						getnamakec(NO_KEC, NO_KAB, NO_PROP) AS KEC_NAME,
						getnamakel(NO_KEL, NO_KEC, NO_KAB, NO_PROP) AS KEL_NAME";
			$where = array();
			$where['NO_KK'] =$no_kk;
			$where['FLAG_STATUS'] ="0";
			$order = "TGL_LHR ASC";
			$all = Biodata_wni_model::count_criteria(array('select' => $select, 'where' => $where, 'order' => $order));
			if ($all > 0) {
				$th = array();
				$criteria = array(
					'select' => $select,
					'where' => $where,
					'order' => $order
				);
				$datum = Biodata_wni_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}

				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Datatidfak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil);
					return;
			}
		}
	}
	
	public function get_anggota_biodata($no_kk){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	NO_KK, NIK, NAMA_LGKP,
						TMPT_LHR, TO_CHAR(TGL_LHR, 'DD-MM-YYYY') AS TGLLHR,
						JENIS_KLMIN, DECODE (JENIS_KLMIN,  1, 'LAKI-LAKI',  2, 'PEREMPUAN') JK,
						STAT_KWN, UPPER (f5_get_ref_wni (stat_kwn, 601)) STAT_KWIN,
						PDDK_AKH, UPPER (f5_get_ref_wni (pddk_akh, 101)) PENDIDIKAN,
						AGAMA, UPPER (f5_get_ref_wni (f5_to_number (agama, 7), 501)) DAGAMA,
						JENIS_PKRJN, UPPER (f5_get_ref_wni (jenis_pkrjn, 201)) PEKERJAAN,
						GOL_DRH, UPPER (f5_get_ref_wni (f5_to_number (gol_drh, 7), 401)) GOLDRH,
						STAT_HBKEL, UPPER (f5_get_ref_wni (stat_hbkel, 301)) HBKEL,
						NO_PROP, NO_KAB, NO_KEC, NO_KEL, NO_AKTA_KWN, TGL_KWN,
						NAMA_LGKP_IBU, NAMA_LGKP_AYAH,
						getnamaprop(NO_PROP) AS PROP_NAME,
						getnamakab(NO_KAB, NO_PROP) AS KAB_NAME,
						getnamakec(NO_KEC, NO_KAB, NO_PROP) AS KEC_NAME,
						getnamakel(NO_KEL, NO_KEC, NO_KAB, NO_PROP) AS KEL_NAME";
			$where = array();
			$where['NO_KK'] =$no_kk;
			$where['FLAG_STATUS'] ="0";
			$order = "TGL_LHR ASC";
			$all = Biodata_wni_model::count_criteria(array('select' => $select, 'where' => $where, 'order' => $order));
			if ($all > 0) {
				$th = array();
				$criteria = array(
					'select' => $select,
					'where' => $where,
					'order' => $order
				);
				$datum = Biodata_wni_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}

				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($response);
				return;
			}else{
				$hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Datatidfak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil);
					return;
			}
		}
	}
	
	public function get_kepala_keluarga($no_kk){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			
			$where = array();
			$where['NO_KK'] =$no_kk;
			$where['FLAG_STATUS'] ="0";
			$where['STAT_HBKEL'] ="1";
			$all = Biodata_wni_model::count_criteria(array( 'where' => $where));
			if ($all > 0) {
				$th = array();
				$criteria = array(
					'where' => $where
				);
				$datum = Biodata_wni_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}

				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$hasil =array();
					$hasil['status'] =0;
					$hasil['pesan'] ="Datatidfak ditemukan";
					$this->output->set_content_type('application/json');
					echo json_encode($hasil);
					return;
			}
		}
	}
	
	public function get_status_code($nik){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	CURRENT_STATUS_CODE";
			$where = array();
			$where['NIK'] =$nik;
			$all = Demographics_lokal_model::count_criteria(array('select' => $select, 'where' => $where));
			if ($all == 1) {
				$criteria = array(
					'select' => $select,
					'where' => $where
				);
				$datum = Demographics_lokal_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}
				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$criteria = array(
					'select' => $select,
					'where' => $where
				);
				$datum = Demographics_orcl_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}
				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}
		}
	}
	
	public function get_current_status_code($nik){//sudah
		$input_data =file_get_contents('php://input');
		if($this->input->method() == "post") {
			$select ="	CURRENT_STATUS_CODE, NIK, NAMA_LGKP";
			$where = array();
			$where['NIK'] =$nik;
			$all = Demographics_lokal_model::count_criteria(array('select' => $select, 'where' => $where));
			if ($all == 1) {
				$criteria = array(
					'select' => $select,
					'where' => $where
				);
				$datum = Demographics_lokal_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}
				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}else{
				$criteria = array(
					'select' => $select,
					'where' => $where
				);
				$datum = Demographics_orcl_model::get_criteria($criteria);
				foreach ($datum as $index => $data) {
					$th[$index] = array_change_key_case($data->to_array(),CASE_UPPER);
					
				}
				$response['rtn'] = 1;
				$response['result'] = $th;
				$this->output->set_status_header(200, 'Ok');
				echo json_encode($th);
				return;
			}
		}
	}
}

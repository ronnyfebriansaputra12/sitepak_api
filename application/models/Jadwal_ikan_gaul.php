<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Jadwal_ikan_gaul extends MY_Model
{
	static $table_name = 'JADWAL_IKAN_GAUL';
	static $primary_key = array('id');
	static $before_create = array("sebelum_insert");
	static $before_update=array("sebelum_update");	

	function sebelum_insert()
	{
		//$this->created_by=MY_Model::CI->session->userdata('user_name');
		//$this->akun=MY_Model::$CI->session_activerecord->userdata("user_id");
		$this->tgl_permohonan = ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT, date(ActiveRecord\DateTime::$DEFAULT_FORMAT));
		$this->tgl_update = ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT, date(ActiveRecord\DateTime::$DEFAULT_FORMAT));
	}

	function sebelum_update()
	{
		//$this->modified_by=MY_Model::CI->session->userdata('user_name');
		//$attributes=$this->attributes();
		//$this->modified_by=MY_Model::$CI->session_activerecord->userdata("user_id");
		//$this->modified_date=ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT,date(ActiveRecord\DateTime::$DEFAULT_FORMAT));
	}

	function show($id)
	{
	  $this->db->where("ID", $id);
	  $this->db->from("JADWAL_IKAN_GAUL");
	  return $this->db->get();
	}
}

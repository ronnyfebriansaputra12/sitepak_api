<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tgl_libur_model extends MY_Model {	
	static $table_name='tgl_libur';
	static $primary_key=array('id');
	static $before_create=array("sebelum_insert");	
	static $before_update=array("sebelum_update");	
	
	function sebelum_insert(){
		$this->created_by=MY_Model::$CI->session_activerecord->userdata("user_id");
		$this->tgl_created=ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT,date(ActiveRecord\DateTime::$DEFAULT_FORMAT));
		$this->modified_by=MY_Model::$CI->session_activerecord->userdata("user_id");
		$this->tgl_modified=ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT,date(ActiveRecord\DateTime::$DEFAULT_FORMAT));
	}
	
	function sebelum_update(){
		$attributes=$this->attributes();
		$this->modified_by=MY_Model::$CI->session_activerecord->userdata("user_id");
		$this->tgl_modified=ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT,date(ActiveRecord\DateTime::$DEFAULT_FORMAT));
	}
}
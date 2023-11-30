<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Widget{
	function __construct(){
		$this->CI =& get_instance();		
	}
	function add(){
		return $this->CI->akses;
		//return $this->CI->load->view('backend/widget/add',true);
	}
	function daftar(){
		return $this->CI->load->view('backend/widget/daftar',true);
	}
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."/third_party/PHPExcel.php";
class Excelso extends PHPExcel{
	public function __construct(){
		parent::__construct();
	}

	public function get_template_file($path){
		$realpath ='';
		$template ="/file_pedukung/xls/";
		$temp ='';
		$cek_pathisurl =strrpos($path, base_url());
		if($cek_pathisurl){
			$temp =str_replace(base_url(), '/', $path);
		}else{
			$temp =$path;
		}
		$template.=$temp;
		$cek_environtment =strrpos(strtoupper(php_uname()), 'WINDOWS');
		if($cek_environtment){
			$realpath =str_replace('/', '\\', $template);
		}else{
			$realpath =$template;
		}
		return getcwd().trim($realpath);
	}
}
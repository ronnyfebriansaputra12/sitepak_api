<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Svc_siakdwhnas{
	private $CI='';
	public $online=true;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->spark('curl/1.3.0');
		$this->CI->load->config('svc_siakdwhnas',true);
		$this->config=$this->CI->config->item('svc_siakdwhnas');
	}
	
	function _getValueData($keyName){
		$criteria = array();
		$criteria["NAMA"] = $keyName;
		$columnz = "NAMA,VALUEZ1";
		$result = Fpd2k_conf_aplikasi_model::get_criteria(array('conditions'=>$criteria,'select'=>$columnz));
		if(count($result) > 0){
			return $result[0]->valuez1;
		}
		return "";	
	}
	
	function getFoto($nik){
		$this->_set_param_http();
		$this->CI->curl->http_login('4dm1nduk','kos0ng', 'basic');
		$url_array=parse_url($this->_getValueData("FPD2K_WEB_SERVICE_PHOTO"));
		//print_r($url_array);
		$this->CI->curl->option(CURLOPT_PORT,$url_array['port']);
		$hasil=false;
		if($this->online){
			$hasil=$this->CI->curl->simple_get($url_array['scheme'].'://'.$url_array['host'].$url_array['path'].'?nik='.$nik);
		}
		//$this->CI->curl->debug();
		return $hasil;
	}
	function getTtd($nik){
		$this->_set_param_http();
		$this->CI->curl->http_login('4dm1nduk','kos0ng', 'basic');
		$url_array=parse_url($this->_getValueData("FPD2K_WEB_SERVICE_SIGN"));
		//print_r($url_array);
		$this->CI->curl->option(CURLOPT_PORT,$url_array['port']);
		$hasil=false;
		if($this->online){
			$hasil=$this->CI->curl->simple_get($url_array['scheme'].'://'.$url_array['host'].$url_array['path'].'?nik='.$nik);
		}
		//$this->CI->curl->debug();
		return $hasil;
	}
	function post($url,$param){
		$this->_set_param_http();
		$hasil=false;
		if($this->online){
			$hasil=$this->CI->curl->simple_post($this->config['nfs2_url_name'].$url,$param);
		}
		return $hasil;
	}

	function get($url,$param){
		$this->_set_param_http();
		$hasil=false;
		if($this->online){
			$hasil=$this->CI->curl->simple_get($this->config['nfs2_url_name'].$url,$param);
		}
		return $hasil;
	}
	function _set_param_http(){
		$this->CI->curl->option(CURLOPT_COOKIESESSION,true);
		$this->CI->curl->option(CURLOPT_COOKIEJAR,getcwd().'/'.APPPATH.'cookies.txt');
		$this->CI->curl->option(CURLOPT_COOKIEFILE,getcwd().'/'.APPPATH.'cookies.txt');
		$this->CI->curl->option(CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');
		$this->CI->curl->option(CURLOPT_ENCODING,'gzip,deflate');
		$this->CI->curl->option(CURLOPT_RETURNTRANSFER,1);
		$this->CI->curl->option(CURLOPT_TIMEOUT,$this->config['nfs2_conn_timeout']);
		$this->CI->curl->option(CURLOPT_PORT,$this->config['nfs2_url_port']);
		$this->CI->curl->option(CURLOPT_FRESH_CONNECT, TRUE);
		$this->CI->curl->http_header('Accept','text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5');
		$this->CI->curl->http_header('Cache-Control','no-cache');
		$this->CI->curl->http_header('Connection','keep-alive');
		$this->CI->curl->http_header('Keep-Alive','300');
		$this->CI->curl->http_header('Accept-Charset','ISO-8859-1,utf-8;q=0.7,*;q=0.7');
		$this->CI->curl->http_header('Accept-Language','en-us,en;q=0.5');
		$this->CI->curl->http_header('Pragma');
		$this->CI->curl->http_header('X-Requested-With','XMLHttpRequest');
	}	
}

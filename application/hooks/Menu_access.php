<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_access{
	public function __construct(){
       //$this->CI =& get_instance();
    }
	function GetAccess(){
		$this->CI =& get_instance();		
		$list_applet=array();
		
		if(!in_array($this->CI->router->fetch_directory().$this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method(),$list_applet) && $this->CI->router->fetch_directory() !='cli/'){
			
			$this->CI->load->library('session_activerecord',array('sess_expiration'=>$this->CI->siakconfig->getSessMax(),'sess_time_to_update'=>$this->CI->siakconfig->getSessAuto()));			
			$list_nonajax=array('apps/dologin',
								'apps/doLogout',
								'apps/index',
								'apps/capcha',
								'apps/key',
								'apps/update_data/doUpdate',
								'search_biodata_wni/pencarian_nik/doCaptcha',
								'cli/telegram/registrasitelegram',
								'cli/telegram/updatesingledata',
								'cli/telegram/updatedatacsv');			
			if(!in_array($this->CI->router->fetch_directory().$this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method(),$list_nonajax)){
				$this->CI->load->library('Siak_menu');
				if(!$this->CI->input->is_ajax_request()){
					//echo $this->CI->router->fetch_directory();
					echo $this->CI->siak_menu->get_page_error('Anda tidak diperbolehkan buka langsung dari browser. Silahkan <a href="'.base_url().'apps">kembali melanjutkan</a>.');					
					exit;
				}else{
					//$this->CI->load->library('SiakLib');
					if(!$this->CI->session_activerecord->userdata('user_id')){
						echo $this->CI->siak_menu->error_status('Session anda telah berakhir silahkan <a href="'.base_url().'">login kembali</a>');												
						exit;	
					}else{
						$this->CI->load->library('Siak_menu');
						if(!$this->CI->siak_menu->cek_access($this->CI->router->fetch_directory().$this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method())){
							echo $this->CI->siak_menu->error_status('Anda tidak diperbolehkan mengakses menu ini. Silahkan <a href="'.base_url().'apps">kembali melanjutkan</a>.');							
							exit;	
						}
					}
				}
			}else{
				$this->CI->load->library('Siak_key');
				if($this->CI->router->fetch_directory().$this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method()=='apps/dologin'){
					if($this->CI->session_activerecord->userdata('user_id')){
						redirect(base_url().'apps');	
					}else{						
						if(!$this->CI->siak_key->key_valid() || !property_exists($this->CI->siak_key,"key_tdk")){
							redirect(base_url().'apps/key');		
						}
					}					
				}else if($this->CI->router->fetch_directory().$this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method()=='apps/key' && $this->CI->siak_key->key_valid()){
					redirect(base_url().'apps');					
				}
				if($this->CI->router->fetch_directory().$this->CI->router->fetch_class().'/'.$this->CI->router->fetch_method()=='apps/index' && !$this->CI->session_activerecord->userdata('user_id')){
					redirect(base_url());
				}
			}
		}elseif($this->CI->router->fetch_directory()=='cli/'){
			if(!$this->CI->input->is_cli_request()){
				echo $this->CI->router->fetch_directory();
				echo $this->CI->siak_menu->get_page_error('Anda tidak diperbolehkan buka langsung dari browser. Silahkan <a href="'.base_url().'apps">kembali melanjutkan</a>.');					
				exit;		
			}else{			
				
			}			
		}

	}   
	function GetAccessBackend(){		
		if(isset($_GET['session_id'])){
			if(isset($_SERVER['HTTP_ORIGIN'])) {
				header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
			}
			header('Access-Control-Allow-Credentials: true');				
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Allow-Header: Origin, X-Requested-With, Content-Type, Accept');	
		}
	}
}
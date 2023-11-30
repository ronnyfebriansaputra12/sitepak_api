<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Widget_wilayah{
	var $auth=false;
	var $tingkat=null;
	function __construct($param=array()){
		$this->CI=& get_instance();				
		if(isset($param['auth'])){
			$this->auth=$param['auth'];
		}
		if(isset($param['tingkat'])){
			$this->tingkat=$param['tingkat'];	
		}
	}	
	function begin_wiget($opsi,$url){		
		if(isset($opsi['form_id'])){
			$form_id=$opsi['form_id'];
			unset($opsi['form_id']);			
		}
		$js_opsi=array();
		foreach($opsi as $variabel=>$wilayah){
			$js_opsi[$variabel]=(isset($form_id)?'#'.$form_id.' ':'').'[id="'.$wilayah.'"]';
			$this->{$variabel}=$wilayah;
		}		
		return $this->CI->load->view('backend/widget/awal_wilayah',array('opsi'=>$js_opsi,'url'=>$url),true);	
	}
	function get_propinsi($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<1){
			$this->auth=false;
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data_awal=isset($opsi['data_awal']['NO_PROP'])?$opsi['data_awal']['NO_PROP']:'0';		
		if($this->auth){			
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>1 && $this->CI->session->userdata('no_prop')!='0'){
				$data_awal=$this->CI->session->userdata('no_prop');			
			}elseif(base_convert($this->CI->session->userdata('group_level'),36,10)==1 && !isset($opsi['data_awal']['NO_PROP'])){
				$no_prop=explode(',',$this->CI->session->userdata('no_prop'));
				$data_awal=$no_prop[0];
			}
		}			
		$hasil=$this->_array_propinsi();		
		$param='data-id="NO_PROP"';
		if(isset($this->prop)){
			$param.=' id="'.$this->prop.'"';			
		}		
		$param.=isset($opsi['param'])?$opsi['param']:'';		
		if(is_numeric($data_awal)){
			return form_dropdown($opsi['name'],$hasil,$data_awal,$param);	
		}else{
			$param.=' multiple="multiple"';			
			$data_array=explode(',', $data_awal);
			$param.=' data-value="'.$data_array[0].'"';			
			return form_multiselect($opsi['name'],$hasil,$data_array,$param);		
		}			
			
	}
	function get_kabupaten($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<2){
			$this->auth=false;
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data_awal=isset($opsi['data_awal']['NO_KAB'])?$opsi['data_awal']['NO_KAB']:'0';
		if($this->auth){
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>3 && $this->CI->session->userdata('no_kab')!='0'){
				$data_awal=$this->CI->session->userdata('no_kab');			
			}elseif (base_convert($this->CI->session->userdata('group_level'),36,10)==3 && !isset($opsi['data_awal']['NO_KAB'])) {
				$no_kab=explode(',',$this->CI->session->userdata('no_kab'));
				$data_awal=$no_kab[0];			
			}
		}	
		$hasil=$this->_array_kabupaten($opsi);
		$param='data-id="NO_KAB"';
		if(isset($this->kab)){
			$param.=' id="'.$this->kab.'"';							
		}			
		$param.=isset($opsi['param'])?$opsi['param']:'';			
		if(is_numeric($data_awal)){
			return form_dropdown($opsi['name'],$hasil,$data_awal,$param);	
		}else{
			$param.=' multiple="multiple"';						
			$data_array=explode(',', $data_awal);
			$param.=' data-value="'.$data_array[0].'"';			
			return form_multiselect($opsi['name'],$hasil,$data_array,$param);		
		}
	}
	function get_kecamatan($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<3){
			$this->auth=false;
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data_awal=isset($opsi['data_awal']['NO_KEC'])?$opsi['data_awal']['NO_KEC']:'0';
		if($this->auth){
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>5 && $this->CI->session->userdata('no_kec')!='0'){
				$data_awal=$this->CI->session->userdata('no_kec');			
			}elseif (base_convert($this->CI->session->userdata('group_level'),36,10)==5 && !isset($opsi['data_awal']['NO_KEC'])) {				
				$no_kec=explode(',',$this->CI->session->userdata('no_kec'));
				$data_awal=$no_kec[0];
			}
		}		
		$hasil=$this->_array_kecamatan($opsi);
		$param='data-id="NO_KEC"';
		if(isset($this->kec)){
			$param.=' id="'.$this->kec.'"';		
		}		
		$param.=isset($opsi['param'])?$opsi['param']:'';	
		if(is_numeric($data_awal)){
			return form_dropdown($opsi['name'],$hasil,$data_awal,$param);	
		}else{
			$param.=' multiple="multiple"';			
			$data_array=explode(',', $data_awal);
			$param.=' data-value="'.$data_array[0].'"';			
			return form_multiselect($opsi['name'],$hasil,$data_array,$param);		
		}
	}
	function get_kelurahan($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<4){
			$this->auth=false;
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data_awal=isset($opsi['data_awal']['NO_KEL'])?$opsi['data_awal']['NO_KEL']:'0';	
		if($this->auth){
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>7 && $this->CI->session->userdata('no_kel')!='0'){
				$data_awal=$this->CI->session->userdata('no_kel');			
			}elseif(base_convert($this->CI->session->userdata('group_level'),36,10)==7 && !isset($opsi['data_awal']['NO_KEL'])){
				$no_kel=explode(',',$this->CI->session->userdata('no_kel'));
				$data_awal=$no_kel[0];
			}
		}
		$hasil=$this->_array_kelurahan($opsi);	
		$param='data-id="NO_KEL"';
		if(isset($this->kel)){
			$param.=' id="'.$this->kel.'"';		
		}
		$param.=isset($opsi['param'])?$opsi['param']:'';	
		if(is_numeric($data_awal)){
			return form_dropdown($opsi['name'],$hasil,$data_awal,$param);	
		}else{
			$param.=' multiple="multiple"';
			$data_array=explode(',', $data_awal);
			$param.=' data-value="'.$data_array[0].'"';			
			return form_multiselect($opsi['name'],$hasil,$data_array,$param);		
		}
	}
	function get_rw($opsi){
		$hasil=array();		
		$data_awal=isset($opsi['data_awal']['NO_RW'])?$opsi['data_awal']['NO_RW']:'';			
		$hasil=$this->_array_rw($opsi);	
		$param='data-id="NO_RW"';
		if(isset($this->rw)){
			$param.=' id="'.$this->rw.'"';			
		}		
		$param.=isset($opsi['param'])?$opsi['param']:'';	
		return form_dropdown($opsi['name'],$hasil,$data_awal,$param);			
	}
	function get_dusun($opsi){
		$hasil=array();		
		$data_awal=isset($opsi['data_awal']['DUSUN'])?$opsi['data_awal']['DUSUN']:'';			
		$hasil=$this->_array_dusun($opsi);	
		$param='data-id="DUSUN"';
		if(isset($this->dusun)){
			$param.=' id="'.$this->dusun.'"';			
		}		
		$param.=isset($opsi['param'])?$opsi['param']:'';	
		return form_dropdown($opsi['name'],$hasil,$data_awal,$param);			
	}
	function get_rt($opsi){
		$hasil=array();		
		$data_awal=isset($opsi['data_awal']['NO_RT'])?$opsi['data_awal']['NO_RT']:'';			
		$hasil=$this->_array_rt($opsi);	
		$param='data-id="NO_RT"';
		if(isset($this->rt)){
			$param.=' id="'.$this->rt.'"';			
		}		
		$param.=isset($opsi['param'])?$opsi['param']:'';	
		return form_dropdown($opsi['name'],$hasil,$data_awal,$param);			
	}
	function get_instansi($opsi){
		$hasil=array();
		$data=array();
		$data_awal=isset($opsi['data_awal']['id_instansi'])?$opsi['data_awal']['id_instansi']:'0';
		if(!$this->auth){
			$hasil['0']='==PILIH INSTANSI==';
			$data=Fpd2k_instansi_model::get_criteria(array('order'=>'ID_INSTANSI'));
		}else{
			if(base_convert($this->CI->session->userdata('group_level'),36,10)==9){
				$data=Fpd2k_instansi_model::get_criteria(array('where'=>array('ID_INSTANSI'=> $this->CI->session->userdata('id_instansi'))));
			}else{
				$hasil['0']='==PILIH INSTANSI==';
				$data=Fpd2k_instansi_model::get_criteria(array('order'=>'ID_INSTANSI'));	
			}
		}
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->id_instansi]=$data[$i]->instansi_name.' ('.$data[$i]->instansi_kategori->category_name.')';
		}
		$param=isset($opsi['param'])?$opsi['param']:'';
		return form_dropdown($opsi['name'],$hasil,$data_awal,$param);	
	}
	function get_konjen($opsi){
		$hasil=array();
		$data=array();
		$data_awal=isset($opsi['data_awal']['kode_konjen'])?$opsi['data_awal']['kode_konjen']:'0';
		if(!$this->auth){
			$hasil['']='==PILIH KONJEN==';
			$data=T5_konjen_model::get_criteria(array('order'=>'NAMA_KONJEN'));
		}else{
			if(base_convert($this->CI->session->userdata('group_level'),36,10)==10){
				$data=T5_konjen_model::get_criteria(array('where'=>array('KODE_KONJEN'=> $this->CI->session->userdata('kode_konjen'))));
			}else{
				$hasil['']='==PILIH KONJEN==';
				$data=T5_konjen_model::get_criteria(array('order'=>'NAMA_KONJEN'));	
			}
		}
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->kode_konjen]=$data[$i]->nama_konjen;
		}
		$param=isset($opsi['param'])?$opsi['param']:'';
		return form_dropdown($opsi['name'],$hasil,$data_awal,$param);	
	}
	function _array_propinsi(){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<1){
			$this->auth=false;
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		if(!$this->auth){
			$hasil['0']='==PILIH PROVINSI==';
			$data=Propinsi_model::get_criteria(array('order'=>'NO_PROP'));				
		}else{
			$data=array();
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>1 && $this->CI->session->userdata('no_prop')!='0'){//group level diatas 1 untuk satu propinsi
				$data_awal=$this->CI->session->userdata('no_prop');			
				$data=Propinsi_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'))));
			}else{			
				$hasil['0']='==PILIH PROVINSI==';
				if(base_convert($this->CI->session->userdata('group_level'),36,10)==1){//group level satu untuk beberapa propinsi			
					$data=Propinsi_model::get_criteria(array('where'=>(array('NO_PROP IN'=>explode(',',$this->CI->session->userdata('no_prop')))),'order'=>'NO_PROP'));
				}elseif(base_convert($this->CI->session->userdata('group_level'),36,10)==0){//group level 0 untuk satu indonesia
					$data=Propinsi_model::get_criteria(array('order'=>'NO_PROP'));				
				}else{						
					$data=Propinsi_model::get_criteria(array('order'=>'NO_PROP'));			
				}
			}
		}								
		for($i=0;$i<count($data);$i++){		
			$hasil[$data[$i]->no_prop]=$data[$i]->nama_prop.' ('.$data[$i]->no_prop.')';
		}
		return $hasil;
	}
	function _array_kabupaten($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<2){
			$this->auth=false;
			if($this->tingkat==1){
				$opsi['data_awal']['NO_PROP']=$this->CI->session->userdata('no_prop');				
			}			
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data=array();	
		if(!$this->auth){
			if(isset($opsi['data_awal']['NO_PROP'])){				
				$data=Kabupaten_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP']),'order'=>'NO_KAB'));				
			}else{
				$data=array();				
			}
			$hasil['0']='==PILIH KABUPATEN/KOTA==';			
		}else{
			$data=array();
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>3 && $this->CI->session->userdata('no_kab')!='0'){//group level satu kabupaten
				$data=Kabupaten_model::get_criteria(array('where'=>(array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab')))));
			}else{				
				if(base_convert($this->CI->session->userdata('group_level'),36,10)==3){//group level beberapa kabupaten			
					$data=Kabupaten_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB IN'=>explode(',',$this->CI->session->userdata('no_kab'))),'order'=>'NO_KAB'));
				}else{//group level propinsi atau yg diatasnya
					$hasil['0']='==PILIH KABUPATEN/KOTA==';
					if(base_convert($this->CI->session->userdata('group_level'),36,10)==2){
						$data=Kabupaten_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop')),'order'=>'NO_KAB'));
					}elseif(base_convert($this->CI->session->userdata('group_level'),36,10)==1 && !isset($opsi['data_awal']['NO_PROP'])){
						$no_prop=explode(',',$this->CI->session->userdata('no_prop'));
						$data=Kabupaten_model::get_criteria(array('where'=>array('NO_PROP'=>$no_prop[0]),'order'=>'NO_KAB'));				
					}elseif(isset($opsi['data_awal']['NO_PROP'])){
						if(is_numeric($opsi['data_awal']['NO_PROP']) && $opsi['data_awal']['NO_PROP']!=0){
							$data=Kabupaten_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP']),'order'=>'NO_KAB'));					
						}					
					}elseif($this->CI->session->userdata('no_prop')!='0' && is_numeric($this->CI->session->userdata('no_prop'))){
						$data=Kabupaten_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop')),'order'=>'NO_KAB'));					
					}
				}
			}			
		}			
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->no_kab]=$data[$i]->nama_kab.' ('.$data[$i]->no_kab.')';
		}
		return $hasil;
	}
	function _array_kecamatan($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<3){
			$this->auth=false;
			if($this->tingkat==2){
				$opsi['data_awal']['NO_PROP']=$this->CI->session->userdata('no_prop');
				$opsi['data_awal']['NO_KAB']=$this->CI->session->userdata('no_kab');	
			}			
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data=array();		
		if(!$this->auth){
			$hasil['0']='==PILIH KECAMATAN==';
			if(isset($opsi['data_awal']['NO_KAB'])){
				if(is_numeric($opsi['data_awal']['NO_KAB'])){
					$data=Kecamatan_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB']),'order'=>'NO_KEC'));							
				}			
			}
		}else{			
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>5 && $this->CI->session->userdata('no_kec')!='0'){//group level satu kecamatan
				$data=Kecamatan_model::get_criteria(array('where'=>(array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec')))));
			}else{				
				if(base_convert($this->CI->session->userdata('group_level'),36,10)==5){//group level beberapa kecamatan			
					$data=Kecamatan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC IN'=>explode(',',$this->CI->session->userdata('no_kec'))),'order'=>'NO_KEC'));
				}else{//group level kabupaten atau yg diatasnya
					$hasil['0']='==PILIH KECAMATAN==';
					if(base_convert($this->CI->session->userdata('group_level'),36,10)==4){
						$data=Kecamatan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab')),'order'=>'NO_KEC'));				
					}elseif(base_convert($this->CI->session->userdata('group_level'),36,10)==3 && !isset($opsi['data_awal']['NO_KAB'])){
						$no_kab=explode(',',$this->CI->session->userdata('no_kab'));
						$data=Kecamatan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$no_kab[0]),'order'=>'NO_KEC'));
					}elseif(isset($opsi['data_awal']['NO_KAB'])){
						if(is_numeric($opsi['data_awal']['NO_KAB']) && $opsi['data_awal']['NO_KAB']!=0){
							$data=Kecamatan_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB']),'order'=>'NO_KEC'));												
						}						
					}elseif($this->CI->session->userdata('no_kab')!='0' && is_numeric($this->CI->session->userdata('no_kab'))){
						$data=Kecamatan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab')),'order'=>'NO_KEC'));						
					}	
				}
			}
		}			
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->no_kec]=$data[$i]->nama_kec.' ('.$data[$i]->no_kec.')';
		}
		return $hasil;
	}
	function _array_kelurahan($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat<4){
			$this->auth=false;
			if($this->tingkat==3){
				$opsi['data_awal']['NO_PROP']=$this->CI->session->userdata('no_prop');
				$opsi['data_awal']['NO_KAB']=$this->CI->session->userdata('no_kab');			
				$opsi['data_awal']['NO_KEC']=$this->CI->session->userdata('no_kec');	
			}			
		}elseif(!is_null($this->tingkat)){
			$this->auth=true;
		}
		$data=array();
		if(!$this->auth){
			$hasil['0']='==PILIH KELURAHAN/DESA==';
			if(isset($opsi['data_awal']['NO_KEC'])){				
				$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC']),'order'=>'NO_KEL'));				
			}
		}else{
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>7 && $this->CI->session->userdata('no_kel')){//group level satu kelurahan
				$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'))));
			}else{			
				if(base_convert($this->CI->session->userdata('group_level'),36,10)==7){//group level beberapa kelurahan			
					$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL IN'=>explode(',',$this->CI->session->userdata('no_kel'))),'order'=>'NO_KEL'));
				}else{//group level kecamatan atau yg diatasnya
					$hasil['0']='==PILIH KELURAHAN/DESA==';
					if(base_convert($this->CI->session->userdata('group_level'),36,10)==6){
						$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec')),'order'=>'NO_KEL'));
					}elseif(base_convert($this->CI->session->userdata('group_level'),36,10)==5 && !isset($opsi['data_awal']['NO_KEC'])){
						$no_kec=explode(',',$this->CI->session->userdata('no_kec'));
						$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$no_kec[0]),'order'=>'NO_KEL'));	
					}elseif(isset($opsi['data_awal']['NO_KEC'])){
						if(is_numeric($opsi['data_awal']['NO_KEC']) && $opsi['data_awal']['NO_KEC']!=0){
							$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC']),'order'=>'NO_KEL'));																			
						}						
					}elseif($this->CI->session->userdata('no_kec')!='0' && is_numeric($this->CI->session->userdata('no_kec'))){
						$data=Kelurahan_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec')),'order'=>'NO_KEC'));						
					}	
				}
			}
		}
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->no_kel]=$data[$i]->nama_kel.' ('.$data[$i]->no_kel.')';
		}
		return $hasil;
	}
	function _array_rw($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat==4){
			$opsi['data_awal']['NO_PROP']=$this->CI->session->userdata('no_prop');
			$opsi['data_awal']['NO_KAB']=$this->CI->session->userdata('no_kab');			
			$opsi['data_awal']['NO_KEC']=$this->CI->session->userdata('no_kec');
			$opsi['data_awal']['NO_KEL']=$this->CI->session->userdata('no_kel');			
		}
		$data=array();
		if(!$this->auth){
			$hasil['']='==PILIH RW==';
			if(isset($opsi['data_awal']['NO_KEL'])){				
				$data=Ref_rw_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC'],'NO_KEL'=>$opsi['data_awal']['NO_KEL'],'ST_ACTIVE'=>'Y'),'order'=>'NO_RW'));				
			}
		}else{
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>8 && $this->CI->session->userdata('no_kel')){//group level satu kelurahan
				$data=Ref_rw_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'),'ST_ACTIVE'=>'Y'),'order'=>'NO_RW'));
			}else{							
				$hasil['']='==PILIH RW==';
				if(base_convert($this->CI->session->userdata('group_level'),36,10)==8){
					$data=Ref_rw_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'),'ST_ACTIVE'=>'Y'),'order'=>'NO_RW'));
				}elseif(isset($opsi['data_awal']['NO_KEL'])){
					if(is_numeric($opsi['data_awal']['NO_KEL']) && $opsi['data_awal']['NO_KEL']!=0){
						$data=Ref_rw_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC'],'NO_KEL'=>$opsi['data_awal']['NO_KEL'],'ST_ACTIVE'=>'Y'),'order'=>'NO_RW'));																			
					}						
				}elseif($this->CI->session->userdata('no_kel')!='0' && is_numeric($this->CI->session->userdata('no_kel'))){
					$data=Ref_rw_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'),'ST_ACTIVE'=>'Y'),'order'=>'NO_RW'));						
				}				
			}
		}
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->no_rw]=str_pad ( $data[$i]->no_rw , 3, '0', STR_PAD_LEFT);
		}
		return $hasil;
	}
	function _array_dusun($opsi){
		$hasil=array();
		if(!is_null($this->tingkat) && $this->tingkat==4){
			$opsi['data_awal']['NO_PROP']=$this->CI->session->userdata('no_prop');
			$opsi['data_awal']['NO_KAB']=$this->CI->session->userdata('no_kab');			
			$opsi['data_awal']['NO_KEC']=$this->CI->session->userdata('no_kec');
			$opsi['data_awal']['NO_KEL']=$this->CI->session->userdata('no_kel');			
		}
		$data=array();
		if(!$this->auth){
			$hasil['']='==PILIH DUSUN==';
			if(isset($opsi['data_awal']['NO_KEL'])){				
				$data=Ref_dusun_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC'],'NO_KEL'=>$opsi['data_awal']['NO_KEL'],'ST_ACTIVE'=>'Y'),'order'=>'NAMA_DUSUN'));				
			}
		}else{
			if(base_convert($this->CI->session->userdata('group_level'),36,10)>8 && $this->CI->session->userdata('no_kel')){//group level satu kelurahan
				$data=Ref_dusun_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'),'ST_ACTIVE'=>'Y'),'order'=>'NAMA_DUSUN'));
			}else{							
				$hasil['']='==PILIH DUSUN==';
				if(base_convert($this->CI->session->userdata('group_level'),36,10)==8){
					$data=Ref_dusun_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'),'ST_ACTIVE'=>'Y'),'order'=>'NAMA_DUSUN'));
				}elseif(isset($opsi['data_awal']['NO_KEL'])){
					if(is_numeric($opsi['data_awal']['NO_KEL']) && $opsi['data_awal']['NO_KEL']!=0){
						$data=Ref_dusun_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC'],'NO_KEL'=>$opsi['data_awal']['NO_KEL'],'ST_ACTIVE'=>'Y'),'order'=>'NAMA_DUSUN'));																			
					}						
				}elseif($this->CI->session->userdata('no_kel')!='0' && is_numeric($this->CI->session->userdata('no_kel'))){
					$data=Ref_dusun_model::get_criteria(array('where'=>array('NO_PROP'=>$this->CI->session->userdata('no_prop'),'NO_KAB'=>$this->CI->session->userdata('no_kab'),'NO_KEC'=>$this->CI->session->userdata('no_kec'),'NO_KEL'=>$this->CI->session->userdata('no_kel'),'ST_ACTIVE'=>'Y'),'order'=>'NAMA_DUSUN'));						
				}				
			}
		}
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->nama_dusun]=$data[$i]->nama_dusun;
		}
		return $hasil;
	}
	function _array_rt($opsi){
		$hasil=array();		
		$data=array();
		if(!$this->auth){
			$hasil['']='==PILIH RT==';
			if(isset($opsi['data_awal']['NO_RW'])){				
				$data=Ref_rt_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC'],'NO_KEL'=>$opsi['data_awal']['NO_KEL'],'NO_RW'=>$opsi['data_awal']['NO_RW'],'ST_ACTIVE'=>'Y'),'order'=>'NO_RT'));				
			}
		}else{
			$hasil['']='==PILIH RT==';
			if(isset($opsi['data_awal']['NO_RW'])){
				if(is_numeric($opsi['data_awal']['NO_RW'])){
					$data=Ref_rt_model::get_criteria(array('where'=>array('NO_PROP'=>$opsi['data_awal']['NO_PROP'],'NO_KAB'=>$opsi['data_awal']['NO_KAB'],'NO_KEC'=>$opsi['data_awal']['NO_KEC'],'NO_KEL'=>$opsi['data_awal']['NO_KEL'],'NO_RW'=>$opsi['data_awal']['NO_RW'],'ST_ACTIVE'=>'Y'),'order'=>'NO_RT'));																			
				}						
			}				
		}		
		for($i=0;$i<count($data);$i++){
			$hasil[$data[$i]->no_rt]=str_pad ( $data[$i]->no_rt , 3, '0', STR_PAD_LEFT);
		}
		return $hasil;
	}				
}
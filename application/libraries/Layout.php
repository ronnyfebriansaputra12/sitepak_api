<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Layout
{
    
    var $obj;
    var $layout;
    var $js=array();
	var $css=array();
	var $title;
	var $dynamic_data=array();
    function __construct()
    {
        $this->obj =& get_instance();        
    }
    function setLayout($layout)
    {
      $this->layout = $layout;
    }
    function setJs($js=array()){
		$this->js=$js;
	}
	function setCss($css=array()){
		$this->css=$css;
	}
	function setTitle($title){
		$this->title=$title;
	}
	function setDynamic_data($attribute,$data){
		$this->dynamic_data[$attribute]=$data;
	}
	function unsetDynamic_data($attribute){
		unset($this->dynamic_data[$attribute]);
	}
    function view($view, $data=null, $return=false)
    {
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view,$data,true);
        $loadedData['js']=$this->js;
		$loadedData['css']=$this->css;
		$loadedData['title_for_layout']=$this->title;
		$loadedData['dynamic_data']=$this->dynamic_data;	
        if($return)
        {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }
} 
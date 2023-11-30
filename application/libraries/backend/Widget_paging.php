<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Widget_paging{
	var $input=array();
	function __construct($param){
		$this->CI=& get_instance();
		$this->jumlah=$param['jumlah'];
		if(isset($param['batas_halaman'])){
			$this->batas_halaman=$param['batas_halaman'];
		}elseif(isset($_POST['batas_halaman'])){
			$this->batas_halaman=$_POST['batas_halaman'];
		}else{	
			$this->batas_halaman=$this->CI->config->item('paging_backend');
		}
		$this->jumlah_halaman=ceil($this->jumlah/$this->batas_halaman);		
	}
	function awal_data($param){
		if($param['halaman'] < 1)
			$this->halaman=1;
		elseif($param['halaman'] > $this->jumlah_halaman)
			$this->halaman=$this->jumlah_halaman;
		else		
			$this->halaman=$param['halaman'];
		$this->input=$param['input'];
		$this->offset=$this->batas_halaman*($this->halaman-1)+1;
		return $this->offset;
	}
	function masukkan_halaman($param){
		//$this->input['style']="width : 20px";
		$this->input['onkeypress']="return numbersonly(event,false)";
		$this->input['onkeyup']="return numbersonly(event,false)";
		$this->input['class']="paging-halaman";
		$masukkan="";
		if($this->halaman > 1)
			$masukkan='<img align="absmiddle" class="paging_prev" src="'.$param['prev'].'" />';		
		$masukkan.=form_input($this->input,$this->halaman);
		if($this->halaman < $this->jumlah_halaman)
			$masukkan.='<img align="absmiddle" class="paging_next" src="'.$param['next'].'" />';
		$masukkan.='<script language="javascript">
		$(function(){			
			$("#'.$param['id_form'].' img.paging_prev").click(function(){				
				$("#'.$this->input['id'].'").val('.($this->halaman-1).');
				$("#'.$param['id_form'].'").submit();
			});
			$("#'.$param['id_form'].' img.paging_next").click(function(){
				$("#'.$this->input['id'].'").val('.($this->halaman+1).');
				$("#'.$param['id_form'].'").submit();
			});
			$("#'.$param['id_form'].'").bind("submit",function(event){
			
				if(parseInt($("#'.$param['id_form'].' input[id=\'page\']").val()) > parseInt($("#'.$param['id_form'].' .jml_halaman").html())){
					jAlert("Halaman tidak valid", "Pesan");						
				}else{	
					$(this).ajaxSubmit({beforeSubmit:function(){
						$(\'input[type="submit"],button[type="submit"]\').attr(\'disabled\',true);
						showLoader();
					},success:function(responseText, statusText, xhr, form){							
						$(\'input[type="submit"],button[type="submit"]\').attr(\'disabled\',false);
						$("#"+form.attr("targetDiv")).html(responseText);
						hideLoader();
					}});
				}
				event.preventDefault();	
			});			
		});				
		</script>';
		return $masukkan;		
	}
	function form_cari(){
		$hasil="";
		if(isset($_POST['tabel'])){
			foreach($_POST['tabel'] as $nama_isian=>$nilai_isian){
				$hasil.="<input type=hidden value='".$nilai_isian."' name='tabel[".$nama_isian."]' />";
			}
		}
		if(isset($_POST['batas_halaman'])){
			$hasil.="<input type=hidden value='".$_POST['batas_halaman']."' name='batas_halaman' />";
		}
		return $hasil;
	}
}
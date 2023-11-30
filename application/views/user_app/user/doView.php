<?php 
if($data == NULL){
	$this->siaklib->getNoInfo4('Pengguna dengan ID: <b>'.$ID_USER.'</b> tidak ditemukan atau telah dihapus dalam database', 'siak_list', 'siak_edit');
} 
else{
?>
	<div class="portlet box black">
	  <div class="portlet-title">
		 <div class="caption">PENGGUNA</div>
		 <div class="actions">
			<?php 
				$this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');
			?>					
		</div>
	  </div>
	  <div class="portlet-body form">
	  	<form class="form-horizontal" id="frmInput">
			<div class="form-body">
				<div class="portlet">
					<div class="portlet-title">
						<label class="control-label siak-font">DATA PENGGUNA</label>
						<div class="tools">
							 <a href="javascript:;" class="collapse"></a>
						</div>
					</div> 
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Id Pengguna</label>
									 <div class="control-label col-md-9">:&nbsp;<b class="font_biru"><?=$data[0]->user_id?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Nama Lengkap</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->nama_lgkp?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">NIP</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->nip?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Tempat Lahir</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->tmpt_lhr?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Tanggal Lahir</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->tgl_lhr->format('d-m-Y')?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Jenis Kelamin</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->jenis_klmin_desc?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Telephone/Handphone</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->telp?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Golongan</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->golongan?></b></div>
								</div>
							</div>
						</div>      
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Jabatan</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->jabatan?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Nama Kantor</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->nama_kantor?></b></div>
								</div>
							</div>
						</div>   
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Alamat Kantor</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->alamat_kantor?></b></div>
								</div>
							</div>
						</div>    
						<div class="row">
							<div class="col-md-12">
								<div class="form-group jarak">
									 <label class="control-label col-md-3">Kelompok Pengguna</label>
									 <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->level_name?></b>&nbsp;&nbsp;<span class='label lable-sm label-<?=$this->siaklib->getLabelTingkatan($data[0]->level_code)?>'><?=$data[0]->tingkatan?></span></div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="form-actions right">                           
				<a href="#" class="btn purple kembali" data-target="siak_list" data-hidden="siak_edit"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
			</div>
		</form>
	</div>
</div>
<script>
$(function(){
	var level_userV = "<?=$data[0]->level_code?>";
	if(level_userV.charCodeAt(0) > 48 && level_userV.charCodeAt(0) < 57){
		$('#instansiV').hide();
		$('#konjenV').hide(); 
		$('#provinsiV').show();
		if(level_userV.charCodeAt(0) > 50){
			$('#kabupatenV').show();
			if(level_userV.charCodeAt(0) > 52){
				$('#kecamatanV').show();
				if(level_userV.charCodeAt(0)>54){
					$('#kelurahanV').show();
				}else{
					$('#kelurahanV').hide();
				}
			}else{
				$('#kecamatanV').hide();
				$('#kelurahanV').hide();
			}
		}else{
			$('#kabupatenV').hide();
			$('#kecamatanV').hide();
			$('#kelurahanV').hide();
		}
	}else if(level_userV.charCodeAt(0) == 48){
		$('#provinsiV').hide();
		$('#kabupatenV').hide();
		$('#kecamatanV').hide();
		$('#kelurahanV').hide();
		$('#konjenV').hide();
		$('#instansiV').hide();
	}else{
		$('#provinsiV').show();
		$('#kabupatenV').show();
		$('#kecamatanV').show();
		$('#kelurahanV').show();
		if(level_userV.charCodeAt(0) == 57){
			$('#instansiV').show();	
			$('#konjenV').hide();	
		}else if(level_userV.charCodeAt(0) == 65){
			$('#konjenV').show();	
			$('#instansiV').hide();	
		}			
	}
});	
</script>
<?php 
}
?>
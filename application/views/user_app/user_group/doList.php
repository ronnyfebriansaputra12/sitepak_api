<div class="row">
	<div class="col-md-12" id="siak_list-user_group">
		<div class="portlet box black">
			<div class="portlet-title">
				<div class="caption">DAFTAR KELOMPOK PENGGUNA</div>
				<div class="actions">
					<?php $this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');?>
				</div>
			</div>
			<div class="portlet-body form">
			 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doListData'?>" class="form-horizontal" id="formSearch2" data-target='main_siak_child2' method="post">
				<div class="form-body">
				   <div class="form-group">
					  <label class="col-md-2 control-label">Tingkatan</label>
					  <div class="col-md-3">
						<?php echo form_dropdown('TABEL[GROUP_LEVEL]',$cb_group_level,'','class="form-control input-sm" id="GROUP_LEVEL"')?>					 
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Kata Kunci</label>
					  <div class="col-md-5">
						<input type="text" class="form-control input-sm mask-alamat_cari" name="TABEL[LEVEL_NAME]"  placeholder="Kelompok Pengguna">
					  </div>
				   </div>
				</div>
				<div class="form-actions right">                           
				   <button type="submit" class="btn red"><i class="fa fa-table"></i> Tampilkan</button>                           
				</div>
			 </form>
			</div>    
			<div class="portlet-body">
				 <div class="table-responsive">
					<div id="main_siak_child2"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12" id="siak_edit-user_group">
	</div>
</div>
	<script language="javascript">
	$(function(){
		$('#formSearch2').validate(option_form);
		$(".mask-alamat_cari").inputmask("Z{+}", {
			definitions: {
				"Z": {
					validator: "[a-zA-Z0-9\', %.\/\-]",
					casing: "upper"
				}
			}
		});
		App.initAjax();
	});
	</script>
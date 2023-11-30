<div class="row">
	<div id="siak_list" class="col-md-12">
		<div class="portlet box black">
			<div class="portlet-title">
				<div class="caption">DAFTAR PENGGUNA</div>
				<div class="actions">
					<?php 
						$this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');
					?>					
				</div>				
			</div>
			<div class="portlet-body form">
			 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doListData'?>" class="form-horizontal" id="formSearch" data-target='main_siak_child' method="post">
				<div class="form-body">
					<div class="portlet" id="Pencarian">
						<div class="portlet-title">
							<label class="control-label">Cari Berdasarkan</label>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_1" id="opsi_1">Id Pengguna
												</label>
											</div>
										</div>
										<div class="col-md-7">
											<input type="text" class="form-control input-sm" id="CARI_USER_ID" name="CARI_USER_ID" placeholder="Kata Kunci">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_2" id="opsi_2">Nama Lengkap
												</label>
											</div>
										</div>
										<div class="col-md-7">
											<input type="text" class="form-control input-sm mask-alamat_cari" id="CARI_NAMA_LGKP" name="CARI_NAMA_LGKP" placeholder="Kata Kunci">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_3" id="opsi_3">Kelompok Pengguna
												</label>
											</div>
										</div>
										<div class="col-md-7">
											<?php echo form_dropdown('CARI_USER_LEVEL',$cbKelompok,'','class="form-control input-sm" id="CARI_USER_LEVEL"')?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
								</div>
							</div>
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
					<div id="main_siak_child"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12" id="siak_edit">
	</div>

</div>

<script language="javascript">
$(function(){	
	$('#formSearch').validate(option_form);
	$(".mask-alamat_cari").inputmask("Z{+}", {
        definitions: {
            "Z": {
                validator: "[a-zA-Z0-9\', %.\/\-]",
                casing: "upper"
            }
        }
    });
	$("#Pencarian input[type='text']").attr('disabled',true);
	$("#Pencarian select").attr('disabled',true);
	$("#Pencarian input[type='checkbox']").change(function(e){
		if($(this).is(':checked')){
			$("input[type='text']",$(this).parents('.col-md-6')[0]).attr('disabled',false);
			$("select",$(this).parents('.col-md-6')[0]).attr('disabled',false);
		}
		else{
			$("input[type='text']",$(this).parents('.col-md-6')[0]).val('');
			$("select",$(this).parents('.col-md-6')[0]).val('');
			$("input[type='text']",$(this).parents('.col-md-6')[0]).attr('disabled',true);
			$("select",$(this).parents('.col-md-6')[0]).attr('disabled',true);
		}
	});
	
	App.initAjax();
});
</script>
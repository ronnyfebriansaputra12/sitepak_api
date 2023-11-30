<div id="siak_list" class="col-md-12">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">DAFTAR LAPORAN METODE AKSES</div>
			<div class="actions">
							
			</div>
		</div>
		<div class="portlet-body form">
		 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/listMetodeData'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
			<div class="form-body">
				
				
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<div class="col-md-3">
									<div align="left">
										<label>
											Nama Lembaga
										</label>
									</div>
								</div>
								<div class="col-md-7">
										<?php echo form_dropdown('CARI_LEMBAGA',$listLembaga,'','class="form-control input-sm select2" id="CARI_LEMBAGA"')?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="col-md-5">
									<div align="left">
										<label>
											Status Web Service
										</label>
									</div>
								</div>
								<div class="col-md-7">
										<?php echo form_dropdown('CARI_WS',$listMetodeAkses,'','class="form-control input-sm" id="CARI_WS"')?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<div class="col-md-5">
									<div align="left">
										<label>
											Status Web Portal
										</label>
									</div>
								</div>
								<div class="col-md-7">
										<?php echo form_dropdown('CARI_WP',$listMetodeAkses,'','class="form-control input-sm" id="CARI_WP"')?>
								</div>
							</div>
						</div>
					</div>
					<div class="portlet" id="Pencarian">
						<div class="portlet-title">
							<label class="control-label">Jenis Metode Akses</label>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_1" id="opsi_1">WS LAMA
												</label>
											</div>
										</div>
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_2" id="opsi_2">WS KOMBINASI
												</label>
											</div>
										</div>
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_3" id="opsi_3">WS KESESUAIAN
												</label>
											</div>
										</div>
										<div class="col-md-7">

										</div>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_4" id="opsi_4">FINGER PRINT
												</label>
											</div>
										</div>
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_5" id="opsi_5">FACE RECOGNITION
												</label>
											</div>
										</div>
										
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="col-md-5">
											<div align="left">
												<label>
													<input type="checkbox" name="opsi_6" id="opsi_6">WEB PORTAL
												</label>
											</div>
										</div>
										<div class="col-md-7">

										</div>
									</div>
								</div>
								
							</div>
						</div> 
					</div>
					
					 
				</div>                                            
			</div>
			<div class="form-actions right">                           
				<button type="submit" class="btn yellow"><i class="fa fa-table"></i> Tampilkan</button>                           
			</div>
		 </form>
		</div>    
		<div class="portlet-body">
			 <div>
				<div id="main_siak_child"></div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12" id="siak_edit">
</div>


<script language="javascript">
$(function(){	
	$('#form-cari-sinkronisasi_data').validate(option_form);
	$(".mask-alamat_cari").inputmask("Z{+}", {
		  definitions: {
				"Z": {
					 validator: "[a-zA-Z0-9\', %.\/\-]",
					 casing: "upper"
				}
		  }
	 });
	$(".mask-date_cari").inputmask("d-m-y", {
		"placeholder": "DD-MM-YYYY"
	});
	$(".mask-angka_cari").inputmask("Regex",{ regex: "[0-9,]*",});
	$('.select2').select2();

	function rmvTextDateAttrDataRule(field_id){
		$(field_id).removeAttr("data-rule-dateINA");
		$(field_id).removeAttr("data-msg-dateINA");
	}

	function addTextDateAttrDataRule(field_id, field_dataRule, field_dataMsg){
		$(field_id).attr("data-rule-dateINA", field_dataRule);
		$(field_id).attr("data-msg-dateINA", field_dataMsg);
	}
	
	App.initAjax();
});
</script>
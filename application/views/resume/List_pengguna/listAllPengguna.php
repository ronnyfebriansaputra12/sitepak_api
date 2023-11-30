<div id="siak_list" class="col-md-12">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">RESUME MONITORING LIST PENGGUNA AKSES PEMANFAATAN DATA</div>
			<div class="actions">
			</div>
		</div>
		<div class="portlet-body form">
		 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/listAllPenggunaData'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
			<div class="form-body">
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Wilayah
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[LIST_WILAYAH]',$listWilayahPengguna,'','class="form-control input-sm select2" id="CARI[LIST_WILAYAH]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Status Pengguna
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[LIST_PENGGUNA]',$listPengguna,'','class="form-control input-sm select2" id="CARI[LIST_PENGGUNA]"')?>
								</div>
							</div>
						</div>
					</div>
				</div>                                            
			</div>
			<div class="form-actions text-center">                           
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
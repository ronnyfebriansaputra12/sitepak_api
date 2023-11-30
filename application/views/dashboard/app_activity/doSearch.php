<div class="row">
	<div class="col-md-12" id="siak_list">
		<div class="tabbable-custom">
			<div class="tab-content" id="permintaanCetak" style="padding:0">
				<div class="portlet-body form">
					<form class="form-horizontal" role="form" method="post" id="form_search-aktivitas_all" data-target='daftar_aktifitas-all_detil' action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().'Data' ?>">
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
															<input type="checkbox" name="opsi_1" id="opsi_1">User ID
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
															<input type="checkbox" name="opsi_2" id="opsi_2">Alamat IP
														</label>
													</div>
												</div>
												<div class="col-md-7">
													<input type="text" class="form-control input-sm mask-alamat_cari" id="CARI_IP_ADDRESS" name="CARI_IP_ADDRESS" placeholder="Kata Kunci">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-5">
													<div align="left">
														<label><input type="checkbox" name="opsi_3" id="opsi_3">Operasi</label>
													</div>
												</div>
												<div class="col-md-7">
													<?php echo form_dropdown('CARI_ACT_TYPE', $this->siakactivity->get_activity_operand_list(), '', 'id="CARI_ACT_TYPE" class="form-control input-sm"');?>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-5">
													<div align="left">
														<label><input type="checkbox" name="opsi_4" id="opsi_4">Modul</label>
													</div>
												</div>
												<div class="col-md-7">
													<?php echo form_dropdown('CARI_ACT_MODUL', $this->siakactivity->get_activity_module_list(), '', 'id="CARI_ACT_MODUL" class="form-control input-sm"');?>
												</div>
											</div>                                
										</div>
									</div>                            
								</div>
							</div>
						</div>
						<div class="form-actions right">                    
							<button type="submit" class="btn red"> <i class="fa fa-table"></i> Tampilkan</button>                            
						</div>                    
					</form>
				</div>
				<div class="portlet-body">
					<div class="table-responsive">
						<div id="daftar_aktifitas-all_detil"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-12" id="siak_edit"></div>
<script language="javascript">
$(function(){
	$('#form_search-aktivitas_all').validate(option_form);
	$(".mask-date_cari").inputmask("d-m-y", {
		"placeholder": "DD-MM-YYYY"
	});
	$(".mask-nama_cari").inputmask("X{+}", {
		definitions: {
			"X": {
				validator: "[a-zA-Z\', .\-]",
				casing: "upper"
			}
		}
	});
	$(".mask-alamat_cari").inputmask("Z{+}", {
		definitions: {
			"Z": {
				validator: "[a-zA-Z0-9\', %.\/\-]",
				casing: "upper"
			}
		}
	});     
	$(".mask-angka_cari").inputmask("Regex",{
		regex: "[0-9,]*"}).on("input", function(){
			$(this).val($(this).val().toUpperCase())
		});

	$(".cari_aktivitas").uniform();
	$.uniform.restore('.make-switch');
	$.uniform.update();
	App.initAjax();

	$("#Pencarian input[type='text']", "#form_search-aktivitas_all").attr('disabled',true);
	$("#Pencarian select", "#form_search-aktivitas_all").attr('disabled',true);
	$("#Pencarian input[type='checkbox']", "#form_search-aktivitas_all").change(function(e){
		if($(this).is(':checked')){
			$("input[type='text']",$(this).parents('.col-md-6')[0]).attr('disabled',false);
			$("select",$(this).parents('.col-md-6')[0]).attr('disabled',false);

		}else{
			$("input[type='text']",$(this).parents('.col-md-6')[0]).val('');
			$("select",$(this).parents('.col-md-6')[0]).val(0);
			$("select#CARI_ACT_TYPE",$(this).parents('.col-md-6')[0]).val('');
			$("select#CARI_ACT_MODUL",$(this).parents('.col-md-6')[0]).val('');
			$("input[type='text']",$(this).parents('.col-md-6')[0]).attr('disabled',true);
			$("select",$(this).parents('.col-md-6')[0]).attr('disabled',true);
		}
	});

	$('#opsi_4').change(function(){
		if($(this).is(":checked")){
			addTextDateAttrDataRule('#CARI_TANGGAL', 'true', 'Tanggal harus benar');
		}else{
			rmvTextDateAttrDataRule('#CARI_TANGGAL');
		}
	});

	function rmvTextDateAttrDataRule(field_id){
		$(field_id).removeAttr("data-rule-dateINA");
		$(field_id).removeAttr("data-msg-dateINA");
	}

	function addTextDateAttrDataRule(field_id, field_dataRule, field_dataMsg){
		$(field_id).attr("data-rule-dateINA", field_dataRule);
		$(field_id).attr("data-msg-dateINA", field_dataMsg);
	}
});
</script>
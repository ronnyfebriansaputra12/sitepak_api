<div id="siak_list" class="col-md-12">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">DAFTAR LAPORAN TOTAL AKSES HARIAN (PUSAT)</div>
			<div class="actions">
			</div>
		</div>
		<div class="portlet-body form">
			<form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/listHarianData'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
			<div class="form-body">
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												Nama Lembaga
											</label>
										</div>
									</div>
									<div class="col-md-8">
										<?php echo form_dropdown('CARI_LEMBAGA',$listLembaga,'','class="form-control input-sm select2" id="CARI_LEMBAGA"')?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												Tanggal
											<span class="required"></span></label>
										</div>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm mask-date_cari" id="CARI_ADM_TGL_ENTRY" name="CARI_ADM_TGL_ENTRY" placeholder="Kata Kunci" data-rule-required="true" data-msg-required="Tanggal Wajib Diisi" data-rule-dateINA="true" data-msg-dateINA="Format Tanggal Benar">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												&nbsp;
											</label>
										</div>
									</div>
									<div class="col-md-8">
										&nbsp;
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												Status Web Service
											</label>
										</div>
									</div>
									<div class="col-md-8">
										<?php echo form_dropdown('CARI_WS',$listAktivasi,'','class="form-control input-sm select2" id="CARI_WS"')?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												Status Web Portal
											</label>
										</div>
									</div>
									<div class="col-md-8">
										<?php echo form_dropdown('CARI_WP',$listAktivasi,'','class="form-control input-sm select2" id="CARI_WP"')?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												Status Biometrik
											</label>
										</div>
									</div>
									<div class="col-md-8">
										<?php echo form_dropdown('CARI_BIO',$listAktivasi,'','class="form-control input-sm select2" id="CARI_BIO"')?>
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
			 <div class="table-responsive">
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
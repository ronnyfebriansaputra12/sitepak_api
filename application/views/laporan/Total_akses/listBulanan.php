<div id="siak_list" class="col-md-12">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">DAFTAR LAPORAN TOTAL AKSES BULANAN (PUSAT)</div>
			<div class="actions">
			</div>
		</div>
		<div class="portlet-body form">
			<form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/listBulananData'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
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
										<?php echo form_dropdown('CARI[LEMBAGA]',$listLembaga,'','class="form-control input-sm select2" id="CARI[LEMBAGA]"')?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="col-md-4">
										<div align="right">
											<label>
												Bulan <sup>(*)</sup>
											<span class="required"></span></label>
										</div>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control input-sm mask-date_cari" id="CARI[TGL_AWAL]" name="CARI[TGL_AWAL]" placeholder="Kata Kunci" data-rule-required="true" data-msg-required="Bulan Wajib Diisi" data-rule-monthINA="true" data-msg-monthINA="Format Bulan Salah">
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
										<?php echo form_dropdown('CARI[WS]',$listAktivasi,'','class="form-control input-sm select2" id="CARI[WS]"')?>
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
										<?php echo form_dropdown('CARI[WP]',$listAktivasi,'','class="form-control input-sm select2" id="CARI[WP]"')?>
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
										<?php echo form_dropdown('CARI[BIO]',$listAktivasi,'','class="form-control input-sm select2" id="CARI[BIO]"')?>
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
	
	$(".mask-date_cari").inputmask("m-y", {
		"placeholder": "MM-YYYY"
	});
	$('.select2').select2();
	function rmvTextDateAttrDataRule(field_id){
		$(field_id).removeAttr("data-rule-monthINA");
		$(field_id).removeAttr("data-msg-monthINA");
	}

	function addTextDateAttrDataRule(field_id, field_dataRule, field_dataMsg){
		$(field_id).attr("data-rule-monthINA", field_dataRule);
		$(field_id).attr("data-msg-monthINA", field_dataMsg);
	}
	
	App.initAjax();
});
</script>
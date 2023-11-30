<div id="siak_list" class="col-md-12">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">RESUME MONITORING AKSES (PUSAT)</div>
			<div class="actions">
			</div>
		</div>
		<div class="portlet-body form">
		 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/listAllPusatData'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
			<div class="form-body">
				<div class="portlet-body">
					<!--
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
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											WS Lama
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[WSL]',$listStatusMetodeAkses,'','class="form-control input-sm select2" id="CARI[WSL]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											WS Kesesuaian
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[WSKES]',$listStatusMetodeAkses,'','class="form-control input-sm select2" id="CARI[WSKES]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											WS Kombinasi
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[WSKOM]',$listStatusMetodeAkses,'','class="form-control input-sm select2" id="CARI[WSKOM]"')?>
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
											Finger Print
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[FP]',$listStatusMetodeAkses,'','class="form-control input-sm select2" id="CARI[FP]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Face Recognition
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[FR]',$listStatusMetodeAkses,'','class="form-control input-sm select2" id="CARI[FR]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Web Portal
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[WP_2]',$listStatusMetodeAkses,'','class="form-control input-sm select2" id="CARI[WP_2]"')?>
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
											Jenis Skala Data<br>Web Service
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[SKALA_DATA_1]',$listSkalaData,'','class="form-control input-sm select2" id="CARI[SKALA_DATA_1]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Jenis Skala Data<br>Web Portal
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[SKALA_DATA_2]',$listSkalaData,'','class="form-control input-sm select2" id="CARI[SKALA_DATA_2]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Jenis Skala Data<br>Biometrik
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[SKALA_DATA_3]',$listSkalaData,'','class="form-control input-sm select2" id="CARI[SKALA_DATA_3]"')?>
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
											Status User<br>Web Service
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[STATUS_1]',$listStatusUser,'','class="form-control input-sm select2" id="CARI[STATUS_1]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Status User<br>Admin Web Portal
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[STATUS_2]',$listStatusUser,'','class="form-control input-sm select2" id="CARI[STATUS_2]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Status User<br>Biometrik
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[STATUS_4]',$listStatusUser,'','class="form-control input-sm select2" id="CARI[STATUS_4]"')?>
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
											&nbsp;
										</label>
									</div>
								</div>
								<div class="col-md-8">
									&nbsp;
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Status User<br>Opr Web Portal
										</label>
									</div>
								</div>
								<div class="col-md-8">
										<?php echo form_dropdown('CARI[STATUS_3]',$listStatusUser,'','class="form-control input-sm select2" id="CARI[STATUS_3]"')?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Status Akses
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<?php echo form_dropdown('CARI[STATUS_AKSES]',$listStatusAkses,'','class="form-control input-sm select2" id="CARI[STATUS_AKSES]"')?>
								</div>
							</div>
						</div>
					-->
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
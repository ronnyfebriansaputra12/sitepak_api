<div id="siak_list" class="col-md-12">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">DAFTAR LAPORAN KUOTA USER (DAERAH)</div>
			<div class="actions">
							
			</div>
		</div>
		<div class="portlet-body form">
		 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/listTotalKuotaData'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
			<div class="form-body">
				
				
				<div class="portlet-body">
					<? echo $this->widget_wilayah->begin_wiget(array('prop'=>'NO_PROP','kab'=>'NO_KAB'),base_url().'backend/ajax_wilayah/')?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Provinsi
										</label>
									</div>
								</div>
								<div class="col-md-8">
										<? echo $this->widget_wilayah->get_propinsi(array('name'=>'CARI[NO_PROP]','param'=>'id="NO_PROP" class="form-control input-sm select2" '))?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<div class="col-md-4">
									<div align="right">
										<label>
											Kabupaten/Kota
										</label>
									</div>
								</div>
								<div class="col-md-8">
										<? echo $this->widget_wilayah->get_kabupaten(array('name'=>'CARI[NO_KAB]','param'=>'id="NO_KAB" class="form-control input-sm select2"'))?>
								</div>
							</div>
						</div>
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
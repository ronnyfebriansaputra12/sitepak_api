<div id="siak_list" class="col-md-12">
	<div class="portlet box black">
		<div class="portlet-title">
			<div class="caption">MONITORING PENGADUAN LEMBAGA HARIAN</div>
			
		</div>
		<div class="portlet-body form">
		 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doListHarian01'?>" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='siak_edit' method="post" data-hidden="siak_list">
			<div class="form-body">
				<div class="row">
					
					<div class="col-md-6">
						<div  class="col-md-2">
							Pilih lembaga
						</div>
						<div  class="col-md-8">
							<select name="tabel[LEMBAGA]" data-id="LEMABAGA" id="LEMBAGA" class="form-control input-sm">
								<option value="0" selected="selected">==PILIH PROVINSI==</option>
								<option value="11">ACEH (11)</option>
								<option value="12">SUMATERA UTARA (12)</option>
								<option value="13">SUMATERA BARAT (13)</option>
								<option value="14">RIAU (14)</option>
								<option value="15">JAMBI (15)</option>
								<option value="16">SUMATERA SELATAN (16)</option>
								<option value="17">BENGKULU (17)</option>
								<option value="18">LAMPUNG (18)</option>
								<option value="19">KEPULAUAN BANGKA BELITUNG (19)</option>
								<option value="21">KEPULAUAN RIAU (21)</option>
								<option value="31">DKI JAKARTA (31)</option>
								<option value="32">JAWA BARAT (32)</option>
								<option value="33">JAWA TENGAH (33)</option>
								<option value="34">DAERAH ISTIMEWA YOGYAKARTA (34)</option>
								<option value="35">JAWA TIMUR (35)</option>
								<option value="36">BANTEN (36)</option>
								<option value="51">BALI (51)</option>
								<option value="52">NUSA TENGGARA BARAT (52)</option>
								<option value="53">NUSA TENGGARA TIMUR (53)</option>
								<option value="61">KALIMANTAN BARAT (61)</option>
								<option value="62">KALIMANTAN TENGAH (62)</option>
								<option value="63">KALIMANTAN SELATAN (63)</option>
								<option value="64">KALIMANTAN TIMUR (64)</option>
								<option value="65">KALIMANTAN UTARA (65)</option>
								<option value="71">SULAWESI UTARA (71)</option>
								<option value="72">SULAWESI TENGAH (72)</option>
								<option value="73">SULAWESI SELATAN (73)</option>
								<option value="74">SULAWESI TENGGARA (74)</option>
								<option value="75">GORONTALO (75)</option>
								<option value="76">SULAWESI BARAT (76)</option>
								<option value="81">MALUKU (81)</option>
								<option value="82">MALUKU UTARA (82)</option>
								<option value="91">PAPUA (91)</option>
								<option value="92">PAPUA BARAT (92)</option>
								</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-md-3">
								<div align="left">
									<label>
										Tanggal
									</label>
								</div>
							</div>
							<div class="col-md-3">
								<span class="input-group date date-picker">
									<span class="input-group-btn">
										<button class="btn yellow" type="button"><i class="fa fa-calendar"></i></button>&nbsp;&nbsp;&nbsp;
									</span>
									<input name="DATE_PICKER" value="<?php echo date('d-m-Y');?>" id="DATE_PICKER" class="form-control" readonly="readonly" type="text">
								</span>
								
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


<script language="javascript">
$(function(){	
	$('#form-cari-sinkronisasi_data').validate(option_form);
	$('.date-picker').datepicker({
		orientation: "left",
		autoclose: true,
		keepOpen: false,
		format: "dd-mm-yyyy",
		viewMode: "date", 
		minViewMode: "date",
		startDate: new Date(2018,10,16),
		endDate: new Date(<?php echo date('Y')?>,<?php echo date('m')-1?>,<?php echo date('d')?>)
	});
	

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
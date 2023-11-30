<!-- BEGIN PAGE HEADER-->


<!-- BEGIN PAGE CONTENT-->
<div class="row profile" id="main_siak_show" style="margin-top:20px; margin-bottom:20px; margin-left: 0px; margin-right: 0px;">
	<div class="row">
		<div class="col-md-12">
			<div id="siak_list" class="col-md-12">
				<div class="portlet-body form">
				 <form action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doView01'?>" class="form-horizontal form_cari" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
					<div class="form-body">
						<div class="form-actions form-group">                           
							<div class="row">
								<div  class="col-md-10">
									<h3 class="page-title" style="font-size:22px;">MONITORING PENGADUAN HARIAN</h3>
								</div>
								<div  class="col-md-2">
									<div class="input-group input-group-md" style="width:200px">
										<span class="input-group date date-picker">
											<span class="input-group-btn">
												<button class="btn yellow" type="button"><i class="fa fa-calendar"></i></button>
											</span>
											<input name="DATE_PICKER" value="<?php echo date('d-m-Y');?>" id="DATE_PICKER" class="form-control" readonly="readonly" type="text">
										</span>
										<span class="input-group-btn">
											<button class="btn yellow" id="tampilkan_detail" type="submit" data-target="siak_edit"><i class="fa fa-search"></i></button>
										</span>
									</div>	
								</div>
							</div>
						</div>
					</div>
				 </form>
				</div>    
				<div class="portlet-body">
					 <div class="table-responsive">
						<div id="main_siak_child"></div>
					</div>
				</div>
			</div>
			<div class="col-md-12" id="siak_edit">
			<div class="col-md-12" id="siak_detail">
			</div>
		</div>
	</div>
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
	$('#tampilkan_detail').click();
	App.initAjax();
});
</script>
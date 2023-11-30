<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title  font-grey-cascade"><?php echo $this->siakconfig->getNamaLembaga()?>&nbsp;<small>SISTEM INFORMASI PEMANFAATAN DATA</small></h3>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<div class="row profile" id="main_siak_show">
	<div id="siak_list" class="col-md-12">
		<div class="portlet box black">
			<div class="portlet-title">
				<div class="caption">Grafik</div>
			</div>
			<div class="portlet-body form">
			 <form action="#" class="form-horizontal" id="form-cari-sinkronisasi_data" data-target='main_siak_child' method="post">
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Tanggal Grafik<span class="required">*</span></label>
								<div class="col-md-7">
								<input maxlength="5" class="form-control input-sm" name="tabel[SERVICE_USRID]" id="SERVICE_USRID" data-rule-required="true"  aria-required="true" type="text">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							
						</div>
					</div>					
				</div>
			 </form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".mask-angka").inputmask("Regex",{ regex: "[0-9,]*",});
		
	});
</script>
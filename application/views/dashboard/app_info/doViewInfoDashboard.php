<div class="col-md-12">
	<div class="portlet" id="info-instansi<?php echo $instansi;?>-kategori-data">
		<div class="portlet-title">
			<div class="caption text-muted">
				<small><?php echo (!is_null($desc) ? ('<span class="label label-default">'.(is_null($desc->fpd2k_instansi_category) ? '-' : $desc->fpd2k_instansi_category->category_name).'</span> '.$desc->instansi_name) : 'Detail');?></small>
			</div>
			<div class="tools">
				<a href="javascript;" class="collapse"></a>
			</div>
		</div>
		<div class="portlet-body">
			<div id="detail-instansi-<?php echo $instansi;?>" data-url="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/data_refresh_instDashboard?i='.$instansi.'&t='.(isset($delays) ? $delays: 15);?>" data-map='{"akses-<?php echo $instansi;?>":"akses","found-<?php echo $instansi;?>":"ditemukan","not_found-<?php echo $instansi;?>":"tidak_ditemukan"}' data-noblock="true"></div>
			<div class="table-responsive">
				<div class="row">
					<div class="col-md-4">
						<div class="dashboard-stat bg-blue" style="height:145px;">
							<div class="visual" style="height:97px;">
								<i class="fa fa-search"></i>
							</div>
							<div class="details" style="width:75%;">
								<div class="number" id="akses-<?php echo $instansi;?>" style="text-align: right;">0</div>
								<div class="desc" style="text-align: right;">AKSES</div>
							</div>
							 <a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewInfoDataDashboard/1/'.$instansi?>" id="tampilkan-default" class="ajaxify more active" data-toggle="tooltip" data-placement="bottom" data-target="info-instansi<?php echo $instansi;?>-kategori-detail">
							Tampilkan <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="dashboard-stat bg-green-meadow" style="height:145px;">
							<div class="visual" style="height:97px;">
								<i class="fa fa-check-circle-o"></i>
							</div>
							<div class="details" style="width:75%;">
								<div class="number" id="found-<?php echo $instansi;?>" style="text-align: right;">0</div>
								<div class="desc" style="text-align: right;">DI TEMUKAN</div>
							</div>
							 <a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewInfoDataDashboard/2/'.$instansi?>" class="ajaxify more" data-toggle="tooltip" data-placement="bottom" data-target="info-instansi<?php echo $instansi;?>-kategori-detail">
							Tampilkan <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					<div class="col-md-4">
						<div class="dashboard-stat bg-red-flamingo" style="height:145px;">
							<div class="visual" style="height:97px;">
								<i class="fa fa-times-circle-o"></i>
							</div>
							<div class="details" style="width:75%;">
								<div class="number" id="not_found-<?php echo $instansi;?>" style="text-align: right;">0</div>
								<div class="desc" style="text-align: right;">TIDAK DI TEMUKAN</div>
							</div>
							 <a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewInfoDataDashboard/3/'.$instansi?>" class="ajaxify more" data-toggle="tooltip" data-placement="bottom" data-target="info-instansi<?php echo $instansi;?>-kategori-detail">
							Tampilkan <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				</div>
				<br/>	
				<div id="info-instansi<?php echo $instansi;?>-kategori-detail"></div>
			</div>
		</div>
	</div>
	<a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewDashboard/'.$index;?>" class="btn purple btn-block ajaxify" data-target="dashboard-container"><i class="fa fa-arrow-circle-left "></i> Kembali </a>
</div>

<script type="text/javascript">
	$(function() {
		ajax_function($('#detail-instansi-<?php echo $instansi;?>'));
		$('#tampilkan-default').click();
	})
</script>
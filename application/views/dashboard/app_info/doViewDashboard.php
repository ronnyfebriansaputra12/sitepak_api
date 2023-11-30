<?php
	$now = new DateTime('now');
	$hri_curr = $now->format('w');
	$tgl_curr = $now->format('d');
	$bln_curr = $now->format('m');
	$thn_curr = $now->format('Y');
?>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title font-grey-cascade"><?php echo $this->siakconfig->getNamaLembaga()?>&nbsp;<small>SISTEM INFORMASI PEMANFAATAN DATA</small></h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box grey-cararra">
			<div class="portlet-title">
				<div class="caption">
					<?php echo strtoupper($this->siakwordconvert->getNamaHariId($hri_curr)).", ".$tgl_curr." ".strtoupper($this->siakwordconvert->getIndonesiaMonth($bln_curr))." ".$thn_curr;?>
				</div>
				<div class="actions" style="margin-top:15px">
					<div class="btn-group pull-right">
						<button data-close-others="true" data-delay="1000" data-toggle="dropdown" class="btn red-sunglo dropdown-toggle" type="button">
							Tampilan &nbsp;<i class="fa fa-angle-down"></i>
						</button>
						<ul role="menu" class="dropdown-menu pull-right">
							<li>
								<a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewDashboard/01';?>" class="ajaxify" data-target="dashboard-container">
									</i>&nbsp; Daftar
								</a>
							</li>
							<li>
								<a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewDashboard/02';?>" class="ajaxify"  data-target="dashboard-container">
									&nbsp; Kelompok
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="dashboard-container" class="row">
	<div id="list-instansi-kategori" class="col-md-12">
		<div id="instansi-kategori-list" class="panel-group accordion">
			<?php
				if(count($instansi) > 0):
					$i =0;
					$logcount =array();
			?>
			<div class="row">
				<?php
					foreach ($instansi as $inst):
				?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat grey-cascade" style="height:145px;">
							<div class="visual" style="height:97px;">
								<?php
									$this->siaklib02->get_instansi_logo($inst['id_instansi'], $inst['id_category']);
								?>
							</div>
							<div class="details" style="width:60%;">
								<div class="number" id="<?php echo 'logcount-'.$inst['id_category'].$inst['id_instansi'];?>" style="text-align: right;"><?php echo $inst['log_count'];?></div>
								<div class="desc" style="text-align: right;"><?php echo $inst['instansi_name'];?></div>
							</div>
							<a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewInfoDashboard/'.$inst['id_instansi'].'/'.$inst['id_category'].'/01';?>" class="ajaxify more" data-toggle="tooltip" data-placement="bottom" data-target="dashboard-container">
								Tampilkan <i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
				<?php
						$logcount['logcount-'.$inst['id_category'].$inst['id_instansi']] ='logcount-'.$inst['id_category'].$inst['id_instansi'];
						$i++;
					endforeach;
				?>
				<div id="refreshdata-all" data-url="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/data_refresh_allDashboard?h='.$HARI.'&t='.(isset($delays) ? $delays: 15);?>" data-map='<?php echo json_encode($logcount);?>' data-noblock="true"></div>
				<script type="text/javascript">
					$(function() {
						ajax_function($('#refreshdata-all'));
					})
				</script>
			</div>
			<?php
				endif;
			?>
		</div>
	</div>
</div>
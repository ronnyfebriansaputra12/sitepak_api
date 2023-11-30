<?php 
//if($listData == NULL){ 
//	$this->siaklib->getNoInfo3('', 'main_siak_child');
//}
//else{
	//$tanggal =date_create($tgl);	
	//echo  date_format($tanggal, 'Y-m-d H:i:s');;
	//$hri_curr = $tanggal->format('w');
	//$tgl_curr = $tanggal->format('d');
	//$bln_curr = $tanggal->format('m');
	//$thn_curr = $tanggal->format('Y');

?>
<div class="col-md-12">
<h3 class="page-title" style="font-size:22px">
	<small><?php //echo strtoupper($this->siakwordconvert->getNamaHariId($hri_curr)).", ".$tgl_curr." ".strtoupper($this->siakwordconvert->getIndonesiaMonth($bln_curr))." ".$thn_curr;?></small>
</h3>
<?
	//$selesai 	= $listData[0]->berhasil + $listData[0]->manual;
	//$proses		= $listData[0]->proses;
	//$total 		= $listData[0]->berhasil + $listData[0]->manual + $listData[0]->proses ;
	
?>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat green">
			<div class="visual"></div>
			<div class="details">
				<div class="number" id="selesai" style="text-align: right;"><?//echo number_format($selesai,0,",",".")?></div>
				<div class="desc" style="text-align: right;">SELESAI</div>
			</div>
			<a href="#" class=" more" data-toggle="tooltip" data-placement="bottom" data-target="dashboard-container">
				&nbsp; <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat yellow">
			<div class="visual"></div>
			<div class="details">
				<div class="number" id="selesai" style="text-align: right;"><? //echo number_format($proses,0,",",".")?></div>
				<div class="desc" style="text-align: right;">PROSES</div>
			</div>
			<a href="#" class=" more" data-toggle="tooltip" data-placement="bottom" data-target="dashboard-container">
				&nbsp; <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat red">
			<div class="visual"></div>
			<div class="details">
				<div class="number" id="selesai" style="text-align: right;"><? //echo  number_format($total,0,",",".")?></div>
				<div class="desc" style="text-align: right;">TOTAL</div>
			</div>
			<a href="#" class=" more" data-toggle="tooltip" data-placement="bottom" data-target="dashboard-container">
				&nbsp; <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>						
</div>
<style>
table, th, td {
  border: 1px solid;
  border-color: rgb(220, 221, 221)
}
</style>
	<div class=" row col-md-12">
		<div class="col-md-5">
			
		</div>
		<div class="col-md-2">
		<br />
		<a href="#" class="btn purple kembali" data-target="siak_list" data-hidden="siak_edit"><i class="fa fa-arrow-circle-left"></i> Kembali</a>	
		<a href='<?php //echo base_url()."dashboard/app_dashboard/excelDashboardProp/".$tgl;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a>
		</div>
		<div class="col-md-5">
			
		</div>
	</div>
</div>
<div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>
<?php
//}
?>
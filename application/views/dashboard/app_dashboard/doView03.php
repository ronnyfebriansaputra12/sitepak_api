<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('', 'main_siak_child');
}
else{

?>
<div class="col-md-12">
<?
	$selesai 	= $listData[0]->berhasil + $listData[0]->manual;
	$proses		= $listData[0]->proses;
	$total 		= $listData[0]->berhasil + $listData[0]->manual + $listData[0]->proses ;
	
?>
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="dashboard-stat green">
			<div class="visual"></div>
			<div class="details">
				<div class="number" id="selesai" style="text-align: right;"><?echo number_format($selesai,0,",",".")?></div>
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
				<div class="number" id="selesai" style="text-align: right;"><? echo number_format($proses,0,",",".")?></div>
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
				<div class="number" id="selesai" style="text-align: right;"><? echo  number_format($total,0,",",".")?></div>
				<div class="desc" style="text-align: right;">TOTAL</div>
			</div>
			<a href="#" class=" more" data-toggle="tooltip" data-placement="bottom" data-target="dashboard-container">
				&nbsp; <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div					
</div>
<style>
table, th, td {
  border: 1px solid;
  border-color: rgb(220, 221, 221)
}
</style>
<table class="table table-striped table-hover">
	<thead>
	   <tr>
		 <th style="width:2%"><strong>No</strong></th>
			<th style="width:38%"><strong>NAMA PROVINSI</strong></th>
			<th style="width:8%"><strong>SELESAI</strong></th>
			<th style="width:8%"><strong>PROSES</strong></th>
			<th style="width:8%"><strong>TOTAL</strong></th>
			
	   </tr>
	</thead>
	<tbody>
		<?php $i=1;
			$jumWil = 0;
			$totSelesai = 0;
			$totProses = 0;
			$totManual = 0;
			$totData = 0;
		foreach($listDataGroup as $row):
			$jumWil = $row->tidak_valid + $row->berhasil + $row->manual+ $row->proses;
			$totSelesai = $totSelesai + $row->berhasil;
			$totProses = $totProses + $row->proses;
			$totManual = $totManual + $row->manual;
			
			$totData = $totData + $jumWil;
		?>
		
		<tr>
			<td align="center"><?php echo $i?></td>
			<td align="left"><a href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doView03Detail/'.$row->no_prop.'/'.$tgl;?>" data-hidden="siak_list" data-target="siak_edit" title="" data-placement="bottom" data-toggle="tooltip" class="ajaxify tooltips" style="text-decoration: none;"><?php echo $row->nama_prop?></a></td>
			<td align="right"><?php echo number_format($row->berhasil + $row->manual,0,",",".")?></td>
			<td align="right"><?php echo number_format($row->proses,0,",",".")?></td>
			<td align="right"><?php echo number_format($jumWil,0,",",".")?></td>
		</tr>
		<?php $i++;
		endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" align="center"><b>T O T A L</b></td>
		
			
			<td align="right"><?php echo number_format($totSelesai+$totManual,0,",",".")?></td>
			<td align="right"><?php echo number_format($totProses,0,",",".")?></td>
			<td align="right"><?php echo number_format($totData,0,",",".")?></td>
			
		</tr>
		
	</tfoot>
</table>
<div class=" row col-md-12">
		<div class="col-md-5">
			
		</div>
		<div class="col-md-2">
		<br />
		
		<a href='<?php echo base_url()."dashboard/app_dashboard/excelDashboardPropTahunan/".$tgl;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a>
		</div>
		<div class="col-md-5">
			
		</div>
	</div>
</div>
<div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>
<?php
}
?>
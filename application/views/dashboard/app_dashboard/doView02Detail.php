<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('', 'main_siak_child');
}
else{
	$tanggal =date_create('01-'.$tgl);	
	//echo  date_format($tanggal, 'Y-m-d H:i:s');;
	
	$bln_curr = $tanggal->format('m');
	$thn_curr = $tanggal->format('Y');

?>
<div class="form-actions form-group">                           
	<div class="row">
		<div  class="col-md-10">
			<h3 class="page-title" style="font-size:22px">
				MONITORING PENGADUAN BULANAN
			</h3>
		</div>
		<div  class="col-md-2">
			<h3 class="page-title" style="font-size:22px">
				BULAN <?php echo strtoupper($this->siakwordconvert->getIndonesiaMonth($bln_curr))." ".$thn_curr;?>	
			</h3>				
		</div>
	</div>
</div>
<br />
	
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
	</div>						
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
			<th style="width:38%"><strong>NAMA KABUPATEN/KOTA</strong></th>
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
			<td align="left"><?php echo $row->nama_kab?></td>
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
			<a href="#" class="btn purple kembali" data-target="siak_list" data-hidden="siak_edit"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
		
		<a href='<?php echo base_url()."dashboard/app_dashboard/excelDashboardBulanan/".$row->no_prop.'/'.$tgl;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a>
		</div>
		<div class="col-md-5">
			
		</div>
	</div>
	<br /><br /><br /><br />
</div>

<?php
}
?>
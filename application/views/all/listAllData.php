<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('Tidak ada data untuk ditampilkan', 'main_siak_child');
}
else{
?>
<table class="table table-striped table-hover">
   <thead>
	   <tr>
		 <th style="width:2%" rowspan="2"><strong>No</strong></th>
			<th style="width:25%" rowspan="2"><strong>NAMA LEMBAGA</strong></th>
			<th style="width:10%" rowspan="2"><strong>STATUS WEB SERVICE</strong></th>
			<th style="width:10%" rowspan="2"><strong>STATUS WEB PORTAL</strong></th>
			<th style="width:53%" colspan="6"><strong>METODE AKSES</strong></th>
			
	   </tr>
	    <tr>
			
			<th ><strong>WS LAMA</strong></th>
			<th ><strong>WS KOMBINASI</strong></th>
			<th ><strong>WS KESESUAIAN </strong></th>
			<th ><strong>FINGER PRINT </strong></th>
			<th ><strong>FACE RECOGNITION</strong></th>
			<th ><strong>WEB PORTAL</strong></th>
	   </tr>
	</thead>
	<tbody>
		<?php $i=$this->siak_paging->offset+1;
		foreach($listData as $row):
			if($row->kode_wilayah!='00'){
				$pengguna = $row->nama_pengguna." (".$row->kode_wilayah.")";
			}else{
				$pengguna = $row->nama_pengguna;
			}
			if($row->ws_stat_aktivasi==1){
				$wsAktifasi ="AKTIF" ;
			}else{
				$wsAktifasi ="TIDAK AKTIF" ;
			}
			
			if($row->wp_stat_aktivasi==1){
				$wpAktifasi ="AKTIF" ;
			}else{
				$wpAktifasi ="TIDAK AKTIF" ;
			}
			
		?>
		<tr>
		  <td align="center"><?php echo $i?></td>
		  <td><?=$pengguna;?></td>
		  <td><?php echo $wsAktifasi?></td>
		  <td><?php echo $wpAktifasi?></td>
		  <td><?php echo $this->fpd2klib->getstatusdata($row->ma_wsl)?></td>
		  <td><?php echo $this->fpd2klib->getstatusdata($row->ma_wskom)?></td>
		  <td><?php echo $this->fpd2klib->getstatusdata($row->ma_wskes)?></td>
		  <td><?php echo $this->fpd2klib->getstatusdata($row->ma_fp)?></td>
		  <td><?php echo $this->fpd2klib->getstatusdata($row->ma_fr)?></td>
		  <td><?php echo $this->fpd2klib->getstatusdata($row->ma_wp)?></td>
		  </td>
		 
		  
		</tr>
		 <?php $i++;
		endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="10">
				<div class="form-group">
					<div class="col-md-3"></div>
					<label class="control-label col-md-4"><?=$this->siak_paging->info_paging()?> </label>
					<div class="col-md-4" id="paging"><?=$this->siak_paging->form_paging(array())?></div>
				</div>
			</td>
		</tr>
	</tfoot>
</table>
<?php
}
?>
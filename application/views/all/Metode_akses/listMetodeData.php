<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('Tidak ada data untuk ditampilkan', 'main_siak_child');
}
else{
?>
<div  class="table-scrollable">
	<table class="table table-striped table-hover">
	   <thead>
		   <tr>
			 <th style="width:2%" rowspan="2"><strong>No</strong></th>
				<th style="width:25%" rowspan="2"><strong>NAMA LEMBAGA</strong></th>
				<th rowspan="2"><strong>STATUS WEB SERVICE</strong></th>
				<th rowspan="2"><strong>STATUS WEB PORTAL</strong></th>
				<th colspan="6"><strong>METODE AKSES</strong></th>
				<th colspan="2"><strong>JUMLAH USER WEB SERVICE</strong></th>
				<th colspan="2"><strong>JUMLAH USER WEB PORTAL</strong></th>
				
				<th colspan="2"><strong>JUMLAH TOTAL KUOTA WEB SERVICE</strong></th>
				<th colspan="2"><strong>JUMLAH TOTAL KUOTA WEB PORTAL</strong></th>
				
				<th rowspan="2"><strong>STATUS WEB SERVICE</strong></th>
				<th rowspan="2"><strong>STATUS WEB PORTAL</strong></th>
				<th colspan="2"><strong>TOTAL AKSES</strong></th>
		   </tr>
			<tr>
				
				<th ><strong>WS LAMA</strong></th>
				<th ><strong>WS KOMBINASI</strong></th>
				<th ><strong>WS KESESUAIAN </strong></th>
				<th ><strong>FINGER PRINT </strong></th>
				<th ><strong>FACE RECOGNITION</strong></th>
				<th ><strong>WEB PORTAL</strong></th>
				
				<th ><strong>Aktif</strong></th>
				<th ><strong>Non Aktif</strong></th>
				<th ><strong>Aktif</strong></th>
				<th ><strong>Non Aktif</strong></th>
				
				<th ><strong>Aktif</strong></th>
				<th ><strong>Non Aktif</strong></th>
				<th ><strong>Aktif</strong></th>
				<th ><strong>Non Aktif</strong></th>
				<th><strong>TOTAL AKSES WEB SERVICE</strong></th>
				<th><strong>TOTAL AKSES WEB PORTAL</strong></th>
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
				
				if($row->ws_akses_data==1){
					$wsSkala ="NASIONAL" ;
				}else{
					$wsSkala ="LOKAL" ;
				}
				
				if($row->wp_akses_data==1){
					$wpSkala ="NASIONAL" ;
				}elseif($row->wp_akses_data==null){
					$wpSkala="BELUM TERDAFTAR";
				}else{
					$wpSkala ="LOKAL" ;
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
			  <td><?php echo $row->ws_user_aktif?></td>
			  <td><?php echo $row->ws_user_nonaktif?></td>
			  <td><?php echo $row->wp_user_aktif?></td>
			  <td><?php echo $row->wp_user_nonaktif?></td>
			  
			  <td><?php echo $row->ws_kuota_aktif?></td>
			  <td><?php echo $row->ws_kuota_nonaktif?></td>
			  <td><?php echo $row->wp_kuota_aktif?></td>
			  <td><?php echo $row->wp_kuota_nonaktif?></td>
			  <td><?php echo $wsSkala?></td>
			  <td><?php echo $wpSkala?></td>
			  <td  align="right"><?php echo number_format($row->ta_ws_all,0,",",".")?></?></td>
			  <td  align="right"><?php echo number_format($row->ta_wp_all,0,",",".")?></?></td>
			  </td>
			 
			  
			</tr>
			 <?php $i++;
			endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="22">
					<div class="form-group">
						<div class="col-md-1"></div>
						<label class="control-label col-md-2"><?=$this->siak_paging->info_paging()?> </label>
						<div class="col-md-1" id="paging"><?=$this->siak_paging->form_paging(array())?></div>
					</div>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<br />
<?php
}
?>
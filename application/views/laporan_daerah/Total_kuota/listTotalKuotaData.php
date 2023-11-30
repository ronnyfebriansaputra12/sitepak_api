<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('Tidak ada data untuk ditampilkan', 'main_siak_child');
}
else{
?>
<div class="table-scrollable">
	<table class="table table-striped table-hover">
	   <thead>
		   <tr>
				<th rowspan="5"><strong>NO</strong></th>
				<th rowspan="5"><strong>NAMA LEMBAGA</strong></th>
				<th colspan="3"><strong>STATUS AKTIVASI PENGGUNA</strong></th>
				<th colspan="16"><strong>JUMLAH USER & KUOTA</strong></th>
		   </tr>
		   <tr>
				<th rowspan="4"><strong>WEB SERVICE</strong></th>
				<th rowspan="4"><strong>WEB PORTAL</strong></th>
				<th rowspan="4"><strong>BIOMETRIK</strong></th>
				<th rowspan="2" colspan="4"><strong>WEB SERVICE</strong></th>
				<th colspan="8"><strong>WEB PORTAL</strong></th>
				<th rowspan="2" colspan="4"><strong>BIOMETRIK</strong></th>
		   </tr>
		   <tr>
				<th colspan="4"><strong>ADMIN</strong></th>
				<th colspan="4"><strong>OPERATOR</strong></th>
		   </tr>
		   <tr>
				<th colspan="2"><strong>AKTIF</strong></th>
				<th colspan="2"><strong>TIDAK AKTIF</strong></th>
				<th colspan="2"><strong>AKTIF</strong></th>
				<th colspan="2"><strong>TIDAK AKTIF</strong></th>
				<th colspan="2"><strong>AKTIF</strong></th>
				<th colspan="2"><strong>TIDAK AKTIF</strong></th>
				<th colspan="2"><strong>AKTIF</strong></th>
				<th colspan="2"><strong>TIDAK AKTIF</strong></th>
		   </tr>
		   <tr>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
				<th><strong>USER</strong></th>
				<th><strong>KUOTA</strong></th>
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
				}elseif($row->ws_stat_aktivasi==2){
					$wsAktifasi ="TIDAK AKTIF" ;
				}else{
					$wsAktifasi ="TIDAK TERDAFTAR" ;
				}
				
				if($row->wp_stat_aktivasi==1){
					$wpAktifasi ="AKTIF" ;
				}elseif($row->wp_stat_aktivasi==2){
					$wpAktifasi ="TIDAK AKTIF" ;
				}else{
					$wpAktifasi ="TIDAK TERDAFTAR" ;
				}
				
				if($row->bio_stat_aktivasi==1){
					$bioAktifasi ="AKTIF" ;
				}elseif($row->bio_stat_aktivasi==2){
					$bioAktifasi ="TIDAK AKTIF" ;
				}else{
					$bioAktifasi ="TIDAK TERDAFTAR" ;
				}
				
			?>
			<tr>
			  <td align="center"><?php echo $i?></td>
			  <td><?=$pengguna;?></td>
			  <td align="center"><?php echo $wsAktifasi?></td>
			  <td align="center"><?php echo $wpAktifasi?></td>
			  <td align="center"><?php echo $bioAktifasi?></td>
			  
			  <td align="right"><?php echo number_format($row->ws_user_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ws_kuota_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->ws_user_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ws_kuota_nonaktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_ua_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ka_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_ua_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ka_nonaktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_uo_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ko_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_uo_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ko_nonaktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->bio_user_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->bio_kuota_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->bio_user_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->bio_kuota_nonaktif,0,",",".")?></?></td>
			</tr>
			 <?php $i++;
			endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="21">
					<div class="form-group">
						<? $arrQuery=[];
						foreach($_POST["CARI"] as $key=>$nilai){
							$arrQuery["CARI[".$key."]"]=$nilai;		
						}
						$filterCari=http_build_query($arrQuery);?>
						<div class="col-md-1 text-center"><a href='<?php echo base_url()."laporan_daerah/Total_kuota/excelReport?".$filterCari;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a></div>
						<div class="col-md-2 text-center"><label class="control-label text-center"><?=$this->siak_paging->info_paging()?> </label></div>
						<div class="col-md-1 text-center" id="paging"><?=$this->siak_paging->form_paging(array())?></div>
					</div>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php
}
?>
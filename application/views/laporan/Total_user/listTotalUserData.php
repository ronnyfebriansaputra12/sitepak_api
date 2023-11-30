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
				<th style="width:2%" rowspan="4"><strong>NO</strong></th>
				<th style="width:18%" rowspan="4"><strong>NAMA LEMBAGA</strong></th>
				<th style="width:30%" colspan="3"><strong>STATUS AKTIVASI PENGGUNA</strong></th>
				<th style="width:50%" colspan="8"><strong>JUMLAH USER</strong></th>
			</tr>
			<tr>
				<th style="width:10%" rowspan="3"><strong>WEB SERVICE</strong></th>
				<th style="width:10%" rowspan="3"><strong>WEB PORTAL</strong></th>
				<th style="width:10%" rowspan="3"><strong>BIOMETRIK</strong></th>
				<th style="width:16%" rowspan="2" colspan="2"><strong>WEB SERVICE</strong></th>
				<th style="width:16%" colspan="4"><strong>WEB PORTAL</strong></th>
				<th style="width:16%" rowspan="2" colspan="2"><strong>BIOMETRIK</strong></th>
			</tr>
			<tr>
				<th style="width:8%" colspan="2"><strong>ADMIN</strong></th>
				<th style="width:8%" colspan="2"><strong>OPERATOR</strong></th>
			</tr>
			<tr>
				<th style="width:6%"><strong>AKTIF</strong></th>
				<th style="width:6%"><strong>TIDAK AKTIF</strong></th>
				<th style="width:6%"><strong>AKTIF</strong></th>
				<th style="width:6%"><strong>TIDAK AKTIF</strong></th>
				<th style="width:6%"><strong>AKTIF</strong></th>
				<th style="width:6%"><strong>TIDAK AKTIF</strong></th>
				<th style="width:6%"><strong>AKTIF</strong></th>
				<th style="width:6%"><strong>TIDAK AKTIF</strong></th>
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
			  <td align="right"><?php echo number_format($row->ws_user_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ua_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ua_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_uo_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_uo_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->bio_user_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->bio_user_nonaktif,0,",",".")?></?></td>
			</tr>
			 <?php $i++;
			endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="14">
					<div class="form-group">
						<? $arrQuery=[];
						foreach($_POST["CARI"] as $key=>$nilai){
							$arrQuery["CARI[".$key."]"]=$nilai;		
						}
						$filterCari=http_build_query($arrQuery);?>
						<div class="col-md-1 text-center"><a href='<?php echo base_url()."laporan/Total_user/excelReport?".$filterCari;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a></div>
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
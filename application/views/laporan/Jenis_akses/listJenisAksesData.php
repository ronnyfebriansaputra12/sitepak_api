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
				<th rowspan="2"><strong>NO</strong></th>
				<th rowspan="2"><strong>NAMA LEMBAGA</strong></th>
				<th colspan="3"><strong>STATUS AKTIVASI PENGGUNA</strong></th>
				<th colspan="3"><strong>JENIS SKALA DATA</strong></th>
			</tr>
			<tr>
				<th><strong>WEB SERVICE</strong></th>
				<th><strong>WEB PORTAL</strong></th>
				<th><strong>BIOMETRIK</strong></th>
				<th><strong>WEB SERVICE</strong></th>
				<th><strong>WEB PORTAL</strong></th>
				<th><strong>BIOMETRIK</strong></th>
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
				
				if($row->ws_akses_data==1){
					$wsSkala ="NASIONAL" ;
				}elseif($row->ws_akses_data==7){
					$wsSkala="TIDAK TERDAFTAR";
				}else{
					$wsSkala ="LOKAL" ;
				}
				
				if($row->wp_akses_data==1){
					$wpSkala ="NASIONAL" ;
				}elseif($row->wp_akses_data==7){
					$wpSkala="TIDAK TERDAFTAR";
				}else{
					$wpSkala ="LOKAL" ;
				}
				
				if($row->bio_akses_data==1){
					$bioSkala ="NASIONAL" ;
				}elseif($row->bio_akses_data==7){
					$bioSkala="TIDAK TERDAFTAR";
				}else{
					$bioSkala ="LOKAL" ;
				}
			?>
			<tr>
			  <td align="center"><?php echo $i?></td>
			  <td align="left"><?=$pengguna;?></td>
			  <td align="center"><?php echo $wsAktifasi?></td>
			  <td align="center"><?php echo $wpAktifasi?></td>
			  <td align="center"><?php echo $bioAktifasi?></td>
			  <td align="center"><?php echo $wsSkala?></td>
			  <td align="center"><?php echo $wpSkala?></td>
			  <td align="center"><?php echo $bioSkala?></td>
			</tr>
			 <?php $i++;
			endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8">
					<div class="form-group">
						<? $arrQuery=[];
						foreach($_POST["CARI"] as $key=>$nilai){
							$arrQuery["CARI[".$key."]"]=$nilai;		
						}
						$filterCari=http_build_query($arrQuery);?>
						<div class="col-md-1 text-center"><a href='<?php echo base_url()."laporan/Jenis_akses/excelReport?".$filterCari;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a></div>
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
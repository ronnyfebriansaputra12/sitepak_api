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
				<th style="width:2%" rowspan="2"><strong>NO</strong></th>
				<th style="width:25%" rowspan="2"><strong>NAMA LEMBAGA</strong></th>
				<th style="width:24%" colspan="3"><strong>STATUS AKTIVASI PENGGUNA</strong></th>
				<th style="width:49%" colspan="6"><strong>METODE AKSES</strong></th>
			</tr>
			<tr>
				<th style="width:8%"><strong>STATUS WEB SERVICE</strong></th>
				<th style="width:8%"><strong>STATUS WEB PORTAL</strong></th>
				<th style="width:8%"><strong>STATUS BIOMETRIK</strong></th>
				<th style="width:8%"><strong>WS LAMA</strong></th>
				<th style="width:8%"><strong>WS KESESUAIAN </strong></th>
				<th style="width:8%"><strong>WS KOMBINASI</strong></th>
				<th style="width:8%"><strong>FINGER PRINT </strong></th>
				<th style="width:8%"><strong>FACE RECOGNITION</strong></th>
				<th style="width:8%"><strong>WEB PORTAL</strong></th>
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
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wsl)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wskes)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wskom)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_fp)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_fr)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wp)?></td>
			</tr>
			 <?php $i++;
			endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="12">
					<div class="form-group">
						<? $arrQuery=[];
						foreach($_POST["CARI"] as $key=>$nilai){
							$arrQuery["CARI[".$key."]"]=$nilai;		
						}
						$filterCari=http_build_query($arrQuery);?>
						<div class="col-md-1 text-center"><a href='<?php echo base_url()."laporan_daerah/Metode_akses/excelReport?".$filterCari;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a></div>
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
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
				<th style="background-color:#55ddcc;" rowspan="5" colspan="1"><strong>NO.</strong></th>
				<th style="background-color:#4dffb8;" rowspan="5" colspan="1"><strong>KODE</br>WILAYAH</strong></th>
				<th style="background-color:#00ff99;" rowspan="5" colspan="1"><strong>NAMA WILAYAH / NAMA PENGGUNA</strong></th>
				<th style="background-color:#33cc33;" rowspan="4" colspan="3"><strong>STATUS AKTIVASI PENGGUNA</strong></th>
				<th style="background-color:#ff9900;" rowspan="4" colspan="3"><strong>JENIS SKALA DATA AKSES</strong></th>
				<th style="background-color:#ff6600;" rowspan="1" colspan="14"><strong>JUMLAH USER & KUOTA</strong></th>
				<th style="background-color:#0099ff;" rowspan="4" colspan="6"><strong>METODE AKSES</strong></th>
				<th style="background-color:#ff1a1a;" rowspan="4" colspan="4"><strong>TOTAL AKSES</strong></th>
				<th style="background-color:#00ff99;" rowspan="5" colspan="1"><strong>STATUS AKSES</strong></th>
			</tr>
			
			<tr>
				<th style="background-color:#ff8533;" rowspan="2" colspan="4"><strong>WEB SERVICE</strong></th>
				<th style="background-color:#ff8533;" rowspan="1" colspan="6"><strong>WEB PORTAL</strong></th>
				<th style="background-color:#ff8533;" rowspan="2" colspan="4"><strong>BIOMETRIK</strong></th>
			</tr>
			
			<tr>
				<th style="background-color:#ff944d;" colspan="4"><strong>ADMIN</strong></th>
				<th style="background-color:#ff944d;" colspan="2"><strong>OPERATOR</strong></th>
			</tr>
			
			<tr>
				<th style="background-color:#ffb380;" colspan="2"><strong>AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="2"><strong>TIDAK AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="2"><strong>AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="2"><strong>TIDAK AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="1"><strong>AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="1"><strong>TIDAK AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="2"><strong>AKTIF</strong></th>
				<th style="background-color:#ffb380;" colspan="2"><strong>TIDAK AKTIF</strong></th>
			</tr>
			
			<tr>
				<th style="background-color:#5cd65c;"><strong>WEB SERVICE</strong></th>
				<th style="background-color:#5cd65c;"><strong>WEB PORTAL</strong></th>
				<th style="background-color:#5cd65c;"><strong>BIOMETRIK</strong></th>
				<th style="background-color:#ffad33;"><strong>WEB SERVICE</strong></th>
				<th style="background-color:#ffad33;"><strong>WEB PORTAL</strong></th>
				<th style="background-color:#ffad33;"><strong>BIOMETRIK</strong></th>
				
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>KUOTA</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>KUOTA</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>KUOTA</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>KUOTA</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>KUOTA</strong></th>
				<th style="background-color:#ff8533;"><strong>USER</strong></th>
				<th style="background-color:#ff8533;"><strong>KUOTA</strong></th>
				
				<th style="background-color:#33adff;"><strong>WS LAMA</strong></th>
				<th style="background-color:#33adff;"><strong>WS KESESUAIAN </strong></th>
				<th style="background-color:#33adff;"><strong>WS KOMBINASI</strong></th>
				<th style="background-color:#33adff;"><strong>FINGER PRINT </strong></th>
				<th style="background-color:#33adff;"><strong>FACE RECOGNITION</strong></th>
				<th style="background-color:#33adff;"><strong>WEB PORTAL</strong></th>
				
				<th style="background-color:#ff6666;"><strong>WEB SERVICE</strong></th>
				<th style="background-color:#ff6666;"><strong>WEB PORTAL</strong></th>
				<th style="background-color:#ff6666;"><strong>BIOMETRIK</strong></th>
				<th style="background-color:#ff6666;"><strong>TOTAL</strong></th>
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
				
				if($row->status_akses==1){
					$statusAkses ="SUDAH" ;
				}else{
					$statusAkses ="BELUM" ;
				}
				
			?>
			<tr>
			  <?php if($row->nama_wilayah == $row->nama_pengguna){ ?>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->no_urut?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->kode_wilayah?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->nama_pengguna?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ws_stat_aktivasi?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->wp_stat_aktivasi?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->bio_stat_aktivasi?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ws_akses_data?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->wp_akses_data?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->bio_akses_data?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ws_user_aktif,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ws_kuota_aktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ws_user_nonaktif,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ws_kuota_nonaktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->wp_ua_aktif,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->wp_ka_aktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->wp_ua_nonaktif,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->wp_ka_nonaktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->wp_uo_aktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->wp_uo_nonaktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->bio_user_aktif,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->bio_kuota_aktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->bio_user_nonaktif,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->bio_kuota_nonaktif,0,",",".")?></b></?></b></td>
			  
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ma_wsl?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ma_wskes?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ma_wskom?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ma_fp?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ma_fr?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->ma_wp?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ta_ws_all,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ta_wp_all,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ta_bio_all,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->ta_all,0,",",".")?></b></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo $row->status_akses?></b></td>
			  
			  <?php }else{ ?>
			  
			  <td align="center"><?php echo $row->no_urut?></td>
			  <td align="center"><?php echo $row->kode_wilayah?></td>
			  <td align="left"><?php echo $row->nama_pengguna?></td>
			  <td align="center"><?php echo $wsAktifasi?></td>
			  <td align="center"><?php echo $wpAktifasi?></td>
			  <td align="center"><?php echo $bioAktifasi?></td>
			  <td align="center"><?php echo $wsSkala?></td>
			  <td align="center"><?php echo $wpSkala?></td>
			  <td align="center"><?php echo $bioSkala?></td>
			  
			  <td align="right"><?php echo number_format($row->ws_user_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ws_kuota_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->ws_user_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ws_kuota_nonaktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_ua_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ka_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_ua_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->wp_ka_nonaktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_uo_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->wp_uo_nonaktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->bio_user_aktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->bio_kuota_aktif,0,",",".")?></?></td>
			  
			  <td align="right"><?php echo number_format($row->bio_user_nonaktif,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->bio_kuota_nonaktif,0,",",".")?></?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wsl)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wskes)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wskom)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_fp)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_fr)?></td>
			  <td align="center"><?php echo $this->fpd2klib->getstatusdata($row->ma_wp)?></td>
			  <td align="right"><?php echo number_format($row->ta_ws_all,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ta_wp_all,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ta_bio_all,0,",",".")?></?></td>
			  <td align="right"><?php echo number_format($row->ta_all,0,",",".")?></?></td>
			  <td align="center"><?php echo $statusAkses?></td>
			  
			  <? } ?>
			
			</tr>
			<?php endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="36">
					<div class="form-group">
						<? $arrQuery=[];
						foreach($_POST["CARI"] as $key=>$nilai){
							$arrQuery["CARI[".$key."]"]=$nilai;		
						}
						$filterCari=http_build_query($arrQuery);?>
						<div class="col-md-1 text-center"><a href='<?php echo base_url()."all/All_provinsi/excelReportAllProvinsi?".$filterCari;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a></div>
						<div class="col-md-2 text-center"><label class="control-label text-center"><?=$this->siak_paging->info_paging()?> </label></div>
						<div class="col-md-1 text-center" id="paging"><?=$this->siak_paging->form_paging(array())?></div>
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
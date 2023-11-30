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
			<th width="30%"><strong>NAMA WILAYAH</strong></th>
			<th width="10%"><strong>TOTAL PENGGUNA TERDAFTAR</strong></th>
			<th width="10%"><strong>TOTAL TERDAFTAR AKTIF</strong></th>
			<th width="10%"><strong>TOTAL AKTIF SUDAH AKSES</strong></th>
			<th width="10%"><strong>TOTAL AKTIF BELUM AKSES</strong></th>
			<th width="10%"><strong>TOTAL TERDAFTAR TIDAK AKTIF</strong></th>
			<th width="10%"><strong>TOTAL TIDAK AKTIF SUDAH AKSES</strong></th>
			<th width="10%"><strong>TOTAL TIDAK AKTIF BELUM AKSES</strong></th>
		</tr>
	</thead>
		<tbody>
			<?php $i=$this->siak_paging->offset+1;
			foreach($listData as $row):
			?>
			<tr>
			<?php
			if(preg_match('/\bTOTAL PENGGUNA\b/', $row->nama_wilayah)){
			?>
			  <td align="left" style="background-color:#ffe6e6;"><b><?php echo $row->nama_wilayah?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_pengguna_terdaftar,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_terdaftar_aktif,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_aktif_akses,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_aktif_belum_akses,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_terdaftar_tidak_aktif,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_tidak_aktif_akses,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ffe6e6;"><b><?php echo number_format($row->total_tidak_aktif_belum_akses,0,",",".")?></?></b></td>
			<?php
			} elseif(preg_match('/\bTOTAL KESELURUHAN\b/', $row->nama_wilayah)){
			?>
			  <td align="left" style="background-color:#ccffe6;"><b><?php echo $row->nama_wilayah?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_pengguna_terdaftar,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_terdaftar_aktif,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_aktif_akses,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_aktif_belum_akses,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_terdaftar_tidak_aktif,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_tidak_aktif_akses,0,",",".")?></?></b></td>
			  <td align="center" style="background-color:#ccffe6;"><b><?php echo number_format($row->total_tidak_aktif_belum_akses,0,",",".")?></?></b></td>
			<?php
			}else{
			?>
			  <td align="left"><?php echo $row->nama_wilayah?></td>
			  <td align="center"><?php echo number_format($row->total_pengguna_terdaftar,0,",",".")?></?></td>
			  <td align="center"><?php echo number_format($row->total_terdaftar_aktif,0,",",".")?></?></td>
			  <td align="center"><?php echo number_format($row->total_aktif_akses,0,",",".")?></?></td>
			  <td align="center"><?php echo number_format($row->total_aktif_belum_akses,0,",",".")?></?></td>
			  <td align="center"><?php echo number_format($row->total_terdaftar_tidak_aktif,0,",",".")?></?></td>
			  <td align="center"><?php echo number_format($row->total_tidak_aktif_akses,0,",",".")?></?></td>
			  <td align="center"><?php echo number_format($row->total_tidak_aktif_belum_akses,0,",",".")?></?></td>
			<?php
			}
			?>
			</tr>
			<?php //$i++;
			endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="35">
					<div class="form-group">
						<? $arrQuery=[];
						foreach($_POST["CARI"] as $key=>$nilai){
							$arrQuery["CARI[".$key."]"]=$nilai;		
						}
						$filterCari=http_build_query($arrQuery);?>
						<div class="col-md-1 text-center"><a href='<?php echo base_url()."resume/Resume_daerah/excelReportResume?".$filterCari;?>' class="btn btn-success" target="_blank"><i class="fa fa-download"></i> Excel</a></div>
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
<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('', 'main_siak_child');
}
else{
?>
<table class="table table-striped table-hover">
   <thead class="flip-content">
	   <tr>
		  <th width="5%"><strong>NO</strong></th>
		  <th width="10%" class="sorting" data-kolom="USER_ID"><strong>ID PENGGUNA</strong></th>
		  <th width="22%" class="sorting" data-kolom="NAMA_LGKP"><strong>NAMA LENGKAP</strong></th>
		  <th width="41%" class="sorting" data-kolom="C.LEVEL_NAME"><strong>KELOMPOK PENGGUNA</strong></th>
		  <th width="9%"><strong>PHOTO</strong></th>
		  <th width="13%"><strong>OPERASI</strong></th>
	   </tr>
	</thead>
	<tbody>
		<?php
            $i=$this->siak_paging->offset+1;
            foreach ($listData as $row) : 
        ?>
    
		<tr>
		  <td align="center"><?php echo $i;?>.</td>
		  <td><?php echo $row->user_id;?></td>
		  <td><?php echo $row->nama_lgkp;?></td>
		  <td><?php echo $row->level_name;?>&nbsp;&nbsp;<span class='label lable-sm label-<?=$this->siaklib->getLabelTingkatan($row->level_code)?>'><?=$row->tingkatan?></span></td>
          <?php
			$iconLock = "fa-lock";
			$iconTips = "Aktifkan?";
			$actUser = "1";
		  	if($row->status == "1"){
				$iconLock = "fa-unlock";
				$iconTips = "Non Aktifkan?";
				$actUser = "2";
			}
			if(file_exists('./upload/pic_pengguna/'.$row->user_id.'.jpg') == TRUE){
					$pathPhoto = base_url().'upload/pic_pengguna/'.$row->user_id.'.jpg?_='.time();
				}
				else{
					if($row->jenis_klmin==1){
					$pathPhoto = base_url().VER_TEMPLATE."assets/img/1.png";
					}
					else{
						$pathPhoto = base_url().VER_TEMPLATE."assets/img/2.png";
					}
				}
		  ?>
		  <td align="center">
		  	<img width="55" height="67" src="<?php echo $pathPhoto.'?_='.time();?>" id="photo_nik_<?=$row->user_id?>">
		  </td>
		  <td align="center">
          	<?php if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doView')):?>
			<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doView?userId='.$row->user_id?>" class="ajaxify fa-item tooltips" title="Lihat" data-placement="bottom" data-target="siak_edit" data-hidden="siak_list"><i class="fa fa-search"></i></a>
			<?php endif; ?>            
            <?php
				if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doEdit')):
					if(strlen(trim($this->siakconfig->getDefaultPassword())) >0){
			?>
            		<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doResetPassword?userId='.$row->user_id?>" class="hapus fa-item tooltips" data-msg="Apakah ingin me-reset kata kunci Id Pengguna : <b><?=$row->user_id?></b><br>menjadi <b><?=$this->siakconfig->getDefaultPassword()?></b>" title="Reset Password" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-refresh"></i></a>
            <?php
					}
			?>          


            	<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doEdit?userId='.$row->user_id.'&btnBack=Y'?>" class="ajaxify fa-item tooltips" title="Wilayah/Ubah" data-placement="bottom" data-target="siak_edit" data-hidden="siak_list"><i class="fa fa-thumb-tack"></i></a>
			<?php 
				endif; 
			?>
            <?php if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doDelete')):?>            
			<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doDelete?userId='.$row->user_id ?>" class="hapus fa-item tooltips" data-msg="Apakah ingin menghapus<br>Id Pengguna : <b><?=$row->user_id?></b>" data-refresh="frm_paging" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-times"></i></a>
            <?php endif; ?>
		  </td>
		</tr>
		<?php
            $i++;
            endforeach;
        ?>		
	</tbody>
	<tfoot >
		<tr>
			<td colspan="9">
				<div class="form-group">                    
					<div class="col-md-5"></div>
                    <label class="control-label col-md-4"><?=$this->siak_paging->info_paging()?> </label>
					<div class="col-md-3" id="paging"><?=$this->siak_paging->form_paging(array())?></div>                    
				</div>
			</td>
		</tr>
	</tfoot>    
</table>
<?php
}
?>
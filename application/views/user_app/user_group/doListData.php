<?php 
if($listData == NULL){ 
	$this->siaklib->getNoInfo3('', 'main_siak_child2');
}
else{
?>
<table class="table table-striped table-hover">
   <thead>
	   <tr>
		  <th width="5%"><strong>NO</strong></th>
		  <th class="sorting" data-kolom="USER_LEVEL" width="12%"><strong>KODE<br />KELOMPOK</strong></th>		  
		  <th class="sorting" data-kolom="LEVEL_NAME"><strong>NAMA KELOMPOK</strong></th>		  
		  <th class="sorting" data-kolom="GROUP_LEVEL"><strong>TINGKATAN</strong></th>		  
		  <th width="12%"><strong>OPERASI</strong></th>
	   </tr>
	</thead>
	<tbody>
		<?php $i=$this->siak_paging->offset+1;
		foreach($listData as $row):?>
		<tr>
		  <td align="center"><?php echo $i?></td>
		  <td align="center"><?php echo $row->user_level?></td>
		  <td><?php echo $row->level_name?></td>
		  <td><?php echo is_null($row->fpd2k_group_level)?'-':$row->fpd2k_group_level->level_name;?></td>		  
		  <td align="center">
          	<?php if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doView')):?>		  	
				<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewAccess/'.$row->user_level?>" class="ajaxify fa-item tooltips" style="padding:0;" title="Lihat" data-placement="bottom" data-target="siak_edit-user_group" data-hidden="siak_list-user_group"><i class="fa fa-search"></i></a>
            <?php endif; ?>
            <?php 
				if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doAccess01')):?>
				<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doAccess/'.$row->user_level?>" class="ajaxify fa-item tooltips" style="padding:0;" title="Hak Akses/Ubah" data-placement="bottom" data-target="siak_edit-user_group" data-hidden="siak_list-user_group"><i class="fa fa-sitemap"></i></a>
            <?php endif; ?>
            <?php if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doAdd')):?>
            <a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doDuplikasi/'.$row->user_level?>" class="ajaxify fa-item tooltips" style="padding:0;" title="Duplikasi" data-placement="bottom" data-target="siak_edit-user_group" data-hidden="siak_list-user_group"><i class="fa fa-files-o"></i></a>
			<?php endif; ?>            
            <?php if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doDelete')):?>            
            <a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doDelete/'.$row->user_level?>" class="hapus fa-item tooltips" style="padding:0;" data-msg="Apakah ingin menghapus Kelompok Pengguna : <br/><b><?=$row->user_level." - ".$row->level_name?></b>" data-refresh="formSearch2" data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="fa fa-times"></i></a>
            <?php endif; ?>            
		  </td>
		</tr>
		<?php $i++;
		endforeach;?>		
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8">
				<div class="form-group">
					<div class="col-md-4"></div>
					<label class="control-label col-md-4"><?=$this->siak_paging->info_paging()?> </label>
					<div class="col-md-4" id="paging"><?=$this->siak_paging->form_paging(array('div_table'=>'main_siak_child2'))?></div>
				</div>
			</td>
		</tr>
	</tfoot>
</table>
<?php
}
?>
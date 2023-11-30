<?php
if($user_list == NULL):
	$this->siaklib->getNoInfo4('Daftar pengguna tidak ditemukan', 'siak_list', 'siak_edit');
else:
?>
<div id="list_user_level<?php echo $user_level;?>">
	<div class="col-md-12" align="center">
		<div class="page-title" style="font-size:18px">USER</div>
	</div>
	<table class="table table-striped table-hover">
		<thead class="flip-content">
			<tr>
				<th width="5%"><strong>NO</strong></th>
				<th width="30%" class="sorting" data-kolom="T5_SIAK_USER.USER_ID"><strong>ID PENGGUNA</strong></th>
				<th width="38%" class="sorting" data-kolom="T5_SIAK_USER.NAMA_LGKP"><strong>NAMA LENGKAP</strong></th>
				<th width="18%" class="sorting" data-kolom="T5_SIAK_USER.JENIS_KLMIN"><strong>JENIS <br /> KELAMIN</strong></th>
				<th width="9%"><strong>PHOTO</strong></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no =$this->siak_paging->offset+1;
				foreach($user_list as $row):
				$vStatus = "A";
				$vBadge = "success";
				if(empty($row->session_id)){
					$vBadge = "danger";
					$vStatus = "T";
					$vTime = "";
				}
			?>
				<tr>
					<td align="center">
						<?php echo $no;?>.
					</td>
					<td align="left"><span class="badge badge-<?=$vBadge?>"><?=$vStatus?></span>&nbsp;
						<?php echo $row->user_id;?>		
					</td>
					<td align="left">
						<?php echo $row->nama_lgkp;?>
					</td>
					<td align="center">
						<?php echo ($row->jenis_klmin == 1)?'LAKI-LAKI':'PEREMPUAN';?>
					</td>
					
					<td align="center">
						<img src="<?php echo base_url().'upload/pic_pengguna/'.$row->user_id.'.jpg?_='.time();?>" class="img-responsive" width="55" onerror="this.src='<?php echo base_url().VER_TEMPLATE."assets/img/".$row->jenis_klmin.".png?_=".time();?>'" />
					</td>
				</tr>
			<?php
					$no++;
				endforeach;
			?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5">
					<div class="form-group">
						<div class="col-md-5">&nbsp;</div>
						<div class="col-md-5">
							<label class="control-label"><?=$this->siak_paging->info_paging();?> </label>
						</div>
						<div class="col-md-2" id="paging"><?=$this->siak_paging->form_paging(array('div_table' => 'list_user_level'.$user_level, 'form_act' => '/'.$user_level));?></div>
					</div>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php
endif;
?>
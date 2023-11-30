<?php
	if($listData == NULL):
		$this->siaklib->getNoInfo5("TIDAK ADA AKTIVITAS");
	else:
?>
<div id="list_aktifitas-per_user">
	<table class="table table-striped table-hover">
		<thead class="flip-content">
			<tr>
				<th width="5%">#</th>
				<th width="13%">USER ID</th>
				<th width="13%">ALAMAT IP</th>
				<th width="13%">WAKTU</th>
				<th width="21%">MODUL</th>
				<th width="35%">KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=$this->siak_paging->offset+1;
				foreach ($listData as $row) : 
			?>
				<tr >
					<td align="center"><?php echo $i;?>.</td>
					<td align="left"><i class="fa fa-user"></i>&nbsp;<?php echo $row->user_id;?></td>
					<td align="left"><i class="fa fa-laptop"></i>&nbsp;<?php echo $row->ip_address;?></td>
					<td align="left">
						<i class="fa fa-calendar"></i>&nbsp;<?php echo $row->activity_date->format('d-m-Y');?><br/>
						<i class="fa fa-clock-o"></i>&nbsp;<?php echo $row->activity_date->format('H:i:s');?>
					</td>
					<td>
						<?php 
							echo is_null($this->siakactivity->get_activity_module_list($row->activity_mod))
								?"-"
								:$this->siakactivity->get_activity_module_list($row->activity_mod)->activity_module."  ".$this->siakactivity->get_activity_module_list($row->activity_mod)->activity_name;
						?>
						&nbsp;
						<?php 
							echo is_null($this->siakactivity->get_activity_operand_list($row->activity_type))
								?""
								:'<span class="label '.$this->siakactivity->get_activity_operand_list($row->activity_type)->clazz.'">'.$this->siakactivity->get_activity_operand_list($row->activity_type)->activity_name.'</span>';
						?>
					</td>
					<td>
						<?php echo $row->activity_desc1.$row->activity_desc2.$row->activity_desc3.$row->activity_desc4.$row->activity_desc5;?>  
					</td>
				</tr>
			<?php
				$i++;
				endforeach;
			?>      
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="col-md-6"></div>
					<label class="control-label col-md-4"><?=$this->siak_paging->info_paging();?></label>
					<div class="col-md-2" id="paging"><?=$this->siak_paging->form_paging(array('div_table' =>"list_aktifitas-per_user"));?></div>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<script type="text/javascript">
$(function(){
	$.uniform.restore('.make-switch');
	$('.make-switch').bootstrapSwitch('destroy');
	$('.make-switch').parent().css('margin-top', '-11px');
})
</script>
<?php 
	endif;
?>
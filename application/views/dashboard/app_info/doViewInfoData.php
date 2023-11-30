<?php
	if($list === NULL):
		$this->siaklib->getNoInfo3(ucfirst(strtolower($caption)).' kosong', 'info-instansi'.$instansi.'-kategori-detail');
	else:
?>
<div class="portlet box black">
	<div class="portlet-title">
		<div class="caption" style="padding-bottom: 0; padding-top: 8px;""><small><?php echo $caption;?> (<?php echo $count_act;?> Aktivitas terakhir)</small></div>
		<div class="actions"></div>
	</div>
	<div class="portlet-body">
		<div class="table-responsive">
			<?php
				if($index == 1):
			?>
				<table class="table table-striped table-bordered table-advance">
					<thead>
						<tr>
							<th width="3%"><strong>NO</strong></th>
							<th width="21%"><strong>USERNAME</strong></th>
							<th width="13%"><strong>TANGGAL AKSES</strong></th>
							<th width="55%"><strong>INFORMASI</strong></th>
							<th width="8%"><strong>STATUS</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$urut =1;
							foreach($list as $row):
						?>
						<tr>
							<td align="center">
								<?php echo $urut;?>
							</td>
							<td>
								<?php echo $row->username;?>	
							</td>
							<td>
								<i class="fa fa-calendar"></i> <?php echo $row->created_date->format('d-m-Y');?>
								<br/><i class="fa fa-clock-o"></i> <?php echo $row->created_date->format('H:i:s');?>
							</td>
							<td>
								<?php echo $row->raw_body;?>	
							</td>
							<td align="center">
								<i class="fa fa-circle <?php echo ($row->status_no != 200 ? 'text-danger' : 'text-success');?>"></i>	
							</td>
						</tr>
						<?php
								$urut++;
							endforeach;
						?>
					</tbody>
				</table>	
			<?php
				else:
			?>
				<table class="table table-striped table-bordered table-advance">
					<thead>
						<tr>
							<th width="3%"><strong>NO</strong></th>
							<th width="21%"><strong>USERNAME</strong></th>
							<th width="13%"><strong>TANGGAL AKSES</strong></th>
							<th width="63%"><strong>INFORMASI</strong></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$urut =1;
							foreach($list as $row):
						?>
						<tr>
							<td align="center">
								<?php echo $urut;?>
							</td>
							<td>
								<?php echo $row->username;?>	
							</td>
							<td>
								<i class="fa fa-calendar"></i> <?php echo $row->created_date->format('d-m-Y');?>
								<br/><i class="fa fa-clock-o"></i> <?php echo $row->created_date->format('H:i:s');?>
							</td>
							<td>
								<?php echo $row->raw_body;?>	
							</td>
						</tr>
						<?php
								$urut++;
							endforeach;
						?>
					</tbody>
				</table>
			<?php
				endif;
			?>		
		</div>
		<!-- <div class="scroller" style="height:377px">
		</div> -->
	</div>
</div>
<?php
	endif;
?>
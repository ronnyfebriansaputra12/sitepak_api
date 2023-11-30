<?php 
if($data == NULL){
	$this->siaklib->getNoInfo4('Level pengguna: <b>'.$USER_LEVEL.'</b> tidak ditemukan atau telah dihapus dalam database', 'siak_list', 'siak_edit');
} 
else{
?>
<div class="portlet box black">
  <div class="portlet-title">
	 <div class="caption">UBAH KELOMPOK PENGGUNA</div>     
  </div>
  <div class="portlet-body form">  	
	 <form class="form-horizontal" id="frmEdit" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$user_level?>" method="post" data-refresh="frm_paging" data-nondisable="true">
		<div class="form-body">
			<h4 class="form-section">KELOMPOK PENGGUNA</h4>
			<div class="row"> 
				<div class="col-md-12">
					 <div class="form-group">
						  <label class="col-md-2 control-label">Kode</label>
						  <div class="col-md-4 control-label">
							<b class="font_biru"><?=$data[0]->user_level?></b>
							 <input type="hidden" name="tabel[USER_LEVEL]" id="USER_LEVEL" value="<?=$data[0]->user_level?>" disabled="disabled">
						  </div>
					 </div>
				</div>
			</div>        
			<div class="row">
				<div class="col-md-12">
					 <div class="form-group">
						  <label class="col-md-2 control-label">Nama Kelompok</label>
						  <div class="col-md-5">
							 <input type="text" maxlength="100" class="form-control input-sm mask-alamat"  placeholder="Nama Kelompok" name="tabel[LEVEL_NAME]" id="LEVEL_NAME" data-rule-required="true" data-msg-required="Nama Kelompok harus diisi" value="<?=$data[0]->level_name?>">
						  </div>
					 </div>
				</div>
			</div>       
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						  <label class="col-md-2 control-label">Tingkatan</label>
						  <div class="col-md-4">
							<?php echo form_dropdown('X_GROUP_LEVEL',$cb_group_level,$data[0]->group_level,'class="form-control input-sm" id="X_GROUP_LEVEL"  readonly="readonly"')?>
						  </div>
					</div>
				</div>
			</div>  
		</div>
		<?php
		if($listData == NULL){
			$this->siaklib->getNoInfo5('Tidak ada yang dapat ditampilkan');
		} 
		else{
		?>
		<div class="portlet-body">
			<div class="table-responsive">
				<div id="main_siak_child">  
				<table class="table table-striped table-hover" id="tree_access">
				   <thead>
					   <tr>
							<th width="20%"><strong>HAK AKSES</strong></th>
							<th width="70%"><strong>NAMA MENU</strong></th>
							<th width="10%"><strong>ATURAN AKSES</strong></th>					  
					   </tr>
					</thead>
					<tbody>
						<?php 
						foreach($listData as $row):?>
						<tr data-tt-id="<?php echo $row->id ?>" data-tt-parent-id="<?php echo $row->parent_id ?>" data-tt-branch="<?php echo $row->jumlah_anak($data[0]->group_level)->jumlah == 0 ? "false" :"true" ?>" data-href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$user_level.'/'.$row->id?>">
							<td><?php $data_akses=$row->menu_access($user_level);?><input type="hidden" name="akses[<?php echo $row->id?>]" value="N"><input type="checkbox" id="akses<?php echo $row->id?>" data-id="<?php echo $row->id?>" name="akses[<?php echo $row->id?>]" class="akses" value="Y" <?php if($data_akses):?>checked="checked"<?php endif;?> ></td>
							<td valign="top"><font color="#006666"><?php echo "<b>".$row->menu_display."</b>";?></font></td>
							<td><?php if($row->tipe=='RULE'):?><?php endif;?></td>					
						</tr>
						<?php 
						endforeach;?>		
					</tbody>			
				</table>
				</div>
			</div>
		</div>
		<?php
		}
		?>
		<div class="form-actions right">                           
		   <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
           <?php
		   		if($btnBack <> "N"){
		   ?>
	           <a href="#" class="btn purple kembali" data-target="siak_list-user_group" data-hidden="siak_edit-user_group"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
           <?php
		   		}
		   ?>
		</div>
	 </form>
  </div>
</div>
<script>
	$(function(){
		$("#tree_access").treetable({
			expandable: true,
			onNodeExpand: function(e) {				
				var node = this;
				var href = $('tr[data-tt-id='+node.id+']').data('href');				
				if($('#akses'+node.id).is(':checked')){
						if($('tr[data-tt-parent-id="'+node.id+'"]').length==0){
							$.ajax({
								async: false, 
								url: href
							}).done(function(html) {
								var rows = $(html).filter("tr");				
								$("#tree_access").treetable("loadBranch", node, rows);
								App.initAjax();
								$("input[type='checkbox'].akses",$("tr[data-tt-parent-id='"+node.id+"']")).each(function( index ) {
									if(!$(this).is(':checked')){
										$('span.indenter a',$("tr[data-tt-id='"+$(this).data("id")+"']")).hide();
									}	
								});	
							});	
						}						
				}				
			}
		});
		$( "input[type='checkbox'].akses" ).each(function( index ) {
			if(!$(this).is(':checked')){
				$('span.indenter a',$("tr[data-tt-id='"+$(this).data("id")+"']")).hide();
			}	
		});		
		$('#tree_access').on('click','.akses',function(e){
			if($(e.target).is(':enabled')){
				if($(e.target).is(':checked')){					
					$("input[type='checkbox']",$("tr[data-tt-parent-id='"+$(e.target).data("id")+"']")).attr('disabled',false);						
					$("[name='param["+$(this).data("id")+"]']").attr('disabled',false);				
					$.uniform.update("tr[data-tt-parent-id='"+$(e.target).data("id")+"'] input[type='checkbox']");
					$('span.indenter a',$("tr[data-tt-id='"+$(e.target).data("id")+"']")).show();
				}else{
					$('span.indenter a',$("tr[data-tt-id='"+$(e.target).data("id")+"']")).hide();
					$('#tree_access').treetable('collapseNode',$(e.target).data("id"));
					$("input[type='checkbox'][name^='akses["+$(e.target).data("id")+"']").attr('disabled',true);
					$("[name='param["+$(this).data("id")+"]']").attr('disabled',true);	
					$(e.target).attr('disabled',false);
					$("input[type='checkbox'][name^='akses["+$(e.target).data("id")+"']").attr('checked',false);
					$.uniform.update("input[type='checkbox'][name^='akses["+$(e.target).data("id")+"']");					
				}				
			}			
		});		
		$('#frmEdit').validate(option_form);
		$.data($('#frmEdit')[0], 'validator').settings.ignore = "";
		$('select[readonly="readonly"]').select_readonly();
	});
</script>
<?php 
}
?>
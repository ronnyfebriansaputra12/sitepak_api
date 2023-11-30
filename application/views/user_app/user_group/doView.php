<div class="portlet box blue">
  <div class="portlet-title">
	 <div class="caption">UBAH PENGGUNA/AKSES GROUP</div>
    <div class="actions">
        <a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doList'?>" class="btn yellow ajaxify" data-target="main_siak_show"> Daftar</a>
        <a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doAdd'?>" class="btn green ajaxify" data-target="main_siak_show"> Tambah</a>
    </div>
  </div>
  <div class="portlet-body form">  	
	 <form class="form-horizontal" id="frmEdit" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$user_level?>" method="post">
		<div class="form-body">
			<h4 class="form-section">KELOMPOK PENGGUNA</h4>
			<div class="row"> 
				<div class="col-md-12">
					 <div class="form-group">
						  <div class="col-md-2">Kode</div>
						  <div class="col-md-1">:&nbsp;<b><?=$data[0]->user_level?></b></div>
					 </div>
				</div>
			</div>        
			<div class="row">
				<div class="col-md-12">
					 <div class="form-group">
						  <div class="col-md-2">Nama Kelompok</div>
						  <div class="col-md-5">:&nbsp;<b><?=$data[0]->level_name?></b></div>
					 </div>
				</div>
			</div>       
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						  <div class="col-md-2">Tingkatan</div>
						  <div class="col-md-2">:&nbsp;<b><?=$data[0]->t5_group_level->level_name?></b></div>
					</div>
				</div>
			</div>  
		</div>
		<div class="portlet-body">
			<div class="table-responsive">
				<div id="main_siak_child">  
				<table class="table table-striped table-hover" id="tree_access">
				   <thead>
					   <tr>
							<th width="15%"><strong>HAK AKSES</strong></th>
							<th width="45%"><strong>NAMA MENU</strong></th>
							<th width="40%"><strong>ATURAN AKSES</strong></th>					  
					   </tr>
					</thead>
					<tbody>
						<?php 
						foreach($listData as $row):?>
						<tr data-tt-id="<?php echo $row->id ?>" data-tt-parent-id="<?php echo $row->parent_id ?>" data-tt-branch="<?php echo $row->jumlah_anak($user_level)->jumlah == 0 ? "false" :"true" ?>" data-href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$user_level.'/'.$row->id?>">
							<td><?php $data_akses=$row->menu_access($user_level);?><input type="hidden" name="akses[<?php echo $row->id?>]" value="N"><input type="checkbox" id="akses<?php echo $row->id?>" data-id="<?php echo $row->id?>" name="akses[<?php echo $row->id?>]" class="akses" value="Y" <?php if($data_akses):?>checked="checked"<?php endif;?> ></td>
							<td valign="top"><font color="#660000"><?php echo "<b>".$row->menu_name."</b>";?></font></td>
							<td><?php if($row->tipe=='RULE'):?><?php endif;?></td>					
						</tr>
						<?php 
						endforeach;?>		
					</tbody>			
				</table>
				</div>
			</div>
		</div>       
		<div class="form-actions right">                           
           <a href="#" class="btn purple kembali" data-target="siak_list" data-hidden="siak_edit"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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
					$.uniform.update("tr[data-tt-parent-id='"+$(e.target).data("id")+"'] input[type='checkbox']");
					$('span.indenter a',$("tr[data-tt-id='"+$(e.target).data("id")+"']")).show();
				}else{
					$('span.indenter a',$("tr[data-tt-id='"+$(e.target).data("id")+"']")).hide();
					$('#tree_access').treetable('collapseNode',$(e.target).data("id"));
					$("input[type='checkbox'][name^='akses["+$(e.target).data("id")+"']").attr('disabled',true);
					$(e.target).attr('disabled',false);
					$("input[type='checkbox'][name^='akses["+$(e.target).data("id")+"']").attr('checked',false);
					$.uniform.update("input[type='checkbox'][name^='akses["+$(e.target).data("id")+"']");					
				}				
			}			
		});
		$('#frmEdit').validate(option_form);		
	});

</script>
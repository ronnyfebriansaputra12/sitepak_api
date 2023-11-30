<?php 
if($listData == NULL){
	$this->siaklib->getNoInfo5('Tidak ada yang dapat ditampilkan');
} 
else{
?>
				<?php $belumtampil=true;
				foreach($listData as $row):?>
				<tr data-tt-id="<?php echo $row->id ?>" 
                	data-tt-parent-id="<?php echo $row->parent_id ?>" 
                    data-tt-branch="<?php echo $row->jumlah_anak($data[0]->group_level)->jumlah == 0 ? "false" :"true" ?>" 
                    data-href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$user_level.'/'.$row->id?>">
				  <td><?php $data_akses=$row->menu_access($user_level);?><input type="hidden" name="akses[<?php echo $row->id?>]" value="N"><input type="checkbox" id="akses<?php echo $row->id?>" data-id="<?php echo $row->id?>" name="akses[<?php echo $row->id?>]" class="akses" value="Y" <?php if($data_akses):?>checked="checked"<?php endif;?> ></td>					  
				  <td><?php 
				  			$arrMenu = $this->siaklib->getMenuDisplay($row->tipe,$row->id);
							echo $arrMenu["space"].'<font color="'.$arrMenu["color"].'"><b>'.$row->menu_name.'</b></font>';
						?>
                  </td>
				  <td><?php if($row->tipe=='RULE' && !empty($row->rule_content)){
					  $rule=json_decode($row->rule_content);
					  if($rule->tipe!='dropdown'){
					  	$value="";
					  	if($data_akses){					  		
					  		$value=$data_akses->rule_param;
					  	}else{
					  		$rule->options.=' disabled="disabled"';
					  	}
					  	$form="form_".$rule->tipe;
					  	echo $form('param['.$row->id.']',$value,$rule->options);	
					  }else{
					  	$value="";
					  	if($data_akses){
					  		if( ! strpos($rule->options, 'multiple')){
					  			$value=$data_akses->rule_param;	
					  		}else{
					  			$value=explode(',',$data_akses->rule_param);	
					  		}	  		
					  	}else{
					  		$rule->options.=' disabled="disabled"';
					  	}
					  	$form="form_".$rule->tipe;
					  	echo $form('param['.$row->id.']',$rule->extra,$value,$rule->options);
					  }					  
				  }  				  
				  ?></td>
				  <?if($belumtampil):?>
				  	<script>
				  		$(function(){
				  			$(".mask-angka").inputmask("Regex",{
								regex: "[0-9]*",			
							});
				  		});
				  	</script>
				  <? $belumtampil=false;
				  endif;?>				 									  				  
				</tr>
				<?php 
				endforeach;?>
				
<?php 
}
?>
					<form id="<?=$form_id?>" action="<?=$this->router->fetch_directory().$this->router->fetch_class().'/'.$this->router->fetch_method().$form_act;?>" method="post" data-target="<?=$div_table?>">
					<?if($halaman>1):?>	
					<a class="sebelum" href="#">
						<span class="fa fa-caret-left"></span>
					</a>
					<?endif;?>
					<? foreach($_POST as $key => $value):
						if($key!="page"){
							if(is_array($value)){
								foreach($value as $keychild => $valuechild):?>
						<input type="hidden" name="<?=$key.'['.$keychild.']'?>" value="<?=$valuechild?>"/>	
						<?	endforeach;
							}else{?>	
							<input type="hidden" name="<?=$key?>" value="<?=$value?>"/>	
						<? }
						}
					endforeach;
					if(!isset($_POST['order'])) :?>
						<input type="hidden" name="order" value=""/>	
					<? endif;?>					
					<input type="text" class="form-control input-sm" name="page" placeholder="" data-msg-min="Halaman Tidak Valid" data-rule-min="1" data-msg-max="Halaman tidak valid" data-rule-max="<?=$jumlah_halaman?>" value="<?=$halaman?>">
					<?if($halaman<$jumlah_halaman):?>	
					<a class="sesudah" href="#">
						<span class="fa fa-caret-right"></span>
					</a>
					<?endif;?>
					</form>
					<script language="javascript">
						$(function(){
							$('#<?=$form_id?>').validate(option_form);
							$('.sebelum',$('#<?=$form_id?>')).click(function(){
								$("input[name='page']",$('#<?=$form_id?>')).val('<?=$halaman-1?>');
								$('#<?=$form_id?>').submit();
							});
							$('.sesudah',$('#<?=$form_id?>')).click(function(){
								$("input[name='page']",$('#<?=$form_id?>')).val('<?=$halaman+1?>');
								$('#<?=$form_id?>').submit();
							});
							$("input[name='page']",$('#<?=$form_id?>')).inputmask("integer",
							 { allowMinus: false, allowPlus: true , rightAlign: false});
							$("input[name='page']",$('#<?=$form_id?>')).css("text-align","center");
							<? if(isset($_POST['order'])) :?>
							var order="<?=$_POST['order']?>".split(" ");							
							if(order[1]==undefined){
								$(".table thead .sorting[data-kolom='"+order[0]+"']").addClass("sorting_desc");
								$(".table thead .sorting[data-kolom='"+order[0]+"']").removeClass("sorting");	
							}else{
								$(".table thead .sorting[data-kolom='"+order[0]+"']").addClass("sorting_asc");
								$(".table thead .sorting[data-kolom='"+order[0]+"']").removeClass("sorting");	
							}
							<? endif?>
							$(".table thead .sorting,.table thead .sorting_asc",$("#<?=$div_table?>")).click(function(){
								$("input[name='order']",$('#<?=$form_id?>')).val($(this).data("kolom"));
								$("input[name='page']",$('#<?=$form_id?>')).val(1);
								$('#<?=$form_id?>').submit();	
							});
							$(".table thead .sorting_desc",$("#<?=$div_table?>")).click(function(){
								$("input[name='order']",$('#<?=$form_id?>')).val($(this).data("kolom")+" DESC");
								$("input[name='page']",$('#<?=$form_id?>')).val(1);
								$('#<?=$form_id?>').submit();
							});
						});
					</script>
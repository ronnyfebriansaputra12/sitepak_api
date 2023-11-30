<div class="row">
	<div class="col-md-12" id="siak_pengaturan_pengguna">
		<div class="tabbable-custom">
			<div class="tab-content" id="tab-pengaturan-peruser" style="padding:0">
				<div class="portlet-body form">
					<form class="form-horizontal" id="form_pengaturan_pengguna" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doPengaturan'?>" method="post">
						<div class="form-body">
							<div class="portlet">
								<div class="portlet-title">
									<label class="control-label siak-font">DISPLAY APLIKASI</label>
									<div class="tools">
										 <a href="javascript:;" class="collapse"></a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="row jarak">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label col-md-5">Daftar Pencarian (Jumlah Max. Record Per halaman)</label>
												<div class="col-md-4">
													<?php
														$halaman =array(
															'' => "== PILIHAN ==", 
															"10" => "10",
															"15" => "15",
															"20" => "20",
															"25" => "25",
															"30" => "30",
															"35" => "35",
															"40" => "40",
															"45" => "45",
															"50" => "50"
														);
														$curr_setting =((is_null($this->siakconfig->getViewConfigUser($this->session_activerecord->userdata('user_id'), $this->session_activerecord->userdata('is_internal'), "MAX_PAGINATION", "valuez1"))) 
															|| ($this->siakconfig->getViewConfigUser($this->session_activerecord->userdata('user_id'), $this->session_activerecord->userdata('is_internal'), "MAX_PAGINATION", "valuez1") == ""))
															?"10"
															:$this->siakconfig->getViewConfigUser($this->session_activerecord->userdata('user_id'), $this->session_activerecord->userdata('is_internal'), "MAX_PAGINATION", "valuez1");

														echo form_dropdown('MAX_PAGINATION', $halaman, $curr_setting, 'id="MAX_PAGINATION" class="form-control input-sm"');
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>               
						</div>
						<div class="form-actions right">                         
							<button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
						</div>            
					</form>
				</div>
			</div>
		</div>
	</div>                             
</div>
<script>
$(function(){
	$('#form_pengaturan_pengguna').validate(option_form);
	$(".mask-angka").inputmask("Regex",{
		regex: "[0-9]*",
	});	
	
	$(".mask-nama").inputmask("X{+}", {
		  definitions: {
				"X": {
					 validator: "[a-zA-Z\', .\-]",
					 casing: "upper"
				}
		  }
	 });
	$.uniform.restore('.make-switch');
	$('.make-switch').bootstrapSwitch();
	$('.my_menu').each(function(e){
		$(this).on('switch-change', function(e, checkboxes){
			if(checkboxes.value == true){
				$('#'+$(checkboxes.el).data('dicentang')).val("Y");
				if($(checkboxes.el).data('formterkait')){
					$('#'+$(checkboxes.el).data('formterkait')).removeClass('hidden');
					if($('#'+$(checkboxes.el).data('formterkait')).hasClass('buat-penting')){
						$('.set-suket-pjb', 'div#'+$(checkboxes.el).data('formterkait')).each(function(e){
							if($(this).data('validtipe')){
								$(this).attr('data-rule-'+$(this).data('validtipe'), $(this).data('validtipeval'))
									.data('rule-'+$(this).data('validtipe'), $(this).data('validtipeval'));
								$(this).attr('data-msg-'+$(this).data('validtipe'), $(this).data('validtipemsg'))
									.data('msg-'+$(this).data('validtipe'), $(this).data('validtipemsg'));
							}
						});
					}
				}
			}else{
				$('#'+$(checkboxes.el).data('dicentang')).val("N");
				if($(checkboxes.el).data('formterkait')){
					if($('#'+$(checkboxes.el).data('formterkait')).is('div') != true){
						$('#'+$(checkboxes.el).data('formterkait')).val('');
					}

					if($('#'+$(checkboxes.el).data('formterkait')).hasClass('buat-penting')){
						$('.set-suket-pjb', 'div#'+$(checkboxes.el).data('formterkait')).each(function(e){
							if($(this).data('validtipe')){
								$(this).removeAttr('data-rule-'+$(this).data('validtipe'), $(this).data('validtipeval'))
									.removeData('rule-'+$(this).data('validtipe'), $(this).data('validtipeval'));
								$(this).removeAttr('data-msg-'+$(this).data('validtipe'), $(this).data('validtipemsg'))
									.removeData('msg-'+$(this).data('validtipe'), $(this).data('validtipemsg'));
							}
						});	
					}
					$('#'+$(checkboxes.el).data('formterkait')).addClass('hidden');
				}
			}
		});
	});	
});	
</script>
<style type="text/css">
.has-switch > div{
	margin-top: -11px;
}
</style>
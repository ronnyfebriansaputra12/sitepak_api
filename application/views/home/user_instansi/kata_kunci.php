<div class="row">
	<div class="col-md-12" id="siak_list">
		<div class="tabbable-custom">
			<div class="tab-content" id="gantiPassword" style="padding:0">
				<div class="portlet-body form">
				<form id="frmPasswordChange" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doUpdatePassword'?>" method="post">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Password Lama<span class="required">*</span></label>
									<input type="password" class="form-control input-sm" id="KATA_KUNCI" name="KATA_KUNCI" placeholder="Password Lama" data-rule-required="true" data-msg-required="Password Lama harus diisi"/>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Password<span class="required">*</span></label>
									<input type="password" class="form-control input-sm" id="PWD1" name="PWD1" placeholder="Password" data-rule-required="true" data-msg-required="Password harus diisi" data-pesan="" />
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Re-password<span class="required">*</span></label>
									<input type="password" class="form-control input-sm" id="PWD2" name="PWD2" placeholder="Password" data-rule-required="true" data-msg-required="Re-password harus diisi" data-pesan="Password" data-rule-banding_kesamaan_dua_kolom='#PWD1' />
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">  
						<button type="submit" class="btn green" id="SIMPAN_UBAH"><i class="fa fa-save"></i> Simpan</button>
						<a id="ULANGI_UBAH" class="btn blue hidden ajaxify" data-target="tab_3-3"><i class="fa fa-refresh"></i> Ubah Lagi</a>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){	
	$('#frmPasswordChange').validate(option_form);
});	
</script>
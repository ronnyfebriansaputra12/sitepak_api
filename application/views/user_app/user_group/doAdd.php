<div class="row">
	<div class="col-md-12" id="siak_add-user_group">
		<div class="portlet box black">
			<div class="portlet-title">
				<div class="caption">TAMBAH KELOMPOK PENGGUNA</div>
				<div class="actions">
					<?php $this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');?>
				</div>
			</div>
			<div class="portlet-body form">
				<form class="form-horizontal" id="form_add-user_group" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doAdd'?>" method="post">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-2 control-label">Kode<span class="required">*</span></label>
							<div class="col-md-1">
								<input type="text" maxlength="2" class="form-control input-sm mask-angka" placeholder="Kode" name="tabel[USER_LEVEL]" id="USER_LEVEL" data-rule-required="true" data-msg-required="Kode Kelompok harus diisi" data-rule-min="1" data-msg-min="Kode Kelompok tidak diperkenankan 0" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Nama Kelompok<span class="required">*</span></label>
							<div class="col-md-5">
								<input type="text" maxlength="100" class="form-control input-sm mask-alamat"  placeholder="Nama Kelompok" name="tabel[LEVEL_NAME]" id="LEVEL_NAME" data-rule-required="true" data-msg-required="Nama Kelompok harus diisi" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label">Tingkatan<span class="required">*</span></label>
							<div class="col-md-4">
								<?php echo form_dropdown('tabel[GROUP_LEVEL]',$cb_group_level,'','class="form-control input-sm" id="GROUP_LEVEL" data-rule-required="true" data-msg-required="Tingkatan harus dipilih"')?>	
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
						<a href="#" class="btn default disabled ajaxify" name="hakAkses" id="hakAkses" data-target="siak_add_access-user_group" data-hidden="siak_add-user_group"><i class="fa fa-lock"></i> Hak Akses</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-12" id="siak_add_access-user_group">
	</div>
</div>
<script language="javascript">
$(function(){
	$('#form_add-user_group').validate(option_form);
	$(".mask-alamat").inputmask("Y{+}", {
		definitions: {
			"Y": {
				validator: "[a-zA-Z0-9\', .\/\-]",
				casing: "upper"
			}
		}
	});
	$(".mask-angka").inputmask("Regex",{
		regex: "[0-9]*",
	}).on("input", function(){
		$(this).val($(this).val().toUpperCase());
	});
});
</script>
<div class="row">
	<div class="col-md-12" id="siak_list">
		<div class="tabbable-custom">
			<div class="tab-content" id="gantiFotoProfil" style="padding:0">
				<div class="portlet-body form">
				<?php echo form_open_multipart(base_url().$this->router->fetch_directory().$this->router->fetch_class().'/photo_upload?pengguna='.$pengguna, array('id' => 'formChangePhoto', 'class' => 'form-horizontal', 'method' => 'post'));?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-4">&nbsp;</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 240px; height: 300px; vertical-align:middle">
											<img class="img-responsive" src="<? echo $img_src;?>" alt="" width="240" height:"300" />
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 240px; max-height: 300px;width: 240px; height: 300px; vertical-align:middle"></div>
										<div>
											<span class="btn default btn-file afterChangePic">
												<span class="fileinput-new">
													<?php echo ($is_ada == 'T')?'Select Image':'Change'?>
												</span>
												<span class="fileinput-exists">
													Change
												</span>
												<input type="file" name="uploadPhoto" id="uploadPhoto" accept="image/jpeg">
											</span>
											<span class="help-block afterChangePic">File bertipe jpeg dan jpg</span>
											<span class="help-block afterChangePic">Maximal besar file 100 kb</span>
											<span class="help-block afterChangePic">Maximal ukuran gambar yang disarankan 480px x 600px</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2">&nbsp;</div>
						</div>
					</div>
					<div class="form-actions right">  
						<button type="submit" class="btn green" name="SIMPAN_UBAH_PHOTO" id="SIMPAN_UBAH_PHOTO" disabled="disabled"><i class="fa fa-save"></i> Simpan</button>
						<a id="ULANGI_UBAH_PHOTO" class="btn blue hidden ajaxify" data-target="tab_2-2"><i class="fa fa-refresh"></i> Ubah Lagi</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script language="javascript">
$(function(){
	$('#formChangePhoto').validate(option_form);
	$('#uploadPhoto').change(function(){
	 	if($(this).val() != null){
	 		var pesan ='';
	 		var ext = $(this).val().split('.').pop().toLowerCase();
	 		var _URL = window.URL || window.webkitURL;
 			var file = this.files[0];
 			var reader = new FileReader();
 			reader.readAsDataURL(file);
 			var fileSize = Math.round(file.size/1024);

	 		if($.inArray(ext, ['jpg','jpeg']) == -1){
	 			pesan = 'Tipe file yang anda masukan salah (bukan *.jpg atau *.jpeg)';
	 			showAlertErrorUpload(pesan);
	 			$(this).val('');
	 			$('#SIMPAN_UBAH_PHOTO').prop('disabled', true);
	 		}
	 		else{
	 			if(parseInt(fileSize) > 100){
	 				pesan = 'File melebihi batas ukuran maksimal';
	 				showAlertErrorUpload(pesan);
	 				$(this).val('');
		 			$('#SIMPAN_UBAH_PHOTO').prop('disabled', true);
		 		}
		 		else{
	 				$('#SIMPAN_UBAH_PHOTO').prop('disabled', false);
		 		}
		 	} 
	 	}
	 	else{
	 		$('#SIMPAN_UBAH_PHOTO').prop('disabled', true);
	 	}
    });
});
</script>
<?php 
if($data == NULL){
	$this->siaklib->getNoInfo4('Pengguna dengan ID: <b>'.$ID_USER.'</b> tidak ditemukan atau telah dihapus dalam database', 'siak_list', 'siak_edit');
} 
else{
?>
	<div class="portlet box black">
	  <div class="portlet-title">
		 <div class="caption">UBAH PENGGUNA/SET WILAYAH</div>
		  <div class="actions">
			<?php 
				$this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');
			?>					
		</div>
	  </div>
	  <div class="portlet-body form">
	  	<form class="form-horizontal" id="frmInput" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doEdit'?>" method="post" data-refresh="frm_paging">
			<div class="form-body">
				<h4 class="form-section">DATA PENGGUNA</h4>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Id Pengguna<span class="required">*</span></label>
					  <div class="col-md-3 control-label">
						 <b class="font_biru"><?=$data[0]->user_id?></b>
						 <input type="hidden" name="tabel[USER_ID]" id="USER_ID" value="<?=$data[0]->user_id?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Nama Lengkap<span class="required">*</span></label>
					  <div class="col-md-4">
						 <input type="text" maxlength="60" class="form-control input-sm mask-nama" name="tabel[NAMA_LGKP]" id="NAMA_LGKP"  placeholder="Nama Lengkap" data-rule-required="true" data-msg-required="Nama Lengkap harus diisi" value="<?=$data[0]->nama_lgkp?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">NIP</label>
					  <div class="col-md-3">
						 <input type="text" maxlength="18" class="form-control input-sm mask-angka" name="tabel[NIP]" id="NIP"  placeholder="Nomor Induk Pegawai" value="<?=$data[0]->nip?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Tempat Lahir<span class="required">*</span></label>
					  <div class="col-md-4">
						 <input type="text" maxlength="60" class="form-control input-sm mask-alamat" name="tabel[TMPT_LHR]" id="TMPT_LHR"  placeholder="Tempat Lahir" data-rule-required="true" data-msg-required="Tempat Lahir harus diisi" value="<?=$data[0]->tmpt_lhr?>"/>
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Tanggal Lahir<span class="required">*</span></label>
					  <div class="col-md-2">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</span>
						 	<input type="text" name="tabel[TGL_LHR]" id="TGL_LHR" class="form-control input-sm mask-date" data-rule-required="true" data-msg-required="Tanggal Lahir harus diisi" data-rule-dateINA="true" data-msg-dateINA="Tanggal Lahir harus benar" value="<?=$data[0]->tgl_lhr->format('d-m-Y')?>"  />
					  	</div>
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Jenis Kelamin<span class="required">*</span></label>
					  <div class="col-md-2">
						 <?php echo form_dropdown('tabel[JENIS_KLMIN]', $this->siakrefwni->getDropJenisKelamin(), $data[0]->jenis_klmin, 'class="form-control input-sm" id="JENIS_KLMIN" data-rule-min="1" data-msg-min="Jenis Kelamin harus dipilih"'); ?>
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Telephone/Handphone<span class="required">*</span></label>
					  <div class="col-md-3">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-phone"></i>
							</span>
							<input type="text" maxlength="25" class="form-control input-sm mask-angka" name="tabel[TELP]" id="TELP"  placeholder="Telephone atau Handphone" data-rule-required="true" data-msg-required="Telephone atau Handphone harus diisi" value="<?=$data[0]->telp?>"/>
					  	</div>
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Golongan</label>
					  <div class="col-md-2">
						 <input type="text" maxlength="10" class="form-control input-sm mask-alamat" name="tabel[GOLONGAN]" id="GOLONGAN"  placeholder="Golongan" value="<?=$data[0]->golongan?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Jabatan</label>
					  <div class="col-md-4">
						 <input type="text" maxlength="60" class="form-control input-sm mask-alamat" name="tabel[JABATAN]" id="JABATAN"  placeholder="Jabatan" value="<?=$data[0]->jabatan?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Nama Kantor<span class="required">*</span></label>
					  <div class="col-md-6">
						 <input type="text" maxlength="120" class="form-control input-sm mask-alamat" name="tabel[NAMA_KANTOR]" id="NAMA_KANTOR"  placeholder="Nama Kantor" data-rule-required="true" data-msg-required="Nama Kantor harus diisi" value="<?=$data[0]->nama_kantor?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Alamat Kantor<span class="required">*</span></label>
					  <div class="col-md-6">
						 <input type="text" maxlength="120" class="form-control input-sm mask-alamat" name="tabel[ALAMAT_KANTOR]" id="ALAMAT_KANTOR"  placeholder="Alamat Kantor" data-rule-required="true" data-msg-required="Alamat harus diisi" value="<?=$data[0]->alamat_kantor?>" />
					  </div>
				   </div>
				   <div class="form-group">
					  <label class="col-md-2 control-label">Kelompok Pengguna<span class="required">*</span></label>
					  <div class="col-md-4">
						<select class="bs-select form-control" data-show-subtext="true" id="GROUP_LEVEL">
							<option value="<?=$data[0]->user_level?>" data-content="<?=$data[0]->level_name?> <span class='label lable-sm label-<?=$this->siaklib->getLabelTingkatan($data[0]->level_code)?>'><?=$data[0]->tingkatan?></span>"><?=$data[0]->level_name?></option>
						</select>
					  </div>
				   </div>
                  
					                           
				</div>
			<div class="form-actions right">
			  <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
			   <?php
                    if($btnBack <> "N"){
               ?>
                   <a href="#" class="btn purple kembali" data-target="siak_list" data-hidden="siak_edit"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
               <?php
                    }
               ?>
			</div>
		</form>
	</div>
<script>
$(function(){
	var level_code=<?=json_encode(array($data[0]->user_level => $data[0]->level_code))?>;	
	$('#frmInput').validate(option_form);	
	
	$('.wilayah').on('multiple_change',function(){
		if($(this).attr('multiple')){
			$(this).attr('name','tabel['+$(this).attr('id')+'][]');
			$(this).data('rule-inputhidden_required',$(this).attr('id')+'_DEFAULT');
		}else{
			$(this).attr('name','tabel['+$(this).attr('id')+']');
			$(this).removeData('rule-inputhidden_required');
		}
	});
	$('#GROUP_LEVEL').change();
	$('.wilayah').change(function(){
		if($.isArray($(this).val()) && $(this).val().length==1){			
			if($(this).val()[0] != 0){
				$('#'+$(this).attr('id')+'_DEFAULT').val($(this).val()[0]);			
				$(this).next('span').html('Wilayah Utama: '+$('option:selected',$(this)).text());	
			}					
		}		
	});
	$('.wilayah').each(function(index){
		if($.isArray($(this).val())){			
			if($(this).val().length==1){
				if($(this).val()[0] != 0){
					$('#'+$(this).attr('id')+'_DEFAULT').val($(this).val()[0]);			
					$(this).next('span').html('Wilayah Utama: '+$('option:selected',$(this)).text());
				}
			}else if($(this).data('value')){				
				$('#'+$(this).attr('id')+'_DEFAULT').val($(this).data('value'));			
				$(this).next('span').html('Wilayah Utama: '+$('option:selected[value="'+$(this).data('value')+'"]',$(this)).text());		
			}							
		}		
	});
	jQuery.validator.addMethod("selectmultiple_required", function(value, element) {
		var check = false;		
		if( $.isArray(value)) {
			var jml_val=0;
			for(var i=0;i<value.length;i++){
				if(value[i] != 0){
					jml_val++;
				}
			}
			if(jml_val > 0){
				check=true;
			}			
		}else if(value != '0' && value!=''){
			check=true;
		} 
		return this.optional(element) || check;
	}, "Please enter select multiple");
	jQuery.validator.addMethod("inputhidden_required", function(value, element,options) {
		var check = false;		
		if( $('#'+options).val() !='') {
			check=true;			
		} 
		return this.optional(element) || check;
	}, "Please enter hidden value");

	$(".mask-date").inputmask("d-m-y", {
		"placeholder": "DD-MM-YYYY"
	});
	$(".mask-time").inputmask("hh:mm", {
		"placeholder": "HH:MM"
	});
	$(".mask-nama").inputmask("X{+}", {
        definitions: {
            "X": {
                validator: "[a-zA-Z\', .\-]",
                casing: "upper"
            }
        }
    });
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
	});
	$('.bs-select').selectpicker({
		iconBase: 'fa',
		tickIcon: 'fa-check'
	});
});	
</script>
<?php 
}
?>
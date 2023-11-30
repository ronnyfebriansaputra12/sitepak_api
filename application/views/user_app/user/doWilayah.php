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
	  	<form class="form-horizontal" id="frmWilayah" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doWilayah'?>" method="post" data-refresh="frm_paging">
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
					  <label class="col-md-2 control-label">Kelompok Pengguna<span class="required">*</span></label>
					  <div class="col-md-4">
						<select class="bs-select form-control" data-show-subtext="true" id="GROUP_LEVEL">
							<option value="<?=$data[0]->user_level?>" data-content="<?=$data[0]->level_name?> <span class='label lable-sm label-<?=$this->siaklib->getLabelTingkatan($data[0]->level_code)?>'><?=$data[0]->tingkatan?></span>"><?=$data[0]->level_name?></option>
						</select>
					  </div>
				   </div>
                    <?php if($data[0]->level_code != "0"){?>
					<h4 class="form-section">WILAYAH</h4>
                    <?php }?>
				   <? echo $this->widget_wilayah->begin_wiget(array('prop'=>'NO_PROP','kab'=>'NO_KAB','kec'=>'NO_KEC','kel'=>'NO_KEL'),base_url().'backend/ajax_wilayah/')?>
				   <div class="form-group" id="provinsi">
					  <label class="col-md-2 control-label">Provinsi<?php if(!in_array($data[0]->level_code,array("9","A"))) {?><span class="required">*</span><?php } ?></label>
					  <div class="col-md-4">
						<? echo $this->widget_wilayah->get_propinsi(array('name'=>'tabel[NO_PROP]','param'=>'id="NO_PROP" class="form-control input-sm wilayah" data-rule-selectmultiple_required="true" data-msg-selectmultiple_required="Provinsi harus dipilih" data-msg-inputhidden_required="Isi Propinsi dengan benar"','data_awal'=>array('NO_PROP'=>$data[0]->no_prop)))?><span></span><input type="hidden" id="NO_PROP_DEFAULT" name="NO_PROP_DEFAULT" /> 
					  </div>
				   </div>
				   <div class="form-group" id="kabupaten">
					  <label class="col-md-2 control-label">Kabupaten/Kota<?php if(!in_array($data[0]->level_code,array("9","A"))) {?><span class="required">*</span><?php } ?></label>
					  <div class="col-md-4">
						<? echo $this->widget_wilayah->get_kabupaten(array('name'=>'tabel[NO_KAB]','param'=>'id="NO_KAB" class="form-control input-sm wilayah" data-rule-selectmultiple_required="true" data-msg-selectmultiple_required="Kabupaten harus dipilih" data-msg-inputhidden_required="Isi Kabupaten dengan benar"','data_awal'=>array('NO_PROP'=>$data[0]->no_prop,'NO_KAB'=>$data[0]->no_kab)))?><span></span><input type="hidden" id="NO_KAB_DEFAULT" name="NO_KAB_DEFAULT" />
					  </div>
				   </div>
				   <div class="form-group" id="kecamatan">
					  <label class="col-md-2 control-label">Kecamatan<?php if(!in_array($data[0]->level_code,array("9","A"))) {?><span class="required">*</span><?php  } ?></label>
					  <div class="col-md-4">
						<? echo $this->widget_wilayah->get_kecamatan(array('name'=>'tabel[NO_KEC]','param'=>'id="NO_KEC" class="form-control input-sm wilayah" data-rule-selectmultiple_required="true" data-msg-selectmultiple_required="Kecamatan harus dipilih" data-msg-inputhidden_required="Isi Kecamatan dengan benar"','data_awal'=>array('NO_PROP'=>$data[0]->no_prop,'NO_KAB'=>$data[0]->no_kab,'NO_KEC'=>$data[0]->no_kec)))?><span></span><input type="hidden" id="NO_KEC_DEFAULT" name="NO_KEC_DEFAULT" />
					  </div>
				   </div>
				   <div class="form-group" id="kelurahan">
					  <label class="col-md-2 control-label">Desa/Kelurahan<?php if(!in_array($data[0]->level_code,array("9","A"))) {?><span class="required">*</span><?php  }?></label>
					  <div class="col-md-4">
						<? echo $this->widget_wilayah->get_kelurahan(array('name'=>'tabel[NO_KEL]','param'=>'id="NO_KEL" class="form-control input-sm wilayah" data-rule-selectmultiple_required="true" data-msg-selectmultiple_required="Kelurahan harus dipilih" data-msg-inputhidden_required="Isi Kelurahan dengan benar"','data_awal'=>array('NO_PROP'=>$data[0]->no_prop,'NO_KAB'=>$data[0]->no_kab,'NO_KEC'=>$data[0]->no_kec,'NO_KEL'=>$data[0]->no_kel)))?><span></span><input type="hidden" id="NO_KEL_DEFAULT" name="NO_KEL_DEFAULT" />
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
</div>
<script>
$(function(){
	var level_code=<?=json_encode(array($data[0]->user_level => $data[0]->level_code))?>;	
	$('#frmWilayah').validate(option_form);	
	$('#GROUP_LEVEL').change(function(){
		var level_user=level_code[$(this).val()];
		if(level_user.charCodeAt(0) > 48 && level_user.charCodeAt(0) < 57){
			$('#NO_PROP').data('rule-selectmultiple_required',true);
			$('#NO_KAB').data('rule-selectmultiple_required',true);
			$('#NO_KEC').data('rule-selectmultiple_required',true);
			$('#NO_KEL').data('rule-selectmultiple_required',true);
			$('#instansi').hide();
			$('#konjen').hide(); 
			$('#provinsi').show();
			if(level_user.charCodeAt(0) == 49){
				$('#NO_PROP').attr('multiple',true);
				$('#NO_PROP').trigger('multiple_change');
			}else{
				$('#NO_PROP').attr('multiple',false);	
				$('#NO_PROP').trigger('multiple_change');
			}
			if(level_user.charCodeAt(0) > 50){
				$('#kabupaten').show();
				if(level_user.charCodeAt(0) == 51){
					$('#NO_KAB').attr('multiple',true);
					$('#NO_KAB').trigger('multiple_change');
				}else{
					$('#NO_KAB').attr('multiple',false);	
					$('#NO_KAB').trigger('multiple_change');
				}
				if(level_user.charCodeAt(0) > 52){
					$('#kecamatan').show();
					if(level_user.charCodeAt(0) == 53){
						$('#NO_KEC').attr('multiple',true);
						$('#NO_KEC').trigger('multiple_change');
					}else{
						$('#NO_KEC').attr('multiple',false);
						$('#NO_KEC').trigger('multiple_change');
					}
					if(level_user.charCodeAt(0)>54){
						$('#kelurahan').show();
						if(level_user.charCodeAt(0) == 55){
							$('#NO_KEL').attr('multiple',true);
							$('#NO_KEL').trigger('multiple_change');
						}else{
							$('#NO_KEL').attr('multiple',false);
							$('#NO_KEL').trigger('multiple_change');
						}
					}else{
						$('#kelurahan').hide();
					}
				}else{
					$('#kecamatan').hide();
					$('#kelurahan').hide();
				}
			}else{
				$('#kabupaten').hide();
				$('#kecamatan').hide();
				$('#kelurahan').hide();
			}
		}else if(level_user.charCodeAt(0) == 48){
			$('#provinsi').hide();
			$('#NO_PROP').attr('multiple',false);
			$('#NO_PROP').trigger('multiple_change');
			$('#kabupaten').hide();
			$('#NO_KAB').attr('multiple',false);
			$('#NO_KAB').trigger('multiple_change');
			$('#kecamatan').hide();
			$('#NO_KEC').attr('multiple',false);
			$('#NO_KEC').trigger('multiple_change');
			$('#kelurahan').hide();
			$('#NO_KEL').attr('multiple',false);
			$('#NO_KEC').trigger('multiple_change');
			$('#konjen').hide();
			$('#instansi').hide();
		}else{
			$('#provinsi').show();
			$('#NO_PROP').attr('multiple',false);
			$('#NO_PROP').trigger('multiple_change');
			$('#NO_PROP').data('rule-selectmultiple_required',false);
			$('#kabupaten').show();
			$('#NO_KAB').attr('multiple',false);
			$('#NO_KAB').trigger('multiple_change');
			$('#NO_KAB').data('rule-selectmultiple_required',false);
			$('#kecamatan').show();
			$('#NO_KEC').attr('multiple',false);
			$('#NO_KEC').trigger('multiple_change');
			$('#NO_KEC').data('rule-selectmultiple_required',false);
			$('#kelurahan').show();
			$('#NO_KEL').attr('multiple',false);
			$('#NO_KEL').trigger('multiple_change');
			$('#NO_KEL').data('rule-selectmultiple_required',false);			
			if(level_user.charCodeAt(0) == 57){
				$('#instansi').show();	
				$('#konjen').hide();	
			}else if(level_user.charCodeAt(0) == 65){
				$('#konjen').show();	
				$('#instansi').hide();	
			}			
		}
	});
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

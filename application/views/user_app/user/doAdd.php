<div id="siakAdd">
	<div class="portlet box black">
	  <div class="portlet-title">
		 <div class="caption">TAMBAH PENGGUNA</div>
		 <div class="actions">
			<?php 
				$this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');
			?>					
		</div>
	  </div>
	  <div class="portlet-body form">
	  	<form class="form-horizontal" id="frmInput" action="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doAdd'?>" method="post">
			<div class="form-body">
			   <div class="form-group">
				  <label class="col-md-2 control-label">Id Pengguna<span class="required">*</span></label>
				  <div class="col-md-3">
					 <input type="text" maxlength="20" class="form-control input-sm" name="tabel[USER_ID]" id="USER_ID"  placeholder="Id Pengguna" data-rule-required="true" data-msg-required="Id Pengguna harus diisi" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Nama Lengkap<span class="required">*</span></label>
				  <div class="col-md-4">
					 <input type="text" maxlength="60" class="form-control input-sm mask-nama" name="tabel[NAMA_LGKP]" id="NAMA_LGKP"  placeholder="Nama Lengkap" data-rule-required="true" data-msg-required="Nama Lengkap harus diisi" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">NIP</label>
				  <div class="col-md-3">
					 <input type="text" maxlength="18" class="form-control input-sm mask-angka" name="tabel[NIP]" id="NIP"  placeholder="Nomor Induk Pegawai" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Tempat Lahir<span class="required">*</span></label>
				  <div class="col-md-4">
					 <input type="text" maxlength="60" class="form-control input-sm mask-alamat" name="tabel[TMPT_LHR]" id="TMPT_LHR"  placeholder="Tempat Lahir" data-rule-required="true" data-msg-required="Tempat Lahir harus diisi"/>
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Tanggal Lahir<span class="required">*</span></label>
				  <div class="col-md-2">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
					 	<input type="text" name="tabel[TGL_LHR]" id="TGL_LHR" class="form-control input-sm mask-date" data-rule-required="true" data-msg-required="Tanggal Lahir harus diisi" data-rule-dateINA="true" data-msg-dateINA="Tanggal Lahir harus benar"  />
				  	</div>
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Jenis Kelamin<span class="required">*</span></label>
				  <div class="col-md-2">
					 <?php echo form_dropdown('tabel[JENIS_KLMIN]', $this->siakrefwni->getDropJenisKelamin(), '0', 'class="form-control input-sm" id="JENIS_KLMIN" data-rule-min="1" data-msg-min="Jenis Kelamin harus dipilih"'); ?>
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Telephone/Handphone<span class="required">*</span></label>
				  <div class="col-md-3">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-phone"></i>
						</span>
						<input type="text" maxlength="25" class="form-control input-sm mask-angka" name="tabel[TELP]" id="TELP"  placeholder="Telephone atau Handphone" data-rule-required="true" data-msg-required="Telephone atau Handphone harus diisi"/>
					 </div>
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Golongan</label>
				  <div class="col-md-2">
					 <input type="text" maxlength="10" class="form-control input-sm mask-alamat" name="tabel[GOLONGAN]" id="GOLONGAN"  placeholder="Golongan" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Jabatan</label>
				  <div class="col-md-4">
					 <input type="text" maxlength="60" class="form-control input-sm mask-alamat" name="tabel[JABATAN]" id="JABATAN"  placeholder="Jabatan" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Nama Kantor<span class="required">*</span></label>
				  <div class="col-md-6">
					 <input type="text" maxlength="120" class="form-control input-sm mask-alamat" name="tabel[NAMA_KANTOR]" id="NAMA_KANTOR"  placeholder="Nama Kantor" data-rule-required="true" data-msg-required="Nama Kantor harus diisi" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Alamat Kantor<span class="required">*</span></label>
				  <div class="col-md-6">
					 <input type="text" maxlength="120" class="form-control input-sm mask-alamat" name="tabel[ALAMAT_KANTOR]" id="ALAMAT_KANTOR"  placeholder="Alamat Kantor" data-rule-required="true" data-msg-required="Alamat harus diisi" />
				  </div>
			   </div>			   
			   <div class="form-group">
					<label class="control-label col-md-2">Kelompok Pengguna<span class="required">*</span></label>
					<div class="col-md-4">
                    	<?php echo form_dropdown('tabel[USER_LEVEL]',$cbKelompok,'','class="form-control input-sm" id="USER_LEVEL" data-rule-required="true" data-msg-required="Kelompok Pengguna harus dipilih"')?>
					</div>
				</div>               
			   <div class="form-group">
				  <label class="col-md-2 control-label">Password<span class="required">*</span></label>
				  <div class="col-md-3">
					 <input type="password" maxlength="20" class="form-control input-sm" name="tabel[USER_PWD]" id="USER_PWD"  placeholder="Password" data-rule-required="true" data-msg-required="Password harus diisi" data-pesan="" />
				  </div>
			   </div>
			   <div class="form-group">
				  <label class="col-md-2 control-label">Re-Password<span class="required">*</span></label>
				  <div class="col-md-3">
					 <input type="password" maxlength="20" class="form-control input-sm" name="USER_PWD_RE" id="USER_PWD_RE" placeholder="Re-Password" data-rule-required="true" data-msg-required="Re-Password harus diisi" data-pesan="Password" data-rule-banding_kesamaan_dua_kolom='#USER_PWD' />
				  </div>
			   </div>                              
			</div>
			<div class="form-actions right">
			  <button type="submit" class="btn green"><i class="fa fa-save"></i> Simpan</button>
			  <a href="#" class="btn default disabled ajaxify" name="idWilayah" id="idWilayah" data-target="siak_wilayah" data-hidden="siakAdd"><i class="fa fa-thumb-tack"></i> Wilayah</a>
			</div>
		 </form>
	  </div>
	</div>
</div>
<div id="siak_wilayah"></div>
<script>
$(function(){	
	$('.bs-select').selectpicker({
		iconBase: 'fa',
		tickIcon: 'fa-check'
	})		
	$('#frmInput').validate(option_form);
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
});	
</script>
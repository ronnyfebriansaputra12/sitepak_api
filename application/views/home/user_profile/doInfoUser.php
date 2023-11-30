<div class="tabbable tabbable-custom tabbable-custom-profile">
	<div class="tab-content">
		<form class="form-horizontal" id="frmInput">
			<div class="form-body">
				<div class="portlet" id="Pencarian">
					<div class="portlet-body">
					<h4 class="form-section">DATA PENGGUNA</h4>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Id Pengguna</label>
                          <div class="control-label col-md-6">:&nbsp;<b class="font_biru"><?=$data[0]->user_id?></b></div>
						  <div class="control-label col-md-3">
				<img src="<?php echo $photo_profile?>" class="img-responsive" alt="" id="dp_dasbor" />
			</div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Nama Lengkap</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->nama_lgkp?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">NIP</label>
                          <div class="control-label col-md-3">:&nbsp;<b><?=$data[0]->nip?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Tempat Lahir</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->tmpt_lhr?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Tanggal Lahir</label>
                          <div class="control-label col-md-2">:&nbsp;<b><?=$data[0]->tgl_lhr->format('d-m-Y')?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Jenis Kelamin</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->jenis_klmin_desc?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Telephone/Handphone</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->telp?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Golongan</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->golongan?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Pangkat</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->pangkat?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Jabatan</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->jabatan?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Nama Kantor</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->nama_kantor?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Alamat Kantor</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->alamat_kantor?></b></div>
                       </div>
                       <div class="form-group jarak">
                          <label class="control-label col-md-3">Abaikan IP Address</label>
                          <div class="control-label col-md-2">:&nbsp;<b><?=$data[0]->check_ip_desc?></b></div>
                       </div>
                       <div class="form-group">
                         <label class="control-label col-md-3">Kelompok Pengguna</label>
                          <div class="control-label col-md-9">:&nbsp;<b><?=$data[0]->level_name?></b>&nbsp;&nbsp;<span class='label lable-sm label-<?=$this->siaklib->getLabelTingkatan($data[0]->level_code)?>'><?=$data[0]->tingkatan?></span></div>
                       </div>
                    <?php 
						$arrProv = array();
						$arrKab = array();
						$arrKec = array();
						$arrKel = array();
						$jmlProp = 0; 
						$jmlKab = 0; 
						$jmlKec = 0; 
						$jmlKel = 0; 
					if($data[0]->level_code != "0"){?>
					<h4 class="form-section">WILAYAH</h4>
                    <?php 
						}
					?>
					   <div class="form-group jarak" id="provinsiV">
						  <label class="col-md-3 control-label">Provinsi</label>
						  <div class="col-md-9 control-label">:<b>                          
							<?php								
								if($data[0]->no_prop <> NULL || $data[0]->no_prop <> "0"){
									$arrProv = explode(",",$data[0]->no_prop);									
									$jmlProp = count($arrProv);
									if($jmlProp > 0){
										for($i=0;$i<$jmlProp;$i++){
											if($i > 0){
												echo "<br>&nbsp;&nbsp;";
											}
											if (trim($arrProv[$i]) <> "" || strlen(trim($arrProv[$i])) <> 0){
												echo str_pad($arrProv[$i],2,"0",STR_PAD_LEFT).' - '.$this->siaklib->getNamaProvinsi($arrProv[$i]);
											}
											
											
										}
									}
								}
							?>
							</b>
						  </div>
					   </div>
					   <div class="form-group jarak" id="kabupatenV">
						  <label class="col-md-3 control-label">Kabupaten/Kota</label>
						  <div class="col-md-9 control-label">:<b>
							<?php
								if($jmlProp > 0){
									if($data[0]->no_kab <> NULL || $data[0]->no_kab <> "0"){
										$arrKab = explode(",",$data[0]->no_kab);
										$jmlKab = count($arrKab);
										if($jmlKab > 0){
											echo " ";
											for($i=0;$i<$jmlKab;$i++){
												if($i > 0){
													echo "<br>&nbsp;&nbsp;";
												}
												if(trim($arrKab[$i]) <> "" || strlen(trim($arrKab[$i])) <> 0){
													echo str_pad($arrKab[$i],2,"0",STR_PAD_LEFT).' - '.$this->siaklib->getNamaKabupaten($arrProv[0],$arrKab[$i]);
												}
											}
										}
									}
								}
							?>
							</b>	
						  </div>
					   </div>
					   <div class="form-group jarak" id="kecamatanV">
						  <label class="col-md-3 control-label">Kecamatan</label>
						  <div class="col-md-9 control-label">:<b>
							<?php
								if($jmlProp > 0 && $jmlKab > 0){
									if($data[0]->no_kec <> NULL || $data[0]->no_kec <> "0"){
										$arrKec = explode(",",$data[0]->no_kec);
										$jmlKec = count($arrKec);
										if($jmlKec > 0){
											echo " ";
											for($i=0;$i<$jmlKec;$i++){
												if($i > 0){
													echo "<br>&nbsp;&nbsp;";
												}
												if(trim($arrKec[$i]) <> "" || strlen(trim($arrKec[$i])) <> 0){
													echo str_pad($arrKec[$i],2,"0",STR_PAD_LEFT).' - '.$this->siaklib->getNamaKecamatan($arrProv[0],$arrKab[0],$arrKec[$i]);
												}
											}
										}
									}
								}
							?>
							</b>
						  </div>
					   </div>
					   <div class="form-group jarak" id="kelurahanV">
						  <label class="col-md-3 control-label">Desa/Kelurahan</label>
						  <div class="col-md-9 control-label">:<b>
							<?php
								if($jmlProp > 0 && $jmlKab > 0 && $jmlKec > 0){
									if($data[0]->no_kel <> NULL || $data[0]->no_kel <> "0"){
										$arrKel = explode(",",$data[0]->no_kel);
										$jmlKel = count($arrKel);
										if($jmlKel > 0){
											echo " ";
											for($i=0;$i<$jmlKel;$i++){
												if($i > 0){
													echo "<br>&nbsp;&nbsp;";
												}
												if(trim($arrKel[$i]) <> "" || strlen(trim($arrKel[$i])) <> 0){
													echo str_pad($arrKel[$i],4,"0",STR_PAD_LEFT).' - '.$this->siaklib->getNamaKelurahan($arrProv[0],$arrKab[0],$arrKec[0],$arrKel[$i]);
												}
											}
										}
									}
								}
							?>
							</b>
						  </div>
					   </div>
                       <?php 
					   		if($data[0]->level_code == "9"){
						?>
					   <div class="form-group jarak" id="instansiV">
						  <label class="col-md-3 control-label">Instansi</label>
						  <div class="col-md-9 control-label">: <b><?php echo $data[0]->kode_instansi?> - <?php echo $this->siaklib->getNamaInstansi($data[0]->kode_instansi)?></b></div>
					   </div>
                       <?php
					   		}
						?>
					   <div class="form-group jarak" id="konjenV">
						  <label class="col-md-3 control-label">Konjen</label>
						  <div class="col-md-9 control-label">:</div>
					   </div> 
					</div> 
				</div>                             
			</div>
		</form>
	</div>                             
</div>
<script>
$(function(){
	var level_userV = "<?=$data[0]->level_code?>";
	if(level_userV.charCodeAt(0) > 48 && level_userV.charCodeAt(0) < 57){
		$('#instansiV').hide();
		$('#konjenV').hide(); 
		$('#provinsiV').show();
		if(level_userV.charCodeAt(0) > 50){
			$('#kabupatenV').show();
			if(level_userV.charCodeAt(0) > 52){
				$('#kecamatanV').show();
				if(level_userV.charCodeAt(0)>54){
					$('#kelurahanV').show();
				}else{
					$('#kelurahanV').hide();
				}
			}else{
				$('#kecamatanV').hide();
				$('#kelurahanV').hide();
			}
		}else{
			$('#kabupatenV').hide();
			$('#kecamatanV').hide();
			$('#kelurahanV').hide();
		}
	}else if(level_userV.charCodeAt(0) == 48){
		$('#provinsiV').hide();
		$('#kabupatenV').hide();
		$('#kecamatanV').hide();
		$('#kelurahanV').hide();
		$('#konjenV').hide();
		$('#instansiV').hide();
	}else{
		$('#provinsiV').show();
		$('#kabupatenV').show();
		$('#kecamatanV').show();
		$('#kelurahanV').show();
		if(level_userV.charCodeAt(0) == 57){
			$('#instansiV').show();	
			$('#konjenV').hide();	
		}else if(level_userV.charCodeAt(0) == 65){
			$('#konjenV').show();	
			$('#instansiV').hide();	
		}			
	}			
});	
</script>
<div class="portlet box black">
	<div class="portlet-title">
		<div class="caption">INFORMASI</div>
		 <div class="actions">
			<?php 
				$this->load->view($this->router->fetch_directory().$this->router->fetch_class().'/doBar');
			?>					
		</div>
	</div>
	<div class="portlet-body">
        <div class="table-responsive">
            <div id="main_siak_child">
				<div class="form-body">
					<div class="portlet">
						<div class="portlet-body form form-horizontal">
							<div class="row"> 
								<div class="col-md-12">
									 <div class="form-group">
										  <label class="col-md-2 control-label">Kode</label>
										  <div class="col-md-1">
											<b class="font_biru"><?=$data[0]->user_level?></b>
											 <input type="hidden" name="tabel[USER_LEVEL]" id="USER_LEVEL" value="<?=$data[0]->user_level?>" disabled="disabled">
										  </div>
									 </div>
								</div>
							</div>        
							<div class="row">
								<div class="col-md-12">
									 <div class="form-group">
										  <label class="col-md-2 control-label">Nama Kelompok</label>
										  <div class="col-md-5">
											 <input type="text" maxlength="100" class="form-control input-sm mask-alamat"  placeholder="Nama Kelompok" name="tabel[LEVEL_NAME]" id="LEVEL_NAME" data-rule-required="true" data-msg-required="Nama Kelompok harus diisi" value="<?=$data[0]->level_name?>" readonly="readonly">
										  </div>
									 </div>
								</div>
							</div>       
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										  <label class="col-md-2 control-label">Tingkatan</label>
										  <div class="col-md-4">
											<?php echo form_dropdown('X_GROUP_LEVEL',$cb_group_level,$data[0]->group_level,'class="form-control input-sm" id="X_GROUP_LEVEL"  disabled="disabled"')?>
										  </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable tabbable-custom boxless tabbable-reversed">
                            <ul id="siak_informasi" class="nav nav-tabs">
                                <li class="active">                            	
                                    <a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewAccessKelompokPengguna/'.$user_level;?>" data-target="#tab-usergroup-view_0" data-toggle="tab">
                                         HAK AKSES
                                    </a>
                                </li>
                                <li>                            	
                                    <a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewAccessKelompokUser/'.$user_level;?>" data-target="#tab-usergroup-view_1" data-toggle="tab">
                                         PENGGUNA
                                    </a>
                                </li>							
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane form-horizontal active" id="tab-usergroup-view_0"></div>
                                <div class="tab-pane form-horizontal" id="tab-usergroup-view_1"></div>
                            </div> 
                        </div>    
                        <div class="form-actions right">                           
	       					<a href="#" class="btn purple kembali" data-target="siak_list-user_group" data-hidden="siak_edit-user_group"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#siak_informasi > li > a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var url_target = $(e.target).attr("href"); 
			var target=$(e.target).data("target");
			if ($(target).is(':empty')) {
				App.blockUI({boxed: true,message: 'Harap Tunggu'});
				$.ajax({
					type: "GET",
					url: url_target,
					error: function(data){
						App.unblockUI();
						alert("Terjadi Kesalahan");
					},
					success: function(data){
						App.unblockUI();
						$(target).html(data);
					}
				})
			}
		});
		App.blockUI({boxed: true,message: 'Harap Tunggu'});
		$($('#siak_informasi.nav-tabs > .active > a').data("target")).load($('#siak_informasi.nav-tabs > .active > a').attr("href"),function(result){
			$('#siak_informasi.nav-tabs > .active > a').tab('show');
			App.unblockUI();
		});
	});
</script>
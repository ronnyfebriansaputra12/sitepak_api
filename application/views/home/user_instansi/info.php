					<div class="row profile-account">
						<div class="col-md-3">
							<ul id="ul-dashboard-pengguna" class="ver-inline-menu tabbable margin-bottom-10">
								<li class="active">
									<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doInfoUser'?>" data-toggle="tab" data-target="#tab_info_pengguna-1">
										<i class="fa fa-user"></i> Data Pribadi
									</a>
									<span class="after">
									</span>
								</li>
								<li>
									<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/photo?pengguna='.$pengguna;?>" data-toggle="tab" data-target="#tab_info_pengguna-2">
										<i class="fa fa-picture-o"></i> Ganti Photo
									</a>
								</li>
								<li>
									<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/pengaturan'?>" data-toggle="tab" data-target="#tab_info_pengguna-4">
										<i class="fa fa-cogs"></i> Pengaturan
									</a>
								</li>
							</ul>
						</div>
						<div class="col-md-9">
							<div class="tab-content">
								<div id="tab_info_pengguna-1" class="tab-pane active"></div>
								<div id="tab_info_pengguna-2" class="tab-pane"></div>
								<div id="tab_info_pengguna-3" class="tab-pane"></div>
								<div id="tab_info_pengguna-4" class="tab-pane"></div>
							</div>
						</div>
						<!--end col-md-9-->
					</div>
					<script type="text/javascript">
						$(function(){
							$('#ul-dashboard-pengguna > li > a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
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
							$($('#ul-dashboard-pengguna.tabbable > .active > a').data("target")).load($('#ul-dashboard-pengguna.tabbable > .active > a').attr("href"),function(result){
								$('#ul-dashboard-pengguna.tabbable > .active > a').tab('show');
								App.unblockUI();
							});
						});
					</script>
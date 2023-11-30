									<div id="accordion3" class="panel-group">
										<div class="panel panel-info">
											<div class="panel-heading">
												<h4 class="panel-title">
												<a href="#accordion3_1" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3">
													PELAPORAN PENDUDUK YANG TIDAK MAMPU 
												</a>
												</h4>
											</div>
											<div id="accordion3_1" class="panel-collapse collapse in" data-url="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/statistik1'?>"></div>
										</div>
									</div>
									<script type="text/javascript">
									$(function(){
										$('#accordion3 > .panel > div > a[data-toggle="collapse"]').on('shown.bs.collapse', function (e) {
											var url_target = $(e.target).data("url"); 
											var target=$(e.target).attr("href");						
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
										$('#accordion3').on('shown.bs.collapse', function (e) {											
											var url_target = $(e.target).data("url"); 
											var target='#'+$(e.target).attr("id");											
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
										var awal=($('#accordion3 .collapse.in').attr('id'));							
										$('#'+awal).load($('#'+awal).data("url"),function(result){											
											App.unblockUI();
										});
									});
								</script>
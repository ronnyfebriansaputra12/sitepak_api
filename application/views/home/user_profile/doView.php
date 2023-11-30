<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title  font-grey-cascade"><?php echo $this->siakconfig->getNamaLembaga()?>&nbsp;<small>SISTEM INFORMASI PEMANFAATAN DATA</small></h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>HALAMAN UTAMA</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- BEGIN PAGE CONTENT-->
<div class="row profile" id="main_siak_show">
	<div class="col-md-12">
		<!--BEGIN TABS-->
		<div class="tabbable tabbable-custom tabbable-full-width">
			<ul id="ul-tab-dashboard" class="nav nav-tabs">
				
				<li class="active">
					<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/info'?>" data-target="#dashboard-tab-1" data-toggle="tab">Pengguna</a>
				</li>
				<li>
					<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doAktivitas'?>" data-target="#dashboard-tab-2" data-toggle="tab">Aktivitas</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="dashboard-tab-1"></div>
				<div class="tab-pane" id="dashboard-tab-2"></div>
				<div class="tab-pane" id="dashboard-tab-3"></div>
			</div>
		</div>
		<!--END TABS-->
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#ul-tab-dashboard > li > a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
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
		$($('#ul-tab-dashboard.nav-tabs > .active > a').data("target")).load($('#ul-tab-dashboard.nav-tabs > .active > a').attr("href"),function(result){
			$('#ul-tab-dashboard.nav-tabs > .active > a').tab('show');
			App.unblockUI();
		});
	});
</script>

<!-- END JAVASCRIPTS -->
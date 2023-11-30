<nav class="navbar navbar-inverse navbar-fixed-bottom">
	<div class="col-md-12">
		<ul class="nav navbar-nav navbar-header navbar-left">
		
			<li class="start active open">
				<a href="<?=base_url().'home/user_instansi/doView'?>" class="ajaxify start dashboard" data-target="page-content">
					<i class="fa fa-home"></i>
					<span class="title"><b>DWH</b></span>
					<span class="selected"></span>
				</a>
			</li>
			
			<li class="dropup">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-cube"></i>
					<span class="title">Monitoring Pusat</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li class="list-group-item-danger">
						<a href="<?=base_url().'laporan/Status_aktivasi/listAktivasi'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-share-square-o"></i> <b>Status Aktivasi Pengguna</b></a>
					</li>				
					<li class="list-group-item-danger">
						<a href="<?=base_url().'laporan/Jenis_akses/listJenisAkses'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-globe"></i> <b>Jenis Skala Data</b></a>
					</li>
					<li class="list-group-item-danger dropdown-submenu">
						<a href="javascript:;">
							<i class="fa fa-users"></i><span class="title"> <b>User & Kuota</b></span>
						</a>
						<ul class="dropdown-menu">
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan/Total_kuota/listTotalKuota'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-exchange"></i> <b>Total Kuota</b></a>
							</li>
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan/Total_user/listTotalUser'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-users"></i> <b>Total User</b></a>
							</li>
						</ul>
					</li>
					<li class="list-group-item-danger">
						<a href="<?=base_url().'laporan/Metode_akses/listMetode'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-share-alt"></i> <b>Metode Akses Pengguna</b></a>
					</li>
					<li class="list-group-item-danger dropdown-submenu">
						<a href="javascript:;">
							<i class="fa fa-bar-chart"></i><span class="title"> <b>Total Akses</b></span>
						</a>
						<ul class="dropdown-menu">
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan/Total_akses/listTahunan'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-calendar-check-o"></i> <b>Total Akses Tahunan</b></a>
							</li>
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan/Total_akses/listBulanan'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-calendar"></i> <b>Total Akses Bulanan</b></a>
							</li>
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan/Total_akses/listHarian'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-clock-o"></i> <b>Total Akses Harian</b></a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			
			<li class="dropup">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-cubes"></i>
					<span class="title">Monitoring Daerah</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li class="list-group-item-danger">
						<a href="<?=base_url().'laporan_daerah/Status_aktivasi/listAktivasi'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-share-square-o"></i> <b>Status Aktivasi Pengguna</b></a>
					</li>				
					<li class="list-group-item-danger">
						<a href="<?=base_url().'laporan_daerah/Jenis_akses/listJenisAkses'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-globe"></i> <b>Jenis Skala Data</b></a>
					</li>
					<li class="list-group-item-danger dropdown-submenu">
						<a href="javascript:;">
							<i class="fa fa-users"></i><span class="title"> <b>User & Kuota</b></span>
						</a>
						<ul class="dropdown-menu">
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan_daerah/Total_kuota/listTotalKuota'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-exchange"></i> <b>Total Kuota</b></a>
							</li>
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan_daerah/Total_user/listTotalUser'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-users"></i> <b>Total User</b></a>
							</li>
						</ul>
					</li>
					<li class="list-group-item-danger">
						<a href="<?=base_url().'laporan_daerah/Metode_akses/listMetode'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-share-alt"></i> <b>Metode Akses Pengguna</b></a>
					</li>
					<li class="list-group-item-danger dropdown-submenu">
						<a href="javascript:;">
							<i class="fa fa-bar-chart"></i><span class="title"> <b>Total Akses</b></span>
						</a>
						<ul class="dropdown-menu">
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan_daerah/Total_akses/listTahunan'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-calendar-check-o"></i> <b>Total Akses Tahunan</b></a>
							</li>
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan_daerah/Total_akses/listBulanan'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-calendar"></i> <b>Total Akses Bulanan</b></a>
							</li>
							<li class="list-group-item-danger">
								<a href="<?=base_url().'laporan_daerah/Total_akses/listHarian'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-clock-o"></i> <b>Total Akses Harian</b></a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			
			<li class="dropup">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-line-chart"></i>
					<span class="title">Laporan Data</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li class="list-group-item-danger">
						<a href="<?=base_url().'all/All_pusat/listAllPusat'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-cube"></i> <b>All Pusat</b></a>
					</li>
					<li class="list-group-item-danger">
						<a href="<?=base_url().'all/All_daerah/listAllDaerah'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-cubes"></i> <b>All Daerah</b></a>
					</li>
					<li class="list-group-item-danger">
						<a href="<?=base_url().'all/All_provinsi/listAllProvinsi'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-file-o"></i> <b>Daerah (Provinsi)</b></a>
					</li>
					<li class="list-group-item-danger">
						<a href="<?=base_url().'all/All_kabkota/listAllKabKota'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-files-o"></i> <b>Daerah (Kab/Kota)</b></a>
					</li>
				</ul>
			</li>
			
			<li class="dropup">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-newspaper-o"></i>
					<span class="title">Resume</span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li class="list-group-item-danger">
						<a href="<?=base_url().'resume/Resume_all/listResumeAll'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-newspaper-o"></i> <b>Resume All</b></a>
					</li>
					<li class="list-group-item-danger">
						<a href="<?=base_url().'resume/List_pengguna/listAllPengguna'?>" class="ajaxify" data-target="main_siak_show"><i class="fa fa-star"></i> <b>List Pengguna</b></a>
					</li>
				</ul>
			</li>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li class="dropup">
				<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
					<i class="fa fa-user"></i>
					<span class="username"><?php echo "Administrator"//$this->session->userdata("user_name"); ?></span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li class="list-group-item-danger">
						<a href="<?php echo base_url()?>apps/doLogout"><i class="fa fa-power-off"></i> Log Out</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

<script type="text/javascript">
$(document).ready(function(){
  $(".dashboard").click();
});
</script>
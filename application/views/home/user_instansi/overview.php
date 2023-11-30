<div class="row" id="siak_pesan">
	<div class="col-md-12">
		<ul class="list-unstyled profile-nav">
			<li>
				<img src="<?php //echo $photo_profile?>" class="img-responsive" alt="" id="dp_dasbor" />
			</li>
			<li>
				<center>
				<p>
					 Selamat Datang  <b class="font_mermar jarak"><?php echo "Administrator"//$this->session->userdata("user_name"); ?></b> di Aplikasi Laporan Aggregate Akses Pemanfaatan Data Warehouse<br />
					 <b>Login Time</b> <?php echo $this->session->userdata("login_time"); ?><br />
				</p>
				</center>
			</li>
			<li>
				<div class="row">
					<div class="profile-info">
						<center><img src="<?php echo base_url().VER_TEMPLATE;?>img/cc.png" alt="logo" style="width:400px;height:400px;"/></center>
					</div>
				</div>
			</li>
		</ul>
	</div>
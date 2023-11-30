<?php 
if($obj == NULL){
	$this->siaklib->getNoInfo4('Pesan tidak ditemukan atau telah dihapus dalam database', 'siak_pesan', 'siak_lihat_pesan');
} 
else{
?>
<div class="row">
	<div class="tabbable-custom">
		<div class="tab-content" style="padding:0">
			<div class="portlet-body form">
				<form method="post" action="#" id="frmInput" class="form-horizontal">
					<div class="form-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-2 control-label">Dari</label>
									<div class="col-md-10 control-label">:<span class="deskripsi"><?php echo $obj->dari;?></span></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-2 control-label">Perihal</label>
									<div class="col-md-10 control-label">:<span class="deskripsi"><?php echo $obj->judul;?></span></div>
								</div>
							</div>
						</div>
						<div class="row">&nbsp;</div>
						<h4 class="form-section">PESAN</h4> 
						<div class="row">
							<div class="col-md-12">
								<div class="portlet">
									<div class="portlet-body">
										<div class="scroller" style="height:<?php echo $height;?>px;">
											<p><?php echo $isi_pesan;?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<a href="#" class="btn purple kembali" data-target="siak_pesan" data-hidden="siak_lihat_pesan"><i class="fa fa-arrow-circle-left"></i>&nbsp;Kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
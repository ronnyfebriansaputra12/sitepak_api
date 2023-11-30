<div id="list-instansi-kategori" class="col-md-12">
	<div id="instansi-kategori-list" class="panel-group accordion">
	<?php
		if(count($kategori) !== NULL):
	?>
		<?php
			foreach ($kategori as $kat):
				if($kat->count_instansi() != 0):
		?>
			<div class="panel panel-default" style="border:none;">
				<div class="panel-heading bg-white" style="border:none;">
					<h4 class="panel-title my-panel-title">
						<a href="#kategori-<?php echo $kat->id_table;?>" class="accordion-toggle" data-toggle="collapse" data-parent="instansi-kategori-list" data-href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewInstansi?ID_KATEGORI='.$kat->id_table.'&HARI='.$HARI;?>" style="text-decoration: none;">
							<?php echo $kat->category_name;?>
						</a>
					</h4>
				</div>
				<div id="kategori-<?php echo $kat->id_table;?>" class="panel-collapse in my-panel-collapse" data-href="<?php echo base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doViewInstansi?ID_KATEGORI='.$kat->id_table.'&HARI='.$HARI;?>" style="border:none;"></div>
			</div>
		<?php
				endif;
			endforeach;
		?>
		<script type="text/javascript">
			$(function(){
				$('#instansi-kategori-list > .panel > div > a[data-toggle="collapse"]').on('shown.bs.collapse', function(e){
					var url_href =$(e.target).data("href");
					var div_target =$(e.target).attr("href");
					$(div_target).empty();
					App.blockUI({
						boxed: true,
						message: 'Harap Tunggu',
						target:div_target
					});

					$.ajax({
						type: "GET",
						url: url_href,
						error: function(data){
							App.unblockUI(div_target);
							alert("Terjadi Kesalahan");
						},
						success: function(data){
							App.unblockUI(div_target);
							$(div_target).load(data);
						}
					});
				});

				$('#instansi-kategori-list .my-panel-collapse').each(function(){
					App.blockUI({
						boxed: true,
						message: 'Harap Tunggu',
						target:"#"+$(this).attr('id')
					});
					$("#"+$(this).attr('id')).load($("#"+$(this).attr('id')).data('href'), function(){
						App.unblockUI("#"+$(this).attr('id'));
					});
				});
			});
		</script>
	<?php
		endif;
	?>
	</div>
</div>
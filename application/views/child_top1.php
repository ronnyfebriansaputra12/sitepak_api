<div class="row">
	<div class="col-md-12">
		<h3 class="page-title  font-grey-cascade"><?php echo $this->siakconfig->getNamaLembaga()?>&nbsp;<small>SISTEM INFORMASI PEMANFAATAN DATA</small></h3>
		<ul class="page-breadcrumb breadcrumb font-grey-cascade">
			<li><?php echo $titleBar?></li>
		</ul>
	</div>
</div>
<div id="main_siak_show" class="row">
	<div class="col-md-12">
		<div class="tabbable-line tabbable-full-width">
			<ul id="viewdotoptab" class="nav nav-tabs my-nav-tabs">
				<?php 
					$i = 0;
					foreach ($data_menu as $menu) :
						$i++;
				?>            
				<li class="<?php echo ($i==1)?" active":""?>">
					<a href="<?=base_url().$menu->menu_link?>" data-target="#topTab" data-toggle="tab">
					<?php echo (empty($menu->menu_display))?$menu->menu_name:$menu->menu_display;?></a>
				</li>
				<?php
					endforeach;
				?>
			</ul>
			<div class="tab-content">
				<div id="topTab" class="tab-pane active"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('#viewdotoptab > li > a').on('click', function(e){
		e.stopPropagation();
		var url_target = $(e.target).attr("href"); 
		var target=$(e.target).data("target");
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
		});
	});
	
	$('#viewdotoptab > li > a').click(function(e){
		e.preventDefault();
  		$(this).tab('show');
	})
	App.blockUI({boxed: true,message: 'Harap Tunggu'});
	$($('#viewdotoptab.nav-tabs > .active > a').data("target")).load($('#viewdotoptab.nav-tabs > .active > a').attr("href"), function(result){
		$('#viewdotoptab.nav-tabs > .active > a').tab('show');
		App.unblockUI();
	});
});
</script>
<style>
.tabbable-line > .my-nav-tabs > li.active > a, 
.tabbable-line > .my-nav-tabs > li.active > a:hover, 
.tabbable-line > .my-nav-tabs > li.active > a:focus{
	cursor: pointer;
}
</style>
	<a href="<?=base_url().$this->router->fetch_directory().$this->router->fetch_class().'/doList'?>" class="ajaxify btn btn-circle btn-icon-only btn-default tooltips" data-toggle="tooltip" title="Daftar" data-target="topTab">
		<i class="fa fa-bars"></i>
	</a>
	<?php
	if($this->siak_menu->cek_access($this->router->fetch_directory().$this->router->fetch_class().'/doAdd')):?>
	<a href="<?=$this->router->fetch_directory().$this->router->fetch_class().'/doAdd'?>" class="ajaxify btn btn-circle btn-icon-only btn-default tooltips" data-toggle="tooltip" title="Tambah" data-target="topTab"><i class="fa fa-plus"></i></a>
	<?php 
		endif; 		
	?>	
<ul class="page-sidebar-menu visible-sm visible-xs  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
	<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
	<!-- DOC: This is mobile version of the horizontal menu. The desktop version is defined(duplicated) in the header above -->
	<?php foreach ($data_menu as $menu):?>
	<li class="nav-item">
            <?php 
					if(empty($menu->menu_link)){?>
               <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
            <?php echo (empty($menu->menu_display))?$menu->menu_name:$menu->menu_display; ?>
               </a>
            <?php
	                  $data_menu_child=$menu->menu_child_access($this->session_activerecord->userdata('user_level'));
					  if(count($data_menu_child) > 0){
			?>
               <ul class="sub-menu">   
            <?php 
				  		foreach ($data_menu_child as $menu_child):							
			?>               
                  <li class="nav-item">
						<a href="<?=base_url().$menu_child->menu_link?>" <? echo "class=\"ajaxify\" data-target=\"page-content\""; ?>><?php echo $menu_child->menu_name?></a>
                  </li>  
            <?php endforeach;?>
               </ul>
            <?php
					}
			?>   
            <?php }else{?>
               <a href="<?php echo base_url().$menu->menu_link?>" class="ajaxify" data-target="page-content" >
                   <?php echo (empty($menu->menu_display))?$menu->menu_name:$menu->menu_display;?>   
               </a>  
            <?php }?>                              
    </li>
    <?php endforeach;?>	
</ul>
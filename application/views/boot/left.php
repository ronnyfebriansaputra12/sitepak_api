      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
            <li>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               <div class="sidebar-toggler hidden-phone"></div>
               <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li>
               <div style="height:5px"></div>
            </li>
            <li>
               <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
               <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
			<?if($this->session_activerecord->userdata("is_internal")=="Y"){?>
            <li class="start active open">
               <a href="<?=base_url().'home/user_profile/doView'?>" class="ajaxify start">
                   <i class="fa fa-home"></i> 
                   <span class="title">Halaman Utama</span>
				   <span class="selected"></span>				   
               </a>
            </li>
			<? }else{?>
			<li class="start active open">
               <a href="<?=base_url().'home/user_instansi/doView'?>" class="ajaxify start">
                   <i class="fa fa-home"></i> 
                   <span class="title">Halaman Utama</span>
				   <span class="selected"></span>				   
               </a>
            </li>
			<? }?>
            <?php foreach ($data_menu as $menu):?>
            <li>
            <?php 
					if(empty($menu->menu_link)){?>
               <a href="javascript:;">
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
                  <li>
                     <a href="<?=base_url().$menu_child->menu_link?>" <?php if($menu_child->id == "0501" || $menu_child->id == "0502" || $menu_child->id == "0503" || $menu_child->id == "0504" || $menu_child->id == "0505"){ echo "target=\"_blank\"";}else{echo "class=\"ajaxify\"";} ?>><?php echo $menu_child->menu_name?></a>
                  </li>   
                  <?if($this->session_activerecord->userdata("is_internal")=="Y"):?> 
				  
                  <?endif;?>                 
            <?php endforeach;?>
               </ul>
            <?php
					}
			?>   
            <?php }else{?>
               <a href="<?php echo base_url().$menu->menu_link?>" class="ajaxify">
                   <?php echo (empty($menu->menu_display))?$menu->menu_name:$menu->menu_display;?>   
               </a>  
               <?php }?>                              
            </li>
			
            <?php endforeach;?> 
			
         </ul>
         <!-- END SIDEBAR MENU -->
      </div>	  
      <!-- END SIDEBAR -->
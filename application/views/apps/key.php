<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>DWH V-01 | Login </title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL STYLES --> 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/select2/select2_metro.css" />
   <!-- END PAGE LEVEL SCRIPTS -->
   <!-- BEGIN THEME STYLES --> 
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
   <link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
   <!-- BEGIN LOGO -->
   <div class="logo">
      <img src="<?php echo base_url().VER_TEMPLATE;?>assets/img/GARUDA_logo.png" width="100" height="90"/>
   </div>
   <!-- END LOGO -->
   <!-- BEGIN LOGIN -->
   <div class="content">
   <!-- BEGIN LOGO -->
   <div align="center">
      <img src="<?php echo base_url().VER_TEMPLATE;?>assets/img/logoSiak.png" width="150" height="157"/>
   </div>
   <div>
      &nbsp;
   </div>
   <!-- END LOGO -->
      <!-- BEGIN LOGIN FORM -->
      <form class="login-form" action="<?php echo base_url().$this->router->fetch_class().'/'.$this->router->fetch_method();?>" method="post">
          <!-- <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>Enter any username and password. <?php echo base_url().VER_TEMPLATE;?></span>
         </div>-->
		<div class="alert alert-danger display-hide">
			<button data-close="alert" class="close"></button>
			<span id="form_validation_place"></span>
		</div>
         <div class="form-group" align="center">
		 	<span class="label label-sm label-warning" style="font-size:18px;"><?=$this->siak_key->key_encript()?></span>
		 </div>
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Key</label>
            <div class="input-icon">
               <i class="fa fa-key"></i>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Key" name="key" data-rule-required="true" data-msg-required="Key Harus Diisi" />
            </div>
         </div>                          
         <?php if($this->session_activerecord->userdata('verify_code') != ''):?>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Kode Verifikasi </label>
            <div class="input-icon">
               <i class="fa fa-picture-o"></i>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Kode Verifikasi" name="verifikasi" data-rule-required="true" data-msg-required="Kode Verifikasi Harus Diisi" />
            </div>
         </div>
         <div class="form-group" align="center">
            <img src="<?php echo base_url().$this->router->fetch_class().'/capcha/'.uniqid();?>" />
         </div>
         <?php endif?>
         <div class="form-actions">
            <button type="submit" class="btn blue pull-right">
            Simpan <i class="fa fa-save m-icon-white"></i>
            </button>            
         </div>
         <div align="center" style="font-size:14px; color:#FFFFFF;">
		 	    Sistem Informasi Adminitrasi Kependudukan
         </div>
         <div class="create-account">
         </div>
      </form>
      <!-- END LOGIN FORM -->  
   </div>   
   <!-- END LOGIN -->
   <!-- BEGIN COPYRIGHT -->
   <div class="copyright">
      <img src="<?php echo base_url().VER_TEMPLATE;?>assets/img/ddn14.png" width="360"/>
   </div>
   <!-- END COPYRIGHT -->
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/scripts/app.js" type="text/javascript"></script>
   <script src="<?php echo base_url().VER_TEMPLATE;?>assets/scripts/login-soft.js" type="text/javascript"></script>      
   <!-- END PAGE LEVEL SCRIPTS --> 
   <script>
      jQuery(document).ready(function() {     
        App.init();
        Login.init("<?php echo base_url().VER_TEMPLATE;?>");
        <?php echo (isset($js_validate))?$js_validate:''?>
      });
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
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
   <link rel="shortcut icon" href="<?php echo base_url().VER_TEMPLATE;?>assets/img/1.ico"/>
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
      <img src="<?php echo base_url().VER_TEMPLATE;?>assets/img/logoSiak.png" width="185" height="160"/>
   </div>
   <div>
      &nbsp;
   </div>
   <!-- END LOGO -->
      <!-- BEGIN LOGIN FORM -->
      <div class="display-hide" id="tespdf"></div>
      <div class="alert alert-danger display-hide" id="browser_check">
         <button data-close="alert" class="close"></button>
         <span id="browser_check_place"></span>
      </div>
      <form class="login-form" action="<?php echo base_url().$this->router->fetch_class().'/'.$this->router->fetch_method();?>" method="post" id="login-form">
          <!-- <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            <span>Enter any username and password. <?php echo base_url().VER_TEMPLATE;?></span>
         </div>-->
		<div class="alert alert-danger display-hide">
			<button data-close="alert" class="close"></button>
			<span id="form_validation_place"></span>
		</div>
         <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Nama Pengguna</label>
            <div class="input-icon">
               <i class="fa fa-user"></i>
               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nama Pengguna" name="username" data-rule-required="true" data-msg-required="Nama Pengguna Harus Diisi" />
            </div>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Kata Kunci</label>
            <div class="input-icon">
               <i class="fa fa-lock"></i>
               <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Kata Kunci" name="password" data-rule-required="true" data-msg-required="Kata Kunci Harus Diisi" />
            </div>
         </div>
         <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">ID Pengguna</label>
            <div class="input-icon">
				<select class="form-control input-sm placeholder-no-fix" name="ID_PENGGUNA" id="ID_PENGGUNA" autocomplete="off" placeholder="Pilih Masuk Sebagai" data-rule-required="true" data-msg-required="Pilihan Pengguna Harus Diisi">
					<option value="">=== PILIH PENGGUNA ===</option>
					<option value="2">DITJEN ADMINDUK</option>
					<option value="3">LEMBAGA PENGGUNA</option>
				</select>
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
            <button type="submit" class="btn yellow pull-right">
            Masuk <i class="m-icon-swapright m-icon-white"></i>
            </button>            
         </div>
         <div align="center" style="font-size:14px; color:#FFFFFF;">
		 	    DWH - PEMANFAATAN DATA
         </div>
         <div class="create-account">
            <p id="versi" style="color:#FFFFFF; opacity: 0">v <?=$this->config->item('versi')?></p>
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
   <script type="text/javascript" src="<?php echo base_url().VER_MINDUK?>js/modernizr.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url().VER_MINDUK?>js/swfobject/swfobject.js"></script>
   <script type="text/javascript" src="<?php echo base_url().VER_MINDUK?>js/pdfobject.js"></script>      
   <!-- END PAGE LEVEL SCRIPTS --> 
   <script>   
      jQuery(document).ready(function() {     
         App.init();
         Login.init("<?php echo base_url().VER_TEMPLATE;?>");
         var tidak_browser=false;
         if (!Modernizr.input.placeholder) {
              $('#browser_check_place').append('<li>Browser anda tidak mendukung input place holder </li>');
              tidak_browser=true;
         } 
         if (!Modernizr.canvas) {
            $('#browser_check_place').append('<li>Browser anda tidak mendukung html5 canvas</li>');
            tidak_browser=true;
         }
         if (!Modernizr.canvastext) {
            $('#browser_check_place').append('<li>Browser anda tidak mendukung html5 tulisan canvas</li>');
            tidak_browser=true; 
         }
         if (!Modernizr.svg) {
            $('#browser_check_place').append('<li>Browser anda tidak mendukung file format SVG</li>');
            tidak_browser=true;  
         }
         if(!swfobject.hasFlashPlayerVersion("11.7")){
            $('#browser_check_place').append('<li>Anda tidak dapat mengambil foto langsung dari kamera karena browser anda belum terpasang Flash player versi 11.6 atau yang terbaru <a href="<?=base_url()?>file_pedukung/Adobe_Flash_Player_11.6.602.180_Offline_Installer_For_Windows_64bit.exe" download="Adobe_Flash_Player_11.6.602.180_Offline_Installer_For_Windows_64bit.exe"> Download Flash Player </a></li>');            
         }         
         var params = {          
            url: "<?=base_url().VER_MINDUK?>js/pdfjs/web/compressed.tracemonkey-pldi-09.pdf",            
            pdfOpenParams: {            
               navpanes: 0,
               toolbar: 0,
               statusbar: 0,
               view: "FitV"            
            }         
         };
         var myPDF = new PDFObject(params).embed("tespdf");      
         if(!myPDF){
            $('#browser_check_place').append('<li>Anda tidak dapat mencetak karena browser anda tidak mendukung format pdf <a href="<?=base_url()?>file_pedukung/AdbeRdr11000_en_US.exe" download="AdbeRdr11000_en_US.exe"> Download Adobe Reader (PDF) </a></li>');
            $('#browser_check').show();            
         }         
         if(tidak_browser){
            $('#browser_check_place').prepend('Browser anda tidak mendukung siak versi 5 <a href="<?=base_url()?>file_pedukung/FirefoxSetup38.0.1.exe"> Download Browser </a> karena');
            $('#login-form').remove();
            $('#browser_check').show();
         }
         $('#versi').bind('mouseenter click',function(){            
            $(this).css('opacity',1);
         });
         $('#versi').bind('mouseleave',function(){            
            $(this).css('opacity',0);
         });
        <?php echo (isset($js_validate))?$js_validate:''?>
      });
      window.onerror = function() {
         $('#browser_check_place').append('<li>Browser anda tidak mendukung siak versi 5 <span class="help-block afterChange"> <a href="<?=base_url()?>file_pedukung/FirefoxSetup38.0.1.exe"> Download Browser </a></span></li>');
         $('#login-form').remove();
         $('#browser_check').show();
      };
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<html>
<head>
<link href="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/pages/error.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<style>
	a {
    color: #d12610;
    text-decoration: none;
	}
	a:hover, a:focus {
		color: #ad0505;
		text-decoration: underline;
	}
</style>
</head>
<body class="page-500-full-page">
   <div class="row">
      <div class="col-md-12 page-500">
         <div class="number" style="color:#d12610"><br />
            DWH
         </div>
         <div class=" details">
            <h3></h3>
            <p>
               <?php echo $msg?><br />
               .<br /><br />
            </p>
         </div>
      </div>
   </div>
</body>
</html>
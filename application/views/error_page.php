<html>
<head>
	<title>Kesalahan User</title>
	<link href="<?php echo base_url().VER_TEMPLATE;?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().VER_TEMPLATE;?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>	
</head>
<body class="page-header-fixed page-sidebar-fixed page-footer-fixed">
	<div id="siakMainFullScreen"><?php echo $this->load->view('error_msg',array('msg'=>$msg),true);?></div>
</body>
</html>
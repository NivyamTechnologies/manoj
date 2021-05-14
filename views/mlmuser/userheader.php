<!DOCTYPE html>

 <html lang="en" class="no-js"> 

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title>Assurdness</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->        

	<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/font-awesome/css/font-awesome.min.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/bootstrap/css/bootstrap.min.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/uniform/css/uniform.default.css';?> rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<link href=<?php echo base_url().'assets/plugins/gritter/css/jquery.gritter.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar/fullcalendar.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/jqvmap.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css';?> rel="stylesheet" type="text/css"/>

<!-- END PAGE LEVEL PLUGIN STYLES -->

<!-- BEGIN THEME STYLES -->

<link href=<?php echo base_url().'assets/css/style-metronic.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/css/style.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/css/style-responsive.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/css/plugins.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/css/pages/tasks.css';?> rel="stylesheet" type="text/css"/>

<link href=<?php echo base_url().'assets/css/themes/default.css';?> rel="stylesheet" type="text/css" id="style_color"/>

<link href=<?php echo base_url().'assets/css/print.css';?> rel="stylesheet" type="text/css" media="print"/>

<link href=<?php echo base_url().'assets/css/custom.css';?> rel="stylesheet" type="text/css"/>

	<!--END PAGE LEVEL STYLES-->

	<link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'?>" />

</head>

<!-- END HEAD -->

<body class="page-header-fixed">

<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="#">
				<img style="margin-top:8px; height: 43px;" src="<?php echo base_url().'assets/img/logo.png'?>" alt="logo" />
				</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $("#phone-hide1").click(function(){
        $(".page-sidebar-menu").slideToggle("fast");
    });
});
</script>

<style> 
@media(max-width:500px){ .navbar-collapse.collapse {
    display: none!important;
    height: auto!important;
    padding-bottom: 0;
    overflow: visible!important;
}

.page-content {
    margin-left: 0px !important;
    margin-top: 0px;
    min-height: 600px;
    padding: 25px 20px 20px 20px;
}

.page-sidebar-closed .page-sidebar {
    width: 35px !important;
    display: block !important;
}

}
</style>

            	<li class="sidebar-toggler-wrapper phone-hide">
					<div class="sidebar-toggler" id="phone-hide1"></div>
				</li>
                
				<!-- END LOGO -->
				        
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">					          
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img src="<?php echo base_url(); ?><?php echo $userview[0]->profilepic;?>" height="35px;" width="45px;">
						<span class="username"> </span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>login/change_password"><i class="icon-lock"></i>Forget Password</a></li>
							<li><a href="<?php echo base_url().'login/userlogout'?>"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->


<!-- BEGIN CONTAINER -->
<div class="page-container">
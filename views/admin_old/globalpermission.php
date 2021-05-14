<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Online CMS</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>assets/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico"/>

 <script src="<?php echo base_url().'assets/scripts/jquery-1.10.1.min.js';?>" type="text/javascript"></script>
        
        <script type="text/javascript">
			$(document).ready(function() {    
			$("#FirstName,#LastName,#date").keyup(function() {
				var date = $("#date").val().split('-');
				var fname = $("#FirstName").val();
				var lname = $("#LastName").val();       
				var orgId = fname.charAt(0)+ lname.charAt(0)+ date.join('');
				$("#OrgID").val(orgId);
			});
		});	
		</script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<?php require_once('adminheader.php');?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<?php require_once('adminsidebar.php');?>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
							 THEME COLOR
						</span>
						<ul>
							<li class="color-black current color-default" data-style="default">
							</li>
							<li class="color-blue" data-style="blue">
							</li>
							<li class="color-brown" data-style="brown">
							</li>
							<li class="color-purple" data-style="purple">
							</li>
							<li class="color-grey" data-style="grey">
							</li>
							<li class="color-white color-light" data-style="light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
							 Layout
						</span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Header
						</span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar
						</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar Position
						</span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Footer
						</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Organization <small>Details</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">
								Organization
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						
						
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom boxless tabbable-reversed">
						<div class="tab-pane " id="tab_2">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Details
										</div>
										<!--<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a>
											<a href="javascript:;" class="reload">
											</a>
											<a href="javascript:;" class="remove">
											</a>
										</div>-->
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
					<?php echo form_open_multipart('admin/globalpermission/'); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>                              
											<div class="form-body">
												<h3 class="form-section">Global Menu Permission</h3>
												
												<!--Menu View Start-->
												<div class="page-sidebar-wrapper">
													<div class="page-sidebar navbar-collapse collapse">
														<!-- BEGIN SIDEBAR MENU -->
														<ul class="page-sidebar-menu">
				
				
				
				<?php
				foreach($userinfo as $uservalue)
				{
					$orgrole = $uservalue->org_role;
								
				?>
				
				<?php
				if($orgrole==1)
				{
				?>
				<li class="start ">
					<a href="<?php echo base_url()?>admin/dashboard">
						<i class="fa fa-home"></i>
						<span class="title">
							Menu Permission
						</span>
					</a>
				</li>
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
						Basic Configuration
						</span>						
					</a>
					
					<ul class="sub-menu">
						<li>
							<a href="<?php echo base_url();?>admin/organization">
								<i class="fa fa-bullhorn"></i>
								Organization
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_orders.html">
								<i class="fa fa-shopping-cart"></i>
								Coaching
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_orders_view.html">
								<i class="fa fa-tags"></i>
								Coaching/Organization Session
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_products.html">
								<i class="fa fa-sitemap"></i>
								Coaching/Organization Global Config
							</a>
						</li>
						<li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Holiday Config
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Class
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Section
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Grade
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Subject/Skill/Formative
							</a>
						</li>
                        <li>
							<a href="../temp/ecommerce_products_edit.html">
								<i class="fa fa-file-o"></i>
								Allocate Subject
							</a>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/globalpermission">
								<i class="fa fa-sitemap"></i>
								Global Menu Permission
							</a>
						</li>
					</ul>
					
				</li>
						
			
           		<?php
				if($orgrole==3||$orgrole==2||$orgrole==1)
				{
				?>
           		<!--Coaching Management-->
            	<li>
					<a href="javascript:;">
						<i class="fa fa-gift"></i>
						<span class="title">
							Coaching Management
						</span>
						<span class="arrow">
						</span>
					</a>
					<ul class="sub-menu">
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete E-Commerce Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_ecommerce" target="_blank">
								<span class="title">
									Manage
								</span>
							</a>
						</li>
						<li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
								<span class="title">
									Feature
								</span>
							</a>
						</li>
                        <li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="Complete Multipurpose Corporate Frontend Theme For Metronic Admin">
							<a href="http://keenthemes.com/preview/index.php?theme=metronic_frontend" target="_blank">
								<span class="title">
									Report
								</span>
							</a>
						</li>
					</ul>
				</li>
				<?php
				}?>
				
				<?php
				if($orgrole==4||$orgrole==2||$orgrole==1)
				{
				?>
				<!--Teacher Management-->				
               	<li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Management
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_manage_global as $teacher_manage_val)
								{
									$view_teacher_manage_id = $teacher_manage_val->id;
									
									$view_teacher_manage = $teacher_manage_val->menu_name;
									
									$view_teacher_manage_menu_status = $teacher_manage_val->menu_status;
								
								?>
								<input type="checkbox" name="textmanage[]" value="<?php echo $view_teacher_manage_id; ?>" <?php ($view_teacher_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_manage_id;?> <?php echo $view_teacher_manage; ?>
																								
								
								<?php
								}?>
								<button type="submit" name="set_teacher_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_manage_disable" class="btn green">Set Disable</button>
							</ul>					
						</li>
                        
                        
                        
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
								foreach($menu_teacher_report_global as $teacher_report_val)
								{
									$view_teacher_report_id = $teacher_report_val->id;
									
									$view_teacher_report = $teacher_report_val->menu_name;
									
									$view_teacher_report_menu_status = $teacher_report_val->menu_status;
								?>
								<input type="checkbox" name="textreport[]" value="<?php echo $view_teacher_report_id; ?>" <?php ($view_teacher_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_report_id;?> <?php echo $view_teacher_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_report_disable" class="btn green">Set Disable</button>
							</ul>
						</li>
						
						<li>
					<a href="javascript:;">
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Attendance
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
							<?php
						foreach($menu_teacher_attendance_manage_global as $teacher_attendance_manage_val)
								{
		$view_teacher_attendance_manage_id = $teacher_attendance_manage_val->id;
		$view_teacher_attendance_manage_menu_status = $teacher_attendance_manage_val->menu_status;		$view_teacher_attendance_manage = $teacher_attendance_manage_val->menu_name;
								?>
                         		<input type="checkbox" name="textattendance_manage[]" value="<?php echo $view_teacher_attendance_manage_id; ?>" <?php ($view_teacher_attendance_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_attendance_manage_id;?> <?php echo $view_teacher_attendance_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_attendance_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_attendance_manage_disable" class="btn green">Set Disable</button>
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
			foreach($menu_teacher_attendance_feature_global as $teacher_attendance_feature_val)
								{
		$view_teacher_attendance_feature_id = $teacher_attendance_feature_val->id;
		$view_teacher_attendance_feature_menu_status = $teacher_attendance_feature_val->menu_status;	
		$view_teacher_attendance_feature = $teacher_attendance_feature_val->menu_name;	
								?>
								<input type="checkbox" name="textattendance_feature[]" value="<?php echo $view_teacher_attendance_feature_id; ?>" <?php ($view_teacher_attendance_feature_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_attendance_feature_id;?> <?php echo $view_teacher_attendance_feature; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_attendance_feature_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_attendance_feature_disable" class="btn green">Set Disable</button>
							</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
			foreach($menu_teacher_attendance_report_global as $teacher_attendance_report_val)
								{
		$view_teacher_attendance_report_id = $teacher_attendance_report_val->id;
		$view_teacher_attendance_report_menu_status = $teacher_attendance_report_val->menu_status;	
		$view_teacher_attendance_report = $teacher_attendance_report_val->menu_name;
								?>
                            <input type="checkbox" name="textattendance_report[]" value="<?php echo $view_teacher_attendance_report_id; ?>" <?php ($view_teacher_attendance_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_attendance_report_id;?> <?php echo $view_teacher_attendance_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_attendance_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_attendance_report_disable" class="btn green">Set Disable</button>                    
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                   				
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Leave Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_teacher_leave_manage_global as $teacher_leave_manage_val)
								{
	$view_teacher_leave_manage_id = $teacher_leave_manage_val->id;
	$view_teacher_leave_manage_menu_status = $teacher_leave_manage_val->menu_status;	
	$view_teacher_leave_manage = $teacher_leave_manage_val->menu_name;								
								?>
                           <input type="checkbox" name="textleave_manage[]" value="<?php echo $view_teacher_leave_manage_id; ?>" <?php ($view_teacher_leave_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_leave_manage_id;?> <?php echo $view_teacher_leave_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_leave_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_leave_manage_disable" class="btn green">Set Disable</button>   
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
		foreach($menu_teacher_leave_feature_global as $teacher_leave_feature_val)
								{
	$view_teacher_leave_feature_id = $teacher_leave_feature_val->id;
	$view_teacher_leave_feature_menu_status = $teacher_leave_feature_val->menu_status;
	$view_teacher_leave_feature = $teacher_leave_feature_val->menu_name;
								?>
								<input type="checkbox" name="textleave_feature[]" value="<?php echo $view_teacher_leave_feature_id; ?>" <?php ($view_teacher_leave_feature_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_leave_feature_id;?> <?php echo $view_teacher_leave_feature; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_leave_feature_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_leave_feature_disable" class="btn green">Set Disable</button> 
							</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">								
                                <?php
	foreach($menu_teacher_leave_report_global as $teacher_leave_report_val)
								{
	$view_teacher_leave_report_id = $teacher_leave_report_val->id;
	$view_teacher_leave_report_menu_status = $teacher_leave_report_val->menu_status;
	$view_teacher_leave_report = $teacher_leave_report_val->menu_name;								
								?>
                            <input type="checkbox" name="textleave_feature[]" value="<?php echo $view_teacher_leave_report_id; ?>" <?php ($view_teacher_leave_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_leave_report_id;?> <?php echo $view_teacher_leave_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_leave_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_leave_report_disable" class="btn green">Set Disable</button> 
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                   				
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Payroll
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_teacher_payroll_manage_global as $teacher_payroll_manage_val)
								{
	$view_teacher_payroll_manage_id = $teacher_payroll_manage_val->id;
	$view_teacher_payroll_manage_menu_status = $teacher_payroll_manage_val->menu_status;
	$view_teacher_payroll_manage = $teacher_payroll_manage_val->menu_name;
								?>
                          	<input type="checkbox" name="textpayroll_manage[]" value="<?php echo $view_teacher_payroll_manage_id; ?>" <?php ($view_teacher_payroll_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_payroll_manage_id;?> <?php echo $view_teacher_payroll_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_payroll_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_payroll_manage_disable" class="btn green">Set Disable</button>                                 
                           	</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_teacher_payroll_feature_global as $teacher_payroll_feature_val)
								{
	$view_teacher_payroll_feature_id = $teacher_payroll_feature_val->id;
	$view_teacher_payroll_feature_menu_status = $teacher_payroll_feature_val->menu_status;
	$view_teacher_payroll_feature = $teacher_payroll_feature_val->menu_name;
								?>
								<input type="checkbox" name="textpayroll_feature[]" value="<?php echo $view_teacher_payroll_feature_id; ?>" <?php ($view_teacher_payroll_feature_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_payroll_feature_id;?> <?php echo $view_teacher_payroll_feature; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_payroll_feature_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_payroll_feature_disable" class="btn green">Set Disable</button>      
							</ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								 <?php
		foreach($menu_teacher_payroll_report_global as $teacher_payroll_report_val)
								{
	$view_teacher_payroll_report_id = $teacher_payroll_report_val->id;
	$view_teacher_payroll_report_menu_status = $teacher_payroll_report_val->menu_status;
	$view_teacher_payroll_report = $teacher_payroll_report_val->menu_name;
								?>
                            <input type="checkbox" name="textpayroll_report[]" value="<?php echo $view_teacher_payroll_report_id; ?>" <?php ($view_teacher_payroll_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_payroll_report_id;?> <?php echo $view_teacher_payroll_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_payroll_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_payroll_report_disable" class="btn green">Set Disable</button>                                
                             </ul>
						</li>
						
						
					</ul>
                   				</li>
                   				
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Teacher Release Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
			foreach($menu_teacher_release_manage_global as $teacher_release_manage_val)
								{
	$view_teacher_release_manage_id = $teacher_release_manage_val->id;
	$view_teacher_release_manage_menu_status = $teacher_release_manage_val->menu_status;
	$view_teacher_release_manage = $teacher_release_manage_val->menu_name;
								?>
                           <input type="checkbox" name="textrelease_manage[]" value="<?php echo $view_teacher_release_manage_id; ?>" <?php ($view_teacher_release_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_release_manage_id;?> <?php echo $view_teacher_release_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_release_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_release_manage_disable" class="btn green">Set Disable</button>   
                            </ul>
						</li>
                                                
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
		foreach($menu_teacher_release_report_global as $teacher_release_report_val)
								{
	$view_teacher_release_report_id = $teacher_release_report_val->id;
	$view_teacher_release_report_menu_status = $teacher_release_report_val->menu_status;
	$view_teacher_release_report = $teacher_release_report_val->menu_name;
								?>
								<input type="checkbox" name="textrelease_report[]" value="<?php echo $view_teacher_release_report_id; ?>" <?php ($view_teacher_release_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_teacher_release_report_id;?> <?php echo $view_teacher_release_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_teacher_release_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_release_report_disable" class="btn green">Set Disable</button>    
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                   				
                   		
						
					</ul>
                   				</li>
                <?php
				}?>
               
                <?php
				if($orgrole==5||$orgrole==2||$orgrole==1)
				{
				?>                               
                <!--Student Management-->                                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Management
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
		foreach($menu_student_manage_global as $student_manage_val)
								{
		$view_student_manage_id = $student_manage_val->id;
		$view_student_manage_menu_status = $student_manage_val->menu_status;	
		$view_student_manage = $student_manage_val->menu_name;								
								?>
                           <input type="checkbox" name="textstudent_manage[]" value="<?php echo $view_student_manage_id; ?>" <?php ($view_student_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_manage_id;?> <?php echo $view_student_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_manage_disable" class="btn green">Set Disable</button> 
                            </ul>
						</li>
                                       
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_report_global as $student_report_val)
								{
		$view_student_report_id = $student_report_val->id;
		$view_student_report_menu_status = $student_report_val->menu_status;
		$view_student_report = $student_report_val->menu_name;								
								?>
								<input type="checkbox" name="textstudent_report[]" value="<?php echo $view_student_report_id; ?>" <?php ($view_student_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_report_id;?> <?php echo $view_student_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_report_disable" class="btn green">Set Disable</button>  
							</ul>
						</li>
                        
						<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Attendance Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
		foreach($menu_student_attendance_manage_global as $student_attendance_manage_val)
								{
		$view_student_attendance_manage_id = $student_attendance_manage_val->id;
		$view_student_attendance_manage_menu_status = $student_attendance_manage_val->menu_status;
		$view_student_attendance_manage = $student_attendance_manage_val->menu_name;
								?>
                           <input type="checkbox" name="textstudent_attendance_manage[]" value="<?php echo $view_student_attendance_manage_id; ?>" <?php ($view_student_attendance_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_attendance_manage_id;?> <?php echo $view_student_attendance_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_attendance_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_attendance_manage_disable" class="btn green">Set Disable</button>                                   
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_attendance_feature_global as $student_attendance_feature_val)
								{
		$view_student_attendance_feature_id = $student_attendance_feature_val->id;
		$view_student_attendance_feature_menu_status = $student_attendance_feature_val->menu_status;
		$view_student_attendance_feature = $student_attendance_feature_val->menu_name;
								?>
								<input type="checkbox" name="textstudent_attendance_feature[]" value="<?php echo $view_student_attendance_feature_id; ?>" <?php ($view_student_attendance_feature_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_attendance_feature_id;?> <?php echo $view_student_attendance_feature; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_attendance_feature_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_attendance_feature_disable" class="btn green">Set Disable</button>  
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_attendance_report_global as $student_attendance_report_val)
								{
	$view_student_attendance_report_id = $student_attendance_report_val->id;
	$view_student_attendance_report_menu_status = $student_attendance_report_val->menu_status;
	$view_student_attendance_report = $student_attendance_report_val->menu_name;
								?>
								<input type="checkbox" name="textstudent_attendance_report[]" value="<?php echo $view_student_attendance_report_id; ?>" <?php ($view_student_attendance_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_attendance_report_id;?> <?php echo $view_student_attendance_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_attendance_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_attendance_report_disable" class="btn green">Set Disable</button>   
							</ul>
						</li>
						
					</ul>
                 	
                 	<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Certificates
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_certificate_manage_global as $student_certificate_manage_val)
								{
	$view_student_certificate_manage_id = $student_certificate_manage_val->id;
	$view_student_certificate_manage_menu_status = $student_certificate_manage_val->menu_status;
	$view_student_certificate_manage = $student_certificate_manage_val->menu_name;
								?>
                           <input type="checkbox" name="textstudent_certificate_manage[]" value="<?php echo $view_student_certificate_manage_id; ?>" <?php ($view_student_certificate_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_certificate_manage_id;?> <?php echo $view_student_certificate_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_certificate_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_certificate_manage_disable" class="btn green">Set Disable</button> 
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_certificate_feature_global as $student_certificate_feature_val)
								{
	$view_student_certificate_feature_id = $student_certificate_feature_val->id;
	$view_student_certificate_feature_menu_status = $student_certificate_feature_val->menu_status;
	$view_student_certificate_feature = $student_certificate_feature_val->menu_name;
								?>
								<input type="checkbox" name="textstudent_certificate_feature[]" value="<?php echo $view_student_certificate_feature_id; ?>" <?php ($view_student_certificate_feature_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_certificate_feature_id;?> <?php echo $view_student_certificate_feature; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_certificate_feature_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_certificate_feature_disable" class="btn green">Set Disable</button>  
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_certificate_report_global as $student_certificate_report_val)
								{
	$view_student_certificate_report_id = $student_certificate_report_val->id;
	$view_student_certificate_report_menu_status = $student_certificate_report_val->menu_status;
	$view_student_certificate_report = $student_certificate_report_val->menu_name;
								?>
								<input type="checkbox" name="textstudent_certificate_report[]" value="<?php echo $view_student_certificate_report_id; ?>" <?php ($view_student_certificate_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_certificate_report_id;?> <?php echo $view_student_certificate_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_certificate_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_certificate_report_disable" class="btn green">Set Disable</button> 
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                  	
                   	</li>
                   	
                   		<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Student Class Note, Assignment & Homework
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_class_manage_global as $student_class_manage_val)
								{
	$view_student_class_manage_id = $student_class_manage_val->id;
	$view_student_class_manage_menu_status = $student_class_manage_val->menu_status;
	$view_student_class_manage = $student_class_manage_val->menu_name;
								?>
                           <input type="checkbox" name="textstudent_class_manage[]" value="<?php echo $view_student_class_manage_id; ?>" <?php ($view_student_class_manage_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_class_manage_id;?> <?php echo $view_student_class_manage; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_class_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_class_manage_disable" class="btn green">Set Disable</button> 
                            </ul>
						</li>
                       
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<?php
	foreach($menu_student_class_report_global as $student_class_report_val)
								{
	$view_student_class_report_id = $student_class_report_val->id;
	$view_student_class_report_menu_status = $student_class_report_val->menu_status;
	$view_student_class_report = $student_class_report_val->menu_name;
								?>
								<input type="checkbox" name="textstudent_class_report[]" value="<?php echo $view_student_class_report_id; ?>" <?php ($view_student_class_report_menu_status == '1' ? 'checked' : null); ?>/><?php echo $view_student_class_report_id;?> <?php echo $view_student_class_report; ?>
								
								<?php
								}?>
								<button type="submit" name="set_student_class_report_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_student_class_report_disable" class="btn green">Set Disable</button> 
							</ul>
						</li>						

					</ul>
                 </li>	
						
					</ul>                  				
                  	
                   	</li>    
				<?php
				}?>
               
                <!--Fee Manager-->
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Fee Manager V2(16-17)
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Fee Type
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Fee Rule
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Generic Fee Amount
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Specific Fee Amount
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Configure Rebate Fee Amount
									</a>
								</li>
                                
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Entry
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Entry (Multiple Students)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Update Cheque Status
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Fee Challan
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Print/View/Cancel Fee Receipt
									</a>
								</li>
                               
                                
								
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Fee Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Receipt Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>	Fee Collection/Outstanding Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Day Book
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Defaulter Student Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Fee Cancellation Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Fee Day Book
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Rebate Details
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Cheque Deposited Details
									</a>
								</li>
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                               
                <!--Admission Manager-->
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Admission Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Prospectus Configuration
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Related Student Document
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Admission Criteria
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Stages Configuration
									</a>
								</li>
                               
                                
                            </ul>
						</li>
                  
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">

										<i class="fa fa-user"></i>Admission Process
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Entry
									</a>
								</li>
                              
                               
                                
								
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Count Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Admission History
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Criteria Wise Student Admission Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Date Wise Summary Record
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Student Fee Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Receipt Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Collection Outstanding Record
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Admission Fee Collection Day Book
									</a>
								</li>
                                 
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                               
                <!--Notification Manager-->
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Notification Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>SMS Configurator
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Email Configurator
									</a>
								</li>
                               
                             </ul>
						</li>
                    
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>SMS Details
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Email Delivery Report
									</a>
								</li>
                            </ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                               
                <!--TimeTable Manager-->
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Timetable Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Class Timing
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Class Timing Relation
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Add/Edit Timetable
									</a>
								</li>
                                
                                
                            </ul>
						</li>
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>My Timetable
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>View Timetable by Subjects
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>	View Timetable by Faculty
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Complete Timetable
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>View My Timetable
									</a>
								</li>
                                
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>
                               
                <!--Examination Manager-->
                                
				<li>
					<a href="javascript:;">
                    <span class="arrow ">
						</span>
						<i class="fa fa-folder-open"></i>
						<span class="title">
							Examination Manager
						</span>
						
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Manage
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Template Configuration
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Syllabus
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Marksheet Heading
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Allocation
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Assign Optional Paper
									</a>
								</li>
                                
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Test
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Multiple Exam Test
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Online Exams Question Bank
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Online Exams Paper Config
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Multiple Exam Test Grade (SEABA)
									</a>
								</li>
                                
                                
                                
                            </ul>
						</li>
                   
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Feature	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">
										<i class="fa fa-user"></i>Examination Marks Entry
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Physical Health
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Comments
									</a>
								</li>
							</ul>
						</li>
                        
                        <li>
							<a href="javascript:;">
								<i class="fa fa-cogs"></i> Report	
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">								
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Student Mark Sheets 
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Scholastic Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Cross List
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Consolidated Report (CBSE)
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Exam Test Report
									</a>
								</li>
                                <li>
									<a href="#">
										<i class="fa fa-user"></i>Report of Marks Entry
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Assigned Optional Papers
									</a>
								</li>
                                 <li>
									<a href="#">
										<i class="fa fa-user"></i>Result Summary
									</a>
								</li>
                               
                               
                                
								
							</ul>
						</li>
                        
						
						
					</ul>
                   				</li>                                                                     
               <?php
				}}?>
				
			</ul>
														<!-- END SIDEBAR MENU -->
													</div>
												</div>
												<!--Menu View End-->
												
												</div>
												
												<!--/row-->
												<div class="row">
												
													</div><br/>
										
											<!--<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
															<button type="submit" name="set_teacher_manage_enable" class="btn green">Set Enable</button>
															
															<button type="submit" name="set_teacher_manage_disable" class="btn green">Set Disable</button>
															
															
															<button type="button" class="btn default">Cancel</button>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>-->
										<?php echo form_close(); ?>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 2014 &copy; Metronic by keenthemes.
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/scripts/core/app.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/form-samples.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
   // initiate layout and plugins
   App.init();
   FormSamples.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
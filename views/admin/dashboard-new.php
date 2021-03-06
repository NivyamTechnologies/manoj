<!DOCTYPE html>
 <html lang="en" class="no-js"> 
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Online CMS</title>
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
<link href=<?php echo base_url().'assets/css/print.css';?>' rel="stylesheet" type="text/css" media="print"/>
<link href=<?php echo base_url().'assets/css/custom.css';?> rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'?>" />
</head>
<!-- END HEAD -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<?php require_once('adminheader.php'); ?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->			
			<?php require_once('adminsidebar.php'); ?>
			
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
			
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Dashboard 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/dashboard">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/dashboard">
								Dashboard
							</a>
						</li>
						<li class="pull-right">							

								<i class="fa fa-calendar"></i>								

								<?php 

								$date = date_create(date());

							   $todaydate = date_format($date,'d-M-Y');

								echo "Today&nbsp;".$todaydate;?>

								

							

						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
			<?php
				foreach($userinfo as $uservalue)
				{
					$orgrole = $uservalue->org_role;
				}
				?>
				<?php
				if(($orgrole==1)||($orgrole==2))
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?php								
								echo $TotalOrg[0]->register;
								
								?>
							</div>
							<div class="desc">
								 Total Organization
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/organization">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
				<?php
				if(($orgrole==1)||($orgrole==2))
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php								
								echo $TotalTeacher[0]->register;								
								?>
							</div>
							<div class="desc">
								 Total Teacher
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/teacher">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
				<?php
				if(($orgrole==1)||($orgrole==2))
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?php								
								echo $TotalStudent[0]->register;								
								?>
							</div>
							<div class="desc">
								Total Student
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/studentdetail">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
				<?php
				if(($orgrole==1)||($orgrole==2))
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat yellow">
						<div class="visual">
							<i class="fa fa-inr"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php								
								echo number_format($TotalFeecollect[0]->collectfee, 0, '.', ',');								
								?>
							</div>
							<div class="desc">
								 Collect Fee
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/feeconfig">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
				<?php
				if($orgrole==3)
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php								
								echo $TotalTeacher[0]->register;								
								?>
							</div>
							<div class="desc">
								 Total Teacher
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/teacher">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?php								
								echo $TotalStudent[0]->register;								
								?>
							</div>
							<div class="desc">
								Total Student
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/studentdetail">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat yellow">
						<div class="visual">
							<i class="fa fa-briefcase"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php								
								echo $Totalapprove[0]->leaves;								
								?>
							</div>
							<div class="desc">
								 Total Leave
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/leavelist">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
				<?php
				if($orgrole==4)
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php								
								echo $TotalTeacher[0]->register;								
								?>
							</div>
							<div class="desc">
								 Total Teacher
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/teacher">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
				<?php
				if($orgrole==5)
				{
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple">
						<div class="visual">
							<i class="fa fa-user"></i>
						</div>
						<div class="details">
							<div class="number">
								 <?php								
								echo $TotalStudent[0]->register;								
								?>
							</div>
							<div class="desc">
								Total Student
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/studentdetail">
							 View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<?php }?>
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue">

						<div class="portlet-title">
							<div class="caption">
								Notification
							</div>
						</div>

						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">

								<ul class="feeds">

									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col2">
													<marquee direction="up" scrollamount="2" scrolldelay="2" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 2, 0);" height="218">

            <div class="desc">

              

                  <?php if(count($notifications)>0) {

                     foreach($notifications as $n) {

                  ?>

                  <li>                     

                     <?php echo $n->title.'&nbsp;';?>: <?php echo $n->description;?>

                     

                  </li>

                  <?php }

				  } 

				  else echo "coming soon.";

				  ?>

               

            </div>

         </marquee>

												</div>

											</div>

										</div>

										<div class="col2">

											<div class="date">

												 Just now

											</div>

										</div>

									</li>

																		

								</ul>

							</div>

							

						</div>

					</div>
					<!-- END PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">

					<!-- BEGIN PORTLET-->

					<div class="portlet solid bordered light-grey">

						<div class="portlet-title">

							<div class="caption">

								Holiday Calendar

							</div>							

						</div>

						<div class="portlet-body">							

							<?php

									  $i=0;

			foreach($holidaycalendar as $val){

				$holidaydate = $val->holiday_date;

				$holidayname = $val->holiday_name;	

				

			if($i==0)

			{

		$strapprove .='

		{ title: "'.$holidayname.'",  start: "'.$val->holiday_date.'", end: "'.$val->holiday_date.'", allDay: true, editable: false, backgroundColor: "green", borderColor: "green"},';

	}

	else

	{

		$strapprove .='

		{ title: "Approve",  start: "'.$val->holiday_date.'", end: "'.$val->holiday_date.'", allDay: true, editable: false, backgroundColor: "green", borderColor: "green"},';

	}

	$i++;			

	}



?>  

<div id="sidebar-calendar"></div>    

						</div>

					</div>

					<!-- END PORTLET-->

					

				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bell-o"></i>Recent Activities
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn btn-sm default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
										 Filter By <i class="fa fa-angle-down"></i>
									</a>
									<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox"/> Finance</label>
										<label><input type="checkbox" checked=""/> Membership</label>
										<label><input type="checkbox"/> Customer Support</label>
										<label><input type="checkbox" checked=""/> HR</label>
										<label><input type="checkbox"/> System</label>
									</div>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 You have 4 pending tasks.
														<span class="label label-sm label-warning ">
															 Take action <i class="fa fa-share"></i>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 Just now
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-success">
															<i class="fa fa-bar-chart-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Finance Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 You have 5 pending membership that requires a quick review.
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-shopping-cart"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 New order received with
														<span class="label label-sm label-success">
															 Reference Number: DR23923
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 30 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 You have 5 pending membership that requires a quick review.
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-default">
														<i class="fa fa-bell-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 Web server hardware needs to be upgraded.
														<span class="label label-sm label-default ">
															 Overdue
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 2 hours
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-default">
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 IPO Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 You have 4 pending tasks.
														<span class="label label-sm label-warning ">
															 Take action <i class="fa fa-share"></i>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 Just now
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-danger">
															<i class="fa fa-bar-chart-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Finance Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-default">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 You have 5 pending membership that requires a quick review.
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-shopping-cart"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 New order received with
														<span class="label label-sm label-success">
															 Reference Number: DR23923
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 30 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-success">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 You have 5 pending membership that requires a quick review.
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 24 mins
											</div>
										</div>
									</li>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-warning">
														<i class="fa fa-bell-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														 Web server hardware needs to be upgraded.
														<span class="label label-sm label-default ">
															 Overdue
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												 2 hours
											</div>
										</div>
									</li>
									<li>
										<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-briefcase"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 IPO Report for year 2013 has been released.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="scroller-footer">
								<div class="pull-right">
									<a href="#">
										 See All Records <i class="m-icon-swapright m-icon-gray"></i>
									</a>
									 &nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet box green tasks-widget">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-check"></i>Tasks
							</div>
							<div class="tools">
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn default btn-xs" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
										 More <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">
												<i class="i"></i> All Project
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
												 AirAsia
											</a>
										</li>
										<li>
											<a href="#">
												 Cruise
											</a>
										</li>
										<li>
											<a href="#">
												 HSBC
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
												 Pending
												<span class="badge badge-important">
													 4
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												 Completed
												<span class="badge badge-success">
													 12
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												 Overdue
												<span class="badge badge-warning">
													 9
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="task-content">
								<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
									<!-- START TASK LIST -->
									<ul class="task-list">
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Present 2013 Year IPO Statistics at Board Meeting
												</span>
												<span class="label label-sm label-success">
													 Company
												</span>
												<span class="task-bell">
													<i class="fa fa-bell-o"></i>
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Hold An Interview for Marketing Manager Position
												</span>
												<span class="label label-sm label-danger">
													 Marketing
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 AirAsia Intranet System Project Internal Meeting
												</span>
												<span class="label label-sm label-success">
													 AirAsia
												</span>
												<span class="task-bell">
													<i class="fa fa-bell-o"></i>
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Technical Management Meeting
												</span>
												<span class="label label-sm label-warning">
													 Company
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Kick-off Company CRM Mobile App Development
												</span>
												<span class="label label-sm label-info">
													 Internal Products
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Prepare Commercial Offer For SmartVision Website Rewamp
												</span>
												<span class="label label-sm label-danger">
													 SmartVision
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Sign-Off The Comercial Agreement With AutoSmart
												</span>
												<span class="label label-sm label-default">
													 AutoSmart
												</span>
												<span class="task-bell">
													<i class="fa fa-bell-o"></i>
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li>
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 Company Staff Meeting
												</span>
												<span class="label label-sm label-success">
													 Cruise
												</span>
												<span class="task-bell">
													<i class="fa fa-bell-o"></i>
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
										<li class="last-line">
											<div class="task-checkbox">
												<input type="checkbox" class="liChild" value=""/>
											</div>
											<div class="task-title">
												<span class="task-title-sp">
													 KeenThemes Investment Discussion
												</span>
												<span class="label label-sm label-warning">
													 KeenThemes
												</span>
											</div>
											<div class="task-config">
												<div class="task-config-btn btn-group">
													<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
														<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="#">
																<i class="fa fa-check"></i> Complete
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-pencil"></i> Edit
															</a>
														</li>
														<li>
															<a href="#">
																<i class="fa fa-trash-o"></i> Cancel
															</a>
														</li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
									<!-- END START TASK LIST -->
								</div>
							</div>
							<div class="task-footer">
								<span class="pull-right">
									<a href="#">
										 See All Tasks <i class="m-icon-swapright m-icon-gray"></i>
									</a>
									 &nbsp;
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-calendar"></i>General Stats
							</div>
							<div class="actions">
								<a href="javascript:;" class="btn btn-sm yellow easy-pie-chart-reload">
									<i class="fa fa-repeat"></i> Reload
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-4">
									<div class="easy-pie-chart">
										<div class="number transactions" data-percent="55">
											<span>
												 +55
											</span>
											 %
										</div>
										<a class="title" href="#">
											 Transactions <i class="m-icon-swapright"></i>
										</a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm">
								</div>
								<div class="col-md-4">
									<div class="easy-pie-chart">
										<div class="number visits" data-percent="85">
											<span>
												 +85
											</span>
											 %
										</div>
										<a class="title" href="#">
											 New Visits <i class="m-icon-swapright"></i>
										</a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm">
								</div>
								<div class="col-md-4">
									<div class="easy-pie-chart">
										<div class="number bounce" data-percent="46">
											<span>
												 -46
											</span>
											 %
										</div>
										<a class="title" href="#">
											 Bounce <i class="m-icon-swapright"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-calendar"></i>Server Stats
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-4">
									<div class="sparkline-chart">
										<div class="number" id="sparkline_bar">
										</div>
										<a class="title" href="#">
											 Network <i class="m-icon-swapright"></i>
										</a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm">
								</div>
								<div class="col-md-4">
									<div class="sparkline-chart">
										<div class="number" id="sparkline_bar2">
										</div>
										<a class="title" href="#">
											 CPU Load <i class="m-icon-swapright"></i>
										</a>
									</div>
								</div>
								<div class="margin-bottom-10 visible-sm">
								</div>
								<div class="col-md-4">
									<div class="sparkline-chart">
										<div class="number" id="sparkline_line">
										</div>
										<a class="title" href="#">
											 Load Rate <i class="m-icon-swapright"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN REGIONAL STATS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Regional Stats
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div id="region_statistics_loading">
								<img src="assets/img/loading.gif" alt="loading"/>
							</div>
							<div id="region_statistics_content" class="display-none">
								<div class="btn-toolbar margin-bottom-10">
									<div class="btn-group" data-toggle="buttons">
										<a href="" class="btn default btn-sm active">
											 Users
										</a>
										<a href="" class="btn default btn-sm">
											 Orders
										</a>
									</div>
									<div class="btn-group pull-right">
										<a href="" class="btn default btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											 Select Region
											<span class="fa fa-angle-down">
											</span>
										</a>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="javascript:;" id="regional_stat_world">
													 World
												</a>
											</li>
											<li>
												<a href="javascript:;" id="regional_stat_usa">
													 USA
												</a>
											</li>
											<li>
												<a href="javascript:;" id="regional_stat_europe">
													 Europe
												</a>
											</li>
											<li>
												<a href="javascript:;" id="regional_stat_russia">
													 Russia
												</a>
											</li>
											<li>
												<a href="javascript:;" id="regional_stat_germany">
													 Germany
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div id="vmap_world" class="vmaps display-none">
								</div>
								<div id="vmap_usa" class="vmaps display-none">
								</div>
								<div id="vmap_europe" class="vmaps display-none">
								</div>
								<div id="vmap_russia" class="vmaps display-none">
								</div>
								<div id="vmap_germany" class="vmaps display-none">
								</div>
							</div>
						</div>
					</div>
					<!-- END REGIONAL STATS PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet paddingless">
						<div class="portlet-title line">
							<div class="caption">
								<i class="fa fa-bell-o"></i>Feeds
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<!--BEGIN TABS-->
							<div class="tabbable tabbable-custom">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_1_1" data-toggle="tab">
											 System
										</a>
									</li>
									<li>
										<a href="#tab_1_2" data-toggle="tab">
											 Activities
										</a>
									</li>
									<li>
										<a href="#tab_1_3" data-toggle="tab">
											 Recent Users
										</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1_1">
										<div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
											<ul class="feeds">
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-success">
																	<i class="fa fa-bell-o"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 You have 4 pending tasks.
																	<span class="label label-sm label-danger ">
																		 Take action <i class="fa fa-share"></i>
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 Just now
														</div>
													</div>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New version v1.4 just lunched!
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 20 mins
															</div>
														</div>
													</a>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-danger">
																	<i class="fa fa-bolt"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 Database server #12 overloaded. Please fix the issue.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 24 mins
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-info">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 30 mins
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-success">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 40 mins
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-warning">
																	<i class="fa fa-plus"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New user registered.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 1.5 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-success">
																	<i class="fa fa-bell-o"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 Web server hardware needs to be upgraded.
																	<span class="label label-sm label-default ">
																		 Overdue
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 2 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-default">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 3 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-warning">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 5 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-info">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 18 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-default">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 21 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-info">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 22 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-default">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 21 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-info">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 22 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-default">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 21 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-info">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 22 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-default">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 21 hours
														</div>
													</div>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-info">
																	<i class="fa fa-bullhorn"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 New order received. Please take care of it.
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 22 hours
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-pane" id="tab_1_2">
										<div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
											<ul class="feeds">
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New order received
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 10 mins
															</div>
														</div>
													</a>
												</li>
												<li>
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-danger">
																	<i class="fa fa-bolt"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	 Order #24DOP4 has been rejected.
																	<span class="label label-sm label-danger ">
																		 Take action <i class="fa fa-share"></i>
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															 24 mins
														</div>
													</div>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
												<li>
													<a href="#">
														<div class="col1">
															<div class="cont">
																<div class="cont-col1">
																	<div class="label label-sm label-success">
																		<i class="fa fa-bell-o"></i>
																	</div>
																</div>
																<div class="cont-col2">
																	<div class="desc">
																		 New user registered
																	</div>
																</div>
															</div>
														</div>
														<div class="col2">
															<div class="date">
																 Just now
															</div>
														</div>
													</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="tab-pane" id="tab_1_3">
										<div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
											<div class="row">
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Robert Nilson
															</a>
															<span class="label label-sm label-success label-mini">
																 Approved
															</span>
														</div>
														<div>
															 29 Jan 2013 10:45AM
														</div>
													</div>
												</div>
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Lisa Miller
															</a>
															<span class="label label-sm label-info">
																 Pending
															</span>
														</div>
														<div>
															 19 Jan 2013 10:45AM
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Eric Kim
															</a>
															<span class="label label-sm label-info">
																 Pending
															</span>
														</div>
														<div>
															 19 Jan 2013 12:45PM
														</div>
													</div>
												</div>
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Lisa Miller
															</a>
															<span class="label label-sm label-danger">
																 In progress
															</span>
														</div>
														<div>
															 19 Jan 2013 11:55PM
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Eric Kim
															</a>
															<span class="label label-sm label-info">
																 Pending
															</span>
														</div>
														<div>
															 19 Jan 2013 12:45PM
														</div>
													</div>
												</div>
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Lisa Miller
															</a>
															<span class="label label-sm label-danger">
																 In progress
															</span>
														</div>
														<div>
															 19 Jan 2013 11:55PM
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Eric Kim
															</a>
															<span class="label label-sm label-info">
																 Pending
															</span>
														</div>
														<div>
															 19 Jan 2013 12:45PM
														</div>
													</div>
												</div>
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Lisa Miller
															</a>
															<span class="label label-sm label-danger">
																 In progress
															</span>
														</div>
														<div>
															 19 Jan 2013 11:55PM
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Eric Kim
															</a>
															<span class="label label-sm label-info">
																 Pending
															</span>
														</div>
														<div>
															 19 Jan 2013 12:45PM
														</div>
													</div>
												</div>
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Lisa Miller
															</a>
															<span class="label label-sm label-danger">
																 In progress
															</span>
														</div>
														<div>
															 19 Jan 2013 11:55PM
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Eric Kim
															</a>
															<span class="label label-sm label-info">
																 Pending
															</span>
														</div>
														<div>
															 19 Jan 2013 12:45PM
														</div>
													</div>
												</div>
												<div class="col-md-6 user-info">
													<img alt="" src="assets/img/avatar.png" class="img-responsive"/>
													<div class="details">
														<div>
															<a href="#">
																 Lisa Miller
															</a>
															<span class="label label-sm label-danger">
																 In progress
															</span>
														</div>
														<div>
															 19 Jan 2013 11:55PM
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--END TABS-->
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet box blue calendar">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-calendar"></i>Calendar
							</div>
						</div>
						<div class="portlet-body light-grey">
							<div id="calendar">
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet">
						<div class="portlet-title line">
							<div class="caption">
								<i class="fa fa-comments"></i>Chats
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
								<a href="" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body" id="chats">
							<div class="scroller" style="height: 435px;" data-always-visible="1" data-rail-visible1="1">
								<ul class="chats">
									<li class="in">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar1.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Bob Nilson
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="out">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar2.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Lisa Wong
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="in">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar1.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Bob Nilson
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="out">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Richard Doe
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="in">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Richard Doe
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="out">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar1.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Bob Nilson
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="in">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar3.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Richard Doe
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
											</span>
										</div>
									</li>
									<li class="out">
										<img class="avatar img-responsive" alt="" src="assets/img/avatar1.jpg"/>
										<div class="message">
											<span class="arrow">
											</span>
											<a href="#" class="name">
												 Bob Nilson
											</a>
											<span class="datetime">
												 at Jul 25, 2012 11:09
											</span>
											<span class="body">
												 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet.
											</span>
										</div>
									</li>
								</ul>
							</div>
							<div class="chat-form">
								<div class="input-cont">
									<input class="form-control" type="text" placeholder="Type a message here..."/>
								</div>
								<div class="btn-cont">
									<span class="arrow">
									</span>
									<a href="" class="btn blue icn-only">
										<i class="fa fa-check icon-white"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
	

	
	<script src=<?php echo base_url().'assets/plugins/jquery-1.10.2.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery-migrate-1.2.1.min.js';?> type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src=<?php echo base_url().'assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery.blockui.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery.cokie.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/uniform/jquery.uniform.min.js';?> type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/jquery.vmap.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/flot/jquery.flot.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/flot/jquery.flot.resize.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/flot/jquery.flot.categories.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery.pulsate.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/moment.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/daterangepicker.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/gritter/js/jquery.gritter.js';?> type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src=<?php echo base_url().'assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/plugins/jquery.sparkline.min.js';?> type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src=<?php echo base_url().'assets/scripts/core/app.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/scripts/custom/index.js';?> type="text/javascript"></script>
<script src=<?php echo base_url().'assets/scripts/custom/tasks.js';?> type="text/javascript"></script>    
	
     
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   Index.initJQVMAP(); // init index page's custom scripts
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts		   
		   Index.initMiniCharts();
		   Index.initDashboardDaterange();
		   Index.initIntro();
		   Tasks.initDashboardWidget();
		});
	</script>
	<script language="javascript">

 /* --------------------------------------------------------

	Calendar

    -----------------------------------------------------------*/

$(document).ready(function(){

        //Sidebar

        if ($('#sidebar-calendar')[0]) {

            var date = new Date();

            var d = date.getDate();

            var m = date.getMonth();

            var y = date.getFullYear();

            $('#sidebar-calendar').fullCalendar({

                editable: false,							

				events: [
							<?php echo $strapprove;?>		

						],
				
                header: {
                    	left: 'title'
                		},
			});
        }
	});
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
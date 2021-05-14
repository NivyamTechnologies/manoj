<style>
.mySlides {display:none;text-align: center;}
.w3-display-left {
    position: absolute; 
    top: 50%;
    left: 23%;
    transform: translate(0%,-50%);
    -ms-transform: translate(-0%,-50%);
}
.wrap-table100 {
    display: inline-block;
}
.w3-black, .w3-hover-black:hover, .w3-black, .w3-hover-black:hover {
    color: #FFF!important;
    background-color: #000!important;
}
.w3-display-right {
    position: absolute;
    top: 50%;
    right: 5%;
    transform: translate(0%,-50%);
    -ms-transform: translate(0%,-50%);
}
</style>
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
			<!-- <div class="theme-panel hidden-xs hidden-sm">
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
			</div> -->
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
							<a href="<?php echo base_url();?>login/profile">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>login/profile">
								Dashboard
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>login/profile">
								Name <i class="fa fa-angle-right"></i> <?php echo $userview[0]->applicant_name;?>
							</a>
						</li>
						<li class="pull-right">
							
								<!-- <i class="fa fa-calendar"></i>
								<span>
								</span>
								<i class="fa fa-angle-down"></i> -->
								Registration Date: <?php echo $userview[0]->date;?>
							
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<h2>  Welcome to Assuredness Business <?php echo $userview[0]->applicant_name;?></h2>
				
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<!-- <div class="col-md-6 col-sm-6">
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
				</div> -->
				<!-- <div class="col-md-6 col-sm-6">
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
									
									<ul class="task-list">
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
				</div> -->
			</div>
			<div class="clearfix">
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
<!-- END CONTAINER -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">

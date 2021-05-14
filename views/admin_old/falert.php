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

			

			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->

			<div class="row">

				<div class="col-md-12">

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<h3 class="page-title">

					Alert 

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="<?php echo base_url()?>admin/falert">

								Alert

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

											<i class="fa fa-reorder"></i>Alert

										</div>										

									</div>

							<?php

				foreach($userinfo as $uservalue)

				{

					$orgrole = $uservalue->org_role;

					$org_role_add = $uservalue->org_role_rights_add;

					$org_role_edit = $uservalue->org_role_rights_edit;

					$org_role_delete = $uservalue->org_role_rights_delete;

					$org_role_active = $uservalue->org_role_rights_active;

				}

				?>

				<?php

				if(($orgrole==1)||($orgrole==2)||($orgrole==3))

				{

				?>		

									<div class="portlet-body form">

										<!-- BEGIN FORM-->

					<?php echo form_open_multipart('admin/falert'); ?>

										

										<?php if ($this->session->flashdata('success')) { ?>

        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>

        </div>

    <?php } ?>  

				<?php				

				foreach($viewsectioninfo as $userdata)

						{

							

							$class_name = $userdata->class_name;

							$section_name = $userdata->section_name;

							$description_name = $userdata->description;

						}

				?>

				                                                   

											<div class="form-body">

												<h3 class="form-section">Alert Set</h3>

												<div class="row">
												<div class="col-md-6">
												<?php require_once('checksms.php');?>
												<label class="control-label col-md-4">
													SMS Balance : &nbsp;&nbsp;<?php  echo $response;?> </label>
													</div></div><br/>
												

												<div class="row">
													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-4">Class Name</label>

															<div class="col-md-8">

																	<?php

		  echo form_dropdown('class',$class,$class_name,'class="form-control" id="class"'); ?>

			

																</div>

														</div>

													</div>
                                                    <div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-4">Section </label>

															<div class="col-md-4">

																	<?php 

		  

		  echo form_dropdown('section',$section,$section_name,'class="form-control" id="section"'); ?>

			

																</div>

														</div>

													</div>
                                               </div><br/>

													


												<div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-4">Description </label>

															

										<div class="col-md-8">
											<?php
					echo form_dropdown('description',$description,$description_name,'class="form-control" id="description"');
											?>
										</div></div></div>
                                        
                                        </div><br/>												

											</div>

											<div class="form-actions fluid">

												<div class="row">

													<div class="col-md-6">

														<div class="col-md-offset-3 col-md-9">

														<?php

													if($this->uri->segment(3)!='')
													{

														?>
															<button type="submit" name="send"  class="btn green">Update</button>
															<?php

													}else{?>

														<button type="submit" name="send_alert" class="btn green">Send</button>

														<?php

													}?>

							<a class="btn btn default" href="<?php echo base_url()?>admin/dashboard">Cancel</a>

														</div>

													</div>

													<div class="col-md-6">
													
													</div>

												</div>

											</div>

										<?php echo form_close(); ?>

										<!-- END FORM-->

									</div>

								
				<?php } ?>
					

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



<?php require_once('adminfooter.php');?>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<!--[if lt IE 9]>

<script src="assets/plugins/respond.min.js"></script>

<script src="assets/plugins/excanvas.min.js"></script> 

<![endif]-->

<script src="<?php echo base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap2-typeahead.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/clockface/js/clockface.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo base_url()?>assets/scripts/core/app.js"></script>

<script src="<?php echo base_url()?>assets/scripts/custom/components-pickers.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

        jQuery(document).ready(function() {       

           // initiate layout and plugins

           App.init();

           ComponentsPickers.init();

        });   

	</script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"/>

<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>

<script>

   $(function() {

	   $( "#start_year" ).datepicker({

  // defaultDate: "+1w",

   changeYear: true,

   numberOfMonths: 1,

   dateFormat: "yy",

  // onClose: function( selectedDate ) {

  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );

  // }

   });

	   $( "#end_year" ).datepicker({

  // defaultDate: "+1w",

   changeYear: true,

   numberOfMonths: 1,

   dateFormat: "yy",

  // onClose: function( selectedDate ) {

  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );

  // }

   });

   $( "#start_date" ).datepicker({

  // defaultDate: "+1w",

   changeMonth: true,

   numberOfMonths: 1,

   dateFormat: "dd",

  // onClose: function( selectedDate ) {

  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );

  // }

   });

   $( "#end_date" ).datepicker({

  // defaultDate: "+1w",

   changeMonth: true,

   numberOfMonths: 1,

   dateFormat: "dd",

  // onClose: function( selectedDate ) {

  // $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );

  // }

   });

   });

</script>

    

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>
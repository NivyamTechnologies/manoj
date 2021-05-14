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
				var techId = fname.charAt(0)+ lname.charAt(0)+ date.join('');
				$("#teacher_id").val(techId);
			});
		});	
		</script>
		
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<?php include_once('adminheader.php'); ?>
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
					<?php
						if($this->uri->segment(3)!='')
						{
					?>
					Update Teacher <small>Details</small>
					<?php }else{?>
					Add Teacher <small>Details</small>
					<?php }?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/addteacher">
							<?php
						if($this->uri->segment(3)!='')
						{
					?>Update Teacher
						<?php }else{?>
						Add Teacher
						<?php }?>
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
				if(($orgrole==1)||($orgrole==2)||($orgrole==3)||($orgrole==4))
				{
				?>									
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<?php echo form_open_multipart('admin/addteacher/'.$this->uri->segment(3)); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>
										
				<?php				
				foreach($viewteacherinfo as $userdata)
						{
							$Stdid = $userdata->Tecid;
							$coaching_name = $userdata->coaching_name;
							$FName = $userdata->FirstName;
							$LName = $userdata->LastName;
							$gender = $userdata->gender;
							$dob = $userdata->dob;							
							$anniversary_dob = $userdata->anniversary_dob;
							$emailid = $userdata->emailid;							
							
							$country = $userdata->country;
							$state = $userdata->state;
							$city = $userdata->city;						
							$pincode = $userdata->pincode;
							
							$teacher_mobile = $userdata->teacher_mobile;
							$communication_address = $userdata->communication_address;
							$permanent_address = $userdata->permanent_address;
							
							$father_name = $userdata->father_name;
							$father_mobile = $userdata->father_mobile;
							$father_emailid = $userdata->father_emailid;
							
							
							
						}
				?>										    
											<div class="form-body">
												<h3 class="form-section">Teacher Detail</h3>
												<div class="row">
												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Registration Id as Login Id</label>
															
										<div class="col-md-6">
											<input type="text"  name="teacher_id" id="teacher_id" class="form-control" value="<?php echo $Stdid;?>" readonly>											
										</div>
									</div>
														</div>
														
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Coaching</label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('coaching',$coaching,$coaching_name,'class="form-control" id="coaching"'); ?>
			
																</div>
														</div>
													</div>
														
														<input type="hidden" id="date" name="date" class="form-control"autocomplete="off" value="<?php echo date("d-m-ms"); ?>"/>
												
												</div><br/>
												    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Teacher first name</label>
															
										<div class="col-md-6">
											<input type="text" name="FirstName" id="FirstName" class="form-control" value="<?php echo $FName;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Teacher last name</label>
															
										<div class="col-md-6">
											<input type="text" name="LastName" id="LastName" class="form-control" value="<?php echo $LName;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                
                                                	<div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">Gendar
									 <?php 
                           $male = array(
                                        'name'          => 'Gender',
                                        'id'            => 1,
                                    'value'             => 'Male',                                                                      
                                        'checked'       =>(set_value('Gender',$userdata->gender) === 'Male' ? TRUE : FALSE)
                                        
                                    );

							   echo form_radio($male); ?>Male</label>
                          
                            <label class="control-label col-md-6">
                       <?php
                                $female = array(
                                        'name'          => 'Gender',
                                        'id'            => 2,
                                        'value'         => 'Female', 
                                        'checked'       =>(set_value('Gender',$userdata->gender) === 'Female' ? TRUE : FALSE)
                                        
                                    );
                                echo form_radio($female); ?>Female</label>  
								  </div>
													</div>
                                                    
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Date of birth</label>
															
										<div class="col-md-6">
											<input class="form-control" name="dob" id="teacher_dob" type="text" value="<?php echo $dob;?>"/>
											<span class="help-block">
												 Select date
											</span>
										</div>
									</div>
														</div>
                                                    
												</div>
                                               
                                                <div class="row">
                                                    
                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Email-id</label>
															
										<div class="col-md-6">
											<input type="email" name="Emailid" class="form-control" id="exampleInputEmail1" value="<?php echo $emailid;?>" placeholder="Enter text">
											<?php echo form_error('Emailid','<p style="color:#F83A18">','</p>'); ?>
										</div>
									</div>
														</div>
                                                        
                                                      <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Teacher Image</label>
															<div class="col-md-6">
																<input type="file" name="teacher_image" id="exampleInputFile1">
												
															</div>
														</div>
													</div>
													<!--/span-->
													
													<!--/span-->
												</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                
                                                  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mobile No</label>
															
										<div class="col-md-6">
											<input type="number" name="teacher_mobile" class="form-control" id="exampleInputEmail1" value="<?php echo $teacher_mobile;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
													<!--/span-->
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Teacher anniversary</label>
															
										<div class="col-md-6">
											<input class="form-control" name="anniversary_dob" id="anniversary_dob" type="text" value="<?php echo $anniversary_dob;?>"/>
											<span class="help-block">
												 Select date
											</span>
										</div>
									</div>
														</div>
													
													<!--/span-->
												</div>
                                                
                                                <h3 class="form-section">Address Information</h3>
												    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Communication address </label>
															
										<div class="col-md-6">
											<input type="text" name="communication_address" class="form-control" value="<?php echo $communication_address;?>" id="exampleInputEmail1" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Permanent address</label>
															
										<div class="col-md-6">
											<input type="text" name="permanent_address" class="form-control" value="<?php echo $permanent_address;?>" id="exampleInputEmail1" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                
                                                <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Country</label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('countriesDrp',$countryDrop,$country,'class="form-control" id="countriesDrp"'); ?>
			
																</div>
														</div>
													</div>
                                                    
                                                 	
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">State</label>
															<div class="col-md-6">
															<?php 
	 
	  echo form_dropdown('StateDrp',$stateDrop,$state,'class="form-control" id="StateDrp"'); ?> 
			
																</div>
                                                                
														</div>
													</div>
													
                                                        
                                                        
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                	
                                                <div class="row">
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">City</label>
															<div class="col-md-6">
																	 <?php
	  echo form_dropdown('cityDrp',$cityDrop,$city,'class="form-control" id="cityDrp"'); ?> 
			
																</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Pin code</label>
															
										<div class="col-md-6">
											<input type="text" name="pincode" class="form-control" id="exampleInputEmail1" value="<?php echo $pincode;?>" placeholder="Enter Pincode">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                
                                             
                                                 <h3 class="form-section">Parents  Information</h3>
												    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's name *</label>
															
										<div class="col-md-6">
											<input type="text" name="father_name" class="form-control" id="exampleInputEmail1" value="<?php echo $father_name;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's mobile number</label>
															
										<div class="col-md-6">
											<input type="number" class="form-control" id="exampleInputEmail1" name="father_mobile" value="<?php echo $father_mobile;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's Email ID</label>
															
										<div class="col-md-6">
											<input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $father_emailid;?>" name="father_emailid" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
												</div><br/>
                                                
                                                
                                                <h3 class="form-section">Enclosed Document</h3>
												  <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Attach Doc Proof</label>
															<div class="col-md-6">
																<input type="file" name="attach_doc1" id="exampleInputFile1">
												
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Attach Doc Proof</label>
															<div class="col-md-6">
																<input type="file" name="attach_doc2" id="exampleInputFile1">
												
															</div>
														</div>
													</div>
													<!--/span-->
													
													<!--/span-->
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
															<button type="submit" name="teacher_update" class="btn green">Update</button>
															<?php
													}else{?>
														<button type="submit" class="btn green">Submit</button>
														<?php
													}?>
															<button type="button" class="btn default">Cancel</button>
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
   $( "#teacher_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
   $( "#anniversary_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });   
   });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
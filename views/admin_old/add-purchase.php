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
<title>BVM Business</title>
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
			
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Branch 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url('admin/addbranch');?>">
								Branch
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
											<i class="fa fa-reorder"></i>Purchager Details
										</div>
										
									</div>
												             
               			<?php
				foreach($userinfo as $uservalue)
				{
					$orgrole = $uservalue->org_role;
				}
				?>
									
									
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
					<?php echo form_open_multipart('admin/add/'.$this->uri->segment(3)); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>  
				<?php				
				foreach($vieworginfo as $userdata)
						{
												
						}
				?>
				
									                                                     
										                                                     
											<div class="form-body">
												<h3 class="form-section">Personal Information Of The Rent Holder</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">1. Party Name</label>
															<div class="col-md-8">
																<input type="text" id="PName" name="PName" class="form-control" placeholder="Enter Party Name" required autocomplete="off" value=""/>
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. Address</label>
															<div class="col-md-8">
																<input type="text" id="Address" name="Address" class="form-control" placeholder="Enter Address" required autocomplete="off" value=""/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>

                                                    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. City</label>
															<div class="col-md-8">
																<input type="text" id="city" name="city" class="form-control" placeholder="Enter City" required autocomplete="off" value=""/>
																
															</div>
														</div>		
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. Distt</label>
															<div class="col-md-8">
														
													<?php 
	 
	  echo form_dropdown('Distt',$DisttDrop,$Distt,'class="form-control" id="Distt"'); ?> 
																
															</div>
													
														</div>
													</div>
													</div><br/>

												<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5. State</label>
															<div class="col-md-8">
							
															<?php 
	 
	  echo form_dropdown('StateDrp',$stateDrop,$state,'class="form-control" id="StateDrp"'); ?> 
			
																
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">6. Pincode</label>
															<div class="col-md-8">
																<input type="text" id="pincode3" name="pincode3" class="form-control" placeholder="Enter Pincode" required autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">7. GST No.</label>
															<div class="col-md-8">
																<input type="text" id="gst" name="gst" class="form-control" placeholder="Enter GST No." required autocomplete="off" value=""/>
																
															</div>
														</div>	
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">8. Tin No.</label>
															<div class="col-md-8">
																<input type="text" id="TinNo" name="TinNo" class="form-control" placeholder="Enter Tin No." required autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>
													
													<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">9. Mobile No.</label>
															<div class="col-md-8">
																<input type="text" id="Mobile" name="Mobile" class="form-control" placeholder="Enter Mobile" required autocomplete="off" value="<?php echo $Mobile;?>"/>
																
															</div>
														</div>

														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">10.Bank A/c Number</label>
															<div class="col-md-8">
																<input type="text" id="BankAcc2" name="BankAcc2" class="form-control" placeholder="Enter Bank Account Number" required autocomplete="off" value=""/>
																
															</div>
														</div>
													</div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">11. IFS Code</label>
															<div class="col-md-8">
																<input type="text" id="ifs2" name="ifs2" class="form-control" placeholder="Enter IFS Code"" required autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">12. Name And Address of the Bank</label>
															<div class="col-md-8">
																<input type="text" id="BankName2" name="BankName2" class="form-control" placeholder="Enter Name and Address of Bank" required autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Opening Balance</label>
															<div class="col-md-8">
																<input type="text" id="OpenBal" name="OpenBal" class="form-control" placeholder="Enter Balance" required autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    </div><br/>

													<!--/span-->
												<!--/row-->
												<div class="row">
													
													<!--/span-->
													
													<!--/span-->
												</div>


											<!--	<h3 class="form-section">Address</h3>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Address </label>
															<div class="col-md-8">
																<input type="text" name="address" class="form-control" autocomplete="off" value="<?php echo $address;?>"/>
																<span class="help-block">
																<?php echo form_error('address','<p style="color:#F83A18">','</p>'); ?></span>
															</div>
														</div>
													</div>
                                                    
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Country</label>
															<div class="col-md-8">
																	<?php 
		  
		  echo form_dropdown('countriesDrp',$countryDrop,$country,'class="form-control" id="countriesDrp"'); ?>
			
																</div>
														</div>
													</div>
                                                    </div><br/>
													
													
													<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">State</label>
															<div class="col-md-8">
															<?php 
	 
	  echo form_dropdown('StateDrp',$stateDrop,$state,'class="form-control" id="StateDrp"'); ?> 
			
																</div>
                                                                
														</div>
													</div>
													
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">City</label>
															<div class="col-md-8">
																	 <?php
	  echo form_dropdown('cityDrp',$cityDrop,$city,'class="form-control" id="cityDrp"'); ?> 
			
																</div>
														</div>
													</div>
												</div><br/>
												
											</div> -->
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
														<?php
													if($this->uri->segment(3)!='')
													{
														?>
															<button type="submit" name="org_update" class="btn green">Update</button>
															<?php
													}else{?>
														<button type="submit" class="btn green">Submit</button>
														<?php
													}?>
															<a class="btn btn default" href="<?php echo base_url()?>admin/allorganization">Cancel</a>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
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
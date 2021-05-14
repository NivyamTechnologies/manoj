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
				<?php if($update=='true'){ echo 'Edit';}?>	Depo 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url('admin/generatedepo');?>">
							<?php if($update=='true'){ echo 'Edit';}?>	Depo
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
											<i class="fa fa-reorder"></i><?php if($update=='true'){ echo 'Edit';}?> Details
										</div>
										
									</div>
												             
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
				
					<form name="registration" id="registration" action="" method="POST" enctype="multipart/form-data">
										
	    <?php 
		if ($this->session->flashdata('success')) 
		{
			$msg=$this->session->flashdata('success');
			echo '<script type="text/javascript">alert("'.$msg.'");</script>';
         } 
		 ?>  
		
				
									                                                     
										                                                     
											<div class="form-body">
												<h3 class="form-section">Personal Information Of The Applicant</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">

								<label class="control-label col-md-4">1. Distributor ID</label>

														<div class="col-md-8">
																<input type="text" id="distributor_id" name="distributor_id" class="form-control" value="<?php echo $branchdata[0]->distributor_id; ?>"  onchange="getsn(this.value)"/>

								<input type="hidden" name="applicant_no" id="applicant_no"  class="form-control" placeholder="Enter Name" value="<?php echo $branchdata[0]->applicant_no; ?>" autocomplete="off" />
																
															</div>

														</div>
													</div>
                                                   
                                                    
                                                    </div><br/>
													<!--/span-->
													
													<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. Name of the Applicant:</label>
															<div class="col-md-8">
																<input type="text" name="applicant_name" id="applicant_name" class="form-control" placeholder="Enter Name"  disabled autocomplete="off" />
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. Father's/ Husband's Name</label>
															<div class="col-md-8">
																<input type="text" name="father_name" id="father_name" class="form-control" placeholder="Enter FirstName" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>

                                                    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. Date Of Birth</label>
															<div class="col-md-8">
																<input type="text" id="applicant_dob" name="applicant_dob" class="form-control" placeholder="Enter Date of Birth" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5. E-mail ID</label>
															<div class="col-md-8">
																<input type="text" id="email" name="email" class="form-control" placeholder="Enter Email Id" disabled autocomplete="off" value="<?php echo $Emailid;?>"/>				
																<?php echo form_error('Emailid','<p style="color:#F83A18">','</p>'); ?>
															</div>
														</div>
													</div>
													</div><br/>

												<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">6. State</label>
															<div class="col-md-8">
							
																<input type="text" id="state_name" name="state_name" class="form-control" placeholder="Select City" disabled autocomplete="off" value=""/>
															
			
																
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">7. City</label>
															<div class="col-md-8">
																<input type="text" id="city" name="city" class="form-control" placeholder="Select City" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">8. Distt</label>
															<div class="col-md-8">
													<input type="text" id="district_name" name="district_name" class="form-control" placeholder="Select City" disabled autocomplete="off" value=""/>
																
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">9. Tehsil</label>
															<div class="col-md-8">
																<input type="text" id="tehsil" name="tehsil" class="form-control" placeholder="Enter Tehsil" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>
													
													<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">10.Pincode</label>
															<div class="col-md-8">
																<input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">11. Mobile No.</label>
															<div class="col-md-8">
																<input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter Mobile" disabled autocomplete="off"/>
																
															</div>
														</div>
													</div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">12. Bank A/c No.</label>
															<div class="col-md-8">
																<input type="text" id="bank_accno" name="bank_accno" class="form-control" placeholder="Enter Bank Account Number" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">13. IFS Code</label>
															<div class="col-md-8">
																<input type="text" id="bank_ifsc_code" name="bank_ifsc_code" class="form-control" placeholder="Enter IFS code" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">14. Name and Address of the Bank</label>
															<div class="col-md-8">
																<input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Enter Bank Name and Address" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">15. PAN No.</label>
															<div class="col-md-8">
																<input type="text" id="panno" name="panno" class="form-control" placeholder="Enter your PAN Number" disabled autocomplete="off" value=""/>
																
															</div>
														</div>
                                                    </div>
                                                    </div><br/>
													

										<div class="form-body">
												<h3 class="form-section">Information Related to BVM Branch & Security</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">1. Name of BVM Branch:</label>
															<div class="col-md-8">
																<input type="text" id="bvmbranchname" name="bvmbranchname" class="form-control" placeholder="Enter Branch Name"   autocomplete="off" value="<?php echo $branchdata[0]->bvmbranchname; ?>"/>
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. Complete Postal Address</label>
															<div class="col-md-8">
																<input type="text" id="address" name="address" class="form-control" placeholder="Enter your Postal Address"   autocomplete="off" value="<?php echo $branchdata[0]->address; ?>"/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>

                                                    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. Near Land Mark</label>
															<div class="col-md-8">
																<input type="text" id="landmark" name="landmark" class="form-control" placeholder="Enter Near Landmark"   autocomplete="off" value="<?php echo $branchdata[0]->landmark; ?>"/>
																
															</div>
														</div>		
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. Select State</label>
															<div class="col-md-8">
															<select class="form-control" id="state" name="state" onchange="getdistrict(this.value)">
						                                    <option value="">Select State</option>
						                                    <?php foreach($state as $st){ ?>
						                                    <option value="<?php echo $st['state_id'];  ?>" <?php if($branchdata[0]->state==$st['state_id']){ ?>selected<?php } ?>><?php echo $st['state_name'];  ?></option>
						                                    <?php } ?>
						                                    </select>	
															</div>
														</div>
													</div>
													</div><br/>

												<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5.Select District</label>
															<div class="col-md-8">
															<select class="form-control" id="district" name="district">
						                                    <option value=''>select District</option>
															<option value="<?php echo $branchdata[0]->district;  ?>" selected><?php echo $branchdata[0]->districtname;  ?></option>
						                                    </select>
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">6. City</label>
															<div class="col-md-8">
																<input type="text" id="city" name="city" class="form-control" placeholder="Select city"   autocomplete="off" value="<?php echo $branchdata[0]->city;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">7. Pincode</label>
															<div class="col-md-8">
																<input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode"   autocomplete="off" value="<?php echo $branchdata[0]->pincode;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">8. Mobile No.</label>
															<div class="col-md-8">
																<input type="text" id="mobno" name="mobno" class="form-control" placeholder="Enter Mobile"   autocomplete="off" value="<?php echo $branchdata[0]->mobno;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>
													
													<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">9. Rent Fixed</label>
															<div class="col-md-8">
																<input type="text" id="rentfixed" name="rentfixed" class="form-control" placeholder="Enter Rent"   autocomplete="off" value="<?php echo $branchdata[0]->rentfixed;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">10. Security Deposit</label>
															<div class="col-md-8">
																<input type="text" id="securitydeposit" name="securitydeposit" class="form-control" placeholder="Enter Security Deposit"   autocomplete="off" value="<?php echo $branchdata[0]->securitydeposit;  ?>"/>
																
															</div>
														</div>
													</div>
                                                    </div><br/>


                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">11. Credit Limit</label>
															<div class="col-md-8">
																<input type="text" id="creditlimit" name="creditlimit" class="form-control" placeholder="Enter Credit"   autocomplete="off" value="<?php echo $branchdata[0]->creditlimit;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">12. Commision on Puc</label>
															<div class="col-md-8">
																<input type="text" id="commisiononpuc" name="commisiononpuc" class="form-control" placeholder="Enter Commission"   autocomplete="off" value="<?php echo $branchdata[0]->commisiononpuc;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">13. Commision on Distributer</label>
															<div class="col-md-8">
																<input type="text" id="commisionondistributor" name="commisionondistributor" class="form-control" placeholder="Enter Commission"   autocomplete="off" value="<?php echo $branchdata[0]->commisionondistributor;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">14. Nearest Depo</label>
															<div class="col-md-8">
																<input type="text" id="nearesrdepo" name="nearesrdepo" class="form-control" placeholder="Enter Nearest Depo"   autocomplete="off" value="<?php echo $branchdata[0]->nearesrdepo;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>
													
													<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">15. Nearest Branch</label>
															<div class="col-md-8">
																<input type="text" id="nearestbranch" name="nearestbranch" class="form-control" placeholder="Enter Nearest Branch"   autocomplete="off" value="<?php echo $branchdata[0]->nearestbranch;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div> 

                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">16. GST No.</label>
															<div class="col-md-8">
																<input type="text" id="gstno" name="gstno" class="form-control" placeholder="Enter GST"   autocomplete="off" value="<?php echo $branchdata[0]->gstno;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>
													</div><br/>

													<div class="row">
                                                     <div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">ID Proof</label>
															<div class="col-md-8">
																<input type="file" id="idproofdoc" name="idproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Address Proof</label>
															<div class="col-md-8">
																<input type="file" id="addressproofdoc" name="addressproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                    </div> <br/>
                                                    
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Income Proof</label>
															<div class="col-md-8">
																<input type="file" id="incomeproofdoc" name="incomeproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                    </div> <br/>

                                                    <div class="row">

                                                     <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Bank Details</label>
															<div class="col-md-8">
																<input type="file" id="bankdetailproofdoc" name="bankdetailproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                    </div> <br/>


											<div class="form-body">
												<h3 class="form-section">Rent Details</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">1. Name of the Land Lord</label>
															<div class="col-md-8">
																<input type="text" id="rentlandloard" name="rentlandloard" class="form-control" placeholder="Enter Landlord Name"   autocomplete="off" value="<?php echo $branchdata[0]->rentlandloard;  ?>"/>
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. Father's/Husband's Name</label>
															<div class="col-md-8">
																<input type="text" id="rentfathername" name="rentfathername" class="form-control" placeholder="Enter FirstName"   autocomplete="off" value="<?php echo $branchdata[0]->rentfathername;  ?>"/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>

                                                    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. Name of the Bank</label>
															<div class="col-md-8">
															<select class="form-control" id="rentbankname" name="rentbankname">
						                                    <option value="">Select bank</option>
						                                    <?php foreach($bank as $st){ ?>
						                                    <option value="<?php echo $st['id'];  ?>" <?php if($st['id']==$branchdata[0]->rentbankname){ ?>selected<?php } ?>><?php echo $st['bank_name'];  ?></option>
						                                    <?php } ?>
						                                    </select>
															</div>
														</div>		
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. Account No.</label>
															<div class="col-md-8">
																<input type="text" id="rentaccno" name="rentaccno" class="form-control" placeholder="Enter Account Number"   autocomplete="off" value="<?php echo $branchdata[0]->rentaccno;  ?>"/>
																
															</div>
														</div>
													</div>
													</div><br/>

												<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5. IFS Code</label>
															<div class="col-md-8">
																<input type="text" id="rentifsc" name="rentifsc" class="form-control" placeholder="Enter IFS Code"   autocomplete="off" value="<?php echo $branchdata[0]->rentifsc;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>                
                                                    </div><br/>

                                                    
													</div><br/>

											<div class="form-body">
												<h3 class="form-section">Information of BVM Puc Under the Leader</h3>
																						
													<div class="row">
													<div class="col-md-6">
														<div class="form-group">

			<label class="control-label col-md-4">1. Platinum Achiver Distributer No.</label>

				<div class="col-md-8">

			<input type="text" id="bvmpuc_distributor" name="bvmpuc_distributor" class="form-control" value="<?php echo $branchdata[0]->bvmpuc_distributor; ?>"  onchange="getpsn(this.value)"/>	
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. Name of the Applicant:</label>
															<div class="col-md-8">
																<input type="text" id="bvmpuc_aplicantname" name="bvmpuc_aplicantname" class="form-control" placeholder="Enter Name" disabled  autocomplete="off" value="<?php echo $branchdata[0]->bvmpuc_aplicantname;  ?>"/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>

                                                    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. Email ID</label>
															<div class="col-md-8">
				<input type="text" id="bvmpuc_email" name="bvmpuc_email" class="form-control" placeholder="Enter E-mail id" disabled  value="<?php echo $branchdata[0]->bvmpuc_email;  ?>"/>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. State</label>
															<div class="col-md-8">

																<input type="text" id="bvmpuc_state" name="bvmpuc_state" class="form-control" placeholder="Select City" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														</div>
													</div><br/>

												<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5. City</label>
															<div class="col-md-8">

												<input type="text" id="bvmpuc_city" name="bvmpuc_city" class="form-control" placeholder="Select City" disabled autocomplete="off" value=""/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">6. Distt</label>
															<div class="col-md-8">
															<input type="text" id="bvmpuc_dist" name="bvmpuc_dist" class="form-control" placeholder="Select Distt" disabled autocomplete="off" value=""/>
															
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                   	<div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">7. Mobile No.</label>
															<div class="col-md-8">
																<input type="text" id="bvmpuc_mobno" name="bvmpuc_mobno" class="form-control" placeholder="Enter Mobile" disabled  autocomplete="off" value="<?php echo $branchdata[0]->bvmpuc_mobno;  ?>"/>
																
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">8. Guarantee Amount</label>
															<div class="col-md-8">
																<input type="text" id="bvmpuc_gurntamount" name="bvmpuc_gurntamount" class="form-control" placeholder="Enter Guarantee Amount"   autocomplete="off" value="<?php echo $branchdata[0]->bvmpuc_gurntamount;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">9. Declare the Leader Commission</label>
															<div class="col-md-8">
																<input type="text" id="bvmpuc_leadercommision" name="bvmpuc_leadercommision" class="form-control" placeholder="Enter Leader Commission"   autocomplete="off" value="<?php echo $branchdata[0]->bvmpuc_leadercommision;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div> 

                                                     <div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">10.Submit ID Proof</label>
															<div class="col-md-8">
																<input type="file" id="bvmpuc_submitid" name="bvmpuc_submitid" class="form-control"/>
															</div>
														</div>
                                                    </div>
                                                   
                                                    </div><br/>

                                                    <div class="row">

                                                     <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Submit Guarantee Agreement</label>
															<div class="col-md-8">
																<input type="file" id="bvmpuc_agreement" name="bvmpuc_agreement" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                   </div><br/>
													
													</div><br/>

													<div class="form-body">
												<h3 class="form-section">Name of the Witness</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
												<label class="control-label col-md-4">1. </label>
															<div class="col-md-8">
						                                    <input type="text" id="witness_name1" name="witness_name1" class="form-control" placeholder="Enter Name"   autocomplete="off" value="<?php echo $branchdata[0]->witness_name1;  ?>"/>	
															</div>
														</div>
													</div>

                                                    <div class="col-md-6">
														<div class="form-group">
											<label class="control-label col-md-4">2. </label>
															<div class="col-md-8">
								<input type="text" id="witness_name2" name="witness_name2" class="form-control" placeholder="Enter Witness Name"   value="<?php echo $branchdata[0]->witness_name2;  ?>"/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>
                                                    </div><br/>

                                                <div class="form-body">
												<h3 class="form-section"></h3>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Password</label>
															<div class="col-md-8">
																<input type="password" id="password" name="password" class="form-control" placeholder="Enter password"   autocomplete="off" value="<?php echo $branchdata[0]->password;  ?>"/>
																
															</div>
														</div>		
													</div>
													
													<!--/span-->
												</div><br/>
										<div class="form-body">
												<h3 class="form-section"></h3>
												<div class="row">
													<div class="col-md-6">
													<div class="form-group">
															<label class="control-label col-md-4">Submited By:  	1. </label>
															<div class="col-md-8">
																<input type="text" id="witness_submitby1" name="witness_submitby1" class="form-control" placeholder="Enter Name"   autocomplete="off" value="<?php echo $branchdata[0]->witness_submitby1;  ?>"/>
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. </label>
															<div class="col-md-8">
																<input type="text" id="witness_submitby2" name="witness_submitby2" class="form-control" placeholder="Enter Name"   autocomplete="off" value="<?php echo $branchdata[0]->witness_submitby2;  ?>"/>
																
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


											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
														<?php if($update=='true'){  ?>
														<input type="submit" class="btn green" value="UPDATE" name="update"/>
														<?php } else{ ?>
									                    <input type="submit" class="btn green" value="SAVE" name="save"/>
														<?php } ?>
													
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										</form>
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
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/scripts/core/app.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/table-editable.js"></script>

<script>

function getdistrict(str)
{
jQuery.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
	    res = result.split('--#--');
        jQuery("#district").html(res[1]);
		//jQuery("#city").html(res[1]);
    });	
}

function getdistrictnew(str)
{
jQuery.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
	    res = result.split('--#--');
        jQuery("#bvmpuc_dist").html(res[1]);
		//jQuery("#city").html(res[1]);
    });	getspnoalldata
}



jQuery(document).ready(function(){
getpsn(<?php echo $branchdata[0]->bvmpuc_distributor; ?>);	
});

function getpsn(str)
{
jQuery.post("<?php echo base_url();  ?>admin/getspnoalldata", {no: str}, function(result){
	dataArray = jQuery.parseJSON(result);
       if(result=='1')
	   {
	   jQuery("#bvmpuc_aplicantname").val('');
	   jQuery("#bvmpuc_email").val('');
	   jQuery("#bvmpuc_state").val('');
	   jQuery("#bvmpuc_city").val('');
	   jQuery("#bvmpuc_dist").val('');
	   jQuery("#bvmpuc_mobno").val('');	  
	   //alert("Distributor Id. not exist");	   
	   }
	   else
	   {
	   
	   jQuery("#bvmpuc_aplicantname").val(dataArray[0].applicant_name);
	   jQuery("#bvmpuc_email").val(dataArray[0].email);
	   jQuery("#bvmpuc_state").val(dataArray[0].state_name);
	   jQuery("#bvmpuc_city").val(dataArray[0].city);	  
	   jQuery("#bvmpuc_dist").val(dataArray[0].district_name);
	   jQuery("#bvmpuc_mobno").val(dataArray[0].mobile_no);	  
	  
	   }
    });		
}

jQuery(document).ready(function(){
getsn(<?php echo $branchdata[0]->distributor_id; ?>);	
});

function getsn(str)
{
jQuery.post("<?php echo base_url();  ?>admin/getspnoalldata", {no: str}, function(result){
	dataArray = jQuery.parseJSON(result);
       if(result=='1')
	   {
	   jQuery("#applicant_name").val('');
	   jQuery("#father_name").val('');
	   jQuery("#applicant_dob").val('');
	   jQuery("#email").val('');
	   jQuery("#state_name").val('');
	   jQuery("#district_name").val('');
	   jQuery("#tehsil").val('');
	   jQuery("#city").val('');
	   jQuery("#pincode").val('');
	   jQuery("#mobile_no").val('');
	   jQuery("#bank_accno").val('');
	   jQuery("#bank_ifsc_code").val('');
	   jQuery("#bank_name").val('');
	   jQuery("#panno").val('');
	   //alert("Distributor Id. not exist");	   
	   }
	   else
	   {
	   
	   jQuery("#applicant_name").val(dataArray[0].applicant_name);
	   jQuery("#father_name").val(dataArray[0].father_name);
	   jQuery("#applicant_dob").val(dataArray[0].applicant_dob);
	   jQuery("#email").val(dataArray[0].email);
	   jQuery("#state_name").val(dataArray[0].state_name);
	   jQuery("#district_name").val(dataArray[0].district_name);
	   jQuery("#tehsil").val(dataArray[0].tehsil);
	   jQuery("#city").val(dataArray[0].city);
	   jQuery("#pincode").val(dataArray[0].pincode);
	   jQuery("#mobile_no").val(dataArray[0].mobile_no);
	   jQuery("#bank_accno").val(dataArray[0].bank_accno);
	   jQuery("#bank_ifsc_code").val(dataArray[0].bank_ifsc_code);
	   jQuery("#bank_name").val(dataArray[0].bank_name);
	   jQuery("#panno").val(dataArray[0].panno);
	   }
    });		
}





</script>
<script src="<?php echo base_url();?>assets/plugins/jquery.validate.min.js" type="text/javascript"></script>
<script>
$.noConflict();
jQuery(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side 
      distributor_id: "required",
	  bvmbranchname: "required",
	 // idproofdoc: "required",
	 // addressproofdoc: "required",
	 // incomeproofdoc: "required",
	//  bankdetailproofdoc: "required",
      address: "required",
	  landmark: "required",
	  state: "required",
	  district: "required",
	  city: "required",
	  pincode: "required",
	  rentfixed: "required",
	  securitydeposit: "required",
	  creditlimit: "required",
	  commisiononpuc: "required",
	  commisionondistributor: "required",
	  nearesrdepo: "required",
	  nearestbranch: "required",
	  gstno: "required",
	  rentlandloard: "required",
	  rentfathername:"required",
	  rentbankname: "required",
	  rentaccno: "required",
	  rentifsc: "required",
	  
	  bvmpuc_distributor: "required",
	  bvmpuc_aplicantno: "required",
	  bvmpuc_state: "required",
	  bvmpuc_city: "required",
	  bvmpuc_dist: "required",
	  
	  bvmpuc_gurntamount: "required",
	  bvmpuc_leadercommision:"required",
	  //bvmpuc_submitid: "required",
	 // bvmpuc_agreement: "required",
	  witness_name1: "required",
	  witness_name2: "required",
	  witness_submitby1: "required",
	  witness_submitby2: "required",
	  bvmpuc_mobno:{
	  required: true,
      minlength:9,
      maxlength:10,
      number: true
      },
	  mobno:{
	  required:true,
      minlength:9,
      maxlength:10,
      number: true
      },
	  bvmpuc_email: {
		required:true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      distributor_id: "Please enter your distributor No.",
	 // idproofdoc: "Please select file.",
	 // addressproofdoc: "Please select file.",
	 // incomeproofdoc: "Please select file.",
	 // bankdetailproofdoc: "Please select file.",
	  bvmbranchname: "Please enter Branch Name.",
      address: "Please enter your Address.",
	  landmark: "Please enter Landmark",
	  state: "Select  your state.",
	  
      district: "Select your district Name.",
      city: "Please enter your city Name.",
	  pincode: "Please enter your Nominee Name.",
	  rentfixed: "Please enter your Rent.",
	  securitydeposit: "Please enter security deposit.",
	  
	  creditlimit: "Please enter credit limit.",
	  commisiononpuc: "Please enter commisionon puc.",
	  commisionondistributor: "Please enter commisionon distributor.",
	  nearesrdepo: "Please enter Nearest depo Name.",
	  nearestbranch: "Please enter Nearest branch.",
	  gstno: "Please enter GST No.",
	    
      rentlandloard: "Please enter Landloard Name.",
      rentfathername: "Please enter Name.",
	  rentbankname: "Please enter Bank Name.",
	  rentaccno: "Please enter rent accno.",
	  
	  rentifsc: "Please enter Ifsc code.",
      bvmpuc_distributor: "Please enter distributor Name.",
	  bvmpuc_aplicantno: "Please enter Applicant Name.",
	  bvmpuc_state: "Please enter State.",
	  
	  
	  bvmpuc_city: "Please enter City.",
      bvmpuc_dist: "Please enter district.",
	  bvmpuc_gurntamount: "Please enter Amount.",
	  bvmpuc_leadercommision: "Please enter Leadercommision.",
	  
	  //bvmpuc_submitid: "Please enter Id.",
     // bvmpuc_agreement: "Please enter agreement.",
	  witness_name1: "Please enter witness name.",
	  witness_name2: "Please enter second witness name.",
	  witness_submitby1: "Please enter submit by.",
	  witness_submitby2: "Please enter submit by.",

	  mobno: "Please enter valid Mobile no.",
	  mobileno: "Please enter valid Second Mobile no.",
	  
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
      },

    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) 
	{
	form.submit();
    }
  });
});
</script>
<script>
jQuery(document).ready(function() {       
   App.init();
   TableEditable.init();
});

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
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


			$("#class,#coaching").change(function() {
			
				var string = "PFE";
				var cl = $("#class").val();
				var coaching = $("#coaching").val();
				var year = '<?php echo date('y');?>';
				//var lastid = '<?php //echo $autoid;?>';
				//alert(year);
				//alert(lname.charAt(0));  
				$.post("<?php echo base_url();?>admin/getrollno",{cl:cl,coaching:coaching},function(data)
				{
				//alert(data);
				//return false;
				//$(".auto_load_div").load(location.href + " .auto_load_div");
				//var data = data 
				//alert(data);
				var orgId = string+year+coaching+cl+data;
				$("#registration_id").val(orgId);
				
					})
				$.post("<?php echo base_url();?>admin/getstudentfees",{class:cl,coaching:coaching},function(data)
				{
					//alert(data);
			$("#fee").html(data);

				//return false;
				//$(".auto_load_div").load(location.href + " .auto_load_div");
				//var data = data 
				//alert(data);
				//var orgId = string+year+coaching+cl+data;
				//$("#registration_id").val(orgId);
				
					})
				
			
    
				
				//alert(orgid);
			});

		});	
		</script>
		


		<script type = "text/javascript">
$(document).ready(function(){

    $("#discountcode").change(function(){
    	var code = $("#discountcode").val();
    	var fees = $("#fee").val();
    	$.post("<?php echo base_url();?>admin/getpayablefees",{code:code,fee:fees},function(data)
				{


//$('#payamount').show();
$('#pay').val(data);
$('#netamount').show();
				
					})
				
    			
        
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
					Update Student <small>Details</small>
					<?php }else{?>
					Add Student <small>Details</small>
					<?php }?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/addstudent">
							<?php
						if($this->uri->segment(3)!='')
						{
					?>Update Student
						<?php }else{?>
						Add Student
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
				if(($orgrole==1)||($orgrole==2)||($orgrole==3)||($orgrole==5))
				{
				?>								
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<?php echo form_open_multipart('admin/addstudent/'.$this->uri->segment(3)); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>
										
				<?php				
				foreach($viewstudentinfo as $userdata)
						{
							$Stdid = $userdata->Stdid;
							$admission_date = $userdata->admission_date;
							$acedmic_session = $userdata->admission_session;
							$student_class = $userdata->student_class;
							$first_day_session = $userdata->first_day_session;						
							$student_coaching = $userdata->student_coaching;
							$student_fee = $userdata->student_fee;
							$membarshipcard = $userdata->membarship_cardtype;
							$remaining_fee = $userdata->remaining_fee;
							$remarks = $userdata->remarks;
							$FName = $userdata->FirstName;
							$LName = $userdata->LastName;
							$gender = $userdata->gender;
							$dob = $userdata->dob;
							
							$emailid = $userdata->emailid;
							$student_age = $userdata->student_age;
							$adharcard_no = $userdata->adharcard_no;
							$last_school_name = $userdata->last_school_name;
							
							$last_class_passed = $userdata->last_class_passed;
							$last_school_stard_date = $userdata->last_school_stard_date;
							$last_school_end_date = $userdata->last_school_end_date;
							$last_class_persentage = $userdata->last_class_persentage;
							
							$last_school_board = $userdata->last_school_board;
							$passing_year = $userdata->passing_year;
							$communication_address = $userdata->communication_address;
							$permanent_address = $userdata->permanent_address;
							
							$country = $userdata->country;
							$state = $userdata->state;
							$city = $userdata->city;
							$pincode = $userdata->pincode;
							
							$residence_phone = $userdata->residence_phone;
							$emergency_phone = $userdata->emergency_phone;
							$father_name = $userdata->father_name;
							$father_mobile = $userdata->father_mobile;
							
							$father_emailid = $userdata->father_emailid;
							$mother_name = $userdata->mother_name;
							$mother_mobile = $userdata->mother_mobile;
							
						}
				?>										    
											<div class="form-body">
												<h3 class="form-section">Academic Detail</h3>
												<br/>
												<div class="row">
												<div class="col-md-6">
														<div class="form-group">
						<label class="control-label col-md-6">Registration Number as Login Id</label>
															
										<div class="col-md-6">
											<input type="text"  name="registration_id" class="form-control" value="<?php echo $Stdid;?>" id="registration_id">											
										</div>
									</div>
														</div>
														
														<input type="hidden" id="date" name="date" class="form-control"autocomplete="off" value="<?php echo date("d-m-ms"); ?>"/>
												
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Date of Admission</label>			
										<div class="col-md-6">
											<input class="form-control" value="<?php echo $admission_date;?>" id="admission_date" name="admission_date" type="text"/>
											<span class="help-block">
												 Select date
											</span>
										</div>
									</div>
														</div>
												</div>
													<!--/span-->
												
												<!--/row-->
												<div class="row">
                                                <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Acedmic Session </label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('session',$session,$acedmic_session,'class="form-control" id="session"'); ?>
			
																</div>
														</div>
													</div>
												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Class Name</label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('class',$class,$student_class,'class="form-control" id="class"'); ?>
			
																</div>
														</div>
													</div></div><br/>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">First Day In Session</label>
															
										<div class="col-md-6">
											<input class="form-control" size="16" name="firstday_session" type="text" id="first_day_session" value="<?php echo $first_day_session;?>"/>
											
										</div>
									</div>
									
									
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Coaching</label>
															<div class="col-md-6">
																<?php 
		  
		  echo form_dropdown('coaching',$coaching,$student_coaching,'class="form-control" id="coaching"'); ?>
												<?php echo form_error('coaching','<p style="color:#F83A18">','</p>'); ?>									
															</div>
														</div>
													</div>
													
													<!--/span-->
												</div><br/>
                                                
                                                <div class="row">
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Section</label>
															<div class="col-md-6">
																<?php 
		  
		  echo form_dropdown('section',$section,$section_name,'class="form-control" id="section"'); ?>
															<?php echo form_error('section','<p style="color:#F83A18">','</p>'); ?>	
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student Image</label>
															<div class="col-md-6">
																<input type="file" name="student_image" id="exampleInputFile1">
												
															</div>
														</div>
													</div>
													</div><br/>
                                                
                                                <div class="row">
													<div class="col-md-6" id="fee1">
														<div class="form-group">
															<label class="control-label col-md-6">Student Fee</label>
															<div class="col-md-6">
																<?php 
		 if($fee == '')
		 {
		  echo form_dropdown('fee','',$student_fee,'class="form-control" id="fee" readonly');
		  }
		  else{
		  	 echo form_dropdown('fee',$fee,$student_fee,'class="form-control" id="fee"');
		  	} ?>
												
															</div>
														</div>
													</div>
													
													<?php
													if($this->uri->segment(3)=='')
													{
														?>
													<div class="col-md-6">
												<div class="form-group">
												<label class="control-label col-md-6">Few Pay Amount</label>
													<input type="checkbox" id="fewpay" name="fewpay"/>
												</div></div>
												
											<?php } ?>
													
											<div class="col-md-6" style="display: none" id="payamount">
												<div class="form-group">
												<label class="control-label col-md-6">Pay Amount</label>
										<div class="col-md-6">
											<input type="number" name="fee1" class="form-control" id="exampleInputEmail1" value="<?php echo $student_fee;?>" placeholder="Enter Amount">
											
										</div>
									</div>
									</div>
													
												</div><br>
                                                
                                                <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Remark</label>
															
										<div class="col-md-6">
											<input type="text" name="remarks" class="form-control" id="exampleInputEmail1" value="<?php echo $remarks;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
														
														<?php
												if($remaining_fee>0)
												{
													?>
					
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Remaining Fee</label>
															<div class="col-md-6" style="background-color: darkred">				
															
																<?php echo "<p class='form-control'>$remaining_fee</p>"?>
												
															</div>
														</div>
													</div>
													<?php } ?>
													
													<?php
													if($this->uri->segment(3)=='')
													{
														?>
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Membarship Card</label>
															<div class="col-md-6">
																<?php
					$options = array(
						'' => 'Select',
						'30' => 'Orange',
						'90' => 'Green',
						'180' => 'Blue',
						'365' => 'Yellow'
						);
		  
		  echo form_dropdown('cardtype',$options,$membarshipcard,'class="form-control" id="cardtype"'); ?>
												
															</div>
														</div>
													</div>
													<?php } ?>
													
												</div>
												<br>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Enter Discount Code</label>
															
										<div class="col-md-6">
											<input type="text" name="code" id="discountcode" class="form-control" value="" >
											
										</div>
									</div>
														</div>
													
													<!--/span-->
													
													<!--/span-->
												</div><br/>
												<div class="row">
												<div class="col-md-6" >
												<div class="form-group" id = "netamount" style = "display:none;" >
												<label class="control-label col-md-6"> Pay Amount</label>
<input type = "text" name = "pay" id = "pay" class = "form-control" >
												</div>
												</div>
												</div>

                                                
												<h3 class="form-section">Student Details</h3>
												    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student first name</label>
															
										<div class="col-md-6">
											<input type="text" name="FirstName" id="FirstName" class="form-control" value="<?php echo $FName;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student last name</label>
															
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
                          
                            <label class="control-label col-md-3">
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
											<input class="form-control" name="dob" id="student_dob" type="text" value="<?php echo $dob;?>"/>
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
                                                        
                                                      <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Aadhar Card No</label>
															
										<div class="col-md-6">
											<input type="text" name="aadhar_cardno" class="form-control" id="exampleInputEmail1" value="<?php echo $adharcard_no;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>  
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                
                                                  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student Age</label>
															
										<div class="col-md-6">
											<input type="text" name="student_age" class="form-control" id="exampleInputEmail1" value="<?php echo $student_age;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
													<!--/span-->
													
													<!--/span-->
												</div>
                                                
                                                 
                                                <h3 class="form-section">Last Academic Information</h3>
												    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Name of last school</label>
															
										<div class="col-md-6">
											<input type="text" name="lastschool_name" class="form-control" id="exampleInputEmail1" value="<?php echo $last_school_name;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last class passed</label>
															
										<div class="col-md-6">
											<input type="text" name="lastclass_passed" class="form-control" id="exampleInputEmail1" value="<?php echo $last_class_passed;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br />
                                                
                                                	<div class="row">
													
													 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last school start date</label>
															
										<div class="col-md-6">
											<input class="form-control" id="last_school_startdate" name="lastschool_startdate" type="text" value="<?php echo $last_school_stard_date;?>"/>
											<span class="help-block">
												 Select date
											</span>
										</div>
									</div>
														</div>
                                                    
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last school end date</label>
															
										<div class="col-md-6">
											<input class="form-control" id="last_school_enddate" name="lastschool_enddate" type="text" value="<?php echo $last_school_end_date;?>"/>
											<span class="help-block">
												 Select date
											</span>
										</div>
									</div>
														</div>											
														<!--/span-->													
													<!--/span-->
												</div>
                                                
                                                <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last class percentage</label>
															
										<div class="col-md-6">
											<input type="text" name="last_persentage" class="form-control" id="exampleInputEmail1" value="<?php echo $last_class_persentage;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last school board</label>
															
										<div class="col-md-6">
											<input type="text" name="lastschool_board" class="form-control" id="exampleInputEmail1" value="<?php echo $last_school_board;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br>
                                                
                                               <div class="row">
													
													 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Passing year</label>
															
										<div class="col-md-6">
											<input class="form-control" type="number" name="passing_year" value="<?php echo $passing_year;?>"/>											
										</div>
									</div>
														</div>
                                                       
													<!--/span-->
													
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
                                                
                                                 <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Residence phone number</label>
															
										<div class="col-md-6">
											<input type="number" class="form-control" name="residence_mobile" id="exampleInputEmail1" value="<?php echo $residence_phone;?>" placeholder="Enter Mobile No">
											<?php echo form_error('residence_mobile','<p style="color:#F83A18">','</p>'); ?>
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Emergency contact number</label>
															
										<div class="col-md-6">
											<input type="number" name="emergency_mobile" class="form-control" id="exampleInputEmail1" value="<?php echo $emergency_phone;?>" placeholder="Enter Mobile No">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div>
                                                
                                             
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
												</div><br>
                                                  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's Email ID</label>
															
										<div class="col-md-6">
											<input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $father_emailid;?>" name="father_emailid" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother's name</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_name" class="form-control" id="exampleInputEmail1" value="<?php echo $mother_name;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother's mobile number</label>
															
										<div class="col-md-6">
											<input type="number" name="mother_mobile" class="form-control" id="exampleInputEmail1" value="<?php echo $mother_mobile;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
													<!--/span-->
													
													<!--/span-->
												</div>
                                                
                                                
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
															<button type="submit" name="student_update" class="btn green">Update</button>
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
				<?php } ?>											
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
   $( "#admission_date" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd",
  // onClose: function( selectedDate ) {
  // $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
   $( "#first_day_session" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd",
  // onClose: function( selectedDate ) {
  // $( "#startdate" ).datepicker( "option", "maxDate", selectedDate );
  // }
   });
   $( "#student_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
   $( "#last_school_startdate" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
   $( "#last_school_enddate" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
	  
    
        $("#fewpay").click(function () {
            if ($(this).is(":checked")) {
                $("#payamount").show();
				// $("#studentfee").show();
				$("#fee1").hide();
            } else {
              $("#payamount").hide();
				//$("#studentfee").hide();
				$("#fee1").show();
            }
        });	
    });
        
 
</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
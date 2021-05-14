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
<title>Online ERP</title>
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

			$(".change_state").change(function(){
									var id = $(this).val();
									//alert(id);
									$.ajax({
										type : 'post',
								url  : '<?php echo base_url()?>ajax/city',
										data : 'id='+id+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
										cache:false,
										success: function(data){
											var dta = $.parseJSON(data);
											var i = 0;
											$("select[name=cityDrp]").empty();
											if(dta.length>0){
												$("select[name=cityDrp]").append("<option  value=''>Select City</option>");
												for(i;i<=dta.length;i++){
													$("select[name=cityDrp]").append("<option  value="+dta[i].id+">"+dta[i].city_name+"</option>");
												}
											//alert(dta[1].name);
											}
											else{
												alert("No City in this State.");
											}
										}
									});
									//alert(id);
								//alert('hello');
								});    


			$("#class,#coaching").change(function() {
			
				var string = "ERP";
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

		<script type="text/javascript">
			$(document).ready(function() {
			$("#roomfeature").change(function() {
				var id = $(this).val();
				
		$.post("<?php echo base_url();?>admin/getroomfeatures",{id:id},function(data)
		{

	//$("#features").html(data);

	//$(".auto_load_div").load(location.href + " .auto_load_div");
	})

				
			});
		});
		</script>
		


		<script type = "text/javascript">
$(document).ready(function(){

$("#student_dob").change(function(){
    	var age = $("#student_dob").val();
    	
    	$.post("<?php echo base_url();?>admin/getage",{age:age},function(data)
				{
					//alert(data);
//$('#payamount').show();
$('#currentdob').html(data);

				
					})


    });

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
					Update Student
					<?php }else{?>
					Add Student
					<?php }?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>admin/studentdetail">
							<?php
						if($this->uri->segment(3)!='')
						{
					?>Update Student
						<?php }else{?>
						Student
						<?php } ?>
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
						<div class="tab-pane" id="tab_2">
								<div class="portlet box green tabbable">
									
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>
							</div>
						</div>
						
						<?php echo form_open_multipart('admin/addstudent'); ?>
										
				<?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?php echo $this->session->flashdata('success') ?>
        </div>
    <?php }?>
    <?php if($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger"> <?php echo $this->session->flashdata('error') ?>
        </div>
    <?php }?>
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
				if($orgrole==1)
				{
				?>
						<div class="portlet-body">
										
				<?php				
				foreach($viewstudentinfo as $userdata)
						{
							$Stdid = $userdata->Stdid;
							$admission_date = $userdata->admission_date;
							$acedmic_session = $userdata->admission_session;
							$addmission_no = $userdata->addmission_no;
							$section_name = $userdata->section_name;
							$student_class = $userdata->student_class;
							$class_of_first_admission = $userdata->class_of_first_admission;
							$student_group = $userdata->student_group;
							$first_day_session = $userdata->first_day_session;						
							$student_coaching = $userdata->student_coaching;
							$student_image = $userdata->student_image;
							$student_fee = $userdata->student_fee;
							$sttype = $userdata->st_type;
							$adtype = $userdata->ad_type;
							$cast_category = $userdata->cast_category;
							$religion = $userdata->religion;
							$board_rollno = $userdata->board_rollno;
							$board_regno = $userdata->board_regno;
							$blood_group = $userdata->blood_group;
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
							
							$countries = $userdata->country;
							$state = $userdata->state;
							$city = $userdata->city;
							$pincode = $userdata->pincode;
							$firstday_session = $userdata->first_day_session;
							$gr_no = $userdata->gr_no;
							
							$residence_phone = $userdata->residence_phone;
							$emergency_phone = $userdata->emergency_phone;
							$father_name = $userdata->father_name;
							$father_mobile = $userdata->father_mobile;
							
							$father_emailid = $userdata->father_emailid;
							$mother_tongue = $userdata->mother_tongue;
							$mother_name = $userdata->mother_name;
							$mother_mobile = $userdata->mother_mobile;
							
						}
				?>						
					<div class="form-body">
							<div class=" portlet-tabs">
								<ul class="nav nav-tabs">
									
									<li>
										<a href="#portlet_tab2_6" data-toggle="tab">
											 Enclosed Images
										</a>
									</li>
									<li>
										<a href="#portlet_tab2_5" data-toggle="tab">
											 Transport Details
										</a>
									</li>
									<li>
										<a href="#portlet_tab2_4" data-toggle="tab">
											 Fees Details
										</a>
									</li>
									<li>
										<a href="#portlet_tab2_3" data-toggle="tab">
											 Family Details
										</a>
									</li>									
									<li>
										<a href="#portlet_tab2_2" data-toggle="tab">
											 Last Academic Details
										</a>
									</li>									
									<li class="active">
										<a href="#portlet_tab2_1" data-toggle="tab">
											 Academic Detail
										</a>
									</li>
								</ul>
								<div class="tab-content">
 <div class="tab-pane active" id="portlet_tab2_1">
	<h3 class="form-section">Academic Detail</h3>

	<div class="row">
	<div class="thumbnail" style="width: 290px; height: 160px;">

                            <?php

									  if($student_image=='')

									  {

									  ?>

         <img src="<?php echo base_url().'assets/img/avatar.png'?>"/>          							
         <?php }

									  if($student_image!='')

									  { ?>

		<img src="<?php echo base_url().'studentimage/'.$student_image;?>"/>	  

								<?php } ?>   

		</div>
	</div>

	<hr/>
	
	<div class="row">
												<div class="col-md-6">
														<div class="form-group">
						<label class="control-label col-md-6">Registration Number as Login Id</label>
															
										<div class="col-md-6">
											<input type="text"  name="registration_id" class="form-control" value="<?php if(isset($_POST['registration_id'])) {echo $_POST['registration_id'];} else{echo $Stdid;} ?>" readonly id="registration_id">											
										</div>
									</div>
														</div>
														
														<input type="hidden" id="date" name="date" class="form-control"autocomplete="off" value="<?php echo date("d-m-ms"); ?>"/>
												
													
												</div><br/>
													<!--/span-->
												
												<!--/row-->
												<div class="row">
                                                <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Acedmic Session Year <font color="red">*</font> </label>
															<div class="col-md-6">
		<?php

		$acedmic = '';

		if(isset($_POST['session']))
		{
			$acedmic = $_POST['session'];
		}
		else{
			$acedmic = $acedmic_session;
		} 
		  
		  echo form_dropdown('session',$session,$acedmic,'class="form-control" id="session"','required'); ?>
			
																</div>
	
														</div>
													</div>
	<?php echo form_error('session','<p style="color:#F83A18">','</p>'); ?>
												

													<div class="col-md-6">
														<div class="form-group">
							<label class="control-label col-md-6">Admission Type
							<font color="red">*</font></label>
															<div class="col-md-6">
		<?php 

		$addtype = '';
		
		if(isset($_POST['ad_type']))
		{
			$addtype = $_POST['ad_type'];
		}
		else{
			$addtype = $acedmic_session;
		} 
		  
		  echo form_dropdown('ad_type',['Select']+$ad_type,$addtype,'class="form-control" id="ad_type" required'); ?>

			<?php echo form_error('ad_type','<p style="color:#F83A18">','</p>'); ?>	
															</div>
														</div>
													</div>

													 </div> <br/>

			 <div class="row">
													<div class="col-md-6">
														<div class="form-group">
		<label class="control-label col-md-6">Student first name
		<font color="red">*</font></label>
															
										<div class="col-md-6">
											<input type="text" name="FirstName" id="FirstName" class="form-control" value="<?php if(isset($_POST['FirstName'])) {echo $_POST['FirstName'];} else{echo $FName;} ?>" placeholder="Enter text">
											<?php echo form_error('FirstName','<p style="color:#F83A18">','</p>'); ?>	
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student last name<font color="red">*</font></label>
															
										<div class="col-md-6">
											<input type="text" name="LastName" id="LastName" class="form-control" value="<?php if(isset($_POST['LastName'])) {echo $_POST['LastName'];} else{echo $LName;} ?>" placeholder="Enter text">
											<?php echo form_error('LastName','<p style="color:#F83A18">','</p>'); ?>	
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>

		<div class="row">
		<div class="col-md-6">
														<div class="form-group">
		<label class="control-label col-md-6">Admission No.
		<font color="red">*</font></label>
															
										<div class="col-md-6">
			<input type="text" name="addmission_no" class="form-control" id="addmission_no" value="<?php if(isset($_POST['addmission_no'])) {echo $_POST['addmission_no'];} else{echo $addmission_no;} ?>" placeholder="Enter text">
											<?php echo form_error('addmission_no','<p style="color:#F83A18">','</p>'); ?>
										</div>
									</div>
														</div>

											<div class="col-md-6">
														<div class="form-group">
		<label class="control-label col-md-6">Class Section<font color="red">*</font></label>
															<div class="col-md-6">
		<?php 

		$Classection = '';
		
		if(isset($_POST['section']))
		{
			$Classection = $_POST['section'];
		}
		else{

			$Classection = $section_name;
		} 
		  
		  echo form_dropdown('section',$section,$Classection,'class="form-control" id="section" required'); ?>

			<?php echo form_error('section','<p style="color:#F83A18">','</p>'); ?>	
															</div>
														</div>
													</div>
		</div> <br/>

<div class="row">
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Class Name</label>
															<div class="col-md-6">
		<?php 
		  
		  echo form_dropdown('class',$class,$student_class,'class="form-control" id="class"'); ?>
			
																</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
				<label class="control-label col-md-6">Mobile number<font color="red">*</font></label>
															
										<div class="col-md-6">
											<input type="number" class="form-control" name="residence_mobile" id="residence_mobile" value="<?php if(isset($_POST['residence_mobile'])) {echo $_POST['residence_mobile'];} else{echo $residence_phone;} ?>" placeholder="Enter Mobile No">
											<?php echo form_error('residence_mobile','<p style="color:#F83A18">','</p>'); ?>
										</div>
									</div>
														</div>
</div> <br/>

<div class="row">
<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Date of birth</label>
															
										<div class="col-md-6">
							<input class="form-control" name="dob" id="student_dob" type="text" value="<?php echo $dob;?>"/>
											
										</div>
									</div>
														</div>

														 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student Age</label>
															
							<div class="col-md-6">
									<span id="currentdob" name="student_age"></span>
											
											
										</div>
									</div>
														</div>    
</div> <br/> 

<div class="row">
<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Board Roll No.</label>
															
										<div class="col-md-6">
		<input type="text" name="board_rollno" class="form-control" id="board_rollno" value="<?php if(isset($_POST['board_rollno'])) {echo $_POST['board_rollno'];} else{echo $board_rollno;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Aadhar Card No</label>
															
										<div class="col-md-6">
											<input type="text" name="aadhar_cardno" class="form-control" id="aadhar_cardno" value="<?php echo $adharcard_no;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>		
</div> <br/>

<div class="row">
<div class="col-md-6">
														<div class="form-group">
		<label class="control-label col-md-6">Email-id<font color="red">*</font></label>
															
										<div class="col-md-6">
											<input type="email" name="Emailid" class="form-control" id="Emailid" value="<?php echo $emailid;?>" placeholder="Enter text">
		<?php echo form_error('Emailid','<p style="color:#F83A18">','</p>'); ?>
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother Tongue</label>
															
										<div class="col-md-6">
			<input type="text" name="mother_tongue" class="form-control" id="mother_tongue" value="<?php if(isset($_POST['mother_tongue'])) {echo $_POST['mother_tongue'];} else{echo $mother_tongue;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
</div> <br/>

<div class="row">

													
													<div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">Gendar
									 <?php 
                           $male = array(
                                        'name'          => 'Gender',
                                        'id'            => 1,
                                    'value'             => 'Boy',                                                                      
                                        'checked'       =>(set_value('Gender',$userdata->gender) === 'Boy' ? TRUE : FALSE)
                                        
                                    );

							   echo form_radio($male); ?>Boy</label>
                          
                            <label class="control-label col-md-3">
                       <?php
                                $female = array(
                                        'name'          => 'Gender',
                                        'id'            => 2,
                                        'value'         => 'Girl', 
                                        'checked'       =>(set_value('Gender',$userdata->gender) === 'Girl' ? TRUE : FALSE)
                                        
                                    );
                                echo form_radio($female); ?>Girl</label>  
								  </div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Category|Cast</label>
															
										<div class="col-md-6">
											<?php
					$options = array(
						'' => 'Select',
						'General' => 'General',
						'EWS'	=> 'EWS',
						'OBC' => 'OBC',
						'SC' => 'SC/ST',
						'Other' => 'Other'
						);
		  
		  echo form_dropdown('cast_category',$options,$cast_category,'class="form-control" id="cast_category"'); ?>
											
										</div>
									</div>
														</div>
</div> <br/>

<div class="row">
<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student Type</label>
															<div class="col-md-6">
																<?php 
		  
		  echo form_dropdown('st_type',$st_type,$sttype,'class="form-control" id="st_type"'); ?>

															<?php echo form_error('section','<p style="color:#F83A18">','</p>'); ?>	
															</div>
														</div>
													</div>

													 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Religion</label>
															
										<div class="col-md-6">
											<?php
					$options = array(
						'' => 'Select',
						'Hindu' => 'Hindu',
						'Muslim' => 'Muslim',
						'Sheikh' => 'Sheikh',
						'Christian' => 'Christian',
						'Roman'     => 'Roman'
						);
		  
		  echo form_dropdown('religion',$options,$religion,'class="form-control" id="religion"'); ?>
											
										</div>
									</div>
														</div>
</div> <br/>

<div class="row">
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Date of Admission</label>			
										<div class="col-md-6">
											<input class="form-control" value="<?php if(isset($_POST['admission_date'])) {echo $_POST['admission_date'];} else{echo $admission_date;} ?>" id="admission_date" name="admission_date" type="text"/>
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Class of first Admission
															<font color="red">*</font></label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('class_of_first_admission',$class,$class_of_first_admission,'class="form-control" id="class_of_first_admission" required'); ?>
			
																</div>
														</div>
													</div>
												</div> <br/>

														<div class="row">
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Admission in Session</label>
															
										<div class="col-md-6">
			<input class="form-control" size="16" name="firstday_session" type="text" id="firstday_session" value="<?php if(isset($_POST['firstday_session'])) {echo $_POST['firstday_session'];} else{echo $firstday_session;} ?>"/>
											
										</div>
									</div>
									
									
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student Group
															<font color="red">*</font></label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('student_group',['Select']+$group,$student_group,'class="form-control" id="student_group" required'); ?>
			
																</div>
														</div>
													</div>
</div> <br/>

<div class="row">

                                                    
                                                   <div class="col-md-6">
														<div class="form-group">
													<label class="control-label col-md-6">Board Registration No.</label>
															
										<div class="col-md-6">
		<input type="text" name="board_regno" class="form-control" id="board_regno" value="<?php if(isset($_POST['board_regno'])) {echo $_POST['board_regno'];} else{echo $board_regno;} ?>" placeholder="Enter text">
											<?php echo form_error('board_regno','<p style="color:#F83A18">','</p>'); ?>
										</div>
									</div>
														</div>
                                                        
                                                      <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">GR No.</label>
															
										<div class="col-md-6">
		<input type="text" name="gr_no" class="form-control" id="gr_no" value="<?php if(isset($_POST['gr_no'])) {echo $_POST['gr_no'];} else{echo $gr_no;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
												</div><br/>


												<!--/row-->
												<div class="row">

												 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Blood Group</label>
															
										<div class="col-md-6">
		<input type="text" name="blood_group" class="form-control" id="blood_group" value="<?php if(isset($_POST['blood_group'])) {echo $_POST['blood_group'];} else{echo $blood_group;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>		
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">School</label>
															<div class="col-md-6">
																<?php 
		 if(empty($coaching))
		  {
		  	$coaching =	$this->base_model->getcoachingname($this->session->userdata('empid'));

		  	echo form_dropdown('coaching',['Select School']+$coaching,$student_coaching,'class="form-control" id="coaching"');
		  }
			elseif($coaching!=''){

				if(!empty($coaching))
				{

				$coaching =	$this->base_model->get_coaching_name($this->session->userdata('empid'));

					echo form_dropdown('coaching',['Select School']+$coaching,$student_coaching,'class="form-control" id="coaching"');
				}
				else{
					
					$coaching = $this->base_model->getCoaching();

				echo form_dropdown('coaching',['Select School']+$coaching,$student_coaching,'class="form-control" id="coaching"');
				}
			}

		   ?>
												<?php echo form_error('coaching','<p style="color:#F83A18">','</p>'); ?>									
															</div>
														</div>
													</div>
													
													<!--/span-->
												</div><br/>
                                                
                                                <div class="row">
														
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Student Image</label>
															<div class="col-md-6">
																<input type="file" name="student_image" id="exampleInputFile1">
												
															</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">House
															</label>
															<div class="col-md-6">
																	<?php 
		  
		  echo form_dropdown('house_group',['Select']+$housegroup,$house_group,'class="form-control" id="house_group"'); ?>
			
																</div>
														</div>
													</div>


													</div><br/>
 											
<h3 class="form-section">Subject Details</h3>
												    <div class="row">
													<div class="col-md-12">
														<div class="form-group">


									<div class="row">

									<?php									
									
									foreach($subject as $row) {								
										?>

										<div class="col-md-3">
								
									<div class="col-md-7" style="padding-left: 0">
											<?php echo $row->subject_name; ?>
											</div>
											<div class="col-md-2">

											<?php
											
							$subjectname = explode(',',$viewstudentinfo[0]->subject);


											?>
											<input type="checkbox" name="subject_name[]" <?php if(in_array($row->id,$subjectname)){ ?> checked="checked" <?php } ?> class="chk" id="subject_name" value = "<?php echo $row->id;?>">
											</div>
												
											

										</div>

										<?php } ?>

										</div>

									</div></div>
								</div><br/>												

		<h3 class="form-section">Address Details</h3>

		 <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Communication address </label>
															
										<div class="col-md-6">
											<input type="text" name="communication_address" class="form-control" value="<?php if(isset($_POST['communication_address'])) {echo $_POST['communication_address'];} else{echo $communication_address;} ?>" id="exampleInputEmail1" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Permanent address</label>
															
										<div class="col-md-6">
										<input type="text" name="permanent_address" class="form-control" value="<?php if(isset($_POST['permanent_address'])) {echo $_POST['permanent_address'];} else{echo $permanent_address;} ?>" id="exampleInputEmail1" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>

												<div class="row">
<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Country/Nationality</label>
															<div class="col-md-6">
																	<?php 
		  				$option = array('10'=>'Indian');
		  echo form_dropdown('countriesDrp',$option,$countries,'class="form-control" id="countriesDrp"','required'); ?>
			
																</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">State</label>
															<div class="col-md-6">
															<?php 
	 
	  echo form_dropdown('StateDrp',$stateDrop,$state,'class="form-control change_state" id="StateDrp"','required'); ?> 
			
																</div>
                                                                
														</div>
													</div>
</div> <br/>
                                                
                                                                                              	
                                                <div class="row">
														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">City</label>
															<div class="col-md-6">
																	 <?php	 
	  echo form_dropdown('cityDrp', $cityDrop, $city,'class="form-control select2me"','required');
	  ?>			
																</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Pin code</label>
															
										<div class="col-md-6">
											<input type="text" name="pincode" class="form-control" id="pincode" value="<?php if(isset($_POST['pincode'])) {echo $_POST['pincode'];} else{echo $pincode;} ?>" placeholder="Enter Pincode">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
                                                
                                                 <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Emergency contact number</label>
															
										<div class="col-md-6">
		<input type="number" name="emergency_mobile" class="form-control" id="emergency_mobile" value="<?php if(isset($_POST['emergency_mobile'])) {echo $_POST['emergency_mobile'];} else{echo $emergency_phone;} ?>" placeholder="Enter Mobile No" required>
		<?php echo form_error('emergency_mobile','<p style="color:#F83A18">','</p>'); ?>
											
										</div>
									</div>
														</div>
													
												</div> <br/>

		<h3 class="form-section">Health Information</h3>

												<div class="row">

                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Height(cm)</label>
															
										<div class="col-md-6">
											<input type="text" name="height" class="form-control" id="height" value="<?php if(isset($_POST['height'])) {echo $_POST['height'];} else{echo $height;} ?>" placeholder="Enter height">
											
										</div>
									</div>
														</div>													
														
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Weight(kg)</label>
															
										<div class="col-md-6">
											<input type="text" name="weight" class="form-control" id="weight" value="<?php if(isset($_POST['weight'])) {echo $_POST['weight'];} else{echo $weight;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
												</div><br/>

												<div class="row">

                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Vision(L)</label>
															
										<div class="col-md-6">
											<input type="text" name="visionL" class="form-control" id="visionL" value="<?php if(isset($_POST['visionL'])) {echo $_POST['visionL'];} else{echo $visionL;} ?>" placeholder="Enter visionL">
											
										</div>
									</div>
														</div>													
														
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Vision(R)</label>
															
										<div class="col-md-6">
											<input type="text" name="visionR" class="form-control" id="visionR" value="<?php if(isset($_POST['visionR'])) {echo $_POST['visionR'];} else{echo $visionR;} ?>" placeholder="Enter visionR">
											
										</div>
									</div>
														</div>
													
												</div><br/>

												<div class="row">

												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Dental Hygiene</label>
															
										<div class="col-md-6">
											<input type="text" name="dental" class="form-control" id="dental" value="<?php if(isset($_POST['dental'])) {echo $_POST['dental'];} else{echo $dental;} ?>" placeholder="Enter Hygiene">
											
										</div>
									</div>
														</div> <br/>
												</div>                                                
                                                 
</div>

<div class="tab-pane" id="portlet_tab2_2">	
<h3 class="form-section">Last Academic Information</h3>

    <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Name of last school</label>
															
										<div class="col-md-6">
										<input type="text" name="lastschool_name" class="form-control" id="exampleInputEmail1" value="<?php if(isset($_POST['lastschool_name'])) {echo $_POST['lastschool_name'];} else{echo $lastschool_name;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last class passed</label>
															
										<div class="col-md-6">
											<input type="text" name="lastclass_passed" class="form-control" id="lastclass_passed" value="<?php if(isset($_POST['lastclass_passed'])) {echo $_POST['lastclass_passed'];} else{echo $last_class_passed;} ?>" placeholder="Enter text">
											
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
											<input class="form-control" id="last_school_startdate" name="lastschool_startdate" type="text" value="<?php if(isset($_POST['last_school_startdate'])) {echo $_POST['last_school_startdate'];} else{echo $last_school_stard_date;} ?>"/>
											
										</div>
									</div>
														</div>
                                                    
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last school end date</label>
															
										<div class="col-md-6">
											<input class="form-control" id="lastschool_enddate" name="lastschool_enddate" type="text" value="<?php if(isset($_POST['lastschool_enddate'])) {echo $_POST['lastschool_enddate'];} else{echo $last_school_end_date;} ?>"/>
											
										</div>
									</div>
														</div>											
														<!--/span-->													
													<!--/span-->
												</div><br/>
                                                
                                                <div class="row">
													<div class="col-md-6">
														<div class="form-group">
												<label class="control-label col-md-6">Last class percentage</label>
															
										<div class="col-md-6">
											<input type="text" name="last_persentage" class="form-control" id="last_persentage" value="<?php if(isset($_POST['last_persentage'])) {echo $_POST['last_persentage'];} else{echo $last_class_persentage;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Last school board</label>
															
										<div class="col-md-6">
											<input type="text" name="lastschool_board" class="form-control" id="lastschool_board" value="<?php if(isset($_POST['lastschool_board'])) {echo $_POST['lastschool_board'];} else{echo $last_school_board;} ?>" placeholder="Enter text">
											
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
											<input class="form-control" type="number" name="passing_year" value="<?php if(isset($_POST['passing_year'])) {echo $_POST['passing_year'];} else{echo $passing_year;} ?>"/>											
										</div>
									</div>
														</div>
                                                       
													<!--/span-->
													
													<!--/span-->
												</div>                                        
                                              
</div>

<div class="tab-pane" id="portlet_tab2_3">
 <h3 class="form-section">Father Details</h3>
 
 <div class="row">
													<div class="col-md-12">
														<div class="form-group">
															<label class="control-label col-md-2">Father's name *</label>

										<div class="col-md-2">
											<?php
					$options = array(
						'' => 'Select',						
						'MR.' => 'MR.',
						'DR.'	=> 'DR.',
						'LATE.' => 'LATE.'						
						);
		  
		  echo form_dropdown('father_salutation',$options,$father_salutation,'class="form-control" id="father_salutation",required'); ?>
											
										</div>

										<div class="col-md-3">
											<input type="text" name="father_name" class="form-control" id="father_name" value="<?php if(isset($_POST['father_name'])) {echo $_POST['father_name'];} else{echo $father_name;} ?>" placeholder="Enter text">
											
										</div> 
</div>



										</div>
										</div> <br/>

										 <div class="row">
									
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's mobile number</label>
															
										<div class="col-md-6">
											<input type="number" class="form-control" id="father_mobile" name="father_mobile" value="<?php if(isset($_POST['father_mobile'])) {echo $_POST['father_mobile'];} else{echo $father_mobile;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<!--/span-->
													
													<!--/span-->
											</div> <br/>	

                                                  <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's Email ID</label>
															
										<div class="col-md-6">
		<input type="email" class="form-control" id="father_emailid" value="<?php if(isset($_POST['father_emailid'])) {echo $_POST['father_emailid'];} else{echo $father_emailid;} ?>" name="father_emailid" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father's DOB</label>
															
										<div class="col-md-6">
											<input type="text" class="form-control" id="father_dob" value="<?php if(isset($_POST['father_dob'])) {echo $_POST['father_dob'];} else{echo $father_dob;} ?>" name="father_dob" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
													
												</div><br/>
                                                  <div class="row">

                                                  <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Specialization</label>
															
										<div class="col-md-6">
											<input type="text" name="father_specialization" class="form-control" id="father_specialization" value="<?php if(isset($_POST['father_specialization'])) {echo $_POST['father_specialization'];} else{echo $father_specialization;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Qualification</label>
															
										<div class="col-md-6">
											<?php
					$options = array(
						'' => 'Select',
						'BSC' => 'BSC',
						'MSC' => 'MSC',
						'BCA' => 'BCA',
						'MCA' => 'MCA',
						'BTECH'=> 'BTECH',
						'MTECH' => 'MTECH'
						);
		  
		  echo form_dropdown('father_qualification',$options,$qualification,'class="form-control" id="father_qualification"'); ?>
											
										</div>
									</div>
														</div>
														</div><br/>

														 <div class="row">

                                                 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Profession</label>
															
										<div class="col-md-6">
											<input type="text" name="father_profession" class="form-control" id="father_profession" value="<?php if(isset($_POST['father_profession'])) {echo $_POST['father_profession'];} else{echo $father_profession;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Desigination</label>
															
										<div class="col-md-6">
											<input type="text" name="father_desigination" class="form-control" id="father_desigination" value="<?php if(isset($_POST['father_desigination'])) {echo $_POST['father_desigination'];} else{echo $father_desigination;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
														</div><br/>

														 <div class="row">

                                                 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Department</label>
															
										<div class="col-md-6">
											<input type="text" name="father_department" class="form-control" id="father_department" value="<?php if(isset($_POST['father_department'])) {echo $_POST['father_department'];} else{echo $father_department;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Office Name</label>
															
										<div class="col-md-6">
											<input type="text" name="father_officename" class="form-control" id="father_officename" value="<?php if(isset($_POST['father_officename'])) {echo $_POST['father_officename'];} else{echo $father_officename;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
														</div><br/>

														 <div class="row">

                                                 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Office Address</label>
															
										<div class="col-md-6">
											<input type="text" name="father_officeaddress" class="form-control" id="father_officeaddress" value="<?php if(isset($_POST['father_officeaddress'])) {echo $_POST['father_officeaddress'];} else{echo $father_officeaddress;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Office Contact No.</label>
															
										<div class="col-md-6">
											<input type="text" name="father_officecontactno" class="form-control" id="father_officecontactno" value="<?php if(isset($_POST['father_officecontactno'])) {echo $_POST['father_officecontactno'];} else{echo $father_officecontactno;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div> 
														</div><br/>

														<div class="row">

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father Annual Income</label>
															
										<div class="col-md-6">
											<input type="text" name="father_annual_income" class="form-control" id="father_annual_income" value="<?php if(isset($_POST['father_annual_income'])) {echo $_POST['father_annual_income'];} else{echo $father_annual_income;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div> 
														</div> <br/>

	<h3 class="form-section">Mother Details</h3>

	<div class="row">

                                                  	<div class="col-md-12">
														<div class="form-group">
															<label class="control-label col-md-2">Mother's name</label>
															

									<div class="col-md-2">
											<?php
					$options = array(
						'' => 'Select',
						'MRS.' => 'MRS.',
						'DR.'	=> 'DR.',
						'LATE.' => 'LATE.'						
						);
		  
		  echo form_dropdown('mother_salutation',$options,$mother_salutation,'class="form-control" id="mother_salutation",required'); ?>
											
										</div> 

										
															
										<div class="col-md-3">
											<input type="text" name="mother_name" class="form-control" id="mother_name" value="<?php if(isset($_POST['mother_name'])) {echo $_POST['mother_name'];} else{echo $mother_name;} ?>" placeholder="Enter text">
											
										</div> </div> </div> </div>  <br/>
									
													<div class="row">

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother's mobile number</label>
															
										<div class="col-md-6">
											<input type="number" name="mother_mobile" class="form-control" id="mother_mobile" value="<?php if(isset($_POST['mother_mobile'])) {echo $_POST['mother_mobile'];} else{echo $mother_mobile;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														</div> <br/>

														 <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother Email ID</label>
															
										<div class="col-md-6">
											<input type="email" class="form-control" id="mother_emailid" value="<?php if(isset($_POST['mother_emailid'])) {echo $_POST['mother_emailid'];} else{echo $mother_emailid;} ?>" name="mother_emailid" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother DOB</label>
															
										<div class="col-md-6">
											<input type="text" class="form-control" id="mother_dob" value="<?php if(isset($_POST['mother_dob'])) {echo $_POST['mother_dob'];} else{echo $mother_dob;} ?>" name="mother_dob" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
													
												</div><br/>
                                                  <div class="row">

                                                  <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Specialization</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_specialization" class="form-control" id="mother_specialization" value="<?php if(isset($_POST['mother_specialization'])) {echo $_POST['mother_specialization'];} else{echo $mother_specialization;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Qualification</label>
															
										<div class="col-md-6">
											<?php
					$options = array(
						'' => 'Select',
						'BSC' => 'BSC',
						'MSC' => 'MSC',
						'BCA' => 'BCA',
						'MCA' => 'MCA',
						'BTECH'=> 'BTECH',
						'MTECH' => 'MTECH'
						);
		  
		  echo form_dropdown('mother_qualification',$options,$mother_qualification,'class="form-control" id="mother_qualification"'); ?>
											
										</div>
									</div>
														</div>
														</div><br/>

														 <div class="row">

                                                 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Profession</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_profession" class="form-control" id="mother_profession" value="<?php if(isset($_POST['mother_profession'])) {echo $_POST['mother_profession'];} else{echo $mother_profession;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Desigination</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_desigination" class="form-control" id="mother_desigination" value="<?php if(isset($_POST['mother_desigination'])) {echo $_POST['mother_desigination'];} else{echo $mother_desigination;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
														</div><br/>

														 <div class="row">

                                                 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Department</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_department" class="form-control" id="mother_department" value="<?php if(isset($_POST['mother_department'])) {echo $_POST['mother_department'];} else{echo $mother_department;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Office Name</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_officename" class="form-control" id="mother_officename" value="<?php if(isset($_POST['mother_officename'])) {echo $_POST['mother_officename'];} else{echo $mother_officename;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
														</div><br/>

														 <div class="row">

                                                 <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Office Address</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_officeaddress" class="form-control" id="mother_officeaddress" value="<?php if(isset($_POST['mother_officeaddress'])) {echo $_POST['mother_officeaddress'];} else{echo $mother_officeaddress;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

		  									<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Office Contact No.</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_officecontactno" class="form-control" id="mother_officecontactno" value="<?php if(isset($_POST['mother_officecontactno'])) {echo $_POST['mother_officecontactno'];} else{echo $mother_officecontactno;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div> 
														</div><br/>

														<div class="row">

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother Annual Income</label>
															
										<div class="col-md-6">
											<input type="text" name="mother_annual_income" class="form-control" id="mother_annual_income" value="<?php if(isset($_POST['mother_annual_income'])) {echo $_POST['mother_annual_income'];} else{echo $mother_annual_income;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div> 
														</div> <br/>

		<h3 class="form-section">Relative Details</h3>

														<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">No. of Brothers</label>
															
										<div class="col-md-6">
											<input type="number" name="brothers" class="form-control" id="brothers" value="<?php if(isset($_POST['brothers'])) {echo $_POST['brothers'];} else{echo $brothers;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
												</div><br/>

												 <div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">No. of Sisters</label>
															
										<div class="col-md-6">
											<input type="number" name="sisters" class="form-control" id="sisters" value="<?php if(isset($_POST['sisters'])) {echo $_POST['sisters'];} else{echo $sisters;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Special Needs if any</label>
															
										<div class="col-md-6">
											<input type="text" name="sp_need" class="form-control" id="sp_need" value="<?php if(isset($_POST['sp_need'])) {echo $_POST['sp_need'];} else{echo $sp_need;} ?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
												</div><br/>

</div>

<div class="tab-pane" id="portlet_tab2_4">	
<h3 class="form-section">Fees Information</h3>

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
															<label class="control-label col-md-6">Fee Applicable Date</label>
															
										<div class="col-md-6">
											<input type="text" name="fee_applicable_date" class="form-control" id="fee_applicable_date" value="<?php if(isset($_POST['fee_applicable_date'])) {echo $_POST['fee_applicable_date'];} else{echo $fee_applicable_date;} ?>" placeholder="Enter text">
											
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
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Remark</label>
															
										<div class="col-md-6">
											<input type="text" name="remarks" class="form-control" id="exampleInputEmail1" value="<?php echo $remarks;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>
													
												</div><br/>
												<div class="row">
												<div class="col-md-6" >
												<div class="form-group" id = "netamount" style = "display:none;" >
												<label class="control-label col-md-6"> Pay Amount</label>
<input type = "text" name = "pay" id = "pay" class = "form-control" >
												</div>
												</div>
												</div>



</div>

<div class="tab-pane" id="portlet_tab2_5">	
<h3 class="form-section">Transport Information</h3>
</div>

<div class="tab-pane" id="portlet_tab2_6">
 <h3 class="form-section">Enclosed Images</h3>

												 <div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Father Image</label>
															<div class="col-md-6">
																<input type="file" name="father_image" id="exampleInputFile1">
												
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Mother Image</label>
															<div class="col-md-6">
																<input type="file" name="mother_image" id="exampleInputFile1">
												
															</div>
														</div>
													</div>
													<!--/span-->
													
													<!--/span-->
												</div><br/>
<div class="form-actions fluid">
												<div class="row">
						<div class="col-md-offset-3 col-md-4">
															<?php
												if(!empty($_POST['edit']))
													{
														?>
															<input type="submit" name="student_update" class="btn green" value="Update"/>
															<?php
													}else{?>
														<input type="submit" name="student_update" class="btn green" value="Submit"/>
														<?php
													}?>
<a class="btn default addroom-cancel" href="<?php echo base_url()?>admin/studentdetail">Cancel</a>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>	
</div>




</div>
</div> </div>
										
<?php echo form_close(); ?>
</div>
<?php } ?>
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
   $( "#father_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
   $( "#mother_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
   $( "#student_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd", 
   });
   $( "#fee_applicable_date" ).datepicker({
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
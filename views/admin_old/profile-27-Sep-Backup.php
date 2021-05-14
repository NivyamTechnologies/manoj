<!DOCTYPE html>

 <html lang="en" class="no-js"> 

<!-- BEGIN HEAD --><head>

	<meta charset="utf-8" />

	<title>Online ERP</title>

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

<link href="<?php echo base_url().'assets/css/pages/tasks.css'?>" rel="stylesheet" type="text/css" media="screen"/>

	<!-- END PAGE LEVEL STYLES -->

<link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'?>" />

<script src="<?php echo base_url().'assets/scripts/jquery-1.10.1.min.js';?>" type="text/javascript"></script>

<script>
   $(function(){  

   	$(".change_state").change(function(){
									var id = $(this).val();
									alert(id);
									$.ajax({
										type : 'post',
								url  : '<?php echo base_url()?>admin/city',
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
   });
 </script>

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

<?php

        foreach($userinfo as $userdata)

						{

							$employeeid = $userdata->Orgid;

							$FirstName = $userdata->FirstName;

							$LastName = $userdata->LastName;

							$desigination = $userdata->desigination;

							$dob = date_create($userdata->dob);

							$dateofbirth = date_format($dob,"d-M-Y");

							$profilephoto = $userdata->photo_name;							

							$country = $userdata->country;

							$state = $userdata->state;

							$city = $userdata->city;

							$emailid = $userdata->emailid;

							$mobileno = $userdata->mobileno;

                        ?>

                        

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div id="portlet-config" class="modal hide">

				<div class="modal-header">

					<button data-dismiss="modal" class="close" type="button"></button>

					<h3>portlet Settings</h3>

				</div>

				<div class="modal-body">

					<p>Here will be a configuration form</p>

				</div>

			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							Profile

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo base_url()?>admin/dashboard">Home</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="<?php echo base_url()?>admin/profile">Profile</a></li>

							<li class="pull-right no-text-shadow">

								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">

									<i class="icon-calendar"></i>

									<span></span>

									<i class="icon-angle-down"></i>

								</div>

							</li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				

                

        <div class="alert alert-error hide">

												<button class="close" data-dismiss="alert"></button>

												You have some form errors. Please check below.

											</div>

                                            <?php if ($this->session->flashdata('success')) { ?>

        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>

        <button class="close" data-dismiss="alert"></button> </div>

    <?php } ?>

    

    			<div class="col-md-12 col-sm-12">

					<!-- BEGIN PORTLET-->

					<div class="portlet paddingless">

						<div class="portlet-title line">							

							

						</div>

						<div class="portlet-body">

							<!--BEGIN TABS-->

							<div class="tabbable tabbable-custom">

								<ul class="nav nav-tabs">

								<li class="active"><a href="#tab_1_1" data-toggle="tab">Overview</a></li>

								<li><a href="#tab_1_2" data-toggle="tab">Profile Info</a></li>

								<li><a href="#tab_1_3" data-toggle="tab">Change Pic</a></li>

								<li><a href="#tab_1_4" data-toggle="tab">Change Info</a></li>

								<li><a href="#tab_1_5" data-toggle="tab">Change Password</a></li>

							</ul>

								<div class="tab-content">

								<div class="tab-pane row-fluid active" id="tab_1_1">

									<ul class="unstyled profile-nav span3">

										

                                        <?php

									  if($profilephoto=='')

									  {

									  ?>

         <img src="<?php echo base_url().'assets/img/avatar.png'?>" height="150px;" width="250px;"/>          							<?php }

									  if($profilephoto!='')

									  { ?>

		<img src="<?php echo base_url().'adminimage/'.$profilephoto;?>" height="150px;" width="250px;"/>	  

								<?php } ?>

										

									</ul>

									<div class="span9">

										<div class="row-fluid">

											<div class="span8 profile-info">

												<h1><?php echo $FirstName.'&nbsp;'.$LastName;?></h1><h4><?php echo $desigination;?></h4>
											</div>

											

										</div>

										<!--end row-fluid-->

										
									</div>									

								</div>

								<!--end tab-pane-->

								<div class="tab-pane profile-classic row-fluid" id="tab_1_2">

									<div class="span2"><img src="<?php echo base_url().'adminimage/'.$profilephoto;?>" height="70px;" width="100px;" /></div>

									<ul class="unstyled span10">

                     <li><span>Employee Id:</span> <p align="right" style="margin-right:590px; margin-top:-20px;"><?php echo $employeeid;?></p></li>

					<li><span>First Name:</span><p align="right" style="margin-right:660px; margin-top:-20px;"><?php echo $FirstName;?></p></li>

					<li><span>Last Name:</span><p align="right" style="margin-right:660px; margin-top:-20px;"><?php echo $LastName;?></p></li>									

		<li><span>Date Of Birth</span><p align="right" style="margin-right:655px; margin-top:-20px;"><?php echo $dateofbirth;?></p></li>        

<li><span>Email:</span><p align="right" style="margin-right:655px; margin-top:-20px;"><?php echo $emailid;?></p></li>

 <li><span>Mobile Number:</span><p align="right" style="margin-right:590px; margin-top:-20px;">+91-<?php echo $mobileno;?></p></li>

									</ul>

								</div>

								<!--tab_1_2-->

								<div class="tab-pane" id="tab_1_3">

									<div class="row-fluid">

										<div class="span12">											

											<div class="span9">

                      <?php if ($this->session->flashdata('sucess')) { ?>

        <div class="alert alert-success"> <?= $this->session->flashdata('sucess') ?>

        <button class="close" data-dismiss="alert"></button> </div>

    <?php } ?>
				<div style="height: auto;">
				<?php echo form_open_multipart('admin/Profilephoto'); ?> 

																<br />

						<div class="controls">

							<div class="thumbnail" style="width: 291px; height: 190px;">

                            <?php

									  if($profilephoto=='')

									  {

									  ?>

         <img src="<?php echo base_url().'assets/img/avatar.png'?>" height="50px;" width="500px;"/>          							<?php }

									  if($profilephoto!='')

									  { ?>

		<img src="<?php echo base_url().'adminimage/'.$profilephoto;?>" style="width: 291px; height: 190px;"/>	  

								<?php } ?>   

																		

																	</div>

																</div>

																<div class="space10"></div>

																<div class="fileupload fileupload-new" data-provides="fileupload">

																	<div class="input-append">

																		

																		

																		<span class="fileupload-new">Select file</span>

																		<span class="fileupload-exists">Change</span>

										<input type="file" required name="image" class="default" />

																		

																	</div>

																</div><br/>

																<div class="clearfix"></div>

																

																<div class="space10"></div>

																<div class="submit-btn">

			<?php $submit = array('type' => 'submit','name'=>'photo','class' => 'btn green');  

						echo form_submit($submit,'Update Photo');?> &nbsp;&nbsp;&nbsp;&nbsp;

																	<a href="#" class="btn">Cancel</a>

																</div>

															</form>

														</div>

														

											</div>

											<!--end span9-->                                   

										</div>

									</div>

								</div>

								<!--end tab-pane-->

								<div class="tab-pane row-fluid profile-account" id="tab_1_4">

									<div class="row-fluid">

										<div class="portlet-body form">

										<!-- BEGIN FORM-->

				<?php echo form_open_multipart('admin/profile'); ?>

				<?php				

				foreach($viewadmininfo as $userdata)
						{

							$Orgid = $userdata->Orgid;

							$FName = $userdata->FirstName;

							$LName = $userdata->LastName;

							$emailid = $userdata->emailid;

							$country = $userdata->country;

							$state = $userdata->state;

							$city = $userdata->city;						

							$communication_address = $userdata->address;

						}

				?>										    

											<div class="form-body">

												<h3 class="form-section">Orgnization Detail</h3>

												<div class="row">

												<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">Registration Id as Login Id</label>

															

										<div class="col-md-9">

											<input type="text"  name="teacher_id" id="teacher_id" class="form-control" value="<?php echo $Stdid;?>" id="exampleInputEmail1" readonly>

										</div>

									</div>

														</div>

														

													<!--	<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">Coaching</label>

															<div class="col-md-9">

																	<?php 

		  

		  echo form_dropdown('coaching',$coaching,$coaching_name,'class="form-control" readonly id="coaching"'); ?>

			

																</div>

														</div>

													</div> -->

														

														

												

												</div><br/>

												    <div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">First name</label>

															

										<div class="col-md-9">

											<input type="text" name="FirstName" id="FirstName" class="form-control" id="exampleInputEmail1" value="<?php echo $FName;?>" placeholder="Enter text">

											

										</div>

									</div>

														</div>

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">Last name</label>

															

										<div class="col-md-9">

											<input type="text" name="LastName" id="LastName" class="form-control" id="exampleInputEmail1" value="<?php echo $LName;?>" placeholder="Enter text">

											

										</div>

									</div>

														</div>

													<!--/span-->

													

													<!--/span-->

												</div><br/>

                                                

                                                	<!--<div class="row">

													

													<div class="col-md-6">

														<div class="form-group">

									<label class="control-label col-md-3">Gendar

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

															<label class="control-label col-md-3">Date of birth</label>

															

										<div class="col-md-9">

											<input class="form-control" name="dob" id="teacher_dob" type="text" value="<?php echo $dob;?>"/>

											<span class="help-block">

												 Select date

											</span>

										</div>

									</div>

														</div>

                                                    

												</div> -->

                                               

                                                <div class="row">

                                                    

                                                   <div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">Email-id</label>

															

										<div class="col-md-9">

											<input type="email" name="Emailid" class="form-control" id="exampleInputEmail1" value="<?php echo $emailid;?>" placeholder="Enter text">

											<?php echo form_error('Emailid','<p style="color:#F83A18">','</p>'); ?>

										</div>

									</div>

														</div>

                                                        

                                                      <div class="row">

													

													

												</div>

													<!--/span-->

													

													<!--/span-->

												</div><br/>

                                                

                                                  <div class="row">

													<div class="col-md-6">

													<div class="form-group">

					<label class="control-label col-md-3">Mobile No</label>

										<div class="col-md-9">

			<input type="number" name="mobileno" class="form-control" id="exampleInputEmail1" value="<?php echo $mobileno;?>" placeholder="Enter text">

										</div>

									</div>
										</div>

												</div>

                                                

                                                <h3 class="form-section">Address Information</h3>

												    <div class="row">

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">Communication address </label>

															

										<div class="col-md-9">

											<input type="text" name="communication_address" class="form-control" value="<?php echo $communication_address;?>" id="exampleInputEmail1" placeholder="Enter text">

											

										</div>

									</div>

														</div>

													
												</div><br/>

                                                

                                                <div class="row">

													

													<div class="col-md-6">

														<div class="form-group">

															<label class="control-label col-md-3">Country</label>

															<div class="col-md-9">

													<?php

		  echo form_dropdown('countriesDrp',$countryDrop,$country,'class="form-control" id="countriesDrp"'); ?>

			

																</div>

														</div>

													</div></div><br/>

                                                    

                                                 	 <div class="row">

														<div class="col-md-6">

														<div class="form-group">

				<label class="control-label col-md-3">State</label>

					<div class="col-md-9">

					<?php 
	 
	  echo form_dropdown('StateDrp',$stateDrop,$state,'class="form-control change_state" id="StateDrp"','required'); ?> 

								</div>
														</div>

														 </div>

												</div><br/>

                                                <div class="row">

								<div class="col-md-6">

								<div class="form-group">

			<label class="control-label col-md-3">City</label>

	<div class="col-md-9">

	<?php		 
	  echo form_dropdown('cityDrp',$cityDrop,$city,'class="form-control"','required');
	  ?>

			</div>

				</div>

					</div>

													

												</div><br/>

                                                                                                 

											</div>

											<div class="form-actions fluid">

												<div class="row">

													<div class="col-md-6">

														<div class="col-md-offset-3 col-md-9">

															

	<button type="submit" name="admin_update" class="btn green">Update</button>

															

	<a href="<?php echo base_url()?>admin/profile" class="btn">Cancel</a>

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

								

								<div class="tab-pane" id="tab_1_5">

								<div class="row-fluid">

								<div class="portlet-body form">

									

										<!-- BEGIN FORM-->

										

								<?php echo form_open_multipart('admin/Changepassword'); ?> 

								

								<div class="form-body">

												<h3 class="form-section">Change Password</h3>

												<div class="row">

													<div class="col-md-6">

														<div class="form-group">

										<label class="control-label col-md-3">New Password</label>			

										<div class="col-md-9">

								<input type="password"  name="password" id="password" class="form-control" required value="" id="exampleInputEmail1">

										</div>

									</div>

														</div>

												</div>

													

																<div class="submit-btn">

	<?php $submit = array('type' => 'submit','name'=>'pass','class' => 'btn green');  

						echo form_submit($submit,'Update Password');?>

																	<a href="<?php echo base_url()?>admin/profile" class="btn">Cancel</a>

																</div>

														<?php echo form_close();?>

						</div>

								</div>

								

								

							</div>

							</div>

							<!--END TABS-->

						</div>

					</div>

					<!-- END PORTLET-->

				</div>

    			

    			

					<?php	}?>

			</div>

			<!-- END PAGE CONTAINER--> 

		

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
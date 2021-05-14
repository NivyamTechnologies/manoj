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
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico"/>
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
					Section Detail
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/sectionwise">
								Section 
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
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Student
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
						<div class="portlet-body">
						
						<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
		
        </div>
    <?php } ?>  
							<div class="table-toolbar">
								<div class="btn-group">
				<?php echo form_open_multipart('admin/sectionwise'); ?>
										<table width="800">
                    <tr><td>
                    <div class="col-md-8">
														<div class="form-group">
												<label class="control-label col-md-4">Section</label>
															
										<div class="col-md-4">
											<?php 
		  
		  echo form_dropdown('section',$section,$section_name,'class="form-control" id="section"'); ?>
									</div>
							<div class="col-md-4">	<input type="submit" class="btn btn-sm" data-toggle="modal" name="search" value="Find"/>
									</div>
										
										
						</div></div></td>
                        
                      
											</tr><br/>
										</table>
										<?php echo form_close();?>					
								</div><br/>
								
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th> S.No.</th>
								<th>
									 Roll No
								</th>
								<th>
									 Student Name
								</th>
								<th>
									 Class Name
								</th>
								<th>
									 Section
								</th>
								<th>
									 Coaching Name
								</th>
								<th>
									 Fee
								</th>
								<th>
									 Remaining Fee
								</th>								
								<th>
									 Date of Admission
								</th>
								<th>
									 Membarship Card
								</th>
								<th>
									 Photo
								</th>
								<th>
									 Edit
								</th>
								<th>
									 Delete
								</th>
								<th>
									Action
								</th>
								
							</tr>
							</thead>
							<tbody>
							<?php 
					if(count($Allstudent)>0) { 
					$i=1;
										
					foreach($Allstudent as $r)
					{
						$student_class = $r->student_class;
						$student_section = $r->section_name;
						$dateofadmission = date_create($r->admission_date);
						$admission_date = date_format($dateofadmission,"d-M-Y");
						$coachingname = $r->student_coaching;
						$payfee = $r->student_fee;
						$remainingfee = $r->remaining_fee;
						$membarshipcard = $r->membarship_cardtype;
						
				?>
							
							<tr>
								
								<td><?php echo $i++;?></td>								
								<td><?php echo $r->Stdid;?></td>
								<td><?php echo $r->FirstName.'&nbsp;'.$r->LastName;?></td>
								<td><?php 
									$qq=$this->base_model->get_class($r->student_class);
									
		                            echo $qq[0]['class_name'];
		                            ?></td>
		                        <td>
									<?php 
									$qq=$this->base_model->get_section($r->section_name);
									
		                            echo $qq[0]['section_name'];
		                            ?>
								</td>
								<td>
									<?php 
									$qq=$this->base_model->get_coaching($r->student_coaching);
									
		                            echo $qq[0]['org_name'];
		                            ?>
								</td>
								<td>
									<?php echo $payfee;?>
								</td>
								<td>
									<?php 
									if($remainingfee!='')
									{
						echo "<p style='background-color: darkred; width:40px;'>$remainingfee</p>";
									}else{?>
									<?php 
										echo "<p>Not Due</p>";
									} ?>
									
								</td>
								<td>
									<?php echo $admission_date;?>
								</td>
								<td>
									<?php 
										if($membarshipcard==30)
									  {	echo  "<p style='background-color: orange; width:50px;'>Orange</p>"
									  ?>
									<?php }
									  elseif($membarshipcard==90)
									  { echo  "<p style='background-color: green; width:50px;'>Green</p>"
									?>
								  <?php }
									  elseif($membarshipcard==180)
									  { echo  "<p style='background-color: blue; width:50px;'>Blue</p>"
									?>
								  <?php }
									  elseif($membarshipcard==365)
									  { echo  "<p style='background-color: yellow; width:50px;'>Yellow</p>"
									?>
									  
									  <?php } ?>
								</td>
								<td>
									<?php
									  if($r->student_image=='')
									  {
									  ?>
         <img src="<?php echo base_url().'assets/img/avatar.png'?>" height="50px;" width="50px;"/>          							<?php }
									  if($r->student_image!='')
									  { ?>
		<img src="<?php echo base_url().'studentimage/'.$r->student_image;?>" height="50px;" width="50px;"/>	  
								<?php } ?>
									
								</td>								
								<td>
								<?php
								if(($org_role_edit==1))
								{
								?>
									<a href="<?php echo base_url()?>admin/addstudent/<?php echo $r->aid;?>" class="btn bg-primary wnm-user">
										 Edit
									</a>
								<?php }?>
								</td>
								<td>
								<?php
								if(($org_role_delete==1))
								{
								?>
									<a href="<?php echo base_url();?>admin/deleteStd/<?php echo $r->aid;?>" onclick="return confirm('Are you sure you want to delete this Student?')" class="btn bg-primary wnm-user"><i class="fa fa-times-circle"></i> Delete</a>
							   <?php }?>
								</td>
								<td>
								<?php
								if(($org_role_active==1))
								{
								?>
									<?php // Create form and send values in 'shopping/add' function.
                        echo form_open('admin/studentstatus');
                        echo form_hidden('aid', $r->aid);                        
                        ?>
                       <div> 
                        <?php
						if($r->status=='Active')
						{
							
                        $btn = array(
                            'class' => 'btn bg-primary wnm-user',
                            'value' => 'Dactivate',
                            'name' => 'dactvie'
                        );
							// Submit Button.
                        echo form_submit($btn);
						}
						if($r->status=='Dactivate')
						{
							
                       $dbtn = array(
                            'class' => 'btn bg-primary wnm-user',
                            'value' => 'Activate',
                            'name' => 'active'
                        );
                        echo form_submit($dbtn);
						}                        
                        ?>
                        <?php } ?>
                        <?php
                        echo form_close();
						?>
                        
                        </div>
									
								</td>
							</tr>
							
							<?php } } else "<tr><td colspan='4'>No Data Available.</td></tr>"; ?>
							
							
							
							</tbody>
							</table>
						</div>
				<?php
				}?>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT -->
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
jQuery(document).ready(function() {       
   App.init();
   TableEditable.init();
});
</script>

</body>
<!-- END BODY -->
</html>
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
					User List
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/category">
								User
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
								<i class="fa fa-edit"></i>user
							</div>
							
						</div>
				
				
						<div class="portlet-body">
						
						<?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('msg') ?>
		
        </div>
    <?php } ?>  
								<div class="table-toolbar">
								<div class="container">
      <div class="row">
      <div class="col-md-4  toppad  pull-right col-md-offset-3 ">
          
<p class=" text-info" style="font-size: larger;"><?php echo date('d M').','.date('Y').','.date('h:i:s'); ?></p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px;">
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $userview[0]->applicant_name; ?></h3>
            </div>
			
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
				<?php if($userview[0]->profilepic){?>
				<img alt="User Pic" src="<?php echo base_url(); ?>/<?php echo $userview[0]->profilepic; ?>" class="img-circle img-responsive">
				<?php
				 }else{ ?>
				 <img alt="User Pic" src="<?php echo base_url(); ?>adminimage/default.png" class="img-circle img-responsive"> 
				 <?php
				 
				 } ?>
				
				</div>
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Applicant No:</td>
                        <td><?php echo $userview[0]->applicant_no;?> &nbsp;&nbsp;
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
						Registration Date : <?php echo $userview[0]->date;?></td>
                        <td><?php echo $userview[0]->registration_date;?></td>
                      </tr>
                      <tr>
                        <td>Password:</td>
                        <td><?php echo $userview[0]->password;?></td>
                      </tr>
                      <tr>
                        <td>Sponser No:</td>
                        <td><?php echo $userview[0]->sponser_no;?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Sponser Name:</td>
                        <td><?php echo $userview[0]->sponser_name;?></td>
                      </tr>
                        <tr>
                        <td>Proposer No:</td>
                        <td><?php echo $userview[0]->proposer_no;?></td>
                      </tr>
                      <tr>
                        <td>Proposer Name:</td>
                        <td><?php echo $userview[0]->proposer_name;?></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><?php echo $userview[0]->phone_no;?>(Landline)<br><br><?php echo $userview[0]->mobile_no;?>(Mobile)
                        </td>
                           
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Father/Husband Name:</td>
                        <td><?php echo $userview[0]->father_name;?></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Applicant DOB.:</td>
                        <td><?php echo $userview[0]->applicant_dob;?></td>
                      </tr>
					  
					  
					  </tr>
                        <tr>
                        <td>Nominee Name.:</td>
                        <td><?php echo $userview[0]->nomnee_name;?></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Nominee DOB.*:</td>
                        <td><?php echo $userview[0]->nomnee_dob;?></td>
                      </tr>
					  
					  
					  </tr>
                        <tr>
                        <td>Age.*:</td>
                        <td><?php echo $userview[0]->nomnee_age;?></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Relation:</td>
                        <td><?php echo $userview[0]->nomnee_rel;?></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>House No/Loaction:</td>
                        <td><?php echo $userview[0]->location;?></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Tehsil:</td>
                        <td><?php echo $userview[0]->tehsil;?></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Post:</td>
                        <td><?php echo $userview[0]->post;?></td>
                      </tr>
                     
					 <tr>
                        <td>State:</td>
                        <td><?php echo $userview[0]->state_name;?></td>
                      </tr>
					  
					  <tr>
                        <td>District:</td>
                        <td><?php echo $userview[0]->district_name;?></td>
                      </tr>
					 
					 <tr>
                        <td>City:</td>
                        <td><?php echo $userview[0]->city;?></td>
                      </tr>
					 
                     <tr>
                        <td>Pincode:</td>
                        <td><?php echo $userview[0]->pincode;?></td>
                      </tr>

                      <tr>
                        <td>Email Address:</td>
                        <td><?php echo $userview[0]->email;?></td>
                      </tr>
					 
					  
					  <tr>
                        <td>Bank Name:</td>
                        <td><?php echo $userview[0]->bank_name;?></td>
                      </tr>
					  
					  <tr>
                        <td>Branch State:</td>
                        <td><?php echo $userview[0]->bank_branch_state;?></td>
                      </tr>
					  
					  <tr>
                        <td>Branch Name:</td>
                        <td><?php echo $userview[0]->branch_name;?></td>
                      </tr>
					  
					  <tr>
                        <td>Bank A/C No:</td>
                        <td><?php echo $userview[0]->bank_accno;?></td>
                      </tr>
					  
					  <tr>
                        <td>Bank Ifsc No:</td>
                        <td><?php echo $userview[0]->bank_ifsc_code;?></td>
                      </tr>
					  
					  					  <tr>
                        <td>Pan No:</td>
                        <td><?php echo $userview[0]->panno;?></td>
						
                      </tr>
					  					  					  <tr>
                        <td>Opening Balance:</td>
                        <td><?php echo $userview[0]->opening_balance_quantity;?></td>
						
                      </tr>
					  
					  
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="<?php echo base_url();?>admin/edituser/<?php echo $userview[0]->member_id; ?>" title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
								
						</div>
						
						
						
						
						</div>
				
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
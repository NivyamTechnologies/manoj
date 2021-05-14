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
							<a href="#">
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
						
						<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
		
        </div>
        <?php } ?>  
								<div class="table-toolbar">
								<div class="btn-group">
	<form name="serach" action="<?php echo base_url() ?>admin/generatedistributer" method="POST">
						<table>
						<tr>
                        <td style="padding-right: 25px;">
						  <select class="form-control" id="state" name="state">
						  <option value="">Select District</option>
						  <?php foreach($state as $st){ ?>
						  <option value="<?php echo $st['id'];  ?>" ><?php echo $st['city_name'];  ?></option>
						  <?php } ?>
						  </select>
						  </td>
						  <td style="padding-right: 25px;">
						  <select class="form-control" id="bankname" name="bankname">
						  <option value="">Select Bank</option>
						  <?php foreach($bank as $st){ ?>
						  <option value="<?php echo $st['bank_id'];  ?>" ><?php echo $st['bank_name'];  ?></option>
						  <?php } ?>
						  </select>
						  </td>
						  <td style="padding-right: 25px;"><input type='text' class="form-control" id="panno" name="panno" placeholder="Bank Pan No."></td>
						  <td style="padding-right: 25px;"><input type='text' class="form-control" id="apno" name="apno" placeholder="Applicant No."></td>
						  <td style="padding-right: 25px;"><input type='text' class="form-control" id="mob" name="mob" placeholder="Mobile No."></td>
						  
						  <td style="padding-right: 25px;"><input type="submit" class="btn btn-primary" value="search" name="search"/></td>
						  <?php 
                          $kk='';						  
						  if($con)
						  {
						  $kk = '/'.urlencode(base64_encode($con));  
						  }
						  ?>
						  <td><a href="<?php echo base_url(); ?>admin/export_alluser<?php echo $kk; ?>" class="btn btn-primary">Export In Excel</a></td>
                          </tr>
						  
						  </table>
                          </form>
						 	
							</div>								
							</div>

							<div class="row">
							<h4>&nbsp; &nbsp; Total No. of Member &nbsp;<?php echo $num_results;?></h4>
							</div> <br/> <br/>



							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th> S.No.</th>								
								<th>
							    Applicant No
								</th>
												
								<th>
								Password
								</th>								
								<th>
								Applicant Name
								</th>
								<th>
							    Sponser No
								</th>									
								<th>
							    Sponser Name
								</th>
								 <th>
							   Mobile No
								</th>									
								<!--<th>
							    Proposer Name
								</th>
								<th>
							    State
								</th>									
								<th>
							    district
								</th> -->
								<th>
							    View
								</th>
								<th>
							    Action
								</th>									
								
							</tr
							</tr>
							</thead>
							<tbody>
							<?php 
							if(count($alluser)>0) 
							{ 

					        $i=($startcount+1);
					        foreach($alluser as $r)
					        {
								
		
				            ?>
							
							<tr>								
								<td><?php echo $i++;?></td>
								
								<td>
								<?php echo $r->applicant_no;?>
								</td>
                                <td>
								<?php echo $r->password;?>
								</td>
								<td>
								<?php echo $r->applicant_name;?>
								</td>
                                                                	
																
								<td>
								<?php echo $r->sponser_no;?>
								</td>	
								<td>
								<?php echo $r->sponser_name;?>
								</td>	
								<td>
								<?php echo $r->mobile_no;?>
								</td>

								<!-- <td>
								<?php echo $r->proposer_name;?>
								</td>

								<td>
								<?php echo $r->state_name;?>
								</td>

								<td>
								<?php echo $r->district_name;?>
								</td>	 -->							
								<td>
								<a class="btn bg-primary wnm-user" href="<?php echo base_url(); ?>admin/userview/<?php echo $r->member_id; ?>">
								View
							    </a> &nbsp; &nbsp;
							    </td>
							    <td>
							    <?php // Create form and send values in 'shopping/add' function.
                        echo form_open('admin/memberstatus');
                        echo form_hidden('member_id', $r->member_id);                        
                        ?>
                      
                        <?php
						if($r->status=='inActive')
						{
							
                        $btn = array(
                            'class' => 'btn bg-primary wnm-user',
                            'value' => 'Dactive',
                            'name' => 'dactvie'
                        );
							// Submit Button.
                        echo form_submit($btn);
						}
						if($r->status=='inDactive')
						{
							
                       $dbtn = array(
                            'class' => 'btn bg-primary wnm-user',
                            'value' => 'Active',
                            'name' => 'active'
                        );
                        echo form_submit($dbtn);
						}                        
                        ?>
                        
                        <?php
                        echo form_close();
						?>
						</td>
								
								
							</tr>
							
							<?php } } else "<tr><td colspan='4'>No Data Available.</td></tr>"; ?>
							
							
							
							</tbody>
							</table>

							<!--pagination View -->
                    <?php if(strlen($pagination)):?>
                      <div class="pagination pagination-sm">
                      <?php echo $pagination;?>
                      </div>
                    <?php endif;?>


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
   //"aLengthMenu": [20];
   TableEditable.init();
});

</script>
</body>
<!-- END BODY -->
</html>
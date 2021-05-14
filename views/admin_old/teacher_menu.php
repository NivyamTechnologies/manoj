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

					Teacher Detail<small>Detail</small>

					</h3>

					<ul class="page-breadcrumb breadcrumb">

						

						<li>

							<i class="fa fa-home"></i>

							<a href="index.html">

								Teacher Detail

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

								<i class="fa fa-edit"></i>Teacher

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

						<div class="portlet-body">

						

						<?php if ($this->session->flashdata('success')) { ?>

        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>

		

        </div>

    <?php } ?>  

							<div class="table-toolbar">

								<div class="btn-group">

				<?php

				if(($org_role_add==1))

				{

				?>							


			<?php } ?>						

								</div>

								<div class="btn-group pull-right">

									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>

									</button>

									<ul class="dropdown-menu pull-right">

										<!--<li>

											<a href="#">

												 Print

											</a>

										</li>

										<li>

											<a href="#">

												 Save as PDF

											</a>

										</li>-->

										<li>

											<a href="#">

												 Export to Excel

											</a>

										</li>

									</ul>

								</div>

							</div>

							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">

							<thead>

							<tr>

								<th> S.No.</th>

								<th>

									Teacher Id

								</th>
								<th>

									Password

								</th>


								<th>

									 Teacher Name

								</th>

								<th>

									 Coaching Name

								</th>

								<th>

									 Photo

								</th>

								<th>

									 Date of Registration

								</th>

								<th>

									 View

								</th>


								

							</tr>

							</thead>

							<tbody>

							<?php if(count($Allteacher)>0) { 

					$i=1;

					foreach($Allteacher as $r)

					{

						$coaching_name = $r->coaching_name;

						if($coaching_name!='')

						{

							$coachings = $qq=$this->base_model->get_coaching($r->coaching_name);

									

		                        $coachings = $qq[0]['org_name'];

						}

						else{

							$coachings='';

						}

						$dateofregistration = date_create($r->create_date);

						$registration_date = date_format($dateofregistration,"d-M-Y");

				?>

							

							<tr>								

								<td><?php echo $i++;?></td>								

								<td><?php echo $r->Tecid;?></td>
								<td><?php echo $r->password;?> </td>

								<td><?php echo $r->FirstName.'&nbsp;'.$r->LastName;?></td>

								<td>

									<?php echo $coachings; ?>

								</td>

								<td>

									<?php

									  if($r->teacher_image=='')

									  {

									  ?>

         <img src="<?php echo base_url().'assets/img/avatar.png'?>" height="50px;" width="50px;"/>          							<?php }

									  if($r->teacher_image!='')

									  { ?>

		<img src="<?php echo base_url().'teacherimage/'.$r->teacher_image;?>" height="50px;" width="50px;"/>	  

								<?php } ?>

									

								</td>

								<td>

									<?php echo $registration_date;?>

								</td>								

								<td>
								<a href="<?php echo base_url()?>admin/user_menu_manage_sidebar/<?php echo $r->Tecid;?>/<?php echo $r->aid;?>" class="btn bg-primary wnm-user">
                                manage menu
							    </a>
								</td>

								
								
									

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
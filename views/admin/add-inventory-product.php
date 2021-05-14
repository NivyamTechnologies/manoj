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
<title>Mlm Business</title>
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
					Product 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/inventoryproduct">
								product
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
												             
               								
									
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
			<?php echo form_open_multipart('admin/addinventoryproduct/'.$this->uri->segment(3)); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>  
				<?php				
				foreach($viewproductinfo as $userdata)
						{
							$hcn_no = $userdata->hcn_no;
							$batch_no = $userdata->batch_no;
							$manufacturer_date = $userdata->manufacturer_date;
							$expiry_date = $userdata->expiry_date;
							$packaging_size = $userdata->packaging_size;
							$total_taxIGST = $userdata->total_taxIGST;
							$center_taxCGST = $userdata->center_taxCGST;
							$state_taxSGST = $userdata->state_taxSGST;

							$product_code = $userdata->product_code;
							$product_name = $userdata->product_name;
							$product_quantity = $userdata->product_quantity;
							$total_quantity = $userdata->total_quantity;
							$opening_date = $userdata->opening_date;
						
							$tex_rate = $userdata->tex_rate;
							$product_bv = $userdata->product_bv;
							$product_dp = $userdata->product_dp;
							$product_db_taxprice = $userdata->product_db_taxprice;
							$proposer_income = $userdata->proposer_income;
							$product_mrp_price = $userdata->product_mrp_price;
							$categoryid = $userdata->category_id;
							$proid = $userdata->id;
						}
				?>
				                                                   
											<div class="form-body">
												<h3 class="form-section">Product Info</h3>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Category<font color="red">*</font></label>
															<div class="col-md-8">
																	<?php 
		  
		  echo form_dropdown('category',$category,$categoryid,'class="form-control" id="category" required'); ?>
			
																</div>
														</div>
													</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-6">Product Image </label>
															<div class="col-md-6">
														<input type="file" name="product_image" id="exampleInputFile1">
												
															</div>
														</div>
													</div> 

													 </div><br/>

												<div class="row">

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Product HCN No.</label>
															
										<div class="col-md-8">
											<input type="text" name="hcn_no" class="form-control" required id="hcn_no" value="<?php echo $hcn_no;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">Product Batch No.</label>
															
										<div class="col-md-8">
											<input type="text" name="batch_no" class="form-control" required id="batch_no" value="<?php echo $batch_no;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

													 </div> <br/>

													 <div class="row">

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4"> Manufacturer Date</label>
															
										<div class="col-md-8">
											<input type="text" name="manufacturer_date" class="form-control" required id="manufacturer_date" value="<?php echo $manufacturer_date;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">Expiry Date</label>
															
										<div class="col-md-8">
											<input type="text" name="expiry_date" class="form-control" required id="expiry_date" value="<?php echo $expiry_date;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

													 </div> <br/>

													  <div class="row">

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4"> Packaging Size</label>
															
										<div class="col-md-8">
											<input type="text" name="packaging_size" class="form-control" required id="packaging_size" value="<?php echo $packaging_size;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">Total tax IGST</label>
															
										<div class="col-md-8">
											<input type="text" name="total_taxIGST" class="form-control" required id="total_taxIGST" value="<?php echo $total_taxIGST;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

													 </div> <br/>

													 <div class="row">

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4"> Center Tax CGST</label>
															
										<div class="col-md-8">
											<input type="text" name="center_taxCGST" class="form-control" required id="center_taxCGST" value="<?php echo $center_taxCGST;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
									<label class="control-label col-md-4">State tax SGST</label>
															
										<div class="col-md-8">
											<input type="text" name="state_taxSGST" class="form-control" required id="state_taxSGST" value="<?php echo $state_taxSGST;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

													 </div> <br/>													 

													 <div class="row">

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Product Code<font color="red">*</font></label>
															
										<div class="col-md-8">
											<input type="text" name="product_code" class="form-control" required id="product_code" value="<?php echo $product_code;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														

													 </div> <br/>

													 <div class="row">					

									<div class="col-md-6">
											<div class="form-group">
										<label class="control-label col-md-4">Product Name<font color="red">*</font></label>
															
										<div class="col-md-8">
											<input type="text" name="product_name" class="form-control" required id="product_name" value="<?php echo $product_name;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Text Rate<font color="red">*</font></label>
															
										<div class="col-md-8">
											<?php 
		  
		  echo form_dropdown('tex_rate',$tax,$tex_rate,'class="form-control" id="tex_rate" required'); ?>
											
										</div>
									</div>
														</div>
                                                    
                                                    </div><br/>												
													
													<div class="row">													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Product BV<font color="red">*</font></label>
															
										<div class="col-md-8">
											<input type="text" name="product_bv" class="form-control" id="exampleInputEmail1" required value="<?php echo $product_bv;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Product DP Tax Price<font color="red">*</font></label>
															
										<div class="col-md-8">
											<input type="text" name="product_db_taxprice" class="form-control" id="product_db_taxprice" readonly value="<?php echo $product_db_taxprice;?>">
											
										</div>
									</div>
														</div>

														
												</div><br/>
									
													<div class="row">													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Product MRP Price<font color="red">*</font></label>
															
										<div class="col-md-8">
											<input type="text" name="product_mrp_price" class="form-control" id="product_mrp_price" value="<?php echo $product_mrp_price;?>" required placeholder="Enter text">
											
										</div>
									</div>
														</div>

													<div class="col-md-6">
														<div class="form-group">
						<label class="control-label col-md-4">Product DP<font color="red">*</font></label>
															
							<div class="col-md-8">
				<input type="text" name="product_dp" class="form-control" id="exampleInputEmail1" required value="<?php echo $product_dp;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>	

														
												</div><br/>	

												<div class="row">

												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Proposer Income</label>
															
										<div class="col-md-8">
				<input type="text" name="proposer_income" class="form-control" id="proposer_income" value="<?php echo $proposer_income;?>" placeholder="Enter text">
											
										</div>
									</div>
														</div>

													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Opening Quantity</label>
												<?php
												$readonly="readonly";
												$readonlytotal="";
                                                if($proid)
												{
												$readonly="";
                                                $readonlytotal="readonly";												
												}
												?>
										<div class="col-md-8">
				<input type="number" name="total_quantity" class="form-control" id="total_quantity" value="<?php echo $total_quantity;?>" placeholder="Enter text" <?php echo $readonly;  ?>>
				<input type="hidden" name="total_quantity1" class="form-control" id="total_quantity1" value="<?php echo $total_quantity;?>" placeholder="Enter text" readonly>
											
										</div>
									</div>
														</div>	

												</div> <br/>

												<div class="row">
												
												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Total Quantity</label>
															
										<div class="col-md-8">
				<input type="number" name="product_quantity" class="form-control" id="product_quantity" value="<?php echo $product_quantity;?>" placeholder="Enter text" <?php echo $readonlytotal;  ?>>
											
										</div>
									</div>
														</div>

												

														<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Opening Balance Date</label>
															
										<div class="col-md-8">
				<input type="text" name="opening_date" class="form-control" id="opening_date" value="<?php echo $opening_date;?>" readonly>
											
										</div>
									</div>
														</div>

												</div>
												
												<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Product RP</label>
															
										<div class="col-md-8">
				<input type="number" name="product_rp" class="form-control" id="product_rp" value="<?php echo $product_rp;?>" placeholder="Enter text" >
											
										</div>
									</div>
														</div>

												 <br/>
														
											
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
														<?php
													if($this->uri->segment(3)!='')
													{
														?>
															<input type="submit" name="product_update" class="btn green" value="Update"/>
															<?php
													}else{?>
														<input type="submit" name="product_update" class="btn green" value="Submit"/>
														<?php
													}?>
															<a class="btn btn default" href="<?php echo base_url()?>admin/inventoryproduct">Cancel</a>
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
	   $( "#manufacturer_date" ).datepicker({
  // defaultDate: "+1w",
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd",
  // onClose: function( selectedDate ) {
  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
	   $( "#expiry_date" ).datepicker({
  // defaultDate: "+1w",
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd",
  // onClose: function( selectedDate ) {
  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
   $( "#start_date" ).datepicker({
  // defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "dd",
  // onClose: function( selectedDate ) {
  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
   $( "#end_date" ).datepicker({
  // defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "dd",
  // onClose: function( selectedDate ) {
  // $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
  // }
   });
    $( "#opening_date" ).datepicker({
  // defaultDate: "+1w",
   changeYear: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd",
  // onClose: function( selectedDate ) {
  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
   });
</script>
    
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>



	<!DOCTYPE html>
 <html lang="en" class="no-js"> 
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Online CMS</title>
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
<link href="<?php echo base_url().'assets/css/print.css';?>" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo base_url().'assets/css/custom.css';?>" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'?>" />
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
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					ADD Phone No
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/dashboard">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url()?>admin/dashboard">
                            ADD Phone No 
							</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			
			
			<div class="clearfix">
			</div>
			<div class="row">
            <div class="col-12">
  
  <form action="" method="post" accept-charset="utf-8">										
  <?php 
		if ($this->session->flashdata('success1')) 
		{
			$msg=$this->session->flashdata('success1');
			echo '<script type="text/javascript">alert("'.$msg.'");</script>';
         } 
		 ?>                                            
    <div class="form-body">
        <h3 class="form-section">ADD phone No  </h3>
                          
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label class="control-label col-md-8">Distributor Login ID</label>
                    <div class="col-md-10">
                        <input type="text" id="branch_id" name="branch_id" class="form-control" required  onchange="getbranchdata(this.value)" />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-8"> Distributor Name:</label>
                    <div class="col-md-10">
                        <input type="text" name="distributor_name" id="bvmbranchname" class="form-control" placeholder="Enter Name"  readonly autocomplete="off" />
                        
                    </div>
                </div>
            </div>
			
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-8"> Mobile  No:</label>
                    <div class="col-md-10">
                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile No."    />
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-8"></label>
                    <div class="col-md-10">
					
                        <input type="submit" class="btn btn-primary" Value="Add" />
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
  </form>

</div>

				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">

					<!-- BEGIN PORTLET-->

					<!-- END PORTLET-->

					

				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					
				</div>
				<div class="col-md-6 col-sm-6">
					
				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					
				</div>
				<div class="col-md-6 col-sm-6">
				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN REGIONAL STATS PORTLET-->
					
					<!-- END REGIONAL STATS PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					
					<!-- END PORTLET-->
				</div>
			</div>
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					
					<!-- END PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					
					<!-- END PORTLET-->
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>



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
function getbranchdata(str)
{
jQuery.post("<?php echo base_url();  ?>admin/getdataledger", {no: str}, function(result){
	dataArray = jQuery.parseJSON(result);
       if(result=='1')
	   {
	   jQuery("#bvmbranchname").val('');
	   jQuery("#ledgerlimit").val('');
	   alert("Id. not exist");	   
	   }
	   else
	   {
	   if(dataArray[0].dpname!=null)
	   {
	   jQuery("#bvmbranchname").val(dataArray[0].dpname);   
	   }
	   else if(dataArray[0].pucname!=null) 
	   {
	   jQuery("#bvmbranchname").val(dataArray[0].pucname);   
	   }
	   else if(dataArray[0].brname!=null) 
	   {
	   jQuery("#bvmbranchname").val(dataArray[0].brname);   
	   }
	   else if(dataArray[0].membername!=null) 
	   {
	   jQuery("#bvmbranchname").val(dataArray[0].membername);   
	   }
	   else if(dataArray[0].party_name!=null) 
	   {
	   jQuery("#bvmbranchname").val(dataArray[0].party_name);   
	   }
	   //jQuery("#creditlimit").val(dataArray[0].creditlimit);
	   }
    });		
}
</script>
<!-- END CONTAINER -->
<!-- END CONTAINER -->
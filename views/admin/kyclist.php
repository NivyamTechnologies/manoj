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
			<!-- BEGIN STYLE CUSTOMIZER -->
			
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Dashboard 
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
								Dashboard
							</a>
						</li>
						<li class="pull-right">						

								<i class="fa fa-calendar"></i>								

								<?php 

								$date = date_create(date());

							   $todaydate = date_format($date,'d-M-Y');

								echo "Today&nbsp;".$todaydate;?>

						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			
<div class="row">
  <div class="col-12">
  
    <div class="table-toolbar">
    <div class="table-responsive">
        <div class="btn-group">

         <form id="sms_form">
            <table class="table  table-striped table-hover table-bordered">
              <thead>
                <tr>
                    <td>ID No.</td>
                    <td>Name</td>
					<td>Mobile No</td>
					<td>Pan Card</td>
					<td>Aadhar Card</td>
					<td>Action</td>
                </tr>
              </thead>
              <tbody>
              <?php 
              if(!isset($kycusers)){ $kycusers= array(); }
              $totalBonus = 0;
              foreach($kycusers as $kycuser){ ?>
                <tr>
                    <td><?php echo $kycuser->uid;?></td>
                    <td><?php echo $kycuser->applicant_name;?></td>  
					<td><?php echo $kycuser->phone_no;?></td>
					<td><a target="_blank" href="<?php echo base_url('uploads/doc_'.$kycuser->uid.'/'.$kycuser->pancard)?>"><?php echo $kycuser->pancard;?></a></td>
					<td><a target="_blank" href="<?php echo base_url('uploads/doc_'.$kycuser->uid.'/'.$kycuser->aadharcard)?>"><?php echo $kycuser->aadharcard;?></a></td>
					<td><?php echo ($kycuser->approve==1)?'':'<button data-id="'.$kycuser->kid.'" type="button" class="btn btn-primary approve">Approve</button> &nbsp;' ?>
						<button type="button" data-id="<?php echo $kycuser->kid;?>" class="btn btn-danger delete">Delete</button></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </form>
          
        </div>
    </div>
  <div>
</div>
<!--content end here -->			
			
			<div class="clearfix">
			</div>
			<div class="row">
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
	
	<?php echo $pagination; ?>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php require_once('adminfooter.php');?>	

	
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
<script src=<?php echo base_url().'assets/scripts/custom/tasks.js';?> type="text/javascript"></script>

<script src=<?php echo base_url().'assets/plugins/data-tables/jquery.dataTables.min.js';?> type="text/javascript"></script>    
	
     
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Tasks.initDashboardWidget();
		});
	</script>
	<script language="javascript">

 /* --------------------------------------------------------

	Calendar

    -----------------------------------------------------------*/

$(document).ready(function(){
	
		$('#send_sms').click(function(){
			$.post("<?php echo base_url("admin/send_bonus_sms"); ?>", $('#sms_form').serialize())
		});
		$('#process').click(function(){
			$.post("<?php echo base_url("admin/process_bonus"); ?>", $('#sms_form').serialize()).done(function( data ) {
				alert( "Report Processed" );
			});
		});
});
        //Sidebar

        if ($('#sidebar-calendar')[0]) {

            var date = new Date();

            var d = date.getDate();

            var m = date.getMonth();

            var y = date.getFullYear();

            $('#sidebar-calendar').fullCalendar({

                editable: false,							

				events: [
							<?php echo $strapprove;?>		

						],
				
                header: {
                    	left: 'title'
                		},
			});
        }
	
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

<script>
$("#filter_id").change(function(){
  var filter = $(this).val();
    window.location = "<?php echo base_url("distribution/index/"); ?>"+filter+"/<?php echo $month;?>/<?php echo $year;?>";
});

$('.approve').click(function(){
	var $this = $(this);
    var id = $(this).attr('data-id');
  
  if (confirm('Are you sure you want to approve this KYC?')) {
		// Save it!
		$.post("<?php echo base_url("admin/approvekyc"); ?>", {id: id}, function(result){
			$this.remove();
		  });
	} else {
		// Do nothing!
	}
});

$('.delete').click(function(){
	var $this = $(this);
    var id = $(this).attr('data-id');
  
	if (confirm('Are you sure you want to delete this KYC?')) {
		// Save it!
		$.post("<?php echo base_url("admin/deletekyc"); ?>", {id: id}, function(result){
			$this.parents('tr').remove();
		});
	} else {
		// Do nothing!
	}
});
</script>

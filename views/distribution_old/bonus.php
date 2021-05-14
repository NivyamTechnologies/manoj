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
			
<!--content start here -->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="index.html">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Distribution</li>
</ol>
<div class="row">
  <div class="col-12">
  
    <div class="table-toolbar">
        <div class="btn-group">
                  <form name="serach" action="<?php echo base_url('distribution/index/'.$report_filter); ?>" method="POST">
        <table>
        <tbody>
          <tr>
                    <td style="padding-right: 25px;">
                    <select class="form-control user-success" id="month" name="month">
                    <option value="1" <?php echo ($month==1)?'selected':''; ?>>January</option>
                    <option value="2" <?php echo ($month==2)?'selected':''; ?>>February</option>
                    <option value="3" <?php echo ($month==3)?'selected':''; ?>>March</option>
                    <option value="4" <?php echo ($month==4)?'selected':''; ?>>April</option>
                    <option value="5" <?php echo ($month==5)?'selected':''; ?>>May</option>
                    <option value="6" <?php echo ($month==6)?'selected':''; ?>>June</option>
                    <option value="7" <?php echo ($month==7)?'selected':''; ?>>July</option>
                    <option value="8" <?php echo ($month==8)?'selected':''; ?>>August</option>
                    <option value="9" <?php echo ($month==9)?'selected':''; ?>>September</option>
                    <option value="10" <?php echo ($month==10)?'selected':''; ?>>October</option>
                    <option value="11" <?php echo ($month==11)?'selected':''; ?>>November</option>
                    <option value="12" <?php echo ($month==12)?'selected':''; ?>>December</option>
                    </select>
        </td>  
        <td style="padding-right: 25px;">
        <select class="form-control" id="year" name="year">
          <option value="2016" <?php echo ($year==2016)?'selected':''; ?>>2016</option>
          <option value="2017" <?php echo ($year==2017)?'selected':''; ?>>2017</option>
          <option value="2018" <?php echo ($year==2018)?'selected':''; ?>>2018</option>
        </select>
        </td> 
        <td style="padding-right: 25px;"><input type="submit" class="btn btn-primary" value="search" name="search"></td>
        </tr>
          
          </tbody>
          </table>
                      </form>

                      <select class=" user-success" id="filter_id">
                        <option value="" <?php echo ($report_filter == "none")?'selected':''?>>None</option>
                        <option  value="mobile_bonus" <?php echo ($report_filter == "mobile_bonus")?'selected':''?>>Mobile Bonus</option>
                        <option  value="running_bonus" <?php echo ($report_filter == "running_bonus")?'selected':''?>>Running Bonus</option>
						<option  value="royalty_bonus" <?php echo ($report_filter == "royalty_bonus")?'selected':''?>>Royalty Bonus</option>
					    <option  value="leader_bonus" <?php echo ($report_filter == "leader_bonus")?'selected':''?>>LeaderShip Bonus</option>
                        <option  value="tour_bonus" <?php echo ($report_filter == "tour_bonus")?'selected':''?>>Tour Bonus</option>
                        <option  value="car_bonus" <?php echo ($report_filter == "car_bonus")?'selected':''?>>Car Bonus</option>
						<option  value="stop_car_bonus" <?php echo ($report_filter == "stop_car_bonus")?'selected':''?>>stop Car Bonus</option>
					    <option  value="home_bonus" <?php echo ($report_filter == "home_bonus")?'selected':''?>>Home Bonus</option>
                         <option  value="other_bonus" <?php echo ($report_filter == "other_bonus")?'selected':''?>>Other Bonus</option>
                      </select>
                      <?php if(empty($report)){ ?>
                      <input style="margin-left: 25px;" type="button" id="process_report" class="btn btn-primary" value="process" name="Process">
                      <!--input style="margin-left: 25px;" type="button" class="btn btn-primary" name="Process"-->
                      <?php }else{ ?>
                      <input style="margin-left: 25px;" type="button" id="process_report" class="btn btn-primary" value="process" name="Process">
                      <?php } ?>
          </div>	
  
    <div class="table-responsive">
        <div class="btn-group">
           <form name="serach" action="<?php echo base_url('distribution/report_save'); ?>" id="save_report" method="POST">
            <table class="table  table-striped table-hover table-bordered">
              <thead>
                <tr>
                    <td>ID No.</td>
                    <td>Name</td>
                  
                    <td>Total B.V.</td>
                    <td>A Leg B.V.</td>
                  
                    <td>You %</td>
                    <td>You B.V.</td>
                    <td>S.P. B.V.</td>
                    <td>Commission</td>
                  
                </tr>
              </thead>
              <tbody>
              <?php 
              if(!isset($profiles)){ $profiles= array(); }
              foreach($profiles as $profile){ ?>
                <tr>
                    <td><?php echo $profile->applicant_no;?>
                        <input type="hidden" value="<?php echo $profile->applicant_no;?>" name="sponsor_id[]">
                    </td>
                    <td><?php echo $profile->applicant_name;?>
                        <input type="hidden" value="<?php echo $report_filter;?>" name="report_filter">
                    </td>

                    <td><?php echo $profile->overall_total_bv;?></td>
                    <td><?php echo $profile->current_month_bv_a;?></td>
                    <td><?php echo percentage($profile->current_month_bv); ?>%</td>
                    <td><?php echo $profile->current_month_bv;?>
                        <input type="hidden" value="<?php echo $month;?>" name="month">
                        <input type="hidden" value="<?php echo $year;?>" name="year">
                    </td>
                   
                    <td><?php echo $profile->current_month_bv-($profile->current_month_bv_a+$profile->current_month_bv_b+$profile->current_month_bv_c+$profile->current_month_bv_d);?></td>
                   <td>  <input type="number" value="<?php echo (isset($report[$profile->applicant_no]))?$report[$profile->applicant_no][$report_filter]:0;?>" name="commission[]"></td>
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

<script src=<?php echo base_url().'assets/plugins/data-tables/jquery.dataTables.min.js';?> type="text/javascript"></script>    
	
     
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   Index.initJQVMAP(); // init index page's custom scripts
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts		   
		   Index.initMiniCharts();
		   Index.initDashboardDaterange();
		   Index.initIntro();
		   Tasks.initDashboardWidget();
		});
	</script>
	<script language="javascript">

 /* --------------------------------------------------------

	Calendar

    -----------------------------------------------------------*/

$(document).ready(function(){

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
	});
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

$('#process_report').click(function(){
  $('#save_report').submit();
});
</script>

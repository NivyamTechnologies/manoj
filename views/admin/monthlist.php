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
					DP List 
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
							<a href="<?php echo base_url()?>admin/dplist">
								DP LIST
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
  
    <div class="table-toolbar">
        <div class="btn-group">
                  <form name="serach" action="" method="POST">
        <table>
        <tbody>
          <tr> 
                    <td style="padding-right: 25px;">
                    <select class="form-control user-success" id="fmonth" name="fmonth">
                    <option value="1" <?php echo ($fmonth==1)?'selected':''; ?>>January</option>
                    <option value="2" <?php echo ($fmonth==2)?'selected':''; ?>>February</option>
                    <option value="3" <?php echo ($fmonth==3)?'selected':''; ?>>March</option>
                    <option value="4" <?php echo ($fmonth==4)?'selected':''; ?>>April</option>
                    <option value="5" <?php echo ($fmonth==5)?'selected':''; ?>>May</option>
                    <option value="6" <?php echo ($fmonth==6)?'selected':''; ?>>June</option>
                    <option value="7" <?php echo ($fmonth==7)?'selected':''; ?>>July</option>
                    <option value="8" <?php echo ($fmonth==8)?'selected':''; ?>>August</option>
                    <option value="9" <?php echo ($fmonth==9)?'selected':''; ?>>September</option>
                    <option value="10" <?php echo ($fmonth==10)?'selected':''; ?>>October</option>
                    <option value="11" <?php echo ($fmonth==11)?'selected':''; ?>>November</option>
                    <option value="12" <?php echo ($fmonth==12)?'selected':''; ?>>December</option>
                    </select>
        </td>   
        <td style="padding-right: 25px;">
        <select class="form-control" id="fyear" name="fyear">
          <option value="2016" <?php echo ($fyear==2016)?'selected':''; ?>>2016</option>
          <option value="2017" <?php echo ($fyear==2017)?'selected':''; ?>>2017</option>
          <option value="2018" <?php echo ($fyear==2018)?'selected':''; ?>>2018</option>
        </select>
        </td> 
		
                    <td style="padding-right: 25px;">
                    <select class="form-control user-success" id="lmonth" name="lmonth">
                    <option value="1" <?php echo ($lmonth==1)?'selected':''; ?>>January</option>
                    <option value="2" <?php echo ($lmonth==2)?'selected':''; ?>>February</option>
                    <option value="3" <?php echo ($lmonth==3)?'selected':''; ?>>March</option>
                    <option value="4" <?php echo ($lmonth==4)?'selected':''; ?>>April</option>
                    <option value="5" <?php echo ($lmonth==5)?'selected':''; ?>>May</option>
                    <option value="6" <?php echo ($lmonth==6)?'selected':''; ?>>June</option>
                    <option value="7" <?php echo ($lmonth==7)?'selected':''; ?>>July</option>
                    <option value="8" <?php echo ($lmonth==8)?'selected':''; ?>>August</option>
                    <option value="9" <?php echo ($lmonth==9)?'selected':''; ?>>September</option>
                    <option value="10" <?php echo ($lmonth==10)?'selected':''; ?>>October</option>
                    <option value="11" <?php echo ($lmonth==11)?'selected':''; ?>>November</option>
                    <option value="12" <?php echo ($lmonth==12)?'selected':''; ?>>December</option>
                    </select>
        </td>   
        <td style="padding-right: 25px;">
        <select class="form-control" id="lyear" name="lyear">
          <option value="2016" <?php echo ($lyear==2016)?'selected':''; ?>>2016</option>
          <option value="2017" <?php echo ($lyear==2017)?'selected':''; ?>>2017</option>
          <option value="2018" <?php echo ($lyear==2018)?'selected':''; ?>>2018</option>
        </select>
        </td> 
        <td style="padding-right: 25px;"><input type="submit" class="btn btn-primary" value="search" name="search"></td>
        </tr>
          
          </tbody>
          </table>
                      </form>
                      <div class="table-responsive">
        <div class="btn-group">
          
            <table id="myTable" class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                    <td> No.</td>
                    <td>Name</td>
					<td>Jan</td>
					<td>Feb</td>
                    <td>Mar</td>
					<td>Apr</td>
                    <td>May</td>
					<td>June</td>
					<td>July</td>
					<td>Aug</td>
					<td>Sep</td>
					<td>Oct</td>
					<td>Nov</td>
					<td>Dec</td>
                </tr>
              </thead>
              <tbody>
              <?php foreach($monthdplist as $monthdplist){ ?>
                <tr>
                    <td><?php echo $monthdplist->applicant_no;?></td>
                    <td><?php echo $monthdplist->applicant_name;?></td>
					<td><?php echo $monthdplist->Jan;?></td>
					<td><?php echo $monthdplist->Feb;?></td>
					<td><?php echo $monthdplist->Mar;?></td>
					<td><?php echo $monthdplist->Apr;?></td>
					<td><?php echo $monthdplist->May;?></td>
					<td><?php echo $monthdplist->June;?></td>
					<td><?php echo $monthdplist->July;?></td>
					<td><?php echo $monthdplist->Aug;?></td>
					<td><?php echo $monthdplist->Sep;?></td>
					<td><?php echo $monthdplist->Oct;?></td>
					<td><?php echo $monthdplist->Nov;?></td>
					<td><?php echo $monthdplist->Decs;?></td>
                    
					
                    
     
              
                </tr>
                <?php } ?>
                </tbody>
                </table> 
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
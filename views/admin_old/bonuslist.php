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
                  <form name="serach" action="" method="POST">
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
		  <option value="2019" <?php echo ($year==2019)?'selected':''; ?>>2019</option>
        </select>
        </td> 
		
        <td style="padding-right: 25px;"><input type="submit" class="btn btn-primary" value="search" name="search"></td>
        <td style="padding-right: 25px;"><input type="button" class="btn btn-primary" id="send_sms" value="Send SMS"></td>
        <td style="padding-right: 25px;"><input type="button" class="btn btn-primary" id="process" value="Process"></td>
        </tr>
          
          </tbody>
          </table>
                      </form>

                     
                      
          </div>	
  
    <div class="table-responsive">
        <div class="btn-group">

         <form id="sms_form">
			 <input type="hidden" name="month" value="<?php echo $month;?>">
             <input type="hidden" name="year" value="<?php echo $year;?>">
            <table class="table  table-striped table-hover table-bordered">
              <thead>
                <tr>
                    <td>ID No.</td>
                    <td>Name</td>
					<td>Mobile No</td>
					
					<td>RC</td>
					<td>PB</td>
                    <td>MB</td>
					<td>RB</td>
					<td>Royality</td>
					<td>LB</td>
					<td>TB</td>
					<td>CB</td>
					<td>HB</td>
					<td> PC</td>
					<td>BC</td>
					<td>2 %</td>
					<td>OB</td>
					<td>Total</td>
					
					<td>STB</td>
					<td>SCB</td>
					<td>SHB</td>
					<td>SBv</td>
					<td>Balance</td>
					
				
                </tr>
              </thead>
              <tbody>
              <?php 
              if(!isset($bounuslist)){ $bounuslist= array(); }
              foreach($bounuslist as $bounuslist){ ?>
                <tr>
                    <td><?php echo $bounuslist->sponsor_id;?>
                    </td>
                    <td><?php echo $bounuslist->applicant_name;?>
                       <input type="hidden" name="applicant_name[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->applicant_name;?>">
                       <input type="hidden" name="applicant_no[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->sponsor_id;?>">
                       <input type="hidden" name="PreviousBalance[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->PreviousBalance;?>">
                    </td>  
					<td ><?php echo $bounuslist->mobile_no;?>
					<input type="hidden" name="mobile_no[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->mobile_no;?>"></td>
					
					<td><?php echo $bounuslist->none;?></td>
					<td><?php echo $bounuslist->proposer_income;?></td>
                    <td><?php echo $bounuslist->bounus;?></td>
					<td><?php echo $bounuslist->running_bonus;?></td>
					<td><?php echo $bounuslist->royalty_bonus;?></td>
					<td><?php echo $bounuslist->leader_bonus;?></td>
					<td><?php echo $bounuslist->tour_bonus;?></td>
					<td><?php echo $bounuslist->car_bonus;?></td>
					<td><?php echo $bounuslist->home_bonus;?></td>
					<td><?php echo $bounuslist->puc_commision;?></td>
					<td><?php echo $bounuslist->branch_commission;?></td>
					<td><?php echo $bounuslist->leader_commission;?></td>
					<td><?php echo $bounuslist->other_bonus;?></td>
					<?php $total=  $bounuslist->none+$bounuslist->other_bonus+$bounuslist->proposer_income+$bounuslist->bounus+
					$bounuslist->running_bonus+ $bounuslist->royalty_bonus+$bounuslist->leader_bonus+$bounuslist->tour_bonus+
					$bounuslist->car_bonus+$bounuslist->branch_commission+$bounuslist->puc_commision+ $bounuslist->home_bonus+ $bounuslist->leader_commission; ?>
					<td><?php echo $total?>
					<input type="hidden" name="total[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $total;?>"></td>
				
					<td style="color:red;"><?php echo $bounuslist->tour_bonus;?>
					<input type="hidden" name="tour_bonus[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->tour_bonus;?>">
					</td>
					<td style="color:red;"><?php echo $bounuslist->stop_car_bonus;?>
					<input type="hidden" name="stop_car_bonus[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->stop_car_bonus;?>">
					</td>
					<td style="color:red;"><?php echo $bounuslist->home_bonus;?>
					<input type="hidden" name="home_bonus[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $bounuslist->home_bonus;?>">
					</td>
					
					<?php
					if($bounuslist->bv<=0){
						$sbv= $total-$bounuslist->tour_bonus- $bounuslist->stop_car_bonus-$bounuslist->home_bonus;
					}else{	$sbv=0;}
					$Balance =$total-
					$bounuslist->tour_bonus- $bounuslist->stop_car_bonus-$bounuslist->home_bonus-$sbv;
					?>
					<td style="color:red;"><?php echo  $sbv;?>
					<input type="hidden" name="sbv[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $sbv;?>">
					</td>
					<td><?php echo $Balance;?>
					<input type="hidden" name="Balance[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo $Balance;?>"></td>
					<input type="hidden" name="PreviousBalance[<?php echo $bounuslist->sponsor_id;?>]" value="<?php echo  $closing[$bounuslist->sponsor_id];?>"></td>
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

$('#process_report').click(function(){
  $('#save_report').submit();
});
</script>

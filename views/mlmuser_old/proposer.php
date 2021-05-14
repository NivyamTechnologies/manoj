<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
  webshims.setOptions('waitReady', false);
  webshims.setOptions('forms-ext', {types: 'date'});
  webshims.polyfill('forms forms-ext');
</script>
<div class="page-content-wrapper">
<div class="page-content">
						
				  
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
                  
                  
					 <td>Product Name</td>
					 <td>Applicant No</td>
					 <td>Applicant Name</td>
					  <td>Amount</td>
                    

           
                </tr>
              </thead>
              <tbody>
              <?php foreach($proposerdata as $proposerdata){ ?>
                <tr>
                   
					 <td><?php echo $proposerdata->product_name;?></td>
					  <td><?php echo $proposerdata->ApplicantNo;?></td>
					   <td><?php echo $proposerdata->branch_name;?></td>
                      <td><?php echo $proposerdata->amount;?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table> 
			</div>
			
			</div>
			
	
		
		</div>
	</div>
	<!-- END CONTENT -->
</div>		
						
		</div>					
	
</div>
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
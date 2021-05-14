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
			
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			
			<div class="container">
				
				<div class="row" style="padding-bottom: 10px;">
					<form name="serach" action="" method="POST">
						<div class="col-md-4 col-sm-4 col-xs-5">
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
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4">
							 <select class="form-control" id="year" name="year">
								<option value="2016" <?php echo ($year==2016)?'selected':''; ?>>2016</option>
								<option value="2017" <?php echo ($year==2017)?'selected':''; ?>>2017</option>
								<option value="2018" <?php echo ($year==2018)?'selected':''; ?>>2018</option>
							</select>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-3">
							<input type="submit" class="btn btn-primary" value="search" name="search">
						</div>
					</form>
				</div>
			</div>

				
			<div class="row">
				<div class="col-sm-4 col-md-4">
					<div class="row">
						<div style="width: 32%;float: left;padding-bottom: 10px;">
							<div class="user-image">
									<!-- <img src="<?php echo base_url(); ?><?php echo $userview[0]->profilepic;?>" height="70px;" width="70px;"> -->
									<!-- <img  src="<?php echo base_url().'assets/img/logo.png'?>" height="70px;" width="70px;" alt="logo" /> -->
									<img style="margin-top:8px; height: 43px;" src="<?php echo base_url().'assets/img/logo.png'?>" alt="logo" />
							</div>
						</div>
						<div style="width: 66%;float: right;">
							<div class="user-image">
									<h3><?php echo $userview[0]->applicant_name;?></h3>
								 <span class="help-block"> <?php echo $userview[0]->applicant_no;?>
								 &nbsp;&nbsp; Month:-<?php echo $month;?>&nbsp; Year:-<?php echo $year;?>
								 </span>
								 
							</div>
						</div>
					<div class="user-info-block">
                <div class="user-heading">
                   
                </div>
                <ul class="navigation">
                    <!-- <li >
                        <a data-toggle="tab" href="#">
						<img src="<?php echo base_url(); ?><?php echo $userview[0]->profilepic;?>" height="30px;" width="30px;">
                        </a>
                    </li> -->
                    <li class="active">
                        <a data-toggle="tab" href="#settings">
                            <span>Payout</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#email">
                            <span >Transfer   </span>
                        </a>
                    </li>
                   
                </ul>
                <div class="user-body">
                    <div class="tab-content">
                        
                        <div id="settings" class="tab-pane active">
						<table class="table table-borderless">
										
										<tbody>
												<tr>
													<td class="column1">Repurcahge Commission</td>
													<td class="column2"><?php echo $statements[0]->none; ?></td>
												</tr>
											
												<tr>
													<td class="column1">Proposer Income</td>
													<td class="column2"><?php echo  $statements[0]->proposer_income; ?></td>
												</tr>
												<tr>
													<td class="column1">Mobile Bouns</td>
													<td class="column2"><?php echo  $statements[0]->mobile_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">Running Bouns</td>
													<td class="column2"><?php echo  $statements[0]->running_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">Royality Bouns</td>
													<td class="column2"><?php echo  $statements[0]->royalty_bonus; ?></td>
												</tr>
												
												<tr>
													<td class="column1">LeaderShip Bouns</td>
													<td class="column2"><?php echo  $statements[0]->leader_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">Tour Bouns</td>
													<td class="column2"><?php echo  $statements[0]->tour_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">Car Bouns</td>
													<td class="column2"><?php echo  $statements[0]->car_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">Home Bouns</td>
													<td class="column2"><?php echo  $statements[0]->home_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">2% PUC Bouns</td>
													<td class="column2"><?php echo  $statements[0]->leader_commission; ?></td>
												</tr>
												<tr>
													<td class="column1">Branch Bouns</td>
													<td class="column2"><?php echo  $statements[0]->branch_commission; ?></td>
												</tr>
												<tr>
													<td class="column1">Puc Bouns</td>
													<td class="column2"><?php echo  $statements[0]->puc_commision; ?></td>
												</tr>
												<tr>
													<td class="column1">Other Bouns</td>
													<td class="column2"><?php echo  $statements[0]->other_bonus; ?></td>
												</tr>
												
												
												<tr >
										<td class="column1">Total</td>
										<td class="column2"><?php echo  $statements[0]->none+ $statements[0]->running_bonus+  
										$statements[0]->other_bonus+ $statements[0]->car_bonus+$statements[0]->branch_commission+
										 $statements[0]->home_bonus+$statements[0]->tour_bonus+$statements[0]->puc_commision+
										 $statements[0]->leader_bonus+ $statements[0]->royalty_bonus+
										 $statements[0]->proposer_income+ $statements[0]->mobile_bonus+$statements[0]->leader_commission; ?></td>
									</tr>	

										</tbody>
									</table>
                        </div>
                        <div id="email" class="tab-pane">

					<?php	$payouttotal = $statements[0]->none+ $statements[0]->running_bonus+  $statements[0]->branch_commission+
										$statements[0]->other_bonus+ $statements[0]->car_bonus+$statements[0]->puc_commision+
										 $statements[0]->home_bonus+$statements[0]->tour_bonus+
										 $statements[0]->leader_bonus+ $statements[0]->royalty_bonus+
										 $statements[0]->proposer_income+ $statements[0]->mobile_bonus+$statements[0]->leader_commission; ?>
                          	<table class="table">
										
										<tbody>
										<tr>
													<td class="column1">Total Payout</td>
													<td class="column2"><?php echo  $payouttotal; ?></td>
									</tr>	
									
									<tr>
													<td class="column1">Stop Tour Bouns</td>
													<td class="column2"><?php echo  $statements[0]->tour_bonus; ?></td>
												</tr>
												<tr>
													<td class="column1">Stop Car Bouns</td>
													<td class="column2"><?php echo  $statements[0]->stop_car_bonus; ?></td>
												</tr>
												
												<tr>
													<td class="column1">Stop Home Bouns</td>
													<td class="column2"><?php echo  $statements[0]->home_bonus; ?></td>
												</tr>

												
												<?php
												if($selfbv[0]->bv<=0){
													$sbv= $payouttotal-$statements[0]->tour_bonus-$statements[0]->stop_car_bonus- $statements[0]->home_bonus;
												}else{	$sbv=0;
													$Balance =$payouttotal-$statements[0]->tour_bonus-$statements[0]->stop_car_bonus- $statements[0]->home_bonus-$sbv;
												}
												
												?>
												
												<tr>
													<td class="column1">Stop Self Purchasing</td>


													<td style="color:red;"><?php echo  $sbv;?></td>
												</tr> 
												
													<td class="column1">Balance</td>
													<td class="column2"><?php echo  $Balance; ?></td>
												</tr>
												<tr>
													<td class="column1">Previous Balance</td>
													<td class="column2"><?php echo  $prevbal[0]->PreviousBalance; ?></td>
												</tr>
												<?php $total= $Balance+ $userview[0]->opening_balance_quantity ?>
												<tr>
													<td class="column1">Total</td>
													<td class="column2"><?php echo  $total; ?></td>
												</tr>
												<tr>
													<td class="column1">TDS </td>
													<td class="column2"><?php echo  ($total*5)/100; ?></td>
												</tr>
												<tr>
													<td class="column1">Transfer Payment </td>
													<td class="column2"><?php echo  $total-($total*5)/100;  ?></td>
												</tr>
												</tbody>
												</table>
                        </div>
                        <div id="events" class="tab-pane">
                            <h4>Events</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
		

<style>

body {background: #EAEAEA;}
.user-details {position: relative; padding: 0;}
.user-details .user-image {position: relative;  z-index: 1; width: 100%; text-align: center;}
 .user-image img { clear: both; margin: auto; position: relative;}

.user-details .user-info-block {width: 100%; position: absolute; top: 55px; background: rgb(255, 255, 255); z-index: 0; padding-top: 35px;}
 .user-info-block .user-heading {width: 100%; text-align: center; margin: 10px 0 0;}
 .user-info-block .navigation {float: left; background-color: lightgray; width: 100%; margin: 0; padding: 0; list-style: none; border-bottom: 1px solid #428BCA; border-top: 1px solid #428BCA;}
  .navigation li {float: left; margin: 0; padding: 0;}
   .navigation li a {padding: 5px 30px; float: left;}
   .navigation li.active a {background: #428BCA; color: #fff;}
 .user-info-block .user-body {float: left; padding: 5%; width: 90%;}
  .user-body .tab-content > div {float: left; width: 100%;}
  .user-body .tab-content h4 {width: 100%; margin: 10px 0; color: #333;}
</style>

<!-- <style>

/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #5A55A3;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #5A55A3;
  background-image: #5A55A3;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #5A55A3;
}

div.bhoechie-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
}
div.bhoechie-tab div.bhoechie-tab-content:not(.active) {
    display: none;
}
</style> -->
<script>
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css">
<!-- <style>
.w3-display-left {
    position: absolute; 
    top: 45%;
    left: 23%;
    transform: translate(0%,-50%);
    -ms-transform: translate(-0%,-50%);
}
.wrap-table100 {
    display: inline-block;
    width:100%;
}
.w3-black, .w3-hover-black:hover, .w3-black, .w3-hover-black:hover {
    color: #FFF!important;
    background-color: #000!important;
}
.w3-display-right {
    position: absolute;
    top: 45%;
    right: 5%;
    transform: translate(0%,-50%);
    -ms-transform: translate(0%,-50%);
}
</style> -->

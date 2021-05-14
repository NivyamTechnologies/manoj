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
				
				

				
		 <div class="table-responsive">
        <div class="btn-group">
        <style>
table {
 
}


tr:nth-child(even) {
  background-color: lightcyan;
}
</style>
            <table id="myTable" style="border: 2px solid black"  class="table table-striped">
              <thead>
              <tr style="color: whitesmoke;
    background-color: dodgerblue; font-family: cursive;">

				<td  style="border: 2px solid black">Date</td>
                    <td  style="border: 2px solid black">Applicant Id</td>
					<td  style="border: 2px solid black">Particulars</td>
                    <td  style="border: 2px solid black"> Debit</td>
					 <td  style="border: 2px solid black">Credit</td>
                     <td style="border: 2px solid black">Balance</td>
                </tr>
              </thead>
              <tbody> 
              <?php foreach($distributorledger as $distributorledger){ ?>
			  <?php $totolfinal =  $totolfinal+( $distributorledger->total-(isset($distributorledger->payment)  ? $distributorledger->payment : 0));?>
                <tr > 
				<td  style="border: 2px solid black" ><?php echo $distributorledger->date;?></td>
                  <td  style="border: 2px solid black" ><?php echo $distributorledger->applicant_no;?></td>
				  <td style="border: 2px solid black" ><?php echo $distributorledger->narration;?></td>
				    <td style="border: 2px solid black" ><?php echo $distributorledger->payment;?></td>
					 <td style="border: 2px solid black"><?php echo $distributorledger->total;?></td>
                     <td style="border: 2px solid black"> <?php echo $totolfinal; ?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table> 
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

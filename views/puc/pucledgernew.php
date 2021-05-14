
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
					PUc Ledger
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>admin/TotalStock">
								Puc Ledger
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
								<i class="fa fa-edit"></i>Puc Ledger
							</div>
							
						</div>
				
				
						<div class="portlet-body">
						
						<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
		
        </div>
        <?php } ?>  
        					<div class="table-toolbar">
								<div class="btn-group">
	<!--<form name="serach" action="<?php echo base_url() ?>admin/TotalStock" method="POST">
						<table>
						<tr>
						 <td style="padding-right: 25px;">From Date</td> 
						  <td style="padding-right: 25px;"><input type='text' class="form-control" id="from_date" name="from_date" readonly></td>
						  <td style="padding-right: 25px;">To Date</td> 
						  <td style="padding-right: 25px;"><input type='text' class="form-control" id="to_date" name="to_date" readonly></td>
						  
						  <td style="padding-right: 25px;"><input type="submit" class="btn btn-primary" value="search" name="search"/></td>
						  
                          </tr>
						  
						  </table>
                          </form>-->
						 	
							</div>								
							</div>
								
                            <table id="myTable" style="border: 2px solid black"  class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                    <td  style="border: 2px solid black">Date</td>
                    <td  style="border: 2px solid black">Particular Name</td>
                    <td  style="border: 2px solid black">Mode</td>
					<td  style="border: 2px solid black">Bill No</td>
                    <td  style="border: 2px solid black"> Debit</td>
					 <td  style="border: 2px solid black">Credit</td>
                     <td style="border: 2px solid black">Balance</td>
                </tr>
              </thead>
              <tbody>
              <?php foreach($branchledger as $branchledger){ ?>
			  <?php $totolfinal =  $totolfinal+( $branchledger->totaldp-(isset($branchledger->amount)  ? $branchledger->amount : 0));?>
                <tr> 
                    <td  style="border: 2px solid black" ><?php echo date("Y-m-d",strtotime($branchledger->datetime));?></td>
					<td  style="border: 2px solid black" >  <?php echo $branchledger->branch_id;?>/
                     <?php echo $branchledger->branch_name;?>
                     (<?php echo $this->base_model->getpucbranchname($branchledger->createby);?>)</td>
                     <td style="border: 2px solid black" ><?php echo $branchledger->paymentby;?></td>
					<td style="border: 2px solid black" >BVM<?php echo '/'.$branchledger->s_no;?></td>
					<td style="border: 2px solid black" ><?php echo $branchledger->totaldp;?></td>
					 <td style="border: 2px solid black;color:red;"><?php echo $branchledger->amount;?></td>
                     <td style="border: 2px solid black"> <?php echo $totolfinal; ?></td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
						</div>
				
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"/>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
jQuery(document).ready(function() {       
   App.init();
   TableEditable.init();


 $( "#from_date" ).datepicker({
  // defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "dd-mm-yy",
  // onClose: function( selectedDate ) {
  // $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
   $( "#to_date" ).datepicker({
  // defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "dd-mm-yy",
  // onClose: function( selectedDate ) {
  // $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
  // }
   });

});
</script>
</body>
<!-- END BODY -->
</html>
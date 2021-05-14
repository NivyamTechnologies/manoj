
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
					Transaction Recieved
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>branch/addtp">
							Transaction
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
					<?php echo form_open_multipart('branch/addtr'); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>  
				<?php				
				foreach($viewcategoryinfo as $userdata)
						{
							$category_name = $userdata->category_name;
							
						}
				?>
				                                                   
											<div class="form-body">
												<h3 class="form-section">Transaction Info</h3>
												
												<div class="row">
								<div class="col-md-4">
								<div class="form-group">
								<label class="control-label col-md-4">Login ID</label>
                                <div class="col-md-6">
								<input type="text" id="branch_id" name="branch_id" class="form-control" required onchange="getbranchdata(this.value)"/>
								</div>

														</div>
													</div>

						<div class="col-md-4">
						<div class="form-group">
					    <label class="control-label col-md-4">2.Name:</label>
						<div class="col-md-8">
						<input type="text" name="bvmbranchname" id="bvmbranchname" class="form-control" placeholder="Enter Name"  readonly autocomplete="off" />
																
															</div>
														</div>
													</div>

					<div class="col-md-4">
					<div class="form-group">
					<label class="control-label col-md-4">3.Ledger Amount</label>
					<div class="col-md-8">
					<input type="text" name="ledgerlimit" id="ledgerlimit" class="form-control" readonly autocomplete="off" />
					</div>
					</div>
					</div>

  <div class="col-md-4">
									<div class="form-group">
					<label class="control-label col-md-4">Date:</label>
										<div class="col-md-8">
							<input type='text' class="form-control" id="date" name="date" readonly required>									
															</div>
														</div>
													</div> 
						
					</div> <br/>



					<div class="row">
					
                    <div class="col-md-4">
					<div class="form-group">
		            <label class="control-label col-md-4">Payment By</label>
					<div class="col-md-6">
		<?php 
		$paymentby = '';
		if(isset($_POST['paymentby']))
		{
		$paymentby = $_POST['paymentby'];
		}
		else
		{
		$paymentby = $paymentby;
		} 
		$option = array('cash' =>'By Cash');
		echo form_dropdown('paymentby',['Select']+$option,$paymentby,'class="form-control"  onchange="getandshow(this.value)" id="paymentby" required'); ?>										
		</div>
		</div>
		</div>

		<div class="col-md-4" style="display:none" id ='bnk'>
		<div class="form-group">
		<label class="control-label col-md-4">Bank</label>
		<div class="col-md-6">
		<?php 
		$bank = '';
		if(isset($_POST['bank']))
		{
		$bank = $_POST['bank'];
		}
		else
		{
		$bank = $bank;
		} 
		echo form_dropdown('banks',['Select']+$banks,$bankid,'class="form-control" style="display:none" id="bank" required'); ?>	
		</div>
		</div>
		</div>

							<div class="col-md-4" style="display:none" id = 'nar'>
						    <div class="form-group">
					        <label class="control-label col-md-4">Narration</label>
							<div class="col-md-8">
							<input type="text" name="narration" id="narration" class="form-control" style="display:none"/>
					        </div>
							</div>
							</div> 
							</div> 
							<br/>
							<div class="row">
							<div class="col-md-4" style="display:none" id ='amt'>
						    <div class="form-group">
					        <label class="control-label col-md-4">Amount</label>
							<div class="col-md-8">
							<input type="text" name="amount" id="amount" class="form-control" style="display:none"/>
					
																
															</div>
														</div>
													</div> 
							<div class="col-md-4" style="display:none" id="chk">
						    <div class="form-group">
					        <label class="control-label col-md-4">Cheque No.</label>
							<div class="col-md-8">
							<input type="text" name="chequeno" id="chequeno" class="form-control" style="display:none"/>
					
																
															</div>
														</div>
													</div> 

							<div class="col-md-4" style="display:none" id='trans'>
						    <div class="form-group">
					        <label class="control-label col-md-4">Transaction No.</label>
							<div class="col-md-8">
							<input type="text" name="transactionno" id="transactionno" class="form-control" style="display:none"/>
					
																
															</div>
														</div>
													</div>

													</div> <br/>

							
											
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
										
													<input type="submit" name="save" value="Save" class="btn green"/>
													
										
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

	   //jQuery("#creditlimit").val(dataArray[0].creditlimit);
	   }
    });		
}

function getandshow(str)
{
if(str=='cash')
{
$('#nar').show();
$('#amt').show();
$('#trans').hide();
$('#bnk').hide();
$('#chk').hide();
$('#narration').show();
$('#amount').show();
$('#bank').hide();
$('#transactionno').hide(); 
$('#chequeno').hide();
}
else if(str=='bank')
{
$('#nar').show();
$('#amt').show();
$('#trans').hide();
$('#bnk').show();
$('#chk').hide();
$('#narration').show();
$('#amount').show();
$('#bank').show();
$('#transactionno').hide(); 
$('#chequeno').hide();
}
else if(str=='cheque')
{
$('#nar').show();
$('#amt').show();
$('#trans').show();
$('#bnk').hide();
$('#chk').show();
$('#narration').show();
$('#amount').show();
$('#bank').hide();
$('#transactionno').show(); 
$('#chequeno').show();
}
else
{
$('#nar').hide();
$('#amt').hide();
$('#trans').hide();
$('#chk').hide();
$('#bnk').hide();
$('#narration').hide();
$('#amount').hide();
$('#bank').hide();
$('#transactionno').hide(); 
$('#chequeno').hide();
}	
}
</script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"/>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
jQuery(document).ready(function() {       

   $( "#date" ).datepicker({
  // defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   dateFormat: "yy-mm-dd",
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
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
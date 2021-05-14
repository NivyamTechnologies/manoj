
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
					Total Stock List
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>admin/TotalStock">
								Stock
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
								<i class="fa fa-edit"></i>Stock
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
								
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th> S.No.</th>									
								<th>
								Product Name
								</th>
								<th>
							   Opening Balance
								</th>
								<th>
							  Purchase Bill
								</th>
								<th>
							   Sell
								</th>
								<th>
							    Scheme
								</th>
								<th>
							    Balance
								</th>
								<th>
							   	Value
								</th>
                               								
								
							</tr
							</tr>
							</thead>
							<tbody>
							<?php 
							if(count($allstock)>0) 
							{ 
					        $i=1;
					        $scheme_total = 0;
							$total_qty=0;
							 $purchase_total = 0;
							 $sale_total = 0;
					        $bal_total = 0;
					        $proinfo_total = 0;
					        foreach($allstock as $r)
					        {
						
				            ?>
							
							<tr>								
								<td><?php echo $i++;?></td>
								
							
                               <td>
								<?php echo $r->product_name	;?>
								</td>
                                <td>
								<?php echo $r->total_quantity	;
								$total_qty = $total_qty+ $r->total_quantity;
								?>
								</td>
                                <td>
								<?php echo $r->receive	;
									$purchase_total = $purchase_total+ $r->receive;
								?>
								</td>
								<td>
								<?php
								echo  $r->sale+ $r->sale1;
								$sale = $r->sale+ $r->sale1;
								$sale_total = $sale_total+$sale;
								?>
								
								</td>

								<td>
								<?php
								echo  $r->scheme1+ $r->scheme;
								$scheme = $r->scheme1+ $r->scheme;
								$scheme_total = $scheme_total+$scheme;
								?>
								</td>
								<td>
								
								<?php echo $bal = ($r->total_quantity + $r->receive - $sale-$scheme);
									$bal_total = $bal_total+$bal;
								?>
								</td>								
								<td>
								<?php 
                                $proinfo = $this->base_model->productinfo($r->id);
								
								echo $proinfo[0]['product_dp']*$bal;  
								$proinfo_total = $proinfo_total+$proinfo[0]['product_dp']*$bal; 
								?>
							    </td>
								
						<?php
                        echo form_close();
						?>
							</tr>
							<?php } ?>
							
							<tr>								
								<td><?php echo $i++;?></td>
                                <td>Total</td>
                                <td>
								<?php 
									echo $total_qty;
								?></td>
                                <td>
								<?php 
									echo $purchase_total;
								?></td>
								
								<td><?php 
									echo $sale_total;
								?></td>
								<td>
								<?php
								echo  $scheme_total;
								?>
								</td>
								<td>
								
								<?php 
									echo $bal_total;
								?>
								</td>								
								<td>
								<?php 
									echo $proinfo_total;  
								?>
							    </td>
							</tr>
							
							<?php } else "<tr><td colspan='4'>No Data Available.</td></tr>"; ?>

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

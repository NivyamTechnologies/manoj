
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
					Distributor Bill without tax
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							
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
					<?php echo form_open_multipart('puc/adddistchalanwithouttaxIGST/'); ?>
										
										<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>  
								
			
				                                                   
											<div class="form-body">
												<h3 class="form-section">Bill Info</h3>
												
												<div class="row">
								<div class="col-md-4">
								<div class="form-group">
								<label class="control-label col-md-4">Distributor Login ID</label>
                                <div class="col-md-6">
								<input type="text" id="branch_id" name="branch_id" class="form-control" required onchange="getbranchdata(this.value)"/>
								</div>

														</div>
													</div>

						<div class="col-md-4">
									<div class="form-group">
					<label class="control-label col-md-4">Distributor Name:</label>
										<div class="col-md-8">
							<input type="text" name="bvmbranchname" id="bvmbranchname" class="form-control" placeholder="Enter Name"  readonly autocomplete="off" />
																
															</div>
														</div>
													</div>

				
					<!--<input type="text" name="creditlimit" id="creditlimit" class="form-control" readonly autocomplete="off" />-->
					<input type="hidden" name="distributorcommission" id="distributorcommission" class="form-control" readonly autocomplete="off" />
					
					

						<!--<div class="col-md-4">
									<div class="form-group">
					<label class="control-label col-md-4">Date:</label>
										<div class="col-md-8">
							<input type='text' class="form-control" id="date" name="date" readonly required>									
															</div>
														</div>
													</div> -->
													</div> 
													<br/>

													<div class="row">


													<div class="col-md-4">
														<div class="form-group">

		<label class="control-label col-md-4">Transport Name</label>
															
										<div class="col-md-6">
		<?php 
		$transport = '';

		if(isset($_POST['transport']))
		{
			$transport = $_POST['transport'];
		}
		else{

			$transport = $transport;
		} 

		$option = array('localtransport' =>'Local Transport','byhand'=>'By Hand');
		  
		  echo form_dropdown('transport',['Select']+$option,$transport,'class="form-control" id="transport" required'); ?>	
											
										</div>
									</div>
													</div>

                            <div class="col-md-4">
						    <div class="form-group">
					        <label class="control-label col-md-4">Product List</label>
							<div class="col-md-8">
							<input type="text" name="productlist" id="productlist" class="form-control"/>
							<input type="hidden" name="productid" id="productid" class="form-control"/>
					
																
															</div>
														</div>
													</div>
													
							<div class="col-md-4">
						    <div class="form-group">
					        <label class="control-label col-md-4">Add Qty</label>
							<div class="col-md-8">
							<input type="number" name="qty" id="qty" class="form-control" onchange="getaddrow(this.value)"/>
							</div>
							</div>
							</div>
							</div>
							<br/>
											
											<table class="table table-bordered table-hover" id="tab_logic">	
                                            <tr>
											<th>S.No</th>
											<th>P.Name</th>
											<th>Bv</th>
											<th>Dp</th>
											<th>Rp</th>
											<th>Mrp</th>
											<th>Qty</th>
											<th>A.Qty</th>
											<th>Price</th>
											<th>price total</th>
											<th>Total</th>
											<th>Action</th>
											</tr>
			                                </table>
											<table class="table table-bordered table-hover">	
                                            <tr>
											<td>Total BV</td>
											<td><input type="text" readonly name="totalbv" id="totalbv" class="form-control"></td>
											<td>Total DP</td>
											<td><input type="text" readonly name="totaldp" id="totaldp" class="form-control"></td>
                                            <td>Total RP</td>
											<td><input type="text" readonly name="totalrp" id="totalrp" class="form-control"></td>
											<td>Total MRP</td>
											<td><input type="text" readonly name="totalmrp" id="totalmrp" class="form-control"></td>
											<td>Total Price</td>
											<td><input type="text" readonly name="totalprice" id="totalprice" class="form-control"></td>
											<td>Total</td>
											<td><input type="text" readonly name="total" id="total" class="form-control"></td>
											
											</tr>
			                                </table>
											
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
										
													<input type="submit" name="save" value="Save" onclick="return deletebillnew()" class="btn green"/>
													
										
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

<div class="footer">
		<div class="footer-inner">
			Copyright &copy; 
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
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
jQuery.post("<?php echo base_url();  ?>admin/getdistdata", {no: str}, function(result){
	dataArray = jQuery.parseJSON(result);
       if(result=='1')
	   {
	   jQuery("#bvmbranchname").val('');
	   jQuery("#branch_id").val('');
	   alert("Distributor Id. not exist");	   
	   }
	   else if(result=='2'){ 
	    jQuery("#bvmbranchname").val('');
		jQuery("#branch_id").val(''); 
	   alert("Distributor Id is not active");
	   }


	   else if(dataArray[0].status=='inDactive'){ jQuery("#bvmbranchname").val(''); jQuery("#branch_id").val(''); alert("Distributor Id is not active"); }
	   else if(dataArray[0].status=='inDactive'){
		jQuery("#bvmbranchname").val('');
	   jQuery("#branch_id").val('');
	   alert("Distributor Id is  not active");
	   }
	   else
	   {
	   
	   jQuery("#bvmbranchname").val(dataArray[0].applicant_name);
	   //jQuery("#distributorcommission").val(dataArray[0].commisionondistributor);
	   }
    });		
}

  $( function() {
    var availableTags = <?php  echo $allproduct; ?>;
		var i = 1;
    $( "#productlist" ).autocomplete({
      source: availableTags,
	  focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox
					$(this).val(ui.item.label);
				},
				select: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox and hidden field
					$(this).val(ui.item.label);
					$("#productid").val(ui.item.value);
				    $("#qty").val('');
					productid = ui.item.value;
					productname = ui.item.label;
					product_bv = ui.item.product_bv;
                    product_dp = ui.item.product_dp;
                    product_rp = ui.item.product_rp;
					product_mr = ui.item.product_mrp_price;
					
					product_description = ui.item.product_description;
					hcn_no = ui.item.hcn_no;
					batch_no = ui.item.batch_no;
					manufacturer_date = ui.item.manufacturer_date;
					expiry_date = ui.item.expiry_date;
					packaging_size = ui.item.packaging_size;
					product_quantity = ui.item.product_quantity;
					product_taxrate = ui.item.tax_rate;
					product_igst = ui.item.Igst;
				
					k = productid;
	                m = $("#product_id"+productid).val();
					
	 if(typeof m==='undefined')
	 {
	 htmls = "<td>"+i+"</td>";
	 htmls += "<td><input name='product_id[]' id='product_id"+k+"' value='"+k+"' type='hidden' placeholder='Name' class='form-control input-md'/> <input  name='product_name[]' type='text' id='product_name"+k+"' value='"+productname+"' readonly class='form-control input-md'></td>";
	 htmls += "<td><input  name='product_bv[]' type='text' id='product_bv"+k+"' value='"+product_bv+"' readonly class='form-control input-md'></td>";
     htmls += "<td><input  name='product_dp[]' type='text' id='product_dp"+k+"' readonly value='"+product_dp+"' class='form-control input-md'></td>";
     htmls += "<td><input  name='product_rp[]' type='text' id='product_rp"+k+"' readonly value='"+product_rp+"' class='form-control input-md'></td>";
	 htmls += "<td><input  name='product_mr[]' type='text' id='product_mr"+k+"' readonly value='"+product_mr+"' class='form-control input-md'></td>";
	 htmls += '<td><input  name="quantity[]" type="text" id="quantity'+k+'" placeholder="quantity" readonly class="form-control input-md" ></td>';
	 //dscomsn = (product_dp*jQuery("#distributorcommission").val())/100;


     productprice = product_rp;
	 //igst = ((productprice * product_taxrate)/100);
     htmls += "<td><input  name='hcn_no[]' type='hidden' id='hcn_no"+k+ "' value='"+hcn_no+"' readonly class='form-control input-md'><input  name='batch_no[]' type='hidden' id='batch_no"+k+"' value='"+batch_no+"' readonly class='form-control input-md'><input  name='manufacturer_date[]' type='hidden' id='manufacturer_date"+k+"' readonly value='"+manufacturer_date+"' placeholder='quantity' class='form-control input-md'><input  name='expiry_date[]' type='hidden' id='expiry_date"+k+"' readonly value='"+expiry_date+"'  class='form-control input-md'><input  name='packaging_size[]' type='hidden' id='packaging_size"+k+"' readonly value='"+packaging_size+"' class='form-control input-md'><input  name='product_quantity[]' type='text' id='product_quantity"+k+"' readonly value='"+product_quantity+"'  class='form-control input-md'></td>";
	 htmls += "<td><input  name='product_rate[]' type='text' id='product_rate"+k+"' value='"+productprice+"' readonly class='form-control input-md'></td>";
	 htmls += "<td><input  name='product_total[]' type='text' id='product_total"+k+"' readonly class='form-control input-md'></td>";
    

	 htmls += "<td><input  name='taxpricetotal[]' type='text' id='taxpricetotal"+k+"' readonly class='form-control input-md'></td>";
        
	 htmls += "<td><a onclick='deleterow("+i+")'><i class='glyphicon glyphicon-remove-sign'></i></a></td>";	 
	 

     $('#tab_logic').append('<tr id="rowfirst'+i+'">'+htmls+'</tr>');
     i++;
	 }
	 else
	 {

	 }
	 }
    });
  } );
  
  function getaddrow()
  {
  if($("#productid").val()=='')
  {
  alert("Please Select Product First");
  $("#productlist").focus();   
  }
  else if($("#qty").val()=='')
  {
  alert("Please Select Quantity");	
  $("#qty").focus();  
  }
  else
  {
  pid=$("#productid").val();
  rate = $("#product_rate"+pid).val();
  quantity =$("#qty").val();
  if(parseInt(quantity) > parseInt($("#product_quantity"+pid).val()))
  {
  alert("Quntity should less then avl. quantity");	 
  }
  else
  {
  $("#product_total"+pid).val(rate*quantity);
  $("#quantity"+pid).val(quantity);  
  //tax =$("#tax_rate"+pid).val();

  price = $("#product_rate"+pid).val();
  //igst = $("#igst"+pid).val();
  $("#taxpricetotal"+pid).val(Number(price*quantity));  
  
    var sum = 0;
    $("input[name='product_total[]']").each(function() {
    sum += Number($(this).val());
    });
    $("#totalprice").val(sum);
 
    var sum = 0;
    $("input[name='product_bv[]']").each(function() 
	{
	quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totalbv").val(sum);
  
    var sum = 0;
    $("input[name='product_dp[]']").each(function() {
        quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totaldp").val(sum);

	var sum = 0;
    $("input[name='product_mr[]']").each(function() {
        quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totalmrp").val(sum);

    var sum = 0;
    $("input[name='product_rp[]']").each(function() {
        quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totalrp").val(sum);
  
    var sum = 0;
    $("input[name='taxpricetotal[]']").each(function() {
    sum += Number($(this).val());
    });
    $("#total").val(sum);
	
  
  $("#productlist").focus();
  }
  }
  //$("#rowsecond"+i).show();	 
  }
  
  function deleterow(value)
  {
  var txt;
  var r = confirm("Are You Sure");
  if (r == true) 
  {

   $("#rowfirst"+value).remove();
   
  var sum = 0;
    $("input[name='product_total[]']").each(function() {
    sum += Number($(this).val());
    });
	$("#totalprice").val(sum);
	
   
	var sum = 0;
    $("input[name='product_bv[]']").each(function() 
	{
	quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totalbv").val(sum);
    var sum = 0;
    $("input[name='product_dp[]']").each(function() {
        quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totaldp").val(sum);

    var sum = 0;
    $("input[name='product_rp[]']").each(function() {
        quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totalrp").val(sum);

	var sum = 0;
    $("input[name='product_mr[]']").each(function() {
        quan = getid($(this),'#quantity');
    sum += Number($(this).val())*Number($(quan).val());
    });
    $("#totalmrp").val(sum);

    

  
    var sum = 0;
    $("input[name='taxpricetotal[]']").each(function() {
    sum += Number($(this).val());
    });
    $("#total").val(sum);

	
  return true;
  } else 
  {
  return false;
  }   	  
  }
   
     function getid(res,pre)
   {
   quanid = res.attr('id');
   res = quanid.substring(10,20);
   return pre+res;
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

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
					Otp Redeme 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							
							Bill
							
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
					<?php echo form_open_multipart('branch/redemescheme/'); ?>					
					<?php 
					if ($this->session->flashdata('success')) 
					{ 
				    ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
                    </div>
                    <?php 
					} 
					?>  
				    <?php				
				    foreach($viewcategoryinfo as $userdata)
						{
						$category_name = $userdata->category_name;	
						}
				    ?>
				                                                   
											<div class="form-body">
												<h3 class="form-section">Bill Info</h3>
												
												<div class="row">
								<div class="col-md-4">
								<div class="form-group">
								<label class="control-label col-md-4">Otp</label>
                                <div class="col-md-6">
								<input type="text" id="otp" name="otp" class="form-control" required onchange="getbranchdata(this.value)"/>
								</div>

														</div>
													</div>

					

													</div> <br/>
							<br/>
											
											<table class="table table-bordered table-hover" id="tab_logic">	
                                            <tr>
											<th>S.No</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>UserID</th>
											<th>Action</th>
											</tr>
			                                </table>
										
											
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
										
													<input type="submit" name="save" value="Save" onclick="return deletebill()" class="btn green"/>
													
										
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

  $( function() {
    var availableTags = <?php  echo $allproduct; ?>;
		var i = 1;
    $( "#otp" ).autocomplete({
      source: availableTags,
	  focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox
					$(this).val(ui.item.label);
				},
				select: function(event, ui) 
				{
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox and hidden field
					$(this).val(ui.item.label);
					otp = ui.item.value;
					otpvalue = ui.item.label;
					product_name = ui.item.product_name;
					product_id = ui.item.product_id;
					scheme_id = ui.item.scheme_id;
					quantity = ui.item.quantity;
					createby = ui.item.createby;
					apno = ui.item.apno;
					createbyname = ui.item.apno;
					k = product_id;
	  	  var error=0;              
	$("input[name='otp[]']").each(function() {
    if($(this).val()==otp);
	{
	
    error=1;	
	}
    });	
if(error==1)
{
alert("Already in use");
return false;
}	              
					
	 htmls = "<td>"+i+"</td>";
	 htmls += "<td><input name='product_id[]' id='product_id"+k+"' value='"+k+"' type='hidden' placeholder='Name' class='form-control input-md'/> <input  name='product_name[]' type='text' id='product_name"+k+"' value='"+product_name+"' readonly class='form-control input-md'></td>";
	 htmls += '<td><input  name="quantity[]" type="text" id="quantity'+k+'" readonly value="'+quantity+'" class="form-control input-md" ></td>';
	 htmls += '<td><input  name="createbyname[]" type="text" id="createbyname'+k+'" readonly value="'+createbyname+'" class="form-control input-md" ></td>';
	 htmls += "<input  name='otp[]' type='hidden' id='otp"+k+"' readonly value='"+otp+"'  class='form-control input-md'><input  name='scheme_id[]' type='hidden' id='scheme_id"+k+"' value='"+scheme_id+"'  readonly class='form-control input-md'><input  name='createby[]' type='hidden' id='createby"+k+"' readonly value='"+apno+"' class='form-control input-md'>";
	 htmls += "<td><a onclick='deleterow("+i+")'><i class='glyphicon glyphicon-remove-sign'></i></a></td>";	 
	 $('#tab_logic').append('<tr id="rowfirst'+i+'">'+htmls+'</tr>');
     i++;
	 }
    });
  } );
  
 function deleterow(value)
  {
  var txt;
  var r = confirm("Are You Sure");
  if (r == true) 
  {	 
  $("#rowfirst"+value).remove();
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
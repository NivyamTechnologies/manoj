<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>BVM Business</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>assets/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico"/>

 <script src="<?php echo base_url().'assets/scripts/jquery-1.10.1.min.js';?>" type="text/javascript"></script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css"/>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script> 

<script type="text/javascript">
	 $(function() {
	 $( "#applicant_dob" ).datepicker({
   defaultDate: "+1w",
   changeMonth: true,
   numberOfMonths: 1,
   changeYear: true,
   dateFormat: "yy-mm-dd",
   yearRange: '1945:'+(new Date).getFullYear()
  // onClose: function( selectedDate ) {
  // $( "#enddate" ).datepicker( "option", "minDate", selectedDate );
  // }
   });
	});

</script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<?php require_once('adminheader.php');?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<?php require_once('adminsidebar.php');?>
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
					Ledger 
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url('admin/generateledger');?>">
								Ledger
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
											<i class="fa fa-reorder"></i>Ledger Detail
										</div>
										
									</div>
									
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
				
					<form name="registration" id="registration" action="<?php echo base_url();?>admin/addledger" method="POST" enctype="multipart/form-data">
										
	    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
        </div>
        <?php } ?>  

									                                                     
										                                                     
											<div class="form-body">
												<h3 class="form-section">Personal Information Of The Ledger</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
								<label class="control-label col-md-4">1.Party Name</label>
															<div class="col-md-8">

								<input type="text" id="party_name" name="party_name" class="form-control" placeholder="Enter Party Name" autocomplete="off" value="<?php echo $branchdata[0]->party_name; ?>"/>																
															</div>
																
															</div>
														</div>
												
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">2. Firm Name</label>
															<div class="col-md-8">
																<input type="text" name="firm_name" id="firm_name" class="form-control" placeholder="Enter Firm Name"  autocomplete="off" value="<?php echo $branchdata[0]->firm_name; ?>"/>
																
															</div>
														</div>		
														</div>
                                                    </div><br/>

                                                    

												<div class="row">
                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. Select State</label>
															<div class="col-md-8">
															<select class="form-control" id="state" name="state" onchange="getdistrict(this.value)">
						                                    <option value="">Select State</option>
						                                    <?php foreach($state as $st){ ?>
						                                    <option value="<?php echo $st['state_id'];  ?>" <?php if($branchdata[0]->state==$st['state_id']){ ?>selected<?php } ?>><?php echo $st['state_name'];  ?></option>
						                                    <?php } ?>
						                                    </select>	
															</div>
														</div>
													</div>
                                                     <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. City</label>
															<div class="col-md-8">
																<input type="text" id="city" name="city" class="form-control" placeholder="Select city" autocomplete="off" value="<?php echo $branchdata[0]->city;  ?>"/>
																<input type="hidden" name="applicant_no" id="applicant_no"  class="form-control" placeholder="Enter Name" value="<?php echo $branchdata[0]->applicant_no; ?>" autocomplete="off" />
																
															
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>

                                                    <div class="row">
                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5.Select District</label>
															<div class="col-md-8">
															<select class="form-control" id="district" name="district">
						                                    <option value=''>select District</option>
															<option value="<?php echo $branchdata[0]->district;  ?>" selected><?php echo $branchdata[0]->districtname;  ?></option>
						                                    </select>
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">6. Tehsil</label>
															<div class="col-md-8">
																<input type="text" id="tehsil" name="tehsil" class="form-control" placeholder="Enter Tehsil"  autocomplete="off" value="<?php echo $branchdata[0]->tehsil;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    </div><br/>
													
													<div class="row">
                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">7. Pincode</label>
															<div class="col-md-8">
																<input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode"   autocomplete="off" value="<?php echo $branchdata[0]->pincode;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">8. Mobile No.</label>
															<div class="col-md-8">
																<input type="text" id="mobno" name="mobno" class="form-control" placeholder="Enter Mobile" value="<?php echo $branchdata[0]->mobno;  ?>"  autocomplete="off"/>
																
															</div>
														</div>
													</div>
                                                    </div><br/>

                                                    <!-- <div class="row">
                                                   <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">4. Bank Account No.</label>
															<div class="col-md-8">
																<input type="text" id="rentaccno" name="rentaccno" class="form-control" placeholder="Enter Account Number"   autocomplete="off" value="<?php echo $branchdata[0]->rentaccno;  ?>"/>
																
															</div>
														</div>
													</div>
                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">5. IFS Code</label>
															<div class="col-md-8">
																<input type="text" id="rentifsc" name="rentifsc" class="form-control" placeholder="Enter IFS Code"   autocomplete="off" value="<?php echo $branchdata[0]->rentifsc;  ?>"/>
																
															</div>
														</div>		
														
                                                    </div>  
                                                    </div><br/> -->

                                                    <div class="row">
                                                  <!--  <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">3. Name of the Bank</label>
															<div class="col-md-8">
															<select class="form-control" id="rentbankname" name="rentbankname">
						                                    <option value="">Select bank</option>
						                                    <?php foreach($bank as $st){ ?>
						                                    <option value="<?php echo $st['id'];  ?>" <?php if($st['id']==$branchdata[0]->rentbankname){ ?>selected<?php } ?>><?php echo $st['bank_name'];  ?></option>
						                                    <?php } ?>
						                                    </select>
															</div>
														</div>		
														</div> -->

                                                    <div class="col-md-6">
														<div class="form-group">
										<label class="control-label col-md-4">9.Opening Balance</label>

															<div class="col-md-8">

				<input type="text" id="opening_balance" name="opening_balance" class="form-control" placeholder="Enter Opening Balance" value="<?php echo $branchdata[0]->opening_balance;?>"/>

															</div>
														</div>
                                                    </div>
                                                    </div><br/>

                                                   <!--  <div class="row">
                                                     <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Land Photo</label>
															<div class="col-md-8">
																<input type="file" id="land_photo" name="land_photo" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">ID Proof</label>
															<div class="col-md-8">
																<input type="file" id="addressproofdoc" name="addressproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>

                                                    </div> <br/> -->

                                                   <!-- <div class="row">
                                                  <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Address Proof</label>
															<div class="col-md-8">

				<input type="file" id="addressproofdoc" name="addressproofdoc" class="form-control"/>

															</div>
														</div>
                                                    </div>

                                                    <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Income Proof</label>
															<div class="col-md-8">
																<input type="file" id="incomeproofdoc" name="incomeproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>
                                                    </div><br/> -->

                                                    <!-- <div class="row">
                                                     <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-4">Bank Details</label>
															<div class="col-md-8">
																<input type="file" id="bankdetailproofdoc" name="bankdetailproofdoc" class="form-control"/>
															</div>
														</div>
                                                    </div>
                                                    <div class="col-md-6">
														<div class="form-group">

					<label class="control-label col-md-4">Rent Agreemnt Submit</label>

											<div class="col-md-8">

			<input type="file" id="bankdetailproofdoc" name="bankdetailproofdoc" class="form-control"/>

											</div> 

														</div>
                                                    </div>
                                                    </div> <br/> -->
                                                						
                                             

											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
														<?php if($update=='true'){  ?>
														<input type="submit" class="btn green" value="UPDATE" name="update"/> &nbsp;
														&nbsp; <a class="btn btn default" href="<?php echo base_url()?>admin/generateledger">Cancel</a>
														<?php } else{ ?>
									                    <input type="submit" class="btn green"  value="SAVE" name="save"/>
									                    &nbsp;&nbsp; <a class="btn btn default" href="<?php echo base_url()?>admin/generateledger">Cancel</a>
														<?php } ?>
													
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										</form>
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

<?php require_once('adminfooter.php');?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url()?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url()?>assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url()?>assets/scripts/core/app.js"></script>
<script src="<?php echo base_url()?>assets/scripts/custom/table-editable.js"></script>
<script>
jQuery(document).ready(function() {       
   App.init();
   TableEditable.init();
});</script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>

function getdistrict(str)
{
jQuery.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
	    res = result.split('--#--');
        jQuery("#district").html(res[1]);
		//jQuery("#city").html(res[1]);
    });	
}

function getdistrictnew(str)
{
jQuery.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
	    res = result.split('--#--');
        jQuery("#bvmpuc_dist").html(res[1]);
		//jQuery("#city").html(res[1]);
    });	
}

function getsn(str)
{
jQuery.post("<?php echo base_url();  ?>admin/getspnoalldata", {no: str}, function(result){
	dataArray = jQuery.parseJSON(result);
       if(result=='1')
	   {
	   jQuery("#applicant_name").val('');
	   jQuery("#father_name").val('');
	   jQuery("#applicant_dob").val('');
	   jQuery("#email").val('');
	   jQuery("#state_name").val('');
	   jQuery("#district_name").val('');
	   jQuery("#tehsil").val('');
	   jQuery("#city").val('');
	   jQuery("#pincode").val('');
	   jQuery("#mobile_no").val('');
	   jQuery("#bank_accno").val('');
	   jQuery("#bank_ifsc_code").val('');
	   jQuery("#bank_name").val('');
	   jQuery("#panno").val('');
	   alert("Distributor Id. not exist");	   
	   }
	   else
	   {
	   
	   jQuery("#applicant_name").val(dataArray[0].applicant_name);
	   jQuery("#father_name").val(dataArray[0].father_name);
	   jQuery("#applicant_dob").val(dataArray[0].applicant_dob);
	   jQuery("#email").val(dataArray[0].email);
	   jQuery("#state_name").val(dataArray[0].state_name);
	   jQuery("#district_name").val(dataArray[0].district_name);
	   jQuery("#tehsil").val(dataArray[0].tehsil);
	   jQuery("#city").val(dataArray[0].city);
	   jQuery("#pincode").val(dataArray[0].pincode);
	   jQuery("#mobile_no").val(dataArray[0].mobile_no);
	   jQuery("#bank_accno").val(dataArray[0].bank_accno);
	   jQuery("#bank_ifsc_code").val(dataArray[0].bank_ifsc_code);
	   jQuery("#bank_name").val(dataArray[0].bank_name);
	   jQuery("#panno").val(dataArray[0].panno);
	   }
    });		
}
</script>
<script src="<?php echo base_url();?>assets/plugins/jquery.validate.min.js" type="text/javascript"></script>


<script>
$.noConflict();
jQuery(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery("form[name='registration']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side 
      distributor_id: "required",
	  bvmbranchname: "required",
	  //idproofdoc: "required",
	  //addressproofdoc: "required",
	 // incomeproofdoc: "required",
	 // bankdetailproofdoc: "required",
      address: "required",
	  landmark: "required",
	  state: "required",
	  district: "required",
	  city: "required",
	  pincode: "required",
	  rentfixed: "required",
	  securitydeposit: "required",
	  creditlimit: "required",
	  commisiononpuc: "required",
	  commisionondistributor: "required",
	  nearesrdepo: "required",
	  nearestbranch: "required",
	  gstno: "required",
	  rentlandloard: "required",
	  rentfathername:"required",
	  rentbankname: "required",
	  rentaccno: "required",
	  rentifsc: "required",
	  
	  bvmpuc_distributor: "required",
	  bvmpuc_aplicantno: "required",
	  bvmpuc_state: "required",
	  bvmpuc_city: "required",
	  bvmpuc_dist: "required",
	  
	  bvmpuc_gurntamount: "required",
	  bvmpuc_leadercommision:"required",
	  bvmpuc_submitid: "required",
	  bvmpuc_agreement: "required",
	  witness_name1: "required",
	  witness_name2: "required",
	  witness_submitby1: "required",
	  witness_submitby2: "required",
	  bvmpuc_mobno:{
	  required: true,
      minlength:9,
      maxlength:10,
      number: true
      },
	  mobno:{
	  required:true,
      minlength:9,
      maxlength:10,
      number: true
      },
	  bvmpuc_email: {
		required:true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
      distributor_id: "Please enter your distributor No.",
	  //idproofdoc: "Please select file.",
	  //addressproofdoc: "Please select file.",
	 // incomeproofdoc: "Please select file.",
	  //bankdetailproofdoc: "Please select file.",
	  bvmbranchname: "Please enter Branch Name.",
      address: "Please enter your Address.",
	  landmark: "Please enter Landmark",
	  state: "Select  your state.",
	  
      district: "Select your district Name.",
      city: "Please enter your city Name.",
	  pincode: "Please enter your Nominee Name.",
	  rentfixed: "Please enter your Rent.",
	  securitydeposit: "Please enter security deposit.",
	  
	  creditlimit: "Please enter credit limit.",
	  commisiononpuc: "Please enter commisionon puc.",
	  commisionondistributor: "Please enter commisionon distributor.",
	  nearesrdepo: "Please enter Nearest depo Name.",
	  nearestbranch: "Please enter Nearest branch.",
	  gstno: "Please enter GST No.",
	    
      rentlandloard: "Please enter Landloard Name.",
      rentfathername: "Please enter Name.",
	  rentbankname: "Please enter Bank Name.",
	  rentaccno: "Please enter rent accno.",
	  
	  rentifsc: "Please enter Ifsc code.",
      bvmpuc_distributor: "Please enter distributor Name.",
	  bvmpuc_aplicantno: "Please enter Applicant Name.",
	  bvmpuc_state: "Please enter State.",
	  
	  
	  bvmpuc_city: "Please enter City.",
      bvmpuc_dist: "Please enter district.",
	  bvmpuc_gurntamount: "Please enter Amount.",
	  bvmpuc_leadercommision: "Please enter Leadercommision.",
	  
	  bvmpuc_submitid: "Please enter Id.",
      bvmpuc_agreement: "Please enter agreement.",
	  witness_name1: "Please enter witness name.",
	  witness_name2: "Please enter second witness name.",
	  witness_submitby1: "Please enter submit by.",
	  witness_submitby2: "Please enter submit by.",

	  mobno: "Please enter valid Mobile no.",
	  mobileno: "Please enter valid Second Mobile no.",
	  
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
      },

    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid

    submitHandler: function(form) 
	{
	 jQuery.post("<?php echo base_url(); ?>admin/addbranch", jQuery("#registration").serialize(), function(data) {
     alert(data);
	 window.location.href = "<?php echo base_url(); ?>admin/generatebranch";
    });
    }
  });
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
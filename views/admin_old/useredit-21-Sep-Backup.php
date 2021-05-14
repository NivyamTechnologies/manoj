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
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/select2/select2-metronic.css"/>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/data-tables/DT_bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url()?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url()?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php echo base_url()?>favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<?php include_once('adminheader.php'); ?>
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
					User List
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url()?>admin/category">
								User
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
								<i class="fa fa-edit"></i>user
							</div>
							
						</div>
				
				
						<div class="portlet-body">
						
						<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
		
        </div>
    <?php } ?>  
	
	<form class="form-horizontal" action="<?php echo base_url(); ?>admin/edituser" name="registration" method="POST" onsubmit = "return checkmobno(<?php echo $userview[0]->mobile_no;?>)" enctype='multipart/form-data'>
								<div class="table-toolbar">
	
	<div class="container">
      <div class="row">
      <div class="col-md-4  toppad  pull-right col-md-offset-3 ">
          
<p class=" text-info" style="font-size: larger;"><?php echo date('d M').','.date('Y').','.date('h:i:s'); ?></p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px;">
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $userview[0]->applicant_name; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
				<?php if($userview[0]->profilepic){?>
				<img alt="User Pic" src="<?php echo base_url(); ?>/<?php echo $userview[0]->profilepic; ?>" class="img-circle img-responsive">
				<?php
				 }else{ ?>
				 <img alt="User Pic" src="<?php echo base_url(); ?>adminimage/default.png" class="img-circle img-responsive"> 
				 <?php
				 
				 } ?></div>
               
						
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
					
                      <tr>
                        <td>Applicant No:</td>
                        <td><?php echo $userview[0]->applicant_no;?>
						<input type="hidden" class="form-control" id="applicant_no" name="applicant_no" value="<?php echo $userview[0]->applicant_no;?>" placeholder="Applicant Name.">
						<input type="hidden" class="form-control" id="member_id" name="member_id" value="<?php echo $userview[0]->member_id;?>" placeholder="Applicant Name.">
						
						</td>
                      </tr>
					  <tr>
                        <td>Profile Pic:</td>
                        <td>
						 <input type="file" class="form-control" id="image" name="image" >
						</td>
                      </tr>
					  <tr>
                        <td>Applicant Name:</td>
                        <td><input type="text" class="form-control" id="applicantname" name="applicantname" value="<?php echo $userview[0]->applicant_name;?>" placeholder="Applicant Name."></td>
                      </tr>
                      
                     
                      <tr>
                        <td>Sponser No:</td>
                        <td><input type="text" class="form-control" id="sponsorno" name ="sponsorno" value="<?php echo $userview[0]->sponser_no;?>" onchange="getsn(this.value)" placeholder="Sponsor No."></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Sponser Name:</td>
                        <td><input type="text" class="form-control" id="sponsorname" name="sponsorname" value="<?php echo $userview[0]->sponser_name;?>" readonly placeholder="Sponsor Name."></td>
                      </tr>
                        <tr>
                        <td>Proposer No:</td>
                        <td><input type="text" class="form-control" id="proposerno" name="proposerno" value="<?php echo $userview[0]->proposer_no;?>" onchange="getppn(this.value)" placeholder="Proposer No."></td>
                      </tr>
                      <tr>
                        <td>Proposer Name:</td>
                        <td><input type="text" class="form-control" id="proposername" name="proposername" value="<?php echo $userview[0]->proposer_name;?>" readonly placeholder="Proposer Name."></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><input type='text' class="form-control" id="othermobileno" value="<?php echo $userview[0]->phone_no;?>" name="othermobileno" placeholder="Other mobile No.">(Landline)<br><br><input type='checkbox' id="checkmob" value='1'  name="checkmob" <?php if($userview[0]->checkmob==1){ ?>checked<?php } ?>><br><br><input type='text' class="form-control" id="mobileno" value="<?php echo $userview[0]->mobile_no;?>"  name="mobileno" placeholder="Mobile No.">(Mobile)
                        </td>
                           
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Father/Husband Name:</td>
                        <td><input type="text" class="form-control" id="fhname" name="fhname" value="<?php echo $userview[0]->father_name;?>" placeholder="Father/Husband Name."></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Applicant DOB.:</td>
                        <td>
						<?php $apdob=explode('-',$userview[0]->applicant_dob);?>
						<select class="form-control" id="applicantdobdate" name="applicantdobdate" style="width:90px;float: left; margin-right: 5px;">
						  <option value="">Date</option>
						  <?php 
						  for($i=1;$i<=31;$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>" <?php if($apdob[2]==$i){ ?>selected<?php } ?>><?php echo $i; ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
						  <select class="form-control" id="applicantdobmonth" name="applicantdobmonth" style="width:90px;float: left; margin-right: 5px;">
						  <option value="">Month</option>
						  <?php 
						  for($i=1;$i<=12;$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>" <?php if($apdob[1]==$i){ ?>selected<?php } ?>><?php echo date('F', mktime(0, 0, 0, $i, 15)); ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
						  <select class="form-control" id="applicantdobyear" name="applicantdobyear" style="width:100px;">
						  <option value="">Year</option>
						  <?php 
						  for($i=1940;$i<=date('Y');$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>" <?php if($apdob[0]==$i){ ?>selected<?php } ?>><?php echo $i; ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
						</td>
                      </tr>
					  
					  
					  </tr>
                        <tr>
                        <td>Nominee Name.:</td>
                        <td><input type="text" class="form-control" id="nomineename" name="nomineename" value="<?php echo $userview[0]->nomnee_name;?>" placeholder="Nominee Name."></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Nominee DOB.*:</td>
                        <td> 
						<?php $nomdob=explode('-',$userview[0]->nomnee_dob);?>
						<select class="form-control" id="nomineedobdate" name="nomineedobdate" style="width:90px;float: left; margin-right: 5px;">
						  <option value="">Date</option>
						  <?php 
						  for($i=1;$i<=31;$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>" <?php if($nomdob[2]==$i){?>selected<?php }?>><?php echo $i; ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
						  <select class="form-control" id="nomineedobmonth" name="nomineedobmonth" style="width:90px;float: left; margin-right: 5px;">
						  <option value="">Month</option>
						  <?php 
						  for($i=1;$i<=12;$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>" <?php if($nomdob[1]==$i){?>selected<?php }?>><?php echo date('F', mktime(0, 0, 0, $i, 15)); ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
						  <select class="form-control" id="nomineedobyear" name="nomineedobyear" onblur="agecal(this.value)" style="width:100px;">
						  <option value="">Year</option>
						  <?php 
						  for($i=1940;$i<=date('Y');$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>" <?php if($nomdob[0]==$i){?>selected<?php }?>><?php echo $i; ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
						</td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Age.:</td>
                        <td> <input type="text" class="form-control" id="age" name="age" value="<?php echo $userview[0]->nomnee_age;?>" placeholder="Age." readonly></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Relation:</td>
                        <td><input type="text" class="form-control" id="relation" name="relation" value="<?php echo $userview[0]->nomnee_rel;?>" placeholder="Relation."></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>House No/Loaction:</td>
                        <td><input type="text" class="form-control" id="holoc" name="holoc" value="<?php echo $userview[0]->location;?>"  placeholder="House No/Loaction."></td>
                      </tr>
					  
					  </tr>
					  
					  <tr>
                        <td>State:</td>
                        <td>
						<select class="form-control" id="state" name="state" onchange="getdistrict(this.value)">
						  <option value="">Select State</option>
						  <?php foreach($state as $st){ ?>
						  <option value="<?php echo $st['state_id'];  ?>" <?php if($userview[0]->state_id==$st['state_id']) {?> selected <?php } ?>><?php echo $st['state_name'];  ?></option>
						  <?php } ?>
						  </select></td>
                      </tr>
					  
					   <tr>
                        <td>District:</td>
                        <td>
						<select class="form-control" id="district" name="district">
						  <option value="">Select District</option>
						
						  <option value="<?php echo $userview[0]->district_id;  ?>" selected ><?php echo $userview[0]->district_name;  ?></option>
						  
						  </select></td>
                      </tr>
                        <tr>
                        <td>Tehsil:</td>
                        <td><input type='text' class="form-control" id="tehsil" value="<?php echo $userview[0]->tehsil;?>" name="tehsil" placeholder="Tehsil."></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Post:</td>
                        <td><input type='text' class="form-control" id="post" value="<?php echo $userview[0]->post;?>" name="post" placeholder="Post."></td>
                      </tr>
                     
					 <tr>
                        <td>City:</td>
                        <td><input type='text' class="form-control" id="city" name="city" value="<?php echo $userview[0]->city;?>" placeholder="City."></td>
                      </tr>
					 
                     <tr>
                        <td>Pincode:</td>
                        <td><input type='text' class="form-control" id="pincode" name="pincode" value="<?php echo $userview[0]->pincode;?>" placeholder="Pincode."></td>
                      </tr>

                      <tr>
                        <td>Email Address:</td>
                        <td><input type='text' class="form-control" id="email" name="email" value="<?php echo $userview[0]->email;?>" placeholder="Email Address."></td>
                      </tr>
					  
					  
					  <tr>
                        <td>Bank Name:</td>
                        <td>
						<select class="form-control" id="bankname" name="bankname">
						   <option value="">Select Bank</option>
						  <?php foreach($bank as $st){ ?>
						  <option value="<?php echo $st['bank_id'];  ?>" <?php if($userview[0]->bank_name==$st['bank_id']) {?> selected <?php } ?>><?php echo $st['bank_name'];  ?></option>
						  <?php } ?>
						  </select>
						</td>
                      </tr>
					  
					  <tr>
                        <td>Branch Name:</td>
                        <td>
						<select class="form-control" id="bankbranchstate" name="bankbranchstate">
						  <option value="">Select Bank Branch State</option>
						  <?php foreach($state as $st){ ?>
						  <option value="<?php echo $st['state_id'];  ?>" <?php if($userview[0]->branchstateid==$st['state_id']) {?> selected <?php } ?>><?php echo $st['state_name'];  ?></option>
						  <?php } ?>
						  </select></td>
                      </tr>
					  
					  <tr>
                        <td>Branch Name:</td>
                        <td><input type="text" class="form-control" id="branchname" name="branchname" value="<?php echo $userview[0]->branch_name;?>" placeholder="Branch Name."></td>
                      </tr>
					  
					  <tr>
                        <td>Bank A/C No:</td>
                        <td><input type='text' class="form-control" id="acno" name="acno" value="<?php echo $userview[0]->bank_accno;?>" placeholder="Bank A/C No."></td>
                      </tr>
					  
					  <tr>
                        <td>Bank ifsc No:</td>
                        <td><input type='text' class="form-control" id="ifsccode" name="ifsccode" value="<?php echo $userview[0]->bank_ifsc_code;?>" placeholder="Bank Ifsc Code."> </td>
                      </tr>
					  <tr>
                        <td>Pan No:</td>
                        <td><input type='text' class="form-control" id="panno" name="panno" value="<?php echo $userview[0]->panno;?>" placeholder="Bank Pan No."></td>
                      </tr>

					  <tr>
                        <td><input type="submit" class="btn btn-primary" value="Edit User"  name="update"/></td>
                       
                      </tr>
					  
                    </tbody>
                  </table>
                  </form>                  
				</div>
              </div>
            </div>
                 <div class="panel-footer">
                        
                    </div>
            
          </div>
        </div>
      </div>
    </div>
								
						</div>
						
					<script>

function getdistrict(str)
{
jQuery.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
        jQuery("#district").html(result);
    });	
}

function agecal(str)
{
dob = new Date(str);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
jQuery('#age').val(age);
}

function getsn(str)
{

jQuery.post("<?php echo base_url();  ?>login/getspno", {no: str}, function(result){
       if(result==1)
	   {
	   jQuery("#sponsorname").val('');	
	   alert("sponsor no. not exist");	   
	   }
	   else
	   {
	   jQuery("#sponsorname").val(result);	   
	   }
    });		
}

function getppn(str)
{
jQuery.post("<?php echo base_url();  ?>login/getspno", {no: str}, function(result){
	
       if(result==1)
	   {
	   jQuery("#proposername").val('');	
	   alert("proposer no. not exist");	   
	   }
	   else
	   {
	   jQuery("#proposername").val(result);	   
	   }
    });		
}

function checkmobno(exitingmob)
{
str = $("#mobileno").val();	
$.ajaxSetup({async: false});
jQuery.post("<?php echo base_url();  ?>login/getmobno", {no: str}, function(result){
       if(result==1)
	   {
       var kk = 2;	   
	   }
	   else if($("#checkmob").is(':checked'))
	   {
	   var kk = 2;	   
	   }
	   else if(str == exitingmob)
	   {
	   var kk = 2;	   
	   }
	   else  
	   {
	   //jQuery("#proposername").val(result);	
	   var kk = 1;
	   alert("Mobile no. already exist. if you want to save forcefully please check checkox");   	    
	   }
	   mm=kk;
    });	
if(mm==2)
{
ll=  true;	
}
else{
ll=  false;
}
return ll;
}
</script>	
						
	
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
<script>



jQuery(document).ready(function() {       
   App.init();
   TableEditable.init();
});




</script>
				
	
</body>
<!-- END BODY -->
</html>
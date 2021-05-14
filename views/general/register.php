<!DOCTYPE html>
<html lang="en">
	
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Assuredness</title>

		<!-- Bootstrap -->
		<link href="<?php echo base_url();?>assets/new/css/bootstrap.min.css" rel="stylesheet">

		<!-- Google Web Fonts -->


	

		<!-- Template CSS Files  -->
    <link href="<?php echo base_url();?>assets/new/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/new/css/loader.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/new/js/plugins/camera/css/camera.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/new/js/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/new/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/new/css/responsive.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->


		<link rel="shortcut icon" href="<?php echo base_url();?>assets/new/images/fav.html">
		
	</head>
	<body>
	<!-- Pre Loader Starts -->
		
	<!-- Pre Loader Ends -->
	<!-- Header Starts -->
		<header id="main-header" class="main-header">
		<!-- Slider Starts -->
	
			<div id="slider" class="slider clearfix">
				<div id="camera_wrap_1" class="camera_wrap camera_white_skin camera_emboss pattern_10 text-center">
				
				</div>
			</div>	
     
		<!-- Slider Ends -->
		<!-- Header Top Bar Starts -->
			<div class="top-bar">
			<!-- Nested Container Starts -->
				<div class="container">
				<?php
                  if($this->session->flashdata('error')){
                    ?>
                    <div class="alert alert-danger">
                    <button class="close" data-dismiss="alert"></button>
                      <?php echo $this->session->flashdata('error'); ?>
                    </div>
                  <?php
                  }
                  ?>
                          <?php
                  if ($this->session->flashdata('success')) {
                    ?>
                    <div class="alert alert-success">           
                                  <button class="close" data-dismiss="alert"></button>
                      <?php echo $this->session->flashdata('success'); ?>
                    </div>
                  <?php
                  }
                  ?>
				</div>
			<!-- Nested Container Ends -->
			</div>
		<!-- Header Top Bar Ends -->
		<!-- Main Menu Starts -->

			<div id="main-menu-wrap">
				<div id="main-menu">
				<!-- Nested Container Starts -->
					<div class="container">
					<!-- Navbar Starts -->
						<nav id="nav" class="navbar navbar-default">
						<!-- Navbar Header Starts -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a href="#slider" class=""><img style="height:66px" src="<?php echo base_url();?>assets/new/images/logo.png " >
                <span class="mid"></span><br>
									
								</a>
							</div>
						<!-- Navbar Header Ends -->
						<!-- Navbar Collapse Starts -->
						  <div class="navbar-collapse collapse">
						  <ul class="nav navbar-nav navbar-right">
								<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#about">COMPANY</a></li>
									<li><a href="#products">Product</a></li>
									<li><a href="#recent-articles">SCHEDULE</a></li>
									<li><a href="#clearance">BRANCHES</a></li>
									<li><a href="<?php echo base_url();?>login/check">LOGIN</a></li>
									<li><a href="<?php echo base_url();?>login/register">REGISTER</a></li>
								</ul>
							</div>
						<!-- Navbar Collapse Ends -->
						</nav>
					<!-- Navbar Ends -->
					</div>
				<!-- Nested Container Ends -->
				</div>
			</div>
		<!-- Main Menu Ends -->
		</header>
	<!-- Header Ends -->
	<!-- About Section Starts -->
		<section id="about" class="about section-area">
			<div class="rotate-box-1"></div>
      <br/>
      <br/>
      <br/>
	  <br/>
      <br/>
		<!-- Nested Container Starts -->
			<div class="container">
		 
      <form class="form-horizontal" action="<?php echo base_url(); ?>login/register" id="registration" name="registration" method="POST">
                    <fieldset>
                      <legend>Personal Details</legend>
                      <div class="form-group">
                        <label for="sponsorno" class="col-lg-4 control-label">Sponsor No. <span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="sponsorno" name = "sponsorno" onchange="getsn(this.value)" placeholder="Sponsor No.">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="sponsorname" class="col-lg-4 control-label">Sponsor Name. <span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="sponsorname" name="sponsorname" readonly placeholder="Sponsor Name.">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="proposerno" class="col-lg-4 control-label">Proposer No.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="proposerno" name="proposerno" onchange="getppn(this.value)" placeholder="Proposer No.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="proposername" class="col-lg-4 control-label">Proposer Name.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="proposername" name="proposername" readonly placeholder="Proposer Name.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="applicantname" class="col-lg-4 control-label">Applicant Name.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="applicantname" name="applicantname" placeholder="Applicant Name.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="fhname" class="col-lg-4 control-label">Father/Husband Name.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="fhname" name="fhname" placeholder="Father/Husband Name." >
                        </div>
						</div>
						<div class="form-group">
                        <label for="applicantdob" class="col-lg-4 control-label">Applicant DOB.<span class="require">*</span></label>
                        <div class="col-lg-4">
						  <select class="form-control" id="applicantdobdate" name="applicantdobdate" style="width:90px;float: left; margin-right: 5px;">
						  <option value="">Date</option>
						  <?php 
						  for($i=1;$i<=31;$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
						  <option value="<?php echo $i; ?>"><?php echo date('F', mktime(0, 0, 0, $i, 15)); ?></option>
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
						  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="nomineename" class="col-lg-4 control-label">Nominee Name.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="nomineename" name="nomineename" placeholder="Nominee Name.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="nomineedob" class="col-lg-4 control-label">Nominee DOB.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <select class="form-control" id="nomineedobdate" name="nomineedobdate" style="width:90px;float: left; margin-right: 5px;">
						  <option value="">Date</option>
						  <?php 
						  for($i=1;$i<=31;$i++) 
						  {
						  ?>
						  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
						  <option value="<?php echo $i; ?>"><?php echo date('F', mktime(0, 0, 0, $i, 15)); ?></option>
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
						  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						  <?php 
						  } 
						  ?>
						  </select>
                        </div>
                      </div>
					   <div class="form-group">
                        <label for="age" class="col-lg-4 control-label">Age.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="age" name="age" placeholder="Age." readonly>
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="relation" class="col-lg-4 control-label">Relation.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="relation" name="relation" placeholder="Relation.">
                        </div>
                      </div>
					  
                      
                    </fieldset>
                    <fieldset>
                      <legend>Communication Detail</legend>
                      <div class="form-group">
                        <label for="holoc" class="col-lg-4 control-label">House No/Loaction <span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type="text" class="form-control" id="holoc" name="holoc"  placeholder="House No/Loaction.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="state" class="col-lg-4 control-label">State.<span class="require">*</span></label>
                        <div class="col-lg-4">
                        <!-- <?php 
   
    echo form_dropdown('state',$stateDrop,$state,'class="form-control change_state" id="StateDrp"','required'); ?>  -->
                           <select class="form-control" id="state" name="state" onchange="getdistrict(this.value)">
						  <option value="">Select State</option>
						  <?php foreach($state as $st){ ?>
						  <option value="<?php echo $st['state_id'];  ?>"><?php echo $st['state_name'];  ?></option>
						  <?php } ?>
						  </select> 
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="district" class="col-lg-4 control-label">District.<span class="require">*</span></label>
                        <div class="col-lg-4">
                        <!-- <?php  
    echo form_dropdown('district', $cityDrop, $city,'class="form-control select2me"','required');
    ?>       -->
                          <select class="form-control" id="district" name="district">
						  <option value=''>select District</option>
              <?php foreach($state as $st){ ?>
              <option value="<?php echo $st['state_id'];  ?>"><?php echo $st['state_name'];  ?></option>
              <?php } ?>
						  </select> 
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tehsil" class="col-lg-4 control-label">Tehsil.</label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="tehsil" name="tehsil" placeholder="Tehsil.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="post" class="col-lg-4 control-label">Post.</label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="post" name="post" placeholder="Post.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="city" class="col-lg-4 control-label">City.<span class="require">*</span></label>
                        <div class="col-lg-4">
                     <!--   <select class="form-control" id="city" name="city" placeholder="City.">
						<option value=''>Select City</option>
						</select> -->
             <input type='text' class="form-control" id="city" name="city" placeholder="Enter City Name">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="pincode" class="col-lg-4 control-label">Pincode.</label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="pincode" name="pincode" placeholder="Pincode.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="mobileno" class="col-lg-4 control-label">Mobile No.<span class="require">*</span></label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="mobileno" name="mobileno" placeholder="Mobile No." onchange = "return checkmobno(this.value)">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="othermobileno" class="col-lg-4 control-label">Other mobile No.<span class="require"></span></label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="othermobileno" name="othermobileno" placeholder="Other mobile No.">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="aadharcard" class="col-lg-4 control-label">Aadhar Card No.<span class="require">*</span></label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="aadharcard" name="aadharcard" placeholder="aadharcard" onchange = "return checkfather(this.value)">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="email" class="col-lg-4 control-label">Email Address.<span class="require"></span></label>
                        <div class="col-lg-4">
                        <input type='text' class="form-control" id="email" name="email" placeholder="Email Address.">
                        </div>
                      </div>
                     
                    </fieldset>
                 
					<fieldset>
					<legend>Security Details</legend>
					<div class="form-group">
					   <label for="password" class="col-lg-4 control-label">Password.<span class="require">*</span></label>
                        <div class="col-lg-4">
                          <input type='password' maxlength="6" class="form-control" id="password" name="password" placeholder="Password." require>  
                        </div>
                      </div>
					  <div class="form-group">
					   <label for="cpassword" class="col-lg-4 control-label">Confirm Password.<span class="require">*</span></label>
                        <div class="col-lg-4">
                             <input type='password' class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password." require>  
                        </div>
                      </div>
					  <div class="form-group text-center">
					    <input type='checkbox' class="col-md-offset-4 control-label" id="trem" name="term" style="margin-left:0px;"> <span style="margin-left:0px;"><a href=""data-target="#register"  data-toggle="modal">
              Term & Condition</a></span>   
                 <br/>
				 <label id="term-error" style="margin-left:160px;" class="error" for="term"></label>
                             
                       
                      </div>
					</fieldset>
                    <div class="row">
                      <div class="col-lg-4 col-md-offset-4 padding-left-0 padding-top-20">                        
						<input type="submit" class="btn btn-primary" value="Create an account" name="save"/>
                        <button type="button" class="btn btn-default">Cancel</button>
                      </div>
                    </div>
                  </form>  
                </div>
                <!-- <div class="col-md-4 col-sm-4 pull-right">
                  <div class="form-info">
                    <h2><em>Important</em> Information</h2>
                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

  </div>
  </section>        
		<!-- Footer Top Area Starts -->
		<div class="footer-top-area">
		<!-- Nested Container Starts -->
			<div class="container">
				<div class="row">
				<!-- News Letter Starts -->
					<div class="col-md-6 col-xs-12 newsletter-block">
						<div class="row">
							<div class="col-md-4 col-xs-12">
								<h4>Newsletter</h4>
							</div>
							<div class="col-md-8 col-xs-12">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Your Email Address">
									<span class="input-group-btn">
										<button class="btn btn-secondary" type="button">Subscribe</button>
									</span>
								</div>
							</div>
						</div>						
					</div>
				<!-- News Letter Ends -->
				<!-- Social Media Links Starts -->
					<div class="col-md-6 co-xs-12 social-media-block">
						<div class="row">
							<div class="col-md-5 col-xs-12">
								<h4 class="text-right">Follow Us</h4>
							</div>
							<div class="col-md-7 col-xs-12">
								<ul class="list-unstyled list-inline sm-links">
									<li>
										<a href=""><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="https://www.facebook.com/assurdness"><i class="fa fa-facebook"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-linkedin"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-skype"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-pinterest"></i></a>
									</li>
								</ul>
							</div>
						</div>	
					</div>
				<!-- Social Media Links Ends -->
				</div>
			</div>
		<!-- Nested Container Ends -->
		</div>
	<!-- Footer Top Area Ends -->
	<!-- Footer Starts -->
		<footer class="main-footer">
		<!-- Nested Container Starts -->
			<div class="container">
			<!-- Footer Boxes Starts -->
				<div class="row footer-boxes text-center">
					<div class="col-sm-4 col-xs-12">
						<h2 class="text-uppercase">News</h2>
						<h2 class="text-uppercase">GALLERY</h2>
					</div>
					<div class="col-sm-4 col-xs-12">
						<h2 class="text-uppercase">DOWNLOADS</h2>
						<h4></h4>
					</div>
					<div class="col-sm-4 col-xs-12">
						<h2 class="text-uppercase">Call Us</h2>
						<h4>( +91-9058670777 )</h4>
						
					</div>
				</div>
			<!-- Footer Boxes Ends -->
			<!-- Footer Brand Logo Starts -->
				<div class="row foot-brand-logo">
					<div class="col-sm-6 col-xs-12 col-sm-offset-3">
						<ul class="list-unstyled text-center">
							<li class="brand">
								Assuredness<span class="mid"></span> <span class="last">Buisness</span>
							</li>
							<li>
							Address : 161 Raipur Atrena , UTTAR PRADESH, INDIA-251309.
							</li>
							<li>
								Email : <a href="mailto:support@domain.com">customercare@myassuredness.com</a>, Telephone No: +91-9058670777
							</li>
						</ul>
					</div>
				</div>
			<!-- Footer Brand Logo Ends -->
			<!-- Copyright Starts -->
				<div class="copyright clearfix">
					<div class="pull-left">
						Copyright 2019 &copy; Assuredness.
					</div>
					<!-- <ul class="pull-right list-inline">
						<li>
							<img src="<?php echo base_url();?>assets/new/images/payment-icon/cirrus.png" alt="PaymentGateway">
						</li>
						<li>
							<img src="<?php echo base_url();?>assets/new/images/payment-icon/paypal.png" alt="PaymentGateway">
						</li>
						<li>
							<img src="<?php echo base_url();?>assets/new/images/payment-icon/visa.png" alt="PaymentGateway">
						</li>
						<li>
							<img src="<?php echo base_url();?>assets/new/images/payment-icon/mastercard.png" alt="PaymentGateway">
						</li>
						<li>
							<img src="<?php echo base_url();?>assets/new/images/payment-icon/americaexpress.png" alt="PaymentGateway">
						</li>
					</ul> -->
				</div>
			<!-- Copyright Ends -->
			</div>
		<!-- Nested Container Ends -->
		</footer>
	<!-- Footer Ends -->
	
	<!-- Template JS Files -->
	<script src="<?php echo base_url();?>assets/new/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url();?>assets/new/js/jquery-migrate-1.2.1.min.js"></script>	
	<script src="<?php echo base_url();?>assets/new/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/new/js/plugins/camera/js/jquery.mobile.customized.min.js"></script>
	<script src="<?php echo base_url();?>assets/new/js/plugins/camera/js/jquery.easing.1.3.js"></script>
	<script src="<?php echo base_url();?>assets/new/js/plugins/camera/js/camera.min.js"></script>	
	<script src="<?php echo base_url();?>assets/new/js/plugins/jquery.nav.js"></script>
	<script src="<?php echo base_url();?>assets/new/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url();?>assets/new/js/plugins/countdown.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="<?php echo base_url();?>assets/new/js/custom.js"></script>	
  <script>

function getdistrict(str)
{
jQuery.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
	    res = result.split('--#--');
        jQuery("#district").html(res[1]);
		//jQuery("#city").html(res[1]);
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
jQuery.post("<?php echo base_url();  ?>login/getspnonewcheck", {no: str}, function(result){
       
       if(result==1)
	   {
	   jQuery("#sponsorno").val('');	
	   alert("sponsor no. not exist");	
       jQuery("#sponsorname").val('');	   
	   }
	   
	   else if(result==2)
	   {
	   jQuery("#sponsorno").val('');	
	   alert("sponsor no. not Authorized for joining.");
       jQuery("#sponsorname").val('');	   
	   }
	   
	   else
	   { 
	   jQuery("#sponsorname").val(result);	   
	   }
	  
    });		
}

function getppn(str)
{
jQuery.post("<?php echo base_url();  ?>login/getspnonew", {no: str}, function(result){
	
   if(result==1)
	   {
	   jQuery("#proposerno").val('');	
	   alert("proposer no. not exist");	
       jQuery("#proposername").val('');	   
	   }
	   
	   else if(result==2)
	   {
	   jQuery("#proposerno").val('');	
	   alert("proposer no. not Authorized for joining.");
       jQuery("#proposername").val('');	   
	   }
	   
	   else
	   {
	   jQuery("#proposername").val(result);	   
	   }   
    });		
}

function checkmobno(str)
{
jQuery.post("<?php echo base_url();  ?>login/getmobno", {no: str}, function(result){
       if(result==1)
	   {
       return true;	   
	   }
	   else
	   {
	   //jQuery("#proposername").val(result);	
       jQuery("#mobileno").val('');	
	   alert("Mobile no. already exist.");
       return false;	   
	   }
    });		
}

function checkfather(str)
{
jQuery.post("<?php echo base_url();  ?>login/getfather", {no: str}, function(result){
       if(result==1)
	   {
       return true;	   
	   }
	   else
	   {
	   //jQuery("#proposername").val(result);	
       jQuery("#checkfather").val('');	
	   alert("Aadhar Card. already exist.");
       return false;	   
	   }
    });		
}



</script>

<script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            LayersliderInit.initLayerSlider();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
            
            Layout.initFixHeaderWithPreHeader();
            Layout.initNavScrolling();

            $(".change_state").change(function(){
                  var id = $(this).val();
                  $.ajax({
                    type : 'post',
                url  : '<?php echo base_url()?>login/district',
                    data : 'id='+id+'&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>',
                    cache:false,
                    success: function(data){                      
                      var dta = $.parseJSON(data);
                      var i = 0;
                      $("select[name=district]").empty();
                      if(dta.length>0){
                    $("select[name=district]").append("<option  value=''>Select District</option>");
                        for(i;i<=dta.length;i++){
                          $("select[name=district]").append("<option  value="+dta[i].id+">"+dta[i].city_name+"</option>");
                        }
                      //alert(dta[1].name);
                      }
                      else{
                        alert("No District in this State.");
                      }
                    }
                  });
                  //alert(id);
                //alert('hello');
                }); 

        });
    </script>
	</body>

</html>
                </div>
     
                    </div>
                   
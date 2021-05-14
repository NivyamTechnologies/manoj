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

<!-- 
		<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Rochester" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css"> -->

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

		<header id="main-header" class="main-header">
		<!-- Slider Starts -->
	
		
     
		<!-- Slider Ends -->
		<!-- Header Top Bar Starts -->
			<div class="top-bar">
			<!-- Nested Container Starts -->
				<div class="container">
				
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
								<li><a href="<?php echo base_url();?>" >Home</a></li>
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
      <br/>
	
		<!-- Nested Container Starts -->
			<div class="container">
		 
    <form name="login" action="<?php echo base_url(); ?>login/check_login_user" method="POST" class="form-horizontal">

                  
                    <div class="form-group">
                      <label for="email" class="col-lg-4 control-label">Id <span class="require">*</span></label>
                      <div class="col-lg-4">
                      <?php $inputclass = array('name' => 'username','value' => set_value('username'),'class' => 'form-control'); 
            echo form_input($inputclass);?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                      <div class="col-lg-4">
                       <?php $passwordclass = array('name' => 'password', 'class' => 'form-control','id'=>'password'); 
            echo form_password($passwordclass);?>                       
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-lg-4 control-label">Financial Year <span class="require">*</span></label>
                      <div class="col-lg-4">
                      <?php 
                      
						$options = array(
								
								'2020'         => '2020',
						);

						$inputclass = array('class' => 'form-control');
						echo form_dropdown('final', $options, '2020', $inputclass);
					  ?>
                      </div>
                    </div>

                    <!-- <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0">
                        <a href="page-forgotton-password.html">Forget Password?</a>
                      </div>
                    </div> -->

                    <div class="row">
                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                    
                         <?php $submitclass = array('name' => 'submit','type' => 'submit','value' => 'submit', 'class' => 'btn btn-primary','content'=>'Login');          
            echo form_button($submitclass);?>
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-10 padding-right-30">
                        <hr>

                        <!--<div class="login-socio">
                            <p class="text-muted">or login using:</p>
                            <ul class="social-icons">
                                <li><a href="javascript:;" data-original-title="facebook" class="facebook" title="facebook"></a></li>
                                <li><a href="javascript:;" data-original-title="Twitter" class="twitter" title="Twitter"></a></li>
                                <li><a href="javascript:;" data-original-title="Google Plus" class="googleplus" title="Google Plus"></a></li>
                                <li><a href="javascript:;" data-original-title="Linkedin" class="linkedin" title="LinkedIn"></a></li>
                            </ul>
                        </div> -->

                      </div>
                    </div>
                <?php echo form_close();?>

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
										<a href="#"><i class="fa fa-twitter"></i></a>
									</li>
									<li>
										<a href="#"><i class="fa fa-facebook"></i></a>
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
						<h2 class="text-uppercase">Watch links</h2>
					</div>
					<div class="col-sm-4 col-xs-12">
						<h2 class="text-uppercase">Call Us</h2>
						<h2>( +91-90586-70777)</h2>
						
					</div>
				</div>
			<!-- Footer Boxes Ends -->
			<!-- Footer Brand Logo Starts -->
				<div class="row foot-brand-logo">
					<div class="col-sm-6 col-xs-12 col-sm-offset-3">
						<ul class="list-unstyled text-center">
							<li class="brand">
								Assuredness<span class="mid"></span> <span class="last"></span>
							</li>
							<li>
								<!-- Address : 161 Raipur Atrena , UTTAR PRADESH, INDIA-201005. -->
							</li>
							<li>
								Email : <a href="mailto">marketing </a>, Telephone No: +91-90586-70777
							</li>
						</ul>
					</div>
				</div>
			<!-- Footer Brand Logo Ends -->
			<!-- Copyright Starts -->
				<div class="copyright clearfix">
					<div class="pull-left">
						Copyright 2020 &copy; Assuredness Marketing Pvt Ltd
					</div>
					
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
	</body>

</html>
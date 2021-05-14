<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest (the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>BVM Business</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

   <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

   <!-- Global styles START -->          
  <link href="<?php echo base_url();?>front-assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="<?php echo base_url();?>front-assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/global/plugins/slider-layer-slider/css/layerslider.css" rel="stylesheet">
<link href="<?php echo base_url();?>front-assets/global/css/media.css" rel="stylesheet">
<link href="<?php echo base_url();?>front-assets/global/css/loginbox.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="<?php echo base_url();?>front-assets/global/css/components.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/frontend/layout/css/style.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/frontend/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>front-assets/frontend/pages/css/style-layer-slider.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/frontend/layout/css/style-responsive.css" rel="stylesheet">
  <link href="<?php echo base_url();?>front-assets/frontend/layout/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="<?php echo base_url();?>front-assets/frontend/layout/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="corporate">
    <!-- BEGIN STYLE CUSTOMIZER -->
    <!--<div class="color-panel hidden-sm">
      <div class="color-mode-icons icon-color"></div>
      <div class="color-mode-icons icon-color-close"></div>
      <div class="color-mode">
        <p>THEME COLOR</p>
        <ul class="inline">
          <li class="color-red current color-default" data-style="red"></li>
          <li class="color-blue" data-style="blue"></li>
          <li class="color-green" data-style="green"></li>
          <li class="color-orange" data-style="orange"></li>
          <li class="color-gray" data-style="gray"></li>
          <li class="color-turquoise" data-style="turquoise"></li>
        </ul>
      </div>
    </div> -->
    <!-- END BEGIN STYLE CUSTOMIZER --> 
    
 <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->

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
                <div class="col-md-6 col-sm-6 additional-shop-info">

                    <ul class="list-unstyled list-inline">
                        <li><i class="fa fa-phone"></i><span>01206533224</span></li>
                        <!-- BEGIN CURRENCIES -->
                        <!-- <li class="shop-currencies">
                            <a href="javascript:void(0);">€</a>
                            <a href="javascript:void(0);">£</a>
                            <a href="javascript:void(0);" class="current">$</a>
                        </li> -->
                        <!-- END CURRENCIES -->
                        <!-- BEGIN LANGS -->
                      <!-- <li class="langs-block">
                            <a href="javascript:void(0);" class="current">English </a>
                            <div class="langs-block-others-wrapper"><div class="langs-block-others">
                              <a href="javascript:void(0);">French</a>
                              <a href="javascript:void(0);">Germany</a>
                              <a href="javascript:void(0);">Turkish</a>
                            </div></div>
                        </li>  -->
                        <!-- END LANGS -->
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->

                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    <ul class="list-unstyled list-inline pull-right">
              <!--<li><a href="<?php echo base_url();?>login/check">Member Login</a></li>
              <li><a href="<?php echo base_url();?>login/check">PUC Login</a></li>
              <li><a href="<?php echo base_url();?>login/register">NEW JOINING</a></li> -->
            <li><a href="<?php echo base_url();?>" title="Login" id="loginPopup">Home</a></li>
             <li><a href="<?php echo base_url();?>login/check" title="Login">PUC Login</a></li>
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->

            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

     <div class="header">
      <div class="container">
        <a class="site-logo" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>/assets/img/logo.png"></a>

  <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation">
          <ul>
            <li class="dropdown">
    <li><a href="<?php echo base_url();?>login/">Home</a></li>
                
              <!-- BEGIN DROPDOWN MENU -->
             <!-- <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                  <a href="shop-product-list.html">Hi Tops <i class="fa fa-angle-right"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="shop-product-list.html">Second Level Link</a></li>
                    <li><a href="shop-product-list.html">Second Level Link</a></li>
                    <li class="dropdown-submenu">
                      <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                        Second Level Link 
                        <i class="fa fa-angle-right"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="shop-product-list.html">Third Level Link</a></li>
                        <li><a href="shop-product-list.html">Third Level Link</a></li>
                        <li><a href="shop-product-list.html">Third Level Link</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="shop-product-list.html">Running Shoes</a></li>
                <li><a href="shop-product-list.html">Jackets and Coats</a></li>
              </ul> -->
              <!-- END DROPDOWN MENU -->
            </li>
            <li class="dropdown dropdown-megamenu">
               <li><a href="<?php echo base_url();?>login/aboutus">About Us</a></li>
          
            </li>
            <li><a href="<?php echo base_url();?>login/Plan">Plan</a></li>

            <li class="dropdown dropdown-megamenu">
               <li><a href="<?php echo base_url();?>login/product/1">Products</a></li>
            
            </li>
            <li><a href="<?php echo base_url();?>login/achievers" target="_blank">Top Achievers</a></li>
             <li><a href="<?php echo base_url();?>login/branchpuc" target="_blank">Branch & PUC</a></li>
      <li><a href="<?php echo base_url();?>login/seminars" target="_blank">Seminars</a></li>
<li><a href="<?php echo base_url();?>login/contact" target="_blank">Contact</a></li>
            <li><a href="<?php echo base_url();?>login/message" target="_blank">डिस्ट्रीब्यूटर के लिए सन्देश</a></li>
         
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
        <li><a href="<?php echo base_url();?>login">Home</a></li>
          <li class="active"><a href="<?php echo base_url();?>login/check">Login</a></li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
          </div>
          <!-- END SIDEBAR -->

           <!-- Seminar Content Start -->
          <div class="col-md-12 col-sm-12">
            <!-- Table Start -->
            <div class="rewards ptb30">
            <div class="container">
             <section class="post-wrapper-top jt-shadow clearfix">
    <div class="container">
      <div class="col-lg-12" style="text-align:center">
        <h2>OUR PRIVACY AND POLICY</h2>
                <h2>ADARSH NIROGDHAM PVT. LTD.</h2>
                
      </div>
    </div>
  </section>
    <section class="white-wrapper about_sec">
    <div class="container">
          <div class="row">
              <div class="col-xs-12">
                    <div class="widget">

                        <div class="main">


<p>Thank you for visiting www.bvmbusiness.com. As used in this privacy statement,the terms “our”, ”we” and “us” refer to both BVM BUSINESS and the distributor
   unless the context provides otherwise.This privacy policy sets out how Adarsh Nirogdham Pvt. Ltd.
    uses and protects any information that you give us when you use this website. BVM BUSINESS  is
    committed to ensuring that your privacy is always protected. Should we ask you to provide certain
    information by which you can be identified when using this website, then you can be assured that it will
     only be used in accordance with this privacy statement.</p>
        <h2> What Information We Collect and How We Use It</h2>
<p>The information that we collect on our website comes under  two general categories-
<p>•  Personally Identifiable Information</p>
<p>•  Aggregate Information</p>
<h3>1. Personally Identifiable Information </h3>

       Visitors
<p>You can browse our website without sharing any Personally Identifiable Information. If you want to register with us as a 
 distributor or place an order, you may voluntarily provide your Personally Identifiable Information (name, address, email address
   or telephone number) to be shared with a registered Vestige distributor for the purpose of assisting you with registration and order
       placement. We might also maintain a record of your contact information to help us provide better services in case you contact us again.</p>

<h3>2. Aggregate Information</h3>
<p>This refers to information that does not distinguish you as a particular individual. This information includes your browser and operating system 
   type, your IP address, URL (Uniform Source Locator) of the website that directed you to our site and any search terms you enter on our site. 
      Such information is aggregated by our web server to monitor the activities on the site and evaluate its performance. This helps us improve 
         the features and functions on the website to provide you a satisfactory user experience. We might compile, publish, store, collect, promote,
              disclose or use any Aggregate Information. We generally do not correlate any Personally Identifiable Information with Aggregate Information.
    In case we do this, it will be protected as per the terms mentioned for Personally Identifiable Information in this Privacy Policy.</p>
<p>Security </p>
    <p>We are committed to ensuring that your information is secure. In order to prevent unauthorized access or disclosure, we have put in place 
    suitable physical, electronic and managerial procedures to safeguard and secure the information we collect online. It is your sole responsibility to
     safeguard the password created for your online account. In case you suspect that your password has been compromised, contact Vestige Marketing Pvt. Ltd
       as soon as possible. Since your Distributor ID and account password are specific to you, you take full responsibility for any and all activity conducted 
   on our site with your ID and password.</p>
  <p> For any query, suggestions regarding this website please contact at - Customercare@bvmbusiness.com.</p>
 
<h3>THANK YOU.</h3>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>

            </div>
            <!-- Table End -->
          </div> 
        </div> 
       <!-- Dipo Content End -->
       
      </div>


    </div>

    

  

  <span id="socialBox" class="socialLinks fixedbox"> </span>

     <?php include_once('footer.php');?>

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="front-assets/global/plugins/respond.min.js"></script>
    <![endif]--> 
    <script src="<?php echo base_url();?>front-assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>front-assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>front-assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>front-assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>front-assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='<?php echo base_url();?>front-assets/global/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <!-- BEGIN LayerSlider -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/slider-layer-slider/js/greensock.js" type="text/javascript"></script><!-- External libraries: GreenSock -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/slider-layer-slider/js/layerslider.transitions.js" type="text/javascript"></script><!-- LayerSlider script files -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/slider-layer-slider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script><!-- LayerSlider script files -->
    <script src="<?php echo base_url();?>front-assets/frontend/pages/scripts/layerslider-init.js" type="text/javascript"></script>
    <!-- END LayerSlider -->

    <script src="<?php echo base_url();?>front-assets/frontend/layout/scripts/layout.js" type="text/javascript"></script>

    <script src="<?php echo base_url();?>front-assets/global/scripts/loginbox.js" type="text/javascript">
      
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            
        });
    </script>




   
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
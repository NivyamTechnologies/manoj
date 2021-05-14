<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Online CMS</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/select2/select2-metronic.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url();?>assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="<?php echo base_url().'assets/img/favicon.ico'?>" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="<?php echo base_url().'assets/img/logo-big.png'?>" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">   
    <?php $attributes = array('class' => 'login-form');
    echo form_open('login/admin_login',$attributes);?>
     	
		<!-- BEGIN LOGIN FORM -->
		<!-- <form class="form-vertical login-form" action="index.html" method="post"> -->
        		<div style="width: 320px;">
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
				<h3 class="form-title">Login to your account</h3>	 
			<div class="form-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">Username</label>
				
					<div class="input-icon">
					<i class="fa fa-user"></i>
                        <?php $inputclass = array('name' => 'username','value' => set_value('username'),'class' => 'm-wrap placeholder-no-fix form-control'); 
						echo form_input($inputclass);?>
					</div>
                    <?php echo form_error('username');?>
			
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				
					<div class="input-icon">
				<i class="fa fa-lock"></i>
                         <?php $passwordclass = array('name' => 'password', 'class' => 'm-wrap placeholder-no-fix form-control'); 
						echo form_password($passwordclass);?>
					</div>
                    <?php echo form_error('password');?>
			
			</div>
			<div class="form-actions">
				<!--<label class="checkbox">
				<input type="checkbox" name="remember" value="1"/> Remember me
				</label>-->
                <?php $submitclass = array('type' => 'submit','value' => true, 'class' => 'btn blue pull-right','content' => '<i class="m-icon-swapright m-icon-white"></i>&nbsp;Login');				  
						echo form_button($submitclass);?>
                        
				<!--<button type="submit" class="btn blue pull-right">
				Login 
				</button>  -->          
			</div>
			<div class="forget-password">
				<h4>Forgot your password ?</h4>
				<p>
					no worries, click <a href="javascript:;"  id="forget-password">here</a>
					to reset your password.
				</p>
			</div>			
		</form>
		<!-- END LOGIN FORM -->        
		<!-- BEGIN FORGOT PASSWORD FORM -->
		<form class="form-vertical forget-form" action="../index.html" method="post">
			<h3 >Forget Password ?</h3>
			<p>Enter your e-mail address below to reset your password.</p>
			<div class="control-group">
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
                        <?php $inputclass = array('name' => 'email', 'class' => 'm-wrap placeholder-no-fix'); 
						echo form_input($inputclass);?>
				<input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" autocomplete="off" name="email" />
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="button" id="back-btn" class="btn">
				<i class="m-icon-swapleft"></i> Back
				</button>
				<button type="submit" class="btn blue pull-right">
				Submit <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>
		</form>
		<!-- END FORGOT PASSWORD FORM -->		
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		Copyright &copy; <?php echo date ('Y'); ?>. Version <?php echo $this -> config -> item('version'); ?> Powered by <a href="<?php echo $this -> config -> item('credit_url'); ?>" title="<?php echo $this -> config -> item('credit'); ?>"
target="_blank"><?php echo $this -> config -> item('credit'); ?></a>
	</div>
	<!-- END COPYRIGHT -->
	<script src="<?php echo base_url().'assets/plugins/jquery-1.10.1.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jquery-migrate-1.2.1.min.js'?>" type="text/javascript"></script>
	
	<script src="<?php echo base_url().'assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js'?>" type="text/javascript"></script>      
	<script src="<?php echo base_url().'assets/plugins/bootstrap/js/bootstrap.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js'?>" type="text/javascript" ></script>
	 
	<script src="<?php echo base_url().'assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jquery.blockui.min.js'?>" type="text/javascript"></script>  
	<script src="<?php echo base_url().'assets/plugins/jquery.cookie.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/uniform/jquery.uniform.min.js'?>" type="text/javascript" ></script>
	
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/jquery.vmap.js'?>" type="text/javascript"></script>   
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js'?>" type="text/javascript"></script>  
	<script src="<?php echo base_url().'assets/plugins/flot/jquery.flot.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/flot/jquery.flot.resize.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/jquery.pulsate.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/date.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/bootstrap-daterangepicker/daterangepicker.js'?>" type="text/javascript"></script>     
	<script src="<?php echo base_url().'assets/plugins/gritter/js/jquery.gritter.js'?>" type="text/javascript"></script>
	
	
	<script src="<?php echo base_url().'assets/scripts/app.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/index.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/tasks.js'?>" type="text/javascript"></script>        
	
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?php echo base_url().'assets/plugins/jquery-validation/dist/jquery.validate.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/plugins/backstretch/jquery.backstretch.min.js'?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/plugins/select2/select2.min.js'?>"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	
	<script src="<?php echo base_url().'assets/scripts/login-soft.js'?>" type="text/javascript"></script>      
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		 // Login.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
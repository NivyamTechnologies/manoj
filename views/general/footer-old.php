
   

   <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>About us</h2>
            <p>Adarsh Nirog Dham Pvt. Ltd. is a product based company which deals in ayurvedic, cosmetics, food supplement products etc. Company is running from December 2013 and launching direct selling concept from August 2015. Through direct selling, the company wants to give a better health and a better economic life to all human being. In direct selling, Adarsh Nirog Dham Pvt. Ltd. Start this concept with the name of BVM Business. BVM denotes the Big Vision Marketing.</p>            
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->
          <!-- BEGIN BOTTOM INFO BLOCK -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>Information</h2>
            <ul class="list-unstyled">
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Delivery Information</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Customer Service</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Order Tracking</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Shipping &amp; Returns</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="contacts.html">Contact Us</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Careers</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Payment Methods</a></li>
            </ul>
          </div>
          <!-- END INFO BLOCK -->

         

          <!-- BEGIN BOTTOM CONTACTS -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>Adarsh Nirogdham<br/> Private Limited</h2>
            <address class="margin-bottom-40">
             5/84-A,Ground Floor,Sector-5,Opposite<br>
              Khaitan Public School gate no.-1,Rajender<br>
              Nagar,Sahibabad,Ghaziabad(U.P.)PinCode-201005<br/>
              Phone: 01206533224<br>
              Fax: 300 323 1456<br>
              Email: <a href="mailto:Customercare@bvmbusiness.com">Customercare@bvmbusiness.com</a><br>
             Website:<a href="http://www.bvmbusiness.com" target="_blank">www.bvmbusiness.com</a>
            </address>
          </div>
          <!-- END BOTTOM CONTACTS -->
        </div>
        <hr>
        <div class="row">
          <!-- BEGIN SOCIAL ICONS -->
          <div class="col-md-6 col-sm-6">
            <ul class="social-icons">
              <li><a class="rss" data-original-title="rss" href="javascript:;"></a></li>
              <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
              <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
              <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
              <li><a class="linkedin" data-original-title="linkedin" href="javascript:;"></a></li>
              <li><a class="youtube" data-original-title="youtube" href="javascript:;"></a></li>
              <li><a class="vimeo" data-original-title="vimeo" href="javascript:;"></a></li>
              <li><a class="skype" data-original-title="skype" href="javascript:;"></a></li>
            </ul>
          </div>
          <!-- END SOCIAL ICONS -->
          <!-- BEGIN NEWLETTER -->
          <div class="col-md-6 col-sm-6">
            <div class="pre-footer-subscribe-box pull-right">
              <h2>Newsletter</h2>
              <form action="#">
                <div class="input-group">
                  <input type="text" placeholder="youremail@mail.com" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                  </span>
                </div>
              </form>
            </div> 
          </div>
          <!-- END NEWLETTER -->
        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

 <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-6 col-sm-6 padding-top-10">
            2017 © BVM Business. ALL Rights Reserved. 
          </div>
          <!-- END COPYRIGHT -->
         
        </div>
      </div>
    </div>
    <!-- END FOOTER -->
	
	
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="front-assets/global/plugins/respond.min.js"></script>
    <![endif]--> 
    <script src="<?php echo base_url();?>front-assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>front-assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>front-assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="<?php echo base_url();?>front-assets/frontend/layout/scripts/back-to-top.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="<?php echo base_url();?>front-assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	  


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
      sponsorno: "required",
      sponsorname: "required",
	  proposerno: "required",
	  proposername: "required",
	  applicantname: "required",
	  fhname: "required",
	  nomineename: "required",
	  age: "required",
	  relation: "required",
	  holoc: "required",
	  state: "required",
	  district: "required",
	  tehsil: "required",
	  post: "required",
	  city: "required",
	  pincode: "required",
	  bankname: "required",
	  bankbranchstate: "required",
	  branchname: "required",
	  acno: "required",
	  ifsccode: "required",
	  mobileno:{
	  required: true,
      minlength:9,
      maxlength:10,
      number: true
      },
	  othermobileno:{
      minlength:9,
      maxlength:10,
      number: true
      },
	  email: {
        
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
	         cpassword : {
				    required: true,
                    minlength : 5,
                    equalTo : "#password"
                }

    },
    // Specify validation error messages
    messages: {
      sponsorno: "Please enter your Sponsor No.",
      sponsorname: "Please enter your Sponsor Name.",
	  proposerno: "Please enter your Proposer No.",
	  proposername: "Please enter your Proposer Name.",
	  
      applicantname: "Please enter your Applicant Name.",
      fhname: "Please enter your Father/Husband Name.",
	  nomineename: "Please enter your Nominee Name.",
	  age: "Please enter your Age.",
	  
	  
      relation: "Please enter your Relation.",
      holoc: "Please enter your House No/Location.",
	  state: "Please enter your State.",
	  district: "Please enter your District Name.",
	  
	  
      tehsil: "Please enter your Tehsil Name.",
      post: "Please enter your Postoffice Name.",
	  city: "Please enter your City.",
	  pincode: "Please enter your Pincode.",
	  mobileno: "Please enter valid Mobile no.",
	  mobileno: "Please enter valid Second Mobile no.",
	  
	  
      bankname: "Please enter your Bank Name.",
      bankbranchstate: "Please enter Branch State.",
	  branchname: "Please enter your branch Name.",
	  acno: "Please enter your Account No.",
	  ifsccode: "Please enter Ifsc Code.",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
	cpassword: {
        required: "Please Confirm password",
        minlength: "Your password must be at least 5 characters long",
		equalTo:"Passowrd not matched"
      },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) 
	{
    //form.submit();
	 jQuery.post("<?php echo base_url(); ?>login/register", jQuery("#registration").serialize(), function(data) {
     alert(data);
	 window.location.href = "<?php echo base_url(); ?>login/register";
    });
    }
  });
});


</script>
  
 
  

<!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
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
<div style="font-size:32px;">
Edit Profile
</div>
		<div class="portlet-body">
						
						<?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?>
		
        </div>
    <?php } ?>  
	
	<form class="form-horizontal" action="<?php echo base_url(); ?>login/editmyprofile" name="registration" method="POST">
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
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo base_url(); ?>adminimage/default.png" class="img-circle img-responsive"> </div>
                
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
                        <td>Applicant Name:</td>
                        <td><input type="text" class="form-control" id="applicantname" name="applicantname" value="<?php echo $userview[0]->applicant_name;?>" readonly  placeholder="Applicant Name."></td>
                      </tr>
                      
                     
                      <tr>
                        <td>Sponser No:</td>
                        <td><input type="text" class="form-control" id="sponsorno" name ="sponsorno" value="<?php echo $userview[0]->sponser_no;?>" readonly onchange="getsn(this.value)" placeholder="Sponsor No."></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Sponser Name:</td>
                        <td><input type="text" class="form-control" id="sponsorname" name="sponsorname" value="<?php echo $userview[0]->sponser_name;?>" readonly placeholder="Sponsor Name."></td>
                      </tr>
                        <tr>
                        <td>Proposer No:</td>
                        <td><input type="text" class="form-control" id="proposerno" name="proposerno" value="<?php echo $userview[0]->proposer_no;?>" readonly onchange="getppn(this.value)" placeholder="Proposer No."></td>
                      </tr>
                      <tr>
                        <td>Proposer Name:</td>
                        <td><input type="text" class="form-control" id="proposername" name="proposername" value="<?php echo $userview[0]->proposer_name;?>" readonly placeholder="Proposer Name."></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><input type='text' class="form-control" id="othermobileno" value="<?php echo $userview[0]->phone_no;?>" name="othermobileno" placeholder="Other mobile No.">(Landline)<br><br><input type='text' class="form-control" id="mobileno" value="<?php echo $userview[0]->mobile_no;?>" name="mobileno" placeholder="Mobile No.">(Mobile)
                        </td>
                           
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Father/Husband Name:</td>
                        <td><input type="text" class="form-control" id="fhname" name="fhname" readonly value="<?php echo $userview[0]->father_name;?>" placeholder="Father/Husband Name."></td>
                      </tr>
					  
					  </tr>
                        <tr>
                        <td>Applicant DOB.:</td>
                        <td>
						<?php $apdob=explode('-',$userview[0]->applicant_dob);?>
						<select class="form-control" id="applicantdobdate" readonly name="applicantdobdate" style="width:90px;float: left; margin-right: 5px;">
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
						  <select class="form-control" id="applicantdobmonth" readonly name="applicantdobmonth" style="width:90px;float: left; margin-right: 5px;">
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
						  <select class="form-control" id="applicantdobyear" readonly name="applicantdobyear" style="width:100px;">
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
					  
					  <?php 
                      $readonly='';					  
                      if($userview[0]->edit==1)
					  {
					  $readonly = "readonly";	  
					  }
					  ?>
					  <tr>
                        <td>Bank Name:</td>
                        <td>
						<select class="form-control" id="bankname" <?php echo $readonly;  ?> name="bankname">
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
						<select class="form-control" id="bankbranchstate" <?php echo $readonly;  ?> name="bankbranchstate">
						  <option value="">Select Bank Branch State</option>
						  <?php foreach($state as $st){ ?>
						  <option value="<?php echo $st['state_id'];  ?>" <?php if($userview[0]->branchstateid==$st['state_id']) {?> selected <?php } ?>><?php echo $st['state_name'];  ?></option>
						  <?php } ?>
						  </select></td>
                      </tr>
					  
					  <tr>
                        <td>Branch Name:</td>
                        <td><input type="text" class="form-control" id="branchname" <?php echo $readonly;  ?> name="branchname" value="<?php echo $userview[0]->branch_name;?>" placeholder="Branch Name."></td>
                      </tr>
					  
					  <tr>
                        <td>Bank A/C No:</td>
                        <td><input type='text' class="form-control" id="acno" name="acno" <?php echo $readonly;  ?> value="<?php echo $userview[0]->bank_accno;?>" placeholder="Bank A/C No."></td>
                      </tr>
					  
					  <tr>
                        <td>Bank ifsc No:</td>
                        <td><input type='text' class="form-control" id="ifsccode" name="ifsccode" <?php echo $readonly;  ?> value="<?php echo $userview[0]->bank_ifsc_code;?>" placeholder="Bank Ifsc Code."> </td>
                      </tr>
					  					  <tr>
                        <td>Bank Pan No:</td>
                        <td><input type='text' class="form-control" id="panno" name="panno" <?php echo $readonly;  ?> value="<?php echo $userview[0]->panno;?>" placeholder="Bank Pan No."></td>
                      </tr>
                      <tr>
                        <td><input type="submit" class="btn btn-primary" value="Edit User" name="update"/></td>
                       
                      </tr>
					  
                    </tbody>
                  </table>
                  </form>                  
				
</div>
</div>
</div>
<script>

function getdistrict(str)
{
$.post("<?php echo base_url();  ?>login/getdistrict", {state: str}, function(result){
        $("#district").html(result);
    });	
}

function agecal(str)
{
dob = new Date(str);
var today = new Date();
var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
$('#age').val(age);
}

function getsn(str)
{

$.post("<?php echo base_url();  ?>login/getspno", {no: str}, function(result){
       if(result==1)
	   {
	   $("#sponsorname").val('');	
	   alert("sponsor no. not exist");	   
	   }
	   else
	   {
	   $("#sponsorname").val(result);	   
	   }
    });		
}

function getppn(str)
{
$.post("<?php echo base_url();  ?>login/getspno", {no: str}, function(result){
	
       if(result==1)
	   {
	   $("#proposername").val('');	
	   alert("proposer no. not exist");	   
	   }
	   else
	   {
	   $("#proposername").val(result);	   
	   }
    });		
}
</script>	
<script src="<?php echo base_url();?>assets/plugins/jquery.validate.min.js" type="text/javascript"></script>
  <script>
$.noConflict(true);

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
  
 
  
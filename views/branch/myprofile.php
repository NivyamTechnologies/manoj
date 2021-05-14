<div class="page-content-wrapper">
<div class="page-content">
<div style="font-size:32px;">
My Profile
</div>
<div class="table-toolbar">
<div class="container">
			<?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success" style="width:940px;"> <?= $this->session->flashdata('msg') ?>
		
        </div>
    <?php } ?> 

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
				<img alt="User Pic" src="<?php echo base_url(); ?>adminimage/default.png" class="img-circle img-responsive"> 
				</div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Applicant No:</td>
                        <td><?php echo $userview[0]->applicant_no;?></td>
                      </tr>
                      <tr>
                        <td>Password:</td>
                        <td><?php echo $userview[0]->password;?></td>
                      </tr>
                      <tr>
                        <td>Sponser No:</td>
                        <td><?php echo $userview[0]->sponser_no;?></td>
                      </tr>
                   
          
                         <tr>
                        <td>Sponser Name:</td>
                        <td><?php echo $userview[0]->sponser_name;?></td>
                      </tr>
                        <tr>
                        <td>Proposer No:</td>
                        <td><?php echo $userview[0]->proposer_no;?></td>
                      </tr>
                      <tr>
                        <td>Proposer Name:</td>
                        <td><?php echo $userview[0]->proposer_name;?></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><?php echo $userview[0]->phone_no;?>(Landline)<br><br><?php echo $userview[0]->mobile_no;?>(Mobile)
                        </td>
                           
                      </tr>
                        <tr>
                        <td>Father/Husband Name:</td>
                        <td><?php echo $userview[0]->father_name;?></td>
                      </tr>
					  
					  
                        <tr>
                        <td>Applicant DOB.:</td>
                        <td><?php echo $userview[0]->applicant_dob;?></td>
                      </tr>
					  
					  
					  
                        <tr>
                        <td>Nominee Name.:</td>
                        <td><?php echo $userview[0]->nomnee_name;?></td>
                      </tr>
					  
					  
                        <tr>
                        <td>Nominee DOB.*:</td>
                        <td><?php echo $userview[0]->nomnee_dob;?></td>
                      </tr>
					  
					  
					  
                        <tr>
                        <td>Age.*:</td>
                        <td><?php echo $userview[0]->nomnee_age;?></td>
                      </tr>
					  
					  
                        <tr>
                        <td>Relation:</td>
                        <td><?php echo $userview[0]->nomnee_rel;?></td>
                      </tr>
					  
					  
                        <tr>
                        <td>House No/Loaction:</td>
                        <td><?php echo $userview[0]->location;?></td>
                      </tr>
					  
					  
                        <tr>
                        <td>Tehsil:</td>
                        <td><?php echo $userview[0]->tehsil;?></td>
                      </tr>
					  
					  
                        <tr>
                        <td>Post:</td>
                        <td><?php echo $userview[0]->post;?></td>
                      </tr>
                     
					 <tr>
                        <td>City:</td>
                        <td><?php echo $userview[0]->city;?></td>
                      </tr>
					 
                     <tr>
                        <td>Pincode:</td>
                        <td><?php echo $userview[0]->pincode;?></td>
                      </tr>

                      <tr>
                        <td>Email Address:</td>
                        <td><?php echo $userview[0]->email;?></td>
                      </tr>
					 
					  
					  <tr>
                        <td>Bank Name:</td>
                        <td><?php echo $userview[0]->bank_name;?></td>
                      </tr>
					  
					  <tr>
                        <td>Branch State:</td>
                        <td><?php echo $userview[0]->bank_branch_state;?></td>
                      </tr>
					  
					  <tr>
                        <td>Branch Name:</td>
                        <td><?php echo $userview[0]->branch_name;?></td>
                      </tr>
					  
					  <tr>
                        <td>Bank A/C No:</td>
                        <td><?php echo $userview[0]->bank_accno;?></td>
                      </tr>
					  
					  <tr>
                        <td>Bank Ifsc No:</td>
                        <td><?php echo $userview[0]->bank_ifsc_code;?></td>
                      </tr>
					  	<tr>
                        <td>Pan No:</td>
                        <td><?php echo $userview[0]->panno;?></td>
                      </tr>
					  
                    </tbody>
				  </table>
                 </div>
                  
                    <div class="panel-footer">
					 
                        <span class="pull-right">
                            <a href="<?php echo base_url();?>login/editmyprofile/<?php echo $this->session->userdata('member_id'); ?>" title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        </span>
		           
				   </div> 
</div>
</div>					
</div>
</div>
</div>
</div>
</div>
</div>
</div>
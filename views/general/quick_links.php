<div class="col-md-4">
   <h1 class="inner-hed">Quick Links</h1>
   <div class="notif">
      <ul>
         <li><a href="<?php echo base_url();?>">Home</a></li>
         <?php $this->load->library('ion_auth');		
            if ($this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
            {
            ?>
         <li><a href="<?php echo base_url();?>user">My Dashboard</a></li>
         <li><a href="<?php echo base_url();?>user/profile">Profile</a></li>
         <li><a href="<?php echo base_url();?>user/quiz_history">Quiz History</a></li>
         <?php } else if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>
         <li><a href="<?php echo base_url();?>admin">My Dashboard</a></li>
         <li><a href="<?php echo base_url();?>admin/profile">Profile</a></li>
         <?php } else { ?>
         <li><a href="<?php echo base_url(); ?>auth/login">Login </a>  </li>
         <li><a href="<?php echo base_url(); ?>auth/create_user">Register</a>  </li>
         <?php } ?>
         <li><a href="<?php echo base_url(); ?>welcome/contact"> Contact Us </a> </li>
         <li><a href="<?php echo base_url(); ?>welcome/termsConditions"> Terms of Use </a> </li>
      </ul>
   </div>
   
</div>


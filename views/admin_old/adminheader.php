<?php 
$profilephoto = "";
$FirstName ="";
$LastName = "";
 function getfin($date)
							{
							if(date('m',strtotime($date)) > 3)
							{
                            $fin = date('y',strtotime($date)).'-'.date('y',strtotime($date))+1;
							}
                            else
							{
                            $fin = (date('y',strtotime($date))-1).'-'.date('y',strtotime($date));
							}
                            return $fin;							
							}
						foreach($userinfo as $userdata)
						{
							$FirstName = $userdata->FirstName;
							$LastName = $userdata->LastName;
							$profilephoto = $userdata->photo_name;
								
						}
							?>
<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="#">
				<img style="padding: 5px 0; width:108px;" src="<?php echo base_url().'assets/img/logo.png'?>" alt="logo" />
				</a>
			
				        
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">					          
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<?php
									  if($profilephoto=='')
									  {
									  ?>
      <img src="<?php echo base_url().'assets/img/avatar.png'?>" style="width: 25px; height: 29px;"/>          							<?php }
									  if($profilephoto!='')
									  { ?>
		<img src="<?php echo base_url().'adminimage/'.$profilephoto;?>" style="width: 25px; height: 29px;"/>	  
								<?php } ?> 
						
						<span class="username">
						<?php
						echo $FirstName.'&nbsp;'.$LastName;?>
                       </span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url()?>admin/profile"><i class="icon-user"></i> My Profile</a></li>
							<!--<li><a href="page_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
							<li><a href="inbox.html"><i class="icon-envelope"></i> My Inbox <span class="badge badge-important">3</span></a></li>
							<li><a href="#"><i class="icon-tasks"></i> My Tasks <span class="badge badge-success">8</span></a></li>
							<li class="divider"></li>-->
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a></li>
							<!--<li><a href="extra_lock.html"><i class="icon-lock"></i> Lock Screen</a></li>-->
							<li><a href="<?php echo base_url().'login/logout'?>"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->

<script>
function deletebill()
{
var txt;
var r = confirm("Are You Sure?");
if (r == true) {
    return true;
} else {
    return false;
}	
}

function deletebillnew()
{
var txt;
var r = confirm("Are You Sure?");
if (r == true) 
{
var er=0;
$("input[name='quantity[]']").each(function() 
	{
	if($(this).val() == '' || $(this).val()==0 || typeof $(this).val()==='undefined')
	{
	er = 1;	
	}
    });
	
	if(er==0)
	{
    return true;
	}
	else
	{
	alert("Plese Fill Product Quantity Properly.");
	return false;	
	}
} else {
    return false;
}	
}
</script>
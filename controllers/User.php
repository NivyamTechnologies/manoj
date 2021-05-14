<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

/*
| -----------------------------------------------------
| PRODUCT NAME: 	ONLINE COACHING MANAGEMENT SYSTEM (CMS)
| -----------------------------------------------------
| AUTHER:			Amit Sadaphal
| -----------------------------------------------------
| EMAIL:			amit.sadaphal@gmail.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY OTS
| -----------------------------------------------------
| WEBSITE:			http://cms.otsinfotechindia.com     
| -----------------------------------------------------
|
| MODULE: 			User
| -----------------------------------------------------
| This is Admin module controller file.
| -----------------------------------------------------
*/

	 //Authenticate User for each function by calling the Parent Method validate_normaluser() in Constructor.
	function __construct()
    {
        parent::__construct();
		$this->load->model('base_model');	  
		
		//$this->validate_normaluser();
    } 
	
	//User Dashboard (Default Function. If no function is called, this function will be called)
	public function index()
	{
		redirect('user/dashboard');
	}	
	
	public function dashboard()
	{
		
		$table = $this->db->dbprefix('tbl_student');
				
		//Data For Active Users
		$userinfo = $this->base_model->run_query(
		"select * from tbl_student where Stdid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
		
		//starts by running the query for the countries dropdown  
      $this->data['countryDrop'] = $this->base_model->getCountries();
	  
	  $this->data['stateDrop']= $this->base_model->getStateByCountry();
	  
	   $this->data['cityDrop']=$this->base_model->getStateByCity();
	   		
				
		$this->data['userinfo'] 				= $userinfo;		
		$this->data['title'] 				= 'User Dashboard';
		$this->data['active_menu'] 			= 'dashboard';
		$this->data['content'] 				= 'user/index';		
		$this->load->view('user/dashboard',$this->data); 
	}
	
	function Accountinfo()
	{
		 if ($this->input->post()) {
			 
				//Account Seciont - Personal Information Update Fiedls
				
		   		$inputdata['FirstName'] 				= $this->input->post('FirstName');
				$inputdata['LastName'] 					= $this->input->post('LastName');
				$inputdata['mobileno'] 					= $this->input->post('mobileno');
				$inputdata['emailid'] 					= $this->input->post('emailid');
				$inputdata['desigination'] 				= $this->input->post('desigination');
				$inputdata['country'] 					= $this->input->post('countriesDrp');
				$inputdata['state'] 					= $this->input->post('StateDrp');
				$inputdata['city'] 						= $this->input->post('cityDrp');
				
				$where['empid'] 						= $this->session->userdata('empid');				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('add_emp_admin'), 
				$where);
				$this->session->set_flashdata('success','Your Profile Information successfully updated'); 
				return redirect('user/dashboard#tab_1_3','refresh');
		 }
				
	}
	
	function Profilephoto()
	{
		 if ($this->input->post()) {
		   
		   		
				
				//User Photo Upload Process Start
				$image 						= $_FILES['image']['name'];
			
			//Upload User Photo
				if (!empty($image)) {	
				$where['empid'] 		= $this->session->userdata('empid');
					$r = $this->base_model->run_query(
					'select photo_name from '.$this->db->dbprefix('add_emp_admin')
					.' where empid ="'.$where['empid'].'"'
					);
					if (count($r) > 0) {
					
						if (file_exists('assets/img/profile/'.$r[0]->photo_name)) {
							unlink('assets/img/profile/'.$r[0]->photo_name);
						}						
					}
					
					//Unset User Image 
					$this->session->unset_userdata('photo_name');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."".$where['empid'].".".$ext[1];
					
					$inputdata['photo_name'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/img/profile/'.$img
					);					
					
					//Set User Image
					$this->session->set_userdata('photo_name',$img);
					
				}			
				//Quiz Photo Upload Process End
				
				$where['empid'] 						= $this->session->userdata('empid');				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('add_emp_admin'), 
				$where); 
				$this->session->set_flashdata('success','Your Profile Photo successfully updated');
				return redirect('user/dashboard#tab_2-2');
		 }
				
	}
	
	function Changepassword()
	{
		 if ($this->input->post()) {
			 
				//Account Seciont - User Password Information Update Fiedls
				
		   		$inputdata['password'] 					= $this->input->post('npassword');							
				
				$where['empid'] 						= $this->session->userdata('empid');				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('add_emp_admin'), 
				$where); 
				$this->session->set_flashdata('success','Your Password Information successfully updated');
				return redirect('user/dashboard');
		 }
				
	}
	
	function Bankdetails()
	{
		 if ($this->input->post()) {
			 
				//Account Seciont - User Bank Information Update Fiedls
				
		   		$inputdata['Bank_name'] 					= $this->input->post('bankname');
				$inputdata['bank_account_full_name'] 		= $this->input->post('bankacname');
				$inputdata['Account_no'] 					= $this->input->post('banacno');							
				
				$where['empid'] 							= $this->session->userdata('empid');				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('add_emp_admin'), 
				$where); 
				$this->session->set_flashdata('success','Your Bank Information successfully updated');
				redirect('user/dashboard');
				
		 }
				
	}
	
	function attendance()
	{
		$table 		= $this->db->dbprefix('add_emp_admin');
		
		//User Data Info
		$userinfo = $this->base_model->run_query(
		"select * from add_emp_admin where empid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
		
		//Get the User Quiz wise Performance to Display in the user dashboard in Chart.
		$userdata 				= $this->base_model->run_query(
		"select * from ".$table." where empid='".$this->session->userdata('empid')."'");
		
		//Get the User Leave Balacne to Display in the user Attendance.
		$userleavebalacne 				= $this->base_model->run_query(
		"select * from tbl_leave_balance where empid='".$this->session->userdata('empid')."'");
		
		//Get the User total Leave  to Display in the user Attendance.
		$userleave 				= $this->base_model->run_query(
		"select * from tbl_leave where empid='".$this->session->userdata('empid')."' and leave_permission ='Granted'");
		
		$cDate = strtotime("+24 hours");
		$logindt = date("Y/m/d");
		
		//$cDate = strtotime("+24 hours");
		//$logindt = date("Y/m/d",$cDate);
		
		$userallattendance  = $this->base_model->run_query("select * from attendance where empid='".$this->session->userdata('empid')."' ORDER BY date DESC LIMIT 7");
			$this->data['userallattendance'] 	= $userallattendance;	
		
		$attendanceresult  = $this->base_model->run_query(
		"select * from attendance where login >  '$logindt 00:00:00' AND login <  '$logindt 23:59:59' AND empid='".$this->session->userdata('empid')."'");
		
		
		$maxid		= $this->base_model->run_query("select max(att_id) as attid from attendance where empid='".$this->session->userdata('empid')."'");
			
			if (count($maxid)>0) {				
				$this->data['maxattid'] 	= $maxid[0]->att_id;
			}
			foreach($maxid as $max){
				$atmaxid = $max->attid;
			}			
			
			
		$ltime = strtotime("+24 hours + 30 minutes");		
		$lt = strtotime("+24 hours + 30 minutes");
		$lattid = date("Y/m/d h:i:s");		
		$eDate = strtotime("+12 hours");
		
		//$ltime = strtotime("+24 hours + 30 minutes");		
		//$lt = strtotime("+24 hours + 30 minutes");
		//$lattid = date("Y/m/d h:i:s",$lt);		
		//$eDate = strtotime("+12 hours");
		
		
		
		
		$inputdata['empid']							= $this->session->userdata('empid');
		$inputdata['date']							= date("Y-m-d");//eDate;
		$inputdata['logintime'] 					= date("h:i:s A");//ltime
		$inputdata['ipused'] 						= $_SERVER["REMOTE_ADDR"];
		$inputdata['emp_name'] 						= $userinfo[0]->FirstName.$userinfo[0]->LastName;
		$inputdata['login']							= date("Y/m/d h:i:s"); //lt
		
				
		if(isset($_GET["login"])) {			
		
		$this->base_model->insert_operation(
							$inputdata, 
							$this->db->dbprefix('attendance')
							);
		$this->session->set_flashdata('success','Employee Punch in successfully...');	
		return redirect('user/attendance','refresh');
		}
		
		if(isset($_GET["logout"]))
		{
			$attid = date("Y-m-d h:i:s");
			
			$cl=$_REQUEST['logintime'];
			$attendance  = $this->base_model->run_query("select * from attendance where att_id='".$atmaxid."' and empid='".$this->session->userdata('empid')."'");
			$this->data['attendance'] 	= $attendance;	
					
			foreach($attendance as $attendancevalue){
				$atlogout = $attendancevalue->logout;
			}	
			if($attendance)
			{
				$str=$atlogout;
				
				if($str==NULL)
				{ 
						$where['att_id'] 							= $atmaxid;
						$logindata['logout'] 						= date("h:i:s A");//ltime				
						//step for Update
						$logoutaffrow  = $this->base_model->update_operation(
						$logindata, 
						$this->db->dbprefix('attendance'), 
						$where);
						if($logoutaffrow!='')
						   {
						  $attlogout = $this->session->set_flashdata('success','Employee Punch Out successfully...');	
						 	$this->data['counts'] = $counts=3;
						   }
				}
				elseif($str!='')
				{
					$attlogout = $this->session->set_flashdata('success','You Have Already Punch Out...');					
					$this->data['counts'] = $counts=3;
				}
			}             
			return redirect('user/attendance','refresh');
		} // logout script end 
		
		$attendanceresult  = $this->base_model->run_query(
		"select * from attendance where login >  '$logindt 00:00:00' AND login <  '$logindt 23:59:59' AND empid='".$this->session->userdata('empid')."'");
		$this->data['attendanceresult'] 	= $attendanceresult;
		
		$this->data['cntr'] =	$cntr=0;
		
		$attendancecheck  = $this->base_model->run_query("select * from attendance where att_id='".$atmaxid."' and empid='".$this->session->userdata('empid')."'");
			$this->data['attendancecheck'] 	= $attendancecheck;	
					
			foreach($attendancecheck as $attendancevalues){
				$attcheckin = $attendancevalues->logintime;
				$attcheckout = $attendancevalues->logout;
			}
			
			if($attendancecheck)
			{
				$str3=$attcheckout;	
				$str4=$attcheckin;
	
			if($str3!=NULL && $str4!=NULL)
			{
				
				
				if($attendanceresult)
				{
					$this->data['cntr'] = $cntr=2;
				}
				else if($attendanceresult=='')					
				{	
					 $this->data['cntr'] = $cntr=1;
					
				}
			}
			else if($attendanceresult!='')
			{ 
				$this->data['cntr'] = $cntr=3;		
			}
			
	
} //attendance Checkin & Checkout System Script end

		
				
		$this->data['attendanceresult'] 		= $attendanceresult;
		$this->data['attendancecheck'] 			= $attendancecheck;			
		$this->data['userinfo'] 				= $userinfo;
		$this->data['userdata'] 				= $userdata;
		
		$this->data['userleavebalacne'] 		= $userleavebalacne;
		$this->data['userleave'] 				= $userleave;
		
		$this->data['title'] 				= 'User Attendance';
		$this->data['active_menu'] 			= 'Attendance';
		$this->data['content'] 				= 'user/attendance';			
		$this->_render_page('temp/usertemplate', $this->data);
		
				
	}
	
	//Job Work
	function jobwork()
	{
		$table 		= $this->db->dbprefix('daily_jobwork');
		
		
		//userinfo 
		$userinfo = $this->base_model->run_query(
		"select * from add_emp_admin where empid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
		
		
		//Get the All Jobwork info
		$jobinfo 				= $this->base_model->run_query(
		"select * from ".$table." where empid='".$this->session->userdata('empid')."' ORDER BY date DESC");
		
		//Get the All Jobwork info
		$jobworkdetails 				= $this->base_model->run_query(
		"select * from ".$table." where id='".$this->uri->segment(3)."'");
		
		
				
		$this->data['jobinfo'] 				= $jobinfo;
		$this->data['jobworkdetails'] 		= $jobworkdetails;
		$this->data['userinfo'] 			= $userinfo;
		$this->data['title'] 				= 'Job Work';
		$this->data['active_menu'] 			= 'jobwork';
		$this->data['content'] 				= 'user/jobwork';		
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	function jobworkupdate()
	{
		
		 if ($this->input->post()) {
			 
				//JobWork Seciont - User Job work Information Update Fiedls
				if($this->uri->segment(3) != ''){
					
		   		$inputdata['job_work'] 					= $this->input->post('workdesc');
				$inputdata['job_status'] 				= $this->input->post('workstatus');
				
				$where['id'] 							= $this->uri->segment(3);				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('daily_jobwork'), 
				$where); 
				$this->session->set_flashdata('success','Your Work Information successfully updated');
				}
				return redirect('user/jobwork');
				
		 }
				
	}
	
		
	//User Leave
	function leave()
	{
		$table 		= $this->db->dbprefix('tbl_leave');
		
		//userinfo 
		$userinfo = $this->base_model->run_query(
		"select * from add_emp_admin where empid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
		
		foreach($userinfo as $uservalue){
				$empname = $uservalue->FirstName. $uservalue->LastName;
				$empemailid = $uservalue->emailid;
			}
		
		//Get the All Leave info
		$leaveinfo 				= $this->base_model->run_query(
		"select * from ".$table." where empid='".$this->session->userdata('empid')."'");
		
		//Get the All Leave info
		$leaveinfodetails 				= $this->base_model->run_query(
		"select * from ".$table." where leave_code='".$this->uri->segment(3)."'");
		
		//Get the Leave Reporting Manager Details
		$reportingdata 				= $this->base_model->run_query(
		"select * from add_emp_admin where empid='".$this->session->userdata('empid')."'");
		
		foreach($reportingdata as $val){
				$reportingid = $val->reporting;				
			}
			
		//Get the Leave Reporting Manager Emailid
		$reportingemailid 				= $this->base_model->run_query(
		"select * from add_emp_admin where empid='".$reportingid."'");
		
		//Get the User Leave Balacne to Display in the user Leave.
		$userleavebalacne 				= $this->base_model->run_query(
		"select * from tbl_leave_balance where empid='".$this->session->userdata('empid')."'");
		
		//Get the User total Leave  to Display in the user Attendance.
		$userleave 				= $this->base_model->run_query(
		"select * from tbl_leave where empid='".$this->session->userdata('empid')."' and leave_permission ='Granted'");
		
		//Get Present Month Name
		$nowdate = date(); 
			$date = date_create($nowdate);
				$newpresentmonth  = date_format($date,"M");
				
		//Get Apply Leave Present Month
		
		foreach($userleave as $val){
				$lfrom = $val->leave_from;
				$date1=date_create($val->leave_from);
				$date2=date_create($val->leave_to);
				$diff=date_diff($date2,$date1);
				$days = $diff->d;
						
				$dates = date_create($lfrom);
				$newlfrompresentmonth  = date_format($dates,"M");
				if($newpresentmonth==$newlfrompresentmonth)				
				{
					echo $newlfrompresentmonth;
					echo $days;
				}									
			}
			
			//Leave Calendar Script Start
			$leavecalendar 				= $this->base_model->run_query(
		"select * from tbl_leave where empid='".$this->session->userdata('empid')."' and leave_permission ='Granted'");
			
	//Leave Calendar Script End
			
					
		
		if ($this->input->post()) {
			
			$this->load->library('email');
			
			 $str = "";
			 $length = 8;
			 $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
			 $max = count($characters) - 1;
			 for ($i = 0; $i < $length; $i++) {
			  $rand = mt_rand(0, $max);
			  $str .= $characters[$rand];
			 }
				$tokenno = $str;
			 
			
				
				$template='<table width="450" border="0" align="center" cellpadding="0" cellspacing="10" style="font-family:Arial, Helvetica, sans-serif; background-color:#e9e8e8; border:1px solid #cfcfcf;">  
  <tr>
    <td style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;"></td>
    <td style="font-size:11px;"><img src="http://otsinfotechindia.com/hrms/images/logo1.png" height="70"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:16px; background-color:#FF7A09; color:#fff; padding:4px 10px;"><strong>Employee Leave Request Information </strong></td>
  </tr>
  <tr>
  	<td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Employee Id: '.$this->session->userdata('empid').'</td>
  </tr>
  
   <tr>
  	<td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Employee Name: '.$empname.'</td>
  </tr>
  <tr>
   <td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Email: '.$empemailid.'</td>
   
  </tr>
   <tr>
    <td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Type of Leave: '.$this->input->post('leavetype').'		   </td>
    
  </tr>
  <tr>
    <td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Reason for Leave: '.$this->input->post('leavereasion').'</td>
    
  </tr> 
   <tr>
    <td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Leave From: '.$this->input->post('startdate').'</td>
    
  </tr>
   <tr>
<td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Leave To: '.$this->input->post('enddate').'</td>
    
  </tr>  
  <tr>
<td colspan="2" style="font-size:12px; font-weight:bold; padding:0px 0px 0px 10px;">Leave OTP: '.$tokenno.'</td>
    
  </tr>
  
  <tr>
  <td colspan="2" style="font-size:12px; font-weight:bold; padding:10px;"><a href="http://newhrms.otsinfotechindia.com" style="font-size:16px; background-color:#FF7A09; color:#fff; border:2px solid #a1a1a1; border-radius: 25px; padding:4px 10px; text-decoration:none;">Go To HRMS</a></td>  
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr> 
  <tr>
  <td style="font-size:10px; font-weight:bold; padding:0px 0px 0px 10px;">Regards,</td>
  </tr> 
  <tr>
  <td colspan="2" style="font-size:10px; font-weight:bold; padding:0px 0px 0px 10px;">Online HRMS Team</td>
  </tr>         
</table>';
					 
				//Leave Apply - User Leave Information Apply Fields				
					
		   		$reportingemailid 						= $this->input->post('rm');
				$inputdata['empid']	 					= $this->session->userdata('empid');
				$inputdata['empname']	 				= $empname;
				$inputdata['email']						= $empemailid;
				$inputdata['leave_type'] 				= $this->input->post('leavetype');
				$inputdata['leave_from'] 				= $this->input->post('startdate');
				$inputdata['leave_to'] 					= $this->input->post('enddate');				
				$inputdata['leave_resion'] 				= $this->input->post('leavereasion');
				$inputdata['leave_code'] 				= $tokenno;
				
				
				
				
				//Leave Apply Email Information Script
				
				$this->email->from('info@otsinfotechindia.com', 'Online HRMS');
				$this->email->to($reportingemailid);
				 
				$this->email->subject('Online HRMS Employee Leave Request');
				$this->email->message($template);
				
				//Send mail 
				 if($this->email->send()) 
				 $this->session->set_flashdata("email_sent","Email sent successfully."); 
				 else 
				 $this->session->set_flashdata("email_sent","Error in sending Email.");
							
				//step for Insert
				$this->base_model->insert_operation(
							$inputdata, 
							$this->db->dbprefix('tbl_leave')
							);
				$this->session->set_flashdata('success','Your have successfully leave apply');
				return redirect('user/leave');
				
		 }
		
				
		$this->data['leaveinfo'] 				= $leaveinfo;
		$this->data['leaveinfodetails'] 		= $leaveinfodetails;
		$this->data['reportingemailid'] 		= $reportingemailid;
		$this->data['userleavebalacne'] 		= $userleavebalacne;
		$this->data['leavecalendar'] 			= $leavecalendar;
		$this->data['userleave'] 				= $userleave;
		$this->data['userinfo'] 				= $userinfo;
		$this->data['title'] 					= 'Leave';
		$this->data['active_menu'] 				= 'leave';
		$this->data['content'] 					= 'user/leave';		
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	function leaveupdate()
	{
		
		 if ($this->input->post()) {
			 
			 if($this->uri->segment(3) != '') {
			 
				//Leave Update  - User Leave Information Update Fiedls
		   		
				$inputdata['leave_type'] 				= $this->input->post('leavetype');
				$inputdata['leave_from'] 				= $this->input->post('startdate');
				$inputdata['leave_to'] 					= $this->input->post('enddate');				
				$inputdata['leave_resion'] 				= $this->input->post('leavereasion');
				
				
				$where['leave_code'] 					= $this->uri->segment(3);				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('tbl_leave'), 
				$where); 
				$this->session->set_flashdata('success','Your Leave Information successfully updated');				
		 
				return redirect('user/leave');
		 }}
				
	}
	
	function salary()
	{
		
		$table 		= $this->db->dbprefix('salary');
		
		
		//User Data Info
		$userinfo = $this->base_model->run_query(
		"select * from add_emp_admin where empid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
		
		//Get the Salary Display in the Salary.
		$salaryinfo 				= $this->base_model->run_query(
		"select * from ".$table." where empid='".$this->session->userdata('empid')."'");
		
		
				
		$this->data['userinfo'] 				= $userinfo;
		$this->data['salaryinfo'] 				= $salaryinfo;
		$this->data['title'] 				= 'Salary';
		$this->data['active_menu'] 			= 'salary';
		$this->data['content'] 				= 'user/salary';		
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	
	
	//User Profile
	function profile()
	{
		$userid 						= $this->session->userdata('user_id');
		if (isset($userid) && $userid!='') {
			$table 						= $this->db->dbprefix('users');
			$condition['id'] 			= $userid;
			$records 					= $this->base_model->fetch_records_from(
			$table, 
			$condition, 
			$select = '*', 
			$order_by = ''
			);
			
			//Options for Groups For
		
		$groupsoptions['0']='Select Group'; 
		$groupsRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		
		foreach ($groupsRecords as $key=>$val) {
		    $groupsoptions[$val->id]	= $val->group_name;	
		}
		$this->data['groups'] 		= $groupsoptions;
			
			
			$this->data['details'] 		= $records;
			$this->data['content'] 		= 'user/profile';
			$this->data['active_menu'] 	= 'profile';
			$this->data['title'] 		= 'My Profile';
			$this->_render_page('temp/usertemplate', $this->data);
		}
		else {
			$this->prepare_flashmessage('Session Expired!', 2);
			redirect('auth/login', 'refresh');
		}
	}
	
	public function _image_check($image = '', $param2 = '')
	{
		
		$name = explode('.',$param2);
		
		if(count($name)>2 || count($name)<= 0) {
           $this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
            return FALSE;
        }
		
		$ext = $name[1];
		
		$allowed_types = array('jpg','jpeg','png');
		
		if (!in_array($ext, $allowed_types))
		{			
			
			$this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
			
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	//Update Profile
	function update_profile()
	{
		$this->form_validation->set_rules(
		'first_name', 
		'First Name', 
		'trim|required|xss_clean'
		);
		$this->form_validation->set_rules(
		'last_name', 
		'Last Name', 
		'trim|required|xss_clean'
		);
		$this->form_validation->set_rules(
		'phone', 
		'Phone', 
		'required|xss_clean|integer'
		);
		
		if(!empty($_FILES['image']['name'])) {

			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$userid = $this->input->post('user');
			if ($this->input->post('submit') !='' && 
			isset($userid) && $userid!='') {				
				$data['first_name'] 	= $this->input->post('first_name');
				$data['last_name'] 		= $this->input->post('last_name');
				$data['username'] 		= $this->input->post('first_name')
				." ".$this->input->post('last_name');
				$data['phone'] 			= $this->input->post('phone');
				
				$data['group'] 			= $this->input->post('group');
				
				//Unset User Name
				$this->session->unset_userdata('username');
				//Set User Name
				$this->session->set_userdata('username', $data['username']);
				$image 					= $_FILES['image']['name'];
				
				//Upload User Photo
				if (!empty($image)) {	
					$r 					= $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('users')
					.' where image !="" and id='.$userid
					);
					if (count($r) > 0) {
						if (file_exists('assets/uploads/images/'.$r[0]->image)) {
							unlink('assets/uploads/images/'.$r[0]->image);
						}
						if(file_exists('assets/uploads/images(200x200)/'
						.$r[0]->image)) {
							unlink('assets/uploads/images(200x200)/'.$r[0]->image);
						}
							
						if(file_exists('assets/uploads/images(50x50)/'
						.$r[0]->image)) {
							unlink('assets/uploads/images(50x50)/'.$r[0]->image);
						}
					}
					
					//Unset User Image 
					$this->session->unset_userdata('image');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."_".$userid.".".$ext[1];
					
					$data['image'] 		= $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/images/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(200x200)/'. $img,
					200,
					200
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(50x50)/'. $img,
					50,
					50
					);
					
					//Set User Image
					$this->session->set_userdata('image', $img);
					
					
				}
				
				$table 					= $this->db->dbprefix('users');
				$where['id'] 			= $userid;
				$this->base_model->update_operation($data, $table, $where);
				$this->prepare_flashmessage(
				'Your profile has been successfully updated.', 
				0
				);
				redirect('user/profile', 'refresh');
			}
			else {
				$this->prepare_flashmessage('Session Expired!', 2);
				redirect('auth/login', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(validation_errors(), 1);
			redirect('user/profile', 'refresh');
		}
	}
	//Fetch Sub Categories for Category id
	function get_subcategories()
		{
			$id=$this->input->post('catid');
			$sub=$this->base_model->run_query(
			"select subcatid,name from ".$this->db->dbprefix('subcategories')
			." where catid=".$id
			);
			echo json_encode($sub); 
		}
	public function instructions()
	{	
		$check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
		$this->data['records_for_all']=array(); 
		if($check[0]->quizzes_for == "groupquizzes") {
		$userid = $this->ion_auth->get_user_id();
		
		$check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
		

		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s,  ".$this->db->dbprefix('quiz_for')." qf 
		where c.catid=q.catid AND s.subcatid=q.subcatid 
		AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid ) 
		AND q.status='Active' group by q.quizid"
		);
		
		
		$this->data['records_for_all'] 	= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s  where c.catid=q.catid AND s.subcatid=q.subcatid 
		AND q.quiz_for != '*' and q.status = 'Active'  
		AND q.status='Active' group by q.quizid"
		);
		//echo "<pre>"; print_r("hello"); 
		
		} else {
		
		
		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
		and s.subcatid=q.subcatid"
		);
		
		}
		// Code written for fetching quizzes based on admin restrictions END
		
		$options_for_all = array();
		$i=0;
		foreach($this->data['records'] as $key=> $val) {
			
			$options[$i]	= $val->quizid;
			$i++;
		}
		$this->data['quiz_ids'] = $options;
		$j=0;
		
		foreach($this->data['records_for_all'] as $key=> $val) {
			
			$options_for_all[$j]	= $val->quizid;
			$j++;
		}
		$records = array();
		$this->data['quiz_ids_for_all'] = $options_for_all;
		$id = $this->uri->segment(3);
		if (in_array($id, $options) || in_array($id,$options_for_all)) {
			$this->data['title'] 			= 'Exam/Quiz Insrtuctions';
			$this->data['active_menu'] 		= 'exams';
			$this->data['content'] 			= 'user/exam/examinstructions';
			$table 							= $this->db->dbprefix('quiz');
			$condition['quizid'] 			= $id;
			$records 						= $this->base_model->fetch_records_from(
			$table, 
			$condition, 
			$select 						= '*', 
			$order_by 						= ''
			);
			$this->data['exams'] = $records;
			$paymenttable = $this->base_model->run_query("select * from quizsubscriptions where quizid = ".$id."");
			$this->data['paymenttable'] = $paymenttable;
			
			$payment_info = $this->base_model->run_query("select * from quizsubscriptions where quizid = ".$id." and user_id=".$this->ion_auth->user()->row()->id." and status='Active' and (remainingattempts > 0 or expirydate > '".date('Y-m-d')."')");
			$this->data['is_authorized'] = FALSE;
			if ((isset($payment_info) && count($payment_info)>0) || $records[0]->quiztype=='Free') {
					$this->data['is_authorized'] = TRUE;
					$this->data['payment_info'] = $payment_info;
					
		$payment_info = $this->base_model->run_query("select * from quizsubscriptions where quizid = ".$id."");
			
				/**THIS BELOW INFORMATION WILL BE FETCHED BACK AT THE TIME OF STARTING THE EXAM(exam/startexam)
				** DESTROYED AFTER FINISHING EXAM
				**/
				$validity_type  = ''; 
				$account_id 	= '';
				if ($records[0]->quiztype=='Paid') {
					$validity_type 	= $payment_info[0]->remainingattempts;
					$account_id 	= $payment_info[0]->id;
				}
				$account_validation = array(
										'is_authorized'		=> $this->data['is_authorized'],
										'quiz_type'			=> $records[0]->quiztype,
										'validitytype'		=> $records[0]->validitytype,
										'validityvalue'		=> $validity_type,
										'account_id'		=> $account_id
										);
				$this->session->set_userdata('account_validation',$account_validation);
				$this->session->set_userdata('is_user_account_modified',0);
				//UNSET SESSION QUESTIONS. AND SET THE isExamStarted BIT TO 1. 
				//So that for every request (quiz/exam) new questions will be created.
				$this->session->unset_userdata('questions');
				$this->session->set_userdata('isExamStarted', 1);
			}
			$this->_render_page('temp/usertemplate', $this->data);
		}
		else {
			$this->prepare_flashmessage("Invalid attempt to take exam...", 1);
			redirect('user/quizzes', 'refresh');
		}
		
	}
	
	//User Quiz History
	function quiz_history()
	{
		$userid = $this->session->userdata('user_id');
		$today = date('Y-m-d');
		$commontable = "quizsubscriptions";
		$status = FALSE;
		
		$is_performance_report_for = $this->base_model->run_query("SELECT is_performance_report_for FROM general_settings");
		
		if($is_performance_report_for[0]->is_performance_report_for == "Paidusers") {
		$query = $this->db->query("SELECT * FROM ".$commontable." WHERE user_id=".$userid);
			if($query->num_rows()>0)
				$status = TRUE;
			else
				$status = FALSE;
		} 
		else {
			$status = TRUE;
		}
		if (isset($userid) && $userid != '' && is_numeric($userid)) {
		
			if($status) {
			
				$records = $this->base_model->run_query(
				"select qr.*,q.* from ".$this->db->dbprefix('user_quiz_results')
				." qr,".$this->db->dbprefix('quiz')." q where q.quizid=qr.quiz_id 
				and qr.userid=".$userid
				);
				$index = array();
				for($i=0,$j=0;$i<count($records);$i++) {
					
					if($records[$i]->quiztype == "Paid")
	$query = $this->base_model->run_query("SELECT * FROM quizsubscriptions WHERE quizid =".$records[$i]->quiz_id);
					elseif($records[$i]->quiztype == "Free")
						continue;
					
					if(!count($query)>0) {
					   $index[$j] = $i; 
					   $j++;
					}
					
				}
				for($i=0;$i<count($index);$i++)
					unset($records[$index[$i]]);
				 
				$this->data['quiz_history'] 	= $records;
				$this->data['title'] 			= 'Exam/Quiz History';
				$this->data['active_menu'] 		= 'quiz_history';
				$this->data['content'] 			= 'user/exam/examhistory';
				$this->_render_page('temp/usertemplate', $this->data);
			}
			else {
				$this->prepare_flashmessage('Sorry. Quiz performance report is only for premium members.', 2);
				redirect('user', 'refresh');
			}
		} else {
		
			$this->prepare_flashmessage('Session Expired!', 2);
			redirect('user', 'refresh');
		
		}
	}
	
	//User Quiz Exam Review
	function review_result()
	{
		$questArray = array();
		$questions = $this->base_model->run_query(
			"select qr.*,u.image,qu.name,uqr.score,uqr.total_questions,uqr.timeoftest from ".$this->db->dbprefix('questions_review')
				." qr,".$this->db->dbprefix('users')." u,".$this->db->dbprefix('user_quiz_results_history')." uqr,".$this->db->dbprefix('quiz')." qu where u.id=qr.userid and qr.uqrc=uqr.uqrc and qu.quizid=qr.quiz_id and qr.quiz_id=uqr.quiz_id and uqr.uqrc ='".$this->uri->segment(3)."'"
				);
				
			array_push($questArray, $questions);			
			$this->session->set_userdata('questions', $questArray);
		
		$answers 						= '';
		$quizinfo 						= $this->session->userdata('quiz_info');
		$totalQuestions 				= $this->session->userdata('totalQuestions');
		$quizRecords 					= $this->session->userdata('quizRecords');
		$questions 						= $this->session->userdata('questions');
		$answers 						= $this->session->userdata('answers');
		$score 							= 0;
		$useroptions 					= '';
		$not_attempted 					= 0;
		
		
		
			$this->data['quiz_info'] 		= $quizinfo;
			$this->data['totalQuestions'] 	= $totalQuestions;
			$this->data['quizRecords'] 		= $quizRecords;
			$this->data['answers'] 			= $answers;
			$this->data['questions'] 		= $questions;
			$this->data['user_options'] 	= $useroptions;
			$attempted 						= $totalQuestions-$not_attempted;
			$wrongAnswers 					= $attempted-$score;
			
			
			
			
			/**
			* If any question attempted and  Negative mark status of Quiz is active, 
			* the Total Score is
			* 
			*/
			if ($quizinfo->negativemarkstatus == "Active" && $attempted!=0) {
				$negativeMark 			= floatval($quizinfo->negativemark);				
				$totalNegativeMark 		= $wrongAnswers*$negativeMark;
				$score 					-= $totalNegativeMark;
				$this->data['negativeMark'] = $negativeMark;
			}						
			$this->data['attempted'] 	= $attempted;
			$this->data['score'] 		= $score; 
			$this->data['attempted_percentage'] = 0;
			if ($attempted != 0) {
				$this->data['attempted_percentage'] = number_format(
				(($attempted/$totalQuestions)*100),2
				);
			}
				
			$this->data['score_percentage'] = 0;
			if ($score != 0) {
				$this->data['score_percentage']=number_format(
				(($score/$totalQuestions)*100),2
				);
			}
			
			$this->data['wrong_percentage'] 	= 0;
			if ($wrongAnswers != 0) {
				$this->data['wrong_percentage'] = number_format(
				(($wrongAnswers/$attempted)*100),2
				);
			}
		
			if (isset($useroptions) && count($useroptions)>0) {
				$userid = $this->session->userdata('user_id');
				unset($where);
				unset($records);
				$data['userid'] 			= $userid;
				$data['email'] 				= $this->session->userdata('email');
				$data['username'] 			= $this->session->userdata('username');
				$data['quiz_id'] 			= $quizinfo->quizid;
				$data['score'] 				= $score;
				$data['total_questions'] 	= $totalQuestions;
				$data['dateoftest'] 		= date('y-m-d');
				$data['timeoftest'] 		= date('H:i');
				
				unset($where); 
				unset($records);
				
				//$questions = $this->base_model->run_query(
//				"select qr.*,u.image,qu.name from ".$this->db->dbprefix('questions_review')
//				." qr,".$this->db->dbprefix('users')." u,".$this->db->dbprefix('quiz')." qu where u.id=qr.userid 
//				and qu.quizid=qr.quiz_id and qr.quiz_id=2"
//				);		
				
				
				
				
				
				$this->data['previous_score'] 	= $records;
				//$this->data['useranswer'] 	= $records;
				$this->data['active_menu'] 		= 'exams';
				$this->data['title'] 			= 'Exam/Quiz Result';
				$this->data['content'] 			= 'user/exam/review_result';
				$this->_render_page('temp/usertemplate', $this->data);
			}
					
	}
	
	//User Quiz wise Performance History
	function performance()
	{
		$userid 	= $this->session->userdata('user_id');
		$query 		= "SELECT * FROM ".$this->db->dbprefix('user_quiz_results_history')
		." where userid = ".$userid ." limit 10";
		
		if ($this->uri->segment(3)) {
			$quiz_id 					= $this->uri->segment(3);
			$query = "select qh.*,q.* from "
			.$this->db->dbprefix('user_quiz_results_history')." qh,"
			.$this->db->dbprefix('quiz')." q where q.quizid=qh.quiz_id 
			and qh.userid=".$userid." and qh.quiz_id=".$quiz_id." 
			ORDER BY dateoftest ASC limit 10";
		}
		$data = $this->base_model->run_query($query);
		$this->data['info'] 			= "Performance Report of ".$data[0]->username;
		if ($this->uri->segment(3)) {
			$this->data['info'] 		= "Performance Report of "
			.$data[0]->username." in ".$data[0]->name;
		}
		$result 						= array( );
		$temp							= array();
		array_push($temp, "Date", "Score", "Total Questions");
		array_push($result, $temp);
		foreach ($data as $d) {
			$temp = array();
			array_push(
			$temp, 
			$d->dateoftest."  (".$d->score."/".$d->total_questions.")", 
			$d->score,$d->total_questions
			);
			array_push($result, $temp);
		}
		$str 							= "";
		$cnt 							= 0;
		foreach ($result as $r) {
			if ($cnt++ == 0) {
				$str = $str . "['".$r[0]."','".$r[1]."','".$r[2]."'],";
			}
			else {
				$str = $str . "['".$r[0]."',".$r[1].",".$r[2]."],";
			}
		}
		$this->data['result'] 			= $str;
		$this->data['active_menu'] 		= 'exams';
		$this->load->view('user/exam/performance', $this->data);
	}
	
	
	//View Quizzes
	  function quizzes()
    {        //echo "hello"; die();
	$this->data['records_for_all'] = array();
        //Options for Quiz Type
        $qztype['']                     = 'Select Quiz Type';
        $qztype['Free']                 = 'Free';
        $qztype['Paid']                 = 'Paid';
        $this->data['quiztypes']         = $qztype;
        
        //Options for Difficulty Level
        $dlevel['']                     = 'Select Difficulty Level';
        $dlevel['Easy']                 = 'Easy';
        $dlevel['Medium']                 = 'Medium';
        $dlevel['High']                 = 'High';
        $this->data['difficultylevels'] = $dlevel;
        
        //Options for Categories
        $catOptions['']                 = 'Select Category';
        $catRecords                     = $this->base_model->fetch_records_from(
        $this->db->dbprefix('categories')
        );
        foreach ($catRecords as $key=> $val) {
            $catOptions[$val->catid]    = $val->name;
        }
        $this->data['categories']         = $catOptions;
        $this->data['data']             = array();        
        $this->data['title']             = 'Quizzes';
        $this->data['active_menu']         = 'exams';
        
        // Code written for fetching quizzes based on admin restrictions
        $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        $today = date('Y-m-d');
        if($check[0]->quizzes_for == "groupquizzes") {
        
        
        
        $userid = $this->ion_auth->get_user_id();
    
        $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
        
        
        $this->data['records']             = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s,  ".$this->db->dbprefix('quiz_for')." qf 
        where c.catid=q.catid AND s.subcatid=q.subcatid 
        AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid ) 
        AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid"
        );
        
        
        $this->data['records_for_all']     = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s  where c.catid=q.catid AND s.subcatid=q.subcatid 
        AND q.quiz_for != '*' and q.status = 'Active'  
        AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid"
        );
        
        //echo "<pre>"; print_r($this->data['records_for_all']); die();
        
        } else {        
        
        $this->data['records']             = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
        AND s.subcatid=q.subcatid AND q.status='Active' AND q.enddate>='".$today."'"  
        );
        
        }
        
        $this->data['content']             = 'user/exam/quizzes';
        $this->_render_page('temp/usertemplate', $this->data);
    } 
	
	//View Review Quizzes
	  function review_quizzes()
    {        //echo "hello"; die();
	$this->data['records_for_all'] = array();
        //Options for Quiz Type
        $qztype['']                     = 'Select Quiz Type';
        $qztype['Free']                 = 'Free';
        $qztype['Paid']                 = 'Paid';
        $this->data['quiztypes']         = $qztype;
        
        //Options for Difficulty Level
        $dlevel['']                     = 'Select Difficulty Level';
        $dlevel['Easy']                 = 'Easy';
        $dlevel['Medium']                 = 'Medium';
        $dlevel['High']                 = 'High';
        $this->data['difficultylevels'] = $dlevel;
        
        //Options for Categories
        $catOptions['']                 = 'Select Category';
        $catRecords                     = $this->base_model->fetch_records_from(
        $this->db->dbprefix('categories')
        );
        foreach ($catRecords as $key=> $val) {
            $catOptions[$val->catid]    = $val->name;
        }
        $this->data['categories']         = $catOptions;
        $this->data['data']             = array();        
        $this->data['title']             = 'Quizzes';
        $this->data['active_menu']         = 'exams';
        
        // Code written for fetching quizzes based on admin restrictions
        $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        $today = date('Y-m-d');
        if($check[0]->quizzes_for == "groupquizzes") {
        
        
        
        $userid = $this->ion_auth->get_user_id();
    
        $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
        
        
        $this->data['records']             = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s,  ".$this->db->dbprefix('quiz_for')." qf 
        where c.catid=q.catid AND s.subcatid=q.subcatid 
        AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid ) 
        AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid"
        );
        
        
        $this->data['records_for_all']     = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s  where c.catid=q.catid AND s.subcatid=q.subcatid 
        AND q.quiz_for != '*' and q.status = 'Active'  
        AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid"
        );
        
        //echo "<pre>"; print_r($this->data['records_for_all']); die();
        
        } else {        
        
        $this->data['records']             = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
        AND s.subcatid=q.subcatid AND q.status='Active' AND q.enddate>='".$today."'"  
        );
		
		
		$this->data['records'] = $this->base_model->run_query(
			"select DISTINCT uqr.quiz_id,uqr.*,qu.name from ".$this->db->dbprefix('users')." u,".$this->db->dbprefix('user_quiz_results_history')." uqr,".$this->db->dbprefix('quiz')." qu where qu.quizid=uqr.quiz_id"
				);
        
        }
        
        $this->data['content']             = 'user/exam/review_quizzes';
        $this->_render_page('temp/usertemplate', $this->data);
    } 
	
	//Get Quizzes by user selected Options like Category, Sub Category, Quiz Type 
	//and Difficulty Level.
	function get_quizzes()
    {
        $today = date('Y-m-d');
        
        $category_id                     = $this->input->post('catid');
        $sub_category_id                 = $this->input->post('subcatid');
        $quiz_type                         = $this->input->post('quiztype');
        $difficulty_level                 = $this->input->post('difficultylevel');        
        $cond1                             = 1; 
        $cond_val1                        = 1;
        $cond2                             = 1; 
        $cond_val2                        = 1;
        $cond3                             = 1; 
        $cond_val3                        = 1;
        $cond4                             = 1; 
        $cond_val4                        = 1;
        $cond5                             = 1;
        $cond6                             = "";
        $cond7                             = 1;
        $cond8                             = "";
        $cat_table                         = '';
        $sub_cat_table                     = '';
        
        if (trim($category_id) != "") {
            $cond1                         = "q.catid"; 
            $cond_val1                    = $category_id;            
        }
        if (trim($sub_category_id) != "") {
            $cond2                         = "q.subcatid"; 
            $cond_val2                     = $sub_category_id;            
        }
        if (trim($quiz_type) != "") {
            $cond3                         = "q.quiztype"; $cond_val3= $quiz_type;
        }
        if (trim($difficulty_level) != "") {
            $cond4                         = "q.difficultylevel"; 
            $cond_val4                     = $difficulty_level;
        }
        
        if(
        trim($category_id)         !=""     || 
        trim($sub_category_id)     !=""     || 
        trim($quiz_type)         !=""     || 
        trim($difficulty_level) !=""
        ) {
            $cond5                         = "c.catid";
            $cond6                         = ", c.name as catname";
            $cat_table                     = ', '.$this->db->dbprefix('categories').' c';
            $cond7                         = "s.subcatid";
            $cond8                         = ", s.name as subcatname";
            $sub_cat_table                 = ', '.$this->db->dbprefix('subcategories').' s';
            
            $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        
            if($check[0]->quizzes_for == "groupquizzes") {
            
                $userid = $this->ion_auth->get_user_id();
    
                $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
                
                $query      = 'select q.*'.$cond6.$cond8.' from '
                .$this->db->dbprefix('quiz').' q'.$cat_table.$sub_cat_table.', '.$this->db->dbprefix('quiz_for').' qf
                where '.$cond1.'='.$cond_val1.' and '.$cond2.'='.$cond_val2
                .' and '.$cond3.'="'.$cond_val3.'" and '.$cond4.'="'.$cond_val4
                .'" and '.$cond5.'=q.catid and '.$cond7.'=q.subcatid 
                AND (qf.groupid = '.$check_user_group[0]->group.' and qf.quizid = q.quizid )
                AND q.status="Active" AND q.enddate>="'.$today.'" group by q.quizid';
            
            } else {
            
                $query                         = 'select q.*'.$cond6.$cond8.' from '
                .$this->db->dbprefix('quiz').' q'.$cat_table.$sub_cat_table
                .' where '.$cond1.'='.$cond_val1.' and '.$cond2.'='.$cond_val2
                .' and '.$cond3.'="'.$cond_val3.'" and '.$cond4.'="'.$cond_val4
                .'" and '.$cond5.'=q.catid and '.$cond7.'=q.subcatid AND q.status="Active" AND q.enddate>="'.$today.'"';
                        
            }        
            
        }
        else {
            
            $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        
            if($check[0]->quizzes_for == "groupquizzes") {
            
                $userid = $this->ion_auth->get_user_id();
    
                $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
                
                $query = "select q.*,c.name as catname,s.name as subcatname from "
                .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
                ." c,".$this->db->dbprefix('subcategories')." s, ".$this->db->dbprefix('quiz_for')." qf where c.catid=q.catid 
                and s.subcatid=q.subcatid AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid )
                AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid";
            
            } else {
            
                $query = "select q.*,c.name as catname,s.name as subcatname from "
                .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
                ." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
                and s.subcatid=q.subcatid AND q.status='Active' AND q.enddate>='".$today."'";
            
            }            
            
        }
        $records=$this->base_model->run_query($query);
        echo json_encode($records);    
    }
	
	//Fetch Subjects according to Quiz
	function get_subjects()
	{
		$id=$this->input->post('quizid');
		$sub=$this->base_model->run_query(
		"select qq.*,s.name as subjectname from "
		.$this->db->dbprefix('quizquestions')." qq,"
		.$this->db->dbprefix('subjects')." s where s.subjectid=qq.subjectid 
		and qq.quizid=".$id
		);
		echo json_encode($sub); 
	}
	
	
	//Download the Certificate for the Quiz which consists of best score 
	// among all attempts for the quiz.
	function certificate()
	{
		if ($this->uri->segment(3)) {
			$userid 					= $this->session->userdata('user_id');
			$quizid 					= $this->uri->segment(3);
			//general_settings
			$quizinfo 					= $this->base_model->run_query(
			"SELECT r.username,r.email,r.score,r.total_questions 
			as maxscore,r.dateoftest,q.name as examname FROM "
			.$this->db->dbprefix('user_quiz_results')." r, "
			.$this->db->dbprefix('quiz')." q WHERE userid=".$userid
			." and quiz_id=".$quizid." and r.quiz_id=q.quizid"
			);
			$quizinfo 					= $quizinfo[0];
			$contentinfo 				= $this->base_model->run_query(
			"select   certificate_logo,certificate_content,
			certificate_sign,certificate_sign_text from "
			.$this->db->dbprefix('general_settings')
			);
			$contentinfo 				= $contentinfo[0];
			$this->data['content'] 		= $contentinfo->certificate_content;
			$this->data['adminsign'] 	= $contentinfo->certificate_sign_text;
			$this->data['signimage'] 	= $contentinfo->certificate_sign;
			$this->data['logo'] 		= $contentinfo->certificate_logo;
			$this->data['content']		= str_replace(
			"__USERNAME__", 
			$quizinfo->username, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__USERID__",$userid, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__EMAIL__", 
			$quizinfo->email, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__COURSENAME__", $quizinfo->examname, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__SCORE__",
			$quizinfo->score, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__MAXSCORE__", 
			$quizinfo->maxscore, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__DATEOFTEST__", 
			$quizinfo->dateoftest, 
			$this->data['content']
			);
			 $html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 
			 Transitional//EN' ' http://www.w3.org/TR/xhtml1/DTD/xhtml1-
			 transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Certificate</title><style>
.certificates {
	width: 680px;
	height: 470px;
	float: left;
	background: url(". base_url()."assets/uploads/certificate/"
	.$this->data['logo'].")
}
.name {
	width: 100%;
	float: left;
	margin-top: 50px;
	text-align: center;
}
.address {
	width: 28%;
	float: right;
	font-family: 'open Sans';
	text-align: left;
	font-size: 13px;
	margin-right: 35px;
	line-height: 20px;
}
.middle-con {
	width: 100%;
	margin: 0px auto;
	margin-top: 100px;
	clear: both;
}
.hed {
	border-bottom: 3px solid;
	font-family: 'open Sans';
	font-size: 17px;
	font-style: italic;
	font-weight: bold;
	margin: 0 auto;
	text-align: center;
	width: 50%;
}
.clear {
	clear: both;
}
.certi-description {
	width: 90%;
	margin: 0px auto;
	clear: both;
	font-family: 'open Sans';
	font-size: 14px;
	text-align: center;
	line-height: 30px;
	text-decoration: underline;
	margin-top: 0px;
	font-style: oblique;
}
.dmmm {
	font-weight: bold;
}
.sgn-ture {
	width: 250px;
	margin: -110px 42px;
	clear: both; float:right;
	 
}

.facualty{ width:250px; float:left; text-align:center; 
 font-family:'open Sans'; font-size:14px; font-weight:bold;}
.director{ width:250px; float:right; text-align:center; 
 font-family:'open Sans'; font-size:14px; font-weight:bold;}
.sign{ float:left; width:250px;}
</style></head>
<body>
<div class='certificates'>
 <br> 
  <div class='middle-con'>
    <div class='hed'> This is to certify that
      <div class='clear'></div>
    </div>
    <div class='clear'></div>
    <div class='certi-description'>".
$this->data['content']
	."</div>
  </div>
  <div class='clear'></div>
  <div class='sgn-ture'>

  <div class='director'><div class='sign'><img src="
  .base_url()."assets/uploads/certificate/".$this->data['signimage']
  ." width='111' height='63' /></div>".$this->data['adminsign']." </div>
  
  <div class='clear'></div>
  </div>
</div>
</body>
</html>";
	$this->data['html'] 				= $html;	

$filename = $userid;
		$pdfFilePath 					= FCPATH."assets/downloads/reports/".$filename.".pdf";

		$data['page_title'] 			= 'Certificate'; // pass data to the view
		 unlink($pdfFilePath); 
		if (file_exists($pdfFilePath) == FALSE) {
		    ini_set('memory_limit','32M'); 
		 $this->load->library('pdf');
		    $pdf 						= $this->pdf->load();
		    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
	redirect("assets/downloads/reports/$filename.pdf"); 
		}
		else {
			 echo "Some problem is their, please contact admin regarding this..";
		}
		$this->load->view('certificate', $this->data);
	}
	
	
	//Payment Process For Paypal
	function paymentPaypal($param1, $param2, $param3)
	{
		//IT IS A VALID REQUEST
			//EVENTHOUGH WE NEED TO GET THE COST OF THE EXAM FROM DB
			
			$table 									= $this->db->dbprefix('quiz');
			$condition['quizid']					= $param2;
			$examdetails 							= $this->base_model->fetch_records_from(
													$table, 
													$condition);
			if(count($examdetails)<= 0)
				redirect('user/paymentPaypal');
			$examdetails 								= $examdetails[0];
			$subscription_info['user_id'] 				= $this->ion_auth->user()->row()->id;
			$subscription_info['quizid'] 				= $examdetails->quizid;
			$subscription_info['validitytype']			= $examdetails->validitytype;
			$subscription_info['validityvalue'] 		= $examdetails->validityvalue;
			$subscription_info['expirydate'] 			= '';
			if ($examdetails->validitytype == 'Days')
			{
				$Date 									= date('Y-m-d');
				$exp_date 								= date('Y-m-d', strtotime(
															$Date. ' + '
															.$examdetails->validityvalue
															.' days'
															));
				$subscription_info['expirydate']	 	= $exp_date;
			}
			$subscription_info['remainingattempts'] 	= $examdetails->validityvalue;
			$subscription_info['status']				= 'Active';
			$subscription_info['dateofsubscription'] 	= date('Y-m-d');
	
	
		//PAYMENT METHODS VALIDATION
		if ($param1 == "paypal" && isset($param2) && 
			$param2 != '' && is_numeric($param2)  &&
			$param3 != '' && is_numeric($param3)) {
			
			$this->session->set_userdata('subscription_data', $subscription_info);
			$this->session->set_userdata('subscription_examname', $examdetails->name);
			$payment_info = $this->base_model->fetch_records_from(
			'paypal', 
			array('status' => 'Active')
			);
			if (count($payment_info) > 0) {
				$payment_info = $payment_info[0];
				$config['business'] 			= $payment_info->paypal_email;
				//Image header url [750 pixels wide by 90 pixels high]
				$config['cpp_header_image'] 	= base_url()."assets/uploads/paypal_logo/logo.jpg";
				$config['return'] 				= base_url().'user/payment_success';
				$config['cancel_return'] 		= base_url().'user/payment_cancel';
				$config['notify_url'] 			= '';//'process_payment.php'; //IPN Post
				$config['production'] 			= FALSE;
				
				if ($payment_info->account_type != 'Sandbox')
					$config['production'] 		= TRUE; 
					
				$config['currency_code'] 		= $payment_info->currency_code; 
				$this->load->library('paypal', $config);
				$this->paypal->add($examdetails->name, $examdetails->quizcost); 	  //ADD  item
				$this->paypal->pay(); //Proccess the payment For Paypal
			}
			else { 
				$this->prepare_flashmessage("Please contact admin for this payment gateway", 1);
				$quizid 						= $subscriptioninfo['quizid'];
				//remove session data
				$this->session->unset_userdata('subscription_data');
				$this->session->unset_userdata('subscription_examname');
				redirect ('user/instructions/'.$quizid, 'refresh');
			}
		}
		$this->prepare_flashmessage("Invalid request", 1);
		redirect ('user/index', 'refresh');
	}
	
	//Payment Process For Payu
	function paymentPayu($param1, $param2, $param3)
	{
		//IT IS A VALID REQUEST
			//EVENTHOUGH WE NEED TO GET THE COST OF THE EXAM FROM DB
			
			$table 									= $this->db->dbprefix('quiz');
			$condition['quizid']					= $param2;
			$examdetails 							= $this->base_model->fetch_records_from(
													$table, 
													$condition);
			if(count($examdetails)<= 0)
				redirect('user/paymentPayu');
			$examdetails 								= $examdetails[0];
			$subscription_info['user_id'] 				= $this->ion_auth->user()->row()->id;
			$subscription_info['quizid'] 				= $examdetails->quizid;
			$subscription_info['quizcost'] 				= $examdetails->quizcost;
			$subscription_info['validitytype']			= $examdetails->validitytype;
			$subscription_info['validityvalue'] 		= $examdetails->validityvalue;
			$subscription_info['expirydate'] 			= '';
			if ($examdetails->validitytype == 'Days')
			{
				$Date 									= date('Y-m-d');
				$exp_date 								= date('Y-m-d', strtotime(
															$Date. ' + '
															.$examdetails->validityvalue
															.' days'
															));
				$subscription_info['expirydate']	 	= $exp_date;
			}
			$subscription_info['remainingattempts'] 	= $examdetails->validityvalue;
			$subscription_info['status']				= 'Active';
			$subscription_info['dateofsubscription'] 	= date('Y-m-d');
	
	
		//PAYMENT METHODS VALIDATION
		if ($param1 == "payu" && isset($param2) && 
			$param2 != '' && is_numeric($param2)  &&
			$param3 != '' && is_numeric($param3)) {
			
			$this->session->set_userdata('subscription_data', $subscription_info);
			$this->session->set_userdata('subscription_examname', $examdetails->name);
			$payment_info = $this->base_model->fetch_records_from(
			'payu', 
			array('status' => 'Active')
			);
			if (count($payment_info) > 0) {
				$payment_info = $payment_info[0];
				$config['key'] 			= $payment_info->merchant_key;
				$config['salt'] 		= $payment_info->salt;
				
				$config['surl'] 				= base_url().'user/payment_success';
				$config['furl'] 				= base_url().'user/payment_cancel';				
				$config['live'] 			= FALSE;
				
				if ($payment_info->account_type != 'TEST')
					$config['live'] 		= TRUE; 
					
				$config['key'] 			= $payment_info->merchant_key;
				$config['salt'] 		= $payment_info->salt;
				$config['productinfo']	= $examdetails->name;
				$config['amount']	= $examdetails->quizcost;
				$config['quizid']	= $examdetails->quizid;	
		
			return redirect('user/Pay_form'.'/'.'payu'.'/'.$examdetails->quizid.'/'.$examdetails->quizcost);
				
			}
			else { 
				$this->prepare_flashmessage("Please contact admin for this payment gateway", 1);
				$quizid 						= $subscriptioninfo['quizid'];
				//remove session data
				$this->session->unset_userdata('subscription_data');
				$this->session->unset_userdata('subscription_examname');
				redirect ('user/instructions/'.$quizid, 'refresh');
			}
		}
		$this->prepare_flashmessage("Invalid request", 1);
		redirect ('user/index', 'refresh');
	}
	
	function PaymentOffline($param1, $param2, $param3)
	{
			$table 									= $this->db->dbprefix('quiz');
			$condition['quizid']					= $param2;
			$examdetails 							= $this->base_model->fetch_records_from(
													$table, 
													$condition);
													
			$examdetails 								= $examdetails[0];
			$subscription_info['user_id'] 				= $this->ion_auth->user()->row()->id;
			$subscription_info['quizid'] 				= $examdetails->quizid;
			$subscription_info['quizcost'] 				= $examdetails->quizcost;
			$subscription_info['validitytype']			= $examdetails->validitytype;
			$subscription_info['validityvalue'] 		= $examdetails->validityvalue;
			$subscription_info['remainingattempts'] 	= $examdetails->validityvalue;
			$subscription_info['status']				= 'Inactive';
			if ($examdetails->validitytype == 'Days')
				{
				$Date 									= date('Y-m-d');
				$exp_date 	= date('Y-m-d', strtotime($Date. ' + '.$examdetails->validityvalue.' days'));
				$subscription_info['expirydate']	 	= $exp_date;
				}	
			$subscription_info['dateofsubscription'] 	= date('Y-m-d');
		
		if ($param1 == "Offline" && isset($param2) && 
			$param2 != '' && is_numeric($param2)  &&
			$param3 != '' && is_numeric($param3)) {
			
			$this->session->set_userdata('subscription_data', $subscription_info);
			$this->session->set_userdata('subscription_examname', $examdetails->name);
			
				$user_info = $this->base_model->fetch_records_from('users');
				
				$user_info = $user_info[0];				 
				$subscriptioninfo['payer_name'] 	= $user_info->username;
				$subscriptioninfo['phone'] 			= $user_info->phone;
				$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);			
				
				if ($examdetails->validitytype == 'Days')
				{
				$Date 									= date('Y-m-d');
				$exp_date 	= date('Y-m-d', strtotime($Date. ' + '.$examdetails->validityvalue.' days'));
				$subscription_info['expirydate']	 	= $exp_date;
				}	
				
		$subscriptioninfo 						= $this->session->userdata('subscription_data');
		$subscriptioninfo['transaction_id'] 	= $txnid; 
		$subscriptioninfo['payer_id'] 			= $user_info->email;
		$subscription_info['quizid'] 			= $examdetails->quizid;
		$subscription_info['quizcost'] 			= $examdetails->quizcost; 
		$subscriptioninfo['payer_email'] 		= $user_info->email;
		$subscriptioninfo['payer_name'] 		= $user_info->username;
		$subscription_info['validitytype']			= $examdetails->validitytype;
		$subscription_info['remainingattempts'] 	= $examdetails->validityvalue;
				$subscription_info['status']				= 'Inactive';
			$subscription_info['validityvalue'] 		= $examdetails->validityvalue;
			$subscription_info['expirydate']	 	= $exp_date;
					
			$subscription_info['dateofsubscription'] 	= date('Y-m-d');
		$examname 								= $this->session->userdata('subscription_examname');
		$this->base_model->insert_operation($subscriptioninfo, 'quizsubscriptions');
		$this->prepare_flashmessage(
									"Payment Offline Order Request Successfully Done for the exam <strong>"
									.$examname."</strong> with Transaction ID: <strong>"
									.$subscriptioninfo['transaction_id']."</strong>" , 
									0
									);
		$quizid = $subscriptioninfo['quizid'];
		//remove session data
		$this->session->unset_userdata('subscription_data');
		$this->session->unset_userdata('subscription_examname');
		redirect ('user/instructions/'.$quizid, 'refresh');
			}
	}
	
	function Pay_form($param1, $param2, $param3)
	{
		//IT IS A VALID REQUEST
			//EVENTHOUGH WE NEED TO GET THE COST OF THE EXAM FROM DB
			
			$table 									= $this->db->dbprefix('quiz');
			$condition['quizid']					= $param2;
			$examdetails 							= $this->base_model->fetch_records_from(
													$table, 
													$condition);
			if(count($examdetails)<= 0)
				redirect('user/paymentPayu');
			$examdetails 								= $examdetails[0];
			$subscription_info['user_id'] 				= $this->ion_auth->user()->row()->id;
			$subscription_info['quizid'] 				= $examdetails->quizid;
			$subscription_info['quizcost'] 				= $examdetails->quizcost;
			$subscription_info['validitytype']			= $examdetails->validitytype;
			$subscription_info['validityvalue'] 		= $examdetails->validityvalue;
			$subscription_info['expirydate'] 			= '';
			if ($examdetails->validitytype == 'Days')
			{
				$Date 									= date('Y-m-d');
				$exp_date 								= date('Y-m-d', strtotime(
															$Date. ' + '
															.$examdetails->validityvalue
															.' days'
															));
				$subscription_info['expirydate']	 	= $exp_date;
			}
			$subscription_info['remainingattempts'] 	= $examdetails->validityvalue;
			$subscription_info['status']				= 'Active';
			$subscription_info['dateofsubscription'] 	= date('Y-m-d');
	
	
		//PAYMENT METHODS VALIDATION
		if ($param1 == "payu" && isset($param2) && 
			$param2 != '' && is_numeric($param2)  &&
			$param3 != '' && is_numeric($param3)) {
			
			$this->session->set_userdata('subscription_data', $subscription_info);
			$this->session->set_userdata('subscription_examname', $examdetails->name);
			$payment_info = $this->base_model->fetch_records_from(
			'payu', 
			array('status' => 'Active')
			);
			if (count($payment_info) > 0) {
				$payment_info = $payment_info[0];
				$config['key'] 			= $payment_info->merchant_key;
				$config['salt'] 		= $payment_info->salt;
				
				$config['surl'] 	= base_url().'user/payment_success';
				$config['furl'] 	= base_url().'user/payment_cancel';				
				$config['live'] 	= FALSE;
				
				if ($payment_info->account_type != 'TEST')
					$config['live'] 		= TRUE;
				$user_info = $this->base_model->fetch_records_from('users');
				
				$user_info = $user_info[0];				 
				$config['firstname'] 	= $user_info->username;
				$config['phone'] 	= $user_info->phone;
				$config['key'] 			= $payment_info->merchant_key;
				$config['salt'] 		= $payment_info->salt;
				$config['productinfo']	= $examdetails->name;
				$config['amount']	= $examdetails->quizcost;
				$config['quizid']	= $examdetails->quizid;
				
				
				$this->load->view('user/Pay_form',$config);
				
			}
			}
			
	}
	
	//Payment Success	
	function payment_success()
	{
		$subscriptioninfo 						= $this->session->userdata('subscription_data');
		$subscriptioninfo['transaction_id'] 	= $this->input->post("txnid"); 
		$subscriptioninfo['payer_id'] 			= $this->input->post("id"); 
		$subscriptioninfo['payer_email'] 		= $this->input->post("email"); 
		$subscriptioninfo['payer_name'] 		= $this->input->post("firstname");
		$examname 								= $this->session->userdata('subscription_examname');
		$this->base_model->insert_operation($subscriptioninfo, 'quizsubscriptions');
		$this->prepare_flashmessage(
									"Payment Done Successfully for the exam <strong>"
									.$examname."</strong> with Transaction ID: <strong>"
									.$subscriptioninfo['transaction_id']."</strong>" , 
									0
									);
		$quizid = $subscriptioninfo['quizid'];
		//remove session data
		$this->session->unset_userdata('subscription_data');
		$this->session->unset_userdata('subscription_examname');
		redirect ('user/instructions/'.$quizid, 'refresh');
	}
	
	
	//Payment Cancel		
	function payment_cancel()
	{
		$subscriptioninfo = $this->session->userdata('subscription_data');
		$this->prepare_flashmessage("Payment Cancelled for the exam "
									.$this->session->userdata('subscription_examname'),1);
		$quizid = $subscriptioninfo['quizid'];
		//remove session data
		$this->session->unset_userdata('subscription_data');
		$this->session->unset_userdata('subscription_examname');
		redirect ('user/instructions/'.$quizid, 'refresh');
		
	}

	//Payment History		
	function payment_history()
	{
		$this->data['title'] 			= 'Payment Reports';
		$this->data['active_menu'] 		= 'payment_history'; 
		$this->data['records'] 			= $this->base_model->run_query(
		"SELECT s.transaction_id, s.payer_email, s.payer_name, 
		q.name as quizname, q.quizcost as cost, s.dateofsubscription, q.validitytype, 
		s.expirydate, q.validityvalue, s.remainingattempts FROM "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('quizsubscriptions')
		." s,".$this->db->dbprefix('users')." u  where 
		 s.quizid=q.quizid and s.user_id=u.id and s.user_id = ".$this->session->userdata('user_id')
		);
		$this->data['content'] 			= 'user/reports/payment_history';
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	
	
	// Function For Logout
	function logout()
	{
		
		$this->session->sess_destroy();
		$this->prepare_flashmessage("Logout Successful.", 0);
		redirect('test');
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Teacher extends MY_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	ONLINE HUMAN RESOURCES MANAGEMENT SYSTEM (HRMS)
| -----------------------------------------------------
| AUTHER:			Amit Sadaphal
| -----------------------------------------------------
| EMAIL:			amit.sadaphal@gmail.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY OTS
| -----------------------------------------------------
| WEBSITE:			http://hrms.otsinfotechindia.com     
| -----------------------------------------------------
|
| MODULE: 			Admin
| -----------------------------------------------------
| This is Admin module controller file.
| -----------------------------------------------------
*/
	/***Authenticate Admin for each function by calling the Parent Method 
	validate_admin() in Constructor***/
	function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
		$this->load->model('base_model');				
		$this->load->library('form_validation');
		
		$this->load->library('session');
		
		$userinfo = $this->base_model->run_query(
		"select * from tbl_teacher where Tecid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
		
    }
	
	/***Admin Dashboard (Default Function. If no function is called, this function
	 will be called)***/
	/////////////////////////
	function getid($empid)
	{
	$this->db->select("aid");
	$this->db->from("tbl_teacher");
    $this->db->where("Tecid",$empid);
	$result=$this->db->get();
	$res=$result->result_array();
    return $res[0]['aid'];	
	}
	
	function view($filename,$data)
	{
    $tid = $this->getid($this->session->userdata('empid'));
	$eid=$this->session->userdata('empid');
	$this->db->select("*");
	$this->db->from("main_menu a");
	$this->db->join("menu_user b",'a.id=b.menu_id','Inner Join');
    $this->db->where("a.menu_type",1);
	$this->db->where("b.user_id",$tid);
	$this->db->where("b.eid",$eid);
	//$where1 = "FIND_IN_SET('".$this->session->userdata('user_role')."', user_role)";
	//$this->db->where($where1);
	$this->db->where("a.menu_status",'active');
	$this->db->order_by("a.seq");
	$result=$this->db->get();	
	foreach($result->result_array() as $key=>$value)
	{
	$lll[$key]=$value;
	$lll[$key]['child']=$this->get_menu($lll[$key]['id']);
	$lll[$key]['childcount']=count($this->get_menu($lll[$key]['id']));
	//echo count($this->get_menu($lll[$key]['id']));
	foreach($this->get_menu($lll[$key]['id']) as $key1=>$ppp)
	{
	$lll[$key]['child'][$key1]['subchild']=$this->get_menu($ppp['id']);	
	$lll[$key]['child'][$key1]['subchildcount']=count($this->get_menu($ppp['id']));
	foreach($this->get_menu($ppp['id']) as $key2=>$ccc);
	{
	$lll[$key]['child'][$key1]['subchild'][$key2]['subsubchild']=$this->get_menu($ccc['id']);
	$lll[$key]['child'][$key1]['subchild'][$key2]['subsubchildcount']=count($this->get_menu($ccc['id']));	
	}
	}
	}
	$data['data']=$lll;	
	$this->load->view($filename,$data);
	}
	
	function menu_mange()
	{
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_type",1);
	$result=$this->db->get();	
	foreach($result->result_array() as $key=>$value)
	{
	$lll[$key]=$value;
	$lll[$key]['child']=$this->get_menu_action($lll[$key]['id']);
	foreach($this->get_menu_action($lll[$key]['id']) as $key1=>$ppp)
	{
	$lll[$key]['child'][$key1]['subchild']=$this->get_menu_action($ppp['id']);
	}
	}
	$data['data1']=$lll;
	$this->load->view('teacher/menu_manage',$data);
	}
	function menu_manage_sidebar()
	{
		
		$userinfo = $this->base_model->run_query(
		"select * from tbl_teacher where Tecid ='".$this->session->userdata('empid')."' and status='Active'");
		$data['userinfo'] 	= $userinfo;
		
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_type",1);
	$result=$this->db->get();	
	foreach($result->result_array() as $key=>$value)
	{
	$lll[$key]=$value;
	$lll[$key]['child']=$this->get_menu_action($lll[$key]['id']);
	foreach($this->get_menu_action($lll[$key]['id']) as $key1=>$ppp)
	{
	$lll[$key]['child'][$key1]['subchild']=$this->get_menu_action($ppp['id']);	
	foreach($this->get_menu($ppp['id']) as $key2=>$ccc)
	{
	$lll[$key]['child'][$key1]['subchild'][$key2]['subsubchild']=$this->get_menu($ccc['id']);	
	}
	}
	}
	$data['data1']=$lll;
	$this->view('teacher/menu_manage_sidebar',$data);
	}
	
	function get_menu($parent)
	{
	$tid = $this->getid($this->session->userdata('empid'));
	$eid=$this->session->userdata('empid');
	$this->db->select("*");
	$this->db->from("main_menu a");
	$this->db->join("menu_user b",'a.id=b.menu_id','Inner Join');
    $this->db->where("a.menu_parent",$parent);
	$this->db->where("a.menu_status",'active');
	$this->db->where("b.user_id",$tid);
	$this->db->where("b.eid",$eid);
	$result=$this->db->get();	
	return $result->result_array();
	}	
	
	function get_menu_action($parent)
	{
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_parent",$parent);
	$result=$this->db->get();	
	return $result->result_array();
	}
	function getdata()
	{
	if($_POST['value'])
	{
	$arry=array('menu_status'=>'deactive');
	$this->db->update('main_menu',$arry,array('id'=>$_POST['value']));
		}
	if($_POST['devalue'])
		{
	$arry=array('menu_status'=>'active');
	$this->db->update('main_menu',$arry,array('id'=>$_POST['devalue']));
		}
	}
	/////////////////////////
	function index()
	{				
		redirect('teacher/dashboard',$this->data);
	}
	/***Admin Dashboard***/
	function dashboard()
	{
		//Notification Script Start
		//Notifications
		$table 							= $this->db->dbprefix('tbl_notification');
		$notifications 					= $this->base_model->run_query("select * from "
		.$table." where status = 'Active' and last_date>='"
		.date('Y-m-d')."' ORDER BY id DESC LIMIT 10"
		);
		
		//Today Birthday		
		$todaybirthday 	= $this->base_model->run_query(
		"SELECT * FROM tbl_teacher WHERE DATE_FORMAT((dob),'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')");
		
		//Birthday List
		$birthdaycalendar 				= $this->base_model->run_query(
		"SELECT * FROM  tbl_teacher WHERE  DATE_ADD(dob, INTERVAL YEAR(CURDATE())-YEAR(dob) + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(dob),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 MONTH) ORDER BY DATE_FORMAT(dob,'%m-%d')");
		
		//Holiday Calendar Script Start		
		$holidaycalendar 				= $this->base_model->run_query(
		"select * from tbl_holiday where holiday_assign_coaching = '".$this->session->userdata('user_role')."' and status ='Active'");
		$this->data['todaybirthday'] 		= $todaybirthday;
		$this->data['birthdaycalendar'] 	= $birthdaycalendar;
		$this->data['holidaycalendar'] 		= $holidaycalendar;		
		$this->data['notifications'] 		= $notifications;		
		$this->data['title'] 				= 'Teacher Dashboard';
		$this->data['active_menu'] 			= 'dashboard';
		$this->data['content'] 				= 'teacher/dashboard';
		$this->view('teacher/dashboard',$this->data); 	
	}
	
	
	
	function profile()
	{
		$viewteacherinfo = $this->base_model->run_query(
		"select * from tbl_teacher where Tecid ='".$this->session->userdata('empid')."'");
		$this->data['viewteacherinfo'] 	= $viewteacherinfo;
		$this->data['coaching'] = $this->base_model->getCoaching();
		//starts by running the query for the countries dropdown  
      $this->data['countryDrop'] = $this->base_model->getCountries();	  
	  $this->data['stateDrop']= $this->base_model->getStateByCountry();	  
	   $this->data['cityDrop']=$this->base_model->getStateByCity();	
		if(isset($_POST['teacher_update'])!='')
		{
			$this->form_validation->set_rules('Emailid', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('teacher_mobile', 'Mobile No.', 'required|regex_match[/^[0-9]{10}$/]');
			if ($this->form_validation->run() == true)
			{
				
				$data['Tecid'] 				= $this->input->post('teacher_id');
				
				$data['FirstName'] 			= $this->input->post('FirstName');
				$data['LastName'] 			= $this->input->post('LastName');
				$data['gender'] 			= $this->input->post('Gender');
				$data['dob'] 				= $this->input->post('dob');
				$data['anniversary_dob'] 	= $this->input->post('anniversary_dob');
				$data['emailid'] 			= $this->input->post('Emailid');
				
				$data['communication_address'] 		= $this->input->post('communication_address');
				$data['permanent_address'] 			= $this->input->post('permanent_address');
				
				$data['country'] 			= $this->input->post('countriesDrp');
				$data['state'] 				= $this->input->post('StateDrp');
				$data['city'] 				= $this->input->post('cityDrp');
				$data['pincode'] 			= $this->input->post('pincode');
				
				$data['teacher_mobile'] 	= $this->input->post('teacher_mobile');				
				
				$data['father_name'] 		= $this->input->post('father_name');
				$data['father_mobile'] 		= $this->input->post('father_mobile');
				
				$data['father_emailid'] 	= $this->input->post('father_emailid');	
			
				$data['update_date'] 		= date('Y-m-d');					
					
					$where['Tecid'] 		= $this->session->userdata('empid');
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_teacher'), 
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Teacher Information successfully Updated....</font>');
					return redirect('teacher/profile/',$this->data);	
				
		}
		}
		
			$this->data['title'] 		= 'Add Teacher';
			$this->data['active_menu'] 	= 'add teacher';
			$this->data['content'] 		= 'teacher/profile';
			$this->view('teacher/profile',$this->data); 
	}
	function Profilephoto()
	{
		 if ($this->input->post()) {
		   
		   		
				
				//User Photo Upload Process Start
				$image 						= $_FILES['image']['name'];
			
			//Upload User Photo
				if (!empty($image)) {	
				$where['Tecid'] 		= $this->session->userdata('empid');
					$r = $this->base_model->run_query(
					'select teacher_image from '.$this->db->dbprefix('tbl_teacher')
					.' where Tecid ="'.$where['Tecid'].'"'
					);
					if (count($r) > 0) {
					
						if (file_exists('studentimage/'.$r[0]->teacher_image)) {
							unlink('studentimage/'.$r[0]->teacher_image);
						}						
					}
					
					//Unset User Image 
					$this->session->unset_userdata('teacher_image');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."".$where['Tecid'].".".$ext[1];
					
					$inputdata['teacher_image'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'studentimage/'.$img
					);					
					
					//Set User Image
					$this->session->set_userdata('teacher_image',$img);
					
				}			
				//Student Photo Upload Process End
				
				$where['Tecid'] 						= $this->session->userdata('empid');				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('tbl_teacher'), 
				$where); 
				$this->session->set_flashdata('success','Your Profile Photo successfully updated');
				return redirect('teacher/profile');
		 }
				
	}
	function Changepassword()
	{
		 if ($this->input->post()) {
			 
				//Account Seciont - User Password Information Update Fiedls
				
		   		$inputdata['password'] 					= $this->input->post('password');							
				
				$where['Tecid'] 						= $this->session->userdata('empid');		
			 
			 	$this->load->library('email');
				$emailinfo = $this->base_model->run_query("select * from email_setting");
				$this->data['emailinfo'] 		= $emailinfo[0]->smtp_user;
				
				$template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; width=device-width" name="viewport">
<title>Online CMS</title>
<style type="text/css">
.outlook {
  background-color:#ffffff;
  display:none;=20
  display:none !important;
}
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
  <tr>
    <td align="center" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
  <tr>
    <td align="center" valign="top">
    <table width="600" border="0" cellpadding="0" cellspacing="0" class="mobemailfullwidth" align="center">
        <tr>
          <td>         
             <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr><td style="line-height:10px;"><div style="height:10px;"></div></td>
</tr></table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="120" align="center" valign="middle" class="emailcolsplit" style="padding-bottom:10px; padding-top:10px;"><div align="center"><a href="http://Onlinesoftservices.com"><img src="http://otsinfotechindia.com/ots/assets/img/site-image/newlogo.png" width="120" height="45" border="0" alt="" style="display:block;"></a></div></td>
             
 <td width="520" valign="middle" class="emailcolsplit"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr>
                    <td style="padding-left:5px; padding-right:5px; padding-bottom:5px" class="phonenumber" align="right"><font style="font-size:18px; -webkit-text-size-adjust:none; line-height:18px" face="Arial, sans-serif" color="#333333" class="phonenumber"><a href="mob:+91-'.$emailinfo[0]->contact_no.'" style="text-decoration:none"><font color="#333333">24/7 Support: <nobr>+91-'.$emailinfo[0]->contact_no.'</nobr></font></a></font></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
      </table>
      </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
<tr><td style="line-height:10px;"><div style="height:10px;"></div></td>
</tr></table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FD7608">
  <tr>
    <td align="center" valign="top" style="padding-top:40px; padding-left:20px; padding-right:20px">
    <table width="600" border="0" cellpadding="0" cellspacing="0" class="mobemailfullwidth" align="center" bgcolor="#FFFFFF">
      <tr>
        <td align="left" style="padding-top:40px; padding-bottom:20px; padding-left:40px; padding-right:40px; mso-line-height-rule:exactly; font-size:40px; line-height:40px;"><font face=""Walsheim-Bold", "Arial Black", "Arial", "sans-serif" color="#333333" style="font-size:40px; -webkit-text-size-adjust:none; line-height:40px">Your Login Account is ready to go.</font></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FD7608">
  <tr>
    <td align="center" valign="top" style="padding-left:20px; padding-right:20px"><table width="600" border="0" cellpadding="0" cellspacing="0" class="mobemailfullwidth" align="center" bgcolor="#FFFFFF">
      
</table>
</td></tr></table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#d0d0d0">
  <tr>
    <td align="center" valign="top" style="padding-left:20px; padding-right:20px">
<table width="600" border="0" cellpadding="0" cellspacing="0" class="mobemailfullwidth" align="center" bgcolor="#FFFFFF">
      <tr>
        <td align="left" style="padding-top:0px; padding-bottom:20px; padding-left:40px; padding-right:40px">
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FD7608">
          <tr>
            <td align="center" style="padding:5px"><a href="http://cms.otsinfotechindia.com" style="color: #ffffff; text-decoration: none; background-color: #FD7608; border-top: 10px solid #FD7608; border-bottom: 10px solid #FD7608; border-left: 10px solid #FD7608; border-right: 10px solid #FD7608; display: inline-block; mso-table-lspace:0pt; mso-table-rspace:0pt;"><font face=""Walsheim-Medium", "Arial", "sans-serif" color="#ffffff" style="font-size:18px; line-height:20px; -webkit-text-size-adjust:none;">SIGN IN</font>
</a></td>
          </tr>
          <tr>
            <td bgcolor="#FD7608" height="5" style="line-height:5px">
<div style="height:5px"></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#d0d0d0">
  <tr>
    <td align="center" valign="top" style="padding-left:20px; padding-right:20px">
<table width="600" border="0" cellpadding="0" cellspacing="0" class="mobemailfullwidth" align="center" bgcolor="#FFFFFF">
      <tr>
        <td align="left" style="padding-top:20px; padding-bottom:40px; padding-left:40px; padding-right:40px">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
                 <td colspan="2" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:20px" face="Arial, sans-serif" color="#333333">Account Information</font></td>
                 </tr>
               <tr>
                 <td width="21%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Student ID #: </font></td>
                 <td width="79%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">'.$this->session->userdata('empid').'</font></td>
               </tr>
			   <tr>
                 <td width="21%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Password : </font></td>
                 <td width="79%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">'.$this->input->post('password').'</font></td>
               </tr>
           </table>
				<br>
             <table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="#f5f5f5" style="border: 1px solid #f5f5f5; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
               <tr>
   	<td colspan="2" valign="top"><font style="font-size:20px" face="Arial, sans-serif" color="#666666">Need help?</font></td>
    </tr>
        <tr>
        <td colspan="2">        
         </td>
         </tr><tr>
                 <td colspan="2" valign="top"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Our experienced 24/7 Support team can help you get online.</font></td>
                 </tr>
               <tr>
              <td valign="top"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Call:</font></td>
         <td valign="top"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">+91-'.$emailinfo[0]->contact_no.'</font></td>
               </tr>               
             </table></td>
        </tr>
      </table>
</td>
      </tr>
    </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bebebe">
  <tr>
    <td align="center" valign="top"><table width="640" border="0" cellpadding="0" cellspacing="0" class="mobemailfullwidth" align="center">
      <tr>
        <td style="padding-top:5px; padding-bottom:40px; padding-left:20px; padding-right:20px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td align="left" valign="middle" style="padding-left:0px; padding-right:0px; padding-top:5px; padding-bottom:0px"><font face="Arial, sans-serif" color="#333333" style="font-size:12px; -webkit-text-size-adjust:none; line-height:18px">
Please do not reply to this email. Emails sent to this address will not be answered.
<br>
<br>
Copyright &copy; 2016 Onlinesoftservices Company. 14455 N. Hayden Rd, Ste. 219, Scottsdale, AZ 85260. All rights reserved.</font></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
  </tr>
</table>
</body>
</html>';
			 	$this->email->from($emailinfo[0]->smtp_user, 'Onlinesoftservices');
				$this->email->to($this->input->post('Emailid'));
				$this->email->subject('Onlinesoftservices Student Login Password Information');
				$this->email->message($template);
			 
			 	$this->email->send();
			 	
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('tbl_teacher'), 
				$where); 
				$this->session->set_flashdata('success','Your Password Information successfully updated');
				return redirect('teacher/profile');
		 }				
	}
	function attendance($id=FALSE)
	{
		//Options for Classes
		$catOptions['']='Select Class';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('tbl_class')
		);
		foreach ($catRecords as $key=>$val) {
		    $catOptions[$val->id]	= $val->class_name;
		}
		//Options for Session
		$sessionOptions['']='Select Session';
		$sessionRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('tbl_section')
		);
		foreach ($sessionRecords as $key=>$val) {
		    $sessionOptions[$val->id]	= $val->section_name;
		}
		//$data = array();
		if(isset($_POST['search'])!='')
		{
			
	$studentlist  = $this->base_model->run_query("SELECT * FROM tbl_student WHERE student_class = '".$this->input->post('catid')."' and section_name = '".$this->input->post('session')."'");
	foreach ($studentlist as $key) {			
		$studentid = $key->Stdid;
$attendancelist = $this->base_model->run_query("SELECT * FROM tbl_attendance WHERE Stdid = '".$studentid."'");
			
		if($attendancelist[0]->Stdid=='')
		{
			$cDate = strtotime("+5 hours");
			$inputdata['date'] =  date("Y/m/d",$cDate);
			$inputdata['month'] = date("M");
			$inputdata['year'] =  date("Y");
			$inputdata['Stdid'] = $studentid;
		
			$this->base_model->insert_operation(
							$inputdata, 
							$this->db->dbprefix('tbl_attendance')
							);
		}
			
				//array_push($this->data, $attendancelist);
		
	}	
	$current_month = date('M');
	
foreach ($studentlist as $key) {
		$attendancelist = $this->base_model->run_query("SELECT * FROM tbl_attendance where month = '".$current_month."' and Stdid = '".$key->Stdid."'");
		foreach($attendancelist as $a)
		{
			$name[] = $a;
		}
		
		}
		
		//print_r($name);
		
		if(isset($_POST['set_org_role_enable']))
		{
				$id = $this->input->post('textrights_org');
				$data = array();
				if(!empty($_POST['textrights_org'])){
				// Loop to store and display values of individual checked checkbox.
				//foreach($_POST['Orgrole'] as $selected){
              foreach($_POST['textrights_org'] as $level) {
                    $tempArray = array(
              'First_Day' => $this->input->post('textfirst_day'),
			'Second_Day' => $this->input->post('textsecond_day'),
		'Third_Day' => $this->input->post('textthird_day'),
		'Fourth_Day' => $this->input->post('textfourth_day'),
		'Fivth_Day' => $this->input->post('textfifth_day'),
		'Sixth_Day' => $this->input->post('textsixth_day'),
		'Seventh_Day' => $this->input->post('textseven_day'),
		'Eight_Day' => $this->input->post('texteight_day'),
		'Nineth_Day' => $this->input->post('textnine_day'),
		'Tenth_Day' => $this->input->post('textten_day'),
		'Eilleven_Day' => $this->input->post('textelleven_day'),
		'Twelve_Day' => $this->input->post('texttwelve_day')
                    );
                    array_push($data, $tempArray);
              }
				$table 			= $this->db->dbprefix('tbl_attendance');
				//$data['org_role_rights_add']	= '1';
				//$data['org_role_rights_edit']	= '1';
				//$data['org_role_rights_delete']	= '1';
				//$data['org_role_rights_active']	= '1';
				$where['id'] 		= $level;
				$this->base_model->update_operation($data, $table, $where);
				}
			$this->session->set_flashdata('success','<font color="#05BD14">Global Rights Permission successfully updated....</font>');
				$this->data['attendancelist'] 	= $name;	
				$this->view('teacher/attendance',$this->data);
		}
		if(isset($_POST['set_org_role_disable']))
		{
				$id = $this->input->post('textrights_org');
				if(!empty($_POST['textrights_org'])){
				// Loop to store and display values of individual checked checkbox.
				//foreach($_POST['Orgrole'] as $selected){
				//echo $selected."</br>";
				$table 	= $this->db->dbprefix('tbl_attendance');
				$data['First_Day']	= '0';
				$data['Second_Day']	= '0';
				$data['Third_Day']	= '0';
				$data['Fourth_Day']	= '0';
				$data['Fivth_Day']	= '0';
				$data['Sixth_Day']	= '0';
				$data['Seventh_Day']= '0';
				$data['Eight_Day']= '0';
				$data['Nineth_Day']= '0';
				$data['Tenth_Day']= '0';
				$data['Eilleven_Day']= '0';
				$where['id'] 		= $id;
				$this->base_model->update_operation($data, $table, $where);	
				}
			$this->session->set_flashdata('success','<font color="#05BD14">Global Rights Permission successfully updated....</font>');
			$this->data['attendancelist'] 	= $name;		
			$this->view('teacher/attendance',$this->data);
				
		}	
$this->data['class'] 		= $catOptions;
		$this->data['session'] 		= $sessionOptions;
		
		$this->data['attendancelist'] 	= $name;		
		$this->view('teacher/attendance',$this->data);
		}
		else
		{
			$this->data['attendancelist'] 	= $name;
		$this->data['class'] 		= $catOptions;
		$this->data['session'] 		= $sessionOptions;
		$this->data['title'] 		= 'Attendance';
		$this->data['active_menu'] 	= 'attendance';
		$this->data['content'] 		= 'teacher/attendance';
		$this->view('teacher/attendance',$this->data);
		}
		
	}
	
	function editrights()
	{
	$val=$_POST['value'];
	$valsss=explode("__",$_POST['id']);
	$id=$valsss[0];
	$col=$valsss[1];
	if($val==1)
	{
	$editval=0;	
	}
	else
	{
	$editval=1;	
	}
$this->db->update('tbl_attendance',array($col=>$editval),array('id'=>$id));
	echo $editval;
	}
	function editall()
	{
		echo "1234";
		$val=$_POST['value'];
		$id = $_POST['id'];
		$month = date('M');
		if($val==1)
	{
	$editval=0;	
	$att = 1;
	}
	else
	{
	$editval=1;
	$att = 0;	
	}
//echo $val;
//echo $att;
//echo $editval;
$this->db->set($id, $editval);
$this->db->where($id, $att);
$this->db->where('month', $month);
$this->db->update('tbl_attendance');
//echo $id;
//echo $editval;
	}
	function globalrights($id=false)
	{
	$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		//Data For Active Users
		$Allorganization = $this->base_model->run_query(
		"select * from tbl_org");
		$this->data['Orgrole'] = $this->base_model->getRole();
		if(isset($_POST['set_org_role_enable']))
		{
				$id = $this->input->post('textrights_org');
				$data = array();
				if(!empty($_POST['textrights_org'])){
				// Loop to store and display values of individual checked checkbox.
				//foreach($_POST['Orgrole'] as $selected){
              foreach($_POST['textrights_org'] as $level) {
                    $tempArray = array(
                      'org_role_rights_add' => $this->input->post('textrights_add'),
						'org_role_rights_edit' => $this->input->post('textrights_edit'),
				'org_role_rights_delete' => $this->input->post('textrights_delete'),
				'org_role_rights_active' => $this->input->post('textrights_active')
                    );
                    array_push($data, $tempArray);
              }
				$table 					= $this->db->dbprefix('tbl_org');
				//$data['org_role_rights_add']	= '1';
				//$data['org_role_rights_edit']	= '1';
				//$data['org_role_rights_delete']	= '1';
				//$data['org_role_rights_active']	= '1';
				$where['aid'] 		= $level;
				$this->base_model->update_operation($data, $table, $where);
				}
			$this->session->set_flashdata('success','<font color="#05BD14">Global Rights Permission successfully updated....</font>');
				return redirect('admin/globalrights/',$this->data);
		}
		if(isset($_POST['set_org_role_disable']))
		{
				$id = $this->input->post('textrights_org');
				if(!empty($_POST['textrights_org'])){
				// Loop to store and display values of individual checked checkbox.
				//foreach($_POST['Orgrole'] as $selected){
				//echo $selected."</br>";
				$table 					= $this->db->dbprefix('tbl_org');
				$data['org_role_rights_add']	= '0';
				$data['org_role_rights_edit']	= '0';
				$data['org_role_rights_delete']	= '0';
				$data['org_role_rights_active']	= '0';
				$where['aid'] 		= $id;
				$this->base_model->update_operation($data, $table, $where);	
				}
			$this->session->set_flashdata('success','<font color="#05BD14">Global Rights Permission successfully updated....</font>');
				return redirect('admin/globalrights/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['Allorganization'] 	= $Allorganization;	
		$this->data['title'] 		= 'Global Rights';
		$this->data['active_menu'] 	= 'globalrighst';
		$this->data['content'] 		= 'admin/globalrights';
		$this->view('teacher/globalrights',$this->data); 
	}
	function attendance1()
	{
		
		$this->data['student'] 		= $this->base_model->getStudent();
		
		$userinfo = $this->base_model->run_query(
		"select * from tbl_teacher where Tecid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;		
		//$cDate = strtotime("+29 hours");
		//$logindt = date("Y/m/d");
		$cDate = strtotime("+5 hours");
		$logindt = date("Y/m/d",$cDate);
		if(isset($_POST['search'])!='')
		{
			if($this->input->post('student')=='')
			{
		$teacherattendance  = $this->base_model->run_query("SELECT * FROM tbl_attendance WHERE (date BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."') and Stdid = '".$this->session->userdata('empid')."'");
			$this->data['teacherattendance'] 	= $teacherattendance;
			$this->view('teacher/attendance',$this->data);
			}
			else{
				$teacherattendance  = $this->base_model->run_query("SELECT * FROM tbl_attendance WHERE (date BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."') and Stdid = '".$this->input->post('student')."'");
		
			$this->data['teacherattendance'] 	= $teacherattendance;
			
			$this->view('teacher/attendance',$this->data);
			}
		}		
		else
		{	
		$userallattendance  = $this->base_model->run_query("select * from tbl_attendance where Stdid='".$this->session->userdata('empid')."' ORDER BY date DESC LIMIT 7");
			$this->data['userallattendance'] 	= $userallattendance;	
		
		$attendanceresult  = $this->base_model->run_query(
		"select * from tbl_attendance where login >  '$logindt 00:00:00' AND login <  '$logindt 23:59:59' AND Stdid='".$this->session->userdata('empid')."'");		
		$maxid		= $this->base_model->run_query("select max(att_id) as attid from tbl_attendance where Stdid='".$this->session->userdata('empid')."'");
			if (count($maxid)>0) {				
				$this->data['maxattid'] 	= $maxid[0]->att_id;
			}
			foreach($maxid as $max){
				$atmaxid = $max->attid;
			}			
		//$ltime = strtotime("+29 hours + 30 minutes");		
		//$lt = strtotime("+29 hours + 30 minutes");
		//$lattid = date("Y/m/d h:i:s");		
		//$eDate = strtotime("+12 hours");		
		$ltime = strtotime("+5 hours + 30 minutes");		
		$lt = strtotime("+5 hours + 30 minutes");
		$lattid = date("Y/m/d h:i:s",$lt);		
		$eDate = strtotime("+12 hours");
		
		$inputdata['Stdid']							= $this->session->userdata('empid');
		$inputdata['date']							= date("Y-m-d");//eDate;
		$inputdata['logintime'] 					= date("h:i:s A",$ltime);//ltime
			
		$inputdata['month']							= date("F");
			
		$inputdata['year']							= date("Y");
		$inputdata['ipused'] 						= $_SERVER["REMOTE_ADDR"];
		$inputdata['emp_name'] 						= $userinfo[0]->FirstName.$userinfo[0]->LastName;
		$inputdata['login']							= date("Y/m/d h:i:s",$lt); //lt
		if(isset($_GET["login"])) {
		$this->base_model->insert_operation(
							$inputdata, 
							$this->db->dbprefix('tbl_attendance')
							);
		$this->session->set_flashdata('success','Employee Punch in successfully...');	
		return redirect('teacher/attendance','refresh');
		}
		if(isset($_GET["logout"]))
		{
			$attid = date("Y-m-d h:i:s",$ltime);//ltime
			$cl=$_REQUEST['logintime'];
			$attendance  = $this->base_model->run_query("select * from tbl_attendance where att_id='".$atmaxid."' and Stdid='".$this->session->userdata('empid')."'");
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
						$logindata['logout'] 						= date("h:i:s A",$ltime);//ltime
					
						//step for Update
						$logoutaffrow  = $this->base_model->update_operation(
						$logindata, 
						$this->db->dbprefix('tbl_attendance'), 
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
			return redirect('teacher/attendance','refresh');
		} // logout script end 
		
		$attendanceresult  = $this->base_model->run_query(
		"select * from tbl_attendance where login >  '$logindt 00:00:00' AND login <  '$logindt 23:59:59' AND Stdid='".$this->session->userdata('empid')."'");
		$this->data['attendanceresult'] 	= $attendanceresult;
		//$this->data['cntr'] =	$cntr=0;
		$attendancecheck  = $this->base_model->run_query("select * from tbl_attendance where att_id='".$atmaxid."' and Stdid='".$this->session->userdata('empid')."'");
			$this->data['attendancecheck'] 	= $attendancecheck;					
			foreach($attendancecheck as $attendancevalues){
				$attcheckin = $attendancevalues->logintime;
				$attcheckout = $attendancevalues->logout;
			}			
			if($attendancecheck!='')
			{
				$str3=$attcheckout;	
				$str4=$attcheckin;	
				if($str3!=NULL && $str4!=NULL)
				{
					if($attendanceresult)
					{
						$this->data['cntr'] = $cntr=2;
					}
					elseif($attendanceresult=='')
					{
						 $this->data['cntr'] = $cntr=1;
					}
				}
				elseif($attendanceresult!='')
				{
					$this->data['cntr'] = $cntr=3;		
				}
		} //attendance Checkin & Checkout System Script end
		
		$this->data['attendanceresult'] 		= $attendanceresult;
		$this->data['attendancecheck'] 			= $attendancecheck;
		$this->data['title'] 					= 'Teacher Attendance';
		$this->data['active_menu'] 				= 'Attendance';
		$this->data['content'] 					= 'teacher/attendance';			
		$this->view('teacher/attendance', $this->data);
		}
	}	
	function generate_excel()
	{
		$this->data['allattendancelist'] = $this->base_model->ExportCSV();
		 $this->ExportCSV();
		 return redirect("teacher/attendance",$this->data);      
     }
	
	function payslip()
	{
		$month = date("F");
		$year = date("Y");
		
		$viewpayslipinfo = $this->base_model->run_query(
		"select * from tbl_salary where month = '".$month."' and year = '".$year."' and Tecid ='".$this->session->userdata('empid')."'");
		$this->data['viewpayslipinfo'] 	= $viewpayslipinfo;
		
			$this->data['title'] 		= 'PaySlip';
			$this->data['active_menu'] 	= 'view payslip';
			$this->data['content'] 		= 'teacher/payslip';
			$this->view('teacher/payslip',$this->data); 
	}
	
	
	//View All Classes & Subject
	function classdetails()
	{
		
		$Allassignsubject = $this->base_model->run_query(
		"select * from tbl_assignsubject where teacher_id='".$this->session->userdata('empid')."'");
		$this->data['class'] = $this->base_model->getClass();
		
		$this->data['subject'] = $this->base_model->getSubject();
		
		$this->data['teacher'] = $this->base_model->getTeacher();
		
		$this->data['Allassignsubject'] 	= $Allassignsubject;		
		$this->data['title'] 		= 'classdetails';
		$this->data['active_menu'] 	= 'viewclass';
		$this->data['content'] 		= 'admin/classdetails';
		$this->view('teacher/classdetails',$this->data); 
	}
	
	//User Leave
	function leave()
	{
		$table 		= $this->db->dbprefix('tbl_leave');
		
		$userinfo = $this->base_model->run_query(
		"select * from tbl_teacher where Tecid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo[0]->created_by;
		$this->data['userinfo'] 	= $userinfo;
		//Get the All Leave info
		$leaveinfo 				= $this->base_model->run_query(
		"select * from ".$table." where empid='".$this->session->userdata('empid')."'");
		
		//Get the All Leave info
		$leaveinfodetails 				= $this->base_model->run_query(
		"select * from ".$table." where leave_code='".$this->uri->segment(3)."'");
		
		//Get the Leave Reporting Manager Details
		$reportingemailid = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$userinfo[0]->created_by."'");
		
		
		//Get the User Leave Balacne to Display in the user Leave.
		$userleavebalacne 				= $this->base_model->run_query(
		"select * from tbl_leave_balance where Tecid='".$this->session->userdata('empid')."'");
		
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
		if ($this->input->post()) 
		{
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
				$inputdata['leave_type'] 				= $this->input->post('leavetype');
				$inputdata['leave_from'] 				= $this->input->post('startdate');
				$inputdata['leave_to'] 					= $this->input->post('enddate');				
				$inputdata['leave_resion'] 				= $this->input->post('leavereasion');
				$inputdata['request_leave_date'] 		= date("Y-m-d");
				$inputdata['leave_code'] 				= $tokenno;
				
				//Leave Apply Email Information Script
				
				$this->email->from('info@otsinfotechindia.com', 'Online CMS');
				$this->email->to($reportingemailid);
				 
				$this->email->subject('Online CMS Student Leave Request');
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
				return redirect('teacher/leave');
		 }
		
				
		$this->data['leaveinfo'] 				= $leaveinfo;
		$this->data['leaveinfodetails'] 		= $leaveinfodetails;
		$this->data['reportingemailid'] 		= $reportingemailid;
		$this->data['userleavebalacne'] 		= $userleavebalacne;
		$this->data['leavecalendar'] 			= $leavecalendar;
		$this->data['userleave'] 				= $userleave;		
		$this->data['title'] 					= 'Leave';
		$this->data['active_menu'] 				= 'leave';
		$this->data['content'] 					= 'teacher/leave';		
		$this->view('teacher/leave', $this->data);
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
		 
				return redirect('teacher/leave');
		 }}
				
	}
	
	//View All Admins
	function moderators()
	{
		$this->validate_admin();
		
		$moderators =	$this->base_model->run_query("SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id and g.group_id=4 ORDER BY u.id desc ");
		$this->data['users'] = $moderators;
		
		$this->data['active_menu']='users';
		$this->data['title'] = 'Moderators - Super Admin Dashboard';
		$this->data['heading'] = 'Moderators';
		
		$this->data['content'] = 'admin/moderators';
		$this->data['user_type'] = 'moderator';
		
		$this->_render_page('temp/admintemplate',$this->data);
	}
	
	//View All Local Uesrs
	function local()
	{
		$this->validate_admin();
		
		$localusers =	$this->base_model->run_query("SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id and g.group_id=5 ORDER BY u.id desc ");
		$this->data['users'] = $localusers;
		
		$this->data['active_menu']='users';
		$this->data['title'] = 'Local - User View';
		$this->data['heading'] = 'Local Users';
		
		$this->data['content'] = 'admin/local';
		$this->data['user_type'] = 'local';
		
		$this->_render_page('temp/admintemplate',$this->data);
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
		
		if (!in_array($ext, $allowed_types)) {			
			$this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	
	//Create User
	function create_user($user_type = '')
	{
		$this->validate_admin();
		
		$this->data['title'] = "Create User";
	
		//$this->load->config('ion_auth');
		$this->config->load('ion_auth', TRUE);
		$tables = $this->config->item('tables','ion_auth');
		
		if($this->input->post('submit')!='') {
			//validate form input
			$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
			$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean|integer');
			$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');			
			
			if(!empty($_FILES['image']['name'])) {
			
		$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
			
			}
			if ($this->form_validation->run() == true)
			{
				$username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
				$email    = strtolower($this->input->post('email'));
				$password = $this->input->post('password');
				$image = $_FILES['image']['name'];
				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'phone'      => $this->input->post('phone'),
					'date_of_registration'      => date('Y-m-d')
				);
				
				if(!empty($image))
					$additional_data['image'] = $image;
				
				$id = $this->ion_auth->register($username, $password, $email, $additional_data);
				
				if($this->input->post('user_type') == "admin") {
					$empdata['group_id'] = "3";
					$redirect_path = "admin/admins";
				}
				elseif($this->input->post('user_type') == "moderator") {
					$empdata['group_id'] = "4";
					$redirect_path = "admin/moderators";
				}
				
				else {
					$empdata['group_id'] = "5";
					$emp['group'] = "5";
					$redirect_path = "admin/local";
				}
				
				$this->db->where('id', $id);
				$this->db->update('users',$emp);
				
				$this->db->where('user_id', $id);				
				if($this->db->update('users_groups',$empdata)) {
				
					$this->prepare_flashmessage($this->ion_auth->messages(),2);
					redirect($redirect_path, 'refresh');
				
				}
			}
			else
			{
				//display the create user form
				//set the flash data error message if there is one
				$this->prepare_flashmessage((validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))),1);
				redirect("admin/create_user", 'refresh');
				
			}
		}
			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'class'=>'form-control',
				'placeholder'=>'First Name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'class'=>'form-control',
				'placeholder'=>'Last Name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'class'=>'form-control',
				'placeholder'=>'User Email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'class'=>'form-control',
				'placeholder'=>'Company',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'class'=>'form-control',
				'placeholder'=>'Phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'class'=>'form-control',
				'placeholder'=>'Password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'class'=>'form-control',
				'placeholder'=>'Confirm Password',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			
			$this->data['user_type'] = $user_type;
			
			$this->data['content'] = 'admin/create_user';
			$this->_render_page('temp/admintemplate', $this->data);
	}
	//edit a user
	function edit_user($id = '', $user_type = '')
	{
		$this->validate_admin();
		
		$this->data['title'] = "Edit User";
		if($id == "") {		
			$id = $this->input->post('id');		
		}
		
		if(!is_numeric($id)){
		return;
		}
		
		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();
		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
		
		if(!empty($_FILES['image']['name'])) {
			
			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
		
		}
		if (isset($_POST) && !empty($_POST))
		{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
				'username'      => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
			);
			
			$image = $_FILES['image']['name'];
			
			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
				$data['password'] = $this->input->post('password');
			}
			if ($this->form_validation->run() === TRUE)
			{
				
				if(!empty($image)) {
				
					if (file_exists('assets/uploads/images/'. $user->image)) {
						unlink('assets/uploads/images/'. $user->image);
					}
					if(file_exists('assets/uploads/images(200x200)/'. $user->image)) {
						unlink('assets/uploads/images(200x200)/'. $user->image);
					}
						
					if(file_exists('assets/uploads/images(50x50)/'. $user->image)) {
						unlink('assets/uploads/images(50x50)/'. $user->image);
					}
					
					$ext = explode('.', $image);
					
					if(count($ext)>2 || count($ext)<= 0) {
					   $this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
						return FALSE;
					}
					
					$img = $ext[0]."_".$user->id.".".$ext[1];
					
					$data['image'] = $img;
				
				}
				
				$this->ion_auth->update($user->id, $data);
				if($this->input->post('user_type') == "admin") {
					$redirect_path = "admin/admins";
				}
				else {
					$redirect_path = "admin/moderators";
				}
				
				$this->prepare_flashmessage('User Updated Successfully.', 0);
				redirect($redirect_path, 'refresh');
			}
		}
		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;
		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'class'=>'form-control',
			'placeholder'=>'First Name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'class'=>'form-control',
			'placeholder'=>'Last Name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'class'=>'form-control',
			'placeholder'=>'Company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'class'=>'form-control',
			'placeholder'=>'Phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'class'=>'form-control',
			'placeholder'=>'User Email',
			'id'    => 'email',
			'type'  => 'text',
			'readonly'  => 'readonly',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'class'=>'form-control',
			'placeholder'=>'Password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'class'=>'form-control',
			'placeholder'=>'Confirm Password',
			'id'   => 'password_confirm',
			'type' => 'password'
		);
		
			$this->data['user_type'] = $user_type;
			$this->data['content']='admin/edit_user';
			$this->_render_page('temp/admintemplate',$this->data);
		//$this->_render_page('auth/edit_user', $this->data);
	}
	
	
	//View User Profile
	function viewUserProfile()
	{
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 				= $this->uri->segment(3);
			$table 					= $this->db->dbprefix('users');
			$condition['id'] 		= $userid;
			$records 				= $this->base_model->fetch_records_from(
			$table, 
			$condition,
			$select 				= 'id, username, email, phone, image, active', 
			$order_by = '' 
			);
			$this->data['details'] 	= $records;
			$this->data['content'] 	= 'admin/view_user_profile';
			$this->data['title'] 	= 'User Profile';
			$this->_render_page('temp/admintemplate', $this->data);
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	
	//View User Quiz History
	function userQuizHistory()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 						= $this->uri->segment(3);
			$records 						= $this->base_model->run_query(
			"select qr.*,q.* from ".$this->db->dbprefix('user_quiz_results')
			." qr,".$this->db->dbprefix('quiz')
			." q where q.quizid=qr.quiz_id and qr.userid=".$userid
			);
			if (count($records)>0) {
				$this->data['quiz_history'] = $records;
				$this->data['username'] 	= $records[0]->username;
				$this->data['title'] 		= 'User Quiz History';
				$this->data['content'] 		= 'admin/user_quiz_history';
				$this->_render_page('temp/admintemplate', $this->data);
			}
			else {
				$this->prepare_flashmessage(
				"No Quiz History Available, Since the User hasn't 
				taken any Exam/Quiz.", 2
				);
				redirect('admin/viewAllUsers', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(
			"No Quiz History Available, Since the User hasn't 
			taken any Exam/Quiz.", 2
			);
			redirect('admin/viewAllUsers', 'refresh');
		}
	}
	
	//View Performance of User Quiz
	function userQuizPerformance()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(4) && is_numeric($this->uri->segment(4))) {
			$quizId 					= $this->uri->segment(4);
			
			if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
				$userId 				= $this->uri->segment(3);
				$records 				= $this->base_model->run_query(
				"select qh.*,q.* from "
				.$this->db->dbprefix('user_quiz_results_history')
				." qh,".$this->db->dbprefix('quiz')
				." q where q.quizid=qh.quiz_id and qh.userid = "
				.$userId." and qh.score > 0 and qh.quiz_id = "
				.$quizId." ORDER BY dateoftest DESC LIMIT 10"
				);
				
				if (count($records)>0) {
					$this->data['info'] = "Performance Report of "
					.$records[0]->username." in ".$records[0]->name;
					$result 			= array( );
					$temp 				= array();
					array_push($temp, "Date","Score","Total Questions");
					array_push($result, $temp);
					
					foreach ($records as $d) {
						$temp 			= array();
						array_push(
						$temp,$d->dateoftest, 
						$d->score,$d->total_questions
						);
						array_push($result, $temp);
					}
					
				
					$str = "";
					$cnt = 0;
					foreach ($result as $r) {
						if ($cnt++ == 0){
							$str = $str . "['".$r[0]."','".$r[1]."','".$r[2]."'],";
						}
						else{
							$str = $str . "['".$r[0]."',".$r[1].",".$r[2]."],";
						}
					}
							
					$this->data['result'] 	= $str;
					$this->data['title'] 	= "User's Quiz Performance";
					$this->load->view('user/exam/performance', $this->data);
				}
				else {
					$this->prepare_flashmessage(
					"No Quiz History Available, Since the User hasn't 
					taken any Exam/Quiz.", 2
					);
					redirect('admin/viewAllUsers', 'refresh');
				}
			}
			else {
				$this->prepare_flashmessage(
				"No Quiz History Available, Since the User hasn't 
				taken any Exam/Quiz.", 2
				);
				redirect('admin/viewAllUsers', 'refresh');
			}
		}
		elseif ($this->uri->segment(3)) {
			redirect('admin/userQuizHistory/'.$this->uri->segment(3), 'refresh');
		}
		else {
			$this->prepare_flashmessage(
			"No Quiz History Available, Since the User hasn't 
			taken any Exam/Quiz.", 2
			);
			redirect('admin/viewAllUsers', 'refresh');
		}
	}
	
	
	//Update Admin Profile
	function updateProfile()
	{
		$this->validate_admin();
		
		$this->form_validation->set_rules('first_name', 'First Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 
		'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 
		'required|xss_clean|integer');
		
		if(!empty($_FILES['image']['name'])) {
			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
		}
		
		if ($this->form_validation->run() == true) {
			$userid = $this->input->post('user');
			if ($this->input->post('submit')!='' && isset($userid) && $userid!='') {
				$data['first_name'] 	= $this->input->post('first_name');
				$data['last_name'] 		= $this->input->post('last_name');
				$data['username'] 		= $this->input->post('first_name')
				." ".$this->input->post('last_name');
				$data['phone'] 			= $this->input->post('phone');
				$data['email'] 			= $this->input->post('email');
				
				//Unset User Name
				$this->session->unset_userdata('username');
				//Set User Name
				$this->session->set_userdata('username',$data['username']);
				
				$image = $_FILES['image']['name'];
				
				//Upload User Photo
				if (!empty($image)) {	
					$r = $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('users')
					.' where image != "" and id = '.$userid
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
					
					$data['image'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/images/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(200x200)/'. $img,200,200
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(50x50)/'. $img,
					50,50
					);
					
					//Set User Image
					$this->session->set_userdata('image',$img);
					
				}
				
				$table 					= $this->db->dbprefix('users');
				$where['id'] 			= $userid;
				$this->base_model->update_operation($data, $table, $where);
				
				$this->prepare_flashmessage(
				'Your profile has been successfully updated.', 0
				);
				redirect('admin/profile', 'refresh');
			}
			else {
				$this->prepare_flashmessage('Session Expired!', 2);
				redirect('auth/login', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(validation_errors(), 1);
			redirect('admin/profile', 'refresh');
		}
	}
	
	
	//Block User
	function blockUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('users');
			$data['active'] 			= 0;
			$where['id'] 				= $userid;
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("User has been blocked.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	
	//User Payment Activate
	function activatePaymentUser()
	{
		$this->validate_admin();
		
		$table 									= $this->db->dbprefix('quiz');
			$condition['quizid']					= $this->uri->segment(4);
			$examdetails 							= $this->base_model->fetch_records_from(
													$table, 
													$condition);
													
			$examdetails 								= $examdetails[0];
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('quizsubscriptions');
			$data['status'] 			= 'Active';	
			$data['validitytype'] 		= $examdetails->validitytype;			
			$data['dateofsubscription'] = date('Y-m-d');
			$where['user_id'] 			= $userid;
			$where['quizid'] 			= $this->uri->segment(4);
			if ($examdetails->validitytype == 'Days')
				{
				$Date 									= date('Y-m-d');
				$exp_date 	= date('Y-m-d', strtotime($Date. ' + '.$examdetails->validityvalue.' days'));
				$data['expirydate']	 	= $exp_date;
				}	
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("User Payment has been activated.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}	
	
	//User Payment Dactivate
	function DactivatePaymentUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('quizsubscriptions');
			$data['status'] 			= 'Inactive';			
			$where['user_id'] 				= $userid;
			$where['quizid'] 			= $this->uri->segment(4);
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("User Payment has been dactivated.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	//Activate User
	function activateUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('users');
			$data['active'] 			= 1;
			$where['id'] 				= $userid;
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("User has been activated.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	
	//CRUD Operations for Categories
	function categories()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['catid'] 			= $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('categories'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/categories', 'refresh');		
		}
		$this->data['title'] 			= 'Categories';
		$this->data['active_menu'] 		= 'categories';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		$this->data['content'] 			= 'admin/categories/categories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditCategories()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'name', 
		'Category Name', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {
			$inputdata['name'] 			= $this->input->post('name');			
			$inputdata['status'] 		= $this->input->post('status');
			
			$image 						= $_FILES['image']['name'];
			
			//Upload User Photo
				if (!empty($image)) {	
				$where['catid'] 		= $this->input->post('id');
					$r = $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('categories')
					.' where catid ="'.$where['catid'].'"'
					);
					if (count($r) > 0) {
					
						if (file_exists('assets/uploads/CategoryPhoto/'.$r[0]->image)) {
							unlink('assets/uploads/CategoryPhoto/'.$r[0]->image);
						}
						if(file_exists('assets/uploads/CategoryPhoto(200x200)/'
						.$r[0]->image)) {
							unlink('assets/uploads/CategoryPhoto(200x200)/'.$r[0]->image);
						}
							
						if(file_exists('assets/uploads/CategoryPhoto(50x50)/'
						.$r[0]->image)) {
							unlink('assets/uploads/CategoryPhoto(50x50)/'.$r[0]->image);
						}
					}
					
					//Unset User Image 
					$this->session->unset_userdata('image');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."".$where['catid'].".".$ext[1];
					
					$inputdata['image'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/CategoryPhoto/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/CategoryPhoto/'. $img, 
					'assets/uploads/CategoryPhoto(200x200)/'. $img,200,200
					);
					$this->create_thumbnail(
					'assets/uploads/CategoryPhoto/'. $img, 
					'assets/uploads/CategoryPhoto(50x50)/'. $img,
					50,50
					);
					
					//Set User Image
					$this->session->set_userdata('image',$img);
					
				}			
			
			if ($this->input->post('id') == '' ) {
				$this->base_model->insert_operation(
				$inputdata,
				$this->db->dbprefix('categories')
				);
				$msg = "Record Added Successfully";
			}
			else {
				$where['catid'] 		= $this->input->post('id');
				$this->base_model->update_operation(
				$inputdata,
				$this->db->dbprefix('categories'), 
				$where
				);
				$msg = "Record Updated Successfully";
			}
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/categories', 'refresh');
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('categories')
			." where catid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Category';
		}
		else {
			$this->data['data']		= array();
			$this->data['id']		= '';
			$this->data['title']	= 'Add Category';
		}
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= 'categories';
		$this->data['content'] 		= 'admin/categories/addeditCategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Sub Categories
	function subcategories()
	{
	    $this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['subcatid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('subcategories'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/subcategories', 'refresh');		
		}
		$this->data['title'] 		= 'Sub Categories';
		$this->data['active_menu'] 	= 'subcategories';
		$this->data['records'] 		= $this->base_model->run_query(
		"select s.*,c.name as catname from "
		.$this->db->dbprefix('subcategories')." s,"
		.$this->db->dbprefix('categories')." c where c.catid=s.catid"
		);
		$this->data['content']		='admin/categories/subcategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditSubCategories()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('catid', 'Category Name', 'trim|required');
		$this->form_validation->set_rules(
		'name', 
		'Sub Category Name', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {
			$inputdata['catid'] 	= $this->input->post('catid');
			$inputdata['name'] 		= $this->input->post('name');
			$inputdata['status'] 	= $this->input->post('status');
			if ($this->input->post('id') == '' ) {
				$this->base_model->insert_operation(
				$inputdata,
				$this->db->dbprefix('subcategories')
				);
				$msg = "Record Added Successfully.";
			}
			else {
				$where['subcatid'] = $this->input->post('id');
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('subcategories'), 
				$where );
				$msg = "Record Updated Successfully.";
			}
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/subcategories', 'refresh');
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('subcategories')
			." where subcatid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Sub Category';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Add Sub Category';
		}
		
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$catOptions[''] 			= 'Select Category';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		foreach ($catRecords as $key => $val) {
		    $catOptions[$val->catid]=$val->name;	
		}
		$this->data['categories'] 	= $catOptions;
		$this->data['active_menu'] 	= 'subcategories';
		$this->data['content'] 		= 'admin/categories/addeditSubCategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Subjects
	function subjects()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['subjectid'] 	= $this->uri->segment(3);
			$this->base_model->delete_record($this->db->dbprefix('subjects'), $where);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/subjects');		
		}
				
		$this->data['title'] 		= 'Subjects';
		$this->data['active_menu'] 	= 'subjects';
		$this->data['records'] 		= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		$this->data['content'] 		= 'admin/subjects/subjects';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditSubjects()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Subject Name', 'trim|required');
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['name'] 		= $this->input->post('name');
				$inputdata['status'] 	= $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					$this->base_model->insert_operation(
					$inputdata,
					$this->db->dbprefix('subjects')
					);
					
					$msg = "Record Added Successfully";
				}
				else {
					$where['subjectid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('subjects'), 
					$where
					);
					$msg = "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/subjects', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditSubjects', 'refresh');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('subjects')
			." where subjectid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Subject';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Add Subject';
		}
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= 'subjects';
		$this->data['content'] 		= 'admin/subjects/addeditSubjects';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	function questionsindex()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->data['title'] 		= 'Questions Index';
		$this->data['active_menu'] 	= 'questions';
		$this->data['records'] 		= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('subjects')
		);
		$this->data['content'] 		= 'admin/questions/questionsindex';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	//CRUD Operations for Questions
	function questions()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		if ($this->uri->segment(3)!='' && is_numeric($this->uri->segment(4))) {
			if ($this->uri->segment(3) == "delete" && $this->uri->segment(4) != '') {
				$where['questionid'] = $this->uri->segment(4);
				$this->base_model->delete_record(
				$this->db->dbprefix('questions'), 
				$where
				);
				$this->prepare_flashmessage("Record Deleted Successfully", 0);
				redirect('admin/questions', 'refresh');
			}
			elseif (
			$this->uri->segment(3) == "subject_wise" && 
			$this->uri->segment(4)!='' &&
			is_numeric($this->uri->segment(4)
			)) {				
				$records = $this->base_model->run_query(
				"select q.*,s.name as subjectname from "
				.$this->db->dbprefix('questions')." q,"
				.$this->db->dbprefix('subjects')." s 
				where s.subjectid=q.subjectid and q.subjectid="
				.$this->uri->segment(4)
				);
				$this->data['subject_name']="";
				$where['subjectid'] = $this->uri->segment(4);
				$subject_details = $this->base_model->fetch_records_from('subjects', $where);
				if (count($subject_details) > 0) {
				    $subject_details 			= $subject_details[0];
					$this->data['subject_name'] = $subject_details->name;
				}
				$this->data['records'] 			= $records;
				$this->data['subject_id'] 		= $this->uri->segment(4);				
			}
			else {
				$this->data['records'] = $this->base_model->run_query(
				"select q.*,s.name as subjectname from "
				.$this->db->dbprefix('questions')." q,"
				.$this->db->dbprefix('subjects')." s where s.subjectid=q.subjectid"
				);
			}
		}
		else {
			$this->data['records'] = $this->base_model->run_query(
			"select q.*,s.name as subjectname from "
			.$this->db->dbprefix('questions')." q,"
			.$this->db->dbprefix('subjects')." s where s.subjectid=q.subjectid"
			);
		}
		$this->data['title'] 		= 'Questions';
		$this->data['active_menu'] 	= 'questions';
		$this->data['content'] 		= 'admin/questions/questions';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	function addeditQuestions()
	{	
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subjectid', 'Subject', 'trim|required');
		$this->form_validation->set_rules(
		'questiontype', 
		'Question Type', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'totalanswers', 
		'Total Answers', 
		'trim|required'
		);
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('answer1', 'Answer1', 'trim|required');
		$this->form_validation->set_rules('answer2', 'Answer2', 'trim|required');
		$this->form_validation->set_rules('answer3', 'Answer3', 'trim|required');
		$this->form_validation->set_rules('answer4', 'Answer4', 'trim|required');
		$this->form_validation->set_rules(
		'correctanswer', 
		'Correct Answer', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'difficultylevel', 
		'Difficulty Level', 
		'trim'
		);
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				
				$inputdata['subjectid'] 	= $this->input->post('subjectid');
				$inputdata['questiontype'] 	= $this->input->post('questiontype');
				$inputdata['totalanswers'] 	= $this->input->post('totalanswers');
				$inputdata['question'] 		= $this->input->post('question');
				$inputdata['answer1'] 		= $this->input->post('answer1');
				$inputdata['answer2'] 		= $this->input->post('answer2');
				$inputdata['answer3'] 		= $this->input->post('answer3');
				$inputdata['answer4'] 		= $this->input->post('answer4');
				$inputdata['answer5'] 		= $this->input->post('answer5');
				$inputdata['correctanswer'] = $this->input->post('correctanswer');
				$inputdata['hint'] 			= "";
				$inputdata['difficultylevel'] = $this->input->post('difficultylevel');
				$inputdata['status'] = $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					$this->base_model->insert_operation($inputdata, 
					$this->db->dbprefix('questions')
					);
					$msg = "Record Added Successfully.";
				}
				else {
					$where['questionid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('questions'), 
					$where
					);
					$msg = "Record Updated Successfully.";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect(
				'admin/questions/subject_wise/'.$inputdata['subjectid'], 
				'refresh'
				);
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditQuestions');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$record = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('questions')
			." where questionid=".$this->uri->segment(3)
			);
			$this->data['data'] 		= $record;
			$this->data['subject_id'] 	= $record[0]->subjectid;
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Question';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Question';
		}
		
		//Options for Status
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		//Options for Total Answers
		$ans['4'] 						= '4';
		$ans['5'] 						= '5';
		$this->data['totans'] 			= $ans;
		
		//Options for Question Types
		$qtype['SingleAnswer'] 			= 'Single Answer';
		//$qtype['MultiAnswer'] 			= 'Multi Answer';
		$this->data['questtypes'] 		= $qtype;
		
		//Options for Difficulty Level
		$dlevel['Easy'] 				= 'Easy';
		$dlevel['Medium'] 				= 'Medium';
		$dlevel['High'] 				= 'High';
		$this->data['difficultylevels'] = $dlevel;
		
		//Options for Subjects
		$subjOptions[''] 				= 'Select Subject';
		$subjRecords 					= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		
		foreach ($subjRecords as $key=>$val)
		$subjOptions[$val->subjectid] 	= $val->name;
		$this->data['subjects'] 		= $subjOptions;
		$this->data['active_menu'] 		= 'questions';
		$this->data['content'] 			= 'admin/questions/addeditQuestions';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	
	//CRUD Operations for Quiz
	function quiz()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['quizid'] 			= $this->uri->segment(3);
			if ($this->base_model->delete_record(
			$this->db->dbprefix('quiz'), 
			$where)
			)
			{
				$this->base_model->delete_record(
				$this->db->dbprefix('quizquestions'), 
				$where
				);
				$this->prepare_flashmessage("Record Deleted Successfully", 0);
				redirect('admin/quiz');
			}
					
		}				
		$this->data['title'] 			= 'Quizzes';
		$this->data['active_menu'] 		= 'quiz';
		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s 
		where c.catid=q.catid and s.subcatid=q.subcatid"
		);
		$this->data['content'] 			= 'admin/quiz/quiz';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	
	
	//function to add quiz 
	function addeditQuiz()
	{	
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('catid', 'Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subcatid', 'Sub Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('validityvalue', 'Validity Value', 'trim|required|xss_clean');
		$this->form_validation->set_rules('quizcost', 'Price ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('meta_title', 'Meta Title ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('meta_keyword', 'Meta Keyword ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('meta_desc', 'Meta Desc ', 'trim|required|xss_clean');
		$this->form_validation->set_rules('quiz_desc', 'Quiz Desc ', 'trim|required|xss_clean');
		if ($this->input->post('negativemarkstatus') == "Active") {
			$this->form_validation->set_rules(
			'negativemark', 
			'Negative Mark', 
			'trim|required'
			);
		}
		$this->form_validation->set_rules('startdate', 'Start Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('enddate', 'End Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
		'deauration', 
		'Duration', 
		'trim|required|integer'
		);
		$this->form_validation->set_rules('qq', 'Subjects', 'trim|required|xss_clean');
		
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				
				$inputdata['quiztype']  = $this->input->post('quiztype');
				
				$quiz_grp = array();
				if($this->input->post('for_all') == ""){
					$quizgrp = implode(',',$this->input->post('quizfor'));
					$quiz_grp = explode(',',$quizgrp);
					$inputdata['quiz_for'] = "*";
				} else {
					$inputdata['quiz_for'] = 0; 
				}
						
				$inputdata['name'] 						= $this->input->post('name');
				$inputdata['meta_title'] 				= $this->input->post('meta_title');
				$inputdata['meta_keyword'] 				= $this->input->post('meta_keyword');
				$inputdata['meta_desc'] 				= $this->input->post('meta_desc');
				$inputdata['quiz_desc'] 				= $this->input->post('quiz_desc');
				$inputdata['catid'] 					= $this->input->post('catid');
				$inputdata['subcatid'] 					= $this->input->post('subcatid');
				$inputdata['negativemarkstatus'] 		= $this->input->post('negativemarkstatus');
				$inputdata['negativemark'] 				= "";
				
				if ($this->input->post('negativemarkstatus') == "Active") 
					$inputdata['negativemark'] 	= $this->input->post('negativemark');
				
				$inputdata['difficultylevel'] 	= $this->input->post('difficultylevel');
				$inputdata['hint'] 				= "Inactive";
				$inputdata['startdate'] 		= date(
				'Y-m-d', 
				strtotime($this->input->post('startdate'))
				);
				$inputdata['enddate'] 			= date('Y-m-d', 
				strtotime($this->input->post('enddate'))
				);
				$inputdata['deauration'] 		= $this->input->post('deauration');
				$inputdata['quiztype'] 			= $this->input->post('quiztype');
				$inputdata['validitytype'] 		= $this->input->post('validitytype');
				$inputdata['validityvalue'] 	= $this->input->post('validityvalue');
				$inputdata['quizcost'] 			= $this->input->post('quizcost');
				$inputdata['status'] 			= $this->input->post('status');
				
				//Quiz Photo Upload Process Start
				$image 						= $_FILES['image']['name'];
			
			//Upload User Photo
				if (!empty($image)) {	
				$where['quizid'] 		= $this->input->post('id');
					$r = $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('quiz')
					.' where quizid ="'.$where['quizid'].'"'
					);
					if (count($r) > 0) {
					
						if (file_exists('assets/uploads/QuizPhoto/'.$r[0]->image)) {
							unlink('assets/uploads/QuizPhoto/'.$r[0]->image);
						}
						if(file_exists('assets/uploads/QuizPhoto(200x200)/'
						.$r[0]->image)) {
							unlink('assets/uploads/QuizPhoto(200x200)/'.$r[0]->image);
						}
							
						if(file_exists('assets/uploads/QuizPhoto(50x50)/'
						.$r[0]->image)) {
							unlink('assets/uploads/QuizPhoto(50x50)/'.$r[0]->image);
						}
					}
					
					//Unset User Image 
					$this->session->unset_userdata('image');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."".$where['quizid'].".".$ext[1];
					
					$inputdata['image'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/QuizPhoto/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/QuizPhoto/'. $img, 
					'assets/uploads/QuizPhoto(200x200)/'. $img,200,200
					);
					$this->create_thumbnail(
					'assets/uploads/QuizPhoto/'. $img, 
					'assets/uploads/QuizPhoto(50x50)/'. $img,
					50,50
					);
					
					//Set User Image
					$this->session->set_userdata('image',$img);
					
				}			
				//Quiz Photo Upload Process End
				
				
				
				if ($this->input->post('id') == '' ) {
					
					$insertid 					= $this->base_model->insert_operation_id(
					$inputdata,$this->db->dbprefix('quiz')
					);
					
					for($i=0;$i<count($quiz_grp);$i++)
					{
						$quiz_for['quizid'] = $insertid;
						$quiz_for['groupid'] = $quiz_grp[$i];
						$this->base_model->insert_operation($quiz_for,$this->db->dbprefix('quiz_for'));
						
					}
					
					$qq 						= $this->input->post('qq');
					$values 					= explode("^", $qq);
					$len 						= count($values);
					$result 					= array_filter($values, 
					 create_function('$a','return preg_match("#\S#", $a);')
					 );
					$i = 0;
					foreach ($result as $v) {
						if ($i++ < $len) {
							$values1 				= explode(",",$v);
							$data['subjectid'] 		= $values1[0];
							$data['totalquestion'] 	= $values1[1];
							$data['quizid'] 		= $insertid;
							$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('quizquestions')
							);
						}
					}
					$msg = "Record Added Successfully.";
				}
				else {
					
					$where['quizid'] 			= $this->input->post('id');
					
					
					$updateid = $this->input->post('id');
					
					//step 1
					$this->base_model->delete_record(
					$this->db->dbprefix('quiz_for'), 
					$where);
					
					//step 2
					for($i=0;$i<count($quiz_grp);$i++)
					{
						$quiz_for['quizid'] = $updateid;
						$quiz_for['groupid'] = $quiz_grp[$i];
						$this->base_model->insert_operation($quiz_for,$this->db->dbprefix('quiz_for'));
						
					}
					
					//step 3
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('quiz'), 
					$where
					);
					
					
					
					if (
					$this->base_model->delete_record(
					$this->db->dbprefix('quizquestions'), 
					$where
					)
					) {
						$qq 				= $this->input->post('qq');
						$values 			= explode("^", $qq);
						$len 				= count($values);
						 $result 			= array_filter(
						 $values, 
						 create_function('$a','return preg_match("#\S#", $a);')
						 );
						 
						$i = 0;
						foreach ($result as $v) {
							if ($i++ < $len) {
								$values1 				= explode(",", $v);
								$data['subjectid'] 		= $values1[0];
								$data['totalquestion'] 	= $values1[1];
								$data['quizid'] 		= $where['quizid'];
								$this->base_model->insert_operation(
								$data, 
								$this->db->dbprefix('quizquestions')
								);
							}
						}
						$msg = "Record Updated Successfully.";
					}		
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/quiz','refresh');
			}
			else {
				
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditQuiz','refresh');
			}
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$this->data['data'] = $this->base_model->run_query(
			"select q.*,c.name as catname,s.name as subcatname from "
			.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
			." c,".$this->db->dbprefix('subcategories')." s 
			where c.catid=q.catid and s.subcatid=q.subcatid and quizid="
			.$this->uri->segment(3)
			);
			
			$this->data['qqdata'] 		= $this->base_model->run_query(
			"select qq.*,s.name as subjectname from "
			.$this->db->dbprefix('quizquestions')." qq,"
			.$this->db->dbprefix('subjects')." s 
			where s.subjectid=qq.subjectid and qq.quizid="
			.$this->uri->segment(3)
			);
			
			$groups = $this->base_model->run_query("SELECT groupid FROM quiz_for WHERE quizid=".$this->uri->segment(3) );
			
			//echo "<pre>"; print_r($groups); 
			
			$groups_opts = array();$i=-1;
			foreach($groups as $key=>$val)
			{	$i++;
				$groups_opts[$i] = $val->groupid;
				
			}
			
			// echo "<pre>"; print_r($groups_opts); die();
			
			$this->data['groups'] = $groups_opts;
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Quiz';
		}
		else
		{
			$this->data['data'] 		= array();
			$this->data['groups'] 		= array();
			$this->data['qqdata'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Quiz';
		}
		
		
		
		//Options for Status
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		//Options for Quiz Type
		$qztype['Free'] 				= 'Free';
		$this->data['quiztypes'] 		= $qztype;
		
		
		//Options for Quiz For
		//$Quizforoptions['0']='All groups'; 
		$Quizforoptions = array(); 
		$QuizforRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		foreach ($QuizforRecords as $key=>$val) {
		    $Quizforoptions[$val->id]	= $val->group_name;	
		}
		$this->data['quizfor'] 		= $Quizforoptions;
		
		
		//Options for Negative Mark Status
		$nmstatus['Active'] 			= 'Active';
		$nmstatus['Inactive'] 			= 'Inactive';
		$this->data['negativemarksstatus'] = $nmstatus;
		
		//Options for Difficulty Level
		$dlevel['Easy'] 				= 'Easy';
		$dlevel['Medium'] 				= 'Medium';
		$dlevel['High'] 				= 'High';
		$this->data['difficultylevels'] = $dlevel;
		
		//Options for Categories
		$catOptions['']='Select Category';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		foreach ($catRecords as $key=>$val) {
		    $catOptions[$val->catid]	= $val->name;	
		}
		$this->data['categories'] 		= $catOptions;
		
		//Options for Subjects
		$subjOptions[''] 				= 'Select Subject';
		$subjRecords 					= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		foreach ($subjRecords as $key => $val) {
		    $subjOptions[$val->subjectid] = $val->name;	
		}
		
		$this->data['subjects'] 		= $subjOptions;
		$this->data['active_menu'] 		= 'quiz';
		$this->data['content'] 			= 'admin/quiz/addeditQuiz';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	//function to add quiz END
	
	
	//CRUD Operations for Notifications
	function notifications()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '') {
			$where['nid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('notifications'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/notifications');		
		}
				
		$this->data['title'] 			= 'Notifications';
		$this->data['active_menu'] 		= 'notifications';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('notifications')
		);
		$this->data['content'] 			= 'admin/notifications/notifications';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditNotifications()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules(
		'description', 
		'Description', 
		'trim|required'
		);
		$this->form_validation->set_rules('post_date', 'Post Date', 'trim|required');
		$this->form_validation->set_rules('last_date', 'Last Date', 'trim|required');
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['title'] 		= $this->input->post('title');
				$inputdata['description'] 	= $this->input->post('description');
				$inputdata['post_date'] 	= date(
				'Y-m-d', 
				strtotime($this->input->post('post_date'))
				);
				$inputdata['last_date'] 	= date(
				'Y-m-d', 
				strtotime($this->input->post('last_date'))
				);
				$inputdata['status'] 		= $this->input->post('status');
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata, 
					$this->db->dbprefix('notifications')
					);
					
					$msg 					= "Record Added Successfully";
				}
				else {
					$where['nid'] 			= $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('notifications'), 
					$where
					);
					$msg 					= "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/notifications');
			}
			else {
			$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditNotifications');
			}
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 		= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('notifications')
			." where nid=".$this->uri->segment(3)
			);
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Notification';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Notification';
		}
				
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		$this->data['active_menu'] 		= 'notifications';
		$this->data['content'] 			= 'admin/notifications/addeditNotifications';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Testimonials
	function testimonials()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '') {
			$where['tid'] 			= $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('testimonials'), 
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/testimonials');		
		}
				
		$this->data['title'] 			= 'Testimonials';
		$this->data['active_menu'] 		= 'testimonials';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('testimonials')
		);
		$this->data['content'] 			= 'admin/testimonials/testimonials';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditTestimonials()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('author', 'Author', 'trim|required');
		$this->form_validation->set_rules(
		'description', 
		'Description', 
		'trim|required'
		);
		
		if(!empty($_FILES['author_photo']['name'])) {
			$this->form_validation->set_rules('author_photo',"Author Photo", 'callback__image_check['.$_FILES['author_photo']['name'].']');			
		}
		
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['author'] 		= $this->input->post('author');
				$inputdata['description'] 	= $this->input->post('description');			
				$inputdata['status'] 		= $this->input->post('status');
				$inputdata['added_date'] 	= date('Y-m-d');
				$image 						= $_FILES['author_photo']['name'];
				
				//Upload Website Logo
				if (!empty($image)) {
					if($this->input->post('id') != '') {
						$r = $this->base_model->run_query(
						"select author_photo from ".$this->db->dbprefix('testimonials')." 
						where author_photo!='' and status = 'Active' and tid=".$this->input->post('id')
						);
						unlink('assets/uploads/testimony_images/'.$r[0]->author_photo);
					}
					
					$ext = explode('.', $_FILES['author_photo']['name']);
					$inputdata['author_photo'] = $image;
					move_uploaded_file(
					$_FILES['author_photo']['tmp_name'], 
					'assets/uploads/testimony_images/'.$image
					);	
					$this->create_thumbnail(
					'assets/uploads/testimony_images/'. $image, 
					'assets/uploads/testimony_images/images(98x98)/'. $image,98,98);
				}
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata, 
					$this->db->dbprefix('testimonials')
					);
					
					$msg="Record Added Successfully";
				}
				else {
					$where['tid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('testimonials'), 
					$where
					);
					$msg = "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/testimonials');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditTestimonials','refresh');
			}		
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data']=$this->base_model->run_query(
			"select * from ".$this->db->dbprefix('testimonials')
			." where tid=".$this->uri->segment(3)
			);
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Update Testimonial';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Add Testimonial';
		}
				
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['element'] 			= $Options;
		
		$this->data['active_menu'] 		= 'testimonials';
		$this->data['content'] 			= 'admin/testimonials/addeditTestimonials';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	//Update General Settings
	function settings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('site_title', 'Site Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
		'site_description', 
		'Site Description', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'site_keywords', 
		'Site Keywords', 
		'trim|required'
		);
		$this->form_validation->set_rules('site_url', 'Site URL', 'trim|required');
		$this->form_validation->set_rules('copy_right', 'Copy Right', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|integer');
		$this->form_validation->set_rules(
		'passing_score', 
		'Passing Score', 
		'trim|required|integer'
		);
		$this->form_validation->set_rules(
		'contact_email',
		'Contact Email',
		'trim|required|valid_email'
		);
		$this->form_validation->set_rules(
		'google_analytics',
		'Google Analytics',
		'trim|required'
		);
		$this->form_validation->set_rules(
		'certificate_content', 
		'Certificate Content', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'certificate_sign_text', 
		'Text for Signature', 
		'trim|required'
		);
		
		if(!empty($_FILES['site_logo']['name'])) {
			$this->form_validation->set_rules('site_logo',"Site Logo", 'callback__image_check['.$_FILES['site_logo']['name'].']');			
		}
		if(!empty($_FILES['certificate_logo']['name'])) {
			$this->form_validation->set_rules('certificate_logo',"Certificate Logo", 'callback__image_check['.$_FILES['certificate_logo']['name'].']');			
		}
		if(!empty($_FILES['certificate_sign']['name'])) {
			$this->form_validation->set_rules('certificate_sign',"Certificate Sign", 'callback__image_check['.$_FILES['certificate_sign']['name'].']');			
		}
		
		if ($this->form_validation->run() == true) {
			$image 		= $_FILES['site_logo']['name'];
			$image2 	= $_FILES['certificate_logo']['name'];
			$image3 	= $_FILES['certificate_sign']['name'];
			
			//Upload Website Logo
			if (!empty($image)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/designs/images/'.$r[0]->site_logo);
				unlink('assets/uploads/'.$r[0]->site_logo);
				
				$ext = explode('.', $_FILES['site_logo']['name']);
				$inputdata['site_logo'] = $image;
				move_uploaded_file(
				$_FILES['site_logo']['tmp_name'], 
				'assets/uploads/'.$image
				);	
				$this->create_thumbnail(
				'assets/uploads/'. $image, 
				'assets/designs/images/'. $image,360,64
				);
			}
			//Upload Logo on Certificate
			if (!empty($image2)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/uploads/certificate/'.$r[0]->certificate_logo);
				
				$inputdata['certificate_logo'] = $image2;
				move_uploaded_file(
				$_FILES['certificate_logo']['tmp_name'], 
				'assets/uploads/certificate/'.$image2
				);
			}
			//Upload Signature on Certificate
			if (!empty($image3)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/uploads/certificate/'.$r[0]->certificate_sign);
				$inputdata['certificate_sign'] = $image3;
				move_uploaded_file(
				$_FILES['certificate_sign']['tmp_name'], 
				'assets/uploads/certificate/'.$image3
				);
			}
			
			
			$inputdata['site_title'] 		= $this->input->post('site_title');
			$inputdata['site_description'] 	= $this->input->post('site_description');
			$inputdata['site_keywords'] 	= $this->input->post('site_keywords');
			$inputdata['site_url'] 			= $this->input->post('site_url');
			$inputdata['copy_right'] 		= $this->input->post('copy_right');
			$inputdata['address'] 			= $this->input->post('address');
			$inputdata['phone'] 			= $this->input->post('phone');
			$inputdata['passing_score'] 	= $this->input->post('passing_score');
			$inputdata['is_performance_report_for'] = $this->input->post('is_performance_report_for');
			$inputdata['quizzes_for'] 		= $this->input->post('quizzes_to_display');
			$inputdata['contact_email'] 	= $this->input->post('contact_email');
			$inputdata['google_analytics'] 	= $this->input->post('google_analytics');
			$inputdata['certificate_content'] = trim($this->input->post(
			'certificate_content')
			);
			$inputdata['certificate_sign_text'] = trim($this->input->post(
			'certificate_sign_text')
			);
			
			$inputdata['updated_date'] 		= date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('general_settings')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/settings');
		}
		
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('general_settings').""
		);
		$this->data['title'] 			= 'Update Settings';
	
		$this->data['active_menu'] 		= 'settings';
		$this->data['content'] 			= 'admin/settings/settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	//Update Email Settings
	function emailSettings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('smtp_host', 'Smtp Host', 'trim|required');
		$this->form_validation->set_rules('smtp_user', 'Smtp User', 'trim|required|xss_clean');
		$this->form_validation->set_rules('smtp_pass', 'Smtp Password', 'trim|required');
		$this->form_validation->set_rules('smtp_port', 'Smtp Port', 'trim|required');
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['smtp_host'] 		= $this->input->post('smtp_host');
				$inputdata['smtp_user'] 		= $this->input->post('smtp_user');
				$inputdata['smtp_pass'] 		= $this->input->post('smtp_pass');
				$inputdata['smtp_port'] 		= $this->input->post('smtp_port');
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('email_setting')
				);
				$msg = "Record Updated Successfully";
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/emailSettings');
			}
			else {				
					$this->prepare_flashmessage(validation_errors(), 1);
					redirect('admin/emailSettings');
			}
		}
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('email_setting').""
		);
		$this->data['title'] 			= 'Email Settings';
	
		$this->data['active_menu'] 		= 'email-settings';
		$this->data['content'] 			= 'admin/settings/email_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Load View for Uploading Questions in Excel Format
	function uploadexcel()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$this->data['title'] 			= 'Upload questions';
		$this->data['active_menu'] 		= 'questions';
		$this->data['content'] 			= 'admin/questions/upload_question_excel';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	//Read Excel Format Questions and Insert into DB
	function readquestionexcel()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		include(FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');
		$inputFileName 					= $_FILES['questionsfile']['tmp_name'];
		$objReader 						= new PHPExcel_Reader_Excel5();
		$objPHPExcel 					= $objReader->load($inputFileName);
		echo '<hr />';
		$sheetData 						= $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$i								= 0;
		$j 								= 0;
		$data 							= array();
		$valid 							= 1;
		foreach ($sheetData as $r) {
			if ($i++ != 0) {			
			    if ($valid == 1) {
					$data[$j++] = array(
										'subjectid' 	=> $r['A'], 
										'questiontype' 	=> $r['B'],
										'totalanswers' 	=> $r['C'],
										'question' 		=> trim('<p>'.$r['D'].'</p>'),
										'answer1' 		=> trim('<p>'.$r['E'].'</p>'), 
										'answer2' 		=> trim('<p>'.$r['F'].'</p>'),
										'answer3' 		=> trim('<p>'.$r['G'].'</p>'),
										'answer4' 		=> trim('<p>'.$r['H'].'</p>'),
										'answer5' 		=> trim($r['I']),
										'correctanswer' => $r['J'],
										'difficultylevel' => $r['K'],
										'status' 		=> $r['L']
										);
				}
				else {
					break;
				}
			}
		
		}
			if ($valid == 1) {
				$this->db->insert_batch($this->db->dbprefix('questions'), $data);
			}
			else {
				$msg 	= "Invalid Data in excel";
				 $this->prepare_flashmessage($msg, 1);
				 redirect('admin/uploadexcel', 'refresh');
			}
			
			if ($this->db->affected_rows() > 0) {
				$msg = "Questions inserted Successfully";
				$this->prepare_flashmessage($msg, 0);
			}
			else {
				 $msg = "Questions not inserted Successfully";
				 $this->prepare_flashmessage($msg, 1);
			}
				redirect('admin/uploadexcel', 'refresh');
	}
	
	
	//About Us Content Updation
	function aboutusContent()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'content', 
		'Content for Aboutus', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {		
			$inputdata['content'] = trim($this->input->post('content'));
			$inputdata['date_modified'] = date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('aboutus_content')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/aboutusContent');
		}
		
		$this->data['data'] = $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('aboutus_content').""
		);
		$this->data['title'] 			= 'Update Aboutus Content';
		$this->data['active_menu'] 		= 'aboutus_content';
		$this->data['content'] 			= 'admin/aboutus_content';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Get availabile questions according to subject and difficulty level.
	function get_available_questions()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$subjectid 						= $this->input->post('subjectid');
		$difficultylevel 				= $this->input->post('difficultylevel');		
		$available_questions_cnt 		= $this->base_model->run_query(
		"select count(*) as cnt from questions where subjectid="
		.$subjectid." and difficultylevel = '".$difficultylevel."' 
		and answer1!='' and answer2 != '' and correctanswer!='' "
		);
		echo $available_questions_cnt[0]->cnt;
	}
	
	
	//Validation for checking duplicates when performing add operation
	function check_duplicates()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$table 							= $this->input->post('table');
		$cond 							= $this->input->post('condition');
		$cond_val 						= $this->input->post('condition_value');
		$condition[$cond] 				= $cond_val;
		if ($this->base_model->check_duplicates($table,$condition)) {
		    echo "false";//No Availability	
		}
		else {
			echo "true";
		}
	}
	
	
	//Validation for checking duplicates when performing update operation. Here will check the availability except with the updating one.
	function check_duplicates_with_not_cond()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("You have no access to this module",1);
				redirect('user', 'refresh');		
		}
		
		$table 							= $this->input->post('table');
		$cond 							= $this->input->post('condition');
		$cond_val 						= $this->input->post('condition_value');
		$not_cond 						= $this->input->post('not_condition');
		$not_cond_val 					= $this->input->post('not_condition_value');
		$duplicates 					= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix($table)." where "
		.$cond."='".$cond_val."' and ".$not_cond."!=".$not_cond_val
		);
	
		if (count($duplicates)>0) {
			echo "false";//No Availability
		}
		else {
			echo "true";
		}
	}
	
	function paypal_settings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('currency_code', 'currency_code', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == true) {
			$inputdata['paypal_email'] 		= $this->input->post('paypal_email');
			$inputdata['currency_code'] 		= $this->input->post('currency_code');
			$inputdata['status'] 			= $this->input->post('status');
			$inputdata['account_type'] 			= $this->input->post('account_type');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('paypal')
			);
			$msg = "Record Updated Successfully";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/paypal_settings');
		}
		else
		{
			if(validation_errors())
			$this->prepare_flashmessage(validation_errors(), 1);
		}
		
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('paypal').""
		);
		
		$Options['Active'] 				= 'Active';
		$Options['Inactive'] 			= 'Inactive';
		$this->data['status'] 			= $Options;
		unset($Options);
		$Options['Sandbox'] 			= 'Sandbox';
		$Options['Production'] 			= 'Production';
		$this->data['account_type'] 	= $Options;
		
		$currency[''] 		= 'Select Currency';
		$cRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('currencies')
		);
		foreach ($cRecords as $key=>$val) {
		    $currency[$val->code]=$val->country;	
		}
		$this->data['currency'] 		= $currency;
		
		$this->data['title'] 			= 'Paypal Settings';
	
		$this->data['active_menu'] 		= 'paypal';
		$this->data['content'] 			= 'admin/settings/paypal_settings';
		$this->_render_page('temp/admintemplate', $this->data);
		
	}
	
	//Function for Payments Reports
	function payreport()
	{
		$this->validate_admin();
		
		$this->data['title'] 			= 'Payment Reports';
		$this->data['active_menu'] 		= 'payment_report'; 
		$this->data['records'] 			= $this->base_model->run_query(
		"SELECT s.user_id,s.transaction_id, s.payer_email,s.payer_name,q.quizid,
		q.name as quizname,q.quizcost as cost,
		u.username,s.dateofsubscription,s.status,s.validitytype,s.remainingattempts,s.expirydate,s.validityvalue FROM "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('quizsubscriptions')
		." s,".$this->db->dbprefix('users')." u  where
		 s.quizid=q.quizid and s.user_id=u.id"
		);		
		$this->data['content'] 			= 'admin/reports/payment_reports';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	 
	
	// Function For Logout
	function logout()
	{
		$this->session->sess_destroy();
		$this->prepare_flashmessage("You have successfully logout", 0);
		redirect('test');
	
	}
	// function for Uploading Logo
	function do_upload()
	{
		$this->validate_admin();
		
		$config['upload_path'] 			= './assets/uploads/paypal_logo';
		$config['allowed_types'] 		= 'jpg';
		$config['max_size']				= '1000';
		$config['max_width']  			= '400';
		$config['max_height'] 			= '100';
		$config['file_name'] 			= 'logo.jpg';
		$config['overwrite'] 			= TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload())
		{
			$this->prepare_flashmessage($this->upload->display_errors(), 1);
			redirect('admin/paypal_settings');
		}
		else
		{
			$this->prepare_flashmessage("Logo Uploaded Successfully", 0);
			redirect('admin/paypal_settings');
			
		}
	}
	
	function group_settings()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] 	= $this->uri->segment(3);
			$this->base_model->delete_record($this->db->dbprefix('group_settings'), $where);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/group_settings');		
		}
				
		$this->data['title'] 		= 'Group Settings';
		$this->data['active_menu'] 	= '';
		$this->data['records'] 		= $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		$this->data['content'] 		= 'admin/settings/group_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	function add_group()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['group_name'] 		= $this->input->post('group_name');
				$inputdata['status'] 	= $this->input->post('status');
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata,
					$this->db->dbprefix('group_settings')
					);
					
					$msg = "Record Added Successfully";
				}
				else {
					$where['id'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('group_settings'), 
					$where
					);
					$msg = "Record Updated Successfully";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/group_settings', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/add_group', 'refresh');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('group_settings')
			." where id=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Update Group';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Add Group';
		}
		$Options['Active'] 			= 'Active';
		$Options['Inactive'] 		= 'Inactive';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= '';
		$this->data['content'] 		= 'admin/settings/add_group_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
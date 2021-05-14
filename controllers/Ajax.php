<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -----------------------------------------------------
| PRODUCT NAME: 	ITVARNEWS
| -----------------------------------------------------
| AUTHER:			Praveen Kumar
| -----------------------------------------------------
| EMAIL:			praveen@glocious.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY Glocious
| -----------------------------------------------------
| WEBSITE:			http://itvarnews.com/     
| -----------------------------------------------------
| MODULE: 			Home
| -----------------------------------------------------
| This is Home module controller file.
| -----------------------------------------------------
*/

class Ajax extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('string');
		$this->load->library('session');
		$this->load->library('form_validation');		
		$this->load->model('dashboard_model');

	}
	
	public function keywords(){
		$id = $this->input->post('id');
		$where = array('seg_id'=>$id);
		$data = $this->dashboard_model->select_where('keywords',$where);
		echo json_encode($data);
	}
	
	public function city(){
		$id = $this->input->post('id');		
		$where = array('state_id'=>$id);
		//$data = $this->base_model->run_query("select * from tbl_city where state_id ='".$id."'");
		$data = $this->dashboard_model->select_where('tbl_city',$where);
		echo json_encode($data);
		
	}
	
	public function check_exists(){
	$value = $this->input->post('value');
	$query = $this->dashboard_model->run_query("SELECT * FROM 
	(SELECT email, mobile FROM  publishers 
	UNION SELECT email, mobile FROM buyer 
	UNION SELECT email, mobile FROM admin 
	UNION SELECT email, mobile FROM moderator 
	UNION SELECT email, mobile FROM pub_buy) as e 
	WHERE  e.email = '".$value."' or e.mobile = '".$value."'");
	//echo count($query);
				if(count($query)>0){
						$data['mes'] = "Error";
					}
					else{
						$data['mes'] = "success";
					}
			
			echo json_encode($data);
	}
	
	/// first time buyer register
	public function register_buyer(){
		$package_id = $this->input->post('id');
		$set_rules = array(
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|valid_email|is_unique[admin.email]|is_unique[moderator.email]|is_unique[publishers.email]|is_unique[buyer.email]|is_unique[pub_buy.email]'),
			array('field' => 'mobile','label' => 'Mobile','rules' => 'trim|required|is_unique[admin.mobile]|is_unique[moderator.mobile]|is_unique[publishers.mobile]|is_unique[buyer.mobile]|is_unique[pub_buy.mobile]'),
		);
		$this->form_validation->set_message('is_unique', 'This {field} is already exists.');
		$this->form_validation->set_rules($set_rules);
			if($this->form_validation->run() == true){
				$data['otp'] = rand(100000, 999999);
				$this->session->set_tempdata('otp', $data['otp'], 20);
				/// insert data in only buyer table
				$input['ip_address'] = $this->input->ip_address();
				$input['name'] = $this->input->post('name');
				$input['email'] = str_replace("%40","@",$this->input->post('email'));
				$input['comp_name'] = $this->input->post('comp_name');
				$input['mobile'] = $this->input->post('mobile');
				$input['password'] = random_string('alnum', 8);
				$input['date'] = date('Y-m-d');
				$input['time'] = date('H:i:s');
				
				/// insert data in only buyer_package table
				$input2['plan'] = $this->input->post('plan');
				$input2['package_id'] = $package_id;
				$input2['date'] = date('Y-m-d');
				$input2['time'] = date('H:i:s');
				$today = date("Y-m-d");
				if($input2['plan']=='annual'){
					$input2['close_date'] = date('Y-m-d', strtotime('+1 year'. $today));
				}
				else{
					$input2['close_date'] = date('Y-m-d', strtotime('+1 month'. $today));
				}
				
				$this->session->set_userdata('redirect','auth/login');
				$this->session->set_userdata('pwd','password');
				$this->session->set_userdata('table','buyer');
				$this->session->set_userdata('table2','buyer_package');
				$this->session->set_userdata('data',$input);
				$this->session->set_userdata('data2',$input2);
				$this->prepare_flashmessage('Otp sent on your mobile no.',0);
				//$this->send_sms();
				
			}
			else{
				$data['mes'] = validation_errors();
			}
				echo json_encode($data);
		}
		///sign up
		public function sign_up(){
		$set_rules = array(
			array('field' => 'email','label' => 'Email','rules' => 'trim|required|valid_email|is_unique[admin.email]|is_unique[moderator.email]|is_unique[publishers.email]|is_unique[buyer.email]|is_unique[pub_buy.email]'),
			array('field' => 'mobile','label' => 'Mobile','rules' => 'trim|required|is_unique[admin.mobile]|is_unique[moderator.mobile]|is_unique[publishers.mobile]|is_unique[buyer.mobile]|is_unique[pub_buy.mobile]'),
		);
		$this->form_validation->set_message('is_unique', 'The %s is already exists.');
		$this->form_validation->set_rules($set_rules);
			if($this->form_validation->run() == true){
				$data['otp'] = rand(100000, 999999);
				$this->session->set_tempdata('otp', $data['otp'], 20);
				/// insert data in only buyer table
				$input['ip_address'] = $this->input->ip_address();
				$input['name'] = ucwords($this->input->post('name'));
				$input['email'] = str_replace("%40","@",$this->input->post('email'));
				$input['mobile'] = $this->input->post('mobile');
				$input['password'] = md5($this->input->post('password'));
				$input['date'] = date('Y-m-d');
				$input['time'] = date('H:i:s');
				$input['status'] = '1';
				
				$this->session->set_userdata('redirect','auth/login');
				$this->session->set_userdata('table',$this->input->post('register'));
				$this->session->set_userdata('data',$input);
				$this->prepare_flashmessage('Otp sent on your mobile no.',0);
				//$this->send_sms();
			}
			else{
				$data['mes'] = validation_errors();
			}
				echo json_encode($data);
		}
		
		public function login(){
			$name = $this->input->post('name');
			$pwd = md5($this->input->post('pwd'));
			$get_data = $this->check_section($name,$pwd);
			if($get_data['email']){
				if($get_data['section'] == 'admin'){	
				$data['otp'] = rand(100000, 999999);
				$this->session->set_tempdata('otp', $data['otp'], 60);
				$this->session->set_userdata('redirect',$get_data['section']);
				$data['mes'] = 'adminsuccess';
				$this->prepare_flashmessage('Otp sent on your mobile no.',0);
				$array = array(
				'u'=>$get_data['id'],
				'e'=>$get_data['email'],
				'm'=>$get_data['mobile'],
				's'=>$get_data['section'],
				);
				$this->session->set_userdata('mobile',$get_data['mobile']);
				//$this->send_sms();
				$this->session->set_userdata('adminlogin',$array);
				}else{
				$this->session->set_userdata('user_id',$get_data['id']);
				$this->session->set_userdata('email',$get_data['email']);
				$this->session->set_userdata('mobile',$get_data['mobile']);
				$this->session->set_userdata('section',$get_data['section']);
				$data['mes'] = 'success';
				$this->prepare_flashmessage('You have successfully login.',0);
				$data['redirect'] = $get_data['section'];
				}
			}
			else{
				$data['mes'] = "not match";
				$this->prepare_flashmessage('Your username and password not match.',1);
			}
		
		echo json_encode($data);
		}
		
		///reset password
		public function reset_password(){
			$id = $this->input->post('id');
			$table = $this->input->post('table');
			$newpassword = $this->input->post('newpassword');
			$conpassword = $this->input->post('conpassword');
			$where = array('id'=>$id);
				if($newpassword == $conpassword){
					$update  = $this->dashboard_model->update($table,array('session'=>'','password'=>md5($newpassword)),$where);
					$data['mes'] = 'success';
					$this->prepare_flashmessage('Successfully changed your password. Please Login.',0);
					$data['redirect'] = 'auth/login';
				}
				else{
				$data['mes'] = 'not match';
				$this->prepare_flashmessage('New and Confirm Password is not matched.',1);
				}
			
		echo json_encode($data);
	}
	//// reset password
	
	
	/// otp function start
	public function otp(){
		$otp = $this->input->post('otp');
		$tem_otp = $this->session->tempdata('otp');
			if($tem_otp == ''){
				$this->prepare_flashmessage('Your otp time expired.<a href="#" class="btn resend">
				<i class="fa fa-repeat"></i> Resend</a>',1);
				$data['mes'] = "otp expired";
			}
			else if($tem_otp == $otp){
				$table = $this->session->userdata('table');
				$table2 = $this->session->userdata('table2');
				$data = $this->session->userdata('data');
				$data2 = $this->session->userdata('data2');
				
				$admin = $this->session->userdata('adminlogin');
				
					if($data['email'] && $data['password']){
					$this->dashboard_model->insert($table,$data);
					$id = $this->db->insert_id();
					   if($table2 != ''){
							$this->dashboard_model->insert($table2,$data2);
							$buyer_package_id = $this->db->insert_id();
							$this->dashboard_model->update($table2,array('buyer_id'=>$id),array('id'=>$buyer_package_id));
							$data['password'] = $this->session->userdata('pwd');
							$this->email_template($data['email'],$this->load->view('email_template/buyer_password.php',$data,TRUE));
							$this->prepare_flashmessage('Password Sent on your email. Please login.',0);
						}
						else{
							$this->prepare_flashmessage('Please Login.',0);
						}
					//$this->session->set_userdata('user_id',$id);
					
					$this->session->unset_userdata('pwd');
					$this->session->unset_userdata('table');
					$this->session->unset_userdata('table2');
					$this->session->unset_userdata('data');
					$this->session->unset_userdata('data2');
					$data['mes'] = "success";
					}
					else if($admin['u']){
					$this->session->set_userdata('user_id',$admin['u']);
					$this->session->set_userdata('email',$admin['e']);
					$this->session->set_userdata('mobile',$admin['m']);
					$this->session->set_userdata('section',$admin['s']);
					$data['mes'] = "success";
					}
				else{
					$this->prepare_flashmessage('You have successfully logedin.',0);
				}
				
				$data['redirect'] = $this->session->userdata('redirect');
			}
			else{
				$data['mes'] = "not correct";
				$this->prepare_flashmessage('Please enter correct otp.',1);
			}
		echo json_encode($data);
		//redirect('otp');
	}
	//// otp function end
	
	function resend_otp(){
		//$this->send_sms();
		$data['otp'] = rand(100000, 999999);
		$this->session->set_tempdata('otp', $data['otp'], 20);
		$this->prepare_flashmessage('Otp sent on your mobile no.',0);
		//$this->send_sms();
		echo json_encode($data);
	}

	//// view note
	public function view_note(){
		
		$id = $this->input->post('id');
		$buyerid = $this->dashboard_model->single_data_where('leads',array('id'=>$id));
		$note = $buyerid->note;
		print_r($note);
	}
	
	
	
	//// leads request by buyers
	public function buyer_interest(){
		
		$leads = $this->input->post('lead_id');
		$val = explode(",",$leads);
		$input['buyer_id'] = $this->input->post('buyer_id');
		$input['date'] = date('Y-m-d');
		$input['time'] = date('H:i:s');
		$input['status'] = '2';
		$i = 1;
		for($i;$i<=count($val);$i++){
		$input['lead_id'] = $val[$i-1];
		$this->dashboard_model->insert('buyer_interest',$input);
		}
		echo "success";
	}

	public function conversation(){
		//echo "hello";
		$input['lead_id'] = $this->input->post('lead_id');
		$input['buyer_id'] = $this->input->post('buyer_id');
		$input['start_date'] = date('Y-m-d H:i:s');

		$input2['conversation'] = $this->input->post('convers');
		$input2['start_date'] = date('Y-m-d H:i:s');
		$input2['position'] = $this->input->post('position');
		

		$iswork = $this->dashboard_model->run_query("select *,min(is_work) as iswork from moderator where status = '1' and is_work = (SELECT min(is_work) as iswork FROM moderator)");

		$publisherid = $this->dashboard_model->single_data_where('leads',array('id'=>$input['lead_id']));
		$input['p_id'] = $publisherid->p_id;
		

		$conversation = $this->dashboard_model->single_data_where('tbl_conversation',array('lead_id'=>$input['lead_id'],'buyer_id'=>$input['buyer_id']));

		$getadminemail = $this->dashboard_model->single_data('admin');
		$email1 = $getadminemail->email;


		if(count($conversation)>0)
		{
		$input2['conversation_id'] =$conversation->id;
			$this->dashboard_model->insert('tbl_conversation_history',$input2);

			$getemail = $this->dashboard_model->single_data_where('moderator',array('id'=>$conversation->mod_id));
			$email2 = $getemail->email;

		}
		else if($this->input->post('id')>0){
			$input2['conversation_id'] = $this->input->post('id');

			$conversation = $this->dashboard_model->single_data_where('tbl_conversation',array('id'=>$input2['conversation_id']));
			
			$this->dashboard_model->insert('tbl_conversation_history',$input2);

			$getemail = $this->dashboard_model->single_data_where('moderator',array('id'=>$conversation->mod_id));

			$email2 = $getemail->email;
		}

		else
		{
			$email2 = $iswork[0]->email;

			$input['mod_id'] = $iswork[0]->id;

			$this->dashboard_model->insert('tbl_conversation',$input);
			$input2['conversation_id'] = $this->db->insert_id();
			$this->dashboard_model->insert('tbl_conversation_history',$input2);
			$data = $this->dashboard_model->update('moderator',array('is_work'=>($iswork[0]->iswork+1)),array('id'=>$iswork[0]->id));
		}

		$emails = array($email1,$email2);
			
		$this->email_template($emails,$this->load->view('email_template/admin_conversation.php',$input2,true));

		//echo "success";
		print_r($emails);
		
	}

	public function view_conversation(){
		$admin = $this->session->userdata('section');
		$id = $this->input->post('id');
		$mp = $this->input->post('mp');
		$position = $this->input->post('position');
		$update_position = $this->input->post('update_position');
		//echo $position;
		//exit;
		if($mp>0){
			$this->dashboard_model->update('tbl_conversation_history',array('mp'=>'0'),array('conversation_id'=>$id,'position'=>$update_position));
		}
		if($admin == 'admin' || $admin == 'moderator'){
		$getconv = $this->dashboard_model->select_where('tbl_conversation_history',array('conversation_id'=>$id));
		}
		else{
		//$getconv = $this->dashboard_model->select_where('tbl_conversation_history',array('conversation_id'=>$id,'status'=>'1'));

		$getconv = $this->dashboard_model->run_query("select * from  
	(SELECT * FROM  tbl_conversation_history WHERE  status = '1' and conversation_id=".$id."
	UNION SELECT * FROM tbl_conversation_history where position = '".$position."' and conversation_id=".$id.") as e ORDER BY e.id
	 ");
		
		}
		foreach($getconv as $row){
			if($row->position=='in'){
				$mp = '2'; /// message pending for publisher by buyer
			}
			else{
			$mp = '1'; /// message pending for buyer by publisher
			}
if($row->status != '1' && ($admin != 'admin' || $admin != 'moderator')){
	$notapprove = "notapprove";
}
else{

}
echo '<li class="'.$row->position.' '.$notapprove.'" id="'.$row->id.'">
<img class="avatar img-responsive" alt="" src="'.base_url('assets/uploads/admin/profile/photo.jpg').'"/>
<div class="message">
<span class="arrow">
</span>
 <a href="#" class="name">
</a>
<span class="datetime">'.$row->start_date.'
 </span>
<span class="body">';
if($row->status==0 && ($admin == 'admin' || $admin == 'moderator')){

echo '<div class="chat-form">
<div class="input-cont">
<input type="hidden" value="'.$mp.'">
<textarea class="form-control col-md-6">'.$row->conversation.'</textarea>
</div>
<div class="btn-cont" id="btn-cont-final">
<button type="button" class="btn blue update">Approve
 </button></div></div>';
}
else{
	echo $row->conversation;
}
echo '<div class="clearfix"></div><br/>
</span>
</div>
</li>';

}
echo "<input type='hidden' id='conversation_id' value=".$id.">";		
		
	}

	public function buyer_view_conversation(){
		
		$admin = $this->session->userdata('section');
		$lead_id = $this->input->post('lead_id');
		$buyer_id = $this->input->post('buyer_id');
		$mp = $this->input->post('mp');
		$position = $this->input->post('position');
		$update_position = $this->input->post('update_position');
		//echo $position;
		//exit;

		$conversation = $this->dashboard_model->single_data_where('tbl_conversation',array('lead_id'=>$lead_id,'buyer_id'=>$buyer_id));

		if($mp>0){
			$this->dashboard_model->update('tbl_conversation_history',array('mp'=>'0'),array('conversation_id'=>$conversation->id,'position'=>$update_position));
		}
		
		
	
		/*$getconv = $this->dashboard_model->run_query("select * from tbl_conversation_history where conversation_id = ".$conversation->id." UNION select * from tbl_conversation_history where conversation_id = ".$conversation->id." and status='1' and position=".$position." ");*/
if(count($conversation)>0){
		$getconv = $this->dashboard_model->run_query("select * from  
	(SELECT * FROM  tbl_conversation_history WHERE  status = '1' and conversation_id=".$conversation->id."
	UNION SELECT * FROM tbl_conversation_history where position = '".$position."' and conversation_id=".$conversation->id.") as e ORDER BY e.id
	 ");
		
	
		foreach($getconv as $row){
			if($row->position=='in'){
				$mp = '2'; /// message pending for publisher by buyer
			}
			else{
			$mp = '1'; /// message pending for buyer by publisher
			}

			echo '<li class="'.$row->position.'" id="'.$row->id.'">
			<img class="avatar img-responsive" alt="" src="'.base_url('assets/uploads/admin/profile/photo.jpg').'"/>
			<div class="message">
			<span class="arrow">
			</span>
			 <a href="#" class="name">
			</a>
			<span class="datetime">'.$row->start_date.'
			 </span>
			<span class="body">';
			echo $row->conversation;
			echo '<div class="clearfix"></div><br/>
			</span>
			</div>
			</li>';

			}
		}
		
		
	}



	public function update_conversation(){
		$id = $this->input->post('id');
		$txt = $this->input->post('txt');
		$mp = $this->input->post('mp');
		$conversation_id = $this->input->post('conversation_id');

		$getemail = $this->dashboard_model->run_query('select p.email, b.email, p.email as publisher_email, b.email as buyer_email from publishers p, buyer b, tbl_conversation tc where tc.p_id = p.id and tc.buyer_id = b.id and tc.id='.$conversation_id);
		if($mp==1){
			//$email = array();
			$input2['txt'] = $this->input->post('txt');
			$this->email_template($getemail[0]->publisher_email,$this->load->view('email_template/conversation.php',$input2,true));
		//echo $getemail[0]->publisher_email;
		}
		else{
			$input2['txt'] = $this->input->post('txt');
		$this->email_template($getemail[0]->buyer_email,$this->load->view('email_template/conversation.php',$input2,true));
		//echo $getemail[0]->publisher_email;

		}
		$this->dashboard_model->update('tbl_conversation',array('status'=>'1'),array('id'=>$conversation_id));
		$this->dashboard_model->update('tbl_conversation_history',array('conversation'=>$txt,'mp'=>$mp,'status'=>'1'),array('id'=>$id));
		echo "conversation update successfully";
	}

	
	public function invoice_insert(){

		$data['lead_id'] = $this->input->post('leadid');
		$data['p_id'] = $this->input->post('publisherid');
		$data['description'] = $this->input->post('desc');
		$data['qty'] = $this->input->post('qty');
		$data['fixed_cost'] = $this->input->post('fixed_cost');
		$data['time_period'] = $this->input->post('time_period');
		$data['ser_amount'] = $this->input->post('ser_amount');
		$data['ser_tax'] = $this->input->post('ser_tax');
		$data['interhandling'] = $this->input->post('interhandling');
		$data['tot_pay'] = $this->input->post('tot_pay');

		$buyer_id = $this->dashboard_model->select_where('tbl_conversation',array('lead_id'=>$this->input->post('leadid'),'p_id'=>$this->input->post('publisherid')));

			foreach($buyer_id as $row)
			{
				$data['buyer_id'] = $row->buyer_id;
			}

				$this->dashboard_model->insert('tbl_invoice',$data);
				$this->prepare_flashmessage('Your invoice successfully raise.',0);
			

		print_r($data);
		
	}

	
	public function withrawl_request(){
		
		$input['p_id'] = $this->input->post('p_id');

		$input['request_amount'] = $this->input->post('txtamount');

		$input['id'] = $this->input->post('id');

		$totalsum = 1000;
		$input['status']  = "1";

$checkpublisher = $this->dashboard_model->select_where('tbl_request_withdrawl',array('p_id'=>$input['p_id']));


	$withrawlrequest = $this->dashboard_model->select_where('publishers',array('id'=>$input['p_id']));

	if($checkpublisher[0]->p_id==$this->input->post('p_id'))
	{
		$data['mes'] = 
					$this->prepare_flashmessage('you have already withdrawl request send.',1);
	}
	else{

if(($withrawlrequest[0]->account_no!='')&&($input['request_amount']<$totalsum) ||($totalsum>=$input['request_amount']))
			{

				$this->dashboard_model->insert('tbl_request_withdrawl',$input);

				$input['value'] = trim($input['id'], ',');

		$leadid = explode(',',$input['value']);

					for($i=0;$i<count($leadid);$i++)
					{
						$quiz_for['id'] = $leadid[$i];

		$this->dashboard_model->update('leads',array('lead_status'=>1),array('id'=>$leadid[$i]));
					}

				$data['mes'] = 
					$this->prepare_flashmessage('Your withdrawl request successfully send.',0);
			}
			else{
				$data['mes'] = 
					$this->prepare_flashmessage('Your amount should be lessthen earn point or equal.',1);
			}
		}	

		echo "success";
	}

	//// withdrawal request approve by admin
	public function withrawl_request_approve(){
		$publisherid = $this->input->post('publisherid');
		$requestamount = $this->input->post('requestamount');

		$transactionid = $this->input->post('transactionid');

		$this->data['checkpublisherleadamount'] = $this->dashboard_model->select_where('publishers',array('id'=>$publisherid));
	//$totalleadpoint = $this->data['checkpublisherleadamount'][0]->lead_point;

	$walletamount = $requestamount;

	 $this->dashboard_model->update('publishers',array('wallet_amount'=>$requestamount),array('id'=>$publisherid));

	 $this->dashboard_model->update('tbl_request_withdrawl',array('transaction_id'=>$transactionid),array('p_id'=>$publisherid));

	 $input = array('p_id'=>$publisherid,'request_amount'=>$requestamount,'transaction_id'=>$transactionid,'status'=>1);

	 $this->dashboard_model->insert('tbl_withdrawl_request_history',$input);

	 $this->dashboard_model->delete_record('tbl_request_withdrawl',array('p_id'=>$publisherid));

	echo "success";	

	}
	
	
	//// interest status update by admin
	public function update_interest_status(){
		$id = $this->input->post('id');
		$mod_id = $this->input->post('mod_id');
		$status = $this->input->post('value');
		$this->dashboard_model->update('buyer_interest',array('mod_id'=>$mod_id,'status'=>$status),array('id'=>$id));
		echo "success";
	}
	
	
	//// requirements promo code update by admin
	public function update_promo(){
		$id = $this->input->post('id');
		$this->data['promo_code'] = $this->input->post('promo');
		
		$data1 = $this->dashboard_model->run_query("select p.*, s.name as seg_name from publishers p, segments s, leads l where p.id = l.p_id and l.seg_id = s.id and s.id = ".$id." group by p.email");
		$email = array();
		foreach($data1 as $row){
		$this->data['segment'] = $row->seg_name;
		array_push($email,$row->email);
		}	
	//print_r($email);
	$this->email_template($email,$this->load->view('email_template/promo_code.php',$this->data,TRUE));
											
	$this->dashboard_model->update('requirements',array('promo_code'=>$this->data['promo_code']),array('id'=>$id));
		echo "success";
	}
	
}

?>
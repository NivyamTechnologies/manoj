<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
| MODULE: 			general
| -----------------------------------------------------
| This is Admin module controller file.
| -----------------------------------------------------
*/

	//Load the Parent Constructor in Welcome Class Constructor and inherit all the properties. And Load any libraries in this Constructor.
	function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('url');
    } 
	
	//Home Page (Default Function. If no function is called, this function will be called).
	public function index()
	{
	    $this->data['message'] 			= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] 	= array(
				'name' 					=> 'identity',
				'id' 					=> 'identity',
				'class'					=> 'form-control',
				'placeholder'			=> 'User Email',
				'type' 					=> 'text',
				'required'				=> 'true',
				'value' 				=> $this->form_validation->set_value('identity'),
			);
			$this->data['password'] 	= array(
				'name' 					=> 'password',
				'id' 					=> 'password',
				'class' 				=> 'form-control',
				'placeholder' 			=> 'Password',
				'type' 					=> 'password',
				'required' 				=> 'true'
			);
	
		
		
		$this->data['active_menu'] 		= 'home';
		$this->data['content'] 			= 'general/index';
		$this->load->view('general/index');
		//$this->_render_page('temp/template', $this->data);
	}

	//Render Contact Page
	function contact(){
		$this->data['active_menu'] 		= 'contactus';
		$this->data['content'] 			= 'general/contactus';
		$this->_render_page('temp/template', $this->data);
	}
	
	//Send Contact Query to Admin and Send success alert to User in Mail Formats.
	function contact_request_sent()
	{
		if ($this->input->post('submit') != '') {
			$this->load->library('form_validation');
			$this->form_validation->set_rules(
			'name', 
			$this->lang->line('contact_form_validation_name_label'), 
			'required|xss_clean'
			);
			$this->form_validation->set_rules(
			'email', 
			$this->lang->line('contact_form_validation_email_label'), 
			'required|valid_email'
			);
			$this->form_validation->set_rules(
			'phone', 
			$this->lang->line('contact_form_validation_phone_label'), 
			'required|xss_clean|integer'
			);
			$this->form_validation->set_rules(
			'address', 
			$this->lang->line('contact_form_validation_address_label'), 
			'trim|required|xss_clean'
			);
			$this->form_validation->set_rules(
			'subject', 
			$this->lang->line('contact_form_validation_subject_label'), 
			'required|xss_clean'
			);
			if ($this->form_validation->run() == true) {
				$name 		= $this->input->post('name');
				$email 		= $this->input->post('email');
				$phone 		= $this->input->post('phone');
				$address 	= $this->input->post('address');
				$subject 	= $this->input->post('subject');
				$msg 		= "";
				
				if(trim($this->input->post('msg')) != '') {
					$msg 	= $this->input->post('msg');
				}
				$contact_email = $this->base_model->run_query("select contact_email FROM  general_settings ");
				
				//Load Email Library
				$this->load->library('email');
				
				// mail to admin from contactus form				
				$config['charset'] 		= 'utf-8';
				$config['newline'] 		= "\r\n";
				$config['mailtype'] 	= 'html';		
				$config['wordwrap'] 	= TRUE;				
				$this->email->initialize($config);
				$this->email->from($email);		
				$this->email->to($contact_email[0]->contact_email);				
				$this->email->bcc('amit.sadaphal@gmail.com');
				$this->email->subject('Contactus Query');
				$message 				= 'Hello <b>Admin</b>, <br><br>';
				$message 				.='You got a query from <br>Name:<b>'.$name."</b>";
				$message 				.='<br>Phone:<b>'.$phone."</b>";
				$message 				.= '<br>Email:<b>'.$email."</b>";
				$message 				.='<br>Address:<b>'.$address."</b>";
				$message 				.='<br>Subject:<b>'.$subject."</b>";
				if($msg != '')
				$message 				.='<br>Message / Comments:<b>'.$msg."</b>";
				$this->email->message( $message );			
				$this->email->send();
			
				// mail to client from admin form				
				$config['mailtype'] 	= 'html';		
				$config['charset'] 		= 'utf-8';		
				$config['wordwrap'] 	= TRUE;				
				$this->email->initialize($config);
				$this->email->from(
				$contact_email[0]->contact_email, 
				'Online Examination System'
				);
				$this->email->to($email);				
				$this->email->subject('Contact Query Received');
				$message 				= 'Hello <b>'.$name.'</b>, <br><br>';
				$message 				.='Thanks for your interest in  
				Online Examination System. One of our team members 
				will contact you shortly.';
				$message 				.= '<br><br>Thank you,<br><a href="'.base_url().'">OEMS</a>';
				$this->email->message($message);			
				$this->email->send();
				$this->prepare_flashmessage(
				'Your contact query sent successfully. Please check your mail.', 
				'0'
				);
				redirect('welcome/contact', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), '1');
				redirect('welcome/contact', 'refresh');
			}
		}
		else {
			redirect('welcome/contact', 'refresh');
		}	
	}
	
	//Render Aboutus Page.
	function aboutus()
	{
		$aboutus_content 				= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('aboutus_content').""
		);
		$this->data['aboutus_content'] 	= $aboutus_content;
		$this->data['active_menu'] 		= 'aboutus';
		$this->data['content'] 			= 'general/aboutus';
		$this->_render_page('temp/template', $this->data);
	}
	
	//Render Terms and Conditions Page.
	function termsConditions()
	{
	    $this->data['content'] 			= 'general/terms_conditions';
		$this->_render_page('temp/template', $this->data);
	}
	
	//Render List of Notifications 
	function notifications()
	{
		$table 							= 'notifications';
		$condition 						= '';
		if ($this->uri->segment(3)) {
			$notificationId 			= $this->uri->segment(3);
			$condition['nid'] 			= $notificationId;			
		}
		$notifications 					= $this->base_model->fetch_records_from(
		$table, 
		$condition, 
		$select 						= '*', 
		$order_by 						= ''
		);
		$this->data['notifications'] 	= $notifications;
		if ($this->uri->segment(3)) {
			$this->data['notificationTitle'] = $notifications[0]->title;
		}
		$this->data['content'] 			= 'general/notifications';
		$this->_render_page('temp/template', $this->data);
	}
	
	//Check Duplicate Email
	function check_duplicate_email()
	{
		if ($this->base_model->check_duplicate(
		'users', 
		'email', 
		$this->input->post('emailid')
		)) {
			echo "false";
		}
		else {
			echo "true";
		}
	}
	
	
 }

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
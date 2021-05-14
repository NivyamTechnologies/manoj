<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Distribution extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// if(empty($this->session->userdata('sponser_no'))){
		// 	redirect(base_url());
		// }

		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->helper('form');
      
		$this->load->library('session');

		$this->_init();
	}

	private function _init()
	{
		ini_set('xdebug.max_nesting_level', 89000);
	}

	public function index()
	{
		$data = array();
		$filterz = $this->uri->segment(3, "none");
		$data['report_filter'] = $filterz; 

		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$monthx = date('m');
			$yearx = date('Y');
			$month = $this->uri->segment(4, $monthx);
		    $year = $this->uri->segment(5, $yearx);
		}

		$data['month'] = $month;
		$data['year'] = $year;

		if($filterz == 'tour_bonus'){
			$query = $this->db->query('select * from member_bv where month ='.$month.' AND year='.$year.' and 	applicant_no in 
									(select applicant_no from mlm_members_detail where tour_bonus=1)');
		}else if($filterz == 'car_bonus'){
			$query = $this->db->query('select * from member_bv where month ='.$month.' AND year='.$year.' and 	applicant_no in 
									(select applicant_no from mlm_members_detail where car_bonus=1)');
		}else if($filterz == 'stop_car_bonus'){
			$query = $this->db->query('select * from member_bv where month ='.$month.' AND year='.$year.' and 	applicant_no in 
									(select applicant_no from mlm_members_detail where stop_car_bonus=0)');
		}else if($filterz == 'home_bonus'){
			$query = $this->db->query('select * from member_bv where month ='.$month.' AND year='.$year.' and 	applicant_no in 
									(select applicant_no from mlm_members_detail where home_bonus=1)');
		}else{
			$query = $this->db->query('select * from member_bv where month ='.$month.' AND year='.$year);
		}
	
		if($query){ 
			foreach ($query->result() as $key => $row)
			{    
				if($row->current_month_bv>0){ 
					$data['profiles'][$key] = $row; 
					$leg_total_bv = array($data['profiles'][$key]->overall_total_bv_a, $data['profiles'][$key]->overall_total_bv_b, $data['profiles'][$key]->overall_total_bv_c, $data['profiles'][$key]->overall_total_bv_d);
					$leg_current_total_bv = array($data['profiles'][$key]->current_month_bv_a, $data['profiles'][$key]->current_month_bv_b, $data['profiles'][$key]->current_month_bv_c, $data['profiles'][$key]->current_month_bv_d);
					$maxKey = $this->getMaxKey($leg_total_bv);
					$maxKeyCurrent = $this->getMaxKey($leg_current_total_bv);
					
					//assign now
					if(isset($leg_total_bv[$maxKeyCurrent])){
						$data['profiles'][$key]->overall_total_bv_a = $leg_total_bv[$maxKeyCurrent];
						$data['profiles'][$key]->current_month_bv_a = $leg_current_total_bv[$maxKeyCurrent];
					}
					
					$keyone = ($maxKeyCurrent==1)?0:1;
					if(isset($leg_total_bv[$keyone])){
						$data['profiles'][$key]->overall_total_bv_b = $leg_total_bv[$keyone];
						$data['profiles'][$key]->current_month_bv_b = $leg_current_total_bv[$keyone];
					}

					$keytwo = ($maxKeyCurrent==2)?0:2;
					if(isset($leg_total_bv[$keytwo])){
						$data['profiles'][$key]->overall_total_bv_c = $leg_total_bv[$keytwo];
						$data['profiles'][$key]->current_month_bv_c = $leg_current_total_bv[$keytwo];
					}

					$keythree = ($maxKeyCurrent==3)?0:3;
					if(isset($leg_total_bv[$keythree])){
						$data['profiles'][$key]->overall_total_bv_d = $leg_total_bv[$keythree];
						$data['profiles'][$key]->current_month_bv_d = $leg_current_total_bv[$keythree];
					}

					$onlyMyBv = $this->currentonlyMybv($data['profiles'][$key]->applicant_no, $month, $year);
					if($filterz == "mobile_bonus"){ 
						if($data['profiles'][$key]->current_month_bv_a < 11500 || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 11500){ 
							unset($data['profiles'][$key]);
						}
					}
					
					if($filterz == "tour_bonus") {
						if(($data['profiles'][$key]->current_month_bv_a < 11500) || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 11500){
							unset($data['profiles'][$key]);
						}
					}
					if($filterz == "car_bonus" ) {
						if(($data['profiles'][$key]->current_month_bv_a < 11500) || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 11500){
							unset($data['profiles'][$key]);
						}
					}
					if($filterz == "stop_car_bonus") {
						if(($data['profiles'][$key]->current_month_bv_a < 31000) || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 31000){
							unset($data['profiles'][$key]);
						}
					}
					
					if($filterz == "running_bonus"){
						if(($data['profiles'][$key]->current_month_bv_a < 30000) || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 30000){
							unset($data['profiles'][$key]);
						}
					}
					if($filterz == "royalty_bonus"){
						if(($data['profiles'][$key]->current_month_bv_a < 11500) || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 11500){
							unset($data['profiles'][$key]);
						}
					}
					
					if($filterz == "leader_bonus"){
						if($data['profiles'][$key]->current_month_bv_a <  1800001 || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 1800001){ 
							unset($data['profiles'][$key]);
						}
					}
					
					// if($filterz == "home_bonus"){ 
					// 	if(($data['profiles'][$key]->current_month_bv_a < 110000) || ($onlyMyBv+$data['profiles'][$key]->current_month_bv_b+$data['profiles'][$key]->current_month_bv_c+$data['profiles'][$key]->current_month_bv_d) < 110000){
					// 	unset($data['profiles'][$key]);
					// }
				//	}
				}
			} 
		}
		
		//echo "<pre>"; print_r($data['profile']); exit;
		if($filterz == "none"){
			$data['content'] 		= 'admin/view';
			$this->view('distribution/distribution',$data);
		}else{

			$this->db->where('month', $month);
			$this->db->where('year', $year);
			$query = $this->db->get('report_process'); 
			if($query){
				$report_process_datas = $query->result_array(); 
				foreach($report_process_datas as $report_process_data){ 
					 $data['report'][$report_process_data['sponsor_id']] = $report_process_data;
				} 
			}else{
				$data['report'][$report_process_data['sponsor_id']] = array();
			}
      
            $data['content'] 		= 'admin/view';
			$this->view('distribution/bonus',$data);
		}
	}
	
	function getSingleMemeber(){
		$month = $_GET['month'];
		$year = $_GET['year'];
		$applicant_no = $_GET['applicant_no'];
			
		$this->db->where('applicant_no', $applicant_no);
		$query = $this->db->get('mlm_members_detail');
		
		foreach ($query->result() as $key => $row)
		{ 

			$profiles = $row; 
			$profiles->order_current_total_bv = $this->base_model->currentbv($profiles->applicant_no, $month, $year);
			if($profiles->order_current_total_bv<=0){
				//unset($profiles);
				//continue;
			}
			$profiles->bv = $this->base_model->getuserarray($profiles->applicant_no, array());
			$userquery = $this->db->query("SELECT b.applicant_no,a.applicant_parent_no,b.sponser_no,b.applicant_name FROM mlm_member_tree a left join mlm_members_detail b on a.applicant_no=b.applicant_no WHERE a.applicant_parent_no = '".$profiles->applicant_no."'");
			$a_b_results = $userquery->result();

			$profiles->leg_count = count($a_b_results);

			if(isset($a_b_results[0])){ 
				$a_sponser_no = $a_b_results[0]->applicant_no; 
				$leg_total_bv[0] = $this->base_model->getuserarray($a_sponser_no, array()); 
				$leg_current_total_bv[0] = $this->base_model->currentbv($a_sponser_no, $month, $year);
			}else{
				$leg_total_bv[0] = 0;
				$leg_current_total_bv[0] = 0;
			}
			
			if(isset($a_b_results[1])){
				$b_sponser_no = $a_b_results[1]->applicant_no; 
				$leg_total_bv[1] = $this->base_model->getuserarray($b_sponser_no, array());
				$leg_current_total_bv[1] = $this->base_model->currentbv($b_sponser_no, $month, $year);
			}else{
				$leg_total_bv[1] = 0;
				$leg_current_total_bv[1] = 0;
			}

			if(isset($a_b_results[2])){
				$c_sponser_no = $a_b_results[2]->applicant_no; 
				$leg_total_bv[2] = $this->base_model->getuserarray($c_sponser_no, array());
				$leg_current_total_bv[2] = $this->base_model->currentbv($c_sponser_no, $month, $year);
			}else{
				$leg_total_bv[2] = 0;
				$leg_current_total_bv[2] = 0;
			}

			if(isset($a_b_results[3])){
				$d_sponser_no = $a_b_results[3]->applicant_no; 
				$leg_total_bv[3] = $this->base_model->getuserarray($d_sponser_no,  array());
				$leg_current_total_bv[3] = $this->base_model->currentbv($d_sponser_no, $month, $year);
			}else{
				$leg_total_bv[3] = 0;
				$leg_current_total_bv[3] = 0;
			}

			if(!empty($a_b_results)){
				$maxKey = $this->getMaxKey($leg_total_bv);	
			}else{
				$maxKey = 0;
			}
			
			//assign now
			if(isset($leg_total_bv[$maxKey])){
				$profiles->order_a_total_bv = $leg_total_bv[$maxKey];
				$profiles->order_a_current_total_bv = $leg_current_total_bv[$maxKey];
			}else{
				$profiles->order_a_total_bv = 0;
				$profiles->order_a_current_total_bv = 0;
			}
			
			$keyone = ($maxKey==1)?0:1;
			if(isset($leg_total_bv[$keyone])){
				$profiles->order_b_total_bv = $leg_total_bv[$keyone];
				$profiles->order_b_current_total_bv = $leg_current_total_bv[$keyone];
			}else{
				$profiles->order_b_total_bv = 0;
				$profiles->order_b_current_total_bv = 0;
			}

			$keytwo = ($maxKey==2)?0:2;
			if(isset($a_b_results[2])){
				$profiles->order_c_total_bv = $leg_total_bv[$keytwo];
				$profiles->order_c_current_total_bv = $leg_current_total_bv[$keytwo];
			}else{
				$profiles->order_c_total_bv = 0;
				$profiles->order_c_current_total_bv = 0;
			}

			$keythree = ($maxKey==3)?0:3;
			if(isset($a_b_results[3])){
				$profiles->order_d_total_bv = $leg_total_bv[$keythree];
				$profiles->order_d_current_total_bv = $leg_current_total_bv[$keythree];
			}else{
				$profiles->order_d_total_bv = 0;
				$profiles->order_d_current_total_bv = 0;
			}
		} 
		
		echo json_encode(array(
		$profiles->applicant_no,
		$profiles->applicant_name,
		$profiles->mobile_no,
		$profiles->bv,
		$profiles->order_a_total_bv,
		$profiles->order_b_total_bv,
		$profiles->order_c_total_bv,
		$profiles->order_d_total_bv,
		percentage($profiles->bv),
		percentage($profiles->order_a_total_bv),
		percentage($profiles->order_b_total_bv),
		percentage($profiles->order_c_total_bv),
		percentage($profiles->order_d_total_bv),
		$profiles->order_current_total_bv,
		$profiles->order_a_current_total_bv,
		$profiles->order_b_current_total_bv,
		$profiles->order_c_current_total_bv,
		$profiles->order_d_current_total_bv,
		$profiles->order_current_total_bv-($profiles->order_a_current_total_bv+$profiles->order_b_current_total_bv+$profiles->order_c_current_total_bv+$profiles->order_d_current_total_bv),
		$profiles->order_current_total_bv/10,
		$profiles->order_a_current_total_bv/10,
		$profiles->order_b_current_total_bv/10,
		$profiles->order_c_current_total_bv/10,
		$profiles->order_d_current_total_bv/10,
		""
		//$you_comm = ($profiles->order_current_total_bv/10)-(($profiles->order_a_current_total_bv/10)+($profiles->order_b_current_total_bv/10)+($profiles->order_c_current_total_bv/10)+($profiles->order_d_current_total_bv/10))
		));
	}
	
	function percentage($bv){
		echo $bv;

        $commission = 0;
		if($bv == 0){
			$bv = 1;
		}
		switch ($bv) {
			case $bv<=5000:
				$commission = 6;
				break;
			case $bv>=5001 && $bv<=12000:
				$commission = 8;
				break;
			case $bv>=12001 && $bv<=23000:
				$commission = 10;
				break;
			case $bv>=23001 && $bv<=44000:
				$commission = 12;
				break;
			case $bv>=44001 && $bv<=59000:
				$commission = 14;
				break;
			case $bv>=59001 && $bv<=110000:
				$commission = 16;
				break;
			case $bv>=110001 && $bv<=180000:
				$commission = 18;
				break;
			case $bv>=180001:
				$commission = 20;
				break;
			default:
				$commission = 0;
		}

		return $commission;
    }

	function report_process(){

		if(isset($_POST['month']) && is_array($_POST['none'])){

			$month = $_POST['month'];
			$year = $_POST['year'];

			foreach($_POST['none'] as $key => $value){

				$this->db->where('month', $month);
				$this->db->where('year', $year);
				$this->db->where('sponsor_id', $key);
				$query = $this->db->get('report_process'); 
				$report = $query->result();

				if(count($report)>0){
					$this->db->set("none", $value);
					$this->db->where('month', $month);
					$this->db->where('year', $year);
					$this->db->where('sponsor_id', $key);
					$this->db->update('report_process');
				}else{
					$data = array(
						'sponsor_id' => $key,
						'month' => $_POST['month'],
						'year' => $_POST['year'],
						'none' => $value
					);

					$this->db->insert('report_process', $data);
				}
			}
	
		}	

		redirect('distribution');
	}

	function report_save(){

		if(isset($_POST['sponsor_id']) && is_array($_POST['sponsor_id'])){

			$month = $_POST['month'];
			$year = $_POST['year'];

			foreach($_POST['sponsor_id'] as $key => $sponser_no){

				$this->db->where('month', $month);
				$this->db->where('year', $year);
				$this->db->where('sponsor_id', $sponser_no);
				$query = $this->db->get('report_process'); 
				$report = $query->result();
				
				if(count($report)>0){
					$this->db->set($_POST['report_filter'], $_POST['commission'][$key]);
					$this->db->where('month', $month);
					$this->db->where('year', $year);
					$this->db->where('sponsor_id', $sponser_no);
					$this->db->update('report_process');
				}else{
					$data = array(
						'sponsor_id' => $sponser_no,
						'month' => $_POST['month'],
						'year' => $_POST['year'],
						$_POST['report_filter'] => $_POST['commission'][$key]
					);

					if(!$this->db->insert('report_process', $data)){
						$error = $this->db->error();
						print_r($key-1);
						print_r($data);
						print_r($error); exit;
					}
				}
			}
	
		}	

		redirect('distribution');
	}

	public function approve_report($sponser_no, $month, $year, $value){

		$this->output->set_template('blank');
		$data = array('other_bonus'=> $value);
		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$this->db->where('sponser_no', $sponser_no);
		$this->db->update('report_process', $data);

		echo "Report Save Sucessfully";
	}

	public function update_report(){
		$this->output->set_template('blank');
		$month = $_POST['month'];
		$year = $_POST['year'];
		$sponser_no = $_POST['sponser_no'];

		$data = array(
				'c_leader_bonus'  => isset($_POST['c_leader_bonus'])?$_POST['c_leader_bonus']:0,
				'c_running_bonus' => isset($_POST['c_running_bonus'])?$_POST['c_leader_bonus']:0,
				'c_tour_bonus'    => isset($_POST['c_tour_bonus'])?$_POST['c_leader_bonus']:0,
				'c_car_bonus'     => isset($_POST['c_car_bonus'])?$_POST['c_leader_bonus']:0,
				'c_home_bonus'    => isset($_POST['c_home_bonus'])?$_POST['c_leader_bonus']:0
		);

		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$this->db->where('sponser_no', $sponser_no);
		$this->db->update('report_process', $data);

		echo "Report Save Sucessfully";
	}

	public function accounts()
	{
		
		

		$data = array();
		$filterz = $this->uri->segment(4, "none");
		$data['report_filter'] = $filterz; 

		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$monthx = date('m');
			$yearx = date('Y');
			$month = $this->uri->segment(5, $monthx);
		    $year = $this->uri->segment(6, $yearx);
		}
		$sponser_no = 10000005; //$this->session->userdata('sponser_no');
		$data['month'] = $month;
		$data['year'] = $year;

		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$this->db->where('sponser_no', $sponser_no);
		$query = $this->db->get('report_process'); 
		$data['reports'] = $query->result(); 

		$this->load->view('member/accounts',$data);
	}


	public function finalize_report()
	{
		$data = array();
		$filterz = $this->uri->segment(4, "none");

		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
			//$data['report_filter'] = $_POST['report_filter']; 
		}else{
			$monthx = date('m');
			$yearx = date('Y');
			$month = $this->uri->segment(5, $monthx);
		    $year = $this->uri->segment(6, $yearx);
		}

		$data['month'] = $month;
		$data['year'] = $year;

		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$query = $this->db->get('report_process'); 
		$data['reports'] = $query->result(); 

		$this->load->view('member/finalize_report',$data);
	}

	function getMaxKey($value_array){

		$value = max($value_array);
		$key = array_search($value, $value_array);

		return $key;
	}
	
	function myRecursive($sponser_no, $irrator, $month, $year){ 
		if($irrator == 'my'){
			$total_bv = $this->myoverallbv($sponser_no, $month, $year);
			return $total_bv;
		}else{ 
			$total_bv = $this->overallbv($sponser_no, $month, $year); 
			return $total_bv;
		}
	}

	function myMonthRecursive($sponser_no, $irrator, $month, $year){
		
		if($irrator == 'my'){
			$total_bv = $this->mycurrentbv($sponser_no,$month,$year);
			return $total_bv;
		}else{ 
			$total_bv = $this->currentbv($sponser_no,$month,$year);
			return $total_bv;
		}
		
		//echo '<pre>'; print_r($ret->bv);exit;
	}

	function member_to_bonus(){

		$data = array();

		if(isset($_POST['applicant_no'])){
			$this->db->insert('member_to_bonus', $_POST);
		}

		$data['report_filter'] = 'tour_bonus';
		$this->load->view('member/member_to_bonus',$data);
	}
	
	function view($filename,$data)
	{
		$role_id = $this->getid($this->session->userdata('role'));
		if($this->session->userdata('role')=='admin')
		{
			$result = $this->db->query("select * from main_menu a where a.menu_type='1' and FIND_IN_SET('".$role_id."',role) and 
			a.menu_status='active' order by a.seq");
		}
		elseif($this->session->userdata('role')=='subadmin')
		{
			$result = $this->db->query("select * from main_menu a inner join menu_user b on a.id=b.menu_id where a.menu_type='1' and b.user_id='".$this->session->userdata('empid')."' and b.eid='".$role_id."' and
			a.menu_status='active' order by a.seq");	
		};

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
	
	function recursive($pos_category_id, $array ="")
    {
		if(!is_array($array)){
			$array = array();
		}
		$query = $this->db->query("SELECT applicant_no,applicant_parent_no FROM mlm_member_tree WHERE applicant_parent_no = '".$pos_category_id."'") or 
		die('Invalid query: ' . mysql_error()); 
		
		foreach($query->result_array() as $row)
		{   
			$array[] = $row['applicant_no'];
			$array = $this->recursive($row['applicant_no'], $array);
		} 
		return $array;
	}
	
	function currentonlyMybv($apno,$mon,$year)
	{
		$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($apno) and MONTH(`datetime`) = '".$mon."' and YEAR(`datetime`) = '".$year."'");
		$curbv=$result->result_array();
		$result1 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($apno) and MONTH(`date`) = '".$mon."' and YEAR(`date`) = '".$year."'");
		$curbv1=$result1->result_array();
		return $curbv[0]['monthbv']+$curbv1[0]['monthbv1']; 	
	}
	
	function currentbv($apno,$mon,$year)
	{
		$pp1 = $this->recursive($apno);
		if($pp1 == ""){
			$pp1 = array();
		}
		$kk = array_map(function($n) { return "'".$n."'"; },$pp1);
		$kk[] = "'".$apno."'";
		$pp = implode(',',$kk);	
		$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($pp) and MONTH(`datetime`) = '".$mon."' and YEAR(`datetime`) = '".$year."'");
		$curbv=$result->result_array();
		$result1 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($pp) and MONTH(`date`) = '".$mon."' and YEAR(`date`) = '".$year."'");
		$curbv1=$result1->result_array();
		return $curbv[0]['monthbv']+$curbv1[0]['monthbv1']; 	
	}
	
	function mycurrentbv($apno,$mon,$year)
	{
		$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($apno) and MONTH(`datetime`) = '".$mon."' and YEAR(`datetime`) = '".$year."'");
		$curbv=$result->result_array();
		$result1 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($apno) and MONTH(`date`) = '".$mon."' and YEAR(`date`) = '".$year."'");
		$curbv1=$result1->result_array();
		return $curbv[0]['monthbv']+$curbv1[0]['monthbv1']; 	
	}
	
	function overallbv($apno,$mon,$year)
	{   
		$pp1 = $this->recursive($apno); 
		if($pp1 == ""){
			$pp1 = array();
		}
		$kk = array_map(function($n) { return "'".$n."'"; },$pp1); 
		$kk[] = "'".$apno."'";
		$pp = implode(',',$kk);	 
		$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($pp) and MONTH(`datetime`) <= '".$mon."' and YEAR(`datetime`) <= '".$year."'");
		$curbv=$result->result_array();
		$result1 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($pp) and MONTH(`date`) <= '".$mon."' and YEAR(`date`) = '".$year."'");
		$curbv1=$result1->result_array(); 
		return $curbv[0]['monthbv']+$curbv1[0]['monthbv1']; 	
	}
	
	function myoverallbv($apno,$mon,$year)
	{
		$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($apno) and MONTH(`datetime`) <= '".$mon."' and YEAR(`datetime`) <= '".$year."'");
		$curbv=$result->result_array();
		$result1 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($apno) and MONTH(`date`) <= '".$mon."' and YEAR(`date`) = '".$year."'");
		$curbv1=$result1->result_array();
		return $curbv[0]['monthbv']+$curbv1[0]['monthbv1']; 	
	}
	
	function getid($key)
	{
		$this->db->select("role_id");
		$this->db->from("mlm_member_role");
		$this->db->where("rolekey",$key);
		$result=$this->db->get();
		$res=$result->result_array();
		return $res[0]['role_id'];	
	}
	
	function get_menu($parent)
	{
		$role_id = $this->getid($this->session->userdata('role'));
		if($this->session->userdata('role')== 'admin')
		{
			$this->db->select("*");
			$this->db->from("main_menu");
			$this->db->where("menu_parent",$parent);
			$this->db->where("menu_status",'active');
			$this->db->order_by("seq");
		}
		else
		{
			$this->db->select("*");
			$this->db->from("main_menu a");
			$this->db->join("menu_user b",'a.id=b.menu_id','Inner Join');
			$this->db->where("a.menu_parent",$parent);
			$this->db->where("a.menu_status",'active');
			$this->db->where("b.user_id",$this->session->userdata('empid'));
			$this->db->where("b.eid",$role_id);
			$this->db->order_by("a.seq");
		}
		
		$result=$this->db->get();
		return $result->result_array();	
	}
}

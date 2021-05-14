<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(0);
class Admin extends MY_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	ONLINE HUMAN RESOURCES MANAGEMENT SYSTEM (HRMS)
| -----------------------------------------------------
| AUTHER:			Amit Sadaphal
| -----------------------------------------------------
| EMAIL:			amit.sadaphal@gmail.com//
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
		$this->load->helper('form');
      
		$this->load->library('session');
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo;
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
	
	function getPhone($applicant_no)
	{
		$this->db->select("mobile_no");
		$this->db->from("mlm_members_detail");
		$this->db->where("applicant_no",$applicant_no);
		$result=$this->db->get();
		$res=$result->result_array();
		return $res[0]['mobile_no'];	
	}
	/***Admin Dashboard (Default Function. If no function is called, this function
	 will be called)***/
	/////////////////////////
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
		$menu_query = "select * from main_menu a inner join menu_user b on a.id=b.menu_id where a.menu_type='1' and b.user_id='".$this->session->userdata('empid')."' and b.eid='".$role_id."' and
		a.menu_status='active' order by a.seq";
		
		$result = $this->db->query($menu_query);	
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

	if(!isset($data['userinfo'])){
		$userinfo = $this->base_model->run_query(
			"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
			$data['userinfo'] 	= $userinfo;
	}


	$this->load->view($filename,$data);
	}
	
	function menu_mange()
	{
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_type",1);
	$this->db->order_by("seq");
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
	$this->load->view('admin/menu_manage',$data);
	}
	
	
	function menu_manage_sidebar()
	{	
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_type",1);
	$this->db->order_by("seq");
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
	$lll[$key]['child'][$key1]['subchild'][$key2]['subsubchild']=$this->get_menu_action($ccc['id']);	
	}
	}
	}
	$data['data1']=$lll;
	$this->view('admin/menu_manage_sidebar',$data);
	}
	
	function user_menu_manage_sidebar($type,$userid)
	{
	$role_id = $type;
    $result = $this->db->query("select * from main_menu a where a.menu_type='1' and FIND_IN_SET('".$role_id."',role) and 
	a.menu_status='active' order by a.seq");
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
	$data['eid']=$type;
	$data['userid']=$userid;
	$this->view('admin/user_menu_manage_sidebar',$data);
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
	
	
	
	function update_seq_menu()
	{
	$array	= $_POST['arrayorder'];
    if ($_POST['update'] == "update")
	{
	$count = 1;
	foreach ($array as $idval) 
	{
	$query = mysql_query("UPDATE main_menu SET seq = 
    " . $count . " WHERE id = " . $idval);
	$result = $this->db->query($query);	
	//mysql_query($query) or die('Error, insert query failed');
	$count ++;	
    }
	echo 'Refresh page to see the changes!';
}	
	}
	
	function rename_name()
	{
    $res = $this->getid($this->session->userdata('empid'));
	$tid = $res[0]['aid'];
	$bid = $res[0]['branch_id'];
	$eid=$this->session->userdata('empid');
	
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_type",1);
	$this->db->where("menu_status",'active');
	$this->db->order_by("seq");
	
	$result=$this->db->get();	
	foreach($result->result_array() as $key=>$value)
	{
	$lll[$key]=$value;
	$kkk[$value['id']."#".'black'] = "<b style='color:black';>".$value['menu_name']."</b>";
	foreach($this->get_menu1($lll[$key]['id']) as $key1=>$ppp)
	{
	$kkk[$ppp['id']."#".'blue'] = "<b style='color:blue';>"."-----".$ppp['menu_name']."</b>";
	foreach($this->get_menu1($ppp['id']) as $key2=>$ccc);
	{
	$kkk[$ccc['id']."#".'green'] = "<b style='color:green';>"."---------".$ccc['menu_name']."</b>";	
	}
	}
	}
	$data['renamedata'] = $kkk;	
	$this->view('admin/renamemenu',$data);
	}
	
	function rename_nameedit()
	{
    $id=$_POST['menuid'];
	$rename=$_POST['rename'];
	$this->base_model->run_query("update main_menu set menu_name ='".$rename."' where id='".$id."'");
	$this->session->set_flashdata('success','<font color="#05BD14">Organization successfully created please check your email id for Organization login details...</font>');
	redirect('admin/rename_name');
	}
	
	function get_menu1($parent)
	{
	$this->db->select("*");
	$this->db->from("main_menu");
    $this->db->where("menu_parent",$parent);
	$this->db->where("menu_status",'active');		
	$result=$this->db->get();	
	return $result->result_array();
	}
	
	
	function get_menu_action($parent)
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
	
	
	function usermenugetdata()
	{	
	if($_POST['value'])
	{
	$data=explode('#',$_POST['value']);
	$arry=array('user_id'=>$data[0],'menu_id'=>$data[1],'eid'=>$data[2]);
	$this->db->insert('menu_user',$arry);
	}
	if($_POST['devalue'])
		{
	$data=explode('#',$_POST['devalue']);
	mysql_query("delete from menu_user where user_id='".$data[0]."' and menu_id='".$data[1]."' and eid='".$data[2]."'");
		}
	}
	/////////////////////////
	
	function index()
	{
		return redirect('admin/dashboard',$this->data);
	}
	/***Admin Dashboard***/
	function dashboard()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		//Data For Active Users
		$Allseminar = $this->base_model->run_query(
		"select * from tbl_seminar");
		
		$this->data['state'] = $this->base_model->getStateByCountry();

		
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 				= 'Admin Dashboard';		
		$this->data['active_menu'] 			= 'dashboard';
		$this->data['content'] 				= 'admin/dashboard';
	
		$this->view('admin/dashboard',$this->data); 
	}

	function levellist(){
		
	
		$levellist = $this->base_model->run_query(
		"SELECT * from level");

		$this->data['levellist'] 	= $levellist;
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/levellist';
	// print_r($levellist);exit;
		$this->view('admin/levellist',$this->data); 
	
	}

	 public function addlevel()
	{
		
		$msg= "";
		$leveldata = $this->base_model->run_query(
		"SELECT level_name from level ");
		if(isset($_POST['level_name'])){
			
				 $insert['level_name'] = $_POST['level_name'];
				$insert['applicant_no'] = $_POST['branch_id'];
				$this->db->insert('level',$insert);
				$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
			}
		//Data For Active Users
		//echo "<pre>"; print_r($dplist); exit;

		$this->data['leveldata'] 	= $leveldata;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addlevel';
		$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
		$this->view('admin/addlevel',$this->data); 
	}


	public function addopening()
	{
		
		$msg= "";
		
		if(isset($_POST['balance'])){
			
			$this->db->set('opening_balance_quantity', $_POST['balance']);
			$this->db->where('applicant_no', $_POST['branch_id']);
			$this->db->update('mlm_members_detail');
				$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
			}
	
			$addopening = "";
		$this->data['addopening'] 	= $addopening;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addlevel';
		$msg ="Saved Successfully";
		
		$this->view('admin/addopening',$this->data); 
	}

	public function addpanno()
	{
		
		$msg= "";
		
		if(isset($_POST['panno'])){
			
			$this->db->set('panno', $_POST['panno']);
			$this->db->where('applicant_no', $_POST['branch_id']);
			$this->db->update('mlm_members_detail');
				$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
			}
	
			$addpanno = "";
		$this->data['addpanno'] 	= $addpanno;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addpanno';
		$msg ="Saved Successfully";
		
		$this->view('admin/addpanno',$this->data); 
	}

	public function addphoneno()
	{
		
		$msg= "";
		
		if(isset($_POST['mobile_no'])){
			
			$this->db->set('mobile_no', $_POST['mobile_no']);
			$this->db->set('applicant_name', $_POST['bvmbranchname']);
			$this->db->where('applicant_no', $_POST['branch_id']);
			$this->db->update('mlm_members_detail');
				$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
			}
	
			$addphoneno = "";
		$this->data['addphoneno'] 	= $addphoneno;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addphoneno';
		$msg ="Saved Successfully";
		
		$this->view('admin/addphoneno',$this->data); 
	}
	
	public function addbankaccno()
	{
		
		$msg= "";
		$this->data['bank'] = $this->base_model->run_query(" select * from mlm_bank_detail");
		if(isset($_POST['bank_accno'])){
			
			$this->db->set('bank_accno', $_POST['bank_accno'],'bank_name', $_POST['bankname'],'bank_ifsc_code' ,$_POST['bank_ifsc_code']);
			$this->db->set('bank_name', $_POST['bankname']);
			$this->db->set('bank_ifsc_code', $_POST['bank_ifsc_code']);
			$this->db->where('applicant_no', $_POST['branch_id']);
			$this->db->update('mlm_members_detail');
				$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
			}
	
			$bank_accno = "";
		$this->data['bank_accno'] 	= $bank_accno;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addlevel';
		$msg ="Saved Successfully";
		
		$this->view('admin/addbankaccno',$this->data); 
	}
	
	
	
	public function pucper()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	//echo "<pre>"; print_r($month); exit;
		$pucper = $this->base_model->run_query(
		"
  select  mlm_puc_detail.commisionondistributor, sum(totalrp) totaldp,
			sum(totalbv) distributorbv,(sum(totalrp)*mlm_puc_detail.commisionondistributor)/100 TotalAmount,mlm_puc_detail.commisionondistributor percentageValue, mlm_puc_detail.distributor_id,mlm_members_detail.applicant_name, 
			mlm_members_login.applicant_no branch_id, mlm_puc_detail.bvmbranchname branch_name
		from mlm_dist_chalan
	   left join mlm_members_login
	   on mlm_dist_chalan.createby = mlm_members_login.member_id
	   left join mlm_puc_detail
	   on mlm_puc_detail.applicant_no = mlm_members_login.applicant_no
	   left join mlm_members_detail	
	   on mlm_members_detail.applicant_no = mlm_puc_detail.distributor_id
	   where month(mlm_dist_chalan.datetime) = '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."' 
	   group by branch_name having branch_name  is not null
  
  
");

		$this->data['pucper'] 	= $pucper;
		$this->data['title'] 				= 'pucper List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/pucper';
	
		$this->view('admin/pucper',$this->data); 
	}

	public function pucper1()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	//echo "<pre>"; print_r($month); exit;
		$pucper = $this->base_model->run_query(
		"Select mlm_members_detail.applicant_name, mlm_puc_detail.distributor_id,mlm_members_detail.mobile_no, branch_id,mlm_puc_chalan.branch_name,
sum(totaldp) totaldp, (sum(totaldp)*dcomisson)/100 TotalAmount, createby, dcomisson percentageValue from mlm_puc_chalan
left join mlm_puc_detail
on mlm_puc_detail.applicant_no = mlm_puc_chalan.branch_id
left join mlm_members_detail
on mlm_members_detail.applicant_no = mlm_puc_detail.distributor_id
 where  Month(datetime)='".$this->data['month']."' and Year(datetime)='".$this->data['year']."' 
  group by branch_id  
");

		$this->data['pucper'] 	= $pucper;
		$this->data['title'] 				= 'pucper List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/pucper';
	
		$this->view('admin/pucper1',$this->data); 
	}
	
	public function toolkitlist()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	//echo "<pre>"; print_r($month); exit;
		$toolkitlist = $this->base_model->run_query("SELECT (mlm_dist_chalan.totalwithtax*20)/100 as amount,proposerno.applicant_name as proposername, proposerno.applicant_no as ProposerNo, proposerno.mobile_no as ProposerMobile,
		mlm_dist_chalan_detail.chalan_id chalan_id,
		mlm_dist_chalan.branch_name branch_name,mlm_dist_chalan.branch_id as ApplicantNo 
	   FROM bvmlive.mlm_dist_chalan_detail  
	   left join mlm_dist_chalan
	   on mlm_dist_chalan.chalan_id = mlm_dist_chalan_detail.chalan_id
	   left join mlm_members_detail
	   on mlm_members_detail.applicant_no = mlm_dist_chalan.branch_id
	   left join mlm_members_detail  proposerno
	   on proposerno.applicant_no = mlm_members_detail.proposer_no
	   where billfromtype=9 and Month(mlm_dist_chalan.datetime) = '".$this->data['month']."' and Year(mlm_dist_chalan.datetime)=2021
        group by mlm_dist_chalan_detail.chalan_id");

		$this->data['toolkitlist'] 	= $toolkitlist;
		$this->data['title'] 				= 'toolkitlist List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/toolkitlist';
	
		$this->view('admin/toolkitlist',$this->data); 
	}


	public function toolkitlist10()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	//echo "<pre>"; print_r($month); exit;
		$toolkitlist = $this->base_model->run_query("SELECT (mlm_dist_chalan.totaldp*10)/100 as amount,proposerno.applicant_name as proposername, proposerno.applicant_no as ProposerNo, proposerno.mobile_no as ProposerMobile,
		mlm_dist_chalan_detail.chalan_id chalan_id,
		mlm_dist_chalan.branch_name branch_name,mlm_dist_chalan.branch_id as ApplicantNo 
	   FROM bvmlive.mlm_dist_chalan_detail  
	   left join mlm_dist_chalan
	   on mlm_dist_chalan.chalan_id = mlm_dist_chalan_detail.chalan_id
	   left join mlm_members_detail
	   on mlm_members_detail.applicant_no = mlm_dist_chalan.branch_id
	   left join mlm_members_detail  proposerno
	   on proposerno.applicant_no = mlm_members_detail.proposer_no
	   where billfromtype!=9 and Month(mlm_dist_chalan.datetime) = '".$this->data['month']."' and Year(mlm_dist_chalan.datetime)=2021
        group by mlm_dist_chalan_detail.chalan_id");

		$this->data['toolkitlist'] 	= $toolkitlist;
		$this->data['title'] 				= 'toolkitlist List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/toolkitlist10';
	
		$this->view('admin/toolkitlist10',$this->data); 
	}
	public function toolkitlist1()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	//echo "<pre>"; print_r($month); exit;
		$toolkitlist = $this->base_model->run_query(
		"SELECT mlm_dist_chalan.total,proposerno.applicant_name as proposername, proposerno.applicant_no as ProposerNo, proposerno.mobile_no as ProposerMobile,proposerno1.applicant_name prop1, proposerno1.applicant_no propno1,
proposerno2.applicant_name prop2, proposerno2.applicant_no propno2,
proposerno3.applicant_name prop3, proposerno3.applicant_no propno3,
proposerno4.applicant_name prop4, proposerno4.applicant_no propno4,
proposerno5.applicant_name prop5, proposerno5.applicant_no propno5,
mlm_dist_chalan.branch_name branch_name,mlm_dist_chalan.branch_id as ApplicantNo
FROM bvmlive.mlm_dist_chalan 
left join mlm_members_detail
on mlm_members_detail.applicant_no = mlm_dist_chalan.branch_id 
left join mlm_members_detail proposerno 
on proposerno.applicant_no = mlm_members_detail.proposer_no 
left join mlm_members_detail proposerno1
on proposerno1.applicant_no = proposerno.proposer_no
left join mlm_members_detail proposerno2
on proposerno2.applicant_no = proposerno1.proposer_no
left join mlm_members_detail proposerno3
on proposerno3.applicant_no = proposerno2.proposer_no
left join mlm_members_detail proposerno4
on proposerno4.applicant_no = proposerno3.proposer_no
left join mlm_members_detail proposerno5
on proposerno5.applicant_no = proposerno4.proposer_no
where mlm_dist_chalan.chalantype='6'");

		$this->data['toolkitlist'] 	= $toolkitlist;
		$this->data['title'] 				= 'toolkitlist List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/toolkitlist';
	
		$this->view('admin/toolkitlist1',$this->data); 
	}


public function adminotplist()
	{
		
	
		$adminotplist = $this->base_model->run_query(
		"SELECT * FROM `mlm_dist_chalan` WHERE chalantype=5");

		$this->data['adminotplist'] 	= $adminotplist;
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/adminotplist';
	
		$this->view('admin/adminotplist',$this->data); 
	}
	
	
	public function complainlist()
	{
		
		
				
		$comp_list = $this->base_model->run_query("select * from complain where rec_id='".$this->session->userdata('applicant_no')."' or by_id ='".$this->session->userdata('applicant_no')."'");
		$this->data['comp_list'] 	= $comp_list;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addlevel';
		
		$this->view('admin/complainlist',$this->data); 
	}

	public function addcomplaint()
	{
		
		$msg= "";
	
		if(isset($_POST['subject'])){
			$insert['comp_subject'] = $_POST['subject'];
				$insert['comp_desc'] = $_POST['desc'];
				$insert['sender_id'] = $_POST['branch_id'];
				$insert['rec_id'] = $_POST['branch_id1'];
				$insert['by_id'] = $this->session->userdata('applicant_no'); 
				$insert['rec_id'] = $_POST['branch_id1'];
				$insert['date'] = date('Y-m-d H:i:s');
				
			
			$this->db->insert('complain',$insert);
				$msg ="Saved Successfully";
		$this->session->set_flashdata('success1',$msg);
			}
	
			$complain = "";
		$this->data['complain'] 	= $complain;
		$this->data['title'] 				= 'Add Level';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/addlevel';
		$msg ="Saved Successfully";
		
		$this->view('admin/add-complaint',$this->data); 
	}

	
	
	function report_save(){

		if(isset($_POST['ApplicantNo']) && is_array($_POST['ApplicantNo'])){

			foreach($_POST['ApplicantNo'] as $key => $ApplicantNo){

				$this->db->where('month',  $_POST['month']);
				$this->db->where('year', $_POST['year']);
				$this->db->where('sponsor_id', $ApplicantNo);

				$query = $this->db->get('report_process'); 
				$report = $query->result();
				
				if(count($report)>0){
					$amnt=  $report[0]->{$_POST['report_filter']};
				
					$this->db->set($_POST['report_filter'], $_POST['amount'][$key]+$amnt);
					$this->db->where('month', $_POST['month']);
					$this->db->where('year',  $_POST['year']);
					$this->db->where('sponsor_id', $ApplicantNo);
					$this->db->update('report_process');
				}else{
					$data = array(
						'sponsor_id' => $ApplicantNo,
						'month' => $_POST['month'],
						'year' => $_POST['year'],
						$_POST['report_filter'] => $_POST['amount'][$key]
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

		
	
	
	public function otplist()
	{
		
		$otplist = $this->base_model->run_query(
		"SELECT * from mlm_ticket_chalan");
		
		$this->data['otplist'] 	= $otplist;
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/otplist';
		$this->view('admin/otplist',$this->data); 
	}

	public function releasesbv(){
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
		$sql = "SELECT *, mb.sbv as total FROM `mlm_bonus` mb
		left join mlm_members_detail
			 on mb.applicant_no = mlm_members_detail.applicant_no
		where mb.sbv > 0 AND month(mb.date) = ".$month." AND year(mb.date) = ".$year; 
		
		$releasesbv = $this->base_model->run_query($sql);
		$this->data['releasesbv'] 	= $releasesbv;

		$this->data['title'] 				= 'Releases BV';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/releasesbv';
		$this->view('admin/releasesbv',$this->data);
	}
	
	public function releasestb(){
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
		$sql = "SELECT *, mb.tour_bonus as total FROM `mlm_bonus` mb
		left join mlm_members_detail
			 on mb.applicant_no = mlm_members_detail.applicant_no
		where mb.tour_bonus > 0 AND month(mb.date) = ".$month." AND year(mb.date) = ".$year; 
		
		$releasesbv = $this->base_model->run_query($sql);
		$this->data['releasesbv'] 	= $releasesbv;

		$this->data['title'] 				= 'Releases BV';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/releasesbv';
		$this->view('admin/releasesbv',$this->data);
	}
	
	public function releasescb(){
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
		$sql = "SELECT *, mb.stop_car_bonus as total FROM `mlm_bonus` mb
		left join mlm_members_detail
			 on mb.applicant_no = mlm_members_detail.applicant_no
		where mb.stop_car_bonus > 0 AND month(mb.date) = ".$month." AND year(mb.date) = ".$year; 
		
		$releasesbv = $this->base_model->run_query($sql);
		$this->data['releasesbv'] 	= $releasesbv;

		$this->data['title'] 				= 'Releases BV';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/releasesbv';
		$this->view('admin/releasesbv',$this->data);
	}
	
	public function releaseshb(){
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
		$sql = "SELECT *, mb.home_bonus as total FROM `mlm_bonus` mb
		left join mlm_members_detail
			 on mb.applicant_no = mlm_members_detail.applicant_no
		where mb.home_bonus > 0 AND month(mb.date) = ".$month." AND year(mb.date) = ".$year; 
		
		$releasesbv = $this->base_model->run_query($sql);
		$this->data['releasesbv'] 	= $releasesbv;

		$this->data['title'] 				= 'Releases BV';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/releasesbv';
		$this->view('admin/releasesbv',$this->data);
	}
	
	public function process_releasesbv(){
		foreach($_POST['applicant_name'] as $key => $value){ 
			$applicant_no = $_POST['applicant_no'][$key]; 
			$mobile_no = $_POST['mobile_no'][$key]; 
			$total = $_POST['total'][$key]; 
			$narration = $_POST['narration'][$key]; 
		}
		
		$data = array(
				'applicant_no' => $applicant_no,
				'total' => $total,
				'narration' => $narration,
				'date' => date('Y-m-d')
		);

		if ( ! $this->db->insert('mlm_bonus', $data))
		{
				$error = $this->db->error(); // Has keys 'code' and 'message'
				print_r($error);
		}
	}
	
	public function bounuslist()
	{
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
	
		$bounuslist = $this->base_model->run_query(
		"SELECT current_month_bv-current_month_bv_a-current_month_bv_b-current_month_bv_c-current_month_bv_d as bv,mobile_no,panno,mlm_bank_detail.bank_name as bank_name, bank_accno,bank_ifsc_code,sponsor_id,none,other_bonus,leader_bonus,report_process.stop_car_bonus,branch_commission,report_process.tour_bonus,report_process.car_bonus,report_process.home_bonus,leader_commission,puc_commision,royalty_bonus, mobile_bonus as bounus ,running_bonus,proposer_income,mlm_members_detail.applicant_name FROM report_process
		left join mlm_members_detail
		on mlm_members_detail.applicant_no = report_process.sponsor_id 
		left join mlm_bank_detail
         on mlm_bank_detail.bank_id = mlm_members_detail.bank_name
         left join member_bv
         on member_bv.applicant_no = mlm_members_detail.applicant_no
		  left join mlm_members_login
         on mlm_members_login.applicant_no = mlm_members_detail.applicant_no
		 WHERE  mlm_members_login.status ='inActive' 
		 and  report_process.month= '".$this->data['month']."'
		  and report_process.year= '".$this->data['year']."'
		   and member_bv.month= '".$this->data['month']."'
		    and member_bv.year= '".$this->data['year']."' order by royalty_bonus desc ");
		// $query1 = $this->base_model->run_query("SELECT current_month_bv-current_month_bv_a-current_month_bv_b-current_month_bv_c-current_month_bv_d as bv FROM member_bv 
		// WHERE month= '".$this->data['month']."' and year= '".$this->data['year']."'"); 

		$this->data['bounuslist'] 	= $bounuslist;

		
		
		foreach($bounuslist as $bounuslist){
			//$this->data['bounuslist'][]->closingbalance = $this->closingbalance($bounuslist->applicant_no);
			$this->data['closing'][$bounuslist->sponsor_id] = $this->closingbalance($bounuslist->sponsor_id);
		}
	
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/bonuslist';
		$this->view('admin/bonuslist',$this->data); 
	}

	public function bounuslist1()
	{
		
	
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
	
		
		$bounuslist = $this->base_model->run_query(
			"SELECT current_month_bv-current_month_bv_a-current_month_bv_b-current_month_bv_c-current_month_bv_d as bv,mobile_no,panno,mlm_bank_detail.bank_name as bank_name, bank_accno,bank_ifsc_code,sponsor_id,none,other_bonus,leader_bonus,report_process.stop_car_bonus,branch_commission,report_process.tour_bonus,report_process.car_bonus,report_process.home_bonus,leader_commission,puc_commision,royalty_bonus, mobile_bonus as bounus ,running_bonus,proposer_income,mlm_members_detail.applicant_name FROM report_process
			left join mlm_members_detail
			on mlm_members_detail.applicant_no = report_process.sponsor_id 
			left join mlm_bank_detail
			 on mlm_bank_detail.bank_id = mlm_members_detail.bank_name
			 left join member_bv
			 on member_bv.applicant_no = mlm_members_detail.applicant_no
			  left join mlm_members_login
			 on mlm_members_login.applicant_no = mlm_members_detail.applicant_no
			 WHERE  mlm_members_login.status ='inActive' 
			 and  report_process.month= '".$this->data['month']."'
			  and report_process.year= '".$this->data['year']."'
			   and member_bv.month= '".$this->data['month']."'
				and member_bv.year= '".$this->data['year']."' order by royalty_bonus desc ");
			// $query1 = $this->base_model->run_query("SELECT current_month_bv-current_month_bv_a-current_month_bv_b-current_month_bv_c-current_month_bv_d as bv FROM member_bv 
			// WHERE month= '".$this->data['month']."' and year= '".$this->data['year']."'"); 
		$this->data['bounuslist'] 	= $bounuslist;

		
		
		foreach($bounuslist as $bounuslist){
			//$this->data['bounuslist'][]->closingbalance = $this->closingbalance($bounuslist->applicant_no);
			$this->data['closing'][$bounuslist->sponsor_id] = $this->closingbalance($bounuslist->sponsor_id);
		}
	
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/bonuslist';
		$this->view('admin/bonuslist1',$this->data); 
	}

	public function process_bonus(){ 
		if(isset($_POST['applicant_no']) && is_array($_POST['applicant_no'])){
			foreach($_POST['applicant_no'] as $key => $applicant_no){
				$month 		= $_POST['month'];
				$year 		= $_POST['year'];
				$total 		= $_POST['total'][$key];
				$home_bonus = $_POST['home_bonus'][$key];
				$tour_bonus = $_POST['tour_bonus'][$key];
				$stop_car_bonus = $_POST['stop_car_bonus'][$key];
				$sbv 		= $_POST['sbv'][$key];
				$Balance 	= $_POST['Balance'][$key];
				$PreviousBalance 	= $_POST['PreviousBalance'][$key];
				
				$result1 = $this->db->query("SELECT * FROM `mlm_bonus` WHERE applicant_no = '".$applicant_no."' and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."'");
				$curbv1=$result1->result_array();
				if(empty($curbv1)){
					//insert
					$data = array(
						'applicant_no' => $applicant_no,
						'date' => date('Y-m-d'),
						'total' => $Balance,
						'home_bonus' => $home_bonus,
						'tour_bonus' => $tour_bonus,
						'stop_car_bonus' => $stop_car_bonus,
						'sbv' => $sbv,
						'Balance' => $Balance,
						'PreviousBalance' => $PreviousBalance
					);

					$this->db->insert('mlm_bonus', $data);
				}else{
					//update
					$this->db->where('bonus_id', $curbv1[0]['bonus_id']); 
					$data = array(
						'applicant_no' => $applicant_no,
						'date' => date('Y-m-d'),
						'total' => $Balance,
						'home_bonus' => $home_bonus,
						'tour_bonus' => $tour_bonus,
						'stop_car_bonus' => $stop_car_bonus,
						'sbv' => $sbv,
						'Balance' => $Balance,
						'PreviousBalance' => $PreviousBalance
					);

					$this->db->insert('mlm_bonus', $data);
				}
			}
		}
	}
	
	public function send_bonus_sms(){
	
		if(isset($_POST['mobile_no']) && is_array($_POST['mobile_no'])){
			$monthNum = $_POST['month'];
			$monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
			foreach($_POST['mobile_no'] as $key => $phone){
				
				$applicant_name = $_POST['applicant_name'][$key];
				$total = $_POST['total'][$key];
				
				$user='Assurdnessbusinesstxn';
				$pass='472722';
				$senderid='ASSURD';    
				
				$msg= "Welcome+".urlencode($applicant_name)."+Your+".$monthName."+Month+Commisssion+is+:".urlencode($total)."+Thanks+!+Assurdness+marketing+pvt+Ltd.";
				$link= "https://www.mysmsapp.in/api/push.json?apikey=5d2d60cfe3d45&sender=".$senderid."&mobileno=".$phone."&text=".$msg; 
				
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $link,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				));
				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
			}
		}
	}
	
	public function send_simple_sms($phone, $msg){
		$user='bvmbusinesstxn';
		$pass='472722';
		$senderid='BVMBUS';    
		
		$msg= urlencode($msg);
		$link= "http://anysms.in/api.php?username=".$user."&password=".$pass."&sender=".$senderid."&sendto=".$phone."&message=".$msg;  

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $link,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	}

	public function dplist()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	//echo "<pre>"; print_r($month); exit;
		$dplist = $this->base_model->run_query(
		"SELECT  applicant_no,name,sum(dp) as dp,sum(bv) as bv from (
			SELECT old_bv_dp.applicant_no applicant_no,mlm_members_detail.applicant_name as name, sum(dp) as dp, sum(bv) as bv from old_bv_dp 
			left join mlm_members_detail on mlm_members_detail.applicant_no = old_bv_dp.applicant_no 
			where MONTH(date) = '".$this->data['month']."' AND YEAR(date)= '".$this->data['year']."' GROUP BY applicant_no
			UNION ALL SELECT branch_id as applicant_no , branch_name as name, sum(totaldp) as dp, sum(totalbv) as bv from mlm_dist_chalan
			where MONTH(datetime) = '".$this->data['month']."' AND YEAR(datetime)='".$this->data['year']."' GROUP BY branch_id) as b   GROUP BY applicant_no
			");
		
		

		//Data For Active Users
	

		$this->data['dplist'] 	= $dplist;
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/dplist';
	
		$this->view('admin/dplist',$this->data); 
	}

	
	public function pucmonthstock()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
		$puc = $_POST['puc'];
	}else{
		$month = date('m');
		$year = date('Y');
		$puc ='';
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	$this->data['puc'] = $puc;
	//echo "<pre>"; print_r($month); exit;
		$pucstock = $this->base_model->run_query(
		"SELECT product_name,sum(quantity) as qty
		FROM mlm_dist_chalan 
		join mlm_dist_chalan_detail on mlm_dist_chalan.chalan_id = mlm_dist_chalan_detail.chalan_id 
		left join mlm_members_login
        on mlm_dist_chalan.createby = mlm_members_login.member_id
        where   mlm_members_login.applicant_no = '".$puc."'
		and month(datetime) = '".$this->data['month']."' AND year(datetime)='".$this->data['year']."' GROUP by product_name");
		$this->data['pucstock'] 	= $pucstock;
		$this->data['title'] 				= 'pucstock';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/pucstock';
	
		$this->view('admin/pucstock',$this->data); 
	}

	public function branchpucmonthstock()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
		$puc = $_POST['puc'];
	}else{
		$month = date('m');
		$year = date('Y');
		$puc ='';
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
	$this->data['puc'] = $puc;
	//echo "<pre>"; print_r($month); exit;
		$pucstock = $this->base_model->run_query(
		"SELECT product_name,sum(quantity) as qty FROM mlm_puc_chalan join mlm_puc_chalan_detail on mlm_puc_chalan.chalan_id = mlm_puc_chalan_detail.chalan_id 
		left join mlm_members_login
		on mlm_puc_chalan.createby = mlm_members_login.member_id
        where   mlm_members_login.applicant_no = '".$puc."'
		and month(datetime) = '".$this->data['month']."' AND year(datetime)='".$this->data['year']."' GROUP by product_name");
		$this->data['pucstock'] 	= $pucstock;
		$this->data['title'] 				= 'pucstock';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/pucstock';
	
		$this->view('admin/pucstock',$this->data); 
	}
	
	public function ledercomission()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
		$ledercomission = $this->base_model->run_query(
			"select (bv*bvmpuc_leadercommision)/100 total,applicant_name,mobile_no, bvmpuc_distributor,bvmpuc_leadercommision, BranchId,BranchName,bv,dp from(
				select  mlm_branch_detail.bvmpuc_distributor,  mlm_branch_detail.bvmpuc_leadercommision,
				mlm_members_detail.applicant_name,mlm_members_detail.mobile_no, mlm_members_login.applicant_no BranchId, mlm_branch_detail.bvmbranchname BranchName ,
				sum(totalbv) bv,sum(totaldp)  dp
				 from mlm_dist_chalan
				left join mlm_members_login
				on mlm_dist_chalan.createby = mlm_members_login.member_id
				left join mlm_branch_detail
				on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
				left join mlm_members_detail
				on mlm_members_detail.applicant_no = mlm_branch_detail.bvmpuc_distributor
				 where month(mlm_dist_chalan.datetime)= '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."'
				group by BranchName having BranchName  is not null
				union all
				select  mlm_puc_detail.bvmpuc_distributor,mlm_puc_detail.bvmpuc_leadercommision,
				mlm_members_detail.applicant_name,mlm_members_detail.mobile_no, mlm_members_login.applicant_no PucId, mlm_puc_detail.bvmbranchname PucName ,
				sum(totalbv) bv,sum(totaldp)  dp
				 from mlm_dist_chalan
				left join mlm_members_login
				on mlm_dist_chalan.createby = mlm_members_login.member_id
				left join mlm_puc_detail
				on mlm_puc_detail.applicant_no = mlm_members_login.applicant_no
				left join mlm_members_detail
				on mlm_members_detail.applicant_no = mlm_puc_detail.bvmpuc_distributor
				 where month(mlm_dist_chalan.datetime)=  '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."'
				group by PucName having PucName  is not null)v1");
		
		

		//Data For Active Users
	

		$this->data['ledercomission'] 	= $ledercomission;
		$this->data['title'] 				= 'leder comission List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/ledercomission';
	
		$this->view('admin/ledercomission',$this->data); 
	}


	public function ledercomission1()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
		$ledercomission = $this->base_model->run_query(
			"select (bv*bvmpuc_leadercommision)/100 total,applicant_name,phone_no, bvmpuc_distributor,bvmpuc_leadercommision, BranchId,BranchName,bv,dp from(
				select  mlm_branch_detail.bvmpuc_distributor,  mlm_branch_detail.bvmpuc_leadercommision,
				mlm_members_detail.applicant_name,mlm_members_detail.phone_no, mlm_members_login.applicant_no BranchId, mlm_branch_detail.bvmbranchname BranchName ,
				sum(totalbv) bv,sum(totaldp)  dp
				 from mlm_dist_chalan
				left join mlm_members_login
				on mlm_dist_chalan.createby = mlm_members_login.member_id
				left join mlm_branch_detail
				on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
				left join mlm_members_detail
				on mlm_members_detail.applicant_no = mlm_branch_detail.bvmpuc_distributor
				 where month(mlm_dist_chalan.datetime)= '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."'
				group by BranchName having BranchName  is not null
				union all
				select  mlm_puc_detail.bvmpuc_distributor,mlm_puc_detail.bvmpuc_leadercommision,
				mlm_members_detail.applicant_name,mlm_members_detail.phone_no, mlm_members_login.applicant_no PucId, mlm_puc_detail.bvmbranchname PucName ,
				sum(totalbv) bv,sum(totaldp)  dp
				 from mlm_dist_chalan
				left join mlm_members_login
				on mlm_dist_chalan.createby = mlm_members_login.member_id
				left join mlm_puc_detail
				on mlm_puc_detail.applicant_no = mlm_members_login.applicant_no
				left join mlm_members_detail
				on mlm_members_detail.applicant_no = mlm_puc_detail.bvmpuc_distributor
				 where month(mlm_dist_chalan.datetime)=  '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."'
				group by PucName having PucName  is not null)v1");
	
		

		//Data For Active Users
	

		$this->data['ledercomission'] 	= $ledercomission;
		$this->data['title'] 				= 'leder comission List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/ledercomission';
	
		$this->view('admin/ledercomission1',$this->data); 
	}

	public function puccommission(){

		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = date('m');
			$year = date('Y');
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
			$branchcomm = $this->base_model->run_query("select  mlm_puc_detail.commisionondistributor, sum(totaldp) distributordp,
			sum(totalbv) distributorbv,(sum(totaldp)*mlm_puc_detail.commisionondistributor)/100 TotalAmount,mlm_puc_detail.commisionondistributor percentageValue, mlm_puc_detail.distributor_id,mlm_members_detail.applicant_name, 
			mlm_members_login.applicant_no BranchId, mlm_puc_detail.bvmbranchname BranchName
		from mlm_dist_chalan
	   left join mlm_members_login
	   on mlm_dist_chalan.createby = mlm_members_login.member_id
	   left join mlm_puc_detail
	   on mlm_puc_detail.applicant_no = mlm_members_login.applicant_no
	   left join mlm_members_detail	
	   on mlm_members_detail.applicant_no = mlm_puc_detail.distributor_id
	   where month(mlm_dist_chalan.datetime) = '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."' and mlm_members_login.date>='2019-04-01'
	   group by BranchName having BranchName  is not null");

	   $this->data['branchcomm'] 	= $branchcomm;
	   $this->data['title'] 				= 'branch comm List';		
	   $this->data['active_menu'] 			= 'admin';
	   $this->data['content'] 				= 'admin/branchcomm';
   
	   $this->view('admin/puccomm',$this->data);

	}


	public function branchcomission1()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
		$branchcomm = $this->base_model->run_query(
		"select commisiononpuc,commisionondistributor, (commisiononpuc*sum(dp))/100 totalpuc, (commisionondistributor*sum(dp1))/100 totaldistributor, distributor_id,applicant_name,BranchId,BranchName,sum( bv) Pucbv,sum(dp) Pucdp,sum(bv1) Distributorbv,sum(dp1) Distributordp from (
select mlm_branch_detail.commisiononpuc,mlm_branch_detail.commisionondistributor, mlm_branch_detail.distributor_id ,mlm_members_detail.applicant_name, mlm_members_login.applicant_no BranchId, mlm_branch_detail.bvmbranchname BranchName,totalbv bv,totaldp  dp,0 bv1,0 dp1
 from mlm_puc_chalan
left join mlm_members_login
on mlm_puc_chalan.createby = mlm_members_login.member_id
left join mlm_branch_detail
on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
left join mlm_members_detail
on mlm_members_detail.applicant_no = mlm_branch_detail.distributor_id
 where month(mlm_puc_chalan.datetime)=  '".$this->data['month']."' AND YEAR(mlm_puc_chalan.datetime)='".$this->data['year']."'
union all 
select  mlm_branch_detail.commisiononpuc,mlm_branch_detail.commisionondistributor, mlm_branch_detail.distributor_id,mlm_members_detail.applicant_name, mlm_members_login.applicant_no BranchId, mlm_branch_detail.bvmbranchname BranchName ,0 ,0,totalbv bv,totaldp  dp
 from mlm_dist_chalan
left join mlm_members_login
on mlm_dist_chalan.createby = mlm_members_login.member_id
left join mlm_branch_detail
on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
left join mlm_members_detail
on mlm_members_detail.applicant_no = mlm_branch_detail.distributor_id
 where month(mlm_dist_chalan.datetime)= '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."'
)v1
group by BranchName having BranchName  is not null");
		
		

		//Data For Active Users
	

		$this->data['branchcomm'] 	= $branchcomm;
		$this->data['title'] 				= 'branch comm List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/branchcomm';
	
		$this->view('admin/branchcomm1',$this->data); 
	}
	
	public function branchcomission()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
		$month = $_POST['month'];
		$year = $_POST['year'];
	}else{
		$month = date('m');
		$year = date('Y');
	}

	$this->data['month'] = $month;
	$this->data['year'] = $year;
		$branchcomm = $this->base_model->run_query(
		"select commisiononpuc,commisionondistributor, (commisiononpuc*sum(dp))/100 totalpuc, (commisionondistributor*sum(dp1))/100 totaldistributor, distributor_id,applicant_name,BranchId,BranchName,sum( bv) Pucbv,sum(dp) Pucdp,sum(bv1) Distributorbv,sum(dp1) Distributordp from (
select mlm_branch_detail.commisiononpuc,mlm_branch_detail.commisionondistributor, mlm_branch_detail.distributor_id ,mlm_members_detail.applicant_name, mlm_members_login.applicant_no BranchId, mlm_branch_detail.bvmbranchname BranchName,totalbv bv,totaldp  dp,0 bv1,0 dp1
 from mlm_puc_chalan
left join mlm_members_login
on mlm_puc_chalan.createby = mlm_members_login.member_id
left join mlm_branch_detail
on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
left join mlm_members_detail
on mlm_members_detail.applicant_no = mlm_branch_detail.distributor_id
 where month(mlm_puc_chalan.datetime)=  '".$this->data['month']."' AND YEAR(mlm_puc_chalan.datetime)='".$this->data['year']."'
union all 
select  mlm_branch_detail.commisiononpuc,mlm_branch_detail.commisionondistributor, mlm_branch_detail.distributor_id,mlm_members_detail.applicant_name, mlm_members_login.applicant_no BranchId, mlm_branch_detail.bvmbranchname BranchName ,0 ,0,totalbv bv,totaldp  dp
 from mlm_dist_chalan
left join mlm_members_login
on mlm_dist_chalan.createby = mlm_members_login.member_id
left join mlm_branch_detail
on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
left join mlm_members_detail
on mlm_members_detail.applicant_no = mlm_branch_detail.distributor_id
 where month(mlm_dist_chalan.datetime)= '".$this->data['month']."' AND YEAR(mlm_dist_chalan.datetime)='".$this->data['year']."'
)v1
group by BranchName having BranchName  is not null");
		
		

		//Data For Active Users
	

		$this->data['branchcomm'] 	= $branchcomm;
		$this->data['title'] 				= 'branch comm List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/branchcomm';
	
		$this->view('admin/branchcomm',$this->data); 
	}

	function list___P()
	{
		$alluser = $this->base_model->run_query(
							"SELECT *,(CASE WHEN transtype = 1 THEN 'Payment'
WHEN transtype = 2 THEN 'General'
WHEN transtype = 3 THEN 'Contra'
WHEN transtype = 4 THEN 'Receive'
ELSE ''
END)Type FROM mlm_transaction where byid in(7,8460)");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/list';
		$this->view('admin/list',$this->data); 
	}
	
  public function monthlist()
	{
		
		if(isset($_POST['fmonth']) && isset($_POST['fyear']) && isset($_POST['lyear']) && isset($_POST['lmonth'])){
		$fmonth = $_POST['fmonth'];
		$fyear = $_POST['fyear'];
		$lmonth = $_POST['lmonth'];
		$lyear = $_POST['lyear'];
	}else{
		$fmonth = date('m');
		$fyear = date('Y');
		$lmonth = date('m');
		$lyear = date('Y');
	}





	$this->data['fmonth'] = $fmonth;
	$this->data['fyear'] = $fyear;
	$this->data['lmonth'] = $lmonth;
	$this->data['lyear'] = $lyear;
	$fdate = $fyear.'-'.$fmonth.'-'.'01';
	$ldate = $lyear.'-'.$lmonth.'-'.'31';
//echo "<pre>"; print_r($fdate); exit;

		$monthdplist = $this->base_model->run_query(
		"select applicant_no, applicant_name,  
		SUM(case when  Month=1 then  TotalValue  else 0  end) as 'Jan',
		SUM(case when  Month=2 then  TotalValue  else 0  end) as 'Feb',
		SUM(case when  Month=3 then  TotalValue  else 0  end) as 'Mar',
		SUM(case when  Month=4 then  TotalValue  else 0  end) as 'Apr',
		SUM(case when  Month=5 then  TotalValue  else 0  end) as 'May',
		SUM(case when  Month=6 then  TotalValue  else 0  end) as 'June',
		SUM(case when  Month=7 then  TotalValue  else 0  end) as 'July',
		SUM(case when  Month=8 then  TotalValue  else 0  end) as 'Aug',
		SUM(case when  Month=9 then  TotalValue  else 0  end) as 'Sep',
		SUM(case when  Month=10 then  TotalValue  else 0  end) as 'Oct',
		SUM(case when  Month=11 then  TotalValue  else 0  end) as 'Nov',
		SUM(case when  Month=12 then  TotalValue  else 0  end) as 'Dec'
		
		
		FROM
			(SELECT 
				old_bv_dp.applicant_no,
					applicant_name,
					MONTH(date) Month,
					SUM(dp) TotalValue
			FROM
				old_bv_dp
			JOIN mlm_members_detail ON mlm_members_detail.applicant_no = old_bv_dp.applicant_no
			WHERE
				date BETWEEN '".$fdate."' AND '".$ldate."'
			GROUP BY old_bv_dp.applicant_no , MONTH(date)
			HAVING old_bv_dp.applicant_no IS NOT NULL 
			UNION SELECT 
				branch_id applicant_no,
					branch_name applicant_name,
					MONTH(datetime) Month,
					SUM(totaldp) TotalValue
			FROM
				mlm_dist_chalan
			WHERE
				datetime BETWEEN '".$fdate."' AND '".$ldate."'
			GROUP BY applicant_no , MONTH(datetime)
			HAVING applicant_no IS NOT NULL) v1
		GROUP BY applicant_no ,applicant_name
		ORDER BY applicant_name ASC , Month DESC;
    ");
		
		/*" select applicant_no,applicant_name,Month,sum(TotalValue) DP from ( 
select old_bv_dp.applicant_no,applicant_name,MONTHNAME(date) Month,sum(dp) TotalValue from old_bv_dp
  join
 mlm_members_detail
 on
 mlm_members_detail.applicant_no=old_bv_dp.applicant_no where date BETWEEN  '".$fdate."' and '".$ldate."'
 group by old_bv_dp.applicant_no,MONTHNAME(date) having old_bv_dp.applicant_no is not null
union 
SELECT branch_id,branch_name,MONTHNAME(datetime) Month,sum(totaldp) TotalValue from mlm_dist_chalan 
where datetime BETWEEN '".$fdate."'  and '".$ldate."'
group by  branch_id,month(datetime)   having branch_id is not null 
)v1 
group by applicant_no,Month
order by applicant_name asc,Month desc");*/

		//Data For Active Users
		//echo "<pre>"; print_r($monthdplist); exit;

		$this->data['monthdplist'] 	= $monthdplist;
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/monthdplist';
	
		$this->view('admin/monthlist',$this->data); 
	}
	
	function retails()
	{
		if($_POST['month']){
			$month = $_POST['month'];
		}else{
			$month = date('m');
		}
		
		if($_POST['year']){
			$year = $_POST['year'];
		}else{
			$year = date('Y');
		}

		$this->data['month'] = $month;
		$this->data['year'] = $year;
		
		//echo "<pre>"; print_r($user_row); exit;
		$query = "SELECT  applicant_no,name,mobile_no,sum(dp) as dp,sum(bv) as bv from (
			SELECT old_bv_dp.applicant_no applicant_no,mlm_members_detail.applicant_name as name, mobile_no, sum(dp) as dp, sum(bv) as bv from old_bv_dp 
			left join mlm_members_detail on mlm_members_detail.applicant_no = old_bv_dp.applicant_no 
			where MONTH(date) = '".$this->data['month']."' AND YEAR(date)='".$this->data['year']."' GROUP BY applicant_no
			UNION ALL SELECT branch_id as applicant_no , branch_name as name,  s_no as mobile_no, sum(totalrp) as dp, sum(totalbv) as bv from mlm_dist_chalan
			where MONTH(datetime) = '".$this->data['month']."' AND YEAR(datetime)='".$this->data['year']."' GROUP BY branch_id) as b GROUP BY applicant_no"; 
			$dplistdata = $this->base_model->run_query($query);
			 $this->data['dp1list'] 	= $dplistdata;	
			 $this->data['dplist'] = $dplistdata;	
            
            if(isset($_POST['dp']) && is_array($_POST['dp'])){   
				
				$this->db->where('next_month', $month);
				$all_user_row = $this->db->get('retail_bouns')->result_array();
				foreach($all_user_row as $all_user){
					$previous_month_user[$all_user['applicant_no']] = 1;
				} 
					   
				foreach($this->data['dp1list'] as $value)
				{
					
					//check if this user exist previously
					$applicant_no = $value->applicant_no;
					$this->db->where('applicant_no', $applicant_no);
					$this->db->where('next_month', $month);
					$user_row = $this->db->get('retail_bouns')->row();
					//100157989
					
					//remove if is in previous month
					if(isset($previous_month_user[$applicant_no])){
						unset($previous_month_user[$applicant_no]);
					}
				
					$this->data['dplist'][] =$value;
					if($user_row->applicant_no){ //user exist 
						if($user_row->target <= $value->dp && $user_row->target>= 1000){ //only if my target is less than equal to this month bv
							if($user_row->chance==3 || $user_row->running_month==3){ //start fresh
								$data = array(
									'applicant_no' => $user_row->applicant_no,
									'current_month' => $month,
									'current_year' => $year,
									'running_month' => 1,
									'chance' => 1,
									'slab' => $_POST['target'][$user_row->applicant_no],
									'target' => $_POST['target'][$user_row->applicant_no], //target for next month
									'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
									'dp' => $value->dp,
									'iscomplete' => '0'
								);
							}else{
								$data = array(
									'applicant_no' => $user_row->applicant_no,
									'current_month' => $month,
									'current_year' => $year,
									'running_month' => $user_row->running_month+1,
									'chance' => 1,
									'slab' => isset($user_row->slab)?$user_row->slab:$_POST['target'][$user_row->applicant_no],
									'target' => isset($user_row->target)?$user_row->target:$_POST['target'][$user_row->applicant_no], //target for next month
									'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
									'dp' => $value->dp,
									'iscomplete' => ($user_row->running_month==2)?'1':'0'
								);
							}
							if($this->db->insert('retail_bouns', $data)){
						
							}else{
								echo "<pre>1";print_r($data);print_r($this->db->error()); exit;
							}
						}else{ //my target, i missed it
							if($user_row->chance==1){ 
								if($value->dp >= 2000){
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => ($user_row->running_month==2)?2:$user_row->running_month+1,
										'chance' => 1,
										'slab' => 2000,
										'target' => 2000, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => '0'
									);
								}else if($value->dp >= 1000){
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => ($user_row->running_month==2)?2:$user_row->running_month+1,
										'chance' => 1,
										'slab' => 1000,
										'target' => 1000, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => '0'
									);
								}else{
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => $user_row->running_month,
										'chance' => 2,
										'slab' => $user_row->target,
										'target' => $user_row->target*3, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => '0'
									);
								}
							}elseif($user_row->chance==2){
								if($value->dp >= 15000){
									if($user_row->slab=='5000'){
										$slab = 2000;
									}else if($user_row->slab=='2000'){
										$slab = 1000;
									}else{
										$slab = 1000;
									}
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => $user_row->running_month+2,
										'chance' => 1,
										'slab' => $slab,
										'target' => $slab, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => '0'
									);
								}else if($value->dp >= 6000){
									if($user_row->slab=='5000'){
										$slab = 2000;
										$running_month = $user_row->running_month+2;
									}else if($user_row->slab=='2000'){
										$running_month = $user_row->running_month+2;
										$slab = 1000;
									}else{
										$running_month = 1;
										$slab = 2000;
										$this->db->where('bouns_id <= ', $user_row->bouns_id);
										$this->db->where('applicant_no', $user_row->applicant_no); 
										if($this->db->delete('retail_bouns')){
											
										}else{
											echo "<pre>";print_r($complete);print_r($this->db->error()); exit;
										}
									}
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => $running_month,
										'chance' => 1,
										'slab' => $slab,
										'target' => $slab, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => '0'
									);
								}else if($value->dp >= 3000){
									if($user_row->slab=='5000'){
										$slab = 1000;
										$running_month = $user_row->running_month+2;
									}else if($user_row->slab=='2000'){
										$running_month = $user_row->running_month+2;
										$slab = 1000;
									}else{
										$running_month = 1;
										$slab = 2000;
										$this->db->where('bouns_id <= ', $user_row->bouns_id);
										$this->db->where('applicant_no', $user_row->applicant_no); 
										if($this->db->delete('retail_bouns')){
											
										}else{
											echo "<pre>";print_r($complete);print_r($this->db->error()); exit;
										}
									}
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => $running_month,
										'chance' => 1,
										'slab' => $slab,
										'target' => $slab, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => '0'
									);
									
								}else{
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => 0,
										'chance' => 3,
										'slab' => 0,
										'target' => 0, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => 0
									);
								}
							}else{
								if(isset($_POST['target'][$user_row->applicant_no])){
									//start fresh
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => 1,
										'chance' => 1,
										'slab' => $_POST['target'][$user_row->applicant_no],
										'target' => $_POST['target'][$user_row->applicant_no], //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => ($user_row->running_month==5)?'1':'0'
									);
								}else{
									$data = array(
										'applicant_no' => $user_row->applicant_no,
										'current_month' => $month,
										'current_year' => $year,
										'running_month' => 0,
										'slab' => 0,
										'chance' => 3,
										'target' => 0, //target for next month
										'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
										'dp' => $value->dp,
										'iscomplete' => 0
									);
								}
							}
							if($this->db->insert('retail_bouns', $data)){
						
							}else{
								echo "<pre>2";print_r($data);print_r($this->db->error()); exit;
							}
						}
						
					}else{ //user don't exist insert him
						if(isset($_POST['target'][$applicant_no])){
							$data = array(
									'applicant_no' => $applicant_no,
									'current_month' => $month,
									'current_year' => $year,
									'running_month' => 1,
									'chance' => 1,
									'slab' => $_POST['target'][$applicant_no],
									'target' => $_POST['target'][$applicant_no], //target for next month
									'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
									'dp' => $value->dp,
									'iscomplete' => '0'
								);
							if($this->db->insert('retail_bouns', $data)){
							
							}else{
								echo "<pre>3";print_r($data);print_r($this->db->error()); exit;
							}
						}
					}
				}
				
				foreach($previous_month_user as $applicant_no => $value){
					$this->db->where('applicant_no', $applicant_no);
					$this->db->where('next_month', $month);
					$user_row = $this->db->get('retail_bouns')->row();
				
					if($user_row->chance==1){ 
						$data = array(
							'applicant_no' => $user_row->applicant_no,
							'current_month' => $month,
							'current_year' => $year,
							'running_month' => ($user_row->running_month==2)?2:$user_row->running_month+1,
							'chance' => 2,
							'slab' => $user_row->target,
							'target' => $user_row->target*3, //target for next month
							'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
							'dp' => ($value->dp)?$value->dp:0,
							'iscomplete' => '0'
						);
					}else{
						$data = array(
							'applicant_no' => $user_row->applicant_no,
							'current_month' => $month,
							'current_year' => $year,
							'running_month' => 0,
							'chance' => 3,
							'slab' => 0,
							'target' => 0, //target for next month
							'next_month' => date("m", strtotime(" +1 month", strtotime($year.'-'.$month.'-01'))),
							'dp' => ($value->dp)?$value->dp:0,
							'iscomplete' => 0
						);
					}
					if($this->db->insert('retail_bouns', $data)){
						
					}else{
						echo "<pre>";print_r($data);print_r($this->db->error()); exit;
					}
				}
			}
			
			$this->db->where('current_year', $year);
			$this->db->where('current_month', $month);
			$exist_row = $this->db->get('retail_bouns')->row();
			if($exist_row){
				$this->data['show_process'] = false;
			}else{
				$this->data['show_process'] = true;
			}
			//echo "<pre>"; print_r($this->data['dplist']);exit;
			$this->view('admin/retaillist',$this->data); 
	}
	
	function retail_pivot(){
		
		/* query for view table
		 * create view retail_bonus_pivot as (
			SELECT `applicant_no`,
			sum(`jan`) as jan,
			sum(`feb`) as feb, 
			sum(`mar`) as mar,
			sum(`apr`) as apr,
			sum(`may`) as may,
			sum(`jun`) as jun,
			sum(`jul`) as jul,
			sum(`aug`) as aug,
			sum(`sep`) as sep,
			sum(`oct`) as oct,
			sum(`nov`) as nov,
			sum(`dec`) as decm
			FROM
			(select `applicant_no`,`current_month`, (case WHEN `current_month` = 1 then `chance` end) as 'jan', (case WHEN `current_month` = 2 then `chance` end) as 'feb', (case WHEN `current_month` = 3 then `chance` end) as 'mar', (case WHEN `current_month` = 4 then `chance` end) as 'apr', (case WHEN `current_month` = 5 then `chance` end) as 'may', (case WHEN `current_month` = 6 then `chance` end) as 'jun', (case WHEN `current_month` = 7 then `chance` end) as 'jul', (case WHEN `current_month` = 8 then `chance` end) as 'aug', (case WHEN `current_month` = 9 then `chance` end) as 'sep', (case WHEN `current_month` = 10 then `chance` end) as 'oct', (case WHEN `current_month` = 11 then `chance` end) as 'nov', (case WHEN `current_month` = 12 then `chance` end) as 'dec' from retail_bouns where iscomplete != 2 group by `applicant_no`,`current_month`) as main
			group by `applicant_no` )
		 */
		if($_POST['month']){
			$month = $_POST['month'];
		}else{
			$month = date('m');
		}
		
		if($_POST['year']){
			$year = $_POST['year'];
		}else{
			$year = date('Y');
		}

		$this->data['month'] = $month;
		$this->data['year'] = $year;
		$this->data['previousMonth'] = array(date("n", strtotime($year.'-'.$month.'-15')));
		
		for ($i = 1; $i < 7; $i++) {
			$this->data['previousMonth'][] = date("n", strtotime("-$i month", strtotime($year.'-'.$month.'-15')));
		}

		$this->data['previousMonth'] = array_reverse($this->data['previousMonth']);
		
		if(isset($_POST['slab'])){ 
			foreach($_POST['slab'] as $key => $value){
				if(!empty($value) && $value != ""){ 
					if($value<2000){
						$otp = "R1".rand(1000, 9999);
					}else if($value<5000){
						$otp = "R2".rand(1000, 9999);
					}else{
						$otp = "R5".rand(1000, 9999);
					}
					$msg = "Your otp for assur bonus is ".$otp;
					
					$phone = $this->getPhone($key);
					$this->send_simple_sms($phone, $msg);
					$data = array(
							'applicant_no' => $key,
							'slab' => $value,
							'month' => $month,
							'year' => $year,
							'otp' => $otp
						);
					if($this->db->insert('retail_pivot_process', $data)){
						foreach($this->data['previousMonth'] as $previousMonth){
							$this->db->update('retail_bouns',array('iscomplete'=>2),array('applicant_no'=>$key,'current_month'=>$previousMonth));
						}
					}else{
						echo "<pre>";print_r($data);print_r($this->db->error()); exit;
					}
				}
			}
		}
		
		$query = "SELECT * FROM retail_bouns
		where current_month = ".$month." AND current_year = ".$year." AND iscomplete != 2"; 
		$dplistcomplete = $this->base_model->run_query($query);
		//$this->data['dplistcomplete'] 	= $dplistcomplete;	
		//echo "<pre>"; print_r($dplistcomplete);exit;
		$query = "SELECT * FROM retail_bonus_pivot  
		left join mlm_members_detail on mlm_members_detail.applicant_no = retail_bonus_pivot.applicant_no "; 
		$dplistdata = $this->base_model->run_query($query);

		$query2 = "SELECT * FROM retail_bonus_target_pivot"; 
		$dplistTargetdataz = $this->base_model->run_query($query2);
		
		foreach($dplistcomplete as $complete){
			if(!empty($complete->slab)){
				$all_applicant_no[] = $complete->applicant_no;
				$iscomplete[$complete->applicant_no] = $complete->iscomplete;
				$all_target[$complete->applicant_no] = $complete->slab;
			}
			if($complete->chance==3){
				
				$this->db->where('bouns_id <= ', $complete->bouns_id);
				$this->db->where('applicant_no', $complete->applicant_no); 
				if($this->db->delete('retail_bouns')){
					
				}else{
					echo "<pre>";print_r($complete);print_r($this->db->error()); exit;
				}
				
			}
		}
		
		foreach($dplistTargetdataz as $dplistTargetdatas){
			$dplistTargetdata[$dplistTargetdatas->applicant_no] = $dplistTargetdatas;
		}
		
		$this->data['pivotlists'] 	= $dplistdata;	
		$this->data['dplistTargetdata'] 	= $dplistTargetdata;	
		$this->data['all_applicant_no'] 	= $all_applicant_no;
		$this->data['all_target'] 	= $all_target;
		$this->data['iscomplete'] 	= $iscomplete;
		
		$this->view('admin/retail_pivot',$this->data); 
	}

	function pivote_report(){
		
		if($_POST['month']){
			$month = $_POST['month'];
		}else{
			$month = date('m');
		}
		
		if($_POST['year']){
			$year = $_POST['year'];
		}else{
			$year = date('Y');
		}

		$this->data['month'] = $month;
		$this->data['year'] = $year;
		
		$query = "SELECT * FROM retail_pivot_process
		join mlm_members_detail
		on mlm_members_detail.applicant_no = retail_pivot_process.applicant_no
		order by year desc, month desc"; 
		$this->data['pivote_report'] = $this->base_model->run_query($query);
		
		$this->view('admin/pivote_report',$this->data); 
	} 
	function allorganization()
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_name,
        g.district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state,
        b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id left join mlm_district_master g on 
		b.district = g.id where a.role='subadmin'");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'Sab Admin List';
		$this->data['active_menu'] 	= 'subadmin';
		$this->data['content'] 		= 'admin/subadmin';
		$this->view('admin/subadminlist',$this->data); 
	}


	
	
	function generatedepo()
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_name,
        g.district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state,
        b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id left join mlm_district_master g on 
		b.district = g.id where a.role='depo'");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'Depo List';
		$this->data['active_menu'] 	= 'user';
		$this->data['content'] 		= 'admin/depo';
		$this->view('admin/depolist',$this->data); 
	}
	
	
	function generatebranch()
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no where a.role='branch'");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'branch List';
		$this->data['active_menu'] 	= 'branch';
		$this->data['content'] 		= 'admin/branch';
		$this->view('admin/branchlist',$this->data); 
	}
	
	function branchlist()
	{
		$alluser = $this->base_model->run_query(
		"select a.applicant_no as applicant_no,member_id ,bvmbranchname,city,mobno,b.password as password from mlm_branch_detail a
left join mlm_members_login b
on  a.applicant_no = b.applicant_no");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'branch List';
		$this->data['active_menu'] 	= 'branch';
		$this->data['content'] 		= 'admin/branch';
		$this->view('admin/subbranchlist',$this->data); 
	}

	function distlist()
	{
		$alluser = $this->base_model->run_query(
		"select a.applicant_no,applicant_name,city,phone_no,b.password as password from mlm_members_detail a left join mlm_members_login b on a.applicant_no = b.applicant_no ORDER BY `a`.`phone_no`");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'branch List';
		$this->data['active_menu'] 	= 'branch';
		$this->data['content'] 		= 'admin/branch';
		$this->view('admin/subdistlist',$this->data); 
	}

	function closinglist()
	{
		$alluser = $this->base_model->run_query(
		"SELECT applicant_no,
		mobile_no,panno,mlm_bank_detail.bank_name as bank_name, bank_accno,bank_ifsc_code,mlm_members_detail.applicant_name FROM 
				 mlm_members_detail
				left join mlm_bank_detail
				 on mlm_bank_detail.bank_id = mlm_members_detail.bank_name ORDER by mlm_members_detail.id desc
				");
		foreach($alluser as $user){
			$this->data['closing'][$user->applicant_no] = $this->closingbalance($user->applicant_no);
			
			}		
		$this->data['alluser'] 	=  $alluser;	
		$this->data['title'] 		= 'branch List';
		$this->data['active_menu'] 	= 'branch';
		$this->data['content'] 		= 'admin/branch';
		$this->view('admin/closinglist',$this->data); 
	}

	function subpuclist()
	{
		$alluser = $this->base_model->run_query(
		"select a.applicant_no as applicant_no ,member_id,bvmbranchname,status,city,mobno,b.password as password from mlm_puc_detail a
left join mlm_members_login b
on  a.applicant_no = b.applicant_no");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'puc List';
		$this->data['active_menu'] 	= 'puc';
		$this->data['content'] 		= 'admin/puc';
		$this->view('admin/subpuclist',$this->data); 
	}

		function subadmin()
	{
		$alluser = $this->base_model->run_query(
		"select  applicant_no ,member_id from  mlm_members_login where role='subadmin'");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'puc List';
		$this->data['active_menu'] 	= 'puc';
		$this->data['content'] 		= 'admin/puc';
		$this->view('admin/subadminlist1',$this->data); 
	}

	
	function generatepuc()
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='puc'");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'puc List';
		$this->data['active_menu'] 	= 'puc';
		$this->data['content'] 		= 'admin/puc';
		$this->view('admin/puclist',$this->data); 
	}

	function generateledger()
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,
		(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,
		(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='ledger'");

		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'ledgerlist List';
		$this->data['active_menu'] 	= 'ledgerlist';
		$this->data['content'] 		= 'admin/ledgerlist';
		$this->view('admin/ledgerlist',$this->data); 
	}
	
	
	
	
   function generatepurchase()
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_name,
        g.district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state,
        b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id left join mlm_district_master g on 
		b.district = g.id where a.role='purchase'");
		$this->data['alluser'] 	=  $alluser;		
		$this->data['title'] 		= 'purchase List';
		$this->data['active_menu'] 	= 'purchase';
		$this->data['content'] 		= 'admin/purchase';
		$this->view('admin/purchaselist',$this->data); 
	}
	
	function groupsearch($id='')
	{
		
	if($this->input->post('spanno')!='' or $id)
	{  
		if($this->uri->segment(3)!='')
		{
		  $id = $this->uri->segment(3);
		 
		  $res = $this->db->query("select mlm_members_detail.proposer_no,city,mobile_no,opening_balance_quantity,location,state, mlm_members_detail.applicant_name, mlm_member_tree.applicant_no as id,applicant_parent_no as parent_id 
		  FROM mlm_member_tree 
		  left join mlm_members_detail
		  on mlm_members_detail.applicant_no = mlm_member_tree.applicant_no WHERE applicant_parent_no = '".$id."'");
		  $this->data['alluser'] 	= $res->result_array();
				  
				 // print_r($this->data['alluser']);exit;
		}else{
			  $res=$this->getallmemberdata1($this->input->post('spanno'),$array='');
			  $this->data['alluser'] 	= $res;  //$res->result_array();
			  //print_r($this->data['alluser']);exit;      
	   }
			   
			   
		foreach($res as $r){ 
			//$this->data['bounuslist'][]->closingbalance = $this->closingbalance($bounuslist->applicant_no);
			$this->data['closing'][$r['id']] = $this->closingbalance($r['id']);
		}
    }               
		
	$this->data['title'] 		= 'User View';
	$this->data['active_menu'] 	= 'View';
	$this->data['content'] 		= 'admin/view';
	$this->view('admin/usergroupsearch',$this->data);	
	}
	
	function rebuild_tree($parent,$left) 
	{   
    // the right value of this node is the left value + 1   
    $right = $left+1;   
   
    // get all children of this node   
    $result = $this->db->query('SELECT applicant_no FROM mlm_member_tree WHERE applicant_parent_no = "'.$parent.'"');   
    foreach($result->result_array() as $row) 
	{   
        // recursive execution of this function for each   
        // child of this node   
        // $right is the current right value, which is   
        // incremented by the rebuild_tree function   
        $right = $this->rebuild_tree($row['applicant_no'], $right);   
    }   
   
    // we've got the left value, and now that we've processed   
    // the children of this node we also know the right value   
    $this->db->query("UPDATE mlm_member_tree SET `left` ='".$left."', `right` = '".$right."' WHERE applicant_no='".$parent."'");   
   
    // return the right value of this node + 1   
    return $right+1;   
    } 

	
	function getuserarraynew($pos_category_id,$mon,$year)
    {
	$totalbv=0;
	$curentbv=0;
    $getleft = $this->db->query("SELECT `left` as l,`right` as r FROM `mlm_member_tree` where applicant_no = '".$pos_category_id."'");
	$lt =$getleft->result_array();
	$pp ="select applicant_no from mlm_member_tree where `left` between '".$lt[0]['l']."' and '".$lt[0]['r']."'";
	
	$result = $this->db->query("SELECT sum(totalbv) as totalbv FROM `mlm_dist_chalan` WHERE branch_id in ($pp)");
	$result1 = $this->db->query("SELECT sum(`bv`) as totalbv1 FROM `old_bv_dp` WHERE applicant_no in ($pp)");
    $curbv1=$result1->result_array();
    $curbv=$result->result_array();
	
	$resultcur = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($pp) and MONTH(`datetime`) = '".$mon."' and YEAR(`datetime`) = '".$year."'");
    $curbvcur=$resultcur->result_array();
	$resultcur11 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($pp) and MONTH(`date`) = '".$mon."' and YEAR(`date`) = '".$year."'");
    $curbvcur1=$resultcur11->result_array();
	$totalbv  =   $curbv[0]['totalbv']+$curbv1[0]['totalbv1'];
    $curentbv =  $curbvcur[0]['monthbv']+$curbvcur1[0]['monthbv1'];
	return $totalbv."###".$curentbv;
    }
	function getpercent($amount)
	{
	$per=0;
	if($amount >=0 and  $amount<=4999)
	{
    $per = 6;
	}
	elseif($amount >=5000 and  $amount<=11999)
	{
    $per = 8;
	}
	elseif($amount >=12000 and  $amount<=19999)
	{
    $per = 10;
	}
	elseif($amount >=20000 and  $amount<=34999)
	{
    $per = 12;
	}
	elseif($amount >=35000 and  $amount<=59999)
	{
    $per = 14;
	}
	elseif($amount >=60000 and  $amount<=109999)
	{
    $per = 16;
	}
	elseif($amount >=110000 and  $amount<=179999)
	{
    $per = 18;
	}
	elseif($amount >=180000)
	{
    $per = 20;
	}
	return $per;
	}
	
	function payoutgen()
	{
	set_time_limit(7200);
	$month = $_POST['month'];
	$year = $_POST['year'];
	$chk = $this->db->query("SELECT id FROM closemonth WHERE month = '".$month."' and year='".$year."'")->result_array();
    if(!$chk[0]['id'])
	{		
    echo '2';
    exit;	
	}
    $parentdata = array('month'=>$month,'year'=>$year);
	$this->db->insert('payout_parent',$parentdata);
	$pay_id = $this->db->insert_id();
	$res = $this->db->query("SELECT A.applicant_no,B.applicant_name,B.mobile_no FROM mlm_members_login A Join mlm_members_detail B on A.applicant_no=B.applicant_no WHERE A.role='Member'");
    $header .= implode("\t", $hedr) . "\r\n";
	$i=0;
	foreach($res->result_array() as $da)
	{
	$datakk12['applicant_no'] = $da['applicant_no'];
	$datakk12['pay_id'] = $pay_id;
	$userquery = $this->db->query("SELECT applicant_no FROM mlm_member_tree WHERE applicant_parent_no = '".$da['applicant_no']."'")->result_array();
    $yourtotal = explode('###',$this->getuserarraynew($da['applicant_no'],$month,$year));
    $datas =array();
	$childtotalall =array();
	$childcurrentall = array();
	$childper = array();
	$childcoms = array();
	$totalchild = array();
	$totalcomsw = array();
	$childtotalall['your'] = $yourtotal[0];
	$childcurrentall['your'] = $yourtotal[1];
	$childper['your'] = $this->getpercent($childtotalall['your']);
	$childcoms['totalcoms'] = $childcurrentall['your']*$childper['your']/100;
   
	$chars = range('A','Z');
	$p=0;
	foreach($userquery as $child)
	{
	$firsttotal = explode('###',$this->getuserarraynew($child['applicant_no'],$month,$year));
	$childtotalall[$chars[$p]] = $firsttotal[0];
	$childcurrentall[$chars[$p]] = $firsttotal[1];
	$childper[$chars[$p]] = $this->getpercent($childtotalall[$chars[$p]]);
	$childcoms[$chars[$p]] = $childcurrentall[$chars[$p]]*$childper[$chars[$p]]/100;
	$totalchild[] = $childcurrentall[$chars[$p]];
	$totalcomsw[] = $childcoms[$chars[$p]];
	$legs = $chars[$p];
    $p++;	
	}
    $datas['childtotalall'] = $childtotalall;
	$datas['childcurrentall'] = $childcurrentall;
	$datas['childper'] = $childper;
	$datas['childcoms'] = $childcoms;

	$datas['spbv'] = $datas['childcurrentall']['your'] - implode('-',$totalchild);
	$datas['Yourcoms'] = $datas['childcoms']['totalcoms'] - implode('-',$totalcomsw);
	$datakk12['alldata'] = json_encode($datas);
	$datakk12['maxleg'] = $legs;
	$this->db->insert('payout',$datakk12);
	$i++;
	} 
	$msg = "Payout Genreted";
    echo '1';
    exit;	
	}
	
	function payout()
	{ 	
	$this->data['title'] 		= 'Payout';
	$this->data['active_menu'] 	= 'View';
	$this->data['content'] 		= 'admin/view';
	$this->view('admin/userpayout',$data='');	
	}
	
	function payoutexcel($month,$year,$payid)
	{
	$chk = $this->db->query("SELECT max(maxleg) as mx FROM payout WHERE pay_id = '".$payid."'")->result_array();
	$chars = range('A',$chk[0]['mx']);
	$hedr1 = array('S. NO','ID No.','NAME','Contact no');
	$total[] = 'Total B.V.';
	$legper[] = 'You %';
	$curlegbv[] = 'You Cur. B.V.';
	$spbv[] = 'S.P. B.V.';
	$comission[] = 'Total comission';
	$lop[] = 'your';
	foreach($chars as $kk)
	{
	$total[] = 'Total '.$kk.' Leg B.V.';
    $legper[] = $kk.' Leg %';
    $curlegbv[] = 'Cur '.$kk.' Leg B.V.';
    $comission[] = $kk.' Leg Commision (-)';
    $lop[] = $kk;	
	}
	$comission[]= 'Your Commision ';
	$hedr = array_merge($hedr1,$total,$legper,$curlegbv,$spbv,$comission);
	$header .= implode("\t", $hedr) . "\r\n";
	$data = $this->db->query("SELECT *,mlm_members_detail.applicant_name,mlm_members_detail.mobile_no FROM payout_parent left join payout on payout_parent.pay_id=payout.pay_id left join mlm_members_detail on payout.applicant_no=mlm_members_detail.applicant_no WHERE payout_parent.pay_id = '".$payid."'")->result_array();
	$i=1;
	foreach($data as $pp)
	{
	$datakk12 = array();
	$datakk12[] = $i;
	$datakk12[] = $pp['applicant_no'];
    $datakk12[] = $pp['applicant_name'];
    $datakk12[] = $pp['mobile_no'];
	$data12 = json_decode($pp['alldata']);
    foreach($lop as $ky)
	{
	$datakk12[] = $data12->childtotalall->$ky;
	}
    foreach($lop as $ky)
	{
	$datakk12[] = $data12->childper->$ky;
	}
    foreach($lop as $ky)
	{
	$datakk12[] = $data12->childcurrentall->$ky;
	}
	$datakk12[] = $data12->spbv;
    foreach($lop as $ky)
	{
	$datakk12[] = $data12->childcoms->$ky;
	}	
	$datakk12[] = $data12->Yourcoms;
	$result .= implode("\t", array_values($datakk12)) . "\r\n";
	$i++;
	}
	$filename = $month.'_'.$year;
	header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$result";
	}

	function grouplegsearch($id='')
	{

	if($this->input->post('spanno')!='' or $id)
	{
		if($this->input->post('spanno'))
		{
		  $id = $this->input->post('spanno');
		} 
                   
      $res = $this->db->query("SELECT mlm_members_detail.proposer_no,city,mobile_no,opening_balance_quantity, mlm_members_detail.applicant_name, mlm_member_tree.applicant_no as id,applicant_parent_no as parent_id 
	  FROM mlm_member_tree 
	  left join mlm_members_detail
	  on mlm_members_detail.applicant_no = mlm_member_tree.applicant_no WHERE applicant_parent_no = '".$id."'");
                  $this->data['alluser'] 	= $res->result_array();	           
        }               
		
	$this->data['title'] 		= 'User View';
	$this->data['active_menu'] 	= 'View';
	$this->data['content'] 		= 'admin/view';
	$this->view('admin/usergrouplegsearch',$this->data);	
	}
	
	public function mygroup($appno='')
	{
	$pp = $this->getallmemberdata($pos_category_id = $appno,'');
	$this->generate_tree_list($pp,$appno);
	$data['tree'] = $this->treeResult;
	$this->view('admin/mygroup',$data);	
	}
	
	public function generate_tree_list($array, $parent = '')
    {
        //
        // Reset the flag each time the function is called
        //
        $has_children = false;
        //
        // Loop through each item of the list array
        //		
        foreach($array as $key => $value)
        {
            //
            // For the first run, get the first item with a parent_id of 0 (= root category)
            // (or whatever id is passed to the function)
            //
            // For every subsequent run, look for items with a parent_id matching the current item's key (id)
            // (eg. get all items with a parent_id of 2)
            //
            // This will return false (stop) when it find no more matching items/children
            //
            // If this array item's parent_id value is the same as that passed to the function
            // eg. [parent_id] => 0   == $parent = 0 (true)
            // eg. [parent_id] => 20  == $parent = 0 (false)
            //
            if($value['parent_id'] == $parent)
            {
                //
                // Only print the wrapper ('<ul>') if this is the first child (otherwise just print the item)
                // Will be false each time the function is called again
                //

                if($has_children === false)
                {
                    //
                    // Switch the flag, start the list wrapper, increase the level count
                    //
                    $has_children = true;

                    $this->treeResult .= "<ul class='parent insRootClose'>";
                }

				$dispaly = 'inline-block';
				if($value['count']==0)
				{
				$dispaly ='none';	
				}
				
                $applicant_name	 = $this->getdataadmin('applicant_name','mlm_members_detail',"applicant_no	=".$value['id']."");

                {$this->treeResult .= '<li><ins style="display:'.$dispaly.'"  onclick="expandNode(this.id);"' . "id='$this->prefix" . $value['id'] . "'" . '>&nbsp;</ins>'.'<img src="'.base_url().'adminimage/default.png" style="width:35px; height:35px;">'.'<a>-[ Name :'.@$applicant_name[0]['applicant_name'].']--[ User Id :'.$value['title'].']</a>';}

                $this->generate_tree_list($array, $key);
                //
                // Close the item
                //
                $this->treeResult .= '</li>';
            }

        }

        //
        // If we opened the wrapper above, close it.
        //
        if ($has_children === true) $this->treeResult .= '</ul>';

    }
	
	function getcounts($id)
	{
	$query = $this->db->query("SELECT applicant_no,applicant_parent_no FROM mlm_member_tree WHERE applicant_parent_no = '".$id."'");
	$num=count($query->result_array());
	return $num;
	}
	
	function getallmemberdata($pos_category_id,$array='')
    {
	
	$query = $this->db->query("SELECT applicant_no,applicant_parent_no FROM mlm_member_tree WHERE applicant_parent_no = '".$pos_category_id."'") or 
    die('Invalid query: ' . mysql_error());
	foreach($query->result_array() as $row)
    {
        //$sub_cat = $return['applicant_no'];
        $array[$row['applicant_no']] = array(
                'id' => $row['applicant_no'],
                'title' => $row['applicant_no'],
				'count'=>$this->getcounts($row['applicant_no']),
                'parent_id' => $row['applicant_parent_no']
            );

        $array = $this->getallmemberdata($row['applicant_no'], $array);
    }
    return $array;
    }
	
	function getallmemberdata1($pos_category_id,$array='')
    {
	
	$query = $this->db->query("select mlm_members_detail.proposer_no,city,mobile_no, mlm_members_detail.applicant_name, mlm_member_tree.applicant_no,applicant_parent_no
	  FROM mlm_member_tree 
	  left join mlm_members_detail
	  on mlm_members_detail.applicant_no = mlm_member_tree.applicant_no WHERE applicant_parent_no = '".$pos_category_id."'") or 
    die('Invalid query: ' . mysql_error());
	foreach($query->result_array() as $row)
    {
        //$sub_cat = $return['applicant_no'];
        $array[$row['applicant_no']] = array(
                'id' => $row['applicant_no'],
				'proposer_no' => $row['proposer_no'],
				'applicant_name' => $row['applicant_name'],
				'city' => $row['city'],
				'mobile_no' => $row['mobile_no'],
                'title' => $row['applicant_no'],
				'count'=>$this->getcounts($row['applicant_no']),
                'parent_id' => $row['applicant_parent_no']
            );
			
			$this->data['closing'][$alluser->applicant_no] = $this->closingbalance($row['applicant_no']);
			
					

        $array = $this->getallmemberdata1($row['applicant_no'], $array);
    }
    return $array;
    }

	
	function generatedistributer($offset=0)
	{
	    $this->data['state'] = $this->getdataadmin('','mlm_city_master',"");
	    $this->data['bank'] = $this->getdataadmin('','mlm_bank_detail',"");
		$cond='';
		if($this->input->post('search')==true)
		{
		$searchdata=array();
		if($this->input->post('state')!='')
		{
        $searchdata[] = "b.district ='".$this->input->post('state')."'";
		}
		if($this->input->post('apno')!='')
		{
        $searchdata[] = "b.applicant_no ='".trim($this->input->post('apno'))."'";
		}
		if($this->input->post('mob')!='')
		{
        $searchdata[] = "b.mobile_no ='".trim($this->input->post('mob'))."'";
		}
        if($this->input->post('bankname')!='')
		{
        $searchdata[] = 'b.bank_name ='."'".$this->input->post('bankname')."'";
		}
        if($this->input->post('panno')!='')
		{
        $searchdata[] = 'b.panno ='."'".trim($this->input->post('panno'))."'";
		}
        $cond =" and ".implode(' and ',$searchdata);
        $this->data['con'] = $cond;		
		}
        
	   
		$limit =  20;
		$results = $this->base_model->getuserlist($limit,$offset,$cond);
		$list  = $results['rows'];
		$this->data['num_results'] = $results['num_rows'];		
		$this->load->library('Pagination');
		$config = array(
		'base_url' => base_url('admin/generatedistributer'),
		'per_page' => $limit,
		'total_rows' => $this->data['num_results'], 
		'full_tag_open' => "<ul class='pagination'>",
		'full_tag_close' => "</ul>",
		'first_tag_open' => "<li>",
		'first_tag_close' => "</li>",
		'last_tag_open' => "<li>",
		'last_tag_close' => "</li>",
		'next_tag_open' => "<li>",
		'next_tag_close' => "</li>",
		'prev_tag_open' => "<li>",
		'prev_tag_close' => "</li>",
		'num_tag_open' => "<li>",
		'num_tag_close' => "</li>",
		'cur_tag_open' => "<li class='active'><a>",
		'cur_tag_close' => "</a></li>",			
		'uri_segment'  =>3
		);
              
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		//$this->data['alluser'] 	= $alluser;
        $this->data['startcount'] = $offset;
		$this->data['alluser'] 	=  $list;

		$this->data['title'] 		= 'User List';
		$this->data['active_menu'] 	= 'user';
		$this->data['content'] 		= 'admin/user';
		$this->view('admin/userlist',$this->data);  
	}
	
	function viewdistributer($offset=0)
	{
	    $this->data['state'] = $this->getdataadmin('','mlm_city_master',"");
	    $this->data['bank'] = $this->getdataadmin('','mlm_bank_detail',"");
		$cond='';
		if($this->input->post('search')==true)
		{
		$searchdata=array();
		if($this->input->post('state')!='')
		{
        $searchdata[] = "b.district ='".$this->input->post('state')."'";
		}
		if($this->input->post('apno')!='')
		{
        $searchdata[] = "b.applicant_no ='".trim($this->input->post('apno'))."'";
		}
		if($this->input->post('mob')!='')
		{
        $searchdata[] = "b.mobile_no ='".trim($this->input->post('mob'))."'";
		}
        if($this->input->post('bankname')!='')
		{
        $searchdata[] = 'b.bank_name ='."'".$this->input->post('bankname')."'";
		}
        if($this->input->post('panno')!='')
		{
        $searchdata[] = 'b.panno ='."'".trim($this->input->post('panno'))."'";
		}
        $cond =" and ".implode(' and ',$searchdata);
        $this->data['con'] = $cond;		
		}
        
	   
		$limit =  20;
		$results = $this->base_model->getuserlist($limit,$offset,$cond);
		$list  = $results['rows'];
		$this->data['num_results'] = $results['num_rows'];		
		$this->load->library('Pagination');
		$config = array(
		'base_url' => base_url('admin/generatedistributer'),
		'per_page' => $limit,
		'total_rows' => $this->data['num_results'], 
		'full_tag_open' => "<ul class='pagination'>",
		'full_tag_close' => "</ul>",
		'first_tag_open' => "<li>",
		'first_tag_close' => "</li>",
		'last_tag_open' => "<li>",
		'last_tag_close' => "</li>",
		'next_tag_open' => "<li>",
		'next_tag_close' => "</li>",
		'prev_tag_open' => "<li>",
		'prev_tag_close' => "</li>",
		'num_tag_open' => "<li>",
		'num_tag_close' => "</li>",
		'cur_tag_open' => "<li class='active'><a>",
		'cur_tag_close' => "</a></li>",			
		'uri_segment'  =>3
		);
              
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		//$this->data['alluser'] 	= $alluser;
        $this->data['startcount'] = $offset;
		$this->data['alluser'] 	=  $list;

		$this->data['title'] 		= 'User List';
		$this->data['active_menu'] 	= 'user';
		$this->data['content'] 		= 'admin/user';
		$this->view('admin/userviewlist',$this->data);  
	}

			
	function usersubview($id='')
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,a.date,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.panno,b.profilepic,b.location,f.state_id,f.state_name,
        g.id as district_id,g.city_name as district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,i.bank_name,b.bank_branch_state as branchstateid,h.state_name as bank_branch_state,
        b.branch_name,b.opening_balance_quantity,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_city_master g on 
		b.district = g.id  left join mlm_bank_detail  i on b.bank_name=i.bank_id where a.member_id='".$id."' and a.role='member'");
		$this->data['userview'] 	=  $alluser;		
		$this->data['title'] 		= 'User View';
		$this->data['active_menu'] 	= 'View';
		$this->data['content'] 		= 'admin/view';
		$this->view('admin/usersubview',$this->data); 
	}
	
	
	function userview($id='')
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,a.date,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.panno,b.profilepic,b.location,f.state_id,f.state_name,
        g.id as district_id,g.city_name as district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,i.bank_name,b.bank_branch_state as branchstateid,h.state_name as bank_branch_state,
        b.branch_name,b.opening_balance_quantity,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_city_master g on 
		b.district = g.id  left join mlm_bank_detail  i on b.bank_name=i.bank_id where a.member_id='".$id."' and a.role='member'");
		
		$this->data['userview'] 	=  $alluser;		
		$this->data['title'] 		= 'User View';
		$this->data['active_menu'] 	= 'View';
		$this->data['content'] 		= 'admin/view';
		$this->view('admin/userview',$this->data); 
	}
	
	function export_alluser($cond='')
	{
		$kk ='';
    if($cond)
	{
    $kk = base64_decode(urldecode($cond)); 
	}
	$alluser = $this->db->query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.date as registration_date,a.status,b.coupon_id,
		b.sponser_no,b.proposer_no,b.applicant_name,b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_name,
        g.district_name,b.tehsil,b.post,b.city,b.panno,b.pincode,b.phone_no,b.mobile_no,b.bank_name,h.state_name as bank_branch_state,
        b.branch_name,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_district_master g on 
		b.district = g.id where a.role='member' $kk")->result_array();	
		$filename = "member.xls"; // File Name
	
        // Download file
        //header("Content-Disposition: attachment; filename=\"$filename\"");
        //header("Content-Type: application/vnd.ms-excel");
        // Write data to file
        $flag = false;
        foreach($alluser as $row) 
	    {
        if (!$flag) {
        // display field/column names as first row
        $header .= implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
        }
         $result .= implode("\t", array_values($row)) . "\r\n";
        }
		header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=member.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$result";
	}
	
	
	function edituser($id='')
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.date,a.email,a.password,a.role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.opening_balance_quantity,b.nomnee_dob,b.nomnee_rel,b.location,f.state_id,f.state_name,
        g.id as district_id,g.city_name as district_name,b.tehsil,b.post,b.checkmob,b.city,b.panno,b.profilepic,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state as branchstateid,h.state_name as bank_branch_state,
        b.branch_name,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_city_master g on 
		b.district = g.id where a.member_id='".$id."' and a.role='member'");
		$this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	    $this->data['bank'] = $this->getdataadmin('','mlm_bank_detail',"");
		$insert=array();
    if($this->input->post('update')==true)
	{
	$msg='';
	///// applicant detail ///////	
	$insert['sponser_no'] = $this->input->post('sponsorno');
	//$insert['proposer_no'] = $this->input->post('sponsorname');
	$insert['proposer_no'] = $this->input->post('proposerno');
	//$insert['insert'] = $this->input->post('proposername');
	$insert['applicant_name'] = $this->input->post('applicantname');
	$insert['father_name'] = $this->input->post('fhname');
	$insert['applicant_dob'] = $this->input->post('applicantdobyear').'-'.$this->input->post('applicantdobmonth').'-'.$this->input->post('applicantdobdate');
	$insert['nomnee_name'] = $this->input->post('nomineename');
	$insert['nomnee_dob'] = $this->input->post('nomineedobyear').'-'.$this->input->post('nomineedobmonth').'-'.$this->input->post('nomineedobdate');
	$insert['nomnee_age'] = $this->input->post('age');
	$insert['nomnee_rel'] = $this->input->post('relation');
	$insert['location'] = $this->input->post('holoc');
	$insert['state'] = $this->input->post('state');
	$insert['post'] = $this->input->post('post');
	$insert['district'] = $this->input->post('district');
	$insert['tehsil'] = $this->input->post('tehsil');
	$insert['city'] = $this->input->post('city');
	$insert['pincode'] = $this->input->post('pincode');
	$insert['mobile_no'] = $this->input->post('mobileno');
	$insert['phone_no'] = $this->input->post('othermobileno');
	$insert['bank_name'] = $this->input->post('bankname');
	$insert['bank_branch_state'] = $this->input->post('bankbranchstate');
	$insert['branch_name'] = $this->input->post('branchname');
	$insert['bank_accno'] = $this->input->post('acno');
	$insert['panno'] = $this->input->post('panno');
	$insert['checkmob'] = $this->input->post('checkmob');
	$insert['bank_ifsc_code'] = $this->input->post('ifsccode');
	$insert['opening_balance_quantity'] = $this->input->post('opening_balance_quantity');
	$login['email'] = $this->input->post('email');
        $login['date'] = $this->input->post('date');
	$tree['applicant_parent_no'] = $insert['sponser_no'];
	$checksponser_no = $this->getdataadmin('','mlm_members_login',"applicant_no	=".$insert['sponser_no']." and role='member'");
	$checkproposer_no = $this->getdataadmin('','mlm_members_login',"applicant_no =".$insert['proposer_no']." and role='member'");
	
	if($_FILES['image']['name'])
	{
	
	$uploaddir = 'adminimage/';
    $uploadfile = $uploaddir.time().basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) 
	{
    $insert['profilepic'] = $uploadfile;
    } 
	}
	
	if(count($checksponser_no)==0)
	{
    $msg ="Invalid Sponser No.";
    }
	elseif(count($checkproposer_no)==0)
	{
    $msg ="Invalid Proposer No.";
    }
	else
	{
	$this->db->update('mlm_members_detail',$insert,array('applicant_no'=>$this->input->post('applicant_no')));
	$this->db->update('mlm_members_login',$login,array('applicant_no'=>$this->input->post('applicant_no')));
	
	$this->db->update('mlm_member_tree',$tree,array('applicant_no'=>$this->input->post('applicant_no')));
	$msg ="User Edited Successfully.";
	}
	$this->session->set_flashdata('msg',$msg); 
	redirect('admin/userview/'.$this->input->post('member_id'));
	}
		
		$this->data['userview'] 	=  $alluser;		
		$this->data['title'] 		= 'Edit User';
		$this->data['active_menu'] 	= 'View';
		$this->data['content'] 		= 'admin/edituser';
		$this->view('admin/useredit',$this->data); 
	}
	
    public function getdataadmin($field,$table,$condition)
	{
	if(!$field)
	{
	$field='*';
    }
    if($condition)
    {
    $condition ="where $condition";
	}
	$query = $this->db->query("select $field from $table $condition");
	return $query->result_array();
    }
	
	function getspnoalldata()
	{
    $spnno= $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_id,f.state_name,
        g.id as district_id,g.district_name,b.tehsil,b.post,b.city,b.panno,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state as branchstateid,h.state_name as bank_branch_state,
        b.branch_name,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_district_master g on 
		b.district = g.id where b.applicant_no='".$spnno."' and a.role='member'");
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	}
	
	function getbranchdata()
	{
    $brno= $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no where a.role='branch' and status='inActive' and a.applicant_no='".$brno."'");
	
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo $brno;
	}
	}
	
	function getpucdata()
	{
    $brno = $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and status='inActive' and a.applicant_no='".$brno."'");
	
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	}

	function updatecomplain()
	{
		$brno = $_POST['no'];
		$status = $_POST['status'];
		if($this->db->update('complain',array('status'=>$status),array('complain_id' => $brno))){
			echo $status;
		}else{
			echo "<pre>1";print_r($data);print_r($this->db->error()); exit;
		}
	}


	function getpucledgerdata()
	{
	$brno = $_POST['no'];	
	
	
    $dp = $this->base_model->run_query(
		"select sum(totaldp) dp from mlm_puc_chalan where Branch_id='".$brno."' and datetime >= '2018-04-01 10:50:41'");
	
	$amount = 	 $this->base_model->run_query(
		"select sum(amount) amount,date from mlm_transaction 
		where  transtype='4' and recid='".$brno."' and date >= '2018-04-01'");
		$final = $dp[0]->dp-$amount[0]->amount;

	echo $final;

	}
	
	function getledger()
	{
    $brno = $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no where a.role='ledger' and status='inActive' and a.applicant_no='".$brno."'");
	
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	}
	
	function getdistdata()
	{
    $brno = $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and status='inActive' and a.applicant_no='".$brno."'");
	
	if(count($alldata) >0)
	{
		$totaldpquery = $this->base_model->run_query(
			"select sum(totalwithtax) as totaldp FROM mlm_dist_chalan where branch_id='".$brno."'");
	
	
	$Totaldp = $totaldpquery[0]->totaldp;
   
	if($Totaldp < 1000 || $Totaldp==null)
	{
		
		echo 2;
	}
	else{
		
		echo json_encode($alldata);
	}




	}
	else
	{
	echo 1;
	}
	}

	function getdistdataNew()
	{
    $brno = $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and status='inActive' and a.applicant_no='".$brno."'");
	
	if(count($alldata) >0)
	{
		echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	}



	function getledgerdata()
	{
    $brno = $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no where a.role='ledger' and status='inActive' and a.applicant_no='".$brno."'");
	
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	} 
	

	function getotpdata()
	{
    $brno = $_POST['no'];	
    $alldata = $this->base_model->run_query(
		"select s_no,branch_id,branch_name,totaldp from mlm_ticket_chalan where s_no = '".$brno."' and status='active' union all
		select otp,applicant_no,'' branch_name,slab from retail_pivot_process where otp = '".$brno."' and status='Active'");
	
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	}

	
	function getdataledger()
	{
    $brno= $_POST['no'];	
    $alldata = $this->base_model->run_query("select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.bvmbranchname as brname,c.bvmbranchname as dpname,e.bvmbranchname as pucname,f.applicant_name as membername,i.party_name as party_name,z.applicant_name as admin  from mlm_members_login as a left join mlm_branch_detail as b on 
	a.applicant_no=b.applicant_no left join mlm_depo_detail as c on a.applicant_no = c.applicant_no left join mlm_puc_detail as e on a.applicant_no = e.applicant_no left join mlm_members_detail as f on a.applicant_no = f.applicant_no left join mlm_ledger_detail as i on a.applicant_no = i.applicant_no   left join mlm_subadmin as z on a.applicant_no = z.applicant_no 
    where (a.role='branch' or a.role='depo' or a.role='puc' or a.role='member' or a.role='ledger' or a.role='admin') and a.applicant_no='".$brno."'");
	if(count($alldata) >0)
	{
	echo json_encode($alldata);
	}
	else
	{
	echo 1;
	}
	}
	
	//View All Organization
	function organization()
	{
		
		$Allorganization = $this->base_model->run_query(
		"select * from tbl_org where branch_id= '".$this->session->userdata('empid')."'");

		if(!empty($Allorganization))
		{	
				$this->data['organization'] = $this->base_model->run_query("select * from tbl_org where branch_id= '".$this->session->userdata('empid')."'");
		}
		
		
		$this->data['title'] 		= 'Organization';
		$this->data['active_menu'] 	= 'organization';
		$this->data['content'] 		= 'admin/organization';
		$this->view('admin/organization',$this->data);
	}

	//View All Organization
	function allorganization1()
	{
    $res = $this->getid($this->session->userdata('empid'));
	$tid = $res[0]['aid'];
	$this->data['branchid'] = $res[0]['branch_id'];
		
		$this->data['organization'] = $this->base_model->run_query(
		"select * from tbl_org");
				
		$this->data['title'] 		= 'Organization';
		$this->data['active_menu'] 	= 'organization';
		$this->data['content'] 		= 'admin/organization';
		$this->view('admin/organization',$this->data);
	}
		
	//Add any type of Organization
	function add($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$vieworginfo = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_name,
        g.district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state,
        b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id left join mlm_district_master g on 
		b.district = g.id where a.role='subadmin' and a.member_id= '".$id."'");
		//$this->data['vieworginfo'] 	= $vieworginfo;
		$this->data['Orgrole'] = $this->base_model->getRole();      
		
		if(isset($_POST['org_update'])=='submit')
		{
			$this->form_validation->set_rules('Emailid', 'Email', 'required|valid_email');
			
			if ($this->form_validation->run() == true)
			{
				
				$data['applicant_no'] 		= $this->input->post('applicant_no');
				$data['password'] 			= $this->input->post('password');
				$data['role'] 				= $this->input->post('Orgrole');
				$data['email'] 				= $this->input->post('Emailid');				
				$data['date'] 				= date('Y-m-d');
				$data['status'] 			= 'Active';

				 //step for Insert
				$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('mlm_members_login')
							);

				$data1['applicant_no'] 		= $this->input->post('applicant_no');
				$data1['applicant_name'] 	= $this->input->post('FirstName');
				$data1['mobile_no'] 			= $this->input->post('Mobile');
				
				$this->base_model->insert_operation($data1,$this->db->dbprefix('mlm_subadmin'));

				 //step for Insert
	//$this->base_model->insert_operation($data1,$this->db->dbprefix('mlm_members_detail'));
							
			$this->session->set_flashdata('success','<font color="#05BD14">Organization successfully created please login by your Organization ID...</font>');
				return redirect('admin/allorganization/',$this->data);
			}
		}
		elseif(isset($_POST['org_update'])=='update')
		{
				$data['applicant_no'] 		= $this->input->post('applicant_no');
				$data['password'] 			= $this->input->post('password');
				$data['role'] 				= $this->input->post('Orgrole');
				$data['email'] 				= $this->input->post('Emailid');

					$where['member_id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('mlm_members_login'), 
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Organization successfully Updated....</font>');
					return redirect('admin/allorganization/',$this->data);
				}
			
			$this->data['title'] 		= 'Add Organization';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/add-organization';
			$this->view('admin/add-organization',$this->data); 
	}

	//Delete Org
	function deleteOrg()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['aid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_org'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Organization successfully Deleted....</font>');
			return redirect('admin/organization/',$this->data);
		}
	}
	
	//Delete Achivers
	function deleteAchivers()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_achivers'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Achivers successfully Deleted....</font>');
			return redirect('admin/achivers/',$this->data);
		}
	}

	public function applno($size = 8)
    {
    $random_number='';
    $count=0;
    while ($count < $size ) 
        {
            $random_digit = mt_rand(0, 9);
            $random_number .= $random_digit;
            $count++;
        }
    return $random_number;  
    }
	
	function deletebranch($id)
	{
		$this->base_model->run_query("delete a,b from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no where a.role='branch' and a.member_id=$id");
    $this->session->set_flashdata('success','Branch successfully Deleted....');
    redirect('admin/generatebranch');		
	}
	
	function uploaddoc($name,$type,$path)
	{
	$errors= array();
    $file_name = $type.'_'.time().'_'.$name['name'];
    $file_size =$name['size'];
    $file_tmp =$name['tmp_name'];
    $file_type=$name['type'];
    $file_ext=strtolower(end(explode('.',$name['name'])));
    $filepath=$path."/".$file_name; 	
	if(move_uploaded_file($file_tmp,$filepath))
	{
	return $filepath;	
	}
	}


	
	

	
	//Add any type of Organization
	function addbranch($id='')
	{
	       $this->data['product'] = $this->getdataadmin('id,product_name','tbl_product_inventory',"");
		    if($this->input->post('save')==true)
	        {
     		$insert['applicant_no'] = $this->applno(5);
			$insert['password'] = $_POST['password'];
			//$insert['email'] = $_POST['bvm_pucemail'];
			$insert['role'] = 'branch';
			$insert['date'] = date('Y-m-d');
			$insert['status'] = 'inActive';		
			$_POST['applicant_no'] = $insert['applicant_no'];
			unset($_POST['password']);
			unset($_POST['save']);
			unset($_POST['applicantno']);
			$this->db->insert('mlm_members_login',$insert);
			$lastid = $this->db->insert_id();
            if($lastid)
	        {
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}
			$productsave=array();
			for($e = 0; $e<count($_POST['productid']);$e++)
			{
			$productsave['applicant_no'] = 	$insert['applicant_no'];
			$productsave['productid'] = 	$_POST['productid'][$e];
			$productsave['productname'] = 	$_POST['productname'][$e];
			$productsave['pucproductquantity'] = 	$_POST['opening_balance'][$e];
			$productsave['open_quantity'] = 	$_POST['opening_balance'][$e];
			$prosave[] =$productsave;
			}
			unset($_POST['productid']);
			unset($_POST['productname']);
			unset($_POST['opening_balance']);
			unset($_POST['totalqun']);
			unset($_POST['opening_balanceexist']);
			$branchdetails = array_merge($_POST, $docspath);
			$this->db->insert('mlm_branch_detail',$branchdetails);
			$this->db->insert_batch('puc_product_details',$prosave);
			$msg ="Thanku For Registration. Your Branch Id is ".$insert['applicant_no'];
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generatebranch');
	        }
			}
			elseif($this->input->post('update')==true)
	        {
			$insert['password'] = $_POST['password'];
			$insert['email'] = $_POST['bvmpuc_email'];	
            $applicant_no = $_POST['applicant_no'];
			unset($_POST['password']);
			unset($_POST['applicant_no']);
			unset($_POST['update']);
			$this->db->update('mlm_members_login', $insert, array('applicant_no' => $applicant_no));
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}
            $productsave=array();
			for($e = 0; $e<count($_POST['productid']);$e++)
			{
			if($this->checkproduct($applicant_no,$_POST['productid'][$e])!='')
			{
			if($_POST['opening_balance'][$e] > $_POST['opening_balanceexist'][$e])
            {
            $productsave['pucproductquantity'] = $_POST['totalqun'][$e]+($_POST['opening_balance'][$e] - $_POST['opening_balanceexist'][$e]);
            }
            elseif($_POST['opening_balance'][$e] < $_POST['opening_balanceexist'][$e])
			{
            $productsave['pucproductquantity'] = $_POST['totalqun'][$e]-($_POST['opening_balanceexist'][$e] - $_POST['opening_balance'][$e]);
            }
            else
			{				
		    $productsave['pucproductquantity'] = 	$_POST['totalqun'][$e];
			}
			$productsave['open_quantity'] = $_POST['opening_balance'][$e];
			
			$this->db->update('puc_product_details',$productsave,array('applicant_no' => $applicant_no,'productid'=>$_POST['productid'][$e]));
			}
			else
			{
			$productsave['applicant_no'] = 	$applicant_no;
			$productsave['productid'] = 	$_POST['productid'][$e];
			$productsave['productname'] = 	$_POST['productname'][$e];
			$productsave['pucproductquantity'] = $_POST['opening_balance'][$e];
			$productsave['open_quantity'] = 	$_POST['opening_balance'][$e];
            $this->db->insert('puc_product_details',$productsave);			
			}
			}
			
			unset($_POST['productid']);
			unset($_POST['productname']);
			unset($_POST['opening_balance']);
			unset($_POST['totalqun']);
			unset($_POST['opening_balanceexist']);
			$branchdetails = array_merge($_POST, $docspath);
			$this->db->update('mlm_branch_detail',array_filter($branchdetails),array('applicant_no' => $applicant_no));
			$msg ="Thanku For updation. data successfully updated";
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generatebranch');
			}
			
		    if($id)
		     {
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='branch' and a.member_id='".$id."'");
		$this->data['branchdata'] = $alluser ;
		$this->data['update'] = 'true' ;
			}
		    $this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	        $this->data['bank'] = $this->getdataadmin('','tbl_bank',"");			
			$this->data['title'] 		= 'Add branch';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/add-branch';
			$this->view('admin/add-branch',$this->data); 
	}



	function viewbranch($id='')
	{
	       $this->data['product'] = $this->getdataadmin('id,product_name','tbl_product_inventory',"");
		   
			
		    if($id)
		     {
		$alluser = $this->base_model->run_query(
		"select a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='branch' and a.applicant_no='".$id."'");
		$this->data['branchdata'] = $alluser ;
			}
		    $this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	        $this->data['bank'] = $this->getdataadmin('','tbl_bank',"");			
			$this->data['title'] 		= 'view branch';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/view-branch';
			$this->view('admin/view-branch',$this->data); 
	}

	function viewpuc($id='')
	{
		$this->data['product'] = $this->getdataadmin('id,product_name','tbl_product_inventory',"");
	   
		
		  if($id)
		     {
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='puc' and a.applicant_no='".$id."'");
		
		$this->data['branchdata'] = $alluser ;
		$this->data['update'] = 'true' ;
			}
			//print_r($this->data['branchdata']);exit;
		    $this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	        $this->data['bank'] = $this->getdataadmin('','tbl_bank',"");
           // $this->data['branchdata'] = $this->getbdpdata('mlm_branch_detail','branch');
            $this->data['depodata'] = $this->getbdpdata('mlm_depo_detail','depo');			
			$this->data['title'] 		= 'Add puc';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/view-puc';
			$this->view('admin/view-puc',$this->data); 
	}

	//Add any type of depo
	function adddepo($id='')
	{
		
		    if($this->input->post('save')==true)
	        {
     		$insert['applicant_no'] = $this->applno(5);
			$insert['password'] = $_POST['password'];
			//$insert['email'] = $_POST['bvmpuc_email'];
			$insert['role'] = 'depo';
			$insert['date'] = date('Y-m-d');
			$insert['status'] = 'inActive';		
			$_POST['applicant_no'] = $insert['applicant_no'];
			unset($_POST['password']);
			unset($_POST['save']);
			$this->db->insert('mlm_members_login',$insert);
			$lastid = $this->db->insert_id();
            if($lastid)
	        {
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}
			$branchdetails = array_merge($_POST, $docspath);
			$this->db->insert('mlm_depo_detail',$branchdetails);
			$msg ="Thanku For Registration. Your Applicant No is ".$insert['applicant_no'];
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generatedepo');
	        }
			}
			elseif($this->input->post('update')==true)
	        {
			$insert['password'] = $_POST['password'];
			$insert['email'] = $_POST['bvmpuc_email'];	
            $applicant_no = $_POST['applicant_no'];
			unset($_POST['password']);
			unset($_POST['applicant_no']);
			unset($_POST['update']);
			$this->db->update('mlm_members_login', $insert, array('applicant_no' => $applicant_no));
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}

			$branchdetails = array_merge($_POST, $docspath);
			$this->db->update('mlm_depo_detail',array_filter($branchdetails),array('applicant_no' => $applicant_no));
			$msg ="Thanku For updation. data successfully updated";
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generatedepo');
			}
			
		    if($id)
		     {
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_depo_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='depo' and a.member_id='".$id."'");
		$this->data['branchdata'] = $alluser ;
		$this->data['update'] = 'true' ;
			}
		    $this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	        $this->data['bank'] = $this->getdataadmin('','tbl_bank',"");			
			$this->data['title'] 		= 'Add depo';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/add-depo';
			$this->view('admin/add-depo',$this->data); 
	}

	function deletedepo($id)
	{
	mysql_query("delete a,b from mlm_members_login as a left join mlm_depo_detail as b on 
		a.applicant_no=b.applicant_no where a.role='depo' and a.member_id=$id");
    $this->session->set_flashdata('success','Depo successfully Deleted....');
    redirect('admin/generatedepo');		
	}
    
	function getbdpdata($table,$role)
	{
	$data = $this->base_model->run_query(
		"select a.member_id,b.* from mlm_members_login as a left join $table as b on 
		a.applicant_no=b.applicant_no where a.role='".$role."'");	
	return $data;
	}
	
	//Add any type of puc
	function addpuc($id='')
	{	
	    $this->data['product'] = $this->getdataadmin('id,product_name','tbl_product_inventory',"");
	    if($this->input->post('save')==true)
	        {
			
     		$insert['applicant_no'] = $this->applno(5);
			$insert['password'] = $_POST['password'];
			//$insert['email'] = $_POST['bvmpuc_email'];
			$insert['role'] = 'puc';
			$insert['date'] = date('Y-m-d');
			$insert['status'] = 'inActive';		
			$_POST['applicant_no'] = $insert['applicant_no'];
			unset($_POST['password']);
			unset($_POST['save']);
			$this->db->insert('mlm_members_login',$insert);
			$lastid = $this->db->insert_id();
            if($lastid)
	        {
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}
			
			$productsave=array();
			for($e = 0; $e<count($_POST['productid']);$e++)
			{
			$productsave['applicant_no'] = 	$insert['applicant_no'];
			$productsave['productid'] = 	$_POST['productid'][$e];
			$productsave['productname'] = 	$_POST['productname'][$e];
			$productsave['pucproductquantity'] = $_POST['opening_balance'][$e];
			$productsave['open_quantity'] = 	$_POST['opening_balance'][$e];
			$prosave[] =$productsave;
			}
			unset($_POST['productid']);
			unset($_POST['productname']);
			unset($_POST['opening_balance']);
			unset($_POST['totalqun']);
			unset($_POST['opening_balanceexist']);
			$branchdetails = array_merge($_POST, $docspath);
			$this->db->insert('mlm_puc_detail',$branchdetails);
			$this->db->insert_batch('puc_product_details',$prosave);
			$msg ="Thanku For Registration. Your PUC Id is ".$insert['applicant_no'];
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generatepuc');
	        }
			}
			elseif($this->input->post('update')==true)
	        {
			$insert['password'] = $_POST['password'];
			$insert['email'] = $_POST['bvmpuc_email'];	
            $applicant_no = $_POST['applicant_no'];
			unset($_POST['password']);
			unset($_POST['applicant_no']);
			unset($_POST['update']);
			$this->db->update('mlm_members_login', $insert, array('applicant_no' => $applicant_no));
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}
            $productsave=array();
			for($e = 0; $e<count($_POST['productid']);$e++)
			{
			if($this->checkproduct($applicant_no,$_POST['productid'][$e])!='')
			{
			if($_POST['opening_balance'][$e] > $_POST['opening_balanceexist'][$e])
            {
            $productsave['pucproductquantity'] = $_POST['totalqun'][$e]+($_POST['opening_balance'][$e] - $_POST['opening_balanceexist'][$e]);
            }
            elseif($_POST['opening_balance'][$e] < $_POST['opening_balanceexist'][$e])
			{
            $productsave['pucproductquantity'] = $_POST['totalqun'][$e]-($_POST['opening_balanceexist'][$e] - $_POST['opening_balance'][$e]);
            }
            else
			{				
		    $productsave['pucproductquantity'] = 	$_POST['totalqun'][$e];
			}

			$productsave['open_quantity'] = $_POST['opening_balance'][$e];
			$this->db->update('puc_product_details',$productsave,array('applicant_no' => $applicant_no,'productid'=>$_POST['productid'][$e]));
			}
			else
			{
			$productsave['applicant_no'] = 	$applicant_no;
			$productsave['productid'] = 	$_POST['productid'][$e];
			$productsave['productname'] = 	$_POST['productname'][$e];
			$productsave['pucproductquantity'] = $_POST['opening_balance'][$e];
			$productsave['open_quantity'] = 	$_POST['opening_balance'][$e];
            $this->db->insert('puc_product_details',$productsave);			
			}
			}

			unset($_POST['productid']);
			unset($_POST['productname']);
			unset($_POST['opening_balance']);
			unset($_POST['totalqun']);
			unset($_POST['opening_balanceexist']);
			$branchdetails = array_merge($_POST, $docspath);
			$this->db->update('mlm_puc_detail',array_filter($branchdetails),array('applicant_no' => $applicant_no));
			$msg ="Thanku For updation. data successfully updated";
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generatepuc');
			}
			
		    if($id)
		     {
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='puc' and a.member_id='".$id."'");
		$this->data['branchdata'] = $alluser ;
		$this->data['update'] = 'true' ;
			}
		    $this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	        $this->data['bank'] = $this->getdataadmin('','tbl_bank',"");
           // $this->data['branchdata'] = $this->getbdpdata('mlm_branch_detail','branch');
            $this->data['depodata'] = $this->getbdpdata('mlm_depo_detail','depo');			
			$this->data['title'] 		= 'Add puc';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/add-puc';
			$this->view('admin/add-puc',$this->data); 
	}
    
	function checkproduct($appid,$proid)
	{
    $assignproduct = $this->db->query("select productid from puc_product_details where applicant_no = '".$appid."' and productid = '".$proid."'")->result_array();
	return $assignproduct[0]['productid'];
	}
	
	function deletepuc($id)
	{
	$this->db->query("delete a,b from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and a.member_id=$id");
    $this->session->set_flashdata('success','Puc successfully Deleted....');
    redirect('admin/generatepuc');		
	}

	//Add any type of puc
	function addledger($id='')
	{		
		    if($this->input->post('save')==true)
	        {
     		$insert['applicant_no'] = $this->applno(5);
			$insert['password'] = '1234';
			$insert['email'] = $_POST['email'];
			$insert['role'] = 'ledger';
			$insert['date'] = date('Y-m-d');
			$insert['status'] = 'inActive';		
			$_POST['applicant_no'] = $insert['applicant_no'];
			unset($_POST['password']);
			unset($_POST['save']);
			
			$this->db->insert('mlm_members_login',$insert);
			$lastid = $this->db->insert_id();
            if($lastid)
	        {
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}
			$branchdetails = array_merge($_POST, $docspath);
			$this->db->insert('mlm_ledger_detail',$branchdetails);
			$msg ="Thanku For Registration. Your ledger Id is ".$insert['applicant_no'];
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generateledger');
	        }
			}
			elseif($this->input->post('update')==true)
	        {
			//$insert['password'] = $_POST['password'];
			$insert['email'] = $_POST['bvmpuc_email'];	
            $applicant_no = $_POST['applicant_no'];
			unset($_POST['password']);
			unset($_POST['applicant_no']);
			unset($_POST['update']);
			$this->db->update('mlm_members_login', $insert, array('applicant_no' => $applicant_no));
		    $docspath=array();
			foreach($_FILES as $key =>$val)
			{
			$type = $key.'_'.$insert['applicant_no'];
			$path = "document";
			$errors= array();
			if($val['name'])
			{
            $docspath[$key] = $this->uploaddoc($val,$type,$path);
			}
			}

			$branchdetails = array_merge($_POST, $docspath);
		
			$this->db->update('mlm_ledger_detail',array_filter($branchdetails),array('applicant_no' => $applicant_no));
			$msg ="Thanku For updation. data successfully updated";
			$this->session->set_flashdata('success1',$msg);
			redirect('admin/generateledger');
			}
			
		    if($id)
		     {
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='ledger' and a.member_id='".$id."'");
		$this->data['branchdata'] = $alluser ;
	
		$this->data['update'] = 'true' ;
			}
		    $this->data['state'] = $this->getdataadmin('','mlm_state_master',"");
	        $this->data['bank'] = $this->getdataadmin('','tbl_bank',"");			
			$this->data['title'] 		= 'Add ledger';
			$this->data['active_menu'] 	= 'add';
			$this->data['content'] 		= 'admin/add-ledger';
			$this->view('admin/add-ledger',$this->data); 
	}

	function deleteledger($id)
	{
		$userinfo = $this->base_model->run_query("delete a,b from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no where a.role='ledger' and a.member_id=$id");

    	$this->session->set_flashdata('success','Ledger successfully Deleted....');
    	redirect('admin/ledgerlist');		
	}	

	//Add Bank
	function aboutus($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewaboutinfo = $this->base_model->run_query(
		"select * from tbl_aboutus where id=1");

		$this->data['viewaboutinfo'] 	= $viewaboutinfo;

		if($this->input->post('about_update')=='Update')
		{
				
				$data['about_desc'] 			= $this->input->post('about_desc');

			$where['id'] 					= 1;

	$this->base_model->update_operation($data,$this->db->dbprefix('tbl_aboutus'),$where);
	$this->session->set_flashdata('success','<font color="#05BD14">Aboutus successfully Updated....</font>');
			return redirect('admin/aboutus',$this->data);
		}

		$this->data['title'] 		= 'Aboutus';
		
		$this->data['active_menu'] 	= 'aboutus';
		$this->data['content'] 		= 'admin/add-aboutus';
		
		$this->view('admin/add-aboutus',$this->data);
	}
	
	//View All Session
	function session()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		//Data For Active Users
		$Allsession = $this->base_model->run_query(
		"select * from tbl_session");
		$this->data['month'] = $this->base_model->getMonth();
		$this->data['userinfo'] 	= $userinfo;
		$this->data['Allsession'] 	= $Allsession;
		$this->data['title'] 		= 'Session';
		
		$this->data['active_menu'] 	= 'session';
		$this->data['content'] 		= 'admin/session';
		$this->view('admin/session',$this->data);
	}
	//Add Session
	function addsession($id=FALSE)
	{
		$id = $this->uri->segment(3);
		
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$viewsessioninfo = $this->base_model->run_query(
		"select * from tbl_session where id ='".$id."'");
		$this->data['viewsessioninfo'] 	= $viewsessioninfo;
		$this->data['month'] = $this->base_model->getMonth();
		if(isset($_POST['session_update'])=='')
		{
			$this->form_validation->set_rules('start_year', 'StartYear', 'required');
			$this->form_validation->set_rules('end_year', 'End Year', 'required');
			$this->form_validation->set_rules('start_date', 'StartDate', 'required');
			$this->form_validation->set_rules('end_date', 'End Date', 'required');
			
			if ($this->form_validation->run() == true)
			{		
				$data['start_year'] 			= $this->input->post('start_year');
				$data['end_year'] 				= $this->input->post('end_year');
				$data['start_date'] 			= $this->input->post('start_date');
				
				$data['end_date'] 				= $this->input->post('end_date');
				$data['start_month'] 			= $this->input->post('month');
				$data['status'] 				= 'Active';
			 //step for Insert
				$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('tbl_session')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Session successfully created...</font>');
				return redirect('admin/addsession/',$this->data);
			}
		}
		else{
				$data['start_year'] 			= $this->input->post('start_year');
			
				$data['end_year'] 				= $this->input->post('end_year');
			
				$data['start_date'] 			= $this->input->post('start_date');
			
				$data['end_date'] 				= $this->input->post('end_date');
				$data['start_month'] 			= $this->input->post('month');
					$data['status'] 			= 'Active';
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_session'), 
					$where
					);

					$this->session->set_flashdata('success','<font color="#05BD14">Session successfully Updated....</font>');
					return redirect('admin/addsession/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 		= 'Session';
		
		$this->data['active_menu'] 	= 'session';
		$this->data['content'] 		= 'admin/add-session';
		$this->view('admin/add-session',$this->data);
	}
	//Delete Session
	function deleteSession()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_session'),				
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Session successfully Deleted....</font>');
					return redirect('admin/session/',$this->data);
		}
	}

	//View All State List
	function districtlist()
	{
		$Allcity = $this->base_model->run_query("select * from mlm_city_master");
		$this->data['Allcity'] 		= $Allcity;		
		$this->data['title'] 		= 'district';
		$this->data['active_menu'] 	= 'district';
		$this->data['content'] 		= 'admin/districtlist';
		$this->view('admin/districtlist',$this->data); 
	}

	

	//Add District
	function adddistrict($id=FALE)
	{
		$id = $this->uri->segment(3);
		
		$districtdata = $this->base_model->run_query("select * from mlm_city_master where id ='".$id."'");

		$this->data['districtdata'] 	= $districtdata;

		$this->data['state'] = $this->base_model->getStateByCountry();

		if($this->input->post('district_update')=='Submit')
		{
			$this->form_validation->set_rules('district_name', 'District Name', 'required');			
			if($this->form_validation->run() == true)
			{		
				
				$data['city_name'] 			= $this->input->post('district_name');
				$data['state_id'] 			= $this->input->post('state_id');				
			
				
			 //step for Insert
			 
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('mlm_city_master')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">District successfully created...</font>');
				return redirect('admin/districtlist/',$this->data);
			}
		}

		if($this->input->post('district_update')=='Update')
		{
				
			$data['city_name'] 			= $this->input->post('district_name');
			$data['state_id'] 			= $this->input->post('state_id');		

			$where['id'] 		= $this->uri->segment(3);

	$this->base_model->update_operation($data,$this->db->dbprefix('mlm_city_master'),$where);
			$this->session->set_flashdata('success','<font color="#05BD14">District successfully Updated....</font>');
			return redirect('admin/districtlist',$this->data);
		}

		$this->data['title'] 		= 'District';		
		$this->data['active_menu'] 	= 'district';
		$this->data['content'] 		= 'admin/add-district';
		
		$this->view('admin/add-district',$this->data);
	}

	//Delete District List
	function deleteDistrict()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('mlm_city_master'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">District successfully Deleted....</font>');
			return redirect('admin/districtlist/',$this->data);
		}
	}

	//View All News & Events
	function newsevents()
	{
		$Allnews = $this->base_model->run_query("select * from tbl_news");
		$this->data['Allnews'] 		= $Allnews;		
		$this->data['title'] 		= 'news';
		$this->data['active_menu'] 	= 'newslist';
		$this->data['content'] 		= 'admin/newslist';
		$this->view('admin/newslist',$this->data); 
	}

	//Add News
	function addnews($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewnewsinfo = $this->base_model->run_query(
		"select * from tbl_news where id ='".$id."'");

		$this->data['viewnewsinfo'] 	= $viewnewsinfo;

		if($this->input->post('news_update')=='Submit')
		{
			$this->form_validation->set_rules('news_desc', 'News Description', 'required');
						
			if($this->form_validation->run() == true)
			{		
				
				$data['news_desc'] 			= $this->input->post('news_desc');
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_news')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">News successfully created...</font>');
				return redirect('admin/newsevents/',$this->data);
			}
		}

		if($this->input->post('news_update')=='Update')
		{
				
				$data['news_desc'] 			= $this->input->post('news_desc');

			$where['id'] 					= $this->uri->segment(3);

	$this->base_model->update_operation($data,$this->db->dbprefix('tbl_news'),$where);
	$this->session->set_flashdata('success','<font color="#05BD14">News successfully Updated....</font>');
			return redirect('admin/newsevents',$this->data);
		}

		$this->data['title'] 		= 'News';
		
		$this->data['active_menu'] 	= 'news';
		$this->data['content'] 		= 'admin/add-news';
		
		$this->view('admin/add-news',$this->data);
	}

	//Delete News
	function deleteNews()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_news'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">News successfully Deleted....</font>');
			return redirect('admin/newsevents/',$this->data);
		}
	}

	//View All Bank List
	function banklist()
	{
		$Allbanklist = $this->base_model->run_query("select * from mlm_bank_detail");
		$this->data['Allbanklist'] 	= $Allbanklist;		
		$this->data['title'] 		= 'bank';
		$this->data['active_menu'] 	= 'banklist';
		$this->data['content'] 		= 'admin/banklist';
		$this->view('admin/banklist',$this->data); 
	}
    // add bv dp
	function addbvdp()
	{
	if($this->input->post('submit')=='Submit')
	{
	$insert['applicant_no'] = $this->input->post('branch_id');	
	$insert['date'] = $this->input->post('date');
	$insert['bv'] = $this->input->post('bv');
	$insert['dp'] = $this->input->post('dp');
	
	$month = date('m',strtotime($this->input->post('date')));
	$year = date('Y',strtotime($this->input->post('date')));
	$dd=$this->db->query("select id from closemonth where month ='".$month."' and year='".$year."'")->row();
	
	if(!$dd->id)
	{
	$this->db->insert('old_bv_dp',$insert);
	$this->session->set_flashdata('success','<font color="#05BD14"> Successfully Added...</font>');
	}
	else
	{
	$this->session->set_flashdata('success','<font color="#05BD14"> Month Is Already Closed for Payout...</font>');
		
	}
	redirect('admin/addbvdp');
	}
    $this->view('admin/add-bvdp', array());	
	}
	
	function closemonth()
	{
	if($this->input->post('submit')=='Submit')
	{
	$insert['month'] = $this->input->post('month');	
	$insert['year'] = $this->input->post('year');
	$dd=$this->db->query("select id from closemonth where month ='".$insert['month']."' and year='".$insert['year']."'")->row();
	
	if(!$dd->id)
	{
	$this->db->insert('closemonth',$insert);	
	$this->session->set_flashdata('success','<font color="#05BD14"> Successfully Closed...</font>');
	}
	else
	{
	$this->session->set_flashdata('success','<font color="#05BD14"> Already Closed Selected Month...</font>');	
	}
	redirect('admin/closemonth');
	}
    $this->view('admin/closemonth');	
	}
	
	function closemonthlist()
	{
	$data['alluser']=$this->base_model->run_query("select month,year,(case when status =1 then 'Closed' else 'Open' end) as status from closemonth");
    $this->view('admin/closemonthlist',$data);	
	}

	function change_password(){
		$application_no = $this->session->userdata("applicant_no");
		
		if(isset($_POST['update'])){
			$this->db->where('applicant_no', $application_no);
			$member_query = $this->db->get('mlm_members_login')->row();
			$current_old_password = $member_query->password;
			$old_password = $this->input->post('old_password');
			$new_password = $this->input->post('new_password');
			
			if($current_old_password == $old_password){
				$this->db->set("password", $new_password);
				$this->db->where('applicant_no', $application_no);
				$this->db->update('mlm_members_login');
				$this->session->set_flashdata('msg','Password Updated Successfully');
			}else{
				$this->session->set_flashdata('msg','Old password is wrong');
			}
		}
		
		$this->view('admin/changePassword', array());
	}
	
	function bvdplist()
	{

	$data = array();
	$data['alluser'] = array();
	if($this->input->post('search')==true)
	{
		$searchdata=array();
		if($this->input->post('date1')!='')
		{
        	$searchdata[] = "date >='".$this->input->post('date1')."'";
		}
		if($this->input->post('date2')!='')
		{
        	$searchdata[] = "date <='".trim($this->input->post('date2'))."'";
		}
		if($this->input->post('apno')!='')
		{
       		$searchdata[] = "applicant_no ='".trim($this->input->post('apno'))."'";
		}
		
        $cond =implode(' and ',$searchdata);
        if($cond)
		{
			$conds = 'where '.$cond;	
		}
		else
		{
			$conds = '';	
		}
		$data['alluser']=$this->base_model->run_query("select * from old_bv_dp $conds");
	}

    $this->view('admin/bvdplist',$data);	
	}
	
	function genratedpayout()
	{
	$data['alluser']=$this->base_model->run_query("select pay_id,month,year,(Case when showinlogin=0 then 'No' else 'Yes' end ) as showinlogin ,'Genrated' as active from payout_parent");
    $this->view('admin/genratedpayout',$data);	
	}
	
	function deletepayout($pay_id)
	{
	$this->db->query("delete from payout_parent where pay_id='".$pay_id."'");
	$this->db->query("delete from payout where pay_id='".$pay_id."'");
	$this->session->set_flashdata('success','<font color="#05BD14"> Pyout Successfully Deleted...</font>');
    redirect('admin/genratedpayout');	
	}
	
	//Add Bank
	function addbanklist($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewbanklistinfo = $this->base_model->run_query(
		"select * from mlm_bank_detail where bank_id ='".$id."'");

		$this->data['viewbanklistinfo'] 	= $viewbanklistinfo;

		if($this->input->post('bank_update')=='Submit')
		{
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
						
			if($this->form_validation->run() == true)
			{		
				
				$data['bank_name'] 			= $this->input->post('bank_name');
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('mlm_bank_detail')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Banklist successfully created...</font>');
				return redirect('admin/banklist/',$this->data);
			}
		}

		if($this->input->post('bank_update')=='Update')
		{
				
				$data['bank_name'] 			= $this->input->post('bank_name');

			$where['id'] 					= $this->uri->segment(3);

	$this->base_model->update_operation($data,$this->db->dbprefix('mlm_bank_detail'),$where);
	$this->session->set_flashdata('success','<font color="#05BD14">Banklist successfully Updated....</font>');
			return redirect('admin/banklist',$this->data);
		}

		$this->data['title'] 		= 'Banklist';
		
		$this->data['active_menu'] 	= 'banklist';
		$this->data['content'] 		= 'admin/add-banklist';
		
		$this->view('admin/add-banklist',$this->data);
	}

	//Delete Banklist
	function deleteBanklist()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('mlm_bank_detail'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Banklist successfully Deleted....</font>');
			return redirect('admin/banklist/',$this->data);
		}
	}


	//View All Bank
	function bank()
	{
		$Allbank = $this->base_model->run_query(
		"select * from tbl_bank");
		$this->data['Allbank'] 		= $Allbank;		
		$this->data['title'] 		= 'bank';
		$this->data['active_menu'] 	= 'bank';
		$this->data['content'] 		= 'admin/bank';
		$this->view('admin/bank',$this->data); 
	}

	//Add Bank
	function addbank($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewbankinfo = $this->base_model->run_query(
		"select * from tbl_bank where id ='".$id."'");
		$this->data['viewbankinfo'] 	= $viewbankinfo;

		if($this->input->post('bank_update')=='Submit')
		{
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
			$this->form_validation->set_rules('bank_ifsc', 'Bank IFSC Code', 'required');				
			if($this->form_validation->run() == true)
			{		
				
				$data['bank_name'] 			= $this->input->post('bank_name');
				$data['bank_ifsc'] 			= $this->input->post('bank_ifsc');
				$data['bank_address'] 			= $this->input->post('bank_address');
				$data['bank_location'] 			= $this->input->post('bank_location');

				$data['status'] 				= 'Active';
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_bank')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Bank successfully created...</font>');
				return redirect('admin/bank/',$this->data);
			}
		}

		if($this->input->post('bank_update')=='Update')
		{
				
				$data['bank_name'] 			= $this->input->post('bank_name');
				$data['bank_ifsc'] 			= $this->input->post('bank_ifsc');
				$data['bank_address'] 			= $this->input->post('bank_address');
				$data['bank_location'] 			= $this->input->post('bank_location');

			$where['id'] 		= $this->uri->segment(3);

			$this->base_model->update_operation($data,$this->db->dbprefix('tbl_bank'),$where);
			$this->session->set_flashdata('success','<font color="#05BD14">Bank successfully Updated....</font>');
			return redirect('admin/bank',$this->data);
		}

		$this->data['title'] 		= 'Bank';
		
		$this->data['active_menu'] 	= 'bank';
		$this->data['content'] 		= 'admin/add-bank';
		
		$this->view('admin/add-bank',$this->data);
	}

	//Delete Bank
	function deleteBank()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_bank'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Bank successfully Deleted....</font>');
			return redirect('admin/bank/',$this->data);
		}
	}


	//View All Tax
	function tax()
	{
		$Alltax = $this->base_model->run_query(
		"select * from tbl_tax");
		$this->data['Alltax'] 		= $Alltax;		
		$this->data['title'] 		= 'tax';
		$this->data['active_menu'] 	= 'tax';
		$this->data['content'] 		= 'admin/tax';
		$this->view('admin/tax',$this->data); 
	}

	//Add Tax
	function addtax($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewtaxinfo = $this->base_model->run_query(
		"select * from tbl_tax where id ='".$id."'");
		$this->data['viewtaxinfo'] 	= $viewtaxinfo;

		if($this->input->post('tax_update')=='Submit')
		{
			$this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required');			
			if($this->form_validation->run() == true)
			{		
				
				$data['tax_rate'] 			= $this->input->post('tax_rate');				
				$data['status'] 				= 'Active';
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_tax')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Tax successfully created...</font>');
				return redirect('admin/addtax/',$this->data);
			}
		}

		if($this->input->post('tax_update')=='Update')
		{
				
			$data['tax_rate'] 			= $this->input->post('tax_rate');	

			$where['id'] 		= $this->uri->segment(3);

			$this->base_model->update_operation($data,$this->db->dbprefix('tbl_tax'),$where);
			$this->session->set_flashdata('success','<font color="#05BD14">Tax successfully Updated....</font>');
			return redirect('admin/tax',$this->data);
		}

		$this->data['title'] 		= 'Tax';
		
		$this->data['active_menu'] 	= 'tax';
		$this->data['content'] 		= 'admin/add-tax';
		
		$this->view('admin/add-tax',$this->data);
	}

	//Delete Tax
	function deleteTax()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_tax'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Tax successfully Deleted....</font>');
			return redirect('admin/tax/',$this->data);
		}
	}

	//View All Scheme
	function scheme()
	{
		$Allscheme = $this->base_model->run_query(
		"select * from tbl_scheme");
		$this->data['Allscheme'] 	= $Allscheme;		
		$this->data['title'] 		= 'scheme';
		$this->data['active_menu'] 	= 'scheme';
		$this->data['content'] 		= 'admin/scheme';
		$this->view('admin/scheme',$this->data); 
	}

	function schemeNew()
	{
		$Allscheme = $this->base_model->run_query(
		"select * from tbl_scheme_new");
		$this->data['Allscheme'] 	= $Allscheme;		
		$this->data['title'] 		= 'scheme';
		$this->data['active_menu'] 	= 'scheme';
		$this->data['content'] 		= 'admin/scheme';
		$this->view('admin/scheme',$this->data); 
	}
	
	function schemedata()
	{
		$Allscheme = $this->base_model->run_query(
		"select * from tbl_scheme where date_end < '".date('Y-m-d')."'");
		$this->data['Allscheme'] 	= $Allscheme;		
		$this->data['title'] 		= 'scheme';
		$this->data['active_menu'] 	= 'scheme';
		$this->data['content'] 		= 'admin/scheme';
		$this->view('admin/schemedata',$this->data); 
	}
	function schemedataNew()
	{
		$Allscheme = $this->base_model->run_query(
		"select * from tbl_scheme_new where date_end < '".date('Y-m-d')."'");
		$this->data['Allscheme'] 	= $Allscheme;		
		$this->data['title'] 		= 'scheme';
		$this->data['active_menu'] 	= 'scheme';
		$this->data['content'] 		= 'admin/scheme';
		$this->view('admin/schemedata',$this->data); 
	}
    
	function viewschemedata($schemeid)
	{
	$Allscheme = $this->base_model->run_query("SELECT a.*,count(b.quantity) as qun,product_name,product_id,b.schemeid FROM `mlm_dist_chalan` a left join mlm_dist_chalan_detail b on a.`chalan_id`=b.`chalan_id` where b.schemeid = '".$schemeid."' and createby!=7 group by createby");	
	$this->data['Allscheme'] 	= $Allscheme;		
	$this->data['title'] 		= 'scheme';
	$this->data['active_menu'] 	= 'scheme';
	$this->data['content'] 		= 'admin/scheme';
	$this->view('admin/viewschemedata',$this->data);
	}

	function viewschemedataNew($schemeid)
	{
	$Allscheme = $this->base_model->run_query("SELECT a.*,count(b.quantity) as qun,product_name,product_id,b.schemeid FROM `mlm_dist_chalan` a left join mlm_dist_chalan_detail b on a.`chalan_id`=b.`chalan_id` where b.schemeid = '".$schemeid."' and createby!=7 and chalantype=6 group by createby");	
	$this->data['Allscheme'] 	= $Allscheme;		
	$this->data['title'] 		= 'scheme';
	$this->data['active_menu'] 	= 'scheme';
	$this->data['content'] 		= 'admin/scheme';
	$this->view('admin/viewschemedata',$this->data);
	}
	
	function appnos($memberid)
	{
	$member = $this->db->query("SELECT a.applicant_no   FROM `mlm_members_login` a left join mlm_members_detail b on a.applicant_no = b.applicant_no left join mlm_branch_detail c on a.applicant_no = c.applicant_no left join  mlm_puc_detail d on a.applicant_no = d.applicant_no
where a.member_id = '".$memberid."'")->result_array();
    return $member[0]['applicant_no'];	
	}
	
	function redemeschemechalan()
	{
		$alluser = $this->base_model->run_query(
		"select * from mlm_scheme_chalan where billfromtype =1 and createby ='".$this->session->userdata('empid')."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/redemeschemechalan',$this->data); 
	}

	function branchschemelist($id='')
	{
		
		if($this->input->post('spanno')!='' or $id)
		{
			if($this->input->post('spanno'))
			{
			  $id = $this->input->post('spanno');

			} 

        $member_id = $this->base_model->run_query("select member_id from mlm_members_login where applicant_no='".$id."'");
	
		$alluser = $this->base_model->run_query(
		"select * from mlm_scheme_chalan where billfromtype =2 and createby ='".$member_id[0]->member_id."'");
		}
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/branchschemechalanlist';
		$this->view('admin/branchschemechalanlist',$this->data); 
	}

	
	function schemechalan($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_scheme_chalan.* from mlm_scheme_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status from mlm_members_login as a where a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/schemechalan',$this->data); 
	}
	
	function redemescheme($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$Allproduct = $this->base_model->run_query(
		"SELECT * FROM `scheme_process` where otpstatus = '1'");
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->otp,'label'=>$pro->otp,'product_name'=>$pro->product_name,
		'product_id'=>$pro->product_id,'scheme_id'=>$pro->scheme_id,'quantity'=>$pro->quantity,'createby'=>$pro->createby,'apno'=>$this->appnos($pro->createby)); 	
		}
		if($this->input->post('save')==true)
	    {		
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/redemescheme');
		}
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['otp'] = $this->input->post('otp')[$i];
		$chalandetailarray['branch_id'] = $this->input->post('createby')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
		$chalandetailarray['scheme_id'] = $this->input->post('scheme_id')[$i];
		$chalandetailarray['createby'] = $this->session->userdata('empid');
		$chalandetailarray['datetime'] = date('Y-m-d H:i:s');
        $this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $this->db->query("update scheme_process set otpstatus='2' where otp ='".$this->input->post('otp')[$i]."'");		
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_scheme_chalan',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/redemeschemechalan');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Scheme';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->view('admin/redemescheme',$this->data);
	    }
	
	
	function otp($l=8,$s=1,$a=1,$n=1) 
	{
  $string = ''; $chars = array();
  if ($s) $chars = array_merge($chars,array(
                     33,35,36,37,38,40,41,42,43,44,45,
                     46,47,58,59,60,61,62,63,64,91,93,
                     94,95,123,124,125,126
                     ));
  if ($a) $chars = array_merge($chars,array(
                     65,66,67,68,69,70,71,72,73,74,
                     75,76,77,78,79,80,81,82,83,84,
                     85,86,87,88,89,90,
                     97,98,99,100,101,102,103,104,105,106,
                     107,108,109,110,111,112,113,114,115,116,
                     117,118,119,120,121,122
                     ));
  if ($n) $chars = array_merge($chars,array(
                     48,49,50,51,52,53,54,55,56,57
                     ));
  for ($i=0;$i<$l;$i++) {shuffle($chars);$string.=chr(reset($chars));}
  return $string;
  }
	
	function processscheme($schemeid)
	{
	$Allscheme = $this->db->query("SELECT a.*,count(b.quantity) as qun,product_name,product_id,schemeid FROM `mlm_dist_chalan` a left join mlm_dist_chalan_detail b on a.`chalan_id`=b.`chalan_id` where b.schemeid = '".$schemeid."' group by createby")->result_array();	
	foreach($Allscheme as $vals)
	{
	$insertdata = array('scheme_id'=>$vals['schemeid'],'product_id'=>$vals['product_id'],'product_name'=>$vals['product_name'],
	'quantity'=>$vals['qun'],'createby'=>$vals['createby'],'otp'=>$this->otp(9,0));
	$this->db->insert('scheme_process',$insertdata);
	}
	redirect('admin/schemedata');	
	}
	
	function addschemecategory()
	{
	$this->data['category'] = $this->base_model->getCategory();
	$this->data['selectedcategory'] = $this->db->query("select category from scheme_category")->result_array();
	if($this->input->post('scheme_update')=='Submit')
		{
		$data['category'] = implode(',',$this->input->post('category'));
		$this->db->query("delete from scheme_category");
		$this->db->insert('scheme_category',$data);
        $this->session->set_flashdata('success','<font color="#05BD14">Scheme Category successfully Updated....</font>');
	    redirect('admin/addschemecategory',$this->data);		
		}
	$this->view('admin/add-scheme-category',$this->data);
	}
	
	//Add Scheme
	function addscheme($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewschemeinfo = $this->base_model->run_query(
		"select * from tbl_scheme where id ='".$id."'");
		$this->data['viewschemeinfo'] 	= $viewschemeinfo;
		$this->data['category'] = $this->base_model->getCategory();

		$this->data['product'] = $this->base_model->getProduct();
		if($this->input->post('scheme_update')=='Submit')
		{
				$data['product_id'] 			= $this->input->post('product');
				$data['category'] 			    = implode(',',$this->input->post('category'));
				$data['scheme_price_start']     = $this->input->post('price_start');
				$data['quantity']     = $this->input->post('qun');
				$data['scheme_price_end'] 	    = $this->input->post('price_end');
				$data['date_start'] 			= date('Y-m-d',strtotime($this->input->post('startdate')));
				$data['date_end'] 			    = date('Y-m-d',strtotime($this->input->post('enddate')));
				$data['status'] 				= 'Active';
			 //step for Insert
				$this->db->insert('tbl_scheme',$data);
			    $this->session->set_flashdata('success','<font color="#05BD14">Scheme successfully created...</font>');
				return redirect('admin/scheme/',$this->data);
		}

		if($this->input->post('scheme_update')=='Update')
		{
				
			$data['product_id'] 			= $this->input->post('product');
			$data['category'] 			    = implode(',',$this->input->post('category'));
			$data['scheme_price_start']     = $this->input->post('price_start');
			$data['quantity']     = $this->input->post('qun');
			$data['scheme_price_end'] 	    = $this->input->post('price_end');
			$data['date_start'] 			= date('Y-m-d',strtotime($this->input->post('startdate')));
			$data['date_end'] 			    = date('Y-m-d',strtotime($this->input->post('enddate')));	

			$where['id'] 		= $this->uri->segment(3);

			$this->base_model->update_operation($data,$this->db->dbprefix('tbl_scheme'),$where);
			$this->session->set_flashdata('success','<font color="#05BD14">Scheme successfully Updated....</font>');
			return redirect('admin/scheme',$this->data);
		}

		$this->data['title'] 		= 'scheme';
		
		$this->data['active_menu'] 	= 'scheme';
		$this->data['content'] 		= 'admin/add-scheme';
		
		$this->view('admin/add-scheme',$this->data);
	}


	function addschemeNew($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewschemeinfo = $this->base_model->run_query(
		"select * from tbl_scheme_new where id ='".$id."'");
		$this->data['viewschemeinfo'] 	= $viewschemeinfo;
		$this->data['category'] = $this->base_model->getCategory();

		$this->data['product'] = $this->base_model->getProduct();
		if($this->input->post('scheme_update')=='Submit')
		{
				$data['product_id'] 			= $this->input->post('product');
				$data['category'] 			    = implode(',',$this->input->post('category'));
				$data['scheme_price_start']     = $this->input->post('price_start');
				$data['quantity']     = $this->input->post('qun');
				$data['scheme_price_end'] 	    = $this->input->post('price_end');
				$data['date_start'] 			= date('Y-m-d',strtotime($this->input->post('startdate')));
				$data['date_end'] 			    = date('Y-m-d',strtotime($this->input->post('enddate')));
				$data['status'] 				= 'Active';
			 //step for Insert
				$this->db->insert('tbl_scheme_new',$data);
			    $this->session->set_flashdata('success','<font color="#05BD14">Scheme successfully created...</font>');
				return redirect('admin/scheme/',$this->data);
		}

		if($this->input->post('scheme_update')=='Update')
		{
				
			$data['product_id'] 			= $this->input->post('product');
			$data['category'] 			    = implode(',',$this->input->post('category'));
			$data['scheme_price_start']     = $this->input->post('price_start');
			$data['quantity']     = $this->input->post('qun');
			$data['scheme_price_end'] 	    = $this->input->post('price_end');
			$data['date_start'] 			= date('Y-m-d',strtotime($this->input->post('startdate')));
			$data['date_end'] 			    = date('Y-m-d',strtotime($this->input->post('enddate')));	

			$where['id'] 		= $this->uri->segment(3);

			$this->base_model->update_operation($data,$this->db->dbprefix('tbl_scheme_new'),$where);
			$this->session->set_flashdata('success','<font color="#05BD14">Scheme successfully Updated....</font>');
			return redirect('admin/scheme',$this->data);
		}

		$this->data['title'] 		= 'scheme';
		
		$this->data['active_menu'] 	= 'scheme';
		$this->data['content'] 		= 'admin/add-scheme';
		
		$this->view('admin/add-schemeNew',$this->data);
	}



	//Delete Scheme
	function deleteScheme()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_scheme'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Scheme successfully Deleted....</font>');
			return redirect('admin/scheme/',$this->data);
		}
	}
	
	function deleteBV()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('old_bv_dp'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">BV/DP successfully Deleted....</font>');
			return redirect('admin/bvdplist/',$this->data);
		}
	}

	//View All Transfer To Branch
	function ttbv()
	{
		$Allttb = $this->base_model->run_query(
		"select * from tbl_category");
		$this->data['Allttb'] 	= $Allttb;		
		$this->data['title'] 		= 'ttb';
		$this->data['active_menu'] 	= 'ttb';
		$this->data['content'] 		= 'admin/ttb';
		$this->view('admin/ttbv',$this->data); 
	}
    
	function adddistchalanIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/addpucchalanIGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 1;
			
		$chalanarray['datetime'] = $this->input->post('date');
		$snno = $this->base_model->getserialnoviatypepucdist(1);
		if(empty($sn))
		{
			$snno =1;
		}
		$chalanarray['s_no'] = $snno;			
		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$this->db->insert('mlm_dist_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['igst'] = $this->input->post('igst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		$chalandetailarray['tax_rate_igst'] = $this->input->post('tax_rate_igst')[$i];
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];
		$chalandetailarray['schemeid'] =0;
        $this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$chdetail = $this->addscheme_product($this->input->post('total'),$this->input->post('date'),$chdetail,$lastid,'igst');
		
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/distchalanviewIGST');		
		}
		
		$option = array();
		$allMembers = $this->base_model->run_query("select applicant_name, applicant_no from mlm_members_detail");
		foreach($allMembers as $allMember){
			$option[$allMember->applicant_no] = $allMember->applicant_name;
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->data['option'] 		= $option;
		$this->view('admin/add-distchalanIGST',$this->data);
	}
	
    function checkschemeamount($date,$productarray)
	{	
	$schemearray = array(); 
	$proarray = $this->db->query("SELECT * FROM `tbl_scheme` WHERE (`date_start`<='".$date."' and `date_end`>='".$date."') and status='Active'")->result_array();	
	
	foreach($proarray as $pr)
	{
	$catarray = explode(',',$pr['category']);
	$amount = 0;
	foreach($productarray as $pro)
	{
	$ff = $this->db->query("SELECT category_id FROM `tbl_product_inventory` WHERE id ='".$pro['product_id']."'")->result_array();
	if(in_array($ff[0]['category_id'],array_values($catarray)))
	{
    $amount = $amount + $pro['total'];
	}
	}
	
    if($pr['scheme_price_start'] <= $amount and $pr['scheme_price_end'] >=$amount)
    {
	$schemearray[] = $pr['id'];	
    }
	}
	return implode(',',$schemearray); 
	}


	function checkschemeamountNew($date,$productarray)
	{	
	$schemearray = array(); 
	$proarray = $this->db->query("SELECT * FROM `tbl_scheme_new` WHERE (`date_start`<='".$date."' and `date_end`>='".$date."') and status='Active'")->result_array();	
	
	foreach($proarray as $pr)
	{
	$catarray = explode(',',$pr['category']);
	$amount = 0;
	foreach($productarray as $pro)
	{
	$ff = $this->db->query("SELECT category_id FROM `tbl_product_inventory` WHERE id ='".$pro['product_id']."'")->result_array();
	if(in_array($ff[0]['category_id'],array_values($catarray)))
	{
    $amount = $amount + $pro['total'];
	}
	}
	
    if($pr['scheme_price_start'] <= $amount and $pr['scheme_price_end'] >=$amount)
    {
	$schemearray[] = $pr['id'];	
    }
	}
	return implode(',',$schemearray); 
	}
	
	
	function addscheme_product($amount,$date,$productarray,$chalanid,$type)
	{
	$sche = $this->checkschemeamount($date,$productarray);
	if($sche)
	{
	$proarray = $this->db->query("SELECT * FROM `tbl_scheme` WHERE id in ($sche)")->result_array();	
	if($proarray>0)
	{
	$chalandetailarray=array();
	foreach($proarray as $pr)
	{
	 $proinfo = $this->db->query("SELECT * FROM `tbl_product_inventory` WHERE id ='".$pr['product_id']."'")->result_array();	 
	 $chalandetailarray['product_id'] = $pr['product_id'];
	 $chalandetailarray['chalan_id'] = $chalanid;
     $chalandetailarray['product_name'] = $proinfo[0]['product_name'];
	 if($type=='igst')
	 {
	 $chalandetailarray['igst'] = 0;
	 $chalandetailarray['tax_rate_igst'] = 0;
	 $chalandetailarray['tax_rate'] = 0;
	 }
	 elseif($type=='cgst')
	 {
	 $chalandetailarray['cgst'] = 0;
     $chalandetailarray['sgst'] = 0;
     $chalandetailarray['tax_rate_cgst'] = 0;
     $chalandetailarray['tax_rate_sgst'] = 0;
     $chalandetailarray['tax_rate'] = 0;	 
	 }
	 $chalandetailarray['total'] = 0;
	 $chalandetailarray['hcn_no'] = $proinfo[0]['hcn_no'];
	 $chalandetailarray['batch_no'] = $proinfo[0]['batch_no'];
	 $chalandetailarray['m_date'] = $proinfo[0]['manufacturer_date'];
	 $chalandetailarray['expire_date'] = $proinfo[0]['expiry_date'];
	 $chalandetailarray['size'] = $proinfo[0]['packaging_size'];
     $chalandetailarray['bv'] = 0;
     $chalandetailarray['dp'] = 0;
     $chalandetailarray['quantity'] = $pr['quantity'];
     $chalandetailarray['rate'] = 0;
     $chalandetailarray['product_total'] =0;
	 $chalandetailarray['schemeid'] =$pr['id'];
	 $productarray[] = $chalandetailarray;
	}	
	}
	}
	return $productarray;
	}


	function addscheme_productNew($amount,$date,$productarray,$chalanid,$type)
	{
	$sche = $this->checkschemeamountNew($date,$productarray);
	if($sche)
	{
	$proarray = $this->db->query("SELECT * FROM `tbl_scheme_new` WHERE id in ($sche)")->result_array();	
	if($proarray>0)
	{
	$chalandetailarray=array();
	foreach($proarray as $pr)
	{
	 $proinfo = $this->db->query("SELECT * FROM `tbl_product_inventory` WHERE id ='".$pr['product_id']."'")->result_array();	 
	 $chalandetailarray['product_id'] = $pr['product_id'];
	 $chalandetailarray['chalan_id'] = $chalanid;
     $chalandetailarray['product_name'] = $proinfo[0]['product_name'];
	 if($type=='igst')
	 {
	 $chalandetailarray['igst'] = 0;
	 $chalandetailarray['tax_rate_igst'] = 0;
	 $chalandetailarray['tax_rate'] = 0;
	 }
	 elseif($type=='cgst')
	 {
	 $chalandetailarray['cgst'] = 0;
     $chalandetailarray['sgst'] = 0;
     $chalandetailarray['tax_rate_cgst'] = 0;
     $chalandetailarray['tax_rate_sgst'] = 0;
     $chalandetailarray['tax_rate'] = 0;	 
	 }
	 $chalandetailarray['total'] = 0;
	 $chalandetailarray['hcn_no'] = $proinfo[0]['hcn_no'];
	 $chalandetailarray['batch_no'] = $proinfo[0]['batch_no'];
	 $chalandetailarray['m_date'] = $proinfo[0]['manufacturer_date'];
	 $chalandetailarray['expire_date'] = $proinfo[0]['expiry_date'];
	 $chalandetailarray['size'] = $proinfo[0]['packaging_size'];
     $chalandetailarray['bv'] = 0;
     $chalandetailarray['dp'] = 0;
     $chalandetailarray['quantity'] = $pr['quantity'];
     $chalandetailarray['rate'] = 0;
     $chalandetailarray['product_total'] =0;
	 $chalandetailarray['schemeid'] =$pr['id'];
	 $productarray[] = $chalandetailarray;
	}	
	}
	}
	return $productarray;
	}
	
	function distchalanIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/distchalanIGST',$this->data); 
	}
	
	function distchalanviewIGST()
	{   $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =1 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/distchalanviewIGST',$this->data); 
	}
	function subdistchalanviewIGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =1 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/subdistchalanviewIGST',$this->data); 
	}

	function distchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		
		$alluser = $this->base_model->run_query("select mlm_dist_chalan.* from mlm_dist_chalan where chalantype in(2,6)  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->view('admin/distchalanviewCGST',$this->data); 
	}
	function subdistchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =2 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->view('admin/subdistchalanviewCGST',$this->data); 
	}
	
	function lists()
	{
		$alluser = $this->base_model->run_query(
			"SELECT *,(CASE WHEN transtype = 1 THEN 'Payment'
			WHEN transtype = 2 THEN 'General'
			WHEN transtype = 3 THEN 'Contra'
			WHEN transtype = 4 THEN 'Receive'
			ELSE ''
			END)Type FROM mlm_transaction where byid = 7");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/list';
		$this->view('admin/list',$this->data); 
	}
	
	function deletebill($type,$chalanno,$redirect)
	{
	$table = "";
	$subtable = "";
	$updatetable = "tbl_product_inventory";
	if($type=='puc')
	{
	$table= "mlm_puc_chalan";
    $subtable= "mlm_puc_chalan_detail";	
	$field = "product_id as id,quantity  as qun";
	}
	elseif($type=='distributor')
	{
	$table= "mlm_dist_chalan";
    $subtable= "mlm_dist_chalan_detail";
    $field = "product_id as id,quantity  as qun";	
	}
	elseif($type=='branch')
	{
	$table= "mlm_branch_chalan";
    $subtable= "mlm_branch_chalan_detail";
    $field = "product_id as id,quantity  as qun";
	}
	elseif($type=='purchase')
	{
	$table= "mlm_purchase_chalan";
    $subtable= "mlm_purchase_chalan_detail";
    $field = "product_id as id,quantity  as qun";	
	}
	
	$res = $this->db->query("select $field from $subtable  where chalan_id = '".$chalanno."'")->result_array();
	
	foreach($res as $val)
	{
	$this->db->query("update $updatetable set product_quantity = product_quantity + ".$val['qun']." where id = '".$val['id']."'");
	}
	$this->db->query("delete from $table where chalan_id = '".$chalanno."'");
	$this->db->query("delete from $subtable where chalan_id = '".$chalanno."'");
	redirect("admin/".$redirect);
	}
	
	function deletebillall($id,$apno,$type,$chalanno,$redirect)
	{
	$table = "";
	$subtable = "";
	$updatetable = "tbl_product_inventory";
	if($type=='puc')
	{
	$table= "mlm_puc_chalan";
    $subtable= "mlm_puc_chalan_detail";	
	$field = "product_id as id,quantity  as qun";
	}
	elseif($type=='distributor')
	{
	$table= "mlm_dist_chalan";
    $subtable= "mlm_dist_chalan_detail";
    $field = "product_id as id,quantity  as qun";	
	}
	elseif($type=='branch')
	{
	$table= "mlm_branch_chalan";
    $subtable= "mlm_branch_chalan_detail";
    $field = "product_id as id,quantity  as qun";
	}
	elseif($type=='purchase')
	{
	$table= "mlm_purchase_chalan";
    $subtable= "mlm_purchase_chalan_detail";
    $field = "product_id as id,quantity  as qun";	
	}
	
	$res = $this->db->query("select $field from $subtable  where chalan_id = '".$chalanno."'")->result_array();
	$mobile_no = 7500633111;
	foreach($res as $val)
	{
	//$this->db->query("update $updatetable set product_quantity = product_quantity + ".$val['qun'].",total_quantity = total_quantity + ".$val['qun']." where id = '".$val['id']."'");
	$this->manage_avl_quan_puc_add($apno,$val['id'],$val['qun']);
	}
	$this->sendsmsregister($mobile_no,$chalanno,$id,$apno);
	$this->db->query("delete from $table where chalan_id = '".$chalanno."'");
	$this->db->query("delete from $subtable where chalan_id = '".$chalanno."'");
	redirect("admin/".$redirect);
	}

	public function sendsmsregister($mobile_no,$chalanno,$id,$apno)
	{
	$user='bvmbusinesstxn';                                                         // Here Varible $user Holds Your SMS Panel USERID
	$pass='472722';                                                         // Here Varible $pass Holds Your SMS Panel Password
	$senderid='BVMBUS';        
	
	$msg= "Delete+Bill+No+".urlencode($chalanno)."+Distributor+No+".urlencode($id)."Created+by+".urlencode($apno);

	$link= "http://anysms.in/api.php?username=".$user."&password=".$pass."&sender=".$senderid."&sendto=".$mobile_no."&message=".$msg;  

	// We Creates an API Link .
		//Curl Method Calling
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $link,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	}

	
	function manage_avl_quan_puc_add($appno,$productid,$quantity)
	{
	$this->db->query("update puc_product_details set pucproductquantity = (pucproductquantity+$quantity) where productid = '".$productid."' and applicant_no = '".$appno."'");	
	}
	
	function adddistchalanCGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/addpucchalanIGST');
		}	
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 2;
		$chalanarray['datetime'] = $this->input->post('date');
		$snno = $this->base_model->getserialnoviatypepucdist(1);
		if(empty($snno))
		{
			$snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$chalanarray_1['recid'] =$this->input->post('branch_id1');
		$chalanarray_1['amount'] =$this->input->post('total');
		$chalanarray_1['byid'] =$this->session->userdata('empid');
		$chalanarray_1['paymentby'] ='SaleBill';
		$chalanarray_1['date'] = $this->input->post('date');
		$chalanarray_1['narration'] =$this->input->post('branch_id');
		$chalanarray_1['transtype'] =1;

		$this->db->insert('mlm_dist_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		$this->db->insert('mlm_transaction',$chalanarray_1);
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['cgst'] = $this->input->post('cgst')[$i];
		$chalandetailarray['sgst'] = $this->input->post('sgst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		$chalandetailarray['tax_rate_cgst'] = $this->input->post('tax_rate_cgst')[$i];
		$chalandetailarray['tax_rate_sgst'] = $this->input->post('tax_rate_sgst')[$i];
		
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
		$chalandetailarray['schemeid'] =0;
		$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $chdetail[]=$chalandetailarray;		
		}
		
		$chdetail = $this->addscheme_product($this->input->post('total'),$this->input->post('date'),$chdetail,$lastid,'cgst');
		
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/distchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->view('admin/add-distchalanCGST',$this->data);
	}

	function adddistchalanCGSTNew($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/adddistchalanCGSTNew');
		}	
		
        if($this->input->post('total')<1000)
		{
			$this->session->set_flashdata('success','<font color="red">Bill Amount maximum 1000</font>');
			redirect('admin/adddistchalanCGSTNew');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 6;
		$chalanarray['datetime'] = $this->input->post('date');
		$snno = $this->base_model->getserialnoviatypepucdist(1);
		if(empty($snno))
		{
			$snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$chalanarray_1['recid'] =$this->input->post('branch_id1');
		$chalanarray_1['amount'] =$this->input->post('total');
		$chalanarray_1['byid'] =$this->session->userdata('empid');
		$chalanarray_1['paymentby'] ='SaleBill';
		$chalanarray_1['date'] = $this->input->post('date');
		$chalanarray_1['narration'] =$this->input->post('branch_id');
		$chalanarray_1['transtype'] =1;

		$this->db->insert('mlm_dist_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		$this->db->insert('mlm_transaction',$chalanarray_1);
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['cgst'] = $this->input->post('cgst')[$i];
		$chalandetailarray['sgst'] = $this->input->post('sgst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		$chalandetailarray['tax_rate_cgst'] = $this->input->post('tax_rate_cgst')[$i];
		$chalandetailarray['tax_rate_sgst'] = $this->input->post('tax_rate_sgst')[$i];
		
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
		$chalandetailarray['schemeid'] =0;
		$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $chdetail[]=$chalandetailarray;		
		}
		
		$chdetail = $this->addscheme_productNew($this->input->post('total'),$this->input->post('date'),$chdetail,$lastid,'cgst');
		
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/distchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->view('admin/add-distchalanCGSTNew',$this->data);
	}

	
	function distchalanCGST($chalanid)
	{
        $alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/distchalanCGST';
		$this->view('admin/distchalanCGST',$this->data); 
	}

	
	
	function addpurchasechalanIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['bvmbillno'] =$this->input->post('bvmbillno');
		$chalanarray['bvmnarration'] =$this->input->post('bvmnarration');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['datetime'] = $this->input->post('date');
		$chalanarray['chalantype'] = 1;
			
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_purchase_chalan WHERE role='purchase'");
		
		if($snno[0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else{
			$chalanarray['s_no'] = '1';			
		}

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'purchase';
		$this->db->insert('mlm_purchase_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['igst'] = $this->input->post('igst')[$i];
		$chalandetailarray['tax_rate_igst'] = $this->input->post('tax_rate_igst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		
		
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
		$this->manage_avl_quan1($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_purchase_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/purchasechalanviewIGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'purchase';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-purchasechalan';
		$this->view('admin/add-purchasechalanIGST',$this->data);
	}

	function purchasechalanviewIGST()
	{   $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_purchase_chalan.* from mlm_purchase_chalan where chalantype =1 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/purchasechalanviewIGST';
		$this->view('admin/purchasechalanviewIGST',$this->data); 
	}
	
	function purchasechalanIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_purchase_chalan.* from mlm_purchase_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no where a.role='ledger' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/purchasechalanIGST',$this->data); 
	}
	
    
	function purchasechalanCGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_purchase_chalan.* from mlm_purchase_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_ledger_detail as b on 
		a.applicant_no=b.applicant_no where a.role='ledger' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/purchasechalanCGST',$this->data); 
	}
	
		
	function purchasechalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_purchase_chalan.* from mlm_purchase_chalan where chalantype =2  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/purchasechalanviewCGST';
		$this->view('admin/purchasechalanviewCGST',$this->data); 
	}
	
	function addpurchasechalanCGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['bvmbillno'] =$this->input->post('bvmbillno');
		$chalanarray['bvmnarration'] =$this->input->post('bvmnarration');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 2;
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_purchase_chalan WHERE role='purchase'");
		
		if($snno[0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else{
			$chalanarray['s_no'] = '1';			
		}

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'purchase';
		$this->db->insert('mlm_purchase_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['cgst'] = $this->input->post('cgst')[$i];
		$chalandetailarray['sgst'] = $this->input->post('sgst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		$chalandetailarray['tax_rate_cgst'] = $this->input->post('tax_rate_cgst')[$i];
		$chalandetailarray['tax_rate_sgst'] = $this->input->post('tax_rate_sgst')[$i];
		
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
		$this->manage_avl_quan1($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_purchase_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/purchasechalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->view('admin/add-purchasechalanCGST',$this->data);
	}
	
	function delete_transation(){
            $tId = $_POST['tId'];
            $this->db->where('id', $tId);
            $this->db->delete('mlm_transaction');
        }
	
	function manage_avl_quan1($productid,$quantity)
	{
	$this->db->query("update tbl_product_inventory set product_quantity = (product_quantity+$quantity) where id = $productid");	
	}
	
	
	function addpucchalanIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo']  = $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/addpucchalanIGST');
		}	
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 1;
			
		$chalanarray['datetime'] = $this->input->post('date');
		$snno = $this->base_model->getserialnoviatypepucdist(1);
		if(empty($snno))
		{
		$snno = 1;
		}
		$chalanarray['s_no'] = $snno;
		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'puc';
		$this->db->insert('mlm_puc_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['igst'] = $this->input->post('igst')[$i];
		$chalandetailarray['tax_rate_igst'] = $this->input->post('tax_rate_igst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		
		
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
		$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_puc_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/pucchalanviewIGST');		
		}
		
		$option = array();
		$allMembers = $this->base_model->run_query("select applicant_name, applicant_no from mlm_members_detail");
		foreach($allMembers as $allMember){
			$option[$allMember->applicant_no] = $allMember->applicant_name;
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->data['option'] 		= $option;
		$this->view('admin/add-pucchalanIGST',$this->data);
	}
        
	function manage_avl_quan($productid,$quantity)
	{
	$this->db->query("update tbl_product_inventory set product_quantity = (product_quantity-$quantity) where id = $productid");	
	}
	
	
	
	
	function pucchalanIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/pucchalanIGST',$this->data); 
	}
	
	function pucchalanviewIGST()
	{   $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =1 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/pucchalanviewIGST',$this->data); 
	}

	function subpucchalanviewIGST()
	{     $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =1 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/subpucchalanviewIGST',$this->data); 
	}
	function pucchalanviewCGST()
	{    $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =2 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->view('admin/pucchalanviewCGST',$this->data); 
	}
	
	function subpucchalanviewCGST()
	{   $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =2 and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/subpucchalanviewCGST';
		$this->view('admin/subpucchalanviewCGST',$this->data); 
	}
	function pucledgernew($id='',$member_id='')
	{
	                   
	
		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = date('m');
			$year = date('Y');
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
		//echo "<pre>"; print_r($month); exit;
		  $branchd =  	$this->data['year'];
		  $branchdd = $branchd.'-04-01';
		   $branchpp = '2019-03-31';
		$branchledger = $this->base_model->run_query(
			"select * from ( select 'sale' paymentby ,s_no,branch_id,branch_name,createby,totalwithtax,0 amount,datetime from mlm_dist_chalan where createby='".$member_id."' 
			and datetime >= '".$branchdd."' 
            union all select paymentby,  '' a,recid,name,narration,amount,0,date
            from mlm_transaction 
			where transtype='4' and byid='".$member_id."' and date >= '".$branchdd."' 
			union all select paymentby,  '' a,recid,name,narration,0,amount,date
            from mlm_transaction 
			where transtype='2' and recid1='".$id."' and date >= '".$branchdd."' 
			union all select paymentby,  '' a,recid,name,narration,amount,0,date
            from mlm_transaction 
			where transtype='1' and recid='".$id."' and date >= '".$branchdd."' 
            union all
            select  paymentby,'' a,recid,name,byid,0,amount,date 
            from mlm_transaction where transtype='4' and recid = '".$id."' and date >= '".$branchdd."' 
			union all select  '', '' sno,'' a ,'Opening Balance' b ,'Opening Balance' f,ifnull(opening_balance,0) ,'' d ,'".$branchdd."'  e
	        from mlm_puc_detail where applicant_no= '".$id."' )v1 order by datetime
 ");
			$this->data['branchledger'] 	= $branchledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/branchledger';
			$this->view('admin/pucnewledger',$this->data); 
		}


		function creditlimit($id='',$member_id=''){

			$sale = $this->base_model->creditlimitpuc($id,$member_id)	;
			
		}


	function branchledger2018($id='',$member_id='')
	{
	                   
	
		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = date('m');
			$year = date('Y');
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
		//echo "<pre>"; print_r($month); exit;
		  $branchd =  	$this->data['year'];
		  $branchdd = $branchd.'-04-01';
		   $branchpp = '2019-03-31';
		$branchledger = $this->base_model->run_query(
			"select * from ( select s_no,branch_id,branch_name,createby,totalwithtax as totaldp,0 amount,datetime from mlm_dist_chalan where createby='".$member_id."' 
			and datetime >= '".$branchdd."' and datetime < '2019-04-01'
            union all select  '' a,recid,name,narration,amount,0,date
            from mlm_transaction 
			where transtype='4' and byid='".$member_id."' and date >= '".$branchdd."' and date < '2019-04-01'
            union all
            select  '' a,recid,name,narration,0,amount,date 
            from mlm_transaction where transtype='4' and recid = '".$id."' and date >= '".$branchdd."' and date < '2019-04-01'
			union all select  '' sno,'' a ,'Opening Balance' b ,'Opening Balance' f,ifnull(opening_balance,0) ,'' d ,'".$branchdd."'  e
	        from mlm_branch_detail where applicant_no= '".$id."' )v1 order by datetime
 ");
			$this->data['branchledger'] 	= $branchledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/branchledger';
			$this->view('admin/branchledger',$this->data); 
		}
		
		
		function branchledger($id='',$member_id='')
{
	
	if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = date('m');
			$year = date('Y');
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
		//echo "<pre>"; print_r($month); exit;
		  $branchd =  	$this->data['year'];
		  $branchdd = $branchd.'-04-01';
		   $branchpp = '2019-03-31';

		$branchledger = $this->base_model->run_query("select * from ( select s_no,branch_id,branch_name,createby,totalwithtax as totaldp,0 amount,datetime from mlm_dist_chalan where createby='".$member_id."' 
			and datetime >= '".$branchdd."' 
            union all select  '' a,recid,name,narration,amount,0,date
            from mlm_transaction 
			where transtype='4' and byid='".$member_id."' and date >= '".$branchdd."' 
            union all
            select  '' a,recid,name,narration,0,amount,date 
            from mlm_transaction where transtype='4' and recid = '".$id."' and date >= '".$branchdd."' 
			union all select  '' sno,'' a ,'Opening Balance' b ,'Opening Balance' f,ifnull(Opening_balance_2019,0) ,'' d ,'".$branchdd."'  e
	        from mlm_branch_detail where applicant_no= '".$id."' )v1 order by datetime ");
			$this->data['branchledger'] 	= $branchledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/branchledger';
			$this->view('admin/branchledger',$this->data); 
			
}
		function subadminledger($id='',$member_id='')
		{
						   
		
			if(isset($_POST['month']) && isset($_POST['year'])){
				$month = $_POST['month'];
				$year = $_POST['year'];
			}else{
				$month = date('m');
				$year = date('Y');
			}
		
			$this->data['month'] = $month;
			$this->data['year'] = $year;
			//echo "<pre>"; print_r($month); exit;
			$branchledger = $this->base_model->run_query(
				"select * from ( select s_no,branch_id,branch_name,createby,totaldp,0 amount,datetime from mlm_dist_chalan where createby='".$member_id."' 
				and datetime >= '2018-04-01 10:50:41' 
				union all select  '' a,recid,name,narration,amount,0,date
				from mlm_transaction 
				where transtype='4' and byid='".$member_id."' and date >= '2018-04-01' and recid>100000
				union all
				select  '' a,recid,name,narration,0,amount,date 
				from mlm_transaction where transtype='4' and recid = '".$id."' and date >= '2018-04-01'
				union all select  '' sno,'' a ,'Opening Balance' b ,'Opening Balance' f,ifnull(opening_balance,0) ,'' d ,'2018-04-01'  e
				from mlm_branch_detail where applicant_no= '".$id."' )v1 order by datetime
	 ");
				$this->data['branchledger'] 	= $branchledger;
				$this->data['title'] 				= 'DP List';		
				$this->data['active_menu'] 			= 'admin';
				$this->data['content'] 				= 'admin/branchledger';
				$this->view('admin/branchledger',$this->data); 
			}
	


 function closingbalance($id=''){
	$op = $this->base_model->run_query(
		"select ifnull(opening_balance_quantity,0) openingbalance from mlm_members_detail where applicant_no= '".$id."'");
		$trans = $this->base_model->run_query(
			"select sum(amount) amount from mlm_transaction where  transtype='1' and recid='".$id."'");

			$bonus = $this->base_model->run_query(
				"select sum(amount) amount from mlm_transaction where  transtype='2' and recid1= '".$id."'");
				$payment = $this->base_model->run_query(
					"select sum(total) total from mlm_bonus where applicant_no='".$id."'");
				$recv =	 $this->base_model->run_query("select sum(amount)  total from mlm_transaction 
				where  transtype='4' and recid= '".$id."'  and byid in(7,8460)");

					$genral = $this->base_model->run_query(
				"select sum(amount) amount from mlm_transaction where  transtype='2' and recid= '".$id."'");
			
			
				
				
			return $closingBalance = ($op[0]->openingbalance +$payment[0]->total +$bonus[0]->amount+$recv[0]->total)-($trans[0]->amount + $genral[0]->amount); 
	
			
	                         

 }
 
 function listz()
	{
		$alluser = $this->base_model->run_query(
							"SELECT *,(CASE WHEN transtype = 1 THEN 'Payment'
WHEN transtype = 2 THEN 'General'
WHEN transtype = 3 THEN 'Contra'
WHEN transtype = 4 THEN 'Receive'
ELSE ''
END)Type FROM mlm_transaction where byid in(7,8460)");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/list';
		$this->view('admin/list',$this->data); 
	}
	public function finalbonus1()
	{
		
	
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
	
		$bounuslist = $this->base_model->run_query(
		"select sum(mlm_bonus.total) total,mlm_members_detail.opening_balance_quantity openingbalance,mlm_bonus.PreviousBalance, 
		mlm_bonus.home_bonus,mlm_bonus.tour_bonus,mlm_bonus.stop_car_bonus,sbv Balance,
		mobile_no,panno,mlm_bank_detail.bank_name as bank_name, bank_accno,bank_ifsc_code,
		mlm_members_detail.applicant_no,mlm_members_detail.applicant_name 
		from mlm_members_detail left join mlm_bank_detail on mlm_bank_detail.bank_id = mlm_members_detail.bank_name
		left join mlm_bonus on mlm_bonus.applicant_no = mlm_members_detail.applicant_no 
		  GROUP BY mlm_bonus.applicant_no order by bank_accno desc
		    ");
	

		$this->data['bounuslist'] 	= $bounuslist;
		foreach($bounuslist as $key => $user){
			$PreviousBalance =  $this->closingbalance($user->applicant_no);
			if($PreviousBalance<100){
				unset($this->data['bounuslist'][$key]);
			}else{
				$this->data['bounuslist'][$key]->PreviousBalance = $PreviousBalance;
				$this->data['bounuslist'][$key]->previous_tds = $this->get_previous_tds($user->applicant_no, $month, $year);
			}
		}
		// $this->data['selfbv'] 	= $query1;
	
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/bonuslist';
		$this->view('admin/finalbonus1',$this->data); 
	}

		
public function finalbonus()
	{
		
	
		if(isset($_POST['month']) && isset($_POST['year']) ){
			$month = $_POST['month'];
			$year = $_POST['year'];
			
		}else{
			$month = date('m');
			$year = date('Y');
		
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
	
	
		$bounuslist = $this->base_model->run_query(
		"select sum(mlm_bonus.total) total,mlm_members_detail.opening_balance_quantity openingbalance,mlm_bonus.PreviousBalance, 
		mlm_bonus.home_bonus,mlm_bonus.tour_bonus,mlm_bonus.stop_car_bonus,sbv Balance,
		mobile_no,panno,mlm_bank_detail.bank_name as bank_name, bank_accno,bank_ifsc_code,
		mlm_members_detail.applicant_no,mlm_members_detail.applicant_name 
		from mlm_members_detail left join mlm_bank_detail on mlm_bank_detail.bank_id = mlm_members_detail.bank_name
		left join mlm_bonus on mlm_bonus.applicant_no = mlm_members_detail.applicant_no 
		  GROUP BY mlm_bonus.applicant_no order by bank_accno desc
		    ");
	

		$this->data['bounuslist'] 	= $bounuslist;
		foreach($bounuslist as $key => $user){
			$PreviousBalance =  $this->closingbalance($user->applicant_no);
			if($PreviousBalance<100){
				unset($this->data['bounuslist'][$key]);
			}else{
				$this->data['bounuslist'][$key]->PreviousBalance = $PreviousBalance;
				$this->data['bounuslist'][$key]->previous_tds = $this->get_previous_tds($user->applicant_no, $month, $year);
				$this->data['bounuslist'][$key]->gen_bal = $this->get_genralbal($user->applicant_no);
			}
		}
		// $this->data['selfbv'] 	= $query1;
	
		$this->data['title'] 				= 'DP List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/bonuslist';
		$this->view('admin/finalbonus',$this->data); 
	}
	
	function get_previous_tds($applicant_no, $month, $year){ 
		$previous_tds = $this->base_model->run_query(
					"SELECT  sum(amount) amount FROM `mlm_transaction` WHERE `recid1` in(89855,52249) and `recid` = '".$applicant_no."'");
		
		if(!empty($previous_tds)){			 
			return $previous_tds[0]->amount;
		}else{
			return 0;
		}
	}
	function get_genralbal($applicant_no){ 
		$gen_bal = $this->base_model->run_query(
					"SELECT sum(amount) amount FROM `mlm_transaction` WHERE  transtype =2 and recid1  = '".$applicant_no."'");
		
		if(!empty($gen_bal)){			 
			return $gen_bal[0]->amount;
		}else{
			return 0;
		}
	}
	

	function distributorledger($id='')
	{

		
		$distributorledger = $this->base_model->run_query(
			"select * from (
				select applicant_no,total,0 payment,narration,date
								from mlm_bonus where applicant_no='".$id."' 
				UNION ALL
			select recid1,amount,0 total,narration,date 
				from mlm_transaction where  transtype='2' and recid1= '".$id."' 
					  UNION ALL
			select recid,0 total, amount,narration,date
				from mlm_transaction where  transtype='2' and recid= '".$id."' 
				UNION ALL
				select recid,amount as total,0 payment,narration,date from mlm_transaction 
				where  transtype='4' and recid= '".$id."'  and byid in(7,8460)
			union all
			select recid,0 total,amount,narration,date from mlm_transaction 
			where  transtype='1' and recid= '".$id."' 
			union all
			 select  'Opening Balance' f,ifnull(opening_balance_quantity,0) ,0 d,'Opening Balance' e,'' g 
						from mlm_members_detail where applicant_no= '".$id."'  )v1 order by date;");
	
			$this->data['distributorledger'] 	= $distributorledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/distributorledger';
		
			$this->view('admin/distributorledger',$this->data); 
		}


		function bank2ledger()
	{

		$bank2ledger = $this->base_model->run_query(
			"select * from( select recid,amount,0 payment,date,narration from mlm_transaction where transtype=4 and paymentby='bank' and bank=2
			UNION ALL select recid,0 payement, amount,date,narration from mlm_transaction where transtype=1  and bank=2 and paymentby='bank'
			UNION ALL select 'contra' recid,0 payement, amount,date,narration from mlm_transaction where transtype=3  and bank=2 and bankto=3 and paymentby='bank2bank'
			UNION ALL select 'contra' recid,amount ,0 payment,date,narration from mlm_transaction where transtype=3  and bank=3 and bankto=2 and paymentby='bank2bank'
			UNION ALL select 'contra' recid,0 payement, amount,date,narration from mlm_transaction where transtype=3  and bank=2  and paymentby='cash'
			UNION ALL select 'contra' recid,amount ,0 payment,date,narration from mlm_transaction where transtype=3 and bank=2   and paymentby='bank'
			UNION ALL
              select  'Opening Balance' f,179724.33  ,0 d,'2018-04-01' g,'Opening Balance' e)v1 order by date;");
			$this->data['bank2ledger'] 	= $bank2ledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/bank2ledger';
			$this->view('admin/bank2ledger',$this->data); 
		}

		function bankledger()
	{

		
		$bank2ledger = $this->base_model->run_query(
			"select * from( select recid,amount,0 payment,date,narration from mlm_transaction where transtype=4 and paymentby='bank' and bank=3
			UNION ALL select recid,0 payement, amount,date,narration from mlm_transaction where transtype=1  and bank=3 and paymentby='bank'
			UNION ALL select 'contra' recid,0 payement, amount,date,narration from mlm_transaction where transtype=3  and bank=3 and bankto=2 and paymentby='bank2bank'
			UNION ALL select 'contra' recid,amount ,0 payment,date,narration from mlm_transaction where transtype=3  and bank=2 and bankto=3 and paymentby='bank2bank'
			UNION ALL select 'contra' recid,0 payement, amount,date,narration from mlm_transaction where transtype=3  and bank=3  and paymentby='cash'
			UNION ALL select 'contra' recid,amount ,0 payment,date,narration from mlm_transaction where transtype=3 and bank=3   and paymentby='bank'
			UNION ALL
              select  'Opening Balance' f,25000  ,0 d,'2018-04-01' g,'Opening Balance' e)v1 order by date;");
	
			$this->data['bank2ledger'] 	= $bank2ledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/bank2ledger';
		
			$this->view('admin/bankledger',$this->data); 
		}

		function cashledger()
	{

		
		$bank2ledger = $this->base_model->run_query(
			"select * from( select recid,amount,0 payment,date,narration from mlm_transaction where transtype=4 and paymentby='cash' and byid in(7,8460)
			UNION ALL select recid,0 payement, amount,date,narration from mlm_transaction where transtype=1  and paymentby='cash' and byid in(7,8460)
			UNION ALL select 'contra' recid,amount,0 payement,date,narration from mlm_transaction where transtype=3    and paymentby='cash' and byid in(7,8460)
			UNION ALL select 'contra' recid ,0 payment,amount,date,narration from mlm_transaction where transtype=3    and paymentby='bank' and byid in(7,8460)
			UNION ALL
              select  'Opening Balance' f,4317  ,0 d,'2018-04-01' g,'Opening Balance' e)v1  order by date;");
	
			$this->data['bank2ledger'] 	= $bank2ledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/bank2ledger';
		
			$this->view('admin/cashledger',$this->data); 
		}

		

			function leaderledger($id='')
			{
		
				if(isset($_POST['month']) && isset($_POST['year'])){
					$month = $_POST['month'];
					$year = $_POST['year'];
				}else{
					$month = date('m');
					$year = date('Y');
				}
			
				$this->data['month'] = $month;
				$this->data['year'] = $year;
				//echo "<pre>"; print_r($month); exit;
				$leaderledger = $this->base_model->run_query(
					"select * from (
						select '' v,s_no,branch_id,branch_name,createby,0 totaldp,totaldp as amount,datetime from mlm_purchase_chalan where branch_id='".$id."' and datetime >= '2018-04-01 10:50:41'
						union all
						select paymentby v,'' a,recid,name,narration,0,amount,date from mlm_transaction 
						where  transtype='4' and recid='".$id."' and date >= '2018-04-01' 
						union all
						select paymentby v,'' a,recid,name,narration,0 totaldp, amount,date from mlm_transaction 
						where  transtype='2' and recid1='".$id."' and date >= '2018-04-01' 
						union all
						select paymentby v,'' a,recid,name,narration,amount as totaldp,0 amount,date from mlm_transaction 
						where  transtype='2' and recid='".$id."' and date >= '2018-04-01'  
						UNION ALL
						select paymentby v,'' a,recid,name,narration,amount,0, date from mlm_transaction where  transtype='1' and recid='".$id."' and date >= '2018-04-01' 
							union all
							select '' v,'' s,'' a ,'Opening Balance' b ,'Opening Balance' f,'' c ,opening_balance ,'2018-04-01'  e FROM mlm_ledger_detail where applicant_no ='".$id."'    ) v1 order by datetime
			
		 ");
			
					$this->data['leaderledger'] 	= $leaderledger;
					$this->data['title'] 				= 'DP List';		
					$this->data['active_menu'] 			= 'admin';
					$this->data['content'] 				= 'admin/leaderledger';
				
					$this->view('admin/leaderledger',$this->data); 
				}


	function pucledger($id='')
	{

		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = date('m');
			$year = date('Y');
		}
	
		$this->data['month'] = $month;
		$this->data['year'] = $year;
		//echo "<pre>"; print_r($month); exit;
		$pucledger = $this->base_model->run_query(
			"select * from (
select s_no,branch_id,branch_name,createby,totaldp,0 amount,datetime from mlm_puc_chalan where Branch_id='".$id."' and datetime >= '2018-04-01 10:50:41'
union all
select '' a,recid,name,narration,0,amount,date from mlm_transaction 
where  transtype='4' and recid='".$id."' and date >= '2018-04-01'
union all select  '' a,recid,name,narration,amount,0,date
            from mlm_transaction 
			where transtype='1' and recid='".$id."' and date >= '2018-04-01' 
union all
select '' s,'' a ,'Opening Balance' b ,'Opening Balance' f,0 c ,'' d ,'2018-04-01'  e   ) v1 order by datetime;
 ");
	
			$this->data['pucledger'] 	= $pucledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/pucledger';
		
			$this->view('admin/pucledger',$this->data); 
		}
	function addpucchalanCGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/addpucchalanCGST');
		}	
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 2;
		$chalanarray['datetime'] = $this->input->post('date');
		//date('Y-m-d H:i:s')
		$snno = $this->base_model->getserialnoviatypepucdist(1);
		if(empty($snno))
		{
			$snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'puc';
		$chalanarray_1['recid'] =$this->input->post('branch_id1');
		$chalanarray_1['amount'] =$this->input->post('total');
		$chalanarray_1['byid'] =$this->session->userdata('empid');
		$chalanarray_1['paymentby'] ='SaleBill';
		$chalanarray_1['date'] = $this->input->post('date');
		$chalanarray_1['narration'] =$this->input->post('branch_id');
		$chalanarray_1['transtype'] =1;
		
		$this->db->insert('mlm_puc_chalan',$chalanarray);
	

		$lastid =$this->db->insert_id();
		$this->db->insert('mlm_transaction',$chalanarray_1);
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['cgst'] = $this->input->post('cgst')[$i];
		$chalandetailarray['sgst'] = $this->input->post('sgst')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		$chalandetailarray['tax_rate_cgst'] = $this->input->post('tax_rate_cgst')[$i];
		$chalandetailarray['tax_rate_sgst'] = $this->input->post('tax_rate_sgst')[$i];
		
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
		$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_puc_chalan_detail',$chdetail);
		
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/pucchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->view('admin/add-pucchalanCGST',$this->data);
	}
    
    
	//$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
	function pucchalanCGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/pucchalanCGST';
		$this->view('admin/pucchalanCGST',$this->data); 
	}
	

	//Add Transfer To Branch
	function addttb($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/addpucchalanIGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['datetime'] = $this->input->post('date');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_branch_chalan WHERE role='branch' and date(datetime)>='2018-04-01'");
		
		if($snno[ 0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else{
			$chalanarray['s_no'] = '1';			
		}

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'branch';
		$this->db->insert('mlm_branch_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_branch_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/branchchalanlist');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Branch';
		$this->data['active_menu'] 	= 'Transfer';
		$this->data['content'] 		= 'admin/add-ttb';
		$this->view('admin/add-ttb',$this->data);
	}
    
	function branchchalanview($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_branch_chalan.* from mlm_branch_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no where a.role='branch' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/chalanview',$this->data); 
	}
	
	function branchchalanlist()
	{
		$alluser = $this->base_model->run_query(
		"select mlm_branch_chalan.* from mlm_branch_chalan");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/branchchalanlist';
		$this->view('admin/branchchalanlist',$this->data); 
	}

	//Add Transfer To Depo
	function addttd($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity); 	
		}		
		
		if($this->input->post('save')==true)
	    {
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_branch_chalan WHERE role='depo'");
		
		if($snno[0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else{
			$chalanarray['s_no'] = '1';			
		}

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'depo';
		$this->db->insert('mlm_branch_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];	
        $chdetail[]=$chalandetailarray;		
		}

		$this->db->insert_batch('mlm_branch_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/depochalanlist');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Depo';
		$this->data['active_menu'] 	= 'Transfer';
		$this->data['content'] 		= 'admin/add-ttd';
		$this->view('admin/add-ttd',$this->data);
	}

	function depochalanview($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_branch_chalan.* from mlm_branch_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no where a.role='branch' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Depo List';
		$this->data['active_menu'] 	= 'Depo List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/chalanview',$this->data); 
	}
	
	function depochalanlist()
	{
		$alluser = $this->base_model->run_query(
		"select mlm_branch_chalan.* from mlm_branch_chalan where role='depo'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Depo List';
		$this->data['active_menu'] 	= 'Depo List';
		$this->data['content'] 		= 'admin/depochalanlist';
		$this->view('admin/depochalanlist',$this->data); 
	}

	//Add Transaction Payment
	function addtp()
	{
		$this->data['banks'] = $this->base_model->getBank();
		if($this->input->post('save')==true)
	    {
		$trans['recid'] =$this->input->post('branch_id');
		$trans['name'] =$this->input->post('bvmbranchname');
		$trans['paymentby'] =$this->input->post('paymentby');
		$trans['byid'] =$this->session->userdata('empid');
		$trans['narration'] =$this->input->post('narration');
		$trans['amount'] =$this->input->post('amount');
		$trans['date'] =$this->input->post('date');
		$trans['transtype'] =1;
		//$trans['ledamount'] =$this->input->post('ledgerlimit');
		
		if($this->input->post('paymentby')=='bank')
        {
		$trans['bank'] =$this->input->post('banks');
        }
        elseif($this->input->post('paymentby')=='cheque')
        {
        
		$trans['chqno'] =$this->input->post('chequeno');
		$trans['transno'] =$this->input->post('transactionno');
        }	
       
		$this->db->insert('mlm_transaction',$trans);
		$this->session->set_flashdata('success','<font color="#05BD14">successfully created...</font>');
        redirect('admin/addtp');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Transaction Payment';
		$this->data['active_menu'] 	= 'Transaction';
		$this->data['content'] 		= 'admin/add-tp';
		$this->view('admin/add-tp',$this->data);
	}

	//Add Transaction Received
	function addtr()
	{
		$this->data['banks'] = $this->base_model->getBank();
		if($this->input->post('save')==true)
	    {
		$trans['recid'] =$this->input->post('branch_id');
		$trans['name'] =$this->input->post('bvmbranchname');
		$trans['paymentby'] =$this->input->post('paymentby');
		$trans['byid'] =$this->session->userdata('empid');
		$trans['narration'] =$this->input->post('narration');
		$trans['amount'] =$this->input->post('amount');
		$trans['transtype'] =4;
		$trans['date'] =$this->input->post('date');
		//$trans['ledamount'] =$this->input->post('ledgerlimit');
		if($this->input->post('paymentby')=='bank')
        {
		$trans['bank'] =$this->input->post('banks');
        }
        elseif($this->input->post('paymentby')=='cheque')
        {
        
		$trans['chqno'] =$this->input->post('chequeno');
		$trans['transno'] =$this->input->post('transactionno');
        }	
		$this->db->insert('mlm_transaction',$trans);
		$this->session->set_flashdata('success','<font color="#05BD14">successfully created...</font>');
        redirect('admin/addtr');		
		}
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Transaction Received';
		$this->data['active_menu'] 	= 'Transaction';
		$this->data['content'] 		= 'admin/add-tr';
		$this->view('admin/add-tr',$this->data);
	}

	//Add Transaction General
	function addtg()
	{
		$this->data['banks'] = $this->base_model->getBank();
		if($this->input->post('save')==true)
	    {
		$trans['recid'] =$this->input->post('branch_id');
		$trans['name'] =$this->input->post('bvmbranchname');
		$trans['recid1'] =$this->input->post('branch_id1');
		$trans['name1'] =$this->input->post('bvmbranchname1');
		$trans['byid'] =$this->session->userdata('empid');
		$trans['narration'] =$this->input->post('narration');
		$trans['amount'] =$this->input->post('amount');
		$trans['date'] =$this->input->post('date');
		//$trans['ledamount'] =$this->input->post('ledgerlimit');
		//$trans['ledamount1'] =$this->input->post('ledgerlimit1');
		$trans['transtype'] =2;
		$this->db->insert('mlm_transaction',$trans);
		$this->session->set_flashdata('success','<font color="#05BD14">successfully created...</font>');
        redirect('admin/addtg');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Transaction General';
		$this->data['active_menu'] 	= 'Transaction';
		$this->data['content'] 		= 'admin/add-tg';
		$this->view('admin/add-tg',$this->data);
	}

	
	function adddistchalanwithouttaxIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where product_quantity > 0");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$pro->product_quantity,'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('admin/addpucchalanIGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 3;
			
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_dist_chalan WHERE role='member' and chalantype='3' and billfromtype='1'");
		
		if($snno[0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else
		{
		$chalanarray['s_no'] = '1';			
		}

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$this->db->insert('mlm_dist_chalan',$chalanarray);
		$lastid =$this->db->insert_id();
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
		$chalandetailarray['chalan_id'] = $lastid;
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['total'] = $this->input->post('taxpricetotal')[$i];
     
		
		$chalandetailarray['hcn_no'] = $this->input->post('hcn_no')[$i];
		$chalandetailarray['batch_no'] = $this->input->post('batch_no')[$i];
		$chalandetailarray['m_date'] = $this->input->post('manufacturer_date')[$i];
		$chalandetailarray['expire_date'] = $this->input->post('expiry_date')[$i];
		$chalandetailarray['size'] = $this->input->post('packaging_size')[$i];
		
        $chalandetailarray['bv'] = $this->input->post('product_bv')[$i];
        $chalandetailarray['dp'] = $this->input->post('product_dp')[$i];
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
        $chalandetailarray['rate'] = $this->input->post('product_rate')[$i];
        $chalandetailarray['product_total'] = $this->input->post('product_total')[$i];
		$chalandetailarray['schemeid'] =0;
        $this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$chdetail = $this->addscheme_product($this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'');
		
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('admin/distchalanviewwithouttaxIGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->view('admin/add-distchalanwithouttaxIGST',$this->data);
	}
    
	
	function distchalanwithouttaxIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->view('admin/distchalanwithouttaxIGST',$this->data); 
	}
	
	function distchalanviewwithouttaxIGST()
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype = 3");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/distchalanviewwithouttaxIGST',$this->data); 

	}

	function subdistchalanviewwithouttaxIGST()
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype = 3");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->view('admin/subdistchalanviewwithouttaxIGST',$this->data); 
	}

	function TotalStock()
	{
		$cond='';
		if($this->input->post('search')==true)
		{
		$searchdata=array();
        if($this->input->post('from_date')!='' and $this->input->post('to_date')!='')
		{
        $searchdata[] = 'date(opening_date) >='."'".date('Y-m-d',strtotime($this->input->post('from_date')))."'".' and date(opening_date) <='."'".date('Y-m-d',strtotime($this->input->post('to_date')))."'";
		}
       
        $cond =" where ".implode(' and ',$searchdata);
		}
		$allstock = $this->base_model->run_query(
		"SELECT product_name,id,total_quantity,product_dp,(SELECT sum(`quantity`) FROM mlm_purchase_chalan join `mlm_purchase_chalan_detail` on mlm_purchase_chalan.chalan_id=mlm_purchase_chalan_detail.chalan_id WHERE  `product_id` = tbl_product_inventory.id and mlm_purchase_chalan.datetime>='2019-04-01') as receive FROM `tbl_product_inventory` $cond");
		$this->data['allstock'] 		=  $allstock;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'All Bill List';
		$this->data['content'] 		= 'admin/TotalStock';
		$this->view('admin/TotalStock',$this->data); 
	}
	
	function TotalStock2018()
	{
		$cond='';
		if($this->input->post('search')==true)
		{
		$searchdata=array();
        if($this->input->post('from_date')!='' and $this->input->post('to_date')!='')
		{
        $searchdata[] = 'date(opening_date) >='."'".date('Y-m-d',strtotime($this->input->post('from_date')))."'".' and date(opening_date) <='."'".date('Y-m-d',strtotime($this->input->post('to_date')))."'";
		}
       
        $cond =" where ".implode(' and ',$searchdata);
		}
		$allstock = $this->base_model->run_query(
		"SELECT product_name,id,total_quantity,product_dp,(SELECT sum(`quantity`) FROM mlm_purchase_chalan join `mlm_purchase_chalan_detail` on mlm_purchase_chalan.chalan_id=mlm_purchase_chalan_detail.chalan_id WHERE  `product_id` = tbl_product_inventory_old.id and mlm_purchase_chalan.datetime<'2019-04-01') as receive FROM `tbl_product_inventory_old` $cond");
		$this->data['allstock'] 		=  $allstock;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'All Bill List';
		$this->data['content'] 		= 'admin/TotalStock';
		$this->view('admin/TotalStock',$this->data); 
	}
	
	function Serialwiseview()
	{
	$cond='';
		if($this->input->post('search')==true)
		{
		$searchdata=array();
		if($this->input->post('apno')!='')
		{
        $searchdata[] = "branch_id ='".$this->input->post('apno')."'";
		}
		if($this->input->post('serial_no')!='')
		{
        $searchdata[] = "s_no ='".trim($this->input->post('serial_no'))."'";
		}
		if($this->input->post('type')!='')
		{
        $searchdata[] = "chalantype ='".trim($this->input->post('type'))."'";
		}
        if($this->input->post('from_date')!='' and $this->input->post('to_date')!='')
		{
        $searchdata[] = 'date(datetime) >='."'".date('Y-m-d',strtotime($this->input->post('from_date')))."'".' and date(datetime) <='."'".date('Y-m-d',strtotime($this->input->post('to_date')))."'";
		}
       
        $cond =" and ".implode(' and ',$searchdata);
	
		}
    
	
    $alluser = $this->base_model->getserialwisedata(1,$cond);
    $this->data['alluser'] 		=  $alluser;		
	$this->data['title'] 		= 'Bill List';
	$this->data['active_menu'] 	= 'All Bill List';
	$this->data['content'] 		= 'admin/Serialwiseview';
	$this->view('admin/Serialwiseview',$this->data); 
	}

	//Add Transaction Contra
	function addtc()
	{
		$this->data['banks'] = $this->base_model->getBank();
		
		if($this->input->post('save')==true)
	    {
		$trans['recid'] =$this->input->post('branch_id');
		$trans['name'] =$this->input->post('bvmbranchname');
		$trans['date'] =$this->input->post('date');
		$trans['byid'] =$this->session->userdata('empid');
		$trans['narration'] =$this->input->post('narration');
		$trans['amount'] =$this->input->post('amount');
		//$trans['ledamount'] =$this->input->post('ledgerlimit');
		//$trans['ledamount1'] =$this->input->post('ledgerlimit1');
		if($this->input->post('paymentby')=='btb')
        {
		$trans['bank'] =$this->input->post('banks');
		$trans['bankto'] =$this->input->post('banks1');
		$trans['paymentby'] ='bank2bank';
        
		}
        elseif($this->input->post('paymentby')=='btc')
        {
		$trans['bank'] =$this->input->post('banks');
		$trans['paymentby'] ='cash';
		}	
		elseif($this->input->post('paymentby')=='ctb')
        {
		$trans['bank'] =$this->input->post('banks');
		$trans['paymentby'] ='bank';
		}	
       
		
		$trans['transtype'] =3;
		$this->db->insert('mlm_transaction',$trans);
		$this->session->set_flashdata('success','<font color="#05BD14">successfully created...</font>');
        redirect('admin/addtc');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Transaction Contra';
		$this->data['active_menu'] 	= 'Transaction';
		$this->data['content'] 		= 'admin/add-tc';
		$this->view('admin/add-tc',$this->data);
	}

	//View All Categorie
	function category()
	{
		$Allcategory = $this->base_model->run_query(
		"select * from tbl_category");
		$this->data['Allcategory'] 	= $Allcategory;		
		$this->data['title'] 		= 'category';
		$this->data['active_menu'] 	= 'category';
		$this->data['content'] 		= 'admin/category';
		$this->view('admin/category',$this->data); 
	}

	//Add Classes
	function addcategory($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;

		if($this->input->post('category_update')=='Submit')
		{
			$this->form_validation->set_rules('category_name', 'Category Name', 'required');			
			if($this->form_validation->run() == true)
			{		
				
				$data['category_name'] 			= $this->input->post('category_name');				
				$data['status'] 				= 'Active';

				//File Upload Process start
						$config = array(
						'upload_path' => "./categoryimage/",
						'allowed_types' => "gif|jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
						);

						$this->load->library('upload', $config);
						$this->upload->do_upload('category_image');
						$temp = $this->upload->data();

						$image['category_image']=$temp['file_name'];

						$data['category_image'] = $image['category_image'];
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_category')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Category successfully created...</font>');
				return redirect('admin/addcategory/',$this->data);
			}
		}

		if($this->input->post('category_update')=='Update')
		{
				
			$data['category_name'] 			= $this->input->post('category_name');

			//Category Photo Upload Process Start
					$image 						= $_FILES['category_image']['name'];

					if($image['category_image']=='')
					{
						
						$this->session->set_flashdata('success','All Information successfully Updated');
					}
					elseif($image['category_image']!='')
					{

						//Upload User Photo
							if (!empty($image)) {	
							$where['id'] 						= $this->uri->segment(3);
								$r = $this->base_model->run_query(
								'select category_image from '.$this->db->dbprefix('tbl_category')
								.' where id ="'.$where['id'].'"'
								);
								if (count($r) > 0) {
								
								if (file_exists('categoryimage/'.$r[0]->category_image)) {
										unlink('categoryimage/'.$r[0]->category_image);
									}						
								}					
								
								$ext = explode('.',$image);
								
								$img = $ext[0]."".$where['id'].".".$ext[1];
								
								$data['category_image'] = $img;
								move_uploaded_file(
								$_FILES['category_image']['tmp_name'], 
								'categoryimage/'.$img
								);								
							}
					}			
					//Slider Photo Upload Process End		

			$where['id'] 		= $this->uri->segment(3);

			$this->base_model->update_operation($data,$this->db->dbprefix('tbl_category'),$where);
			$this->session->set_flashdata('success','<font color="#05BD14">Category successfully Updated....</font>');
			return redirect('admin/category',$this->data);
		}

		$this->data['title'] 		= 'Category';
		
		$this->data['active_menu'] 	= 'category';
		$this->data['content'] 		= 'admin/add-category';
		
		$this->view('admin/add-category',$this->data);
	}

	//Delete Class
	function deleteCategory()
	{	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_category'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Category successfully Deleted....</font>');
			return redirect('admin/category/',$this->data);
		}
	}

	//View All Plan
	function plan()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		//Data For Active Users
		$Allplan = $this->base_model->run_query(
		"select * from tbl_plan");
		
		$this->data['plan'] = $this->base_model->getCategory();
		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allplan'] 		= $Allplan;
		
		$this->data['title'] 		= 'plan';
		
		$this->data['active_menu'] 	= 'plan';
		$this->data['content'] 		= 'admin/plan';
		
		$this->view('admin/plan',$this->data);
	}

	//Add Plan
	function addplan($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		$viewplaninfo = $this->base_model->run_query(
		"select * from tbl_plan where id ='".$id."'");
		$this->data['viewplaninfo'] 	= $viewplaninfo;

		if($this->input->post('plan_update')=='Submit')
		{
			$this->form_validation->set_rules('plan_name', 'Plan Name', 'required');

			if ($this->form_validation->run() == true)
			{	
				
				$data['plan_name'] 			= $this->input->post('plan_name');
				$data['plan_persent'] 		= $this->input->post('plan_persent');
				$data['status'] 			= 'Active';
       		
						//File Upload Process start
						$config = array(
						'upload_path' => "./planimage/",
						'allowed_types' => "gif|jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
						);

						$this->load->library('upload', $config);
						$this->upload->do_upload('plan_image');
						$temp = $this->upload->data();

						$image['plan_image']=$temp['file_name'];

						$data['plan_image'] = $image['plan_image'];
			       		
					 //step for Insert
						$this->base_model->insert_operation(
									$data,
									$this->db->dbprefix('tbl_plan')
									);
						$this->session->set_flashdata('success','<font color="#05BD14">Plan successfully created...</font>');
						return redirect('admin/addplan/',$this->data);
			}
		}
		if($this->input->post('plan_update')=='Update')
		{			
				$data['plan_name'] 			= $this->input->post('plan_name');
				$data['plan_persent'] 			= $this->input->post('plan_persent');
			
				//Slider Photo Upload Process Start
					$image 						= $_FILES['plan_image']['name'];

					if($image['plan_image']=='')
					{
						
						$this->session->set_flashdata('success','All Information successfully Updated');
					}
					elseif($image['plan_image']!='')
					{

						//Upload User Photo
							if (!empty($image)) {	
							$where['id'] 	= $this->uri->segment(3);
								$r = $this->base_model->run_query(
								'select plan_image from '.$this->db->dbprefix('tbl_plan')
								.' where id ="'.$where['id'].'"'
								);
								if (count($r) > 0) {
								
									if (file_exists('planimage/'.$r[0]->plan_image)) {
										unlink('planimage/'.$r[0]->plan_image);
									}						
								}					
								
								$ext = explode('.',$image);
								
								$img = $ext[0]."".$where['id'].".".$ext[1];
								
								$data['plan_image'] = $img;
								move_uploaded_file(
								$_FILES['plan_image']['tmp_name'], 
								'planimage/'.$img
								);								
							}
					}			
					//Slider Photo Upload Process End				
					$where['id'] 	= $this->uri->segment(3);					
					
	$this->base_model->update_operation($data,$this->db->dbprefix('tbl_plan'),$where);
					
					$this->session->set_flashdata('success','<font color="#05BD14">Plan successfully Updated....</font>');
					return redirect('admin/plan/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 		= 'Plan';		
		$this->data['active_menu'] 	= 'plan';
		$this->data['content'] 		= 'admin/add-plan';
		$this->view('admin/add-plan',$this->data);
	}

	//Delete Plan
	function deletePlan()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_plan'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Plan successfully Deleted....</font>');
			return redirect('admin/plan/',$this->data);
		}
	}

	//View All Product
	function product()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		//Data For Active Users
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product");
		
		$this->data['product'] = $this->base_model->getCategory();
		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allproduct'] 	= $Allproduct;
		
		$this->data['title'] 		= 'product';
		
		$this->data['active_menu'] 	= 'product';
		$this->data['content'] 		= 'admin/product';
		
		$this->view('admin/product',$this->data);
	}

	//Add Product
	function addproduct($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$viewproductinfo = $this->base_model->run_query(
		"select * from tbl_product where id ='".$id."'");
		$this->data['viewproductinfo'] 	= $viewproductinfo;
		
		$this->data['category'] = $this->base_model->getCategory();

		if($this->input->post('product_update')=='Submit')
		{
			$this->form_validation->set_rules('product_name', 'Product Name', 'required');
			$this->form_validation->set_rules('category', 'Category Name', 'required');			
			if ($this->form_validation->run() == true)
			{	
				
				$data['product_name'] 			= $this->input->post('product_name');
				$data['category_id'] 			= $this->input->post('category');
				$data['product_bv'] 			= $this->input->post('product_bv');
				$data['product_dp'] 			= $this->input->post('product_dp');
				$data['product_rp'] 			= $this->input->post('product_rp');
				$data['product_price'] 			= $this->input->post('product_price');
				$data['product_desc'] 			= $this->input->post('product_desc');
				$data['status'] 				= 'Active';
       		
						//File Upload Process start
						$config = array(
						'upload_path' => "./productimage/",
						'allowed_types' => "gif|jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
						);

						$this->load->library('upload', $config);
						$this->upload->do_upload('product_image');
						$temp = $this->upload->data();

						$image['product_image']=$temp['file_name'];

						$data['product_image'] = $image['product_image'];
			       		
					 //step for Insert
						$this->base_model->insert_operation(
									$data,
									$this->db->dbprefix('tbl_product')
									);
						$this->session->set_flashdata('success','<font color="#05BD14">Product successfully created...</font>');
						return redirect('admin/addproduct/',$this->data);
			}
		}
		if($this->input->post('product_update')=='Update')
		{			
				$data['product_name'] 			= $this->input->post('product_name');
				$data['category_id'] 			= $this->input->post('category');
				$data['product_bv'] 			= $this->input->post('product_bv');
				$data['product_dp'] 			= $this->input->post('product_dp');
				$data['product_rp'] 			= $this->input->post('product_rp');
				$data['product_price'] 			= $this->input->post('product_price');
				$data['product_desc'] 			= $this->input->post('product_desc');
			
				//Slider Photo Upload Process Start
					$image 						= $_FILES['product_image']['name'];

					if($image['product_image']=='')
					{
						
						$this->session->set_flashdata('success','All Information successfully Updated');
					}
					elseif($image['product_image']!='')
					{

						//Upload User Photo
							if (!empty($image)) {	
							$where['id'] 						= $this->uri->segment(3);
								$r = $this->base_model->run_query(
								'select product_image from '.$this->db->dbprefix('tbl_product')
								.' where id ="'.$where['id'].'"'
								);
								if (count($r) > 0) {
								
									if (file_exists('productimage/'.$r[0]->product_image)) {
										unlink('productimage/'.$r[0]->product_image);
									}						
								}					
								
								$ext = explode('.',$image);
								
								$img = $ext[0]."".$where['id'].".".$ext[1];
								
								$data['product_image'] = $img;
								move_uploaded_file(
								$_FILES['product_image']['tmp_name'], 
								'productimage/'.$img
								);								
							}
					}			
					//Slider Photo Upload Process End				
					$where['id'] 						= $this->uri->segment(3);					
					
					$this->base_model->update_operation($data,$this->db->dbprefix('tbl_product'),$where);

					
					$this->session->set_flashdata('success','<font color="#05BD14">Product successfully Updated....</font>');
					return redirect('admin/product/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 		= 'Product';
		
		$this->data['active_menu'] 	= 'product';
		$this->data['content'] 		= 'admin/add-product';
		$this->view('admin/add-product',$this->data);
	}
	
	//Delete Section
	function deleteProduct()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) 
		{
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_product_inventory'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Product successfully Deleted....</font>');
			return redirect('admin/product/',$this->data);
		}
	}

	//View All achivers
	function achivers()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		//Data For Active Users
		$Allachivers = $this->base_model->run_query(
		"select * from tbl_achivers");
		
		$this->data['plan'] = $this->base_model->getCategory();
		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allachivers'] 	= $Allachivers;
		
		$this->data['title'] 		= 'achivers';
		
		$this->data['active_menu'] 	= 'achivers';
		$this->data['content'] 		= 'admin/achivers';
		
		$this->view('admin/achivers',$this->data);
	}

	//Add achivers
	function addachivers($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		$viewachiversinfo = $this->base_model->run_query(
		"select * from tbl_achivers where id ='".$id."'");
		$this->data['viewachiversinfo'] 	= $viewachiversinfo;

		if($this->input->post('achivers_update')=='Submit')
		{
		$this->form_validation->set_rules('achivers_name', 'Achivers Name', 'required');

			if ($this->form_validation->run() == true)
			{	
				
				$data['achivers_name'] 			= $this->input->post('achivers_name');
				if($this->input->post('achivers_level')=="universaldiamond")
				{
					$data['seq'] = 1;
				}
				if($this->input->post('achivers_level')=="starcrowndiamond")
				{
					$data['seq'] = 2;
				}
				if($this->input->post('achivers_level')=="crowndiamond")
				{
					$data['seq'] = 3;
				}
				if($this->input->post('achivers_level')=="stardiamond")
				{
					$data['seq'] = 4;
				}
				if($this->input->post('achivers_level')=="diamond")
				{
					$data['seq'] = 5;
				}
				if($this->input->post('achivers_level')=="opalleader")
				{
					$data['seq'] = 6;
				}
				if($this->input->post('achivers_level')=="starplatinumleader")
				{
					$data['seq'] = 7;
				}
				if($this->input->post('achivers_level')=="platinumleader")
				{
					$data['seq'] = 8;
				}
				if($this->input->post('achivers_level')=="stargoldleader")
				{
					$data['seq'] = 9;
				}
				if($this->input->post('achivers_level')=="goldleader")
				{
					$data['seq'] = 10;
				}
				$data['achivers_level'] 		= $this->input->post('achivers_level');
				$data['message'] 				= $this->input->post('message');
       		
						//File Upload Process start
						$config = array(
						'upload_path' => "./achiversimage/",
						'allowed_types' => "gif|jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
						);

						$this->load->library('upload', $config);
						$this->upload->do_upload('achivers_image');
						$temp = $this->upload->data();

						$image['achivers_image']=$temp['file_name'];

						$data['achivers_image'] = $image['achivers_image'];
			       		
					 //step for Insert
						$this->base_model->insert_operation(
									$data,
									$this->db->dbprefix('tbl_achivers')
									);
						$this->session->set_flashdata('success','<font color="#05BD14">Achivers successfully created...</font>');
						return redirect('admin/addachivers/',$this->data);
			}
		}
		if($this->input->post('achivers_update')=='Update')
		{			
				$data['achivers_name'] 			= $this->input->post('achivers_name');
				if($this->input->post('achivers_level')=="universaldiamond")
				{
					$data['seq'] = 1;
				}
				if($this->input->post('achivers_level')=="starcrowndiamond")
				{
					$data['seq'] = 2;
				}
				if($this->input->post('achivers_level')=="crowndiamond")
				{
					$data['seq'] = 3;
				}
				if($this->input->post('achivers_level')=="stardiamond")
				{
					$data['seq'] = 4;
				}
				if($this->input->post('achivers_level')=="diamond")
				{
					$data['seq'] = 5;
				}
				if($this->input->post('achivers_level')=="opalleader")
				{
					$data['seq'] = 6;
				}
				if($this->input->post('achivers_level')=="starplatinumleader")
				{
					$data['seq'] = 7;
				}
				if($this->input->post('achivers_level')=="platinumleader")
				{
					$data['seq'] = 8;
				}
				if($this->input->post('achivers_level')=="stargoldleader")
				{
					$data['seq'] = 9;
				}
				if($this->input->post('achivers_level')=="goldleader")
				{
					$data['seq'] = 10;
				}
				$data['achivers_level'] 		= $this->input->post('achivers_level');
				$data['message'] 				= $this->input->post('message');
			
				//Slider Photo Upload Process Start
					$image 						= $_FILES['achivers_image']['name'];

					if($image['achivers_image']=='')
					{
						
						$this->session->set_flashdata('success','All Information successfully Updated');
					}
					elseif($image['achivers_image']!='')
					{

						//Upload User Photo
							if (!empty($image)) {	
							$where['id'] 	= $this->uri->segment(3);
							$r = $this->base_model->run_query(
								'select achivers_image from '.$this->db->dbprefix('tbl_achivers')
								.' where id ="'.$where['id'].'"'
								);
								if (count($r) > 0) {
								
								if (file_exists('achiversimage/'.$r[0]->achivers_image)) {
										unlink('achiversimage/'.$r[0]->achivers_image);
									}						
								}					
								
								$ext = explode('.',$image);
								
								$img = $ext[0]."".$where['id'].".".$ext[1];
								
								$data['achivers_image'] = $img;
								move_uploaded_file(
								$_FILES['achivers_image']['tmp_name'], 
								'achiversimage/'.$img
								);								
							}
					}			
					//Slider Photo Upload Process End				
					$where['id'] 	= $this->uri->segment(3);					
					
	$this->base_model->update_operation($data,$this->db->dbprefix('tbl_achivers'),$where);
					
					$this->session->set_flashdata('success','<font color="#05BD14">Achivers successfully Updated....</font>');
					return redirect('admin/achivers/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 		= 'Achivers';		
		$this->data['active_menu'] 	= 'achivers';
		$this->data['content'] 		= 'admin/add-achivers';
		$this->view('admin/add-achivers',$this->data);
	}

	//View All Seminars
	function seminar()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		//Data For Active Users
		$Allseminar = $this->base_model->run_query(
		"select * from tbl_seminar");
		
		$this->data['state'] = $this->base_model->getStateByCountry();

		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allseminar'] 		= $Allseminar;
		
		$this->data['title'] 		= 'seminar';
		
		$this->data['active_menu'] 	= 'seminar';
		$this->data['content'] 		= 'admin/seminar';
		
		$this->view('admin/seminar',$this->data);
	}

	//Add Seminar
	function addseminar($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		$viewseminarinfo = $this->base_model->run_query(
		"select * from tbl_seminar where id ='".$id."'");

		$this->data['viewseminarinfo'] 	= $viewseminarinfo;
		
		$this->data['state'] = $this->base_model->getStateByCountry();

		if($this->input->post('seminar_update')=='Submit')
		{
			$this->form_validation->set_rules('seminar_date', 'Seminar Date', 'required');
			$this->form_validation->set_rules('seminar_time', 'Seminar Time', 'required');			
			if ($this->form_validation->run() == true)
			{	
				
				$data['seminar_date'] 			= $this->input->post('seminar_date');
				$data['seminar_time'] 			= $this->input->post('seminar_time');
				$data['state'] 					= $this->input->post('state');
				$data['city'] 					= $this->input->post('city');
				$data['venue'] 					= $this->input->post('venue');
				$data['leader'] 				= $this->input->post('leader');
				$data['seminar_type'] 			= $this->input->post('seminar_type');
				$data['contact'] 				= $this->input->post('contact');
				$data['status'] 				= 'Active';
       		
						
			       		
					 //step for Insert
						$this->base_model->insert_operation(
									$data,
									$this->db->dbprefix('tbl_seminar')
									);
						$this->session->set_flashdata('success','<font color="#05BD14">Seminar successfully created...</font>');
						return redirect('admin/addseminar/',$this->data);
			}
		}
		if($this->input->post('seminar_update')=='Update')
		{			
				$data['seminar_date'] 			= $this->input->post('seminar_date');
				$data['seminar_time'] 			= $this->input->post('seminar_time');
				$data['state'] 					= $this->input->post('state');
				$data['city'] 					= $this->input->post('city');
				$data['venue'] 					= $this->input->post('venue');
				$data['leader'] 				= $this->input->post('leader');
				$data['seminar_type'] 			= $this->input->post('seminar_type');
				$data['contact'] 				= $this->input->post('contact');
							
								
					$where['id'] 						= $this->uri->segment(3);
					
					$this->base_model->update_operation($data,$this->db->dbprefix('tbl_seminar'),$where);

					
					$this->session->set_flashdata('success','<font color="#05BD14">Seminar successfully Updated....</font>');
					return redirect('admin/seminar/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 		= 'Seminar';
		
		$this->data['active_menu'] 	= 'seminar';
		$this->data['content'] 		= 'admin/add-seminar';
		$this->view('admin/add-seminar',$this->data);
	}

	//View All Contact List
	function contact()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");

		//Data For Active Users
		$Allcontact = $this->base_model->run_query(
		"select * from tbl_contact");
		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allcontact'] 	= $Allcontact;
		
		$this->data['title'] 		= 'contact';
		
		$this->data['active_menu'] 	= 'contact';
		$this->data['content'] 		= 'admin/contact';
		
		$this->view('admin/contact',$this->data);
	}

	//Delete Contact
	function deleteContact()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_contact'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Contact successfully Deleted....</font>');
			return redirect('admin/contact/',$this->data);
		}
	}

	//View All Inventory Product
	function inventoryproduct()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		//Data For Active Users
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory ");
		
		$this->data['product'] = $this->base_model->getCategory();
		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allproduct'] 	= $Allproduct;
		
		$this->data['title'] 		= 'inventoryproduct';
		
		$this->data['active_menu'] 	= 'inventoryproduct';
		$this->data['content'] 		= 'admin/inventoryproduct';
		
		$this->view('admin/inventoryproduct',$this->data);
	}

	//Add Product Inventory
	function addinventoryproduct($id=FALSE)
	{    
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$viewproductinfo = $this->base_model->run_query(
		"select * from tbl_product_inventory where id ='".$id."'");
		$this->data['viewproductinfo'] 	= $viewproductinfo;
		
		$this->data['category'] = $this->base_model->getCategory();
		$this->data['tax'] = $this->base_model->getTaxrate();

		if($this->input->post('product_update')=='Submit')
		{
			$this->form_validation->set_rules('product_name', 'Product Name', 'required');
			$this->form_validation->set_rules('category', 'Category Name', 'required');			
			if ($this->form_validation->run() == true)
			{	
				$data['category_id'] 			= $this->input->post('category');
				$data['hcn_no'] 				= $this->input->post('hcn_no');
				$data['batch_no'] 				= $this->input->post('batch_no');
				$data['manufacturer_date'] 		= $this->input->post('manufacturer_date');
				$data['expiry_date'] 			= $this->input->post('expiry_date');
				$data['packaging_size'] 		= $this->input->post('packaging_size');
				$data['total_taxIGST'] 			= $this->input->post('total_taxIGST');
				$data['center_taxCGST'] 		= $this->input->post('center_taxCGST');
				$data['state_taxSGST'] 			= $this->input->post('state_taxSGST');
			    $data['product_db_taxprice'] 	= $this->input->post('product_db_taxprice');

				$data['product_code'] 			= $this->input->post('product_code');
				$data['product_name'] 			= $this->input->post('product_name');
				$data['product_quantity'] 		= $this->input->post('product_quantity');
				$data['total_quantity'] 		= $this->input->post('product_quantity');
				$data['opening_date'] 			= $this->input->post('opening_date');
				
				$data['product_mrp_price'] 		= $this->input->post('product_mrp_price');
				$data['product_bv'] 			= $this->input->post('product_bv');
				$data['tex_rate'] 				= $this->input->post('tex_rate');
				$data['product_dp'] 			= $this->input->post('product_dp');
				$data['product_rp'] 			= $this->input->post('product_rp');
				$data['proposer_income'] 		= $this->input->post('proposer_income');
				
				$data['status'] 				= 'Active';
       		
						//File Upload Process start
						$config = array(
						'upload_path' => "./productimage/",
						'allowed_types' => "gif|jpg|png|jpeg",
						'overwrite' => TRUE,
						'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
						);

						$this->load->library('upload', $config);
						$this->upload->do_upload('product_image');
						$temp = $this->upload->data();

						$image['product_image']=$temp['file_name'];

						$data['product_image'] = $image['product_image'];
			       		
					 //step for Insert
						$this->base_model->insert_operation(
									$data,
									$this->db->dbprefix('tbl_product_inventory')
									);
						$this->session->set_flashdata('success','<font color="#05BD14">Product successfully created...</font>');
						return redirect('admin/inventoryproduct/',$this->data);
			}
		}
		if($this->input->post('product_update')=='Update')
		{			
				$data['category_id'] 			= $this->input->post('category');
				$data['hcn_no'] 				= $this->input->post('hcn_no');
				$data['batch_no'] 				= $this->input->post('batch_no');
				$data['manufacturer_date'] 		= $this->input->post('manufacturer_date');
				$data['expiry_date'] 			= $this->input->post('expiry_date');
				$data['packaging_size'] 		= $this->input->post('packaging_size');
				$data['total_taxIGST'] 			= $this->input->post('total_taxIGST');
				$data['center_taxCGST'] 		= $this->input->post('center_taxCGST');
				$data['state_taxSGST'] 			= $this->input->post('state_taxSGST');
				$data['product_db_taxprice'] 	= $this->input->post('product_db_taxprice');

				$data['product_code'] 			= $this->input->post('product_code');
				$data['product_name'] 			= $this->input->post('product_name');
				$data['product_quantity'] 		= $this->input->post('product_quantity');
				echo $data['total_quantity'] 		= $this->input->post('total_quantity');
				$data['opening_date'] 			= $this->input->post('opening_date');
			
				$data['product_mrp_price'] 		= $this->input->post('product_mrp_price');
				$data['product_bv'] 			= $this->input->post('product_bv');
				$data['tex_rate'] 				= $this->input->post('tex_rate');
				$data['product_dp'] 			= $this->input->post('product_dp');
				$data['product_rp'] 			= $this->input->post('product_rp');
				$data['proposer_income'] 		= $this->input->post('proposer_income');
				if($this->input->post('total_quantity') < $this->input->post('total_quantity1'))
				{
				$dif = $this->input->post('total_quantity1')-$this->input->post('total_quantity');
				$data['product_quantity'] 		= $this->input->post('product_quantity')-$dif;
				}
				if($this->input->post('total_quantity') > $this->input->post('total_quantity1'))
				{
				$add = $this->input->post('total_quantity')-$this->input->post('total_quantity1');
				$data['product_quantity'] 		= $this->input->post('product_quantity')+$add;
				}

				
				//Slider Photo Upload Process Start
				$image 	= $_FILES['product_image']['name'];
					

					if($image['product_image']=='')
					{
						
						$this->session->set_flashdata('success','All Information successfully Updated');
					}
					elseif($image['product_image']!='')
					{

						//Upload User Photo
							if (!empty($image)) {	
							$where['id'] = $this->uri->segment(3);
								$r = $this->base_model->run_query(
								'select product_image from '.$this->db->dbprefix('tbl_product_inventory')
								.' where id ="'.$where['id'].'"'
								);
								if (count($r) > 0) {
								
									if (file_exists('productimage/'.$r[0]->product_image)) {
										unlink('productimage/'.$r[0]->product_image);
									}						
								}					
								
								$ext = explode('.',$image);
								
								$img = $ext[0]."".$where['id'].".".$ext[1];
								
								$data['product_image'] = $img;
								move_uploaded_file(
								$_FILES['product_image']['tmp_name'], 
								'productimage/'.$img
								);								
							}
					}			
					//Slider Photo Upload Process End				
					$where['id'] 						= $this->uri->segment(3);					
					
					$this->base_model->update_operation($data,$this->db->dbprefix('tbl_product_inventory'),$where);

					
					$this->session->set_flashdata('success','<font color="#05BD14">Product successfully Updated....</font>');
					return redirect('admin/inventoryproduct/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		$this->data['title'] 		= 'Inventory Product';
		
		$this->data['active_menu'] 	= 'Inventory Product';
		$this->data['content'] 		= 'admin/add-inventory-product';
		$this->view('admin/add-inventory-product',$this->data);
	}
	
	//View All Subject
	function subject()
	{		
		$Allsubject = $this->base_model->run_query(
		"select * from tbl_subject");
		$this->data['class'] = $this->base_model->getClass();
		$this->data['Allsubject'] 	= $Allsubject;
		$this->data['title'] 		= 'subject';
		$this->data['active_menu'] 	= 'subject';
		$this->data['content'] 		= 'admin/subject';
		$this->view('admin/subject',$this->data); 
	}
	//Add Subject
	function addsubject($id=FALSE)
	{
		$id = $this->uri->segment(3);	
		$viewsubjectinfo = $this->base_model->run_query(
		"select * from tbl_subject where id ='".$id."'");
		$this->data['viewsubjectinfo'] 	= $viewsubjectinfo;
		$this->data['session'] = $this->base_model->getSession();
		$this->data['class'] = $this->base_model->getClass();
		if(isset($_POST['subject_update'])=='')
		{
			$this->form_validation->set_rules('class', 'Class Name', 'required');
			$this->form_validation->set_rules('subject_name', 'Subject', 'required');
			if ($this->form_validation->run() == true)
			{	
				$data['class_id'] 			= $this->input->post('class');
				$data['subject_name'] 			= $this->input->post('subject_name');
				$data['priority'] 				= $this->input->post('priority');
				$data['description'] 			= $this->input->post('description');
				$data['status'] 				= 'Active';
			 //step for Insert
				$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('tbl_subject')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Subject successfully created...</font>');
				return redirect('admin/addsubject/',$this->data);
			}
		}
		else{
				$data['class_id'] 			= $this->input->post('class');
				$data['subject_name'] 			= $this->input->post('subject_name');
				$data['priority'] 				= $this->input->post('priority');
				$data['description'] 			= $this->input->post('description');
			
					$data['status'] 			= 'Active';
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_subject'), 
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Subject successfully Updated....</font>');
					return redirect('admin/addsubject/',$this->data);
		}
		$this->data['title'] 		= 'Subject';
		$this->data['active_menu'] 	= 'subject';
		$this->data['content'] 		= 'admin/add-subject';
		$this->view('admin/add-subject',$this->data);
	}
	
	//Delete Subject
	function deleteSubject()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_subject'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Subject successfully Deleted....</font>');
			return redirect('admin/subject/',$this->data);
		}
	}
	//View All Assign Subject
	function assignsubjectdetails()
	{
		$Allassignsubject = $this->base_model->run_query(
		"select * from tbl_assignsubject");
		$this->data['class'] = $this->base_model->getClass();
		$this->data['subject'] = $this->base_model->getSubject();
		
		$this->data['teacher'] = $this->base_model->getTeacher();
		
		$this->data['Allassignsubject'] 	= $Allassignsubject;
		$this->data['title'] 		= 'assignsubject';
		$this->data['active_menu'] 	= 'assignsubject';
		$this->data['content'] 		= 'admin/assignsubjectdetails';
		$this->view('admin/assignsubjectdetails',$this->data); 
	}	
		//Add Assign Subject
	function addassignsubject($id=FALSE)
	{
		$id = $this->uri->segment(3);
		
		$viewassignsubjectinfo = $this->base_model->run_query(
		"select * from tbl_subject where id ='".$id."'");
		//print_r($viewassignsubjectinfo);
		//exit();
		$this->data['viewassignsubjectinfo'] 	= $viewassignsubjectinfo;		
		$this->data['teacher'] = $this->base_model->getTeacher();
		if(isset($_POST['assignsubject_update'])=='')
		{
			$this->form_validation->set_rules('catid', 'Class Name', 'required');
			$this->form_validation->set_rules('subjectid', 'Subject', 'required');
			$this->form_validation->set_rules('teacher', 'Subject', 'required');
			if ($this->form_validation->run() == true)
			{	
				$data['class_id'] 			= $this->input->post('catid');
				$data['subject_id'] 			= $this->input->post('subjectid');
				$data['teacher_id'] 			= $this->input->post('teacher');
				$data['status'] 				= 'Active';				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_assignsubject')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Assign Subject successfully Set...</font>');
				return redirect('admin/addassignsubject/',$this->data);
			}
		}
		else{
				$data['class_id'] 			= $this->input->post('catid');
				$data['subject_id'] 		= $this->input->post('subjectid');
				$data['teacher_id'] 		= $this->input->post('teacher');
				$data['status'] 			= 'Active';
				$where['id'] 				= $this->uri->segment(3);
			
					$this->base_model->update_operation($data,$this->db->dbprefix('tbl_assignsubject'),$where);
					$this->session->set_flashdata('success','<font color="#05BD14">Assign Subject successfully Updated....</font>');
					return redirect('admin/addassignsubject/',$this->data);
		}
		//Options for Classes
		$catOptions['']='Select Class';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('tbl_class')
		);
		foreach ($catRecords as $key=>$val) {
		    $catOptions[$val->id]	= $val->class_name;
		}
		$this->data['class'] 		= $catOptions;
		$this->data['title'] 		= 'Subject';
		
		$this->data['active_menu'] 	= 'subject';
		$this->data['content'] 		= 'admin/assign-subject';
		
		$this->view('admin/assign-subject',$this->data);
	}
	//Fetch Subject for catid
	function getSubject()
	{
		$id 	= $this->input->post('catid');
		$sub 	= mysql_query("select id,subject_name from ".$this->db->dbprefix('tbl_subject')." where class_id=".$id);
		if(mysql_num_rows($sub)>0)
		{
		while($row=mysql_fetch_array($sub))
		{
		$data[] = $row['id']."_".$row['subject_name'];
		}
     	echo json_encode($data); 
		}
		else
		{
		echo "error";
		}
	}
	//View All Slider
	function slider()
	{
		//Data For Active Users
		$Allslider = $this->base_model->run_query(
		"select * from tbl_slider");		
		$this->data['Allslider'] 	= $Allslider;
		$this->data['title'] 		= 'Slider';
		$this->data['active_menu'] 	= 'Slider';
		$this->data['content'] 		= 'admin/slider';
		$this->view('admin/slider',$this->data);
	}
	
	
	
	
	//Add Holiday
	function addslider($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewsliderinfo = $this->base_model->run_query(
		"select * from tbl_slider where id ='".$id."'");
		$this->data['viewsliderinfo'] 	= $viewsliderinfo;
		
		if($this->input->post('slider_update')=='Submit')
		{
			
			//File Upload Process start
			$config = array(
			'upload_path' => "./sliderimage/",
			'allowed_types' => "gif|jpg|png|jpeg",
			'overwrite' => TRUE,
			'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
			);

			$this->load->library('upload', $config);
			$this->upload->do_upload('slider');
			$temp = $this->upload->data();
			
       		$image['slider']=$temp['file_name'];

       		if($image['slider']!='')
				{
					$sliderimage =array('slider_image'=>$image['slider'],'price'=> $this->input->post('price'),'status'=>'Active');
				
				$this->session->set_flashdata('success','Image Sucessfully Inserted');
			 //step for Insert
			$this->base_model->insert_operation($sliderimage,$this->db->dbprefix('tbl_slider'));
			$this->session->set_flashdata('success','<font color="#05BD14">Slider successfully created...</font>');
				return redirect('admin/addslider/',$this->data);
				}			
		}

		if($this->input->post('slider_update')=='Update'){
						
					$where['id'] 		= $this->uri->segment(3);
					$data['price']			= $this->input->post('price');

					//Slider Photo Upload Process Start
					$image 						= $_FILES['slider']['name'];

					if($image['slider']=='')
					{
						
						$this->session->set_flashdata('success','All Information successfully Updated');
					}
					elseif($image['slider']!='')
					{

						//Upload User Photo
							if (!empty($image)) {	
							$where['id'] 						= $this->uri->segment(3);
								$r = $this->base_model->run_query(
								'select slider_image from '.$this->db->dbprefix('tbl_slider')
								.' where id ="'.$where['id'].'"'
								);
								if (count($r) > 0) {
								
									if (file_exists('sliderimage/'.$r[0]->slider_image)) {
										unlink('sliderimage/'.$r[0]->slider_image);
									}						
								}					
								
								$ext = explode('.',$image);
								
								$img = $ext[0]."".$where['id'].".".$ext[1];
								
								$data['slider_image'] = $img;
								move_uploaded_file(
								$_FILES['slider']['tmp_name'], 
								'sliderimage/'.$img
								);								
							}
					}			
					//Slider Photo Upload Process End				
					$where['id'] 						= $this->uri->segment(3);					
					
					$this->base_model->update_operation($data,$this->db->dbprefix('tbl_slider'),$where);
					$this->session->set_flashdata('success','<font color="#05BD14">Slider successfully Updated....</font>');
					return redirect('admin/addslider/',$this->data);
					}
		
		$this->data['title'] 		= 'Slider';
		$this->data['active_menu'] 	= 'slider';
		$this->data['content'] 		= 'admin/add-slider';
		$this->view('admin/add-slider',$this->data);
	}	
	//Delete Holiday
	function deleteSlider()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_slider'), 
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Slider successfully Deleted....</font>');
					return redirect('admin/slider/',$this->data);
		}
	
	}
	
	//View All Fee
	function fee()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		//Data For Active Users
		$Allfee = $this->base_model->run_query(
		"select * from tbl_fee");
		
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['Allfee'] 		= $Allfee;
		
		$this->data['title'] 		= 'fee';
		
		$this->data['active_menu'] 	= 'fee';
		$this->data['content'] 		= 'admin/fee';
		
		$this->view('admin/fee',$this->data);
	}
	
	//Add Fee
	function addfee($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$viewfeeinfo = $this->base_model->run_query(
		"select * from tbl_fee where id ='".$id."'");
		
		$this->data['viewfeeinfo'] 	= $viewfeeinfo;
		$this->data['session'] = $this->base_model->getSession();
		$this->data['class'] = $this->base_model->getClass();
		
		$this->data['coaching'] = $this->base_model->getCoaching();
		if(isset($_POST['fee_update'])=='')
		{
			$this->form_validation->set_rules('class', 'Class Name', 'required');
			$this->form_validation->set_rules('session', 'Session', 'required');
			
			$this->form_validation->set_rules('coaching', 'Coaching', 'required');
			if ($this->form_validation->run() == true)
			{	
				$data['acedmic_session'] 		= $this->input->post('session');
				$data['class_name'] 			= $this->input->post('class');
				$data['coaching_name'] 			= $this->input->post('coaching');
				$data['tution_amount'] 			= $this->input->post('tution_amount');
				
				$data['transfer_amount'] 		= $this->input->post('transfer_amount');
				
				$data['membarship_cardfee'] 	= $this->input->post('membarship_cardfee');
				$data['status'] 				= 'Active';
				
				//step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_fee')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Fee successfully created...</font>');
				return redirect('admin/addfee/',$this->data);
			}
		}
		else{
				$data['acedmic_session'] 		= $this->input->post('session');
				$data['class_name'] 			= $this->input->post('class');
				$data['coaching_name'] 			= $this->input->post('coaching');
				$data['tution_amount'] 			= $this->input->post('tution_amount');
			
				$data['transfer_amount'] 		= $this->input->post('transfer_amount');
				
				$data['membarship_cardfee'] 	= $this->input->post('membarship_cardfee');
					$data['status'] 			= 'Active';	
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_fee'), 
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Fee successfully Updated....</font>');
					return redirect('admin/addfee/',$this->data);
		}
		$this->data['userinfo'] 	= $userinfo;
		
		$this->data['title'] 		= 'Fee';
		$this->data['active_menu'] 	= 'fee';
		$this->data['content'] 		= 'admin/add-fee';
		$this->view('admin/add-fee',$this->data);
	}
	
	//Delete Fee
	function deleteFee()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_fee'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Fee successfully Deleted....</font>');
					return redirect('admin/fee/',$this->data);
		}
	}
	
	function massupload()
	{
		$this->data['title'] 		= 'massupload';
		$this->data['active_menu'] 	= 'massupload';
		$this->data['content'] 		= 'admin/massupload';
		$this->view('admin/massupload',$this->data); 
	}
	
	//Read Excel Format Questions and Insert into DB
	function readattendanceexcel()
	{
		
		include(FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');
		$inputFileName 					= $_FILES['attendancefile']['tmp_name'];
		$objReader 						= new PHPExcel_Reader_Excel5();
		$objPHPExcel 					= $objReader->load($inputFileName);

		echo '<hr />';
		$sheetData 						= $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$i								= 0;
		$j= 0;
		$data 							= array();
		$datas                          = array(); 
		$valid 							= 1;
		foreach ($sheetData as $r) {
			if ($i++ != 0) {			
			    if ($valid == 1) {
					$data[$j] = array(
										'Stdid' 					=> $r['A'], 
										'password' 					=> $r['B'],
										'admission_date' 			=> $r['C'],
										'student_class' 			=> $r['D'],
										'section_name' 				=> $r['E'],
										'FirstName' 				=> $r['F'],
										'LastName' 					=> $r['G'],
										'addmission_no' 			=> $r['H'],
										'emailid' 					=> $r['I'],
										'board_regno' 				=> $r['J'],
										'dob' 						=> $r['K'],
										'gender' 					=> $r['L'],
										'blood_group' 				=> $r['M'],
										'residence_phone' 			=> $r['N'],
										'father_mobile' 			=> $r['O'],
										'cast_category' 			=> $r['P'],
										'country' 					=> $r['Q'],
										'communication_address' 	=> $r['R'],
										'city' 						=> $r['S'],	
										'father_name' 				=> $r['T'],	
										'father_emailid' 			=> $r['U'],	
										'father_mobile' 			=> $r['V'],
										'father_qualification' 		=> $r['W'],
										'father_desigination' 		=> $r['X'],
										'father_profession' 		=> $r['Y'],
										'father_officecontactno' 	=> $r['Z'],
										'father_annual_income' 		=> $r['AA'],	
										'mother_name' 				=> $r['AB'],	
										'mother_mobile' 			=> $r['AC'],	
										'mother_officeaddress' 		=> $r['AD'],	
										'mother_officecontactno' 	=> $r['AE'],	
										'mother_annual_income' 		=> $r['AF'],
										'pickup_bus_stop' 			=> $r['AG'],
										'pickup_bus_route' 			=> $r['AH'],
										'drop_bus_stop' 			=> $r['AI'],
										'drop_bus_route' 			=> $r['AJ'],
										'religion' 					=> $r['AK'],
										'is_transport' 				=> $r['AL'],
										'mother_salutation' 		=> $r['AM'],
										'father_salutation' 		=> $r['AN'],
										'subject' 					=> $r['AO'],
										'fee_applicable_date' 		=> $r['AP'],
										'weight' 					=> $r['AQ'],
										'height' 					=> $r['AR'],
										'visionL' 					=> $r['AS'],
										'visionR' 					=> $r['AT'],
										'dental' 					=> $r['AU'],
										'adharcard_no' 				=> $r['AV'],
										'brothers' 					=> $r['AW'],
										'sisters' 					=> $r['AX'],
										'student_status' 			=> $r['AY'],
										'remarks' 					=> $r['AZ']										
										);

					$class = $this->base_model->run_query(
		"select * from tbl_class where class_name = '".$data[$j]['student_class']."'");

$section = $this->base_model->run_query(
		"select * from tbl_section where section_name = '".$data[$j]['section_name']."'");

$country = $this->base_model->run_query(
		"select * from tbl_country where country_name = '".$data[$j]['country']."'");

$city = $this->base_model->run_query(
		"select * from tbl_city where city_name = '".$data[$j]['city']."'");

$status = $this->base_model->run_query(
		"select * from tbl_status where status_name = '".$data[$j]['student_status']."'");

	$subject = explode(',', $data[$j]['subject']);

	$getsubjectid = '';

	for($i=0; $i<count($subject);$i++) {
		$getsubject = $this->base_model->run_query(
			"select * from tbl_subject where subject_name = '".$subject[$i]."'");

		$getsubjectid .= $getsubject[0]->id.',';
	}

				$student_class = $class[0]->id;
				$section_name = $section[0]->id;
				$country_name = $country[0]->country_id;
				$city_name = $city[0]->id;
				$status_name = $status[0]->id;
				$setsubject =  rtrim($getsubjectid,',');
		
	$datas[$j] = array(
										'Stdid' 					=> $r['A'], 
										'password' 					=> $r['B'],
										'admission_date' 			=> $r['C'],
										'student_class' 			=> $student_class,
										'section_name' 				=> $section_name,
										'FirstName' 				=> $r['F'],
										'LastName' 					=> $r['G'],
										'addmission_no' 			=> $r['H'],
										'emailid' 					=> $r['I'],
										'board_regno' 				=> $r['J'],
										'dob' 						=> $r['K'],
										'gender' 					=> $r['L'],
										'blood_group' 				=> $r['M'],
										'residence_phone' 			=> $r['N'],
										'father_mobile' 			=> $r['O'],
										'cast_category' 			=> $r['P'],
										'country' 					=> $country_name,
										'communication_address' 	=> $r['R'],
										'city' 						=> $city_name,	
										'father_name' 				=> $r['T'],	
										'father_emailid' 			=> $r['U'],	
										'father_mobile' 			=> $r['V'],
										'father_qualification' 		=> $r['W'],
										'father_desigination' 		=> $r['X'],
										'father_profession' 		=> $r['Y'],
										'father_officecontactno' 	=> $r['Z'],
										'father_annual_income' 		=> $r['AA'],	
										'mother_name' 				=> $r['AB'],	
										'mother_mobile' 			=> $r['AC'],	
										'mother_officeaddress' 		=> $r['AD'],	
										'mother_officecontactno' 	=> $r['AE'],	
										'mother_annual_income' 		=> $r['AF'],
										'pickup_bus_stop' 			=> $r['AG'],
										'pickup_bus_route' 			=> $r['AH'],
										'drop_bus_stop' 			=> $r['AI'],
										'drop_bus_route' 			=> $r['AJ'],
										'religion' 					=> $r['AK'],
										'is_transport' 				=> $r['AL'],
										'mother_salutation' 		=> $r['AM'],
										'father_salutation' 		=> $r['AN'],
										'subject' 					=> $setsubject,
										'fee_applicable_date' 		=> $r['AP'],
										'weight' 					=> $r['AQ'],
										'height' 					=> $r['AR'],
										'visionL' 					=> $r['AS'],
										'visionR' 					=> $r['AT'],
										'dental' 					=> $r['AU'],
										'adharcard_no' 				=> $r['AV'],
										'brothers' 					=> $r['AW'],
										'sisters' 					=> $r['AX'],
										'student_status' 			=> $status_name,
										'remarks' 					=> $r['AZ']
										);

				
				}
				else {
					break;
				}
			}
		 
		$j++; }
		//print_r($datas);
		//exit();
		
			if ($valid == 1) {
				$this->db->insert_batch($this->db->dbprefix('tbl_student'), $datas);
				
			}
			else {
				$msg 	= "Invalid Data in excel";
				 $this->prepare_flashmessage($msg, 1);
				 redirect('admin/massupload', 'refresh');
			}
			
			if ($this->db->affected_rows() > 0) {
				$msg = "All Data Uploaded Successfully";
				$this->prepare_flashmessage($msg, 0);
			}
			else {
				 $msg = "All Data not Uploaded Successfully";
				 $this->prepare_flashmessage($msg, 1);
			}
				$this->session->set_flashdata('success','<font color="#05BD14">All Data successfully uploaded....</font>');
				redirect('admin/massupload');
	}
	//Global Rights for Role
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
	$this->db->update('tbl_org',array($col=>$editval),array('aid'=>$id));
	echo $editval;
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
		$this->view('admin/globalrights',$this->data); 
	}
	function feeconfig()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;
		
		$this->data['class'] = $this->base_model->getClass();
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allstudent = $this->base_model->run_query("select * from tbl_student");
			
			$this->data['Allstudent'] 	= $Allstudent;
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){
				$Allstudent = $this->base_model->run_query(
			"select * from tbl_student where created_by ='".$this->session->userdata('empid')."'");
				$this->data['Allstudent'] 	= $Allstudent;
			}
		
			$this->data['userinfo'] 	= $userinfo;
			$this->data['title'] 		= 'Fee Details';
		
			$this->data['active_menu'] 	= 'Feeconfig';
			$this->data['content'] 		= 'admin/feeconfig';
		
			$this->view('admin/feeconfig',$this->data);
	}
	
	//Fee Edit
	function feeedit($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$viewstudentinfo = $this->base_model->run_query("select * from tbl_student where aid ='".$id."'");
		$this->data['viewstudentinfo'] 	= $viewstudentinfo;
		$this->data['session'] = $this->base_model->getSession();
		$this->data['class'] = $this->base_model->getClass();
		$this->data['coaching'] = $this->base_model->getCoaching();
		$this->data['fee'] = $this->base_model->getFee();
		//starts by running the query for the countries dropdown 
      $this->data['countryDrop'] = $this->base_model->getCountries();
	  $this->data['stateDrop']= $this->base_model->getStateByCountry();
		
	   $this->data['cityDrop']=$this->base_model->getStateByCity();
		if(isset($_POST['fee_update'])!=''){			
				
				$data['student_fee'] 		= $this->input->post('student_fee');
			
				$data['remaining_fee'] 		= $this->input->post('fee');
			
				$data['remarks'] 			= $this->input->post('remarks');
			
				$data['membarship_cardtype'] = $this->input->post('cardtype');
			
				$data['card_validity'] 	= $this->input->post('card_validity');
					$where['aid'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
						
					$data,
					$this->db->dbprefix('tbl_student'),
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Student Fee Information successfully Updated....</font>');
					return redirect('admin/feeconfig/',$this->data);
				}
			$this->data['userinfo'] 	= $userinfo;
			$this->data['title'] 		= 'Fee Student';
			$this->data['active_menu'] 	= 'fee student';
		
			$this->data['content'] 		= 'admin/feeedit';
		
			$this->view('admin/feeedit',$this->data); 
	}
	
	//View All timetable
	function timetable()
	{	
		$Alltimetable = $this->base_model->run_query(
		"select * from tbl_timetable");
		$this->data['class'] 		= $this->base_model->getClass();
		$this->data['Alltimetable'] 	= $Alltimetable;
		$this->data['title'] 		= 'subject';
		$this->data['active_menu'] 	= 'subject';
		$this->data['content'] 		= 'admin/timetable';
		$this->view('admin/timetable',$this->data); 
	}
	function getrollno()
	{
		$class_id = $this->input->post('cl');
		$coaching_id =  $this->input->post('coaching');
		$data['class_id'] = $this->input->post('cl');
		$data['coaching_id'] = $this->input->post('coaching');
		$data['autogen'] = "01";

		$count = $this->base_model->count_rows($class_id,$coaching_id);

		if($count == 1)
		{
			$data = $this->base_model->get_autogen($class_id,$coaching_id);
			echo $data[0]->autogen;

		}
		else
		{
			$this->base_model->insert_operation($data,'tbl_autogen');
			echo $data['autogen'];


		}	
	}
	function list()
	{
		$alluser = $this->base_model->run_query(
							"SELECT *,(CASE WHEN transtype = 1 THEN 'Payment'
WHEN transtype = 2 THEN 'General'
WHEN transtype = 3 THEN 'Contra'
WHEN transtype = 4 THEN 'Receive'
ELSE ''
END)Type FROM mlm_transaction where byid in(7,8460)");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/list';
		$this->view('admin/list',$this->data); 
	}
	//Add Timetable
	function addtimetable($id=FALSE)
	{
		$id = $this->uri->segment(3);	
		$viewtimetableinfo = $this->base_model->run_query(
		"select * from tbl_timetable where id ='".$id."'");
		$this->data['viewtimetableinfo'] 	= $viewtimetableinfo;
		
		$this->data['section'] = $this->base_model->getSection();
		$this->data['class'] = $this->base_model->getClass();
		
		$this->data['subject'] = $this->base_model->getSubject();
		if(isset($_POST['timetable_update'])=='')
		{
			$this->form_validation->set_rules('class', 'Class Name', 'required');			
			if ($this->form_validation->run() == true)
			{	
				$data['class_id'] 				= $this->input->post('class');
				
				$data['section'] 				= $this->input->post('section');
				
				$data['batch_time'] 			= $this->input->post('time');
				$data['week_no'] 				= $this->input->post('week_no');
				$data['mon1'] 					= $this->input->post('mon1');
				
				$data['mon2'] 					= $this->input->post('mon2');
				
				$data['tue1'] 					= $this->input->post('tue1');
				
				$data['tue2'] 					= $this->input->post('tue2');
				
				$data['wed1'] 					= $this->input->post('wed1');
				
				$data['wed2'] 					= $this->input->post('wed2');
				
				$data['thu1'] 					= $this->input->post('thu1');
				
				$data['thu2'] 					= $this->input->post('thu2');
				
				$data['fri1'] 					= $this->input->post('fri1');
				
				$data['fri2'] 					= $this->input->post('fri2');
				
				$data['sat1'] 					= $this->input->post('sat1');
				
				$data['sat2'] 					= $this->input->post('sat2');
				$data['status'] 				= 'Active';
			 //step for Insert
				$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('tbl_timetable')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Timetable successfully created...</font>');
				return redirect('admin/addtimetable/',$this->data);
			}
		}
		else{
				$data['class_id'] 				= $this->input->post('class');
				
				$data['section'] 				= $this->input->post('section');
				
				$data['batch_time'] 			= $this->input->post('time');
				$data['week_no'] 				= $this->input->post('week_no');
				$data['mon1'] 					= $this->input->post('mon1');
				
				$data['mon2'] 					= $this->input->post('mon2');
				
				$data['tue1'] 					= $this->input->post('tue1');
				
				$data['tue2'] 					= $this->input->post('tue2');
				
				$data['wed1'] 					= $this->input->post('wed1');
				
				$data['wed2'] 					= $this->input->post('wed2');
				
				$data['thu1'] 					= $this->input->post('thu1');
				
				$data['thu2'] 					= $this->input->post('thu2');
				
				$data['fri1'] 					= $this->input->post('fri1');
				
				$data['fri2'] 					= $this->input->post('fri2');
				
				$data['sat1'] 					= $this->input->post('sat1');
				
				$data['sat2'] 					= $this->input->post('sat2');
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_timetable'), 
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Time successfully Updated....</font>');
					return redirect('admin/addtimetable/',$this->data);
		}
		$this->data['title'] 		= 'Timetable';
		$this->data['active_menu'] 	= 'timetable';
		$this->data['content'] 		= 'admin/add-timetable';
		$this->view('admin/add-timetable',$this->data);
	}
	
	function timetable_excel()
	{
		
		$this->data['alltimetablelist'] = $this->base_model->ExportTimetable();
		 $this->ExportTimetable();
		 return redirect("admin/timetable",$this->data);      
     }
	
	//Delete Timetable
	function deleteTimetable()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_timetable'), 
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Timetable successfully Deleted....</font>');
			return redirect('admin/timetable/',$this->data);
		}
	}
	


	function getage()
	{
		$age =  $this->input->post('age');

		$dateofbirth = date_create($age);
		$cdob = date_format($dateofbirth,"d.m.Y");

		$bday = new DateTime($cdob);
		// $today = new DateTime('00:00:00'); - use this for the current date
		$today = new DateTime('00:00:00'); // for testing purposes

		$diff = $today->diff($bday);

		printf('%d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
	}


	//Member Status
	function memberstatus()
	{
		// Set array for send data.
		if(!empty($_POST['dactvie']))
		{
		$data['status'] = 'inDactive';
		$where['member_id'] 		= $this->input->post('member_id');
		$this->base_model->update_operation(
		$data,
		$this->db->dbprefix('mlm_members_login'),
		$where
		);
		$this->session->set_flashdata('success','<font color="#05BD14"> successfully Dactivated....</font>');
			
		return redirect('admin/dashboard/',$this->data);
		}
		if(!empty($_POST['active']))
		{
		$data['status'] = 'inActive';
		$where['member_id'] 		= $this->input->post('member_id');
		$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('mlm_members_login'),
					$where
					);
		$this->session->set_flashdata('success','<font color="#05BD14"> successfully Activated....</font>');
			return redirect('admin/dashboard/',$this->data);
		}
	}
	
	
	function generatestructure($id=FALSE)
	{
		$id = $this->uri->segment(3);
		
		$this->data['teacher'] = $this->base_model->getTeacher();
		
		$viewteacherinfo = $this->base_model->run_query(
		"select * from salary_standard where Tecid ='".$id."'");
		
		$this->data['viewteacherinfo'] 		= $viewteacherinfo;
		if(isset($_POST['generate_structure'])=='')
		{
			$this->form_validation->set_rules('teacher', 'Teacher Name', 'required');
			$this->form_validation->set_rules('ctc', 'Cost of the company', 'required');
			
			if($this->form_validation->run() == true)
			{	
				$data['Tecid'] 					= $this->input->post('teacher');
				$data['basic'] 					= $this->input->post('basic');
				$data['hra'] 					= $this->input->post('hra');
				$data['da'] 					= $this->input->post('da');
				$data['bonus'] 					= $this->input->post('bonus');
				
				$data['ctc'] 					= $this->input->post('ctc');
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('salary_standard')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Salary Structure Generated successfully ...</font>');
				return redirect('admin/teacherlist/',$this->data);
			}
		}
		else{
				
				$data['basic'] 					= $this->input->post('basic');
				$data['hra'] 					= $this->input->post('hra');
				$data['ca'] 					= $this->input->post('ca');
				$data['bonus'] 					= $this->input->post('bonus');
			
				$data['ctc'] 					= $this->input->post('ctc');
					$where['Tecid'] 			= $id;			
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('salary_standard'),
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Salary Structure successfully Updated....</font>');
					return redirect('admin/teacherlist/',$this->data);
		}		
		
		$this->data['title'] 		= 'Generate';
		
		$this->data['active_menu'] 	= 'generate';
		
		$this->data['content'] 		= 'admin/addstructure';
		
		$this->view('admin/addstructure',$this->data);
	}

	function findstudentlist()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;
		
		$this->data['class'] = $this->base_model->getClass();
		$this->data['session'] = $this->base_model->getSession();
		$this->data['section'] = $this->base_model->getSection();
		$this->data['st_type'] = $this->base_model->getSttype();
		$this->data['group'] = $this->base_model->getStudentGroup();

		if($userinfo[0]->org_role=='1')
		{
			
			if(isset($_POST['search'])!='')
			{
			
				$admission_session = $this->input->post('admission_session');
				$student_class = $this->input->post('student_class');
				$section_name = $this->input->post('section_name');
				$student_type = $this->input->post('student_type');
				$student_status = $this->input->post('student_status');
				$student_group = $this->input->post('student_group');
				$orderby = $this->input->post('orderby');

				if($orderby==0)
				{
					$ORDER = "";
					$orderby = "";
				}
				elseif($orderby!=0)
				{
					$ORDER = "ORDER BY";
					$orderby = $orderby;
				}
				


				$Allstudent  = $this->base_model->run_query("SELECT * from tbl_student where admission_session = ".$admission_session." OR student_class = ".$student_class." OR section_name = ".$section_name." OR student_type = ".$student_type." OR student_status = ".$student_status." OR student_group = ".$student_group." ".$ORDER." ".$orderby."");
				
			
				$this->data['Allstudent'] 	= $Allstudent;

				$this->data['userinfo'] 	= $userinfo;

				$this->data['title'] 		= 'Student Details';
			
				$this->data['active_menu'] 	= 'Studentlist';
			
				$this->data['content'] 		= 'admin/findstudentlist';			

				$this->view('admin/findstudentlist',$this->data);
			}		
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){

			
			if(isset($_POST['search'])!='')
			{
			
				$admission_session = $this->input->post('admission_session');
				$student_class = $this->input->post('student_class');
				$section_name = $this->input->post('section_name');
				$student_type = $this->input->post('student_type');
				$student_status = $this->input->post('student_status');
				$student_group = $this->input->post('student_group');
				$orderby = $this->input->post('orderby');

				if($orderby==0)
				{
					$ORDER = "";
					$orderby = "";
				}
				elseif($orderby!=0)
				{
					$ORDER = "ORDER BY";
					$orderby = $orderby;
				}

				$Allstudent  = $this->base_model->run_query("SELECT * from tbl_student where admission_session = ".$admission_session." OR student_class = ".$student_class." OR section_name = ".$section_name." OR student_type = ".$student_type." OR student_status = ".$student_status." OR student_group = ".$student_group." ".$ORDER." ".$orderby."");
				
			
				$this->data['Allstudent'] 	= $Allstudent;

				$this->data['userinfo'] 	= $userinfo;

				$this->data['title'] 		= 'Student Details';
			
				$this->data['active_menu'] 	= 'Studentlist';
			
				$this->data['content'] 		= 'admin/findstudentlist';			

				$this->view('admin/findstudentlist',$this->data);
			}		
		
		}
	}
	
	function findteacherlist()
	{
				
		if(isset($_POST['search'])!='')
		{
			
		$teacherlist  = $this->base_model->run_query("SELECT * FROM tbl_teacher WHERE coaching_name = '".$this->input->post('coaching')."'");
		
			$this->data['teacherlist'] 	= $teacherlist;
			
			$this->data['coaching'] = $this->base_model->getCoaching();
			
			$this->view('admin/teacherlist',$this->data);
		}
		else{
		
			
			$this->data['title'] 		= 'Teacher Details';
		
			$this->data['active_menu'] 	= 'Teacherdetails';
		
			$this->data['content'] 		= 'admin/teacherlist';
			$this->view('admin/teacherlist',$this->data);
		}
			
	}
	
	function generatesalary($id=FALSE)
	{
		if(isset($_POST['generate'])=='')
		{
			$id = $this->uri->segment(3);			
			$month = date("F");
			$year = date('Y');			
		$teacherinfo  = $this->base_model->run_query("SELECT * FROM tbl_attendance WHERE month = '".$month."' and year = '".$year."' and Stdid = '".$id."'");		
			$this->data['teacherinfo'] 	= $teacherinfo;			
			foreach($teacherinfo as $r)
			{
				$totalworkingdays = count($r->logintime);
			}			
			$salaryinfo  = $this->base_model->run_query("SELECT * FROM salary_standard WHERE Tecid = '".$this->uri->segment(3)."'");			
			$this->data['salaryinfo'] 	= $salaryinfo;			
			foreach($salaryinfo as $r)
			{
				$basic = $r->basic;
				$hra = $r->hra;
				$ca = $r->ca;
				$bonus = $r->bonus;
				$ctc = $r->ctc;
			}	
			$totaldays = "30";			
			$earnbasic = ($basic/$totaldays)*$totalworkingdays;
			$earnhra = ($hra/$totaldays)*$totalworkingdays;
			$earnca = ($ca/$totaldays)*$totalworkingdays;			
			$totalpaysalary = $earnbasic+$earnhra+$earnca;			
			$totaldeduction = $ctc-$totalpaysalary;			
			$data['Tecid']  				=	$id;
			$data['month']  				=	date('F');
			$data['year']  					=	date('Y');
			$data['basic_salary']	  		=	$basic;
			$data['hra']  					=	$hra;
			$data['ca']  					=	$ca;
			$data['profit_bonus']  			=	$bonus;
			
			$data['earn_basic']	  			=	$earnbasic;
			$data['earn_hra']  				=	$earnhra;
			$data['earn_ca']  				=	$earnca;			
			$data['earn_total']  			=	$totalpaysalary;			
			$data['current_salary']  		=	$ctc;
			$data['current_salary_total']  	=	$ctc;
			$data['present_attendance']  	=	$totalworkingdays;
			$data['total_working_days']  	=	$totalworkingdays;
			$data['total_deduction']  		=	$totaldeduction;
			$data['total_pay_salary']  		=	$totalpaysalary+$bonus;
			$data['generate_salary_date']  	=	date('Y-m-d');
			
			
			$leavebalanceinfo  = $this->base_model->run_query("SELECT * FROM tbl_leave_balance WHERE Stdid = '".$id."'");
			
					$this->data['leavebalanceinfo'] 	= $leavebalanceinfo[0]->leave_balance;
					$earnleave = 1.75;
					$deductleave = ($totaldays)-($totalworkingdays);
			
					$leave_data['leave_balance']  	=	($leavebalanceinfo[0]->leave_balance)+($earnleave)-$deductleave;
			
					$where['empid'] 				= $id;			
					$this->base_model->update_operation(
					$leave_data,
					$this->db->dbprefix('tbl_leave_balance'),
					$where
					);
			//step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_salary')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Salary Generated successfully ....</font>');			
			return redirect('admin/teacherlist',$this->data);
		}			
	}	
	function viewsalary()
	{
		
		$this->data['coaching'] = $this->base_model->getCoaching();
		$viewsalary = $this->base_model->run_query("select * from tbl_salary");
			$this->data['viewsalary'] 	= $viewsalary;			
			$this->data['title'] 		= 'Salary Details';
			$this->data['active_menu'] 	= 'SalaryDetails';
		
			$this->data['content'] 		= 'admin/viewsalary';
		
			$this->view('admin/viewsalary',$this->data);
	}
	
	//Delete Student
	function deleteSalary()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['salaryid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_salary'),
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Salary successfully Deleted....</font>');
			return redirect('admin/viewsalary/',$this->data);
		}
	}
	
	function gender()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		
		$this->data['userinfo'] 	= $userinfo;
		
		if(isset($_POST['search'])!='')
		{
				
			
			
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;		
		$this->data['class'] = $this->base_model->getClass();
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allstudent = $this->base_model->run_query("select * from tbl_student");			
			$this->data['Allstudent'] 	= $Allstudent;
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){
				$Allstudent = $this->base_model->run_query(
			"select * from tbl_student where created_by ='".$this->session->userdata('empid')."' and gender = '".$this->input->post('gender')."'");
				$this->data['Allstudent'] 	= $Allstudent;
			}		
		}
			$this->data['title'] 		= 'Student Details';		
			$this->data['active_menu'] 	= 'Studentdetail';
			$this->data['content'] 		= 'admin/gender';		
			$this->view('admin/gender',$this->data);
	}
	
	function feecollection()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		
		$this->data['userinfo'] 	= $userinfo;
		
		if(isset($_POST['search'])!='')
		{
			
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;		
		$this->data['class'] = $this->base_model->getClass();
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allstudent = $this->base_model->run_query("select * from tbl_student");			
			$this->data['Allstudent'] 	= $Allstudent;
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){
				$Allstudent = $this->base_model->run_query(
			"select * from tbl_student where created_by ='".$this->session->userdata('empid')."' and remaining_fee != '".$this->input->post('fee')."'");
				$this->data['Allstudent'] 	= $Allstudent;
			}		
		}
			$this->data['title'] 		= 'Student Details';		
			$this->data['active_menu'] 	= 'Studentdetail';
			$this->data['content'] 		= 'admin/feecollection';		
			$this->view('admin/feecollection',$this->data);
	}
	
	function classwise()
	{
		
		$this->data['class'] = $this->base_model->getClass();
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		
		$this->data['userinfo'] 	= $userinfo;
		
		if(isset($_POST['search'])!='')
		{
			
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;		
		$this->data['class'] = $this->base_model->getClass();
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allstudent = $this->base_model->run_query("select * from tbl_student");			
			$this->data['Allstudent'] 	= $Allstudent;
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){
				$Allstudent = $this->base_model->run_query(
			"select * from tbl_student where created_by ='".$this->session->userdata('empid')."' and student_class = '".$this->input->post('class')."'");
				$this->data['Allstudent'] 	= $Allstudent;
			}		
		}
			$this->data['title'] 		= 'Student Details';		
			$this->data['active_menu'] 	= 'Studentdetail';
			$this->data['content'] 		= 'admin/classwise';		
			$this->view('admin/classwise',$this->data);
	}
	
	function sectionwise()
	{
		
		$this->data['section'] = $this->base_model->getSection();
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		
		$this->data['userinfo'] 	= $userinfo;
		
		if(isset($_POST['search'])!='')
		{
			
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;		
		$this->data['class'] = $this->base_model->getClass();
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allstudent = $this->base_model->run_query("select * from tbl_student");			
			$this->data['Allstudent'] 	= $Allstudent;
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){
				$Allstudent = $this->base_model->run_query(
			"select * from tbl_student where created_by ='".$this->session->userdata('empid')."' and section_name = '".$this->input->post('section')."'");
				$this->data['Allstudent'] 	= $Allstudent;
			}		
		}
			$this->data['title'] 		= 'Student Details';		
			$this->data['active_menu'] 	= 'Studentdetail';
			$this->data['content'] 		= 'admin/sectionwise';		
			$this->view('admin/sectionwise',$this->data);
	}
	
	function sessionwise()
	{
		
		$this->data['session'] = $this->base_model->getSession();
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		
		$this->data['userinfo'] 	= $userinfo;
		
		if(isset($_POST['search'])!='')
		{
			
		$Allstudent = $this->base_model->run_query(
		"select * from tbl_student where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allstudent'] 	= $Allstudent[0]->created_by;		
		$this->data['class'] = $this->base_model->getClass();
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allstudent = $this->base_model->run_query("select * from tbl_student");			
			$this->data['Allstudent'] 	= $Allstudent;
		}
		elseif(($userinfo[0]->Orgid=$Allstudent[0]->created_by)){
				$Allstudent = $this->base_model->run_query(
			"select * from tbl_student where created_by ='".$this->session->userdata('empid')."' and admission_session = '".$this->input->post('session')."'");
				$this->data['Allstudent'] 	= $Allstudent;
			}		
		}
			$this->data['title'] 		= 'Student Details';		
			$this->data['active_menu'] 	= 'Studentdetail';
			$this->data['content'] 		= 'admin/sessionwise';		
			$this->view('admin/sessionwise',$this->data);
	}
	function teacher()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;	
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		$this->data['coaching'] = $this->base_model->getCoaching();
		$Allteacher = $this->base_model->run_query(
		"select * from tbl_teacher where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allteacher'] 	= $Allteacher[0]->created_by;		
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allteacher = $this->base_model->run_query("select * from tbl_teacher");
			$this->data['Allteacher'] 	= $Allteacher;
		}
		elseif(($userinfo[0]->Orgid=$Allteacher[0]->created_by)){
				$Allteacher = $this->base_model->run_query(
			"select * from tbl_teacher where created_by ='".$this->session->userdata('empid')."'");
				$this->data['Allteacher'] 	= $Allteacher;
			}
			$this->data['userinfo'] 	= $userinfo;
			$this->data['title'] 		= 'Teacher Details';
			$this->data['active_menu'] 	= 'Teacherdetails';
			$this->data['content'] 		= 'admin/teacher';
			$this->view('admin/teacher',$this->data);
	}
	
	
	
	function teacher_menu_manage()
	{
        $this->data['userinfo'] 	= $userinfo[0]->Orgid;	
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		$this->data['coaching'] = $this->base_model->getCoaching();
		$Allteacher = $this->base_model->run_query(
		"select * from tbl_teacher where created_by='".$userinfo[0]->Orgid."'");
		$this->data['Allteacher'] 	= $Allteacher[0]->created_by;		
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$Allteacher = $this->base_model->run_query("select * from tbl_teacher");
			$this->data['Allteacher'] 	= $Allteacher;
		}
		elseif(($userinfo[0]->Orgid=$Allteacher[0]->created_by)){
				$Allteacher = $this->base_model->run_query(
			"select * from tbl_teacher where created_by ='".$this->session->userdata('empid')."'");
				$this->data['Allteacher'] 	= $Allteacher;
			}
			$this->data['userinfo'] 	= $userinfo;
			$this->data['title'] 		= 'Teacher Menu Manage';
			$this->data['active_menu'] 	= 'Teacherdetails';
			$this->data['content'] 		= 'admin/teacher';
			$this->view('admin/teacher_menu',$this->data);
	}
	//Add Teacher
	function addteacher($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		$this->data['userinfo'] 	= $userinfo[0]->org_role;		
		$Allteacher = $this->base_model->run_query(
		"select * from tbl_teacher where created_by='".$userinfo[0]->Orgid."'");
			$this->data['Allteacher'] 	= $Allteacher[0]->created_by;		
		if($userinfo[0]->org_role=='1')
		{
			$this->data['coaching'] = $this->base_model->getCoaching();
		}
		elseif(($userinfo[0]->Orgid=$this->session->userdata('empid'))){
				$coaching = $this->base_model->run_query(
			"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."'");
		$this->data['coaching'] 	= $coaching = $this->base_model->getcheck_Coaching($coaching[0]->aid);
			
			}
		
		$viewteacherinfo = $this->base_model->run_query(
		"select * from tbl_teacher where aid ='".$id."'");
		$this->data['viewteacherinfo'] 	= $viewteacherinfo;
		
		//$this->data['coaching'] = $this->base_model->getCoaching();
		//starts by running the query for the countries dropdown 
      $this->data['countryDrop'] = $this->base_model->getCountries();
	  $this->data['stateDrop']= $this->base_model->getStateByCountry();		
	   $this->data['cityDrop']=$this->base_model->getStateByCity();	
		if(isset($_POST['teacher_update'])=='')
		{
		
			$this->form_validation->set_rules('Emailid', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('teacher_mobile', 'Mobile No.', 'required|regex_match[/^[0-9]{10}$/]');
			if ($this->form_validation->run() == true)
			{
				$this->load->library('email');
				$emailinfo = $this->base_model->run_query("select * from email_setting");
				$this->data['emailinfo'] 		= $emailinfo[0]->smtp_user;
				//Password Generate Script
				$str = "";
			 $length = 8;
			 $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
			 $max = count($characters) - 1;
			 for ($i = 0; $i < $length; $i++) {
				 
			  $rand = mt_rand(0, $max);
			  $str .= $characters[$rand];
			 }
				$tokenno = $str;
		$template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; width=device-width" name="viewport">
<title>'.$this->input->post('FirstName').'&nbsp;'.$this->input->post('LastName').', thank you for your Interest .</title>
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
                <td width="120" align="center" valign="middle" class="emailcolsplit" style="padding-bottom:10px; padding-top:10px;"><div align="center"><a href="passionforexams.co.in
"><img src="http://passionforexams.co.in/assets/img/logo.png" width="120" height="45" border="0" alt="" style="display:block;"></a></div></td>
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
      <tr>
        <td align="left" style="padding-top:20px; padding-bottom:40px; padding-left:40px; padding-right:40px"><font face="Arial, sans-serif" color="#333333" style="font-size:14px; -webkit-text-size-adjust:none; line-height:20px">
'.$this->input->post('FirstName').'&nbsp;'.$this->input->post('LastName').', it is time to get started buy our product.
</font></td>
  </tr>
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
                 <td width="21%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Customer ID #: </font></td>
                 <td width="79%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">'.$this->input->post('teacher_id').'</font></td>
               </tr>
			   <tr>
                 <td width="21%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Password : </font></td>
                 <td width="79%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">'.$tokenno.'</font></td>
               </tr>
               <tr>
                 <td valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Full Name:</font></td>
                 <td valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">'.$this->input->post('FirstName').'&nbsp;'.$this->input->post('LastName').'</font></td>
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
<br><br>
Copyright &copy; 2016 Onlinesoftservices Company. All rights reserved.</font></td></tr>
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
				$data['Tecid'] 				= $this->input->post('teacher_id');				
				$data['password'] 			= $tokenno;			
				$data['coaching_name'] 		= $this->input->post('coaching');
				$data['teacher_type'] 		= 'User';
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
				$data['created_by']			= $this->session->userdata('empid');
				//File Upload Process start Student Image
				$teacherimageconfig = array(
				'upload_path' => "./teacherimage/",
				'allowed_types' => "gif|jpg|png|jpeg",					
				'overwrite' => TRUE,
					
				'max_size' => "2048000" // Can be set to particular file size , here it is 2 MB(2048 Kb)
				);
				$this->load->library('upload', $teacherimageconfig);
				$this->upload->do_upload('teacher_image');
				$tempteacherimage = $this->upload->data();
				$data['teacher_image']=$tempteacherimage['file_name'];
				//File Upload Process start Teacher Document1
				$this->upload->do_upload('attach_doc1');
				$tempteacherdoc = $this->upload->data();
				$data['attach_doc1']=$tempteacherdoc['file_name'];
				//File Upload Process start Teacher Document2
				$this->upload->do_upload('attach_doc2');				
				$tempteacherdocs = $this->upload->data();
				$data['attach_doc2']=$tempteacherdocs['file_name'];
				$data['create_date'] 		= date('Y-m-d');			
				$data['status'] 			= 'Active';				
				$CustomerEmailid 			= $this->input->post('Emailid');
				//Account Create Email Information Script
				$this->email->from($emailinfo[0]->smtp_user, 'Onlinesoftservices');
				$this->email->to($this->input->post('Emailid'));
				$this->email->subject('Onlinesoftservices Teacher Login Account Information');			
				$this->email->message($template);
				//step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_teacher')
							);
				//Send mail 
				$this->email->send();
				
				//Teacher leave balacne insert
				
				$teacherleaveinfo = $this->base_model->run_query(
		"select * from tbl_leave_balance where Tecid ='".$this->input->post('teacher_id')."'");
		$this->data['teacherleaveinfo'] 	= $teacherleaveinfo[0]->Tecid;
				if($teacherleaveinfo[0]->Tecid!=$this->input->post('teacher_id'))
				{
					
				$inputdata['Tecid'] = $this->input->post('teacher_id');	
				$this->base_model->insert_operation($inputdata,$this->db->dbprefix('tbl_leave_balance'));
				}
			$this->session->set_flashdata('success','<font color="#05BD14">Teacher successfully created please check your email id for Teacher login details...</font>');
				return redirect('admin/addteacher/',$this->data);
			}
		}
		else{
				$data['Tecid'] 				= $this->input->post('teacher_id');
			
				$data['coaching_name'] 		= $this->input->post('coaching');
			
				$data['teacher_type'] 		= 'User';
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
					$where['aid'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_teacher'),
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Teacher Information successfully Updated....</font>');
					return redirect('admin/teacher/',$this->data);
				}	
			$this->data['userinfo'] 	= $userinfo;
			$this->data['title'] 		= 'Add Teacher';
			$this->data['active_menu'] 	= 'add teacher';
			$this->data['content'] 		= 'admin/addteacher';
			$this->view('admin/addteacher',$this->data);
	}
	//Delete Teacher
	function deleteTeacher()
	{
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['aid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_teacher'), 
			$where
			);
			$this->session->set_flashdata('success','<font color="#05BD14">Teacher successfully Deleted....</font>');
			return redirect('admin/teacher/',$this->data);
		}
	}
	
	//Teacher Status
	function teacherstatus()
	{
		// Set array for send data.
		if(!empty($_POST['dactvie']))
		{
		$data['status'] = 'Dactivate';
		$where['aid'] 		= $this->input->post('aid');
		$this->base_model->update_operation(
		$data,
		$this->db->dbprefix('tbl_teacher'),
		$where
		);
		$this->session->set_flashdata('success','<font color="#05BD14">Teacher successfully Dactivated....</font>');
		return redirect('admin/teacher/',$this->data);
		}
		
		if(!empty($_POST['active']))
		{
		$data['status'] = 'Active';
		$where['aid'] 		= $this->input->post('aid');
		$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_teacher'),
					$where
					);
		$this->session->set_flashdata('success','<font color="#05BD14">Teacher successfully Activated....</font>');
			return redirect('admin/teacher/',$this->data);
		}
	}
	function leavelist()
	{
		$userinfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."' and status='Active'");
		$this->data['userinfo'] 	= $userinfo[0]->Orgid;
		
		$this->data['userinfo'] 	= $userinfo[0]->org_role;
		$this->data['coaching'] = $this->base_model->getCoaching();	
		$leavelist = $this->base_model->run_query(
		"select * from tbl_teacher where created_by='".$userinfo[0]->Orgid."'");
			$this->data['leavelist'] 	= $leavelist;
		
		if($userinfo[0]->org_role=='1')
		{
			//Data For Active Users
			$leavelist = $this->base_model->run_query("select * from tbl_leave");
			$this->data['leavelist'] 	= $leavelist;		
		}
		else{
			
			$this->data['leavelist'] 	= $leavelist;			
				
					$leavelists = $this->base_model->run_query(
				"select * from tbl_leave where empid ='".$leavelist[0]->Tecid."'");
					$this->data['leavelists'] 	= $leavelists;
			}
			
			
			$this->data['userinfo'] 	= $userinfo;
			$this->data['title'] 		= 'Leave Details';
			$this->data['active_menu'] 	= 'Leavedetails';
			$this->data['content'] 		= 'admin/leavelist';
			$this->view('admin/leavelist',$this->data);
	}
	//Leave approve
	function leaveapprove($id=FALSE)
	{
		$id = $this->uri->segment(3);		
		
		if($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$data['leave_permission'] = "Granted";			
			$where['id'] 		= $id;
			$this->base_model->update_operation(
			$data,
			$this->db->dbprefix('tbl_leave'),
			$where
			);
			
			$teacherinfo = $this->base_model->run_query(
		"select * from tbl_teacher where Tecid='".$this->uri->segment(4)."'");
			$this->data['teacherinfo'] 	= $teacherinfo;
			
			foreach($teacherinfo as $r)
			{
				$teacheremail = $r->emailid;
				$teacherFirstName = $r->FirstName;
				$teacherLastName = $r->LastName;
				$teachermobile = $r->teacher_mobile;
			}
			
			//step for send sms 
				$message ="Your leave approved with OnlineCMS";
				
		
				$url = 'http://truebulksms.biz/smsapi.php?' . http_build_query([
				'username'=> 'ayurscrub',
				'password'=>'atulraime',
				'sender'=>'AYURVD',    
				'sendto' => $teachermobile,
				'message' => $message				
			]);
			$ch = curl_init($url);
			curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
			curl_exec($ch);  // execute
			
			//Email Send Setup
			
				$this->load->library('email');
				$emailinfo = $this->base_model->run_query("select * from email_setting");
				
				$this->data['emailinfo'] 		= $emailinfo[0]->smtp_user;
			
			$template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8; width=device-width" name="viewport">
<title>Leave status, thank you for your Interest .</title>
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
                <td width="120" align="center" valign="middle" class="emailcolsplit" style="padding-bottom:10px; padding-top:10px;"><div align="center"><a href="http://onlinesoftservices.com"><img src="http://otsinfotechindia.com/ots/assets/img/site-image/newlogo.png" width="120" height="45" border="0" alt="" style="display:block;"></a></div></td>
             
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
        <td align="left" style="padding-top:40px; padding-bottom:20px; padding-left:40px; padding-right:40px; mso-line-height-rule:exactly; font-size:40px; line-height:40px;"><font face=""Walsheim-Bold", "Arial Black", "Arial", "sans-serif" color="#333333" style="font-size:40px; -webkit-text-size-adjust:none; line-height:40px">Your Leave Status</font></td>
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
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FD7608">          <tr>
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
                 <td colspan="2" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:20px" face="Arial, sans-serif" color="#333333">Leave Status Information</font></td>
                 </tr>
               <tr>
                 <td width="21%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Leave : </font></td>
                 <td width="79%" valign="top" style="padding:10px; padding-left:0px;"><font style="font-size:14px" face="Arial, sans-serif" color="#333333">Approved</font></td>
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
				
				//Account Create Email Information Script
				$this->email->from($emailinfo[0]->smtp_user, 'Online CMS');
				$this->email->to($teacheremail);
				$this->email->subject('Online CMS Teacher Leave Status Information');
				
				$this->email->message($template);
				
				$this->email->send();
			$this->session->set_flashdata('success','<font color="#05BD14">Leave successfully Approved....</font>');
			return redirect('admin/leavelist/',$this->data);
		}
	}	
	function notification()
	{
		
		if($this->uri->segment(3) != '') {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_notification'),
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/notification');
		}
		
		$notification = $this->base_model->run_query("select * from tbl_notification");
		
			$this->data['notification'] = $notification;
			$this->data['title'] 		= 'Teacher Details';
			$this->data['active_menu'] 	= 'Teacherdetails';
			$this->data['content'] 		= 'admin/notification';
			$this->view('admin/notification',$this->data);
	}
	//Add Notification
	function addnotification($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewnotificationinfo = $this->base_model->run_query("select * from tbl_notification where id ='".$id."'");
		
		$this->data['viewnotificationinfo'] 	= $viewnotificationinfo;	
		
		
		if(isset($_POST['notification_update'])=='')
		{
			$this->form_validation->set_rules('title', 'Notification Title', 'required');
			$this->form_validation->set_rules('description', 'Notification Desc', 'required');
			
			if ($this->form_validation->run() == true)
			{				
				$data['title'] 				= $this->input->post('title');
			
				$data['description'] 		= $this->input->post('description');
				$data['post_date'] 			= $this->input->post('post_date');
				$data['last_date'] 			= $this->input->post('last_date');
				
				$data['status'] 				= 'Active';	
				
				
					
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_notification')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Notification successfully created...</font>');
				return redirect('admin/notification/',$this->data);
			}
		}
		else{	
				$data['title'] 		= $this->input->post('title');
			
				$data['description'] 			= $this->input->post('description');
				$data['post_date'] 			= $this->input->post('post_date');
				$data['last_date'] 			= $this->input->post('last_date');			
					$data['status'] 			= 'Active';		
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_notification'),
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Notification successfully Updated....</font>');
					return redirect('admin/notification/',$this->data);
		}
		$this->data['title'] 		= 'Notificaiton';
		$this->data['active_menu'] 	= 'notification';
		$this->data['content'] 		= 'admin/add-notification';
		$this->view('admin/add-notification',$this->data);
	}	
	//Set Alert for Student
	function alert()
	{
		$this->data['section'] = $this->base_model->getSection();
		$this->data['class'] = $this->base_model->getClass();
		$this->data['description'] = $this->base_model->getTemplate();
		if(isset($_POST['send_alert'])!='')
		{
			$this->form_validation->set_rules('class', 'Class Name', 'required');
			
			$this->form_validation->set_rules('section', 'Section', 'required');
			if ($this->form_validation->run() == true)
			{
				$studentinfo = $this->base_model->run_query(
		"select * from tbl_student where student_class ='".$this->input->post('class')."' and section_name ='".$this->input->post('section')."'");
		$this->data['studentinfo'] = $studentinfo;				
			foreach($studentinfo as $r)
			{
				//step for send sms 				
				$studentinfo[0]->residence_phone;
					$message = $this->input->post('description');
					$url = 'http://truebulksms.biz/smsapi.php?' . http_build_query([
					'username'=> 'ayurscrub',
						
					'password'=>'',//atulraime
						
					'sender'=>'AYURVD',
					'sendto' => $r->residence_phone,
						
					'message' => $message
					]);
					$ch = curl_init($url);
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
					curl_exec($ch);  // execute
			}
			
			$this->session->set_flashdata('success','<font color="#05BD14">Alert successfully Send...</font>');
				return redirect('admin/alert/',$this->data);
			}
		}
		$this->data['title'] 		= 'Alert';	
		$this->data['active_menu'] 	= 'alert';
		$this->data['content'] 		= 'admin/alert';
		
		$this->view('admin/alert',$this->data);
	}
	
	//Set Alert for parents
	function falert()
	{
		$this->data['section'] = $this->base_model->getSection();
		$this->data['class'] = $this->base_model->getClass();
		
		$this->data['description'] = $this->base_model->getTemplate();
		if(isset($_POST['send_alert'])!='')
		{
			$this->form_validation->set_rules('class', 'Class Name', 'required');
			
			$this->form_validation->set_rules('section', 'Section', 'required');
			if ($this->form_validation->run() == true)
			{
				$studentinfo = $this->base_model->run_query(
		"select * from tbl_student where student_class ='".$this->input->post('class')."' and section_name ='".$this->input->post('section')."'");
		$this->data['studentinfo'] = $studentinfo;				
			foreach($studentinfo as $r)
			{
				//step for send sms 				
				$studentinfo[0]->father_mobile;
					$message = $this->input->post('description');
					$url = 'http://truebulksms.biz/smsapi.php?' . http_build_query([
					'username'=> 'ayurscrub',
						
					'password'=>'',//atulraime
						
					'sender'=>'AYURVD',
					'sendto' => $r->father_mobile,
						
					'message' => $message
					]);
					$ch = curl_init($url);
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
					curl_exec($ch);  // execute
			}
			
			$this->session->set_flashdata('success','<font color="#05BD14">Alert successfully Send...</font>');
				return redirect('admin/falert/',$this->data);
			}
		}
		$this->data['title'] 		= 'Alert';	
		$this->data['active_menu'] 	= 'Falert';
		$this->data['content'] 		= 'admin/falert';
		
		$this->view('admin/falert',$this->data);
	}
	function template()
	{
	
		if($this->uri->segment(3) != '') {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_template'),
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/template');
		}		
		$template = $this->base_model->run_query("select * from tbl_template");		
			$this->data['template'] = $template;
			$this->data['title'] 		= 'Template Details';
			$this->data['active_menu'] 	= 'Template';
			$this->data['content'] 		= 'admin/template';
			$this->view('admin/template',$this->data);
	}
	
	//Add Notification
	function addtemplate($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewtemplateinfo = $this->base_model->run_query("select * from tbl_template where id ='".$id."'");
		$this->data['viewtemplateinfo'] 	= $viewtemplateinfo;
		if(isset($_POST['template_update'])=='')
		{
			$this->form_validation->set_rules('title', 'Notification Title', 'required');
			$this->form_validation->set_rules('description', 'Notification Desc', 'required');
			
			if($this->form_validation->run() == true)
			{				
				$data['title'] 				= $this->input->post('title');		
				$data['description'] 		= $this->input->post('description');
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_template')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Template successfully created...</font>');
				return redirect('admin/template/',$this->data);
			}
		}
		else{	
				$data['title'] 		= $this->input->post('title');			
				$data['description'] 			= $this->input->post('description');
					
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_template'),
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Template successfully Updated....</font>');
					return redirect('admin/template/',$this->data);
		}
		$this->data['title'] 		= 'Template';
		$this->data['active_menu'] 	= 'template';
		$this->data['content'] 		= 'admin/add-template';
		$this->view('admin/add-template',$this->data);
	}	
	
	function leavebalance()
	{
		
		if($this->uri->segment(3) != '') {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('tbl_leave_balance'),
			$where
			);
			$this->prepare_flashmessage("Record Deleted Successfully", 0);
			redirect('admin/leavebalance');
		}		
			$leavebalance = $this->base_model->run_query("select * from tbl_leave_balance");		
			$this->data['leavebalance'] = $leavebalance;
			$this->data['title'] 		= 'Leave Balance';
			$this->data['active_menu'] 	= 'Leavebalance';
			$this->data['content'] 		= 'admin/leavebalance';
			$this->view('admin/leavebalance',$this->data);
	}
	
	//Add Notification
	function addleavebalance($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewleaveinfo = $this->base_model->run_query("select * from tbl_leave_balance where id ='".$id."'");
		$this->data['viewleaveinfo'] 	= $viewleaveinfo;
		if(isset($_POST['leave_balance_update'])=='')
		{
			$this->form_validation->set_rules('empid', 'Employee id', 'required');
			$this->form_validation->set_rules('balance', 'Balance', 'required');			
			if($this->form_validation->run() == true)
			{				
				$data['empid'] 				= $this->input->post('empid');			
				$data['leave_balance'] 		= $this->input->post('balance');
				
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_leave_balance')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Leave Balance successfully created...</font>');
				return redirect('admin/leavebalance/',$this->data);
			}
		}
		else{	
				$data['empid'] 		= $this->input->post('empid');			
				$data['leave_balance'] 	= $this->input->post('balance');
					$where['id'] 		= $this->uri->segment(3);
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_leave_balance'),
					$where
					);
					$this->session->set_flashdata('success','<font color="#05BD14">Leave Balance successfully Updated....</font>');
					return redirect('admin/leavebalance/',$this->data);
		}
		$this->data['title'] 		= 'Leavebalance';
		$this->data['active_menu'] 	= 'leavebalance';
		$this->data['content'] 		= 'admin/add-leavebalance';
		$this->view('admin/add-leavebalance',$this->data);
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

	public function city(){
		$id = $this->input->post('id');		
		$where = array('state_id'=>$id);
		$data = $this->base_model->run_query("select * from tbl_city where state_id ='".$id."'");
		//$data = $this->base_model->select_where('tbl_city',$where);
		echo json_encode($data);
		
	}


	function profile()
	{
		$viewadmininfo = $this->base_model->run_query(
		"select * from tbl_org where Orgid ='".$this->session->userdata('empid')."'");
		$this->data['viewadmininfo'] 	= $viewadmininfo;
		$this->data['coaching'] = $this->base_model->getCoaching();
		//starts by running the query for the countries dropdown  
      $this->data['countryDrop'] = $this->base_model->getCountries();	  
	  $this->data['stateDrop']= $this->base_model->getStateByCountry();	  
	   $this->data['cityDrop']=$this->base_model->getStateByCity();	
		if(isset($_POST['admin_update'])!='')
		{
			$this->form_validation->set_rules('Emailid', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('mobileno', 'Mobile No.', 'required|regex_match[/^[0-9]{10}$/]');

			if($this->form_validation->run() == true)
			{
				
				$data['Orgid'] 				= $this->input->post('org_id');
				
				$data['FirstName'] 			= $this->input->post('FirstName');
				$data['LastName'] 			= $this->input->post('LastName');
				
				$data['emailid'] 			= $this->input->post('Emailid');
				
				$data['communication_address'] 		= $this->input->post('communication_address');
								
				$data['country'] 			= $this->input->post('countriesDrp');
				$data['state'] 				= $this->input->post('StateDrp');
				$data['city'] 				= $this->input->post('cityDrp');
				
			
				$data['update_date'] 		= date('Y-m-d');
					
					$where['Orgid'] 	= $this->session->userdata('empid');
					$this->base_model->update_operation(
					$data,
					$this->db->dbprefix('tbl_org'), 
					$where
					);

					$this->session->set_flashdata('success','<font color="#05BD14">Organization Information successfully Updated....</font>');

					return redirect('admin/profile/',$this->data);	
				
			}
		}
		
			$this->data['title'] 		= 'Profile';
			$this->data['active_menu'] 	= 'profile';
			$this->data['content'] 		= 'admin/profile';
			$this->view('admin/profile',$this->data); 
	}

	function Profilephoto()
	{
		 if ($this->input->post()) {				
				//User Photo Upload Process Start
				$image 						= $_FILES['image']['name'];
			
			//Upload User Photo
				if (!empty($image)) {	
				$where['Orgid'] 		= $this->session->userdata('empid');
					$r = $this->base_model->run_query(
					'select photo_name from '.$this->db->dbprefix('tbl_org')
					.' where Orgid ="'.$where['Orgid'].'"'
					);
					if (count($r) > 0) {
					
						if (file_exists('adminimage/'.$r[0]->photo_name)) {
							unlink('adminimage/'.$r[0]->photo_name);
						}						
					}
					
					//Unset User Image 
					$this->session->unset_userdata('photo_name');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."".$where['Orgid'].".".$ext[1];
					
					$inputdata['photo_name'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'adminimage/'.$img
					);					
					
					//Set User Image
					$this->session->set_userdata('photo_name',$img);
					
				}			
				//Student Photo Upload Process End
				
				$where['Orgid'] 						= $this->session->userdata('empid');				
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('tbl_org'), 
				$where); 
				$this->session->set_flashdata('success','Your Profile Photo successfully updated');
				return redirect('admin/profile');
		 }
				
	}
	
	function Changepassword()
	{
		 if ($this->input->post()) {			 
				//Account Seciont - User Password Information Update Fiedls			
		   		$inputdata['password'] 					= $this->input->post('password');				
				$where['Orgid'] 						= $this->session->userdata('empid');
			 
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
				$this->email->subject('OnlineCMS Organization Login Password Information');
				$this->email->message($template);
			 
			 	$this->email->send();
			 	
				//step for Update
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('tbl_org'), 
				$where); 
				$this->session->set_flashdata('success','Your Password Information successfully updated');
				return redirect('admin/profile');
		 }
	}
	
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
	function categoriess()
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
	function generatecodedetails()
	{
		$Allassigncode = $this->base_model->run_query(
		"select * from tbl_generatecode");
		$this->data['class'] = $this->base_model->getClass();
		$this->data['subject'] = $this->base_model->getSubject();
		
		$this->data['teacher'] = $this->base_model->getTeacher();
		
		$this->data['Allassigncode'] 	= $Allassigncode;
		$this->data['title'] 		= 'generatediscountcode';
		$this->data['active_menu'] 	= 'assignsubject';
		$this->data['content'] 		= 'admin/generatediscountcode';
		$this->view('admin/assigncodedetails',$this->data);
		//if($this->input->post('button2'))
		//{
		//	$post = $this->input->post();
		//	unset($post['button2']);
		//	$name = $this->base_model->insert_operation($post,'tbl_generatecode');
		//	if($name == 1)
			//{
				//$this->session->set_flashdata('sucess','discount code have been generated successfully');
				//redirect('admin/generatediscountcode');
			//}
			//print_r($post);



//}
		//else
		//{
		//$coaching = $this->base_model->getCoaching();
		//$class = $this->base_model->getClass();
		//print_r($class);
		//print_r($coaching);
		//exit();

		//$this->data['coaching'] 		= $coaching;
		//$this->data['class'] 		= $class;

		//$this->data['title'] 		= 'Generate';		
		//$this->data['active_menu'] 	= 'generate';		
		//$this->data['content'] 		= 'admin/generatediscountcode';
		//$this->view('admin/discountcode',$this->data);
		
	}
	function generatediscountcode($id =FALSE)
	{
		$id = $this->uri->segment(3);
		$viewassigncodeinfo = $this->base_model->run_query(
		"select * from tbl_generatecode where id ='".$id."'");
		$this->data['viewassigncodeinfo'] 	= $viewassigncodeinfo;

		if(isset($_POST['dis_update'])=='')
		{

			
			$this->form_validation->set_rules('coaching', 'coaching name', 'required');
			$this->form_validation->set_rules('class', 'class name', 'required');

			if($this->form_validation->run() ==true)
			{	
				$data['coaching'] 			= $this->input->post('coaching');
				$data['class'] 			= $this->input->post('class');
				$data['amount'] 			= $this->input->post('amount');
				$data['code'] 			= $this->input->post('code');
							
			 //step for Insert
				$this->base_model->insert_operation(
							$data,
							$this->db->dbprefix('tbl_generatecode')
							);
			$this->session->set_flashdata('success','<font color="#05BD14">Added discount code successfully Set...</font>');
				return redirect('admin/generatecodedetails/',$this->data);
			}
		}
		elseif(isset($_POST['dis_update'])=='Update'){
			
			
			
				$data['coaching'] 			= $this->input->post('coaching');
				$data['class'] 		= $this->input->post('class');
				$data['amount'] 		= $this->input->post('amount');
				$data['code'] 			= $this->input->post('code');
										
				//$data['status'] 			= 'Active';
				$where['id'] 				= $this->input->post('id');
					$this->base_model->update_operation($data,$this->db->dbprefix('tbl_generatecode'),$where);
					$this->session->set_flashdata('success','<font color="#05BD14">discount code successfully Updated....</font>');
					return redirect('admin/generatecodedetails/',$this->data);
		}
		
		//else
		//{
		//$coaching = $this->base_model->getCoaching();
		//$class = $this->base_model->getClass();
		//print_r($class);
		//print_r($coaching);
		//exit();

		//$this->data['coaching'] 		= $coaching;
		//$this->data['class'] 		= $class;
		//$this->data['title'] 		= 'generatediscountcode';
		//$this->data['active_menu'] 	= 'assignsubject';
		//$this->data['content'] 		= 'admin/generatediscountcode';
		//$this->view('admin/discountcode',$this->data);
		//}
		$coaching = $this->base_model->getCoaching();
		$class = $this->base_model->getClass();
		$this->data['coaching'] 		= $coaching;
		$this->data['class'] 		= $class;
		$this->data['title'] 		= 'generatediscountcode';
		$this->data['active_menu'] 	= 'assignsubject';
		$this->data['content'] 		= 'admin/generatediscountcode';
		$this->view('admin/discountcode',$this->data);
		


	}
	function deletediscountcode($id)
	{
		$table = "tbl_generatecode";
		$where['id'] = $id;
		$this->base_model->delete_record($table,$where);
		redirect('admin/generatecodedetails');


	}
	
	

	function getpayablefees()
	{
		$code = $this->input->post('code');
		$fees =  $this->input->post('fee');


		$coaching = $this->base_model->getcodediscount($code);
		$finalamount = $fees-$coaching->amount;
		echo $finalamount;
		//echo $coaching->amount;
		

	}
	
	function kyc_details()
	{
		$kycuser = $this->base_model->run_query(
		"select *, k.id as kid from kyc_docs k
		left join mlm_members_detail m
		on k.uid = m.applicant_no
		");
		
		if(isset($kycuser)){
			$this->data['kycusers'] = $kycuser;
		}else{
			$this->data['kycusers'] = array();
		}
		//echo "<pre>"; print_r($this->data['kycusers']); exit;
		$this->data['title'] 				= 'Kyc List';		
		$this->data['active_menu'] 			= 'admin';
		$this->data['content'] 				= 'admin/kyclist';
		$this->view('admin/kyclist',$this->data); 
	}

	function approvekyc(){
		if($_POST['id']){
			$id = $_POST['id'];
			
			$data = array(
				'approve' => 1
			);

			$this->db->where('id', $id);
			$this->db->update('kyc_docs', $data);
		}
	}

	function deletekyc(){
		if($_POST['id']){
			$id = $_POST['id'];
			
			$this->db->where('id', $id);
			$this->db->from('kyc_docs');
			$query = $this->db->get();
			$row = $query->row();
			if(unlink("./uploads/doc_".$row->uid."/".$row->pancard)){
				//echo "pan card deleted";
			}else{
				//echo "no pan card";
			}
			
			if(unlink("./uploads/doc_".$row->uid."/".$row->aadharcard)){
				//echo "aadhar card deleted";
			}else{
				//echo "no aadhar card";
			}
			
			$this->db->delete('kyc_docs', array('id' => $id));
		}
	}
}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */

<?php
error_reporting(0);
class Ledger extends CI_Controller
{
public function __construct()
{				
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('url');
		$this->load->library('session');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");		
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
	
	public function ledgerview($file,$data='')
	{
	$role_id = $this->getid($this->session->userdata('role'));
	$result = $this->db->query("select * from main_menu a inner join menu_user b on a.id=b.menu_id where a.menu_type='1' and b.user_id='".$this->session->userdata('empid')."' and b.eid='".$role_id."' and
	a.menu_status='active' order by a.seq");
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
	$this->load->view('ledger/ledgerheader',$data);
	$this->load->view('ledger/ledgersidebar',$data);
	$this->load->view($file,$data);
    $this->load->view('ledger/ledgerfooter',$data);	
	}
	
	public function index()
	{
	$this->ledgerview('ledger/ledgerprofile','');	
	}
	
	function get_menu($parent)
	{
	$role_id = $this->getid($this->session->userdata('role'));
	$this->db->select("*");
	$this->db->from("main_menu a");
	$this->db->join("menu_user b",'a.id=b.menu_id','Inner Join');
    $this->db->where("a.menu_parent",$parent);
	$this->db->where("a.menu_status",'active');
	$this->db->where("b.user_id",$this->session->userdata('empid'));
	$this->db->where("b.eid",$role_id);
	$this->db->order_by("a.seq");
	$result=$this->db->get();
	return $result->result_array();	
	}
}

?>
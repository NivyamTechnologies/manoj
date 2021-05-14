<?php
error_reporting(0);
class Puc extends MY_Controller
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
	
	
	function pucdetail($id)
	{
	$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='puc' and a.member_id='".$id."'");
    return $alluser;		
	}
	
	public function pucview($file,$data='')
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
	$this->load->view('puc/pucheader',$data);
	$this->load->view('puc/pucsidebar',$data);
	$this->load->view($file,$data);
    $this->load->view('puc/pucfooter',$data);	
	}
	
	public function pucview1($file,$data='')
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
	$this->load->view('puc/pucheader',$data);
	$this->load->view('puc/pucsidebar',$data);
	$this->load->view($file,$data);	
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

	function index()
	{
		return redirect('puc/profile',$this->data);
	}

	public function profile()
	{
	$data['total'] = $this->gettotalamount();
	$data['currentbv'] = $this->gecurrentbv();
	$data['rpcommission'] = $this->gecurrentrpcommission();
	$data['userview'] = $this->getprofilepic();


	$this->pucview('puc/profile',$data);	
	}


	function myprofile($id='')
	{ 
	    if($id=='')
		{
		$id = $this->session->userdata('member_id'); 
		}
		$alluser = $this->base_model->run_query("
		SELECT * FROM mlm_puc_detail
left join mlm_members_login 
on  mlm_puc_detail.applicant_no = mlm_members_login.applicant_no
LEFT JOIN mlm_state_master 
on mlm_puc_detail.state = mlm_state_master.state_id
LEFT JOIN mlm_city_master
on mlm_city_master.id = mlm_puc_detail.district
where mlm_puc_detail.applicant_no = '".$this->session->userdata('applicant_no')."'

		");
		
		$data['userview'] 	=  $alluser;		
		$this->pucview('puc/myprofile',$data); 
	}


	function getprofilepic()
	{
		$result = $this->base_model->run_query("SELECT a.applicant_no,b.date FROM `mlm_puc_detail` a,`mlm_members_login` b WHERE a.applicant_no = '".$this->session->userdata('applicant_no')."' and a.applicant_no=b.applicant_no");
		return $result; 	
	}
	
	
	function gettotalamount()
	{
	$result = $this->db->query("SELECT SUM(totalbv) as totalbv,SUM(totaldp) as totaldp FROM `mlm_puc_chalan` WHERE branch_id = '".$this->session->userdata('applicant_no')."'");
    return $result->result_array(); 	
	}
	
	function gecurrentbv()
	{
	$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_puc_chalan` WHERE branch_id = '".$this->session->userdata('applicant_no')."' and MONTH(`datetime`) = MONTH(CURRENT_DATE())");
    return $result->result_array(); 	
	}

	function gecurrentrpcommission()
	{
	$result = $this->db->query("SELECT (sum(ifnull(totalmrp,0)) -sum(ifnull(totalwithtax,0))) rpcomm from mlm_dist_chalan where billfromtype!=9 and  createby = '".$this->session->userdata('empid')."' and MONTH(`datetime`) = MONTH(CURRENT_DATE())");
    return $result->result_array(); 	
	}

	function manage_avl_quan($productid,$quantity)
	{
	$this->db->query("update tbl_product_inventory set product_quantity = (product_quantity-$quantity) where id = $productid");	
	}
	
	function manage_avl_quan_puc($appno,$productid,$quantity)
	{
	$this->db->query("update puc_product_details set pucproductquantity = (pucproductquantity-$quantity) where productid = '".$productid."' and applicant_no = '".$appno."'");	
	}

	public function adddistchalanIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
	    $pps='';
		foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		}
	
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/adddistchalanIGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 1;
			
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
	$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,1);
		if(empty($snno))
		{
	    $snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$chalanarray['billfromtype'] = 2;
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
        $this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$chdetail = $this->addscheme_product($this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'igst');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/distchalanviewIGST');		
		}
		
		
		$data['allproduct'] 	= json_encode($proarray);
		//$data['title'] 		= 'PUC';
		//$data['active_menu'] 	= 'Bill';
		//$data['content'] 		= 'puc/add-distchalanIGST';
		$this->pucview1('puc/add-distchalanIGST',$data);
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
	
	
	function distchalanviewIGST()
	{

		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =1 and createby = '".$this->session->userdata('empid')."'  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->pucview1('puc/distchalanviewIGST',$this->data); 
	}
	
	function distchalanIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->pucdetail($this->session->userdata('empid'));
	
        $this->data['pucdata'] 		=  $detail;		
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->load->view('puc/distchalanIGST',$this->data); 
	}
	

	function adddistchalanCGSTNew($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
		foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/adddistchalanCGST');
		}
		if($this->input->post('total')<1000)
		{
			$this->session->set_flashdata('success','<font color="red">Bill Amount maximum 1000</font>');
			redirect('puc/adddistchalanCGSTNew');
		}


		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalrp'] =$this->input->post('totalrp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 2;
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
	$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,2);
		if(empty($snno))
		{
	    $snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$chalanarray['billfromtype '] = 9;
		$this->db->insert('mlm_dist_chalan',$chalanarray);
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
        $chalandetailarray['schemeid'] =0;		
		$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		
        $chdetail = $this->addscheme_product($this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'cgst');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/distchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->pucview1('puc/add-distchalanCGSTNew',$this->data);
	}


    function adddistchalanCGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
		foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/adddistchalanCGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalrp'] =$this->input->post('totalrp');
		$chalanarray['totalmrp'] =$this->input->post('totalmrp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 2;
		$chalanarray['chalantype'] = 2;
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
	$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,2);
		if(empty($snno))
		{
	    $snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$chalanarray['billfromtype '] = 2;
		$this->db->insert('mlm_dist_chalan',$chalanarray);
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
        $chalandetailarray['schemeid'] =0;		
		$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		
        $chdetail = $this->addscheme_product($this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'cgst');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/distchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->pucview1('puc/add-distchalanCGST',$this->data);
	}

	function distchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =2 and createby = '".$this->session->userdata('empid')."'  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->pucview1('puc/distchalanviewCGST',$this->data); 
	}
	
	function distchalanCGST($chalanid)
	{
        $alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->pucdetail($this->session->userdata('empid'));	
        $this->data['pucdata'] 		=  $detail;		
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/distchalanCGST';
		$this->load->view('puc/distchalanCGST',$this->data); 
	}
	


	function addpucchalanIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
	    foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] = $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
			if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/addpucchalanIGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 1;
			
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,1);
		if(empty($snno))
		{
	    $snno =1;
		}
		$chalanarray['s_no'] = $snno;
        $chalanarray['billfromtype '] = 2;
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
		$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_puc_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/pucchalanviewIGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->pucview1('puc/add-pucchalanIGST',$this->data);
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
		$this->load->view('puc/pucchalanIGST',$this->data); 
	}
	
	function pucchalanviewIGST()
	{
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =1 and createby = '".$this->session->userdata('empid')."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->pucview1('puc/pucchalanviewIGST',$this->data); 
	}

    function pucchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =2 and createby = '".$this->session->userdata('empid')."' and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->pucview1('puc/pucchalanviewCGST',$this->data); 
	}
	
	
	
	
	function addpucchalanCGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
	    foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] 	= $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/addpucchalanCGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 2;
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,2);
		if(empty($snno))
		{
	    $snno =1;
		}
		$chalanarray['s_no'] = $snno;

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'puc';
		$chalanarray['billfromtype '] = 2;
		$this->db->insert('mlm_puc_chalan',$chalanarray);
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
		$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_puc_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/pucchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->pucview1('puc/add-pucchalanCGST',$this->data);
	}
    
    
	//$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
	function pucchalanCGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->pucdetail($this->session->userdata('empid'));	
        $this->data['pucdata'] 		=  $detail;		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/pucchalanCGST';
		$this->load->view('puc/pucchalanCGST',$this->data); 
	}
	
	

   function adddistchalanwithouttaxIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
	    foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] = $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		}
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/adddistchalanwithouttaxIGST');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalrp'] =$this->input->post('totalrp');
		$chalanarray['totalmrp'] =$this->input->post('totalmrp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 3;
		$chalanarray['billfromtype'] = 2;
			
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_dist_chalan WHERE  date(datetime)>='2020-04-01' and  createby = '".$this->session->userdata('empid')."' and chalantype='3' and billfromtype='2'");
		
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
        $this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$mobile_no =$this->db->query("select mobile_no from mlm_members_detail where applicant_no='".$chalanarray['branch_id']."'")->row();
        $chdetail = $this->addscheme_product($this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		// $this->sendsmsbill($mobile_no->mobile_no,$chalanarray['branch_name'],$chalanarray['totaldp'],$chalanarray['totalbv']);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/distchalanviewwithouttaxIGST');		
		}
	
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		//$this->pucview1('puc/add-distchalanwithouttaxIGST',$this->data);
		$this->pucview1('puc/add-distchalanwithouttaxIGST',$this->data);
	}

	

	function adddistchalanwithouttaxIGSTNew($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category");
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
	    foreach($assignproduct as $ass)
		{
		$pps[] = $ass['productid'];	
		}
		$this->data['viewcategoryinfo'] = $viewcategoryinfo;
		foreach($Allproduct as $pro)
		{
		if(in_array($pro->id,$pps))
		{
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		}
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('puc/adddistchalanwithouttaxIGSTNew');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalrp'] =$this->input->post('totalrp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 3;
		$chalanarray['billfromtype'] = 9;
			
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_dist_chalan WHERE  date(datetime)>='2018-04-01' and  createby = '".$this->session->userdata('empid')."' and chalantype='3' and billfromtype='2'");
		
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
        $this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
		}
		$mobile_no =$this->db->query("select mobile_no from mlm_members_detail where applicant_no='".$chalanarray['branch_id']."'")->row();
        $chdetail = $this->addscheme_product($this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		// $this->sendsmsbill($mobile_no->mobile_no,$chalanarray['branch_name'],$chalanarray['totaldp'],$chalanarray['totalbv']);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('puc/distchalanviewwithouttaxIGST');		
		}
	
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		//$this->pucview1('puc/add-distchalanwithouttaxIGST',$this->data);
		$this->pucview1('puc/add-distchalanwithouttaxIGSTNew',$this->data);
	}



	public function sendsmsbill($mobile_no,$branch_name,$totaldp,$totalbv)
	{
	$totaldp = round($totaldp,2);
	$user='bvmbusinesstxn';                                                         // Here Varible $user Holds Your SMS Panel USERID
	$pass='472722';                                                         // Here Varible $pass Holds Your SMS Panel Password
	$senderid='BVMBUS';                                                        // Here Varible $senderid Holds the sms SenderID Which Apper on the message
	$msg= "Dear+".urlencode($branch_name)."Your+Bill+Value+DP+:".urlencode($totaldp)."/+BV:+".urlencode($totalbv)."/+Thanks+Any+Queries+01204132645";	
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
    
	
	function distchalanwithouttaxIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
	    $detail = $this->pucdetail($this->session->userdata('empid'));
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;	
        $this->data['pucdata'] 		=  $detail;			
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->load->view('puc/distchalanwithouttaxIGST',$this->data); 
	}
	
	function distchalanviewwithouttaxIGST()
	{$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =3 and createby = '".$this->session->userdata('empid')."' and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->pucview1('puc/distchalanviewwithouttaxIGST',$this->data); 
	}
	
	
	function pucchalanviewaddquantity()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.chalan_id,mlm_puc_chalan.branch_id,mlm_puc_chalan.branch_name,mlm_puc_chalan.transport,mlm_puc_chalan.datetime,mlm_puc_chalan.chalantype,mlm_puc_chalan.receive from mlm_puc_chalan where branch_id = '".$this->session->userdata('applicant_no')."'  and date(datetime)>='".$dd."'");
		//$alluser = $this->base_model->run_query("select mlm_puc_chalan.chalan_id,mlm_puc_chalan.branch_id,mlm_puc_chalan.branch_name,mlm_puc_chalan.transport,mlm_puc_chalan.datetime,mlm_puc_chalan.chalantype,mlm_puc_chalan.receive from mlm_puc_chalan where branch_id = '".$this->session->userdata('applicant_no')."' union select mlm_scheme_chalan.chalan_id,mlm_scheme_chalan.branch_id,'no' as branch_name,'no' as transport,mlm_scheme_chalan.datetime,mlm_scheme_chalan.billfromtype as chalantype,mlm_scheme_chalan.receive from mlm_scheme_chalan where branch_id = '".$this->session->userdata('applicant_no')."'");
		
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->pucview1('puc/pucchalanviewadmin',$this->data); 
	}
   
    function manage_avl_quan_puc_add($appno,$productid,$quantity)
	{
	$this->db->query("update puc_product_details set pucproductquantity = (pucproductquantity+$quantity) where productid = '".$productid."' and applicant_no = '".$appno."'");	
	}
	
	function receivequantity($chalanid,$applicantno)
	{
	$chalandata = $this->base_model->run_query(
		"select a.*,b.product_id,b.quantity from mlm_puc_chalan a left join mlm_puc_chalan_detail b on a.chalan_id=b.chalan_id where a.chalan_id = '".$chalanid."' and a.branch_id = '".$applicantno."'");
	foreach($chalandata as $p)
	{
    $this->manage_avl_quan_puc_add($p->branch_id,$p->product_id,$p->quantity);
	}
	$this->db->query("update mlm_puc_chalan set receive=1 where chalan_id ='".$chalanid."'");
	$this->session->set_flashdata('success','<font color="#05BD14">Quantity receive successfully for products against chalan...</font>');
    redirect('puc/pucchalanviewaddquantity');
    }
	
	function receivequantityscheme($chalanid,$applicantno)
	{
	$chalandata = $this->base_model->run_query("select a.* from mlm_scheme_chalan a  where a.chalan_id = '".$chalanid."' and a.branch_id = '".$applicantno."'");
	foreach($chalandata as $p)
	{
    //$this->manage_avl_quan_puc_add($p->branch_id,$p->product_id,$p->quantity);
	}
	$this->db->query("update mlm_scheme_chalan set receive=1 where chalan_id ='".$chalanid."'");
	$this->session->set_flashdata('success','<font color="#05BD14">Quantity receive successfully for products against chalan...</font>');
    redirect('puc/pucchalanviewaddquantity');
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
		$this->data['uid'] =$this->session->userdata('empid');
		$allstock = $this->base_model->run_query(
		"SELECT productname as product_name,productid as id,open_quantity as total_quantity,(SELECT sum(`quantity`) FROM mlm_puc_chalan join `mlm_puc_chalan_detail` on mlm_puc_chalan.chalan_id=mlm_puc_chalan_detail.chalan_id WHERE `product_id` = puc_product_details.productid and mlm_puc_chalan.receive = '1' and (datetime)>='2020-04-01' and branch_id = '".$this->session->userdata('applicant_no')."')  as receive FROM `puc_product_details` where applicant_no = '".$this->session->userdata('applicant_no')."'");
		$this->data['allstock'] 		=  $allstock;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'All Bill List';
		$this->data['content'] 		= 'admin/TotalStock';
		$this->pucview1('puc/TotalStock',$this->data); 
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
		$this->data['uid'] =$this->session->userdata('empid');
		$allstock = $this->base_model->run_query(
		"SELECT productname as product_name,productid as id,open_quantity as total_quantity,(SELECT sum(`quantity`) FROM mlm_puc_chalan join `mlm_puc_chalan_detail` on mlm_puc_chalan.chalan_id=mlm_puc_chalan_detail.chalan_id WHERE `product_id` = puc_product_details_old.productid and mlm_puc_chalan.receive = '1' and (datetime)>='2018-04-01' and (datetime)<='2020-04-01' and branch_id = '".$this->session->userdata('applicant_no')."')  as receive FROM `puc_product_details_old` where applicant_no = '".$this->session->userdata('applicant_no')."'");
		$this->data['allstock'] 		=  $allstock;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'All Bill List';
		$this->data['content'] 		= 'admin/TotalStock';
		$this->pucview1('puc/TotalStock',$this->data); 
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
	//$this->db->query("update $updatetable set product_quantity = product_quantity + ".$val['qun'].",total_quantity = total_quantity + ".$val['qun']." where id = '".$val['id']."'");
	$this->manage_avl_quan_puc_add($this->session->userdata('applicant_no'),$val['id'],$val['qun']);
	}
	$this->db->query("delete from $table where chalan_id = '".$chalanno."'");
	$this->db->query("delete from $subtable where chalan_id = '".$chalanno."'");
	redirect("puc/".$redirect);
	}
	
	function pucviewschemedata()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		//$mainquery = "SELECT * FROM `scheme_process` where createby = '".$this->session->userdata('empid')."' and date(datetime)>='".$dd."'"; 
		$mainquery = "SELECT * FROM  scheme_process left join tbl_scheme on scheme_process.scheme_id = tbl_scheme.id 
		where createby = '".$this->session->userdata('empid')."' and date_end >= '".$dd."' "; 
	$Allscheme = $this->base_model->run_query($mainquery);	
	$this->data['Allscheme'] 	= $Allscheme;		
	$this->data['title'] 		= 'scheme';
	$this->data['active_menu'] 	= 'scheme';
	$this->data['content'] 		= 'admin/scheme';
	$this->pucview1('puc/pucviewschemedata',$this->data);
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
		$this->load->view('admin/schemechalan',$this->data); 
	}
	function pucledgernew()
	{
		$member_id = $this->session->userdata('empid');
		$id=$this->session->userdata('applicant_no');
	
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
		   $branchpp = '2020-03-31';
		$branchledger = $this->base_model->run_query(
			"select * from ( select 'sale' paymentby ,s_no,branch_id,branch_name,createby,totaldp,0 amount,datetime from mlm_dist_chalan where createby='".$member_id."' 
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
			$this->pucview1('puc/pucledgernew',$this->data); 
		}



	
}

?>

<?php
error_reporting(0);
class Branch extends CI_Controller
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
	function branchdetail($id)
	{
	$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,
		(select city_name from  mlm_city_master where  mlm_city_master.id = b.district) as districtname,
		(select city_name from  mlm_city_master where  mlm_city_master.id = b.bvmpuc_dist) as bvmpucdistrictname,
		(select role_id from mlm_member_role where rolekey = a.role) as role,a.status,b.* from mlm_members_login as a left join mlm_branch_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_district_master g on 
		b.district = g.id where a.role='branch' and a.member_id='".$id."'");
    return $alluser;		
	}

    public function branchview($file,$data='')
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
	$this->load->view('branch/branchheader',$data);
	$this->load->view('branch/branchsidebar',$data);
	$this->load->view($file,$data);
    $this->load->view('branch/branchfooter',$data);	
	}
	
	function getpucledgerdata()
	{
	       $brno = $_POST['no'];
		   $query =$this->db->query(
		"select member_id from mlm_members_login where applicant_no='".$brno."'");
		$member_id = $query->result_array();
		 
		 
		$final1 = $this->base_model->creditlimitpuc($brno,$member_id[0]['member_id']) ;
        $this->session->set_userdata('final1', $final1);
	echo $final1;

	}
	public function branchview1($file,$data='')
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
	$this->load->view('branch/branchheader',$data);
	$this->load->view('branch/branchsidebar',$data);
	$this->load->view($file,$data);	
	}
	
	public function index()
	{
	
		return redirect('branch/adddistchalanCGST',$this->data);

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
    function branchledger()
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
			"select * from ( select  'sale' paymentby,s_no,branch_id,branch_name,createby,totalwithtax as totaldp,0 amount,datetime from mlm_dist_chalan where createby= '".$this->session->userdata('empid')."'
			and datetime >= '2018-04-01 10:50:41' 
            union all select  paymentby,'' a,recid,name,narration,amount,0,date
            from mlm_transaction 
			where transtype='4' and byid='".$this->session->userdata('empid')."' and date >= '2018-04-01'
            union all
            select  paymentby,'' a,recid,name,narration,0,amount,date 
            from mlm_transaction where transtype='4' and recid = '".$this->session->userdata('applicant_no')."' and date >= '2018-04-01'
			union all    select '', '' sno,'' a ,'Opening Balance' b ,'Opening Balance' f,ifnull(opening_balance,0) ,'' d ,'2018-04-01'  e   from mlm_branch_detail
            where applicant_no= '".$this->session->userdata('applicant_no')."' )v1 order by datetime
 ");

			$this->data['branchledger'] 	= $branchledger;
			$this->data['title'] 				= 'DP List';		
			$this->data['active_menu'] 			= 'admin';
			$this->data['content'] 				= 'admin/branchledger';
			$this->branchview1('branch/branchledger',$this->data); 
		}
	
	function addpucchalanIGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
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
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Igst'=>$pro->total_taxIGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('branch/addpucchalanIGST');
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
		$chalanarray['role'] = 'puc';
		$chalanarray['billfromtype '] = 2;
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
        redirect('branch/pucchalanviewIGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->branchview1('branch/add-pucchalanIGST',$this->data);
	}
        
	function manage_avl_quan($productid,$quantity)
	{
	$this->db->query("update tbl_product_inventory set product_quantity = (product_quantity-$quantity) where id = $productid");	
	}
	
	function manage_avl_quan_puc($appno,$productid,$quantity)
	{
		
	$this->db->query("update puc_product_details set pucproductquantity = (pucproductquantity-$quantity) where productid = '".$productid."' and applicant_no = '".$appno."'");	
	}

	function manage_avl_quan_puc_min($appno,$productid,$quantity)
	{
	
	$this->db->query("update puc_product_details set pucproductquantity = (pucproductquantity-$quantity) where productid = '".$productid."' and applicant_no = '".$appno."'");	
	}
	
	function manage_otp($otp)
	{
	$this->db->query("update mlm_ticket_chalan set status = 'deactive' where s_no = '".$otp."'");	
	}
	

	function pucchalanIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));
		$this->data['branchdetail'] 		=  $detail;
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->load->view('branch/pucchalanIGST',$this->data); 
	}
	
	function list()
	{
		$alluser = $this->base_model->run_query(
							"SELECT *,(CASE WHEN transtype = 1 THEN 'Payment'
WHEN transtype = 2 THEN 'General'
WHEN transtype = 3 THEN 'Contra'
WHEN transtype = 4 THEN 'Receive'
ELSE ''   
END)Type FROM mlm_transaction where byid = '".$this->session->userdata('empid')."' ");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/list';
		$this->branchview1('branch/list',$this->data); 
	}
	
	function pucchalanviewIGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype = 1 and createby = '".$this->session->userdata('empid')."'  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->branchview1('branch/pucchalanviewIGST',$this->data); 
	}

    function pucchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalantype =2 and createby = '".$this->session->userdata('empid')."'  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->branchview1('branch/pucchalanviewCGST',$this->data); 
	}
	
		function pucchalanviewaddquantity()
	    {
			$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where branch_id = '".$this->session->userdata('applicant_no')."'  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->branchview1('branch/pucchalanviewadmin',$this->data); 
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
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
			$save= true;
			
				$final1=	$this->session->userdata('final1');
		
			
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('branch/addpucchalanCGST');
		}
		if($final1<0)
		{
			echo "<script> alert('Ledger amount  less than')</script>";
			$save= false;
		}
		else{
			if($final1<$this->input->post('totaldp'))
			{	$save= false;
				echo "<script> alert('Ledger amount Less than')</script>";
					
			}
		}
		
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['totalrp'] =$this->input->post('totalrp');
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
		
		
		/*$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_puc_chalan WHERE role='puc' and  and billfromtype = '2' and date(datetime)>='2018-04-01'  and date(datetime)>='2018-04-01' createby = '".$this->session->userdata('empid')."'");
		
		if($snno[0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else{
			$chalanarray['s_no'] = '1';			
		}*/

		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'puc';
		$chalanarray['billfromtype '] = 2;
		if($save)
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
		if($save){
		$this->db->insert_batch('mlm_puc_chalan_detail',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
		redirect('branch/pucchalanviewCGST');	
		}	
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->branchview1('branch/add-pucchalanCGST',$this->data);
	}
    
	function addbranchcgstscheme_product($appno,$amount,$date,$productarray,$chalanid,$type)
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
			$this->manage_avl_quan_puc_min($this->session->userdata('applicant_no'),$chalandetailarray['product_id'],$chalandetailarray['quantity']);		
			$productarray[] = $chalandetailarray;
				
			}	
			}
			}
	return $productarray;
	}
	
	
	function addbranchcgstscheme_productNew($appno,$amount,$date,$productarray,$chalanid,$type)
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
			$this->manage_avl_quan_puc_min($this->session->userdata('applicant_no'),$chalandetailarray['product_id'],$chalandetailarray['quantity']);		
			$productarray[] = $chalandetailarray;
				
			}	
			}
			}
	return $productarray;
	}
	
	//$this->manage_avl_quan($this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);
	function pucchalanCGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_puc_chalan.* from mlm_puc_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_puc_detail as b on 
		a.applicant_no=b.applicant_no where a.role='puc' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));	
        $this->data['branchdetail'] 		=  $detail;		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/pucchalanCGST';
		$this->load->view('branch/pucchalanCGST',$this->data); 
	}
	
	function branchchalanviewaddquantity()
	{
		
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		
		$alluser = $this->base_model->run_query(
		"select mlm_branch_chalan.* from mlm_branch_chalan where billfromtype = 1 and branch_id = '".$this->session->userdata('applicant_no')."' and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'IGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewIGST';
		$this->branchview1('branch/branchchalanviewadmin',$this->data); 
	}
   
    function manage_avl_quan_puc_add($appno,$productid,$quantity)
	{
	$this->db->query("update puc_product_details set pucproductquantity = (pucproductquantity+$quantity) where productid = '".$productid."' and applicant_no = '".$appno."'");	
	}
	
	function receivequantity($chalanid,$applicantno)
	{
	$chalandata = $this->base_model->run_query(
		"select a.*,b.product_id,b.quantity from mlm_branch_chalan a left join mlm_branch_chalan_detail b on a.chalan_id=b.chalan_id where a.chalan_id = '".$chalanid."' and a.branch_id = '".$applicantno."'");
	foreach($chalandata as $p)
	{
    $this->manage_avl_quan_puc_add($p->branch_id,$p->product_id,$p->quantity);
	}
	$this->db->query("update mlm_branch_chalan set receive=1 where chalan_id ='".$chalanid."'");
	$this->session->set_flashdata('success','<font color="#05BD14">Quantity receive successfully for products against chalan...</font>');
	redirect('branch/branchchalanviewaddquantity');
	
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
		$this->load->view('branch/chalanview',$this->data); 
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
			"SELECT productname as product_name,productid as id,open_quantity as total_quantity,
			(SELECT sum(`quantity`) FROM mlm_branch_chalan join `mlm_branch_chalan_detail`
			 on mlm_branch_chalan.chalan_id=mlm_branch_chalan_detail.chalan_id 
			 WHERE `product_id` = puc_product_details.productid and billfromtype = 1 and receive=1 and branch_id = '".$this->session->userdata('applicant_no')."' and (datetime)>='2019-04-01') as receive ,
			(SELECT sum(quantity) as quan FROM `mlm_puc_chalan`
			 join mlm_puc_chalan_detail on mlm_puc_chalan.chalan_id = mlm_puc_chalan_detail.chalan_id 
			 where `product_id` = puc_product_details.productid and billfromtype = 2 and createby = '". $this->session->userdata('empid')."'  and (datetime)>='2019-04-01') as sale1,   
		   (select sum(quantity) as quan from mlm_dist_chalan
			join mlm_dist_chalan_detail on mlm_dist_chalan.chalan_id=mlm_dist_chalan_detail.chalan_id
			 where `product_id` = puc_product_details.productid and  billfromtype in (2,9) and createby =  '". $this->session->userdata('empid')."'  and (datetime)>='2019-04-01' and schemeid=0) as sale,
		   (SELECT sum(quantity) as quan FROM mlm_scheme_chalan 
				where product_id = puc_product_details.productid and billfromtype = 2
				 and createby = '". $this->session->userdata('empid')."' and (datetime)>='2019-04-01') as scheme1,
			   (select sum(quantity) as quan from 
			   mlm_dist_chalan join mlm_dist_chalan_detail 
			   on mlm_dist_chalan.chalan_id=mlm_dist_chalan_detail.chalan_id
				where product_id = puc_product_details.productid
			   and  billfromtype = 2 and   
			   createby = '". $this->session->userdata('empid')."' and (datetime)>='2019-04-01' and product_total=0)  as scheme   
		   FROM `puc_product_details` where applicant_no =  '".$this->session->userdata('applicant_no')."'");
		   
			$this->data['allstock'] 		=  $allstock;		
			$this->data['title'] 		= 'Bill List';
			$this->data['active_menu'] 	= 'All Bill List';
			$this->data['content'] 		= 'admin/TotalStock';
			$this->branchview1('branch/TotalStock',$this->data); 
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
			"SELECT productname as product_name,productid as id,open_quantity as total_quantity,
			(SELECT sum(`quantity`) FROM mlm_branch_chalan join `mlm_branch_chalan_detail`
			 on mlm_branch_chalan.chalan_id=mlm_branch_chalan_detail.chalan_id 
			 WHERE `product_id` = puc_product_details_old.productid and billfromtype = 1 and receive=1 and branch_id = '". $this->session->userdata('applicant_no')."' and (datetime)<'2019-04-01' and (datetime)>='2018-04-01'  ) as receive ,
			(SELECT sum(quantity) as quan FROM `mlm_puc_chalan`
			 join mlm_puc_chalan_detail on mlm_puc_chalan.chalan_id = mlm_puc_chalan_detail.chalan_id 
			 where `product_id` = puc_product_details_old.productid and billfromtype = 2 and createby = '". $this->session->userdata('empid')."'  and (datetime)<'2019-04-01'  and (datetime)>='2018-04-01' ) as sale1,   
		   (select sum(quantity) as quan from mlm_dist_chalan
			join mlm_dist_chalan_detail on mlm_dist_chalan.chalan_id=mlm_dist_chalan_detail.chalan_id
			 where `product_id` = puc_product_details_old.productid and  billfromtype = 2 and createby = '". $this->session->userdata('empid')."' and (datetime)<'2019-04-01'  and (datetime)>='2018-04-01' and schemeid=0) as sale,
		   (SELECT sum(quantity) as quan FROM mlm_scheme_chalan 
				where product_id = puc_product_details_old.productid and billfromtype = 2
				 and createby = '". $this->session->userdata('empid')."' and (datetime)<'2019-04-01' and (datetime)>='2019-02-01') as scheme1,
			   (select sum(quantity) as quan from 
			   mlm_dist_chalan join mlm_dist_chalan_detail 
			   on mlm_dist_chalan.chalan_id=mlm_dist_chalan_detail.chalan_id
				where product_id = puc_product_details_old.productid
			   and  billfromtype = 2 and   
			   createby = '". $this->session->userdata('empid')."' and (datetime)<'2019-04-01' and (datetime)>='2019-02-01'  and product_total=0)  as scheme   
		   FROM puc_product_details_old where applicant_no =  '".$this->session->userdata('applicant_no')."'");
		   
			$this->data['allstock'] 		=  $allstock;		
			$this->data['title'] 		= 'Bill List';
			$this->data['active_menu'] 	= 'All Bill List';
			$this->data['content'] 		= 'admin/TotalStock';
			$this->branchview1('branch/TotalStock',$this->data); 
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
	redirect("branch/".$redirect);
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
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=> $pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_rp'=>$pro->product_rp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('branch/adddistchalanCGST');
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
		$chalandetailarray['cgst'] = round($this->input->post('cgst')[$i],2);
		$chalandetailarray['sgst'] = round($this->input->post('sgst')[$i],2); 
		$chalandetailarray['total'] = round($this->input->post('taxpricetotal')[$i],2); 
        $chalandetailarray['tax_rate'] = $this->input->post('tax_rate')[$i];
		$chalandetailarray['tax_rate_cgst'] = round($this->input->post('tax_rate_cgst')[$i],2);
		$chalandetailarray['tax_rate_sgst'] = round($this->input->post('tax_rate_sgst')[$i],2); 
		
		
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
        $chdetail = $this->addbranchcgstscheme_product($this->session->userdata('applicant_no'),$this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'cgst');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->sendsmsbill($mobile_no->mobile_no,$chalanarray['branch_name'],$chalanarray['totalrp'],$chalanarray['totalbv']);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
	   
		redirect('branch/distchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->branchview1('branch/add-distchalanCGST',$this->data);
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
        redirect('branch/adddistchalanCGST');
		}
		if($this->input->post('total')<1000)
		{
			$this->session->set_flashdata('success','<font color="red">Bill Amount maximum 1000</font>');
			redirect('branch/adddistchalanCGSTNew');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['transport'] =$this->input->post('transport');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalrp'] =$this->input->post('totalrp');
		$chalanarray['totalbv'] =$this->input->post('totalbv');
		$chalanarray['dcomisson'] =$this->input->post('distributorcommission');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['chalantype'] = 6;
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
		$mobile_no =$this->db->query("select mobile_no from mlm_members_detail where applicant_no='".$chalanarray['branch_id']."'")->row();
        $chdetail = $this->addbranchcgstscheme_productNew($this->session->userdata('applicant_no'),$this->input->post('total'),date('Y-m-d'),$chdetail,$lastid,'cgst');
		$this->db->insert_batch('mlm_dist_chalan_detail',$chdetail);
		$this->sendsmsbill($mobile_no->mobile_no,$chalanarray['branch_name'],$chalanarray['totalwithtax'],$chalanarray['totalbv']);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
	   
		redirect('branch/distchalanviewCGST');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->branchview1('branch/add-distchalanCGSTNew',$this->data);
	}
	
	public function sendsmsbill($mobile_no,$branch_name,$totaldp,$totalbv)
	{
	$totaldp = round($totaldp,2);
	$user='Assurdnessbusinesstxn';                                                         // Here Varible $user Holds Your SMS Panel USERID
	$pass='472722';                                                         // Here Varible $pass Holds Your SMS Panel Password
	$senderid='ASSURD';                                                        // Here Varible $senderid Holds the sms SenderID Which Apper on the message
	$msg= "Dear+".urlencode($branch_name)."Your+Bill+Value+RP+:".urlencode($totaldp)."/+BV:+".urlencode($totalbv)."/+Thanks+Any+Queries+9058670777";	
	$link= "https://www.mysmsapp.in/api/push.json?apikey=5d2d60cfe3d45&sender=".$senderid."&mobileno=".$mobile_no."&text=".$msg;  

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



	function adddticketchalanCGST($id=FALSE)
	{
		$id = $this->uri->segment(3);
		
		$viewcategoryinfo = $this->base_model->run_query(
		"select * from tbl_category where id ='".$id."'");
		if($this->input->post('totaldp')<1000){
		$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory where category_id in(1,2);");
		}else{
			
			$Allproduct = $this->base_model->run_query(
		"select * from tbl_product_inventory");
		}
		
		$assignproduct = $this->db->query(
		"select productid from puc_product_details where applicant_no = '".$this->session->userdata('applicant_no')."' and pucproductquantity > 0")->result_array();
	    $pps =[];
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
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
		}
		}
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('branch/adddticketchalanCGST');
		}
		$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,2);
		if(empty($snno))
		{
			$snno =1;
		}
	
		for($i=0;$i<count($this->input->post('product_id'));$i++)
		{
		$chalandetailarray['product_id'] = $this->input->post('product_id')[$i];
        $chalandetailarray['product_name'] = $this->input->post('product_name')[$i];
		$chalandetailarray['otp'] = $this->input->post('otp_id');
		$chalandetailarray['branch_id'] = $this->input->post('branch_id');
        $chalandetailarray['quantity'] = $this->input->post('quantity')[$i];
		$chalandetailarray['scheme_id'] = $this->input->post('otp_id');
		$chalandetailarray['createby'] = $this->session->userdata('empid');
		$chalandetailarray['billfromtype'] = 2;
		$chalandetailarray['s_no'] = $snno;
		$chalandetailarray['datetime'] = date('Y-m-d H:i:s');
        //$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
		$this->db->query("update retail_pivot_process set status='deactive' where otp ='".$this->input->post('otp_id')."'");		
        

	    $this->manage_otp($this->input->post('otp_id'));		

		$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
        $chdetail[]=$chalandetailarray;		
	
	
		
		}

		
		$this->db->insert_batch('mlm_scheme_chalan',$chdetail);
		$mobile_no =$this->db->query("select mobile_no from mlm_members_detail where applicant_no='".$chalanarray['branch_id']."'")->row();
       
	

		$this->sendsmsbill($mobile_no->mobile_no,$chalanarray['branch_name'],$this->input->post('totaldp'),$this->input->post('totalbv'));
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
	   
		
		}
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalanCGST';
		$this->branchview1('branch/add-tickethalanCGST',$this->data);
	}

	function getProductsAjax(){
		if($_POST['totaldp']<1000){
			$Allproduct = $this->base_model->run_query(
			"select * from tbl_product_inventory where category_id in(1,2);");
		}else{
			$Allproduct = $this->base_model->run_query(
			"select * from tbl_product_inventory");
		}
		$proarray = array();
		foreach($Allproduct as $pro)
		{
			//if(in_array($pro->id,$pps))
			//{
				$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
				'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
				,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
			//}
		}
		
		echo json_encode($proarray);
	}

	function distchalanviewCGST()
	{   $aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalantype in(2,5,6) and createby = '".$this->session->userdata('empid')."' and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->branchview1('branch/distchalanviewCGST',$this->data); 
	}
    function ticketchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		$alluser = $this->base_model->run_query(
		"select mlm_ticket_chalan.* from mlm_ticket_chalan where  createby = '".$this->session->userdata('empid')."'  and date(datetime)>='".$dd."'");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->branchview1('branch/ticketchalanviewCGST',$this->data); 
	}

	
	function distchalanCGST($chalanid)
	{
	
        $alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));	
        
		$this->data['pucdata'] 		=  $detail;		
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/distchalanCGST';
		$this->load->view('branch/distchalanCGST',$this->data); 
	}
	
	function ticktbillchalanCGST($chalanid)
	{
        $alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));	
        
		$this->data['pucdata'] 		=  $detail;		
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/ticktbillchalanCGST';
		$this->load->view('branch/ticktbillchalanCGST',$this->data); 
	}

		
	function ticketchalanCGST($chalanid)
	{
        $alluser = $this->base_model->run_query(
		"select mlm_ticket_chalan.* from mlm_ticket_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));	
        
		
		$this->data['pucdata'] 		=  $detail;		
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Chalan List';
		$this->data['active_menu'] 	= 'Chalan List';
		$this->data['content'] 		= 'admin/ticketchalanCGST';
		
		$this->load->view('branch/ticketchalanCGST',$this->data); 
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
		$this->branchview1('branch/distchalanviewIGST',$this->data); 
	}
	
	function distchalanIGST($chalanid)
	{
		$alluser = $this->base_model->run_query(
		"select mlm_dist_chalan.* from mlm_dist_chalan where chalan_id='".$chalanid."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.* from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no where a.role='member' and a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));
	
        $this->data['pucdata'] 		=  $detail;		
		
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->load->view('branch/distchalanIGST',$this->data); 
	}
	
	function adddticket($id=FALSE)
	{
		$msg='';
	   
		$id = $this->uri->segment(3);
		$Allproduct = $this->base_model->run_query(
		"select * from mlm_ticket");
		
		
		foreach($Allproduct as $pro)
		{
		
		$proarray[] = array('value'=>$pro->id,'label'=>$pro->product_name,'product_bv'=>$pro->product_bv,
		'product_dp'=>$pro->product_dp,'product_mrp_price'=>$pro->product_mrp_price,'product_description'=>$pro->product_description,'hcn_no'=>$pro->hcn_no,'batch_no'=>$pro->batch_no
		,'manufacturer_date'=>$pro->manufacturer_date,'expiry_date'=>$pro->expiry_date,'packaging_size'=>$pro->packaging_size,'product_quantity'=>$this->base_model->getprodctinfo($this->session->userdata('applicant_no'),$pro->id),'tax_rate'=>$pro->tex_rate,'Cgst'=>$pro->center_taxCGST,'Sgst'=>$pro->state_taxSGST); 	
	
		}
		
		
		
		if($this->input->post('save')==true)
	    {
		if(!$this->input->post('product_id')[0])
		{
        $this->session->set_flashdata('success','<font color="#05BD14">Please select product...</font>');
        redirect('branch/adddticket');
		}
		$chalanarray['branch_id'] =$this->input->post('branch_id');
		$chalanarray['branch_name'] =$this->input->post('bvmbranchname');
		$chalanarray['totaldp'] =$this->input->post('totaldp');
		$chalanarray['totalwithtax'] =$this->input->post('total');
		$chalanarray['product_id'] = $this->input->post('product_id')[0];
        $chalanarray['product_name'] = $this->input->post('product_name')[0];
	    $otpnoinfo = $this->base_model->run_query("select ml.*,md.mobile_no from mlm_members_detail md,mlm_members_login ml where ml.applicant_no ='".$chalanarray['branch_id']."' and ml.applicant_no = md.applicant_no and ml.status='inActive'");
			$usermobileno =   $otpnoinfo[0]->mobile_no;
		$chalanarray['datetime'] = date('Y-m-d H:i:s');
		$snno =  $this->applno();
		if(empty($snno))
		{
	    $snno =1;
		}
		$chalanarray['s_no'] = $snno;
		$chalanarray['total'] =$this->input->post('totalprice');
		$chalanarray['createby'] = $this->session->userdata('empid');
		$chalanarray['role'] = 'member';
		$chalanarray['billfromtype '] = 2;
	     	$trans['recid'] =$this->input->post('branch_id');
			$trans['name'] =$this->input->post('bvmbranchname');
			$trans['paymentby'] ='cash' ;
			$trans['byid'] =$this->session->userdata('empid');
			$trans['narration'] ='Seminar muzaffarnagar';
			$trans['amount']=$this->input->post('totalprice');
			$trans['transtype'] =4;
			$trans['date'] = date('Y-m-d');
			
			$this->db->insert('mlm_transaction',$trans);
		$res= $this->db->insert('mlm_ticket_chalan',$chalanarray);
	    if($res==true){
	    
		$this->sendsmsregister($usermobileno,$chalanarray['s_no']);
			$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('branch/adddticket');
	    }		
		}
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'PUC';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-ticket';
		$this->branchview1('branch/add-ticket',$this->data);
	}

	public function applno($size = 6)
    {
    $random_number='';
    $count=0;
    while ($count < $size ) 
        {
            $random_digit = mt_rand(1, 6);
            $random_number .= $random_digit;
            $count++;
        }
    return $random_number;  
    }
	 public function sendsmsregister($usermobileno,$Userid)
	{
	$user='bvmbusinesstxn';                                                         // Here Varible $user Holds Your SMS Panel USERID
	$pass='472722';                                                         // Here Varible $pass Holds Your SMS Panel Password
	$senderid='BVMBUS';                                                        // Here Varible $senderid Holds the sms SenderID Which Apper on the message
	$msg= "Your+ticket+OTP+for+BVMBusiness+Seminar+is:+".$Userid;	
	$link= "http://anysms.in/api.php?username=".$user."&password=".$pass."&sender=".$senderid."&sendto=".$usermobileno."&message=".$msg;  


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
        redirect('branch/adddistchalanIGST');
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
		/*$snno = $this->base_model->run_query(
		"SELECT (max(s_no)+1) as sn FROM mlm_dist_chalan WHERE role='member' and date(datetime)>='2018-04-01' and billfromtype = '2' and createby = '".$this->session->userdata('empid')."'");
		
		if($snno[0]->sn!='')
		{
		$chalanarray['s_no'] = $snno[0]->sn;			
		}
		else{
			$chalanarray['s_no'] = '1';			
		}*/

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
        redirect('branch/distchalanviewIGST');		
		}
		
		
		$data['allproduct'] 	= json_encode($proarray);
		//$data['title'] 		= 'PUC';
		//$data['active_menu'] 	= 'Bill';
		//$data['content'] 		= 'puc/add-distchalanIGST';
		$this->branchview1('branch/add-distchalanIGST',$data);
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
	
	function redemescheme($id=FALSE)
	{
		$id = $this->uri->segment(3);
		$Allproduct = $this->base_model->run_query(
		"SELECT * FROM `scheme_process` where otpstatus = '1' and createby!='".$this->session->userdata('empid')."'");
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
		redirect('branch/redemescheme');
		}
		$snno = $this->base_model->getserialnoviatypepucdistbrnach(2,2);
		if(empty($snno))
		{
	    $snno =1;
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
		$chalandetailarray['billfromtype'] = 2;
		$chalandetailarray['datetime'] = date('Y-m-d H:i:s');
		$chalandetailarray['s_no'] = $snno;
        //$this->manage_avl_quan_puc($this->session->userdata('applicant_no'),$this->input->post('product_id')[$i],$this->input->post('quantity')[$i]);		
		$this->db->query("update scheme_process set otpstatus='2' where otp ='".$this->input->post('otp')[$i]."'");		
        $chdetail[]=$chalandetailarray;		
		}
		$this->db->insert_batch('mlm_scheme_chalan',$chdetail);
		$this->session->set_flashdata('success','<font color="#05BD14">Chalan successfully created...</font>');
        redirect('branch/redemeschemechalan');		
		}
		
		$this->data['allproduct'] 	= json_encode($proarray);
		$this->data['title'] 		= 'Scheme';
		$this->data['active_menu'] 	= 'Bill';
		$this->data['content'] 		= 'admin/add-pucchalan';
		$this->branchview1('branch/redemescheme',$this->data);
		}
		


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
			redirect('branch/addtr');		
			}
			$this->data['allproduct'] 	= json_encode($proarray);
			
			$this->data['title'] 		= 'Transaction Received';
			$this->data['active_menu'] 	= 'Transaction';
			$this->data['content'] 		= 'admin/add-tr';
			
			$this->branchview1('branch/add-tr',$this->data);
		}
		
		function redemeschemechalan()
		{ 
			$aa =  ($this->session->userdata('final'));
			$dd = $aa.'-04-01';
			if($aa=='2018'){
				$alluser = $this->base_model->run_query(
					"select * from mlm_scheme_chalan where billfromtype =2 and createby ='".$this->session->userdata('empid')."' and date(datetime)>='".$dd."' and date(datetime)<'2019-04-01' GROUP BY s_no  ");
		
			}else{
			$alluser = $this->base_model->run_query(
			"select * from mlm_scheme_chalan where billfromtype =2 and createby ='".$this->session->userdata('empid')."' and date(datetime)>='".$dd."' GROUP BY s_no");

			}
			$this->data['alluser'] 		=  $alluser;		
			$this->data['title'] 		= 'Bill List';
			$this->data['active_menu'] 	= 'IGST Bill List';
			$this->data['content'] 		= 'admin/pucchalanviewIGST';
			$this->branchview1('branch/redemeschemechalan',$this->data); 
		}
	
	function schemechalan($chalanid)
	{
		
		$alluser = $this->base_model->run_query(
		"select mlm_scheme_chalan.*,hcn_no,batch_no,expiry_date as expire_date,manufacturer_date as m_date,packaging_size as size  from mlm_scheme_chalan 
		left join tbl_product_inventory
         on mlm_scheme_chalan.product_id = tbl_product_inventory.id where s_no='".$chalanid."' and createby= '".$this->session->userdata('empid')."'");
		$branchdata = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status from mlm_members_login as a where a.applicant_no='".$alluser[0]->branch_id."'");
		$detail = $this->branchdetail($this->session->userdata('empid'));	
        
		$this->data['pucdata'] 		=  $detail;
		$this->data['productlist'] 		=  $alluser;
        $this->data['branchdata'] 		=  $branchdata;		
		$this->data['title'] 		= 'Branch List';
		$this->data['active_menu'] 	= 'Branch List';
		$this->data['content'] 		= 'admin/chalanview';
		$this->load->view('branch/schemechalan',$this->data); 
	}
			
	function appnos($memberid)
	{
	$member = $this->db->query("SELECT a.applicant_no   FROM `mlm_members_login` a left join mlm_members_detail b on a.applicant_no = b.applicant_no left join mlm_branch_detail c on a.applicant_no = c.applicant_no left join  mlm_puc_detail d on a.applicant_no = d.applicant_no
where a.member_id = '".$memberid."'")->result_array();
    return $member[0]['applicant_no'];	
	}
	
	function updatekyc(){
		
		$this->data = array();
		
		if(isset($_FILES['pancard']) || isset($_FILES['aadharcard'])){
			$config = $this->set_upload_option();
			$this->load->library('upload', $config, 'coverupload');
			$this->coverupload->initialize($config);
			
			//The name of the directory that we need to create.
			$directoryName = './uploads/doc_'.$this->session->userdata('applicant_no').'/';
			 
			//Check if the directory already exists.
			if(!is_dir($directoryName)){
				//Directory does not exist, so lets create it.
				mkdir($directoryName, 0755);
			}
			
			if($_FILES['pancard']['name'] != "") {
				if (!$this->coverupload->do_upload('pancard')) {
					$error = array('error' => $this->coverupload->display_errors());
					print_r($error);
				} else {

					$cvdata = $this->coverupload->data();
					$data['pancard'] = $cvdata['file_name'];
				}
			}
			//echo "<pre>"; print_r($_FILES); exit;
			if($_FILES['aadharcard']['name'] != "") {
				if (!$this->coverupload->do_upload('aadharcard')) {
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
				} else {

					$coverdata = $this->coverupload->data();
					$data['aadharcard'] = $coverdata['file_name'];
				}
			}
			
			$data['uid'] = $this->session->userdata('applicant_no');
			if(!$this->db->insert('kyc_docs', $data)){
				$error = $this->db->error(); 
			}
		}
		
		$kycuser = $this->base_model->run_query(
		"select * from kyc_docs where uid='".$this->session->userdata('applicant_no')."' LIMIT 1");
		
		if(isset($kycuser[0])){
			$this->data['kycuser'] = $kycuser[0];
		}else{
			$this->data['kycuser'] = $kycuser;
		}
		
		$this->branchview('branch/uploadkyc',$this->data); 
	}
	
	private function set_upload_option()
    {
        $config2['upload_path'] = './uploads/doc_'.$this->session->userdata('applicant_no').'/';
        $config2['allowed_types'] = 'gif|jpg|png|jpeg';
        $config2['max_size'] = 2048;
        $config2['encrypt_name'] = TRUE;

        return $config2;
    }
	
}

?>

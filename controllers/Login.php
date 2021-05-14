<?php
error_reporting(0);
class Login extends CI_Controller
{
    public $treeResult,$prefix;
	public function __construct(){				
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('url');
		$this->load->library('session');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");		
		}
		
	public function index()
	{


		$Allnews = $this->base_model->run_query(
		"select * from tbl_news");

		$Allslider = $this->base_model->run_query(
		"select * from tbl_slider");

		$category = $this->base_model->run_query(
		"select * from tbl_category");

		$product = $this->base_model->run_query(
		"select * from tbl_product");		

		$this->data['Allnews'] 	= $Allnews;
		$this->data['Allslider'] 	= $Allslider;
		$this->data['category'] 	= $category;
		$this->data['product'] 		= $product;
		$this->load->view('general/index',$this->data);				 
	}

	public function aboutus()
	{
		$this->data['aboutus'] = $this->base_model->run_query("select * from tbl_aboutus");

		$this->load->view('general/aboutus',$this->data);				 
	}

	public function plan()
	{
		$this->data['plan'] = $this->base_model->run_query("select * from tbl_plan");
		$this->load->view('general/plan',$this->data);				 
	}	
	
	public function product($id=FALSE)
	{
		$category = $this->base_model->run_query("select * from tbl_category");

		$product = $this->base_model->run_query(
		"select * from tbl_product where category_id = '".$this->uri->segment(3)."'");

		$categoryimage = $this->base_model->run_query("select category_image from tbl_category where id = '".$this->uri->segment(3)."'");

		$this->data['category'] 	= $category;
		$this->data['categoryimage'] = $categoryimage;
		$this->data['product'] 		= $product;
		$this->load->view('general/product',$this->data);		
	}

	public function achivers()
	{
		
	$this->data['allachivers'] = $this->base_model->run_query("select * from tbl_achivers order by seq ASC");


		$this->load->view('general/achivers',$this->data);				 
	}

	public function branchpuc()
	{
	$this->data['alldipo'] = $this->base_model->run_query("select * from mlm_depo_detail");
$this->data['allbranch'] = $this->base_model->run_query("select mlm_branch_detail.* from mlm_branch_detail
left join mlm_members_login
on mlm_branch_detail.applicant_no = mlm_members_login.applicant_no
where mlm_members_login.status='inActive'");
$this->data['allpuc'] = $this->base_model->run_query("select mlm_puc_detail.* from mlm_puc_detail
left join mlm_members_login
on mlm_puc_detail.applicant_no = mlm_members_login.applicant_no
where mlm_members_login.status='inActive'");

		$this->load->view('general/branchpuc',$this->data);				 
	}

	public function seminars()
	{
		$todaydate = date("Y-m-d");
	$this->data['allseminar'] = $this->base_model->run_query("select * from tbl_seminar where seminar_date>= '".$todaydate."' order by seminar_date ASC");


		$this->load->view('general/seminar',$this->data);				 
	}

	public function contact()
	{
		if($this->input->post('contact')=='Submit')
		{
			$this->form_validation->set_rules('name', 'Contact Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'required');

			if ($this->form_validation->run() == true)
			{	
				
				$data['name'] 			= $this->input->post('name');
				$data['email'] 			= $this->input->post('email');				
				$data['city'] 			= $this->input->post('city');
				$data['mobile'] 		= $this->input->post('mobile');
				$data['message'] 		= $this->input->post('message');

					 //step for Insert
	$this->base_model->insert_operation($data,$this->db->dbprefix('tbl_contact'));

	$this->session->set_flashdata('success','<font color="#05BD14">Your Message successfully Send...</font>');
						return redirect('login/contact/','refresh');
			}
		}
		$this->load->view('general/contact','refresh');				 
	}

	public function message()
	{
		$this->load->view('general/message',$this->data);		
	}

	public function privacy()
	{
		$this->load->view('general/privacy','refresh');		
	}

	public function terms()
	{
		$this->load->view('general/terms','refresh');		
	}

	public function view($id=FALSE)
	{
		$category = $this->base_model->run_query(
		"select * from tbl_category");

		$product = $this->base_model->run_query(
		"select * from tbl_product where id = '".$this->uri->segment(3)."'");

		$allproduct = $this->base_model->run_query(
		"select * from tbl_product");

		$this->data['category'] 	= $category;
		$this->data['allproduct'] 		= $allproduct;
		$this->data['product'] 		= $product;
		$this->load->view('general/view',$this->data);		
	}
	
	public function applno($size = 9)
    {
    $random_number='';
    $count=0;
    while ($count < $size ) 
        {
            $random_digit = mt_rand(1, 9);
            $random_number .= $random_digit;
            $count++;
        }
    return $random_number;  
    }
	
	function getcounts($id)
	{
	$query = $this->db->query("SELECT applicant_no,applicant_parent_no FROM mlm_member_tree WHERE applicant_parent_no = '".$id."'");
	$num=$query->num_rows();
	return $num;
	}
	
	function proposer()
	{
		
		$id = $this->session->userdata('applicant_no');
		$proposerdata = $this->base_model->run_query(
		"select applicant_no,applicant_name from mlm_members_detail where proposer_no ='".$id."'");

		$this->data['proposerdata'] 	=  $proposerdata;		
		$this->userview('mlmuser/proposer',	$this->data); 

	}
	
    function businessgroup($id='',$mon='',$yer='')
	{
	$month = $this->input->post('month');
	$year = $this->input->post('year');	
	if(!empty($mon) && !empty($yer))
	{
	$month = $mon;
	$year = $yer;	
	}
	if(empty($month) && empty($year))
	{ 
    $month = date('m');
	$year = date('Y');
	}
	if(!$id)
	{
	$id = $this->session->userdata('applicant_no');	
	}
	$data['parentdata'] = $this->getdata('sponser_no,applicant_no,applicant_name','mlm_members_detail',"applicant_no = $id");
	$userquery = $this->db->query("SELECT b.applicant_no,a.applicant_parent_no,b.sponser_no,b.applicant_name FROM mlm_member_tree a left join mlm_members_detail b on a.applicant_no=b.applicant_no WHERE a.applicant_parent_no = '".$id."'");
    $data['userdata'] = $userquery->result_array(); 
	$data['month'] = $month;
	$data['year'] = $year;
	$this->userview('mlmuser/business',$data);	
	}    

    function recursiveCategory($pos_category_id, $array='')
    {

	$query = $this->db->query("SELECT applicant_no,applicant_parent_no FROM mlm_member_tree WHERE applicant_parent_no = '".$pos_category_id."'");
	if(!is_array($array)){
		$array = array();
	}
	foreach ($query->result_array() as $row)
    { 
        //$sub_cat = $return['applicant_no'];
        $array[$row['applicant_no']] = array(
                'id' => $row['applicant_no'],
                'title' => $row['applicant_no'],
				'count'=>$this->getcounts($row['applicant_no']),
                'parent_id' => $row['applicant_parent_no']
            );
			
        $array = $this->recursiveCategory($row['applicant_no'], $array);
	}
		
    	return $array;
    }
	
    public function generate_tree_list($array, $parent = '')
    {

        $has_children = false;
		
        foreach($array as $key => $value)
        {
            if($value['parent_id'] == $parent)
            {
                if($has_children === false)
                {

                    $has_children = true;

                    $this->treeResult .= "<ul class='parent insRootClose'>";
                }

				$dispaly = 'inline-block';
				if($value['count']==0)
				{
				$dispaly ='none';	
				}
				
                $applicant_name	 = $this->getdata('applicant_name','mlm_members_detail',"applicant_no	=".$value['id']."");
                $total = $this->getTotalAmountByApplication($value['id']);

                {$this->treeResult .= '<li><ins style="display:'.$dispaly.'"  onclick="expandNode(this.id);"' . "id='$this->prefix" . $value['id'] . "'" . '>&nbsp;</ins>'.'<img src="'.base_url().'adminimage/default.png" style="width:35px; height:35px;">'.'<a href='.base_url().'login/mygroup/'.$value['id'].'>-[ Name :'.@$applicant_name[0]['applicant_name'].']--[ User Id :'.$value['title'].'][ Total bv :'.$total[0]['totalbv'].'][ Total dp :'.$total[0]['totaldp'].']</a>';}

                $this->generate_tree_list($array, $key);

                $this->treeResult .= '</li>';
            }

        }


        if ($has_children === true) $this->treeResult .= '</ul>';

    }
	
	
	public function getdata($field,$table,$condition)
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
    
	function getspno()
	{
    $spnno= $_POST['no'];	
	$spnnodata = $this->getdata('applicant_name','mlm_members_detail',"applicant_no='".$spnno."'");
	if(count($spnnodata)>0)
	{
	echo $spnnodata[0]['applicant_name'];	
	}
	else{
	echo 1;	
	}
	}
	
	function getspnonewcheck()
	{
    $spnno= $_POST['no'];	
	$spnnodata = $this->getdata('restype,applicant_name','mlm_members_detail',"applicant_no='".$spnno."'");
	$spnnodatacheck = $this->getdata('sponser_no','mlm_members_detail',"sponser_no='".$spnno."'");
	if(count($spnnodata)>0)
	{
	$totaldpquery = $this->db->query("SELECT sum(`totaldp`) as totaldp FROM `mlm_dist_chalan` where `branch_id` = '".$spnno."' ")->row();
	$Totaldp = $totaldpquery->totaldp;
	
	$totaltool= $this->db->query("SELECT count(*) as cut FROM `mlm_dist_chalan` a join `mlm_dist_chalan_detail` b on a.`chalan_id` = b.`chalan_id` WHERE a.branch_id = '".$spnno."' and b.`product_id` in (select id from tbl_product_inventory where category_id = 7)")->row();
	$tool_count = $totaltool->cut;
	if($spnnodata[0]['restype'] == 2 and count($spnnodatacheck)>0)
	{	
	
	echo $spnnodata[0]['applicant_name'];
	
	}
	else
	{
	echo $spnnodata[0]['applicant_name'];	
	}
	
	}
	else
	{
	echo 1;	
	}
	}
	
	
	function getspnonew()
	{
    $spnno= $_POST['no'];	
	$spnnodata = $this->getdata('restype,applicant_name','mlm_members_detail',"applicant_no='".$spnno."'");
	if(count($spnnodata)>0)
	{
	$totaldpquery = $this->db->query("SELECT sum(`totaldp`) as totaldp FROM `mlm_dist_chalan` where `branch_id` = '".$spnno."' ")->row();
	$Totaldp = $totaldpquery->totaldp;
	
	$totaltool= $this->db->query("SELECT count(*) as cut FROM `mlm_dist_chalan` a join `mlm_dist_chalan_detail` b on a.`chalan_id` = b.`chalan_id` WHERE a.branch_id = '".$spnno."' and b.`product_id` in (select id from tbl_product_inventory where category_id = 7)")->row();
	$tool_count = $totaltool->cut;
	if($spnnodata[0]['restype'] == 2)
	{	
	
	echo $spnnodata[0]['applicant_name'];
	
	}
	else
	{
	echo $spnnodata[0]['applicant_name'];	
	}
	
	}
	else
	{
	echo 1;	
	}
	}
	
	function getmobno()
	{
    $mob= $_POST['no'];	
	$spnnodata = $this->getdata('mobile_no','mlm_members_detail',"mobile_no='".$mob."'");
	if(count($spnnodata)>0)
	{
	echo $spnnodata[0]['mobile_no'];	
	}
	else
	{
	echo 1;	
	}
	}

	function getfather()
	{
    $mob= $_POST['no'];	
	$spnnodata = $this->getdata('aadharcard','mlm_members_detail',"aadharcard='".$mob."'");
	if(count($spnnodata)>0)
	{
	echo $spnnodata[0]['aadharcard'];	
	}
	else
	{
	echo 1;	
	}
	}
	
	function myprofile($id='')
	{ 
	    if($id=='')
		{
		$id = $this->session->userdata('member_id'); 
		}
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.date,a.email,a.password,a.role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,b.profilepic,b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_id,f.state_name,
        g.id as district_id,g.city_name as district_name,b.tehsil,b.post,b.city,b.pincode,b.profilepic,b.phone_no,b.mobile_no,i.bank_name,b.bank_branch_state as branchstateid,h.state_name as bank_branch_state,
        b.branch_name,b.bank_accno,b.panno,b.edit,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_city_master g on 
		b.district = g.id  left join mlm_bank_detail  i on b.bank_name=i.bank_id where a.member_id='".$id."' and a.role='member'");
		
		$data['userview'] 	=  $alluser;		
		$this->userview('mlmuser/myprofile',$data); 
	}
	
	public function idcard()
	{
		$data['idcard']  = $this->base_model->run_query("select applicant_no,applicant_name,profilepic from mlm_members_detail where applicant_no = '".$this->session->userdata('applicant_no')."'");
		$this->userview('mlmuser/idcard',$data);
	}

	function editmyprofile($id='')
	{
		$alluser = $this->base_model->run_query(
		"select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,
		b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name,   b.father_name,b.nomnee_name,
		b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.panno,b.edit,b.location,f.state_id,f.state_name,
        g.id as district_id,g.city_name as district_name,b.tehsil,b.post,b.profilepic,b.city,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state as branchstateid,h.state_name as bank_branch_state,
        b.branch_name,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on 
		a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id 
		left join mlm_state_master as h on b.bank_branch_state = h.state_id left join mlm_city_master g on 
		b.district = g.id where a.member_id='".$id."' and a.role='member'");
		$this->data['state'] = $this->getdata('','mlm_state_master',"");
	    $this->data['bank'] = $this->getdata('','mlm_bank_detail',"");
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
	$insert['bank_ifsc_code'] = $this->input->post('ifsccode');
	$insert['edit'] = 1;
	
	if($_FILES['image']['name'])
	{
	
	$uploaddir = 'adminimage/';
    $uploadfile = $uploaddir.time().basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) 
	{
    $insert['profilepic'] = $uploadfile;
    } 
	}
	
	$login['email'] = $this->input->post('email');
	$tree['applicant_parent_no'] = $insert['sponser_no'];
	if($this->input->post('edit')==1)
	{
	unset($insert['bank_name']);
    unset($insert['bank_branch_state']);
    unset($insert['applicant_dob']);	
    unset($insert['nomnee_dob']);	
	}
	unset($insert['sponser_no']);
	unset($insert['proposer_no']);

	$this->db->update('mlm_members_detail',$insert,array('applicant_no'=>$this->input->post('applicant_no')));
	$this->db->update('mlm_members_login',$login,array('applicant_no'=>$this->input->post('applicant_no')));
	//$this->db->update('mlm_member_tree',$tree,array('applicant_no'=>$this->input->post('applicant_no')));
	
	$msg ="User Edited Successfully.";

	$this->session->set_flashdata('msg',$msg);

	redirect('login/myprofile/'.$this->input->post('member_id'));
	}
		
		$this->data['userview'] 	=  $alluser;		
		$this->data['title'] 		= 'Edit User';
		$this->data['active_menu'] 	= 'View';
		$this->data['content'] 		= 'user/edituser';
		$this->userview('mlmuser/editprofile',$this->data); 
	}
	
    

	function getdistrict()
	{
    $stateid= $_POST['state'];
	$state = $this->getdata('','mlm_city_master',"state_id='".$stateid."'");
    ?>
    <select class="form-control" id="district" name="district">
	<?php
	foreach($state as $val){?>
	<option value="<?php echo $val['id'] ?>"><?php echo $val['district_name'] ?></option>
	<?php } ?>
	</select>--#--	
	<?php
	$state = $this->getdata('','mlm_city_master',"state_id='".$stateid."'");
    ?>
    <select class="form-control" id="city" name="city" placeholder="City.">
	<?php
	foreach($state as $val){?>
	<option value="<?php echo $val['id'] ?>"><?php echo $val['city_name'] ?></option>
	<?php } ?>
	</select>
	<?php
	}
	
	public function register()
	{
		
	$data['state'] = $this->getdata('','mlm_state_master',"");
	$data['bank'] = $this->getdata('','mlm_bank_detail',"");
	$insert=array();
    if($this->input->post('save')==true)
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
	$insert['aadharcard'] = $this->input->post('aadharcard');
	$insert['phone_no'] = $this->input->post('othermobileno');
	$insert['bank_name'] = $this->input->post('bankname');
	$insert['bank_branch_state'] = $this->input->post('bankbranchstate');
	$insert['branch_name'] = $this->input->post('branchname');
	$insert['bank_accno'] = $this->input->post('acno');
	$insert['panno'] = $this->input->post('panno');
	$insert['bank_ifsc_code'] = $this->input->post('ifsccode');
	$insert['restype'] = 2;
	
	///// applicant login detail ///////
	$login['password'] = $this->input->post('password');
	$login['applicant_no'] = $this->applno();
	$login['date'] = date('Y-m-d');
	$login['role'] = 'member';
	$login['email'] = $this->input->post('email');
	$login['status'] = 'inActive';
    $insert['applicant_no'] = $login['applicant_no'];

	
	$checksponser_no = $this->getdata('','mlm_members_login',"applicant_no	=".$insert['sponser_no']." and role='member'");
	$checkproposer_no = $this->getdata('','mlm_members_login',"applicant_no =".$insert['proposer_no']." and role='member'");
	if($this->input->post('password')!=$this->input->post('cpassword'))
	{
	$msg ="Password and confirm password not matched.";	
	}
	else if(count($checksponser_no)==0)
	{
    $msg ="Invalid Sponser No.";
    }
	else if(count($checkproposer_no)==0)
	{
    $msg ="Invalid Proposer No.";
	}
	
	else if($this->input->post('password')=='')
	{
    $msg ="Password is mandatory ";
	}
	else if($this->input->post('mobileno')=='')
	{
    $msg ="mobile no is mandatory ";
	}
	else if($this->input->post('aadharcard')=='')
	{
    $msg ="aadhar card is mandatory ";
	}
	else
	{
	$this->db->insert('mlm_members_login',$login);	
	$lastid = $this->db->insert_id();
    if($lastid)
	{
    $this->db->insert('mlm_members_detail',$insert);
	$treearray=array('applicant_no'=>$login['applicant_no'],'applicant_parent_no'=>$insert['sponser_no']);
	$this->db->insert('mlm_member_tree',$treearray);
	$this->sendsmsregister($insert['mobile_no'],$login['applicant_no'],$login['password']);
	$msg ="Thanku For Registration. Your Applicant No is ".$login['applicant_no'];
	}
	else
	{
	$msg ="There is some problem in registration please try again.";
	}
	}
	//$this->session->set_flashdata('msg',$msg);
	echo $msg ;
	$this->session->set_flashdata('success',$msg);
		redirect ("login");
    exit;	
	
	}
    $this->fileview('general/register',$data);		
	}

	public function district(){
		$id = $this->input->post('id');		
		//$where = array('state_id'=>$id);
		$data = $this->base_model->run_query("select * from tbl_city where state_id ='".$id."'");
		//$data = $this->dashboard_model->select_where('mlm_city_master',$where);
		echo json_encode($data);
		
	}
	
	
	
	public function fileview($file,$data='')
	{
	$this->load->view('general/header',$data);
	$this->load->view($file,$data);
    $this->load->view('general/footer',$data);	
	}
	
	
	public function profile()
	{
	$data['total'] = $this->gettotalamount();
	$data['currentbv'] = $this->gecurrentbv();
	$data['userview'] = $this->getprofilepic();
	$data['level'] = $this->getlevel();
 	$data['appno'] = $this->session->userdata('applicant_no');
	 $this->userview('mlmuser/profile',$data);	

	}

	public function timeline()
	{
		$result = $this->base_model->run_query(
		"SELECT * FROM `retail_bouns` WHERE `applicant_no` = '".$this->session->userdata('applicant_no')."' ORDER BY `retail_bouns`.`current_month` DESC");
		$data['appno'] = $this->session->userdata('applicant_no');
		$data['userview'] = $this->getprofilepic();
		$data['timeline'] = $result; 
		$this->userview('mlmuser/timeline',$data);	

	}

	function getlevel()
	{ 
		$result = $this->base_model->run_query(
		"select level_name from level where applicant_no = '".$this->session->userdata('applicant_no')."'");
		return $result;


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
		
		$this->userview('mlmuser/changePassword');
	}

	function getprofilepic()
	{
		$result = $this->base_model->run_query("SELECT a.profilepic,a.opening_balance_quantity,a.applicant_no,a.applicant_name,b.date FROM `mlm_members_detail` a,`mlm_members_login` b WHERE a.applicant_no = '".$this->session->userdata('applicant_no')."' and a.applicant_no=b.applicant_no");
		return $result; 	
	}
	
	
	function gettotalamount()
	{
	$result = $this->db->query("select sum(totalbv) as totalbv,sum(totaldp) as totaldp  from (SELECT COALESCE(SUM(totalbv),0) as totalbv,COALESCE(SUM(totaldp),0) as totaldp FROM `mlm_dist_chalan` WHERE branch_id = '".$this->session->userdata('applicant_no')."' union SELECT COALESCE(SUM(bv),0) as totalbv,COALESCE(SUM(dp),0)+1 as totaldp FROM `old_bv_dp` WHERE applicant_no = '".$this->session->userdata('applicant_no')."') as bb");
    return $result->result_array(); 	
	}
	
	function getTotalAmountByApplication($applicant_no)
	{
	$result = $this->db->query("select sum(totalbv) as totalbv,sum(totaldp) as totaldp  from (SELECT COALESCE(SUM(totalbv),0) as totalbv,COALESCE(SUM(totaldp),0) as totaldp FROM `mlm_dist_chalan` WHERE branch_id = '".$applicant_no."' union SELECT COALESCE(SUM(bv),0) as totalbv,COALESCE(SUM(dp),0)+1 as totaldp FROM `old_bv_dp` WHERE applicant_no = '".$applicant_no."') as bb");
    return $result->result_array(); 	
	}
	
	function gecurrentbv()
	{
	$result = $this->db->query("SELECT sum(`totalbv`) as monthbv,SUM(totaldp) as monthdp FROM `mlm_dist_chalan` WHERE branch_id = '".$this->session->userdata('applicant_no')."' and MONTH(`datetime`) = MONTH(CURRENT_DATE()) and YEAR(`datetime`) = YEAR(CURRENT_DATE()) ");
    return $result->result_array(); 	
	}
	
	public function mygroup($appno='')
	{
	if($appno=='')
		{
	$appno=$this->session->userdata('applicant_no');
		} 
	$pp = $this->recursiveCategory($pos_category_id = $appno,'');
	$this->generate_tree_list($pp,$appno);
	$data['tree'] = $this->treeResult;
	$this->userview('mlmuser/mygroup',$data);	
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
	
	public function userview($file,$data='')
	{
	$result = $this->db->query("select * from main_menu a where a.menu_type='1' and FIND_IN_SET('".$this->session->userdata('role')."',role) and 
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
	$mmm['data']=$lll;	
	$this->load->view('mlmuser/userheader',$data);
	$this->load->view('mlmuser/sidebar',$mmm);
	$this->load->view($file,$data);
    $this->load->view('mlmuser/userfooter',$data);	
	}
    
	function get_menu($parent)
	{
	$this->db->select("*");
	$this->db->from("main_menu a");
	$this->db->where("a.menu_parent",$parent);
	$this->db->where("a.menu_status",'active');
	$this->db->order_by("a.seq");
	$result=$this->db->get();	
	return $result->result_array();
	}
	
	public function userlogout()
	{
	session_destroy();
	redirect(base_url());
	}
	
	public function check_login_user()
	{
	if($this->input->post('submit')==true)
	{	
    $username = $this->input->post('username');
	$password = $this->input->post('password');	
	$final = $this->input->post('final');	
	if($username and $password)
	{
    $userdetail = $this->getdata('','mlm_members_login',"applicant_no='".$username."' and password='".$password."'");		
	//print_r($userdetail[0]);exit;
	if(($userdetail[0]['applicant_no']==$username)&&($userdetail[0]['password']==$password))
	{
	if($userdetail[0]['role']=='member')
	{
		if($userdetail[0]['status']=='inDactive')
	{
	$this->session->set_flashdata('error','Your member ID is lock. Please contact Assurdness Head Office.');
	redirect ("login");
	}else{

    $this->session->set_userdata('member_id', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
	redirect("login/profile");
	}
	}
	elseif($userdetail[0]['role']=='depo')
	{
		$this->session->set_userdata('final', $final);
	$this->session->set_userdata('empid', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
	redirect("depo"); 	
	}
	elseif($userdetail[0]['role']=='branch')
	{
		if($userdetail[0]['status']=='inDactive')
	{
	$this->session->set_flashdata('error','Your  ID is lock. Please contact Assurdness Head Office.');
	redirect ("login");
	}else{
		$this->session->set_userdata('final', $final);
	$this->session->set_userdata('empid', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
	redirect("branch"); 	
	}
	}
	elseif($userdetail[0]['role']=='puc')
	{
		if($userdetail[0]['status']=='inDactive')
	{
	$this->session->set_flashdata('error','Your  ID is lock. Please contact Assurdness Head Office.');
	redirect ("login");
	}else{
		$this->session->set_userdata('final', $final);
	$this->session->set_userdata('empid', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
	redirect("puc"); 	
	}
	}
	elseif($userdetail[0]['role']=='ledger')
	{
		$this->session->set_userdata('final', $final);
	$this->session->set_userdata('empid', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
	redirect("ledger"); 	
	}
	elseif($userdetail[0]['role']=='purchase')
	{
		$this->session->set_userdata('final', $final);
	$this->session->set_userdata('empid', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
	redirect("purchase"); 	
	}
	elseif($userdetail[0]['role']=='admin' or $userdetail[0]['role']=='subadmin')
	{
		$this->session->set_userdata('final', $final);
	$this->session->set_userdata('empid', $userdetail[0]['member_id']);
	$this->session->set_userdata('applicant_no', $userdetail[0]['applicant_no']);
	$this->session->set_userdata('role', $userdetail[0]['role']);
    redirect("admin"); 	
	}
	elseif($userdetail[0]['status']=='inDactive')
	{
	$this->session->set_flashdata('error','Your member ID is lock. Please contact Assurdness Head Office.');
	redirect ("login");
	}
	}
	else
	{
		$this->session->set_flashdata('error','Your Member Id & Password is wrong');
		redirect ("login");
	}
	}	
	}
	}

	function distributorledger()
	{
if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = '11';
			$year = date('Y');
			
		}

		$data['month'] =$month;
		$data['year'] = $year;
		$id = $this->session->userdata('applicant_no');
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
		
			$this->userview('mlmuser/distributorledger',$this->data); 
		}

	public function statements()
	{
		
		if(isset($_POST['month']) && isset($_POST['year'])){
			$month = $_POST['month'];
			$year = $_POST['year'];
		}else{
			$month = '11';
			$year = date('Y');
			
		}

		$data['month'] =$month;
		$data['year'] = $year;
		$appno = $data['appno'] = $this->session->userdata('applicant_no');
		
		$query = $this->db->query('select * from report_process where sponsor_id='.$appno.' AND month ='.$data['month'].' AND year='.$data['year'].'');
		$query1 = $this->db->query('select current_month_bv-current_month_bv_a-current_month_bv_b-current_month_bv_c-current_month_bv_d as bv FROM member_bv WHERE applicant_no ='.$appno.' AND month ='.$data['month'].' AND year='.$data['year'].''); 
		$query2 = $this->db->query('select PreviousBalance FROM mlm_bonus WHERE applicant_no ='.$appno.' and MONTH(`date`) ='.$data['month'].' and YEAR(`date`)='.$data['year'].''); 
		$data['statements'] = $query->result();
		$data['selfbv'] = $query1->result();
		$data['prevbal'] = $query2->result();
		$data['userview'] = $this->getprofilepic();
		$data['level'] = $this->getlevel();
		
		$this->userview('mlmuser/statements',$data);	

	}




    public function sendsmsregister($usermobileno,$Userid,$password)
	{
	$user='Assurdnessbusinesstxn';                                                         // Here Varible $user Holds Your SMS Panel USERID
	$pass='472722';                                                         // Here Varible $pass Holds Your SMS Panel Password
	$senderid='ASSURD';                                                        // Here Varible $senderid Holds the sms SenderID Which Apper on the message

$msg= "Dear Distributor Welcome to Assuredness, You can login with your RegID-".$Userid." and Password ".$password."..Regards, Assuredness marketing pvt.Ltd. Wish u Success";	
	$link= "https://www.mysmsapp.in/api/push.json?apikey=5d2d60cfe3d45&sender=".$senderid."&mobileno=".$usermobileno."&text=".$msg;  // We Creates an API Link .
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
	
	public function forget()
	{
		if($this->input->post('applicant_no')!='')
		{

		//$old = $this->input->post('oldpassword');
		$applicantno = $this->input->post('applicant_no');
		//$new = $this->input->post('newpassword');

		// $otpno = $this->getdata('','mlm_members_detail',"applicant_no='".$applicantno."'");

		 $otpnoinfo = $this->base_model->run_query("select ml.*,md.mobile_no from mlm_members_detail md,mlm_members_login ml where ml.applicant_no ='".$applicantno."' and ml.applicant_no = md.applicant_no and ml.status='inActive'");

		$usermobileno =   $otpnoinfo[0]->mobile_no;
		$userpasswordinfo =   $otpnoinfo[0]->password;

		$user='Assurdnessbusinesstxn';                                                         // Here Varible $user Holds Your SMS Panel USERID
		$pass='472722';                                                         // Here Varible $pass Holds Your SMS Panel Password
		$senderid='AssurdnessBUS';                                                        // Here Varible $senderid Holds the sms SenderID Which Apper on the message
		$msg= "Your+Password+for+AssurdnessBusiness+loginID+is:+".$userpasswordinfo."";        

		$link= "http://anysms.in/api.php?username=".$user."&password=".$pass."&sender=".$senderid."&sendto=".$usermobileno."&message=".$msg;  // We Creates an API Link .

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

		if ($err)
		{
		  $this->prepare_flashmessage($err,1);
		}
		else{
			$this->session->set_flashdata('succes','Please check your Password successfully send in Your Mobile No.');
		}
	    return redirect('login/forget','refresh');	
		}
		else{
				$this->load->view('general/forget','refresh');	
			}
	}

	public function check()
	{


		$this->load->view('general/login');				 
	}
	
	public function check_login()
	{		
		

		
		if($this -> input -> post()){
			$validate = array(
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules'	=> 'required'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required'
				)
			);
			$this -> form_validation -> set_rules($validate);
			if($this -> form_validation -> run() == FALSE){

	$this->session->set_flashdata('error', 'Please Input UserId & Password');	

					return redirect('','refresh');
				
			}else{
				$username = $this -> input -> post('username');
				$password = $this -> input -> post('password');
				
				if($username!=''&&$password!=''){	
					
					$table 	= $this->db->dbprefix('tbl_org');
				$login 		= $this->base_model->run_query("select * from "
		.$table." where status = 'Active' and Orgid='".$username."' and password='".$password."'");
		                  		echo "<pre>"; print_r($monthdplist); exit;
							$this->data['login'] 	= $login;
					
							$type =	$login[0]->org_type;
							
							$empid = $login[0]->Orgid;
					
							$role =	$login[0]->org_role;
							
							$this->session->set_userdata('empid', $username);
					
							$this->session->set_userdata('role', $role);
							
							$empuserid = $this->session->userdata('empid');
							
													
							if($type=="Admin"){								
									return redirect('admin/index',$this->data);
								}else{								
								
			$tbl_student = $this->db->dbprefix('tbl_student');
								
								
								
				$studentlogin 		= $this->base_model->run_query("select * from "
		.$tbl_student." where status = 'Active' and Stdid='".$username."' and password='".$password."'");								
							
							$this->data['studentlogin'] 	= $studentlogin;
							
								
								$currentdate = date('Y-m-d');
								
			$tbl_teacher = $this->db->dbprefix('tbl_teacher');
				$teacherlogin = $this->base_model->run_query("select * from "
		.$tbl_teacher." where status = 'Active' and Tecid='".$username."' and password='".$password."'");
								
								$this->data['teacherlogin'] 	= $teacherlogin;
								
if(($studentlogin[0]->Stdid==$username)&&($studentlogin[0]->student_type=="User")&&($studentlogin[0]->card_validity>$currentdate))
								{
									$type =	$studentlogin[0]->student_type;
							
									$empid = $studentlogin[0]->Stdid;
									
									$role =	"5";

									$this->session->set_userdata('empid', $username);

									$empuserid = $this->session->userdata('empid');
									
									$this->session->set_userdata('user_role', $role);
									
									redirect('student/index',$this->data);
									
								}
								if($teacherlogin[0]->Tecid==$username)
								{
									$type =	$teacherlogin[0]->teacher_type;
							
									$empid = $teacherlogin[0]->Tecid;
									
									$role =	"4";

									$this->session->set_userdata('empid', $username);

									$empuserid = $this->session->userdata('empid');
									
									$this->session->set_userdata('user_role', $role);
									
									if($type=="User")
									{									
										redirect('teacher/index',$this->data);
									}
								}
								
				elseif(($studentlogin[0]->password!=$password)){								
							$this->session->set_flashdata('error', 'Your Password is wrong. Try again');
							redirect ($this->config->item ('login').'login',$this->data);
						}
					else{
							$this->session->set_flashdata('error', 'Your Membarship Card Validity Exipire. Try again');							
							redirect ($this->config->item ('login').'login',$this->data);
								
					}								
						
				}
			}
		 }
	  }
	}
	
	public function logout(){		
		$this->session->unset_userdata('empid');		
		$this->session->set_flashdata('success','You have successfully logged out');
		redirect ($this->config->item ('login').'login',$this->data);
		
		
	}
	
	function updatekyc(){
		
		$this->data = array();
		
		if(isset($_FILES)){
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
		
		$this->userview('branch/uploadkyc',$this->data); 
	}
	
	private function set_upload_option()
    {
        $config2['upload_path'] = './uploads/doc_'.$this->session->userdata('applicant_no').'/';
        $config2['allowed_types'] = 'gif|jpg|png|jpeg';
        $config2['max_size'] = 2048;
        $config2['encrypt_name'] = TRUE;

        return $config2;
	}
	
	function distchalanviewCGST()
	{
		$aa =  ($this->session->userdata('final'));
		$dd = $aa.'-04-01';
		
		$alluser = $this->base_model->run_query("select mlm_dist_chalan.* from mlm_dist_chalan where chalantype =2 and branch_id= '".$this->session->userdata('applicant_no')."' and date(datetime)>='".$dd."' LIMIT 50");
		$this->data['alluser'] 		=  $alluser;		
		$this->data['title'] 		= 'Bill List';
		$this->data['active_menu'] 	= 'CGST Bill List';
		$this->data['content'] 		= 'admin/pucchalanviewCGST';
		$this->userview('mlmuser/distchalanviewCGST',$this->data); 
	}


		
}
?>

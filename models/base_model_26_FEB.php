<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Model extends CI_Model  
{

/*
| -----------------------------------------------------
| PRODUCT NAME: 	ONLINE EXAM MANAGEMENT SYSTEM (OEMS)
| -----------------------------------------------------
| AUTHER:			Amit Sadaphal
| -----------------------------------------------------
| EMAIL:			amit.sadaphal@gmail.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY OTS
| -----------------------------------------------------
| WEBSITE:			http://point.otsinfotechindia.com     
| -----------------------------------------------------
|
| MODULE: 			Base Model
| -----------------------------------------------------
| This is Base Model module controller file.
| -----------------------------------------------------
*/


	function __construct()
	{
		parent::__construct();
	}

	
	//General database operations

	function run_query($query)
	{
		return($this->db->query($query)->result());  
	}
	
	public function getRole()  
   	{  
   	 
      $this->db->select('id,name');  
      $this->db->from('tbl_role');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['name'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function getMonth()  
   	{  
   	 
      $this->db->select('id,month');  
      $this->db->from('tbl_month');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['month'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }
	
	public function getSection()  
   	{  
   	 
      $this->db->select('id,section_name');  
      $this->db->from('tbl_section');  
      $query = $this->db->get();  
      $data[] = "select section";
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['section_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function getSession()  
   	{  
   	 
      $this->db->select('id,start_year,end_year');  
      $this->db->from('tbl_session');  
      $query = $this->db->get();  
      $data[] = "select session year";
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['start_year'].'&nbsp;-&nbsp;'.$row['end_year'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }

    public function getSttype()  
   	{  
   	 
      $this->db->select('id,st_type');  
      $this->db->from('tbl_sttype');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['st_type'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }

    public function getStudentGroup()  
   	{  
   	 
      $this->db->select('id,group_name');  
      $this->db->from('tbl_stgroup');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['group_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }

    public function getHouseGroup()  
   	{  
   	 
      $this->db->select('id,house_name');  
      $this->db->from('tbl_housegroup');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['house_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }

   public function update_Studentimage($id,$stimage)
	  {
		  
		 $this->db->where('aid',$id)->update('tbl_student',$stimage);	
		//$this->db->where('aid',$id)->update('tbl_student',$image);
	  }

	public function insert_Sliderimage($sliderimage)
	  {
		  
		 $this->db->insert($this->db->dbprefix('tbl_slider'),$sliderimage);
		//$this->db->where('aid',$id)->update('tbl_student',$image);
	  }

    public function getAdtype()  
   	{  
   	 
      $this->db->select('id,ad_type');  
      $this->db->from('tbl_adtype');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['ad_type'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }
	
	public function getFee()  
   	{  
		$this->db->select('*');
		$this->db->from('tbl_org');
		$this->db->join('tbl_fee', 'tbl_fee.coaching_name = tbl_org.aid');

		$query = $this->db->get();
     $data["3"] = "select fees";
      foreach($query->result_array() as $row){  
         $data[$row['tution_amount']]=$row['org_name'].'&nbsp;-&nbsp;'.$row['tution_amount'];  
      }  
      // the fetching data from database is return  
      return $data;  
    }

	function check_menu($userid,$menuid,$eid)
	{
	$this->db->select("uid");
	$this->db->from("menu_user");
    $this->db->where("menu_id",$menuid);
	$this->db->where("user_id",$userid);
	$this->db->where("eid",$eid);
	$result=$this->db->get();
	$res=$result->result_array();
    return $res[0]['uid'];	
	}
	
	
	public function get_section($id)
	{
	$this->db->select('id,section_name');  
    $this->db->from('tbl_section');  
	 $this->db->where('id',$id); 
		return $this->db->get()->result_array(); 	
		
	}
	
	public function get_session($id)
	{
	$this->db->select('id,start_year,end_year');  
    $this->db->from('tbl_session');  
	 $this->db->where('id',$id); 
		return $this->db->get()->result_array(); 	
		
	}

	public function getTaxrate()  
   	{  
   	 
      $this->db->select('id,tax_rate');  
      $this->db->from('tbl_tax');  
      $query = $this->db->get();  
     $data[] = "select tax rate";
      foreach($query->result_array() as $row){  
         $data[$row['tax_rate']]=$row['tax_rate'];   
      }  
      // the fetching data from database is return  
      return $data;  
    }

    public function get_taxrate($id)
	{
	$this->db->select('id,tax_rate');  
    $this->db->from('tbl_tax');  
	 $this->db->where('id',$id);  
		return  $this->db->get()->result_array(); 	
	}

	public function getProduct()  
   	{  
   	 
      $this->db->select('id,product_name');  
      $this->db->from('tbl_product_inventory');  
      $query = $this->db->get();  
     $data[] = "Select Product";
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['product_name'];   
      }  
      // the fetching data from database is return  
      return $data;  
    } 

   public function get_product($id)
	{
	$this->db->select('id,product_name');  
    $this->db->from('tbl_product_inventory');  
	 $this->db->where('id',$id);  
		return  $this->db->get()->result_array(); 	
	}

  public function getBank()  
    {  
     
      $this->db->select('id,bank_name');  
      $this->db->from('tbl_bank');  
      $query = $this->db->get(); 
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['bank_name'];   
      }  
      // the fetching data from database is return  
      return $data;  
    }
	
	public function getCategory()  
   	{  
   	 
      $this->db->select('id,category_name');  
      $this->db->from('tbl_category');  
      $query = $this->db->get();  
     $data[] = "select category";
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['category_name'];   
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function get_class($id)
	{
	$this->db->select('id,class_name');  
    $this->db->from('tbl_class');  
	 $this->db->where('id',$id);  
		return  $this->db->get()->result_array(); 	
	}
	
	public function get_coaching($id)
	{
	$this->db->select('aid,org_name');  
    $this->db->from('tbl_org');  
	 $this->db->where('aid',$id);  
		return  $this->db->get()->result_array(); 	
	}

	public function get_coaching_name($id)
	{
	$this->db->select('aid,org_name');  
    $this->db->from('tbl_org');  
	 $this->db->where('branch_id',$id);  
		 $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['aid']]=$row['org_name'];  
      }  

      return $data;
	}

	public function getcoachingname($id)
	{
	$this->db->select('aid,org_name');  
    $this->db->from('tbl_org');  
	 $this->db->where('Orgid',$id);  
		 $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['aid']]=$row['org_name'];  
      }  

      return $data;
	}
	
	public function getcheck_Coaching($id)  
   	{  
   	 
      $this->db->select('aid,org_name');  
      $this->db->from('tbl_org');
	  $this->db->where('aid',$id);
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['aid']]=$row['org_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function getCoaching()  
   	{  
   	 
      $this->db->select('aid,Orgid,org_name');  
      $this->db->from('tbl_org');
	  $this->db->where('org_role',1);
      $query = $this->db->get();  
     $data[5] = 'select school';
      foreach($query->result_array() as $row){  
         $data[$row['aid']]=$row['org_name'];   
      }  

      // the fetching data from database is return  
      return $data;  
    } 
	
	public function get_subject($id)
	{
	$this->db->select('id,subject_name');  
    $this->db->from('tbl_subject');  
	 $this->db->where('id',$id);  
		return  $this->db->get()->result_array(); 	
	}
	
	public function getSubject()  
   	{  
   	 
      $this->db->select('id,class_id,subject_name');  
      $this->db->from('tbl_subject');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['subject_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function get_teacher($id)
	{
	$this->db->select('Tecid,FirstName,LastName');  
    $this->db->from('tbl_teacher');  
	 $this->db->where('Tecid',$id);  
		return  $this->db->get()->result_array(); 	
	}
	
	public function getTeacher()  
   	{  
   	 
      $this->db->select('Tecid,FirstName,LastName');  
      $this->db->from('tbl_teacher');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['Tecid']]=$row['FirstName'].'&nbsp;&nbsp;'.$row['LastName'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
    public function gettuitionfees($class_id,$coaching_id)
    {
    	$query2 = $this->db->get_where("tbl_fee",array("class_name"=>$class_id,'coaching_name'=>$coaching_id));
		return $query2->result();
	

    }
	
	public function getStudent()  
   	{  
   	 
      $this->db->select('Stdid,FirstName,LastName');  
      $this->db->from('tbl_student');
	  $this->db->where('created_by',$this->session->userdata('empid'));
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['Stdid']]=$row['FirstName'].'&nbsp;&nbsp;'.$row['LastName'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function getTemplate()  
   	{  
   	 
      $this->db->select('id,title,description');  
      $this->db->from('tbl_template');  
      $query = $this->db->get();  
     
      foreach($query->result_array() as $row){  
         $data[$row['description']]=$row['title'];  
      }  
      // the fetching data from database is return  
      return $data;  
    } 
	
	public function ExportCSV()
	{
			$this->load->dbutil();			
			$this->load->helper('download');
			$delimiter = ",";
			$newline = "\r\n";
			$filename = "Allattendance.csv";
			$query = "SELECT Stdid as StudentID,date as Date,month as Month,ipused as IP,logintime as PunchInTime,logout as PunchOutTime FROM tbl_attendance where Stdid = '".$this->session->userdata('empid')."'";
			$result = $this->db->query($query);
			$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
			force_download($filename, $data);
			return true;			
		}
	
	public function ExportTimetable()
	{
			$this->load->dbutil();			
			$this->load->helper('download');
			$delimiter = ",";
			$newline = "\r\n";
			$filename = "Alltimetable.csv";
			$query = "SELECT c.class_name as Class,t.week_no as Week,t.mon1 as MONTIME1,t.mon2 as MONTIME2,t.tue1 as TUETIME1,t.tue2 as TUETIME2,t.wed1 as WEDTIME1,t.wed2 as WEDTIME2,t.thu1 as THUTIME1,t.thu2 as THUTIME2,t.fri1 as FRITIME1,t.fri2 as FRITIME2,t.sat1 as SATTIME1,t.sat2 as SATTIME2 FROM tbl_timetable as t,tbl_class as c where c.id=t.class_id";
			$result = $this->db->query($query);
			$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
			force_download($filename, $data);
			return true;			
		}
	
	//Country State City Dropdown Value Fetch Start
	//fill your contry dropdown  
   public function getCountries()  
   {  
   	 
      $this->db->select('country_id,country_name');  
      $this->db->from('tbl_country');  
      $query = $this->db->get();  
      // the query mean select cat_id,category from category  
      foreach($query->result_array() as $row){  
         $data[$row['country_id']]=$row['country_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
   } 
   //fill your State dropdown depending on the selected Country   
   public function getStateByCountry()  
   {  
   	 	
      $this->db->select('state_id,state_name');  
      $this->db->from('mlm_state_master');  
      //$this->db->where('country_id',$cat_id);  
      $query = $this->db->get();
	 	foreach($query->result_array() as $row){  
         $data[$row['state_id']]=$row['state_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
      
   }

   public function getuserlist($limit,$offset,$cond)
     {
     $q = "select a.member_id,a.applicant_no,a.email,a.password,a.role,a.status,b.coupon_id,(select c.applicant_name from mlm_members_detail as c where c.applicant_no=b.sponser_no) as sponser_name,b.sponser_no,(select d.applicant_name from mlm_members_detail as d where d.applicant_no=b.proposer_no) as proposer_name,b.proposer_no,b.applicant_name, b.father_name,b.nomnee_name,b.applicant_dob,b.nomnee_age,b.nomnee_dob,b.nomnee_rel,b.location,f.state_name,g.city_name as district_name,b.tehsil,b.post,b.city,b.pincode,b.phone_no,b.mobile_no,b.bank_name,b.bank_branch_state,b.bank_accno,b.bank_ifsc_code from mlm_members_login as a left join mlm_members_detail as b on a.applicant_no=b.applicant_no left join mlm_state_master as f on b.state = f.state_id left join mlm_city_master g on b.district = g.id where a.role='member' $cond LIMIT $limit OFFSET $offset";
     $rs = $this->db->query($q);
	 $ret['rows']  = $rs->result();
     //Count Query
     $q = $this->db->select('COUNT(*) as count',FALSE)
            ->from('mlm_members_detail');             
     $tmp = $q->get()->result();
     $ret['num_rows'] = $tmp[0]->count;
     return $ret;
     } 
	 
   
   //fill your cities dropdown depending on the selected State  
   public function getStateByCity()  
   {  
   	  	
      $this->db->select('id,city_name');  
      $this->db->from('tbl_city');  
      //$this->db->where('state_id',$cat_id);  
      $query = $this->db->get();  
      foreach($query->result_array() as $row){  
         $data[$row['id']]=$row['city_name'];  
      }  
      // the fetching data from database is return  
      return $data;  
   } 

   public function getState($id)  
    {  
     
      $this->db->select('state_id,state_name');  
      $this->db->from('mlm_state_master');  
       $this->db->where('state_id',$id);
      $query = $this->db->get();  
     
      //foreach($query->result() as $row){  
        // $data[$row->id]=$row->subject_name;  
     // }  
      // the fetching data from database is return  
      return $query->result_array();  
    }  
	 
	//Country State City Dropdown Value Fetch End
	
	
	function getMaxId($TableName, $ColName)
	{
		$query 							= $this->db->query(
		"select max(".$ColName.") as Id from "
		.$this->db->dbprefix($TableName)
		)->result();
		return $query[0]->Id;
	}
	function getcodediscount($code)
	{
		$query2 = $this->db->get_where("tbl_generatecode",array("code"=>$code));
		return $query2->first_row();
	}

	function insert_operation($inputdata, $table, $email = '')
	{
		if ($this->db->insert($this->db->dbprefix($table), $inputdata))
    		return 1;
		else 
    		return 0;
	}

	function insert_operation_id($inputdata, $table, $email = '')
	{
		$result  = $this->db->insert($this->db->dbprefix($table), $inputdata);
		return $this->db->insert_id();
	}

	function update_operation($inputdata, $table, $where)
	{
		$result  = $this->db->update(
		$this->db->dbprefix($table), 
		$inputdata, 	
		$where
		);
		return $result;
	}

	function fetch_single_column_value($table, $column, $where='')
	{
		$this->db->select($column,FALSE);
		$this->db->from( $this->db->dbprefix( $table ) );
		
		if( !empty( $where ) )
			$this->db->where( $where );
		$result_rs = $this->db->get();
		$result = $result_rs->result();
		if( count( $result ) > 0 )
			$ret = $result[0]->$column;
		else
			$ret = '-';
		return $ret;
	}
	
	function fetch_records_from(
	$table, 
	$condition 		= '', 
	$select 		= '*', 
	$order_by 		= '', 
	$limit 			= ''
	)
	{
		$this->db->select($select, FALSE);
		$this->db->from($this->db->dbprefix($table));
		if (!empty($condition))
			$this->db->where( $condition );
		if (!empty($order_by))
			$this->db->order_by($order_by);
		if (!empty($limit))
			$this->db->limit($limit);
		$result = $this->db->get();
		return $result->result();
	}


	function changestatus($table, $inputdata, $where )
	{
		$result = $this->db->update($this->db->dbprefix($table), $inputdata, $where);
		return $result;
	}

	function delete_record($table, $where)
	{	
		$result = $this->db->delete($table, $where);
		return $result;
	}

	function check_duplicate($table_name, $cond, $cond_val)
	{
		$col_name 		= '*';
		$this->db->where(array($cond=>$cond_val));
		$this->db->from($this->db->dbprefix($table_name));
		$query 			= $this->db->get();
		$rows 			= $query->num_rows();
		if ($rows > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	function count_rows($class_id,$coaching_id)
	{
		$query2 = $this->db->get_where("tbl_autogen",array("class_id"=>$class_id,'coaching_id'=>$coaching_id));
		return $query2->num_rows();
	

	}
	function get_autogen($class_id,$coaching_id)
	{
		$query2 = $this->db->get_where("tbl_autogen",array("class_id"=>$class_id,'coaching_id'=>$coaching_id));
		return $query2->result();
	

	}

	function check_duplicates($table_name, $conditions)
	{
		$col_name 		= '*';
		$this->db->where($conditions);
		$this->db->from($this->db->dbprefix($table_name));
		$query = $this->db->get();
		$rows = $query->num_rows();
		if($rows > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	public function get_details($table)
	{
		$query 			= $this->db->get($table);
		return $query->result_array();
	}

	function get_single_column_value($column_name, $table, $condition)
	{
		$this->db->select($column_name);
		$this->db->from($table);
		$this->db->where($condition);
		return $this->db->get()->row()->$column_name;
	}
	
	
	function currentbvback($apno,$mon,$year)
	{
	$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id = '".$apno."' and MONTH(`datetime`) = '".$mon."' and YEAR(`datetime`) = '".$year."'");
    $curbv=$result->result_array();
    return $curbv[0]['monthbv']; 	
	}
	
	function recursive($pos_category_id,$array='')
    {
    $query = $this->db->query("SELECT applicant_no,applicant_parent_no FROM mlm_member_tree WHERE applicant_parent_no = '".$pos_category_id."'") or 
    die('Invalid query: ' . mysql_error());
	foreach($query->result_array() as $row)
    {
        //$sub_cat = $return['applicant_no'];
        $array[] = $row['applicant_no'];
            

        $array = $this->recursive($row['applicant_no'], $array);
    }
    return $array;
	}
	
	function currentbv($apno,$mon,$year)
	{
	$pp1 = $this->recursive($apno,$array='');
	/*$query = $this->db->query("SELECT GROUP_CONCAT(lv SEPARATOR ',') as apids FROM ( SELECT @pv:=(SELECT GROUP_CONCAT(applicant_no SEPARATOR ',') FROM mlm_member_tree WHERE FIND_IN_SET(applicant_parent_no, @pv)) AS lv FROM mlm_member_tree JOIN (SELECT @pv:=$apno) tmp ) a");
    $curbv = $query->result_array();
	*/
	$kk = array_map(function($n) { return "'".$n."'"; },$pp1);
	$kk[] = "'".$apno."'";
	$pp = implode(',',$kk);	
	$result = $this->db->query("SELECT sum(`totalbv`) as monthbv FROM `mlm_dist_chalan` WHERE branch_id in ($pp) and MONTH(`datetime`) = '".$mon."' and YEAR(`datetime`) = '".$year."'");
    $curbv=$result->result_array();
	$result1 = $this->db->query("SELECT sum(`bv`) as monthbv1 FROM `old_bv_dp` WHERE applicant_no in ($pp) and MONTH(`date`) = '".$mon."' and YEAR(`date`) = '".$year."'");
    $curbv1=$result1->result_array();
    return $curbv[0]['monthbv']+$curbv1[0]['monthbv1']; 	
	}
	
	function getuserarray($pos_category_id,$array='')
    {
    $pp1 = $this->recursive($pos_category_id,$array='');
	/*$query = $this->db->query("SELECT GROUP_CONCAT(lv SEPARATOR ',') as apids FROM ( SELECT @pv:=(SELECT GROUP_CONCAT(applicant_no SEPARATOR ',') FROM mlm_member_tree WHERE FIND_IN_SET(applicant_parent_no, @pv)) AS lv FROM mlm_member_tree JOIN (SELECT @pv:=$apno) tmp ) a");
    $curbv = $query->result_array();
	*/
	$kk = array_map(function($n) { return "'".$n."'"; },$pp1);
	$kk[] = "'".$pos_category_id."'";
	$pp = implode(',',$kk);
	$result = $this->db->query("SELECT sum(totalbv) as totalbv FROM `mlm_dist_chalan` WHERE branch_id in ($pp)");
	$result1 = $this->db->query("SELECT sum(`bv`) as totalbv1 FROM `old_bv_dp` WHERE applicant_no in ($pp)");
    $curbv1=$result1->result_array();
    $curbv=$result->result_array();
    return $curbv[0]['totalbv']+$curbv1[0]['totalbv1'];
    }
	
	
	
	
	function getserialnoviatypepucdist($type)
	{
	$query = $this->db->query("select (COALESCE(max(s_no),0)+1) as serl_no from (SELECT s_no FROM `mlm_puc_chalan` where billfromtype = '".$type."' union select s_no from mlm_dist_chalan where billfromtype = '".$type."') as kk ");	
	$curbv = $query->result_array();
	return $curbv[0]['serl_no'];
	}
	
	function getserialwisedata($type, $cond)
	{
	$query = $this->db->query("select datetime,branch_id,s_no,(CASE when chalantype =1 then 'IGST' else 'CGST & SGST' end) as chalantypename from (SELECT datetime,branch_id,s_no,chalantype FROM `mlm_puc_chalan` where billfromtype = '".$type."'  $cond union select datetime,branch_id,s_no,chalantype from mlm_dist_chalan where billfromtype = '".$type."'  $cond) as kk");	
	$curbv = $query->result_array();
	return $curbv;
	}
	
	
	function productsale($productid)
	{
	$query = $this->db->query("select sum(quan) as productsale from (SELECT sum(quantity) as quan FROM `mlm_puc_chalan` join mlm_puc_chalan_detail on mlm_puc_chalan.chalan_id = mlm_puc_chalan_detail.chalan_id where `product_id` = '".$productid."' and billfromtype = 1 union select sum(quantity) as quan from mlm_dist_chalan join mlm_dist_chalan_detail on mlm_dist_chalan.chalan_id=mlm_dist_chalan_detail.chalan_id where `product_id` = '".$productid."' and billfromtype = 1 and schemeid!=0) as sale");	
	$curbv = $query->result_array();
	return $curbv[0]['productsale'];
	}
	
	function productsalepuc($productid,$uid)
	{
	$query = $this->db->query("select sum(quan) as productsale from (SELECT sum(quantity) as quan FROM `mlm_puc_chalan` join mlm_puc_chalan_detail on mlm_puc_chalan.chalan_id = mlm_puc_chalan_detail.chalan_id where `product_id` = '".$productid."' and billfromtype = 2 and createby = '".$uid."' union select sum(quantity) as quan from mlm_dist_chalan join mlm_dist_chalan_detail on mlm_dist_chalan.chalan_id=mlm_dist_chalan_detail.chalan_id where `product_id` = '".$productid."' and  billfromtype = 2 and createby = '".$uid." and schemeid!=0') as sale");	
	$curbv = $query->result_array();
	return $curbv[0]['productsale'];
	}
	
	function getprodctinfo($apno,$productid)
	{
	$query = $this->db->query("select pucproductquantity from puc_product_details where applicant_no='".$apno."' and productid='".$productid."'");	
	$curbv = $query->result_array();
	return $curbv[0]['pucproductquantity'];
	}
	
	function getprodctinfonew($apno,$productid)
	{
	$query = $this->db->query("select pucproductquantity,open_quantity from puc_product_details where applicant_no='".$apno."' and productid='".$productid."'");	
	$curbv = $query->result_array();
	return $curbv;
	}
	
	function productinfo($productid)
	{
	$query = $this->db->query("select * from tbl_product_inventory where `id` = '".$productid."'");	
	$curbv = $query->result_array();
	return $curbv;
	}
	
	
}


/* End of file base_model.php */
/* Location: ./application/models/base_model.php */
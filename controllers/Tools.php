<?php
class Tools extends CI_Controller {

        public function currentMonthBV($to)
        {
				ini_set('xdebug.max_nesting_level', 8900000);
				$month = 04; //date('m');
				$year = 2021; //date('Y');
				
				//$this->db->limit(1);
				$query = $this->db->query("SELECT * from mlm_members_detail where applicant_no='".$to."'");
				foreach($query->result_array() as $row)
				{
					$applicant_no = $row['applicant_no']; 
					$return_bv = $this->base_model->bvnew($applicant_no, $month, $year);
					$current_month_bv = $return_bv[0];
					$overall_total_bv = $return_bv[1];
					$userquery = $this->db->query("SELECT b.applicant_no,a.applicant_parent_no,b.sponser_no,b.applicant_name FROM mlm_member_tree a left join mlm_members_detail b on a.applicant_no=b.applicant_no WHERE a.applicant_parent_no = '".$applicant_no."'");
					$userdata = $userquery->result_array(); 
					
					if(isset($userdata[0]['applicant_no'])){
						$applicant_no = $userdata[0]['applicant_no'];
						$return_bv_a = $this->base_model->bvnew($applicant_no, $month, $year);
						$current_month_bv_a = $return_bv_a[0];
						$overall_total_bv_a = $return_bv_a[1];
						
					}else{
						$current_month_bv_a = 0;
						$overall_total_bv_a = 0;
					}
					
					if(isset($userdata[1]['applicant_no'])){
						$applicant_no = $userdata[1]['applicant_no'];
						$return_bv_b = $this->base_model->bvnew($applicant_no, $month, $year);
						$current_month_bv_b = $return_bv_b[0];
						$overall_total_bv_b = $return_bv_b[1];
						
					}else{
						$current_month_bv_b = 0;
						$overall_total_bv_b = 0;
					}
					
					if(isset($userdata[2]['applicant_no'])){
						$applicant_no = $userdata[2]['applicant_no'];
						$return_bv_c = $this->base_model->bvnew($applicant_no, $month, $year);
						$current_month_bv_c = $return_bv_c[0];
						$overall_total_bv_c = $return_bv_c[1];
						
					}else{
						$current_month_bv_c = 0;
						$overall_total_bv_c = 0;
					}
					
					if(isset($userdata[3]['applicant_no'])){
						$applicant_no = $userdata[3]['applicant_no'];
						$return_bv_d = $this->base_model->bvnew($applicant_no, $month, $year);
						$current_month_bv_d = $return_bv_d[0];
						$overall_total_bv_d = $return_bv_d[1];
						
					}else{
						$current_month_bv_d = 0;
						$overall_total_bv_d = 0;
					}
					
					$data = array(
							'applicant_no' => $row['applicant_no'],
							'applicant_name' => $row['applicant_name'],
							'current_month_bv' => $current_month_bv,
							'overall_total_bv' => $overall_total_bv,
							'current_month_bv_a' => $current_month_bv_a,
							'current_month_bv_b' => $current_month_bv_b,
							'current_month_bv_c' => $current_month_bv_c,
							'current_month_bv_d' => $current_month_bv_d,
							'overall_total_bv_a' => $overall_total_bv_a,
							'overall_total_bv_b' => $overall_total_bv_b,
							'overall_total_bv_c' => $overall_total_bv_c,
							'overall_total_bv_d' => $overall_total_bv_d,
							'month' => $month,
							'year' => $year,
							'date' => date('Y-m-d H:i:s')
					);

					$this->db->insert('member_bv', $data);
					//if($current_month_bv>=0){
						//echo $applicant_no." : ".$current_month_bv." : ".$overall_total_bv.PHP_EOL;
						//echo $current_month_bv_a." : ".$current_month_bv_b." : ".$current_month_bv_c." : ".$current_month_bv_d.PHP_EOL;
						//echo $overall_total_bv_a." : ".$overall_total_bv_b." : ".$overall_total_bv_c." : ".$overall_total_bv_d.PHP_EOL;
					//}
				}
        }
}

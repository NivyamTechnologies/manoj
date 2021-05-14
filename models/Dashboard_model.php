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
| MODULE: 			Dashboard Model
| -----------------------------------------------------
| This is Dashboard Model module controller file.
| -----------------------------------------------------
*/

class Dashboard_model extends CI_Model{
	
	public function insert($table,$data){
	$this->db->insert($table,$data);
	}	
	
	//// select all data from database
	public function select_all($table){
		$q = $this->db->select('*')
					  ->get($table);
		return $q->result();
	}
	
	//// select all data with where condition from database
	public function select_where($table,$where){
		$q = $this->db->select('*')
					  ->where($where)
					  ->get($table);
		return $q->result();
	}
	
	public function single_data($table){
		$q = $this->db->select('*')
					  ->get($table);
		return $q->row();			  
	}
	
	public function single_data_where($table,$where){
		$q = $this->db->select('*')
					  ->where($where)
					  ->get($table);
		return $q->row();			  
	}
	
	public function update($table,$data,$where){
	$this->db->where($where)
			->update($table,$data);
	}
	
	public function delete_record($table,$where){
		$this->db->delete($table,$where);
	}
	
	//General database operations
	function run_query($query)
	{
		return($this->db->query($query)->result());  
	}
	
}
?>
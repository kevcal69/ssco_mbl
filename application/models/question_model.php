<?php
class Question_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function add($data) {
		if ($this->db->insert('question', $data)) {
			return true;	
		} 
		return false;
	}

	function add_test($data) {
		if ($this->db->insert('scheduled_test_question', $data)) {
			return true;	
		} 
		return false;
	}	

	function fetch_questions($id) {
		 $query = $this->db->get_where('question', array('module_id' => $id));
		 if ($query) {
		 	return $query->result();
		 } else {
		 	return false;
		 }		
	}

	function fetch_test_questions($id) {
		 $query = $this->db->get_where('scheduled_test_question', array('module_id' => $id));
		 if ($query) {
		 	return $query->result();
		 } else {
		 	return false;
		 }		
	}	

	function fetch_test_sched($id) {
		 $query = $this->db->get_where('scheduled_test', array('module_id' => $id));
		 if ($query) {
		 	return $query->result();
		 } else {
		 	return false;
		 }				
	}

	function fetch_test($id) {
		 $query = $this->db->get_where('scheduled_test_question', array('id' => $id));
		 if ($query) {
		 	return $query->row();
		 } else {
		 	return false;
		 }				
	}	

	function set_test($id,$val) {
		$this->db->where('id', $id);
		$this->db->update('scheduled_test_question', array('is_used'=>$val)); 
	}
}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */
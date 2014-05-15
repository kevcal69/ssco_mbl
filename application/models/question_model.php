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
		 	return $query->row();
		 } else {
		 	return false;
		 }				
	}
}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */
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

	function fetch_evaluation_test($id, $limit = FALSE) {
		if ($limit === FALSE) {
			$limit = 10;
		}

		$array = $this->fetch_questions($id);
		$data = array();

		$haystack = array();
		if (sizeof($array) < $limit) {
			return $array;
		} else {
			for ($i=0; $i < $limit; $i++) { 
				$rand_num = rand(0,sizeof($array)-1);
				if (in_array($rand_num, $haystack)) {
					$i--;
				} else {
					$haystack[$i] = $rand_num;
					array_push($data, $array[$rand_num]);
				}
			}
		}
		return $data;
	}	
}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */
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

	function edit_test($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('scheduled_test_question', $data);

		if ($this->db->_error_message()) {
			return FALSE;
		} else {
			return $this->db->affected_rows();
		}
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

	function set_test($id,$val) {
		$this->db->where('id', $id);
		$this->db->update('scheduled_test_question', array('is_used'=>$val));
	}

	function fetch_filtered_test($filter,$mid) {
		 $query = $this->db->get_where('scheduled_test_question', array('module_id' => $mid, 'is_used' => $filter));
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

	function get_scheduled_tests($test_id = FALSE) {
		if ($test_id === FALSE) {
			//get all scheduled tests
			$query = $this->db->get_where('scheduled_test', array('isset_test' => TRUE));
			if ($query) {
				return $query->result();
			} else {
				return FALSE;
			}
		} else {
			$query = $this->db->get_where('scheduled_test', array('id' => $test_id));
			if ($query) {
				return $query->row();
			} else {
				return FALSE;
			}
		}
	}

	function isset_test($test_id) {
		$query = $this->db->get_where('scheduled_test', array('id' => $test_id));
		if ($query) {
			return $query->isset_test;
		} else {
			return FALSE;
		}
	}
}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */
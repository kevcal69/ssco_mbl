<?php
class Module_test_result_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function insert_result($module_id,$trainee_id,$rating = 0,$content = NULL) {
		$data = array (
			'trainee_id' => $trainee_id,
			'module_id' => $module_id,
			'rating' => $rating,
			'content' => $content
			);
		if ($this->db->insert('module_test_result',$data)) {
			return $this->db->insert_id();
		} else {
			return NULL;
		}
	}

	public function update_result($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('module_test_result',$data);
	}

	public function get_results($module_id = FALSE,$trainee_id = FALSE) {
		//allows for different filters
		if ($module_id !== FALSE && $trainee_id !== FALSE) {
			//module_id and trainee_id given. returns all test results in a module for the trainee
			$data = array(
				'module_id' => $module_id, 
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('module_test_result', $data);
			return $query->result();
		} else if ($module_id === FALSE && $trainee_id !== FALSE) {
			//only trainee_id is given. returns all test results in all modules for the trainee
			$data = array(
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('module_test_result', $data);
			return $query->result();
		} else if ($module_id !== FALSE && $trainee_id === FALSE) {
			//only module_id is given. gets all test results of all trainees for module
			$data = array(
				'module_id' => $module_id
				);
			$query = $this->db->get_where('module_test_result', $data);
			return $query->result();
		} else {
			//no parameters
			$query = $this->db->get('module_test_result');
			return $query->result();
		}
	}

	public function get_result($test_id) {
		$data = array(
			'id' => $test_id
			);
		$query = $this->db->get_where('module_test_result', $data);
		return $query->row();
	}
}

/* End of file module_test_result_model.php */
/* Location: ./application/models/module_test_result_model.php */
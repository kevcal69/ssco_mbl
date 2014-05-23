<?php
class Scheduled_test_result_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function insert_result($test_id,$module_id,$trainee_id,$rating = 0,$content = NULL) {
		$data = array (
			'test_id' => $test_id,
			'trainee_id' => $trainee_id,
			'module_id' => $module_id,
			'rating' => $rating,
			'content' => $content
			);
		if ($this->db->insert('test_result',$data)) {
			return $this->db->insert_id();
		} else {
			return NULL;
		}
	}

	public function update_result($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('test_result',$data);
	}

	public function get_results($test_id = FALSE,$trainee_id = FALSE) {
		//allows for different filters
		if ($test_id !== FALSE && $trainee_id !== FALSE) {
			//test_id and trainee_id given. returns all scheduled test results for the trainee
			$data = array(
				'test_id' => $test_id, 
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('test_result', $data);
			return $query->result();
		} else if ($test_id === FALSE && $trainee_id !== FALSE) {
			//only trainee_id is given. returns all scheduled test results for the trainee
			$data = array(
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('test_result', $data);
			return $query->result();
		} else if ($test_id !== FALSE && $trainee_id === FALSE) {
			//only test_id is given. gets all scheduled test results of all trainees
			$data = array(
				'test_id' => $test_id
				);
			$query = $this->db->get_where('test_result', $data);
			return $query->result();
		} else {
			//no parameters. get all scheduled test results
			$query = $this->db->get('test_result');
			return $query->result();
		}
	}

	public function get_result($test_id) {
		$data = array(
			'id' => $test_id
			);
		$query = $this->db->get_where('test_result', $data);
		return $query->row();
	}
}

/* End of file scheduled_test_result_model.php */
/* Location: ./application/models/scheduled_test_result_model.php */
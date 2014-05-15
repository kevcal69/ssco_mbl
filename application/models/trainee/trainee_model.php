<?php
class Trainee_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_name($trainee_id) {
		$this->db->select('first_name,last_name');
		$name = $this->db->get_where('trainee',array('user_id' => $trainee_id));

		$this->db->select('username');
		$username = $this->db->get_where('user', array('id' => $trainee_id));

		$result = array();
		$result['first_name'] = $name->row()->first_name;
		$result['last_name'] = $name->row()->last_name;
		$result['username'] = $username->row()->username;

		return $result;
	}

	public function get_statistics($trainee_id) {
		//modules enroled
		$this->db->select('module_id,is_completed');
		$modules_enroled = $this->db->get_where('enrolled_module', array('trainee_id' => $trainee_id));
		
		$result['modules_enroled'] = array();
		foreach ($modules_enroled->result_array() as $module) {
			array_push($result['modules_enroled'],$module['module_id']);
		}
		$result['num_modules_enroled'] = sizeof($result['modules_enroled']);
		//modules completed
		$result['modules_completed'] = array();
		foreach ($modules_enroled->result_array() as $module) {
			if ($module['is_completed'] == TRUE) {
				array_push($result['modules_completed'],$module['module_id']);
			}
		}
		$result['num_modules_completed'] = sizeof($result['modules_completed']);
		//tests taken
		
		//average test rating

		return $result;
	}
}

/* End of file trainee_model.php */
/* Location: ./application/models/trainee_model.php */
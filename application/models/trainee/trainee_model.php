<?php
class Trainee_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

/**
*	Fetch trainee name using user_id
*
*	@param	int 		$trainee_id	user_id
*
*	@return	array		array of first_name, last_name and username on success.
*					FALSE		FALSE on failure
*/
	public function get_name($trainee_id) {
		$this->db->select('first_name,last_name');
		$name = $this->db->get_where('trainee',array('user_id' => $trainee_id));

		$this->db->select('username');
		$username = $this->db->get_where('user', array('id' => $trainee_id));

		if ($name->row() && $username->row()) {
			$result = array();
			$result['first_name'] = $name->row()->first_name;
			$result['last_name'] = $name->row()->last_name;
			$result['username'] = $username->row()->username;

			return $result;
		} else {
			return FALSE;
		}
	}

/**
*	Get trainee statistics (name, modules, test results)
*
*	@param	int 		$trainee_id	user_id
*
*	@return	array		array of name(first_name, last_name, username), 
*									modules(completed, current), and scheduled test results
*/
	public function get_statistics($trainee_id) {
		$this->load->model('module_model');
		$this->load->model('module_test_result_model');
		$this->load->model('scheduled_test_result_model');
		//name
		$result['name'] = $this->get_name($trainee_id);
		//modules
		$result['modules'] = array();
		//modules completed
		$result['modules']['completed'] = array();
		$modules_completed = $this->db->get_where('enrolled_module', array('trainee_id' => $trainee_id, 'is_completed' => TRUE));
		foreach ($modules_completed->result() as $module_row) {
			$module = array();
			$module['id'] = $module_row->module_id;
			$module['title'] = $this->module_model->get_title($module['id']);
			$module['date_enroled'] = $module_row->date_enroled;
			$module['date_completed'] = $module_row->date_completed;
			$module['rating'] = $module_row->rating;
			$module['tests_taken'] = sizeof($this->module_test_result_model->get_results($module['id'],$trainee_id));
			array_push($result['modules']['completed'],$module);
		}
		//modules current
		$result['modules']['current'] = array();
		$modules_current = $this->db->get_where('enrolled_module', array('trainee_id' => $trainee_id, 'is_completed' => FALSE));
		foreach ($modules_current->result() as $module_row) {
			$module = array();
			$module['id'] = $module_row->module_id;
			$module['title'] = $this->module_model->get_title($module['id']);
			$module['date_enroled'] = $module_row->date_enroled;
			array_push($result['modules']['current'],$module);
		}
		//scheduled tests
		$result['scheduled_tests'] = array();
		$scheduled_tests = $this->scheduled_test_result_model->get_results(FALSE,$trainee_id);
		foreach ($scheduled_tests as $test_row) {
			$test = array();
			$test['id'] = $test_row->id;
			$test['test_id'] = $test_row->test_id;
			$test['module_title'] = $this->module_model->get_title($test_row->module_id);
			$test['rating'] = $test_row->rating;
			$test['date'] = $test_row->date;
			array_push($result['scheduled_tests'],$test);
		}

		return $result;
	}
}

/* End of file trainee_model.php */
/* Location: ./application/models/trainee_model.php */
<?php
class Trainee_module_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function enrol_module($module_id, $trainee_id) {
		$data = array (
			'module_id' => $module_id,
			'trainee_id' => $trainee_id
			);
		//insert if not exists
		$result = $this->get_enroled_module($module_id, $trainee_id);
		if (empty($result)) {
			return $this->db->insert('enrolled_module',$data);
		} else {
			// $data['last_page'] = NULL;
			$data['is_completed'] = FALSE;
			$data['date_enroled'] = NULL;
			$data['date_completed'] = 'DEFAULT 0';
			$this->db->where('trainee_id',$trainee_id);
			$this->db->where('module_id',$module_id);
			return $this->db->update('enrolled_module',$data);
		}
	}

	public function update_module($module_id,$trainee_id,$rating,$is_completed) {
		//TODO rating calculation
		$data = array(
			'rating' => $rating,
			'is_completed' => $is_completed
			);
		if ($is_completed == TRUE) {
			$data['date_completed'] = NULL;
		}
		$this->db->where('trainee_id',$trainee_id);
		$this->db->where('module_id',$module_id);
		return $this->db->update('enrolled_module',$data);
	}

	public function get_enroled_module($module_id = FALSE, $trainee_id = FALSE) {
		//allows for different filters
		if ($module_id !== FALSE && $trainee_id !== FALSE) {
			//module_id and trainee_id given
			$data = array(
				'module_id' => $module_id, 
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('enrolled_module', $data);
			return $query->row();
		} else if ($module_id === FALSE && $trainee_id !== FALSE) {
			//only trainee_id is given. gets all modules trainee is enroled in
			$data = array(
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('enrolled_module', $data);
			return $query->result();
		} else if ($module_id !== FALSE && $trainee_id === FALSE) {
			//only module_id is given. gets all trainees enroled in module
			$data = array(
				'module_id' => $module_id
				);
			$query = $this->db->get_where('enrolled_module', $data);
			return $query->result();
		} else {
			//no parameters
			$query = $this->db->get('enrolled_module');
			return $query->result();
		}
	}

	public function get_rating ($module_id, $trainee_id) {
		$data = array(
			'module_id' => $module_id,
			'trainee_id' => $trainee_id
			);
		$query = $this->db->get_where('enrolled_module', $data);
		if (is_null($query->row()->rating)) {
			return 0;
		} else {
			return $query->row()->rating;
		}
	}

	public function is_enroled($module_id,$trainee_id) {
		$result =  $this->get_enroled_module($module_id,$trainee_id);
		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function is_completed($module_id,$trainee_id) {
		$result =  $this->get_enroled_module($module_id,$trainee_id);
		if (!empty($result) && $result->is_completed == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_available_modules($trainee_id, $limit = FALSE, $random = FALSE) {
		$sql_query = '
			SELECT	*
			FROM		module m
			WHERE		NOT EXISTS (
							SELECT	NULL
							FROM		enrolled_module e
							WHERE		e.module_id = m.id AND e.trainee_id = '.$trainee_id.'
							)
			';
		if ($random === TRUE) {
			$sql_query = $sql_query .' ORDER BY RAND()';
		}
		if (is_numeric($limit)) {
			$sql_query = $sql_query .' LIMIT '.$limit;
		}
		$query = $this->db->query($sql_query);
		return $query->result();
	}

	public function get_current_modules($trainee_id) {
		$data = array(
			'trainee_id' => $trainee_id,
			'is_completed' => 0
			);
		$query = $this->db->get_where('enrolled_module', $data);
		//get corresponding module from module table
		$result = array();
		foreach ($query->result() as $module) {
			array_push($result,$this->module_model->fetch_module($module->module_id));
		}
		return $result;
	}

	public function get_completed_modules($trainee_id, $limit = FALSE) {
		$data = array(
			'trainee_id' => $trainee_id,
			'is_completed' => 1
			);
		if ($limit !== FALSE && is_numeric($limit)) {
			$query = $this->db->get_where('enrolled_module', $data, $limit);
		} else {
			$query = $this->db->get_where('enrolled_module', $data);
		}
		//get corresponding module from module table
		$result = array();
		foreach ($query->result() as $module) {
			array_push($result,$this->module_model->fetch_module($module->module_id));
		}
		return $result;
	}

	public function get_statistics($trainee_id,$module_id) {
		$this->load->model('module_test_result_model');
		$query = $this->db->get_where('enrolled_module', array('trainee_id' => $trainee_id, 'module_id' => $module_id));
		$module_row = $query->row();
		$module = array();
		$module['id'] = $module_row->module_id;
		$module['title'] = $this->module_model->get_title($module['id']);
		$module['date_enroled'] = $module_row->date_enroled;
		$module['is_completed'] = $module_row->is_completed;
		$module['date_completed'] = $module_row->date_completed;
		$module['rating'] = $module_row->rating;
		$module['tests_taken'] = sizeof($this->module_test_result_model->get_results($module['id'],$trainee_id));
		return $module;
	}
}

/* End of file trainee_module_model.php */
/* Location: ./application/models/trainee_module_model.php */
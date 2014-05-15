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
			$this->db->where('trainee_id',$trainee_id);
			$this->db->where('module_id',$module_id);
			return $this->db->update('enrolled_module',$data);
		}
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

	public function get_completed_modules($trainee_id) {
		$data = array(
			'trainee_id' => $trainee_id,
			'is_completed' => 1
			);
		$query = $this->db->get_where('enrolled_module', $data);
		//get corresponding module from module table
		$result = array();
		foreach ($query->result() as $module) {
			array_push($result,$this->module_model->fetch_module($module->module_id));
		}
		return $result;
	}
}

/* End of file trainee_module_model.php */
/* Location: ./application/models/trainee_module_model.php */
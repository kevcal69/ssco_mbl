<?php
class Trainee_module_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

/**
*	Insert/Update enroled module
*
*	@param	int 		$trainee_id	(user_id) must exist
*	@param	int 		$module_id	must exist
*
*	@return	boolean	update result
*/
	public function enrol_module($module_id, $trainee_id) {
		$data = array (
			'module_id' => $module_id,
			'trainee_id' => $trainee_id
			);
		//insert if not exists
		$result = $this->get_enroled_module($module_id, $trainee_id);
		if ($result === FALSE) {
			//insert/enrol
			return $this->db->insert('enrolled_module',$data);
		} else {
			// update/reenrol
			$data['is_completed'] = FALSE;
			$data['date_enroled'] = NULL;
			$data['date_completed'] = 'DEFAULT 0';
			$this->db->where('trainee_id',$trainee_id);
			$this->db->where('module_id',$module_id);
			return $this->db->update('enrolled_module',$data);
		}
	}

/**
*	Delete enroled module
*
*	@param	int 		$trainee_id	(user_id) must exist
*	@param	int 		$module_id	must exist
*
*	@return	boolean	delete result
*/
	public function unenrol_module($module_id, $trainee_id) {
		$this->db->trans_start();

		$result = $this->db->delete('enrolled_module',array('module_id' => $module_id,'trainee_id' => $trainee_id));

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

/**
*	Update enroled module
*
*	@param	int			$module_id	must exist
*	@param	int			$trainee_id	(user_id) must exist
*	@param	float		$rating
*	@param	boolean $is_completed
*
*	@return	boolean	update result
*/
	public function update_module($module_id,$trainee_id,$rating,$is_completed) {
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

/**
*	Get enroled module
*
*	@param	int			$module_id (optional)
*	@param	int			$trainee_id (optional)
*
*	@return	object	on specific module (module_id and trainee_id given)
*					array 	array of objects on multiple results
*/
	public function get_enroled_module($module_id = FALSE, $trainee_id = FALSE) {
		$this->load->model('module_model');
		//allows for different filters
		if ($module_id !== FALSE && $trainee_id !== FALSE) {
			//module_id and trainee_id given. specific enroled modules
			$data = array(
				'module_id' => $module_id, 
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('enrolled_module', $data);
			if ($query->row()) {
				$result = $query->row();
				$result->module_content = $this->module_model->fetch_module($query->row()->module_id);
				return $result;
			} else {
				return FALSE;
			}
		} else if ($module_id === FALSE && $trainee_id !== FALSE) {
			//only trainee_id is given. gets all modules trainee is enroled in
			$data = array(
				'trainee_id' => $trainee_id
				);
			$query = $this->db->get_where('enrolled_module', $data);
			$result = array();
			foreach ($query->result() as $index => $module) {
				array_push($result,$module);
				$result[$index]->module_content = $this->module_model->fetch_module($module->module_id);
			}
			return $result;
		} else if ($module_id !== FALSE && $trainee_id === FALSE) {
			//only module_id is given. gets all trainees enroled in module
			$data = array(
				'module_id' => $module_id
				);
			$query = $this->db->get_where('enrolled_module', $data);
			$result = array();
			foreach ($query->result() as $index => $module) {
				array_push($result,$module);
				$result[$index]->module_content = $this->module_model->fetch_module($module->module_id);
			}
			return $result();
		} else {
			//no parameters. gets all entries
			$query = $this->db->get('enrolled_module');
			$result = array();
			foreach ($query->result() as $index => $module) {
				array_push($result,$module);
				$result[$index]->module_content = $this->module_model->fetch_module($module->module_id);
			}
			return $result();
		}
	}

/**
*	Get enroled module's rating
*
*	@param	int			$module_id must exist
*	@param	int			$trainee_id must exist
*
*	@return	float		rating
*/
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

/**
*	Check if enroled module exists
*
*	@param	int			$module_id must exist
*	@param	int			$trainee_id must exist
*
*	@return	boolean	result
*/
	public function is_enroled($module_id,$trainee_id) {
		$result =  $this->get_enroled_module($module_id,$trainee_id);
		if ($result !== FALSE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

/**
*	Check if enrolled_module.is_completed is true
*
*	@param	int			$module_id must exist
*	@param	int			$trainee_id must exist
*
*	@return	boolean	result
*/
	public function is_completed($module_id,$trainee_id) {
		$result =  $this->get_enroled_module($module_id,$trainee_id);
		if ($result && $result->is_completed == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

/**
*	Gets all available modules of trainee (modules not enroled).
* limit and random are optional variables.
*
*	@param	int			$trainee_id must exist
*	@param	int			$limit			resulting rows limit
*	@param	boolean	$random 		randomize results
*
*	@return	array		query result
*/
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

/**
*	Gets all current modules of trainee (enroled modules with is_completed = FALSE).
*
*	@param	int			$trainee_id must exist
*
*	@return	array		query result
*/
	public function get_current_modules($trainee_id) {
		$this->load->model('module_model');
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

/**
*	Gets all current modules of trainee (enroled modules with is_completed = TRUE).
*
*	@param	int			$trainee_id must exist
*
*	@return	array		query result
*/
	public function get_completed_modules($trainee_id, $limit = FALSE) {
		$this->load->model('module_model');
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

/**
*	Gets module statistics
*
*	@param	int			$trainee_id must exist
*	@param	int			$module_id 	must exist
*
*	@return	array		$module 		result
*/
	public function get_statistics($trainee_id,$module_id) {
		$this->load->model('module_model');
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
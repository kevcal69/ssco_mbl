<?php
class Module_test_result_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

/**
*	Add test result to database
*
*	@param	int			$module_id	must exist
*	@param	int			$trainee_id	must exist
*	@param	float		$rating			(optional)
*	@param	string	$content		(optional) serialized content array
*
*	@return	int 		id of inserted entry on success, else NULL
*/
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

/**
*	Update test result in database
*
*	@param	int			$id		must exist
*	@param	array		$data	contains trainee_id(int), module_id(int), rating(float), content(string)
*
*	@return	boolean	query result
*/
	public function update_result($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('module_test_result',$data);
	}

/**
*	Get test result from database
*
*	@param	int			$module_id	(optional) must exist
*	@param	int			$trainee_id	(optional) must exist
*
*	@return	array 	query result
*/
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

	public function	get_test_results_with_module_detail_by_trainee_id($trainee_id,$module_id =false) {
		if ($module_id == false )
			$query = $this->db->query('select module.cover_picture, module.id, module.title,module.description, module_test_result.content, module_test_result.date, module_test_result.module_id, module_test_result.id, module_test_result.rating, module_test_result.trainee_id from module inner join module_test_result on module.id = module_test_result.module_id AND module_test_result.content IS NOT NULL AND module_test_result.trainee_id = '.$trainee_id);
		else 
			$query = $this->db->query('select module.cover_picture, module.id, module.title,module.description, module_test_result.content, module_test_result.date, module_test_result.module_id, module_test_result.id, module_test_result.rating, module_test_result.trainee_id from module inner join module_test_result on module.id = module_test_result.module_id AND module_test_result.content IS NOT NULL AND module.id = '.$module_id.' AND module_test_result.trainee_id = '.$trainee_id);
		return $query->result();
	}

	public function	get_test_results_with_module_detail_by_module_id($module_id) {
		$this->db->select('module.content, module.id, module.title,module.cover_picture,module.description, module_test_result.content, module_test_result.date, module_test_result.module_id, module_test_result.id, module_test_result.rating, module_test_result.trainee_id, trainee.first_name, trainee.last_name');
		$this->db->from('module_test_result');
		$this->db->join('module', ' module.id = module_test_result.module_id AND module_test_result.content IS NOT NULL AND module_test_result.module_id = '.$module_id.'', 'inner');
		$this->db->join('trainee','module_test_result.trainee_id = trainee.user_id','inner');
		$query = $this->db->get();
		return $query->result();
	}

/**
*	Get test result from database
*
*	@param	int			$test_result_id	must exist
*
*	@return	object 	query result
*/
	public function get_result($test_result_id) {
		$data = array(
			'id' => $test_result_id
			);
		$query = $this->db->get_where('module_test_result', $data);
		return $query->row();
	}
}

/* End of file module_test_result_model.php */
/* Location: ./application/models/module_test_result_model.php */
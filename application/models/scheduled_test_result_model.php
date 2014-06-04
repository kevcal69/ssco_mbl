<?php
class Scheduled_test_result_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

/**
*	Add test result to database
*
*	@param	int			$test_id		must exist
*	@param	int			$module_id	must exist
*	@param	int			$trainee_id	must exist
*	@param	float		$rating			(optional)
*	@param	string	$content		(optional) serialized content array
*
*	@return	int 		id of inserted entry on success, else NULL
*/
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

/**
*	Update test result in database
*
*	@param	int			$id		must exist
*	@param	array		$data	contains test_id(int), trainee_id(int), module_id(int), 
*												rating(float), content(string)
*
*	@return	boolean	query result
*/
	public function update_result($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('test_result',$data);
	}

/**
*	Get test result from database
*
*	@param	int			$test_id		(optional) must exist
*	@param	int			$trainee_id	(optional) must exist
*
*	@return	array 	query result
*/
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

	public function	get_test_results_with_module_detail_by_module_id($module_id = FALSE,$trainee_id = FALSE) {
		if ($trainee_id == FALSE) {			
			$this->db->select('module.content, module.id, module.title,module.cover_picture,module.description, test_result.content, test_result.date, test_result.module_id, test_result.id, test_result.rating, test_result.trainee_id, trainee.first_name, trainee.last_name');
			$this->db->from('test_result');
			$this->db->join('module', ' module.id = test_result.module_id AND test_result.content IS NOT NULL AND test_result.module_id = '.$module_id.'', 'inner');
			$this->db->join('trainee','test_result.trainee_id = trainee.user_id','inner');
			$query = $this->db->get();
			return $query->result();
		} else if($module_id == FALSE) {
			$this->db->select('module.content, module.id, module.title,module.cover_picture,module.description, test_result.content, test_result.date, test_result.module_id, test_result.id, test_result.rating, test_result.trainee_id, trainee.first_name, trainee.last_name');
			$this->db->from('test_result');
			$this->db->join('module', ' module.id = test_result.module_id AND test_result.content IS NOT NULL', 'inner');
			$this->db->join('trainee','test_result.trainee_id = trainee.user_id','inner');
			$this->db->where('test_result.trainee_id',$trainee_id);
			$query = $this->db->get();
			return $query->result();			
		} else {
			$this->db->select('module.content, module.id, module.title,module.cover_picture,module.description, test_result.content, test_result.date, test_result.module_id, test_result.id, test_result.rating, test_result.trainee_id, trainee.first_name, trainee.last_name');
			$this->db->from('test_result');
			$this->db->join('module', ' module.id = test_result.module_id AND test_result.content IS NOT NULL AND test_result.module_id = '.$module_id.'', 'inner');
			$this->db->join('trainee','test_result.trainee_id = trainee.user_id','inner');
			$this->db->where('test_result.trainee_id',$trainee_id);
			$query = $this->db->get();
			return $query->result();	
		}
	}
	
	public function	get_test_results_with_module_detail_by_test_id($test_id) {
		$this->db->select('module.content,module.cover_picture,module.description,module.title');
		$this->db->select('scheduled_test.content as test_content, scheduled_test.id as test_id, scheduled_test.isset_test, scheduled_test.module_id');
		$this->db->select('test_result.content as test_result_content, test_result.id as test_result_id,test_result.rating, test_result.date');
		$this->db->select('trainee.first_name, trainee.last_name, trainee.user_id as trainee_id, ');
		$this->db->from('scheduled_test');
		$this->db->join('module', ' module.id = scheduled_test.module_id AND scheduled_test.content IS NOT NULL AND scheduled_test.id = '.$test_id, 'inner');
		$this->db->join('test_result','scheduled_test.id = test_result.test_id','inner');
		$this->db->join('trainee','test_result.trainee_id = trainee.user_id','inner');
		$query = $this->db->get();
		return $query->result();
	}

/**
*	Get test result from database
*
*	@param	int			$test_result_id must exist
*
*	@return	object 	query result
*/
	public function get_result($test_result_id) {
		$data = array(
			'id' => $test_result_id
			);
		$query = $this->db->get_where('test_result', $data);
		return $query->row();
	}
}

/* End of file scheduled_test_result_model.php */
/* Location: ./application/models/scheduled_test_result_model.php */
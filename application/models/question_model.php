<?php
class Question_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

/**
*	Add question to database
*
*	@param	array 	$data	contains qtitle(string), question(string), answer(serialized array), 
*												module_id(int), choices(serialized array)
*
*	@return	boolean	mysql query result
*/
	function add($data) {
		if ($this->db->insert('question', $data)) {
			return true;
		} 
		return false;
	}

/**
*	Update question in database
*
*	@param	array 	$data	contains id(int),qtitle(string), question(string),
*												answer(serialized array), module_id(int), choices(serialized array)
*
*	@return	boolean	mysql query result
*/
	function edit($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('question', $data); 

		if ($this->db->_error_message()) {
			return FALSE; 
		} else {
			return TRUE;
		}
	}

/**
*	Add scheduled test to database
*
*	@param	array 	$data	contains isset_test(boolean), module_id(int), content(serialized array)
*
*	@return	boolean	mysql query result
*/
	function add_test($data) {
		if ($this->db->insert('scheduled_test_question', $data)) {
			return true;
		} 
		return false;
	}

/**
*	Edit scheduled test in database
*
*	@param	array 	$data	contains  id(int), isset_test(boolean), module_id(int), content(serialized array)
*
*	@return	boolean	mysql query result
*/
	function edit_test($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('scheduled_test_question', $data);

		if ($this->db->_error_message()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

/**
*	Get questions from database
*
*	@param	int 	$id must exist
*
*	@return	array	mysql query result on success, else FALSE
*/
	function fetch_questions($id) {
		$query = $this->db->get_where('question', array('module_id' => $id));
		if ($query) {
			return $query->result();
		} else {
			return false;
		}
	}

/**
*	Get scheduled test questions from database
*
*	@param	int 	$id must exist
*
*	@return	array	mysql query result on success, else FALSE
*/
	function fetch_test_questions($id) {
		$this->db->order_by("is_used", "desc"); 
		 $query = $this->db->get_where('scheduled_test_question', array('module_id' => $id));
		 if ($query) {
		 	return $query->result();
		 } else {
		 	return false;
		 }
	}

/**
*	Set isset_test of scheduled test
*
*	@param	int 		$id must exist
*	@param	boolean	$val
*
*	@return	void
*/
	function set_test($id,$val) {
		$this->db->where('id', $id);
		$this->db->update('scheduled_test_question', array('is_used'=>$val));
	}

/**
*	Get scheduled test questions based on is_used and module_id
*
*	@param	boolean	$filter is_used value
*	@param	int 		$mid module id must exist
*
*	@return	array	mysql query result on success, else FALSE
*/
	function fetch_filtered_test($filter,$mid) {
		$query = $this->db->get_where('scheduled_test_question', array('module_id' => $mid, 'is_used' => $filter));
		if ($query) {
			return $query->result();
		} else {
			return false;
		}
	}

/**
*	Get latest scheduled test for module
*
*	@param	int 		$id module id must exist
*
*	@return	array	mysql query result on success, else FALSE
*/
	function fetch_test_sched($id) {
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
		 $query = $this->db->get_where('scheduled_test', array('module_id' => $id));
		 if ($query) {
		 	return $query->row();
		 } else {
		 	return false;
		 }
	}

/**
*	Insert scheduled test entry
*
*	@param	int 		$id		module id must exist
*	@param	string	$str	serialized content array
*
*	@return	void
*/
	function conduct_test($id,$str) {
		$this->db->insert('scheduled_test', array('isset_test'=>1,'module_id'=>$id,'content'=>$str)); 
	}

/**
*	Set scheduled test isset_test to FALSE
*
*	@param	int 		$tid	test id must exist
*	@param	int 		$id		module id must exist
*
*	@return	void
*/
	function stop_test($tid,$id) {
		$this->db->where('id', $tid);
		$this->db->update('scheduled_test', array('isset_test'=>0,'module_id'=>$id)); 
	}

/**
*	Get module test questions
*
*	@param	int 		$id		module id must exist
*	@param	int 		$limit
*
*	@return	array		$data	questions array
*/
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

/**
*	Get scheduled tests
*
*	@param	int 		$test_id	(optional) must exist
*
*	@return	array		query result
*/
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

/**
*	Get scheduled tests
*
*	@param	int 		$id	module_id must exist
*
*	@return	array		query result
*/
	function get_scheduled_tests_by_module($id, $set = FALSE){
		if ($set === FALSE) {
			//get all scheduled tests
			$query = $this->db->get_where('scheduled_test', array('module_id' => $id));
			if ($query) {
				return $query->result();
			} else {
				return FALSE;
			}
		} else {
			$query = $this->db->get_where('scheduled_test', array('module_id' => $id, 'isset_test' => TRUE));
			if ($query) {
				return $query->row();
			} else {
				return FALSE;
			}
		}
	
	}

/**
*	Check if scheduled test isset
*
*	@param	int 		$test_id	must exist
*
*	@return	boolean	query result
*/
	function isset_test($test_id) {
		$query = $this->db->get_where('scheduled_test', array('id' => $test_id));
		if ($query) {
			return $query->row()->isset_test;
		} else {
			return FALSE;
		}
	}

/**
*	Get test results for module tests and scheduled tests
*
*	@param	none
*
*	@return	array	query result
*/
	function fetch_both_user_stats_by_id() {
		$query =  $this->db->query("Select trainee1.*, module_test_result.content,module_test_result.date,module_test_result.id,module_test_result.module_id,module_test_result.rating  from trainee as trainee1 inner join module_test_result on trainee1.user_id = module_test_result.trainee_id");
		$results['mod_test_res'] = $query->result();
		$query =  $this->db->query("Select trainee2.*,test_result.content,test_result.date,test_result.id,test_result.module_id,test_result.rating,test_result.test_id  from trainee as trainee2 inner join test_result on trainee2.user_id = test_result.trainee_id");
		$results['sched_est_res'] = $query->result();
		return $results;
	}
}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */
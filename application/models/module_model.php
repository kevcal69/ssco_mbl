<?php
class Module_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

/**
*	Get modules
*
*	@param	int			$limit (optional)
*	@param	boolean	$random (optional)
*
*	@return	array		query result
*/
	function get_module_entries($limit = FALSE, $random = FALSE) {
		if (is_numeric($limit)) {
			$this->db->limit($limit);
		} 
		if ($random === TRUE) {
			$this->db->order_by('id', 'RANDOM');
		}
		$query = $this->db->get('module');

		return $query->result();
	}

/**
*	Get tags
*
*	@param	int			$id (optional)
*
*	@return	array		query result
*/
	function get_module_tags($id = FALSE) {
		if ($id == FALSE ) {
			//all module tags
			$this->db->select('module.id, tags.*, module_tags.*');
			$this->db->from('module_tags');
			$this->db->join('module','module_tags.module_id = module.id');
			$this->db->join('tags','module_tags.tag_id = tags.id');
			$query = $this->db->get();
			return $query->result();
		} else {
			//specific module tags
			$this->db->select('tags.tags');
			$this->db->from('tags');
			$this->db->join('module_tags','module_tags.tag_id = tags.id','inner');
			$this->db->where('module_tags.module_id', $id); 
			$query = $this->db->get();
			return $query->result();			
		}
	}

/**
*	Get all tags
*
*	@return	array		query result
*/
	function get_tags() {
		$this->db->select('tags.tags');
		$query = $this->db->get('tags');
		return $query->result();
	}

	function get_tag_by_id($tag) {
		$query = $this->db->get_where('tags', array('tags' => $tag));
		if ($query) {
			return $query->row()->id;
		} else {
			return false;
		}
	}

/**
*	Create module
*
*	@param	array	$data contains title, cover_picture path, description, content
*	@param	array	$tags 
*
*	@return	array		query result
*/
	function create_module($data,$tags) {
		if ($this->db->insert('module', $data)) {
			$id = $this->db->insert_id();
			$this->add_tags($tags);
			$this->add_module_tags($tags,$id);
			return $id;
		} 
		return false;
	}

/**
*	Get module content
*
*	@param	int	$id must exist
*
*	@return	object	module content on success, else FALSE
*/
	function fetch_module($id) {
		$query = $this->db->get_where('module', array('id' => $id));
		if ($query) {
			return $query->row();
		} else {
			return false;
		}
	}

/**
*	Update module
*
*	@param	array	$data contains title, cover_picture path, description, content
*	@param	array	$tags
*	@param	int	$id must exist
*
*	@return	boolean	query result
*/
	function modify_module($data,$id,$tags = FALSE) {
		if ($tags != FALSE) {
			$this->add_tags($tags);
			$this->add_module_tags($tags,$id);
		}
		
		$this->db->where('id', $id);
		$this->db->update('module', $data); 

		if ($this->db->_error_message()) {
			return FALSE; 
		} else {
			return $this->db->affected_rows();
		}
	}	

/**
*	Add tags to module
*
*	@param	array	$tags
*	@param	int	$id must exist
*
*	@return	void
*/
	function add_module_tags($tags, $module_id) {
		$module_tags = $this->get_module_tags($module_id);
		foreach ($module_tags as $key => $value) {
			if (!in_array($value->tags,$tags)) {
				$this->db->delete('module_tags',array('tag_id' => $this->get_tag_by_id($value->tags)));
			}
		}			
		foreach ($module_tags as $key => $value) {
			if (in_array($value->tags,$tags)) {
				$tags  = array_diff($tags, array($value->tags));
			}
		}	
		sort($tags, SORT_NUMERIC);
		foreach ($tags as $key ){
			$data['tag_id'] = $this->get_tag_by_id($key);
			$data['module_id'] = $module_id;
			$this->db->insert('module_tags', $data);
		}		
	}

/**
*	Add tag to database
*
*	@param	array	$tags
*
*	@return	void
*/
	function add_tags($tags) {
		$present_tag = $this->get_tags(); 
		$data = array();
		$table_tags = $tags;
		foreach ($present_tag as $key => $value) {
			if (in_array($value->tags,$tags)) {
				$table_tags  = array_diff($table_tags, array($value->tags));
			}
		}	
		sort($table_tags, SORT_NUMERIC);
		foreach ($table_tags as $key ){
			$data['tags'] = $key;
			echo $key;
			$this->db->insert('tags', $data);
		}	

	}

/**
*	Delete module from database
*
*	@param	int	$id must exist
*
*	@return	boolean query result
*/
	function delete_module($id) {
		return $this->db->delete('module',array('id' => $id));
	}

/**
*	Get module title
*
*	@param	int	$id must exist
*
*	@return	string title on success
*/
	function get_title($id) {
		$this->db->select('title');
		$query =  $this->db->get_where('module', array('id' => $id), 1);
		if ($query) {
			return $query->row()->title;
		} else {
			return false;
		}
	}

/**
*	Get module id based on title
*
*	@param	string	$title must exist
*
*	@return	int module id on success
*/
	function get_id($title) {
		$this->db->select('id');
		$query =  $this->db->get_where('module', array('title' => $title), 1);
		if ($query->row()) {
			return $query->row()->id;
		} else {
			return false;
		}
	}

/**
*	Search module based on title
*
*	@param	string	$keyword
*
*	@return	array module entries
*/
	function get_module_by_keyword($keyword) {
		$this->db->like('title', $keyword); 
		$query = $this->db->get('module');
		return $query->result();
	}
/**
*	Search module based on tags
*
*	@param	string	$keyword tag
*
*	@return	array module entries
*/
	function search_module_by_tag($keyword){ 
		$this->db->distinct();
		$this->db->select("module.*,tags.tags,module_tags.tag_id,module_tags.module_id");
		$this->db->from('module_tags');
		$this->db->join('tags','tags.id = module_tags.tag_id','left');
		$this->db->join('module','module.id = module_tags.module_id AND tags.id = module_tags.tag_id','left');
		$this->db->like('tags.tags', $keyword); 
		$query = $this->db->get();
		return $query->result();		
	}
}

/* End of file session.php */
/* Location: ./application/models/homepage_model.php */
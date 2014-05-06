<?php
class Module_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function get_module_entries() {
		$query = $this->db->get('module');
		return $query->result();
	}

	function create_module($data) {
		if ($this->db->insert('module', $data)) {
			return true;	
		} 
		return false;
	}

	function fetch_module($id) {
		 $query = $this->db->get_where('module', array('id' => $id));
		 if ($query) {
		 	return $query->row();
		 } else {
		 	return false;
		 }
	}
}

/* End of file session.php */
/* Location: ./application/models/homepage_model.php */
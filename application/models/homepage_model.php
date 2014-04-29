<?php
class Homepage_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function get_module_entries() {
		$query = $this->db->get('module');
		return $query->result();
	}
}

/* End of file session.php */
/* Location: ./application/models/homepage_model.php */
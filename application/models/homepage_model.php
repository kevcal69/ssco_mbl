<?php
class Homepage_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function get_module_entries() {
		$query = $this->db->get('module');
		return $query->result();
	}

	function login($username, $password) {
		$this->db->select('id, username, password, role');
		$this->db->from('user');
		$this->db->where('username', $username);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		}	else {
			return FALSE;
		}
	}
}
?>
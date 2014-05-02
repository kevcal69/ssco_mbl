<?php
class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function create($username, $password, $role) {
		$data = array(
			'username' => $username,
			'password' => MD5($password),
			'role' => $role
			);
		$this->db->insert('user',$data);
		if ($this->username_exists($username)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function edit($user_id, $username, $password, $role) {
		//if same password as old, don't update password
		$user = $this->view($username);
		$new_password = $password;
		if ($user['password'] !== $password) {
			$new_password = MD5($password);
		}
		
		$data = array(
			'username' => $username,
			'password' => $new_password,
			'role' => $role
			);
		$this->db->where('id',$user_id);
		$result = $this->db->update('user',$data);
		if ($result == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function view($username = FALSE) {
		if ($username === FALSE) {
			$query = $this->db->get('user');
			return $query->result_array();
		}

		$query = $this->db->get_where('user', array('username' => $username));
		return $query->row_array();
	}

	function username_exists($username) {
		//check for existing username
		$this->db->select('username')->from('user')->where('username',$username)->limit(1);
		$check_username = $this->db->get();
		if($check_username->num_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file user_model.php */
/* Location: ./application/models/admin/user_model.php */
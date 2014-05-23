<?php
class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function create($username, $password, $role, $name = FALSE) {
		$data = array(
			'username' => $username,
			'password' => MD5($password),
			'role' => $role
			);
		$result = $this->db->insert('user',$data);
		$user = $this->view($username);
		//update user in trainee table
		if ($role === 'trainee') {
			if (!$this->update_trainee($user['id'], $name['first_name'], $name['last_name'])) {
				return FALSE;
			}
		}

		return $result;
	}

	function edit($user_id, $username, $password, $role, $name = FALSE) {
		//$data contains username, password, user_id, and role
		//if role is trainee, $data also contains first_name and last_name

		//if same password as old, don't update password
		$user = $this->view(FALSE, $user_id);
		$new_password = $password;
		if ($user['password'] !== $password) {
			$new_password = MD5($password);
		}
		
		$this->db->where('id',$user_id);

		$user_data = array(
			'username' => $username,
			'password' => MD5($password),
			'role' => $role
			);
		$result = $this->db->update('user',$user_data);

		//update user in trainee table
		if ($role === 'trainee') {
			if (!$this->update_trainee($user_id, $name['first_name'], $name['last_name'])) {
				return FALSE;
			}
		}

		return $result;
	}

	function update_trainee($user_id, $first_name, $last_name) {
		$data = array(
			'user_id' => $user_id,
			'first_name' => $first_name,
			'last_name' => $last_name
			);

		//insert if not exists
		$trainee = $this->view_trainee($user_id);
		if (empty($trainee)) {
			$this->db->where('user_id',$user_id);
			return $this->db->insert('trainee',$data);
		} else {
			$this->db->where('user_id',$user_id);
			return $this->db->update('trainee',$data);
		}
	}

//TODO delete user from enrolled_module and trainee tables
	function delete($username) {
		$this->db->trans_start();

		$user = $this->view($username);
		if ($user['role'] === 'trainee' OR $this->trainee_exists($user['id'])) {
			$this->delete_trainee($user['id']);
		}
		$result = $this->db->delete('user',array('username' => $username));

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

//TODO delete user from enrolled_module table
	function delete_trainee($user_id) {
		return $this->db->delete('trainee',array('user_id' => $user_id));
	}

	public function view($username = FALSE, $user_id = FALSE) {
		//no parameters
		if ($username === FALSE && $user_id === FALSE) {
			$query = $this->db->get('user');
			return $query->result_array();
		//user_id parameter
		} else if ($user_id !== FALSE && $username === FALSE) {
			$query = $this->db->get_where('user', array('id' => $user_id));
			return $query->row_array();
		//username parameter
		} else {
			$query = $this->db->get_where('user', array('username' => $username));
			return $query->row_array();
		}
	}

	public function view_trainee($user_id = FALSE,$trainee_id = FALSE) {
		if (empty($user_id) && empty($trainee_id)) {
			$query = $this->db->get('trainee');
			return $query->result_array();
		} else if (!empty($user_id) && empty($trainee_id)) {
			$query = $this->db->get_where('trainee', array('user_id' => $user_id));
			return $query->row_array();
		} else if (empty($user_id) && !empty($trainee_id)) {
			echo $trainee_id;
			$query = $this->db->get_where('trainee', array('id' => $trainee_id));
			return $query->row_array();
		}
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

	function trainee_exists($user_id) {
		//check for existing username
		$this->db->select('user_id')->from('trainee')->where('user_id',$user_id)->limit(1);
		$check_trainee = $this->db->get();
		if($check_trainee->num_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file user_model.php */
/* Location: ./application/models/admin/user_model.php */
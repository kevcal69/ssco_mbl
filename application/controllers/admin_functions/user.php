<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MBL_Controller {
    function __construct() {
      parent::__construct();
      //refuse access when not logged as admin
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

      $this->load->model('admin/user_model');
      $this->load->helper('application_helper');
			$this->load->library('form_validation');
			
    }	

	public function index() {
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/user/user_functions','',TRUE);
		$this->parser->parse('layouts/default', $data);
	}
	public function create() {
		//set validation rules
		$validation_rules = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|xss_clean|callback_unique_username'
				),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|xss_clean'
				),
			array(
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'trim|required|xss_clean'
				),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|xss_clean'
				),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|xss_clean'
				)
			);
		$this->form_validation->set_rules($validation_rules);

		if ($this->form_validation->run() == FALSE) {
			//validation failure, return to form
			$data['body_content'] = $this->load->view('admin/user/user_create','',TRUE);
		} else {
			//validation success, create new user
			$result = $this->create_user();

			$message = '';
			$error = '';
			if ($result) {
				$message = 'User <a href="'. base_url('admin/user/view/' . $this->input->post('username')) . '">' . $this->input->post('username') . '</a> was successfully created.';
			} else {
				$message = 'User creation failed.';
				$error = $this->db->_error_message();
			}
			$create_data = array('message' => $message, 'error' => $error);
			$data['body_content'] = $this->load->view('admin/user/function_result',$create_data,TRUE);
		}
		$data['page_title'] = "Create User - Admin - SSCO Module-Based Learning";
		$this->parser->parse('layouts/default', $data);
	}

	public function view($username = FALSE) {
		//view all users
		if ($username === FALSE) {
			$users['users'] = $this->user_model->view();

			$data['body_content'] = $this->load->view('admin/user/user_view_all',$users,TRUE);
		} else {
			$user = $this->user_model->view($username);

			if ($user['role'] === 'trainee' && $this->user_model->trainee_exists($user['id'])) {
				$trainee = $this->user_model->view_trainee($user['id']);
				$user['first_name'] = $trainee['first_name'];
				$user['last_name'] = $trainee['last_name'];
				//TODO enrolled modules for trainees
				//     created modules for content managers
			}

			$data['body_content'] = $this->load->view('admin/user/user_view',$user,TRUE);
		}
		$data['page_title'] = "View User - Admin - SSCO Module-Based Learning";
		$this->parser->parse('layouts/default', $data);
	}

	public function edit($username = FALSE) {
		//no $username parameter
		if ($username === FALSE) {
			$users = $this->user_model->view();

			foreach ($users as $user) {
				$data['users'][$user['username']] = $user['username'];
			}

			//validation
			$this->form_validation->set_rules('users', 'User', 'trim|required|xss_clean');

			if ($this->form_validation->run() == FALSE) {
				//validation failure, return to form
				$data['body_content'] = $this->load->view('admin/user/user_choose_edit',$data,TRUE);
			} else {
				//validation success, redirect to edit/user
				echo $this->input->post('user');
				redirect('admin/user/edit/'. $this->input->post('users'));
			}
		//$username parameter
		} else {
			$user = $this->user_model->view($username);
			//load first name and last name if trainee
			if ($user['role'] === 'trainee' OR $this->user_model->trainee_exists($user['id'])) {
				$trainee = $this->user_model->view_trainee($user['id']);
				$user['first_name'] = $trainee['first_name'];
				$user['last_name'] = $trainee['last_name'];
			} else {
				$user['first_name'] = '';
				$user['last_name'] = '';
			}

			//set validation rules
			$validation_rules = array(
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required|xss_clean|callback_unique_new_username['.$user['id'].']'
					),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|xss_clean'
					),
				array(
					'field' => 'role',
					'label' => 'Role',
					'rules' => 'trim|required|xss_clean'
					),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|xss_clean'
				),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|xss_clean|callback_required_if_trainee'
				)
				);
			$this->form_validation->set_rules($validation_rules);

			if ($this->form_validation->run() == FALSE) {
				//validation failure, return to form
				$data['body_content'] = $this->load->view('admin/user/user_edit',$user,TRUE);
			} else {
				//edit user
				$result = $this->edit_user($user['id']);

				$message = '';
				$error = '';
				if ($result) {
					$message = 'User <a href="'. base_url('admin/user/view/' . $this->input->post('username')) . '">' . $this->input->post('username') . '</a> was successfully edited.';
				} else {
					$message = 'User edit failed.';
					$error = $this->db->_error_message();
				}
				$edit_data = array('message' => $message, 'error' => $error);
				$data['body_content'] = $this->load->view('admin/user/function_result',$edit_data,TRUE);
			}
		}
		$data['page_title'] = "Edit User - Admin - SSCO Module-Based Learning";
		$this->parser->parse('layouts/default', $data);
	}

	public function delete($username) {
		//must go through delete-confirm form
		$confirm = $this->input->post('confirm');

		if ($confirm !== 'TRUE') {
			//confirmation dialog
			$data['body_content'] = $this->load->view('admin/user/delete_confirm',array('username' => $username),TRUE);
		} else {
			$result = $this->delete_user($username);

			$message = '';
			$error = '';
			if ($result) {
				$message = 'User '. $username . ' was successfully deleted.';
			} else {
				$message = 'User delete failed.';
				$error = $this->db->_error_message();
			}
			$delete_data = array('message' => $message, 'error' => $error);
			$data['body_content'] = $this->load->view('admin/user/function_result',$delete_data,TRUE);
		}

		$data['page_title'] = "Delete User - Admin - SSCO Module-Based Learning";
		$this->parser->parse('layouts/default', $data);
	}

	private function create_user() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		if ($role === 'trainee') {
			$name['first_name'] = $this->input->post('first_name');
			$name['last_name'] = $this->input->post('last_name');
			$result = $this->user_model->create($username, $password, $role, $name);
		} else {
			$result = $this->user_model->create($username, $password, $role);
		}

		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function edit_user($user_id) {
		$user_id = $user_id;
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		if ($role === 'trainee') {
			$name['first_name'] = $this->input->post('first_name');
			$name['last_name'] = $this->input->post('last_name');
			$result = $this->user_model->edit($user_id, $username, $password, $role, $name);
		} else {
			$result = $this->user_model->edit($user_id, $username, $password, $role);
		}

		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function delete_user($username) {
		if ($this->user_model->delete($username)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	//check if user's new username is the same as the previous one
	private function same_old_username($username, $user_id) {
		//check if username already exists
		if ($this->user_model->username_exists($username)) {
			$result = $this->user_model->view($username);
			//check if result id is same as user_id
			if ($result['id'] === $user_id) {
				return TRUE;
			}
		}
		return FALSE;
	}

	//edit validation rule: username must be unique, except when it is the same as the old username
	public function unique_new_username($username, $user_id) {
		if ($this->same_old_username($username, $user_id)) {
			return TRUE;
		} else {
			if (!$this->unique_username($username)) {
				$this->form_validation->set_message('unique_new_username','Username already exists. Choose another one.');
				return FALSE;
			} else {
				return true;
			}
		}
	}

	public function unique_username($username) {
		$result = $this->user_model->username_exists($username);
		if($result) {
			//error: username already exists			
			$this->form_validation->set_message('unique_username','Username already exists.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function required_if_trainee($str) {
		if ($this->input->post('role') === 'trainee') {
			if ($this->input->post('first_name') == '' OR $this->input->post('last_name') == '') {
				$this->form_validation->set_message('required_if_trainee', 'First Name and Last Name are required.');
				echo form_error('required_if_trainee','<p class="error">','</p>');
				return FALSE;
			}
		}
		return TRUE;
	}
}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */
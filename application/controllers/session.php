<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends MBL_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('session_model');
    }	

	public function login() {
		//check whether user is already logged in
		if ($this->session->userdata('id')) {
			$this->redirect_to_home();
		}

		$this->load->library('form_validation');

		//validation rules. password validation calls the verify login function
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_verify_login');

		if ($this->form_validation->run() == FALSE) {
			//get username errors
			$username_error = form_error('username','<p class="text-error">','</p>');
			$this->session->set_flashdata('username_error', $username_error);
			//password errors
			$password_error = form_error('password','<p class="text-error">','</p>');
			$this->session->set_flashdata('password_error', $password_error);
			//pass username and password for data repopulation
			$this->session->set_flashdata('username', $this->input->post('username'));
			$this->session->set_flashdata('password', $this->input->post('password'));

			redirect(base_url());
		} else {
			$this->redirect_to_home();
		}
	}

	public function logout()  {
		echo 'LOGGING OUT...';
			
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}

	//runs when username and password are validated
	function verify_login($password) {
		$username = $this->input->post('username');
		$result = $this->session_model->login($username,$password);
		if($result) {
			//login success, session creation
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username,
					'role' => $row->role,
					);
				$this->session->set_userdata($sess_array);
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('verify_login','Invalid username or password.');
			return FALSE;
		}
	}

	//accepts role string and redirects to role's home
	private function redirect_to_home() {
		$role = $this->session->userdata('role');
		if ($role === 'admin') {
			redirect('admin');
		} else if ($role === 'trainee') {
			redirect('trainee');
		} else if ($role === 'content_manager') {
			redirect('content_manager');
		} else {
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}
}

/* End of file session.php */
/* Location: ./application/controllers/session.php */
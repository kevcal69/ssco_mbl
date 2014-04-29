<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MBL_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Homepage_model','mModel');
      $this->load->helper('application_helper');

    }	

	public function index() {
		if ($this->session->userdata('id')) {
			$this->redirect_to_home();
		}

		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('content_homepage/content_home',array('modules' => $this->mModel->get_module_entries()),TRUE); // kevcal
		$this->parser->parse('layouts/home', $data);
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
			//
			$this->index();
		} else {
			$this->redirect_to_home();
		}
	}

	public function logout()  {
		echo 'LOGGING OUT';
			
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}

	//runs when username and password are validated
	function verify_login($password) {
		$username = $this->input->post('username');

		$result = $this->mModel->login($username,$password);

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
	function redirect_to_home() {
		$role = $this->session->userdata('role');
		if ($role === 'admin') {
			redirect('admin_controller/index');
		} else if ($role === 'trainee') {
			redirect('trainee');
		} else if ($role === 'content_manager') {
			redirect('content_manager');
		} else {
			$this->session->sess_destroy();
			redirect(base_url(),'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
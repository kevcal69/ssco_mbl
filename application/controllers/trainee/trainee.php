<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trainee extends MBL_Controller {
    function __construct() {
      parent::__construct();
      //refuse access when not logged as admin
			if ($this->session->userdata('role') !== 'trainee') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

      $this->load->model('trainee/trainee_model');
      $this->load->model('trainee/trainee_module_model');
      $this->load->model('module_model');
      $this->load->helper('application_helper');
      $this->load->helper('sidebar_helper');
			$this->load->library('form_validation');

			$this->trainee_id = $this->session->userdata('id');
			$this->sidebar_content = array(
				'quicklinks' => array(
					'home' => array(
						'content' => to_sidebar_element('fa-home', 'Home'),
						'href' => base_url('trainee'),
						'active' => FALSE
						),
					'profile' => array(
						'content' => to_sidebar_element('fa-user', 'Profile'),
						'href' => base_url('trainee/view_profile'),
						'active' => FALSE
						),
					'module' => array(
						'content' => to_sidebar_element('fa-book','Modules'),
						'href' => base_url('trainee/module'),
						'active' => FALSE
						),
					'test' => array(
						'content' => to_sidebar_element('fa-list','Tests'),
						'href' => base_url('trainee/test'),
						'active' => FALSE
						)
					)
				);
    }	

	public function index() {
		$this->sidebar_content['quicklinks']['home']['active'] = TRUE;
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";

		$data['current_modules'] = $this->trainee_module_model->get_current_modules($this->trainee_id);
		
		// $data['available_modules'] = $this->module_model->get_module_entries(3,TRUE);
		$data['available_modules'] = $this->trainee_module_model->get_available_modules($this->trainee_id,'',TRUE);

		// $data['completed_modules'] = $this->trainee_module_model->get_completed_modules($this->trainee_id);

		$data['body_content'] = $this->load->view('trainee/home',$data,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function view_profile() {
		$this->sidebar_content['quicklinks']['profile']['active'] = TRUE;
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";

		$data['name'] = $this->trainee_model->get_name($this->trainee_id);
		$data['statistics'] = $this->trainee_model->get_statistics($this->trainee_id);

		$data['current_modules'] = $this->trainee_module_model->get_current_modules($this->trainee_id);
		$data['completed_modules'] = $this->trainee_module_model->get_completed_modules($this->trainee_id);

		$data['body_content'] = $this->load->view('trainee/profile/profile',$data,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}
}

/* End of file trainee.php */
/* Location: ./application/controllers/trainee/trainee.php */
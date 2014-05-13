<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MBL_Controller {
    function __construct() {
      parent::__construct();
      //refuse access when not logged as admin
			if ($this->session->userdata('role') !== 'trainee') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

      // $this->load->model('trainee/trainee_model');
      $this->load->model('module_model');
      $this->load->helper('application_helper');
      $this->load->helper('sidebar_helper');
			$this->load->library('form_validation');


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
					'modules' => array(
						'content' => to_sidebar_element('fa-book','Modules'),
						'href' => base_url('trainee/module'),
						'active' => TRUE
						),
					'tests' => array(
						'content' => to_sidebar_element('fa-list','Tests'),
						'href' => base_url('trainee/test'),
						'active' => FALSE
						)
					)
				);
    }	

	public function index() {
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-home','Home'),
						'href' => base_url('trainee/module'),
						'active' => TRUE
						),
					'current_module' => array(
						'content' => to_sidebar_element('fa-edit','View Current Module'),
						'href' => base_url('trainee/module/view_current_module'),
						'active' => FALSE
						),
					'view_module' => array(
						'content' => to_sidebar_element('fa-search','View Modules'),
						'href' => base_url('trainee/module/view_module'),
						'active' => FALSE
						),
					'enrol_module' => array(
						'content' => to_sidebar_element('fa-plus','Enrol Module'),
						'href' => base_url('admin/user/view'),
						'active' => FALSE
						),
					'delete' => array(
						'content' => to_sidebar_element('fa-times','Delete User'),
						'href' => base_url('admin/user/delete'),
						'active' => FALSE
						)
					);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "Trainee - SSCO Module-Based Learning";
		$data['modules'] = $this->module_model->get_module_entries();
		$data['body_content'] = $this->load->view('module/module_list_admin',$data,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function view($id = FALSE) {
		if ($id === FALSE) {
			//view all available modules

		} else {
			//view specific module
			$data['page_title'] = "Trainee - SSCO Module-Based Learning";
			$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
			$module = array('module' => $this->module_model->fetch_module($id));
			$data['body_content'] = $this->load->view('admin/module/view',$module,TRUE); 
			$this->parser->parse('layouts/logged_in', $data);		
		}
	}
}

/* End of file module.php */
/* Location: ./application/controllers/trainee/module.php */
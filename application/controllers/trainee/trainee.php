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

      // $this->load->model('trainee/trainee_model');
      $this->load->helper('application_helper');
      $this->load->helper('sidebar_helper');
			$this->load->library('form_validation');


			$this->sidebar_content = array(
				'quicklinks' => array(
					array(
						'content' => to_sidebar_element('fa-home', 'Home'),
						'href' => base_url('trainee'),
						'active' => TRUE
						),
					array(
						'content' => to_sidebar_element('fa-user', 'Profile'),
						'href' => base_url('trainee/view_profile'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-book','Modules'),
						'href' => base_url('trainee/module'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-list','Tests'),
						'href' => base_url('trainee/test'),
						'active' => FALSE
						)
					)
				);
    }	

	public function index() {
		// $this->sidebar_content['actions']['home']['active'] = TRUE;
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "Trainee - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('trainee/home','',TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}
}

/* End of file trainee.php */
/* Location: ./application/controllers/trainee/trainee.php */
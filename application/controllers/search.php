<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin' && $this->session->userdata('role') !== 'trainee') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

			$this->load->model('Module_model','mModel');
			$this->load->helper('application_helper');
			$this->load->helper('sidebar_helper');
			if ($this->session->userdata('role') === 'admin') {
				$this->sidebar_content = array(
					'quicklinks' => array(

						array(
							'content' => to_sidebar_element('fa-home','Home'),
							'href' => base_url('admin'),
							'active' => TRUE
							),
						array(
							'content' => to_sidebar_element('fa-user', 'Users'),
							'href' => base_url('admin/user'),
							'active' => FALSE
							),
						array(
							'content' => to_sidebar_element('fa-book','Modules'),
							'href' => base_url('admin/module'),
							'active' => FALSE
							),
						array(
							'content' => to_sidebar_element('fa-question','Test Results'),
							'href' => base_url('admin/test'),
							'active' => FALSE
							),
						array(
							'content' => to_sidebar_element('fa-group','Trainees'),
							'href' => base_url('admin/trainee'),
							'active' => FALSE
							)
						)
					);
			} else if ($this->session->userdata('role') === 'trainee') {
				$this->sidebar_content = array(
					'quicklinks' => array(
						'home' => array(
							'content' => to_sidebar_element('fa-home', 'Home'),
							'href' => base_url('trainee'),
							'active' => TRUE
							),
						'profile' => array(
							'content' => to_sidebar_element('fa-user', 'Profile'),
							'href' => base_url('trainee/profile'),
							'active' => FALSE
							),
						'modules' => array(
							'content' => to_sidebar_element('fa-book','Modules'),
							'href' => base_url('trainee/module'),
							'active' => FALSE
							),
						'tests' => array(
							'content' => to_sidebar_element('fa-list','Tests'),
							'href' => base_url('trainee/test'),
							'active' => FALSE
							)
						)
					);
					$this->load->model('trainee/trainee_module_model');
					$this->trainee_id = $this->session->userdata('id');
			}
			//show sidebar search
			$this->sidebar_content['actions'] = array();
			$this->sidebar_content['module_search'] = TRUE;
		}

	public function index() {
		$keyword = $this->input->post('search');
		$this->load->model('Module_model','mModule');
		$myData['modules'] = $this->mModule->search_module_by_tag($keyword);
		//echo $this->db->last_query();
		
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "Search Results - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('module/module_list_admin',$myData,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

}

/* End of file search.php */
/* Location: ./application/search.php */
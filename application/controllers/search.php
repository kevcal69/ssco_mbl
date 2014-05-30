<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}

			$this->load->model('Module_model','mModel');
			$this->load->helper('application_helper');
			$this->load->helper('sidebar_helper');
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
						)
					)
				);
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
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('module/module_list_admin',$myData,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

}

/* End of file admin.php */
/* Location: ./application/admin_functions/admin.php */
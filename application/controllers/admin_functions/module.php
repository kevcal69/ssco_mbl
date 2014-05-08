<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Module extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}			
			$this->load->model('Module_model','mModule');
      			$this->load->helper('application_helper');
	    }	

	function index() {
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/module/show',array('modules' => $this->mModule->get_module_entries()),TRUE); // kevcal
		$this->parser->parse('layouts/default', $data);
	}

	function create() {
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/module/create',array(),TRUE); // kevcal
		$this->parser->parse('layouts/default', $data);
	}	

	function view($id)  {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/module/view',array('module' => $this->mModule->fetch_module($id)),TRUE); 
		$this->parser->parse('layouts/default', $data);		
	}
	
	function modify($id)  {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/module/modify',array('module' => $this->mModule->fetch_module($id)),TRUE); 
		$this->parser->parse('layouts/default', $data);		
		// echo stripslashes($this->mModule->fetch_module($id)->content);
	}	

	function create_module()  {

		$str =  $this->input->post('editor1');
		$module_title = $this->input->post('title');
		$module_description = $this->input->post('description');		


			$data =  array(
				'title' => addslashes($module_title),
				'description' => addslashes($module_description),
				'content' => addslashes($str)
			);

			if ($this->mModule->create_module($data)) {
				redirect('admin/module');
			} else  {
				show_404();
			}			
		
	}

	function authenticate_content($str) {
		if ($this->security->xss_clean($str, TRUE) === FALSE) {	
			$this->session->set_flashdata('alert', 'Error: ');		
			return false;
		} else if (trim($str) === '') {
			return false;
		}
		return true;
	}

	function modify_module() {
		$str =  $this->input->post('editor1');
		$module_title = $this->input->post('title');
		$module_description = $this->input->post('description');
		$id = $this->input->post('id');

		$data =  array(
			'title' => addslashes($module_title),
			'description' => addslashes($module_description),
			'content' => addslashes($str)
		);
		if ($this->mModule->modify_module($data,$id) >= 0) {
			redirect('admin/module');
		} else  {
			show_404();
		}		
	}	

	function delete($id) {
		if ($this->mModule->delete_module($id)) {
			redirect('admin/module');
		} else  {
			show_404();
		}			
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
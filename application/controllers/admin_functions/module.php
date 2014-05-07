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
		
		$title_start = strpos($str, '<h1>');
		$title_end = strpos($str, '</h1>');
		
		$description_end = strpos($str, '<h2>');
		
		$module_title = substr($str,$title_start +4, $title_end-$title_start -4).trim();
		$module_description = strip_tags((substr ($str,$title_end+5, $description_end-$title_end-6)).trim());

		

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

	function modify_module() {
		$str =  $this->input->post('editor1');
		$id =  $this->input->post('id');	
		


		$title_start = strpos($str, '<h1>');
		$title_end = strpos($str, '</h1>');
		
		$description_end = strpos($str, '<h2>');
		$module_title = trim(substr($str,$title_start +4, $title_end-$title_start -4));
		$module_description = strip_tags(trim(substr ($str,$title_end+5, $description_end-$title_end-6)));

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

	function delete() {

	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
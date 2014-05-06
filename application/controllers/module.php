<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Module extends MBL_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Module_model','mModule');
      			$this->load->helper('application_helper');
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

	function view_module($id)  {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('module/view',array('module' => $this->mModule->fetch_module($id)),TRUE); 
		$this->parser->parse('layouts/home', $data);		
	}
	
	function modify_module($id)  {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('module/modify',array('module' => $this->mModule->fetch_module($id)),TRUE); 
		$this->parser->parse('layouts/home', $data);		
	}	

	function modify() {
		
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
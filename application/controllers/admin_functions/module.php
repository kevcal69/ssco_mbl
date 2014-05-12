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
      			$this->load->helper('sidebar_helper');
			$this->sidebar_content = array(
				'quicklinks' => array(

					array(
						'content' => to_sidebar_element('fa-home','Home'),
						'href' => base_url('admin'),
						'active' => FALSE
						),					
					array(
						'content' => to_sidebar_element('fa-user', 'Users'),
						'href' => base_url('admin/user'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-book','Modules'),
						'href' => base_url('admin/module'),
						'active' => TRUE
						),
					array(
						'content' => to_sidebar_element('fa-list','Tests'),
						'href' => base_url('admin/test'),
						'active' => FALSE
						)
					)
				);      			
	    }	

	function index() {
		$this->sidebar_content['search'] = TRUE;
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-home','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => TRUE
						),
					'create' => array(
						'content' => to_sidebar_element('fa-plus-square','Create Modules'),
						'href' => base_url('admin/module/create'),
						'active' => FALSE
						)
					);
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('module/module_list_admin',array('modules' => $this->mModule->get_module_entries()),TRUE); // kevcal
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

	function create() {
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/module/create',array(),TRUE); // kevcal
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}	

	function view($id)  {
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-home','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => FALSE
						),
					'edit' => array(
						'content' => to_sidebar_element('fa-plus-square','Modify this Module'),
						'href' => base_url('admin/module/modify/'.$id),
						'active' => FALSE
						),
					'delete' => array(
						'content' => to_sidebar_element('fa-plus-square','Delete this Module'),
						'href' => base_url('admin/module/delete'.$id),
						'active' => FALSE
						)
					
					);		
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/module/view',array('module' => $this->mModule->fetch_module($id)),TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}
	
	function modify($id)  {
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-home','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => FALSE
						),
					'edit' => array(
						'content' => to_sidebar_element('fa-plus-square','View this Module'),
						'href' => base_url('admin/module/view/'.$id),
						'active' => FALSE
						),
					'delete' => array(
						'content' => to_sidebar_element('fa-plus-square','Delete this Module'),
						'href' => base_url('admin/module/delete'.$id),
						'active' => FALSE
						)
					
					);			
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/module/modify',array('module' => $this->mModule->fetch_module($id)),TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);		
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
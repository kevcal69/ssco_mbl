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
			$this->load->helper('output_text_helper');
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
						'content' => to_sidebar_element('fa-question','Tests'),
						'href' => base_url('admin/test'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-group','Trainees'),
						'href' => base_url('admin/trainee'),
						'active' => FALSE
						)
					),

				);
			//show sidebar search
			$this->sidebar_content['actions'] = array();
			$this->sidebar_content['module_search'] = TRUE;
		}

	function index() {
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-bars','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => TRUE
						),
					'create' => array(
						'content' => to_sidebar_element('fa-plus-square','Create Module'),
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
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-bars','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => FALSE
						)	
					);
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/module/create',array('taglist' => $this->mModule->get_tags()),TRUE); // kevcal
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}	

	function view($id)  {
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-bars','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => FALSE
						),
					'edit' => array(
						'content' => to_sidebar_element('fa-cogs','Modify this Module'),
						'href' => base_url('admin/module/modify/'.$id),
						'active' => FALSE
						),
					'delete' => array(
						'content' => to_sidebar_element('fa-times-circle','Delete this Module'),
						'href' => base_url('admin/module/delete/'.$id),
						'active' => FALSE,
						'extra' => 'onClick="if(confirm(\'Do you really want to delete this module?\'))return true; else return false;"'
						)
					
					);
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('view' => array('view', $id.'|'.word_limiter($this->mModule->get_title($id),10))));
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/module/view',array('module' => $this->mModule->fetch_module($id),'tags' => $this->mModule->get_module_tags($id)),TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}
	
	function modify($id)  {
		$this->sidebar_content['actions'] = array(
					'home' => array(
						'content' => to_sidebar_element('fa-bars','List Modules'),
						'href' => base_url('admin/module/'),
						'active' => FALSE
						),
					'edit' => array(
						'content' => to_sidebar_element('fa-laptop','View this Module'),
						'href' => base_url('admin/module/view/'.$id),
						'active' => FALSE
						),
					'delete' => array(
						'content' => to_sidebar_element('fa-times-circle','Delete this Module'),
						'href' => base_url('admin/module/delete/'.$id),
						'active' => FALSE,
						'extra' => 'onClick="if(confirm(\'Do you really want to delete this module?\'))return true; else return false;"'
						)
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('modify' => array('modify', $id.'|'.word_limiter($this->mModule->get_title($id),10))));
		
		$module_data['module'] = $this->mModule->fetch_module($id);
		$module_data['tags'] = $this->mModule->get_module_tags($id);
		$module_data['taglist'] = $this->mModule->get_tags();
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/module/modify',$module_data,TRUE);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
		// echo stripslashes($this->mModule->fetch_module($id)->content);
	}	

	function create_module()  {
		$str =  $this->input->post('editor1');
		$module_title = $this->input->post('title');
		$module_description = $this->input->post('description');	
		$tags = $this->input->post('tags');
			$data =  array(
				'title' => addslashes($module_title),
				'description' => addslashes($module_description),
				'content' => addslashes($str)
			);
			$id = $this->mModule->create_module($data,$tags);
			if ($id !== FALSE) {
				if ($_FILES['cover-picture-upload']['size'] != 0 && $_FILES['cover-picture-upload']['error'] == 0) {
					if (!$this->upload_cover_picture($id)) {
						redirect('admin/module/modify/'.$id,'refresh');
					}
				}
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
		$str = $this->input->post('editor1');
		$module_title = $this->input->post('title');
		$module_description = $this->input->post('description');
		$id = $this->input->post('id');
		$tags = $this->input->post('tags');
		$data = array(
			'title' => addslashes($module_title),
			'description' => addslashes($module_description),
			'content' => addslashes($str)
		);

		if ($this->mModule->modify_module($data,$id, $tags) >= 0) {
			//success
			if ($_FILES['cover-picture-upload']['size'] != 0 && $_FILES['cover-picture-upload']['error'] == 0) {
				if (!$this->upload_cover_picture($id)) {
					redirect('admin/module/modify/'.$id,'refresh');
				}
			}
			redirect('admin/module','refresh');
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

	function upload_cover_picture($id) {
			//upload cover picture
			//create directory if not exists
			if (!file_exists('assets/images/module/module_'.$id)) {
				mkdir('assets/images/module/module_'.$id, 0777, true);
			}
			$config['upload_path'] = 'assets/images/module/module_'.$id;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('cover-picture-upload')) {
				//error uploading
				$this->session->set_flashdata('cover_pic_errors',array('error' => $this->upload->display_errors('<p class="text-error">','</p>')));
				// redirect('admin/module/modify/'.$id);
				return FALSE;
			} else {
				//success
				//rename to cover.ext
				$img_data=$this->upload->data();
				$new_imgname='cover'.$img_data['file_ext'];
				$new_imgpath=$img_data['file_path'].$new_imgname;
				rename($img_data['full_path'], $new_imgpath);
				//update module cover pic path
				$data = array(
					'cover_picture' => $config['upload_path'].'/'.$new_imgname
				);
				if ($this->mModule->modify_module($data,$id) >= 0) {
					return TRUE;
				}
				return FALSE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
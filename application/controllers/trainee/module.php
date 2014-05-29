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
			$this->load->model('trainee/trainee_module_model');
			$this->load->helper('application_helper');
			$this->load->helper('sidebar_helper');
			$this->load->helper('output_text_helper');
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
						'href' => base_url('trainee/profile'),
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
			'current_module' => array(
				'content' => to_sidebar_element('fa-edit','Current Modules'),
				'href' => base_url('trainee/module/view_current_modules'),
				'active' => FALSE
				),
			'completed_modules' => array(
				'content' => to_sidebar_element('fa-check-square-o','Completed Modules'),
				'href' => base_url('trainee/module/view_completed_modules'),
				'active' => FALSE
				),
			'available_modules' => array(
				'content' => to_sidebar_element('fa-th-large','Available Modules'),
				'href' => base_url('trainee/module/view_available_modules'),
				'active' => FALSE
				),
			'view_module' => array(
				'content' => to_sidebar_element('fa-search','View All Modules'),
				'href' => base_url('trainee/module/view'),
				'active' => FALSE
				),
			'enrol_module' => array(
				'content' => to_sidebar_element('fa-plus','Enrol in Module'),
				'href' => base_url('trainee/module/enrol'),
				'active' => FALSE
				)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);

		$data['current_modules'] = $this->trainee_module_model->get_current_modules($this->trainee_id);

		$data['available_modules'] = $this->trainee_module_model->get_available_modules($this->trainee_id,3,TRUE);

		$data['view_more'] = TRUE;
		$data['completed_modules'] = $this->trainee_module_model->get_completed_modules($this->trainee_id,3);
		$data['body_content'] = $this->load->view('trainee/module/module',$data,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function view($id = FALSE) {
		if ($id !== FALSE && is_numeric($id)) {
			if ($this->trainee_module_model->is_enroled($id,$this->trainee_id)) {
				if ($this->trainee_module_model->is_completed($id,$this->trainee_id)) {
					//already completed the module
					$this->sidebar_content['actions']['retake_test'] = array(
						'content' => to_sidebar_element('fa-edit','Retake the Test'),
						'href' => base_url('trainee/test/take/'.$id),
						'active' => FALSE
						);
					$this->sidebar_content['actions']['reenrol'] = array(
						'content' => to_sidebar_element('fa-plus','Reenrol in Module'),
						'href' => base_url('trainee/module/enrol/'.$id),
						'active' => FALSE
						);
					$module['completed'] = TRUE;
				} else {
					$this->sidebar_content['actions']['take_test'] = array(
						'content' => to_sidebar_element('fa-edit','Take the Test'),
						'href' => base_url('trainee/test/take/'.$id),
						'active' => FALSE
						);
					$module['enroled'] = TRUE;
				}
				$this->sidebar_content['module_statistics'] = $this->trainee_module_model->get_statistics($this->trainee_id,$id);
			} else {
				$this->sidebar_content['actions']['enrol'] = array(
					'content' => to_sidebar_element('fa-plus','Enrol in Module'),
					'href' => base_url('trainee/module/enrol/'.$id),
					'active' => FALSE
					);
			}
			$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);

			$module['module'] = $this->module_model->fetch_module($id);

			$data['body_content'] = $this->load->view('trainee/module/view',$module,TRUE);
			$data['page_title'] = "SSCO Module-Based Learning";
			$this->parser->parse('layouts/logged_in', $data);
		} else {
			//view all available modules
			$this->sidebar_content['actions'] = array(
				'current_module' => array(
					'content' => to_sidebar_element('fa-edit','Current Modules'),
					'href' => base_url('trainee/module/view_current_modules'),
					'active' => FALSE
					),
				'completed_modules' => array(
					'content' => to_sidebar_element('fa-check-square-o','Completed Modules'),
					'href' => base_url('trainee/module/view_completed_modules'),
					'active' => FALSE
					),
				'available_modules' => array(
					'content' => to_sidebar_element('fa-th-large','Available Modules'),
					'href' => base_url('trainee/module/view_available_modules'),
					'active' => FALSE
					),
				'view_module' => array(
					'content' => to_sidebar_element('fa-search','View All Modules'),
					'href' => base_url('trainee/module/view'),
					'active' => TRUE
					),
				'enrol_module' => array(
					'content' => to_sidebar_element('fa-plus','Enrol in Module'),
					'href' => base_url('trainee/module/enrol'),
					'active' => FALSE
					)
				);
			$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
			$data['modules'] = $this->module_model->get_module_entries();
			$data['body_content'] = $this->load->view('trainee/module/view_all',$data,TRUE);
			$data['page_title'] = "SSCO Module-Based Learning";
			$this->parser->parse('layouts/logged_in', $data);
		}
	}

	public function view_current_modules() {
		$this->sidebar_content['actions'] = array(
			'current_module' => array(
				'content' => to_sidebar_element('fa-edit','Current Modules'),
				'href' => base_url('trainee/module/view_current_modules'),
				'active' => TRUE
				),
			'completed_modules' => array(
				'content' => to_sidebar_element('fa-check-square-o','Completed Modules'),
				'href' => base_url('trainee/module/view_completed_modules'),
				'active' => FALSE
				),
			'available_modules' => array(
				'content' => to_sidebar_element('fa-th-large','Available Modules'),
				'href' => base_url('trainee/module/view_available_modules'),
				'active' => FALSE
				),
			'view_module' => array(
				'content' => to_sidebar_element('fa-search','View All Modules'),
				'href' => base_url('trainee/module/view'),
				'active' => FALSE
				),
			'enrol_module' => array(
				'content' => to_sidebar_element('fa-plus','Enrol in Module'),
				'href' => base_url('trainee/module/enrol'),
				'active' => FALSE
				)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['current_modules'] = $this->trainee_module_model->get_current_modules($this->trainee_id);
		$data['body_content'] = $this->load->view('trainee/module/current_modules',$data,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function view_completed_modules() {
		$this->sidebar_content['actions'] = array(
			'current_module' => array(
				'content' => to_sidebar_element('fa-edit','Current Modules'),
				'href' => base_url('trainee/module/view_current_modules'),
				'active' => FALSE
				),
			'completed_modules' => array(
				'content' => to_sidebar_element('fa-check-square-o','Completed Modules'),
				'href' => base_url('trainee/module/view_completed_modules'),
				'active' => TRUE
				),
			'available_modules' => array(
				'content' => to_sidebar_element('fa-th-large','Available Modules'),
				'href' => base_url('trainee/module/view_available_modules'),
				'active' => FALSE
				),
			'view_module' => array(
				'content' => to_sidebar_element('fa-search','View All Modules'),
				'href' => base_url('trainee/module/view'),
				'active' => FALSE
				),
			'enrol_module' => array(
				'content' => to_sidebar_element('fa-plus','Enrol in Module'),
				'href' => base_url('trainee/module/enrol'),
				'active' => FALSE
				)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);

		$data['view_more'] = FALSE;
		$data['completed_modules'] = $this->trainee_module_model->get_completed_modules($this->trainee_id);
		$data['body_content'] = $this->load->view('trainee/module/completed_modules',$data,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function view_available_modules() {
		$this->sidebar_content['actions'] = array(
			'current_module' => array(
				'content' => to_sidebar_element('fa-edit','Current Modules'),
				'href' => base_url('trainee/module/view_current_modules'),
				'active' => FALSE
				),
			'completed_modules' => array(
				'content' => to_sidebar_element('fa-check-square-o','Completed Modules'),
				'href' => base_url('trainee/module/view_completed_modules'),
				'active' => FALSE
				),
			'available_modules' => array(
				'content' => to_sidebar_element('fa-th-large','Available Modules'),
				'href' => base_url('trainee/module/view_available_modules'),
				'active' => TRUE
				),
			'view_module' => array(
				'content' => to_sidebar_element('fa-search','View All Modules'),
				'href' => base_url('trainee/module/view'),
				'active' => FALSE
				),
			'enrol_module' => array(
				'content' => to_sidebar_element('fa-plus','Enrol in Module'),
				'href' => base_url('trainee/module/enrol'),
				'active' => FALSE
				)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['module_table'] = TRUE;
		$data['available_modules'] = $this->trainee_module_model->get_available_modules($this->trainee_id,FALSE,FALSE);
		$data['body_content'] = $this->load->view('trainee/module/available_modules',$data,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function enrol($module_id = FALSE) {
		if ($module_id !== FALSE) {
			//enrol specific module
			$confirm = $this->input->post('confirm');
			$module_title = $this->module_model->get_title($module_id);
			//check if already enroled
			$result = $this->trainee_module_model->get_enroled_module($module_id, $this->trainee_id);
			if (!empty($result)) {
				//reenrol warning
				$reenrol_confirm = $this->input->post('reenrol-confirm');

				if ($reenrol_confirm !== 'TRUE') {
					$reenrol_data = array(
						'module_title' => $module_title,
						'module_id' => $module_id
						);
					$data['body_content'] = $this->load->view('trainee/module/reenrol_confirm',$reenrol_data,TRUE);
				} else {
					$result = $this->trainee_module_model->enrol_module($module_id, $this->trainee_id);
					$enrol_data['title'] = 'Reenrol in "'.$module_title.'"';
					$enrol_data['message'] = '';
					$enrol_data['error'] = '';
					if ($result) {
						$enrol_data['message'] = 'Successfully reenroled in "'. $module_title . '" module.';
					} else {
						$enrol_data['message'] = 'Failed to reenrol in '. $module_title . ' module.';
						$enrol_data['error'] = $this->db->_error_message();
					}
					$data['body_content'] = $this->load->view('trainee/module/function_result',$enrol_data,TRUE);
				}
			} else {

				if ($confirm !== 'TRUE') {
					//confirmation dialog
					$confirm_data = array(
						'module_title' => $module_title,
						'module_id' => $module_id
						);
					$data['body_content'] = $this->load->view('trainee/module/enrol_confirm',$confirm_data,TRUE);
				} else {
					$result = $this->trainee_module_model->enrol_module($module_id, $this->trainee_id);
					$enrol_data['title'] = 'Enrol in "'.$module_title.'"';
					$enrol_data['message'] = '';
					$enrol_data['error'] = '';
					if ($result) {
						$enrol_data['message'] = 'Successfully enroled in "'. $module_title . '" module.';
					} else {
						$enrol_data['message'] = 'Failed to enrol in '. $module_title . ' module.';
						$enrol_data['error'] = $this->db->_error_message();
					}
					$data['body_content'] = $this->load->view('trainee/module/function_result',$enrol_data,TRUE);
				}
			}
		} else {
			//choose enrol module
			$modules = $this->module_model->get_module_entries();

			foreach ($modules as $module) {
				$data['modules'][$module->id] = $module->title;
			}

			//validation
			$this->form_validation->set_rules('modules', 'Module', 'trim|required|xss_clean|callback_module_exists');

			if ($this->form_validation->run() == FALSE) {
				//validation failure, return to form
				$data['body_content'] = $this->load->view('trainee/module/choose_enrol',$data,TRUE);
			} else {
				//validation success, redirect to edit/user
				$module_id = $this->module_model->get_id(html_entity_decode($this->input->post('modules')));
				redirect('trainee/module/enrol/'. $module_id);
			}
		}
		$this->sidebar_content['actions'] = array(
			'current_module' => array(
				'content' => to_sidebar_element('fa-edit','Current Modules'),
				'href' => base_url('trainee/module/view_current_modules'),
				'active' => FALSE
				),
			'completed_modules' => array(
				'content' => to_sidebar_element('fa-check-square-o','Completed Modules'),
				'href' => base_url('trainee/module/view_completed_modules'),
				'active' => FALSE
				),
			'available_modules' => array(
				'content' => to_sidebar_element('fa-th-large','Available Modules'),
				'href' => base_url('trainee/module/view_available_modules'),
				'active' => FALSE
				),
			'view_module' => array(
				'content' => to_sidebar_element('fa-search','View All Modules'),
				'href' => base_url('trainee/module/view'),
				'active' => FALSE
				),
			'enrol_module' => array(
				'content' => to_sidebar_element('fa-plus','Enrol in Module'),
				'href' => base_url('trainee/module/enrol'),
				'active' => TRUE
				)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}

	public function module_exists($module_title) {
		$result =  $this->module_model->get_id($module_title);
		if ($result) {
			return TRUE;
		} else {
			$this->form_validation->set_message('module_exists','No such module exists.');
			return FALSE;
		}
	}
}

/* End of file module.php */
/* Location: ./application/controllers/trainee/module.php */
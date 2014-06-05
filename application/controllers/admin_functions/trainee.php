<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Trainee extends MBL_Controller {
		function __construct() {
			parent::__construct();
			if ($this->session->userdata('role') !== 'admin') {
				$message_403 = "You don't have permission to access the url you are trying to reach.";
				$heading = '403 Forbidden';
				show_error($message_403,403,$heading);
			}		
			$this->load->model('Module_model','mModule');	
			$this->load->model('Question_model','mQ');
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
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-question','Tests'),
						'href' => base_url('admin/test'),
						'active' => FALSE
						),
					array(
						'content' => to_sidebar_element('fa-group','Trainees'),
						'href' => base_url('admin/trainee'),
						'active' => TRUE
						)
					)
				);            			
			}	
	function index() {
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => FALSE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee'),
						'active' => TRUE
						)
					);		
		$this->load->helper('output_text_helper');
		$this->load->model('Module_model','mModule');
		$this->load->model('scheduled_test_result_model','strm');
		$this->load->model('admin/user_model','user_model');
		$testDB['scheduled_test']  = $this->mQ->get_scheduled_tests();	
		$testDB['user_stats']  =  $this->user_model->view_trainee();
		$testDB['modules'] = $this->mModule->get_module_entries();
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/trainee/test_home',$testDB,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('trainee' => array('../test|test results','trainee')));
		
		$this->parser->parse('layouts/logged_in', $data);
	}

	//enrolment
	function enrolment($id) {
		$this->load->helper('output_text_helper');
		$this->load->model('Module_model','mModule');
		$this->load->model('module_test_result_model','mod_res');
		$this->load->model('trainee/trainee_model','trainee_model');
		$this->load->model('trainee/trainee_module_model');

		$myData['tid'] = $id;
		$myData['user_info'] = $this->trainee_model->get_name($id);
		$myData['enroled_modules'] = $this->trainee_module_model->get_enroled_module(FALSE,$id);
		$myData['available_modules'] = $this->trainee_module_model->get_available_modules($id,FALSE,FALSE);
		$myData['module_table'] = TRUE;

		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/trainee/trainee_enrolment',$myData,TRUE);
			$this->sidebar_content['actions'] = array(
				'current_module' => array(
					'content' => to_sidebar_element('fa-arrow-left','Back'),
					'extra' => 'onclick="history.go(-1);window.close();"',
					'active' => FALSE
					)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('trainee' => array('trainee', $myData['user_info']['first_name'].' '.$myData['user_info']['last_name'])));
		
		$this->parser->parse('layouts/logged_in', $data);
	}

	function enrol($trainee_id,$module_id) {
		$this->load->model('module_model');
		$this->load->model('trainee/trainee_model');
		$this->load->model('trainee/trainee_module_model');
		$trainee = $this->trainee_model->get_name($trainee_id);
		$module = $this->module_model->fetch_module($module_id);
		if ($module && $trainee) {
			$confirm = $this->input->post('confirm');
			$module_title = $this->module_model->get_title($module_id);
				if ($confirm !== 'TRUE') {
					//confirmation dialog
					$confirm_data = array(
						'module_title' => $module_title,
						'module_id' => $module_id,
						'trainee' => $trainee['first_name'].' '.$trainee['last_name'],
						'trainee_id' => $trainee_id
						);
					$data['body_content'] = $this->load->view('admin/trainee/enrol_confirm',$confirm_data,TRUE);
				} else {
					$result = $this->trainee_module_model->enrol_module($module_id, $trainee_id);
					$enrol_data['title'] = 'Enrol in "'.$module_title.'"';
					$enrol_data['message'] = '';
					$enrol_data['error'] = '';
					if ($result) {
						$enrol_data['message'] = 'Successfully enroled trainee '.$trainee['first_name'].' '.$trainee['last_name'].' in "'. $module_title . '" module.';
					} else {
						$enrol_data['message'] = 'Failed to enrol trainee '.$trainee['first_name'].' '.$trainee['last_name'].' in '. $module_title . ' module.';
						$enrol_data['error'] = $this->db->_error_message();
					}
					$data['body_content'] = $this->load->view('admin/function_result',$enrol_data,TRUE);
				}

			//breadcrumb settings
			$this->config->set_item('replacer_embed', array('trainee' => array('trainee', $trainee['first_name'].' '.$trainee['last_name']),'enrol' => array('../enrolment/'.$trainee_id.'|enrol',word_limiter($module_title,10))));
		} else if (!$module && $trainee) {
			$error_data['error_title'] = 'Invalid Module.';
			$error_data['error_message'] = 'The module you are trying to enrol is not found in the database.';
			$data['body_content'] = $this->load->view('admin/error',$error_data,TRUE);
		} else if (!$trainee && $module) {
			$error_data['error_title'] = 'Invalid Trainee.';
			$error_data['error_message'] = 'The trainee you are trying to enrol is not found in the database.';
			$data['body_content'] = $this->load->view('admin/error',$error_data,TRUE);
		} else {
			$error_data['error_title'] = 'Invalid Details.';
			$error_data['error_message'] = 'The trainee and module you are trying to enrol is not found in the database.';
			$data['body_content'] = $this->load->view('admin/error',$error_data,TRUE);
		}
			$this->sidebar_content['actions'] = array(
				'current_module' => array(
					'content' => to_sidebar_element('fa-arrow-left','Back'),
					'extra' => 'onclick="history.go(-1);window.close();"',
					'active' => FALSE
					)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}

	function unenrol($trainee_id,$module_id) {
		$this->load->model('module_model');
		$this->load->model('trainee/trainee_model');
		$this->load->model('trainee/trainee_module_model');
		$trainee = $this->trainee_model->get_name($trainee_id);
		$result = $this->trainee_module_model->get_enroled_module($module_id,$trainee_id);
		if ($result && $trainee) {
			$confirm = $this->input->post('confirm');
			$module_title = $this->module_model->get_title($module_id);
				if ($confirm !== 'TRUE') {
					//confirmation dialog
					$confirm_data = array(
						'module_title' => $module_title,
						'module_id' => $module_id,
						'trainee' => $trainee['first_name'].' '.$trainee['last_name'],
						'trainee_id' => $trainee_id
						);
					$data['body_content'] = $this->load->view('admin/trainee/unenrol_confirm',$confirm_data,TRUE);
				} else {
					$result = $this->trainee_module_model->unenrol_module($module_id, $trainee_id);
					$enrol_data['title'] = 'Unenrol from "'.$module_title.'"';
					$enrol_data['message'] = '';
					$enrol_data['error'] = '';
					if ($result) {
						$enrol_data['message'] = 'Successfully unenroled trainee '.$trainee['first_name'].' '.$trainee['last_name'].' from "'. $module_title . '" module.';
					} else {
						$enrol_data['message'] = 'Failed to unenrol trainee '.$trainee['first_name'].' '.$trainee['last_name'].' from '. $module_title . ' module.';
						$enrol_data['error'] = $this->db->_error_message();
					}
					$data['body_content'] = $this->load->view('admin/function_result',$enrol_data,TRUE);
				}

			//breadcrumb settings
			$this->config->set_item('replacer_embed', array('trainee' => array('trainee', $trainee['first_name'].' '.$trainee['last_name']),'unenrol' => array('../enrolment/'.$trainee_id.'|unenrol',word_limiter($module_title,10))));
		} else {
			$error_data['error_title'] = 'Failed to Unenrol.';
			$error_data['error_message'] = 'The trainee or module you are trying to unenrol is not found in the database.';
			$data['body_content'] = $this->load->view('admin/error',$error_data,TRUE);
		}

			$this->sidebar_content['actions'] = array(
				'current_module' => array(
					'content' => to_sidebar_element('fa-arrow-left','Back'),
					'extra' => 'onclick="history.go(-1);window.close();"',
					'active' => FALSE
					)
			);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$this->parser->parse('layouts/logged_in', $data);
	}
	
	function module_test_view($id) {
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => FALSE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee'),
						'active' => TRUE
						)
					);
		$this->load->helper('output_text_helper');
		$this->load->model('Module_model','mModule');
		$this->load->model('module_test_result_model','mod_res');
		$this->load->model('trainee/trainee_model','trainee_model');
		$myData['tid'] = $id;
		$myData['user_info'] = $this->trainee_model->get_name($id); 
		$myData['modules'] = $this->mModule->get_module_entries();
		$myData['module_test_result'] = $this->mod_res->get_test_results_with_module_detail_by_trainee_id($id);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/trainee/module_test_result',$myData,TRUE);
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);

		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('trainee' => array('../test|test results','trainee',$myData['user_info']['username']), 'module_test_view' => 'module'));
		
		$this->parser->parse('layouts/logged_in', $data);
	} 
	function schedule_test_view($id) {
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => FALSE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee'),
						'active' => TRUE
						)
					);
		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','sched_res');
		$this->load->model('question_model','mQ');
		$this->load->model('Module_model','mModule');
		$this->load->model('trainee/trainee_model','trainee_model');
		$myData['tid'] = $id;
		$myData['user_info'] = $this->trainee_model->get_name($id); 
		$myData['scheduled_test'] = $this->mQ->get_scheduled_tests_by_module($id);
		$myData['scheduled_test_result'] = $this->sched_res->get_test_results_with_module_detail_by_module_id(false,$id);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/trainee/schedule_test_result',$myData,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);

		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('trainee' => array('../test|test results','trainee',$myData['user_info']['username']), 'schedule_test_view' => 'scheduled test'));
		
		$this->parser->parse('layouts/logged_in', $data);
	} 	
	function sched_results_view($test_result_id) {
		$this->load->model('admin/user_model');
		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','test_result_model');
		$this->load->model('module_model');
		$result['scheduled_test_result'] = $this->test_result_model->get_test_results_with_module_detail_by_test_id($test_result_id);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/test/schedule_test_result',$result,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
		
	}	
	function module_quick_access() {
		$this->load->model('module_model');
		$keyword = $this->input->post('keyword');
		$tid = $this->input->post('tid');
		$results = $this->module_model->get_module_by_keyword($keyword);
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','mod_res');
		$this->load->model('scheduled_test_result_model','sched_res');
		 foreach ($results as $module): 
			$mod_ratings= $this->mod_res->get_test_results_with_module_detail_by_trainee_id($tid,$module->id);
			$sched_ratings = $this->sched_res->get_test_results_with_module_detail_by_module_id($module->id,$tid);
		if(!empty($mod_ratings)) {
			$var = stat_format_per_tid($mod_ratings);
		} else {
			$var['taken'] = 0;
			$var['rating_summary'] = 'N/A';
			$var['status'] ='<span class = "text-error">Not</span>';
		}
		if(!empty($sched_ratings)) {
			$foo = stat_format_per_tid($sched_ratings);
		} else {
			$foo['taken'] = 0;
			$foo['rating_summary'] = 'N/A';
		}		
		echo '<div class="inner-panel">
					<div class="inner-panel-heading">
						<h3 class="inner-panel-title">Module ID: '.$module->id.'</h3>
					</div>
					<div class="inner-panel-body">
						<div id="mod-box">
							<div id="thumb" style = "background-image: url('.base_url($module->cover_picture).');">
								
							</div>
							<div id="info-box">
								<div id="title">
									'.$module->title.'
								</div>
								<div id="stat">
									<div class="mod-stat">
										<span class = "text-size-o" >Module Test Stat</span>
										<ul>
											<li>
											<span class = "stat-item">Status</span>
											<span class = "stat-val">'.$var['status'].'</span>
											</li>
											<li>
											<span class = "stat-item">Times taken</span>
											<span class = "stat-val">'.$var['taken'].'</span>
											</li>
											<li>
											<span class = "stat-item">Percentage Rating</span>
											<span class = "stat-val">'.$var['rating_summary'].'</span>
											</li>
										</ul>
										<span id = "sm-r" class = "text-size-o fa fa-arrow-circle-o-right float-r" ></span>
									</div>
									<div class="sched-stat">
										<span  class = "text-size-o " >Scheduled Test Stat</span>
										<ul>
											<li>
											<span class = "stat-item">Times takers</span>
											<span class = "stat-val">'.$foo['taken'].'</span>
											</li>
											<li>
											<span class = "stat-item">Percentage Rating</span>
											<span class = "stat-val">'.$foo['rating_summary'].'</span>
											</li>
										</ul>
										<span id ="ss-l" class = "text-size-o fa fa-arrow-circle-o-left" ></span>
									</div>
								</div>														
							</div>
						</div>
					</div>
				</div>	
				<div class="inner-panel">
					<div class="inner-panel-heading">
						<h3 class="inner-panel-title">Actions</h3>
					</div>
					<div class="inner-panel-body">
						<ul>

							<li><a href = "'.base_url('admin/test/module_test_view/'.$module->id).'" class = "actions"><span>Module Test Results</span></a></li>
							<li><a href = "'.base_url('admin/test/schedule_test_view/'.$module->id).'" class = "actions"><span>Schedule Test Results</span></a></li>
							<li><a href = "'.base_url('admin/question/test_set_up/'.$module->id).'" class = "actions"><span>Set up a Scheduled Test</span></a></li>
						</ul>
					</div>
				</div>';
		endforeach;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

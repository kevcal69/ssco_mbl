<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Test extends MBL_Controller {
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
						'active' => TRUE
						),
					array(
						'content' => to_sidebar_element('fa-group','Trainees'),
						'href' => base_url('admin/trainee'),
						'active' => FALSE
						)
					),
				);
		 }
	function index() {
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('test' => 'test results'));
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => TRUE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee/'),
						'active' => FALSE
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
		$data['body_content'] = $this->load->view('admin/test/test_home',$testDB,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}	   
	function module_test_view($id) {
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => TRUE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee/'),
						'active' => FALSE
						)
					);
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('module_test_view' => '','test' => array('module test results', $id.'|'.word_limiter($this->mModule->get_title($id),10))));
		
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','mod_res');
		$myData['module_test_result'] = $this->mod_res->get_test_results_with_module_detail_by_module_id($id);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/test/module_test_result',$myData,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	} 
	function schedule_test_view($id) {
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => TRUE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee/'),
						'active' => FALSE
						)
					);
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('schedule_test_view' => '','test' => array('scheduled test results', $id.'|'.word_limiter($this->mModule->get_title($id),10))));

		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','sched_res');
		$this->load->model('question_model','mQ');
		$myData['mid'] = $id;
		$myData['scheduled_test'] = $this->mQ->get_scheduled_tests_by_module($id);
		$myData['scheduled_test_result'] = $this->sched_res->get_test_results_with_module_detail_by_module_id($id);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/test/schedule_test_result_view',$myData,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	} 	
	function sched_results_view($test_id) {
		$this->sidebar_content['actions'] = array(
					'Mod_test' => array(
						'content' => to_sidebar_element('fa-bars','By Module'),
						'href' => base_url('admin/test/'),
						'active' => TRUE
						),
					'trainee_test' => array(
						'content' => to_sidebar_element('fa-tags','By Trainee'),
						'href' => base_url('admin/trainee/'),
						'active' => FALSE
						)
					);
		$this->load->model('admin/user_model');
		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','test_result_model');
		$this->load->model('module_model');
		$result['scheduled_test_result'] = $this->test_result_model->get_test_results_with_module_detail_by_test_id($test_id);
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/test/schedule_test_result',$result,TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		//breadcrumb settings
		$this->config->set_item('replacer_embed', array('test' => 'scheduled test results', 'sched_results_view' => array('../schedule_test_view/'.$this->mQ->get_scheduled_tests($test_id)->module_id.'|'.word_limiter($this->mModule->get_title($this->mQ->get_scheduled_tests($test_id)->module_id),10), $test_id)));

		$this->parser->parse('layouts/logged_in', $data);
	}
	function result($test_result_id) {
		$this->load->model('admin/user_model');
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','test_result_model');
		$this->load->model('module_model');
		$result = $this->test_result_model->get_result($test_result_id);
		if ($result) {
			$result_content = unserialize(base64_decode($result->content));
			$result_content['details']['test_result_id'] = $result->id;
			$result_content['details']['trainee_id'] = $result->trainee_id;

			$trainee = $this->user_model->view_trainee($result->trainee_id);

			$result_content['details']['trainee']['last_name'] = $trainee['last_name'];
			$result_content['details']['trainee']['first_name'] = $trainee['first_name'];

			$result_content['details']['module_title'] = $this->module_model->get_title($result->module_id);
			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_result',$result_content,TRUE);
			$data['page_title'] = "Admin - SSCO Module-Based Learning";
			
			//breadcrumb settings
			$this->config->set_item('replacer_embed', array('result'=> array('../module_test_view/'.$result_content['details']['module_id'].'|'.word_limiter($result_content['details']['module_title'],10), $test_result_id), 'test' => array('module test results')));

			$this->parser->parse('layouts/default', $data);
		}
	}		
	function answers($test_result_id) {
		$this->load->model('admin/user_model');
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','test_result_model');
		$this->load->model('module_model');
		$result = $this->test_result_model->get_result($test_result_id);	
		$result = $this->test_result_model->get_result($test_result_id);
		if ($result) {
			$result_content = unserialize(base64_decode($result->content));
		
			//change retrieved answers to correct answers			
			foreach ($result_content['questions'] as $index => $question) {
				$answer = unserialize_choices($question->answer);
				$result_content['answers'][$index] = $answer;
			}

			$result_content['details']['test_result_id'] = $result->id;
			$result_content['details']['trainee_id'] = $result->trainee_id;

			$trainee = $this->user_model->view_trainee($result->trainee_id);

			$result_content['details']['trainee']['last_name'] = $trainee['last_name'];
			$result_content['details']['trainee']['first_name'] = $trainee['first_name'];

			$result_content['details']['module_title'] = $this->module_model->get_title($result->module_id);
			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_answers',$result_content,TRUE);
			$data['page_title'] = "Admin - SSCO Module-Based Learning";
			//breadcrumb settings
			$this->config->set_item('replacer_embed', array('answers'=> array('../module_test_view/'.$result_content['details']['module_id'].'|'.word_limiter($result_content['details']['module_title'],10), $test_result_id), 'test' => array('module test answers')));

			$this->parser->parse('layouts/default', $data);
		}
	}

	function sched_result($test_result_id) {
		$this->load->model('module_model');
		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','test_result_model');
		$this->load->model('admin/user_model');
		$result = $this->test_result_model->get_result($test_result_id);
		if ($result) {
			$result_content = unserialize(base64_decode($result->content));
			// print_r($result_content);
			$result_content['details']['test_result_id'] = $result->id;
			$result_content['details']['trainee_id'] = $result->trainee_id;

			$trainee = $this->user_model->view_trainee($result->trainee_id);

			$result_content['details']['trainee']['last_name'] = $trainee['last_name'];
			$result_content['details']['trainee']['first_name'] = $trainee['first_name'];

			$result_content['details']['module_title'] = $this->module_model->get_title($result->module_id);
			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_result',$result_content,TRUE);
			$data['page_title'] = "Admin - SSCO Module-Based Learning";

			//breadcrumb settings
			$this->config->set_item('replacer_embed', array('sched_result'=> array('../module_test_view/'.$result_content['details']['module_id'].'|'.word_limiter($result_content['details']['module_title'],10), $test_result_id), 'test' => array('scheduled test results')));

			$this->parser->parse('layouts/default', $data);
		}
	}
	function sched_answers($test_result_id) {
		$this->load->model('module_model');
		$this->load->helper('output_text_helper');
		$this->load->model('scheduled_test_result_model','test_result_model');
		$this->load->model('admin/user_model');
		$result = $this->test_result_model->get_result($test_result_id);
		if ($result) {
			$result_content = unserialize(base64_decode($result->content));
		
			//change retrieved answers to correct answers			
			foreach ($result_content['questions'] as $index => $question) {
				$answer = unserialize_choices($question->answer);
				$result_content['answers'][$index] = $answer;
			}

			$result_content['details']['test_result_id'] = $result->id;
			$result_content['details']['trainee_id'] = $result->trainee_id;

			$trainee = $this->user_model->view_trainee($result->trainee_id);

			$result_content['details']['trainee']['last_name'] = $trainee['last_name'];
			$result_content['details']['trainee']['first_name'] = $trainee['first_name'];

			$result_content['details']['module_title'] = $this->module_model->get_title($result->module_id);
			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_answers',$result_content,TRUE);
			$data['page_title'] = "Admin - SSCO Module-Based Learning";

			//breadcrumb settings
			$this->config->set_item('replacer_embed', array('sched_answers'=> array('../module_test_view/'.$result_content['details']['module_id'].'|'.word_limiter($result_content['details']['module_title'],10), $test_result_id), 'test' => array('scheduled test answers')));

			$this->parser->parse('layouts/default', $data);
		}
	}		
	function module_quick_access() {
		$this->load->model('module_model');
		$keyword = $this->input->post('keyword');
		$results = $this->module_model->get_module_by_keyword($keyword);
		$this->load->helper('output_text_helper');
		$this->load->model('module_test_result_model','mod_res');
		$this->load->model('scheduled_test_result_model','sched_res');

	 foreach ($results as $module): 
	$mod_ratings = $this->mod_res->get_test_results_with_module_detail_by_module_id($module->id);
	$sched_ratings =  $this->sched_res->get_test_results_with_module_detail_by_module_id($module->id);
	if(!empty($mod_ratings)) {
		$var = stats_parser($mod_ratings, 'rating');
	} else {
		$var['takers'] = 0;
		$var['rating_summary'] = 'N/A';
	}
	if(!empty($sched_ratings)) {
		$foo = stats_parser($sched_ratings, 'rating');
	} else {
		$foo['takers'] = 0;
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
								'.word_limiter($module->title,10).'
							</div>
							<div id="stat">
								<div class="mod-stat">
									<span class = "text-size-o" >Module Test Stat</span>
									<ul>
										<li>
										<span class = "stat-item">Number of takers</span>
										<span class = "stat-val">'.$var['takers'].'</span>
										</li>
										<li>
										<span class = "stat-item">Percentage Difficulty</span>
										<span class = "stat-val">'.$var['rating_summary'].'</span>
										</li>
									</ul>
									<span id = "sm-r" class = "text-size-o fa fa-arrow-circle-o-right float-r" ></span>
								</div>
								<div class="sched-stat">
									<span  class = "text-size-o " >Scheduled Test Stat</span>
									<ul>
										<li>
										<span class = "stat-item">Number of takers</span>
										<span class = "stat-val">'.$foo['takers'].'</span>
										</li>
										<li>
										<span class = "stat-item">Percentage Difficulty</span>
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

/* End of file test.php */
/* Location: ./application/admin_functions/test.php */

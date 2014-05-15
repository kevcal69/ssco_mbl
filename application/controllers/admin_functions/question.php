<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Question extends MBL_Controller {
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
						'active' => TRUE
						)
					)
				);            			
	    }	

	function create($id) {
		$this->load->helper('output_text_helper');
		$this->sidebar_content['actions'] = array(
					'list' => array(
						'content' => to_sidebar_element('fa-bars','List Questions'),
						'href' => base_url(''),
						'active' => TRUE
						),
					'sched' => array(
						'content' => to_sidebar_element('fa-tags','Schedule a Test'),
						'href' => base_url('admin/question/fetch_evaluation_test/6'),
						'active' => FALSE
						),
					'stats' => array(
						'content' => to_sidebar_element('fa-bar-chart-o','Users\' Stats'),
						'href' => base_url(''),
						'active' => FALSE
						)
					);		
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/question/create',array('module' => $this->mModule->fetch_module($id),'questions' => $this->mQ->fetch_questions($id)),TRUE); // kevcal
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

	function fetch_evaluation_test($id) {
		$array = $this->mQ->fetch_questions($id);
		$data = array();

		$haystack = array();
		if (sizeof($array) < 10) {
			return $array;
		} else {
			for ($i=0; $i < 10; $i++) { 
				$rand_num = rand(0,sizeof($array)-1);
				if (in_array($rand_num, $haystack)) {
					$i--;
				} else {
					$haystack[$i] = $rand_num;
					array_push($data, $array[$i]);
				}
			}
		}
		return $data;
	}	

	function create_question() {
		$information = $this->input->post('question');
		$question = array(
			'id' => '',
			'qtitle' => addslashes($information['title']),
			'question' => addslashes($information['question']),
			'answer' => base64_encode(serialize($information['answers'])),
			'module_id' => $information['module'],
			'choices' => base64_encode(serialize($information['choices'])),
		);
		if ($this->mQ->add($question)) {
			redirect('admin/question/create/'.$information['module']);
		} else  {
			show_404();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MBL_Controller {
	function __construct() {
		parent::__construct();
		//refuse access when not logged as trainee
		if ($this->session->userdata('role') !== 'trainee') {
			$message_403 = "You don't have permission to access the url you are trying to reach.";
			$heading = '403 Forbidden';
			show_error($message_403,403,$heading);
		}

		// $this->load->model('trainee/trainee_model');
		$this->load->model('trainee/trainee_module_model');
		$this->load->model('module_model');
		$this->load->model('module_test_result_model','test_result_model');
		$this->load->model('question_model');
		$this->load->helper('application_helper');
		$this->load->helper('output_text_helper');
		$this->load->helper('sidebar_helper');
		$this->load->library('form_validation');

		$this->trainee_id = $this->session->userdata('id');
	}

	// public function index() {
	// 	//scheduled tests
	// 	//module tests not yet taken
	// 	//scheduled test results
	// }

	public function take($module_id) {
		//check if already taken test
		$result = $this->test_result_model->get_results($module_id,$this->trainee_id);

		if (!$this->trainee_module_model->is_enroled($module_id,$this->trainee_id)) {
			$data['error_message'] = 'You are not allowed to take the test for a module you are not enroled in.';
			$data['error_title'] = 'Not Allowed to Take the Test';
			$data['body_content'] = $this->load->view('trainee/test/test_error',$data,TRUE);
		} else if ($this->session->flashdata('test_ongoing') === FALSE 
						&& !empty($result) 
						&& $this->input->post('retake-confirm') !== 'TRUE'
						&& $this->trainee_module_model->is_completed($module_id,$this->trainee_id) === TRUE
						) {
			//retake
			if ($this->input->post('retake-confirm') !== 'TRUE') {
				$retake_data = array(
					'module_title' => $this->module_model->get_title($module_id),
					'module_id' => $module_id
					);
				$data['body_content'] = $this->load->view('trainee/test/retake_confirm',$retake_data,TRUE);
			}
		} else {
			if ($this->input->post('questions-string')) {
				$data['questions'] = unserialize(base64_decode($this->input->post('questions-string')));
				//validation rules
				foreach ($data['questions'] as $index => $question) {
					$this->form_validation->set_rules('answers['.$index.'][]','Answer','trim|required|xss_clean');
					$this->form_validation->set_message('required', 'This question must be answered.');
				}
			}
			if ($this->form_validation->run() === TRUE) {
				$data['body_content'] = $this->correct();
				$this->session->set_flashdata('test_ongoing',FALSE);
			} else {
				//fetch questions
				if (!$this->input->post('questions-string') OR $this->session->flashdata('test_ongoing') === FALSE) {
					$data['questions'] = $this->question_model->fetch_evaluation_test($module_id);
					$data['questions_string'] = base64_encode(serialize($data['questions']));
					$this->session->set_flashdata('test_ongoing',TRUE);
					//insert zero-score result
					$data['test_result_id'] = $this->test_result_model->insert_result($module_id,$this->trainee_id);
				} else {
					$data['questions'] = unserialize(base64_decode($this->input->post('questions-string')));
					$data['questions_string'] = $this->input->post('questions-string');
					$data['test_result_id'] = $this->input->post('test-result-id');
					$this->session->keep_flashdata('test_ongoing');
				}

				//check if there are questions
				if (sizeof($data['questions']) <= 0) {
					//error
					$data['error_message'] = 'The test for this module has not been created yet.';
					$data['error_title'] = 'No Test For Module';
					$data['body_content'] = $this->load->view('trainee/test/test_error',$data,TRUE);
				} else {
					//display
					$data['module_id'] = $module_id;
					$data['module_title'] = $this->module_model->get_title($module_id);
					$data['body_content'] = $this->load->view('trainee/test/test_form',$data,TRUE);
				}
			}
		}

		$data['page_title'] = "SSCO Module-Based Learning";
		$this->parser->parse('layouts/default', $data);
	}

	private function correct() {
		$data['test_result_id'] = $this->input->post('test-result-id');		
		$data['module_id'] = $this->input->post('module-id');
		$data['module_title'] = $this->input->post('module-title');
		$data['questions_string'] = $this->input->post('questions-string');
		$data['questions'] = unserialize(base64_decode($this->input->post('questions-string')));
		
		//test correction
		$data['answers'] = $this->input->post('answers');
		$data['results']['total'] = sizeof($data['questions']);
		$data['results']['score'] = 0;
		$data['results']['rating'] = 0;
		$data['results']['answers'] = array();
		foreach ($data['questions'] as $index => $question) {
			$answer = unserialize_choices($question->answer);
			if ($data['answers'][$index] == $answer) {
				$data['results']['answers'][$index] = TRUE;
				$data['results']['score']++;
			} else {
				$data['results']['answers'][$index] = FALSE;
			}
		}
		//rating is stored as score/total. it will be displayed as round(($data['results']['rating']*100),3)
		$data['results']['rating'] = $data['results']['score'] / $data['results']['total'];
		//update test_results
		$update_data['rating'] = $data['results']['rating'];
		$update_data['content'] = base64_encode(serialize($data));
		$this->test_result_model->update_result($data['test_result_id'],$update_data);
		//mark module as completed
		$this->trainee_module_model->update_module($data['module_id'],$this->trainee_id,$update_data['rating'],TRUE);
		
		return $this->load->view('trainee/test/test_result',$data,TRUE);
	}
//TODO transfer to admin
	public function result($test_result_id) {
		$this->load->model('admin/user_model');
		$result = $this->test_result_model->get_result($test_result_id);
		if ($result) {
			$result_content = unserialize(base64_decode($result->content));
			$result_content['details']['test_result_id'] = $result->id;
			$result_content['details']['trainee_id'] = $result->trainee_id;

			$trainee = $this->user_model->view_trainee($result->trainee_id);

			$result_content['details']['trainee']['last_name'] = $trainee['last_name'];
			$result_content['details']['trainee']['first_name'] = $trainee['first_name'];

			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_result',$result_content,TRUE);
			$data['page_title'] = "SSCO Module-Based Learning";
			$this->parser->parse('layouts/default', $data);
		}
	}
	public function answers($test_result_id) {
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

			$result_content['details']['module_id'] = $result->module_id;
			$result_content['details']['rating'] = $result->rating;
			$result_content['details']['date'] = $result->date;
			$data['body_content'] = $this->load->view('admin/test_answers',$result_content,TRUE);
			$data['page_title'] = "SSCO Module-Based Learning";
			$this->parser->parse('layouts/default', $data);
		}
	}
}

/* End of file test.php */
/* Location: ./application/controllers/trainee/test.php */
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
						),
					array(
						'content' => to_sidebar_element('fa-question','Test Results'),
						'href' => base_url('admin/test'),
						'active' => FALSE
						)					
					
					)
				);            			
	    }	

	function create($id) {
		$this->load->helper('output_text_helper');
		$this->sidebar_content['actions'] = array(
					'list' => array(
						'content' => to_sidebar_element('fa-bars','Evaluation Questions'),
						'href' => base_url('admin/question/create/'.$id),
						'active' => TRUE
						),
					'set' => array(
						'content' => to_sidebar_element('fa-tags','Scheduled Test'),
						'href' => base_url('admin/question/test_set_up/'.$id),
						'active' => FALSE
						),
					'stats' => array(
						'content' => to_sidebar_element('fa-bar-chart-o','Users\' Stats'),
						'href' => base_url(''),
						'active' => FALSE
						)
					);		
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('admin/question/create',array('module' => $this->mModule->fetch_module($id),'questions' => $this->mQ->fetch_questions($id)),TRUE); 
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);
	}

	function test_set_up($id) {
		$this->load->helper('output_text_helper');
		$this->sidebar_content['actions'] = array(
					'list' => array(
						'content' => to_sidebar_element('fa-bars','Evaluation Questions'),
						'href' => base_url('admin/question/create/'.$id),
						'active' => FALSE
						),
					'set' => array(
						'content' => to_sidebar_element('fa-tags','Scheduled Test'),
						'href' => base_url('admin/question/test_set_up/'.$id),
						'active' => TRUE
						),
					'stats' => array(
						'content' => to_sidebar_element('fa-bar-chart-o','Users\' Stats'),
						'href' => base_url(''),
						'active' => FALSE
						)
					);		
		$data['page_title'] = "SSCO Module Base Learning";
		$test_data = array(
			'module' => $this->mModule->fetch_module($id),
			'questions' => $this->mQ->fetch_test_questions($id),
			'test' => $this->mQ->fetch_test_sched($id),
			);		
		$data['body_content'] = $this->load->view('admin/question/test_set_up',$test_data,TRUE); // kevcal
		$data['sidebar'] = $this->load->view('partials/sidebar',$this->sidebar_content,TRUE);
		$this->parser->parse('layouts/logged_in', $data);		
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
	function create_test_question() {
		$information = $this->input->post('question');
		$question = array(
			'id' => '',
			'qtitle' => addslashes($information['title']),
			'question' => addslashes($information['question']),
			'answer' => base64_encode(serialize($information['answers'])),
			'module_id' => $information['module'],
			'choices' => base64_encode(serialize($information['choices'])),
		);
		if ($this->mQ->add_test($question)) {
			redirect('admin/question/test_set_up/'.$information['module']);
		} else  {
			show_404();
		}
	}
	function edit_question() {
		$information = $this->input->post('question');
		$question = array(
			'id' => $information['id'],
			'qtitle' => addslashes($information['title']),
			'question' => addslashes($information['question']),
			'answer' => base64_encode(serialize($information['answers'])),
			'module_id' => $information['module'],
			'choices' => base64_encode(serialize($information['choices'])),
		);
		if ($this->mQ->edit($question)) {
			redirect('admin/question/create/'.$information['module']);
		} else  {
			show_404();
		}
	}	
	function edit_test_question() {
		$information = $this->input->post('question');
		$question = array(
			'id' => $information['id'],
			'qtitle' => addslashes($information['title']),
			'question' => addslashes($information['question']),
			'answer' => base64_encode(serialize($information['answers'])),
			'module_id' => $information['module'],
			'choices' => base64_encode(serialize($information['choices'])),
		);
		if ($this->mQ->edit_test($question)) {
			redirect('admin/question/test_set_up/'.$information['module']);
		} else  {
			show_404();
		}
	}	
	function question_filter() {
		$sp = $this->input->post('val');
		$mid = $this->input->post('mid');
		$this->load->helper('output_text_helper');
		if ($sp == 2) {
			$questions = $this->mQ->fetch_test_questions($mid);
		} else {
			$questions = $this->mQ->fetch_filtered_test($sp,$mid);	
		}
		
		foreach ($questions as $question):
		echo '<div class="item">
		<div class="item-heading">
			<div class="item-id">
				<span class = "text-warning qid-label">'.$question->id.'</span>
				<span class = "text-warning mid-label">'.$question->module_id.'</span>
			</div>
		';
		if ($question->is_used == 1):	
		echo	 '<i class="fa fa-check-square fa-fw text-muted"></i> <h3 class = "text-info que-tit">'.$question->qtitle.'</h3>
			<div class="opt-group">
				<span class="edit"><i class="fa fa-gear fa-fw"></i>Edit</span>
				<span class="set-test" data-id = "'.$question->id.'" data-mid = "'.$question->module_id.'" data-val = "0"><i class="fa fa-times text-error fa-fw"></i>Exclude from test</span>
			</div>';
		elseif ($question->is_used == 0):
		echo	'<h3 class = "text-info que-tit">'.$question->qtitle.'</h3>
			<div class="opt-group">
				<span class="edit"><i class="fa fa-gear fa-fw"></i>Edit</span>
				<span class="set-test" data-id = "'.$question->id.'" data-mid = "'.$question->module_id.'" data-val = "1"><i class="fa fa-check text-success fa-fw"></i>Include to test</span>
			</div>';				
		endif;
		echo '</div>
		<div class="show_d">
			<span class = "text-warning sh_mr">Show More</span>
		</div>					
		<div class="item-body">
			<h4 class = "item-title">Question</h4>
			<div class="panel panel-body">
				<p>'.$question->question.'</p>
			</div>
			<h4 class = "item-title">Choices and Answers</h4>
			<div class="panel panel-body">
				'.display_ca(unserialize(base64_decode($question->choices)),unserialize(base64_decode($question->answer))).'
			</div>				
		</div>
		<div class="panel" id ="questionare">
			<form action = "'.base_url('admin/question/edit_test_question').'" method = "POST">
				<div class="panel-heading">
					<h3 class="panel-title">
						<input type = "hidden" name = "question[id]" value = "'.$question->id.'"/>
						<input type = "hidden" name = "question[module]" value = "'.$question->module_id.'"/>
						<input type = "text" name = "question[title]" value = "'.$question->qtitle.'" class = "qfield" />
					</h3>
				</div>
				<div class="panel-body">
					<div id="econtainer">
					<textarea id = "edit-area" name = "question[question]" placeholder = "Question">'.$question->question.'</textarea>
					</div>
					
				</div>
				<div class="panel-footer">
						<div class="control-group">
							<label>Choices</label>
							<div class="controls" id = "choices-li">
								'.edit_ca(unserialize(base64_decode($question->choices)),unserialize(base64_decode($question->answer))).'
							</div>
							<button type = "button" class = "" onclick="question.add()">Add</button>
						</div>		
						<button  class = "button-success">Save</button>				
				</div>
			</form>
		</div>		

		</div>';
		endforeach;
	}
	function set_question(){
		$this->load->helper('output_text_helper');		
		$id = $this->input->post('id');
		$mid = $this->input->post('mid');
		$val = $this->input->post('val');
		$this->mQ->set_test($id,$val);
		echo "success";
	}
	function conduct() {
		echo "success";
		$mid = $this->input->post('mid');
		$test_question = $this->mQ->fetch_test_questions($mid);
		$test_question = base64_encode(serialize($test_question));
		$this->mQ->conduct_test($mid,$test_question);
		echo "success";
	}
	function stop() {
		$mid = $this->input->post('mid');
		$tid = $this->input->post('tid');
		$this->mQ->stop_test($tid,$mid);
		echo "success";
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

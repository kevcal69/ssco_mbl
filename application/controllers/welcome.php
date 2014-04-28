<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['page_title'] = "SSCO Module Base Learning";
		$data['body_content'] = $this->load->view('content_homepage/content_home',array(),TRUE); // kevcal
		$this->parser->parse('layouts/home', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
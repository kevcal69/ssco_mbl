<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MBL_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Homepage_model','mModel');
      $this->load->helper('application_helper');

    }	

	public function index() {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('content_homepage/content_home',array('modules' => $this->mModel->get_module_entries()),TRUE); // kevcal
		$this->parser->parse('layouts/home', $data);
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
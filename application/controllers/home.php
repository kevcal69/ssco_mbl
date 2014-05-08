<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MBL_Controller {
    function __construct() {
        parent::__construct();
	// if ($this->session->userdata('role') == 'admin') {
	// 	redirect('admin');
	// }
        $this->load->model('Module_model','mModel');


      $this->load->helper('application_helper');

    }	

	public function index() {
		$data['page_title'] = "SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('contents/home',array('modules' => $this->mModel->get_module_entries()),TRUE); // kevcal
		$this->parser->parse('layouts/default', $data);
	}
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */

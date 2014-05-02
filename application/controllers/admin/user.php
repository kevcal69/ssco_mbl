<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('admin/user_model');
    }	

	public function index() {
		$data['page_title'] = "Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/user/user_functions','',TRUE);
		$this->parser->parse('layouts/home', $data);
	}
	public function create() {
		$data['page_title'] = "Create User - Admin - SSCO Module-Based Learning";
		$data['body_content'] = $this->load->view('admin/user/user_create','',TRUE);
		$this->parser->parse('layouts/home', $data);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/admin/user.php */
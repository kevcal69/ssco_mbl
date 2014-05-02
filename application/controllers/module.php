<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Admin extends MBL_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('Homepage_model','mModel');
      			$this->load->helper('application_helper');
	    }	

	    function create_module()  {
	    	
	    }

		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
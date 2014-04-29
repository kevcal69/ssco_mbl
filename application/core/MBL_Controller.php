<?php

  class MBL_Controller extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->request_methods['GET'] = array();
      $this->request_methods['POST'] = array();
      $this->required_validations = array();

      $this->_determine_route();
    }

    protected function _determine_route() {
      $this->route['controller'] = $this->uri->rsegment(1);
      $this->route['action'] = $this->uri->rsegment(2);
      $this->load->vars($this->route);
    }

    protected function _check_request_method() {
      if (!in_array($this->route['action'], $this->request_methods[$_SERVER['REQUEST_METHOD']])) {
        show_404($this->route['controller'] . '/' . $this->route['action'] . ' with method ' . $_SERVER['REQUEST_METHOD'] . ' not found.');
      }
    }

    protected function _check_required_validation() {
      if (array_key_exists($this->route['action'], $this->required_validations) 
        && !$this->session->userdata($this->required_validations[$this->route['action']])) {
        redirect(base_url());
      }
    }

  }

?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->estaLogueado();
    }

    private function estaLogueado() {
        return TRUE;
        if ($this->session->userdata("logueado") != TRUE) {
            redirect(base_url() . 'login/');
            exit();
        }
    }

    public function index() {
        $this->template = $this->parser->parse("dashboard_view", array(), TRUE);
        $this->load->view('template');
    }

}

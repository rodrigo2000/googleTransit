<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library(array('form_validation'));
    }

    public function index($data = array()) {
        //echo "<pre>" . print_r($this->session->userdata(), true) . "</pre>";
        switch ($this->session->userdata('id_perfil')) {
            case '':
                $data['token'] = $this->token();
                $data['titulo'] = 'Inicio de sesion';
                $this->load->view('login_view', $data);
                break;
            case "1": // idPerfil = 1  ==> Administrador de sistema
                redirect("panelcontrol/");
                break;
            default: // Cualquier otro enviamos a filemanager
                redirect("panelcontrol/");
                //redirect("http://192.168.10.129/advans/boveda/");
                break;
        }
    }

    public function iniciar_sesion() {
        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {
            $this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('contrasena', 'Contrasena', 'required|trim|min_length[5]|max_length[150]|xss_clean');
            
            $r['usuario'] = $this->input->post('usuario');
            if ($this->form_validation->run() == FALSE) {
                $data['r'] = $r;
                $this->index($data);
            } else {
                $username = $this->input->post('usuario');
                $password = md5($this->input->post('contrasena'));
                $check_user = $this->Login_model->login_user($username, $password);
                if ($check_user == TRUE) {
                    $this->index();
                }
            }
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function token() {
        $token = md5(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

    public function cerrar_sesion() {
        date_default_timezone_set('America/Merida');
        $this->Login_model->cerrar_sesion();
        $this->db->set("ultimo_acceso", ahora())->where("id_usuario", $this->session->userdata("id_usuario"))->update("usuarios");
        $this->session->sess_destroy();
        $this->index();
    }
    
    function error404(){
        redirect("Panelcontrol/");
    }

}

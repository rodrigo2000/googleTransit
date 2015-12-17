<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->model_name = "Login_model";
    }

    public function login_user($username, $password) {
        $result = $this->initSessionDeUsuario($username, $password);
        if (!$result['success']) {
            $this->Bitacora_model->insert(array(
                'id_cuenta' => NULL,
                'id_empresa' => NULL,
                'id_usuario' => NULL,
                'tabla' => NULL,
                'accion' => "Iniciar sesión",
                'modulo' => $this->model_name,
                'data' => json_encode(array("usuario" => $username, "contrasena" => $password)),
                'result' => json_encode($result),
                'mensaje' => sprintf("El usuario %s falló al iniciar sesión", $username)
            ));
            $this->session->set_flashdata('informacion', $result['message']);
            redirect(base_url() . 'Login');
        }
        $this->session->set_userdata($result['config']);
        $this->Bitacora_model->insert(array(
            'tabla' => NULL,
            'accion' => "Iniciar sesión",
            'modulo' => $this->model_name,
            'data' => json_encode(array("usuario" => $username, "contrasena" => $password)),
            'result' => json_encode($result),
            'mensaje' => sprintf("El usuario %s inició sesión", $username)
        ));
        return TRUE;
    }

    function cerrar_sesion() {
        $this->Bitacora_model->insert(array(
            'tabla' => NULL,
            'accion' => "Cerrar sesión",
            'modulo' => $this->model_name,
            'data' => NULL,
            'result' => NULL,
            'mensaje' => sprintf("El usuario %s finalizó sesión", $this->session->username)
        ));
    }

}

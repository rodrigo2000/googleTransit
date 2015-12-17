<?php

class Usuarios extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->module['name'] = 'usuarios';
        $this->module['folder'] = '';
        $this->module['controller'] = 'Usuarios';
        $this->module['title'] = 'Usuarios';
        $this->module['title_list'] = "Listado de usuarios";
        $this->module['title_new'] = "Agregar usuario";
        $this->module['title_edit'] = "Editar usuario";
        $this->module['title_delete'] = "Eliminar usuario";
        $this->module["id_field"] = "id_usuario";
        $this->module['tabla'] = "usuarios";
        $this->module['prefix'] = "u";

        $this->rulesForm = array(
            array(
                'field' => 'nombre',
                'label' => 'Nombre real del usuario',
                'rules' => 'required|trim|max_length[100]',
            ),
            array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'trim|integer|max_length[15]|min_length[10]'
            ),
            array(
                'field' => 'extension',
                'label' => 'Extension',
                'rules' => 'trim|integer|max_length[5]'
            ),
            array(
                'field' => 'departamento',
                'label' => 'Departamento',
                'rules' => 'trim|max_length[30]'
            ),
            array(
                'field' => 'puesto',
                'label' => 'Puesto',
                'rules' => 'trim|max_length[50]'
            ),
        );
        $contrasena = $this->input->post("contrasena");
        if ($this->uri->segment(2) == "nuevo" || !empty($contrasena)) {
            $t = array(
                array(
                    'field' => 'contrasena',
                    'label' => 'Contraseña',
                    'rules' => 'trim|required|max_length[100]'
                ),
                array(
                    'field' => 'contrasena_r',
                    'label' => 'Repite contraseña',
                    'rules' => 'trim|required|matches[contrasena]',
                    'errors' => array(
                        'matches' => "Las contraseñas no concuerdan"
                    )
                ),
                array(
                    'field' => "id_usuario",
                    "label" => "id_usuario",
                    'rules' => 'xss_clean'
                )
            );
            foreach ($t as $tt) {
                array_push($this->rulesForm, $tt);
            }
        }
        if ($this->uri->segment(2) != "mi_perfil" && !$this->isTipoUsuario(ADVANS_TIPO_USUARIO_TITULAR_CUENTA)) {
            $t = array(
                array(
                    'field' => 'id_tipousuario',
                    'label' => 'Tipo de usuario',
                    'rules' => 'trim|required|is_natural_no_zero',
                    'errors' => array(
                        'is_natural_no_zero' => 'Debe seleccionar un %s'
                    )
                ),
                array(
                    'field' => 'id_perfil',
                    'label' => 'Perfil',
                    'rules' => 'trim|required|is_natural_no_zero',
                    'errors' => array(
                        'is_natural_no_zero' => 'Debe seleccionar un %s'
                    )
                )
            );
            foreach ($t as $tt) {
                array_push($this->rulesForm, $tt);
            }
        }
        if ($this->uri->segment(2) != "mi_perfil" && $this->session->id_tipousuario <= ADVANS_PERFIL_ADMINISTRADOR_EMPRESA && !$this->isTipoUsuario(ADVANS_TIPO_USUARIO_TITULAR_CUENTA)) {
            $t = array(
                'field' => 'id_perfil',
                'label' => 'Perfil',
                'rules' => 'greater_than[0]|required',
                'errors' => array(
                    'greater_than' => 'Debe seleccionar el %s del usuario',
                ),
            );
            array_push($this->rulesForm, $t);
        }
        if ($this->input->post("id_usuario") == 0) {
            $t = array(
                'field' => 'username',
                'label' => 'Nombre de usuario',
                'rules' => 'trim|required|min_length[5]|max_length[100]|valid_email|callback_esUsuarioUnico[usuarios.username]'
            );
            array_push($this->rulesForm, $t);
        }
        $this->_initialize();
    }

    function nuevo($data = array()) {
        $data = array(
            "tituloModulo" => $this->module['title_new'],
            "etiquetaBoton" => "Agregar usuario",
            "urlAction" => $this->module['new_url']
        );
        parent::nuevo($data);
    }

    function modificar($id = NULL, $data = array()) {
        $data = array(
            "tituloModulo" => $this->module['title_edit'],
            "etiquetaBoton" => "Actualizar",
            "urlAction" => $this->module['edit_url'] . "/" . $id,
            "id" => $id
        );
        $idEmpresa = $this->input->post("id_empresa_anterior");
        if (!empty($idEmpresa)) {
            $this->session->set_userdata("id_empresa_anterior", $idEmpresa);
        }
        parent::modificar($id, $data);
    }

    function eliminar($id, $data = NULL) {

        $data = array(
            "etiqueta" => "¿Esta seguro que desea eliminar este usuario?",
            "urlActionDelete" => $this->module['delete_url'],
            "urlActionCancel" => $this->module['listado_url'],
            "id" => $id
        );
        parent::eliminar($id, $data);
    }

    function esUsuarioUnico($username) {
        if (intval($this->input->post("id_usuario")) > 0) {
            return TRUE;
        }
        $user = $this->input->post("username");
        $r = $this->db->like("username", $username)->limit(1)->get("usuarios");
        if ($r->num_rows() > 0) {
            $this->form_validation->set_message('esUsuarioUnico', 'Este usuario ya existe');
            return FALSE;
        }
        return TRUE;
    }

    function mi_perfil() {
        $id = $this->session->userdata("id_usuario");
        $data = array(
            "tituloModulo" => "Mi perfil",
            "etiquetaBoton" => "Actualizar",
            "urlAction" => $this->module['url'] . "/mi_perfil/" . $id,
            "id" => $id
        );
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $this->form_validation->set_rules($this->rulesForm);
            $id = $this->input->post($this->module['id_field']);
            foreach ($this->rulesForm as $rule) {
                $r[$rule['field']] = $this->input->post($rule['field']);
            }
            if ($this->form_validation->run() == FALSE) {
                $data['r'] = $r;
            } else {
                $s = $this->_update($id, $r);
                if ($s['state'] == 'success') {
                    $this->session->set_flashdata("informacion", $s);
                }
            }
        }
        $res = $this->db->where($this->module['prefix'] . "." . $this->module['id_field'], $id)->get($this->module['tabla'] . " " . $this->module['prefix']);
        if ($res->num_rows() == 1) {
            $data['r'] = $res->row_array();
        }

        $data['accion'] = "modificar";
        $this->visualizar($this->module['name'] . "_nuevo_view", $data);
    }

    function apps($idCuenta) {
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $idApps = $this->input->post("id_app");
            $this->Apps_por_cuenta_model->borrarTodasLasAppsDelUsuario($idCuenta);
            if (count($idApps) > 0) {
                $data = array();
                foreach ($idApps as $i) {
                    array_push($data, array('id_app' => $i, 'id_cuenta' => $idCuenta));
                }
                $result = $this->Apps_por_cuenta_model->insert_batch($data);
                if ($result['state'] == "success") {
                    $result['message'] = "Se han actualizado las apps del usuario.";
                    $this->session->set_flashdata("informacion", $result);
                    redirect(base_url() . "cuentas/");
                }
            }
            $this->session->set_flashdata("informacion", "Se han quitado todas las apps al usuario");
            redirect(base_url() . "cuentas/");
        }
        $data = array(
            'id_apps' => $this->Apps_model->obtenerAppDelUsuario($idCuenta),
            'tituloModulo' => "Apps de la cuenta: " . $idCuenta,
            'urlAction' => base_url() . "usuarios/apps/" . $idCuenta,
            'id' => $idCuenta
        );
        $this->visualizar("apps_cuentas_view", $data);
    }

    function empresas($action = NULL, $id = 0) {
        if ($action == NULL || is_numeric($action)) {
            $data = array(
                "title_new" => "Nueva empresa",
                "url_new" => base_url() . $this->module['name'] . "/empresas/nuevo",
                "title_list" => "Listado de empresas",
                "id" => $id
            );
            $totalRegistros = $this->db->where("id_cuenta", $this->session->userdata("id_cuenta"))->get("empresas")->num_rows();
            $uriSegment = 3;
            $porPagina = 25;
            $page = ($this->uri->segment($uriSegment, 0));
            $registros = $this->db->where("id_cuenta", $this->session->userdata("id_cuenta"))->limit($porPagina, $page)->get("empresas")->result_array();
            $this->listadoModoUsuario($uriSegment, $porPagina, $totalRegistros, $registros, "usuarios_empresas_view", $data);
        } else {
            $data = array(
                "tituloModulo" => "Agregar nueva empresa",
                "etiquetaBoton" => "Agregar empresa",
                "urlAction" => base_url() . $this->module['name'] . "/empresas/nuevo",
                "accion" => strtolower($action),
                "id" => $id
            );
            if ($this->input->server('REQUEST_METHOD') == "POST") {
                $this->rulesForm = array(
                    array(
                        'field' => 'razon_social',
                        'label' => 'Razón social',
                        'rules' => 'required|trim',
                    ),
                    array(
                        'field' => 'rfc',
                        'label' => 'RFC',
                        'rules' => 'required|trim|min_length[10]|max_length[14]|callback_validaRFC' . ( $this->input->post("id_empresa") == 0 ? '|is_unique[empresas.rfc]' : ''),
                        'errors' => array(
                            'is_unique' => 'Este %s ya ha sido capturado.'
                        )
                    ),
                    array(
                        'field' => 'domicilio_fiscal',
                        'label' => 'Domicilio fiscal',
                        'rules' => 'required|trim'
                    )
                );
                $this->form_validation->set_rules($this->rulesForm);
                $id = $this->input->post($this->module['id_field']);
                foreach ($this->rulesForm as $rule) {
                    $r[$rule['field']] = $this->input->post($rule['field']);
                }
                if ($this->form_validation->run() == FALSE) {
                    $data['r'] = $r;
                } else {
                    $r['id_cuenta'] = $this->session->userdata("id_cuenta");
                    $s = $this->input->post("accion") == "nuevo" ? $this->Empresas_model->insert($r) : $this->Empresas_model->update($id, $r);
                    if ($s['state'] == 'success') {
                        $this->session->set_flashdata("informacion", $s);
                        redirect(base_url() . implode("/", array($this->module['controller'], "empresas")));
                    }
                }
            }
            $this->visualizar("empresas_nuevo_view", $data);
        }
    }

    function validaRFC($str) {
        $this->load->helper("class_form");
        if (!valid_rfc($str)) {
            $this->form_validation->set_message('validaRFC', 'El RFC no posee una sintaxis correcta');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function activarUsuario($id) {
        $result = $this->db->select("activo")->where("id_usuario", $id)->limit(1)->get("usuarios")->row_array();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $activar = 1 - $result['activo'];
            if ($this->session->userdata('id_perfil') <= ADVANS_PERFIL_ADMINISTRADOR_EMPRESA && $this->session->userdata("id_tipocuenta") <= ADVANS_CUENTA_EMPRESARIAL) {
                $this->Usuarios_model->activarUsuario($id, $activar);
                redirect(base_url() . $this->module['controller']);
            }
        } else {
            if ($this->session->userdata("id_usuario") == $id) {
                $informacion = array('state' => 'warning', 'message' => 'No puede desactivar su propia cuenta');
            }
            if ($id == 1) {
                switch ($this->session->userdata("id_cuenta")) {
                    case ADVANS_CUENTA_ADMINISTRADOR:
                        $informacion = array('state' => 'warning', 'message' => 'El usuario <b>Administrador de Soluciones ADVANS</b> es imposible de desactivar');
                        break;
                    default :
                        $informacion = array('state' => 'warning', 'message' => 'El elemento que intentó Activar/Desactivar no existe');
                }
            }
            if (!$this->Usuarios_model->esUsuarioDeMiCuenta($id) && !$this->isTipoCuenta(ADVANS_CUENTA_ADMINISTRADOR)) {
                $informacion = array('state' => 'warning', 'message' => 'El usuario no existe');
            }
            if (isset($informacion)) {
                $this->session->set_flashdata("informacion", $informacion);
                redirect(base_url() . $this->module['controller']);
            }
            $data = array(
                "etiqueta" => "¿Esta seguro que desea eliminar esta cuenta?",
                "urlAction" => base_url() . "Usuarios/activarUsuario/" . $id,
                "urlActionCancel" => $this->module['listado_url'],
                "id" => $id,
                "activo" => $result['activo']
            );
            $this->visualizar("usuarios_activar_view", $data);
        }
    }

}

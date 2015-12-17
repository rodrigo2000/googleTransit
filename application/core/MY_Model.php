<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table_prefix = "";
        $this->table_name = "";
        $this->id_field = "";
        $this->model_name = "";
        date_default_timezone_set('America/Merida');
    }

    public function record_count() {
//        switch ($this->session->id_cuenta) {
//            case 1:
//                break;
//            default:
//                $this->db->where($this->table_prefix . ".id_cuenta", $this->session->id_cuenta);
//        }
        return $this->db->count_all_results($this->table_name . " " . $this->table_prefix);
    }

    public function getResultados($limit, $start) {
//        switch ($this->session->id_cuenta) {
//            case 1:
//                break;
//            default:
//                $this->db->where($this->table_prefix . ".id_cuenta", $this->session->id_cuenta);
//        }
        $query = $this->db
                ->limit($limit, $start)
                ->get($this->table_name . " " . $this->table_prefix);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return array();
    }

    function initSessionDeUsuario($username, $password) {
        $return = array(
            'success' => FALSE,
            'config' => NULL,
            'message' => NULL,
        );
        if (empty($username) || empty($password)) {
            $return['message'] = "Nombre de usuario o contaseña incorrectos";
            return $return;
        }
        $this->dbControl = $this->getDatabaseControl();
        $query = $this->dbControl->select("c.id_cuenta, c.id_tipocuenta, c.id_servidor, c.activo as cuenta_activa")
                ->where('u.username', $username)
                ->where('u.contrasena', $password)
                ->join("servidores s", "s.id_servidor = c.id_servidor", "INNER")
                ->join("usuarios u", "u.id_cuenta = c.id_cuenta", "INNER")->select("u.*")
                ->join("tipos_cuenta tc", "c.id_tipocuenta = tc.id_tipocuenta", "INNER")->select("tc.nombre AS 'tipo_cuenta'")
                ->join("perfiles p", "p.id_perfil = u.id_perfil", "INNER")->select("p.nombre AS 'perfil'")
                //->join("empresas e", "e.id_cuenta = c.id_cuenta", "INNER")->select("e.id_empresa, e.rfc AS 'rfc', e.razon_social AS 'empresa'")
                ->limit(1)
                ->get("cuentas c");
        if ($query->num_rows() == 1) {
            $result = $query->row_array();
            if ($result['cuenta_activa'] == TRUE) {
                if ($result['activo'] == TRUE) {
                    $data = array(
                        'logueado' => TRUE,
                        'ultimo_acceso' => $result['ultimo_acceso'],
                        'id_cuenta' => intval($result['id_cuenta']),
                        'id_usuario' => intval($result['id_usuario']),
                        'id_perfil' => intval($result['id_perfil']),
                        'id_tipocuenta' => intval($result['id_tipocuenta']),
                        'id_tipousuario' => intval($result['id_tipousuario']),
                        'empresas' => $this->Empresas_model->getEmpresas($result['id_cuenta']),
                        'perfil' => $result['perfil'],
                        'username' => $username,
                        'contrasena' => $password
                    );
                    $data['apps'] = $this->getAppsDeCuenta($result['id_cuenta']);
                    $return = array(
                        'success' => TRUE,
                        'config' => $data
                    );
                    return $return;
                } else {
                    $return['message'] = "Su usuario esta desactivado. Por favor comuníquese con el <b>titular de la cuenta</b> o envíe un correo a <b>soporte@advans.mx</b> para brindarle información de este inconveniente.";
                    return $return;
                }
            } else {
                $return['message'] = "Su cuenta esta desactivada. Por favor comuníquese a <b>soporte@advans.mx</b> para brindarle información de este inconveniente.";
                return $return;
            }
        } else {
            $return['message'] = 'Nombre de usuario o contraseña incorrectos.';
            return $return;
        }
    }

    function getDatabaseDeUsuario($nameSpace = NULL) {
        if (empty($nameSpace)) {
            $nameSpace = ADVANS_NAMESPACE;
        }
        if ($nameSpace == "control") {
            return false;
        }
        $result = $this->session->apps[$nameSpace]['db'];
        if (is_array($result)) {
            $dbControl = $this->getDatabaseControl();
            $db = array(
                'dsn' => '',
                'hostname' => $dbControl->select("server_host")->where("id_servidor", $result['id_servidor'])->limit(1)->get("servidores")->row()->server_host,
                'username' => $result['db_user'],
                'password' => $result['db_pass'],
                'database' => $result['db_name'],
                'dbdriver' => 'mysqli',
                'dbprefix' => '',
                'pconnect' => FALSE,
                'db_debug' => TRUE,
                'cache_on' => FALSE,
                'cachedir' => '',
                'char_set' => 'utf8',
                'dbcollat' => 'utf8_general_ci',
                'swap_pre' => '',
                'encrypt' => FALSE,
                'compress' => FALSE,
                'stricton' => FALSE,
                'failover' => array(),
                'save_queries' => TRUE
            );
            $CI = &get_instance();
            return $CI->load->database($db, TRUE);
        } else {
            $this->session->set_flashdata('usuario_incorrecto', 'Error de base de datos: Nombre de usuario o contraseña incorrectos.');
            redirect(base_url() . 'login', 'refresh');
            return FALSE;
        }
    }

    function isActiveApp($idCuenta, $idApp) {
        if (empty($idCuenta)) {
            $idCuenta = $this->session->userdata("id_cuenta");
        }
        if (empty($idApp)) {
            $idApp = $this->getAppID();
        }
        $this->dbControl = $this->getDatabaseControl();
        return $this->dbControl->select("activo")->where("id_cuenta", $idCuenta)->where("id_app", $idApp)->get("apps_por_cuenta")->row()->activo;
    }

    function getAppID() {
        $apps = $this->session->userdata("apps");
        return $apps[ADVANS_NAMESPACE]['id_app'];
    }

    function delete($id) {
        $this->db->where($this->id_field, $id);
        $r = $this->db->delete($this->table_name);
        if ($r || $this->db->affected_rows() > 0) {
            $return = array(
                'state' => 'success',
                'message' => 'Se ha eliminado el registro.'
            );
        } else {
            $return = array(
                'state' => 'error',
                'message' => 'No se pudo eliminar el registro.'
            );
        }
        return $return;
    }

    function update($id, $data) {
        if (count($data) > 0) {
            $this->db->where($this->id_field, $id);
            $result = $this->db->update($this->table_name, $data);
        } else {
            $result = true;
        }
        if ($result) {
            $return = array(
                'state' => 'success',
                'message' => 'Se ha editado el registro.',
                'data' => array(
                    'affected_rows' => $result === true ? 0 : $this->db->affected_rows(),
                    'query' => $result === true ? '' : $this->db->last_query()
                )
            );
        } else {
            $return = array(
                'state' => 'error',
                'message' => 'Ocurrió un error al editar el registro.',
            );
        }
        return $return;
    }

    function insert($data) {
        if ($this->db->insert($this->table_name, $data)) {
            $id = $this->db->insert_id();
            $return = array(
                'state' => 'success',
                'message' => 'Se ha agregado el registro.',
                'data' => array(
                    'insert_id' => isset($data[$this->id_field]) ? $data[$this->id_field] : $id
                )
            );
        } else {
            $this->inserted_id = false;
            $return = array(
                'state' => 'warning',
                'message' => 'No fue posible agregar el registro. ' . $this->db->_error_message()
            );
        }
        return $return;
    }

    function insert_batch($data) {
        if ($this->db->insert_batch($this->table_name, $data)) {
            $return = array(
                'state' => 'success',
                'message' => 'Se ha' . (count($data) > 1 ? 'n' : '') . ' agregado ' . count($data) . ' el registro' . (count($data) > 1 ? 's' : '') . '.',
                'data' => ''
            );
        } else {
            $return = array(
                'state' => 'warning',
                'message' => 'No fue posible agregar los registros. ' . $this->db->_error_message()
            );
        }
        return $return;
    }

}

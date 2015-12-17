<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

class Usuarios_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = "usuarios";
        $this->id_field = "id_usuario";
        $this->table_prefix = "u";
        $this->model_name = ucfirst($this->table_name) . "_model";
    }

    function getResultados($limit, $start) {
        $this->db
                ->select("u.*")
                ->join("perfiles p", "p.id_perfil=u.id_perfil", "LEFT")->select("p.nombre AS perfil")
                ->join("tipos_usuario tu", "tu.id_tipousuario = u.id_tipousuario", "INNER")->select("tu.nombre AS tipo_usuario")
                ->join("cuentas c", "c.id_cuenta = u.id_cuenta", "INNER")->select("c.id_tipocuenta");
        return parent::getResultados($limit, $start);
    }

    function insert($data) {
        if (!isset($data['id_cuenta']))
            $data['id_cuenta'] = $this->session->id_cuenta;
        if (!isset($data['activo']))
            $data['activo'] = 1;
        if (!isset($data['fecha_creacion']))
            $data['fecha_creacion'] = ahora();
        $data['contrasena'] = md5($data['contrasena']);
        unset($data["contrasena_r"]);
        return parent::insert($data);
    }

    function update($id, $data) {
        if (!empty($data['contrasena'])) {
            $data['contrasena'] = md5($data['contrasena']);
        } else {
            unset($data['contrasena']);
        }
        unset($data["contrasena_r"], $data['username']);
        return parent::update($id, $data);
    }

    function borrarUsuariosDeLaCuenta($idCuenta) {
        if (!empty($idCuenta)) {
            $this->db->where("id_cuenta", $idCuenta)->delete("usuarios");
            return TRUE;
        }
        return FALSE;
    }

    function activarUsuario($idUsuario, $activar) {
        $return = $this->db->set("activo", $activar)->where("id_usuario", $idUsuario)->update("usuarios");
        $this->Bitacora_model->insert(array(
            'tabla' => $this->table_name,
            'modulo' => $this->model_name,
            'accion' => "Activación/Desactivación de usuario",
            'data' => json_encode(array("id_usuario" => $idUsuario, "activar" => $activar)),
            'result' => json_encode(array("result" => $this->db->affected_rows())),
            'mensaje' => sprintf("Se ha " . ($activar ? "activado" : "desactivado") . " el usuario %s", $idUsuario)
        ));
        return $return;
    }

    function esUsuarioDeMiCuenta($idUsuario, $idCuenta = NULL) {
        if ($idCuenta == NULL)
            $idCuenta = $this->session->userdata('id_cuenta');
        return $this->db->where("id_usuario", $idUsuario)->where("id_cuenta", $idCuenta)->get("usuarios")->num_rows() > 0;
    }

}

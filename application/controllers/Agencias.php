<?php

class Agencias extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->module['name'] = 'agencias';
        $this->module['folder'] = '';
        $this->module['controller'] = 'Agencias';
        $this->module['title'] = 'Agencias';
        $this->module['title_list'] = "Listado de " . $this->module['name'];
        $this->module['title_new'] = "Agregar agencia";
        $this->module['title_edit'] = "Editar agencia";
        $this->module['title_delete'] = "Eliminar agencia";
        $this->module["id_field"] = "id_agencia";
        $this->module['tabla'] = "agency";
        $this->module['prefix'] = "a";

        $this->rulesForm = array(
            array(
                'field' => 'agency_id',
                'label' => 'agency_id',
                'rules' => 'trim|max_length[10]'
            ),
            array(
                'field' => 'agency_name',
                'label' => 'agency_name',
                'rules' => 'required|trim|max_length[300]',
            ),
            array(
                'field' => 'agency_url',
                'label' => 'agency_url',
                'rules' => 'required|trim|valid_url|max_length[300]'
            ),
            array(
                'field' => 'agency_timezone',
                'label' => 'agency_timezone',
                'rules' => 'required|trim|max_length[30]'
            ),
            array(
                'field' => 'agency_lang',
                'label' => 'agency_lang',
                'rules' => 'trim|max_length[300]'
            ),
            array(
                'field' => 'agency_phone',
                'label' => 'agency_phone',
                'rules' => 'trim|max_length[30]'
            ),
            array(
                'field' => 'agency_fare_url',
                'label' => 'agency_fare_url',
                'rules' => 'trim|valid_url|max_length[300]'
            )
        );

        $this->_initialize();
    }

    function nuevo($data = array()) {
        $data = array(
            "tituloModulo" => $this->module['title_new'],
            "etiquetaBoton" => "Agregar agencia",
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

}

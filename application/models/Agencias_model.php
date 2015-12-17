<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

class Agencias_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = "agency";
        $this->id_field = "id_agencia";
        $this->table_prefix = "a";
        $this->model_name = ucfirst($this->table_name) . "_model";
    }

    function insert($data) {
        if (empty($data['agency_id'])) {
            $data['agency_id'] = rand(0, 99999);
        }
        return parent::insert($data);
    }

}

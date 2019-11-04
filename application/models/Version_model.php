<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Version_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function edit_version($id, $ver_name, $ver_code, $ver_desc, $updated_dt)
    {
        $hasil = $this->db->query("UPDATE `ngulikode_version` SET 
                    `version_name`='$ver_name', 
                    `version_code`='$ver_code', 
                    `description`='$ver_desc',
                    `updated_date`='$updated_dt' WHERE `id`='$id'");
        return $hasil;
    }

    function getVersion()
    {
        return $this->db->get('ngulikode_version')->result_array();
    }
}

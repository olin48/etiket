<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_users_model extends CI_Model
{
    function view_data()
    {
        return $this->db->get('cms_user');
    }

    function admin_mobile_data()
    {
        return $this->db->get('mob_admins');
    }

    function edit_mob_admin($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete_mob_admin($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

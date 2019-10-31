<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    function edit_users($id, $name, $email, $role_id, $status_id)
    {
        $hasil = $this->db->query("UPDATE `cms_user` SET `name`='$name', `email`='$email', `role_id`='$role_id', `is_active`='$status_id' WHERE `id`='$id'");
        return $hasil;
    }

    function delete_users($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

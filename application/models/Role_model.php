<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function getRoleId()
    {
        $query = "SELECT `cms_user_access_menu`.*, `cms_user_role`.`role`, `cms_user_menu`.`menu`
                  FROM `cms_user_access_menu` JOIN `cms_user_role`
                  ON `cms_user_access_menu`.`role_id` = `cms_user_role`.`id`
                  JOIN `cms_user_menu`
                  ON `cms_user_menu`.`id` = `cms_user_access_menu`.`menu_id`";

        return $this->db->query($query)->result_array();
    }

    public function getRoleName()
    {
        $query = "SELECT `cms_user`.*, `cms_user_role`.`role`
                  FROM `cms_user` JOIN `cms_user_role`
                  ON `cms_user`.`role_id` = `cms_user_role`.`id`";

        return $this->db->query($query)->result_array();
    }

    public function getRoleAdmin()
    {
        $query = "SELECT * FROM `cms_user_role` WHERE `id` != '1'";

        return $this->db->query($query)->result_array();
    }

    function edit_role_menu($id, $role_id, $menu_id)
    {
        $hasil = $this->db->query("UPDATE `cms_user_access_menu` SET `role_id`='$role_id', `menu_id`='$menu_id' WHERE `id`='$id'");
        return $hasil;
    }

    function delete_role_menu($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function edit_role($id, $role)
    {
        $hasil = $this->db->query("UPDATE `cms_user_role` SET `role`='$role' WHERE `id`='$id'");
        return $hasil;
    }

    function delete_role($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

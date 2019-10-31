<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `cms_user_sub_menu`.*, `cms_user_menu`.`menu`
                  FROM `cms_user_sub_menu` JOIN `cms_user_menu`
                  ON `cms_user_sub_menu`.`menu_id` = `cms_user_menu`.`id`";

        return $this->db->query($query)->result_array();
    }

    function edit_menu($id, $menu)
    {
        $hasil = $this->db->query("UPDATE `cms_user_menu` SET `menu`='$menu' WHERE `id`='$id'");
        return $hasil;
    }

    function delete_menu($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

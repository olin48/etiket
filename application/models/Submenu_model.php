<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model
{
    function edit_submenu($id, $menu_id, $submenu, $url, $icon, $is_active)
    {
        $query = "UPDATE `cms_user_sub_menu` SET
                    `menu_id`='$menu_id', 
                    `title`='$submenu', 
                    `url`='$url', 
                    `icon`='$icon', 
                    `is_active`='$is_active'
                  WHERE `id`='$id'";
        $hasil = $this->db->query($query);
        return $hasil;
    }

    function delete_submenu($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

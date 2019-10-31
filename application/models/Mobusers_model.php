<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobusers_model extends CI_Model
{
    public function registerUsers($data)
    {
        $this->db->insert('mob_users', $data);
        return $this->db->affected_rows();
    }

    public function loginUsers($username)
    {
        $this->db->get_where('mob_users', array('username' => $username))->result_array();
        return $this->db->affected_rows();
    }
}

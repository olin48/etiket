<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_users_model extends CI_Model
{
    function view_data()
    {
        return $this->db->get('cms_user');
    }
}

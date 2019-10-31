<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function edit_mob_users($id, $name, $username, $email, $password, $phone, $status)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if ($password == null) {
            $hasil = $this->db->query("UPDATE `mob_users` SET 
                                  `name`='$name',
                                  `username`='$username',
                                  `email`='$email',
                                  `phone`='$phone',
                                  `is_active`='$status' WHERE `id`='$id'");
            return $hasil;
        } else {
            $hasil = $this->db->query("UPDATE `mob_users` SET 
                                  `name`='$name',
                                  `username`='$username',
                                  `email`='$email',
                                  `password`='$passwordHash',
                                  `phone`='$phone',
                                  `is_active`='$status' WHERE `id`='$id'");
            return $hasil;
        }
    }

    function delete_mob_users($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function edit_berita($id, $judul, $isi, $image, $link)
    {
        $hasil = $this->db->query("UPDATE `mob_berita` SET 
                    `judul`='$judul', 
                    `isi`='$isi', 
                    `image`='$image',
                    `link`='$link' WHERE `id`='$id'");
        return $hasil;
    }

    function delete_berita($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}

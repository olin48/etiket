<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function edit_download($id, $judul, $isi, $image, $url)
    {
        $hasil = $this->db->query("UPDATE `ngulikode_download` SET 
                    `judul`='$judul', 
                    `isi`='$isi', 
                    `image`='$image',
                    `url`='$url' WHERE `id`='$id'");
        return $hasil;
    }

    function delete_download($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getSource($code = null)
    {
        if ($code === null) {
            return $this->db->get('ngulikode_download')->result_array();
        } else {
            return $this->db->get_where('ngulikode_download', ['code_gen' => $code])->result_array();
        }
    }

    public function updateCount($count, $id)
    {
        $hasil = $this->db->query("UPDATE `ngulikode_download` SET 
                    `count`='$count' WHERE `id`='$id'");
        return $hasil;
    }
}

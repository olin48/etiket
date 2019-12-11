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

    public function getBeritaSlide()
    {
        return $this->db->get('mob_berita', 5)->result_array();
    }

    public function getBerita()
    {
        return $this->db->get('mob_berita')->result_array();
    }

    public function getTiketEvent()
    {
        return $this->db->get('mob_tiket_event')->result_array();
    }

    public function getTiketEventDetail($id)
    {
        return $this->db->get_where('mob_kapasitas_tiket', array('jenis_tiket_cd' => "TIKETEVN", 'id_tiket' => $id))->result_array();
    }

    public function getTiketPertandingan()
    {
        return $this->db->get('mob_tiket_pertandingan')->result_array();
    }

    public function getTiketPertandinganDetail($id)
    {
        return $this->db->get_where('mob_kapasitas_tiket', array('jenis_tiket_cd' => "TIKETPTN", 'id_tiket' => $id))->result_array();;
    }
}

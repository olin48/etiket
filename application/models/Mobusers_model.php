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
        $table = $this->db->get('mob_tiket_event');
        $id = $table->row("id");
        $tipe_tiket = $this->db->get_where('mob_kapasitas_tiket', array('jenis_tiket_cd' => "TIKETEVN", 'id_tiket' => $id))->result_array();
        $data = [
            'id' => $id,
            'nama_event' => $table->row("nama_event"),
            'description' => $table->row("description"),
            'image' => $table->row("image"),
            'start_date' => $table->row("start_date"),
            'end_date' => $table->row("end_date"),
            'tanggal_event' => $table->row("tanggal_event"),
            'waktu_event' => $table->row("waktu_event"),
            'is_active' => $table->row("is_active"),
            'tipe_tiket' => $tipe_tiket
        ];

        return $data;
    }

    public function getTiketPertandingan()
    {
        $table = $this->db->get('mob_tiket_pertandingan');
        $id = $table->row("id");
        $tipe_tiket = $this->db->get_where('mob_kapasitas_tiket', array('jenis_tiket_cd' => "TIKETPTN", 'id_tiket' => $id))->result_array();
        $data = [
            'id' => $id,
            'nama_pertandingan' => $table->row("nama_pertandingan"),
            'club_name_satu' => $table->row("club_name_satu"),
            'club_logo_satu' => $table->row("club_logo_satu"),
            'club_name_dua' => $table->row("club_name_dua"),
            'club_logo_dua' => $table->row("club_logo_dua"),
            'tgl_tanding' => $table->row("tgl_tanding"),
            'jam_tanding' => $table->row("jam_tanding"),
            'is_active' => $table->row("is_active"),
            'tipe_tiket' => $tipe_tiket
        ];

        return $data;
    }
}

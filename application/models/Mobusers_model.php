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
        return $this->db->get_where('mob_kapasitas_tiket', array('jenis_tiket_cd' => "TIKETPTN", 'id_tiket' => $id))->result_array();
    }

    public function orderTiket($data)
    {
        $this->db->insert('mob_order_tiket', $data);
        return $this->db->affected_rows();
    }

    public function getDataOrder($invoice_code)
    {
        return $this->db->get_where('mob_order_tiket', array('invoice_code' => $invoice_code))->result_array();
    }

    public function getCountKapasitas($id, $kapasitas)
    {
        $hasil = $this->db->query("UPDATE `mob_kapasitas_tiket` SET `kapasitas`='$kapasitas' WHERE `id`='$id'");
        return $hasil;
    }

    public function getOrderTiket($id_user)
    {
        $query = "SELECT `mob_tiket_pertandingan`.`club_name_satu`,
                         `mob_tiket_pertandingan`.`club_name_dua`, 
                         `mob_tiket_pertandingan`.`tgl_tanding`, 
                         `mob_tiket_pertandingan`.`jam_tanding`,
                         `mob_order_tiket`.`invoice_code`, 
                         `mob_order_tiket`.`qty_order`, 
                         `mob_kapasitas_tiket`.`id` AS `id_kapasitas`,
                         `mob_kapasitas_tiket`.`tipe_tiket`, 
                         `mob_kapasitas_tiket`.`harga`, 
                         `mob_kapasitas_tiket`.`kapasitas`,
                         `mob_order_tiket`.`id` AS `id_order`,
                         `mob_order_tiket`.`total_bayar`, 
                         `mob_order_tiket`.`payment_method`,
                         `mob_order_tiket`.`status_order`
                  FROM `mob_order_tiket` 
                  JOIN `mob_tiket_pertandingan` 
                  ON `mob_order_tiket`.`id_tiket` = `mob_tiket_pertandingan`.`id` 
                  JOIN `mob_kapasitas_tiket` 
                  ON `mob_order_tiket`.`id_kapasitas` = `mob_kapasitas_tiket`.`id`
                  WHERE `mob_order_tiket`.`id_user` = $id_user";
        return $this->db->query($query)->result_array();
    }

    public function getOrderTiketDetail($id_order)
    {
        $query = "SELECT IF(`mob_order_tiket`.`jenis_tiket` = 'TIKETPTN', 'Tiket Pertandingan', 'Tiket Event') AS `jenis_tiket`,
                         `mob_generate_qr`.`id`,
                         `mob_generate_qr`.`qr_code`,
                         `mob_generate_qr`.`qr_image`,
                         `mob_generate_qr`.`status_scan`,
                         `mob_tiket_pertandingan`.`nama_pertandingan`,
                         `mob_tiket_pertandingan`.`club_name_satu`,
                         `mob_tiket_pertandingan`.`club_name_dua`
                FROM `mob_order_tiket` 
                JOIN `mob_generate_qr` 
                ON `mob_order_tiket`.`id` = `mob_generate_qr`.`id_order`
                JOIN `mob_tiket_pertandingan`
                ON `mob_order_tiket`.`id_tiket` = `mob_tiket_pertandingan`.`id`
                WHERE `mob_generate_qr`.`id_order` = $id_order";
        return $this->db->query($query)->result_array();
    }

    public function updateOrderTiketDetail($qr_code)
    {
        $hasil = $this->db->query("UPDATE `mob_generate_qr` SET `status_scan`='1' WHERE `qr_code`='$qr_code'");
        return $hasil;
    }

    public function getStatusBayar($id, $status, $method)
    {
        $hasil = $this->db->query("UPDATE `mob_order_tiket` SET `status_order`='$status', `payment_method`='$method' WHERE `id`='$id'");
        return $hasil;
    }
}

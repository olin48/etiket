<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiket_model extends CI_Model
{
    public function edit_tiket_event($id, $namaEvent, $isi, $image, $startEvent, $endEvent, $tanggalEvent, $waktuEvent, $status)
    {
        $hasil = $this->db->query(
            "UPDATE `mob_tiket_event` SET 
                `nama_event`='$namaEvent', 
                `description`='$isi',
                `image`='$image',
                `start_date`='$startEvent',
                `end_date`='$endEvent',
                `tanggal_event`='$tanggalEvent',
                `waktu_event`='$waktuEvent',
                `is_active`='$status' WHERE `id`='$id'"
        );
        return $hasil;
    }

    function delete_tiket_event($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_tiket_pertandingan($id, $namaPertandingan, $clubNameSatu, $logoClubSatu, $clubNameDua, $logoClubDua, $tglTanding, $jamTanding, $status)
    {
        $hasil = $this->db->query(
            "UPDATE `mob_tiket_pertandingan` SET 
                `nama_pertandingan`='$namaPertandingan', 
                `club_name_satu`='$clubNameSatu',
                `club_logo_satu`='$logoClubSatu',
                `club_name_dua`='$clubNameDua',
                `club_logo_dua`='$logoClubDua',
                `tgl_tanding`='$tglTanding',
                `jam_tanding`='$jamTanding',
                `is_active`='$status' WHERE `id`='$id'"
        );
        return $hasil;
    }

    function delete_tiket_pertandingan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_kapasitas($id, $jenisTiketCd, $jenisTiketName, $kegiatan, $tipeTiket, $banyakTiket, $hargaTiket, $status)
    {
        $hasil = $this->db->query(
            "UPDATE `mob_kapasitas_tiket` SET 
                `jenis_tiket_cd`='$jenisTiketCd', 
                `jenis_tiket_name`='$jenisTiketName',
                `id_tiket`='$kegiatan',
                `tipe_tiket`='$tipeTiket',
                `kapasitas`='$banyakTiket',
                `harga`='$hargaTiket',
                `is_active`='$status' WHERE `id`='$id'"
        );
        return $hasil;
    }

    function delete_kapasitas($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function orderTiketEvent()
    {
        $query = "SELECT if(`kapasitas_tiket`.`jenis_tiket_cd` = 'TIKETEVN', 'Tiket Event', 'Tiket Event') AS jenis_tiket,
        `kapasitas_tiket`.`tipe_tiket`,
        `kapasitas_tiket`.`kapasitas`,
        `mob_users`.`name`,
        `order_tiket`.`id`,
        `order_tiket`.`jenis_tiket`,
        `order_tiket`.`invoice_code`,
        `order_tiket`.`status_order`,
        `order_tiket`.`qty_order`,
        `order_tiket`.`total_bayar`,
        `order_tiket`.`payment_method`,
        `order_tiket`.`id_kapasitas`,
        `event`.`tanggal_event`,
        `event`.`waktu_event`
        FROM `mob_kapasitas_tiket` AS `kapasitas_tiket`
        JOIN `mob_order_tiket` AS `order_tiket`
        ON `kapasitas_tiket`.`id` = `order_tiket`.`id_kapasitas`
        JOIN `mob_users`
        ON `order_tiket`.`id_user` = `mob_users`.`id`
        JOIN `mob_tiket_event` AS `event`
        ON `order_tiket`.`id_tiket` = `event`.`id` AND `order_tiket`.`jenis_tiket` = `event`.`jenis_tiket`
        WHERE `order_tiket`.`status_order` = '1' OR `order_tiket`.`status_order` = '2' OR `order_tiket`.`status_order` = '3'";
        return $this->db->query($query)->result_array();
    }

    function orderTiketPertandingan()
    {
        $query = "SELECT if(`kapasitas_tiket`.`jenis_tiket_cd` = 'TIKETPTN', 'Tiket Pertandingan', 'Tiket Event') AS jenis_tiket,
        `kapasitas_tiket`.`tipe_tiket`,
        `kapasitas_tiket`.`kapasitas`,
        `mob_users`.`name`,
        `order_tiket`.`id`,
        `order_tiket`.`jenis_tiket`,
        `order_tiket`.`invoice_code`,
        `order_tiket`.`status_order`,
        `order_tiket`.`qty_order`,
        `order_tiket`.`total_bayar`,
        `order_tiket`.`payment_method`,
        `order_tiket`.`id_kapasitas`,
        `pertandingan`.`tgl_tanding`,
        `pertandingan`.`jam_tanding`
        FROM `mob_kapasitas_tiket` AS `kapasitas_tiket`
        JOIN `mob_order_tiket` AS `order_tiket`
        ON `kapasitas_tiket`.`id` = `order_tiket`.`id_kapasitas`
        JOIN `mob_users`
        ON `order_tiket`.`id_user` = `mob_users`.`id`
        JOIN `mob_tiket_pertandingan` AS `pertandingan`
        ON `order_tiket`.`id_tiket` = `pertandingan`.`id` AND `order_tiket`.`jenis_tiket` = `pertandingan`.`jenis_tiket`
        WHERE `order_tiket`.`status_order` = '1' OR `order_tiket`.`status_order` = '2' OR `order_tiket`.`status_order` = '3'";
        return $this->db->query($query)->result_array();
    }

    function edit_status_bayar($id)
    {
        $hasil = $this->db->query(
            "UPDATE `mob_order_tiket` SET 
                `status_order`='2' WHERE `id`='$id'"
        );
        return $hasil;
    }

    function cancle_status_bayar($id)
    {
        $hasil = $this->db->query(
            "UPDATE `mob_order_tiket` SET 
                `status_order`='3' WHERE `id`='$id'"
        );
        return $hasil;
    }

    function edit_quantity($id_kapasitas, $qty_order, $kapasitas)
    {
        $updateKapasitas = $kapasitas - $qty_order;
        $hasil = $this->db->query(
            "UPDATE `mob_kapasitas_tiket` SET 
                `kapasitas`= '$updateKapasitas' WHERE `id`='$id_kapasitas'"
        );
        return $hasil;
    }
}

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
}

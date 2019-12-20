<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('ciqrcode');
        $this->load->model('Tiket_model', 'tiket');
        $this->load->library('session');
        $this->load->helper('string');
        is_logged_in();
    }

    public function tiket_event()
    {
        $this->form_validation->set_rules('nama_event', 'Nama Event', 'required|trim');
        $this->form_validation->set_rules('isi_event', 'Description Event', 'required|trim');
        // $this->form_validation->set_rules('image', 'Attachment/ Image', 'required|trim');
        $this->form_validation->set_rules('start_event', 'Start Event', 'required|trim');
        $this->form_validation->set_rules('end_event', 'End Event', 'required|trim');
        $this->form_validation->set_rules('tanggal_event', 'Tanggal Event', 'required|trim');
        $this->form_validation->set_rules('waktu_event', 'Waktu Event', 'required|trim');
        $this->form_validation->set_rules('status_id', 'Status', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['mobevent'] = $this->db->get('mob_tiket_event')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('tiket/tiket_event', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/ckeditor_event');
        } else {
            $data = [
                'nama_event' => $this->input->post('nama_event'),
                'description' => $this->input->post('isi_event'),
                'image' => $this->_uploadImageEvent(),
                'start_date' => $this->input->post('start_event'),
                'end_date' => $this->input->post('end_event'),
                'tanggal_event' => $this->input->post('tanggal_event'),
                'waktu_event' => $this->input->post('waktu_event'),
                'is_active' => $this->input->post('status_id')
            ];
            $this->db->insert('mob_tiket_event', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data tiket event baru sukses!</div>');
            redirect('tiket/tiket_event');
        }
    }

    public function edit_tiket_event()
    {
        $id = $this->input->post('id');
        $namaEvent = $this->input->post('nama_event');
        $isi = $this->input->post('isi_event_' . $id);
        if (!empty($_FILES["image"]["name"])) {
            $this->_deleteImageEvent($this->input->post('old_image'));
            $image = $this->_uploadImageEvent();
        } else {
            $image = $this->input->post('old_image');
        }
        $startEvent = $this->input->post('start_event_' . $id);
        $endEvent = $this->input->post('end_event_' . $id);
        $tanggalEvent = $this->input->post('tanggal_event_' . $id);
        $waktuEvent = $this->input->post('waktu_event_' . $id);
        $status = $this->input->post('status_id');
        $this->tiket->edit_tiket_event($id, $namaEvent, $isi, $image, $startEvent, $endEvent, $tanggalEvent, $waktuEvent, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data tiket event sukses!</div>');
        redirect('tiket/tiket_event');
    }

    function delete_tiket_event($id, $image)
    {
        $where = array('id' => $id);
        if (!empty($_FILES["image"]["name"])) {
            $this->_deleteImageEvent($image);
        }
        $this->tiket->delete_tiket_event($where, 'mob_tiket_event');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data tiket event sukses!</div>');
        redirect('tiket/tiket_event');
    }

    public function tiket_pertandingan()
    {
        $this->form_validation->set_rules('nama_pertandingan', 'Nama Pertandingan', 'required|trim');
        $this->form_validation->set_rules('club_name_satu', 'Club Name', 'required|trim');
        $this->form_validation->set_rules('club_name_dua', 'Club Name Versus', 'required|trim');
        $this->form_validation->set_rules('tanggal_tanding', 'Tanggal Tanding', 'required|trim');
        $this->form_validation->set_rules('waktu_tanding', 'Waktu Tanding', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['mobpertandingan'] = $this->db->get('mob_tiket_pertandingan')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('tiket/tiket_pertandingan', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/js_pertandingan');
        } else {
            $data = [
                'nama_pertandingan' => $this->input->post('nama_pertandingan'),
                'club_name_satu' => $this->input->post('club_name_satu'),
                'club_logo_satu' => $this->_uploadImageClubSatu(),
                'club_name_dua' => $this->input->post('club_name_dua'),
                'club_logo_dua' => $this->_uploadImageClubDua(),
                'tgl_tanding' => $this->input->post('tanggal_tanding'),
                'jam_tanding' => $this->input->post('waktu_tanding'),
                'is_active' => $this->input->post('status_id')
            ];
            $this->db->insert('mob_tiket_pertandingan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data tiket pertandingan baru sukses!</div>');
            redirect('tiket/tiket_pertandingan');
        }
    }

    function delete_tiket_pertandingan($id, $logoClubSatu, $logoClubDua)
    {
        $where = array('id' => $id);
        if (!empty($_FILES["logo_club_satu"]["name"])) {
            $this->_deleteImageClubSatu($logoClubSatu);
        }
        if (!empty($_FILES["logo_club_dua"]["name"])) {
            $this->_deleteImageClubDua($logoClubDua);
        }
        $this->tiket->delete_tiket_pertandingan($where, 'mob_tiket_pertandingan');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data tiket pertandingan sukses!</div>');
        redirect('tiket/tiket_pertandingan');
    }

    public function edit_tiket_pertandingan()
    {
        $id = $this->input->post('id');
        $namaPertandingan = $this->input->post('nama_pertandingan');
        $clubNameSatu = $this->input->post('club_name_satu');
        if (!empty($_FILES["logo_club_satu"]["name"])) {
            $this->_deleteImageClubSatu($this->input->post('old_logo_club_satu'));
            $logoClubSatu = $this->_uploadImageClubSatu();
        } else {
            $logoClubSatu = $this->input->post('old_logo_club_satu');
        }
        $clubNameDua = $this->input->post('club_name_dua');
        if (!empty($_FILES["logo_club_dua"]["name"])) {
            $this->_deleteImageClubDua($this->input->post('old_logo_club_dua'));
            $logoClubDua = $this->_uploadImageClubDua();
        } else {
            $logoClubDua = $this->input->post('old_logo_club_dua');
        }
        $tglTanding = $this->input->post('tanggal_tanding_' . $id);
        $jamTanding = $this->input->post('waktu_tanding_' . $id);
        $status = $this->input->post('status_id');
        $this->tiket->edit_tiket_pertandingan($id, $namaPertandingan, $clubNameSatu, $logoClubSatu, $clubNameDua, $logoClubDua, $tglTanding, $jamTanding, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data tiket pertandingan sukses!</div>');
        redirect('tiket/tiket_pertandingan');
    }

    public function kapasitas()
    {
        $this->form_validation->set_rules('jenis_tiket', 'Jenis Tiket', 'required|trim');
        $this->form_validation->set_rules('tipe_tiket', 'Tipe Tiket', 'required|trim');
        $this->form_validation->set_rules('banyak_tiket', 'Banyak Tiket', 'required|trim');
        $this->form_validation->set_rules('harga_tiket', 'Harga Tiket', 'required|trim');
        $this->form_validation->set_rules('status_id', 'Status', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['kapasitas'] = $this->db->get('mob_kapasitas_tiket')->result_array();
            $data['event'] = $this->db->get('mob_tiket_event')->result_array();
            $data['pertandingan'] = $this->db->get('mob_tiket_pertandingan')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('tiket/kapasitas_tiket', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/js_kapasitas');
        } else {
            $jenisTiketCd = $this->input->post('jenis_tiket');
            if ($jenisTiketCd == "TIKETEVN") {
                $kegiatan = $this->input->post('id_tiket_event');
                $jenisTiketName = "Tiket Event";
            } else {
                $kegiatan = $this->input->post('id_tiket_pertandingan');
                $jenisTiketName = "Tiket Pertandingan";
            }
            $data = [
                'jenis_tiket_cd' => $jenisTiketCd,
                'jenis_tiket_name' => $jenisTiketName,
                'id_tiket' => $kegiatan,
                'tipe_tiket' => $this->input->post('tipe_tiket'),
                'kapasitas' => $this->input->post('banyak_tiket'),
                'harga' => $this->input->post('harga_tiket'),
                'is_active' => $this->input->post('status_id')
            ];

            $this->db->insert('mob_kapasitas_tiket', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data kapasitas & harga tiket baru sukses!</div>');
            redirect('tiket/kapasitas');
        }
    }

    public function order_tiket()
    {
        $data['order_tiket'] = $this->tiket->orderTiketPertandingan();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/breadcumb');
        $this->load->view('tiket/order_tiket', $data);
        $this->load->view('templates/footer');
        // $this->load->view('templates/js_kapasitas');
    }

    public function update_status_bayar($id, $id_kapasitas, $qty_order, $kapasitas, $generateCode)
    {
        $this->tiket->edit_status_bayar($id);
        $this->tiket->edit_quantity($id_kapasitas, $qty_order, $kapasitas);
        $codeQR = $generateCode . '-' . random_string('numeric', 5);
        $this->generate_qr($id, $codeQR);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Approve pembayaran sukses!</div>');
        redirect('tiket/order_tiket');
    }

    function generate_qr($id_order, $codeQR)
    {
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/generate/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $codeQR . '.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $codeQR; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = [
            'id_order' => $id_order,
            'qr_code' => $codeQR,
            'qr_image' => $image_name
        ];
        $this->db->insert('mob_generate_qr', $data);
        // redirect('mahasiswa'); //redirect ke mahasiswa usai simpan data
    }

    public function cancle_status_bayar($id)
    {
        $this->tiket->cancle_status_bayar($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Approve pembayaran sukses!</div>');
        redirect('tiket/order_tiket');
    }

    public function edit_kapasitas()
    {
        $id = $this->input->post('id');
        $jenisTiketCd = $this->input->post('jenis_tiket_' . $id);
        if ($jenisTiketCd == "TIKETEVN") {
            $kegiatan = $this->input->post('id_tiket_event_' . $id);
            $jenisTiketName = "Tiket Event";
        } else {
            $kegiatan = $this->input->post('id_tiket_pertandingan_' . $id);
            $jenisTiketName = "Tiket Pertandingan";
        }
        $tipeTiket = $this->input->post('tipe_tiket');
        $banyakTiket = $this->input->post('banyak_tiket');
        $hargaTiket = $this->input->post('harga_tiket');
        $status = $this->input->post('status_id');
        $this->tiket->edit_kapasitas($id, $jenisTiketCd, $jenisTiketName, $kegiatan, $tipeTiket, $banyakTiket, $hargaTiket, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data kapasitas & harga tiket sukses!</div>');
        redirect('tiket/kapasitas');
    }

    function delete_kapasitas($id)
    {
        $where = array('id' => $id);
        $this->tiket->delete_kapasitas($where, 'mob_kapasitas_tiket');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data kapasitas & harga tiket sukses!</div>');
        redirect('tiket/kapasitas');
    }

    private function _uploadImageEvent()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('His');

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/event/";
        $config['file_name'] = "upload_img_" . $now;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("image")) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        } else {
            $upload = array('upload_data' => $this->upload->data());
            return $upload['upload_data']['file_name'];
        }

        return "default.png";
    }

    private function _uploadImageClubSatu()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('His');

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/pertandingan/";
        $config['file_name'] = "logo_club_satu_" . $now;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("logo_club_satu")) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        } else {
            $upload = array('upload_data' => $this->upload->data());
            return $upload['upload_data']['file_name'];
        }

        return "default.png";
    }

    private function _uploadImageClubDua()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('His');

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/pertandingan/";
        $config['file_name'] = "logo_club_dua_" . $now;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("logo_club_dua")) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        } else {
            $upload = array('upload_data' => $this->upload->data());
            return $upload['upload_data']['file_name'];
        }

        return "default.png";
    }

    private function _deleteImageEvent($file)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/event/" . $file);
    }

    private function _deleteImageClubSatu($file)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/pertandingan/" . $file);
    }

    private function _deleteImageClubDua($file)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/pertandingan/" . $file);
    }
}

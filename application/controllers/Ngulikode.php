<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ngulikode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->load->model('view_users_model');
        $this->load->library('session');
        is_logged_in();
    }

    public function dashboard()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/breadcumb');
        $this->load->view('ngulikode/dashboard');
        $this->load->view('templates/footer');
    }

    private function _uploadImage()
    {
        date_default_timezone_set('Asia/Karachi');
        $now = date('His');

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . "/etiket/assets/uploads/ngulikode/";
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

    private function _deleteImage($file)
    {
        unlink($_SERVER['DOCUMENT_ROOT'] . "/etiket/assets/uploads/ngulikode/" . $file);
    }

    public function download()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('isi_download', 'Isi', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['download'] = $this->db->get('ngulikode_download')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('ngulikode/download', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/ckeditor_download');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi_download'),
                'url' => $this->input->post('url'),
                'image' => $this->_uploadImage(),
                'code_gen' => random_string('alnum', 5),
                'count' => 0
            ];

            $this->db->insert('ngulikode_download', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data users baru sukses!</div>');
            redirect('ngulikode/download');
        }
    }

    public function edit_download()
    {
        $id = $this->input->post('id');
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi_download_' . $id);
        if (!empty($_FILES["image"]["name"])) {
            $this->_deleteImage($this->input->post('old_image'));
            $image = $this->_uploadImage();
        } else {
            $image = $this->input->post('old_image');
        }
        $url = $this->input->post('url');
        $this->load->model('Download_model', 'download');
        $this->download->edit_download($id, $judul, $isi, $image, $url);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data source code sukses!</div>');
        redirect('ngulikode/download');
    }

    public function delete_download($id, $image)
    {
        $where = array('id' => $id);
        $this->_deleteImage($image);
        $this->load->model('Download_model', 'download');
        $this->download->delete_download($where, 'ngulikode_download');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data source code sukses!</div>');
        redirect('ngulikode/download');
    }
}

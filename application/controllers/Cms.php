<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Cms_model', 'cms');
        $this->load->library('session');
        is_logged_in();
    }

    public function mob_users()
    {
        $data['mobuser'] = $this->db->get('mob_users')->result_array();
        $data['role'] = $this->db->get('cms_user_role')->result_array();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/breadcumb');
        $this->load->view('cms/user_mobile', $data);
        $this->load->view('templates/footer');
    }

    public function edit_mob_users()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $phone = $this->input->post('phone');
        $status = $this->input->post('status_id');
        $this->cms->edit_mob_users($id, $name, $username, $email, $password, $phone, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data users sukses!</div>');
        redirect('cms/mob_users');
    }

    public function delete_mob_users($id)
    {
        $where = array('id' => $id);
        $this->cms->delete_mob_users($where, 'mob_users');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data users sukses!</div>');
        redirect('cms/mob_users');
    }

    public function mob_admins()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['mobadmin'] = $this->db->get('mob_admins')->result_array();
            $data['role'] = $this->db->get('cms_user_role')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('cms/admin_mobile', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'phone' => $this->input->post('phone'),
                'is_active' => $this->input->post('status_id'),
            ];

            $this->db->insert('mob_admins', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data admin baru sukses!</div>');
            redirect('cms/mob_admins');
        }
    }

    public function edit_mob_admins()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $status = $this->input->post('status_id');
        $this->cms->edit_mob_admins($id, $name, $username, $email, $password, $phone, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data admin sukses!</div>');
        redirect('cms/mob_admins');
    }

    public function delete_mob_admins($id)
    {
        $where = array('id' => $id);
        $this->cms->delete_mob_admins($where, 'mob_admins');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data admins sukses!</div>');
        redirect('cms/mob_admins');
    }

    private function _uploadImage()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('His');

        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/berita/";
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
        unlink($_SERVER['DOCUMENT_ROOT'] . "/assets/uploads/berita/" . $file);
    }

    public function berita()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['mobberita'] = $this->db->get('mob_berita')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('cms/post_berita', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/ckeditor_berita');
        } else {
            $data = [
                'judul' => $this->input->post('judul'),
                'isi' => $this->input->post('isi'),
                'image' => $this->_uploadImage(),
                'link' => $this->input->post('link')
            ];

            $this->db->insert('mob_berita', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data berita baru sukses!</div>');
            redirect('cms/berita');
        }
    }

    public function edit_berita()
    {
        $id = $this->input->post('id');
        $judul = $this->input->post('judul');
        $isi = $this->input->post('isi_' . $id);
        if (!empty($_FILES["image"]["name"])) {
            $this->_deleteImage($this->input->post('old_image'));
            $image = $this->_uploadImage();
        } else {
            $image = $this->input->post('old_image');
        }
        $link = $this->input->post('link');
        $this->cms->edit_berita($id, $judul, $isi, $image, $link);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data berta sukses!</div>');
        redirect('cms/berita');
    }

    public function delete_berita($id, $image)
    {
        $where = array('id' => $id);
        $this->_deleteImage($image);
        $this->cms->delete_berita($where, 'mob_berita');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data berita sukses!</div>');
        redirect('cms/berita');
    }
}

<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();

        $this->load->model('Mobusers_model', 'mob_users');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function register_post()
    {
        $data = [
            'name' => $this->post('name'),
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'password' => password_hash($this->post('password'), PASSWORD_DEFAULT),
            'phone' => $this->post('phone'),
            'is_active' => 1
        ];

        $check = $this->db->get_where(
            'mob_users',
            array(
                'username' => $this->post('username'),
                'email' => $this->post('email'),
                'phone' => $this->post('phone')
            )
        )->result_array();

        if ($check == null) {
            if ($this->mob_users->registerUsers($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Registrasi berhasil, Silahkan login'
                ], 200);
            } else {
                $this->response([
                    'status' => true,
                    'message' => 'Gagal'
                ], 201);
            }
        } else {
            $this->response([
                'status' => true,
                'message' => 'Gagal! User sudah tersedia, silahkan login.'
            ], 201);
        }
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        $user = $this->db->get_where('mob_users', ['username' => $username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = $this->db->get_where('mob_users', array('username' => $username))->result_array();
                $this->response([
                    'status' => true,
                    'data' => $data
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Password salah!'
                ], 201);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'User tidak ada'
            ], 201);
        }
    }

    public function berita_slide_get()
    {
        $source = $this->mob_users->getBeritaSlide();

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada berita!'
            ], 201);
        }
    }

    public function berita_get()
    {
        $source = $this->mob_users->getBerita();

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada berita!'
            ], 201);
        }
    }

    public function tiket_event_get()
    {
        $source = $this->mob_users->getTiketEvent();

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada berita!'
            ], 201);
        }
    }

    public function tiket_pertandingan_get()
    {
        $source = $this->mob_users->getTiketPertandingan();

        if ($source) {
            $this->response([
                'status' => true,
                'data' => [$source]
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada berita!'
            ], 201);
        }
    }
}

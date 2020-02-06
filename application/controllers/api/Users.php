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
                    'status' => false,
                    'message' => 'Gagal'
                ], 201);
            }
        } else {
            $this->response([
                'status' => false,
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

    public function login_admin_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        $user = $this->db->get_where('mob_admins', ['username' => $username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = $this->db->get_where('mob_admins', array('username' => $username))->result_array();
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
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function tiket_event_detail_get()
    {
        $id = $this->get('id_tiket');
        $source = $this->mob_users->getTiketEventDetail($id);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function tiket_pertandingan_get()
    {
        $source = $this->mob_users->getTiketPertandingan();

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function tiket_pertandingan_detail_get()
    {
        $id = $this->get('id_tiket');
        $source = $this->mob_users->getTiketPertandinganDetail($id);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function order_tiket_post()
    {
        $data = [
            'jenis_tiket' => $this->post('jenis_tiket'),
            'id_tiket' => $this->post('id_tiket'),
            'id_kapasitas' => $this->post('id_kapasitas'),
            'id_user' => $this->post('id_user'),
            'invoice_code' => $this->post('invoice_code'),
            'status_order' => "0",
            'qty_order' => $this->post('qty_order'),
            'total_bayar' => $this->post('total_bayar')
        ];

        $check = $this->db->get_where(
            'mob_order_tiket',
            array(
                'invoice_code' => $this->post('invoice_code')
            )
        )->result_array();

        if ($check == null) {
            if ($this->mob_users->orderTiket($data) > 0) {
                $source = $this->mob_users->getDataOrder($this->post('invoice_code'));
                $this->response([
                    'status' => true,
                    'data' => $source
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal'
                ], 201);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal, Terdapat duplikasi data order!'
            ], 201);
        }
    }

    public function count_kapasitas_put()
    {
        $id = $this->put('id');
        $kapasitas = $this->put('kapasitas');
        $source = $this->mob_users->getCountKapasitas($id, $kapasitas);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => 'Update berhasil!'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal update!'
            ], 201);
        }
    }

    public function list_order_tiket_get()
    {
        $id_user = $this->get('id_user');
        $source = $this->mob_users->getOrderTiket($id_user);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function dtl_order_pertandingan_get()
    {
        $id_user = $this->get('id_user');
        $id_order = $this->get('id_order');
        $source = $this->mob_users->getOrderPertandingan($id_user, $id_order);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function dtl_order_event_get()
    {
        $id_user = $this->get('id_user');
        $id_order = $this->get('id_order');
        $source = $this->mob_users->getOrderEvent($id_user, $id_order);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function list_order_dtl_event_get()
    {
        $id_order = $this->get('id_order');
        $source = $this->mob_users->getOrderTiketDtlEvent($id_order);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function list_order_dtl_pertandingan_get()
    {
        $id_order = $this->get('id_order');
        $source = $this->mob_users->getOrderTiketDtlPertandingan($id_order);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'tidak ada data!'
            ], 201);
        }
    }

    public function status_scan_put()
    {
        $qr_code = $this->put('qr_code');
        $check = $this->db->get_where('mob_generate_qr', array('qr_code' => $qr_code))->result_array();
        if ($check != null) {
            $checkStatus = $this->db->get_where('mob_generate_qr', array('qr_code' => $qr_code, 'status_scan' => '1'))->result_array();
            if ($checkStatus == null) {
                $source = $this->mob_users->updateOrderTiketDetail($qr_code);
                if ($source) {
                    $this->response([
                        'status' => true,
                        'data' => 'Scan barcode sukses!'
                    ], 200);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Scan barcode gagal!'
                    ], 201);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Barcode sudah pernah discan!'
                ], 201);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Barcode tidak ada didatabase!'
            ], 201);
        }
    }

    public function status_bayar_put()
    {
        $id = $this->put('id');
        $status = $this->put('status_order');
        $method = $this->put('payment_method');
        $source = $this->mob_users->getStatusBayar($id, $status, $method);

        if ($source) {
            $this->response([
                'status' => true,
                'data' => 'Pembayaran berhasil, admin akan segera memprosesnya!'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Pembayaran gagal!'
            ], 201);
        }
    }
}

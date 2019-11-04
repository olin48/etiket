<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Ngulikode extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->__resTraitConstruct();

        $this->load->model('Download_model', 'download');
        $this->load->model('Version_model', 'version');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function source_get()
    {
        $code = $this->get('code_gen');
        if ($code === null) {
            $source =  $this->download->getSource();
        } else {
            $source =  $this->download->getSource($code);
        }

        if ($source) {
            $this->response([
                'status' => true,
                'data' => $source
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Code yang anda masukan salah!'
            ], 400);
        }
    }

    public function source_put()
    {

        $id = $this->put('id');
        $data = [
            'count' => $this->put('count')
        ];

        if ($this->download->updateCount($data, $id) > 0) {
            $this->response([
                'status' => true,
                'data' => 'Update jumlah download sukses.'
            ], 200);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Update count gagal!'
            ], 400);
        }
    }

    public function apk_version_get()
    {
        $source =  $this->version->getVersion();
        $this->response([
            'status' => true,
            'data' => $source
        ], 200);
    }
}

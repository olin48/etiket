<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dev extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }

    public function users()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $data['user'] = $this->view_users_model->view_data()->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->model('Role_model', 'role');
            $data['user'] = $this->role->getRoleName();
            $data['role'] = $this->db->get('cms_user_role')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('users/dev', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('cms_user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data users baru sukses!</div>');
            redirect('dev/users');
        }
    }

    public function edit_users()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $role_id = $this->input->post('role_id');
        $status_id = $this->input->post('status_id');
        $this->load->model('Users_model', 'users');
        $this->users->edit_users($id, $name, $email, $role_id, $status_id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data users sukses!</div>');
        redirect('dev/users');
    }

    public function delete_users($id)
    {
        $where = array('id' => $id);
        $this->load->model('Users_model', 'users');
        $this->users->delete_users($where, 'cms_user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data users sukses!</div>');
        redirect('dev/users');
    }

    public function menu()
    {
        $data['title'] = 'Main Menu';
        $this->form_validation->set_rules('menu', 'Nama Menu', 'required');
        if ($this->form_validation->run() == false) {
            $data['menu'] = $this->db->get_where('cms_user_menu')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('menu/mainmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('cms_user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data menu baru sukses!</div>');
            redirect('dev/menu');
        }
    }

    public function edit_menu()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        $this->load->model('Menu_model', 'menu');
        $this->menu->edit_menu($id, $menu);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data menu sukses!</div>');
        redirect('dev/menu');
    }

    public function delete_menu($id)
    {
        $where = array('id' => $id);
        $this->load->model('Menu_model', 'menu');
        $this->menu->delete_menu($where, 'cms_user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data menu sukses!</div>');
        redirect('dev/menu');
    }

    public function submenu()
    {
        $this->form_validation->set_rules('menu_id', 'Main Menu', 'required');
        $this->form_validation->set_rules('submenu', 'Submenu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Submenu';
            $this->load->model('Menu_model', 'menu');
            $data['submenu'] = $this->menu->getSubMenu();
            $data['menu'] = $this->db->get('cms_user_menu')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu_id' => $this->input->post('menu_id'),
                'title' => $this->input->post('submenu'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('status_id')
            ];
            $this->db->insert('cms_user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan submenu sukses!</div>');
            redirect('dev/submenu');
        }
    }

    public function edit_submenu()
    {
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $submenu = $this->input->post('submenu');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('status_id');
        $this->load->model('Submenu_model', 'submenu');
        $this->submenu->edit_submenu($id, $menu_id, $submenu, $url, $icon, $is_active);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data submenu sukses!</div>');
        redirect('dev/submenu');
    }

    public function delete_submenu($id)
    {
        $where = array('id' => $id);
        $this->load->model('Submenu_model', 'submenu');
        $this->submenu->delete_submenu($where, 'cms_user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data submenu sukses!</div>');
        redirect('dev/submenu');
    }

    public function role_menu()
    {
        $this->form_validation->set_rules('role_id', 'Role Name', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu Name', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Role Akses Menu';
            $this->load->model('Role_model', 'role');
            $data['role'] = $this->role->getRoleId();
            $data['role_name'] = $this->db->get('cms_user_role')->result_array();
            $data['menu_name'] = $this->db->get('cms_user_menu')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('menu/rolemenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role_id' => $this->input->post('role_id'),
                'menu_id' => $this->input->post('menu_id')
            ];
            $this->db->insert('cms_user_access_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan role menu sukses!</div>');
            redirect('dev/role_menu');
        }
    }

    public function edit_role_menu()
    {
        $id = $this->input->post('id');
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');
        $this->load->model('Role_model', 'role');
        $this->role->edit_role_menu($id, $role_id, $menu_id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data role menu sukses!</div>');
        redirect('dev/role_menu');
    }

    public function delete_role_menu($id)
    {
        $where = array('id' => $id);
        $this->load->model('Role_model', 'role');
        $this->role->delete_role_menu($where, 'cms_user_access_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data role menu sukses!</div>');
        redirect('dev/role_menu');
    }

    public function role()
    {
        $data['title'] = 'Role User';
        $this->form_validation->set_rules('role', 'Role Name', 'required');
        if ($this->form_validation->run() == false) {
            $data['role'] = $this->db->get_where('cms_user_role')->result_array();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('templates/breadcumb');
            $this->load->view('menu/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('cms_user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penambahan data role baru sukses!</div>');
            redirect('dev/role');
        }
    }

    public function edit_role()
    {
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        $this->load->model('Role_model', 'role');
        $this->role->edit_role($id, $role);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data role sukses!</div>');
        redirect('dev/role');
    }

    public function delete_role($id)
    {
        $where = array('id' => $id);
        $this->load->model('Role_model', 'role');
        $this->role->delete_role($where, 'cms_user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data role sukses!</div>');
        redirect('dev/role');
    }
}

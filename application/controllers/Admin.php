<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('view_users_model');
		$this->load->helper('url');
		is_logged_in();
	}

	public function dashboard()
	{
		$email = $this->session->userdata('email');
		if ($email != null) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/breadcumb');
			$this->load->view('dashboard');
			$this->load->view('templates/footer');
		} else {
			redirect('auth');
		}
	}

	public function users()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$data['cms_user'] = $this->view_users_model->view_data()->result();

		if ($this->form_validation->run() == false) {
			$this->load->model('Role_model', 'role');
			$data['user'] = $this->role->getRoleName();
			$data['role'] = $this->role->getRoleAdmin();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/breadcumb');
			$this->load->view('users/admin', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role_id'),
				'is_active' => $this->input->post('status_id'),
				'date_created' => time()
			];

			$this->db->insert('cms_user', $data);

			redirect('admin/users');
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
		redirect('admin/users');
	}

	public function delete_users($id)
	{
		$where = array('id' => $id);
		$this->load->model('Users_model', 'users');
		$this->users->delete_users($where, 'cms_user');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data users sukses!</div>');
		redirect('dev/users');
	}

	public function admin_mobile()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$data['cms_admin'] = $this->view_users_model->admin_mobile_data()->result_array();

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('templates/breadcumb');
			$this->load->view('users/admin_mobile', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'phone' => $this->input->post('phone'),
				'is_active' => $this->input->post('status_id'),
				'register_date' => time()
			];

			$this->db->insert('mob_admins', $data);
			redirect('admin/admin_mobile');
		}
	}

	public function edit_admin_mobile($id)
	{
		$where = ['id' => $id];
		$data = "";
		if ($this->input->post('password1') != null) {
			$data = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'phone' => $this->input->post('phone'),
				'is_active' => $this->input->post('status_id'),
				'register_date' => time()
			];
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'is_active' => $this->input->post('status_id'),
				'register_date' => time()
			];
		}

		$this->view_users_model->edit_mob_admin($where, $data, 'mob_admins');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Perubahan data admin mobile sukses!</div>');
		redirect('admin/admin_mobile');
	}

	public function delete_mob_admin($id)
	{
		$where = array('id' => $id);
		$this->view_users_model->delete_mob_admin($where, 'mob_admins');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus data admin mobile sukses!</div>');
		redirect('admin/admin_mobile');
	}
}

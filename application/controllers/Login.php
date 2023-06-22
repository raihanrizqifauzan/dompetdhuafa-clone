<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct(Type $var = null) {
        parent::__construct();
    }

	public function index()
	{
        if($this->session->userdata('email_user')) {
            redirect(base_url('dashboard'));
        }
		$this->load->view('V_login');
	}

    public function proses() {
        if($this->session->userdata('email_user')) {
            redirect(base_url('dashboard'));
        }

        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $check = $this->db->query("SELECT * FROM tb_user where email_user = ? and password_user = ?", [$email, $password])->row();
        if (empty($check)) {
            $flashdata = ['notif_message' => "Gagal Login. Pastikan email dan password yang Anda ketik sudah benar", 'notif_icon' => "error"];
            $this->session->set_flashdata($flashdata);
            redirect(base_url('login'));
        }

        $session_set = [
            'email_user' => $email,
            'nama_user' => $check->nama_user
        ];
        $this->session->set_userdata($session_set);
        $flashdata = ['notif_message' => "Berhasil Login", 'notif_icon' => "success"];
        $this->session->set_flashdata($flashdata);
        redirect(base_url('dashboard'));
    }

	public function logout()
	{
        $this->session->sess_destroy();
        redirect(base_url('login'));
	}
}

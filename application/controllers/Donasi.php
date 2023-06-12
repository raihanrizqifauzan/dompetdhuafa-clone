<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donasi extends CI_Controller {
    public function __construct(Type $var = null) {
        parent::__construct();
        if(!$this->session->userdata('email_user')) {
            redirect(base_url('login'));
        }
    }


	public function list()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_donasi_list");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}
}

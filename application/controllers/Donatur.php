<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donatur extends CI_Controller {
    public function __construct(Type $var = null) {
        parent::__construct();
        $this->load->model(['M_donatur']);
        if(!$this->session->userdata('email_user')) {
            redirect(base_url('login'));
        }

        if ($this->session->userdata('role') != "data entry") {
            redirect(base_url());
        }
    }


	public function index()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_donatur");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

    public function get_list_donatur()
	{
        $filter = $this->input->post();
        // echo json_encode($filter);die;
		$list = $this->M_donatur->get_datatables_donatur($filter);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $row = [];

            $status = '<span class="badge bg-info">ACTIVE</span>';
            if ($item->status_donatur == "nonaktif") {
                $status = '<span class="badge bg-danger">INACTIVE</span>';
            }

            $item->no_hp = "+62".substr($item->no_hp, 1);
            $row[] = '<div class="text-center">'.$item->id_donatur.'</div>';
            $row[] = $item->nama_lengkap;
            $row[] = $item->no_hp;
            $row[] = $item->email_donatur;
            $row[] = $item->tipe_donatur;
            $row[] = '<div class="text-center">'.$status.'</div>';
            $row[] = '<div class="text-center mx-1"><a href="'.base_url('donatur/edit/').$item->id_donatur.'" class="edit-donatur"><i class="fa fa-edit text-primary"></i></a></div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_donatur->get_total_donatur($filter),
            "recordsFiltered" => $this->M_donatur->get_total_filtered_donatur($filter),
            "data" => $data,
        );

        echo json_encode($output);
	}

	public function new()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_donatur_add");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

    public function get_list_kota()
	{
        $search = $this->input->get('search', TRUE);
        $search = str_replace("%20", " ", $search);

        $list_kota = $this->M_donatur->getListKotaDonatur($search);

        $result = [];
        foreach ($list_kota as $key => $row) {
            $temp = [
                'id' => $row->id,
                'text' => "$row->nama_kecamatan, $row->nama_kabupaten_kota, $row->nama_provinsi",
            ];
            $result[] = $temp;
        }
        echo json_encode($result);
	}

    public function create()
	{
        $tipe_donatur = $this->input->post("tipe_donatur", TRUE);
        $kategori_prospek = $this->input->post("kategori_prospek", TRUE);
        $kategori_donatur = $this->input->post("kategori_donatur", TRUE);
        $notifikasi = $this->input->post("notifikasi", TRUE);
        $sapaan = $this->input->post("sapaan", TRUE);
        $nama_lengkap = $this->input->post("nama_lengkap", TRUE);
        $no_hp = $this->input->post("no_hp", TRUE);
        $no_hp2 = $this->input->post("no_hp2", TRUE);
        $email_donatur = $this->input->post("email_donatur", TRUE);
        $kota = $this->input->post("kota", TRUE);
        $kode_pos = $this->input->post("kode_pos", TRUE);
        $address = $this->input->post("address", TRUE);
        $no_identitas = $this->input->post("no_identitas", TRUE);
        $npwp = $this->input->post("npwp", TRUE);
        $npwz = $this->input->post("npwz", TRUE);
        $status_hidup = $this->input->post("status_hidup", TRUE);
        $status_donatur = $this->input->post("status_donatur", TRUE);
        $kode_rekening = $this->input->post("kode_rekening", TRUE);
        $terima_hard_copy = $this->input->post("terima_hard_copy", TRUE);
        $tgl_lahir = $this->input->post("tgl_lahir", TRUE);
        $pekerjaan = $this->input->post("pekerjaan", TRUE);
        $pendidikan_terakhir = $this->input->post("pendidikan_terakhir", TRUE);


        try {
            $list_tipe = ['individu', 'lembaga', 'komunitas'];
            if (!in_array($tipe_donatur, $list_tipe)) {
                throw new Exception("Tipe Donatur Invalid");
            }

            if ($kategori_prospek != "prospek" && $kategori_prospek != "non prospek") {
                throw new Exception("Kategori Donatur Invalid");
            }

            $list_required = ['sapaan', 'nama_lengkap', 'no_hp', 'no_hp2', 'email_donatur', 'kode_pos', 'address', 'no_identitas', 'npwp', 'npwz', 'tgl_lahir', 'pekerjaan'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
            }

            $list_sapaan = ['Bapak', 'Ibu', 'Mr.', 'Mrs.', 'Haji', 'Hajjah'];
            if (!in_array($sapaan, $list_sapaan)) {
                throw new Exception("Sapaan Invalid");
            }

            $data_kecamatan = $this->M_donatur->getKecamatanById($kota);
            if (empty($data_kecamatan)) {
                throw new Exception("Kota invalid !");
            }

            $data_donatur = [
                'tipe_donatur' => $tipe_donatur,
                'kategori_prospek' => $kategori_prospek,
                'kategori_donatur' => $kategori_donatur,
                'notifikasi' => json_encode($notifikasi),
                'sapaan' => $sapaan,
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'no_hp2' => $no_hp2,
                'email_donatur' => $email_donatur,
                'id_kota' => $kota,
                'provinsi' => $data_kecamatan->nama_provinsi,
                'kota' => $data_kecamatan->nama_kabupaten_kota,
                'kecamatan' => $data_kecamatan->nama_kecamatan,
                'kode_pos' => $kode_pos,
                'address' => $address,
                'no_identitas' => $no_identitas,
                'npwp' => $npwp,
                'npwz' => $npwz,
                'status_hidup' => $status_hidup,
                'status_donatur' => $status_donatur,
                'kode_rekening' => $kode_rekening,
                'terima_hard_copy' => $terima_hard_copy,
                'tgl_lahir' => $tgl_lahir,
                'pekerjaan' => $pekerjaan,
                'jenis_kelamin' => $jenis_kelamin,
                'pendidikan_terakhir' => $pendidikan_terakhir,
            ];

            $this->M_donatur->insertDonatur($data_donatur);
            $flashdata = ['notif_message' => "Donatur berhasil ditambahkan", 'notif_type' => "success"];
            $this->session->set_userdata('flashdata', $flashdata);
            $response = ['status' => true, 'message' => "Donatur berhasil ditambahkan"];
        } catch (Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);die;
	}

	public function edit($id_donatur = null)
	{
        $data_donatur = $this->M_donatur->getDonaturById($id_donatur);
        if (empty($data_donatur)) {
            $flashdata = ['notif_message' => "Donatur tidak ditemukan", 'notif_type' => "error"];
            $this->session->set_userdata('flashdata', $flashdata);
            redirect(base_url('donatur'));
        }
        $data['donatur'] = $data_donatur;
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_donatur_edit");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

    public function update()
	{
        $id_donatur = $this->input->post("id_donatur", TRUE);
        $tipe_donatur = $this->input->post("tipe_donatur", TRUE);
        $kategori_prospek = $this->input->post("kategori_prospek", TRUE);
        $kategori_donatur = $this->input->post("kategori_donatur", TRUE);
        $notifikasi = $this->input->post("notifikasi", TRUE);
        $sapaan = $this->input->post("sapaan", TRUE);
        $nama_lengkap = $this->input->post("nama_lengkap", TRUE);
        $no_hp = $this->input->post("no_hp", TRUE);
        $no_hp2 = $this->input->post("no_hp2", TRUE);
        $email_donatur = $this->input->post("email_donatur", TRUE);
        $kota = $this->input->post("kota", TRUE);
        $kode_pos = $this->input->post("kode_pos", TRUE);
        $address = $this->input->post("address", TRUE);
        $no_identitas = $this->input->post("no_identitas", TRUE);
        $npwp = $this->input->post("npwp", TRUE);
        $npwz = $this->input->post("npwz", TRUE);
        $status_hidup = $this->input->post("status_hidup", TRUE);
        $status_donatur = $this->input->post("status_donatur", TRUE);
        $kode_rekening = $this->input->post("kode_rekening", TRUE);
        $terima_hard_copy = $this->input->post("terima_hard_copy", TRUE);
        $tgl_lahir = $this->input->post("tgl_lahir", TRUE);
        $pekerjaan = $this->input->post("pekerjaan", TRUE);
        $jenis_kelamin = $this->input->post("jenis_kelamin", TRUE);
        $pendidikan_terakhir = $this->input->post("pendidikan_terakhir", TRUE);


        try {
            $donatur = $this->M_donatur->getDonaturById($id_donatur);
            if (empty($donatur)) {
                throw new Exception("Terjadi Kesalaham, Donatur tidak ditemukan");
            }

            $list_tipe = ['individu', 'lembaga', 'komunitas'];
            if (!in_array($tipe_donatur, $list_tipe)) {
                throw new Exception("Tipe Donatur Invalid");
            }

            if ($kategori_prospek != "prospek" && $kategori_prospek != "non prospek") {
                throw new Exception("Kategori Donatur Invalid");
            }

            $list_required = ['sapaan', 'nama_lengkap', 'no_hp', 'no_hp2', 'email_donatur', 'kode_pos', 'address', 'no_identitas', 'npwp', 'npwz', 'tgl_lahir', 'pekerjaan', 'jenis_kelamin'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
            }

            $list_sapaan = ['Bapak', 'Ibu', 'Mr.', 'Mrs.', 'Haji', 'Hajjah'];
            if (!in_array($sapaan, $list_sapaan)) {
                throw new Exception("Sapaan Invalid");
            }

            $data_kecamatan = $this->M_donatur->getKecamatanById($kota);
            if (empty($data_kecamatan)) {
                throw new Exception("Kota invalid !");
            }

            $data_donatur = [
                'tipe_donatur' => $tipe_donatur,
                'kategori_prospek' => $kategori_prospek,
                'kategori_donatur' => $kategori_donatur,
                'notifikasi' => json_encode($notifikasi),
                'sapaan' => $sapaan,
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'no_hp2' => $no_hp2,
                'email_donatur' => $email_donatur,
                'id_kota' => $kota,
                'provinsi' => $data_kecamatan->nama_provinsi,
                'kota' => $data_kecamatan->nama_kabupaten_kota,
                'kecamatan' => $data_kecamatan->nama_kecamatan,
                'kode_pos' => $kode_pos,
                'address' => $address,
                'no_identitas' => $no_identitas,
                'npwp' => $npwp,
                'npwz' => $npwz,
                'status_hidup' => $status_hidup,
                'status_donatur' => $status_donatur,
                'kode_rekening' => $kode_rekening,
                'terima_hard_copy' => $terima_hard_copy,
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'pekerjaan' => $pekerjaan,
                'pendidikan_terakhir' => $pendidikan_terakhir,
            ];

            $this->M_donatur->updateDonatur($id_donatur, $data_donatur);
            $flashdata = ['notif_message' => "Donatur berhasil di Update", 'notif_type' => "success"];
            $this->session->set_userdata('flashdata', $flashdata);
            $response = ['status' => true, 'message' => "Donatur berhasil diupdate"];
        } catch (Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);die;
	}

    function get_donatur_by_id() {
        $id_donatur = $this->input->get('id_donatur');

        $donatur = $this->M_donatur->getDonaturById($id_donatur);
        if (empty($donatur)) {
            $response = ['status' => false, 'message' => "Donatur tidak ditemukan"];
        } else {
            $response = ['status' => true, 'message' => "Success", 'data' => $donatur];
        }
        echo json_encode($response);
    }
}

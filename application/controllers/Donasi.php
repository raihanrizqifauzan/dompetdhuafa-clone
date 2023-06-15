<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donasi extends CI_Controller {
    public function __construct(Type $var = null) {
        parent::__construct();
        $this->load->model(['M_donatur', 'M_donasi']);
        if(!$this->session->userdata('email_user')) {
            redirect(base_url('login'));
        }
    }

	public function index() {
		redirect(base_url('donasi/list'));
	}


	public function list()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_donasi_list");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

	public function new_counter()
	{
        $data['list_jenis_donasi'] = $this->M_donasi->getJenisDonasi();
        $data['list_item_donasi'] = json_encode($this->M_donasi->getTempDonasi());
        $this->M_donasi->deleteTempItemDonasi();
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_counter_add");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}	

    public function get_list_donatur()
	{
		$list = $this->M_donatur->get_datatables_donatur();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $row = [];

            $prospek = '<span class="badge bg-warning">'.$item->kategori_prospek.'</span>';
            if ($item->kategori_prospek == "non prospek") {
                $prospek = '<span class="badge bg-danger">'.$item->kategori_prospek.'</span>';
            }

            $row[] = '<div class="text-center">'.$item->id_donatur.'</div>';
            $row[] = $item->nama_lengkap;
            $row[] = str_replace("08", "+62", $item->no_hp);
            $row[] = $item->email_donatur;
            $row[] = $item->kode_rekening;
            $row[] = "<span></span>";
            $row[] = "<span></span>";
            $row[] = '<div class="text-center">'.$prospek.'</div>';
            $row[] = '<div class="text-center mx-1">
			<a class="btn select-donatur" href="javascript:void(0)" data-id="'.$item->id_donatur.'">
				<i class="fa fa-check text-success"></i>
			</a>
			</div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_donatur->get_total_donatur(),
            "recordsFiltered" => $this->M_donatur->get_total_filtered_donatur(),
            "data" => $data,
        );

        echo json_encode($output);
	}

    public function get_program_donasi() {
        $id_jenis = $this->input->get('id', TRUE);
        $program_donasi = $this->M_donasi->getProgramDonasi($id_jenis);
        echo json_encode($program_donasi);
    }

    public function get_project_donasi() {
        $id_program = $this->input->get('id', TRUE);
        $project_donasi = $this->M_donasi->getProjectDonasi($id_program);
        echo json_encode($project_donasi);
    }

    public function save_temp_item() {
        $jenis_donasi = $this->input->post("jenis_donasi", TRUE);
        $program_donasi = $this->input->post("program_donasi", TRUE);
        $project_donasi = $this->input->post("project_donasi", TRUE);
        $tipe_donasi = $this->input->post("tipe_donasi", TRUE);
        $atas_nama = $this->input->post("atas_nama", TRUE);
        $kategori_barang = $this->input->post("kategori_barang", TRUE);
        $nama_barang = $this->input->post("nama_barang", TRUE);
        $jumlah_barang = $this->input->post("jumlah_barang", TRUE);
        $harga_satuan = $this->input->post("harga_satuan", TRUE);
        $nominal = $this->input->post("nominal", TRUE);
        $keterangan = $this->input->post("keterangan", TRUE);

        try {
            $list_required = ['jenis_donasi', 'program_donasi', 'project_donasi', 'tipe_donasi', 'atas_nama'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
            }

            if ($tipe_donasi == "barang") {
                if (empty($kategori_barang) || empty($nama_barang) || empty($jumlah_barang) || empty($harga_satuan)) {
                    throw new Exception("Kategori, Nama Barang, Qty, dan Harga harus diisi");
                } else if (!is_numeric($jumlah_barang) || $jumlah_barang < 1) {
                    throw new Exception("Jumlah Barang tidak valid");
                } else if (!is_numeric($harga_satuan) || $harga_satuan < 1) {
                    throw new Exception("Harga Satuan tidak valid");
                }
                $nominal = 0;
            } else {
                if (empty($nominal)) {
                    throw new Exception("Nominal Harus diisi");
                } else if (!is_numeric($nominal) || $nominal < 1) {
                    throw new Exception("Nominal tidak valid");
                }
                $kategori_barang = "";
                $nama_barang = "";
                $jumlah_barang = 0;
                $harga_satuan = 0;
            }

            $data_insert = [
                'id_jenis_donasi' => $jenis_donasi,
                'id_program_donasi' => $program_donasi,
                'id_project_donasi' => $project_donasi,
                'tipe_donasi' => $tipe_donasi,
                'atas_nama' => $atas_nama,
                'kategori_barang' => $kategori_barang,
                'nama_barang' => $nama_barang,
                'jumlah_barang' => $jumlah_barang,
                'harga_satuan' => $harga_satuan,
                'nominal' => $nominal,
                'keterangan' => $keterangan,
            ];

            $this->M_donasi->saveItem($data_insert);
            $data = $this->M_donasi->getTempDonasi();
            $response = ['status' => true, 'message' => "Item berhasil di tambahkan", 'data' => $data];
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update_temp_item() {
        $id_item = $this->input->post("id_item", TRUE);
        $jenis_donasi = $this->input->post("jenis_donasi", TRUE);
        $program_donasi = $this->input->post("program_donasi", TRUE);
        $project_donasi = $this->input->post("project_donasi", TRUE);
        $tipe_donasi = $this->input->post("tipe_donasi", TRUE);
        $atas_nama = $this->input->post("atas_nama", TRUE);
        $kategori_barang = $this->input->post("kategori_barang", TRUE);
        $nama_barang = $this->input->post("nama_barang", TRUE);
        $jumlah_barang = $this->input->post("jumlah_barang", TRUE);
        $harga_satuan = $this->input->post("harga_satuan", TRUE);
        $nominal = $this->input->post("nominal", TRUE);
        $keterangan = $this->input->post("keterangan", TRUE);

        try {
            $list_required = ['jenis_donasi', 'program_donasi', 'project_donasi', 'tipe_donasi', 'atas_nama'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
            }

            if ($tipe_donasi == "barang") {
                if (empty($kategori_barang) || empty($nama_barang) || empty($jumlah_barang) || empty($harga_satuan)) {
                    throw new Exception("Kategori, Nama Barang, Qty, dan Harga harus diisi");
                } else if (!is_numeric($jumlah_barang) || $jumlah_barang < 1) {
                    throw new Exception("Jumlah Barang tidak valid");
                } else if (!is_numeric($harga_satuan) || $harga_satuan < 1) {
                    throw new Exception("Harga Satuan tidak valid");
                }
                $nominal = 0;
            } else {
                if (empty($nominal)) {
                    throw new Exception("Nominal Harus diisi");
                } else if (!is_numeric($nominal) || $nominal < 1) {
                    throw new Exception("Nominal tidak valid");
                }
                $kategori_barang = "";
                $nama_barang = "";
                $jumlah_barang = 0;
                $harga_satuan = 0;
            }

            $data_update = [
                'id_jenis_donasi' => $jenis_donasi,
                'id_program_donasi' => $program_donasi,
                'id_project_donasi' => $project_donasi,
                'tipe_donasi' => $tipe_donasi,
                'atas_nama' => $atas_nama,
                'kategori_barang' => $kategori_barang,
                'nama_barang' => $nama_barang,
                'jumlah_barang' => $jumlah_barang,
                'harga_satuan' => $harga_satuan,
                'nominal' => $nominal,
                'keterangan' => $keterangan,
            ];

            $this->M_donasi->updateDonasi($id_item, $data_update);
            $data = $this->M_donasi->getTempDonasi();
            $response = ['status' => true, 'message' => "Item berhasil di tambahkan", 'data' => $data];
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function get_item_detail() {
        $id = $this->input->post("id", TRUE);
        $item_donasi = $this->M_donasi->getItemDonasiById($id);
        if (empty($item_donasi)) {
            echo json_encode(['status' => false, 'message' => "Data tidak ditemukan"]);
        } else {
            echo json_encode(['status' => true, 'message' => "Success get item", 'data' => $item_donasi]);
        }
    }

    public function delete_item() {
        $id = $this->input->post("id", TRUE);
        $item_donasi = $this->M_donasi->getItemDonasiById($id);
        if (empty($item_donasi)) {
            echo json_encode(['status' => false, 'message' => "Data tidak ditemukan"]);
        } else {
            $this->M_donasi->deleteItemDonasi($id);
            echo json_encode(['status' => true, 'message' => "Item berhasil dihapus"]);
        }
    }

    public function save_donasi() {
        $email_donatur = $this->input->post("email_donatur", TRUE);
        $tgl_donasi = $this->input->post("tgl_donasi", TRUE);
        $departemen = $this->input->post("departemen", TRUE);
        $jenis_pembayaran = $this->input->post("jenis_pembayaran", TRUE);
        $email_user = $this->session->email_user;

        try {
            $list_required = ['email_donatur', 'tgl_donasi', 'departemen', 'jenis_pembayaran'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
            }

            $temp_donasi = $this->M_donasi->getTempDonasi();
            if (empty($temp_donasi)) {
                throw new Exception("Item Donasi Harus diisi");
            }

            $item_donasi = [];
            $total_donasi = 0;
            foreach ($temp_donasi as $key => $item) {
                $item_donasi[] = [
                    'id_jenis_donasi' => $item->id_jenis_donasi,
                    'id_program_donasi' => $item->id_program_donasi,
                    'id_project_donasi' => $item->id_project_donasi,
                    'tipe_donasi' => $item->tipe_donasi,
                    'atas_nama' => $item->atas_nama,
                    'kategori_barang' => $item->kategori_barang,
                    'nama_barang' => $item->nama_barang,
                    'jumlah_barang' => $item->jumlah_barang,
                    'harga_satuan' => $item->harga_satuan,
                    'nominal' => $item->nominal,
                    'keterangan' => $item->keterangan,
                ];

                if ($item->tipe_donasi == "uang") {
                    $total_donasi += $item->nominal;
                } else {
                    $total_donasi += $item->jumlah_barang * $item->harga_satuan;
                }
            }

            $data_donasi = [
                'email_input' => $email_user,
                'datetime_create' => date("Y-m-d H:i:s"),
                'email_donatur' => $email_donatur,
                'departemen' => $departemen,
                'jenis_pembayaran' => $jenis_pembayaran,
                'tgl_donasi' => $tgl_donasi,
                'total_donasi' => $total_donasi,
            ];

            $id_donasi_inserted = $this->M_donasi->insertDonasi($data_donasi);
            if ($id_donasi_inserted === false) {
                throw new Exception("Gagal menyimpan data");
            }

            foreach ($item_donasi as $i => $item) {
                $item_donasi[$i]['id_donasi'] = $id_donasi_inserted;
            }
            $insert_detail_item = $this->M_donasi->insertBatchItemDonasi($item_donasi);

            $this->M_donasi->deleteTempItemDonasi();
            $flashdata = ['notif_message' => "Berhasil menyimpan data donasi", 'notif_type' => "success"];
            $this->session->set_userdata('flashdata', $flashdata);

            $data_donasi['list_item'] = $item_donasi;

            $response = ['status' => true, 'message' => "Donasi berhasil di tambahkan", 'data' => $data_donasi];
            echo json_encode($response);
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}

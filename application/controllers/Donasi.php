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
			$this->db->trans_start();
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

            $data_donatur = $this->M_donatur->getDonaturByEmail($email_donatur);
            if (empty($data_donatur)) {
                throw new Exception("Email donatur tidak valid");
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

            $data_log_notifikasi = [
                'id_donasi' => $id_donasi_inserted,
                'keterangan' => "Pengiriman Whatsapp ke Nomor $data_donatur->no_hp Berhasil",
                'datetime_notifikasi' => date("Y-m-d H:i:s"),
                'email_notifikasi' => $email_donatur,
                'no_hp' => $data_donatur->no_hp,
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($data_log_notifikasi, 'tb_log_notifikasi');

            $data_log_donasi = [
                'id_donasi' => $id_donasi_inserted,
                'datetime_action' => date("Y-m-d H:i:s"),
                'email_user' => $email_user,
                'keterangan' => "Membuat Donasi via Konter"
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($data_log_donasi, 'tb_donasi_log');

            $this->db->trans_commit();
            $this->M_donasi->deleteTempItemDonasi();
            $flashdata = ['notif_message' => "Berhasil menyimpan data donasi", 'notif_type' => "success"];
            $this->session->set_userdata('flashdata', $flashdata);

            $data_donasi['list_item'] = $item_donasi;
            $data_donasi['redirect_url'] = base_url('donasi/detail?id=').base64_encode($id_donasi_inserted);

            $response = ['status' => true, 'message' => "Donasi berhasil di tambahkan", 'data' => $data_donasi];
            echo json_encode($response);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

	public function counter_list()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_counter_list.php");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}	

	public function detail()
	{
        $data['list_jenis_donasi'] = $this->M_donasi->getJenisDonasi();
        $id_donasi = $this->input->get('id');
        $id_donasi = base64_decode($id_donasi);
        $data['donasi'] = $this->M_donasi->getDonasiById($id_donasi);
        if (empty($data['donasi'])) {
            redirect(base_url('donasi/counter/list'));
        }

        $data['log_donasi'] = $this->M_donasi->getDonasiLog($id_donasi);
        $data['log_notifikasi'] = $this->M_donasi->getLogNotifikasi($id_donasi);
        $data['list_item_donasi'] = json_encode($this->M_donasi->getDonasiItem($id_donasi));
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_counterdonasi_detail");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}	


    public function get_counter_list()
	{
        $status = $this->input->post('status');
		$list = $this->M_donasi->get_datatables_counter($status);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $row = [];
            if ($item->status_donasi == "request_void") {
                $color_badge = "bg-warning";
            } else if ($item->status_donasi == "settle") {
                $color_badge = "bg-success";
            } else {
                $color_badge = "bg-primary";
            }

            $btn_delete = "";
            if ($item->status_donasi != "settle" && $item->status_donasi != "request_void") {
                $btn_delete = '
                <div class="mx-1">
                    <a class="btn btn-danger void_donasi" data-id="'.$item->id.'">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>';
            }

            $row[] = '<div class="text-center">'.$item->id.'</div>';
            $row[] = $item->tgl_donasi;
            $row[] = strtoupper($item->nama_lengkap);
            $row[] = '<div class="text-center"><span class="badge '.$color_badge.'">'.strtoupper($item->status_donasi).'</span></div>';
            $row[] = '<div class="text-center">COUNTER</div>';
            $row[] = "<span>BRANCH TEST 001</span>";
            $row[] = "<span></span>";
            $row[] = '<div class="text-end">'.$item->jumlah_item_donasi.'</div>';
            $row[] = '<div class="text-end">Rp'.number_format($item->total_donasi).'</div>';
            $row[] = '<div class="d-flex justify-content-center text-center mx-1">
                <div>
                    <a class="btn btn-default" href="'.base_url('donasi/detail?id=').base64_encode($item->id).'" data-id="'.$item->id.'">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
                '.$btn_delete.'
			</div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_donasi->get_total_counter(),
            "recordsFiltered" => $this->M_donasi->get_total_counter_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
	}

    function update_email_donatur() {
        $id_donatur = $this->input->post('id_donatur', TRUE);
        $id_donasi = $this->input->post('id_donasi', TRUE);
        $email_user = $this->session->email_user;

        $donatur = $this->M_donatur->getDonaturById($id_donatur);
        $donasi = $this->M_donasi->getDonasiById($id_donasi);
        try {
            if (empty($donatur)) {
                throw new Exception("Donatur tidak ditemukan");
            }

            if (empty($donasi)) {
                throw new Exception("Terjadi Kesalahan");
            }

            $data_donasi = ['email_donatur' => $donatur->email_donatur];
            $this->M_donasi->updateData($id_donasi, $data_donasi);

            $log_donasi = [
                'id_donasi' => $id_donasi,
                'datetime_action' => date("Y-m-d H:i:s"),
                'email_user' => $email_user,
                'keterangan' => "Memperbarui donatur dari donasi dengan ID $id_donasi",
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($log_donasi, 'tb_donasi_log');

            $response = ['status' => true, 'message' => "Sukses mengganti donatur", 'data' => $donatur];
        } catch (Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);
    }

    public function update_item_donasi() {
        $id_donasi = $this->input->post("id_donasi", TRUE);
        $list_item = $this->input->post("list_item", TRUE);

        try {
			$this->db->trans_start();
            $donasi = $this->M_donasi->getDonasiById($id_donasi);
            if (empty($donasi)) {
                throw new Exception("Error Processing Request");
            }

            $total_donasi = $donasi->total_donasi;

            $item_insert = [];
            $item_update = [];
            // echo json_encode($list_item);die;
            $total_donasi_update = 0;
            foreach ($list_item as $key => $item) {
                if ($item['tipe_donasi'] == "barang") {
                    $item['nominal'] = 0;
                } else {
                    $item['kategori_barang'] = "";
                    $item['nama_barang'] = "";
                    $item['jumlah_barang'] = 0;
                    $item['harga_satuan'] = 0;
                }

                

                if ($item['tipe_donasi'] == "uang") {
                    $total_donasi_update += $item['nominal'];
                } else {
                    $total_donasi_update += $item['jumlah_barang'] * $item['harga_satuan'];
                }

                if (!is_numeric($item['id'])) {
                    $item_insert[] = [
                        'id_donasi' => $item['id_donasi'],
                        'id_jenis_donasi' => $item['id_jenis_donasi'],
                        'id_program_donasi' => $item['id_program_donasi'],
                        'id_project_donasi' => $item['id_project_donasi'],
                        'tipe_donasi' => $item['tipe_donasi'],
                        'atas_nama' => $item['atas_nama'],
                        'kategori_barang' => $item['kategori_barang'],
                        'nama_barang' => $item['nama_barang'],
                        'jumlah_barang' => $item['jumlah_barang'],
                        'harga_satuan' => $item['harga_satuan'],
                        'nominal' => $item['nominal'],
                        'keterangan' => $item['keterangan'],
                    ];
                } else {
                    $item_update = [
                        'id_jenis_donasi' => $item['id_jenis_donasi'],
                        'id_program_donasi' => $item['id_program_donasi'],
                        'id_project_donasi' => $item['id_project_donasi'],
                        'tipe_donasi' => $item['tipe_donasi'],
                        'atas_nama' => $item['atas_nama'],
                        'kategori_barang' => $item['kategori_barang'],
                        'nama_barang' => $item['nama_barang'],
                        'jumlah_barang' => $item['jumlah_barang'],
                        'harga_satuan' => $item['harga_satuan'],
                        'nominal' => $item['nominal'],
                        'keterangan' => $item['keterangan'],
                    ];
                    $this->M_donasi->updateItemDonasi($item['id'], $item_update);
                }
            }

            if (count($item_insert) > 0) {
                $this->M_donasi->insertBatchItemDonasi($item_insert);
            }

            if ($total_donasi != $total_donasi_update) {
                throw new Exception("Nominal donasi tidak match !");
            }

			$this->db->trans_commit();
            $response = ['status' => true, 'message' => "Item berhasil di ubah"];

            echo json_encode($response);
        } catch (Exception $e) {
			$this->db->trans_rollback();
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    function update_departemen() {
        $departemen = $this->input->post('departemen', TRUE);
        $id_donasi = $this->input->post('id_donasi', TRUE);
        $email_user = $this->session->email_user;

        $donasi = $this->M_donasi->getDonasiById($id_donasi);
        try {
            if (empty($donasi)) {
                throw new Exception("Terjadi Kesalahan");
            }

            $data_donasi = ['departemen' => $departemen];
            $this->M_donasi->updateData($id_donasi, $data_donasi);

            $log_donasi = [
                'id_donasi' => $id_donasi,
                'datetime_action' => date("Y-m-d H:i:s"),
                'email_user' => $email_user,
                'keterangan' => "Memperbarui departemen dari donasi dengan ID $id_donasi",
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($log_donasi, 'tb_donasi_log');

            $response = ['status' => true, 'message' => "Sukses memperbarui departemen"];
        } catch (Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);
    }

    function counter_collect() {
        $data['list_collector'] = $this->M_donasi->getListCollector();
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_counter_collect.php");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
    }

    function request_void() {
        $id_donasi = $this->input->post('id_donasi', TRUE);
        $keterangan = $this->input->post('keterangan', TRUE);
        $email_user = $this->session->email_user;

        $donasi = $this->M_donasi->getDonasiById($id_donasi);
        try {
            if (empty($donasi)) {
                throw new Exception("Terjadi Kesalahan");
            }

            if (empty($keterangan)) {
                throw new Exception("Keterangan wajib diisi");
            }

            $data_donasi = ['keterangan_void' => $keterangan, 'status_donasi' => 'request_void'];
            $this->M_donasi->updateData($id_donasi, $data_donasi);

            $log_donasi = [
                'id_donasi' => $id_donasi,
                'datetime_action' => date("Y-m-d H:i:s"),
                'email_user' => $email_user,
                'keterangan' => "Meminta pembatalan doansi",
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($log_donasi, 'tb_donasi_log');

            $response = ['status' => true, 'message' => "Sukses melakukan permintaan pembatalan donasi"];
        } catch (Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);
    }


    public function get_counter_collect()
	{
        $status = $this->input->post('status');
		$list = $this->M_donasi->get_datatables_counter($status);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key => $item) {
            $row = [];

            $no = $key+1;
            $row[] = '<div class="text-center">'.$no.'</div>';
            $row[] = $item->id;
            $row[] = strtoupper($item->nama_lengkap);
            $row[] = '<div class="text-end">'.$item->jumlah_item_donasi.'</div>';
            $row[] = '<div class="text-center">'.$item->jenis_pembayaran.'</div>';
            $row[] = '<div class="text-end">Rp'.number_format($item->total_donasi).'</div>';
            $row[] = '<div class="text-center">'.date("d-m-Y", strtotime($item->tgl_donasi)).'</div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_donasi->get_total_counter($status),
            "recordsFiltered" => $this->M_donasi->get_total_counter_filtered($status),
            "data" => $data,
        );

        echo json_encode($output);
	}

    function get_collector_by_id() {
        $id_collector = $this->input->get('id_collector');

        $collector = $this->M_donasi->getCollectorById($id_collector);
        if (empty($collector)) {
            $response = ['status' => false, 'message' => "Collector tidak ditemukan"];
        } else {
            $response = ['status' => true, 'message' => "Success", 'data' => $collector];
        }
        echo json_encode($response);
    }

    function request_collect() {
        // $id_donasi = $this->input->post('id_donasi', TRUE);
        // $keterangan = $this->input->post('keterangan', TRUE);
        $email_user = $this->session->email_user;

        $list_donasi = $this->M_donasi->getDonasiByStatus("draft");
        try {
            if (empty($list_donasi)) {
                throw new Exception("Tidak ada data");
            }

            foreach ($list_donasi as $key => $donasi) {
                $id_donasi = $donasi->id;
                $data_donasi = ['status_donasi' => 'collect'];
                $this->M_donasi->updateData($id_donasi, $data_donasi);

                $log_donasi = [
                    'id_donasi' => $id_donasi,
                    'datetime_action' => date("Y-m-d H:i:s"),
                    'email_user' => $email_user,
                    'keterangan' => "Mengubah status donasi menjadi Collect",
                ];
                $insert_log_notifikasi = $this->M_donasi->insertLog($log_donasi, 'tb_donasi_log');
            }
            $response = ['status' => true, 'message' => "Sukses mengubah status donasi"];
        } catch (Exception $e) {
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);
    }

    function counter_rekapan() {
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_counter_rekapan.php");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
    }
}

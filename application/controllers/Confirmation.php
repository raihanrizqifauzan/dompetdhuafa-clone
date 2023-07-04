<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirmation extends CI_Controller {
    public function __construct(Type $var = null) {
        parent::__construct();
        if(!$this->session->userdata('email_user')) {
            redirect(base_url('login'));
        }

        $this->load->model(['M_donatur', 'M_donasi', 'M_konfirmasi']);

        if ($this->session->userdata('role') != "data entry") {
            redirect(base_url());
        }
    }

	public function index()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_konfirmasi");
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
            redirect(base_url('confirmation'));
        }

        $data['list_item_donasi'] = json_encode($this->M_donasi->getDonasiItem($id_donasi));
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_konfirmasi_edit");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

    public function new()
	{
        $data['list_jenis_donasi'] = $this->M_donasi->getJenisDonasi();
        $data['list_item_donasi'] = json_encode($this->M_donasi->getTempDonasi());
        $this->M_donasi->deleteTempItemDonasi();
        
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_konfirmasi_add");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

	public function get_donasi_list()
	{
        $filter = $this->input->post();
		$list = $this->M_konfirmasi->get_datatables_donasi($filter);
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

            $row[] = '<div class="text-center">'.$item->nama_user.'</div>';
            $row[] = '<div class="text-center">'.$item->id.'</div>';
            $row[] = $item->tgl_donasi;
            $row[] = strtoupper($item->nama_lengkap);
            $row[] = '<div class="text-center">BANK</div>';
            $row[] = "<span>$item->bank_pengirim</span>";
            $row[] = "<span>$item->no_rek_pengirim</span>";
            $row[] = '<div class="d-flex justify-content-center text-center mx-1">
                <div>
                    <a class="btn btn-default" href="'.base_url('confirmation/detail?id=').base64_encode($item->id).'" data-id="'.$item->id.'">
                        <i class="fa fa-eye"></i>
                    </a>
					<a class="btn btn-delete btn-danger" href="javascript:void(0)" data-id="'.$item->id.'">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
			</div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_konfirmasi->get_total_donasi($filter),
            "recordsFiltered" => $this->M_konfirmasi->get_total_donasi_filtered($filter),
            "data" => $data,
        );

        echo json_encode($output);
	}

    public function get_list_bank()
	{
        $search = $this->input->get('search', TRUE);
        $search = str_replace("%20", " ", $search);

        $list_bank = $this->M_konfirmasi->getListBank($search);

        $result = [];
        foreach ($list_bank as $key => $row) {
            $temp = [
                'id' => $row->id_bank,
                'text' => $row->nama_bank,
            ];
            $result[] = $temp;
        }
        echo json_encode($result);
	}

    public function get_kode_rekening()
	{
		$id_bank = $this->input->get('bank');
        $search = $this->input->get('search', TRUE);
        $search = str_replace("%20", " ", $search);

        $data_bank = $this->M_konfirmasi->getDetailBank($id_bank);

        $result = [];
		$list_kode_rekening = json_decode($data_bank->kode_rekening, TRUE);
        foreach ($list_kode_rekening as $key => $row) {
			if (empty($search) || strpos($row, $search) !== false) {
				$temp = [
					'id' => $row,
					'text' => $row,
				];
				$result[] = $temp;
			}
        }
        echo json_encode($result);
	}

	public function save_donasi() {
        $email_donatur = $this->input->post("email_donatur", TRUE);
        $tgl_donasi = $this->input->post("tgl_donasi", TRUE);
        $departemen = $this->input->post("departemen", TRUE);
        $bank_tujuan = $this->input->post("bank_tujuan", TRUE);
        $kode_rekening = $this->input->post("kode_rekening", TRUE);
        $bank_pengirim = $this->input->post("bank_pengirim", TRUE);
        $atas_nama_pengirim = $this->input->post("atas_nama_pengirim", TRUE);
        $keterangan_donasi = $this->input->post("keterangan_donasi", TRUE);
        $jenis_pembayaran = "bank";
        $email_user = $this->session->email_user;

        try {
			$this->db->trans_start();
            $list_required = ['email_donatur', 'tgl_donasi', 'departemen', 'bank_tujuan', 'kode_rekening', 'bank_pengirim', 'atas_nama_pengirim', 'keterangan_donasi'];

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
			
			$data_bank = $this->M_konfirmasi->getDetailBank($bank_tujuan);
			if (empty($data_bank)) {
                throw new Exception("Bank tujuan tidak valid");
			}
			$id_bank_tujuan = $data_bank->id_bank;
			$bank_tujuan = $data_bank->nama_bank;

			$data_bank = $this->M_konfirmasi->getDetailBank($bank_pengirim);
			if (empty($data_bank)) {
                throw new Exception("Bank pengirim tidak valid");
			}
			$id_bank_pengirim = $data_bank->id_bank;
			$bank_pengirim = $data_bank->nama_bank;

			// Start Bukti TF
			if (!isset($_FILES['bukti_tf']) || empty($_FILES['bukti_tf']['name'])) {
				$nama_file_bukti = "";
			} else {
				$file_name = $_FILES['bukti_tf']['name'];
				$file_tmp = $_FILES['bukti_tf']['tmp_name'];
				$imageFileType = pathinfo($file_name, PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'JPG', 'JPEG', 'jpeg', 'PNG', 'png');
				$ukuran  = $_FILES['bukti_tf']['size'];

				if (!in_array($imageFileType, $allowed_extension)) {
					throw new Exception("Ekstensi gambar bukti transfer harus jpg/png");
				} else if ($ukuran > 2048576) {
					throw new Exception("Ukuran gambar bukti transfer  maksimal ukuran 2 mb");
				}

				$document_root = $this->get_document_root();
				$nama_file_bukti = time().".$imageFileType";
				if (!move_uploaded_file($file_tmp, "$document_root/user-uploads/bukti-tf-konfirmasi/$nama_file_bukti")) {
					throw new Exception("Gambar gagal diupload");
				} 
			}
			// End Field Bukti TF
			if (empty($nama_file_bukti)) {
                throw new Exception("Bukti Transfer harus diisi");
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

                $total_donasi += $item->nominal;
            }

            $data_donasi = [
                'email_input' => $email_user,
                'datetime_create' => date("Y-m-d H:i:s"),
                'email_donatur' => $email_donatur,
                'departemen' => $departemen,
                'jenis_pembayaran' => $jenis_pembayaran,
                'tgl_donasi' => $tgl_donasi,
                'id_bank_tujuan' => $id_bank_tujuan,
                'bank_tujuan' => $bank_tujuan,
                'kode_rekening' => $kode_rekening,
                'id_bank_pengirim' => $id_bank_pengirim,
                'bank_pengirim' => $bank_pengirim,
                'atas_nama_pengirim' => $atas_nama_pengirim,
                'no_rek_pengirim' => $no_rek_pengirim,
                'keterangan_donasi' => $keterangan_donasi,
				'bukti_tf' => $nama_file_bukti,
                'total_donasi' => $total_donasi,
				'tipe' => 'bank'
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
            $data_donasi['redirect_url'] = base_url('confirmation/detail?id=').base64_encode($id_donasi_inserted);

            $response = ['status' => true, 'message' => "Donasi berhasil di tambahkan", 'data' => $data_donasi];
            echo json_encode($response);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

	public function update_donasi() {
        $id_donasi = $this->input->post("id_donasi", TRUE);
        $email_donatur = $this->input->post("email_donatur", TRUE);
        $tgl_donasi = $this->input->post("tgl_donasi", TRUE);
        $departemen = $this->input->post("departemen", TRUE);
        $bank_tujuan = $this->input->post("bank_tujuan", TRUE);
        $kode_rekening = $this->input->post("kode_rekening", TRUE);
        $bank_pengirim = $this->input->post("bank_pengirim", TRUE);
        $atas_nama_pengirim = $this->input->post("atas_nama_pengirim", TRUE);
        $keterangan_donasi = $this->input->post("keterangan_donasi", TRUE);
        $no_rek_pengirim = $this->input->post("no_rek_pengirim", TRUE);
        $list_item = json_decode($this->input->post("list_item", TRUE), TRUE);
        $delete_item = json_decode($this->input->post("delete_item", TRUE), TRUE);
        $jenis_pembayaran = "bank";
        $email_user = $this->session->email_user;

        try {
			$this->db->trans_start();
			$data_donasi = $this->M_donasi->getDonasiById($id_donasi);
			if (empty($data_donasi)) {
				throw new Exception("Donasi tidak ditemukan");
			}

            $list_required = ['email_donatur', 'tgl_donasi', 'departemen', 'bank_tujuan', 'kode_rekening', 'bank_pengirim', 'atas_nama_pengirim', 'keterangan_donasi'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
            }

            if (empty($list_item)) {
                throw new Exception("Item Donasi Harus diisi");
            }

            $data_donatur = $this->M_donatur->getDonaturByEmail($email_donatur);
            if (empty($data_donatur)) {
                throw new Exception("Email donatur tidak valid");
            }
			
			$data_bank = $this->M_konfirmasi->getDetailBank($bank_tujuan);
			if (empty($data_bank)) {
                throw new Exception("Bank tujuan tidak valid");
			}
			$id_bank_tujuan = $data_bank->id_bank;
			$bank_tujuan = $data_bank->nama_bank;

			$data_bank = $this->M_konfirmasi->getDetailBank($bank_pengirim);
			if (empty($data_bank)) {
                throw new Exception("Bank pengirim tidak valid");
			}
			$id_bank_pengirim = $data_bank->id_bank;
			$bank_pengirim = $data_bank->nama_bank;

			// Start Bukti TF
			if (!isset($_FILES['bukti_tf']) || empty($_FILES['bukti_tf']['name'])) {
				$nama_file_bukti = "";
			} else {
				$file_name = $_FILES['bukti_tf']['name'];
				$file_tmp = $_FILES['bukti_tf']['tmp_name'];
				$imageFileType = pathinfo($file_name, PATHINFO_EXTENSION);
				$allowed_extension = array('jpg', 'JPG', 'JPEG', 'jpeg', 'PNG', 'png');
				$ukuran  = $_FILES['bukti_tf']['size'];

				if (!in_array($imageFileType, $allowed_extension)) {
					throw new Exception("Ekstensi gambar bukti transfer harus jpg/png");
				} else if ($ukuran > 2048576) {
					throw new Exception("Ukuran gambar bukti transfer  maksimal ukuran 2 mb");
				}

				$document_root = $this->get_document_root();
				$nama_file_bukti = time().".$imageFileType";
				if (!move_uploaded_file($file_tmp, "$document_root/user-uploads/bukti-tf-konfirmasi/$nama_file_bukti")) {
					throw new Exception("Gambar gagal diupload");
				} 
			}
			// End Field Bukti TF
			if (empty($nama_file_bukti)) {
                $nama_file_bukti = $data_donasi->bukti_tf;
			}

            $item_insert = [];
            $total_donasi_update = 0;
            foreach ($list_item as $key => $item) {
				$item['kategori_barang'] = "";
				$item['nama_barang'] = "";
				$item['jumlah_barang'] = 0;
				$item['harga_satuan'] = 0;
				$total_donasi_update += $item['nominal'];
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

			foreach ($delete_item as $i => $id_delete) {
				$this->M_donasi->deleteDetailItemDonasi($id_delete);
			}

            $data_donasi = [
                'email_input' => $email_user,
                'datetime_create' => date("Y-m-d H:i:s"),
                'email_donatur' => $email_donatur,
                'departemen' => $departemen,
                'jenis_pembayaran' => $jenis_pembayaran,
                'tgl_donasi' => $tgl_donasi,
                'id_bank_tujuan' => $id_bank_tujuan,
                'bank_tujuan' => $bank_tujuan,
                'kode_rekening' => $kode_rekening,
                'id_bank_pengirim' => $id_bank_pengirim,
                'bank_pengirim' => $bank_pengirim,
                'atas_nama_pengirim' => $atas_nama_pengirim,
                'no_rek_pengirim' => $no_rek_pengirim,
                'keterangan_donasi' => $keterangan_donasi,
				'bukti_tf' => $nama_file_bukti,
                'total_donasi' => $total_donasi_update,
				'tipe' => 'bank'
            ];

            $this->M_donasi->updateDataDonasi($id_donasi, $data_donasi);

            $data_log_donasi = [
                'id_donasi' => $id_donasi,
                'datetime_action' => date("Y-m-d H:i:s"),
                'email_user' => $email_user,
                'keterangan' => "Mengupdate Donasi $id_donasi"
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($data_log_donasi, 'tb_donasi_log');

            $this->db->trans_commit();
            $this->M_donasi->deleteTempItemDonasi();
            $flashdata = ['notif_message' => "Berhasil menyimpan data donasi", 'notif_type' => "success"];
            $this->session->set_userdata('flashdata', $flashdata);

            $data_donasi['list_item'] = $list_item;
            $data_donasi['redirect_url'] = base_url('confirmation/detail?id=').base64_encode($id_donasi);

            $response = ['status' => true, 'message' => "Donasi berhasil diupdate", 'data' => $data_donasi];
            echo json_encode($response);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }

	public function get_document_root()
    {
        if (strpos('localhost', $_SERVER['HTTP_HOST']) !== false) {
            $result = $_SERVER['DOCUMENT_ROOT'] . '/dompetdhuafa-clone/';
        } else {
            $result = $_SERVER['DOCUMENT_ROOT']."/";
        }
        return $result;
    }

	public function delete_donasi() {
		$id_donasi = $this->input->post('id_donasi');
		$email_user = $this->session->email_user;

		$donasi = $this->M_donasi->getDonasiById($id_donasi);
		if (empty($donasi)) {
			echo json_encode(['status' => false, 'message' => "Donasi tidak ditemukan"]);
		} else {
			$this->M_konfirmasi->deleteDataDonasi($id_donasi);
			$this->M_konfirmasi->deleteDonasiItem($id_donasi);

			$data_log_donasi = [
                'id_donasi' => $id_donasi,
                'datetime_action' => date("Y-m-d H:i:s"),
                'email_user' => $email_user,
                'keterangan' => "Menghapus donasi dengan ID $id_donasi"
            ];
            $insert_log_notifikasi = $this->M_donasi->insertLog($data_log_donasi, 'tb_donasi_log');
			echo json_encode(['status' => true, 'message' => "Donasi berhasil dihapus"]);
		}
	}

}
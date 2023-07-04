<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {
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
        $data['list_collector'] = $this->M_donasi->getListCollector();
		$this->load->view("structure/V_head", $data);
		$this->load->view("structure/V_navbar");
		$this->load->view("V_request_settle");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

    function save_request() {
        $departemen = $this->input->post("departemen", TRUE);
        $bank_tujuan = $this->input->post("bank_tujuan", TRUE);
        $kode_rekening = $this->input->post("kode_rekening", TRUE);
        $bank_pengirim = $this->input->post("bank_pengirim", TRUE);
        $atas_nama_pengirim = $this->input->post("atas_nama_pengirim", TRUE);
        $keterangan_donasi = $this->input->post("keterangan_donasi", TRUE);
        $list_donasi = json_decode($this->input->post('list_donasi', TRUE), TRUE);
        $id_collector = $this->input->post('id_collector', TRUE);
        $no_rek_pengirim = $this->input->post('no_rek_pengirim', TRUE);
        $email_user = $this->session->email_user;
        date_default_timezone_set("Asia/Jakarta");

        try {
            $this->db->trans_start();
            if (empty($list_donasi)) {
                throw new Exception("Pilih data yang akan di collect");
            }

            if (!is_array($list_donasi)) {
                $list_donasi[] = $list_donasi;
            }

            $list_required = ['departemen', 'bank_tujuan', 'kode_rekening', 'bank_pengirim', 'atas_nama_pengirim', 'keterangan_donasi'];

            foreach ($list_required as $key => $field) {
                if (empty($this->input->post($field))) {
                    $field = ucwords(strtolower(str_replace("_", " ", $field)));
                    throw new Exception("$field Harus diisi");
                }
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
				if (!move_uploaded_file($file_tmp, "$document_root/user-uploads/bukti-tf-request/$nama_file_bukti")) {
					throw new Exception("Gambar gagal diupload");
				} 
			}
			// End Field Bukti TF
			if (empty($nama_file_bukti)) {
                throw new Exception("Bukti Transfer harus diisi");
			}

            foreach ($list_donasi as $key => $id_donasi) {
                $donasi = $this->M_donasi->getDonasiById($id_donasi);
                if (empty($donasi) || $donasi->status_donasi != 'draft') {
                    throw new Exception("Terjadi Kesalahan");
                }

                $id_donasi = $donasi->id;
                $data_donasi = ['status_donasi' => 'pending'];
                $this->M_donasi->updateData($id_donasi, $data_donasi);

                $log_donasi = [
                    'id_donasi' => $id_donasi,
                    'datetime_action' => date("Y-m-d H:i:s"),
                    'email_user' => $email_user,
                    'keterangan' => "Melakukan Request Collect",
                ];
                $insert_log_notifikasi = $this->M_donasi->insertLog($log_donasi, 'tb_donasi_log');
            }

            // Save Request Collect
            $save_request_collect = [
                'id_collector' => $id_collector,
                'list_donasi' => json_encode($list_donasi),
                'datetime_collect' => date("Y-m-d H:i:s"),
                'departemen' => $departemen,
                'id_bank_tujuan' => $id_bank_tujuan,
                'bank_tujuan' => $bank_tujuan,
                'kode_rekening' => $kode_rekening,
                'id_bank_pengirim' => $id_bank_pengirim,
                'bank_pengirim' => $bank_pengirim,
                'atas_nama_pengirim' => $atas_nama_pengirim,
                'no_rek_pengirim' => $no_rek_pengirim,
                'keterangan' => $keterangan_donasi,
				'bukti_tf' => $nama_file_bukti,
            ];
            $id_inserted = $this->M_donasi->saveRequestCollect($save_request_collect);

            $detail_request = [];
            foreach ($list_donasi as $i => $id_donasi) {
                $detail_request[] = [
                    'id_request' => $id_inserted,
                    'id_donasi' => $id_donasi
                ];
            }
            $this->M_donasi->saveDetailRequest($detail_request);
            // End Save Request Collect

            $this->db->trans_commit();
            $flashdata = ['notif_message' => "Sukses mengupload bukti transfer", 'notif_type' => "success"];
            $this->session->set_userdata('flashdata', $flashdata);
            $response = ['status' => true, 'message' => "Sukses mengupload bukti transfer"];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);die;
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

}
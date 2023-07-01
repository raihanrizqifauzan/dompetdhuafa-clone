<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checker extends CI_Controller {
    public function __construct(Type $var = null) {
        parent::__construct();
        if(!$this->session->userdata('email_user')) {
            redirect(base_url('login'));
        }

        $this->load->model(['M_checker', 'M_donasi']);
    }


	public function index()
	{
		$this->load->view("structure/V_head");
		$this->load->view("structure/V_navbar");
		$this->load->view("V_checker_list");
		$this->load->view("structure/V_footer");
		$this->load->view("structure/V_foot");
	}

    public function get_request_collect()
	{
        $filter = $this->input->post();
		$list = $this->M_checker->get_datatables_request_collect($filter);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key => $item) {
            $row = [];

            $no = $key+1;
            $row[] = $item->nama_collector;
            $row[] = '<div class="text-center">'.$item->jumlah_branch.'</div>';
            $row[] = '<div class="text-end">'.$item->jumlah_transaksi.'</div>';
            $row[] = 'Rp'.number_format($item->total_transaksi, 2, ',', '.');
            if ($item->status_collect != "request") {
                $row[] = '<div class="text-center">-</div>';
            } else {
                $row[] = '<div class="text-center"><a href="javascript:void(0)" class="text-primary btn-edit" data-id="'.$item->id_request.'"><i class="fa fa-edit"></i></a></div>';
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_checker->get_total_request_collect($filter),
            "recordsFiltered" => $this->M_checker->get_total_request_collect_filtered($filter),
            "data" => $data,
        );

        echo json_encode($output);
	}

    public function get_detail_request() {
        $id_request = $this->input->get('id_request', TRUE);

        $detail = $this->M_checker->getDetailRequest($id_request);
        if (empty($detail)) {
            $response = ['status' => false, 'message' => 'Data tidak ditemukan', 'data' => []];
        } else {
            $response = ['status' => true, 'message' => 'Success', 'data' => $detail];
        }
        echo json_encode($response);
    }

    public function konfirmasi_checker() {
        $id_request = $this->input->post('id_request', TRUE);
        $status_collect = $this->input->post('status_collect', TRUE);
        $email_user = $this->session->email_user;
        date_default_timezone_set("Asia/Jakarta");

        try {
            $this->db->trans_start();

            if (empty($status_collect)) {
                throw new Exception("Pilih Status Konfirmasi (Approve/Reject)");
            }
            
            $data_collect = $this->M_checker->getRequestById($id_request);

            if (empty($data_collect)) {
                throw new Exception("Data tidak ditemukan");
            } else if ($data_collect->status_collect != "request") {
                throw new Exception("Data request ini sudah di proses !");
            }

            $data_update = ['status_collect' => $status_collect];
            $this->M_checker->updateStatusRequest($id_request, $data_update);


            $list_donasi = $this->M_checker->getListDonasiRequest($id_request);
            foreach ($list_donasi as $key => $donasi) {
                $id_donasi = $donasi->id_donasi;
                $data_donasi = ['status_donasi' => 'settle'];
                $this->M_donasi->updateData($id_donasi, $data_donasi);

                if ($status_collect == "approved") {
                    $msg = "telah di approve";
                } else {
                    $msg = "telah di reject";
                }

                $log_donasi = [
                    'id_donasi' => $id_donasi,
                    'datetime_action' => date("Y-m-d H:i:s"),
                    'email_user' => $email_user,
                    'keterangan' => "Donasi $msg",
                ];
                $insert_log_notifikasi = $this->M_donasi->insertLog($log_donasi, 'tb_donasi_log');
            }

            $this->db->trans_commit();
            $response = ['status' => true, 'message' => "Sukses melakukan konfirmasi donasi"];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $response = ['status' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($response);
    }
}

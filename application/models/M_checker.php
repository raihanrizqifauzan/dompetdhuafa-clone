<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class M_checker extends CI_Model 
{
    // Datatable Function //
	public function _query_get_request_collect($filter = [])
	{
        $column_order = array(null);
        $column_search = array('collector.nama_collector', 'request.status_collect');
        $order_by = array('request.datetime_collect' => 'desc');

        $this->db->select('request.*, collector.nama_collector, COUNT(detail.id_donasi) as jumlah_transaksi, SUM(donasi.total_donasi) as total_transaksi, COUNT(donasi.nama_channel) as jumlah_branch');
        $this->db->from('tb_request_collect as request');
        $this->db->join('tb_collector as collector', 'request.id_collector = collector.id');
        $this->db->join('tb_request_collect_detail as detail', 'request.id_request = detail.id_request');
        $this->db->join('tb_donasi as donasi', 'donasi.id = detail.id_donasi');
		$i = 0;

        // Start Get By Filter 
        if ($filter['nama_collector']) {
            $this->db->like('collector.nama_collector', $filter['nama_collector']);
        }

        if ($filter['status_collect']) {
            $this->db->where('request.status_collect', $filter['status_collect']);
        }
        // End Get By Filter
        $this->db->group_by('request.id_request');
	}

	public function get_datatables_request_collect($filter = [])
	{
		$this->_query_get_request_collect($filter);
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_request_collect_filtered($filter = [])
	{
		$this->_query_get_request_collect($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_request_collect($filter = [])
	{
        $this->db->from('tb_request_collect');
		return $this->db->count_all_results();
	}
	// End Datatable Function //

    public function getDetailRequest($id_request) 
    {
        $this->db->select('request.*, donasi.nama_channel, COUNT(detail.id_donasi) as jumlah_transaksi, SUM(donasi.total_donasi) as total_transaksi');
        $this->db->from('tb_request_collect as request');
        $this->db->join('tb_request_collect_detail as detail', 'request.id_request = detail.id_request');
        $this->db->join('tb_donasi as donasi', 'donasi.id = detail.id_donasi');
        $this->db->where('request.id_request', $id_request);
        $this->db->group_by("donasi.nama_channel");
		return $this->db->get()->result();
    }
    
    public function getRequestById($id_request) 
    {
        $this->db->select('*');
        $this->db->from('tb_request_collect');
        $this->db->where('id_request', $id_request);
		return $this->db->get()->row();
    }

    public function getListDonasiRequest($id_request) {
        $this->db->select('*');
        $this->db->from('tb_request_collect_detail');
        $this->db->where('id_request', $id_request);
		return $this->db->get()->result();
    }

    function updateStatusRequest($id_request, $data) {
        $this->db->set($data);
        $this->db->where("id_request", $id_request);
        return $this->db->update('tb_request_collect');
    }
}
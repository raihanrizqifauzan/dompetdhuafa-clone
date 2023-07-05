<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class M_request extends CI_Model
{
    // Datatable Function //
	public function _query_get_request($filter = [])
	{
        $column_order = array(null);
        $column_search = array('tb_donasi.id', 'tb_donatur.nama_lengkap', 'tb_donasi.tgl_donasi', 'status_donasi', 'total_donasi');
        $order_by = array('id' => 'asc');

        $this->db->select('tb_donasi.*, tb_donatur.nama_lengkap, COUNT(tb_donasi_item.id) as jumlah_item_donasi');
        $this->db->from('tb_donasi');
        $this->db->join('tb_donatur', 'tb_donatur.email_donatur = tb_donasi.email_donatur');
        $this->db->join('tb_donasi_item', 'tb_donasi.id = tb_donasi_item.id_donasi');
		$i = 0;

        // Start Get By Filter 
        if ($filter['id_donasi']) {
            $this->db->where('tb_donasi.id', $filter['id_donasi']);
        }

        if ($filter['tgl_awal'] && $filter['tgl_akhir']) {
            $this->db->where('tb_donasi.tgl_donasi >=', $filter['tgl_awal']);
            $this->db->where('tb_donasi.tgl_donasi <=', $filter['tgl_akhir']);
        }

        if ($filter['nama_donatur']) {
            $this->db->like('tb_donatur.nama_lengkap', $filter['nama_donatur']);
        }

        if ($filter['status_donasi']) {
            $this->db->where('tb_donasi.status_donasi', $filter['status_donasi']);
        }

        if ($filter['nomor_rekonsiliasi']) {
            $this->db->where('tb_donasi.no_rekonsiliasi', $filter['nomor_rekonsiliasi']);
        }

        if ($filter['nama_channel']) {
            $this->db->like('tb_donasi.nama_channel', $filter['nama_channel']);
        }

        if ($filter['tipe']) {
            $this->db->where('tb_donasi.tipe', $filter['tipe']);
        }

        if ($filter['jumlah_donasi_terendah'] && $filter['jumlah_donasi_tertinggi']) {
            $this->db->where('tb_donasi.total_donasi >=', $filter['jumlah_donasi_terendah']);
            $this->db->where('tb_donasi.total_donasi <=', $filter['jumlah_donasi_tertinggi']);
        }
        // End Get By Filter

		foreach ($column_search as $item) { // loop column 
			if (@$_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
        $this->db->where('tb_donasi.tipe', 'counter');
        $this->db->group_by('tb_donasi.id');

        if ($filter['jumlah_donasi']) {
            $this->db->having('jumlah_item_donasi', $filter['jumlah_donasi']);
        }
	}

	public function get_datatables_request($filter = [])
	{
		$this->_query_get_request($filter);
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_request_filtered($filter = [])
	{
		$this->_query_get_request($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_request($filter = [])
	{
        $this->db->from('tb_donasi');
        $this->db->where('tipe', 'counter');
        $this->db->where('status_donasi', 'draft');
		return $this->db->count_all_results();
	}
	// End Datatable Function //
}

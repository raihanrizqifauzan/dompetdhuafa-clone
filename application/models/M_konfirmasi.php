<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class M_konfirmasi extends CI_Model 
{
    // Datatable Function //
	public function _query_get_donasi($filter = [])
	{
        $column_order = array(null);
        $column_search = array('tb_donasi.email_input', 'tb_donasi.id', 'tgl_donasi', 'tb_donatur.nama_lengkap', 'tipe', 'sumber_donasi', 'tb_bank.nama_bank');
        $order_by = array('id' => 'asc');

        $this->db->select('tb_donasi.*, tb_donatur.nama_lengkap, tb_user.nama_user');
        $this->db->from('tb_donasi');
        $this->db->join('tb_donatur', 'tb_donatur.email_donatur = tb_donasi.email_donatur');
        $this->db->join('tb_donasi_item', 'tb_donasi.id = tb_donasi_item.id_donasi');
        $this->db->join('tb_user', 'tb_donasi.email_input = tb_user.email_user', 'left');
		$i = 0;

        // Start Get By Filter 
        if ($filter['nama_user']) {
            $this->db->like('tb_user.nama_user', $filter['nama_user']);
        }

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

		if ($filter['bank']) {
            $this->db->like('tb_donasi.bank_pengirim', $filter['bank']);
        }

		if ($filter['no_rekening']) {
            $this->db->like('tb_donasi.no_rek_pengirim', $filter['no_rekening']);
        }
		$this->db->where('tipe', 'bank');
        // End Get By Filter
	}

	public function get_datatables_donasi($filter = [])
	{
		$this->_query_get_donasi($filter);
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_donasi_filtered($filter = [])
	{
		$this->_query_get_donasi($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_donasi($filter = [])
	{
        $this->db->from('tb_donasi');
        $this->db->where('tipe', 'bank');
		return $this->db->count_all_results();
	}
	// End Datatable Function //

	public function getListBank($search)
	{
        $this->db->select("*");
        $this->db->from("tb_bank");
        $this->db->like("nama_bank", $search);
        $this->db->limit(15);
        return $this->db->get()->result();
    }

	public function getDetailBank($id_bank)
	{
		$this->db->select("*");
        $this->db->from("tb_bank");
        $this->db->where("id_bank", $id_bank);
        return $this->db->get()->row();
	}

	public function deleteDataDonasi($id) {
		$this->db->where("id", $id);
        return $this->db->delete('tb_donasi');
	}

	public function deleteDonasiItem($id_donasi) {
		$this->db->where("id_donasi", $id_donasi);
        return $this->db->delete('tb_donasi_item');
	}
}
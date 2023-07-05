<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_donasi extends CI_Model
{
	public function getJenisDonasi()
	{
        $this->db->select("*");
        $this->db->from("tb_jenis_donasi");
        return $this->db->get()->result();
    }
	public function getProgramDonasi($id_jenis_donasi)
	{
        $this->db->select("*");
        $this->db->from("tb_program_donasi");
        $this->db->where("id_jenis_donasi", $id_jenis_donasi);
        return $this->db->get()->result();
    }
	public function getProjectDonasi($id_program)
	{
        $this->db->select("*");
        $this->db->from("tb_project");
        $this->db->where("id_program_donasi", $id_program);
        return $this->db->get()->result();
    }
    public function saveItem($data) {
        $this->db->insert("tb_temp_donasi", $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }
	public function getTempDonasi()
	{
        $this->db->select("tb_temp_donasi.*, tb_program_donasi.program_donasi, tb_project.nama_project, tb_jenis_donasi.jenis_donasi");
        $this->db->from("tb_temp_donasi");
        $this->db->join("tb_project", "tb_project.id = tb_temp_donasi.id_project_donasi");
        $this->db->join("tb_jenis_donasi", "tb_jenis_donasi.id = tb_temp_donasi.id_jenis_donasi");
        $this->db->join("tb_program_donasi", "tb_program_donasi.id = tb_temp_donasi.id_program_donasi");
        return $this->db->get()->result();
    }
	public function getItemDonasiById($id)
	{
        $this->db->select("tb_temp_donasi.*, tb_program_donasi.program_donasi, tb_project.nama_project, tb_jenis_donasi.jenis_donasi");
        $this->db->from("tb_temp_donasi");
        $this->db->join("tb_project", "tb_project.id = tb_temp_donasi.id_project_donasi");
        $this->db->join("tb_jenis_donasi", "tb_jenis_donasi.id = tb_temp_donasi.id_jenis_donasi");
        $this->db->join("tb_program_donasi", "tb_program_donasi.id = tb_temp_donasi.id_program_donasi");
        $this->db->where("tb_temp_donasi.id", $id);
        return $this->db->get()->row();
    }
	public function deleteItemDonasi($id)
	{
        $this->db->where("id", $id);
        return $this->db->delete("tb_temp_donasi");
    }
	public function deleteTempItemDonasi()
	{
        $this->db->like("id", "");
        return $this->db->delete("tb_temp_donasi");
    }
    public function updateDonasi($id, $data) {
        $this->db->set($data);
        $this->db->where("id", $id);
        return $this->db->update('tb_temp_donasi');

    }
    public function insertDonasi($data) {
        $this->db->insert("tb_donasi", $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }

    public function insertBatchItemDonasi($data)
    {
        return $this->db->insert_batch("tb_donasi_item", $data);
    }

    public function insertLog($data_log, $nama_table) {
        $this->db->insert($nama_table, $data_log);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }

	public function getDonasiById($id_donasi)
	{
        $this->db->select('tb_donasi.*, tb_donasi.kode_rekening as kode_rekening_donasi, tb_donatur.*');
        $this->db->from('tb_donasi');
        $this->db->join('tb_donatur', 'tb_donatur.email_donatur = tb_donasi.email_donatur');
        $this->db->where("tb_donasi.id", $id_donasi);
        return $this->db->get()->row();
    }

    // Datatable Function //
	public function _query_get_counter($filter = [], $tipe = "")
	{
        $column_order = array(null);
        $column_search = array('tb_donasi.id', 'tb_donatur.nama_lengkap', 'tgl_donasi', 'status_donasi', 'total_donasi');
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
        if (!empty($tipe)) {
            $this->db->where('tb_donasi.tipe', $tipe);
        }

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
        $this->db->group_by('tb_donasi.id');

        if ($filter['jumlah_donasi']) {
            $this->db->having('jumlah_item_donasi', $filter['jumlah_donasi']);
        }
	}

	public function get_datatables_counter($filter = [], $tipe = "")
	{
		$this->_query_get_counter($filter, $tipe);
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_counter_filtered($filter = [], $tipe = "")
	{
		$this->_query_get_counter($filter, $tipe);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_counter($filter = [], $tipe = "")
	{
        $this->db->from('tb_donasi');
		return $this->db->count_all_results();
	}
	// End Datatable Function //
    
	public function getDonasiItem($id_donasi)
	{
        $this->db->select('tb_donasi_item.*, tb_program_donasi.program_donasi, tb_project.nama_project, tb_jenis_donasi.jenis_donasi');
        $this->db->from('tb_donasi_item');
        $this->db->join("tb_project", "tb_project.id = tb_donasi_item.id_project_donasi");
        $this->db->join("tb_jenis_donasi", "tb_jenis_donasi.id = tb_donasi_item.id_jenis_donasi");
        $this->db->join("tb_program_donasi", "tb_program_donasi.id = tb_donasi_item.id_program_donasi");
        $this->db->where("tb_donasi_item.id_donasi", $id_donasi);
        return $this->db->get()->result();
    }

    function updateData($id_donasi, $data) {
        $this->db->set($data);
        $this->db->where("id", $id_donasi);
        return $this->db->update('tb_donasi');
    }

    function updateItemDonasi($item_id, $data) {
        $this->db->set($data);
        $this->db->where("id", $item_id);
        return $this->db->update('tb_donasi_item');
    }

    function getDonasiLog($id_donasi) {
        $this->db->select("*");
        $this->db->from("tb_donasi_log");
        $this->db->where("id_donasi", $id_donasi);
        $this->db->order_by("id", "DESC");
        return $this->db->get()->result();
    }

    function getLogNotifikasi($id_donasi) {
        $this->db->select("*");
        $this->db->from("tb_log_notifikasi");
        $this->db->where("id_donasi", $id_donasi);
        $this->db->order_by("id", "DESC");
        return $this->db->get()->result();
    }

    function getListCollector() {
        $this->db->select("*");
        $this->db->from("tb_collector");
        return $this->db->get()->result();
    }
	public function getCollectorById($id_collector) {
		$this->db->select("*");
		$this->db->from("tb_collector");
		$this->db->where("id", $id_collector);
		return $this->db->get()->row();
	}

    function getDonasiByStatus($status) {
		$this->db->select("*");
		$this->db->from("tb_donasi");
		$this->db->where("status_donasi", $status);
		return $this->db->get()->result();
    }

    function getDonasiRecap($start_date = false, $end_date = false) {
		$query = $this->db->query("SELECT fr.nama_user, donasi.tgl_donasi, donasi.id, 
        (CASE
            WHEN donasi.jenis_pembayaran = 'tunai' THEN total_donasi
            ELSE 0
        END) as donasi_tunai,
        (CASE
            WHEN donasi.jenis_pembayaran = 'mitra' THEN total_donasi
            ELSE 0
        END) as donasi_mitra,
        (CASE
            WHEN donasi.jenis_pembayaran = 'edc' THEN total_donasi
            ELSE 0
        END) as donasi_edc
        FROM tb_donasi as donasi JOIN tb_user as fr ON donasi.email_input = fr.email_user
        where donasi.status_donasi != 'request_void'
        ORDER BY donasi.tgl_donasi DESC ");
		return $query->result();
    }

    function getDonasiRecapGroupByTipe($start_date = false, $end_date = false) {
		$this->db->select("j.jenis_donasi, COUNT(d.id) as total_trx, SUM(d.nominal) as total_donasi");
        $this->db->from("tb_donasi_item d");
        $this->db->join("tb_jenis_donasi j", "d.id_jenis_donasi = j.id");
        $this->db->join("tb_donasi don", "don.id = d.id_donasi");
        $this->db->where("don.status_donasi != ", 'request_void');
        $this->db->group_by("d.id_jenis_donasi");
		return $this->db->get()->result();
    }

    function saveRequestCollect($data) {
        $this->db->insert("tb_request_collect", $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }

    function saveDetailRequest($data) {
        return $this->db->insert_batch("tb_request_collect_detail", $data);
    }
    public function updateDataDonasi($id, $data) {
        $this->db->set($data);
        $this->db->where("id", $id);
        return $this->db->update('tb_donasi');

    }
	public function deleteDetailItemDonasi($id)
	{
        $this->db->where("id", $id);
        return $this->db->delete("tb_donasi_item");
    }

    public function getDonasiTunaiDraft() {
        $this->db->select("id");
        $this->db->from("tb_donasi");
        $this->db->where("tipe", "counter");
        $this->db->where("status_donasi", "draft");
        $data = $this->db->get()->result_array();
        $arr = array_column($data, "id");
        return $arr;
    }
}
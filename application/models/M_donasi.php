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
        $this->db->select('tb_donasi.*, tb_donatur.*');
        $this->db->from('tb_donasi');
        $this->db->join('tb_donatur', 'tb_donatur.email_donatur = tb_donasi.email_donatur');
        $this->db->where("tb_donasi.id", $id_donasi);
        return $this->db->get()->row();
    }

    // Datatable Function //
	public function _query_get_counter($status = "")
	{
        $column_order = array(null);
        $column_search = array('id', 'nama_lengkap', 'tgl_donasi', 'status_donasi', 'total_donasi');
        $order_by = array('id' => 'asc');

        $this->db->select('tb_donasi.*, tb_donatur.nama_lengkap, COUNT(tb_donasi_item.id) as jumlah_item_donasi');
        $this->db->from('tb_donasi');
        $this->db->join('tb_donatur', 'tb_donatur.email_donatur = tb_donasi.email_donatur');
        $this->db->join('tb_donasi_item', 'tb_donasi.id = tb_donasi_item.id_donasi');
		$i = 0;
        if (!empty($status)) {
            $this->db->where('tb_donasi.status_donasi', $status);
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
	}

	public function get_datatables_counter($status = "")
	{
		$this->_query_get_counter($status);
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_counter_filtered($status = "")
	{
		$this->_query_get_counter($status);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_counter($status = "")
	{
        $this->db->from('tb_donasi');
        if (!empty($status)) {
            $this->db->where('status_donasi', $status);
        }
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
}
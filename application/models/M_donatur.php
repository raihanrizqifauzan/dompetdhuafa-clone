<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_donatur extends CI_Model
{
	public function getListKotaDonatur($search)
	{
        $this->db->select("*");
        $this->db->from("tb_kecamatan");
        $this->db->like("nama_provinsi", $search);
        $this->db->or_like("nama_kabupaten_kota", $search);
        $this->db->or_like("nama_kecamatan", $search);
        // $this->db->limit(10);
        return $this->db->get()->result();
    }

    public function getKecamatanById($id)
	{
        $this->db->select("*");
        $this->db->from("tb_kecamatan");
        $this->db->where("id", $id);
        return $this->db->get()->row();
    }

    public function insertDonatur($data)
	{
        $this->db->insert("tb_donatur", $data);
        $insert_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $insert_id;
        } else {
            return false;
        }
    }

    // Datatable Function //
	public function _query_get_donatur($filter = "")
	{
        $column_order = array(null);
        $column_search = array('id_donatur', 'nama_lengkap', 'no_hp', 'email_donatur', 'kode_rekening', 'kategori_prospek');
        $order_by = array('id_donatur' => 'asc');

        $this->db->select('*');
        $this->db->from('tb_donatur');
		$i = 0;
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

		if (isset($filter['id_donatur']) && !empty($filter['id_donatur'])) {
            $this->db->like('tb_donatur.id_donatur', $filter['id_donatur']);
        }
		if (isset($filter['nama_lengkap']) && !empty($filter['nama_lengkap'])) {
            $this->db->like('tb_donatur.nama_lengkap', $filter['nama_lengkap']);
        }
		if (isset($filter['no_hp']) && !empty($filter['no_hp'])) {
			$filter['no_hp'] = str_replace("+62", "0", $filter['no_hp']);
			$filter['no_hp'] = str_replace("62", "0", $filter['no_hp']);
            $this->db->like('tb_donatur.no_hp', $filter['no_hp']);
        }
		if (isset($filter['email_donatur']) && !empty($filter['email_donatur'])) {
            $this->db->like('tb_donatur.email_donatur', $filter['email_donatur']);
        }
		if (isset($filter['tipe_donatur']) && !empty($filter['tipe_donatur'])) {
            $this->db->where('tb_donatur.tipe_donatur', $filter['tipe_donatur']);
        }
		if (isset($filter['status_donatur']) && !empty($filter['status_donatur'])) {
            $this->db->where('tb_donatur.status_donatur', $filter['status_donatur']);
        }

		// if (isset($_POST['order'])) { // here order processing
		// 	$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		// } else if (isset($order_by)) {
		// 	$order = $order_by;
		// 	$this->db->order_by(key($order), $order[key($order)]);
		// }
	}

	public function get_datatables_donatur($filter)
	{
		$this->_query_get_donatur($filter);
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_total_filtered_donatur($filter)
	{
		$this->_query_get_donatur($filter);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_total_donatur($filter)
	{
        $this->db->from('tb_donatur');
		return $this->db->count_all_results();
	}
	// End Datatable Function //

	public function getDonaturById($id_donatur) {
		$this->db->select("*");
		$this->db->from("tb_donatur");
		$this->db->where("id_donatur", $id_donatur);
		return $this->db->get()->row();
	}

    public function updateDonatur($id_donatur, $data)
	{
		$this->db->where('id_donatur', $id_donatur);
		$this->db->set($data);
        return $this->db->update("tb_donatur");
    }

	public function getDonaturByEmail($email_donatur) {
		$this->db->select("*");
		$this->db->from("tb_donatur");
		$this->db->where("email_donatur", $email_donatur);
		return $this->db->get()->row();
	}
}

?>
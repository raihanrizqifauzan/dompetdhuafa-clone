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
}
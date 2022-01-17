<?php

class M_customer extends CI_Model{
	protected $_table = 'customer';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_antrean(){
		$this->db->select_max('no_antre');
		$result = $this->db->get($this->_table)->row();
		return $result->no_antre;
	}

	public function get_status(){
		$this->db->select_max('status');
		$result = $this->db->get($this->_table)->row();
		return $result->status;
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_cst(){
		$query = $this->db->select('nama');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_cst_status($status){
		$query = $this->db->where(['status' => $status]);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_nama($no_antre){
		$query = $this->db->select('*');
		$query = $this->db->where(['no_antre' => $no_antre]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function lihat_namalg($kode){
		$query = $this->db->select('nama');
		$query = $this->db->where(['kode' => $kode]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function lihat_antre(){
		$query = $this->db->select('no_antre');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_antre_status(){
		$status2 = 0;
		$query = $this->db->select('no_antre');
		$query = $this->db->where(['status' => $status2]);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_id($kode){
		$query = $this->db->get_where($this->_table, ['kode' => $kode]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $kode){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode' => $kode]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode){
		return $this->db->delete($this->_table, ['kode' => $kode]);
	}

	public function ubahstatus($data, $no_antre){
		$query = $this->db->set($data);
		$query = $this->db->where(['no_antre' => $no_antre]);
		$query = $this->db->update($this->_table);
		return $query;
	}
}
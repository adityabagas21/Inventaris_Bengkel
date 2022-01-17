<?php

class M_detail_barang extends CI_Model{
	protected $_table = 'detail_barang';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok_masuk > 1');
		return $query->result();
	}

	public function lihat_id($kode_barang){
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function plus_stok($stok_masuk, $nama_barang){
		$query = $this->db->set('stok_masuk', 'stok_masuk+' . $stok_masuk, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function min_stok($stok_keluar, $nama_barang){
		$pengurangan = $stok_masuk - $stok_keluar;
		$query = $this->db->set('stok_keluar', 'stok_keluar+' . $stok_keluar, false);
		$query = $this->db->set('stok_sisa', 'stok_sisa+' . $pengurangan, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_barang){
		return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
	}
}
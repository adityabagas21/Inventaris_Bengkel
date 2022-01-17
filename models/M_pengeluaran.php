<?php

class M_pengeluaran extends CI_Model {
	protected $_table = 'pengeluaran';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_no_keluar($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->row();
	}

	public function lihat_data_nama($nama){
		return $this->db->get_where($this->_table, ['nama' => $nama])->row();
	}

	public function lihat_data_no_antre($no_antre){
		return $this->db->get_where($this->_table, ['no_antre' => $no_antre])->result();
	}

	public function lihat_data_kode($nama){
		return $this->db->get_where($this->_table, ['no_keluar' => $nama])->row();
	}

	public function lihat_nama($nama){
		return $this->db->get_where($this->_table, ['nama' => $nama])->result();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}

	
}
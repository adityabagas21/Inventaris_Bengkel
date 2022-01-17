<?php

class M_detail_keluar extends CI_Model {
	protected $_table = 'detail_keluar';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_keluar($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->result();
	}

	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}

	public function lihat_no_antre($no_antre){
		return $this->db->get_where($this->_table, ['no_antre' => $no_antre])->result();
	}

	public function lihat_id($no_keluar){
		$query = $this->db->get_where($this->_table, ['no_keluar' => $no_keluar]);
		return $query->row();
	}
	

	public function ubah($data, $no_keluar){
		$query = $this->db->set($data);
		$query = $this->db->where(['no_keluar' => $no_keluar]);
		$query = $this->db->update($this->_table);
		return $query;
	}
 
	
}
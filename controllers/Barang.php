<?php

use Dompdf\Dompdf;

class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin' && $this->session->login['role'] != 'pemilik') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_detail_barang', 'm_detail_barang');
		$this->load->model('M_barang_sisa', 'm_barang_sisa');
		
	}

	public function index()
	{
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['no'] = 1;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Barang';

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'stok_masuk' => $this->input->post('stok_masuk'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'stok_keluar' => $this->input->post('stok_keluar'),
			'stok_sisa' => $this->input->post('stok_sisa'),
			'satuan' => $this->input->post('satuan'),
		];

		if ($this->m_barang->tambah($data) && $this->m_detail_barang->tambah($data)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
			redirect('barang');
		}

	}

	public function detailbarang($kode_barang){
		$this->data['title'] = 'Detail Barang';
		$this->data['all_detail_barang'] = $this->m_detail_barang->lihat_id($kode_barang);
		$this->data['no'] = 1;

		$this->load->view('barang/detailbarang', $this->data);
	}

	public function reorder($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Re-Order';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->load->view('barang/reorder', $this->data);
	}

	public function proses_reorder($kode_barang){
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'stok_masuk' => $this->input->post('stok_masuk'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'stok_keluar' => $this->input->post('stok_keluar'),
			'stok_sisa' => $this->input->post('stok_sisa'),
			'satuan' => $this->input->post('satuan'),
		];

		if ($this->m_detail_barang->tambah($data) && $this->m_barang->plus_stokkode($data['stok_masuk'], $kode_barang)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('barang');
		}
	}

	public function ubah($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->m_barang->lihat_id($kode_barang);

		$this->load->view('barang/ubah', $this->data);
	}

	public function proses_ubah($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_barang' => $this->input->post('kode_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'stok_masuk' => $this->input->post('stok_masuk'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
			'stok_keluar' => $this->input->post('stok_keluar'),
			'stok_sisa' => $this->input->post('stok_sisa'),
			'satuan' => $this->input->post('satuan'),
		];

		if ($this->m_barang->ubah($data, $kode_barang) && $this->m_detail_barang->tambah($data)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Diubah!');
			redirect('barang');
		}
	}

	public function hapus($kode_barang)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}

		if ($this->m_barang->hapus($kode_barang)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('barang');
		}
	}

	public function barangsisa(){
		$this->data['title'] = 'Barang Sisa';
		$this->data['all_barang_sisa'] = $this->m_barang_sisa->lihat();
		$this->data['no'] = 1;

		$this->load->view('barang/barangsisa', $this->data);
	}

	public function tambahsisa()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Barang Sisa';

		$this->load->view('barang/tambahsisa', $this->data);
	}

	public function proses_tambahsisa()
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$data = [
			'kode_sisa' => $this->input->post('kode_sisa'),
			'nama_sisa' => $this->input->post('nama_sisa'),
			'stok_sisa' => $this->input->post('stok_sisa'),
			'tanggal' => $this->input->post('tanggal'),
			'satuan' => $this->input->post('satuan'),
		];

		if ($this->m_barang_sisa->tambah($data)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
			redirect('barang/barangsisa');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
			redirect('barang/barangsisa');
		}

	}

	public function hapussisa($kode_sisa)
	{
		if ($this->session->login['role'] == 'petugas') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}

		if ($this->m_barang_sisa->hapus($kode_sisa)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('barang/barangsisa');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('barang/barangsisa');
		}
	}

	public function export($kode_barang)
	{
		$data = $this->m_detail_barang->lihat_id($kode_barang);
		$html = $this->load->view('barang/barcode_print', $data);
		$this->load->library('dompdf_gen');
		$this->dompdf_gen->PdfGenerator($html,'coba', 'A4', 'Landscape');
	}

	public function barcode_qrcode($kode_barang){
		$this->data['title'] = 'Detail Barang';
		$this->data['all_detail_barang'] = $this->m_detail_barang->lihat_id($kode_barang);
		$this->data['no'] = 1;

		$this->load->view('barang/barcode_qrcode', $this->data);
	}
}

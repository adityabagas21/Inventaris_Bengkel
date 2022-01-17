<?php

use Dompdf\Dompdf;

class Pengeluaran extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Pengerjaan';
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/lihat', $this->data);
	}

	public function ubah($no_keluar){

		$this->data['title'] = 'Ubah Customer';
		$this->data['pengeluaran'] = $this->m_detail_keluar->lihat_id($no_keluar);

		$this->load->view('pengeluaran/ubah', $this->data);
	}

	public function proses_ubah($no_keluar){
		$data = [
			'jumlah' => $this->input->post('jumlah'),
			'sub_total' => $this->input->post('sub_total'),
		];

		

		if($this->m_detail_keluar->ubah($data, $no_keluar)){
			$this->session->set_flashdata('success', 'Data Pengeluaran <strong>Berhasil</strong> Diubah!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Data Pengeluaran <strong>Gagal</strong> Diubah!');
			redirect('pengeluaran');
		}

	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_barang'] = $this->m_barang->lihat();
		$this->data['all_customer'] = $this->m_customer->lihat_antre_status();

		$this->load->view('pengeluaran/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));

		$data_keluar = [
			'no_keluar' => $this->input->post('no_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'nama' => $this->input->post('nama'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'no_antre' => $this->input->post('no_antre'),
		];

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			array_push($data_detail_keluar, ['no_keluar' => $this->input->post('no_keluar')]);
			$data_detail_keluar[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_keluar[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
			$data_detail_keluar[$i]['no_antre'] = $this->input->post('no_antre_hidden')[$i];
			$data_detail_keluar[$i]['kode_barang'] = $this->input->post('kode_barang_hidden')[$i];
			$data_detail_keluar[$i]['harga_satuan'] = $this->input->post('harga_satuan_hidden')[$i];
		}

		if($this->m_pengeluaran->tambah($data_keluar) && $this->m_detail_keluar->tambah($data_detail_keluar)){
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) { 
				$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('pengeluaran');
		}
	}

	public function detail($no_keluar){
		$this->data['title'] = 'Detail Pengerjaan';
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/detail', $this->data);
	}

	public function hapus($no_keluar){
		if($this->m_pengeluaran->hapus($no_keluar) && $this->m_detail_keluar->hapus($no_keluar)){
			$this->session->set_flashdata('success', 'Invoice Pengerjaan <strong>Berhasil</strong> Dihapus!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Invoice Pengerjaan <strong>Gagal</strong> Dihapus!');
			redirect('pengeluaran');
		}
	}

	public function get_all_barang(){
		$data = $this->m_barang->lihat_kode_barang($_POST['kode_barang']);
		echo json_encode($data);
	}

	public function get_all_customer(){
		$data = $this->m_customer->lihat_nama($_POST['no_antre']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('pengeluaran/keranjang');
	}

	public function export(){
		$this->load->library('Dompdf');
	
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['title'] = 'Laporan Data Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = "apa";
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_keluar){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['title'] = 'Laporan Detail Pengerjaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengeluaran/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Pengerjaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
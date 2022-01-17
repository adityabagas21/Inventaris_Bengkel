<?php

use Dompdf\Dompdf;

class Customer extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin' && $this->session->login['role'] != 'pemilik') redirect();
		$this->load->model('M_customer', 'm_customer');
		$this->data['aktif'] = 'customer';
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
	}

	public function index(){
		$status2=0;
		$this->data['title'] = 'Data Customer Baru';
		$this->data['all_customer'] = $this->m_customer->lihat_cst_status($status2);
		$this->data['no'] = 1;
		
		

		$this->load->view('customer/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Tambah Customer';

		$this->load->view('customer/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('dashboard');
		}
		
		$no_antrean = $this->m_customer->get_antrean();
		$int_antri = (int)$no_antrean;
		$int_antri +=1;
		$status = 0;

		$data = [
			'no_antre' => $int_antri,
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'telepon' => $this->input->post('telepon'),
			'alamat' => $this->input->post('alamat'),
			'no_polisi' => $this->input->post('no_polisi'),
			'no_rangka' => $this->input->post('no_rangka'),
			'no_mesin' => $this->input->post('no_mesin'),
			'tipe_mobil' => $this->input->post('tipe_mobil'),
			'keterangan' => $this->input->post('keterangan'),
			'status' => $status,
		];

		if($this->m_customer->tambah($data)){
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Ditambahkan!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
			redirect('customer');
		}
	}

	public function ubah($kode){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}

		$this->data['title'] = 'Ubah Customer';
		$this->data['customer'] = $this->m_customer->lihat_id($kode);

		$this->load->view('customer/ubah', $this->data);
	}

	public function proses_ubah($kode){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('dashboard');
		}
		

		$data = [
			'no_antre' => $this->input->post('no_antre'),
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'telepon' => $this->input->post('telepon'),
			'alamat' => $this->input->post('alamat'),
			'no_polisi' => $this->input->post('no_polisi'),
			'no_rangka' => $this->input->post('no_rangka'),
			'no_mesin' => $this->input->post('no_mesin'),
			'tipe_mobil' => $this->input->post('tipe_mobil'),
			'keterangan' => $this->input->post('keterangan'),
		];

		if($this->m_customer->ubah($data, $kode)){
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Diubah!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Diubah!');
			redirect('customer');
		}
	}

	public function hapus($kode){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('dashboard');
		}
		
		if($this->m_customer->hapus($kode)){
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Dihapus!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Dihapus!');
			redirect('customer');
		}
	}

	public function selesai($no_antre){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Mengubah data selesai hanya untuk admin!');
			redirect('dashboard');
		}

		$status=1;

		$data = [
			'status' => $status,
		];
		
		if($this->m_customer->ubahstatus($data,$no_antre)){
			$this->session->set_flashdata('success', 'Status Customer <strong>Berhasil</strong> Terganti!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Status Customer <strong>Gagal</strong> Terganti!');
			redirect('customer');
		}
	}

	public function selesaibayar($no_antre){
		if ($this->session->login['role'] == 'petugas'){
			$this->session->set_flashdata('error', 'Mengubah data selesai hanya untuk admin!');
			redirect('dashboard');
		}

		$status=2;
		$tgl_keluar=date('d/m/Y');

		$data = [
			'status' => $status,
			'tgl_keluar' => $tgl_keluar,
		];
		
		if($this->m_customer->ubahstatus($data,$no_antre)){
			$this->session->set_flashdata('success', 'Status Customer <strong>Berhasil</strong> Terganti!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Status Customer <strong>Gagal</strong> Terganti!');
			redirect('customer');
		}
	}

	public function detail($kode){
		//  $lihatnama = $this->m_customer->lihat_namalg($kode);
		//  $lihatnama2= json_encode($lihatnama);

		$this->data['title'] = 'Detail Customer';
		$this->data['customer'] = $this->m_customer->lihat_id($kode);
		//$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_nama($lihatnama2);
		// $this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('customer/detail', $this->data);
	}

	public function detailwaiting($kode){
		//  $lihatnama = $this->m_customer->lihat_namalg($kode);
		//  $lihatnama2= json_encode($lihatnama);

		$this->data['title'] = 'Detail Customer';
		$this->data['customer'] = $this->m_customer->lihat_id($kode);
		//$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_nama($lihatnama2);
		// $this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('customer/detailwaiting', $this->data);
	}

	public function detailreport($kode){
		//  $lihatnama = $this->m_customer->lihat_namalg($kode);
		//  $lihatnama2= json_encode($lihatnama);

		$this->data['title'] = 'Detail Customer';
		$this->data['customer'] = $this->m_customer->lihat_id($kode);
		//$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_nama($lihatnama2);
		// $this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('customer/detailreport', $this->data);
	}

	public function detailbarang($no_antre){
	   $this->data['title'] = 'Detail Barang Customer';
	   $this->data['pengeluaran'] = $this->m_pengeluaran->lihat_data_no_antre($no_antre);
	   //$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_nama($lihatnama2);
	   // $this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
	   $this->data['no'] = 1;

	   $this->load->view('customer/detailbarang', $this->data);
   }

   public function reportcustomer(){
   $status2=2;
   $this->data['title'] = 'Report Customer';
   $this->data['customer'] = $this->m_customer->lihat_cst_status($status2);
   $this->data['no'] = 1;

	$this->load->view('customer/reportcustomer', $this->data);
    }

	public function waitingpayment(){
		$status2=1;
		$this->data['title'] = 'Waiting For Payment';
		$this->data['customer'] = $this->m_customer->lihat_cst_status($status2);
		$this->data['no'] = 1;
	
		$this->load->view('customer/waitingpayment', $this->data);
	}

   public function pembayaran($no_antre){
	$this->data['title'] = 'Detail Pembayaran';
	$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_antre($no_antre);
	$this->data['no'] = 1;

	$this->load->view('customer/pembayaran', $this->data);
   }

   public function invoice($no_antre){
	$this->data['title'] = 'Invoice';
	$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_antre($no_antre);
	$this->data['no'] = 1;

	$this->load->view('customer/invoice', $this->data);
   }

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_customer'] = $this->m_customer->lihat();
		$this->data['title'] = 'Laporan Data Customer';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('customer/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Customer Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('barang/proses_tambah') ?>" id="form-tambah" method="POST">
										<div class="form-row">
										<div class="form-group col-md-6">
											<label>Tanggal Masuk</label>
											<input type="text" name="tanggal_masuk" value="<?= date('d/m/Y') ?>" readonly class="form-control">
										</div>
											<div class="form-group col-md-6">
												<label for="kode_barang"><strong>Kode Barang</strong></label>
												<input type="text" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off" class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_barang"><strong>Nama Barang</strong></label>
												<input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off" class="form-control" required>
											</div>
											<div class="form-group col-md-6">
												<label for="harga_satuan"><strong>Harga Satuan</strong></label>
												<input type="text" name="harga_satuan" placeholder="Masukkan Harga Satuan" autocomplete="off" class="form-control" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="stok_masuk"><strong>Stok Masuk</strong></label>
												<input type="number" id="stok_masuk" name="stok_masuk" placeholder="Masukkan Stok Masuk" autocomplete="off" class="form-control" required  onkeyup="sum();">
											</div>
											<div class="form-group col-md-6">
												<label for="stok_keluar"><strong>Stok Keluar</strong></label>
												<input type="number" id="stok_keluar" name="stok_keluar" placeholder="Masukkan Stok Keluar" autocomplete="off" class="form-control" required  onkeyup="sum();">
											</div>
											<div class="form-group col-md-6">
												<label for="stok_sisa"><strong>Stok Tersedia</strong></label>
												<input type="text" id="stok_sisa" name="stok_sisa" placeholder="Masukkan Stok Tersedia" autocomplete="off" class="form-control" required  maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="satuan"><strong>Satuan</strong></label>
												<select name="satuan" id="satuan" class="form-control" required>
													<option value="">-- Silahkan Pilih --</option>
													<option value="pcs">PCS</option>
													<option value="liter">L</option>
													<option value="ml">Mililiter</option>
													<option value="botol">Botol</option>
													<option value="kg">Kg</option>
													<option value="gr">Gram</option>
													<option value="galon">Galon</option>
													<option value="dus">Dus</option>
												</select>
											</div>
											
										</div>
										<hr>
										<div class="form-group">
											<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
											<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>

<script>
	function sum() {
      var stokMasuk = document.getElementById('stok_masuk').value;
      var stokKeluar = document.getElementById('stok_keluar').value;
      var result = parseInt(stokMasuk) - parseInt(stokKeluar);
      if (!isNaN(result)) {
         document.getElementById('stok_sisa').value = result;
      }
}
</script>

</html>
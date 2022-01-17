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
			<div id="content" data-url="<?= base_url('customer') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('customer') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('customer/detail/' . $customer->kode) ?>" id="form-tambah" method="POST">
										<div class="form-row">
										<div class="form-group col-md-6">
												<label for="no_antre"><strong>Nomor Antrian</strong></label>
												<input type="text" name="no_antre" placeholder="Masukkan Nomor Antrian" autocomplete="off" class="form-control" required value="<?= $customer->no_antre ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="kode"><strong>Kode</strong></label>
												<input type="text" name="kode" placeholder="Masukkan Kode customer" autocomplete="off" class="form-control" required value="<?= $customer->kode ?>" maxlength="8" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama"><strong>Nama</strong></label>
												<input type="text" name="nama" placeholder="Masukkan Nama customer" autocomplete="off" class="form-control" required value="<?= $customer->nama ?>" readonly>
											</div>
										</div>
										<div class="form-row">											
											<div class="form-group col-md-4">
												<label for="telepon"><strong>Telepon</strong></label>
												<input type="number" name="telepon" placeholder="Masukkan Nomor Telepon" autocomplete="off" class="form-control" required value="<?= $customer->telepon ?>" readonly>
											</div>
										</div>
										<div class="form-group">
											<label for="alamat"><strong>Alamat</strong></label>
											<textarea name="alamat" id="alamat" style="resize: none;" class="form-control" placeholder="Masukkan Alamat" readonly><?= $customer->alamat ?></textarea>
										</div>
										<div class="form-row">											
											<div class="form-group col-md-4">
												<label for="no_polisi"><strong>Nomor Polisi</strong></label>
												<input type="text" name="no_polisi" placeholder="Masukkan Nomor Polisi" autocomplete="off" class="form-control" required value="<?= $customer->no_polisi ?>" readonly>
											</div>
											<div class="form-group col-md-4">
												<label for="no_rangka"><strong>Nomor Rangka</strong></label>
												<input type="text" name="no_rangka" placeholder="Masukkan Nomor Rangka" autocomplete="off" class="form-control" required value="<?= $customer->no_rangka ?>" readonly>
											</div>
											<div class="form-group col-md-4">
												<label for="no_mesin"><strong>Nomor Mesin</strong></label>
												<input type="text" name="no_mesin" placeholder="Masukkan Nomor Mesin" autocomplete="off" class="form-control" required value="<?= $customer->no_mesin ?>" readonly>
											</div>
											

										</div>
										<hr>										
									</form>
									<div class="form-group col-md-4">
											<a href="<?= base_url('customer/detailbarang/' . $customer->no_antre) ?>" class="btn btn-primary btn-sm"><i class="fa"></i>&nbsp;&nbsp;Lihat Detail Barang</a>									
											<a onclick="return confirm('Apakah Sudah Selesai Dikerjakan?')" href="<?= base_url('customer/selesai/' . $customer->no_antre) ?>" class="btn btn-warning btn-sm"><i class="fa"></i>&nbsp;&nbsp;Selesai</a>
											
											</div>
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

</html>
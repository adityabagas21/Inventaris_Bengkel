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
					<div class="card shadow">
							<hr>
							<div class="row">
								<div class="col-md-12">
                                <div class="card-body">
							    <div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<table class="table table-bordered">
										<thead>
											<tr>
												<td><strong>No</strong></td>
                                                <td><strong>Nama Customer</strong></td>
												<td><strong>Kode Barang</strong></td>
												<td><strong>Nama Petugas</strong></td>
                                                <td><strong>Aksi</strong></td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($pengeluaran as $detail_keluar) : ?>
												<tr>
													<td><?= $no++ ?></td>
                                                    <td><?= $detail_keluar->nama ?></td>
													<td><?= $detail_keluar->no_keluar ?></td>
													<td><?= $detail_keluar->nama_petugas?></td>
                                                    <td>
													<a href="<?= base_url('pengeluaran/detail/' . $detail_keluar->no_keluar) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
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
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
				
	
					</div>
					<hr>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>
					<div class="card shadow">
						<div class="card-header"><strong>Daftar Customer</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>No</td>
											<td>No Antrian</td>
											<td>Tanggal Selesai</td>
											<td>Kode Customer</td>
											<td>Nama Customer</td>
											<td>Telepon</td>											
											<td>Alamat</td>
											<td>No. Polisi</td>
											<td>No. Rangka</td>
											<td>No. Mesin</td>
											<td>Status</td>
											<td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($customer as $detail) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $detail->no_antre ?></td>
												<td><?= $detail->tgl_keluar ?></td>
												<td><?= $detail->kode ?></td>												
												<td><?= $detail->nama ?></td>
												<td><?= $detail->telepon ?></td>
												<td><?= $detail->alamat ?></td>
												<td><?= $detail->no_polisi ?></td>
												<td><?= $detail->no_rangka ?></td>
												<td><?= $detail->no_mesin ?></td>
												<?php if($detail->status == 2) :?>
													<td><span>Finished</span></td>
												<?php endif ?>
												<?php if ($this->session->login['role'] == 'admin') : ?>
													<td>
														<a href="<?= base_url('customer/detailreport/' . $detail->kode) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>													
													</td>
												<?php endif ?>
												<?php if ($this->session->login['role'] == 'pemilik') : ?>
													<td>
														<a href="<?= base_url('customer/detailreport/' . $detail->kode) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>													
													</td>
												<?php endif ?>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>
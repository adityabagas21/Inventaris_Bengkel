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
							<?php if ($this->session->login['role'] == 'admin') : ?>
								<a href="<?= base_url('customer/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
							<?php endif ?>
						</div>
						<div class="float-right">
							<?php if ($this->session->login['role'] == 'pemilik') : ?>
								<a href="<?= base_url('customer/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
							<?php endif ?>
						</div>
						
						<div class="float-right">
							<?php if ($this->session->login['role'] == 'admin') : ?>
								<a href="<?= base_url('customer/reportcustomer') ?>" class="btn btn-info btn-sm mr-1"><i class="fa fa"></i>&nbsp;Report Customer</a>
							<?php endif ?>
						</div>
						<div class="float-right">
							<?php if ($this->session->login['role'] == 'pemilik') : ?>
								<a href="<?= base_url('customer/reportcustomer') ?>" class="btn btn-info btn-sm mr-1"><i class="fa fa"></i>&nbsp;Report Customer</a>
							<?php endif ?>
						</div>

						<div class="float-right">
							<?php if ($this->session->login['role'] == 'admin') : ?>
								<a href="<?= base_url('customer/waitingpayment') ?>" class="btn btn-warning btn-sm mr-1"><i class="fa fa"></i>&nbsp;Waiting For Payment</a>
							<?php endif ?>
						</div>
						<div class="float-right">
							<?php if ($this->session->login['role'] == 'pemilik') : ?>
								<a href="<?= base_url('customer/waitingpayment') ?>" class="btn btn-warning btn-sm mr-1"><i class="fa fa"></i>&nbsp;Waiting For Payment</a>
							<?php endif ?>
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
											<td>Kode Customer</td>
											<td>Nama Customer</td>
											<td>Telepon</td>											
											<td>Alamat</td>
											<td>No. Polisi</td>
											<td>No. Rangka</td>
											<td>No. Mesin</td>
											<td>Tipe Mobil</td>
											<td>Keterangan</td>
											<td>Status</td>
											<?php if ($this->session->login['role'] == 'admin') : ?>
												<td>Aksi</td>
											<?php endif ?>
											<?php if ($this->session->login['role'] == 'pemilik') : ?>
												<td>Aksi</td>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_customer as $customer) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $customer->no_antre ?></td>
												<td><?= $customer->kode ?></td>
												<td><?= $customer->nama ?></td>
												<td><?= $customer->telepon ?></td>
												<td><?= $customer->alamat ?></td>
												<td><?= $customer->no_polisi ?></td>
												<td><?= $customer->no_rangka ?></td>
												<td><?= $customer->no_mesin ?></td>
												<td><?= $customer->tipe_mobil ?></td>
												<td><?= $customer->keterangan ?></td>
												<?php if($customer->status == 0) :?>
													<td><span>On Progress</span></td>
												<?php endif ?>
												<?php if($customer->status == 1) :?>
													<td><span>Waiting for Payment</span></td>
												<?php endif ?>
												<?php if($customer->status == 2) :?>
													<td><span>Finished</span></td>
												<?php endif ?>
												<?php if ($this->session->login['role'] == 'admin') : ?>
													<td>
														<a href="<?= base_url('customer/detail/' . $customer->kode) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
														<a href="<?= base_url('customer/ubah/' . $customer->kode) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
														<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('customer/hapus/' . $customer->kode) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
													</td>
												<?php endif ?>
												<?php if ($this->session->login['role'] == 'pemilik') : ?>
													<td>
														<a href="<?= base_url('customer/detail/' . $customer->kode) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
														<a href="<?= base_url('customer/ubah/' . $customer->kode) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
														<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('customer/hapus/' . $customer->kode) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
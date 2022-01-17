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
						<div class="card-header"><strong>Daftar Barang</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td>No</td>
											<td>Kode Barang</td>
											<td>Nama Barang</td>
											<td>Harga Satuan</td>
											<td>Stok Masuk</td>
											<td>Tanggal Masuk</td>
											
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_detail_barang as $details) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $details->kode_barang ?></td>
												<td><?= $details->nama_barang ?></td>
												<td><?= $details->harga_satuan ?></td>
												<td><?= $details->stok_masuk ?> <?= strtoupper($details->satuan) ?></td>
												<td><?= $details->tanggal_masuk ?></td>
												
											</tr>
										<?php endforeach ?>
                                        
									</tbody>
									
								</table>
								<br>
                                <?php if ($this->session->login['role'] == 'admin') : ?>
								<a href="<?= base_url('barang/reorder/' . $details->kode_barang) ?>"" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Re-Order</a>
							     <?php endif ?>
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
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
                                                <td><strong>Kode Keluar</strong></td>
												<td><strong>Nama Barang</strong></td>
                                                <td><strong>Jumlah</strong></td>
                                                <td><strong>Satuan</strong></td>
												<td><strong>Harga</strong></td>
                                                
											</tr>
										</thead>
										<tbody>
											<?php foreach ($all_detail_keluar as $detail_keluar) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $detail_keluar->no_keluar ?></td>
													<td><?= $detail_keluar->nama_barang?></td>
                                                    <td><?= $detail_keluar->jumlah?></td>
                                                    <td><?= $detail_keluar->satuan?></td>
                                                    <td><?= $detail_keluar->sub_total?></td>
													
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
									<span>Total Yang Harus Dibayarkan :</span>
									<br>
									<span id="val"></span>
									<br>
									<br>
									<div>
									<a onclick="return confirm('Apakah Sudah Selesai Bayar?')" href="<?= base_url('customer/selesaibayar/' . $detail_keluar->no_antre) ?>" class="btn btn-success btn-sm"><i class="fa"></i>&nbsp;&nbsp;Pembayaran Selesai</a>
									<a href="<?= base_url('customer/invoice/' . $detail_keluar->no_antre) ?>" class="btn btn-success btn-sm"><i class="fa"></i>&nbsp;&nbsp;Print Invoice</a>
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

    <script>		
		var table = document.getElementById("dataTable"), sumVal = 0;
		<?php foreach ($all_detail_keluar as $detail_keluar) : ?>
                sumVal = sumVal + parseInt(<?= $detail_keluar->sub_total?>);
		<?php endforeach ?>
            
            document.getElementById("val").innerHTML = "Rp." + sumVal;
            console.log(sumVal);
    </script>
</body>

</html>
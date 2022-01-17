<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">

    #printable { display: none; }

    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
    </style>
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
						<div id="non-printable" class="float-left">
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
						<div class="card-header"><strong>Barcode Barang</strong></div>
						<div class="card-body">
							    <div id="printableArea">
                                <?php foreach ($all_detail_barang as $barang) : ?>
                                 <?php
                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barang->kode_barang, $generator::TYPE_CODE_128)) . '">';  
                                ?>
                                <br>
                                <?=$barang->kode_barang?>
                                <?php endforeach ?>
                                </div>
								<input type="button" onclick="printDiv('printableArea')" value="Print Barcode" />
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
	<script>
		function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
	</script>
</body>

</html>
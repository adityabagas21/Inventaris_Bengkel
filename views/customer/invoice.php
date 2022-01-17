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
						<div id="non-printable" class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						
					</div>
					<hr>
					<div class="card shadow">
							<hr>
							<div class="row">
								<div class="col-md-12">
                <div class="card-body">
				<div id="printableArea" class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <div class="container mt-5">
    
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-uppercase">Invoice</h1>
                        <div class="billed"><span class="font-weight-bold text-uppercase">PT. Berkah Sembilan Sembilan</span>
                        
                   
                <div class="mt-3">
                    <div class="table-responsive" >
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_detail_keluar as $detail_keluar) : ?>
                                <tr>
                                <td><?= $detail_keluar->nama_barang?></td>
                                 <td><?= $detail_keluar->jumlah?></td>
                                <td><?= $detail_keluar->satuan?></td>
                                <td><?= $detail_keluar->sub_total?></td>
                             </tr>                                                       
                                <?php endforeach ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Total Tagihan Akhir</th>
                                    <td><span id="val"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
         </div>
        
        <input type="button" onclick="printDiv('printableArea')" value="Print" />
    </div>
</div>
									<div>
									
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
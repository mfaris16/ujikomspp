		<?php $total_uang = 0;
			foreach($seluruh_pembayaran as $sp){
				$total_uang = $total_uang+$sp['jumlah_bayar'];
			}
		?>
<section id="" class="mt-3">
    <div class="container">
        <h5><?= $title ?>, <?= $this->session->userdata('level') ?></h5>
        <div class="row mt-3">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h5><?php echo 'Rp.'.$total_uang; ?></h5>
                    <p class="card-title">Total seluruh pembayaran SPP</p>
                	</div>
                </div>
            </div>
			<div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h5><?php echo $siswa_bayar; ?></h5>
                    <p class="card-title">Siswa yang sudah bayar.</p>
                	</div>
                </div>
            </div>
			<div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                    <h5><?php echo $siswa_belum_bayar; ?></h5>
                    <p class="card-title">Siswa yang belum membayar sama sekali.</p>
                	</div>
                </div>
            </div>
        </div>
    </div>
</section>

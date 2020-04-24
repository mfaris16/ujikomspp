<div class="container">
	<div class="mt-3">
	<h5><?= $title; ?></h5><br>
	<form method="post" action="<?php echo site_url('Pembayaran/Cari_NIS_Pembayaran') ?>" class="form-group col-md-6">
		<label>Masukan NIS Siswa : </label>
		<input type="text" name="nis" required="" placeholder="NIS Siswa..." class="form-control"><br>
		<button class="btn btn-sm btn-success"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
	</form>
	</div>
</div>

<!DOCTYPE html>
<html>
<head>
	<title>Profile | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Profile/Profile_petugas.css') ?>">
</head>
<body>
	<br><br><br><br>

	<div class="content-home">
		<h5>Ubah Password</h5><br>
		<form method="post" action="<?php echo site_url('Admin/Proses_Ubah_Password') ?>" class="form-group col-md-6">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			Password Lama :
			<input type="password" name="pass_lama" required="" placeholder="Masukan Password Lama..." class="form-control">
			Password Baru :
			<input type="password" name="pass_baru" required="" placeholder="Masukan Password Baru..." class="form-control">
			Masukan Ulang  :
			<input type="password" name="pass_baru2" required="" placeholder="Masukan Ulang Password Baru..." class="form-control"><br>
			<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
		</form>
	</div>

	<br><br><br><br><br>
</body>
</html>

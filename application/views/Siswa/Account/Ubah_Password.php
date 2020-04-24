<!DOCTYPE html>
<html>
<head>
	<title>Ubah Password | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Siswa/Account/Ubah_Password.css') ?>">
</head>
<body>
	<br><br><br><br>

	<center>
		<div class="container col-md-8">
			<h5>Ubah Password</h5><br>
			<form method="post" action="<?php echo site_url('Siswa/Proses_Ubah_Password') ?>" class="form-group col-md-6">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<br><p>Password Lama :</p>
				<input type="password" name="pass_lama" required="" placeholder="Masukan Password Lama..." class="form-control">
				<br><p>Password Baru :</p>
				<input type="password" name="pass_baru" required="" placeholder="Masukan Password Baru..." class="form-control">
				<br><p>Masukan Ulang  :</p>
				<input type="password" name="pass_baru2" required="" placeholder="Masukan Ulang Password Baru..." class="form-control"><br>
				<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
			</form>
		</div>
	</center>

	<br><br><br><br><br>
</body>
</html>

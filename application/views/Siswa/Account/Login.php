<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/Siswa/Account/Login.css') ?>">

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/js/jquery-3.2.1.js') ?>">
</head>
<body>
	<div class="card mx-auto" id="card-login">
		<form method="post" action="<?php echo site_url('Siswa/Proses_Login') ?>" class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		<h4 class="text-center mt-3"><i class="fa fa-user"></i>&nbsp;&nbsp;LOGIN SISWA</h4>
		<?= $this->session->flashdata('message'); ?>
			<div class="container">
				<div class="card-text col-md-11 mt-3">
					<input type="text" name="nis" placeholder="Masukan NIS..." required="" class="form-control"><br>
					<input type="password" name="password" placeholder="Masukan Password..." required="" class="form-control"><br>
					<button class="btn btn-success" style="width: 100%;">Login</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Account/Login.css') ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<center>
	<div class="card" id="card-login">
		
		<form method="post" action="<?php echo site_url('Petugas/Proses_Login') ?>" class="form-group">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div>
				<h4 style="padding: 40px 0 30px 0;"><i class="fa fa-user-secret"></i>&nbsp;&nbsp;LOGIN ADMIN</h4>
			</div>
			<div class="container">
				<div class="card-text col-md-11">
					<input type="text" name="username" placeholder="Username..." required="" class="form-control"><br>
					<input type="password" name="password" placeholder="Password..." required="" class="form-control"><br>
					<button class="btn btn-success" style="width: 100%;">Login</button>
				</div>
			</div>
		</form>

	</div>
	</center>
</body>
</html>

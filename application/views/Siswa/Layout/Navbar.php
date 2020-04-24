<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Siswa/Layout/Navbar.css') ?>">

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
</head>
<body>
	<nav class="navbar">
		<div class="container">
			<a href="<?php echo site_url('Siswa/Home'); ?>" id="judul-web"><h3><i class="fa fa-money"></i>&nbsp;&nbsp;SPP Siswa</h3></a>
			<div class="navbar-expand-lg">
				<li class="nav-item"><a href="<?php echo site_url('Siswa/Profile') ?>"><i class="fa fa-user" style="font-size: 20px;"></i>&nbsp;&nbsp;<?php echo $this->session->userdata('nama'); ?></a></li>
			</div>
		</div>
	</nav>
</body>
</html>

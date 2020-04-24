<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title><?= $title; ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">SPP</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
		<?php if($this->session->userdata('level') == 'petugas') { ?>
      	<li class="nav-item active">
        	<a class="nav-link" href="<?php echo site_url('Pembayaran/Dashboard') ?>">Dashboard <span class="sr-only">(current)</span></a>
      	</li>
      	<li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('Pembayaran/Pencarian_Data_Siswa') ?>">Input Pembayaran SPP</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('Pembayaran/Data_Pembayaran_SPP') ?>">Data Pembayaran SPP</a>
		</li>
		<form class="form-inline my-2 my-lg-0">
			<a href="<?php echo site_url('Admin/Profile') ?>" id="profile" class="btn btn-sm btn-primary"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a>
		</form>
		<?php }else{ ?>
			<li class="nav-item active">
        	<a class="nav-link" href="<?php echo site_url('Pembayaran/Dashboard') ?>">Dashboard <span class="sr-only">(current)</span></a>
      	</li>
      	<li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('Pembayaran/Pencarian_Data_Siswa') ?>">Input Pembayaran SPP</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('Pembayaran/Data_Pembayaran_SPP') ?>">Data Pembayaran SPP</a>
		</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Admin/Data_Siswa') ?>">CRUD Data Siswa</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Admin/Data_Kelas') ?>">CRUD Data Kelas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Admin/Data_Petugas') ?>">CRUD Data Petugas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo site_url('Admin/Data_SPP') ?>">CRUD Data SPP</a>
			</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<a href="<?php echo site_url('Admin/Profile') ?>" id="profile" class="btn btn-sm btn-primary"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a>
			</form>
			<?php } ?>
  </div>
</nav>

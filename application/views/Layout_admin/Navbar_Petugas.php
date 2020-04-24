<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title><?php echo $title; ?></title>
</head>
<body>
	
		<div class="nav-atas">
			<a href="<?php echo site_url('Admin/Profile') ?>" id="profile" class="btn btn-sm btn-primary"><i class="fa fa-user"></i>&nbsp;&nbsp;Profile</a>
		</div>

		<div class="nav-kiri">
			<a href="<?php echo site_url('Pembayaran/Dashboard') ?>" style="text-decoration: none;"><h4 id="nama-web"><i class="fa fa-money"></i>&nbsp;&nbsp;SPP SMEA</h4></a>

			<div class="menu">
				<ul>
					<a href="<?php echo site_url('Pembayaran/Dashboard') ?>">
						<li style="border-bottom: 1px solid rgba(100,100,100,.1);">
							<div class="row">
								<div class="col col-md-2 icon-menu">
									<i class="fa fa-home" style="font-size: 20px;"></i>
								</div>
								<div class="col">
									<p>Dashboard</p>
								</div>
							</div>
						</li>
					</a>
					<a href="<?php echo site_url('Pembayaran/Pencarian_Data_Siswa') ?>">
						<li style="border-bottom: 1px solid rgba(100,100,100,.1);">
							<div class="row">
								<div class="col col-md-2 icon-menu">
									<i class="fa fa-dollar" style="font-size: 20px;"></i>
								</div>
								<div class="col">
									<p>Input Pembayaran SPP</p>
								</div>
							</div>
						</li>
					</a>
					<a href="<?php echo site_url('Pembayaran/Data_Pembayaran_SPP') ?>">
						<li style="border-bottom: 1px solid rgba(100,100,100,.1);">
							<div class="row">
								<div class="col col-md-2 icon-menu">
									<i class="fa fa-list-alt" style="font-size: 20px;"></i>
								</div>
								<div class="col">
									<p>Data Pembayaran SPP</p>
								</div>
							</div>
						</li>
					</a>
				</ul>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
</body>
</html>

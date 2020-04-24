<!DOCTYPE html>
<html>
<head>
	<title>Website Pembayaran SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Home_Spp.css') ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/bootstrap.min.js') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/bootstrap/js/jquery-3.2.1.js') ?>">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<center>
	<div class="container" id="container-kotak">
		<div class="card bg-white col-md-5" >
			<div>
				<h4 style="padding: 40px 0 30px 0;"><i class="fa fa-money"></i>&nbsp;&nbsp;MASUK SEBAGAI</h4>
			</div>
			
			<div class="row">
				<div class="col">
					<a href="<?php echo site_url('Petugas') ?>" style="text-decoration: none;">
						<div class="btn btn-success" style="width: 200px;">
							<p class="card-text" style="padding: 10px 50px 10px 50px;"><i class="fa fa-user-secret"></i>&nbsp;Admin</p>
						</div>
					</a>
				</div>

				<div class="col">
					<a href="<?php echo site_url('Siswa/Login_Siswa') ?>" style="text-decoration: none;">
						<div class="btn btn-success" style="width: 200px;">
							<p class="card-text" style="padding: 10px 50px 10px 50px;"><i class="fa fa-user"></i>&nbsp;Siswa</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	</center>
</body>
</html>

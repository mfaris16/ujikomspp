<!DOCTYPE html>
<html>
<head>
	<title>Home | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Siswa/Home.css') ?>">
</head>
<body>
	<br><br>
	<center><h5>Selamat Datang, <?php echo $this->session->userdata('nama'); ?>!</h5></center><br>

	<center>
		<div class="container">
			<a href="<?php echo site_url('Siswa/Data_Pembayaran') ?>" class="card" style="text-decoration: none;color: #555;">Data Pembayaran</a>
		</div>
	</center>

	<br><br><br><br><br><br><br><br><br>
</body>
</html>
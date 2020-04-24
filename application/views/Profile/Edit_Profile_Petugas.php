<!DOCTYPE html>
<html>
<head>
	<title>Profile | SPP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/Profile/Edit_Profile_Petugas.css') ?>">
</head>
<body>
	<br><br><br><br>

	<div class="content-home">
		<h5>Edit Profile</h5><br>
		<form method="post" action="<?php echo site_url('Admin/Proses_Edit_Profile_Petugas/'.$edit->id_petugas) ?>" class="form-group col-md-6">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			Nama Petugas :
			<input type="text" name="nama" required="" placeholder="Nama Petugas..." value="<?php echo $edit->nama_petugas ?>" class="form-control">
			Username :
			<input type="text" name="username" required="" placeholder="Username..." value="<?php echo $edit->username ?>" class="form-control"><br>
			<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
		</form>
	</div>

	<br><br><br><br><br>
</body>
</html>

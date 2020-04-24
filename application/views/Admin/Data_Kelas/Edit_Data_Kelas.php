	<div class="container">
	<div class="mt-3">
		<h5>Edit Data Kelas</h5>
		<form method="post" action="<?php echo site_url('Admin/Proses_Edit_Data_Kelas/'.$kelas->id_kelas) ?>" class="form-group col-md-6">
			Kelas :
			<input type="text" name="kelas" required="" value="<?php echo $kelas->nama_kelas ?>" class="form-control">
			Kompetensi Keahlian :
			<input type="text" name="kompetensi" required="" placeholder="Kompetensi Keahlian..." value="<?php echo $kelas->kompetensi_keahlian ?>" class="form-control"><br>
			<button class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Simpan</button>
		</form>
	</div>
	</div>

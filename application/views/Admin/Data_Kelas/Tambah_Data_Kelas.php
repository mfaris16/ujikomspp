		<div class="container">
		<div class="mt-3">
		<h5>Tambah Data Kelas</h5>
		<form method="post" action="<?php echo site_url('Admin/Proses_Tambah_Data_Kelas') ?>" class="form-group col-md-6">
			Kelas :
			<select name="kelas" required="" class="form-control">
				<option value="">- Pilih Kelas</option>
				<option value="X">X (Sepuluh)</option>
				<option value="XI">XI (Sebelas)</option>
				<option value="XII">XII (Dua Belas)</option>
			</select>
			Kompetensi Keahlian :
			<input type="text" name="kompetensi" required="" placeholder="Kompetensi Keahlian..." class="form-control"><br>
			<button class="btn btn-sm btn-success">Tambah</button>
		</form>
	</div>
	</div>

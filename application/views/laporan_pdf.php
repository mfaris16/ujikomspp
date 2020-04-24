<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
	</style>
</head>
<body>
<table class="table table-hover">
			<tr class="thead-light">
				<th>NO</th>
				<th>PETUGAS</th>
				<th>NIS</th>
				<th>SISWA/SISWI</th>
				<th>TGL BAYAR</th>
				<th>TAHUN DIBAYAR</th>
				<th>BULAN DIBAYAR</th>
				<th>JUMLAH BAYAR</th>
				<th>STATUS SISWA</th>
			</tr>
			<?php 
				$no=1;
				$bb=0;
				$jb=0; 

				$data_bulan_nama = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

				foreach($data as $d){
					for ($i=0; $i < $d['bulan_dibayar']; $i++) { 
						$nama_bulan = $data_bulan_nama[$i];
					}
				?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><?php echo $d['nama_petugas'] ?></td>
				<td><?php echo $d['nis'] ?></td>
				<td><?php echo $d['nama'] ?></td>
				<td><?php echo $d['tgl_bayar'] ?></td>
				<td><?php echo 'Tahun Ke '.$d['tahun_dibayar'] ?></td>
				<td><?php echo $nama_bulan; ?></td>
				<td><?php echo 'Rp.'.$d['jumlah_bayar'].';' ?></td>
				<td><?php echo $d['status_pembayaran_siswa']; ?></td>
			</tr>
			<?php 
				$bb = $bb+$d['bulan_dibayar'];
				$jb = $jb+$d['jumlah_bayar'];
			} ?>
			<tr>
				<th colspan="7" style="text-align: right;">Total:</th>
				<th colspan="2"><?php echo 'Rp.'.$jb.';'; ?></th>
			</tr>
		</table>

</body>
</html>

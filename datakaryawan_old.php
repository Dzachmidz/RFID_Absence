<!DOCTYPE html>
<html>

<head>
	<?php include "header.php"; ?>
	<title>Data Karyawan</title>
</head>

<body>

	<?php include "menu.php"; ?>

	<!--isi -->
	<div class="container-fluid">
		<h3>Data Karyawan</h3>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: blueviolet; color: white;">
					<th style="width: 10px; text-align: center">No.</th>
					<th style="width: 200px; text-align: center">No.Kartu</th>
					<th style="width: 400px; text-align: center">Nama</th>
					<th style="text-align: center">Alamat</th>
					<th style="width: 100px; text-align: center">Aksi</th>
				</tr>
			</thead>
			<tbody>

				<?php
				//koneksi ke database
				include "koneksi.php";

				//baca data karyawan
				$sql = mysqli_query($konek, "select * from karyawan");
				$no = 0;
				while ($data = mysqli_fetch_array($sql)) {
					$no++;
				?>

					<tr>
						<td> <?php echo $no; ?> </td>
						<td> <?php echo $data['nokartu']; ?> </td>
						<td> <?php echo $data['nama']; ?> </td>
						<td> <?php echo $data['alamat']; ?> </td>
						<td>
							<a class="btn btn-primary btn-sm" href="edit.php?id=<?php echo $data['id']; ?>" title="Ubah" style="background-color: blueviolet;"><i class="bi bi-pencil-square"></i></a>
							| <a class="btn btn-danger btn-sm" href="hapus.php?id=<?php echo $data['id']; ?>" title="Hapus"> <i class="bi bi-trash-fill"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		<!-- tombol tambah data karyawan -->
		<a href="tambah.php"> <button class="btn" style="background-color: blueviolet; color: white;">Tambah Data Karyawan</button> </a>
	</div>

	<?php include "footer.php"; ?>

</body>

</html>
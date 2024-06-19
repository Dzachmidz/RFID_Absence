<!-- proses penyimpanan -->

<?php 
	include "koneksi.php";

	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$nokartu = $_POST['nokartu'];
		$nama    = $_POST['nama'];
		$alamat  = $_POST['alamat'];

		//simpan ke tabel karyawan
		$simpan = mysqli_query($konek, "insert into karyawan(nokartu, nama, alamat)values('$nokartu', '$nama', '$alamat')");

		//jika berhasil tersimpan, tampilkan pesan Tersimpan,
		//kembali ke data karyawan
		if($simpan)
        {
            echo '<script>
			setTimeout(function() {
				document.getElementById("popupAlert").style.display = "block";
				setTimeout(function() {
					document.getElementById("popupAlert").style.display = "none";
					window.location.href="datakaryawan.php";
				}, 2000); // Menghilangkan pop-up setelah 3 detik
			}, 1000); // Menampilkan pop-up setelah 1 detik (silakan sesuaikan dengan kebutuhan Anda)
			
		</script>';
        }
		else
		{
			echo "
				<script>
					alert('Gagal Terhapus');
					location.replace('datakaryawan.php');
				</script>
			";
		}

	}

	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Karyawan</title>

	<!-- pembacaan no kartu otomatis -->
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#norfid").load('nokartu.php')
			}, 0);  //pembacaan file nokartu.php, tiap 1 detik = 1000
		});
	</script>
<style>
    /* Styles untuk mempercantik tampilan pop-up */
	.popup {
        position: fixed;
        display: flex;
        flex-direction: row;
        text-align:center;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #ffffff;
        
        border-radius: 10px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }
    .popup img{
        width: 170px;
        height: 170px;
        margin-bottom: 15px;
    }
</style>
</head>
<body>

	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Karyawan</h3>

		<!-- form input -->
		<form method="POST">
			<div id="norfid"></div>

			<div class="form-group">
				<label>Nama Karyawan</label>
				<input type="text" name="nama" id="nama" placeholder="nama karyawan" class="form-control" style="width: 400px">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat" id="alamat" placeholder="alamat" style="width: 400px"></textarea>
			</div>

			<button class="btn" style="background-color: blueviolet; color: white;" name="btnSimpan" id="btnSimpan">Simpan</button>
		</form>
	</div>
	<div id="popupAlert" class="popup" style="display:none;">
		<img src="images/success.png">
		<div>Berhasil tambah data</div>
	</div>



	<?php include "footer.php"; ?>

</body>
</html>
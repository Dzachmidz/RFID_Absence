<?php
	include "koneksi.php";

	//baca id data yang akan dihapus
	$id = $_GET['id'];

	//hapus data
	$hapus = mysqli_query($konek, "delete from karyawan where id='$id'");

	//jika berhasil terhapus tampilkan pesan Terhapus
	//kemudian kembali ke data karyawan
	if($hapus)
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

?>

<html>
	<style>
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
	<div id="popupAlert" class="popup" style="display:none;">
		<img src="images/delete.png">
		<div>Data Dihapus</div>
	</div>
</html>
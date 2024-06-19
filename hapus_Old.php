<?php
	include "koneksi.php";

	// Check if the delete action is confirmed
	if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
		$id = $_GET['id'];

		// Hapus data
		$hapus = mysqli_query($konek, "DELETE FROM karyawan WHERE id='$id'");

		// Jika berhasil terhapus tampilkan pesan Terhapus
		// kemudian kembali ke data karyawan
		if ($hapus) {
			echo "<script>
				Swal.fire({
					title: 'Deleted!',
					text: 'Data has been deleted.',
					icon: 'success'
				}).then(() => {
					window.location.href='datakaryawan.php';
				});
			</script>";
		} else {
			echo "<script>
				Swal.fire({
					title: 'Error!',
					text: 'Failed to delete data.',
					icon: 'error'
				}).then(() => {
					window.location.href='datakaryawan.php';
				});
			</script>";
		}
		exit; // Ensure the script stops here after deletion
	}

	// If the id parameter is set, show the confirmation dialog
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
?>

<html>
<head>
	<!-- Include SweetAlert CSS and JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
	<script>
		// Use SweetAlert for confirmation before deletion
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!"
		}).then((result) => {
			if (result.isConfirmed) {
				// Proceed with deletion if confirmed
				window.location.href = 'hapus.php?action=delete&id=<?php echo $id; ?>';
			} else {
				// Redirect to data karyawan if not confirmed
				window.location.href = 'datakaryawan.php';
			}
		});
	</script>
</body>
</html>

<?php
	}
?>

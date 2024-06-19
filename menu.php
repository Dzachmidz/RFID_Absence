<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABSENSI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color:blueviolet;
            border-color: transparent;
            color: white;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav > li > a {
            color: white !important;
        }
        .navbar-custom .navbar-brand:hover,
        .navbar-custom .nav > li > a:hover {
            color: #000000 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">ABSENSI</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="datakaryawan.php">Data Karyawan</a></li>
                <li><a href="absensi.php">Rekapitulasi Absensi</a></li>
                <li><a href="scan.php">Scan Kartu</a></li>
            </ul>
        </div>
    </nav>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>

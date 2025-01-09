<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sistem Informasi Rumah Sakit</title>
    <style>
        /* Reset beberapa style default */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        /* Styling untuk judul utama */
        h1 {
            font-size: 36px;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Styling untuk subjudul */
        h2 {
            font-size: 28px;
            color: #34495e;
            margin-bottom: 15px;
        }

        /* Styling untuk daftar pilihan menu */
        ul {
            list-style-type: none;
            padding-left: 0;
        }

        ul li {
            margin: 10px 0;
        }

        ul li a {
            display: block;
            padding: 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Styling saat hover pada link */
        ul li a:hover {
            background-color: #2980b9;
        }

        /* Styling untuk container dari dashboard */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styling untuk daftar menu */
        ul li a {
            font-weight: bold;
            text-align: center;
            width: 50%
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Informasi Rumah Sakit Surakarta</h1>
        <h2>Pilihan</h2>
        <ul>
            <li><a href="add_patient.php">Pendaftaran pasien</a></li>
            <li><a href="daftar_patient.php">Daftar pasien</a></li>
            <li><a href="manajemen_jadwal_dokter.php">Manajemen jadwal dokter</a></li>
            <li><a href="penjadwalan_operasi.php">Penjadwalan operasi</a></li>
            <li><a href="penyimpanan_rekam_medis.php">Penyimpanan rekam medis</a></li>
            <li><a href="manajemen_apotek.php">Manajemen apotek</a></li>
        </ul>
    </div>
</body>
</html>

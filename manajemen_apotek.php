<?php
// Koneksi ke database
$host = "localhost";
$username = "root";   // Pengguna default XAMPP
$password = "";       // Password default XAMPP
$dbname = "pharmacy_db";  // Pastikan nama database sesuai


$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah obat baru
if (isset($_POST['tambah_obat'])) {
    $nama_obat = $_POST['nama_obat'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO obat (nama_obat, harga, stok) VALUES ('$nama_obat', '$harga', '$stok')";
    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Hapus obat
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM obat WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Obat berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data obat
$sql = "SELECT * FROM obat";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Apotek</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #1f6f8b;
        }
        a {
            color: #f44336;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Manajemen Apotek</h1>
    
    <!-- Form untuk menambah obat -->
    <form method="POST" action="manajemen_apotek.php">
        <h2>Tambah Obat</h2>
        <label for="nama_obat">Nama Obat:</label>
        <input type="text" name="nama_obat" required><br><br>

        <label for="harga">Harga:</label>
        <input type="number" step="0.01" name="harga" required><br><br>

        <label for="stok">Stok:</label>
        <input type="number" name="stok" required><br><br>

        <input type="submit" name="tambah_obat" value="Tambah Obat">
    </form>

    <h2>Daftar Obat</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Obat</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nama_obat'] . "</td>";
                    echo "<td>" . number_format($row['harga'], 2, ',', '.') . "</td>";
                    echo "<td>" . $row['stok'] . "</td>";
                    echo "<td><a href='manajemen_apotek.php?hapus=" . $row['id'] . "'>Hapus</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data obat</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>

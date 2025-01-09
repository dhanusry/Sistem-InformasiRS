<?php
include 'config.php';

// Fungsi untuk mengambil semua jadwal dokter
function getAllSchedules($mysqli) {
    $result = $mysqli->query("SELECT a.id, u.username AS doctor_name, a.appointment_date, a.status FROM appointments a JOIN users u ON a.doctor_id = u.id WHERE u.role = 'doctor'");
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $status = $_POST['status'];

    $stmt = $mysqli->prepare("INSERT INTO appointments (doctor_id, appointment_date, status) VALUES (?, ?, ?)");
    $stmt->bind_param('iss', $doctor_id, $appointment_date, $status);

    if ($stmt->execute()) {
        echo "Jadwal berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Jadwal Dokter</title>
    <style>
        /* Styling untuk keseluruhan halaman */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        h2 {
            margin-top: 40px;
        }

        /* Styling form */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="date"], select, input[type="submit"], input[list="doctor_list"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            cursor: pointer;
            width: auto;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #1f6f8b;
        }

        /* Styling tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Styling untuk responsive */
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }

            label, input[type="date"], select, input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Manajemen Jadwal Dokter</h1>

    <h2>Tambah Jadwal Baru</h2>
    <form method="POST" action="manajemen_jadwal_dokter.php">
        <label for="doctor_id">Dokter:</label><br>
        <input list="doctor_list" name="doctor_id" id="doctor_id" required>
        <datalist id="doctor_list">
            <?php
            // Ambil daftar dokter dari tabel 'users'
            $doctors = $mysqli->query("SELECT id, username FROM users WHERE role = 'doctor'");
            // Loop untuk menampilkan nama dokter dan id-nya dalam datalist
            while ($doctor = $doctors->fetch_assoc()):
            ?>
                <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['username']; ?></option>
            <?php endwhile; ?>
        </datalist><br>
        
        <label for="appointment_date">Tanggal Janji Temu:</label><br>
        <input type="date" id="appointment_date" name="appointment_date" required><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="pending">Pending</option>
            <option value="terjadwal">Terjadwal</option>
            <option value="completed">Completed</option>
        </select><br><br>

        <input type="submit" value="Tambah Jadwal">
    </form>

    <h2>Daftar Jadwal Dokter</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Dokter</th>
            <th>Tanggal Janji Temu</th>
            <th>Status</th>
        </tr>
        <?php
        $schedules = getAllSchedules($mysqli);
        foreach ($schedules as $schedule) {
            echo "<tr>
                    <td>{$schedule['id']}</td>
                    <td>{$schedule['doctor_name']}</td>
                    <td>{$schedule['appointment_date']}</td>
                    <td>{$schedule['status']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>

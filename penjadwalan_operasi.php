<?php
include 'config.php';

// Fungsi untuk mengambil semua jadwal operasi
function getAllSurgerySchedules($mysqli) {
    $result = $mysqli->query("SELECT o.id, p.name AS patient_name, u.username AS doctor_name, o.surgery_date, o.status FROM surgeries o JOIN patients p ON o.patient_id = p.id JOIN users u ON o.doctor_id = u.id WHERE u.role = 'doctor'");
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $surgery_date = $_POST['surgery_date'];
    $status = $_POST['status'];

    $stmt = $mysqli->prepare("INSERT INTO surgeries (patient_id, doctor_id, surgery_date, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('iiss', $patient_id, $doctor_id, $surgery_date, $status);

    if ($stmt->execute()) {
        echo "<p class='success-message'>Jadwal operasi berhasil ditambahkan!</p>";
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penjadwalan Operasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        form {
            background: #fff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        label {
            font-size: 1.1em;
            margin: 5px 0;
            display: inline-block;
        }
        input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #1f6f8b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #2980b9;
            color: white;
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Penjadwalan Operasi</h1>

        <h2>Tambah Jadwal Operasi Baru</h2>
        <form method="POST" action="penjadwalan_operasi.php">
            <label for="patient_id">ID Pasien:</label><br>
            <input type="number" id="patient_id" name="patient_id" required><br>
            <label for="doctor_id">ID Dokter:</label><br>
            <input type="number" id="doctor_id" name="doctor_id" required><br>
            <label for="surgery_date">Tanggal Operasi:</label><br>
            <input type="date" id="surgery_date" name="surgery_date" required><br>
            <label for="status">Status:</label><br>
            <select id="status" name="status" required>
                <option value="scheduled">Scheduled</option>
                <option value="completed">Completed</option>
            </select><br><br>
            <input type="submit" value="Tambah Jadwal Operasi">
        </form>

        <h2>Daftar Jadwal Operasi</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Pasien</th>
                <th>Nama Dokter</th>
                <th>Tanggal Operasi</th>
                <th>Status</th>
            </tr>
            <?php
            $surgery_schedules = getAllSurgerySchedules($mysqli);
            foreach ($surgery_schedules as $schedule) {
                echo "<tr>
                        <td>{$schedule['id']}</td>
                        <td>{$schedule['patient_name']}</td>
                        <td>{$schedule['doctor_name']}</td>
                        <td>{$schedule['surgery_date']}</td>
                        <td>{$schedule['status']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

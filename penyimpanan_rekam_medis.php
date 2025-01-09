<?php
include 'config.php';

// Fungsi untuk mengambil semua rekam medis
function getAllMedicalRecords($mysqli) {
    $result = $mysqli->query("SELECT r.id, p.name AS patient_name, r.diagnosis, r.treatment, r.record_date FROM medical_records r JOIN patients p ON r.patient_id = p.id");
    return $result->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $record_date = $_POST['record_date'];

    $stmt = $mysqli->prepare("INSERT INTO medical_records (patient_id, diagnosis, treatment, record_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $patient_id, $diagnosis, $treatment, $record_date);

    if ($stmt->execute()) {
        echo "<p class='success-message'>Rekam medis berhasil ditambahkan!</p>";
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penyimpanan Rekam Medis</title>
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
        input[type="number"], input[type="date"], textarea {
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
        <h1>Penyimpanan Rekam Medis</h1>

        <h2>Tambah Rekam Medis Baru</h2>
        <form method="POST" action="penyimpanan_rekam_medis.php">
            <label for="patient_id">ID Pasien:</label><br>
            <input type="number" id="patient_id" name="patient_id" required><br>
            <label for="diagnosis">Diagnosis:</label><br>
            <textarea id="diagnosis" name="diagnosis" required></textarea><br>
            <label for="treatment">Perawatan:</label><br>
            <textarea id="treatment" name="treatment" required></textarea><br>
            <label for="record_date">Tanggal Rekam:</label><br>
            <input type="date" id="record_date" name="record_date" required><br><br>
            <input type="submit" value="Simpan Rekam Medis">
        </form>

        <h2>Daftar Rekam Medis</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Pasien</th>
                <th>Diagnosis</th>
                <th>Perawatan</th>
                <th>Tanggal Rekam</th>
            </tr>
            <?php
            $medical_records = getAllMedicalRecords($mysqli);
            foreach ($medical_records as $record) {
                echo "<tr>
                        <td>{$record['id']}</td>
                        <td>{$record['patient_name']}</td>
                        <td>{$record['diagnosis']}</td>
                        <td>{$record['treatment']}</td>
                        <td>{$record['record_date']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

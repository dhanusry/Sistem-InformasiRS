<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $stmt = $mysqli->prepare("INSERT INTO patients (name, dob, gender, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $name, $dob, $gender, $address);

    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label, input, select, textarea {
            margin-bottom: 15px;
            font-size: 16px;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }
    </style>
</head>
<body>
    <h1>Tambah Pasien Baru</h1>
    <form method="post">
        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required>

        <label for="dob">Tanggal Lahir:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male">Laki-laki</option>
            <option value="female">Perempuan</option>
        </select>

        <label for="address">Alamat:</label>
        <textarea id="address" name="address" required></textarea>

        <input type="submit" value="Tambah">
    </form>
</body>
</html>

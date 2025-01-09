<?php
include 'config.php';

$id = $_GET['id'];
$result = $mysqli->query("SELECT * FROM patients WHERE id = $id");
$patient = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $stmt = $mysqli->prepare("UPDATE patients SET name = ?, dob = ?, gender = ?, address = ? WHERE id = ?");
    $stmt->bind_param('ssssi', $name, $dob, $gender, $address, $id);

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
    <title>Edit Pasien</title>
</head>
<body>
    <h1>Edit Data Pasien</h1>
    <form method="post">
        Nama: <input type="text" name="name" value="<?php echo $patient['name']; ?>" required><br>
        Tanggal Lahir: <input type="date" name="dob" value="<?php echo $patient['dob']; ?>" required><br>
        Gender: 
        <select name="gender">
            <option value="male" <?php echo ($patient['gender'] == 'male') ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="female" <?php echo ($patient['gender'] == 'female') ? 'selected' : ''; ?>>Perempuan</option>
        </select><br>
        Alamat: <textarea name="address" required><?php echo $patient['address']; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

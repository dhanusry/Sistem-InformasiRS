<?php
include 'config.php';

$id = $_GET['id'];
$stmt = $mysqli->prepare("DELETE FROM patients WHERE id = ?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Error: " . $stmt->error;
}
?>

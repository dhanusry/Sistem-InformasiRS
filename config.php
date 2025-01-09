<?php
$mysqli = new mysqli('localhost', 'root', '', 'sistem_informasirs');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

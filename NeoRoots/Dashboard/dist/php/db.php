<?php
$conn = new mysqli("localhost", "root", "", "neoroots");

if ($conn->connect_error) {
    die("Error: " . $conn->connect_error);
}
?>
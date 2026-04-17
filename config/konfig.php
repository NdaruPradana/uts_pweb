<?php
$conn = mysqli_connect("localhost", "root", "", "manajemenmahasiswa_pweb");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


?>
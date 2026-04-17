<?php
session_start();
include "../config/konfig.php";

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

        // Validasi kosong
    if ($nama == "" || $nim == "" || $jurusan == "") {
        echo "Data tidak boleh kosong!";
        return;
    }


    mysqli_query($conn, "UPDATE mahasiswa SET 
        nama='$nama',
        nim='$nim',
        jurusan='$jurusan'
        WHERE id='$id'
    ");

    header("Location: index.php");
}
?>

<h2>Edit Mahasiswa</h2>

<form method="POST">
    <input type="text" name="nama" value="<?= $row['nama']; ?>"><br>
    <input type="text" name="nim" value="<?= $row['nim']; ?>"><br>
    <input type="text" name="jurusan" value="<?= $row['jurusan']; ?>"><br>
    <button name="update">Update</button>
</form>
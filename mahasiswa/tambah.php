<?php
session_start();
include "../config/konfig.php";

if (isset($_POST['simpan'])) {

    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $jurusan = trim($_POST['jurusan']);

    // Validasi kosong
    if ($nama == "" || $nim == "" || $jurusan == "") {
        echo "Data tidak boleh kosong!";
        return;
    }

    mysqli_query($conn, "INSERT INTO mahasiswa VALUES ('','$nama','$nim','$jurusan')");
    header("Location: index.php");
}
?>

<h2>Tambah Mahasiswa</h2>

<form method="POST">
    <input type="text" name="nama" placeholder="Nama"><br>
    <input type="text" name="nim" placeholder="NIM"><br>
    <input type="text" name="jurusan" placeholder="Jurusan"><br>
    <button name="simpan">Simpan</button>
</form>
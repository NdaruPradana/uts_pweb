<?php
session_start();
include "../config/konfig.php";

// proteksi login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa 
        WHERE nama LIKE '%$keyword%' 
        OR nim LIKE '%$keyword%'");
} else {
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa");
}
?>

<form method="GET">
    <input type="text" name="keyword" placeholder="Cari nama / NIM">
    <button type="submit">Cari</button>
</form>
<br>

<h2>Data Mahasiswa</h2>

<a href="tambah.php">Tambah Data</a>
<a href="../dashboard.php">Kembali</a>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>

<?php $no = 1; ?>
<?php while ($row = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['nim']; ?></td>
    <td><?= $row['jurusan']; ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
        <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>
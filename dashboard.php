<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
?>


<h1>Selamat datang, <?php echo $_SESSION['user']['nama']; ?></h1>

<a href="mahasiswa/index.php">Kelola Mahasiswa</a>
<a href="auth/logout.php">Logout</a>
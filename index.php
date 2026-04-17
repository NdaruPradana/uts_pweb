<?php
session_start();

// Jika sudah login → langsung ke dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Sistem Mahasiswa</title>
</head>
<body>

    <h1>Selamat Datang di Sistem Manajemen Mahasiswa</h1>

    <p>Silakan login atau register untuk melanjutkan</p>

    <a href="auth/login.php">
        <button>Login</button>
    </a>

    <a href="auth/register.php">
        <button>Register</button>
    </a>

</body>
</html>
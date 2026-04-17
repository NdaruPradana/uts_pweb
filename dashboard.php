<?php
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

include 'config/konfig.php';

// Ambil statistik
$total_mahasiswa = 0;
$result = $conn->query("SELECT COUNT(*) as total FROM mahasiswa");
if ($result) {
    $total_mahasiswa = $result->fetch_assoc()['total'];
}

$nama_user = $_SESSION['nama'] ?? $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Manajemen Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="dashboard.php" class="navbar-brand">📚 Sistem Manajemen Mahasiswa</a>
            <div class="navbar-menu">
                <a href="dashboard.php">Dashboard</a>
                <a href="mahasiswa/index.php">Data Mahasiswa</a>
                <a href="auth/logout.php" style="color: #ef476f;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Dashboard</h1>
        
        <!-- Welcome Card -->
        <div class="card">
            <div class="card-header">
                <h3>Selamat Datang, <?php echo htmlspecialchars($nama_user); ?>! 👋</h3>
            </div>
            <div class="card-body">
                <p>Ini adalah sistem manajemen data mahasiswa. Anda dapat mengelola data mahasiswa melalui menu di atas.</p>
            </div>
        </div>
        
        <!-- Statistik -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Mahasiswa</h3>
                <div class="stat-number"><?php echo $total_mahasiswa; ?></div>
            </div>
            <div class="stat-card">
                <h3>Status</h3>
                <div class="stat-number">Active</div>
            </div>
            <div class="stat-card">
                <h3>Role</h3>
                <div class="stat-number">Admin</div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3>Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <a href="mahasiswa/tambah.php" class="btn btn-success">+ Tambah Mahasiswa Baru</a>
                <a href="mahasiswa/index.php" class="btn btn-primary">Lihat Data Mahasiswa</a>
            </div>
        </div>
    </div>
</body>
</html>
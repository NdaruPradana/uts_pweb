<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/konfig.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    

    $errors = [];
    if (empty($nim)) $errors[] = "NIM harus diisi!";
    if (empty($nama)) $errors[] = "Nama harus diisi!";
    if (empty($jurusan)) $errors[] = "Jurusan harus diisi!";
    

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM mahasiswa WHERE nim = ?");
        $stmt->bind_param("s", $nim);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "NIM sudah terdaftar!";
        }
        $stmt->close();
    }
    
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nim, $nama, $jurusan);
        
        if ($stmt->execute()) {
            header("Location: index.php?success=Data mahasiswa berhasil ditambahkan");
            exit();
        } else {
            $error = "Gagal menambahkan data!";
        }
        $stmt->close();
    } else {
        $error = implode("<br>", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa - Sistem Manajemen Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="../dashboard.php" class="navbar-brand">📚 Sistem Manajemen Mahasiswa</a>
            <div class="navbar-menu">
                <a href="../dashboard.php">Dashboard</a>
                <a href="index.php">Data Mahasiswa</a>
                <a href="../auth/logout.php" style="color: #ef476f;">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <div class="card-header">
                <h3>Tambah Data Mahasiswa</h3>
            </div>
            <div class="card-body">
                <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select id="jurusan" name="jurusan" class="form-control" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Teknik Komputer">Teknik Komputer</option>
                            
                        </select>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
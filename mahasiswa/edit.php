<?php
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/konfig.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data mahasiswa
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php?error=Data tidak ditemukan");
    exit();
}

$data = $result->fetch_assoc();
$stmt->close();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    
    // Validasi
    $errors = [];
    if (empty($nim)) $errors[] = "NIM harus diisi!";
    if (empty($nama)) $errors[] = "Nama harus diisi!";
    if (empty($jurusan)) $errors[] = "Jurusan harus diisi!";
    
    // Cek duplikat NIM (kecuali dirinya sendiri)
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM mahasiswa WHERE nim = ? AND id != ?");
        $stmt->bind_param("si", $nim, $id);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "NIM sudah terdaftar untuk mahasiswa lain!";
        }
        $stmt->close();
    }
    
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nim, $nama, $jurusan, $id);
        
        if ($stmt->execute()) {
            header("Location: index.php?success=Data mahasiswa berhasil diupdate");
            exit();
        } else {
            $error = "Gagal mengupdate data!";
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
    <title>Edit Mahasiswa - Sistem Manajemen Mahasiswa</title>
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
                <h3>Edit Data Mahasiswa</h3>
            </div>
            <div class="card-body">
                <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim" class="form-control" value="<?php echo htmlspecialchars($data['nim']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
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
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
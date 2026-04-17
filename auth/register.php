<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit();
}

include '../config/konfig.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $errors = [];
    
   
    if (empty($nama)) $errors[] = "Nama lengkap harus diisi!";
    if (empty($username)) $errors[] = "Username harus diisi!";
    if (empty($email)) $errors[] = "Email harus diisi!";
    if (empty($password)) $errors[] = "Password harus diisi!";
    

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }
    
  
    if (!empty($password)) {
        if (strlen($password) < 8) {
            $errors[] = "Password minimal 8 karakter!";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password harus mengandung minimal 1 huruf BESAR!";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = "Password harus mengandung minimal 1 huruf kecil!";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password harus mengandung minimal 1 angka!";
        }
        if ($password !== $confirm_password) {
            $errors[] = "Konfirmasi password tidak cocok!";
        }
    }
    

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "Username atau email sudah terdaftar!";
        }
        $stmt->close();
    }
    
   
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (nama, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $success = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Gagal mendaftar. Silakan coba lagi.";
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
    <title>Register - Sistem Manajemen Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Daftar Akun</h2>
                <p>Buat akun baru untuk memulai</p>
            </div>
            <div class="auth-body">
                <?php if($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?> <a href="login.php">Login di sini</a></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        <small class="text-muted">Minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka</small>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar</button>
                </form>
            </div>
            <div class="auth-footer">
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
        </div>
    </div>
</body>
</html>
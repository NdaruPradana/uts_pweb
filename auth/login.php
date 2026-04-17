<?php
session_start();
include "../config/konfig.php";
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil data user dari database
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    // Cek user ditemukan + verifikasi password
    if ($data && password_verify($password, $data['password'])) {

        // Simpan session
        $_SESSION['user'] = $data;

        // Redirect ke dashboard
        header("Location: ../dashboard.php");
        exit;

    } else {
        echo "Email atau password salah!";
    }
}

?>
<a href="../index.php">Kembali</a>
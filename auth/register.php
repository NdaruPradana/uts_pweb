<?php
include "../config/konfig.php";
?>



<form method="POST">
    <input type="text" name="nama" placeholder="Nama"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit" name="register">Register</button>
</form>

<?php
if (isset($_POST['register'])) {

    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Tidak boleh kosong
    if ($nama == "" || $email == "" || $password == "") {
        echo "Semua field wajib diisi!";
        return;
    }

    // 2. Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid!";
        return;
    }

    // 3. Validasi password
    if (
        strlen($password) < 8 ||
        !preg_match("/[A-Z]/", $password) ||
        !preg_match("/[a-z]/", $password) ||
        !preg_match("/[0-9]/", $password)
    ) {
        echo "Password harus minimal 8 karakter, ada huruf besar, kecil, dan angka!";
        return;
    }

    // 4. Cek email duplikat
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "Email sudah digunakan!";
        return;
    }

    // 5. Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // 6. Simpan
    mysqli_query($conn, "INSERT INTO users VALUES ('','$nama','$email','$hash')");

    echo "Register berhasil!";
}
?>
<?php
session_start();

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

include '../config/konfig.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: index.php?success=Data mahasiswa berhasil dihapus");
    } else {
        header("Location: index.php?error=Gagal menghapus data");
    }
    $stmt->close();
} else {
    header("Location: index.php?error=ID tidak valid");
}

$conn->close();
?>
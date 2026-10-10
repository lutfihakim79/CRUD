<?php
require_once 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: Detail.php");
        exit;
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
} else {
    header("Location: Detail.php");
    exit;
}
?>
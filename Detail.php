<?php
require_once 'koneksi.php';

$result = $conn->query("SELECT * FROM staff ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lengkap Pegawai</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>
        <a href="Staff.php">Beranda</a>
        <a href="Detail.php">| Data Lengkap</a>
    </p>
    <hr>

    <h1>Data Lengkap Pegawai</h1>
    <img src="Detail.jpg" alt="Detail">

    <table class="tabel-staff">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Pangkat</th>
                <th>No. Telp</th>
                <th>Daerah</th>
                <th>Shift</th>
                <th>Jam Kerja</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['pangkat']); ?></td>
                <td><?= htmlspecialchars($row['telp']); ?></td>
                <td><?= htmlspecialchars($row['daerah']); ?></td>
                <td><?= htmlspecialchars($row['shift']); ?></td>
                <td><?= htmlspecialchars($row['jam']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
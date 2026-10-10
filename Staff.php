<?php
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $telp    = $_POST['telp'];
    $daerah  = $_POST['daerah'];
    $shift   = $_POST['shift'];
    $jam     = $_POST['jam'];

    $stmt = $conn->prepare("INSERT INTO staff (nama, pangkat, telp, daerah, shift, jam) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $pangkat, $telp, $daerah, $shift, $jam);
    
    if ($stmt->execute()) {
        header("Location: Staff.php");
        exit;
    } else {
        echo "Gagal menambahkan data: " . $stmt->error;
    }
    $stmt->close();
}

$result = $conn->query("SELECT id, nama FROM staff ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Staff</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>
        <a href="Staff.php">Beranda</a>
        <a href="Detail.php">| Data Lengkap</a>
    </p>
    <hr>

    <h1>Data Staff Restoran</h1>
    <img src="Pekerja.jpg" alt="Pegawai">

    <div class="form-container">
        <h2>Tambah Staff Baru</h2>
        <form action="Staff.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Pegawai:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama..." required>
            </div>
            <div class="form-group">
                <label for="pangkat">Pangkat / Jabatan:</label>
                <select id="pangkat" name="pangkat" required>
                    <option value="" disabled selected>-- Pilih Jabatan --</option>
                    <option value="Manager">Manager</option>
                    <option value="Chef">Chef</option>
                    <option value="Cook Helper">Cook Helper</option>
                    <option value="Waiter">Waiter</option>
                    <option value="Kasir">Kasir</option>
                    <option value="Barista">Barista</option>
                    <option value="Dishwasher">Dishwasher</option>
                </select>
            </div>
            <div class="form-group">
                <label for="telp">No. Telepon:</label>
                <input type="tel" id="telp" name="telp" placeholder="Contoh: 081234567890" required>
            </div>
            <div class="form-group">
                <label for="daerah">Daerah / Wilayah:</label>
                <input type="text" id="daerah" name="daerah" placeholder="Contoh: Jakarta Selatan, Bandung..." required>
            </div>
            <div class="form-group">
                <label for="shift">Shift Kerja:</label>
                <select id="shift" name="shift" required>
                    <option value="" disabled selected>-- Pilih Shift --</option>
                    <option value="Shift Pagi">Shift Pagi</option>
                    <option value="Shift Siang">Shift Siang</option>
                    <option value="Shift Malam">Shift Malam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam Kerja:</label>
                <input type="text" id="jam" name="jam" placeholder="Contoh: 08.00 - 16.00" required>
            </div>
            <button type="submit" class="btn btn-tambah">Tambah Pegawai</button>
        </form>
    </div>

    <table class="tabel-staff">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><a href="Detail.php" class="btn-detail">Lihat Detail</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
require_once 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: Detail.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM staff WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = $_POST['nama'];
    $pangkat = $_POST['pangkat'];
    $telp    = $_POST['telp'];
    $daerah  = $_POST['daerah'];
    $shift   = $_POST['shift'];
    $jam     = $_POST['jam'];

    $update_stmt = $conn->prepare("UPDATE staff SET nama = ?, pangkat = ?, telp = ?, daerah = ?, shift = ?, jam = ? WHERE id = ?");
    $update_stmt->bind_param("ssssssi", $nama, $pangkat, $telp, $daerah, $shift, $jam, $id);
    
    if ($update_stmt->execute()) {
        header("Location: Detail.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . $update_stmt->error;
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Staff</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p>
        <a href="Staff.php">Beranda</a>
        <a href="Detail.php">| Data Lengkap</a>
    </p>
    <hr>

    <div class="form-container">
        <h2>Edit Data Staff</h2>
        <form action="edit.php?id=<?= $id; ?>" method="POST">
            <div class="form-group">
                <label for="nama">Nama Pegawai:</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label for="pangkat">Pangkat / Jabatan:</label>
                <select id="pangkat" name="pangkat" required>
                    <?php
                    $jabatan_list = ["Manager", "Chef", "Cook Helper", "Waiter", "Kasir", "Barista", "Dishwasher"];
                    foreach ($jabatan_list as $j) {
                        $selected = ($data['pangkat'] == $j) ? 'selected' : '';
                        echo "<option value='$j' $selected>$j</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="telp">No. Telepon:</label>
                <input type="tel" id="telp" name="telp" value="<?= htmlspecialchars($data['telp']); ?>" required>
            </div>
            <div class="form-group">
                <label for="daerah">Daerah / Wilayah:</label>
                <input type="text" id="daerah" name="daerah" value="<?= htmlspecialchars($data['daerah']); ?>" required>
            </div>
            <div class="form-group">
                <label for="shift">Shift Kerja:</label>
                <select id="shift" name="shift" required>
                    <?php
                    $shift_list = ["Shift Pagi", "Shift Siang", "Shift Malam"];
                    foreach ($shift_list as $s) {
                        $selected = ($data['shift'] == $s) ? 'selected' : '';
                        echo "<option value='$s' $selected>$s</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="jam">Jam Kerja:</label>
                <input type="text" id="jam" name="jam" value="<?= htmlspecialchars($data['jam']); ?>" required>
            </div>
            <button type="submit" class="btn btn-tambah">Simpan Perubahan</button>
            <a href="Detail.php" style="display:inline-block; margin-top:10px;">Batal</a>
        </form>
    </div>
</body>
</html>
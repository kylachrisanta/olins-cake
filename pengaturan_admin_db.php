<?php
require_once 'koneksi.php';

$query = "
CREATE TABLE IF NOT EXISTS admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    nama_pengguna VARCHAR(50) NOT NULL UNIQUE,
    kata_sandi VARCHAR(255) NOT NULL,
    status_admin ENUM('aktif', 'nonaktif') DEFAULT 'aktif',
    tanggal_dibuat DATETIME DEFAULT CURRENT_TIMESTAMP
);
";

if ($koneksi->query($query) === TRUE) {
    echo "Table admin created successfully\n";
} else {
    echo "Error creating table: " . $koneksi->error . "\n";
}

$check = $koneksi->query("SELECT * FROM admin WHERE nama_pengguna = 'admin'");
if ($check->num_rows == 0) {
    $hash = password_hash('password123', PASSWORD_DEFAULT);
    $stmt = $koneksi->prepare("INSERT INTO admin (nama_admin, nama_pengguna, kata_sandi, status_admin) VALUES (?, ?, ?, 'aktif')");
    $nama = "Administrator Utama";
    $user = "admin";
    $stmt->bind_param("sss", $nama, $user, $hash);
    if ($stmt->execute()) {
        echo "Default admin user created successfully\n";
    } else {
        echo "Error inserting default admin: " . $stmt->error . "\n";
    }
} else {
    echo "Default admin user already exists\n";
}
?>

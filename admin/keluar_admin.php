<?php
session_start();

// Hapus variabel session admin
unset($_SESSION['status_login_admin']);
unset($_SESSION['id_admin']);
unset($_SESSION['nama_admin']);

// Redirect ke login admin
header("Location: masuk_admin.php");
exit;
?>

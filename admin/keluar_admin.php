<?php
session_start();

unset($_SESSION['status_login_admin']);
unset($_SESSION['id_admin']);
unset($_SESSION['nama_admin']);

header("Location: masuk_admin.php");
exit;
?>

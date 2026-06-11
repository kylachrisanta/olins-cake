<?php
session_start();
// Hapus semua data sesi
$_SESSION = [];

// Jika menggunakan cookie sesi, hapus juga
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

// Redirect ke halaman masuk
header("Location: masuk.php");
exit;
?>

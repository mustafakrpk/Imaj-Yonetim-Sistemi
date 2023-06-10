<?php
session_start();
// Oturumu kapat
if (session_destroy()) {
    // Ana Sayfaya Yönlendirme
    header("Location: login.php");
}
?>
<?php
// Oturumu başlatma
session_start();

// Kullanıcı adı oturum değişkeni kontrolü
if (!isset($_SESSION["username"])) {
    // Kullanıcı adı oturum değişkeni tanımlanmamışsa, kullanıcıyı login.php sayfasına yönlendirir
    header("Location: login.php");
    exit(); // Kodun burada sonlanmasını sağlar, başka kodun çalışmasını engeller
}
?>
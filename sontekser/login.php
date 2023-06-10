<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8" />
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS Kodları */
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
        }

        .form-link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<?php
// üstMenu.php dosyasını dahil etme
include "üstMenu.php";
?>

<body>
    <?php
    // db.php dosyasını dahil etme veritabanı bağlantısı için gerekli dosya
    require('db.php');
    // Oturumu başlatma
    session_start();

    if (isset($_POST['username'])) { // Formdan kullanıcı adı gönderildiyse işlemleri başlatır.
        // Giriş formundan kullanıcı adı ve şifre alınır
        $username = stripslashes($_REQUEST['username']); // Kullanıcı adını alır ve gerekiyorsa kaçış karakterlerini kaldırır.
        $username = mysqli_real_escape_string($con, $username); // Kullanıcı adında olası SQL enjeksiyon saldırılarını engellemek için veriyi temizler.
        $password = stripslashes($_REQUEST['password']); // Şifreyi alır ve gerekiyorsa kaçış karakterlerini kaldırır.
        $password = mysqli_real_escape_string($con, $password); // Şifrede olası SQL enjeksiyon saldırılarını engellemek için veriyi temizler.
    
        // Kullanıcı adı ve şifre veritabanında kontrol edilir
        $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error()); // SQL sorgusunu veritabanında çalıştırır.
        $rows = mysqli_num_rows($result); // Sorgudan dönen satır sayısını alır.
        if ($rows == 1) { // Eşleşen kullanıcı bulunduysa oturumu başlatır ve kullanıcıyı yönlendirir.
            $_SESSION['username'] = $username; // Oturum değişkenini kullanıcı adıyla ayarlar.
            // Doğru kullanıcı adı ve şifreyle giriş yapılırsa oturum başlatılır ve kullanıcıyı dashboard.php sayfasına yönlendirir
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            // Geçersiz kullanıcı adı veya şifreyle giriş yapılırsa hata mesajı gösterilir
            echo "<div class='container'>
                  <h3>Geçersiz Kullanıcı Adı/Şifre.</h3><br/>
                  <p class='form-link'>Tekrar <a href='login.php'>giriş yapmak için buraya tıklayın</a>.</p>
                  </div>";
        }
    } else { // Formdan veri gönderilmediyse giriş formunu gösterir.
        ?>
        ?>
        <div class="container">
            <h1 class="form-title">Giriş Yap</h1>
            <form class="form" method="post" name="login">
                <input type="text" class="form-input" name="username" placeholder="Kullanıcı Adı" autofocus="true"
                    required />
                <input type="password" class="form-input" name="password" placeholder="Şifre" required />
                <input type="submit" value="Giriş Yap" name="submit" class="form-button" />
                <p class="form-link">Yeni kayıt için <a href="register.php">buraya tıklayın</a>.</p>
            </form>
        </div>
        <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
    <script>
        function checkAuthorization() {
            var password = document.getElementById('password').value;

            if (password !== '11tekser') {
                alert("Kayıt yetkiniz bulunmamaktadır.");// Kayıt yetkisi kontrolü
                return false;
            }

            return true;
        }
    </script>
</head>
<?php
include "üstMenu.php";
?>

<body>
    <?php
    require('db.php');

    if (isset($_REQUEST['username'])) { // Formdan kullanıcı adı gönderildiyse işlemleri başlatır.
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s"); // Oluşturma tarihini alır.
        $query = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        // Yeni kullanıcıyı veritabanına eklemek için bir SQL sorgusu.
    
        $result = mysqli_query($con, $query); // SQL sorgusunu veritabanında çalıştırır.
        if ($result) { // Veritabanına başarıyla eklendiyse tamamlandı mesajını gösterir.
            echo "<div class='container'>
                  <h3>Kaydınız başarıyla tamamlandı.</h3><br/>
                  <p class='form-link'>Şimdi <a href='login.php'>giriş yapabilirsiniz</a></p>
                  </div>";
            echo "<script>setTimeout(function() {
                window.location.href = 'login.php';
            }, 3000);</script>"; // 3 saniye sonra otomatik olarak login.php sayfasına yönlendirir
        } else { // Veritabanına eklenemediyse hata mesajını gösterir.
            echo "<div class='container'>
                  <h3>Gerekli alanlar eksik.</h3><br/>
                  <p class='form-link'>Lütfen <a href='registration.php'>kayıt işlemini</a> tekrar deneyin.</p>
                  </div>";
        }
    } else { // Formdan veri gönderilmediyse kayıt formunu gösterir.
        ?>
        <div class="container">
            <h1 class="form-title">Kayıt Ol</h1>
            <form class="form" action="" method="post">
                <input type="password" class="form-input" name="password" id="password" placeholder="Kayıt Yetkisi"
                    required />
                <input type="text" class="form-input" name="username" id="username" placeholder="Kullanıcı Adı" required />
                <input type="text" class="form-input" name="email" placeholder="Email Adresi" required />
                <input type="password" class="form-input" name="password" placeholder="Şifre" required />
                <input type="submit" name="submit" value="Kayıt Ol" class="form-button"
                    onclick="return checkAuthorization()">
                <p class="form-link">Zaten hesabınız var mı? <a href="login.php">Giriş Yapın</a></p>
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
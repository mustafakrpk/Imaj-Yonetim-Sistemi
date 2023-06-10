<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>BET�KLER</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* CSS Kodları */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-title {
            font-size: 24px;
            margin-right: 10px;
        }

        .header-admin {
            font-size: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .header-link {
            margin-left: 10px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
        }

        h3 {
            text-align: center;
            color: #333;
        }

        pre {
            background-color: #bfe7e7;
            padding: 10px;
            border-radius: 5px;
            white-space: pre-wrap;
        }

        .output-container {
            margin-top: 20px;
            background-color: #666;
            border-radius: 5px;
            padding: 10px;
            overflow: auto;
        }

        .output {
            white-space: pre-wrap;
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
            color: #028f15c4;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="header-title">BETIKLER</div>
                <div class="header-admin">
                    <?php echo $_SESSION['username']; ?>
                </div>
            </div>
            <div class="header-right">
                <a class="header-link" href="login.php">Giriş Yap</a>
                <a class="header-link" href="register.php">Kayıt Ol</a>
            </div>
        </div>
        <h3>Betik Sonucu</h3>
        <div class="output-container">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $output = "No script executed.";

                if (isset($_POST['yenile'])) {
                    $output = shell_exec("sudo /root/betikler/yansilariyenile.sh");
                    //Yansıları yenilemek için shell_exec kullanılıyor.
                } elseif (isset($_POST['sil'])) {
                    $output = shell_exec("sudo /root/betikler/yansilarisil.sh");
                    //  Yansıları silmek için shell_exec kullanılıyor.
                } elseif (isset($_POST['olustur'])) {
                    $output = shell_exec("sudo /root/betikler/ilkyansiolustur.sh");
                    // İlk yansı oluşturmak için shell_exec kullanılıyor.
                } elseif (isset($_POST['servisdurum'])) {
                    $output = shell_exec("sudo servislerindurumu");
                    // Servislerin durumunu kontrol etmek için shell_exec kullanılıyor.
                } elseif (isset($_POST['servisdurdur'])) {
                    $output = shell_exec("sudo servisleridurdur");
                    //Servisleri durdurmak için shell_exec kullanılıyor
                } elseif (isset($_POST['servisbaslat'])) {
                    $output = shell_exec("sudo servisleribaslat");
                    //Servisleri başlatmak için shell_exec kullanılıyor.
                } elseif (isset($_POST['servisyenile'])) {
                    $output = shell_exec("sudo servisleriyenile");
                    //Servisleri yenilemek için shell_exec kullanılıyor.
                }

                echo "<pre class='output'>$output</pre>";
            }
            ?>
        </div>
    </div>
</body>

</html>
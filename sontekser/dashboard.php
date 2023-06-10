<?php include("auth_session.php"); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include "�stMenu.php"; ?>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <style>
        /* CSS stil tanımlamaları */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            color: #333;
        }

        .form-button {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .form-button button {
            margin: 5px;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        .form-button button:hover {
            background-color: #45a049;
        }

        .form-message {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #result {
            display: none;
        }

        #showResultButton {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="form-title">Panel</h3>
        <div class="form">
            <p>Merhaba,
                <?php echo $_SESSION['username']; ?>!
            </p>
            <!-- İşlem butonlarının bulunduğu bir form tanımlar. Bu form, "execute_script.php" dosyasına veri gönderir. -->
            <form class="form-button" method="POST" action="execute_script.php">
                <button type="submit" class="btn btn-primary" name="yenile" onclick="toggleForm(this)">Tum Yansilari
                    Yenile</button>
                <button type="submit" class="btn btn-danger" name="sil" onclick="toggleForm(this)">Yansilari
                    Sil</button>
                <button type="submit" class="btn btn-success" name="olustur" onclick="toggleForm(this)">Ilk Yansi
                    Olustur</button>
                <button type="submit" class="btn btn-success" name="servisdurum" onclick="toggleForm(this)">Servislerin
                    Durumu</button>
                <button type="submit" class="btn btn-success" name="servisdurdur" onclick="toggleForm(this)">Servisleri
                    Durdur</button>
                <button type="submit" class="btn btn-success" name="servisbaslat" onclick="toggleForm(this)">Servisleri
                    Baslat</button>
                <button type="submit" class="btn btn-success" name="servisyenile" onclick="toggleForm(this)">Servisleri
                    Yenile</button>
            </form>

            <p><a href="logout.php">Cikis Yap</a></p>
        </div>

        <div class="form-message" id="successMessage" style="display: none;"></div>

        <div id="result">
            <h4>Islem Detaylari</h4>
            <pre id="resultText"></pre>
        </div>

        <button id="showResultButton" class="btn btn-primary" onclick="showResult()">Detaylari Goster</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleForm(button) {
            // Formu gizle
            var form = document.querySelector('.form');
            form.classList.add('hide');
            // Başarı mesajını göster
            var message = document.getElementById('successMessage');
            message.style.display = 'block';
            message.innerHTML = 'Islem basariyla gerceklesti: ' + button.name;
            // Detayları göster butonunu etkinleştir
            var showResultButton = document.getElementById('showResultButton');
            showResultButton.style.display = 'block';
            showResultButton.disabled = false;
        }

        function showResult() {
            // Sonucu göster divini görünür yap
            var resultDiv = document.getElementById('result');
            resultDiv.style.display = 'block';
            // Detayları yükleniyor mesajını göster
            var resultText = document.getElementById('resultText');
            resultText.innerHTML = 'Detaylar yukleniyor...';
            // AJAX ile detayları al
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 5000) {
                    resultText.innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'execute_script.php', true);
            xhr.send();
        }
    </script>
</body>

</html>
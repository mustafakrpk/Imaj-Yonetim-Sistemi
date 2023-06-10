<?php
// Host adınızı, veritabanı kullanıcı adınızı, şifrenizi ve veritabanı adınızı girin.
// If you have not set database password on localhost then set empty.
$con = mysqli_connect("localhost", "root", "MblA*", "loginsystem");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
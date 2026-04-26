<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
     <link rel="stylesheet" href="style.css"> 
</head>

<body>
    <div class="background"></div>
    <div class="container">
    <form method="post" class="glass-card">
        <h3 class="font-3">Daftar Akun</h3>
        <p>Isi form di bawah untuk membuat akun </p>

        <label for="username">Username</label>
        <input type="text" id="username" placeholder="username" name="username" required>

        <label for="nis">nis</label>
        <input type="text" id="nis" placeholder="nis" name="nis" required>

        <label for="password">Password</label>
        <input type="password" id="password" placeholder="*****" name="password" required>

        <label for="konfirmasi_password">Konfirmasi Password</label>
        <input type="password" name="konfirmasi_password" required>

        <button type="submit" name="register" required>Daftar</button>

        <div class="footer">
        <p>sudah punya akun? <a href="login.php">masuk</a>
        </div>
    </form>
    </div>
</body>

</html>

<?php
include "service/database.php";

if(isset($_POST["register"])) {
    $username = $_POST ['username'];
    $nis = $_POST ['nis'];
    $password = $_POST ['password'];
    $konfirmasi_password = $_POST ['konfirmasi_password'];

    if($password == $konfirmasi_password) {
        $cekNis = mysqli_query($db , "SELECT * FROM users WHERE nis='$nis'");
        if(mysqli_num_rows($cekNis) > 0) {
            echo "<script>alert('nis telah terdaftar'); window.location='register.php';</script>";
        } 
        else {
            $cekUser = mysqli_query($db , "SELECT * FROM users WHERE username='$username'");
                if(mysqli_num_rows($cekUser) > 0) {
                     echo "<script>alert('username telah digunakan'); window.location='register.php';</script>";
                }
                else {
                    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (username, nis, password) VALUES ('$username' , '$nis' , '$hashed_pass')";
                    if(mysqli_query($db, $sql)) {
                        echo "<script>alert('koneksi berhasil'); window.location='login.php';</script>";
                    }
                    else {
                        echo "<script>alert('koneksi gagal'); window.location='register.php';</script>";
                    }
                }
        }
    } else {echo "<script>alert('password tidak sama'); window.location='register.php';</script>";}
}
?>
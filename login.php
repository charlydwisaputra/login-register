<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="background"></div>
    <div class="container">
        <form method="post" class="glass-card">
            <h3>Masuk Akun</h3>
            <p>Masukan data untuk masuk ke akun anda</p>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="username" required>

            <label for="nis">Nis</label>
            <input type="text" id="nis" name="nis" placeholder="nis" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="********" required>

            <button type="submit" name="login">Masuk</button>

            <div class="footer">
                <p>belum punya akun? <a href="register.php">daftar sekarang</a></p>
            </div>

        </form>
    </div>
</body>

</html>

<?php
session_start();
include "service/database.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $nis = $_POST['nis'];
    $password = $_POST['password'];

    // cek username dan nis
    $query = mysqli_query($db, "SELECT * FROM users WHERE username='$username'  AND nis='$nis'");

    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_assoc($query);

        // cek password hash
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $row['username'];
            echo "<script>alert('Login berhasil');window.location='index.php';</script>";
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Username atau NIS salah');</script>";
    }
}
?>
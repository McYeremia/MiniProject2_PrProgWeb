<?php
session_start();

if (isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($password === $row["password"]){

            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;

            header("Location: index.php");

            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harmoni Konser : Login</title>
  <link rel="stylesheet" href="logincss.css">
</head>
<body>
  <header>
    <img src="gambar/LogoHKputihhitam.png" alt="LogoHKputih">
    <a href="index.php" class="pilihan">Home</a>
    <a href="daftarkonser.html" class="pilihan">Semua Konser</a>
    <a href="tentang.php" class="pilihan">Tentang</a>
  </header>

  <div class="bgatas">
    <img src="gambar/bgpolos.png" alt="">
  </div>
  <div class="login">
    <form method="POST" action="">
      <div class="overlay">
        <table border="0">
          <tr>
            <td colspan="2" id="selamatdatang">SELAMAT DATANG!</td>
          </tr>
          <?php if(isset($error)):?>
                <p style ="color: red; font-style: italic; padding-left: 10px">
                    username / password salah
                </p>
          <?php endif;?>
          <tr>
            <td>
              Username :
            </td>
            <td>
              <div class="form">
                <input id="username" class="input" placeholder="Input Username" required="" type="text" name="username">
                <span class="input-border"></span>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Password :
            </td>
            <td>
              <div class="form">
                <input id="password" class="input" placeholder="Input Password" required="" type="password" name="password">
                <span class="input-border"></span>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="submitt">
              <button class="btn" type="submit" name="login" value="Login">Login
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</body>
</html>

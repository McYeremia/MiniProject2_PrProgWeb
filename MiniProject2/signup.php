<?php
session_start();

if (isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["signup"])){

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email= $_POST["email"];
    $confirmpassword = $_POST["confirmpassword"];

    if ($password !== $confirmpassword) {
        $error = "Konfirmasi password tidak sesuai.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = mysqli_query($conn, "INSERT INTO user_data (username, email, password) VALUES ('$username', '$email', '$hashedPassword')");

        if ($result) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Gagal menambahkan user baru: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harmoni Konser : Sign Up</title>
  <link rel="stylesheet" href="logincss.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <img src="gambar/LogoHKputihhitam.png" alt="LogoHKputih">
    <a href="index.php" class="pilihan">Home</a>
    <a href="daftarkonser.php" class="pilihan">Semua Konser</a>
    <a href="tentang.php" class="pilihan">Tentang</a>
    <a href="login.php" class="pilihan">Login</a>
  </header>

  <div class="bgatas">
    <img src="gambar/bgpolos.png" alt="">
  </div>
  <div class="login">
    <form method="POST" action="">
      <div class="overlay">
        <table border="0">
          <tr>
            <td colspan="2" id="selamatdatang">Isilah Data Anda:</td>
          </tr>
          <?php if(isset($error)):?>
                <p style ="color: red; font-style: italic; padding-left: 10px">
                    <?php echo $error; ?>
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
              Email :
            </td>
            <td>
              <div class="form">
                <input id="email" class="input" placeholder="Input Email" required="" type="email" name="email">
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
            <td>
              Confirm Password :
            </td>
            <td>
              <div div class="form">
                <input id="confirmpassword" class="input" placeholder="Confirm Password" required="" type="password" name="confirmpassword">
                <span class="input-border"></span>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="submitt">
              <button class="btn" type="submit" name="signup" value="signup">Sign Up</button>
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>
</body>
</html>

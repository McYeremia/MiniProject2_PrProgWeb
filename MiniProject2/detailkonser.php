<?php
session_start();

///cek login
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require "functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmoni Konser Indonesia</title>
    <link rel="stylesheet" href="detailkonser.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="gambar/LogoHKputihhitam.png" alt="LogoHKputih"></a>
        <a href="index.php" class="pilihan">Home</a>
        <a href="daftarkonser.php" class="pilihan">Semua Konser</a>
        <a href="tentang.php" class="pilihan">Tentang</a>
        <a href="akun.php" class="pilihan">Akun</a>
    </header>
    <h1 class="judul"> Detail Konser</h1>
    
    <table border="0">
        <tr>
            <td>
                <img class="gambar" src="posterkonser/poster1.jpg" alt="">
            </td>
            <td class="desc">
                <h1>Charity Concert </h1>
                <h2>Description: </h2>
                <p>*konser ini adalah konser musik yang ada di indonesia</p>
                <h2>Artis : </h2>
                <p><b>*DJ Valentino</b></p>
                <h2>Date: </h2>
                <p>*19/02/2024</p>
                <h2>Lokasi:</h2>
                <p>*Bandung</p>
                
            </td>
        </tr>
    </table>
    <button onclick="navigateToPage()"class="btn">Pesan Sekarang</button>
    <script>
        function navigateToPage() {
            window.location.href = "pemesanan.php";
        }
    </script>

</html>
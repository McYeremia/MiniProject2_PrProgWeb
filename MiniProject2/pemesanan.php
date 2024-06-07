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
    <title>Pemesanan tiket</title>
    <link rel="stylesheet" href="pemesanan.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="gambar/LogoHKputihhitam.png" alt="LogoHKputih"></a>
        <a href="index.php" class="pilihan">Home</a>
        <a href="daftarkonser.php" class="pilihan">Semua Konser</a>
        <a href="tentang.php" class="pilihan">Tentang</a>
        <?php 
            if (!isset($_SESSION["login"])) {
                ?>
                <a href="akun.php" class="pilihan">Login</a>
                <?php
            }else{
                ?>
                <a href="akun.php" class="pilihan">Akun</a>
                <?php   
            }
        ?>
    </header>
    <div class="container">
        <div class="header">
            <h1>PEMESANAN TIKET</h1>
            <form>
                <table border="0">
                    <tr>
                        <label for="nama">Masukan nama anda</label><br>
                        <input type="text" name="nama" id="nama" placeholder="Masukan nama"><br><br>
                    </tr>
                    <tr>
                        <label for="nomortelepon">Masukan nomor telepon</label><br>
                        <input type="tel" name="nomortelepon" id="nomortelepon" placeholder="Masukan nomor telepon"><br><br>
                    </tr>
                    <tr>
                        <label for="email">Masukan email anda</label><br>
                        <input type="email" name="email" id="email" placeholder="Masukan email anda"><br><br>
                    </tr>
                    <tr>
                        <label for="konser">Masukan nama konser</label><br>     
                        <input type="text" name="konser" id="konser" placeholder="Masukan nama konser"> <br><br>  
                    </tr>
                    <tr>
                        <label for="tanggal">Masukan tanggal konser</label><br>
                        <input type="date" name="tanggal" id="tanggal"><br><br>
                    </tr>
                    <tr>
                        <label for="jumlah">Masukan jumlah tiket</label><br>
                        <input type="number" name="jumlah" id="jumlah" placeholder="Masukan jumlah tiket" min="1" ><br><br>
                    </tr>
                    
                </table>
                <button type="submit">Pesan Tiket</button><br><br>
                <img src="gambar/LogoHKputihHitam.png" alt="logo">

        </div>
        <div class="content">
    
    

    
</body>
</html>
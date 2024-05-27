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
    <title>Detail Akun Harmoni Konser</title>
    <link rel="stylesheet" href="akuncss.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="gambar/LogoHKputihhitam.png" alt="LogoHKputih"></a>
        <a href="index.php" class="pilihan">Home</a>
        <a href="daftarkonser.php" class="pilihan">Semua Konser</a>
        <a href="tentang.php" class="pilihan">Tentang</a>
        <a href="akun.php" class="pilihan">Akun</a>
    </header>
    <div class="hallouser">
        <h1>
            Halo, $username !
        </h1>
    </div>
    <div class="detailakun">
        <h2>
            Detail Akun Anda :
        </h2>
        <table border="0">
            <tr>
                <td>
                    <p class="tabelakun">
                        Username : 
                    </p>
                </td>
                <td>
                    <p class="tabelakun">
                        $username
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="tabelakun">
                        Password :
                    </p>
                </td>
                <td>
                    <p class="tabelakun">
                        $password
                    </p>
                </td>
            <tr>
                <td>
                    <p class="tabelakun">
                        Email :
                    </p>
                </td>
                <td>
                    <p class="tabelakun">
                        $email
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <div class="daftartiketuser">
        <h2>
            Tiket Anda :
        </h2>
        <table border="0" class="tabeltiketuser">
            <thead class="tabeltiketuserhead">
                <tr>
                    <td>
                        <h4>
                            Nama Konser
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Lokasi Konser
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Tanggal Konser
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Nama Artis
                        </h4>
                    </td>
                </tr>
            </thead>
            <div class="tabeltiketuserisi">
                <tr>
                    <td>
                        CHARITY CONCERT : ONE
                    </td>
                    <td>
                        Bandung
                    </td>
                    <td>
                        2024-02-24
                    </td>
                    <td>
                        DJ Valentino
                    </td>
                </tr>
            </div>
        </table>
    </div>
    <div class="tombollogout">
        <form method="Post" action="logout.php">
            <!-- <button type="submit" name="logout">Logout</button> -->
            <button class="btn" type="submit" name="logout"> Log out
            </button>
        </form>
    </div>
</body>
</html>
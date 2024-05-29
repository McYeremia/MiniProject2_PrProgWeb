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
    <link rel="stylesheet" href="indexcss.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="gambar/LogoHKputihhitam.png" alt="LogoHKputih"></a>
        <a href="index.php" class="pilihan">Home</a>
        <a href="daftarkonser.php" class="pilihan">Semua Konser</a>
        <a href="tentang.php" class="pilihan">Tentang</a>
        <a href="akun.php" class="pilihan">Akun</a>
    </header>

    <div class="background1">
        <img src="gambar/Artboard 2.png" alt="gambarbackground1">
        <div class="overlay">
            <a href="daftarkonser.php" id="tombolbiarcepet">Lihat Daftar Konser</a>
        </div>
    </div>

    <div class="tagline1">
        <h1><center>Mau nonton konser apa?</h1>
    </div>

    <div class="pencarian">
        <form id="formpencarian"><center>
            <table  id="tabelpencarian">
                <tr>
                    <td>
                        <input type="text" class="input" id="carinamakonser" placeholder="masukkan nama konser">
                    </td>
                    <td>
                        <input type="date" class="input" id="tanggalkonser">
                    </td>
                    <td>
                        <input type="text" class="input" id="lokasikonser" placeholder="masukkan lokasi konser">
                    </td>
                    <td>
                        <input type="submit" class="input" id="submitcari">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div class="konserterkini">
        <center>
        <h1>
            Daftar Konser Terkini
        </h1>
        <table border="0">
            <tr>
                <td>
                    <a href="detailkonser.php"><img src="posterkonser/poster1.png" alt="gmbrposter1" class="ukuranposter"></a>
                </td>
                <td>
                    <a href="detailkonser.php"><img src="posterkonser/poster2.png" alt="gmbrposter2" class="ukuranposter"></a>
                </td>
                <td>
                    <a href="detailkonser.php"><img src="posterkonser/poster3.png" alt="gmbrposter3" class="ukuranposter"></a>
                </td>
                <td>
                    <a href="detailkonser.php"><img src="posterkonser/poster1.png" alt="gmbrposter4" class="ukuranposter"></a>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="judulposter">
                        <a href="detailkonser.php">CHARITY CONCERT : ONE</a>
                    </div>
                </td>
                <td>
                    <div class="judulposter">
                        <a href="detailkonser.php">Freedom of Nggambleh</a>
                    </div>
                </td>
                <td>
                    <div class="judulposter">
                        <a href="detailkonser.php">Musik Indonesia Keren</a>
                    </div>
                </td>
                <td>
                    <div class="judulposter">
                        <a href="detailkonser.php">CHARITY CONCERT : ONE</a>
                    </div>
                </td>
            </tr>
        
        </table>
    </div>


    <footer>
        <div class="socialmedia">
            <p>
                Follow Us! 
            </p>
            <div class="logososmed">
                <table border="0">
                    <tr>
                        <td>
                            <a href="https://www.facebook.com"><img src="logososmed/facebook.png" alt="fb"></a>
                        </td>
                        <td>
                            <a href="https://www.instagram.com/"><img src="logososmed/instagram (2).png" alt="ig"></a>
                        </td>
                        <td>
                            <a href="https://www.tiktok.com/id-ID/"><img src="logososmed/tiktok.png" alt="tiktok"></a>
                        </td>
                        <td>
                            <a href="https://x.com/?lang=en"><img src="logososmed/twitter.png" alt="x"></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div>
            <p id="reg">
                &reg;Harmoni Musik Indonesia 2024
            </p>
        </div>
    </footer>
</body>
</html>

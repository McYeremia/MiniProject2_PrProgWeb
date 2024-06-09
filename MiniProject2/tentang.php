<?php
    session_start();
    require "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmoni Konser : About Us</title>
    <link rel="stylesheet" href="tentangcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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
                <a href="signup.php" class="pilihan">Sign Up</a>
                <?php
            }else{
                ?>
                <a href="akun.php" class="pilihan">Akun</a>
                <a href="logout.php" class="pilihan">Logout</a>
                <?php   
            }
        ?>
    </header>
    <div class="aboutus">
        <h1>
            About Us :
        </h1>
        <p>
            Kami membuat web ini untuk memenuhi nilai tugas akhir dari mata kuliah Praktikum Pemrograman Web Semester Genap 2023/2024;
        </p>
        <h1>
            Anggota Kelompok :
        </h1>
        <table border="0" class="tabelanggota">
            <tr>
                <td>
                    <h3>
                        71220824
                    </h3>
                </td>
                <td>
                    :
                </td>
                <td>
                    <h3>
                        David Alan Mulia Priantara
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>
                        71220845
                    </h3>
                </td>
                <td>
                    :
                </td>
                <td>
                    <h3>
                        Nicholas Tanugroho
                    </h3>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>
                        71220953
                    </h3>
                </td>
                <td>
                    :
                </td>
                <td>
                    <h3>
                        Yeremia Christopher W
                    </h3>
                </td>
            </tr>
        </table>
    </div>
    
</body>
</html>
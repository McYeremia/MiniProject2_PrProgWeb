<?php
    session_start();

    require "functions.php";

    $result = mysqli_query($conn, "SELECT konser_data.id_konser, poster, tanggal_awal, tanggal_akhir, judul, MIN(tiket_data.harga) AS harga_terendah FROM konser_data LEFT JOIN tiket_data ON konser_data.id_konser = tiket_data.id_konser WHERE tanggal_akhir >= CURDATE() GROUP BY konser_data.id_konser");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmoni Konser Indonesia</title>
    <link rel="stylesheet" href="daftarkonser.css">
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
    <h1 class="judul"> Daftar Konser</h1>
    <div class="konserterkini">
        <center>
        <table border="0">
        <?php
            $concerts = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $concerts[] = $row;
            }
            $totalConcerts = count($concerts);
            for ($i = 0; $i < $totalConcerts; $i += 4) {
                echo "<tr>";
                for ($j = $i; $j < $i + 4; $j++) {
                    if (isset($concerts[$j])) {
                        echo "<td><a href='detailkonser.php?id_konser=" . $concerts[$j]['id_konser'] . "'><img src='" . $concerts[$j]['poster'] . "' alt='poster' class='ukuranposter'></a></td>";
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr><tr>";
                for ($j = $i; $j < $i + 4; $j++) {
                    if (isset($concerts[$j])) {
                        $tanggal = $concerts[$j]['tanggal_awal'] == $concerts[$j]['tanggal_akhir'] ? $concerts[$j]['tanggal_awal'] : $concerts[$j]['tanggal_awal'] . ' - ' . $concerts[$j]['tanggal_akhir'];
                        $hargaTerendah = $concerts[$j]['harga_terendah'] ? number_format($concerts[$j]['harga_terendah'], 0, ',', '.') : 'Tidak Tersedia';
                        echo "<td>";
                        echo "<div class='judulposter'><a href='detailkonser.php?id_konser=" . $concerts[$j]['id_konser'] . "'>" . $concerts[$j]['judul'] . "</a></div>";
                        echo "<div class='tanggalkonser'><a href='detailkonser.php?id_konser=" . $concerts[$j]['id_konser'] . "'>" . $tanggal . "</a></div>";
                        echo "<div class='hargaterendah'>Mulai Dari: Rp " . $hargaTerendah . "</div>";
                        echo "</td>";
                    } else {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
            
            ?>
        
        </table>
    </div>
    <footer>
        <div class="socialmedia">
            <p>Follow Us!</p>
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
            <p id="reg">&reg;Harmoni Musik Indonesia 2024</p>
        </div>
    </footer>

    
</body>
</html>
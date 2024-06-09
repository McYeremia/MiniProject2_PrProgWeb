<?php
    session_start();

    require "functions.php";

    $nama_konser = isset($_POST['carinamakonser']) ? $_POST['carinamakonser'] : '';
    $nama_artis = isset($_POST['carinamaartis']) ? $_POST['carinamaartis'] : '';
    $tanggal_konser = isset($_POST['tanggalkonser']) ? $_POST['tanggalkonser'] : '';
    $lokasi_konser = isset($_POST['lokasikonser']) ? $_POST['lokasikonser'] : '';


    $nama_konser = mysqli_real_escape_string($conn, $nama_konser);
    $nama_artis = mysqli_real_escape_string($conn, $nama_artis);
    $tanggal_konser = mysqli_real_escape_string($conn, $tanggal_konser);
    $lokasi_konser = mysqli_real_escape_string($conn, $lokasi_konser);


    $sql = "select konser_data.id_konser, poster, tanggal_awal, tanggal_akhir, judul, MIN(tiket_data.harga) AS harga_terendah FROM konser_data NATURAL JOIN featuring NATURAL JOIN artis LEFT JOIN tiket_data ON konser_data.id_konser = tiket_data.id_konser WHERE tanggal_akhir >= CURDATE()";

    if (!empty($nama_konser)) {
        $sql .= " AND judul LIKE '%$nama_konser%'";
    }

    if (!empty($nama_artis)) {
        $sql .= " AND artis.nama_artis LIKE '%$nama_artis%'";
    }

    if (!empty($tanggal_konser)) {
        $sql .= " AND '$tanggal_konser' BETWEEN tanggal_awal AND tanggal_akhir";
    }
    if (!empty($lokasi_konser)) {
        $sql .= " AND kota LIKE '%$lokasi_konser%'";
        $sql .= " OR venue LIKE '%$lokasi_konser%'";
    }
    $sql .= " GROUP BY konser_data.id_konser";

    
    $result = mysqli_query($conn, $sql);

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmoni Konser Indonesia</title>
    <link rel="stylesheet" href="indexcss.css">
    <style>
        .konserterkini table {
            width: 80%;
            border-collapse: collapse;
        }
        .konserterkini td {
            padding: 10px;
            text-align: center;
        }
        .konserterkini img.ukuranposter {
            /* width: 300px;
            height: 400px; */
            object-fit: cover;
        }

        .konserterkini table .judulposter {
            margin-top: 5px;
            font-size: 17px;
        }
    
    </style>
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
        <form id="formpencarian" action="search.php" method="POST"><center>
            <table id="tabelpencarian">
                <tr>
                    <td>
                        <input type="text" class="input" id="carinamakonser" name="carinamakonser"  placeholder="masukkan nama konser">
                    </td>
                    <td>
                        <input type="text" class="input" id="carinamaartis" name="carinamaartis"  placeholder="masukkan nama artis">
                    </td>
                    <td>
                        <input type="date" class="input" id="tanggalkonser" name="tanggalkonser">
                    </td>
                    <td>
                        <input type="text" class="input" id="lokasikonser" name="lokasikonser" placeholder="masukkan lokasi konser">
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
            <?php
                if ($result && mysqli_num_rows($result) > 0){
                 echo "<h1>Daftar Konser Terkini</h1>";
                } else {
                    echo "<h1>Konser Tidak Ditemukan</h1>
                    <br>";
                }
                ?>
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

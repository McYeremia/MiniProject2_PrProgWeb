<?php
    session_start();

    ///cek login
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    require "functions.php";
    $username = $_SESSION["username"];

    $result = mysqli_query($conn, "SELECT * FROM user_data WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);
    $password = $user['password'];
    $email = $user['email'];
    $user_id = $user['id_user'];

    $hitungpanjangpassword = strlen($password);
    $penutuppassword = str_repeat('•', $hitungpanjangpassword);
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
            Halo, <?php echo $username; ?>
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
                        <?php echo $username; ?>
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
                        <?php echo $penutuppassword; ?>
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
                        <?php echo $email; ?>
                    </p>
                </td>
            </tr>
        </table>
    </div>
    <div class="tombollogout">
        <form method="post" action="logout.php">
            <button class="btn" type="submit" name="logout">Log out</button>
        </form>
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
                            Jumlah
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Tipe Tiket
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Aksi
                        </h4>
                    </td>
                </tr>
            </thead>
            <tbody class="tabeltiketuserisi">
                <?php
                $resultpemesanan = mysqli_query($conn, "SELECT * FROM pembelian NATURAL JOIN tiket_data WHERE id_user = '$user_id'");
                if(isset($resultpemesanan)) :
                    while($infotiket = mysqli_fetch_assoc($resultpemesanan)) :
                        $id_pembelian = $infotiket['id_pembelian'];
                        $jumlahtiket = $infotiket['jumlah'];
                        $id_konser = $infotiket['id_konser'];     
                        $jenis_tiket = $infotiket['jenis_tiket'];                                                           
                        $resultkonser = mysqli_query($conn, "SELECT * FROM konser_data WHERE id_konser = '$id_konser'");
                        if(mysqli_num_rows($resultkonser) === 1){
                            $infokonser = mysqli_fetch_assoc($resultkonser);
                            $judulkonser = $infokonser['judul'];
                            $lokasikonser = $infokonser['venue']. " - " .$infokonser['kota'];
                            $tanggalKonserAwal = $infokonser['tanggal_awal'];
                            $tanggalKonserAkhir = $infokonser['tanggal_akhir'];
                            if($tanggalKonserAwal == $tanggalKonserAkhir){
                                $tanggalKonser = $tanggalKonserAwal;
                            } else {
                                $tanggalKonser = $tanggalKonserAwal. " - " .$tanggalKonserAkhir;
                            }
                        }
                ?>
                <tr>
                    <td><?php echo $judulkonser; ?></td>
                    <td><?php echo $lokasikonser; ?></td>
                    <td><?php echo $tanggalKonser; ?></td>
                    <td><?php echo $jumlahtiket; ?></td>
                    <td><?php echo $jenis_tiket; ?></td>
                    <td>
                        <form method="post" action="delete_ticket.php" onsubmit="return confirmDelete()">
                            <input type="hidden" name="id_pembelian" value="<?php echo $id_pembelian; ?>">
                            <button class="hapus" type="submit" name="delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; endif; ?>
            </tbody>
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
<script>
function confirmDelete() {
    return confirm("Apakah Anda yakin untuk menghapus tiket ini?");
}
</script>


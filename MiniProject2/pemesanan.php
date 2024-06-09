<?php
session_start();

    ///cek login
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    require "functions.php";

    $idKonser = $_GET['id_konser'];
    $idTiket = $_GET['id_tiket'];
    $jumlah = $_GET['jumlah'];

    $result = mysqli_query($conn, "SELECT * FROM konser_data WHERE id_konser = $idKonser");
    $ambilStok = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_tiket = $idTiket");

    $stokJenisTiket = mysqli_fetch_assoc($ambilStok);
    $stok = $stokJenisTiket['stok'];
    $tiketDipilih = $stokJenisTiket['jenis_tiket'];
    $hargaTiket = $stokJenisTiket['harga'];


    $detailKonser = mysqli_fetch_assoc($result);
    $namaKonser = $detailKonser['judul'];
    $deskripsiKonser = $detailKonser['description'];
    $tanggalKonserAwal = $detailKonser['tanggal_awal'];
    $tanggalKonserAkhir = $detailKonser['tanggal_akhir'];
    $lokasiKonser = $detailKonser['kota'];
    $venueKonser = $detailKonser['venue'];
    $posterKonser = $detailKonser['poster'];
    $hargaTiketFormat = $hargaTiket ? number_format($hargaTiket, 0, ',', '.') : 'Tidak Tersedia';

    $hargaTotal = $hargaTiket * $jumlah;
    $hargaTotalFormat = $hargaTotal ? number_format($hargaTotal, 0, ',', '.') : 'Tidak Tersedia';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan tiket</title>
    <link rel="stylesheet" href="pemesanan.css">
    <script>
        function validateForm() {
            const phoneNumbers = new Set();
            const jumlah = <?php echo $jumlah; ?>;
            for (let i = 0; i < jumlah; i++) {
                const phoneInput = document.getElementById(`nomortelepon${i}`);
                const phoneValue = phoneInput.value.trim();

                if (!/^\d+$/.test(phoneValue)) {
                    alert(`Nomor telepon data diri ${i + 1} harus berupa angka.`);
                    phoneInput.focus();
                    return false;
                }

                if (phoneNumbers.has(phoneValue)) {
                    alert(`Nomor telepon data diri ${i + 1} duplikat. Masukkan nomor yang berbeda.`);
                    phoneInput.focus();
                    return false;
                }
                phoneNumbers.add(phoneValue);
            }
            return true;
        }
    </script>
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
            } else {
                ?>
                <a href="akun.php" class="pilihan">Akun</a>
                <a href="logout.php" class="pilihan">Logout</a>
                <?php   
            }
        ?>
    </header>
    
    <div class="tabelkonser">
        <table border="0">
            <tr>
                <td>
                    <img src="<?php echo $posterKonser ?>" alt="posterkonser">
                </td>
            </tr>
            <tr>
                <td>
                    <h4><?php echo $namaKonser ?></h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4><?php echo $tiketDipilih ?> - <?php echo $jumlah ?> Tiket</h4>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Harga Tiket: <?php echo $hargaTiketFormat ?> / Tiket</p>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>Total: <?php echo $hargaTotalFormat ?></h3>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <form action="submit_order.php" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="id_konser" value="<?php echo $idKonser; ?>">
            <input type="hidden" name="id_tiket" value="<?php echo $idTiket; ?>">
            <input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
            <input type="hidden" name="stok" value="<?php echo $stok; ?>">
            <table border="0">
                <?php
                for ($i = 0; $i < $jumlah; $i++) {?>
                    <table border="0">
                            <thead>
                                <h1>Data Diri <?php echo $i + 1 ?></h1>
                            </thead>
                            <tr>
                                <label for="namaDepan<?php echo $i ?>">Masukan nama depan </label><br>
                                <input type="text" name="namaDepan<?php echo $i ?>" id="namaDepan<?php echo $i ?>" placeholder="Masukan nama depan" required><br><br>
                            </tr>
                            <tr>
                                <label for="namaBelakang<?php echo $i ?>">Masukan nama belakang</label><br>
                                <input type="text" name="namaBelakang<?php echo $i ?>" id="namaBelakang<?php echo $i ?>" placeholder="Masukan nama belakang" required><br><br>
                            </tr>
                            <tr>
                                <label for="nomortelepon<?php echo $i ?>">Masukan nomor telepon</label><br>
                                <input type="text" name="nomortelepon<?php echo $i ?>" id="nomortelepon<?php echo $i ?>" placeholder="Masukan nomor telepon" required><br><br>
                            </tr>
                            <tr>
                                <label for="email<?php echo $i ?>">Masukan email anda</label><br>
                                <input type="email" name="email<?php echo $i ?>" id="email<?php echo $i ?>" placeholder="Masukan email anda" required><br><br>
                                </hr>
                            </tr>                   
                        </table>
                        <?php 
                }
                ?>
                <tr>
                    <td>
                        <button type="submit">Pesan Tiket</button>
                    </td>
                </tr>
            </table>
        </form>
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

<?php
session_start();
require "functions.php";

if (!isset($_GET['id_pembelian'])) {
    echo "Missing parameters.";
    exit;
}

$idPembelian = $_GET['id_pembelian'];

$orderResult = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_pembelian = $idPembelian");
if (!$orderResult) {
    die("Query error: " . mysqli_error($conn));
}
$existingData = mysqli_fetch_assoc($orderResult);


$idKonser = $existingData['id_konser'];
$idTiket = $existingData['id_tiket'];
$jumlah = $existingData['jumlah'];
$idPembelian = $existingData['id_pembelian'];

$result = mysqli_query($conn, "SELECT * FROM konser_data WHERE id_konser = $idKonser");
$ambilStok = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_tiket = $idTiket");
$ambilTiket = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_tiket = $idTiket");
$dataPembelian = mysqli_query($conn, "SELECT * FROM pemesanan_data WHERE id_pembelian = $idPembelian");

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
    <title>Edit Pemesanan Tiket</title>
    <link rel="stylesheet" href="pemesanan.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                echo '<a href="akun.php" class="pilihan">Login</a>';
            } else {
                echo '<a href="akun.php" class="pilihan">Akun</a>';
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
        <form action="edit_order.php" method="post" onsubmit="return validateForm()">
            <input type="hidden" name="id_konser" value="<?php echo $idKonser; ?>">
            <input type="hidden" name="id_tiket" value="<?php echo $idTiket; ?>">
            <input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
            <input type="hidden" name="stok" value="<?php echo $stok; ?>">
            <input type="hidden" name="edit" value="1">
            <input type="hidden" name="id_pembelian" value="<?php echo $idPembelian; ?>">
            
            <?php
             $count = 1;
             while ($row = mysqli_fetch_assoc($dataPembelian)){ 
             ?>
                <table border="0">
                    <thead>
                        <h1>Data Diri <?php echo $count ?></h1>
                        <input type="hidden" name="id_data_pemesanan<?php echo $count ?>" value="<?php echo ($row["id_data_pemesanan"]) ?>">
                    </thead>
                    <tr>
                        <label for="namaDepan<?php echo $count ?>">Masukan nama depan </label><br>
                        <input type="text" name="namaDepan<?php echo $count ?>" id="namaDepan<?php echo $i ?>" value="<?php echo ($row["nama_depan"]) ?>" placeholder="Masukan nama depan" required><br><br>
                    </tr>
                    <tr>
                        <label for="namaBelakang<?php echo $count ?>">Masukan nama belakang</label><br>
                        <input type="text" name="namaBelakang<?php echo $count ?>" id="namaBelakang<?php echo $i ?>" value="<?php echo ($row["nama_belakang"]) ?>" placeholder="Masukan nama belakang" required><br><br>
                    </tr>
                    <tr>
                        <label for="nomortelepon<?php echo $count ?>">Masukan nomor telepon</label><br>
                        <input type="text" name="nomortelepon<?php echo $count ?>" id="nomortelepon<?php echo $i ?>" value="<?php echo ($row["no_HP"]) ?>" placeholder="Masukan nomor telepon" required><br><br>
                    </tr>
                    <tr>
                        <label for="email<?php echo $count ?>">Masukan email anda</label><br>
                        <input type="email" name="email<?php echo $count ?>" id="email<?php echo $i ?>" value="<?php echo ($row["email"]) ?>" placeholder="Masukan email anda" required><br><br>
                    </tr>
                </table>

            <?php 
                 $count++;
             }?>
            <tr>
                <td>
                    <button type="submit">Edit Tiket</button>
                </td>
            </tr>
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

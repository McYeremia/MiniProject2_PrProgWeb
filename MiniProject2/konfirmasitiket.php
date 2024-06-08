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

    $result = mysqli_query($conn, "SELECT * FROM konser_data WHERE id_konser = $idKonser");
    $ambilStok = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_tiket = $idTiket");

    $stokJenisTiket = mysqli_fetch_assoc($ambilStok);
    $stok = $stokJenisTiket['stok'];
    $tiketDipilih = $stokJenisTiket['jenis_tiket'];


    $detailKonser = mysqli_fetch_assoc($result);
    $namaKonser = $detailKonser['judul'];
    $deskripsiKonser = $detailKonser['description'];
    $tanggalKonserAwal = $detailKonser['tanggal_awal'];
    $tanggalKonserAkhir = $detailKonser['tanggal_akhir'];
    $lokasiKonser = $detailKonser['kota'];
    $venueKonser = $detailKonser['venue'];
    $posterKonser = $detailKonser['poster'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan tiket</title>
    <link rel="stylesheet" href="konfirmasitiketcss.css">
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
    
    <div class="tabelkonser">
        <table border=  "0">
            <tr>
                <td>
                    <img src="<?php echo $posterKonser?>" alt="posterkonser">
                </td>
            </tr>
            <tr>
                <td>
                    <h4><?php echo $namaKonser?></h4>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        <?php
                             if($tanggalKonserAwal == $tanggalKonserAkhir){
                                echo $tanggalKonserAwal;
                            } else {
                                echo $tanggalKonserAwal?> sampai <?php echo $tanggalKonserAkhir;
                            } 
                        ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Stok Tiket : <?php echo $stok?></p>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <table border="0">
            <tr>
                <td>
                    <h1>Jenis Tiket :</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                    <h2><?php echo $tiketDipilih?></h2>
                </td>
            </tr>
        </table>
    </div>

    <div class="jumlahtiket">
        <table border="0">
            <tr>
                <td>
                    <h3>Jumlah Tiket Dipesan:</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <div class='ticket-quantity'>
                        <button class='quantity-button' type='button' onclick='decreaseQuantity({$id_tiket})'>-</button>
                        <input type='text' name='quantity[{$id_tiket}]' id='quantity-{$id_tiket}' value='0' readonly>
                        <button class='quantity-button' type='button' onclick='increaseQuantity({$id_tiket}, {$stok_tiket})'>+</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="tombol">
        <table border="0">
            <tr>
                <td>
                    <div class="tombolpesan">
                        <form method="post" action="pemesanan.php">
                            <button class="btn2" type="submit" name="logout">Pesan</button>
                        </form>
                    </div>
                </td>
                <td>
                    <div class="tombolcancel">
                        <form method="post" action="detailkonser.php?id_konser=<?php echo $idKonser?>">
                            <button class="btn" type="submit" name="logout">Cancel</button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
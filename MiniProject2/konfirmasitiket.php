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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan tiket</title>
    <link rel="stylesheet" href="konfirmasitiketcss.css">
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
    
    <div class="tabelkonser">
        <table border= "0">
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
                    <?php 
                    $output = $tiketDipilih. " - Rp. " .$hargaTiketFormat; 
                    ?>
                    <h2><?php echo $output ?></h2>
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
                        <button class='quantity-button' type='button' onclick='decreaseQuantity(<?php echo $idTiket; ?>)'>-</button>
                        <input type='text' name='quantity[<?php echo $idTiket; ?>]' id='quantity-<?php echo $idTiket; ?>' value='0' readonly>
                        <button class='quantity-button' type='button' onclick='increaseQuantity(<?php echo $idTiket; ?>, <?php echo $stok; ?>)'>+</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="hargatiket">
        <table border="0">
            <tr>
                <td>
                    <h3>Harga :</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <span id="total-price">Rp 0</span>
                </td>
            </tr>
        </table>
    </div>

    <div class="tombol">
        <table border="0">
            <tr>
                <td>
                    <div class="tombolpesan">
                        <form id="orderForm-<?php echo $idTiket; ?>" method="post" onsubmit="return updateFormAction(<?php echo $idTiket; ?>,<?php echo $idKonser; ?>)">
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
    function increaseQuantity(idTiket, stokTiket) {
        let quantityInput = document.getElementById('quantity-' + idTiket);
        let quantity = parseInt(quantityInput.value);

        if (quantity < stokTiket) {
            quantity++;
            quantityInput.value = quantity;
            updateTotalPrice(idTiket, quantity);
        }
    }

    function decreaseQuantity(idTiket) {
        let quantityInput = document.getElementById('quantity-' + idTiket);
        let quantity = parseInt(quantityInput.value);

        if (quantity > 0) {
            quantity--;
            quantityInput.value = quantity;
            updateTotalPrice(idTiket, quantity);
        }
    }

    function updateTotalPrice(idTiket, quantity) {
        let hargaTiket = <?php echo $hargaTiket; ?>;
        let totalPriceElement = document.getElementById('total-price');
        let totalPrice = hargaTiket * quantity;
        totalPriceElement.innerText = 'Rp ' + totalPrice.toLocaleString('id-ID');
    }

    function updateFormAction(idTiket, idKonser) {
        var quantity = document.getElementById('quantity-' + idTiket).value;
        if (quantity == 0) {
            alert('Jumlah tiket yang dipesan tidak boleh 0.');
            return false;
        }
        var form = document.getElementById('orderForm-' + idTiket);
        form.action = 'pemesanan.php?id_tiket=' + idTiket + '&jumlah=' + quantity + '&id_konser=' + idKonser;
        return true;
    }
</script>

<?php
    session_start();

    ///cek login
    // if (!isset($_SESSION["login"])){
    //     header("Location: login.php");
    //     exit;
    // }

    require "functions.php";
    
    if (!isset($_GET['id_konser'])) {
        header("Location: index.php");
        exit;
    }

    $idKonser = $_GET['id_konser'];

    $result = mysqli_query($conn, "SELECT * FROM konser_data WHERE id_konser = $idKonser");
    $namaartis = mysqli_query($conn, "SELECT * FROM konser_data NATURAL JOIN featuring NATURAL JOIN artis WHERE id_konser = $idKonser");

    $artisKonser = [];
    while ($row = mysqli_fetch_assoc($namaartis)) {
        $artisKonser[] = $row['nama_artis'];
    }


    $detailKonser = mysqli_fetch_assoc($result);
    // $ambilartis = mysqli_fetch_assoc($namaartis);
    $namaKonser = $detailKonser['judul'];
    $deskripsiKonser = $detailKonser['description'];
    // $artisKonser = $ambilartis['nama_artis'];
    $tanggalKonserAwal = $detailKonser['tanggal_awal'];
    $tanggalKonserAkhir = $detailKonser['tanggal_akhir'];
    $lokasiKonser = $detailKonser['kota'];
    $venueKonser = $detailKonser['venue'];
    $posterKonser = $detailKonser['poster'];
    $seatingKonser = $detailKonser['seating'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmoni Konser Indonesia</title>
    <link rel="stylesheet" href="detailkonser.css">
    <style>
        
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
    <h1 class="headline"> Detail Konser</h1>
    
    <div class='detailposterkonser'>
        <table border="0">
            <tr>
                <td rowspan = "8">
                    <img class="gambar" src="<?php echo $posterKonser; ?>" alt="posterkonser">
                </td>
            </tr>
            <tr>
                <td>
                    <h1><?php echo $namaKonser?></h1>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Artis : </h2>
                    <p><?php echo implode(', ', $artisKonser); ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <h2>Date: </h2>
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
                    <h2>Lokasi:</h2>
                    <p><?php echo $lokasiKonser?></p>
                </td>
            </tr>
            <tr>
                <td class='deskripsikonser'>
                    <h2>Description: </h2>
                    <p><?php echo $deskripsiKonser?></p>
                </td>
            </tr>
        </table>
    </div>
    <div>
    <?php
        if ($seatingKonser != null){
            ?>
            <img class='gambarSeating' src='<?php echo $seatingKonser; ?>' alt='seating'>
            <?php
        }
        
        ?>
        <table border="0" class="tabelpilihantiket">
            <thead>
                <tr>
                    <td>
                        <h4>
                            Jenis Tiket
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Harga
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Stok
                        </h4>
                    </td>
                    <td>
                        <h4>
                            Klik Disini Untuk Pesan
                        </h4>
                    </td>
                </tr>
            </thead>
            <?php
                $sqltiket = "SELECT * FROM tiket_data WHERE id_konser = {$idKonser}"; // Ensure the ID is an integer to prevent SQL injection
                $result = mysqli_query($conn, $sqltiket);
                if ($result && mysqli_num_rows($result) > 0) {
                    $count = 0; // Counter to track the number of boxes in a row
                    while ($tiket = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        $id_tiket = $tiket['id_tiket'];
                        $jenis_tiket = $tiket['jenis_tiket'];
                        $harga_tiket = number_format($tiket['harga'], 2, ',', '.');
                        $stok_tiket = $tiket['stok'];
                        
                        echo "<td>{$jenis_tiket}</td>
                                <td>Rp. {$harga_tiket}</td>
                                <td>Stok: {$stok_tiket}</td>
                                <td>";
                        if ($stok_tiket != 0) {
                            echo "<button onclick='navigateToPage({$id_tiket})'>Pesan Sekarang</button>";
                        } else {
                            echo "<button onclick='navigateToPage({$id_tiket})' disabled>Stok Habis</button>";
                            }
                        $count++;
                    }
                    echo '</td>
                    </tr>'; // Close the last row
                } else {
                    echo "Tidak ada tiket tersedia.";
                    if (!$result) {
                        echo "Error: " . mysqli_error($conn); // Output any SQL error for debugging
                    }
                }
            ?>
        </table>
    </div>
    <script>
        function navigateToPage(id_tiket) {
            var url = 'pemesanan.php?id_tiket=' + encodeURIComponent(id_tiket);
            window.location.href = url;
        }
    </script>
</html>
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
    $namaartis = mysqli_query($conn, "SELECT * FROM artis WHERE id_konser = $idKonser");

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harmoni Konser Indonesia</title>
    <link rel="stylesheet" href="detailkonser.css">
    <style>
        .gambar{
            width: 240pt;
            margin-left: 50px;
            border-radius: 10pt;
            padding: 5px;
            margin-right: 60pt;
        }

        .headline{
            margin-top: 20px;
            text-align: center;
        }

        .detailposterkonser td{
            padding :0px;
            margin: 0px;
        }

        .detailposterkonser h1{
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .detailposterkonser h2{
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn{
            margin-top: 20px;
            margin-bottom: 20px;
            
        }

        .deskripsikonser{
            font-size: 12px;
            text-justify: auto;
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
    
    <button onclick="navigateToPage()"class="btn">Pesan Sekarang</button>
    <script>
        function navigateToPage() {
            window.location.href = "pemesanan.php";
        }
    </script>

</html>
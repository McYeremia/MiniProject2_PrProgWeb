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
    <!-- <style>
        .btn{
            margin-bottom: 10px;
        }
    </style> -->
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
                        <?php 
                           echo $username;
                        
                        ?>
                        
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
                        <?php 
                           echo $penutuppassword;
                        
                        ?>
                        
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
                    <?php 
                           echo $email;
                        
                        ?>
                        
                    </p>
                </td>
            </tr>
        </table>
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
                </tr>
            </thead>
            <!-- !!!Jangan Di Hapus!!! -->
            <!-- <div class="tabeltiketuserisi">
                <?php $resultpemesanan = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_user = '$user_id'");?>
                <?php if(isset($resultpemesanan)) :?>
                    <?php while($infotiket = mysqli_fetch_assoc($resultpemesanan)) : 
                        $jumlahtiket = $infotiket['jumlah'];
                        $id_konser = $infotiket['id_konser'];                                                                    
                        $resultkonser = mysqli_query($conn, "SELECT * FROM konser_data WHERE id_konser = '$id_konser'");

                        if(mysqli_num_rows($resultkonser) === 1){
                            $infokonser = mysqli_fetch_assoc($resultkonser);
                            $judulkonser = $infokonser['nama_konser'];
                            $lokasikonser = $infokonser['lokasi_konser'];
                            $tanggalkonser = $infokonser['tanggal_konser'];
                        }
                    ?>
                <tr>
                    <td>
                        <?php
                            if(isset($judulkonser)){
                                echo $judulkonser;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if(isset($lokasikonser)){
                                echo $lokasikonser;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if(isset($tanggalkonser)){
                                echo $tanggalkonser;
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if(isset($jumlahtiket)){
                                echo $jumlahtiket;
                            }
                        ?>
                    </td>
                </tr>
                    <?php endwhile;?>
                <?php endif;?>
            </div> -->
            <!-- !!!Jangan Di Hapus!!! -->
        </table>
    </div>
    <div class="tombollogout">
        <form method="post" action="logout.php">
            <button class="btn" type="submit" name="logout">Log out</button>
        </form>
    </div>
</body>
</html>
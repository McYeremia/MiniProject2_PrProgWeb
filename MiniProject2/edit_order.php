<?php
session_start();

// cek login
if (!isset($_SESSION["login"])) {
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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idKonser = $_POST['id_konser'];
    $idTiket = $_POST['id_tiket'];
    $jumlah = $_POST['jumlah'];
    $stok = $_POST['stok'];
    


    $result = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_konser = '$idKonser' AND id_tiket = '$idTiket' AND jumlah = '$jumlah' AND id_user = '$user_id'");
    $pembelian = mysqli_fetch_assoc($result);
    $idPembelian = $pembelian['id_pembelian'];

    for ($i = 1; $i <= $jumlah; $i++) {
        $namaDepan = $_POST['namaDepan' . $i];
        $namaBelakang = $_POST['namaBelakang' . $i];
        $nomorTelepon = $_POST['nomortelepon' . $i];
        $email = $_POST['email' . $i];
        $id_data_pemesanan = $_POST['id_data_pemesanan' . $i];

        $query = "update pemesanan_data SET nama_depan = '$namaDepan', nama_belakang = '$namaBelakang', no_HP = '$nomorTelepon', email = '$email' WHERE id_data_pemesanan = $id_data_pemesanan";

        if (!mysqli_query($conn, $query)) {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            exit;
        }
    
    }
    
    header("Location: akun.php");
    exit;
}
?>
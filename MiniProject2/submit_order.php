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

    $query = "INSERT INTO pembelian (id_konser, id_tiket, jumlah, id_user) 
                  VALUES ('$idKonser', '$idTiket', '$jumlah', '$user_id')";
    
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        exit;
    }

    $result = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_konser = '$idKonser' AND id_tiket = '$idTiket' AND jumlah = '$jumlah' AND id_user = '$user_id'");
    $pembelian = mysqli_fetch_assoc($result);
    $idPembelian = $pembelian['id_pembelian'];

    for ($i = 0; $i < $jumlah; $i++) {
        $namaDepan = $_POST['namaDepan' . $i];
        $namaBelakang = $_POST['namaBelakang' . $i];
        $nomorTelepon = $_POST['nomortelepon' . $i];
        $email = $_POST['email' . $i];

        $query = "INSERT INTO pemesanan_data (id_pembelian, nama_depan, nama_belakang, no_HP, email, id_tiket) 
                  VALUES ('$idPembelian', '$namaDepan', '$namaBelakang', '$nomorTelepon', '$email', '$idTiket')";

        if (!mysqli_query($conn, $query)) {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            exit;
        }

        $query = "UPDATE tiket_data SET stok = $stok - ($i+1) WHERE id_tiket = $idTiket";
    
        if (!mysqli_query($conn, $query)) {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            exit;
        }
    }
    
    

    // Redirect to a confirmation page
    header("Location: akun.php");
    exit;
}
?>

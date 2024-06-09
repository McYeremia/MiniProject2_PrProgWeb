<?php
session_start();
require 'functions.php';

if (isset($_POST['update'])) {
    $id_pembelian = $_POST['id_pembelian'];
    $jumlah = $_POST['jumlah'];

    if ($jumlah > 0) {
        $query = "UPDATE pembelian SET jumlah = '$jumlah' WHERE id_pembelian = '$id_pembelian'";
        if (mysqli_query($conn, $query)) {
            header("Location: akun.php");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Jumlah tiket harus lebih besar dari 0.";
    }
}
?>

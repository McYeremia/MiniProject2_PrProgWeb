<?php
session_start();
require "functions.php";

if (isset($_POST['delete'])) {
    $id_pembelian = $_POST['id_pembelian'];

    
    $resultPembelian = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'");
    $pembelian = mysqli_fetch_assoc($resultPembelian);
    $id_tiket = $pembelian['id_tiket'];
    $jumlahTiket = $pembelian['jumlah'];

    
    $resultTiket = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_tiket = '$id_tiket'");
    if ($resultTiket) {
        $tiket = mysqli_fetch_assoc($resultTiket);
        $stokBaru = $tiket['stok'] + $jumlahTiket;

    
        $updateStok = mysqli_query($conn, "UPDATE tiket_data SET stok = '$stokBaru' WHERE id_tiket = '$id_tiket'");
        if ($updateStok) {
            
            $deletePemesananData = mysqli_query($conn, "DELETE FROM pemesanan_data WHERE id_pembelian = '$id_pembelian'");
            if ($deletePemesananData) {
                
                $deletePembelian = mysqli_query($conn, "DELETE FROM pembelian WHERE id_pembelian = '$id_pembelian'");
                if ($deletePembelian) {
                    header("Location: akun.php");
                    exit;
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            } else {
                echo "Error deleting related records: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating stock: " . mysqli_error($conn);
        }
    } else {
        echo "Ticket not found: " . mysqli_error($conn);
    }
} else {
    header("Location: akun.php");
    exit;
}
?>

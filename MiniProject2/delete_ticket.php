<?php
session_start();
require "functions.php";

if (isset($_POST['delete'])) {
    $id_pembelian = $_POST['id_pembelian'];

    // Get the purchase details
    $resultPembelian = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'");
    $pembelian = mysqli_fetch_assoc($resultPembelian);
    $id_tiket = $pembelian['id_tiket'];
    $jumlahTiket = $pembelian['jumlah'];

    // Update the stock of the ticket
    $resultTiket = mysqli_query($conn, "SELECT * FROM tiket_data WHERE id_tiket = '$id_tiket'");
    if ($resultTiket) {
        $tiket = mysqli_fetch_assoc($resultTiket);
        $stokBaru = $tiket['stok'] + $jumlahTiket;

        // Update the stock in the database
        $updateStok = mysqli_query($conn, "UPDATE tiket_data SET stok = '$stokBaru' WHERE id_tiket = '$id_tiket'");
        if ($updateStok) {
            // Delete related records in the pemesanan_data table
            $deletePemesananData = mysqli_query($conn, "DELETE FROM pemesanan_data WHERE id_pembelian = '$id_pembelian'");
            if ($deletePemesananData) {
                // Delete the ticket purchase record
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

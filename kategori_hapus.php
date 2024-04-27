<?php
    include("functions.php");
    global $conn;

    if(isset($_GET['id'])) {
        // Ambil id dari query string
        $id = $_GET['id'];

        // Membuat query untuk menghapus data kategori
        $sql = "DELETE FROM kategori WHERE id=$id";
        $query = mysqli_query($conn, $sql);

        // Cek apakah query berhasil menghapus data
        if($query) {
            header('Location: kategori.php');
        } else {
            die("Gagal menghapus data...");
        }
    } else {
        die();
    }
?>
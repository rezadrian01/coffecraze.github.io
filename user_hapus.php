<?php
    include("functions.php");
    global $conn;

    if(isset($_GET['phone'])) {
        // Ambil phone dari query string
        $phone = $_GET['phone'];

        // Membuat query untuk menghapus data kategori
        $sql = "DELETE FROM user WHERE phone = $phone";
        $query = mysqli_query($conn, $sql);

        // Cek apakah query berhasil menghapus data
        if($query) {
            header('Location: user.php');
        } else {
            die("Gagal menghapus data...");
        }
    } else {
        die();
    }
?>
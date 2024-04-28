<?php 
    include("functions.php");
    global $conn;

    if(isset($_GET['id'])) {
        // Ambil id
        $id = $_GET['id'];

        // Query untuk menghapus data barang
        $sql = "DELETE FROM barang WHERE id = $id";
        $query = mysqli_query($conn, $sql);

        if($query) {
            header('Location: product.php?delete-berhasil');
        } else {
            die("Gagal menghapus data...");
        };
    };
?>
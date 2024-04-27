<?php
    include("functions.php");
    global $conn;

    // Check jika tidak terdapat id di query string
    if(isset($_POST['submit-edit-kategori'])) {
        // Ambil ID kategori dari URL
        $id = $_GET['id'];
        // Ambil data dari input
        $kategori = $_POST['tambah-kategori'];

        // Membuat query update
        $sql = "UPDATE kategori SET nama = '$kategori' WHERE id = $id";
        $query = mysqli_query($conn, $sql);

        if($query) {
            header('Location: kategori.php');
        } else {
            die("Gagal menyimpan perubahan");
        }
    } else {
        die();
    }
?>
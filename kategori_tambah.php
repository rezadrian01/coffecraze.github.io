<?php
    include('functions.php');

    global $conn;

    // Cek apakah tombol submit kategori telah diklik atau belum
    if(isset($_POST['submit-kategori'])) {
        // Ambil data dari input
        $kategori = $_POST['tambah-kategori'];

        // Buat query SQL untuk memasukkan data ke dalam database
        $sql = "INSERT INTO kategori(id, nama) VALUES('', '$kategori')";
        $query = mysqli_query($conn, $sql);

        // Cek apakah query berhasil disimpan ke dalam database
        if($query) {
            header('Location: kategori.php?status=sukses');
        } else {
            header('Location: kategori.php?status=gagal');
        };
    } else {
        die();
    };
?>
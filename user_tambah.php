<?php
    include('functions.php');

    global $conn;

    // Cek apakah tombol submit kategori telah diklik atau belum
    if(isset($_POST['submit-user'])) {
        // Ambil data dari input
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $role = $_POST['role'];

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Buat query SQL untuk memasukkan data ke dalam database
        $sql = "INSERT INTO user(phone, username, password, alamat, role) VALUES('$phone', '$username', '$password_hashed', '$alamat', '$role')";
        $query = mysqli_query($conn, $sql);

        // Cek apakah query berhasil disimpan ke dalam database
        if($query) {
            header('Location: user.php?status=sukses');
        } else {
            header('Location: user.php?status=gagal');
        };
    } else {
        die();
    };
?>
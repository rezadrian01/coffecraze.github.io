<?php
    include("functions.php");
    global $conn;

    // Check jika tidak terdapat id di query string
    if(isset($_POST['submit-edit-user'])) {
        // Ambil phone user dari URL
        $phone = $_GET['phone'];

        // Ambil data dari input
        $username = $_POST['username'];
        $password = $_POST['password'];
        $alamat = $_POST['alamat'];
        $role = $_POST['role'];

        if(!$password) {
            $sql = "UPDATE user SET phone = '$phone', username = '$username', alamat = '$alamat', role = '$role' WHERE phone = $phone";
            $query = mysqli_query($conn, $sql);

            if($query) {
                header('Location: user.php');
            } else {
                die("Gagal menyimpan perubahan");
            }
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE user SET phone = '$phone', username = '$username', password = '$password_hashed', alamat = '$alamat', role = '$role' WHERE phone = $phone";
            $query = mysqli_query($conn, $sql);

            if($query) {
                header('Location: user.php');
            } else {
                die("Gagal menyimpan perubahan");
            }
        }
    } else {
        die();
    }
?>
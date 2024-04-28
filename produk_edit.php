<?php
    include("functions.php");
    global $conn;

    if(isset($_POST['submit-edit-produk'])) {
        // Image upload
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        // mendapatkan nama file yang di upload
        $nama_image = $_FILES['image']['name'];
        $x = explode('.', $nama_image);
        $ekstensi = strtolower(end($x));
        // mendapatkan ukuran file yang di upload
        $ukuran = $_FILES['image']['size'];
        // untuk mendapatkan temporary file yang di upload (tmp)
        $file_tmp = $_FILES['image']['tmp_name'];

        // Ambil id
        $id = $_POST['id'];

        // Mengambil value gambar
        $getBarang = "SELECT * FROM barang WHERE id = $id;";
        $query = mysqli_query($conn, $getBarang);
        $produk_data = mysqli_fetch_assoc($query);

        // Ambil value input
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];
        $deskripsi = $_POST['deskripsi'];

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'images/' . $nama_image);
                $sql = "UPDATE barang SET gambar = '$nama_image', nama = '$nama', harga = $harga, id_kategori = $kategori, deskripsi = '$deskripsi' WHERE id = $id;";
                $query = mysqli_query($conn, $sql);

                if($query) {
                    header('Location: product.php?edit-sukses');
                } else {
                    header('Location: produk_edit_page.php?edit-gagal');
                }
            } else {
                echo "Ukuran gambar terlalu besar";
            }
        } else {
            $sql = "UPDATE barang SET gambar = '{$produk_data['gambar']}', nama = '$nama', harga = $harga, id_kategori = $kategori, deskripsi = '$deskripsi' WHERE id = $id;";
            $query = mysqli_query($conn, $sql);

            if($query) {
                header('Location: product.php?edit-sukses');
            } else {
                header('Location: produk_edit_page.php?edit-gagal');
            }
        }
    }
?>
<?php
    include("functions.php");
    global $conn;

    if(isset($_POST['submit-tambah-produk'])) {
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

        // Ambil value input
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];
        $deskripsi = $_POST['deskripsi'];

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'images/' . $nama_image);
                $sql = "INSERT INTO barang(id, gambar, nama, harga, id_kategori, deskripsi, status) VALUES('', '$nama_image', '$nama', '$harga', $kategori, '$deskripsi', 'ready');";
                $query = mysqli_query($conn, $sql);

                if($query) {
                    header('Location: product.php?upload-sukses');
                } else {
                    header('Location: produk_tambah_page.php?upload-gagal');
                }
            } else {
                echo "Ukuran gambar terlalu besar";
            }
        } else {
            echo "Ekstensi gambar yang di upload tidak diperbolehkan";
        }
    }
?>
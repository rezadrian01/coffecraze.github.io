<?php
    session_start();

    include("functions.php");
    global $conn;

    if(isset($_POST['checkout-submit'])) {
        $nama = $_POST['nama'];
        $phone = $_POST['phone'];
        $alamat = $_POST['alamat'];
        $pemesanan_makanan = $_POST['pemesanan_makanan'];

        // Mendapatkan data user untuk mengupdate alamat user jika alamat tersebut masih bernilai kosong/NULL
        $getUserData = "SELECT * FROM user WHERE phone = '{$_SESSION['data']['phone']}';";
        $getUserDataQuery = mysqli_query($conn, $getUserData);
        
        // Menginputkan data ke dalam tabel pembelian
        $sql = "INSERT INTO pembelian(id, id_user, nama, phone, alamat, pemesanan_makanan ,status) VALUES('', '{$_SESSION['data']['phone']}', '$nama', '$phone', '$alamat', '$pemesanan_makanan', 'in process');";
        $query = mysqli_query($conn, $sql);

        // Setelah berhasil memasukkan data ke dalam tabel pembelian, maka selanjutnya yaitu memasukkan barang dari cart ke dalam tabel barang_dibeli
        if($query) {
            // Mengambil ID yang baru saja dibuat pada tabel pembelian
            $lastInsertedId = mysqli_insert_id($conn);

            if($lastInsertedId) { 
                // Mengambil barang dari cart
                $getProductFromCart = "SELECT * FROM cart WHERE id_user = '{$_SESSION['data']['phone']}'";
                $getProductFromCartQuery = mysqli_query($conn, $getProductFromCart);

                while($data = mysqli_fetch_array($getProductFromCartQuery)) {
                    // Memindah barang dari cart ke dalam barang_dibeli dan menghapus tersebut dari cart
                    $barangDibeli = "INSERT INTO barang_dibeli(id_pembelian, id_barang, jumlah) VALUES('$lastInsertedId', '{$data['id_barang']}', '{$data['jumlah']}');";
                    $barangDibeliQuery = mysqli_query($conn, $barangDibeli);

                    // Check jika barang telah berhasil ditambahkan ke dalam tabel barang_dibeli maka product dalam cart akan dihapus
                    if($barangDibeliQuery) {
                        mysqli_query($conn, "DELETE FROM cart WHERE id = '{$data['id']}';");
                    }
                }
            }
            
            // Mengupdate alamat user jika masih bernilai kosong/NULL
            while($data = mysqli_fetch_assoc($getUserDataQuery)) {
                if($data['alamat'] === "" || NULL) {
                    mysqli_query($conn, "UPDATE user SET alamat = '$alamat' WHERE phone = '{$data['phone']}';");
                }
            }

            header('Location: index.php?message=pembelian_success');
        } else {
            die("Pembelian gagal");
        }
    }
?>
<?php

$conn = mysqli_connect("localhost","root","","ta_web");

function show($key){
    global $conn;
    if($key === false){
        $result = mysqli_query($conn, "SELECT * FROM barang WHERE status = 'ready';");
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id_kategori'];
            $kategori = mysqli_query($conn, "SELECT nama FROM kategori WHERE id = '$id'");
            $kategori = mysqli_fetch_row($kategori)[0];
            $row["kategori"] =  $kategori;
            $rows[] = $row;
        }
        return $rows;
    }
    //jika fungsi dipanggil menggunakan argument
    $result = mysqli_query($conn, "SELECT * FROM barang WHERE id_kategori = '$key' and status = 'ready';");
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $kategori = mysqli_query($conn, "SELECT nama FROM kategori WHERE id = '$key'");
        $kategori = mysqli_fetch_row($kategori)[0];
        $row["kategori"] =  $kategori;
        $rows[] = $row;
    }
    return $rows;
}

function signup($data){
    global $conn;
    $phone = strtolower($data['phone']);
    $username = strtolower(stripslashes($data['username']));
    $password1 = mysqli_real_escape_string($conn,$data['password1']);
    $password2 = mysqli_real_escape_string($conn,$data['password2']);

    //cek apakah nomor telepon sudah ada di database
    $cek = mysqli_query($conn, "SELECT phone FROM user WHERE phone = '$phone';");
    
    if(mysqli_fetch_assoc($cek)){
        echo"<script>alert('phone sudah digunakan');</script>";
        return false;
    }

    //cek konfirmasi password
    if($password1 !== $password2){
        echo"<script>
            alert('Konfirmasi password salah');
        </script>";
        return false;
    }

    $password1 = password_hash($password1, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO USER VALUES ('$phone', '$username', '$password1', '', 'user')");
    return true;
}

function addSession($phone){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE phone = '$phone';");
    $row = mysqli_fetch_assoc($result);
    return $row;
}


function addToPembelian($idUser, $alamatUser){
    global $conn;
    $insertQuery = mysqli_query($conn, "INSERT INTO pembelian VALUES('', '$idUser', '$alamatUser');");
    $idPembelian = mysqli_query($conn, "SELECT id FROM pembelian WHERE id_user = $idUser;");
    $idPembelian = mysqli_fetch_row($idPembelian)[0];
    //ambil semua barang yang dibeli user dari tabel cart
    $cart = mysqli_query($conn, "SELECT * FROM cart WHERE id_user = $idUser;");

    while($row = mysqli_fetch_assoc($cart)){
        $barang[] = $row;
    }
    //input data barang ke tabel barang_dibeli
    foreach($barang as $item){
        $idBarang = $item['id_barang'];
        $jml = $item['jumlah'];
        mysqli_query($conn, "INSERT INTO barang_dibeli VALUES('$idPembelian', '$idBarang', '$jml');");
    }
    return true;
}

function showPembayaran($idUser){
    global $conn;

    // Inisialisasi array untuk menyimpan data barang
    $dataBarang = [];

    // Query untuk mendapatkan id_pembelian
    $queryIdPembelian = mysqli_query($conn, "SELECT id FROM pembelian WHERE id_user = '$idUser';");
    $idPembelian = mysqli_fetch_row($queryIdPembelian)[0];

    // Query untuk mendapatkan semua barang yang dibeli
    $queryBarang = mysqli_query($conn, "SELECT bd.id_barang, bd.jumlah, b.* FROM barang_dibeli bd INNER JOIN barang b ON bd.id_barang = b.id WHERE bd.id_pembelian = '$idPembelian';");

    // Ambil data semua barang yang dibeli
    while($row = mysqli_fetch_assoc($queryBarang)){
        $dataBarang[] = $row;
    }

    return $dataBarang;
}

function hapusAll($idUser){
    global $conn;
    //ambil id pembelian yang terakhir di tabel pembelian
    $result = mysqli_query($conn, "SELECT id FROM pembelian WHERE id_user = '$idUser';");
    while($row = mysqli_fetch_row($result)){
        $rows[] = $row;
    }
    // var_dump($rows[0]); die();
    $idPembelian = end($rows[0]);
    //hapus data di tabel barang_dibeli
    mysqli_query($conn, "DELETE FROM barang_dibeli WHERE id_pembelian = '$idPembelian';");
    if(mysqli_affected_rows($conn) === 0){
        echo"<script>alert('Gagal menghapus di tabel barang_dibeli');</script>";
        return false;
    }
    // var_dump($idPembelian); die();
    mysqli_query($conn, "DELETE FROM pembelian WHERE id = '$idPembelian';");
    if(mysqli_affected_rows($conn) === 0){
        echo"<script>alert('Gagal menghapus di tabel pembelian');</script>";
        return false;
    }
    //hapus cart user
    mysqli_query($conn, "DELETE FROM cart WHERE id_user = '$idUser';");
    if(mysqli_affected_rows($conn) === 0){
        echo"<script>alert('Gagal menghapus di tabel pembelian');</script>";
        return false;
    }
    return true;
}

?>
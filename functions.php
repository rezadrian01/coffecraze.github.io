<?php

$conn = mysqli_connect("localhost","root","","ta_web_final");

function show($key){
    global $conn;
    if($key === false){
        $result = mysqli_query($conn, "SELECT * FROM barang;");
        $rows = [];
        while($row = mysqli_fetch_array($result)){
            $rows[] = $row;
        }
        return $rows;
    }
    $result = mysqli_query($conn, "SELECT * FROM barang WHERE id_kategori = '$key'");
    $rows = [];
    while($row = mysqli_fetch_array($result)){
        $rows[] = $row;
    }
    return $rows;
}

function signup($data){
    global $conn;
    $email = strtolower($data['email']);
    $username = strtolower(stripslashes($data['username']));
    $password1 = mysqli_real_escape_string($conn,$data['password1']);
    $password2 = mysqli_real_escape_string($conn,$data['password2']);

    //cek apakah email sudah ada di database
    $cek = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email';");
    
    if(mysqli_fetch_assoc($cek)){
        echo"<script>alert('Email sudah digunakan');</script>";
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

    mysqli_query($conn, "INSERT INTO USER VALUES ('$email', '$username', '$password1', '', 'user')");
    return true;
}



?>
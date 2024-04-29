<?php 
    if (isset($_COOKIE['user'])) {
        $key = $_COOKIE['user'];
        $result = mysqli_query($conn, "SELECT phone FROM user");
        while($row = mysqli_fetch_row($result)){
            $data = $row[0];
            if ($key === hash('sha256', $data)) {
                $isi = addSession($data);
                $_SESSION["data"] = array(
                    "phone" => $isi['phone'],
                    "username" => $isi['username'],
                    "alamat" => $isi['alamat'],
                    "role" => $isi['role']
                );
            }
        }
    }
?>
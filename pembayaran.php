<?php

require('functions.php');
session_start();

//data user yang login
$phoneUser = $_SESSION['data']['phone'];
$usernameUser = $_SESSION['data']['username'];
$alamatUser = $_SESSION['data']['alamat'];
$roleUser = $_SESSION['data']['role'];

if(isset($_POST['hapusAll'])){
    if(hapusAll($phoneUser)){
        echo"<script>alert('Berhasil menghapus');
        document.location.href = 'index.php';</script>";
    }
    else{
        echo"<script>alert('Gagal menghapus');
        document.location.href: 'index.php';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom Styles */
        .container {
            padding: 2rem;
        }

        .product-image {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .bayar {
            background-color: #de8735;
            color: white;
            border-radius: 20px;
        }

        .bayar:hover {
            background-color: #bf722a;
        }

        /* Responsive Styles */
        @media (max-width: 639px) {
            .card {
                display: flex;
                flex-direction: row-reverse; 
                align-items: center; 
            }

            .product-image {
                max-width: 100%; 
            }
        }
    </style>
</head>

<body class="font-bold">
    <div class="container mx-auto" style="max-width: 500px;">
        <h1 class="font-bold text-center text-4xl" style="border-radius: 20px; color: black;">Pesan</h1>
        <form action="" method="post">
            <button type="submit" name="hapusAll" class="w-full mt-5 mb-5 text-right text-red-400 hover:text-red-700">Remove all Items</button>
        </form>
        <?php $datas = showPembayaran($phoneUser);
        // var_dump($datas); die();
            foreach($datas as $data):
        ?>
        <div class="card flex md:flex-row flex-col items-center gap-4" style="border-radius: 10px;">
            <img src="images/<?= $data['gambar']; ?>" class="product-image md:w-1/2" style="height: 200px; border-radius: 20px;">
            <div class="product-details md:w-1/2 h-full" style="border-radius: 10px; font-weight: bold; padding: 20px;">
                <p><?= $data['nama']; ?></p>
                <p><?= $data['harga']; ?></p>
                <div class="flex items-center gap-2">
                    <p>Jumlah</p>
                    <button onclick="decrement()" class="border p-1 rounded-full hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>

                    <span id="qty" class="text-sm font-medium"><?= $data['jumlah']; ?></span>

                    <button onclick="increment()" class="border p-1 rounded-full hover:bg-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
                <button class="mt-2"><i class="fas fa-trash"></i></button>
            </div>
        </div>

        <?php endforeach; ?>
        <div class="">
            <ul class="grid grid-cols-6 gap-4 mt-5">
                <li class="col-start-1 col-end-3">Total</li>
                <li class="col-end-9 col-span-2"><?php 
                    $total = 0;
                    foreach($datas as $data){
                        $total += ($data['harga']) * ($data['jumlah']);
                    }
                    echo $total;
                ?></li>
            </ul>
        </div>
        <div>
            <button class="font-bold bayar w-full mt-5">Bayar</button>
        </div>
    </div>
</body>

</html>
<?php
    session_start();
    require('functions.php');
    require('session.php');
    $items = show(false);
    if(isset($_GET['key'])){
        $key = $_GET['key'];
        switch($key){
            case "coffee":
                $items = show(1);
                break;
            case "non coffee":
                $items = show(2);
                break;
            case "frappuccino":
                $items = show(3);
                break;
            case "seasional item":
                $items = show(4);
                break;
            case "food":
                $items = show(5);
                break;
            case "wafle":
                $items = show(6);
                break;
            case "snack":
                $items = show(7);
                break;
            case "desert":
                $items = show(8);
                break;
        }
    }
    
    //ketika user input add to cart
    if(isset($_POST['beli'])){
        $idBeli = $_POST['id'];
        $jmlBeli = $_POST['val'];
        //ambil id_user dan id_barang dari database
        $idUser = mysqli_query($conn, "SELECT id_user FROM cart WHERE id_user = '{$_SESSION["data"]["phone"]}';");
        $idBarang = mysqli_query($conn, "SELECT id_barang FROM cart WHERE id_barang = '$idBeli';");
        
        //jika user pernah membeli barang yang sama sebelumnya
        if((mysqli_num_rows($idUser) > 0) && (mysqli_num_rows($idBarang) > 0)){
            $idBarang = mysqli_fetch_row($idBarang)[0];
            $idUser = mysqli_fetch_row($idUser)[0];
            $id = mysqli_query($conn, "SELECT id FROM cart WHERE id_barang = '$idBarang';");
            $id = mysqli_fetch_row($id)[0];
            $jml = mysqli_query($conn, "SELECT jumlah FROM cart WHERE id_barang = '$idBarang';");
            $jml = mysqli_fetch_row($jml)[0];
            $jml = $jml + 1;
            mysqli_query($conn, "UPDATE cart SET id = '$id', id_user='$idUser', id_barang = '$idBarang', jumlah = '$jml' WHERE id = $id;");
            
            header("Location: index.php");
            exit();
        }
        //jika user tidak pernah beli barang / user membeli barang yang berbeda maka insert data biasa
        mysqli_query($conn, "INSERT INTO cart values('', '{$_SESSION["data"]["phone"]}', '$idBeli', '$jmlBeli');");
        header("Location: index.php");
        exit();
    }

    //jika user manipulasi get
    if(isset($_GET['key'])){
        $key = $_GET['key'];
        $result = mysqli_query($conn, "SELECT * FROM kategori");
        $row = [];
        $error = false;
        while($data = mysqli_fetch_array($result)){
            if($key === $data['nama']) {
                $error = true;
            }
        };
        if(!$error){
            header("Location: index.php");
        }
    }

    // Update tambah quantity stock barang di cart
    if(isset($_POST['tambah-quantity'])) {
        $id = $_POST['id_cart'];

        $sql = "UPDATE cart SET jumlah = jumlah + 1 WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);

        if($query) {
            // Redirect ke halaman ini untuk menghindari form resubmission
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            die();
        }
    }

    // Update mengurangi quantity stock barang di cart
    if(isset($_POST['kurang-quantity'])) {
        $id = $_POST['id_cart'];

        $sql = "UPDATE cart SET jumlah = jumlah - 1 WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);

        if($query) {
            // Redirect ke halaman ini untuk menghindari form resubmission
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            die();
        }
    }

    // Delete product dari cart
    if(isset($_GET['hapus_cart'])) {
        // Ambil id dari hapus_cart
        $id = $_GET['hapus_cart'];

        $sql = "DELETE FROM cart WHERE id = $id;";
        $query = mysqli_query($conn, $sql);

        if($query) {
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="flex">
        <div class="flex flex-col min-h-screen w-full">
            <header class="py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
                <div class="flex justify-between items-center">
                    <div class="text-xl font-medium">Logo</div>
                    <!-- jika belum login maka tombolnya login/signup -->
                    <?php if (!isset($_SESSION["data"])) : ?>
                        <div class="flex items-center gap-x-2">
                            <a href="login.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Log in</a>
                            <a href="signup.php" class="py-3 px-6 border hover:bg-[#eeeeee] text-sm text-black font-medium rounded-full">Sign up</a>
                        </div>
                    <!-- jika sudah login maka tombol menjadi logout -->
                    <?php else : ?>
                        <div id="parent-dropdown" class="relative inline-block">
                            <button onclick="menuDropdown()" class="flex items-center py-3 pl-6 pr-5 border rounded-full font-medium text-sm">
                                Welcome, <span class="font-normal"><?php echo $_SESSION['data']['username']; ?></span>
                            
                                <span class="ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </button>

                            <div id="menu-dropdown" class="hidden absolute top-auto right-0 w-52">
                                <ul class="mt-2 p-1 bg-white shadow-md rounded-xl border">
                                    <?php
                                        if($_SESSION['data']['role'] === "admin") {
                                    ?>
                                        <li>
                                            <a href="dashboard.php">
                                                <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                                    Dashboard
                                                </button>
                                            </a>
                                        </li>
                                        
                                    <?php }; ?>
                                    <li>
                                        <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                            Profile
                                        </button>
                                    </li>
                                    <li>
                                        <div class="w-full">
                                            <a href="logout.php">
                                                <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                                    Logout
                                                </button>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <a href="logout.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Logout</a> -->
                    <?php endif; ?>
                </div>
            </header>

            <main class="grow py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
                <div class="flex justify-between items-center mt-3 mb-8">
                    <div class="flex items-center overflow-x-auto gap-x-2">
                        <!--kategori-->
                        <?php if(!isset($_GET['key'])): ?>
                            <a href="index.php" class="py-2 px-4 rounded-full text-sm text-white font-semibold bg-[#723E29]">
                                All
                            </a>
                            <?php else: ?>
                                <a href="index.php" class="py-2 px-4 rounded-full text-sm text-white font-semibold bg-[#8d6e63]">
                                All
                            </a>
                        <?php endif; ?>
                        <?php
                            $getCategory = "SELECT * FROM kategori";
                            $getCategoryQuery = mysqli_query($conn, $getCategory);

                            while($data = mysqli_fetch_array($getCategoryQuery)) {
                        ?><?php if(isset($_GET['key']) && $_GET['key'] === $data['nama']): ?>
                                <a href="index.php?key=<?= $data['nama']; ?>" class="py-2 px-4 rounded-full text-sm text-white font-semibold bg-[#723E29] capitalize whitespace-nowrap">
                                    <?php echo $data['nama'] ?>
                                </a>
                            <?php else: ?>
                                <a href="index.php?key=<?= $data['nama']; ?>" class="py-2 px-4 rounded-full text-sm text-white font-semibold bg-[#8d6e63] capitalize whitespace-nowrap">
                                    <?php echo $data['nama'] ?>
                                </a>
                            <?php endif; ?>
                        <?php }; ?>
                    </div>
                    

                    <div>
                        <button class="flex items-center gap-x-2 py-2 pl-3 pr-4 rounded-full text-sm font-medium border">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path d="M10 3.75a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM17.25 4.5a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM5 3.75a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75ZM4.25 17a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM17.25 17a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM9 10a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1 0-1.5h5.5A.75.75 0 0 1 9 10ZM17.25 10.75a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM14 10a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM10 16.25a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                </svg>
                            </span>
                            Filters
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-6">
                    <?php
                        foreach($items as $data):
                    ?>
                        <div class="flex flex-col justify-between">
                            <div class="cursor-pointer" onclick='showModal(<?php echo $data["id"]?>)'>
                                <div class="h-80 w-full">
                                    <img class="h-full w-full rounded-2xl object-cover" src="<?php echo "./images/" . $data['gambar']?>" alt="coffee">
                                </div>

                                <div class="flex justify-between items-center mt-1">
                                    <!-- Product's name and category -->
                                    <div>
                                        <div class="text-sm text-[#757575] capitalize">
                                            <?php 
                                                $getProductCategory = "SELECT * FROM kategori WHERE id = {$data['id_kategori']};";
                                                $getProductsCategoryQuery = mysqli_query($conn, $getProductCategory);
                                                $resultProductCategory = mysqli_fetch_assoc($getProductsCategoryQuery);

                                                echo $resultProductCategory['nama'];
                                            ?>
                                        </div>
                                        <h6 class="font-bold text-xl text-[#3e2723] line-clamp-2">
                                            <?php echo $data['nama']; ?>
                                        </h6>
                                    </div>

                                    <!-- Rating -->
                                    <div class="flex items-center gap-x-1">
                                        <span>
                                            <svg class="w-4 h-4 text-[#fb8c00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        </span>
                                        4.0
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mt-1">
                                    <h6 class="text-lg font-bold">Rp<?php echo $data['harga']; ?></h6>
                                </div>
                            </div>

                            <div class="flex items-center gap-x-2 mt-2">
                                <!-- jika user belum login -->
                                <?php if (!isset($_SESSION["data"])) : ?>
                                    <button class="bg-[#3e2723] text-white text-center text-xs font-medium py-2.5 w-full rounded-full">
                                        Buy now
                                    </button>
                                    <a href="login.php" class="border text-xs text-center font-medium py-2.5 w-full rounded-full">
                                        Add to cart
                                    </a>
                                    <!-- jika user sudah login -->
                                <?php else : ?>
                                    <button class="bg-[#3e2723] text-white text-center text-xs font-medium py-2.5 w-full rounded-full">
                                        Buy now
                                    </button>
                                    <form class="w-full" action="" method="post">
                                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                                        <input type="hidden" name="val" value="1">
                                        <button type="submit" class="border text-xs text-center font-medium py-2.5 w-full rounded-full" name="beli">
                                            Add to cart
                                        </button>
                                    </form>
                                    
                                <?php endif; ?>
                            </div>
                        </div>

                        <div id="modal<?php echo $data['id']?>" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div onclick="hiddenModal(<?php echo $data['id']?>)" class="fixed top-0 left-0 bg-black opacity-50 w-full h-full z-[-1]"></div>    
                            
                            <div class="p-4 relative w-full max-w-screen-lg max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-3xl shadow-lg">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-end p-4 md:p-1 md:pb-0 rounded-t-2xl">
                                        <button onclick="hiddenModal(<?php echo $data['id']?>)" class="p-3 rounded-full hover:bg-[#eeeeee]">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="p-4 md:pt-4 md:pb-6 md:px-6">
                                        <div class="grid grid-cols-12 gap-x-4 px-6 pb-6">
                                            <div class="col-span-5">
                                                <img class="rounded-2xl h-[32rem] w-full object-cover" src="<?php echo "./images/" . $data['gambar']?>" alt="coffee">
                                            </div>

                                            <div class="col-span-7">
                                                <div class="tabs-parent relative flex items-center justify-between gap-x-1 p-1 bg-[#e0e0e0] rounded-full">
                                                    <button onclick="tab(event, 'details<?php echo $data['id']; ?>', '<?php echo $data['id']; ?>')" class="tablinks<?php echo $data['id']; ?> w-full text-center py-2 rounded-full active">Details</button>
                                                    <button onclick="tab(event, 'review<?php echo $data['id']; ?>', '<?php echo $data['id']; ?>')" class="tablinks<?php echo $data['id']; ?> w-full text-center py-2 rounded-full">Review</d>
                                                </div>

                                                <div id="details<?php echo $data['id']; ?>" class="tab-content<?php echo $data['id']; ?> mt-4" style="display: block;">
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <div class="text-2xl text-black font-medium"><?php echo $data['nama']; ?></div>
                                                            <div class="text-base text-[#757575] capitalize"><?php echo $resultProductCategory['nama']; ?></div>
                                                        </div>

                                                        <div>
                                                            <button class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Buy now</button>
                                                            <button class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Add to cart</button>
                                                        </div>
                                                    </div>

                                                    <!-- Rating -->
                                                    <div class="flex items-center gap-x-2 mt-1">
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 text-[#fb8c00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                        </div>

                                                        <span>45</span>
                                                    </div>

                                                    <div class="bg-[#eeeeee] rounded-2xl py-2 px-3 mt-4">
                                                        <div class="text-lg font-bold mb-3">Description</div>

                                                        <p class="text-base">
                                                            <?php echo $data['deskripsi']; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div id="review<?php echo $data['id']; ?>" class="tab-content<?php echo $data['id']; ?> mt-2" style="display: none;">
                                                    <div class="hover:bg-[#eeeeee] py-2 px-3 rounded-2xl">
                                                        <div class="font-bold">Fathan Alfariel Adhyaksa</div>

                                                        <!-- Rating -->
                                                        <div class="flex items-center mt-0.5">
                                                            <svg class="w-4 h-4 text-[#fb8c00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                            <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                            </svg>
                                                        </div>

                                                        <p class="text-sm mt-1">
                                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, nobis. Possimus explicabo quisquam expedita distinctio fugiat sapiente aliquam. Debitis dicta omnis iure ad odit repellat vitae aliquid facere eos soluta.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>

            <footer class="py-3 px-12 border-t bg-[#723E29] text-white text-center">
                Copyright &#169;<span id="year"></span>
            </footer>
        </div>

        
        <div class="hidden md:block w-80 md:w-64 xl:w-72 2xl:w-80 border-l">
            <div class="sticky top-0 h-screen">
                <?php 
                    if(isset($_SESSION['data'])) {
                ?>
                <div class="flex flex-col justify-between h-full">
                    <div class="p-1">
                        <?php
                            $getUserCart = "SELECT * FROM cart WHERE id_user = '{$_SESSION['data']['phone']}'";
                            $getUserCartQuery = mysqli_query($conn, $getUserCart);

                            // Check if cart is empty
                            if(mysqli_num_rows($getUserCartQuery) === 0) {
                            ?>
                                <div class="flex flex-col justify-center items-center h-screen px-3">
                                    <p class="text-center text-xl font-medium">Tidak ada product yang ditambahkan ke dalam cart.</p>
                                    
                                    <dotlottie-player src="https://lottie.host/be4557e0-aa1c-48bc-886c-ab7b237c9a37/j4h6c86KWJ.json" background="transparent" speed="1" style="width: 250px; height: 250px;" loop autoplay></dotlottie-player>
                                </div>
                            <?php
                            } else {
                                while($data = mysqli_fetch_array($getUserCartQuery)) {
                            ?>
                                <div class="grid grid-cols-12 gap-x-2 rounded-2xl p-1 group">
                                    <?php
                                        $getProductData = "SELECT * FROM barang WHERE id = '{$data['id_barang']}'";
                                        $getProductDataQuery = mysqli_query($conn, $getProductData);

                                        while($productData = mysqli_fetch_array($getProductDataQuery)) {
                                    ?>
                                        <div class="col-span-4">
                                            <img class="h-24 w-full rounded-xl object-cover" src="<?php echo "./images/" . $productData['gambar']; ?>" alt="coffee">
                                        </div>

                                        <div class="col-span-8 flex flex-col justify-between">
                                            <div>
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <div class="text-xs text-[#757575] capitalize">
                                                            <?php 
                                                                $getProductCategory = "SELECT nama FROM kategori WHERE id = {$productData['id_kategori']};";
                                                                $getProductsCategoryQuery = mysqli_query($conn, $getProductCategory);
                                                                $resultProductCategory = mysqli_fetch_assoc($getProductsCategoryQuery);

                                                                echo $resultProductCategory['nama'];
                                                            ?>
                                                        </div>

                                                        <h6 title="<?php echo $productData['nama']; ?>" class="font-bold text-base text-[#3e2723] line-clamp-1">
                                                            <?php echo $productData['nama']; ?>
                                                        </h6>
                                                    </div>

                                                    <a href="<?php echo "{$_SERVER['PHP_SELF']}?hapus_cart=" . $data['id']; ?>" title="Delete from cart" class="hidden group-hover:block p-1.5 border rounded-full hover:bg-[#d32f2f] hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </a>
                                                </div>

                                                <div class="text-base font-bold mt-0.5">
                                                    Rp<?php echo $productData['harga']; ?>

                                                    <span class="text-xs font-normal text-[#424242]">
                                                        (x<?php echo $data['jumlah']; ?> <?php echo $data['jumlah'] * $productData['harga']; ?>)
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-x-2">
                                                <!-- Decrement Quantity -->
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id_cart" value="<?php echo $data['id'] ?>">

                                                    <button type="submit" name="kurang-quantity" class="border p-1 rounded-full hover:bg-[#eeeeee] disabled:cursor-not-allowed disabled:opacity-75 disabled:hover:bg-transparent" <?php echo $data['jumlah'] === '1' ? 'disabled' : ''; ?> >
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <span id="qty" class="text-sm font-medium"><?php echo $data['jumlah'] ?></span>

                                                <!-- Increment Quantity -->
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id_cart" value="<?php echo $data['id'] ?>">

                                                    <button type="submit" name="tambah-quantity" class="border p-1 rounded-full hover:bg-[#eeeeee]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php }; ?>
                                </div>
                        <?php }}; ?>  <!-- End of while loop-->
                    </div>

                    <?php
                        $getUserCart = "SELECT * FROM cart WHERE id_user = '{$_SESSION['data']['phone']}'";
                        $getUserCartQuery = mysqli_query($conn, $getUserCart);

                        // Check if cart is empty
                        if(mysqli_num_rows($getUserCartQuery) !== 0) {
                    ?>
                        <div class="border-t p-3">
                            <div class="flex justify-between items-center mb-5">
                                <div class="text-2xl font-bold">
                                    Total :
                                </div>

                                <div class="text-lg font-medium">
                                    <?php
                                        $getUserCart = "SELECT * FROM cart WHERE id_user = '{$_SESSION['data']['phone']}'";
                                        $getUserCartQuery = mysqli_query($conn, $getUserCart);

                                        $total = 0;
                                    
                                        while($data = mysqli_fetch_array($getUserCartQuery)) {
                                            $getProductData = "SELECT * FROM barang WHERE id = '{$data['id_barang']}'";
                                            $getProductDataQuery = mysqli_query($conn, $getProductData);
                                    
                                            while($productData = mysqli_fetch_array($getProductDataQuery)) {
                                                $total += $data['jumlah'] * $productData['harga'];
                                            }
                                        }

                                        echo "Rp$total";
                                    ?>
                                </div>
                            </div>

                            <a href="checkout.php">
                                <button class="py-2.5 w-full text-white font-medium bg-[#723E29] rounded-full">
                                    Beli
                                </button>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                    } else {
                ?>
                    <div class="flex flex-col justify-center gap-y-2 p-3 border-b h-full">
                        <p class="text-2xl font-semibold text-center mb-3">Login for better exprerience!</p>

                        <a href="login.php" class="py-3 w-full bg-[#723E29] text-base text-white text-center font-medium rounded-full">
                            Login
                        </a>
                        <a href="signup.php" class="py-3 w-full border hover:bg-[#eeeeee] text-base text-center font-medium rounded-full">
                            Sign up
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="script.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
</body>

</html>
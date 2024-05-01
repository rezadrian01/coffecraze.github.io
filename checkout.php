<?php
    session_start();

    include("functions.php");
    global $conn;

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

    // Delete product di dalam halaman checkout
    if(isset($_GET['hapus_cart'])) {
        $id = $_GET['hapus_cart'];

        $sql = "DELETE FROM cart WHERE id = '$id';";
        $query = mysqli_query($conn, $sql);

        if($query) {
            header('Location: checkout.php');
            exit();
        } else {
            exit();
        }
    }

    // Fungsi untuk melakukan buy now
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>    
    <link rel="stylesheet" href="./src/output.css">

    <style>
        .tabs-parent button.active {
            background-color: #ffffff;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <header class="py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <div class="flex justify-between items-center">
            <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>
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

    <main class="max-w-screen-xl mx-auto mt-5">
        <div class="grid grid-cols-12 gap-x-20">
            <div class="col-span-5">
                <div>
                    <a href="index.php" class="inline-flex items-center gap-x-2 py-2.5 pl-4 pr-5 hover:bg-[#eeeeee] rounded-full text-sm border">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </span>
                        Back to homepage
                    </a>
                </div>

                <div class="mt-8">
                    <div class="text-2xl font-medium">
                        <span class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-2xl font-black uppercase bg-clip-text text-transparent">
                            COFFEE
                        </span>
                        Payment
                    </div>

                    <?php
                        if(isset($_GET['buy_now'])) {
                            $idBuyNow = $_GET['buy_now'];
                    ?>
                        <div class="grid grid-cols-12 gap-x-2 rounded-2xl mt-8">
                            <?php
                                $getProductData = "SELECT * FROM barang WHERE id = '$idBuyNow'";
                                $getProductDataQuery = mysqli_query($conn, $getProductData);

                                while($productData = mysqli_fetch_assoc($getProductDataQuery)) {
                            ?>
                                <div class="col-span-3 flex justify-center">
                                    <img class="h-32 w-4/5 rounded-xl object-cover" src="<?php echo "./images/" . $productData['gambar']; ?>" alt="coffee">
                                </div>

                                <div class="col-span-9 flex flex-col justify-between">
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

                                            <h6 title="<?php echo $productData['nama']; ?>" class="font-medium text-lg text-[#3e2723] line-clamp-2 mt-px">
                                                <?php echo $productData['nama']; ?>
                                            </h6>
                                        </div>

                                        <div class="text-lg font-bold text-center">
                                            Rp<?php echo $productData['harga']; ?>

                                            <div class="text-xs font-normal text-[#424242]">
                                                <?php
                                                    echo "<script type='text/javascript'>
                                                            const harga = {$productData['harga']};
                                                        </script>";
                                                ?>
                                                (x<span id="jumlah"></span> <span id="totalXharga"></span>)
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-x-2">
                                        <!-- Decrement Quantity -->
                                        <button id="kurang-quantity" onclick="decrement()" class="border p-1 rounded-full hover:bg-[#eeeeee] disabled:cursor-not-allowed disabled:opacity-75 disabled:hover:bg-transparent">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            </svg>
                                        </button>

                                        <span id="qty" class="text-sm font-medium"></span>

                                        <!-- Increment Quantity -->
                                        <button id="tambah-quantity" onclick="increment()" class="border p-1 rounded-full hover:bg-[#eeeeee]">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>

                        <div class="border-t mt-10">
                            <div class="flex justify-between items-center py-4">
                                <div class="font-medium text-lg">Sub total</div>

                                <div class="font-medium text-lg">Rp<span id="sub-total"></span></div>
                            </div>
                        </div>
                    <?php
                        } else {
                            $getUserCart = "SELECT * FROM cart WHERE id_user = '{$_SESSION['data']['phone']}'";
                            $getUserCartQuery = mysqli_query($conn, $getUserCart);

                            // Check if cart is empty
                            if(mysqli_num_rows($getUserCartQuery) === 0) {
                                echo "Tidak ada barang yang akan dilakukan pembayaran";
                            } else {
                                while($data = mysqli_fetch_array($getUserCartQuery)) {
                    ?>
                            <div class="grid grid-cols-12 gap-x-2 rounded-2xl mt-8">
                                <?php
                                    $getProductData = "SELECT * FROM barang WHERE id = '{$data['id_barang']}'";
                                    $getProductDataQuery = mysqli_query($conn, $getProductData);

                                    while($productData = mysqli_fetch_array($getProductDataQuery)) {
                                ?>
                                    <div class="col-span-3 flex justify-center">
                                        <img class="h-32 w-4/5 rounded-xl object-cover" src="<?php echo "./images/" . $productData['gambar']; ?>" alt="coffee">
                                    </div>

                                    <div class="col-span-9 flex flex-col justify-between">
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

                                                <h6 title="<?php echo $productData['nama']; ?>" class="font-medium text-lg text-[#3e2723] line-clamp-2 mt-px">
                                                    <?php echo $productData['nama']; ?>
                                                </h6>
                                            </div>

                                            <div class="text-lg font-bold text-center">
                                                Rp<?php echo $productData['harga']; ?>

                                                <div class="text-xs font-normal text-[#424242]">
                                                    (x<?php echo $data['jumlah']; ?> <?php echo $data['jumlah'] * $productData['harga']; ?>)
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center">
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

                                            <div class="py-2.5 border-l mx-3"></div>
                                            
                                            <div>
                                                <a href="<?php echo "{$_SERVER['PHP_SELF']}?hapus_cart=" . $data['id']; ?>" class="text-xs text-[#d32f2f] hover:text-[#e53935] hover:underline">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }; ?>
                            </div>

                            <div class="border-t mt-10">
                                <div class="flex justify-between items-center py-4">
                                    <div class="font-medium text-lg">Sub total</div>

                                    <div class="font-medium text-lg">
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
                            </div>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="col-span-7">
                <div class="py-2.5">
                    <h6 class="text-xl font-medium">
                        Shipping information
                    </h6>

                    <div class="mt-8">
                        <div class="tabs-parent relative flex items-center justify-between gap-x-1 p-1 bg-[#e0e0e0] rounded-full">
                            <button onclick="tab(event, 'delivery')" class="tablinks w-full text-center py-2 rounded-full text-sm active">Delivery</button>
                            <button onclick="tab(event, 'dinein/takeaway')" class="tablinks w-full text-center py-2 rounded-full text-sm">Dine in / Take away</d>
                        </div>

                        <div id="delivery" class="tab-content mt-8" style="display: block;">
                            <?php 
                                $sql = "SELECT alamat FROM user WHERE phone = '{$_SESSION['data']['phone']}';";
                                $query = mysqli_query($conn, $sql);

                                while($data = mysqli_fetch_assoc($query)) {
                                    if($data['alamat'] === "" || NULL) {
                            ?>
                                <form action="checkout_query.php" method="POST">
                                    <input type="hidden" name="pemesanan_makanan" value="delivery">
                                    <!-- Recipient name -->
                                    <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                        <label for="nama" class="text-sm text-[#757575] mb-px">Recipient name</label>

                                        <input id="nama" type="text" name="nama" value="<?php echo $_SESSION['data']['username']?>" class="text-sm outline-none" placeholder="Recipient name" required>
                                    </div>

                                    <!-- Phone name -->
                                    <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                        <label for="phone" class="text-sm text-[#757575]">Mobile phone</label>

                                        <input id="phone" type="text" onkeypress="validate(event)" value="<?php echo $_SESSION['data']['phone']?>" class="text-sm outline-none" placeholder="Mobile phone" name="phone" required>
                                    </div>

                                    <!-- Alamat name -->
                                    <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                                        <label for="alamat" class="text-sm text-[#757575] mb-px">Address</label>

                                        <input id="alamat" type="text" name="alamat" class="text-sm outline-none" placeholder="Delivery address" required>
                                    </div>

                                    <button type="submit" name="checkout-submit" class="py-3 w-full bg-[#723E29] text-base text-white text-center font-medium rounded-full mt-9">
                                        Bayar 
                                        <span>
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
                                        </span>
                                    </button>
                                </form>
                            <?php
                                    } else {
                            ?>
                                <form action="checkout_query.php" method="POST">
                                    <div>
                                        <label for="user_information" class="flex justify-between border py-3 px-4 rounded-3xl">
                                            <div>
                                                <div class="text-sm">Recipient name: <?php echo $_SESSION['data']['username']; ?></div>

                                                <div class="text-sm">No. telpon: <?php echo $_SESSION['data']['phone']; ?></div>

                                                <div class="text-sm">Alamat: <?php echo $_SESSION['data']['alamat']; ?></div>
                                            </div>

                                            <input id="user_information" type="radio" name="user_information" checked>
                                        </label>
                                    </div>

                                    <div class="mt-2 border rounded-3xl">
                                        <label for="alamat-lain" class="flex flex-wrap justify-between py-3 px-4 text-sm font-medium">
                                            Gunakan alamat lain
                                            <input id="alamat-lain" type="radio" name="user_information">
                                        </label>

                                        <div id="information-form" class="hidden pt-3 pb-4 px-4 mt-1">
                                            <input type="hidden" name="pemesanan_makanan" value="delivery">

                                            <!-- Recipient name -->
                                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                                <label for="nama" class="text-sm text-[#757575] mb-px">Recipient name</label>

                                                <input id="nama" type="text" name="nama" value="<?php echo $_SESSION['data']['username'];?>" class="text-sm outline-none" placeholder="Recipient name">
                                            </div>

                                            <!-- Phone name -->
                                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                                <label for="phone" class="text-sm text-[#757575]">Mobile phone</label>

                                                <input id="phone" type="text" name="phone" value="<?php echo $_SESSION['data']['phone'];?>" onkeypress="validate(event)" class="text-sm outline-none" placeholder="Mobile phone">
                                            </div>

                                            <!-- Alamat name -->
                                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                                                <label for="alamat" class="text-sm text-[#757575] mb-px">Address</label>

                                                <input id="alamat" type="text" name="alamat" value="<?php echo $_SESSION['data']['alamat'];?>" class="text-sm outline-none" placeholder="Delivery address">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                        if(isset($_GET['buy_now'])) {
                                            echo "<input name='id_buynow' type='hidden' value='{$_GET['buy_now']}'>";
                                            echo "<input id='qty-input' type='hidden' value='1' name='qty_buy_now'>";
                                        }
                                    ?>
                                    <button type="submit" name="checkout-submit" class="py-3 w-full bg-[#723E29] text-base text-white text-center font-medium rounded-full mt-9">
                                        Bayar 
                                            <?php
                                                if(isset($_GET['buy_now'])) {
                                                    echo "Rp<span id='total'></span>";
                                                } else {
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
    
                                                    echo "Rp<span>$total</span>";
                                                }
                                            ?>
                                    </button>
                                </form>
                            <?php
                                    };
                                }
                            ?>
                        </div>

                        <div id="dinein/takeaway" class="tab-content mt-8" style="display: none;">
                            <form action="checkout_query.php" method="POST">
                                <!-- Recipient name -->
                                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                                    <label for="nama" class="text-sm text-[#757575] mb-px">Recipient name</label>

                                    <input id="nama" type="text" name="nama" value="<?php echo $_SESSION['data']['username']?>" class="text-sm outline-none" placeholder="Recipient name">
                                </div>

                                <div class="flex items-center gap-x-4 mt-4">
                                    <label for="dine-in" id="dine-in-label" class="py-5 px-6 flex border border-2 border-blue-400 justify-between items-center bg-white rounded-xl w-full cursor-pointer">
                                        <div class="flex items-center gap-x-3 font-medium">
                                            <span>
                                                <svg class="w-9 h-9" xmlns="http://www.w3.org/2000/svg" width="655.359" height="655.359" fill-rule="evenodd" clip-rule="evenodd" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 6.827 6.827" id="dining-table">
                                                    <path d="M4.10018 5.55891l-1.37369 0c-0.0434094,0 -0.0786063,-0.035189 -0.0786063,-0.0786024l0 -0.241957c0,-0.176752 0.143795,-0.320559 0.320559,-0.320559l0.0540866 -3.93701e-006 0 -2.04187c0,-0.0434173 0.0351929,-0.0786063 0.0786024,-0.0786063 0.0434134,0 0.0786063,0.0351969 0.0786063,0.0786063l0 2.12048c0,0.0434173 -0.0351929,0.078622 -0.0786063,0.078622l-0.132685 -3.93701e-006c-0.0900709,0 -0.16335,0.0732756 -0.16335,0.163343l0 0.163346 1.21648 0 0 -0.16335c0,-0.0900748 -0.0732874,-0.163335 -0.163354,-0.163335l-0.132685 -3.93701e-006c-0.0434094,0 -0.0786063,-0.035189 -0.0786063,-0.0786142l0 -2.12048c0,-0.0434173 0.0351969,-0.0786063 0.0786063,-0.0786063 0.0434134,0 0.0786063,0.0351969 0.0786063,0.0786063l0 2.04187 0.0540787 0c0.176756,0 0.320547,0.143815 0.320547,0.320567l0 0.241949c0,0.0434055 -0.0351811,0.0786102 -0.0785866,0.0786063z"></path><path d="M1.5641 2.71224c.0406535.0108858.0789409.028122.114319.0440315.0471614.0212323.0917047.0412835.12839.0412835.0366811-.00000393701.0812244-.0200472.128402-.0412835.0574094-.0258386.12248-.0551181.192894-.0551181.0704331 0 .1355.0292874.192913.0551181.0471732.0212165.0917165.0412677.128398.0412677.036685-.00000393701.0812283-.0200433.12839-.0412677.0574252-.0258386.122492-.0551181.192909-.0551181.0704173 0 .1355.0292874.192925.0551181.0471614.0212165.0917047.0412677.128386.0412677.036685-.00000393701.0812244-.0200433.12839-.0412677.0574252-.0258386.122492-.0551181.192925-.0551181.0704134 0 .13548.0292874.192894.0551181.0471654.0212165.0917205.0412677.128406.0412677.0366772-.00000393701.0812205-.0200433.128386-.0412677.0574094-.0258386.122492-.0551181.192909-.0551181.0704331 0 .135496.0292874.192909.0551181.0471772.0212165.0917165.0412677.128402.0412677.0366811-.00000393701.0812244-.0200433.128402-.0412677.0574134-.0258386.12248-.0551181.192894-.0551181.070437 0 .1355.0292874.192913.0551181.0471732.0212165.0917165.0412677.128402.0412677.0366811-.00000393701.0812244-.0200433.128398-.0412677.035378-.015937.0736535-.0331457.114295-.0440197l0-.470492-3.69845 0 0 .47048zm.242709.242508c-.0704213 0-.135492-.0292677-.192909-.0551024-.0471693-.021248-.0917205-.0412835-.128402-.0412835-.0434134 0-.0786024-.0351929-.0786024-.0786024l.00000393701-.616606c0-.0434134.035185-.0785984.0785984-.0785984l3.85567-.00000787402c.0434094 0 .0785984.0352047.0785984.0786142l.00000393701.616598c0 .0434016-.0351969.0786024-.0786063.0786024-.0366811 0-.0812402.0200512-.128406.0412677-.0574094.0258268-.122488.055122-.192906.055122-.0704213-.00000393701-.1355-.0292835-.192909-.055122-.0471614-.0212323-.0917205-.0412677-.128406-.0412677-.0366772 0-.0812205.0200512-.128386.0412677-.0574094.0258268-.122496.055122-.192909.055122-.0704173-.00000393701-.135496-.0292835-.192913-.055122-.0471575-.0212323-.0917165-.0412677-.128398-.0412677-.0366693 0-.0812283.0200512-.12839.0412677-.0574094.0258268-.122492.055122-.192906.055122-.0704213-.00000393701-.135504-.0292835-.192913-.055122-.0471614-.0212323-.0917047-.0412677-.128386-.0412677-.036685 0-.0812402.0200512-.128417.0412677-.0574094.0258268-.12248.055122-.192898.055122-.0704134-.00000393701-.135496-.0292835-.192909-.055122-.0471614-.0212323-.0917205-.0412677-.128402-.0412677-.0366811 0-.0812244.0200512-.12839.0412677-.0574094.0258268-.122488.055122-.192909.055122-.0704173-.00000393701-.135496-.0292835-.192906-.055122-.0471654-.0212323-.0917205-.0412677-.128406-.0412677-.0366654 0-.0812205.0200512-.128386.0412677-.0574134.0258425-.122496.055122-.192909.0551181zM.557201 4.06206l1.84567 0 0-.22872c0-.126106-.102598-.228709-.228717-.228709l-1.61695 0 0 .457429zm1.92427.157197l-2.00287 0c-.0434134 0-.0786024-.035189-.0786024-.0785945l0-.61465c0-.0434016.035189-.0785906.0786024-.0785906l1.69555-.000015748c.212807 0 .385925.173154.385925.385945l0 .307299c0 .0434173-.0351929.0786181-.0786024.0786063z"></path><path d="M1.09324 3.60463c-.0434094 0-.0785984-.0351929-.0785984-.0786024l0-1.69555c0-.126126-.102606-.22872-.228713-.22872l-.228724-.00000393701 0 1.92426c0 .0434173-.0351929.0786181-.0786024.0786181-.0434134 0-.0786024-.0351929-.0786024-.0786024l0-2.00288c0-.0434173.035189-.0786024.0786024-.0786024l.307327-.00000393701c.212795 0 .385917.17313.385917.385937l0 1.69553c0 .0434173-.035189.0786181-.0786063.0786181zM1.97956 5.55891l-.999043 0c-.0434134 0-.0786024-.035189-.0786024-.0786024l0-.175969c0-.140374.114197-.254567.254567-.254567l.0178937-.000011811 0-.909087c0-.0434016.035189-.0785984.0785984-.0785984.0434173-.00000787402.0786063.0351969.0786063.0786063l0 .987685c0 .0434134-.035189.0786142-.0786063.0786142l-.0964921-.00000787402c-.053685 0-.0973661.0436929-.0973661.0973661l0 .0973622.841839 0 0-.0973622c0-.0536732-.0436693-.0973583-.0973543-.0973583l-.0965039-.00000787402c-.0434134 0-.0785984-.035189-.0785984-.0785945l0-.987705c0-.0434016.035185-.0785984.0785984-.0785984.0434134-.00000787402.0785984.0351969.0785984.0786063l.00000393701.909079.0179016 0c.140374 0 .254567.11422.254567.254579l0 .175965c0 .0434055-.0351969.0786102-.0786063.0786063zM4.4238 4.06206l1.84567 0 0-.457429-1.61695 0c-.126114 0-.228724.10261-.228724.22872l.00000393701.228709zm1.92426.157197l-2.00287 0c-.0434094 0-.0785906-.035189-.0785906-.0785945l0-.307323c0-.212783.173118-.385917.385913-.385917l1.69555-.000015748c.0434252 0 .0786024.0352087.0786024.078622l0 .614622c0 .0434173-.0351772.0786181-.0786024.0786063z"></path><path d="M6.34806 3.60463c-.0434094 0-.0785906-.0351929-.0785906-.0786024l0-1.92427-.228717 0c-.12611 0-.22872.102598-.22872.228724l0 1.69553c0 .0434173-.0351811.0786181-.0786063.0786181-.0434094 0-.0785906-.0351929-.0785906-.0786024l0-1.69555c0-.212819.173122-.385933.385913-.385933l.307311-.00000393701c.0434252 0 .0786024.0352008.0786024.0786102l0 2.00286c0 .0434173-.0351772.0786181-.0786024.0786181zM5.84615 5.55891l-.999031 0c-.0434291 0-.0786102-.035189-.0786102-.0786024l.00000393701-.175969c0-.140374.114189-.254567.254559-.254567l.0179094-.000011811 0-.909087c0-.0434016.0351772-.0785984.0785866-.0785984.0434291-.00000787402.0786063.0351969.0786063.0786063l.00000393701.987685c0 .0434134-.0351811.0786142-.0786102.0786142l-.0964961-.00000787402c-.0536811 0-.0973661.0436929-.0973661.0973661l0 .0973622.841839 0 0-.0973622c0-.0536732-.0436732-.0973583-.0973583-.0973583l-.0964921-.00000787402c-.0434094 0-.0786063-.035189-.0786063-.0785945l.00000393701-.987705c0-.0434016.035189-.0785984.0785984-.0785984.0434134-.00000787402.0786063.0351969.0786063.0786063l.00000393701.909079.0178858 0c.140374 0 .254567.11422.254567.254579l0 .175965c0 .0434055-.0351929.0786102-.0786024.0786063zM3.76673 2.24178c-.0138386 0-.0278425-.00365354-.0405433-.0113228-.209409-.126406-.330185-.324555-.349248-.573051-.0140551-.183189.032685-.329252.0346929-.335394.0105315-.0323661.0407047-.054248.0747283-.054248l.777217-.000011811c.0340236 0 .0641969.0219016.0747283.0542598.00200787.0061378.048752.152217.0346929.335394-.019063.248492-.139827.446654-.349232.573051-.0371575.0224252-.0854803.0104961-.107917-.0266654-.022437-.0371811-.0104961-.0854961.0266614-.107921.318843-.192461.28624-.537854.259591-.670909l-.654689-.000011811c-.0276339.133213-.0616417.476776.260012.670921.0371772.0224134.0491142.0707441.0266811.107921-.0147638.0244488-.040748.0379921-.067374.0379882z"></path><path d="M4.33851 1.98958c-.0482913 0-.0963268-.0117677-.138882-.0340787-.0384528-.0201457-.0532874-.0676496-.0331457-.106106.0201575-.0384409.0676457-.0532874.106106-.0331457.0204252.010689.0426142.0161299.0659213.0161299.0785512-.00000787402.142472-.0639213.142472-.142484.00000393701-.0785551-.0639213-.142484-.142472-.142484-.0106299-.000011811-.0212323.00116929-.0314961.00349213-.0423425.00952756-.0844173-.0170709-.0939409-.0594173-.00953937-.0423583.0170591-.0844213.0594173-.0939449.0215787-.00488189.0437913-.00732677.0660197-.00732677.165248-.000011811.299681.134433.299681.299681.00000393701.165256-.134433.299693-.299681.299685zM2.81819 2.24178c-.00501181 0-.0101024-.000472441-.0152047-.00148425-.0426063-.00835827-.070378-.0496614-.0620118-.092252l.14178-.723094-.520173 0 .141787.723087c.00835433.0425866-.0194055.0839094-.0620079.0922598-.0425787.00833071-.0839173-.0194055-.0922677-.0620079l-.160157-.816807c-.0045315-.0230433.00151575-.0469213.0164331-.0650709.0149409-.0181378.0371969-.0286457.0606969-.0286457l.711201-.000011811c.0235 0 .0457717.0105197.0606969.0286575.0149331.0181378.0209646.0420197.0164449.0650827l-.160169.816791c-.00734252.0375039-.0402283.0635-.0770472.0634961z"></path><rect width="6.827" height="6.827" fill="none"></rect>
                                                </svg>
                                            </span>

                                            Dine in
                                        </div>
                                        
                                        <input id="dine-in" type="radio" name="pemesanan_makanan" value="dine in" checked>
                                    </label>

                                    <label for="take-away" id="take-away-label" class="py-5 px-6 flex justify-between items-center border border-2 bg-white rounded-xl w-full cursor-pointer">
                                        <div class="flex items-center gap-x-3 font-medium">
                                            <span>
                                                <svg class="w-9 h-9" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 512 512" viewBox="0 0 512 512" id="food-delivery">
                                                    <path fill="#0d0d0d" d="M5 512c-1 0-1.9-.3-2.7-.8C.8 510.3 0 508.7 0 507V390c0-2 1.2-3.8 3-4.6l69.7-29.9 46.9-26.3c23.7-13.3 50.5-20.3 77.7-20.4l122.2-14.8c7.9-.9 15.7 1.5 21.7 6.8 5.9 5.2 9.3 12.8 9.3 20.7 0 12-7.7 22.6-19.1 26.3l-102.4 33.4h115.2l79.7-37.1 1.6-3.2c15.7-30.8 47-50 81.6-50 1.6 0 3.1.8 4 2 .9 1.3 1.2 2.9.7 4.5L485.3 381c-.3.9-.8 1.6-1.4 2.2l-69.1 61.4c-.6.5-1.2.9-2 1.1l-127.4 35.8c-.4.1-.9.2-1.4.2H76L7 511.6C6.3 511.9 5.7 512 5 512zM10 393.3v106.1l63-27.2c.6-.3 1.3-.4 2-.4h208.3l125.6-35.3 67.2-59.7 23.9-75.4c-28 2.3-52.8 18.8-65.7 44.2l-2.4 4.8c-.5 1-1.3 1.8-2.3 2.3l-82.2 38.3c-.7.3-1.4.5-2.1.5H197.5c-2.5 0-4.6-1.8-4.9-4.2-.4-2.4 1-4.8 3.4-5.5l132.3-43.2c7.3-2.4 12.2-9.1 12.2-16.8 0-5-2.2-9.9-5.9-13.2-3.8-3.3-8.8-4.9-13.8-4.3l-122.5 14.8c-.2 0-.4 0-.6 0-25.5 0-50.8 6.6-73.1 19.1l-47.1 26.4c-.2.1-.3.2-.5.2L10 393.3zM364 54H128c-2.8 0-5-2.2-5-5V5c0-2.8 2.2-5 5-5h256c2.8 0 5 2.2 5 5v44h-10V10H133v34h231V54z"></path><rect width="10" height="312.2" x="98.8" y="47.1" fill="#0d0d0d" transform="rotate(8.934 103.738 203.19)"></rect><path fill="#0d0d0d" d="M421.8,321.9L384,81.2l-32.9,209l-9.9-1.6l37.8-240.5c0.4-2.4,2.5-4.2,4.9-4.2
                                                    s4.6,1.8,4.9,4.2l42.8,272.1L421.8,321.9z"></path><rect width="10" height="48.2" x="329.7" y="338.4" fill="#0d0d0d" transform="rotate(8.934 334.661 362.41)"></rect><path fill="#0d0d0d" d="M335.3,388.8l-8.6-5.1l53-90.3c0.9-1.5,2.5-2.5,4.3-2.5s3.4,0.9,4.3,2.5l33.3,56.7
                                                    l-8.6,5.1l-29-49.4L335.3,388.8z"></path><rect width="10" height="247" x="379" y="49" fill="#0d0d0d"></rect><path fill="#0d0d0d" d="M199 287c-5.6 0-10.8-2.2-14.7-6.3-3.9-4-5.9-9.3-5.7-14.9l4.2-107.4c-10.8-2.4-18.8-12-18.8-23.4V94c0-13.2 10.8-24 24-24h22c13.2 0 24 10.8 24 24v41c0 11.5-8.1 21.1-18.8 23.4l4.2 107.4c.2 5.6-1.8 10.9-5.7 14.9C209.8 284.8 204.6 287 199 287zM188 80c-7.7 0-14 6.3-14 14v41c0 7.7 6.3 14 14 14 1.4 0 2.7.6 3.6 1.5.9 1 1.4 2.3 1.4 3.7l-4.4 112c-.1 2.8.9 5.5 2.9 7.6 2 2.1 4.6 3.2 7.5 3.2s5.5-1.1 7.5-3.2c2-2.1 3-4.8 2.9-7.6l-4.4-112c-.1-1.4.4-2.7 1.4-3.7.9-1 2.2-1.5 3.6-1.5 7.7 0 14-6.3 14-14V94c0-7.7-6.3-14-14-14H188zM293 287c-5.6 0-10.8-2.2-14.7-6.3-3.9-4-5.9-9.3-5.7-14.9l4.2-107.4c-10.8-2.4-18.8-12-18.8-23.4v-30c0-19.3 15.7-35 35-35s35 15.7 35 35v30c0 11.5-8.1 21.1-18.8 23.4l4.2 107.4c.2 5.6-1.8 10.9-5.7 14.9C303.8 284.8 298.6 287 293 287zM293 80c-13.8 0-25 11.2-25 25v30c0 7.7 6.3 14 14 14 1.4 0 2.7.6 3.6 1.5.9 1 1.4 2.3 1.4 3.7l-4.4 112c-.1 2.8.9 5.5 2.9 7.6 2 2.1 4.6 3.2 7.5 3.2s5.5-1.1 7.5-3.2c2-2.1 3-4.8 2.9-7.6l-4.4-112c-.1-1.4.4-2.7 1.4-3.7.9-1 2.2-1.5 3.6-1.5 7.7 0 14-6.3 14-14v-30C318 91.2 306.8 80 293 80z"></path><rect width="10" height="49" x="184" y="75" fill="#0d0d0d"></rect><rect width="10" height="49" x="204" y="75" fill="#0d0d0d"></rect>
                                                </svg>
                                            </span>

                                            Take away
                                        </div>
                                        
                                        <input id="take-away" type="radio" name="pemesanan_makanan" value="take away">
                                    </label>
                                </div>

                                <button type="submit" name="checkout-submit" class="py-3 w-full bg-[#723E29] text-base text-white text-center font-medium rounded-full mt-9">
                                    Bayar 
                                        <?php
                                            if(isset($_GET['buy_now'])) {
                                                echo "Rp<span id='total_dinein'></span>";
                                            } else {
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

                                                echo "Rp<span>$total</span>";
                                            }
                                        ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Tabs function
        const tab = (evt, cityName) => {
            let i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        };

        // Regex for phone input
        const validate = (evt) => {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        // Decrement and increment function for buy now
        let i = 1;
        const spanElement = document.querySelector("#qty");
        const inputElement = document.querySelector("#qty-input");
        console.log(harga);
        spanElement.innerHTML = inputElement.value;

        const buttonDecrement = document.querySelector("#kurang-quantity");

        const updateDecrementButton = () => {
            if (i === 1) {
                buttonDecrement.disabled = true;
            } else {
                buttonDecrement.disabled = false;
            }
            
            document.querySelector("#jumlah").innerHTML = i;
            document.querySelector("#totalXharga").innerHTML = i * harga;
            document.querySelector("#sub-total").innerHTML = i * harga;
            document.querySelector("#total").innerHTML = i * harga;
            document.querySelector("#total_dinein").innerHTML = i * harga;
        }

        updateDecrementButton(); // Pertama kali dipanggil untuk mengatur status tombol decrement

        const decrement = () => {
            i--;
            inputElement.value = i;
            spanElement.innerHTML = inputElement.value;
            updateDecrementButton(); // Panggil fungsi untuk memperbarui status tombol decrement setelah dikurangi
        }

        // Increment function for button buy now
        const increment = () => {
            i++;
            inputElement.value = i;
            spanElement.innerHTML = inputElement.value;
            updateDecrementButton(); // Panggil fungsi untuk memperbarui status tombol decrement setelah ditambah
        }

        // END Decrement and increment function for buy now

        // Check if radio button with id alamat-lain checked, then show div with id information-form
        document.addEventListener("DOMContentLoaded", function() {
            const getSelectedValue = document.querySelector("#alamat-lain");
            const userInformationRadio = document.querySelector("#user_information");
            const informationForm = document.querySelector("#information-form");

            function toggleInformationForm() {
                if (getSelectedValue.checked) {
                    informationForm.classList.replace("hidden", "block");
                } else {
                    informationForm.classList.replace("block", "hidden");
                }
            }

            toggleInformationForm();

            getSelectedValue.addEventListener("change", toggleInformationForm);
            userInformationRadio.addEventListener("change", toggleInformationForm);
        });

        // Dropdown Functions
        const menuDropdown = () => {
        const menuElement = document.querySelector("#menu-dropdown");

        // Periksa apakah dropdown sudah terlihat
        const isVisible = !menuElement.classList.contains("hidden");

        // Jika dropdown sudah terlihat, sembunyikan
        if (isVisible) {
            menuElement.classList.add("hidden");
        } else {
            // Jika dropdown belum terlihat, tampilkan
            menuElement.classList.remove("hidden");
        }
        };

        // Fungsi untuk menutup dropdown
        const closeDropdown = () => {
        const menuElement = document.querySelector("#menu-dropdown");
        menuElement.classList.add("hidden");
        };

        // Fungsi untuk mengecek apakah elemen yang diklik adalah dropdown atau bukan
        const isClickedInsideDropdown = (target) => {
        const menuElement = document.querySelector("#parent-dropdown");
        return menuElement.contains(target);
        };

        // Event listener untuk mendengarkan setiap kali dokumen diklik
        document.addEventListener("click", (event) => {
        // Jika elemen yang diklik berada di luar dropdown, tutup dropdown
        if (!isClickedInsideDropdown(event.target)) {
            closeDropdown();
        }
        });
        // End Dropdown Functions

        // Dine in and take away radio button style when checked
        const dineInRadio = document.getElementById('dine-in');
        const takeAwayRadio = document.getElementById('take-away');
        const dineInLabel = document.getElementById('dine-in-label');
        const takeAwayLabel = document.getElementById('take-away-label');

        dineInRadio.addEventListener('change', function() {
            if (dineInRadio.checked) {
                dineInLabel.classList.add('border-blue-400');
                takeAwayLabel.classList.remove('border-blue-400');
            }
        });

        takeAwayRadio.addEventListener('change', function() {
            if (takeAwayRadio.checked) {
                takeAwayLabel.classList.add('border-blue-400');
                dineInLabel.classList.remove('border-blue-400');
            }
        });
    </script>
</body>
</html>
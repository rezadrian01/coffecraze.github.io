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
                        <?php
                            }
                        }
                        ?>

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
                </div>
            </div>

            <div class="col-span-7">
                <div class="py-2.5">
                    <h6 class="text-xl font-medium">
                        Shipping information
                    </h6>

                    <div class="mt-8">
                        <div class="tabs-parent relative flex items-center justify-between gap-x-1 p-1 bg-[#e0e0e0] rounded-full">
                            <button onclick="tab(event, 'dine-in')" class="tablinks w-full text-center py-2 rounded-full text-sm active">Dine in</button>
                            <button onclick="tab(event, 'take-away')" class="tablinks w-full text-center py-2 rounded-full text-sm">Take away</d>
                        </div>

                        <div id="dine-in" class="tab-content mt-8" style="display: block;">
                            <?php 
                                $sql = "SELECT alamat FROM user WHERE phone = '{$_SESSION['data']['phone']}';";
                                $query = mysqli_query($conn, $sql);

                                while($data = mysqli_fetch_assoc($query)) {
                                    if($data['alamat'] === "" || NULL) {
                            ?>
                                        <form action="checkout_query.php" method="POST">
                                            <input type="hidden" name="pemesanan_makanan" value="dine in">
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
                                        <div>
                                            <label for="user_information" class="flex justify-between border py-3 px-4 rounded-3xl">
                                                <div>
                                                    <div class="text-sm">Recipient name: <?php echo $_SESSION['data']['username']; ?></div>
                                                    <input type="hidden" value="<?php echo $_SESSION['data']['username']; ?>">

                                                    <div class="text-sm">No. telpon: <?php echo $_SESSION['data']['phone']; ?></div>
                                                    <input type="hidden" value="<?php echo $_SESSION['data']['phone']; ?>">

                                                    <div class="text-sm">Alamat: <?php echo $_SESSION['data']['alamat']; ?></div>
                                                    <input type="hidden" value="<?php echo $_SESSION['data']['alamat']; ?>"
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
                                                <!-- Recipient name -->
                                                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                                    <label for="nama" class="text-sm text-[#757575] mb-px">Recipient name</label>

                                                    <input id="nama" type="text" name="nama" class="text-sm outline-none" placeholder="Recipient name">
                                                </div>

                                                <!-- Phone name -->
                                                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                                    <label for="phone" class="text-sm text-[#757575]">Mobile phone</label>

                                                    <input id="phone" type="text" onkeypress="validate(event)" class="text-sm outline-none" placeholder="Mobile phone" name="phone">
                                                </div>

                                                <!-- Alamat name -->
                                                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                                                    <label for="alamat" class="text-sm text-[#757575] mb-px">Address</label>

                                                    <input id="alamat" type="text" name="alamat" class="text-sm outline-none" placeholder="Delivery address">
                                                </div>
                                            </div>
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
                            <?php
                                    };
                                }
                            ?>
                        </div>

                        <div id="take-away" class="tab-content mt-8" style="display: none;">
                            <!-- Recipient name -->
                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                                <label for="nama" class="text-sm text-[#757575] mb-px">Recipient name</label>

                                <input id="nama" type="text" name="nama" value="<?php echo $_SESSION['data']['username']?>" class="text-sm outline-none" placeholder="Recipient name">
                            </div>
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
    </script>
</body>
</html>
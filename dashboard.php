<?php
    session_start();

    include("functions.php");
    global $conn;

    if(isset($_SESSION['data']['role'])){
        if($_SESSION['data']['role'] === "user"){
            header("Location: index.php");
            exit();
        }
    }
    else{
        header("Location: index.php");
        exit();
    }

    if(isset($_POST['submit_process'])) {
        $id = $_POST['id'];
        $value = $_POST['submit_process'];

        $sql = "UPDATE pembelian SET status = '$value' WHERE id = '$id';";
        $query = mysqli_query($conn, $sql);

        if($query) {
            header('Location: dashboard.php?message=update_berhasil');
            exit();
        } else {
            die("Gagal update...");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="./src/output.css">

        <style>
            input[type="radio"]:checked + label{
                background-color: #eeeeee;
            }
        </style>
    </head>
    <body>
        <header class="flex flex-wrap lg:flex-nowrap justify-between items-center py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
            <a href="index.php">
                <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>
            </a>
            <ul class="hidden lg:flex items-center gap-x-2">
                <li>
                    <a href="dashboard.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
                        Home
                    </a>
                </li>
                <li>
                    <a href="product.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Product
                    </a>
                </li>
                <li>
                    <a href="kategori.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Kategori
                    </a>
                </li>
                <li>
                    <a href="user.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        User
                    </a>
                </li>
            </ul>

            <div id="parent-dropdown" class="relative inline-block">
                <button onclick="menuDropdown()" class="flex items-center py-2 pl-4 pr-3 border rounded-full font-medium text-sm">
                    Welcome, <span class="font-normal"><?php echo $_SESSION['data']['username']; ?></span>
                
                    <span class="ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </button>

                <div id="menu-dropdown" class="hidden absolute top-auto right-0 w-52">
                    <ul class="mt-2 p-1 bg-white shadow-md rounded-xl border">
                        <li>
                            <div>
                                <a href="index.php">
                                    <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                        Back to home
                                    </button>
                                </a>
                            </div>
                        </li>
                        <li><a href="profile.php">
                                <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                    Profile
                                </button>
                            </a>
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

            <ul class="block lg:hidden flex justify-center items-center w-full gap-x-2 mt-5">
                <li>
                    <a href="dashboard.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
                        Home
                    </a>
                </li>
                <li>
                    <a href="product.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Product
                    </a>
                </li>
                <li>
                    <a href="kategori.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Kategori
                    </a>
                </li>
                <li>
                    <a href="user.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        User
                    </a>
                </li>
            </ul>
        </header>

        <main class="max-w-screen-xl mx-auto px-4 lg:px-0 py-5 md:py-12">
            <h1 class="text-3xl font-semibold">Hello, Fathan</h1>

            <div class="mt-7 md:mt-12">
                <h4 class="text-2xl font-semibold">Your orders</h4>

                <?php 
                    $sql = "SELECT * FROM pembelian;";
                    $query = mysqli_query($conn, $sql);

                    $i = 1;

                    if(mysqli_num_rows($query) === 0) {    
                ?>
                    <div class="flex flex-col justify-center items-center bg-[#f5f5f5] rounded-3xl pb-9 mt-7">
                        <dotlottie-player src="https://lottie.host/af002951-412c-4819-9ae3-5230d9394ecb/ZpkOOvunyr.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>


                        <div class="text-xl font-medium">No orders</div>
                    </div>
                <?php
                    } else {
                ?> 
                    <div class="relative overflow-x-auto mt-5 bg-[#f5f5f5] rounded-3xl py-3 px-5">
                        <table class="table-auto w-full text-left">
                            <thead class="text-xs text-gray-700 uppercase border-b">
                                <tr>
                                    <th scope="col" class="px-1 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Product
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Recipient name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delivery address
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Food ordering
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td class="px-6 py-4">
                                            <div class="flex -space-x-4 rtl:space-x-reverse">
                                                <?php
                                                    // Mengambil gambar dari barang yang dibeli
                                                    $getBarangDibeli = "SELECT gambar FROM barang WHERE id IN (SELECT id_barang FROM barang_dibeli WHERE id_pembelian = '{$data['id']}');";
                                                    $getBarangDibeliQuery = mysqli_query($conn, $getBarangDibeli);

                                                    while($dataGambar = mysqli_fetch_assoc($getBarangDibeliQuery)) {
                                                ?>
                                                    <img class="w-10 h-10 border-2 border-white rounded-xl object-cover" 
                                                        src="<?php echo "./images/" . $dataGambar['gambar']; ?>" 
                                                        alt="produk_dibeli">
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-medium">
                                            <?php echo $data['nama']; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm">Phone number: <?php echo $data['phone']; ?></div>
                                            <div class="text-sm">Delivery address: <?php echo $data['alamat']; ?></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php
                                                if($data['pemesanan_makanan'] === "take away") {
                                                    echo "<span class='bg-rose-100 text-rose-800 text-xs font-medium py-1 px-2 rounded-full capitalize'>" . $data['pemesanan_makanan'] . "</span>";
                                                } else {
                                                    echo "<span class='bg-blue-100 text-blue-800 text-xs font-medium py-1 px-2 rounded-full capitalize'>" . $data['pemesanan_makanan'] . "</span>";
                                                }
                                            ?>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="relative inline-block group">
                                                <button class="inline-flex items-center gap-x-1 py-0.5 pl-0.5 pr-1.5 hover:bg-white rounded-full">
                                                    <span class="<?php echo ($data['status'] === "in process") ? 'bg-rose-100 text-rose-800' : (($data['status'] === "to receive") ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'); ?> text-xs font-medium py-1 px-2 rounded-full capitalize">
                                                        <?php echo $data['status']; ?>
                                                    </span>
                                                
                                                    <div class="invisible group-hover:visible">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                        </svg>
                                                    </div>
                                                </button>

                                                <div class="hidden group-hover:block absolute top-auto right-0 pt-0.5 z-10">
                                                    <form action="" method="POST">
                                                        <div class="flex flex-col gap-y-0.5 w-28 bg-white rounded-lg p-0.5">
                                                            <input type="hidden" name="id" value="<?php echo $data['id']?>">

                                                            <input type="submit" class="cursor-pointer px-2 py-1 text-sm text-left rounded-md capitalize <?php echo ($data['status'] === "in process") ? 'bg-[#eeeeee]' : 'hover:bg-[#eeeeee]'; ?>" name="submit_process" value="in process">
                                                            
                                                            <input type="submit" class="cursor-pointer px-2 py-1 text-sm text-left rounded-md capitalize <?php echo ($data['status'] === "to receive") ? 'bg-[#eeeeee]' : 'hover:bg-[#eeeeee]'; ?>" name="submit_process" value="to receive">
                                                            
                                                            <input type="submit" class="cursor-pointer px-2 py-1 text-sm text-left rounded-md capitalize <?php echo ($data['status'] === "completed") ? 'bg-[#eeeeee]' : 'hover:bg-[#eeeeee]'; ?>" name="submit_process" value="completed">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
                
            </div>
        </main>

        <script>
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

        <!-- Lottie Animations -->
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
    </body>
</html>
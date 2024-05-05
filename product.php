<?php 
    session_start();

    include("functions.php");
    global $conn;

    // Update Status
    if(isset($_POST['submit_status'])) {
        $id = $_POST['id'];
        $status = $_POST['submit_status'];

        $sql = "UPDATE barang SET status = '$status' WHERE id = '$id';";
        $query = mysqli_query($conn, $sql);

        if($query) {
            header('Location: product.php?message=update_berhasil');
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
        <title>Product</title>    
        <link rel="stylesheet" href="./src/output.css">
    </head>
    <body>
        <header class="flex flex-wrap lg:flex-nowrap justify-between items-center py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
            <a href="index.php">
                <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>
            </a>
            <ul class="hidden lg:flex items-center gap-x-2">
                <li>
                    <a href="dashboard.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Home
                    </a>
                </li>
                <li>
                    <a href="product.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
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

        <main class="max-w-screen-xl mx-auto px-4 md:px-0 py-5 md:py-12">
            <h4 class="text-2xl font-semibold">Product</h4>

            <div class="flex items-center gap-x-2 md:gap-x-7 mt-6">
                <form action=""method="post" class="w-full">
                    <div class="grow flex items-center gap-x-2 border py-2 rounded-full px-3">
                        <?php if(!isset($_POST['search'])): ?>
                            <input id="search" type="text" class="outline-none text-sm w-full" placeholder="Search product" name="keyword">
                        <?php else: ?>
                            <input id="search" type="text" class="outline-none text-sm w-full" placeholder="Search product" name="keyword" value="<?= $_POST['keyword'];?>">
                        <?php endif; ?>
                        <button type="submit" name="search">
                            <label for="search">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#424242]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </label>
                        </button>
                    </div>
                </form>

                <a href="produk_tambah_page.php" class="py-2.5 px-5 transition hover:bg-[#e3f2fd] text-[#1976d2] text-sm font-medium rounded-full whitespace-nowrap">Add product</a>
            </div>

            <div class="relative overflow-x-auto mt-5">
                <table class="table-auto w-full text-left">
                    <thead class="text-xs text-gray-700 uppercase border-b">
                        <tr>
                            <th scope="col" class="px-1 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 w-5/12">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Review
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total sold
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                if(!isset($_POST['search'])){
                                    $sql = "SELECT * FROM barang";
                                }
                                else{
                                    $key = $_POST['keyword'];
                                    $sql = "SELECT * FROM barang WHERE
                                    id LIKE '%$key%' OR
                                    nama LIKE '%$key%' OR
                                    harga LIKE '%$key%' OR
                                    status LIKE '%$key%';
                                    ";
                                }
                                $query = mysqli_query($conn, $sql);
                                $i = 1;
                                while($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr class="text-sm">
                                    <th><?= $i++; ?></th>
                                    <th class="flex items-center gap-x-2 px-6 py-4 font-medium text-gray-900 text-sm group">
                                            <img class="w-12 rounded-lg" src="<?php echo "./images/" . $data['gambar']; ?>" alt="coffee">
                
                                            <div>
                                                <?php echo $data['nama']; ?>
                
                                                <p class="group-hover:hidden line-clamp-2 mt-0.5 text-[#757575] font-normal">
                                                    <?php echo $data['deskripsi']; ?>
                                                </p>
                                            
                                                <div class="hidden group-hover:block mt-2.5">
                                                    <div class="flex items-center">
                                                        <a href="<?php echo "produk_edit_page.php?id=" . $data['id']; ?>" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </a>
                    
                                                        <a href="<?php echo "produk_hapus.php?id=" . $data['id']; ?>" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>

                                        <td class="px-6 py-4">
                                            <?php echo $data['harga']; ?>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="relative inline-block group">
                                                <button class="inline-flex items-center gap-x-1 py-0.5 pl-0.5 pr-1.5 hover:bg-white border border-0 hover:border rounded-full">
                                                    <span class="<?php echo ($data['status'] === "ready") ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800'; ?> text-xs font-medium py-1 px-2 rounded-full capitalize">
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
                                                        <div class="flex flex-col gap-y-0.5 w-28 bg-white rounded-lg p-0.5 border">
                                                            <input type="hidden" name="id" value="<?php echo $data['id']?>">

                                                            <input type="submit" class="cursor-pointer px-2 py-1 text-sm text-left rounded-md capitalize <?php echo ($data['status'] === "ready") ? 'bg-[#eeeeee]' : 'hover:bg-[#eeeeee]'; ?>" name="submit_status" value="ready">
                                                            
                                                            <input type="submit" class="cursor-pointer px-2 py-1 text-sm text-left rounded-md capitalize <?php echo ($data['status'] === "not ready") ? 'bg-[#eeeeee]' : 'hover:bg-[#eeeeee]'; ?>" name="submit_status" value="not ready">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm hover:text-blue-600 cursor-pointer">
                                            4
                                        </td>
                                        <td class="px-6 py-4 text-sm hover:text-blue-600 cursor-pointer">
                                            4
                                        </td>
                                </tr>
                            <?php }; ?>
                    </tbody>
                </table>
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
    </body>
</html>
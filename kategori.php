<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kategori</title>    
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
                    <a href="product.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Product
                    </a>
                </li>
                <li>
                    <a href="kategori.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
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
            <h4 class="text-2xl font-semibold">Kategori</h4>

            <div class="mt-6">
                <button type="button" onclick="addCategoryModal()" class="py-3 border w-full transition hover:bg-[#e3f2fd] text-[#1976d2] text-sm font-medium rounded-full">Add category</button>
            </div>

            <div class="relative overflow-x-auto mt-5">
                <table class="table-auto w-full text-left">
                    <thead class="text-xs text-gray-700 uppercase border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include("functions.php");
                            global $conn;

                            $sql = "SELECT * FROM kategori";
                            $query = mysqli_query($conn, $sql);

                            // Mengambil semua data dan memasukkannya ke dalam array
                            $dataArray = [];
                            while($data = mysqli_fetch_array($query)) {
                                $dataArray[] = $data;
                            };

                            $i = 1;
                            foreach($dataArray as $data) {
                                echo "<tr class='text-sm'>";

                                echo "<td class='px-6 py-4'>".$i++."</td>";
                                echo "<td class='px-6 py-4 capitalize'>".$data['nama']."</td>";
                                echo '<td class="flex items-center px-6 py-4">
                                        <button id="edit" onclick="editCategoryModal('.$data["id"].', \''.$data["nama"].'\')" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>

                                        <a href="kategori_hapus.php?id='.$data["id"].'" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </a>
                                    </td>';

                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Tambah Kategori Modal -->
        <div id="add_category" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-2xl shadow-lg">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-6 md:pb-0 rounded-t-2xl">
                        <h3 class="modal-title text-xl font-semibold text-gray-900">
                            Tambah kategori
                        </h3>

                        <button onclick="hiddenModal()" class="p-2 rounded-full hover:bg-[#eeeeee]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form action="kategori_tambah.php" method="POST">
                        <!-- Modal body -->
                        <div class="p-4 md:pt-4 md:pb-0 md:px-6">
                            <!-- Tambah Kategori Input -->
                                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                    <label for="nama_kategori" class="text-sm text-[#757575] mb-px">Nama kategori</label>

                                    <input name="tambah-kategori" id="nama_kategori" type="text" class="text-sm outline-none" placeholder="Nama kategori">
                                </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex justify-end items-center gap-x-2 p-4 md:p-6">
                            <button type="button" onclick="hiddenModal()" class="py-2.5 px-3 text-sm font-medium text-[#2979ff] hover:bg-[#e3f2fd] rounded-full">
                                Cancel
                            </button>

                            <button id="kategori-button" name="submit-kategori" type="submit" class="py-2.5 px-3 text-sm font-medium text-[#2979ff] hover:bg-[#e3f2fd] rounded-full">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const addCategoryModal = () => {
                const element = document.querySelector("#add_category");

                element.classList.replace("hidden", "block");
            };

            const hiddenModal = () => {
                const element = document.querySelector("#add_category");

                element.classList.replace("block", "hidden");
            };

            const editCategoryModal = (categoryId, categoryName) => {
                const element = document.querySelector("#add_category");
                const categoryInput = document.querySelector("#nama_kategori");
                const submitButton = document.querySelector("#kategori-button");
                
                // Ubah judul modal
                document.querySelector(".modal-title").innerText = "Edit Kategori";
                
                // Ganti label tombol
                submitButton.innerText = "Update";
                submitButton.name = "submit-edit-kategori";
                
                // Isi input dengan data kategori yang akan diupdate
                categoryInput.value = categoryName;
                
                // Modifikasi action dari form untuk mengarah ke skrip PHP yang sesuai untuk pembaruan
                document.querySelector("form").action = "kategori_edit.php?id=" + categoryId; // Ganti dengan skrip PHP yang sesuai
                
                // Tampilkan modal
                element.classList.replace("hidden", "block");
            };

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
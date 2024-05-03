<?php
    session_start();
    //periksa jika yang masuk bukan admin
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>    
        <link rel="stylesheet" href="./src/output.css">
    </head>
    <body>
        <header class="flex flex-wrap lg:flex-nowrap justify-between items-center py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
            <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>

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
                    <a href="kategori.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Kategori
                    </a>
                </li>
                <li>
                    <a href="user.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
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
            <h4 class="text-2xl font-semibold">User</h4>

            <div class="flex items-center gap-x-2 md:gap-x-7 mt-6">
                <form action="" method="post" class="w-full">
                    <div class="grow flex items-center gap-x-2 border py-2 rounded-full px-3">
                        <?php if(!isset($_POST['search'])): ?>
                            <input id="search" type="text" class="outline-none text-sm w-full" placeholder="Search user" name="keyword">
                        <?php else: ?>
                            <input id="search" type="text" class="outline-none text-sm w-full" placeholder="Search user" name="keyword" value="<?= $_POST['keyword'];?>">
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
                <button type="button" onclick="addUserModal()" class="py-2.5 px-5 transition hover:bg-[#e3f2fd] text-[#1976d2] text-sm font-medium rounded-full whitespace-nowrap">
                    Add user
                </button>
            </div>

            <div class="relative overflow-x-auto mt-5">
                <table class="table-auto w-full text-left">
                    <thead class="text-xs text-gray-700 uppercase border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include("functions.php");
                            global $conn;
                            if(!isset($_POST['search'])){
                                $sql = "SELECT * FROM user";
                            }
                            else{
                                $keyword = $_POST['keyword'];
                                $sql = "SELECT * FROM user WHERE
                                phone LIKE '%$keyword%' OR
                                username LIKE '%$keyword%' OR
                                alamat LIKE '%$keyword%' OR
                                role LIKE '%$keyword%';
                                ";
                            }
                            // Mengambil semua data dan memasukkannya ke dalam array
                            $query = mysqli_query($conn, $sql);
                            $i = 1;
                            while($data = mysqli_fetch_assoc($query)) {
                                echo "<tr class='text-sm'>";
                                echo "<td class='px-6 py-4'>".$i++."</td>";
                                echo "<td class='px-6 py-4 capitalize'>".$data['username']."</td>";
                                echo "<td class='px-6 py-4 capitalize'><span class='" . ($data['role'] === 'user' ? 'bg-blue-100 text-blue-800' : 'bg-rose-100 text-rose-800') . " text-xs font-medium me-2 py-1 px-2 rounded-full capitalize'>".$data['role']."</span></td>";
                                echo '<td class="flex items-center px-6 py-4">
                                        <button id="edit" onclick="editUserModal('.$data["phone"].', \''.$data["username"].'\', \''.$data["alamat"].'\', \''.$data["role"].'\')" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>

                                        <a href="user_hapus.php?phone='.$data["phone"].'" class="p-2 hover:bg-[#eeeeee] rounded-full">
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

        <!-- Tambah User Modal -->
        <div id="add_user" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-2xl shadow-lg">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-6 md:pb-0 rounded-t-2xl">
                        <h3 class="modal-title text-xl font-semibold text-gray-900">
                            Tambah user
                        </h3>

                        <button onclick="hiddenModal()" class="p-2 rounded-full hover:bg-[#eeeeee]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form action="user_tambah.php" method="POST">
                        <!-- Modal body -->
                        <div class="p-4 md:pt-4 md:pb-0 md:px-6">
                            <!-- Mobile Phone Input -->
                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                <label for="phone" class="text-sm text-[#757575] mb-px">Nomor Telepon</label>

                                <input name="phone" id="phone" type="text" class="text-sm outline-none" placeholder="Nomor Telepon">
                            </div>

                            <!-- Username Input -->
                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                <label for="username" class="text-sm text-[#757575] mb-px">Username</label>

                                <input name="username" id="username" type="text" class="text-sm outline-none" placeholder="Username">
                            </div>

                            <!-- Password Input -->
                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                <label for="password" class="text-sm text-gray-500">Password</label>

                                <div class="flex justify-between gap-x-2 items-center">
                                    <input id="password" type="password" class="grow text-sm outline-none" placeholder="Password" name="password">

                                    <button id="show_hide_pass" type="button" onclick="showHidePassword()" class="p-1 transition hover:bg-[#eeeeee] rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Alamat Input -->
                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                                <label for="alamat" class="text-sm text-[#757575] mb-px">Alamat</label>

                                <input name="alamat" id="alamat" type="text" class="text-sm outline-none" placeholder="Alamat">
                            </div>

                            <!-- Role Input -->
                            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                                <label for="role" class="text-sm text-[#757575] mb-px">Role</label>

                                <select id="role" name="role" class="outline-none border-0 text-sm capitalize" placeholder="Role">
                                    <option id="role_user" value="user" selected>User</option>
                                    <option id="role_admin" value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="flex justify-end items-center gap-x-2 p-4 md:p-6">
                            <button type="button" onclick="hiddenModal()" class="py-2.5 px-3 text-sm font-medium text-[#2979ff] hover:bg-[#e3f2fd] rounded-full">
                                Cancel
                            </button>

                            <button id="user-button" name="submit-user" type="submit" class="py-2.5 px-3 text-sm font-medium text-[#2979ff] hover:bg-[#e3f2fd] rounded-full">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const addUserModal = () => {
                const element = document.querySelector("#add_user");

                element.classList.replace("hidden", "block");
            };

            const hiddenModal = () => {
                const element = document.querySelector("#add_user");

                element.classList.replace("block", "hidden");
            };

            const editUserModal = (phone, username, alamat, role) => {
                const element = document.querySelector("#add_user");

                // Menangkap semua value
                const phoneInput = document.querySelector("#phone");
                const usernameInput = document.querySelector("#username");
                const alamatInput = document.querySelector("#alamat");
                const roleInput = document.querySelector("#role");

                const submitButton = document.querySelector("#user-button");
                
                // Ubah judul modal
                document.querySelector(".modal-title").innerText = "Edit User";
                
                // Ganti label tombol
                submitButton.innerText = "Update";
                submitButton.name = "submit-edit-user";
                
                // Isi input dengan data user yang akan diupdate
                phoneInput.value = phone;
                usernameInput.value = username;
                alamatInput.value = alamat;

                if (role === "admin") {
                    document.querySelector("#role_admin").selected = true;
                }
                
                // Modifikasi action dari form untuk mengarah ke skrip PHP yang sesuai untuk pembaruan
                document.querySelector("form").action = "user_edit.php?phone=" + phone; // Ganti dengan skrip PHP yang sesuai
                
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

            // Show and Hide Password Function
            const showHidePassword = () => {
                const passwordElement = document.getElementById("password");
                const buttonShowHidePass = document.getElementById("show_hide_pass");

                if (passwordElement.type === "password") {
                    passwordElement.type = "text";

                    buttonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>'
                } else {
                    passwordElement.type = "password";

                    buttonShowHidePass.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
                }
            };
        </script>
    </body>
</html>
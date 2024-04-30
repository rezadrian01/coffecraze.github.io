<?php
    require('functions.php');
    session_start();
    $phone = $_SESSION['data']['phone'];
    $result = mysqli_query($conn,"SELECT * FROM user WHERE phone = '$phone';");
    while($row = mysqli_fetch_assoc($result)){
        $data = $row;
    }

    //apabila user menekan tombol edit
    if(isset($_POST['edit'])){
        header("Location: profile-edit.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/output.css">
    <title>Document</title>
</head>
<body>
    <header class="py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <div class="flex justify-between items-center">
            <div class="text-xl font-medium">Logo</div>
            <!-- jika belum login maka tombolnya login/signup -->
            <?php if (!isset($_SESSION["data"])) : ?>
                <a href="login.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Log in / Sign up</a>
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
                                    <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                        Dashboard
                                    </button>
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
        <div class="w-3/4 mx-auto">
            <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Phone Number</dt>
                            <dd class="text-gray-700 sm:col-span-2"><?= $data['phone']; ?></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Username</dt>
                            <dd class="text-gray-700 sm:col-span-2"><?= $data['username']; ?></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Addres</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['alamat']; ?></dd>
                    </div>
                </dl>
            </div>
            <div class="mt-4">
                <form action="" method="post">
                    <input type="hidden" name="idUser" value="<?= $_SESSION['data']['phone']; ?>">
                    <button class="hover:bg-slate-100 p-2 rounded-xl" type="submit" name="edit">Edit data</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="py-3 px-12 border-t bg-[#723E29] text-white text-center">
            Copyright &#169;<span id="year"></span>
    </footer>
    <script src="script.js" ></script>
</body>
</html>
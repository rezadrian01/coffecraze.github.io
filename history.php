<?php
    session_start();
    
    require('functions.php');

    $phone = $_SESSION['data']['phone'];
    $result = mysqli_query($conn,"SELECT * FROM user WHERE phone = '$phone';");
    //ambil data user
    while($row = mysqli_fetch_assoc($result)){
        $data = $row;
    }
    if(!isset($_GET['key']) || $_GET['key'] === 'all'){
        $key = false;
    }else{
        $key = $_GET['key'];
    }

    //ambil data di tabel pembelian
    // $pembelian = mysqli_query($conn, "SELECT * FROM pembelian WHERE id_user = '$phone';");
    // while($tempPembelian = mysqli_fetch_assoc($pembelian)){
    //     $dataPembelian[] = $tempPembelian; //array 2 dimensi index[tiap baris] & assoc[tiap kolom]
    // }

    // //ambil semua id_pembelian di pembelian
    // foreach($dataPembelian as $row){
    //     $idPembelian[] = $row['id'];  //idPembelian berbentuk array index untuk tiap baris
    //     //ambil semua idBarang yang dibeli user
    //     $barangDibeli = mysqli_query($sonn, "SELECT * FROM barang_dibeli WHERE id_pembelian = $idPembelian");
    //     while($dibeli = mysqli_fetch_){

    //     }
    // }

    //dari line 11 itu querynya langsung pake inner join aja
  
    // POST REVIEW
    if(isset($_POST['submitReview'])){
        $id_pembelian = $_POST['id_pembelian'];
        $id_user = $_POST['id_user'];
        $id_barang = $_POST['id_barang'];
        $star = $_POST['star'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO review(id, id_pembelian, id_user, id_barang, rating, comment) VALUES('', '$id_pembelian', '$id_user', '$id_barang', '$star', '$comment');";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            header('Location: history.php?key=completed');
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
    <title>History</title>
    <link rel="stylesheet" href="./src/output.css">

</head>
<body>
    <header class="py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <div class="flex justify-between items-center">
            <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>
            <ul class="flex items-center gap-x-2">
                <li>
                    <a href="profile.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                        Profile
                    </a>
                </li>
                <li>
                    <a href="history.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
                        History purchase
                    </a>
                </li>
                
            </ul>
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
                                    <a href="dashboard.php">
                                        <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                            Dashboard
                                        </button>
                                    </a>
                                </li>
                                
                            <?php }; ?>
                            <li>
                                <a href="index.php">
                                    <button class="py-2 pl-3.5 w-full hover:bg-[#eeeeee] text-left rounded-lg">
                                    Back to home
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
                <!-- <a href="logout.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Logout</a> -->
            <?php endif; ?>
        </div>
    </header>

    <main class="grow py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16 mb-16">
        <div class="w-3/4 mx-auto">
            <!-- filter by kategori -->
            <div class="mb-8">
                <ul class="mx-4 flex gap-8">
                    <!-- ketika all dipilih -->
                    <li><?php if((!isset($_GET['key'])) || ($_GET['key'] === 'all')): ?>
                        <a href="history.php?key=all">
                            <button class="p-2 bg-slate-100 rounded-xl">All</button> 
                        </a>
                        <?php else: ?>
                            <a href="history.php?key=all">
                                <button class="p-2 rounded-xl">All</button> 
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if((!isset($_GET['key'])) || ($_GET['key'] !== 'in process')): ?>
                        <a href="history.php?key=in process">
                            <button class="p-2   rounded-xl">In process</button> 
                        </a>
                        <?php else: ?>
                            <a href="history.php?key=in process">
                                <button class="p-2 bg-slate-100 rounded-xl">In process</button> 
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if((!isset($_GET['key'])) || ($_GET['key'] !== 'to receive')): ?>
                        <a href="history.php?key=to receive">
                            <button class="p-2  rounded-xl">To receive</button> 
                        </a>
                        <?php else: ?>
                            <a href="history.php?key=to receive">
                                <button class="p-2 bg-slate-100 rounded-xl">To receive</button> 
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if((!isset($_GET['key'])) || ($_GET['key'] !== 'completed')): ?>
                        <a href="history.php?key=completed">
                            <button class="p-2  rounded-xl">Completed</button> 
                        </a>
                        <?php else: ?>
                            <a href="history.php?key=completed">
                                <button class="p-2 bg-slate-100 rounded-xl">Completed</button> 
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <!-- parent group -->
            <?php 
            $datas = showHistory($phone, $key);
            foreach($datas as $data):
            ?>
            <div class="flow-root rounded-lg border border-gray-100 py-3 mb-8 shadow-lg">
                <dl class="-my-3 divide-y divide-gray-100 text-sm">
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Recipient's name</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['nama']; ?></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Item id</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['idBarang']; ?></dd>
                    </div>

                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Name item</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['namaBarang']; ?></dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Item category</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['kategori']; ?></dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Price</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['hargaBarang']; ?></dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Ordering method</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['tempat']; ?></dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Status</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['status']; ?></dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Qty</dt>
                        <dd class="text-gray-700 sm:col-span-2"><?= $data['jumlahBarang']; ?></dd>
                    </div>
                    <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                        <dt class="font-medium text-gray-900">Rating & comment</dt>
                        <dd class="text-gray-700 sm:col-span-2">
                            <!-- hanya menampilkan jika status = completed dan belum pernah review-->
                            <?php 
                                $checkIfAlreadyReviewed = "
                                SELECT 
                                    CASE 
                                        WHEN EXISTS(SELECT 1 FROM review WHERE id_pembelian = ? AND id_barang = ?) 
                                        THEN 'reviewed' 
                                        ELSE 'not_reviewed' 
                                    END AS review_status";
                                $checkIfAlreadyReviewedQuery = mysqli_prepare($conn, $checkIfAlreadyReviewed);
                                mysqli_stmt_bind_param($checkIfAlreadyReviewedQuery, "ss", $data['id_pembelian'], $data['idBarang']);
                                mysqli_stmt_execute($checkIfAlreadyReviewedQuery);
                                mysqli_stmt_bind_result($checkIfAlreadyReviewedQuery, $reviewStatus);
                                mysqli_stmt_fetch($checkIfAlreadyReviewedQuery);
                                mysqli_stmt_close($checkIfAlreadyReviewedQuery);
                                
                                if ($reviewStatus == 'reviewed') {
                                    $getReview = "SELECT rating, comment FROM review WHERE id_pembelian = ? AND id_barang = ?";
                                    $getReviewQuery = mysqli_prepare($conn, $getReview);
                                    mysqli_stmt_bind_param($getReviewQuery, "ss", $data['id_pembelian'], $data['idBarang']);
                                    mysqli_stmt_execute($getReviewQuery);
                                    mysqli_stmt_bind_result($getReviewQuery, $rating, $comment);

                                    while(mysqli_stmt_fetch($getReviewQuery)) {
                            ?>
                                        <div class="mt-4">
                                            <p><?php echo $rating; ?>/5</p>
                                            <p type="text" class="bg-slate-100 w-3/4 rounded-md p-2"><?php echo $comment; ?></p>
                                        </div>
                            <?php
                                    }
                                    mysqli_stmt_close($getReviewQuery);
                                } else {
                            ?>
                                    <form action="" method="POST">
                                        <!-- Rating -->
                                        <div class="flex items-center gap-x-1">
                                            <label for="1">
                                                <svg class="w-4 h-4 text-[#90a0a3]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </label>
                                            <input type="radio" id="1" value="1" class="" name="star">

                                            <label for="2">
                                                <svg class="w-4 h-4 text-[#90a0a3]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </label>
                                            <input type="radio" id="2" value="2" class="" name="star">

                                            <label for="3">
                                                <svg class="w-4 h-4 text-[#90a0a3]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </label>
                                            <input type="radio" id="3" value="3" class="" name="star">

                                            <label for="4">
                                                <svg class="w-4 h-4 text-[#90a0a3]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </label>
                                            <input type="radio" id="4" value="4" class="" name="star">

                                            <label for="5">
                                                <svg class="w-4 h-4 text-[#90a0a3]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            </label>
                                            <input type="radio" id="5" value="5" class="" name="star">
                                        </div>
                                        
                                        <div class="mt-4">
                                            <input type="hidden" name="id_pembelian" value="<?php echo $data['id_pembelian']; ?>">
                                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['data']['phone']; ?>">
                                            <input type="hidden" name="id_barang" value="<?php echo $data['idBarang']; ?>">
                                            <input type="text" class="bg-slate-100 w-3/4 rounded-md p-2" name="comment">

                                            <div class="my-4">
                                                <button type="submit" name="submitReview">Submit review</button>
                                            </div>
                                        </div>
                                    </form>
                            <?php 
                                }
                            ?>
                        </dd>
                    </div>
                </dl>
            </div>

            <?php endforeach; ?>
        </div>
    </main>
    <footer class="py-3 px-12 border-t bg-[#723E29] text-white text-center">
            Copyright &#169;<span id="year"></span>
    </footer>
    <script src="script.js" ></script>
</body>
</html>
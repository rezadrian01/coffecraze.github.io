<?php

session_start();
if(isset($_SESSION['data']['role'])){
    if($_SESSION['data']['role'] === "user"){
        header("Location: index.php");
        exit();
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
</head>
<body>
    <header class="flex justify-between items-center py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>

        <ul class="flex items-center gap-x-2">
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
                <a href="logout.php">Logout</a>
            </li>
        </ul>

        <div>
            <button class="py-2 pl-4 pr-3 flex items-center gap-x-2 text-base hover:bg-[#eeeeee] rounded-full">
                Hai, Fathan
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </span>
            </button>
        </div>
    </header>

    <main class="max-w-screen-xl mx-auto py-12">
        <h1 class="text-3xl font-semibold">Hello, Fathan</h1>

        <div class="mt-12">
            <h4 class="text-2xl font-semibold">Your orders</h4>

            <div class="flex flex-col justify-center items-center bg-[#eeeeee] rounded-xl py-9 mt-7">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>
                </span>

                <div class="text-base mt-2.5">No orders</div>
            </div>
        </div>
    </main>
</body>
</html>
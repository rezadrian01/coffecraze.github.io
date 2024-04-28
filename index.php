<?php

session_start();
require('functions.php');
$items = show(false);

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
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <a href="login.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Log in / Sign up</a>
                    <!-- jika sudah login maka tombol menjadi logout -->
                    <?php else : ?>
                        <a href="logout.php" class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Logout</a>
                    <?php endif; ?>
                </div>
            </header>

            <main class="grow py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
                <div class="flex justify-between items-center mt-3 mb-8">
                    <div class="flex items-center gap-x-2">
                        <button class="py-2 px-4 rounded-full text-sm text-white font-semibold bg-[#723E29]">
                            All
                        </button>
                        <a href="show.php?key=1" class="py-2 px-4 rounded-full text-sm text-white font-semibold bg-[#8d6e63]">
                            Coffee
                        </a>
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

                <?php foreach($items as $data): ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-6 gap-6">
                        <div onclick="showModal()">
                            <div class="h-80 w-full">
                                <img class="h-full w-full rounded-2xl object-cover" src="./images/<?= $data['gambar']; ?>" alt="coffee">
                            </div>

                            <div class="flex justify-between items-center mt-1">
                                <!-- Product's name and category -->
                                <div>
                                    <div class="text-sm text-[#757575]"><?= $data['kategori']; ?></div>
                                    <h6 class="font-bold text-xl text-[#3e2723]"><?= $data['nama'] ?></h6>
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
                                <h6 class="text-lg font-bold"><?= $data['harga']; ?></h6>
                            </div>

                            <div class="flex items-center gap-x-2 mt-2">
                                <button class="bg-[#3e2723] text-white text-xs font-medium py-2.5 w-full rounded-full">
                                    Buy now
                                </button>

                                <button class="border text-xs font-medium py-2.5 w-full rounded-full">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Modal -->
                <?php foreach($items as $data): ?>
                    <div id="modal" class="hidden fixed top-0 left-0 flex justify-center items-center w-full h-full z-10">
                        <!-- Backdrop -->
                        <div onclick="hiddenModal()" class="fixed top-0 left-0 bg-black opacity-50 w-full h-full z-[-1]"></div>

                        <!-- Modal Body -->
                        <div class="bg-white rounded-3xl w-full max-w-screen-lg z-20">
                            <div class="flex flex-col gap-y-4 max-h-full">
                                <!-- Header -->
                                <div class="flex justify-end p-2">
                                    <!-- Close Button -->
                                    <button onclick="hiddenModal()" class="p-3 rounded-full hover:bg-[#eeeeee]">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Body -->
                                <div class="grid grid-cols-12 gap-x-4 px-6 pb-6">
                                    <div class="col-span-5">
                                        <img class="rounded-2xl" src="./images/<?= $data['gambar']; ?>" alt="coffee">
                                    </div>

                                    <div class="col-span-7">
                                        <div class="tabs-parent relative flex items-center justify-between gap-x-1 p-1 bg-[#e0e0e0] rounded-full">
                                            <button onclick="tab(event, 'details')" class="tablinks w-full text-center py-2 rounded-full active">Details</button>
                                            <button onclick="tab(event, 'review')" class="tablinks w-full text-center py-2 rounded-full">Review</d>
                                        </div>

                                        <div id="details" class="tab-content mt-4" style="display: block;">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <div class="text-2xl text-black font-medium">Caffè latte</div>
                                                    <div class="text-base text-[#757575]">Espresso</div>
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
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore vel illum quisquam itaque placeat recusandae voluptatem architecto repellendus laborum, quia sit vero corrupti, asperiores, laudantium dolorem autem eos? Magnam consectetur ducimus commodi eum. Eveniet at debitis velit impedit? Optio doloremque ducimus nemo vel beatae voluptatibus architecto ipsa aliquid earum quae?
                                                </p>
                                            </div>
                                        </div>

                                        <div id="review" class="tab-content mt-2" style="display: none;">
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
                <?php endforeach; ?>
            </main>

            <footer class="py-3 px-12 border-t bg-[#723E29] text-white text-center">
                Copyright &#169;<span id="year"></span>
            </footer>
        </div>

        <div class="hidden md:block w-80 md:w-64 xl:w-72 2xl:w-80 border-l p-1">
            <div class="grid grid-cols-12 gap-x-2 rounded-2xl p-1 group">
                <div class="col-span-4">
                    <img class="h-24 w-full rounded-xl object-cover" src="./assets/coffee-image.jpg" alt="coffee">
                </div>

                <div class="col-span-8 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-xs text-[#757575]">Espresso</div>
                                <h6 class="font-bold text-base text-[#3e2723]">Caffè latte</h6>
                            </div>

                            <button title="Delete from cart" class="hidden group-hover:block p-1.5 border rounded-full hover:bg-[#d32f2f] hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>

                        <div class="text-base font-bold mt-0.5">Rp8.000</div>
                    </div>

                    <div class="flex items-center gap-x-2">
                        <button onclick="decrement()" class="border p-1 rounded-full hover:bg-[#eeeeee]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>

                        <span id="qty" class="text-sm font-medium"></span>

                        <button onclick="increment()" class="border p-1 rounded-full hover:bg-[#eeeeee]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="flex justify-between items-center py-2.5 px-12">
        <div class="text-xl font-medium">Logo</div>

        <ul class="flex items-center gap-x-1">
            <li>
                <button class="flex items-center gap-x-2 py-2.5 pl-4 pr-3 rounded-full hover:bg-gray-100">
                    Product 
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </button>
            </li>
            <li><button class="py-2.5 px-3 rounded-full hover:bg-gray-100">Special offers</button></li>
            <li><button class="py-2.5 px-3 rounded-full hover:bg-gray-100">The process</button></li>
            <li><button class="py-2.5 px-3 rounded-full hover:bg-gray-100">Packing</button></li>
            <li><button class="py-2.5 px-3 rounded-full hover:bg-gray-100">About</button></li>
        </ul>

        <div class="flex items-center gap-x-2">
            <button class="p-2 rounded-full border text-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>

            <button class="p-2 rounded-full border text-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>

            <div>
                <button class="py-3 px-6 bg-[#723E29] text-sm text-white font-medium rounded-full">Log in / Sign up</button>
            </div>
        </div>
    </header>

    <main class="py-2.5 px-12">
        <h1 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-9xl font-black uppercase bg-clip-text text-transparent">
            COFFEE
        </h1>

        <h6 class="text-5xl text-[#3e2723] font-black mt-8">An online coffee store</h6>

        <p class="text-[#3e2723] font-medium mt-4">Straight to your doorstep. We don't roast our beans until we have your order. Every order is roasted and shipped the same day.</p>
    
        <div class="flex items-center gap-x-4 mt-10">
            <button class="flex items-center gap-x-2 py-3 pl-6 pr-4 rounded-full bg-[#723E29] text-white font-medium shadow-[rgba(0,0,0,0.3)_0px_19px_38px,_rgba(0,0,0,0.22)_0px_15px_12px]">
                Explore our products 
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
            </button>

            <button class="py-3 px-6 border rounded-full font-medium">Log in / sign up</button>
        </div>

        <div class="flex items-center mt-12">
            <div class="flex flex-col gap-y-1">
                <p class="text-sm text-[#757575]">Our products</p>

                <span class="text-3xl font-bold">+1000</span>
            </div>

            <div class="border-l py-8 mx-4"></div>

            <div class="flex flex-col gap-y-1">
                <p class="text-sm text-[#757575]">Total sales</p>

                <span class="text-3xl font-bold">+340k</span>
            </div>

            <div class="border-l py-8 mx-4"></div>

            <div class="flex flex-col gap-y-1">
                <p class="text-sm text-[#757575]">Total sales</p>

                <span class="text-3xl font-bold">+340k</span>
            </div>
        </div>

        <div class="flex flex-col justify-center mt-12">
            <div>
                <h4 class="text-3xl text-[#3e2723] font-black text-center">
                    Explore the recent products
                </h4>
                <p class="text-[#3e2723] font-medium text-center mt-3">
                    Our delectable drink options, including classic espreso choices, house specialties, fruit smoothies and frozen treats.
                </p>
            </div>

            <div class="grid grid-cols-5 gap-6 mt-8">
                <div onclick="showModal()" class="border rounded-2xl overflow-hidden">
                    <div class="flex justify-center items-center py-3">
                        <img class="h-80" src="./assets/coffee-image.jpg" alt="coffee">
                    </div>

                    <div class="p-1.5 pb-3.5">
                        <div class="pl-4">
                            <div class="text-sm text-[#757575]">Espresso</div>

                            <h6 class="font-bold text-xl">Caffè latte</h6>

                            <div class="flex items-center gap-x-2 mt-3.5">
                                <div class="text-sm line-through text-[#3e2723]">Rp15.000</div>

                                <h6 class="text-2xl font-bold text-[#3e2723]">Rp8.000</h6>
                            </div>
                        </div>

                        <div class="flex items-center gap-x-2 mt-3.5">
                            <button class="flex items-center gap-x-2 py-3 pl-4 pr-3 text-sm font-medium rounded-full hover:bg-gray-100">
                                Add to cart 
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </button>

                            <button class="py-3 px-6 text-sm font-medium rounded-full text-white bg-[#3e2723]">
                                Buy now 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
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
                            <img class="rounded-2xl" src="./assets/coffee-image.jpg" alt="coffee">
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
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
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
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 text-[#fb8c00] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        <svg class="w-4 h-4 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
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
    </main>

    <footer class="py-3 px-12 border-t bg-[#723E29] text-white text-center">
        Copyright &#169;<span id="year"></span>
    </footer>

    <script src="script.js"></script>
</body>
</html>
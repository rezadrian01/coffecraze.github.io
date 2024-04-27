<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="./src/output.css">
</head>
<body>
    <header class="flex justify-between items-center py-2.5 px-4 md:px-6 xl:px-12 2xl:px-16">
        <h5 class="bg-gradient-to-br from-[#a1887f] from-15% to-[#3e2723] to-40% text-3xl font-black uppercase bg-clip-text text-transparent">COFFEE</h5>

        <ul class="flex items-center gap-x-2">
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
        <h4 class="text-2xl font-semibold">Add product</h4>

        <div class="mt-6">
            <!-- Image Input -->
            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                <label for="image" class="text-sm text-[#757575] mb-px">Gambar product</label>

                <input id="image" type="file" multiple class="text-sm outline-none">
            </div>

            <!-- Product Input -->
            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                <label for="email" class="text-sm text-[#757575] mb-px">Nama product</label>

                <input id="email" type="email" class="text-sm outline-none" placeholder="Nama product">
            </div>

            <!-- Harga Input -->
            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                <label for="harga" class="text-sm text-[#757575] mb-px">Harga</label>

                <div class="flex items-center gap-x-2">
                    <span class="text-base text-[#757575]">Rp</span>

                    <input id="harga" type="number" class="text-sm outline-none w-full" placeholder="000.000">
                </div>
            </div>

            <!-- Kategori Input -->
            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                <label for="kategori" class="text-sm text-[#757575] mb-px">Kategori</label>

                <select id="kategori" class="outline-none border-0 text-sm" placeholder="Pilih kategori">
                    <option value="coffee">Coffee</option>
                    <option value="non coffee">Non coffee</option>
                    <option value="frappuccino">Frappuccino</option>
                    <option value="⁠seasional item">⁠Seasional item</option>
                    <option value="food">⁠Food</option>
                    <option value="snack">Snack</option>
                    <option value="desert">Desert</option>
                </select>
            </div>

            <!-- Kategori Input -->
            <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                <label for="deskripsi" class="text-sm text-[#757575] mb-px">Deskripsi</label>

                <textarea id="deskripsi" cols="30" rows="3" class="outline-none text-sm" placeholder="Deskripsi"></textarea>
            </div>

            <div class="flex justify-end gap-x-2 mt-8">
                <a href="product.php" type="button" class="py-2.5 px-5 text-sm font-medium rounded-full border hover:bg-[#eeeeee]">Cancel</a>
                <button type="submit" class="py-2.5 px-5 text-sm font-medium rounded-full bg-[#2196f3] text-white">Submit</button>
            </div>
        </div>
    </main>

</body>
</html>
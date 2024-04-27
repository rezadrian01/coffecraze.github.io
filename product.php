<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>    
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
        <h4 class="text-2xl font-semibold">Product</h4>

        <div class="flex items-center gap-x-7 mt-6">
            <div class="grow flex items-center gap-x-2 border py-2 rounded-full px-3">
                <label for="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#424242]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </label>

                <input id="search" type="text" class="outline-none text-sm w-full" placeholder="Search product">
            </div>

            <a href="tambah_produk.php" class="py-2.5 px-5 transition hover:bg-[#e3f2fd] text-[#1976d2] text-sm font-medium rounded-full">Add product</a>
        </div>

        <div class="relative overflow-x-auto mt-5">
            <table class="table-fixed w-full text-left">
                <thead class="text-xs text-gray-700 uppercase border-b">
                    <tr>
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
                    <tr class="text-sm">
                        <th class="flex items-center gap-x-2 px-6 py-4 font-medium text-gray-900 text-sm group">
                            <img class="w-12 rounded-lg" src="./assets/coffee-image.jpg" alt="coffee">

                            <div>
                                Caffè latte

                                <p class="group-hover:hidden line-clamp-2 mt-0.5 text-[#757575] font-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum earum et impedit quidem quibusdam consequatur vel voluptates, tempora temporibus asperiores nobis explicabo ipsum deleniti architecto consectetur blanditiis, magni repellat voluptate? Quo, unde. Voluptatum officiis illum autem exercitationem reiciendis eligendi non accusamus blanditiis quos animi odio inventore quo, dolores, praesentium atque?</p>
                            
                                <div class="hidden group-hover:block mt-2.5">
                                    <button type="button" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>

                                    <button type="button" class="p-2 hover:bg-[#eeeeee] rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            Rp8.000
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 py-1 px-2 rounded-full">Ready</span>
                        </td>
                        <td class="px-6 py-4 text-sm hover:text-blue-600 cursor-pointer">
                            4
                        </td>
                        <td class="px-6 py-4 text-sm hover:text-blue-600 cursor-pointer">
                            4
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
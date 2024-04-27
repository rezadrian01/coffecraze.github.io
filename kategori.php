<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>    
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
                <a href="product.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full">
                    Product
                </a>
            </li>
            <li>
                <a href="kategori.php" class="py-2 px-4 hover:bg-[#eeeeee] rounded-full font-semibold">
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
        <h4 class="text-2xl font-semibold">Kategori</h4>

        <div class="flex items-center gap-x-7 mt-6">
            <div class="grow flex items-center gap-x-2 border py-2 rounded-full px-3">
                <label for="search">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-[#424242]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </label>

                <input id="search" type="text" class="outline-none text-sm w-full" placeholder="Search category">
            </div>

            <button type="button" onclick="addCategoryModal()" class="py-2.5 px-5 transition hover:bg-[#e3f2fd] text-[#1976d2] text-sm font-medium rounded-full">Add category</button>
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
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-sm">
                        <td class="px-6 py-4">
                            1
                        </td>
                        <td class="px-6 py-4">
                            Coffee
                        </td>
                    </tr>
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
                    <h3 class="text-xl font-semibold text-gray-900">
                        Tambah kategori
                    </h3>

                    <button onclick="hiddenModal()" class="p-2 rounded-full hover:bg-[#eeeeee]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:pt-4 md:pb-0 md:px-6">
                    <!-- Product Input -->
                    <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                        <label for="nama_kategori" class="text-sm text-[#757575] mb-px">Nama kategori</label>

                        <input id="nama_kategori" type="text" class="text-sm outline-none" placeholder="Nama kategori">
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end items-center gap-x-2 p-4 md:p-6">
                    <button type="button" onclick="hiddenModal()" class="py-2.5 px-3 text-sm font-medium text-[#2979ff] hover:bg-[#e3f2fd] rounded-full">
                        Cancel
                    </button>

                    <button type="button" class="py-2.5 px-3 text-sm font-medium text-[#2979ff] hover:bg-[#e3f2fd] rounded-full">
                        Submit
                    </button>
                </div>
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
    </script>
</body>
</html>
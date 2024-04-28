<?php
    include("functions.php");
    global $conn;

    $id = $_GET['id'];

    $sql = "SELECT * FROM barang WHERE id = $id;";
    $query = mysqli_query($conn, $sql);
    $produk_data = mysqli_fetch_assoc($query);
?>

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
            <form action="produk_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" class="hidden" value="<?php echo $produk_data['id']; ?>">
                
                <!-- Image Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="image" class="text-sm text-[#757575] mb-px">Gambar product</label>

                    <input id="image" type="file" name="image" class="text-sm outline-none">

                    <div class="mt-2.5 text-sm text-[#757575]">
                        Gambar sebelumnya 
                        <img class="w-24 rounded-xl mt-0.5" src="<?php echo "./images/" . $produk_data['gambar']; ?>" alt="coffee">
                    </div>
                </div>

                <!-- Product Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="nama_product" class="text-sm text-[#757575] mb-px">Nama product</label>

                    <input id="nama_product" type="text" name="nama" value="<?php echo $produk_data['nama']; ?>" class="text-sm outline-none" placeholder="Nama product">
                </div>

                <!-- Harga Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="harga" class="text-sm text-[#757575] mb-px">Harga</label>

                    <div class="flex items-center gap-x-2">
                        <span class="text-base text-[#757575]">Rp</span>

                        <input id="harga" type="number" name="harga" value="<?php echo $produk_data['harga']; ?>" class="text-sm outline-none w-full" placeholder="000.000">
                    </div>
                </div>

                <!-- Kategori Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400 mb-4">
                    <label for="kategori" class="text-sm text-[#757575] mb-px">Kategori</label>

                    <select id="kategori" name="kategori" class="outline-none border-0 text-sm capitalize" placeholder="Pilih kategori">
                        <?php
                            $sql = "SELECT * FROM kategori";
                            $query = mysqli_query($conn, $sql);

                            $dataArray = [];
                            while($data = mysqli_fetch_array($query)) {
                                $dataArray[] = $data;
                            }

                            foreach($dataArray as $data) {
                                echo "<option class='capitalize' value='{$data['id']}' " . ($data['id'] === $produk_data['id_kategori'] ? 'selected' : '') . ">{$data['nama']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <!-- Deskripsi Input -->
                <div class="flex flex-col py-2 px-3 border-2 rounded-2xl transition hover:border-gray-400">
                    <label for="deskripsi" class="text-sm text-[#757575] mb-px">Deskripsi</label>

                    <textarea id="deskripsi" name="deskripsi" cols="30" rows="3" class="outline-none text-sm" placeholder="Deskripsi"><?php echo $produk_data['deskripsi']; ?></textarea>
                </div>

                <div class="flex justify-end gap-x-2 mt-8">
                    <a href="product.php" class="py-2.5 px-5 text-sm font-medium rounded-full border hover:bg-[#eeeeee]">Cancel</a>
                    <button name="submit-edit-produk" type="submit" class="py-2.5 px-5 text-sm font-medium rounded-full bg-[#2196f3] text-white">Submit</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
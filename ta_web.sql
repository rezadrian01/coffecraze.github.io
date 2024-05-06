-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(15) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `gambar`, `nama`, `harga`, `id_kategori`, `deskripsi`, `status`) VALUES
(2, '1.jpg', 'Double Shot Ice Shaken Espresso', 25000, 1, 'Espresso berkualitas tinggi yang disajikan dingin dengan cita rasa yang kuat.', 'ready'),
(4, '2.jpg', 'Asian Double Latte', 24000, 1, 'Paduan sempurna antara espresso yang kaya dan susu lembut, memberikan pengalaman minum kopi yang menggoda.\r\n', 'ready'),
(5, '3.jpg', 'Americano', 19000, 1, 'Espresso yang diencerkan dengan air panas, menghasilkan minuman yang kuat namun halus, cocok untuk dinikmati kapan saja.\r\n', 'ready'),
(6, '4.jpg', 'Salted Caramel Macchiato', 24000, 1, 'Espresso yang dicampur dengan susu berbusa dan sirup caramel garam, menciptakan minuman yang memikat dengan rasa yang lezat.\r\n', 'ready'),
(7, '5.jpg', 'Caramel Macchiato', 25000, 1, 'Paduan sempurna antara espresso yang kuat, susu berbusa, dan sirup karamel, menghasilkan minuman yang manis dan memikat.\r\n', 'ready'),
(8, '6.jpg', 'Salted Caramel Latte', 25000, 1, 'Espresso yang dicampur dengan susu lembut dan sirup caramel garam, menciptakan harmoni cita rasa yang memanjakan lidah.\r\n', 'ready'),
(9, '7.jpg', 'Cold Brew', 25000, 1, 'Kopi berkualitas tinggi yang diseduh secara dingin selama berjam-jam, menghasilkan minuman yang segar, halus, dan penuh karakter, siap memberikan sensasi kesegaran yang tak tertandingi.\r\n', 'ready'),
(10, '8.jpg', 'Caramel Latte', 23000, 1, 'Espresso yang dicampur dengan susu lembut dan sirup karamel, menghasilkan minuman yang lezat dan memanjakan lidah.\r\n', 'ready'),
(11, '9.jpg', 'Vanila Latte', 26000, 1, 'Paduan sempurna antara espresso yang kaya, susu lembut, dan sentuhan vanila yang lembut, menciptakan minuman yang lezat dan memuaskan.\r\n', 'ready'),
(12, '10.jpg', 'Hazelnut Latte', 24000, 1, 'Espresso yang dicampur dengan susu lembut dan sirup hazelnut, menciptakan minuman yang lezat dengan sentuhan kacang hazelnut yang khas.\r\n', 'ready'),
(13, '11.jpg', 'Caffe Latte', 23000, 1, 'Espresso yang dicampur dengan susu lembut, menciptakan minuman yang halus dan memuaskan, sempurna untuk menikmati kehangatan kopi klasik.\r\n', 'ready'),
(14, '12.jpg', 'Cappuccino', 25000, 1, 'Perpaduan sempurna antara espresso yang kuat, susu berbusa yang lembut, dan taburan bubuk kakao, menciptakan minuman yang kaya, kreami, dan memikat.\r\n', 'ready'),
(15, '13.jpg', 'Vanila Sweat Cream', 22000, 1, 'Espresso yang dicampur dengan susu lembut dan sirup vanila, kemudian disajikan dengan lapisan krim manis di atasnya, menciptakan minuman yang memanjakan lidah dengan rasa yang lezat dan tekstur yang khas.\r\n', 'ready'),
(16, '14.jpg', 'Caffe Mocha', 26000, 1, 'Espresso yang dicampur dengan susu lembut dan sirup cokelat, disajikan dengan taburan whipped cream di atasnya, menciptakan minuman yang kaya, lembut, dan memuaskan dengan sentuhan manis yang tak tertandingi.\r\n', 'ready'),
(17, '15.jpg', 'Brown Sugar Oatmilk', 24000, 1, 'Campuran sempurna antara espresso, susu oat yang lembut, dan sirup gula merah, menciptakan minuman yang memikat dengan cita rasa manis dan aroma yang menggugah selera.\r\n', 'ready'),
(18, '16.jpg', 'Teavana Ice Tea', 17000, 2, 'Teh pilihan terbaik dari Teavana yang disajikan dingin dengan pilihan rasa yang beragam, menciptakan minuman yang menyegarkan dan menyehatkan untuk dinikmati kapan saja.\r\n', 'ready'),
(19, '17.jpg', 'Ice Shaken Lemonade Tea', 18000, 2, 'Kombinasi sempurna antara teh yang disajikan dingin, lemonade segar, dan es yang disajikan dengan metode shaken, menciptakan minuman yang menyegarkan dengan rasa yang segar dan manis.\r\n', 'ready'),
(21, '18.jpg', 'Caramel Signature Chocolate', 21000, 2, 'Campuran istimewa antara cokelat premium yang lembut, sirup caramel yang manis, dan susu lembut, disajikan dengan taburan whipped cream di atasnya, menciptakan minuman yang memanjakan lidah dengan rasa yang kaya dan tekstur yang lembut.\r\n', 'ready'),
(22, '19.jpg', 'Signature Chocolate', 21000, 2, 'Minuman cokelat premium yang lezat dan memuaskan, sempurna untuk memanjakan diri kapan saja.\r\n', 'ready'),
(23, '20.jpg', 'Hazelnut Signature Chocolate', 27000, 2, 'Kombinasi sempurna antara cokelat lembut dan sentuhan khas hazelnut, menciptakan minuman yang memikat dengan rasa yang kaya dan aroma yang menggoda.\r\n', 'ready'),
(24, '21.jpg', 'Greentea Latte', 23000, 2, 'Campuran sempurna antara teh hijau yang halus dan susu lembut, menciptakan minuman yang menyegarkan dengan cita rasa yang lembut dan kaya akan manfaat bagi tubuh.\r\n', 'ready'),
(25, '22.jpg', 'Lemon Tea', 16000, 2, 'Campuran segar antara teh hitam yang lembut dan irisan lemon segar, menciptakan minuman yang menyegarkan dengan cita rasa yang bersahaja dan menyegarkan.\r\n', 'ready'),
(26, '23.jpg', 'Caramel Macchiato Frappuccino', 20000, 3, 'Campuran es krim lembut, espresso yang kuat, susu, dan sirup caramel, menciptakan minuman yang segar dan memanjakan dengan cita rasa klasik yang memikat.\r\n', 'ready'),
(27, '24.jpg', 'Vanila Cream Fappuccino', 27000, 3, 'Campuran es krim lembut, susu, dan sentuhan vanila yang lembut, menciptakan minuman yang segar dan memuaskan, sempurna untuk dinikmati di hari yang panas.\r\n', 'ready'),
(28, '25.jpg', 'Coffe Frappuccino', 23000, 3, 'Campuran es krim lembut, espresso yang kuat, susu, dan es yang di-blend dengan sempurna, menciptakan minuman yang segar dan memikat dengan cita rasa kopi yang autentik.\r\n', 'ready'),
(29, '26.jpg', 'Caramel Cream Frappuccino', 20000, 3, 'Campuran es krim lembut, susu, dan sirup caramel yang manis, menciptakan minuman yang segar dan memanjakan dengan cita rasa karamel yang khas.\r\n', 'ready'),
(30, '27.jpg', 'Salted Caramel Javachip Frappuccino', 24000, 3, 'Campuran es krim lembut, potongan cokelat, espresso yang kuat, susu, dan sirup caramel garam, menciptakan minuman yang segar dan memanjakan dengan cita rasa yang kaya dan gurih.\r\n', 'ready'),
(31, '28.jpg', 'Caramel Frappuccino', 25000, 3, 'Campuran es krim lembut, espresso yang kuat, susu, dan sirup caramel yang manis, menciptakan minuman yang segar dan memanjakan dengan cita rasa karamel yang lezat.\r\n', 'ready'),
(32, '29.jpg', 'Mocha Frappuccino', 26000, 3, 'Campuran es krim lembut, espresso yang kuat, susu, dan sirup cokelat, menciptakan minuman yang segar dan memanjakan dengan cita rasa cokelat yang lezat.\r\n', 'ready'),
(33, '30.jpg', 'Double Chocolate Cream Frappuccino', 22000, 3, 'Campuran es krim lembut, bubuk cokelat, susu, dan taburan cokelat, menciptakan minuman yang segar dan memanjakan dengan cita rasa cokelat yang intens.\r\n', 'ready'),
(34, '31.jpg', 'Caramel Java Chip Frappuccino', 24000, 3, 'Campuran es krim lembut, potongan cokelat, espresso yang kuat, susu, dan sirup caramel, menciptakan minuman yang segar dan memanjakan dengan cita rasa yang kaya dan gurih.\r\n', 'ready'),
(35, '32.jpg', 'Dark Mocha Frappuccino', 23000, 3, 'Campuran es krim lembut, espresso yang kuat, susu, dan sirup cokelat gelap, menciptakan minuman yang segar dan memanjakan dengan cita rasa cokelat yang intens dan kaya.\r\n', 'ready'),
(36, '33.jpg', 'Greentea Cream Frappuccino', 23000, 3, 'Campuran es krim lembut, susu, dan teh hijau yang halus, menciptakan minuman yang segar dan memanjakan dengan cita rasa teh yang lembut dan menyegarkan.\r\n', 'ready'),
(37, '34.jpg', 'Java Chip Frappuccino', 27000, 3, 'Campuran es krim lembut, potongan cokelat, espresso yang kuat, susu, dan es yang di-blend dengan sempurna, menciptakan minuman yang segar dan memanjakan dengan cita rasa yang kaya dan gurih.\r\n', 'ready'),
(38, '35.jpg', 'Raspberry Blackcurrant Frappuccino', 25000, 3, 'Campuran segar antara raspberry dan blackcurrant yang segar, es krim lembut, susu, dan es yang di-blend dengan sempurna, menciptakan minuman yang segar dan memanjakan dengan cita rasa buah yang menyegarkan.\r\n', 'ready'),
(39, '36.jpg', 'Mango Pasion Frappuccino', 20000, 3, 'Campuran segar antara mangga dan passion fruit, es krim lembut, susu, dan es yang di-blend dengan sempurna, menciptakan minuman yang segar dan memanjakan dengan cita rasa buah yang eksotis.\r\n', 'ready'),
(40, '37.jpg', 'Pure Matcha Latte', 23000, 4, 'Campuran teh matcha premium yang halus dengan susu lembut, menciptakan minuman yang kaya rasa dengan aroma yang segar dan menyegarkan.\r\n', 'ready'),
(41, '38.jpg', 'Pure Matcha Cream Frappuccino', 22000, 4, 'Campuran teh matcha premium yang halus, es krim lembut, susu, dan es yang di-blend dengan sempurna, menciptakan minuman yang segar dan memanjakan dengan cita rasa matcha yang autentik.\r\n', 'ready'),
(42, '39.jpg', 'Pure Matcha & Espresso Fusion', 25000, 4, 'Kombinasi segar antara teh matcha premium dan espresso yang kuat, menciptakan minuman yang menyegarkan dengan rasa yang unik dan kompleks.\r\n', 'ready'),
(43, '40.jpg', 'French Vanila Oatmilk Latte', 23000, 4, 'Campuran espresso yang halus dengan susu oat lembut dan sentuhan vanila yang lembut, menciptakan minuman yang lezat dengan cita rasa klasik yang memanjakan.\r\n', 'ready'),
(44, '41.jpg', 'French Vanila Oatmilk Frappuccino', 22000, 4, 'Campuran es krim lembut, susu oat yang lembut, dan sentuhan vanila yang lembut, menciptakan minuman yang segar dan memanjakan dengan cita rasa klasik yang memikat.\r\n', 'ready'),
(45, '42.jpg', 'Iced Strawberry Acia Lemonade', 22000, 4, 'Campuran acai berry yang segar, stroberi manis, dan lemonade segar, disajikan dingin dengan es, menciptakan minuman yang menyegarkan dan memanjakan dengan cita rasa buah yang khas.\r\n', 'ready'),
(46, '43.jpg', 'Iced Pink Drink Strawberry Acai', 24000, 4, 'Campuran acai berry yang segar, stroberi manis, dan susu kokos, disajikan dingin dengan es, menciptakan minuman yang menyegarkan dengan rasa yang manis dan lembut.\r\n', 'ready'),
(47, '44.jpg', 'Almond Caramel Latte', 23000, 4, 'Campuran espresso yang halus dengan susu almond yang lembut dan sirup caramel yang manis, menciptakan minuman yang memanjakan dengan sentuhan rasa yang lezat.\r\n', 'ready'),
(48, '45.jpg', 'Oatmilk Green Tea Latte', 22000, 4, 'Campuran teh hijau yang halus dengan susu oat yang lembut, menciptakan minuman yang menyegarkan dengan cita rasa yang lembut dan kaya akan manfaat bagi tubuh.\r\n', 'ready'),
(49, '46.jpg', 'Soy Milk Espresso Frappuccino Blended Coffe', 20000, 4, 'Campuran es krim, espresso, susu kedelai, dan es, menciptakan minuman segar dengan cita rasa kopi autentik.\r\n', 'ready'),
(50, '47.jpg', 'Vegan Fish sandwich', 24000, 4, 'Campuran bahan-bahan tumbuhan premium yang disajikan dalam roti, menciptakan pilihan santapan yang sehat dan ramah lingkungan, tanpa mengorbankan cita rasa autentik ikan.\r\n', 'ready'),
(51, '48.jpg', 'Vegan Cinnamon Spikoe Cookie', 23000, 4, 'Campuran bahan-bahan tumbuhan premium dengan sentuhan rempah-rempah kayu manis, menciptakan kue yang lezat dan beraroma, sempurna untuk dinikmati sebagai camilan yang menyenangkan.\r\n', 'ready'),
(52, '49.jpg', 'Blueberry Cheseecake Parfait', 23000, 4, 'Lapisan lembut keju krim dipadu dengan blueberry segar dan remah kue graham, menciptakan kombinasi yang sempurna antara manis dan asam dalam setiap suapan.\r\n', 'ready'),
(53, '50.jpg', 'Vienna Creamy Latte', 20000, 4, 'Campuran espresso yang halus dengan susu krim yang lembut, menciptakan minuman yang memanjakan dengan cita rasa klasik dan tekstur yang kaya.\r\n', 'ready'),
(54, '51.jpg', 'Vienna Creamy Frappuccino', 25000, 4, 'Campuran es krim lembut, espresso yang halus, susu krim yang lembut, dan es yang di-blend dengan sempurna, menciptakan minuman yang segar dan memanjakan dengan cita rasa klasik yang lezat dan tekstur yang kaya.\r\n', 'ready'),
(55, '52.jpg', 'Butter Croissant', 20000, 5, 'Lapisan renyah dan lembut yang dibuat dengan mentega berkualitas tinggi, menciptakan rasa dan tekstur yang sempurna untuk dinikmati sebagai camilan pagi atau sore yang memuaskan.\r\n', 'ready'),
(56, '53.jpg', 'Cinnamon Rolls', 21000, 5, 'Lapisan roti lembut yang dipadu dengan rempah-rempah kayu manis dan taburan gula, menciptakan camilan yang manis dan memuaskan untuk dinikmati bersama dengan secangkir kopi atau teh hangat.\r\n', 'ready'),
(57, '54.jpg', 'Peanut Butter Panini Sandwich', 20000, 5, 'Campuran lembut dari selai kacang yang kaya rasa, diberi tekanan ringan dan dipanggang hingga keemasan sempurna, menciptakan sajian yang memuaskan dengan cita rasa yang lezat dan tekstur yang renyah.\r\n', 'ready'),
(58, '55.jpg', 'Classic Dark Chocolate Cake', 25000, 5, 'Lapisan kue cokelat hitam yang lembut dan kaya akan rasa, disajikan dengan taburan bubuk kakao di atasnya, menciptakan pengalaman yang memikat bagi para pecinta cokelat.\r\n', 'ready'),
(59, '56.jpg', 'Raisin Oatmeal Scones', 23000, 5, 'Campuran oatmeal yang renyah, diberi sentuhan manis dari kismis, dipanggang hingga keemasan yang sempurna, menciptakan scone yang lezat dan memuaskan untuk dinikmati sebagai camilan pagi atau sore yang menyehatkan.\r\n', 'ready'),
(60, '57.jpg', 'Cheese Quiche', 23000, 5, 'Lapisan kue yang renyah, diisi dengan campuran telur yang lembut dan berbumbu, dicampur dengan keju yang melumer, menciptakan hidangan sarapan atau camilan yang memanjakan lidah.\r\n', 'ready'),
(61, '58.jpg', 'Chocolate Croisant', 24000, 5, 'Lapisan kue croissant yang renyah, diisi dengan lapisan cokelat yang lembut dan manis, menciptakan gabungan yang sempurna antara gurih dan manis untuk dinikmati sebagai camilan atau sarapan yang memuaskan.\r\n', 'ready'),
(62, '59.jpg', 'Via Red Velvet', 25000, 5, 'Kue yang lembut dengan cita rasa cokelat yang ringan, disajikan dengan taburan cream cheese frosting di atasnya, menciptakan pengalaman yang memanjakan untuk para pencinta kue.\r\n', 'ready'),
(63, '60.jpg', 'Beef Filone Sandwich', 24000, 5, 'Lapisan roti Filone yang lembut dan renyah, diisi dengan potongan daging sapi panggang yang lezat, sayuran segar, dan saus yang melengkapi, menciptakan sajian yang memuaskan untuk dinikmati sebagai santapan yang memuaskan dan bergizi.\r\n', 'ready'),
(64, '61.jpg', 'New York Cheese Cake', 26000, 5, 'Lapisan kue keju yang lembut dan kaya rasa, disajikan dengan lapisan topping atau buah-buahan segar, menciptakan pengalaman yang memuaskan bagi para pecinta cheesecake.\r\n', 'ready'),
(65, '62.jpg', 'Smoked Beef Quiche', 28000, 5, 'Lapisan kue yang renyah, diisi dengan campuran telur lembut yang berpadu dengan potongan daging sapi asap yang lezat, menciptakan hidangan yang memuaskan untuk dinikmati sebagai sarapan atau camilan yang bergizi.\r\n', 'ready'),
(66, '63.jpg', 'Scarlet Velvet Cake', 25000, 5, 'Lapisan kue lembut dengan warna merah yang khas, disajikan dengan frosting cream cheese yang lembut dan manis.\r\n', 'ready'),
(67, '64.jpg', 'Espresso Brownies', 25000, 5, 'Lapisan brownies yang kaya dan lembut, diisi dengan rasa kopi yang khas, menciptakan sajian yang memuaskan untuk dinikmati bersama dengan secangkir kopi atau teh.\r\n', 'ready'),
(68, '65.jpg', 'Smoked Beef Mushroom', 29000, 5, 'Potongan daging sapi asap yang lezat, disajikan dengan saus jamur yang kaya rasa dan bumbu-bumbu yang lezat, menciptakan hidangan yang memuaskan untuk dinikmati sebagai santapan yang bergizi dan memanjakan \r\n', 'ready'),
(69, '66.jpg', 'Classic Tuna Toastie', 28000, 5, 'Potongan roti panggang yang renyah, diisi dengan campuran tuna yang lembut dan berbumbu, serta irisan keju yang meleleh, menciptakan hidangan yang memuaskan untuk dinikmati sebagai camilan atau makanan ringan yang memikat.\r\n', 'ready'),
(70, '67.jpg', 'Almond Croisant', 27000, 5, 'Lapisan kue croissant yang lembut, dipadu dengan taburan irisan almond yang gurih dan manis, menciptakan paduan sempurna antara gurih dan manis untuk dinikmati sebagai camilan yang memuaskan.\r\n', 'ready'),
(71, '68.jpg', 'Cookies', 23000, 5, 'Campuran sempurna antara gurih dan manis, dengan tekstur yang renyah di luar dan lembut di dalam, menciptakan camilan yang memuaskan untuk dinikmati bersama dengan secangkir kopi atau teh.\r\n', 'ready'),
(72, '69.jpg', 'Tuna Cheese Oat Panini', 29000, 5, 'Campuran tuna yang lembut dan berbumbu, disajikan dengan keju yang meleleh dan roti oat yang renyah, menciptakan paduan yang lezat dan bergizi untuk dinikmati sebagai santapan yang memuaskan.\r\n', 'ready'),
(73, '70.jpg', 'Cromboloni Choco', 26000, 5, 'Lapisan kue yang renyah dan berbentuk bola, diisi dengan cokelat lezat yang meleleh di dalamnya, menciptakan camilan yang manis dan memanjakan untuk dinikmati kapan saja.\r\n', 'ready'),
(74, '71.jpg', 'Danish Caramel Crumble', 25000, 5, 'Kue Danish lembut dengan crumble caramel yang gurih di atasnya.\r\n', 'ready'),
(75, '72.jpg', 'Pain Au Choco', 26000, 5, 'Lapisan roti croissant yang renyah, diisi dengan taburan cokelat lezat di dalamnya, menciptakan camilan yang memanjakan dengan cita rasa yang memikat.\r\n', 'ready'),
(76, '73.jpg', 'Danish Vanila Chesee', 26000, 5, 'Lapisan kue Danish yang lembut dan berlapis-lapis, diisi dengan lapisan keju vanilla yang lembut dan manis di tengahnya, menciptakan paduan yang sempurna antara manis dan gurih untuk dinikmati sebagai camilan yang memuaskan.\r\n', 'ready'),
(77, '74.jpg', 'Waffle Classic Sugar', 23000, 6, 'Waffle yang renyah di luar dan lembut di dalamnya, disajikan dengan taburan gula yang manis, menciptakan camilan yang memuaskan untuk dinikmati sebagai sajian ringan yang menggugah selera.\r\n', 'ready'),
(78, '75.jpg', 'Waffle Choki Choki Chesse', 23000, 6, 'Waffle yang renyah dan lembut, diisi dengan taburan cokelat Choki-Choki yang lezat dan lapisan keju yang melumer di atasnya, menciptakan paduan manis dan gurih yang memanjakan lidah.\r\n', 'ready'),
(79, '76.jpg', 'Waffle Tiramisu Oreo', 23000, 6, 'Waffle yang renyah dan lembut, disajikan dengan taburan crumble Oreo yang gurih dan lapisan tiramisu yang lezat, menciptakan paduan yang menggoda antara cita rasa kopi, cokelat, dan kelembutan waffle.\r\n', 'ready'),
(80, '77.jpg', 'Waffle Greentea Almond', 23000, 6, 'Waffle yang renyah, disajikan dengan taburan bubuk green tea yang lembut dan irisan almond yang gurih, menciptakan paduan yang unik dan menyenangkan untuk dinikmati sebagai camilan yang segar dan memuaskan.\r\n', 'ready'),
(81, '78.jpg', 'Waffle Strawberry Icing Sugar', 23000, 6, 'Waffle yang renyah, disajikan dengan taburan gula icing manis dan potongan stroberi segar di atasnya, menciptakan paduan yang segar dan memuaskan untuk dinikmati sebagai camilan yang menyenangkan.\r\n', 'ready'),
(82, '79.jpg', 'Waffle Nutella Orange', 23000, 6, 'Waffle yang renyah, disajikan dengan lapisan Nutella yang lezat dan irisan jeruk segar, menciptakan paduan yang manis dan segar untuk dinikmati sebagai camilan yang memuaskan.\r\n', 'ready'),
(83, '80.jpg', 'Waffle White Dancow', 23000, 6, 'Waffle yang renyah, disajikan dengan lapisan susu Dancow yang lembut dan manis, menciptakan camilan yang menyenangkan dan memuaskan untuk dinikmati bersama dengan keluarga atau teman.\r\n', 'ready'),
(84, '81.jpg', 'French Fries', 20000, 7, 'Potongan kentang yang dipanggang dengan sempurna hingga keemasan, disajikan dengan taburan garam dan rempah pilihan, menciptakan camilan yang renyah di luar dan lembut di dalam untuk dinikmati kapan saja.\r\n', 'ready'),
(85, '82.jpg', 'Onion Ring', 23000, 7, 'Potongan bawang yang dilapisi tepung dan digoreng hingga keemasan, menciptakan camilan yang renyah di luar dan lembut di dalam, sempurna untuk dinikmati sebagai pelengkap hidangan atau camilan ringan.\r\n', 'ready'),
(86, '83.jpg', 'Tahu Cabe Garam', 20000, 7, 'Potongan tahu yang dipanggang atau digoreng hingga kecokelatan, disajikan dengan taburan cabe dan garam yang memberikan cita rasa pedas dan gurih, menciptakan camilan yang lezat dan memikat untuk dinikmati bersama dengan saus favorit Anda.\r\n', 'ready'),
(87, '84.jpg', 'Beef Crouquette Stuffed', 24000, 7, 'Campuran daging sapi lezat dan bumbu-bumbu dalam lapisan tepung roti yang renyah, menciptakan camilan yang memuaskan dengan cita rasa yang kaya dan tekstur yang gurih di setiap gigitannya.\r\n', 'ready'),
(88, '85.jpg', 'Tahu Baso', 20000, 7, 'Tahu segar dengan bakso lezat di dalamnya, disajikan dengan saus pedas.\r\n', 'ready'),
(89, '86.jpg', 'Spring Roll', 20000, 7, 'Campuran sayuran segar, dan daging yang dibungkus dengan kulit lumpia yang renyah, disajikan dengan saus gurih atau saus pedas, menciptakan camilan yang memuaskan untuk dinikmati kapan saja.\r\n', 'ready'),
(90, '87.jpg', 'Mix Platter', 30000, 7, 'Kombinasi lezat antara Spring Roll renyah, Tahu Baso gurih, dan pilihan jajanan lainnya, disajikan dengan saus-saus yang memikat, menciptakan hidangan yang memuaskan untuk dinikmati bersama teman atau keluarga.\r\n', 'ready'),
(91, '88.jpg', 'Pisang Coklat', 22000, 7, 'Potongan pisang yang dibalut dengan lapisan cokelat leleh yang lezat, menciptakan camilan yang memuaskan untuk dinikmati sebagai penutup atau camilan manis di setiap waktu.\r\n', 'ready'),
(92, '89.jpg', 'Wedges Potato Poutine', 22000, 7, 'Potongan kentang wedges dengan saus gravy dan keju meleleh.\r\n', 'ready'),
(93, '90.jpg', 'Nachos', 22000, 7, 'Keripik jagung yang disajikan dengan lapisan keju meleleh, saus salsa segar, dan potongan alpukat yang segar, menciptakan camilan yang memuaskan dengan cita rasa yang kaya dan tekstur yang menggugah selera.\r\n', 'ready'),
(94, '91.jpg', 'Barbeque Chiken Wings', 30000, 7, 'Sayap ayam yang digoreng hingga keemasan dan diselimuti dengan saus barbeque yang kaya rasa, menciptakan camilan yang memuaskan dengan cita rasa yang menggugah selera dan aroma yang menggiurkan.\r\n', 'ready'),
(95, '92.jpg', 'Spicy Chiken Wings', 30000, 7, 'Sayap ayam yang digoreng hingga keemasan dan diselimuti dengan saus pedas yang memikat, menciptakan camilan yang memuaskan dengan cita rasa yang intens dan sensasi pedas yang menggugah selera.\r\n', 'ready'),
(96, '93.jpg', 'Apple Pie Crumble', 28000, 8, 'Potongan apel yang manis dan berbumbu, diselimuti dengan lapisan crumble gurih dan dipanggang hingga keemasan, menciptakan sajian yang memanjakan dengan rasa dan tekstur yang sempurna untuk dinikmati sebagai penutup yang memuaskan.\r\n', 'ready'),
(97, '94.jpg', 'Classic Tiramisu', 32000, 8, 'Lapisan kue ladyfinger yang direndam dalam kopi dan likuer, diselimuti dengan lapisan krim keju mascarpone yang lembut, dicampur dengan bubuk kakao, menciptakan penutup yang memanjakan dengan rasa yang lezat dan tekstur yang lembut.\r\n', 'ready'),
(98, '95.jpg', 'Ice Cream Vanilla (cone)', 10000, 8, 'Eskrim vanilla lembut yang disajikan dalam cone crispy yang gurih, menciptakan camilan yang menyegarkan dan memanjakan dengan cita rasa klasik yang memikat.\r\n', 'ready'),
(99, '96.jpg', 'Ice Cream Vanilla (cup)', 10000, 8, 'Eskrim vanilla lembut yang disajikan dalam cup, menciptakan pengalaman yang memanjakan dengan cita rasa klasik yang memikat.\r\n', 'ready'),
(100, '97.jpg', 'Vanilla Oreo Pudding', 15000, 8, 'Puding vanilla lembut yang diselimuti dengan lapisan remah-remah biskuit Oreo yang renyah dan lezat, menciptakan kombinasi yang sempurna antara manis dan gurih untuk dinikmati sebagai penutup yang memuaskan.\r\n', 'ready'),
(101, '98.jpg', 'Lotus Sundae', 15000, 8, 'Eskrim vanilla lembut yang disajikan dengan taburan crumble biskuit Lotus yang gurih dan saus caramel yang manis, menciptakan kombinasi yang kaya dan memuaskan untuk dinikmati sebagai penutup yang menggugah selera.\r\n', 'ready'),
(102, '99.jpg', 'Strawberry Sundae', 15000, 8, 'Eskrim vanilla lembut yang disajikan dengan taburan potongan stroberi segar dan saus strawberry yang manis, menciptakan paduan yang menyegarkan dan memuaskan untuk dinikmati sebagai penutup yang memanjakan.\r\n', 'ready'),
(103, '100.jpg', 'Chocolate Sundae', 15000, 8, 'Eskrim vanilla lembut yang disajikan dengan saus cokelat lezat, taburan almond panggang, dan cherry ceri manis, menciptakan hidangan penutup yang memanjakan dengan cita rasa klasik yang memikat.\r\n', 'ready');

-- --------------------------------------------------------

--
-- Table structure for table `barang_dibeli`
--

CREATE TABLE `barang_dibeli` (
  `id_pembelian` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_dibeli`
--

INSERT INTO `barang_dibeli` (`id_pembelian`, `id_barang`, `jumlah`) VALUES
(29, 8, 1),
(29, 7, 1),
(30, 87, 1),
(30, 89, 1),
(31, 57, 4),
(31, 60, 3),
(32, 7, 9),
(33, 45, 1),
(34, 29, 1),
(35, 4, 1),
(35, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `id_user`, `id_barang`, `jumlah`) VALUES
(45, '1234', 101, 1),
(58, '1234', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'coffee'),
(2, 'non coffee'),
(3, 'frappuccino'),
(4, 'seasional item'),
(5, 'food'),
(6, 'wafle'),
(7, 'snack'),
(8, 'desert');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `id_user` varchar(20) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `pemesanan_makanan` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `id_user`, `nama`, `phone`, `alamat`, `pemesanan_makanan`, `status`) VALUES
(1, '0812345678', 'Ahmad Wildan', '0812345678', 'Malang', 'delivery', 'completed'),
(29, '0812345678', 'Ahmad Wildan', '', '', 'dine in', 'completed'),
(30, '0812345678', 'Ahmad Wildan', '0812345678', 'Malang', 'delivery', 'in process'),
(31, '0812345678', 'Ahmad Wildan', '', '', 'take away', 'in process'),
(32, '0812345678', 'Ahmad Wildan', '0812345678', 'Malang', 'delivery', 'in process'),
(33, '0812345678', 'Ahmad Wildan', '', '', 'dine in', 'in process'),
(34, '0812345678', 'Ahmad Wildan', '', '', 'take away', 'in process'),
(35, '0812345678', 'Ahmad Wildan', '0812345678', 'Malang', 'delivery', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `id_pembelian`, `id_user`, `id_barang`, `rating`, `comment`) VALUES
(1, 1, '0812345678', 14, 4, 'Cappucino enak worth it banget buat harga segini!'),
(14, 29, '0812345678', 8, 4, 'Beta Review'),
(15, 33, '0812345678', 8, 3, 'Beta Review');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `phone` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `role` varchar(25) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`phone`, `username`, `password`, `alamat`, `role`) VALUES
('0812345678', 'Ahmad Wildan', '$2y$10$t5AnaLsfDyiK6ceO/Frsy.rTbX1x5iRtO1NQRqR7PMEqXWtM9kd4u', 'Malang', 'user'),
('123', '123', '$2y$10$XVgcPYOpP/JpFVV3c1AOAe2AXuIi81r4v8rH7zSN5VSC4jxhD5P4e', '', 'user'),
('1234', '1234', '$2y$10$V1DTrsgPEhGxvQ/Z0Dqfm.wojon3COeoYCHH9Iz.e1QE3jCrf7pZC', 'Lawang', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `barang_dibeli`
--
ALTER TABLE `barang_dibeli`
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `barang_dibeli`
--
ALTER TABLE `barang_dibeli`
  ADD CONSTRAINT `barang_dibeli_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`),
  ADD CONSTRAINT `barang_dibeli_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`phone`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`phone`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`phone`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




CREATE DATABASE shop_db1 CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci;
USE shop_db1;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `gia` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `mota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


INSERT INTO `sanpham` (`id`, `tensp`, `gia`, `soluong`, `mota`) VALUES
(1, 'Iphone 13', 20000000, 10, 'Iphone 13 128GB'),
(2, 'Samsung Galaxy S21', 15000000, 10, 'Samsung Galaxy S21 128GB'),
(3, 'Xiaomi Redmi Note 10', 5000000, 10, 'Xiaomi Redmi Note 10 64GB'),
(4, 'Oppo A94', 7000000, 10, 'Oppo A94 128GB'),
(5, 'Vivo Y20', 4000000, 10, 'Vivo Y20 64GB'),
(6, 'Realme 8', 6000000, 10, 'Realme 8 128GB'),
(7, 'Nokia 5.4', 3000000, 10, 'Nokia 5.4 64GB'),
(8, 'Huawei Y7a', 3500000, 10, 'Huawei Y7a 64GB'),
(9, 'Sony Xperia 10 II', 8000000, 10, 'Sony Xperia 10 II 128GB'),
(10, 'Asus Zenfone 8', 9000000, 10, 'Asus Zenfone 8 128GB');


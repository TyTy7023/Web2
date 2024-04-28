DROP TABLE IF EXISTS product;
CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `product` (`id`, `name`,`category`, `price`, `image`, `product_detail`) VALUES
('1', 'Iphone 13', 'tea', 200, 'card2.jpg', 'Iphone 13 128GB'),
('2', 'Samsung Galaxy S21', 'tea', 150, 'card2.jpg' , 'Samsung Galaxy S21 128GB'),
('3', 'Xiaomi Redmi Note 10', 'tea', 500, 'card2.jpg', 'Xiaomi Redmi Note 10 64GB'),
('4', 'Oppo A94', 'tea', 700, 'card2.jpg', 'Oppo A94 128GB'),
('5', 'Vivo Y20', 'tea', 400, 'card2.jpg', 'Vivo Y20 64GB'),
('6', 'Realme 8', 'coffee', 600, 'card2.jpg', 'Realme 8 128GB'),
('7', 'Nokia 5.4', 'coffee', 300, 'card2.jpg', 'Nokia 5.4 64GB'),
('8', 'Huawei Y7a', 'coffee', 300, 'card2.jpg', 'Huawei Y7a 64GB'),
('9', 'Sony Xperia 10 II', 'coffee', 80, 'card2.jpg', 'Sony Xperia 10 II 128GB'),
('10', 'Asus Zenfone 8', 'coffee', 900, 'card2.jpg', 'Asus Zenfone 8 128GB'),
('11', 'Google Pixel 5', 'tea', 700, 'card2.jpg', 'Google Pixel 5 128GB'),
('12', 'OnePlus 9', 'tea', 800, 'card2.jpg', 'OnePlus 9 256GB'),
('13', 'LG Velvet', 'tea', 600, 'card2.jpg', 'LG Velvet 128GB'),
('14', 'Motorola Moto G Power', 'tea', 250, 'card2.jpg', 'Motorola Moto G Power 64GB'),
('15', 'BlackBerry Key2', 'tea', 400, 'card2.jpg', 'BlackBerry Key2 64GB'),
('16', 'HTC Desire 21 Pro', 'coffee', 350, 'card2.jpg', 'HTC Desire 21 Pro 128GB'),
('17', 'Lenovo Legion Duel 2', 'coffee', 1000, 'card2.jpg', 'Lenovo Legion Duel 2 256GB'),
('18', 'ZTE Axon 30 Ultra', 'coffee', 900, 'card2.jpg', 'ZTE Axon 30 Ultra 128GB'),
('19', 'Alcatel 3X', 'coffee', 200, 'card2.jpg', 'Alcatel 3X 64GB'),
('20', 'TCL 20 Pro 5G', 'coffee', 400, 'card2.jpg', 'TCL 20 Pro 5G 128GB'),
('21', 'Nubia Red Magic 6', 'tea', 850, 'card2.jpg', 'Nubia Red Magic 6 256GB'),
('22', 'Poco X3 Pro', 'tea', 300, 'card2.jpg', 'Poco X3 Pro 128GB'),
('23', 'Redmi Note 10 Pro', 'tea', 400, 'card2.jpg', 'Redmi Note 10 Pro 128GB'),
('24', 'Realme Narzo 30 Pro', 'tea', 350, 'card2.jpg', 'Realme Narzo 30 Pro 128GB'),
('25', 'Infinix Note 10 Pro', 'tea', 250, 'card2.jpg', 'Infinix Note 10 Pro 128GB'),
('26', 'Tecno Camon 17 Pro', 'tea', 200, 'card2.jpg', 'Tecno Camon 17 Pro 128GB'),
('27', 'Samsung Galaxy A52', 'tea', 500, 'card2.jpg', 'Samsung Galaxy A52 128GB'),
('28', 'Apple iPhone SE (2020)', 'tea', 450, 'card2.jpg', 'Apple iPhone SE (2020) 128GB'),
('29', 'Google Pixel 4a', 'tea', 350, 'card2.jpg', 'Google Pixel 4a 128GB'),
('30', 'OnePlus Nord N10', 'tea', 300, 'card2.jpg', 'OnePlus Nord N10 128GB'),
('31', 'LG K92 5G', 'tea', 200, 'card2.jpg', 'LG K92 5G 128GB'),
('32', 'Motorola Moto G Stylus', 'tea', 250, 'card2.jpg', 'Motorola Moto G Stylus 128GB'),
('33', 'BlackBerry KEYone', 'tea', 300, 'card2.jpg', 'BlackBerry KEYone 128GB'),
('34', 'HTC U12+', 'tea', 400, 'card2.jpg', 'HTC U12+ 128GB'),
('35', 'Lenovo Legion Duel', 'tea', 900, 'card2.jpg', 'Lenovo Legion Duel 128GB'),
('36', 'ZTE Axon 20', 'tea', 600, 'card2.jpg', 'ZTE Axon 20 128GB'),
('37', 'Alcatel 1SE', 'tea', 150, 'card2.jpg', 'Alcatel 1SE 128GB'),
('38', 'TCL 10 5G UW', 'tea', 400, 'card2.jpg', 'TCL 10 5G UW 128GB'),
('39', 'Nubia Red Magic 5G', 'tea', 700, 'card2.jpg', 'Nubia Red Magic 5G 128GB'),
('40', 'Poco M3', 'tea', 200, 'card2.jpg', 'Poco M3 128GB'),
('41', 'Redmi Note 9 Pro', 'tea', 250, 'card2.jpg', 'Redmi Note 9 Pro 128GB'),
('42', 'Realme X50 5G', 'tea', 350, 'card2.jpg', 'Realme X50 5G 128GB'),
('43', 'Infinix Hot 10', 'tea', 150, 'card2.jpg', 'Infinix Hot 10 128GB'),
('44', 'Tecno Spark 7 Pro', 'tea', 100, 'card2.jpg', 'Tecno Spark 7 Pro 128GB'),
('45', 'Samsung Galaxy A12', 'tea', 200, 'card2.jpg', 'Samsung Galaxy A12 128GB'),
('46', 'Apple iPhone 12 Mini', 'tea', 700, 'card2.jpg', 'Apple iPhone 12 Mini 128GB'),
('47', 'Google Pixel 3a', 'tea', 400, 'card2.jpg', 'Google Pixel 3a 128GB'),
('48', 'OnePlus 8T', 'tea', 600, 'card2.jpg', 'OnePlus 8T 128GB'),
('49', 'LG V60 ThinQ', 'tea', 500, 'card2.jpg', 'LG V60 ThinQ 128GB'),
('50', 'Motorola Moto G Fast', 'tea', 150, 'card2.jpg', 'Motorola Moto G Fast 128GB');


DROP TABLE IF EXISTS wishlist;
CREATE TABLE `wishlist` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS cart;
CREATE TABLE `cart` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `qty` BIGINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS orders;
CREATE TABLE `orders` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `qty` BIGINT NOT NULL,
  `date` DATE NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

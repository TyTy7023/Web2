DROP TABLE IF EXISTS product;
CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `product` (`id`, `name`, `price`, `image`, `product_detail`) VALUES
('1', 'Iphone 13', 20000000, '3.png', 'Iphone 13 128GB'),
('2', 'Samsung Galaxy S21', 15000000, '0.jpg' , 'Samsung Galaxy S21 128GB'),
('3', 'Xiaomi Redmi Note 10', 5000000, '1.jpg', 'Xiaomi Redmi Note 10 64GB'),
('4', 'Oppo A94', 7000000, '2.jpg', 'Oppo A94 128GB'),
('5', 'Vivo Y20', 4000000, '3.png', 'Vivo Y20 64GB'),
('6', 'Realme 8', 6000000, '04.png', 'Realme 8 128GB'),
('7', 'Nokia 5.4', 3000000, '6.jpg', 'Nokia 5.4 64GB'),
('8', 'Huawei Y7a', 3500000, '7.jpg', 'Huawei Y7a 64GB'),
('9', 'Sony Xperia 10 II', 8000000, '6.jpg', 'Sony Xperia 10 II 128GB'),
('10', 'Asus Zenfone 8', 9000000, '6.jpg', 'Asus Zenfone 8 128GB');

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

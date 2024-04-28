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
('1', 'PEACH TEA', 'TEA', 51, '01.png', 'Black tea, synthetic flavoring: peach flavor'),
('2', 'LITCHI TEA', 'TEA', 52, '02.png' , 'Black tea, synthetic flavoring: fabric flavor'),
('3', 'STRAWBERRY TEA', 'TEA', 53, '03.png', 'Black tea, synthetic flavoring: strawberry flavor'),
('4', 'APPLE TEA', 'TEA', 54, '04.png', 'Black tea, synthetic flavoring: apple flavor'),
('5', 'CINNAMON TEA', 'TEA', 55, '05.png', 'Black tea, synthetic flavoring: cinnamon flavor'),
('6', 'SOURSOP TEA', 'TEA', 56, '06.png', 'Black tea, synthetic flavoring: custard apple flavor'),
('7', 'CHRYSANTHEMUM TEA', 'TEA', 57, '07.png', 'Green tea (70%), chamomile (30%)'),
('8', 'GREEN TEA', 'TEA', 58, '08.png', '100% green tea leaves'),
('9', 'LOTUS TEA', 'TEA', 59, '09.png', 'Green tea and synthetic flavorings: lotus aroma'),
('10', 'JASMINE TEA', 'TEA', 60, '10.png', 'Green tea and natural jasmine'),
('11', 'Coconut Latte Coffee', 'COFFEE', 60, '11.jpg', 'The taste of milk coffee is rich, sweet and the aromatic coconut flavor is extremely attractive'),
('12', 'Hazelnut Latte Coffee ', 'COFFEE', 60, '12.jpg', 'Stylish latte coffee and almond milk'),
('13', 'Almond Latte Coffee', 'COFFEE', 60, '13.jpg', 'Stylish coffee latte and smooth almond milk'),
('14', 'NesCafé 3 in 1 Coffee', 'COFFEE', 60, '14.jpg', 'From 100% high quality Vietnamese coffee beans'),
('15', 'NesCafé 3 in 1 milk coffee is rich and harmonious', 'COFFEE', 60, '15.jpg', 'Roasted coffee and instant coffee with fatty milk flavor'),
('16', 'NesCafé instant milk coffee 3 in 1 harmonious taste, not sweet', 'COFFEE', 60, '16.jpg', 'Combination with Robusta seeds and Central Highlands Arabica'),
('17', 'NesCafé iced milk coffee doubles', 'COFFEE', 60, '17.jpg', 'Made from 100% quality Vietnamese coffee beans'),
('18', 'NesCafé Café Viet Iced Black Coffee', 'COFFEE', 60, '18.jpg', 'Made from 100% quality Vietnamese coffee beans'),
('19', 'NesCafé Red Cup Black Coffee', 'COFFEE', 60, '19.jpg', 'Roasted coffee puree combined with instant coffee'),
('20', 'NesCafé Black Coffee Juice', 'COFFEE', 60, '20.jpg','Splash the amount like drip coffee'),
('21', 'Natsu Matcha Green Tea Powder', 'MATCHA', 60, '21.jpg', 'Made from 100% pure green tea leaves'),
('22', 'Cozy Matcha Milk Tea', 'MATCHA', 60, '22.jpg', 'Natural green tea essence with Japanese matcha green tea powder'),
('23', 'Blendy Milk Matcha Tea', 'MATCHA', 60, '23.jpg', 'Combination of Japanese Matcha tea and milk'),
('24', 'Chasen Broom Beats Matcha', 'MATCHA', 60, '24.jpg', 'Extremely important and necessary tools');

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

DROP TABLE IF EXISTS product;
CREATE TABLE `product` (
  `id` varchar(255) NOT NULL,
  primary key(id),
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_detail` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `product` (`id`, `name`,`category`, `price`, `image`, `product_detail`,`status`) VALUES
('1', 'PEACH TEA', 'TEA', 51, '01.png', 'Ingredients: Black tea, synthetic flavoring: peach flavor. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('2', 'LITCHI TEA', 'TEA', 52, '02.png' , 'Ingredients: Black tea, synthetic flavoring: fabric flavor. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('3', 'STRAWBERRY TEA', 'TEA', 53, '03.png', 'Ingredients: Black tea, synthetic flavoring: strawberry flavor. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('4', 'APPLE TEA', 'TEA', 54, '04.png', 'Ingredients: Black tea, synthetic flavoring: apple flavor. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('32', 'PREMIUM GREEN COFFEE BEANS POWER ', 'TEA', 56, '32.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('33', 'BKB MATCHA MILK TEA POWDER', 'TEA', 75, '33.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('34', 'MATCHA TEA', 'TEA',90, '34.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('5', 'CINNAMON TEA', 'TEA', 55, '05.png', 'Ingredients: Black tea, synthetic flavoring: cinnamon flavor. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('6', 'SOURSOP TEA', 'TEA', 56, '06.png', 'Ingredients: Black tea, synthetic flavoring: custard apple flavor. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('7', 'CHRYSANTHEMUM TEA', 'TEA', 57, '07.png', 'Ingredients: Green tea (70%), chamomile (30%). Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('8', 'GREEN TEA', 'TEA', 58, '08.png', 'Ingredients: 100% green tea leaves. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('9', 'LOTUS TEA', 'TEA', 59, '09.png', 'Ingredients: Green tea and synthetic flavorings: lotus aroma. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('10', 'JASMINE TEA', 'TEA', 60, '10.png', 'Ingredients: Green tea and natural jasmine. Product Information: Produced from selected fresh tea buds, picked and processed according to strict technical processes, blended with attractive peach aroma for a pure fragrance to help the spirit awake, relax and purify. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste','active'),
('11', 'Coconut Latte Coffee', 'COFFEE', 60, '11.jpg', 'Product information: NesCafé Latte coffee with a new coconut flavor, adding richness from pureed roasted coffee to bring a delicate coffee taste, true European style. Nescafé instant coffee has a rich, sweet milk coffee flavor and an extremely attractive fatty coconut flavor. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('12', 'Hazelnut Latte Coffee ', 'COFFEE', 60, '12.jpg', 'Product information: It is a blend of stylish coffee latte and smooth, nutritious almond milk, not only bringing an irresistible delicious coffee experience, but also adding nutrition, awakening energy, alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('43', 'NATURALBIO MATCHA', 'TEA', 55, '43.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('44', 'NESTEA MATCHA', 'TEA', 88, '44.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('45', 'ORAGNIC JAPANESE MATCHA', 'TEA', 44, '45.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('46', 'PREMIUM GREEN COFFEE BEANS POWER', 'TEA', 75, '46.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('13', 'Almond Latte Coffee', 'COFFEE', 60, '13.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('14', 'NesCafé 3 in 1 Coffee', 'COFFEE', 60, '14.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('15', 'NesCafé 3 in 1 milk coffee is rich and harmonious', 'COFFEE', 60, '15.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('16', 'NesCafé instant milk coffee 3 in 1 harmonious taste, not sweet', 'COFFEE', 60, '16.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('37', 'AIK CHEONG MATCHA', 'TEA', 44, '37.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('38', 'GRA SOLA MATCHA', 'TEA', 88, '38.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('39', 'MAYA MATCHA', 'TEA', 45, '39.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('40', 'PURECHIMP MATCHA GREEN TEA', 'TEA', 102, '40.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('17', 'NesCafé iced milk coffee doubles', 'COFFEE', 60, '17.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('18', 'NesCafé Café Viet Iced Black Coffee', 'COFFEE', 60, '18.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('19', 'NesCafé Red Cup Black Coffee', 'COFFEE', 60, '19.jpg', 'Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('20', 'NesCafé Black Coffee Juice', 'COFFEE', 60, '20.jpg','Product information: The blend of stylish latte coffee and smooth, nutritious almond milk not only brings an irresistible delicious coffee experience, but also adds nutrition, awakens energy, and alertness to start a new day effectively. Instructions: With 1 packet of Nescafé instant coffee, add about 100ml of hot water (approx. 85°C) and stir thoroughly. Wait 20 seconds then stir again for the cream foam to rise and enjoy. It is possible to add ice, stir well and enjoy.','active'),
('21', 'PREMIUM FRUIT TEA', 'TEA', 60, '21.png', 'Ingredients: Black tea, hibiscus flowers, dried apples, blueberries, yellow grapes, orange peel, lemon peel, rose petals, food flavoring: blueberry flavor, vanilla flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('22', 'YELLOW LABEL TEA', 'TEA', 60, '22.png', 'Ingredients: Black tea, hibiscus flowers, dried apples, blueberries, yellow grapes, orange peel, lemon peel, rose petals, food flavoring: blueberry flavor, vanilla flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('23', 'HERBAL GINGER TEA', 'TEA', 60, '23.png', 'Ingredients: Ginger root (52% ), South African Red Tea (Rooibos ), chamomile, licorice, lemongrass. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('31', 'SHENCHA EVERY DAY MATCHA', 'TEA', 57, '31.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('35', 'MATCHA SARA SARA ATOUEN', 'TEA', 65, '35.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('36', 'COZY MATCHA MILK TEA POWDER', 'TEA', 35, '36.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('41', 'HEAPWELL JAPANESE MATCHA TEA', 'TEA', 88, '41.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('24', 'PEPPERMINT TEA', 'TEA', 60, '24.png', 'Ingredients: Black tea, synthetic flavoring: mint flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('25', 'PINEAPPLE GINSENG TEA', 'TEA', 60, '25.png', 'Ingredients: Ginger root (52% ), South African Red Tea (Rooibos ), chamomile, licorice, lemongrass. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('26', 'RED TEA', 'TEA', 60, '26.png', 'Ingredients: Black tea, synthetic flavoring: mint flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('27', 'TAM MA JASMINE TEA', 'TEA', 60, '27.png', 'Ingredients: Black tea, synthetic flavoring: mint flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('28', 'OOLONG TEA', 'TEA', 60, '28.png', 'Ingredients: 100% Oolong Tea, synthetic flavoring: mint flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('29', 'BLACK TEA', 'TEA', 60, '29.png', 'Ingredients: Black tea, synthetic flavoring: mint flavor. Product Information: Made from 100% pure green tea leaves. Preparation instructions: Put 1 filter bag in a cup or kettle. Pour boiling water and steep the tea for 4-5 minutes. You can add sugar, milk, drink hot or give ice cubes depending on taste.','active'),
('30', 'GREEN COFFEE BEAN POWER', 'TEA', 62, '30.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('42', 'WIL MATCHA MILK TEA POWER', 'TEA', 77, '42.webp', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active'),
('47', 'GREEN COFFEE BEANS', 'TEA', 85, '47.jpg', 'Ingredients: Matcha green tea powder. Product Information: Made from high-quality matcha green tea leaves, this matcha tea offers a rich and vibrant flavor with a smooth texture. Preparation instructions: Mix 1 teaspoon of matcha powder with hot water (about 70-80°C) in a bowl. Whisk until frothy. Adjust the amount of matcha and water according to your preference. Enjoy hot or iced.','active');

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  primary key(id),
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS wishlist;
CREATE TABLE `wishlist` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  primary key(id),
  foreign key (product_id) references product(id),
  foreign key (user_id) references users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS cart;
CREATE TABLE `cart` (
  `id` varchar(255) NOT NULL,
  primary key(id),
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `qty` BIGINT NOT NULL,
  foreign key (product_id) references product(id),
  foreign key (user_id) references users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS orders;
CREATE TABLE `orders` (
  `id` varchar(255) NOT NULL,
  
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_type` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` BIGINT NOT NULL,
  `qty` BIGINT NOT NULL,
  `date` DATE NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'In process',
  foreign key (product_id) references product(id),
  foreign key (user_id) references users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS admin;
CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  primary key(id),
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT '01.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS contact;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  primary key(id),
  `name` varchar(50) NOT NULL,
  
  `email` varchar(100) NOT NULL,
  `number` int(11) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


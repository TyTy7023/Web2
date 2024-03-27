CREATE DATABASE shop_db CHARACTER SET utf8 COLLATE utf8_general_ci;

use shop_db;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE sanpham
(
    id INT(11) NOT NULL AUTO_INCREMENT,
    tensp VARCHAR(255) NOT NULL,
    gia INT(11) NOT NULL,
    soluong INT(11) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

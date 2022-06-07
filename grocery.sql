-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Maj 2022, 14:06
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `grocery`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'Palna', 'palna'),
(2, 'Diya', 'diya'),
(3, 'Kunj', 'kunj'),
(4, 'michal', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_qty` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `cart`
--

INSERT INTO `cart` (`id`, `cat_id`, `user_id`, `product_id`, `cart_qty`) VALUES
(1, 1, 1, 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart_orders`
--

CREATE TABLE `cart_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `c_id` varchar(255) NOT NULL,
  `p_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `paymode` varchar(255) DEFAULT NULL,
  `pay_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `cart_orders`
--

INSERT INTO `cart_orders` (`id`, `user_id`, `c_id`, `p_id`, `quantity`, `amount`, `fname`, `lname`, `address`, `contact`, `paymode`, `pay_status`) VALUES
(2, 1, '1', '1', '4', '72', '3123', '3123', '133', '1233', 'Pay On Delivery', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Fruits', 1),
(2, 'Veggies', 1),
(3, 'Pulses', 1),
(4, 'Grains and Flours', 1),
(5, 'Spices', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `customer`
--

INSERT INTO `customer` (`Id`, `FirstName`, `LastName`, `Email`, `Password`, `Gender`, `Address`, `City`, `Contact`) VALUES
(1, 'admin', 'admin', 'admin@wp.pl', 'admin', 'Female', '', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `paymode` varchar(255) DEFAULT NULL,
  `pay_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `status`) VALUES
(1, 1, 'Banana', 20, 18, '46', 'bananas.jpg', 1),
(2, 1, 'Orange', 40, 37, '50', 'oranges.jpg', 1),
(3, 1, 'Watermalon', 30, 25, '50', 'watermelon.jpg', 1),
(4, 1, 'Apple', 94, 90, '50', 'apple.jpg', 1),
(5, 1, 'Kiwi', 80, 70, '50', 'kiwi.jpg', 1),
(6, 1, 'Mango', 300, 275, '50', 'mango.jpg', 1),
(7, 1, 'Pomogranate', 100, 95, '50', 'pomogranate.jpg', 1),
(8, 1, 'Strawberry', 150, 125, '50', 'strawberry.jpg', 1),
(9, 1, 'Chickoo', 80, 75, '50', 'chickoo.jpg', 1),
(10, 1, 'Guava', 80, 78, '50', 'guava.jpg', 1),
(11, 1, 'Papaya', 90, 80, '50', 'papaya.jpg', 1),
(12, 1, 'Pineapple', 50, 45, '50', 'pineapple.jpg', 1),
(13, 2, 'Carrot', 40, 38, '50', 'carrot.jpg', 1),
(14, 2, 'Brocolli', 110, 100, '50', 'brocolli.jpg', 1),
(15, 2, 'Cauliflower', 86, 80, '50', 'Cauliflower.jpg', 1),
(16, 2, 'Cucumber', 40, 35, '50', 'cucumber.jpg', 1),
(17, 2, 'Brinjal', 45, 40, '50', 'brinjal.jpg', 1),
(18, 2, 'Green Chilli', 45, 40, '50', 'greenchilli.jpg', 1),
(19, 2, 'Lady Finger', 60, 58, '50', 'ladyfinger.jpg', 1),
(20, 2, 'Onion', 50, 45, '50', 'onion.jpg', 1),
(21, 2, 'Potato', 20, 16, '50', 'potatoes.jpg', 1),
(22, 2, 'Tomato', 40, 35, '50', 'tomatoes.jpg', 1),
(23, 2, 'Beet Root', 40, 38, '50', 'beetroot.jpg', 1),
(24, 2, 'Peas', 65, 60, '50', 'peas.jpg', 1),
(25, 3, 'Green Grams(Moong)', 100, 90, '80', 'moong.jpg', 1),
(26, 3, 'Black Eyed Beans(Chawli)', 120, 115, '80', 'chawli.jpg', 1),
(27, 3, 'Red Lentis(Masoor)', 80, 78, '80', 'masoor.jpg', 1),
(28, 3, 'Yellow Pigeon Peas(Toovar Dal)', 130, 125, '80', 'toordal.jpg', 1),
(29, 3, 'Turkish Gram Beans(Moth)', 110, 105, '80', 'moth.jpg', 1),
(30, 3, 'Red Kidney Beans(Rajma)', 120, 119, '80', 'rajma.jpg', 1),
(31, 3, 'Black Gram Beans(Udad)', 122, 120, '80', 'udad.jpg', 1),
(32, 4, 'Rice', 150, 145, '50', 'rice.jpg', 1),
(33, 4, 'Wheat', 25, 23, '50', 'wheat_(1).jpg', 1),
(34, 4, 'Corn Flour', 50, 48, '50', 'cornfloor.jpg', 1),
(35, 4, 'Barley', 155, 150, '50', 'barley.jpg', 1),
(36, 4, 'Vermicelli', 85, 80, '50', 'vermicelli.jpg', 1),
(37, 4, 'Semolina(Sooji)', 50, 48, '50', 'semolina.jpg', 1),
(38, 4, 'Maida', 50, 45, '50', 'maida.jpg', 1),
(39, 5, 'Black Pepper', 1000, 900, '50', 'blackpepper.jpg', 1),
(40, 5, 'Cumin', 25, 180, '180', 'cumin.jpg', 1),
(41, 5, 'Bay Leaf', 100, 90, '50', 'bayleaf.jpg', 1),
(42, 5, 'Cinnamon', 1000, 1000, '50', 'cinnamon.jpg', 1),
(43, 5, 'Cloves', 1200, 1990, '50', 'cloves.jpg', 1),
(44, 5, 'Elaichi', 6050, 6000, '30', 'elaichi.jpg', 1),
(45, 5, 'Star Anise', 200, 190, '50', 'anise.jpg', 1),
(46, 5, 'Saffron', 20050, 20000, '30', 'saffron.jpg', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cart_orders`
--
ALTER TABLE `cart_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `cart_orders`
--
ALTER TABLE `cart_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

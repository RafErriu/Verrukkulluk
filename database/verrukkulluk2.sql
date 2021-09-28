-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 10:06 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verrukkulluk`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `titel` text NOT NULL,
  `omschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(1) NOT NULL,
  `naam` text NOT NULL,
  `omschrijving` text NOT NULL,
  `prijs` int(11) NOT NULL,
  `calorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `naam`, `omschrijving`, `prijs`, `calorie`) VALUES
(31, 'Broodje', 'Dit is een broodje', 50, 30),
(32, 'Hamburger', 'Een hamburger van rundvlees', 160, 60),
(33, 'Ui', 'Een dikke ui', 30, 20),
(34, 'Tomaat', 'Een sappige tomaat', 40, 15),
(35, 'Kipfilet', 'Een malse hele kipfilet', 170, 78),
(36, 'Tortilla ', 'Een tortilla gemaakt van bloem', 20, 38),
(37, 'Avocado', 'Een boter zachte avocado', 100, 36),
(38, 'Knoflook', 'Één dikke teen knoflook', 10, 13),
(39, 'Chili peper', 'Een rode verse chili peper', 35, 12),
(40, 'Spaghetti', 'Heerlijke Italiaanse spaghetti', 150, 131),
(41, 'Mozzarella', 'De echte buffelmozzarella', 250, 63),
(42, 'Rucola', 'Pittige Rucola sla', 100, 26),
(43, 'Olijfolie', 'Een fles Italiaanse olijfolie', 450, 30),
(44, 'Hard Broodje', 'Een hard crunchy broodje', 50, 40),
(45, 'Gerookte Zalm', 'Plakjes gerookte zalm', 200, 60),
(46, 'Citroensap', 'Een flesje citroensap', 100, 12),
(47, 'Koriander', 'Een bosje koriander', 100, 10),
(48, 'Ei', 'Een dozijn kippeneitjes', 200, 80);

-- --------------------------------------------------------

--
-- Table structure for table `gerecht_info`
--

CREATE TABLE `gerecht_info` (
  `id` int(11) NOT NULL,
  `record_type [B, O, W, F]` text NOT NULL,
  `recept(ID)` int(11) NOT NULL,
  `user(ID)` int(11) NOT NULL,
  `stap` int(1) NOT NULL,
  `bereiding` text NOT NULL,
  `opmerking` text NOT NULL,
  `cijfer` int(1) NOT NULL,
  `favoriet` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `recept_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `hoeveelheid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `recept_id`, `artikel_id`, `hoeveelheid`) VALUES
(10, 20, 5, 1),
(11, 20, 6, 1),
(13, 20, 7, 1),
(14, 20, 8, 1),
(15, 22, 34, 1),
(16, 22, 38, 4),
(17, 22, 40, 100),
(18, 22, 41, 1),
(19, 22, 42, 30),
(20, 22, 43, 50),
(21, 23, 35, 1),
(22, 23, 36, 2),
(23, 23, 38, 2),
(24, 23, 39, 1),
(25, 23, 37, 1),
(26, 24, 44, 1),
(27, 24, 45, 100),
(28, 24, 43, 10),
(29, 24, 46, 20),
(30, 24, 47, 30),
(31, 24, 48, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keuken/type`
--

CREATE TABLE `keuken/type` (
  `id` int(11) NOT NULL,
  `record_type [K, T]` text NOT NULL,
  `omschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keuken/type`
--

INSERT INTO `keuken/type` (`id`, `record_type [K, T]`, `omschrijving`) VALUES
(1, 'T', 'Vegetarisch'),
(2, 'T', 'Vlees'),
(3, 'T', 'Vis'),
(4, 'K', 'Amerikaans'),
(5, 'K', 'Italiaans'),
(6, 'K', 'Mexicaans');

-- --------------------------------------------------------

--
-- Table structure for table `recept`
--

CREATE TABLE `recept` (
  `id` int(11) NOT NULL,
  `titel` text NOT NULL,
  `foto` text NOT NULL,
  `keuken_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `omschrijving` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recept`
--

INSERT INTO `recept` (`id`, `titel`, `foto`, `keuken_id`, `type_id`, `omschrijving`) VALUES
(20, 'Broodje Hamburger', 'C:\\Gebruikers\\Educom\\Afbeeldingen\\burger.jpg', 4, 2, 'Een heerlijke Amerikaanse burger met ui en tomaat.'),
(22, 'Pasta Aglio e Olio', 'C:\\Users\\RafEr\\Pictures\\Recipes\\4_spaghetti-aglio-e-olio.jpg', 5, 1, 'Een heerlijke Italiaanse pasta met knoflook en tomaat.'),
(23, 'Mexican Chicken Wraps', 'C:\\Users\\RafEr\\Pictures\\Recipes\\Crunchy-Southwester-Chicken-Wrap-square.jpg', 6, 2, 'Een Mexicaanse wrap met kip en creamy avocado'),
(24, 'Sandwich Avocado, Gerookte Zalm', 'C:\\Users\\RafEr\\Pictures\\Recipes\\poached-eggs-avocado-smoked-salmon-recipe.jpg', 4, 3, 'Een hard broodje met smashed avocado, gerookte zalm en een gepocheerd eitje.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `gebruikersnaam` text NOT NULL,
  `wachtwoord` text NOT NULL,
  `email` text NOT NULL,
  `afbeelding` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `gebruikersnaam`, `wachtwoord`, `email`, `afbeelding`) VALUES
(6, 'Francienkookt', 'lekkersmullen', 'Francientjepientje@hotmail.com', 'C:\\Gebruikers\\Educom\\Afbeeldingen\\Mary_Lou_Quinlan_headshot_MLQ_Co.jpg'),
(5, 'Robke3', 'Robkeisdebeste', 'robkerobke@gmail.com', 'C:\\Gebruikers\\Educom\\Afbeeldingen\\regular-guy-7657297.jpg'),
(7, 'Johnnepon', 'gewoonlekkerjohn', 'johndeman@msn.com', 'C:\\Gebruikers\\Educom\\Afbeeldingen\\3091.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keuken/type`
--
ALTER TABLE `keuken/type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recept`
--
ALTER TABLE `recept`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `gerecht_info`
--
ALTER TABLE `gerecht_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `keuken/type`
--
ALTER TABLE `keuken/type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recept`
--
ALTER TABLE `recept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

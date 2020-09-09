-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2020 at 10:51 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desafiodrible`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `idProd` int(50) NOT NULL,
  `nameProd` varchar(50) NOT NULL,
  `descriptionProd` text NOT NULL,
  `priceProd` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`idProd`, `nameProd`, `descriptionProd`, `priceProd`) VALUES
(27, 'Económico', 'Recursos básicos para sites base.', 3),
(28, 'Avançado', 'Mais espaço e flexibilidade para vários sítios da internet.', 4),
(29, 'Superior', 'Mais potência para sites com muito tráfego. Ideal para sites WordPress.', 8),
(30, 'Máximo', 'Suporta vários sites complexos com fotos e vídeos de alta resolução.', 13),
(31, 'Hosting Linux Smart', 'O alojamento web para ter sites de alto desempenho, blogs ou plataformas de comércio electrónico, feitos com aplicações ou em código próprio. Uma plataforma rápida, multi-domínio e certificado SSL incluído.', 2),
(32, 'Hosting Linux Advanced', 'O alojamento web para ter sites de alto desempenho, blogs ou plataformas de comércio electrónico, feitos com aplicações ou em código próprio. Uma plataforma rápida, multi-domínio e certificado SSL incluído.', 5),
(33, 'Hosting Windows', 'A garantia dos produtos Microsoft e o profissionalismo dos nossos técnicos no apoio ao seu projecto we', 7),
(34, 'Blue Host', 'Free domin', 2),
(35, 'Hostinger', 'Free templates and high-speed', 1),
(36, 'Web Hosting', 'Alto desempenho', 9),
(37, 'Domain', 'Dominios customizáveis', 7),
(38, 'HostPapa', 'Recursos básicos.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `emailUser` varchar(50) NOT NULL,
  `nameUser` varchar(50) NOT NULL,
  `passwordUser` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`emailUser`, `nameUser`, `passwordUser`, `userType`) VALUES
('admin@admin.com', 'admin', 'admin', 'admin'),
('user@user.com', 'user', 'user', 'utilizador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProd`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`emailUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `idProd` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

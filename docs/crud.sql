-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2019 at 10:53 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--
CREATE DATABASE IF NOT EXISTS `crud` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `crud`;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `nascimento` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `cpf` bigint(20) NOT NULL,
  `estadocivil` varchar(45) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `perfil` varchar(100) NOT NULL DEFAULT 'cliente',
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nome`, `nascimento`, `email`, `cpf`, `estadocivil`, `endereco`, `senha`, `perfil`, `foto`) VALUES
(6, 'Daniel Luiz Ferreira', '2019-05-14', 'daniel@daniel.com.br', 10790630729, 'divorciado', 'teste', 'e10adc3949ba59abbe56e057f20f883e', 'cliente', ''),
(7, 'Acran Laureano', '2019-05-22', 'luiz@sergio.com', 12084767776, 'divorciado', 'teste', '5a2b3c91ee8803f6b9164e00f51c7f0f', 'cliente', ''),
(8, 'Cristina', '2019-05-24', 'rpprjbr@gmail.com', 11262484790, 'solteiro', 'testefdasf', 'b3458277893208e715f7c98a787823f6', 'cliente', ''),
(9, 'Rodolfo Paolucci', '2019-05-25', 'paolucci@paolucci.com', 14722386722, 'solteiro', 'testedsaf', 'e10adc3949ba59abbe56e057f20f883e', 'administrador', 'aeGQJuyc_400x40020190527203657.jpg'),
(10, 'Thiago Lima', '1985-10-27', 'thiago@thiago.com', 10279967799, 'uniaoestavel', 'Rua do Thiago 3', 'e10adc3949ba59abbe56e057f20f883e', 'cliente', 'foto-de-perfil-para-trabalho.jpg20190527202725.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD UNIQUE KEY `index2` (`email`),
  ADD UNIQUE KEY `index3` (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

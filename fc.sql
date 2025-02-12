-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2025 at 11:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(95) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(97) NOT NULL,
  `telefone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `cpf`, `email`, `telefone`) VALUES
(2, 'Gabriel Cordeiro', '111.111.111-21', 'gabrielpikachuoficial@gmail.com', '85 9887752571'),
(4, 'Ivan', '111.111.232-32', 'companyname@gmail.com', '(22) 22222-2222');

-- --------------------------------------------------------

--
-- Table structure for table `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `imagem` varchar(270) NOT NULL,
  `nome` varchar(85) NOT NULL,
  `funcao` varchar(97) NOT NULL,
  `detalhe` varchar(200) NOT NULL,
  `valorcompra` varchar(95) NOT NULL,
  `valorvenda` varchar(95) NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `vendido` int(255) NOT NULL,
  `marca` varchar(95) NOT NULL,
  `peso` varchar(95) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estoque`
--

INSERT INTO `estoque` (`id`, `imagem`, `nome`, `funcao`, `detalhe`, `valorcompra`, `valorvenda`, `quantidade`, `vendido`, `marca`, `peso`) VALUES
(1, 'terra_cortril.webp', 'Terra-Cortril Spray', 'Anti-Inflamatórios', 'Mensagem 2', '31', '39.90', 0, 377, 'ZOETIS', '100ml'),
(2, 'equipalazone.webp', 'Equipalazone', 'Anti-Inflamatórios', 'Mensagem 2', '55.90', '62.90', 3, 17, 'Ceva', '100ml'),
(3, 'diclofenato.jpg', 'Diclofenaco', 'Anti-Inflamatórios', 'Mensagem 2', '8.50', '12.90', 0, 65, 'JASaúdeAnimal', '50ml'),
(4, 'cortvet.webp', 'Cortvet', 'Anti-Inflamatórios', 'Mensagem 2', '4.90', '7.40', 45, 5, 'UCB', '10ml'),
(5, 'CortTrat.webp', 'Cort-trat', 'Anti-Inflamatórios', 'Mensagem 2', '19.90', '25.90', 40, 0, 'SM', '100g'),
(6, 'diuzon.webp', 'Diuzon', 'Anti-Inflamatórios', 'Mensagem 2', '39.90', '45.90', 12, 0, 'Chemitec', '10ml'),
(7, 'flumax.webp', 'Flumax', 'Anti-Inflamatórios', 'Mensagem 2', '77.90', '89.90', 0, 9, 'JASaúdeAnimal', '100ml'),
(8, 'terramicina-la.webp', 'Terramicina /LA', 'Antibióticos', 'Mensagem 3', '15.90', '20.90', 59, 1, 'ZOETIS', '50ml'),
(10, 'terramicina_po.webp', 'Terramicina Pó', 'Antibióticos', 'Mensagem 2', '19.00', '24.40', 22, 0, 'ZOETIS', '100g'),
(11, 'cef-50.webp', 'Cef-50', 'Antibióticos', 'Mensagem 3', '55.90', '60.00', 42, 3, 'Agener', '100ml'),
(12, 'Agemoxi-Cl.webp', 'Agemoxi-CL', 'Antibióticos', 'Mensagem 2', '55.90', '60.00', 0, 6, 'Agemoxi', '250mg'),
(13, 'Pulmodrazin_Plus.webp', 'Pulmodrazin Plus', 'Antimicrobianos', 'Mensagem 1', '18.80', '23.15', 11, 1, 'Pearson', '25ml'),
(14, 'pencil-pronto.webp', 'Pencil Pronto', 'Antimicrobianos', 'Mensagem 1', '16.90', '22.00', 25, 0, 'Calbos', '50ml'),
(15, 'Acura.webp', 'Acura', 'Antimicrobianos', 'Mensagem 2', '25.90', '33.00', 45, 0, 'Clarion', '25ml'),
(16, 'Tribrissen.jpg', ' Tribrissen', 'Antimicrobianos', 'Mensagem 2', '19.85', '25.05', 43, 2, 'Virbac', '15ml'),
(18, 'antitoxico_oral.webp', 'Antitóxicos SM', 'Antitóxicos', 'Mensagem 1', '14.30', '20.22', 0, 22, 'SM', '20ml'),
(19, 'Mercepton.webp', 'Mercepton', 'Antitóxicos', 'Mensagem 1', '25.90', '32.06', 34, 2, 'Bravet', '100ml'),
(20, 'Anestésico_bravet.webp', 'Anestésico Bravet', 'Anestésicos', 'Mensagem 2', '17.20', '22.80', 29, 1, 'Bravet', '50ml'),
(21, 'anestesico-vansil.jpg', 'Anestésico Vansil', 'Anestésicos', 'Mensagem 3', '17.20', '25.90', 40, 5, 'Vansil', '100ml'),
(22, 'Verrutrat.webp', 'Verrutrat', 'Profilaxia e Tratamento', 'Mensagem 2', '16.90', '22.80', 39, 15, 'UCB', '20ml'),
(23, 'Tristezina.webp', 'Tristezina', 'Profilaxia e Tratamento', 'Mensagem 2', '22.20', '28.90', 45, 0, 'UCB', '20ml'),
(24, 'Imizol.webp', 'Imizol', 'Profilaxia e Tratamento', 'Mensagem 2', '59.90', '66.90', 14, 0, 'MSD', '15ml'),
(25, 'ferron.webp', 'Ferron B-12', 'Suplementos e Vitaminas', 'Mensagem 3', '16.21', '21.12', 60, 0, 'Calbos', '100ml'),
(26, 'ferron_50.webp', 'Ferron B-12', 'Suplementos e Vitaminas', 'Mensagem 2', '16.90', '22.80', 49, 0, 'Calbos', '50ml'),
(27, 'Rubralan.webp', 'Rubralan 5000', 'Suplementos e Vitaminas', 'Mensagem 1', '14.90', '19.00', 85, 0, 'Calbos', '10ml'),
(28, 'Rubralan_50.webp', 'Rubralan 5000', 'Suplementos e Vitaminas', 'Mensagem 2', '35.90', '40.90', 85, 0, 'Calbos', '50ml'),
(29, 'PhenodralAmpola.webp', ' Phenodral Ampola', 'Suplementos e Vitaminas', 'Mensagem 2', '8.50', '13.80', 60, 0, 'UCB', '15ml'),
(31, 'organovit-500.webp', 'Organovit', 'Suplementos e Vitaminas', 'Mensagem 3', '147.00', '197.90', 88, 1, 'Biofarm', '500ml'),
(32, 'BioLeite.png', 'BioLeite', 'Suplementos e Vitaminas', 'Mensagem 2', '900.00', '998.00', 90, 0, 'Quimvet', '10KG'),
(44, 'racaogatowhiskas.jpg', 'Ração pra Gato', 'Ração', 'Ração pra gato', '0.031', '0.058', 4500, 1500, ' Whiskas', 'n'),
(45, 'racaocachorro Pedigree.webp', 'Ração teste', 'Ração', 'Ração para cachorro', '0.023', '0.032', 0, 9000, 'Pedigree', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cargo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `cargo`) VALUES
(1, 'adm', '$2y$10$fJwyhXHiLcc2qc.0Zh6C1uhxaQFldfUgWHwonpupumWuf34ZVhP.W', 'adm'),
(5, 'Gabriel', '$2y$10$zxkVtE.4m1p.XK/oHx/yaO6RE37a4A3JSwuH2..25JXGeyiq59biW', 'operador'),
(6, 'cliente', '$2y$10$.ZUULBXhR4j4vFYYP2KlMuhSkZ9fFsj3gXmtzKO2DI3TP3NkWmJ/q', 'cliente'),
(7, 'operador', '$2y$10$qX2h/Zp8r9RTq0dBfrdNm.V7Bg0RjESeE64prX1WBFAYoegnXXHf6', 'operador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

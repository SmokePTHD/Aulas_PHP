-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2024 at 11:16 AM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `publicacoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `classicos_lit`
--

CREATE TABLE `classicos_lit` (
  `autor` varchar(128) DEFAULT NULL,
  `titulo` varchar(128) DEFAULT NULL,
  `categoria` varchar(16) DEFAULT NULL,
  `ano` smallint(6) DEFAULT NULL,
  `preco` decimal(5,2) DEFAULT NULL,
  `isbn` char(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classicos_lit`
--

INSERT INTO `classicos_lit` (`autor`, `titulo`, `categoria`, `ano`, `preco`, `isbn`) VALUES
('Luís Vaz de Camões', 'Os Lusíadas', 'Poesia', 1572, 32.00, '9781598184891'),
('Fernando Pessoa', 'Livro do Desassossego', 'Não ficção', 1982, 24.50, '9780582506206'),
('Padre António Vieira', 'Sermões', 'Não ficção', 2008, 28.70, '9780517123201'),
('José Saramago', 'Memorial do Convento', 'Ficção', 1982, 32.00, '9780517478201'),
('Vergílio Ferreira', 'Manhã Submersa', 'Ficção', 1954, 26.00, '3560517123201'),
('José Cardoso Pires', 'Balada da Praia dos Cães', 'Ficção', 1982, 19.75, '3567877123201');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `isbn` char(13) NOT NULL,
  `preco` decimal(5,2) DEFAULT NULL,
  `exemplares` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`isbn`, `preco`, `exemplares`) VALUES
('3560517123201', 45.00, 14),
('3567877123201', 27.80, 2),
('9780517123201', 19.80, 3),
('9780517478201', 26.50, 16),
('9780582506206', 28.00, 10),
('9781598184891', 32.50, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classicos_lit`
--
ALTER TABLE `classicos_lit`
  ADD KEY `autor` (`autor`(10)),
  ADD KEY `titulo` (`titulo`(10)),
  ADD KEY `categoria` (`categoria`(1));

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

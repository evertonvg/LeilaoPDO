-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Jun-2019 às 18:50
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leilao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `titulo` varchar(32) DEFAULT NULL,
  `descricao` text,
  `minimo` double DEFAULT NULL,
  `camninho_foto` varchar(255) DEFAULT NULL,
  `arrematado` tinyint(1) DEFAULT NULL,
  `situacao` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id`, `titulo`, `descricao`, `minimo`, `camninho_foto`, `arrematado`, `situacao`) VALUES
(1, 'vazo', 'caro pra dedeu', 10, 'c:/foto', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `leilao`
--

CREATE TABLE `leilao` (
  `id` int(11) NOT NULL,
  `dtInicio` date DEFAULT NULL,
  `dtFinal` date DEFAULT NULL,
  `hrInicio` time DEFAULT NULL,
  `hrFinal` time DEFAULT NULL,
  `situacao` tinyint(1) DEFAULT NULL,
  `idItem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) DEFAULT NULL,
  `login` varchar(32) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` double DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `situacao` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`id`, `nome`, `login`, `senha`, `email`, `endereco`, `telefone`, `admin`, `situacao`) VALUES
(2, 'Elton', 'trexx', '12345', 'elton@elton', 'rua 2', 23232323, 0, 1),
(3, 'jaja', 'jaja', 'jaja', 'jaja', 'jaja', 23232323, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leilao`
--
ALTER TABLE `leilao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idItem` (`idItem`);

--
-- Indexes for table `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leilao`
--
ALTER TABLE `leilao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `leilao`
--
ALTER TABLE `leilao`
  ADD CONSTRAINT `leilao_ibfk_1` FOREIGN KEY (`idItem`) REFERENCES `itens` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

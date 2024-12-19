-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/12/2024 às 13:19
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `solicitacoes`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro_solicitacoes`
--

CREATE TABLE `cadastro_solicitacoes` (
  `id` int(11) NOT NULL,
  `numero_solicitacao` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `data_criacao` date NOT NULL,
  `data_previsao` date NOT NULL,
  `status_solicitacao` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro_solicitacoes`
--
ALTER TABLE `cadastro_solicitacoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_solicitacao` (`numero_solicitacao`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_solicitacoes`
--
ALTER TABLE `cadastro_solicitacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

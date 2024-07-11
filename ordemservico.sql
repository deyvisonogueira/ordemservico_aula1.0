-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jul-2022 às 10:31
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ordemservico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod`, `nome`, `email`, `senha`, `endereco`, `numero`, `bairro`, `cidade`, `telefone`, `status`, `perfil`, `data`) VALUES
(4, 'Danilo Alves Alvarenga', 'danilo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', '(35) 99984-9594', 1, 2, 22),
(5, 'Mariany Alves', 'mary@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Avenida Dolores Silva', '335', 'Centro', 'Aguanil', '(35) 99984-9594', 1, 2, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE `ordem` (
  `cod` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_terceirizado` int(11) NOT NULL,
  `cod_servico` int(11) NOT NULL,
  `data_servico` date NOT NULL,
  `status` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordem`
--

INSERT INTO `ordem` (`cod`, `cod_cliente`, `cod_terceirizado`, `cod_servico`, `data_servico`, `status`, `data`) VALUES
(10, 5, 8, 5, '2022-07-16', 2, '2022-07-15'),
(11, 4, 7, 4, '2022-07-17', 1, '2022-07-14'),
(12, 5, 8, 5, '2022-07-21', 3, '2022-07-15'),
(13, 4, 7, 4, '2022-07-19', 1, '2022-07-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`cod`, `nome`, `valor`, `data`) VALUES
(4, 'Lavar Carro', '50', '2022-07-14'),
(5, 'Limpar Piscina', '70', '2022-07-14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `terceirizado`
--

CREATE TABLE `terceirizado` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `terceirizado`
--

INSERT INTO `terceirizado` (`cod`, `nome`, `email`, `telefone`, `senha`, `status`, `perfil`, `data`) VALUES
(7, 'Dalyla Alvarenga ', 'dalylalvarenga@gmail.com', '(35) 99984-9594', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, '2022-07-15'),
(8, 'Maria Aparecida', 'maria@gmail.com', '(35) 99984-9594', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, '2022-07-14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `perfil` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod`, `nome`, `senha`, `email`, `perfil`, `status`, `data`) VALUES
(25, 'Fábio Junior Alves', 'e10adc3949ba59abbe56e057f20f883e', 'faguanil@gmail.com', 1, 1, '2022-07-15');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `ordem`
--
ALTER TABLE `ordem`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `foreign_key_cod_cliente` (`cod_cliente`),
  ADD KEY `foreign_key_cod_servico` (`cod_servico`),
  ADD KEY `foreign_key_cod_terceirizado` (`cod_terceirizado`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `terceirizado`
--
ALTER TABLE `terceirizado`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `ordem`
--
ALTER TABLE `ordem`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `terceirizado`
--
ALTER TABLE `terceirizado`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ordem`
--
ALTER TABLE `ordem`
  ADD CONSTRAINT `foreign_key_cod_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod`),
  ADD CONSTRAINT `foreign_key_cod_servico` FOREIGN KEY (`cod_servico`) REFERENCES `servico` (`cod`),
  ADD CONSTRAINT `foreign_key_cod_terceirizado` FOREIGN KEY (`cod_terceirizado`) REFERENCES `terceirizado` (`cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01-Out-2015 às 23:41
-- Versão do servidor: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `info_mcr`
--
CREATE DATABASE IF NOT EXISTS `info_mcr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `info_mcr`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_comentarios`
--

DROP TABLE IF EXISTS `cad_comentarios`;
CREATE TABLE IF NOT EXISTS `cad_comentarios` (
  `codigo_receita` int(11) NOT NULL,
  `texto` text NOT NULL,
  `nome_usuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_receitas`
--

DROP TABLE IF EXISTS `cad_receitas`;
CREATE TABLE IF NOT EXISTS `cad_receitas` (
  `codigo_receita` int(11) NOT NULL,
  `nome_receita` varchar(60) NOT NULL,
  `tempo` varchar(60) NOT NULL,
  `ingredientes` text NOT NULL,
  `modo_preparo` text NOT NULL,
  `foto` text NOT NULL,
  `tipo_receita` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cad_receitas`
--

INSERT INTO `cad_receitas` (`codigo_receita`, `nome_receita`, `tempo`, `ingredientes`, `modo_preparo`, `foto`, `tipo_receita`) VALUES
(1, 'Bolo de Chocolate Caseiro', '01h 00min', 'Massa:\r\n•4 ovos\r\n•4 colheres de sopa de chocolate em pó\r\n•2 colheres de sopa de manteiga\r\n•3 xícaras de farinha de trigo\r\n•2 xícaras de açúcar\r\n•2 colheres de chá de fermento\r\n•1 xícara de leite\r\n\r\nCalda:\r\n•2 colheres de sopa de manteiga\r\n•7 colheres de sopa de chocolate em pó\r\n•2 latas de creme de leite com soro\r\n•3 colheres de sopa de açúcar\r\ncar', 'Massa: \r\n1.Bata todos os ingredientes por 5 minutos (menos o fermento)\r\n2.Adicione o fermento e misture com uma espÃ¡tula delicadamente\r\n3.Coloque em uma forma untada e asse por 40 minutos\r\n\r\nCalda: \r\n1.AqueÃ§a a manteiga e misture o chocolate em pó que esteja homogeneo\r\n2.Acrescente o creme de leite e misture bem\r\n3.Desligue o fogo e acrescente o aÃ§Ãºcar', 'Imagens/bolo-chocolate-caseiro.jpg', 'bolo'),
(2, 'Bolo de Cenoura', '01h 00min', '•1/2 xícara (chá) de óleo\n•3 cenouras médias raladas\n•4 ovos\n•2 xícaras (chá) de açúcar\n•2 e 1/2 xícaras (chá) de farinha de trigo\n•1 colher (sopa) de fermento em pó Dr. Oetker\n\nCobertura\n•1 colher (sopa) de manteiga\n•3 colheres (sopa) de chocolate em pó Dr. Oetker\n•1 xícara (chá) de açúcar\n•Se desejar uma cobertura molinha coloque 5 colheres de leite\n', 'Massa:\n1.Bata no liquidificador primeiro a cenoura com os ovos e o Ã³leo, acrescente o aÃ§Ãºcar e bata por uns 5 minutos\n2.Depois numa tigela ou na batedeira, coloque o restante dos ingredientes misturando tudo, menos o fermento\n3.Esse Ã© misturado lentamente com uma colher\n4.Asse em forno preaquecido (180Â°C) por 40 minutos\n\nPara a Cobertura:\n1.Misture todos os ingredientes, leve ao fogo, faÃ§a uma calda e coloque por cima do bolo\n2.Se o seu liquidificador for bem potente, o bolo todo pode ser feito nele\n3.VocÃª poderÃ¡ seguir ao vÃ­deo ou a receita escrita, o resultado serÃ¡ perfeito dos 2 modos\n4.Utilize cerca de 250 g de cenoura para o bolo nÃ£o solar\n', 'Imagens/bolo-cenoura.jpg', 'bolo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cad_usuarios`
--

DROP TABLE IF EXISTS `cad_usuarios`;
CREATE TABLE IF NOT EXISTS `cad_usuarios` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cad_usuarios`
--

INSERT INTO `cad_usuarios` (`codigo`, `nome`, `email`, `cpf`, `senha`) VALUES
(1, 'Matheus', 'matheuscunhareis30@gmail.com', '11410238652', 'tami2230');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cad_receitas`
--
ALTER TABLE `cad_receitas`
  ADD PRIMARY KEY (`codigo_receita`);

--
-- Indexes for table `cad_usuarios`
--
ALTER TABLE `cad_usuarios`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cad_receitas`
--
ALTER TABLE `cad_receitas`
  MODIFY `codigo_receita` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cad_usuarios`
--
ALTER TABLE `cad_usuarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

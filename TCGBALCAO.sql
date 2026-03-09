-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/03/2026 às 05:14
-- Versão do servidor: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- Versão do PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `TCGBALCAO`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin_lojas`
--

CREATE TABLE `admin_lojas` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admin_lojas`
--

INSERT INTO `admin_lojas` (`id_admin`, `nome`, `email`, `senha`) VALUES
(1, 'Admin Master', 'admin@tcgbalcao.com', '$2y$10$Tob7KC76Ni7H5lojJaCIPeYaLAgbh6QYG9B8upkkUmrW9Ia7.rv0y');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardgames`
--

CREATE TABLE `cardgames` (
  `id_cardgame` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem_fundo_card` varchar(255) DEFAULT NULL,
  `imagem_card_game` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cardgames`
--

INSERT INTO `cardgames` (`id_cardgame`, `nome`, `imagem_fundo_card`, `imagem_card_game`) VALUES
(1, 'Magic: The Gathering', 'magic.png', NULL),
(2, 'Pokémon TCG', 'pokemon.png', NULL),
(3, 'YuGiOh!', 'yugioh.png', NULL),
(4, 'Digimon TCG', 'digimon.png', NULL),
(5, 'Flesh and Blood', 'flesh_blood.png', NULL),
(6, 'Dungeons & Dragons', 'dungeon_dragons.png', NULL),
(7, 'Star Wars: Unlimited', 'star_wars.png', NULL),
(8, 'One Piece Tcg', 'one_piece.png', NULL),
(9, 'Beyblade', 'fundo.png', 'cardgame.png'),
(10, 'Lorcana', 'lorcana.png', NULL),
(11, 'Vanguard', 'vanguard.png', NULL),
(12, 'Gundam Card Game', 'gundan_war.png', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `telefone`, `email`, `documento`, `data_cadastro`) VALUES
(1, '00 - Balcão', '00000000000', 'balcao@manabank.com.br', NULL, '2026-03-06 12:03:01'),
(2, 'Lucas Nobre Ferreira Martins', '11962851513', 'lnfm1987@gmail.com', NULL, '2026-03-06 21:29:19'),
(3, 'Adilson Ferreira Martins', '11962851151', 'afmnobre1962@gmail.com', NULL, '2026-03-06 21:30:09'),
(4, 'Marta Nobre Maciel Martins', '11948256722', 'mnobre1970@hotmail.com', NULL, '2026-03-06 21:31:28'),
(5, 'Daniel Nobre Ferreira Martins', '11954815628', 'danielsurfnig@hotmail.com', NULL, '2026-03-06 21:32:07'),
(6, 'Matheus Nobre Ferreira Martins', '11987515159', 'matheus_ipjg@hotmail.com', NULL, '2026-03-06 21:32:48'),
(7, 'Sebastião Alves Martins', '11984254793', 'sebastiao@gmail.com', NULL, '2026-03-06 21:34:08'),
(8, 'Maria Edicia Nobre', '11985155781', 'marianobre@gmail.com', NULL, '2026-03-06 21:38:54'),
(9, 'Tony Stark', '11900000001', 'tony.stark1@geekmail.com', 'DOC1', '2026-03-07 19:47:46'),
(10, 'Bruce Wayne', '11900000002', 'bruce.wayne2@geekmail.com', 'DOC2', '2026-03-07 19:47:46'),
(11, 'Peter Parker', '11900000003', 'peter.parker3@geekmail.com', 'DOC3', '2026-03-07 19:47:46'),
(12, 'Luke Skywalker', '11900000004', 'luke.skywalker4@geekmail.com', 'DOC4', '2026-03-07 19:47:46'),
(13, 'Darth Vader', '11900000005', 'darth.vader5@geekmail.com', 'DOC5', '2026-03-07 19:47:46'),
(14, 'Hermione Granger', '11900000006', 'hermione.granger6@geekmail.com', 'DOC6', '2026-03-07 19:47:46'),
(15, 'Frodo Baggins', '11900000007', 'frodo.baggins7@geekmail.com', 'DOC7', '2026-03-07 19:47:46'),
(16, 'Geralt of Rivia', '11900000008', 'geralt.of.rivia8@geekmail.com', 'DOC8', '2026-03-07 19:47:46'),
(17, 'Luffy Monkey', '11900000009', 'luffy.monkey9@geekmail.com', 'DOC9', '2026-03-07 19:47:46'),
(18, 'Naruto Uzumaki', '11900000010', 'naruto.uzumaki10@geekmail.com', 'DOC10', '2026-03-07 19:47:46'),
(19, 'Son Goku', '11900000011', 'son.goku11@geekmail.com', 'DOC11', '2026-03-07 19:47:46'),
(20, 'Vegeta Principe', '11900000012', 'vegeta.principe12@geekmail.com', 'DOC12', '2026-03-07 19:47:46'),
(21, 'Ichigo Kurosaki', '11900000013', 'ichigo.kurosaki13@geekmail.com', 'DOC13', '2026-03-07 19:47:46'),
(22, 'Eleven Hopper', '11900000014', 'eleven.hopper14@geekmail.com', 'DOC14', '2026-03-07 19:47:46'),
(23, 'Sherlock Holmes', '11900000015', 'sherlock.holmes15@geekmail.com', 'DOC15', '2026-03-07 19:47:47'),
(24, 'Walter White', '11900000016', 'walter.white16@geekmail.com', 'DOC16', '2026-03-07 19:47:47'),
(25, 'Rick Sanchez', '11900000017', 'rick.sanchez17@geekmail.com', 'DOC17', '2026-03-07 19:47:47'),
(26, 'Joel Miller', '11900000018', 'joel.miller18@geekmail.com', 'DOC18', '2026-03-07 19:47:47'),
(27, 'Ellie Williams', '11900000019', 'ellie.williams19@geekmail.com', 'DOC19', '2026-03-07 19:47:47'),
(28, 'Lara Croft', '11900000020', 'lara.croft20@geekmail.com', 'DOC20', '2026-03-07 19:47:47'),
(29, 'Master Chief', '11900000021', 'master.chief21@geekmail.com', 'DOC21', '2026-03-07 19:47:47'),
(30, 'Kratos Sparta', '11900000022', 'kratos.sparta22@geekmail.com', 'DOC22', '2026-03-07 19:47:47'),
(31, 'Arthur Morgan', '11900000023', 'arthur.morgan23@geekmail.com', 'DOC23', '2026-03-07 19:47:47'),
(32, 'Nathan Drake', '11900000024', 'nathan.drake24@geekmail.com', 'DOC24', '2026-03-07 19:47:47'),
(33, 'Harry Potter', '11900000025', 'harry.potter25@geekmail.com', 'DOC25', '2026-03-07 19:47:47'),
(34, 'Katniss Everdeen', '11900000026', 'katniss.everdeen26@geekmail.com', 'DOC26', '2026-03-07 19:47:47'),
(35, 'Indiana Jones', '11900000027', 'indiana.jones27@geekmail.com', 'DOC27', '2026-03-07 19:47:47'),
(36, 'Ellen Ripley', '11900000028', 'ellen.ripley28@geekmail.com', 'DOC28', '2026-03-07 19:47:47'),
(37, 'Sarah Connor', '11900000029', 'sarah.connor29@geekmail.com', 'DOC29', '2026-03-07 19:47:47'),
(38, 'James Bond', '11900000030', 'james.bond30@geekmail.com', 'DOC30', '2026-03-07 19:47:47'),
(39, 'Marty McFly', '11900000031', 'marty.mcfly31@geekmail.com', 'DOC31', '2026-03-07 19:47:47'),
(40, 'Doc Brown', '11900000032', 'doc.brown32@geekmail.com', 'DOC32', '2026-03-07 19:47:47'),
(41, 'Wanda Maximoff', '11900000033', 'wanda.maximoff33@geekmail.com', 'DOC33', '2026-03-07 19:47:47'),
(42, 'Steve Rogers', '11900000034', 'steve.rogers34@geekmail.com', 'DOC34', '2026-03-07 19:47:47'),
(43, 'Natasha Romanoff', '11900000035', 'natasha.romanoff35@geekmail.com', 'DOC35', '2026-03-07 19:47:47'),
(44, 'Barry Allen', '11900000036', 'barry.allen36@geekmail.com', 'DOC36', '2026-03-07 19:47:47'),
(45, 'Diana Prince', '11900000037', 'diana.prince37@geekmail.com', 'DOC37', '2026-03-07 19:47:47'),
(46, 'Clark Kent', '11900000038', 'clark.kent38@geekmail.com', 'DOC38', '2026-03-07 19:47:47'),
(47, 'Logan Howlett', '11900000039', 'logan.howlett39@geekmail.com', 'DOC39', '2026-03-07 19:47:47'),
(48, 'Joker Ledger', '11900000040', 'joker.ledger40@geekmail.com', 'DOC40', '2026-03-07 19:47:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes_cardgames`
--

CREATE TABLE `clientes_cardgames` (
  `id_cliente` int(11) NOT NULL,
  `id_cardgame` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes_cardgames`
--

INSERT INTO `clientes_cardgames` (`id_cliente`, `id_cardgame`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 1),
(2, 2),
(2, 8),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(4, 8),
(4, 9),
(5, 1),
(5, 2),
(5, 5),
(6, 1),
(7, 2),
(7, 8),
(8, 1),
(8, 2),
(8, 8),
(9, 3),
(10, 8),
(11, 8),
(12, 1),
(13, 10),
(14, 2),
(15, 6),
(16, 10),
(17, 9),
(18, 6),
(19, 12),
(20, 1),
(21, 12),
(22, 2),
(23, 3),
(24, 4),
(25, 11),
(26, 11),
(27, 10),
(28, 3),
(29, 8),
(30, 9),
(31, 12),
(32, 12),
(33, 2),
(34, 4),
(35, 10),
(36, 8),
(37, 4),
(38, 4),
(39, 11),
(40, 1),
(41, 1),
(42, 1),
(43, 8),
(44, 1),
(45, 3),
(46, 12),
(47, 11),
(48, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes_lojas`
--

CREATE TABLE `clientes_lojas` (
  `id_cliente` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `data_vinculo` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes_lojas`
--

INSERT INTO `clientes_lojas` (`id_cliente`, `id_loja`, `status`, `data_vinculo`) VALUES
(1, 1, 'ativo', '2026-03-06 12:03:01'),
(1, 3, 'ativo', '2026-03-06 14:16:40'),
(2, 3, 'ativo', '2026-03-06 21:29:19'),
(3, 3, 'ativo', '2026-03-06 21:30:09'),
(4, 3, 'ativo', '2026-03-06 21:31:28'),
(5, 3, 'ativo', '2026-03-06 21:32:08'),
(6, 3, 'ativo', '2026-03-06 21:32:48'),
(7, 3, 'ativo', '2026-03-06 21:34:08'),
(8, 3, 'ativo', '2026-03-06 21:38:54'),
(9, 3, 'ativo', '2026-03-07 19:47:46'),
(10, 3, 'ativo', '2026-03-07 19:47:46'),
(11, 3, 'ativo', '2026-03-07 19:47:46'),
(12, 3, 'ativo', '2026-03-07 19:47:46'),
(13, 3, 'ativo', '2026-03-07 19:47:46'),
(14, 3, 'ativo', '2026-03-07 19:47:46'),
(15, 3, 'ativo', '2026-03-07 19:47:46'),
(16, 3, 'ativo', '2026-03-07 19:47:46'),
(17, 3, 'ativo', '2026-03-07 19:47:46'),
(18, 3, 'ativo', '2026-03-07 19:47:46'),
(19, 3, 'ativo', '2026-03-07 19:47:46'),
(20, 3, 'ativo', '2026-03-07 19:47:46'),
(21, 3, 'ativo', '2026-03-07 19:47:46'),
(22, 3, 'ativo', '2026-03-07 19:47:46'),
(23, 3, 'ativo', '2026-03-07 19:47:47'),
(24, 3, 'ativo', '2026-03-07 19:47:47'),
(25, 3, 'ativo', '2026-03-07 19:47:47'),
(26, 3, 'ativo', '2026-03-07 19:47:47'),
(27, 3, 'ativo', '2026-03-07 19:47:47'),
(28, 3, 'ativo', '2026-03-07 19:47:47'),
(29, 3, 'ativo', '2026-03-07 19:47:47'),
(30, 3, 'ativo', '2026-03-07 19:47:47'),
(31, 3, 'ativo', '2026-03-07 19:47:47'),
(32, 3, 'ativo', '2026-03-07 19:47:47'),
(33, 3, 'ativo', '2026-03-07 19:47:47'),
(34, 3, 'ativo', '2026-03-07 19:47:47'),
(35, 3, 'ativo', '2026-03-07 19:47:47'),
(36, 3, 'ativo', '2026-03-07 19:47:47'),
(37, 3, 'ativo', '2026-03-07 19:47:47'),
(38, 3, 'ativo', '2026-03-07 19:47:47'),
(39, 3, 'ativo', '2026-03-07 19:47:47'),
(40, 3, 'ativo', '2026-03-07 19:47:47'),
(41, 3, 'ativo', '2026-03-07 19:47:47'),
(42, 3, 'ativo', '2026-03-07 19:47:47'),
(43, 3, 'ativo', '2026-03-07 19:47:47'),
(44, 3, 'ativo', '2026-03-07 19:47:47'),
(45, 3, 'ativo', '2026-03-07 19:47:47'),
(46, 3, 'ativo', '2026-03-07 19:47:47'),
(47, 3, 'ativo', '2026-03-07 19:47:47'),
(48, 3, 'ativo', '2026-03-07 19:47:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contratos`
--

CREATE TABLE `contratos` (
  `id_contrato` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `tipo` enum('teste','mensal','anual') NOT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `status` enum('ativo','suspenso','cancelado') DEFAULT 'ativo',
  `numero_contrato` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contratos`
--

INSERT INTO `contratos` (`id_contrato`, `id_loja`, `tipo`, `data_inicio`, `data_fim`, `status`, `numero_contrato`) VALUES
(23, 11, 'mensal', '2026-03-06', '2026-04-05', 'ativo', '11202603MEN'),
(24, 3, 'anual', '2026-03-06', '2027-03-06', 'ativo', '3202603ANU'),
(25, 2, 'mensal', '2026-03-06', '2026-04-05', 'ativo', '2202603MEN'),
(26, 1, 'anual', '2026-03-06', '2027-03-06', 'cancelado', '1202603ANU'),
(27, 1, 'mensal', '2026-03-06', '2026-04-05', 'ativo', '1202603MEN');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque_movimentacoes`
--

CREATE TABLE `estoque_movimentacoes` (
  `id_mov` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `tipo` enum('entrada','saida') DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `data_mov` datetime DEFAULT current_timestamp(),
  `referencia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `estoque_movimentacoes`
--

INSERT INTO `estoque_movimentacoes` (`id_mov`, `id_produto`, `tipo`, `quantidade`, `data_mov`, `referencia`) VALUES
(1, 1, 'entrada', 50, '2026-02-13 02:11:01', 'NF001'),
(2, 2, 'entrada', 200, '2026-02-13 02:11:01', 'NF002'),
(3, 3, 'entrada', 100, '2026-02-13 02:11:01', 'NF003'),
(4, 4, 'entrada', 30, '2026-02-13 02:11:01', 'NF004'),
(5, 5, 'entrada', 20, '2026-02-13 02:11:01', 'NF005');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id_fornecedor`, `nome`, `telefone`, `email`) VALUES
(1, 'Fornecedor A', '11333330001', 'fa@teste.com'),
(2, 'Fornecedor B', '11333330002', 'fb@teste.com'),
(3, 'Fornecedor C', '11333330003', 'fc@teste.com'),
(4, 'Fornecedor D', '11333330004', 'fd@teste.com'),
(5, 'Fornecedor E', '11333330005', 'fe@teste.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs_pedidos`
--

CREATE TABLE `logs_pedidos` (
  `id_log` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `acao` enum('criado','alterado','excluido') DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data_log` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lojas`
--

CREATE TABLE `lojas` (
  `id_loja` int(11) NOT NULL,
  `nome_loja` varchar(150) NOT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cor_tema` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `numero_contrato` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lojas`
--

INSERT INTO `lojas` (`id_loja`, `nome_loja`, `cnpj`, `endereco`, `cor_tema`, `logo`, `favicon`, `data_cadastro`, `numero_contrato`) VALUES
(1, 'Player\'s Stop Tcg', '29.836.936/0001-39', 'Rua A, 100', '#FF0000', 'logo.jpg', 'favicon.png', '2026-02-13 02:11:01', '1202603MEN'),
(2, 'Neowalkers Geek Store', '43.395.867/0001-04', 'Rua B, 200', '#540a15', 'logo.jpg', 'logo.ico', '2026-02-16 21:27:16', '2202603MEN'),
(3, 'Galaxy Quest TCG', '43.395.867/0001-04', 'Rua Cumanaxos, 184 - Vila Santana - São Paulo/SP', '#000000', 'logo.jpg', 'logo.png', '2026-02-16 21:27:16', '3202603ANU'),
(11, 'Spellcast Games', '44.407.057/0001-85', 'Avenida Doutor Timóteo Penteado, 2778 - Vila São Judas Tadeu (Sobreloja) - Guarulhos/SP', '#8a0000', 'logo.jpg', 'favicon.png', '2026-02-28 11:20:04', '11202603MEN');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lojas_contratos_historico`
--

CREATE TABLE `lojas_contratos_historico` (
  `id` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `data_inicio_contrato` date DEFAULT NULL,
  `data_fim_contrato` date DEFAULT NULL,
  `tipo_contrato` enum('teste','mensal','anual') NOT NULL,
  `status_contrato` enum('ativo','suspenso','cancelado') NOT NULL,
  `numero_contrato` varchar(50) DEFAULT NULL,
  `data_vinculo` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lojas_contratos_historico`
--

INSERT INTO `lojas_contratos_historico` (`id`, `id_loja`, `id_contrato`, `data_inicio_contrato`, `data_fim_contrato`, `tipo_contrato`, `status_contrato`, `numero_contrato`, `data_vinculo`) VALUES
(28, 11, 23, '2026-03-06', '2026-04-05', 'mensal', 'ativo', '11202603MEN', '2026-03-06 15:49:37'),
(29, 3, 24, '2026-03-06', '2027-03-06', 'anual', 'ativo', '3202603ANU', '2026-03-06 15:51:03'),
(30, 2, 25, '2026-03-06', '2026-04-05', 'mensal', 'ativo', '2202603MEN', '2026-03-06 15:51:11'),
(31, 1, 26, '2026-03-06', '2027-03-06', 'anual', 'ativo', '1202603ANU', '2026-03-06 15:51:18'),
(32, 1, 26, '2026-03-06', '2027-03-06', 'anual', 'suspenso', '1202603ANU', '2026-03-06 15:52:01'),
(33, 1, 26, '2026-03-06', '2027-03-06', 'anual', 'cancelado', '1202603ANU', '2026-03-06 15:52:24'),
(34, 1, 27, '2026-03-06', '2026-04-05', 'mensal', 'ativo', '1202603MEN', '2026-03-06 15:52:35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lotes_importacao`
--

CREATE TABLE `lotes_importacao` (
  `id_lote` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `tipo_arquivo` enum('mensal','semanal') NOT NULL,
  `referencia_periodo` varchar(100) DEFAULT NULL,
  `data_importacao` datetime DEFAULT current_timestamp(),
  `total_itens_processados` int(11) DEFAULT 0,
  `valor_total_lote` decimal(12,2) DEFAULT 0.00,
  `status_processamento` enum('processando','concluido','erro') DEFAULT 'concluido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `lotes_importacao`
--

INSERT INTO `lotes_importacao` (`id_lote`, `id_loja`, `nome_arquivo`, `tipo_arquivo`, `referencia_periodo`, `data_importacao`, `total_itens_processados`, `valor_total_lote`, `status_processamento`) VALUES
(23, 3, 'magic-quest.csv', 'mensal', 'FEV_2026', '2026-03-09 00:59:06', 351, 2324.38, 'concluido'),
(24, 1, 'magic-quest.csv', 'mensal', 'FEV_2026', '2026-03-09 02:00:36', 351, 2324.38, 'concluido');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas_fiscais`
--

CREATE TABLE `notas_fiscais` (
  `id_nf` int(11) NOT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `numero_nf` varchar(50) DEFAULT NULL,
  `data_nf` date DEFAULT NULL,
  `imagem_nf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notas_fiscais`
--

INSERT INTO `notas_fiscais` (`id_nf`, `id_fornecedor`, `numero_nf`, `data_nf`, `imagem_nf`) VALUES
(1, 1, 'NF001', '2026-01-01', NULL),
(2, 2, 'NF002', '2026-01-02', NULL),
(3, 3, 'NF003', '2026-01-03', NULL),
(4, 4, 'NF004', '2026-01-04', NULL),
(5, 5, 'NF005', '2026-01-05', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `data_pedido` date DEFAULT NULL,
  `valor_variado` decimal(10,2) DEFAULT 0.00,
  `observacao_variado` text DEFAULT NULL,
  `pedido_pago` tinyint(1) DEFAULT 0,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_loja`, `id_cliente`, `data_pedido`, `valor_variado`, `observacao_variado`, `pedido_pago`, `criado_em`) VALUES
(1, 3, 1, '2026-03-08', 20.00, 'TESTE', 1, '2026-03-07 21:15:36'),
(2, 3, 3, '2026-03-08', 0.00, '', 1, '2026-03-07 21:30:49'),
(3, 3, 31, '2026-03-08', 20.00, '2 aguas e 20 reais', 1, '2026-03-07 22:38:16'),
(4, 3, 46, '2026-03-08', 0.00, '', 1, '2026-03-08 01:13:32'),
(5, 1, 1, '2026-03-08', 50.00, 'TESTE DE SALVAMENTO.', 1, '2026-03-08 03:52:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_itens`
--

CREATE TABLE `pedidos_itens` (
  `id_item` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 0,
  `valor_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos_itens`
--

INSERT INTO `pedidos_itens` (`id_item`, `id_pedido`, `id_produto`, `quantidade`, `valor_unitario`) VALUES
(14, 1, 1, 15, 4.00),
(15, 2, 1, 4, 4.00),
(16, 3, 1, 2, 4.00),
(18, 4, 3, 1, 8.50),
(21, 5, 4, 13, 4.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_pagamento`
--

CREATE TABLE `pedido_pagamento` (
  `id_pedido` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido_pagamento`
--

INSERT INTO `pedido_pagamento` (`id_pedido`, `id_pagamento`, `valor`) VALUES
(1, 3, 30.00),
(1, 5, 30.00),
(2, 1, 3.20),
(2, 2, 3.20),
(2, 3, 3.20),
(2, 4, 3.20),
(2, 5, 3.20),
(3, 1, 7.00),
(3, 2, 7.00),
(3, 3, 7.00),
(3, 5, 7.00),
(4, 3, 4.25),
(4, 4, 4.25),
(5, 3, 52.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `id_loja` int(11) DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `emoji` varchar(10) DEFAULT NULL,
  `valor_venda` decimal(10,2) DEFAULT NULL,
  `valor_compra` decimal(10,2) DEFAULT NULL,
  `controlar_estoque` tinyint(1) DEFAULT 0,
  `estoque_atual` int(11) DEFAULT 0,
  `estoque_alerta` int(11) DEFAULT 0,
  `ordem_exibicao` int(11) DEFAULT 0,
  `id_fornecedor` int(11) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `id_loja`, `nome`, `emoji`, `valor_venda`, `valor_compra`, `controlar_estoque`, `estoque_atual`, `estoque_alerta`, `ordem_exibicao`, `id_fornecedor`, `ativo`) VALUES
(1, 3, 'Água', '💧', 4.00, 0.85, 1, 6, 5, 1, 1, 1),
(2, 3, 'Refri', '🥤', 6.00, 4.00, 1, 15, 0, 2, 1, 1),
(3, 3, 'Hamburgão', '🍔', 8.50, 4.50, 1, 14, 0, 3, 1, 1),
(4, 1, 'Água', '💧', 4.00, 0.85, 1, 15, 5, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_pagamento`
--

CREATE TABLE `tipos_pagamento` (
  `id_pagamento` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_pagamento`
--

INSERT INTO `tipos_pagamento` (`id_pagamento`, `nome`, `imagem`) VALUES
(1, 'Dinheiro', 'imagem.png'),
(2, 'Débito', 'imagem.png'),
(3, 'Crédito', 'imagem.png'),
(4, 'Pix', 'imagem.png'),
(5, 'Crédito (Ligamagic)', 'imagem.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `torneios`
--

CREATE TABLE `torneios` (
  `id_torneio` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_cardgame` int(11) NOT NULL,
  `nome_torneio` varchar(150) NOT NULL,
  `tipo_torneio` enum('suico_bo1','suico_bo3','elim_dupla_bo1','elim_dupla_bo3') NOT NULL,
  `tempo_rodada` int(11) DEFAULT 50,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `status` enum('em_andamento','finalizado','cancelado') DEFAULT 'em_andamento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `torneios`
--

INSERT INTO `torneios` (`id_torneio`, `id_loja`, `id_cardgame`, `nome_torneio`, `tipo_torneio`, `tempo_rodada`, `data_criacao`, `status`) VALUES
(8, 3, 1, 'Commander Semanal', 'suico_bo3', 50, '2026-03-06 22:20:27', 'finalizado'),
(9, 3, 1, 'Commander Semanal', 'suico_bo3', 50, '2026-03-06 22:21:22', 'finalizado'),
(10, 3, 1, 'Commander Semanal', 'suico_bo1', 50, '2026-03-06 22:22:19', 'finalizado'),
(11, 3, 1, 'Commander Semanal', 'suico_bo3', 50, '2026-03-06 22:23:15', 'finalizado'),
(12, 3, 8, 'One Piece Semanal', 'suico_bo1', 50, '2026-03-06 22:23:55', 'finalizado'),
(13, 3, 9, 'Torneio Mensal - Edição 1/2024', 'suico_bo3', 50, '2024-01-10 00:00:00', 'finalizado'),
(14, 3, 2, 'Torneio Mensal - Edição 1/2024', 'suico_bo3', 50, '2024-01-20 00:00:00', 'finalizado'),
(15, 3, 9, 'Torneio Mensal - Edição 2/2024', 'suico_bo3', 50, '2024-02-10 00:00:00', 'finalizado'),
(16, 3, 5, 'Torneio Mensal - Edição 2/2024', 'suico_bo3', 50, '2024-02-20 00:00:00', 'finalizado'),
(17, 3, 2, 'Torneio Mensal - Edição 3/2024', 'suico_bo3', 50, '2024-03-10 00:00:00', 'finalizado'),
(18, 3, 3, 'Torneio Mensal - Edição 3/2024', 'suico_bo3', 50, '2024-03-20 00:00:00', 'finalizado'),
(19, 3, 11, 'Torneio Mensal - Edição 4/2024', 'suico_bo3', 50, '2024-04-10 00:00:00', 'finalizado'),
(20, 3, 1, 'Torneio Mensal - Edição 4/2024', 'suico_bo3', 50, '2024-04-20 00:00:00', 'finalizado'),
(21, 3, 1, 'Torneio Mensal - Edição 5/2024', 'suico_bo3', 50, '2024-05-10 00:00:00', 'finalizado'),
(22, 3, 6, 'Torneio Mensal - Edição 5/2024', 'suico_bo3', 50, '2024-05-20 00:00:00', 'finalizado'),
(23, 3, 12, 'Torneio Mensal - Edição 6/2024', 'suico_bo3', 50, '2024-06-10 00:00:00', 'finalizado'),
(24, 3, 2, 'Torneio Mensal - Edição 6/2024', 'suico_bo3', 50, '2024-06-20 00:00:00', 'finalizado'),
(25, 3, 9, 'Torneio Mensal - Edição 7/2024', 'suico_bo3', 50, '2024-07-10 00:00:00', 'finalizado'),
(26, 3, 11, 'Torneio Mensal - Edição 7/2024', 'suico_bo3', 50, '2024-07-20 00:00:00', 'finalizado'),
(27, 3, 7, 'Torneio Mensal - Edição 8/2024', 'suico_bo3', 50, '2024-08-10 00:00:00', 'finalizado'),
(28, 3, 4, 'Torneio Mensal - Edição 8/2024', 'suico_bo3', 50, '2024-08-20 00:00:00', 'finalizado'),
(29, 3, 12, 'Torneio Mensal - Edição 9/2024', 'suico_bo3', 50, '2024-09-10 00:00:00', 'finalizado'),
(30, 3, 2, 'Torneio Mensal - Edição 9/2024', 'suico_bo3', 50, '2024-09-20 00:00:00', 'finalizado'),
(31, 3, 12, 'Torneio Mensal - Edição 10/2024', 'suico_bo3', 50, '2024-10-10 00:00:00', 'finalizado'),
(32, 3, 5, 'Torneio Mensal - Edição 10/2024', 'suico_bo3', 50, '2024-10-20 00:00:00', 'finalizado'),
(33, 3, 10, 'Torneio Mensal - Edição 11/2024', 'suico_bo3', 50, '2024-11-10 00:00:00', 'finalizado'),
(34, 3, 3, 'Torneio Mensal - Edição 11/2024', 'suico_bo3', 50, '2024-11-20 00:00:00', 'finalizado'),
(35, 3, 3, 'Torneio Mensal - Edição 12/2024', 'suico_bo3', 50, '2024-12-10 00:00:00', 'finalizado'),
(36, 3, 3, 'Torneio Mensal - Edição 12/2024', 'suico_bo3', 50, '2024-12-20 00:00:00', 'finalizado'),
(37, 3, 4, 'Torneio Mensal - Edição 1/2025', 'suico_bo3', 50, '2025-01-10 00:00:00', 'finalizado'),
(38, 3, 11, 'Torneio Mensal - Edição 1/2025', 'suico_bo3', 50, '2025-01-20 00:00:00', 'finalizado'),
(39, 3, 9, 'Torneio Mensal - Edição 2/2025', 'suico_bo3', 50, '2025-02-10 00:00:00', 'finalizado'),
(40, 3, 3, 'Torneio Mensal - Edição 2/2025', 'suico_bo3', 50, '2025-02-20 00:00:00', 'finalizado'),
(41, 3, 5, 'Torneio Mensal - Edição 3/2025', 'suico_bo3', 50, '2025-03-10 00:00:00', 'finalizado'),
(42, 3, 5, 'Torneio Mensal - Edição 3/2025', 'suico_bo3', 50, '2025-03-20 00:00:00', 'finalizado'),
(43, 3, 6, 'Torneio Mensal - Edição 4/2025', 'suico_bo3', 50, '2025-04-10 00:00:00', 'finalizado'),
(44, 3, 11, 'Torneio Mensal - Edição 4/2025', 'suico_bo3', 50, '2025-04-20 00:00:00', 'finalizado'),
(45, 3, 4, 'Torneio Mensal - Edição 5/2025', 'suico_bo3', 50, '2025-05-10 00:00:00', 'finalizado'),
(46, 3, 3, 'Torneio Mensal - Edição 5/2025', 'suico_bo3', 50, '2025-05-20 00:00:00', 'finalizado'),
(47, 3, 7, 'Torneio Mensal - Edição 6/2025', 'suico_bo3', 50, '2025-06-10 00:00:00', 'finalizado'),
(48, 3, 1, 'Torneio Mensal - Edição 6/2025', 'suico_bo3', 50, '2025-06-20 00:00:00', 'finalizado'),
(49, 3, 4, 'Torneio Mensal - Edição 7/2025', 'suico_bo3', 50, '2025-07-10 00:00:00', 'finalizado'),
(50, 3, 4, 'Torneio Mensal - Edição 7/2025', 'suico_bo3', 50, '2025-07-20 00:00:00', 'finalizado'),
(51, 3, 2, 'Torneio Mensal - Edição 8/2025', 'suico_bo3', 50, '2025-08-10 00:00:00', 'finalizado'),
(52, 3, 2, 'Torneio Mensal - Edição 8/2025', 'suico_bo3', 50, '2025-08-20 00:00:00', 'finalizado'),
(53, 3, 3, 'Torneio Mensal - Edição 9/2025', 'suico_bo3', 50, '2025-09-10 00:00:00', 'finalizado'),
(54, 3, 1, 'Torneio Mensal - Edição 9/2025', 'suico_bo3', 50, '2025-09-20 00:00:00', 'finalizado'),
(55, 3, 2, 'Torneio Mensal - Edição 10/2025', 'suico_bo3', 50, '2025-10-10 00:00:00', 'finalizado'),
(56, 3, 6, 'Torneio Mensal - Edição 10/2025', 'suico_bo3', 50, '2025-10-20 00:00:00', 'finalizado'),
(57, 3, 12, 'Torneio Mensal - Edição 11/2025', 'suico_bo3', 50, '2025-11-10 00:00:00', 'finalizado'),
(58, 3, 1, 'Torneio Mensal - Edição 11/2025', 'suico_bo3', 50, '2025-11-20 00:00:00', 'finalizado'),
(59, 3, 8, 'Torneio Mensal - Edição 12/2025', 'suico_bo3', 50, '2025-12-10 00:00:00', 'finalizado'),
(60, 3, 5, 'Torneio Mensal - Edição 12/2025', 'suico_bo3', 50, '2025-12-20 00:00:00', 'finalizado'),
(61, 3, 3, 'Torneio Mensal - Edição 1/2024', 'suico_bo3', 50, '2024-01-10 00:00:00', 'finalizado'),
(62, 3, 3, 'Torneio Mensal - Edição 1/2024', 'suico_bo3', 50, '2024-01-20 00:00:00', 'finalizado'),
(63, 3, 5, 'Torneio Mensal - Edição 2/2024', 'suico_bo3', 50, '2024-02-10 00:00:00', 'finalizado'),
(64, 3, 2, 'Torneio Mensal - Edição 2/2024', 'suico_bo3', 50, '2024-02-20 00:00:00', 'finalizado'),
(65, 3, 3, 'Torneio Mensal - Edição 3/2024', 'suico_bo3', 50, '2024-03-10 00:00:00', 'finalizado'),
(66, 3, 9, 'Torneio Mensal - Edição 3/2024', 'suico_bo3', 50, '2024-03-20 00:00:00', 'finalizado'),
(67, 3, 4, 'Torneio Mensal - Edição 4/2024', 'suico_bo3', 50, '2024-04-10 00:00:00', 'finalizado'),
(68, 3, 6, 'Torneio Mensal - Edição 4/2024', 'suico_bo3', 50, '2024-04-20 00:00:00', 'finalizado'),
(69, 3, 4, 'Torneio Mensal - Edição 5/2024', 'suico_bo3', 50, '2024-05-10 00:00:00', 'finalizado'),
(70, 3, 10, 'Torneio Mensal - Edição 5/2024', 'suico_bo3', 50, '2024-05-20 00:00:00', 'finalizado'),
(71, 3, 8, 'Torneio Mensal - Edição 6/2024', 'suico_bo3', 50, '2024-06-10 00:00:00', 'finalizado'),
(72, 3, 5, 'Torneio Mensal - Edição 6/2024', 'suico_bo3', 50, '2024-06-20 00:00:00', 'finalizado'),
(73, 3, 1, 'Torneio Mensal - Edição 7/2024', 'suico_bo3', 50, '2024-07-10 00:00:00', 'finalizado'),
(74, 3, 8, 'Torneio Mensal - Edição 7/2024', 'suico_bo3', 50, '2024-07-20 00:00:00', 'finalizado'),
(75, 3, 2, 'Torneio Mensal - Edição 8/2024', 'suico_bo3', 50, '2024-08-10 00:00:00', 'finalizado'),
(76, 3, 8, 'Torneio Mensal - Edição 8/2024', 'suico_bo3', 50, '2024-08-20 00:00:00', 'finalizado'),
(77, 3, 1, 'Torneio Mensal - Edição 9/2024', 'suico_bo3', 50, '2024-09-10 00:00:00', 'finalizado'),
(78, 3, 3, 'Torneio Mensal - Edição 9/2024', 'suico_bo3', 50, '2024-09-20 00:00:00', 'finalizado'),
(79, 3, 7, 'Torneio Mensal - Edição 10/2024', 'suico_bo3', 50, '2024-10-10 00:00:00', 'finalizado'),
(80, 3, 7, 'Torneio Mensal - Edição 10/2024', 'suico_bo3', 50, '2024-10-20 00:00:00', 'finalizado'),
(81, 3, 1, 'Torneio Mensal - Edição 11/2024', 'suico_bo3', 50, '2024-11-10 00:00:00', 'finalizado'),
(82, 3, 11, 'Torneio Mensal - Edição 11/2024', 'suico_bo3', 50, '2024-11-20 00:00:00', 'finalizado'),
(83, 3, 3, 'Torneio Mensal - Edição 12/2024', 'suico_bo3', 50, '2024-12-10 00:00:00', 'finalizado'),
(84, 3, 12, 'Torneio Mensal - Edição 12/2024', 'suico_bo3', 50, '2024-12-20 00:00:00', 'finalizado'),
(85, 3, 4, 'Torneio Mensal - Edição 1/2025', 'suico_bo3', 50, '2025-01-10 00:00:00', 'finalizado'),
(86, 3, 8, 'Torneio Mensal - Edição 1/2025', 'suico_bo3', 50, '2025-01-20 00:00:00', 'finalizado'),
(87, 3, 2, 'Torneio Mensal - Edição 2/2025', 'suico_bo3', 50, '2025-02-10 00:00:00', 'finalizado'),
(88, 3, 12, 'Torneio Mensal - Edição 2/2025', 'suico_bo3', 50, '2025-02-20 00:00:00', 'finalizado'),
(89, 3, 5, 'Torneio Mensal - Edição 3/2025', 'suico_bo3', 50, '2025-03-10 00:00:00', 'finalizado'),
(90, 3, 2, 'Torneio Mensal - Edição 3/2025', 'suico_bo3', 50, '2025-03-20 00:00:00', 'finalizado'),
(91, 3, 9, 'Torneio Mensal - Edição 4/2025', 'suico_bo3', 50, '2025-04-10 00:00:00', 'finalizado'),
(92, 3, 9, 'Torneio Mensal - Edição 4/2025', 'suico_bo3', 50, '2025-04-20 00:00:00', 'finalizado'),
(93, 3, 2, 'Torneio Mensal - Edição 5/2025', 'suico_bo3', 50, '2025-05-10 00:00:00', 'finalizado'),
(94, 3, 7, 'Torneio Mensal - Edição 5/2025', 'suico_bo3', 50, '2025-05-20 00:00:00', 'finalizado'),
(95, 3, 5, 'Torneio Mensal - Edição 6/2025', 'suico_bo3', 50, '2025-06-10 00:00:00', 'finalizado'),
(96, 3, 5, 'Torneio Mensal - Edição 6/2025', 'suico_bo3', 50, '2025-06-20 00:00:00', 'finalizado'),
(97, 3, 5, 'Torneio Mensal - Edição 7/2025', 'suico_bo3', 50, '2025-07-10 00:00:00', 'finalizado'),
(98, 3, 8, 'Torneio Mensal - Edição 7/2025', 'suico_bo3', 50, '2025-07-20 00:00:00', 'finalizado'),
(99, 3, 8, 'Torneio Mensal - Edição 8/2025', 'suico_bo3', 50, '2025-08-10 00:00:00', 'finalizado'),
(100, 3, 7, 'Torneio Mensal - Edição 8/2025', 'suico_bo3', 50, '2025-08-20 00:00:00', 'finalizado'),
(101, 3, 7, 'Torneio Mensal - Edição 9/2025', 'suico_bo3', 50, '2025-09-10 00:00:00', 'finalizado'),
(102, 3, 9, 'Torneio Mensal - Edição 9/2025', 'suico_bo3', 50, '2025-09-20 00:00:00', 'finalizado'),
(103, 3, 1, 'Torneio Mensal - Edição 10/2025', 'suico_bo3', 50, '2025-10-10 00:00:00', 'finalizado'),
(104, 3, 10, 'Torneio Mensal - Edição 10/2025', 'suico_bo3', 50, '2025-10-20 00:00:00', 'finalizado'),
(105, 3, 2, 'Torneio Mensal - Edição 11/2025', 'suico_bo3', 50, '2025-11-10 00:00:00', 'finalizado'),
(106, 3, 10, 'Torneio Mensal - Edição 11/2025', 'suico_bo3', 50, '2025-11-20 00:00:00', 'finalizado'),
(107, 3, 8, 'Torneio Mensal - Edição 12/2025', 'suico_bo3', 50, '2025-12-10 00:00:00', 'finalizado'),
(108, 3, 8, 'Torneio Mensal - Edição 12/2025', 'suico_bo3', 50, '2025-12-20 00:00:00', 'finalizado'),
(109, 3, 11, 'Teste de MD3', 'suico_bo3', 50, '2026-03-07 20:45:19', 'finalizado'),
(110, 3, 9, 'Teste de MD3', 'suico_bo3', 50, '2026-03-07 20:46:12', 'finalizado'),
(112, 3, 1, 'Teste de MD3', 'suico_bo3', 50, '2026-03-07 23:10:25', 'finalizado'),
(113, 3, 1, 'Teste de MD3', 'elim_dupla_bo1', 50, '2026-03-07 23:39:51', 'finalizado'),
(116, 3, 8, 'Teste de MD3', 'suico_bo3', 50, '2026-03-08 00:58:25', 'finalizado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `torneio_debug_logs`
--

CREATE TABLE `torneio_debug_logs` (
  `id` int(11) NOT NULL,
  `id_torneio` int(11) DEFAULT NULL,
  `acao` varchar(50) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `criado_em` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `torneio_debug_logs`
--

INSERT INTO `torneio_debug_logs` (`id`, `id_torneio`, `acao`, `detalhes`, `criado_em`) VALUES
(1, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:40:17'),
(2, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:47:06'),
(3, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:47:06'),
(4, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:47:06'),
(5, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:47:07'),
(6, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:47:07'),
(7, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:47:07'),
(8, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:49:02'),
(9, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:49:03'),
(10, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:49:04'),
(11, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:51:22'),
(12, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:53:34'),
(13, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:30'),
(14, 113, 'RESULTADO_SALVO_PARTIDA_88', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:48'),
(15, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:48'),
(16, 113, 'RESULTADO_SALVO_PARTIDA_89', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:49'),
(17, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:49'),
(18, 113, 'RESULTADO_SALVO_PARTIDA_90', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:50'),
(19, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"BOTÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:50'),
(20, 113, 'RESULTADO_SALVO_PARTIDA_91', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:52'),
(21, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":\"-\"},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:52'),
(22, 113, 'RESULTADO_SALVO_PARTIDA_95', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:55'),
(23, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:55'),
(24, 113, 'RESULTADO_SALVO_PARTIDA_96', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:57'),
(25, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:57'),
(26, 113, 'RESULTADO_SALVO_PARTIDA_92', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:59'),
(27, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:55:59'),
(28, 113, 'RESULTADO_SALVO_PARTIDA_93', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:00'),
(29, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":\"-\"},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:00'),
(30, 113, 'RESULTADO_SALVO_PARTIDA_97', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:02');
INSERT INTO `torneio_debug_logs` (`id`, `id_torneio`, `acao`, `detalhes`, `criado_em`) VALUES
(31, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":\"-\"},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:02'),
(32, 113, 'RESULTADO_SALVO_PARTIDA_98', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:04'),
(33, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":\"-\"},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:04'),
(34, 113, 'RESULTADO_SALVO_PARTIDA_94', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:06'),
(35, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":\"-\"},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"TBD\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:06'),
(36, 113, 'RESULTADO_SALVO_PARTIDA_99', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:10'),
(37, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":\"-\"},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:10'),
(38, 113, 'RESULTADO_SALVO_PARTIDA_100', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:13'),
(39, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 02:56:13'),
(40, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:17'),
(41, 113, 'EXEC_AVANCAR_WB_R1', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:31'),
(42, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:31'),
(43, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:31'),
(44, 113, 'EXEC_AVANCAR_LB_R1', '{\"info_torneio\":{\"rodada_ativa_numero\":1,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:35'),
(45, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":2,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:35'),
(46, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":2,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:35'),
(47, 113, 'EXEC_AVANCAR_LB_R2', '{\"info_torneio\":{\"rodada_ativa_numero\":2,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:36'),
(48, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":2,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:36'),
(49, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":2,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:36'),
(50, 113, 'EXEC_AVANCAR_WB_R2', '{\"info_torneio\":{\"rodada_ativa_numero\":2,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Barry Allen\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:37'),
(51, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":3,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:37'),
(52, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":3,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:37'),
(53, 113, 'EXEC_AVANCAR_LB_R3', '{\"info_torneio\":{\"rodada_ativa_numero\":3,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:37'),
(54, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":3,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:37'),
(55, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":3,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:37'),
(56, 113, 'EXEC_AVANCAR_WB_R3', '{\"info_torneio\":{\"rodada_ativa_numero\":3,\"rodada_ativa_chave\":\"WB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"TBD\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:38'),
(57, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:38');
INSERT INTO `torneio_debug_logs` (`id`, `id_torneio`, `acao`, `detalhes`, `criado_em`) VALUES
(58, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:38'),
(59, 113, 'EXEC_AVANCAR_LB_R4', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"LB\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"TBD\",\"v\":\"-\"}]}', '2026-03-08 03:03:38'),
(60, 113, 'AVANCO_CONCLUIDO', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"GF\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":\"-\"}]}', '2026-03-08 03:03:38'),
(61, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"GF\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":\"-\"}]}', '2026-03-08 03:03:38'),
(62, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"GF\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"BOTÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":\"-\"}]}', '2026-03-08 03:04:51'),
(63, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"GF\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:10:09'),
(64, 113, 'EXEC_AVANCAR_GF_R4', '{\"info_torneio\":{\"rodada_ativa_numero\":4,\"rodada_ativa_chave\":\"GF\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:10:16'),
(65, 113, 'TORNEIO_FINALIZADO', '{\"info_torneio\":{\"rodada_ativa_numero\":\"N\\/A\",\"rodada_ativa_chave\":\"N\\/A\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:10:16'),
(66, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":\"N\\/A\",\"rodada_ativa_chave\":\"N\\/A\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:10:16'),
(67, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":\"N\\/A\",\"rodada_ativa_chave\":\"N\\/A\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:10:22'),
(68, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":\"N\\/A\",\"rodada_ativa_chave\":\"N\\/A\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:11:08'),
(69, 113, 'VIEW_LOAD', '{\"info_torneio\":{\"rodada_ativa_numero\":\"N\\/A\",\"rodada_ativa_chave\":\"N\\/A\"},\"pareamentos\":[{\"id\":88,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Doc Brown\",\"v\":8},{\"id\":89,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Marta Nobre Maciel Martins\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":2},{\"id\":90,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Daniel Nobre Ferreira Martins\",\"v\":3},{\"id\":91,\"ch\":\"WB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Barry Allen\",\"p2\":\"Luke Skywalker\",\"v\":12},{\"id\":95,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Marta Nobre Maciel Martins\",\"v\":40},{\"id\":96,\"ch\":\"LB\",\"rd\":1,\"ui\":\"NÃO\",\"p1\":\"Daniel Nobre Ferreira Martins\",\"p2\":\"Barry Allen\",\"v\":44},{\"id\":92,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":8},{\"id\":93,\"ch\":\"WB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":3},{\"id\":97,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":98,\"ch\":\"LB\",\"rd\":2,\"ui\":\"NÃO\",\"p1\":\"Lucas Nobre Ferreira Martins\",\"p2\":\"Luke Skywalker\",\"v\":2},{\"id\":94,\"ch\":\"WB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Maria Edicia Nobre\",\"p2\":\"Adilson Ferreira Martins\",\"v\":3},{\"id\":99,\"ch\":\"LB\",\"rd\":3,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Lucas Nobre Ferreira Martins\",\"v\":40},{\"id\":100,\"ch\":\"LB\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Doc Brown\",\"p2\":\"Doc Brown\",\"v\":40},{\"id\":101,\"ch\":\"GF\",\"rd\":4,\"ui\":\"NÃO\",\"p1\":\"Adilson Ferreira Martins\",\"p2\":\"Doc Brown\",\"v\":3}]}', '2026-03-08 03:46:33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `torneio_participantes`
--

CREATE TABLE `torneio_participantes` (
  `id_torneio` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `torneio_participantes`
--

INSERT INTO `torneio_participantes` (`id_torneio`, `id_cliente`) VALUES
(8, 2),
(8, 4),
(8, 5),
(8, 8),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 8),
(10, 2),
(10, 3),
(10, 4),
(10, 5),
(10, 6),
(10, 8),
(11, 2),
(11, 3),
(11, 5),
(11, 6),
(12, 2),
(12, 4),
(12, 7),
(12, 8),
(13, 1),
(13, 4),
(13, 17),
(13, 30),
(14, 2),
(14, 3),
(14, 4),
(14, 5),
(14, 7),
(14, 8),
(14, 14),
(14, 22),
(15, 1),
(15, 4),
(15, 17),
(15, 30),
(16, 1),
(16, 5),
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(17, 8),
(17, 22),
(17, 33),
(18, 1),
(18, 9),
(18, 23),
(18, 28),
(18, 45),
(19, 1),
(19, 25),
(19, 26),
(19, 39),
(19, 47),
(20, 2),
(20, 3),
(20, 5),
(20, 8),
(20, 12),
(20, 40),
(20, 41),
(20, 44),
(21, 1),
(21, 2),
(21, 3),
(21, 5),
(21, 8),
(21, 12),
(21, 40),
(21, 42),
(22, 1),
(22, 15),
(22, 18),
(23, 1),
(23, 19),
(23, 21),
(23, 31),
(23, 32),
(23, 46),
(24, 1),
(24, 2),
(24, 4),
(24, 5),
(24, 7),
(24, 8),
(24, 14),
(24, 33),
(25, 1),
(25, 4),
(25, 17),
(25, 30),
(26, 1),
(26, 25),
(26, 26),
(26, 39),
(26, 47),
(27, 1),
(28, 1),
(28, 24),
(28, 34),
(28, 37),
(28, 38),
(28, 48),
(29, 1),
(29, 19),
(29, 21),
(29, 31),
(29, 32),
(29, 46),
(30, 2),
(30, 4),
(30, 5),
(30, 7),
(30, 8),
(30, 14),
(30, 22),
(30, 33),
(31, 1),
(31, 19),
(31, 21),
(31, 31),
(31, 32),
(31, 46),
(32, 1),
(32, 5),
(33, 1),
(33, 13),
(33, 16),
(33, 27),
(33, 35),
(34, 1),
(34, 9),
(34, 23),
(34, 28),
(34, 45),
(35, 1),
(35, 9),
(35, 23),
(35, 28),
(35, 45),
(36, 1),
(36, 9),
(36, 23),
(36, 28),
(36, 45),
(37, 1),
(37, 24),
(37, 34),
(37, 37),
(37, 38),
(37, 48),
(38, 1),
(38, 25),
(38, 26),
(38, 39),
(38, 47),
(39, 1),
(39, 4),
(39, 17),
(39, 30),
(40, 1),
(40, 9),
(40, 23),
(40, 28),
(40, 45),
(41, 1),
(41, 5),
(42, 1),
(42, 5),
(43, 1),
(43, 15),
(43, 18),
(44, 1),
(44, 25),
(44, 26),
(44, 39),
(44, 47),
(45, 1),
(45, 24),
(45, 34),
(45, 37),
(45, 38),
(45, 48),
(46, 1),
(46, 9),
(46, 23),
(46, 28),
(46, 45),
(47, 1),
(48, 1),
(48, 4),
(48, 6),
(48, 8),
(48, 12),
(48, 20),
(48, 40),
(48, 44),
(49, 1),
(49, 24),
(49, 34),
(49, 37),
(49, 38),
(49, 48),
(50, 1),
(50, 24),
(50, 34),
(50, 37),
(50, 38),
(50, 48),
(51, 1),
(51, 3),
(51, 4),
(51, 5),
(51, 7),
(51, 8),
(51, 14),
(51, 33),
(52, 1),
(52, 2),
(52, 5),
(52, 7),
(52, 8),
(52, 14),
(52, 22),
(52, 33),
(53, 1),
(53, 9),
(53, 23),
(53, 28),
(53, 45),
(54, 1),
(54, 2),
(54, 4),
(54, 12),
(54, 20),
(54, 40),
(54, 42),
(54, 44),
(55, 2),
(55, 3),
(55, 4),
(55, 5),
(55, 7),
(55, 14),
(55, 22),
(55, 33),
(56, 1),
(56, 15),
(56, 18),
(57, 1),
(57, 19),
(57, 21),
(57, 31),
(57, 32),
(57, 46),
(58, 1),
(58, 2),
(58, 3),
(58, 5),
(58, 6),
(58, 12),
(58, 40),
(58, 42),
(59, 1),
(59, 2),
(59, 4),
(59, 7),
(59, 11),
(59, 29),
(59, 36),
(59, 43),
(60, 1),
(60, 5),
(61, 1),
(61, 9),
(61, 23),
(61, 28),
(61, 45),
(62, 1),
(62, 9),
(62, 23),
(62, 28),
(62, 45),
(63, 1),
(63, 5),
(64, 1),
(64, 2),
(64, 3),
(64, 5),
(64, 7),
(64, 8),
(64, 22),
(64, 33),
(65, 1),
(65, 9),
(65, 23),
(65, 28),
(65, 45),
(66, 1),
(66, 4),
(66, 17),
(66, 30),
(67, 1),
(67, 24),
(67, 34),
(67, 37),
(67, 38),
(67, 48),
(68, 1),
(68, 15),
(68, 18),
(69, 1),
(69, 24),
(69, 34),
(69, 37),
(69, 38),
(69, 48),
(70, 1),
(70, 13),
(70, 16),
(70, 27),
(70, 35),
(71, 1),
(71, 2),
(71, 4),
(71, 8),
(71, 10),
(71, 11),
(71, 29),
(71, 36),
(72, 1),
(72, 5),
(73, 1),
(73, 4),
(73, 6),
(73, 12),
(73, 20),
(73, 41),
(73, 42),
(73, 44),
(74, 2),
(74, 4),
(74, 7),
(74, 8),
(74, 10),
(74, 29),
(74, 36),
(74, 43),
(75, 1),
(75, 2),
(75, 3),
(75, 5),
(75, 7),
(75, 14),
(75, 22),
(75, 33),
(76, 1),
(76, 2),
(76, 4),
(76, 7),
(76, 8),
(76, 29),
(76, 36),
(76, 43),
(77, 1),
(77, 2),
(77, 6),
(77, 12),
(77, 20),
(77, 40),
(77, 41),
(77, 44),
(78, 1),
(78, 9),
(78, 23),
(78, 28),
(78, 45),
(79, 1),
(80, 1),
(81, 2),
(81, 3),
(81, 4),
(81, 6),
(81, 12),
(81, 40),
(81, 41),
(81, 44),
(82, 1),
(82, 25),
(82, 26),
(82, 39),
(82, 47),
(83, 1),
(83, 9),
(83, 23),
(83, 28),
(83, 45),
(84, 1),
(84, 19),
(84, 21),
(84, 31),
(84, 32),
(84, 46),
(85, 1),
(85, 24),
(85, 34),
(85, 37),
(85, 38),
(85, 48),
(86, 1),
(86, 4),
(86, 7),
(86, 8),
(86, 10),
(86, 11),
(86, 36),
(86, 43),
(87, 1),
(87, 2),
(87, 3),
(87, 4),
(87, 7),
(87, 8),
(87, 14),
(87, 22),
(88, 1),
(88, 19),
(88, 21),
(88, 31),
(88, 32),
(88, 46),
(89, 1),
(89, 5),
(90, 3),
(90, 4),
(90, 5),
(90, 7),
(90, 8),
(90, 14),
(90, 22),
(90, 33),
(91, 1),
(91, 4),
(91, 17),
(91, 30),
(92, 1),
(92, 4),
(92, 17),
(92, 30),
(93, 1),
(93, 2),
(93, 4),
(93, 5),
(93, 7),
(93, 8),
(93, 14),
(93, 33),
(94, 1),
(95, 1),
(95, 5),
(96, 1),
(96, 5),
(97, 1),
(97, 5),
(98, 1),
(98, 2),
(98, 7),
(98, 10),
(98, 11),
(98, 29),
(98, 36),
(98, 43),
(99, 2),
(99, 7),
(99, 8),
(99, 10),
(99, 11),
(99, 29),
(99, 36),
(99, 43),
(100, 1),
(101, 1),
(102, 1),
(102, 4),
(102, 17),
(102, 30),
(103, 1),
(103, 4),
(103, 5),
(103, 6),
(103, 8),
(103, 40),
(103, 42),
(103, 44),
(104, 1),
(104, 13),
(104, 16),
(104, 27),
(104, 35),
(105, 1),
(105, 2),
(105, 3),
(105, 5),
(105, 7),
(105, 14),
(105, 22),
(105, 33),
(106, 1),
(106, 13),
(106, 16),
(106, 27),
(106, 35),
(107, 2),
(107, 4),
(107, 8),
(107, 10),
(107, 11),
(107, 29),
(107, 36),
(107, 43),
(108, 1),
(108, 2),
(108, 4),
(108, 7),
(108, 8),
(108, 10),
(108, 11),
(108, 29),
(109, 25),
(109, 26),
(109, 39),
(109, 47),
(110, 1),
(110, 4),
(110, 17),
(110, 30),
(112, 2),
(112, 5),
(112, 8),
(112, 12),
(112, 40),
(112, 44),
(113, 2),
(113, 3),
(113, 4),
(113, 5),
(113, 8),
(113, 12),
(113, 40),
(113, 44),
(116, 2),
(116, 4),
(116, 8),
(116, 36),
(116, 43);

-- --------------------------------------------------------

--
-- Estrutura para tabela `torneio_partidas`
--

CREATE TABLE `torneio_partidas` (
  `id_partida` int(11) NOT NULL,
  `id_rodada` int(11) NOT NULL,
  `id_jogador1` int(11) DEFAULT NULL,
  `id_jogador2` int(11) DEFAULT NULL,
  `resultado` enum('jogador1_vitoria','jogador2_vitoria','empate','BYE','jogador1_2x0','jogador1_2x1','jogador2_2x0','jogador2_2x1') DEFAULT NULL,
  `vencedor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `torneio_partidas`
--

INSERT INTO `torneio_partidas` (`id_partida`, `id_rodada`, `id_jogador1`, `id_jogador2`, `resultado`, `vencedor_id`) VALUES
(41, 17, 4, 2, 'jogador1_2x1', 4),
(42, 17, 5, 8, 'jogador2_2x1', 8),
(43, 18, 8, 4, 'jogador1_2x1', 8),
(44, 18, 5, 2, 'jogador2_2x1', 2),
(45, 19, 8, 4, 'jogador1_2x1', 8),
(46, 19, 2, 5, 'empate', NULL),
(47, 19, 3, 6, 'jogador1_2x1', 3),
(48, 20, 3, 8, 'jogador2_2x1', 8),
(49, 20, 5, 4, 'empate', NULL),
(50, 20, 2, 6, 'jogador1_2x1', 2),
(51, 21, 8, 2, 'jogador2_2x1', 2),
(52, 21, 3, 5, 'jogador2_2x0', 5),
(53, 21, 4, 6, 'jogador1_2x0', 4),
(54, 22, 6, 5, 'jogador2_vitoria', 5),
(55, 22, 4, 2, 'jogador1_vitoria', 4),
(56, 22, 8, 3, 'jogador2_vitoria', 3),
(57, 23, 3, 5, 'jogador2_vitoria', 5),
(58, 23, 4, 8, 'jogador1_vitoria', 4),
(59, 23, 2, 6, 'jogador2_vitoria', 6),
(60, 24, 5, 4, 'jogador1_vitoria', 5),
(61, 24, 3, 6, 'jogador1_vitoria', 3),
(62, 24, 2, 8, 'jogador2_vitoria', 8),
(63, 25, 5, 2, 'jogador1_2x1', 5),
(64, 25, 6, 3, 'jogador2_2x1', 3),
(65, 26, 3, 5, 'jogador2_2x0', 5),
(66, 26, 2, 6, 'jogador1_2x0', 2),
(67, 27, 2, 8, 'jogador1_vitoria', 2),
(68, 27, 7, 4, 'jogador2_vitoria', 4),
(69, 28, 2, 4, 'jogador2_vitoria', 4),
(70, 28, 8, 7, 'jogador1_vitoria', 8),
(71, 29, 26, 39, 'jogador1_2x0', 26),
(72, 29, 47, 25, 'jogador2_2x0', 25),
(73, 30, 26, 25, 'jogador2_2x1', 25),
(74, 30, 47, 39, 'jogador1_2x1', 47),
(75, 31, 30, 4, 'jogador1_2x1', 30),
(76, 31, 17, 1, 'jogador2_2x1', 1),
(77, 32, 1, 30, 'jogador2_2x0', 30),
(78, 32, 17, 4, 'jogador1_2x1', 17),
(79, 33, 40, 2, 'jogador1_2x0', 40),
(80, 33, 12, 8, 'jogador2_2x0', 8),
(81, 33, 44, 5, 'jogador1_2x1', 44),
(82, 34, 40, 8, 'jogador2_2x1', 8),
(83, 34, 44, 2, 'empate', NULL),
(84, 34, 5, 12, 'jogador1_2x1', 5),
(85, 35, 8, 44, 'jogador1_2x1', 8),
(86, 35, 40, 5, 'jogador2_2x1', 5),
(87, 35, 2, 12, 'jogador1_2x1', 2),
(88, 36, 8, 40, 'jogador1_vitoria', 8),
(89, 36, 4, 2, 'jogador2_vitoria', 2),
(90, 36, 3, 5, 'jogador1_vitoria', 3),
(91, 36, 44, 12, 'jogador2_vitoria', 12),
(92, 37, 8, 2, 'jogador1_vitoria', 8),
(93, 37, 3, 12, 'jogador1_vitoria', 3),
(94, 38, 8, 3, 'jogador2_vitoria', 3),
(95, 39, 40, 4, 'jogador1_vitoria', 40),
(96, 39, 5, 44, 'jogador2_vitoria', 44),
(97, 40, 40, 2, 'jogador1_vitoria', 40),
(98, 40, 2, 12, 'jogador1_vitoria', 2),
(99, 41, 40, 2, 'jogador1_vitoria', 40),
(100, 42, 40, 40, 'jogador2_vitoria', 40),
(101, 43, 3, 40, 'jogador1_2x0', 3),
(102, 45, 43, 2, 'jogador1_2x1', 43),
(103, 45, 8, 4, 'jogador2_2x1', 4),
(104, 45, 36, NULL, 'jogador1_vitoria', NULL),
(105, 46, 36, 4, 'jogador1_2x1', 36),
(106, 46, 43, 8, 'jogador2_2x1', 8),
(107, 46, 2, NULL, 'jogador1_vitoria', NULL),
(108, 47, 36, 8, 'jogador1_2x1', 36),
(109, 47, 4, 43, 'jogador1_2x0', 4),
(110, 47, 2, NULL, 'jogador1_vitoria', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `torneio_resultados_finais`
--

CREATE TABLE `torneio_resultados_finais` (
  `id_torneio` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `pontos_totais` int(11) DEFAULT 0,
  `posicao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `torneio_resultados_finais`
--

INSERT INTO `torneio_resultados_finais` (`id_torneio`, `id_cliente`, `pontos_totais`, `posicao`) VALUES
(8, 2, 3, 3),
(8, 4, 3, 2),
(8, 5, 0, 4),
(8, 8, 6, 1),
(9, 2, 7, 1),
(9, 3, 3, 5),
(9, 4, 4, 4),
(9, 5, 5, 3),
(9, 6, 0, 6),
(9, 8, 6, 2),
(10, 2, 0, 6),
(10, 3, 6, 2),
(10, 4, 6, 3),
(10, 5, 9, 1),
(10, 6, 3, 4),
(10, 8, 3, 5),
(11, 2, 3, 2),
(11, 3, 3, 3),
(11, 5, 6, 1),
(11, 6, 0, 4),
(12, 2, 3, 2),
(12, 4, 6, 1),
(12, 7, 0, 4),
(12, 8, 3, 3),
(13, 1, 9, 1),
(13, 17, 6, 2),
(14, 2, 6, 2),
(14, 8, 9, 1),
(15, 17, 9, 1),
(15, 30, 6, 2),
(16, 1, 9, 1),
(16, 5, 6, 2),
(17, 3, 6, 2),
(17, 22, 9, 1),
(18, 9, 6, 2),
(18, 45, 9, 1),
(19, 1, 9, 1),
(19, 25, 6, 2),
(20, 2, 9, 1),
(20, 40, 6, 2),
(21, 1, 6, 2),
(21, 8, 9, 1),
(22, 1, 6, 2),
(22, 18, 9, 1),
(23, 19, 6, 2),
(23, 46, 9, 1),
(24, 2, 9, 1),
(24, 14, 6, 2),
(25, 1, 9, 1),
(25, 17, 6, 2),
(26, 1, 9, 1),
(26, 47, 6, 2),
(27, 1, 9, 1),
(28, 1, 6, 2),
(28, 37, 9, 1),
(29, 1, 6, 2),
(29, 32, 9, 1),
(30, 22, 6, 2),
(30, 33, 9, 1),
(31, 21, 9, 1),
(31, 46, 6, 2),
(32, 1, 9, 1),
(32, 5, 6, 2),
(33, 1, 6, 2),
(33, 13, 9, 1),
(34, 1, 9, 1),
(34, 28, 6, 2),
(35, 1, 9, 1),
(35, 9, 6, 2),
(36, 9, 6, 2),
(36, 23, 9, 1),
(37, 1, 9, 1),
(37, 34, 6, 2),
(38, 1, 6, 2),
(38, 25, 9, 1),
(39, 17, 6, 2),
(39, 30, 9, 1),
(40, 23, 6, 2),
(40, 45, 9, 1),
(41, 1, 9, 1),
(41, 5, 6, 2),
(42, 1, 9, 1),
(42, 5, 6, 2),
(43, 1, 9, 1),
(43, 18, 6, 2),
(44, 25, 6, 2),
(44, 39, 9, 1),
(45, 34, 9, 1),
(45, 48, 6, 2),
(46, 1, 6, 2),
(46, 23, 9, 1),
(47, 1, 9, 1),
(48, 4, 9, 1),
(48, 20, 6, 2),
(49, 1, 6, 2),
(49, 48, 9, 1),
(50, 24, 9, 1),
(50, 37, 6, 2),
(51, 3, 9, 1),
(51, 14, 6, 2),
(52, 8, 9, 1),
(52, 33, 6, 2),
(53, 28, 9, 1),
(53, 45, 6, 2),
(54, 2, 6, 2),
(54, 20, 9, 1),
(55, 4, 9, 1),
(55, 14, 6, 2),
(56, 1, 9, 1),
(56, 15, 6, 2),
(57, 21, 9, 1),
(57, 32, 6, 2),
(58, 1, 6, 2),
(58, 12, 9, 1),
(59, 4, 6, 2),
(59, 36, 9, 1),
(60, 1, 9, 1),
(60, 5, 6, 2),
(61, 1, 9, 1),
(61, 45, 6, 2),
(62, 1, 9, 1),
(62, 23, 6, 2),
(63, 1, 9, 1),
(63, 5, 6, 2),
(64, 1, 9, 1),
(64, 33, 6, 2),
(65, 1, 9, 1),
(65, 28, 6, 2),
(66, 17, 9, 1),
(66, 30, 6, 2),
(67, 1, 9, 1),
(67, 34, 6, 2),
(68, 1, 9, 1),
(68, 15, 6, 2),
(69, 37, 6, 2),
(69, 48, 9, 1),
(70, 16, 6, 2),
(70, 35, 9, 1),
(71, 1, 9, 1),
(71, 4, 6, 2),
(72, 1, 6, 2),
(72, 5, 9, 1),
(73, 20, 9, 1),
(73, 42, 6, 2),
(74, 4, 9, 1),
(74, 29, 6, 2),
(75, 3, 6, 2),
(75, 7, 9, 1),
(76, 1, 9, 1),
(76, 4, 6, 2),
(77, 12, 6, 2),
(77, 41, 9, 1),
(78, 23, 6, 2),
(78, 28, 9, 1),
(79, 1, 9, 1),
(80, 1, 9, 1),
(81, 2, 9, 1),
(81, 44, 6, 2),
(82, 26, 6, 2),
(82, 47, 9, 1),
(83, 9, 9, 1),
(83, 45, 6, 2),
(84, 21, 9, 1),
(84, 32, 6, 2),
(85, 37, 6, 2),
(85, 48, 9, 1),
(86, 1, 9, 1),
(86, 43, 6, 2),
(87, 2, 6, 2),
(87, 8, 9, 1),
(88, 1, 9, 1),
(88, 31, 6, 2),
(89, 1, 6, 2),
(89, 5, 9, 1),
(90, 22, 9, 1),
(90, 33, 6, 2),
(91, 17, 6, 2),
(91, 30, 9, 1),
(92, 4, 9, 1),
(92, 30, 6, 2),
(93, 2, 6, 2),
(93, 4, 9, 1),
(94, 1, 9, 1),
(95, 1, 9, 1),
(95, 5, 6, 2),
(96, 1, 6, 2),
(96, 5, 9, 1),
(97, 1, 9, 1),
(97, 5, 6, 2),
(98, 1, 9, 1),
(98, 36, 6, 2),
(99, 2, 9, 1),
(99, 29, 6, 2),
(100, 1, 9, 1),
(101, 1, 9, 1),
(102, 1, 9, 1),
(102, 17, 6, 2),
(103, 5, 6, 2),
(103, 8, 9, 1),
(104, 13, 9, 1),
(104, 35, 6, 2),
(105, 2, 9, 1),
(105, 14, 6, 2),
(106, 13, 9, 1),
(106, 16, 6, 2),
(107, 2, 6, 2),
(107, 29, 9, 1),
(108, 4, 9, 1),
(108, 11, 6, 2),
(109, 25, 6, 1),
(109, 26, 3, 2),
(109, 39, 0, 4),
(109, 47, 3, 3),
(110, 1, 3, 2),
(110, 4, 0, 4),
(110, 17, 3, 3),
(110, 30, 6, 1),
(112, 2, 4, 4),
(112, 5, 6, 2),
(112, 8, 9, 1),
(112, 12, 0, 6),
(112, 40, 3, 5),
(112, 44, 4, 3),
(116, 2, 6, 3),
(116, 4, 6, 2),
(116, 8, 3, 4),
(116, 36, 9, 1),
(116, 43, 3, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `torneio_rodadas`
--

CREATE TABLE `torneio_rodadas` (
  `id_rodada` int(11) NOT NULL,
  `id_torneio` int(11) NOT NULL,
  `numero_rodada` int(11) NOT NULL,
  `tempo_restante` int(11) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pendente',
  `tipo_chave` varchar(10) DEFAULT 'WB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `torneio_rodadas`
--

INSERT INTO `torneio_rodadas` (`id_rodada`, `id_torneio`, `numero_rodada`, `tempo_restante`, `status`, `tipo_chave`) VALUES
(17, 8, 1, NULL, 'em_andamento', 'WB'),
(18, 8, 2, NULL, 'em_andamento', 'WB'),
(19, 9, 1, NULL, 'em_andamento', 'WB'),
(20, 9, 2, NULL, 'em_andamento', 'WB'),
(21, 9, 3, NULL, 'em_andamento', 'WB'),
(22, 10, 1, NULL, 'em_andamento', 'WB'),
(23, 10, 2, NULL, 'em_andamento', 'WB'),
(24, 10, 3, NULL, 'em_andamento', 'WB'),
(25, 11, 1, NULL, 'em_andamento', 'WB'),
(26, 11, 2, NULL, 'em_andamento', 'WB'),
(27, 12, 1, NULL, 'em_andamento', 'WB'),
(28, 12, 2, NULL, 'em_andamento', 'WB'),
(29, 109, 1, NULL, 'em_andamento', 'WB'),
(30, 109, 2, NULL, 'em_andamento', 'WB'),
(31, 110, 1, NULL, 'em_andamento', 'WB'),
(32, 110, 2, NULL, 'em_andamento', 'WB'),
(33, 112, 1, NULL, 'em_andamento', 'WB'),
(34, 112, 2, NULL, 'em_andamento', 'WB'),
(35, 112, 3, NULL, 'em_andamento', 'WB'),
(36, 113, 1, NULL, 'F', 'WB'),
(37, 113, 2, NULL, 'F', 'WB'),
(38, 113, 3, NULL, 'F', 'WB'),
(39, 113, 1, NULL, 'F', 'LB'),
(40, 113, 2, NULL, 'F', 'LB'),
(41, 113, 3, NULL, 'F', 'LB'),
(42, 113, 4, NULL, 'F', 'LB'),
(43, 113, 4, NULL, 'F', 'GF'),
(45, 116, 1, NULL, 'em_andamento', 'WB'),
(46, 116, 2, NULL, 'em_andamento', 'WB'),
(47, 116, 3, NULL, 'em_andamento', 'WB');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_loja`
--

CREATE TABLE `usuarios_loja` (
  `id_usuario` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `perfil` enum('atendente','gerente') NOT NULL,
  `ativo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios_loja`
--

INSERT INTO `usuarios_loja` (`id_usuario`, `id_loja`, `nome`, `email`, `senha`, `perfil`, `ativo`) VALUES
(6, 1, 'Carlos Atendente', 'carlos@lojaalpha.com', '$2y$10$Tob7KC76Ni7H5lojJaCIPeYaLAgbh6QYG9B8upkkUmrW9Ia7.rv0y', 'atendente', 1),
(7, 1, 'Ana Gerente', 'ana@lojaalpha.com', '$2y$10$Tob7KC76Ni7H5lojJaCIPeYaLAgbh6QYG9B8upkkUmrW9Ia7.rv0y', 'gerente', 1),
(8, 2, 'Carlos Atendente', 'carlos@lojabeta.com', '$2y$10$Tob7KC76Ni7H5lojJaCIPeYaLAgbh6QYG9B8upkkUmrW9Ia7.rv0y', 'atendente', 1),
(9, 2, 'Ana Gerente', 'ana@lojabeta.com', '$2y$10$Tob7KC76Ni7H5lojJaCIPeYaLAgbh6QYG9B8upkkUmrW9Ia7.rv0y', 'gerente', 1),
(10, 3, 'Ana Gerente', 'ana@lojazeta.com', '$2y$10$FKqC1se.cZSAbPYMNVt7S.XikoK2y7vqwE5HxpMLIUfCsjsNpZbHq', 'gerente', 1),
(18, 11, 'Lucas Nobre Ferreira Martins', 'lucas_guitar1987@hotmail.com', '$2y$10$NBMQilbe8HgFSwPVFhonhOTqGgKVQ84KUrZGEu50LjKANZdKVAuAq', 'gerente', 1),
(19, 3, 'Carlos Silva', 'carlos@lojazeta.com', '$2y$10$eCm9CsTDYUKi7e9C7ECrveoEudfE4HNsKNRTuNxuc/gI/8uiGJUWK', 'atendente', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_ligamagic`
--

CREATE TABLE `vendas_ligamagic` (
  `id_venda_liga` int(11) NOT NULL,
  `id_loja` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `tipo_produto` varchar(100) DEFAULT NULL,
  `status_venda` varchar(100) DEFAULT NULL,
  `forma_envio` varchar(100) DEFAULT NULL,
  `forma_pagamento` varchar(100) DEFAULT NULL,
  `nome_produto_pt` varchar(255) DEFAULT NULL,
  `nome_produto_en` varchar(255) DEFAULT NULL,
  `categoria_completa` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 0,
  `preco_total` decimal(12,2) DEFAULT 0.00,
  `preco_medio` decimal(12,2) DEFAULT 0.00,
  `jogo_base` varchar(150) DEFAULT NULL,
  `subcategoria` varchar(150) DEFAULT NULL,
  `edicao_categoria_limpa` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendas_ligamagic`
--

INSERT INTO `vendas_ligamagic` (`id_venda_liga`, `id_loja`, `id_lote`, `tipo_produto`, `status_venda`, `forma_envio`, `forma_pagamento`, `nome_produto_pt`, `nome_produto_en`, `categoria_completa`, `quantidade`, `preco_total`, `preco_medio`, `jogo_base`, `subcategoria`, `edicao_categoria_limpa`) VALUES
(5590, 3, 23, 'Produto', 'Retirado no Balcão', 'Retirada no balcão', 'Pagamento Balcão em até 10x sem juros', '(PT-BR) Blister Unitário - Megaevolução 1 - Megaevolução', '', 'Pokemon > Boosters Avulsos', 2, 25.80, 12.90, 'Pokemon', 'Boosters Avulsos', NULL),
(5591, 3, 23, 'Produto', 'Retirado no Balcão', 'Retirada no balcão', 'Pagamento Balcão em até 10x sem juros', '(PT-BR) Blister Unitário - Megaevolução 2 - Fogo Fantasmagórico', '', 'Pokemon > Boosters Avulsos', 2, 25.80, 12.90, 'Pokemon', 'Boosters Avulsos', NULL),
(5592, 3, 23, 'Produto', 'Retirado no Balcão', 'Retirada no balcão', 'Pagamento Balcão em até 10x sem juros', 'Booster Avulso - Lorwyn Eclipsed - Booster de Jogo', '', 'Produtos Selados de Magic > Boosters e Caixa de Boosters', 1, 35.00, 35.00, 'Magic: The Gathering', 'Boosters e Caixa de Boosters', NULL),
(5593, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Éomer da Marca dos Cavaleiros', 'Éomer of the Riddermark', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5594, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'A Criação de Avacyn', 'The Creation of Avacyn', 'Modern Horizons 3', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5595, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'A Realm Reborn', 'A Realm Reborn', 'FINAL FANTASY', 1, 3.78, 3.78, 'Magic: The Gathering', 'Geral', NULL),
(5596, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aang\'s Iceberg', 'Aang\'s Iceberg', 'Avatar: The Last Airbender', 1, 2.52, 2.52, 'Magic: The Gathering', 'Geral', NULL),
(5597, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aang\'s Journey', 'Aang\'s Journey', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5598, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aang, o Último Dobrador de Ar', 'Aang, the Last Airbender', 'Avatar: The Last Airbender', 1, 0.22, 0.22, 'Magic: The Gathering', 'Geral', NULL),
(5599, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Abigale, Eloquent First-Year', 'Abigale, Eloquent First-Year', 'Lorwyn Eclipsed', 1, 9.05, 9.05, 'Magic: The Gathering', 'Geral', NULL),
(5600, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Afundar em Estupor', 'Sink into Stupor', 'Modern Horizons 3', 1, 47.81, 47.81, 'Magic: The Gathering', 'Geral', NULL),
(5601, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Airship Engine Room', 'Airship Engine Room', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5602, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ajani Derruba o Sacrogenitor', 'Ajani Fells the Godsire', 'Modern Horizons 3', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5603, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Altar Argentado', 'Argent Dais', 'Modern Horizons 3', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5604, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aprisionados na Lua', 'Imprisoned in the Moon', 'Avatar: The Last Airbender Eternal (Source Material)', 1, 3.21, 3.21, 'Magic: The Gathering', 'Geral', NULL),
(5605, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Arahbo, the First Fang', 'Arahbo, the First Fang', 'Foundations', 1, 3.91, 3.91, 'Magic: The Gathering', 'Geral', NULL),
(5606, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ashling\'s Command', 'Ashling\'s Command', 'Lorwyn Eclipsed', 2, 6.88, 3.44, 'Magic: The Gathering', 'Geral', NULL),
(5607, 3, 23, 'Magic: The Gathering', 'Retirado no Balcão', 'Retirada no balcão', 'Créditos', 'Aurora Awakener', 'Aurora Awakener', 'Lorwyn Eclipsed', 2, 73.38, 36.69, 'Magic: The Gathering', 'Geral', NULL),
(5608, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ba Sing Se', 'Ba Sing Se', 'Avatar: The Last Airbender', 1, 15.64, 15.64, 'Magic: The Gathering', 'Geral', NULL),
(5609, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Badgermole', 'Badgermole', 'Avatar: The Last Airbender', 2, 0.34, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5610, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Balthier and Fran', 'Balthier and Fran', 'FINAL FANTASY', 1, 1.60, 1.60, 'Magic: The Gathering', 'Geral', NULL),
(5611, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Batida da Meia-noite', 'Stroke of Midnight', 'Foundations', 1, 1.70, 1.70, 'Magic: The Gathering', 'Geral', NULL),
(5612, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Behold the Sinister Six!', 'Behold the Sinister Six!', 'Marvel\'s Spider-Man', 1, 16.21, 16.21, 'Magic: The Gathering', 'Geral', NULL),
(5613, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Beifong\'s Bounty Hunters', 'Beifong\'s Bounty Hunters', 'Avatar: The Last Airbender', 1, 1.99, 1.99, 'Magic: The Gathering', 'Geral', NULL),
(5614, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bile-Vial Boggart', 'Bile-Vial Boggart', 'Lorwyn Eclipsed', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5615, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Black Cat, Cunning Thief', 'Black Cat, Cunning Thief', 'Marvel\'s Spider-Man', 1, 1.15, 1.15, 'Magic: The Gathering', 'Geral', NULL),
(5616, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bloodline Bidding', 'Bloodline Bidding', 'Lorwyn Eclipsed', 1, 9.22, 9.22, 'Magic: The Gathering', 'Geral', NULL),
(5617, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Bloodline Bidding', 'Bloodline Bidding', 'Lorwyn Eclipsed', 1, 9.22, 9.22, 'Magic: The Gathering', 'Geral', NULL),
(5618, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Boggart Cursecrafter', 'Boggart Cursecrafter', 'Lorwyn Eclipsed', 4, 1.32, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5619, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Boggart Mischief', 'Boggart Mischief', 'Lorwyn Eclipsed', 3, 0.78, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5620, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Boiling Rock Prison', 'Boiling Rock Prison', 'Avatar: The Last Airbender', 4, 0.68, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5621, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Bounce Off', 'Bounce Off', 'Aetherdrift', 3, 0.51, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5622, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bre of Clan Stoutarm', 'Bre of Clan Stoutarm', 'Lorwyn Eclipsed', 2, 5.58, 2.79, 'Magic: The Gathering', 'Geral', NULL),
(5623, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Brigid, Clachan\'s Heart', 'Brigid, Clachan\'s Heart', 'Lorwyn Eclipsed', 1, 10.23, 10.23, 'Magic: The Gathering', 'Geral', NULL),
(5624, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bristlebane Battler', 'Bristlebane Battler', 'Lorwyn Eclipsed', 1, 5.12, 5.12, 'Magic: The Gathering', 'Geral', NULL),
(5625, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Broadside Barrage', 'Broadside Barrage', 'Aetherdrift', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5626, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Bueiros de Vapor', 'Steam Vents', 'Lorwyn Eclipsed', 2, 73.48, 36.74, 'Magic: The Gathering', 'Geral', NULL),
(5627, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Calca-toco', 'Stump Stomp', 'Modern Horizons 3', 1, 0.56, 0.56, 'Magic: The Gathering', 'Geral', NULL),
(5628, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Carnage, Crimson Chaos', 'Carnage, Crimson Chaos', 'Wizards Play Network 2025', 1, 36.12, 36.12, 'Magic: The Gathering', 'Geral', NULL),
(5629, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Catástrofe', 'Catastrophe', 'A Saga de Urza', 1, 14.95, 14.95, 'Magic: The Gathering', 'Geral', NULL),
(5630, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Chama da Duplicação', 'Flare of Duplication', 'Modern Horizons 3', 1, 9.49, 9.49, 'Magic: The Gathering', 'Geral', NULL),
(5631, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Chamado da Ilha Perdida', 'Lost Isle Calling', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 1.14, 1.14, 'Magic: The Gathering', 'Geral', NULL),
(5632, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Champion of the Path', 'Champion of the Path', 'Lorwyn Eclipsed', 1, 1.55, 1.55, 'Magic: The Gathering', 'Geral', NULL),
(5633, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Champions of the Perfect', 'Champions of the Perfect', 'Lorwyn Eclipsed', 1, 9.17, 9.17, 'Magic: The Gathering', 'Geral', NULL),
(5634, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Chomping Changeling', 'Chomping Changeling', 'Lorwyn Eclipsed', 2, 1.86, 0.93, 'Magic: The Gathering', 'Geral', NULL),
(5635, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Chomping Changeling', 'Chomping Changeling', 'Lorwyn Eclipsed', 2, 3.11, 1.56, 'Magic: The Gathering', 'Geral', NULL),
(5636, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Chuva de Escórias', 'Slagstorm', 'Foundations', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5637, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Cilada Mágica', 'Spell Snare', 'Lorwyn Eclipsed', 3, 20.03, 6.68, 'Magic: The Gathering', 'Geral', NULL),
(5638, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Colete de Mithril', 'Mithril Coat', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 97.64, 97.64, 'Magic: The Gathering', 'Geral', NULL),
(5639, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Collective Inferno', 'Collective Inferno', 'Lorwyn Eclipsed', 1, 5.09, 5.09, 'Magic: The Gathering', 'Geral', NULL),
(5640, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Coro Élfico', 'Elven Chorus', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 2, 49.49, 24.75, 'Magic: The Gathering', 'Geral', NULL),
(5641, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Costume Closet', 'Costume Closet', 'Marvel\'s Spider-Man', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5642, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Cripta de Sangue', 'Blood Crypt', 'Lorwyn Eclipsed', 2, 66.68, 33.34, 'Magic: The Gathering', 'Geral', NULL),
(5643, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Cynical Loner', 'Cynical Loner', 'Noctumbra: A Casa dos Horrores', 1, 0.18, 0.18, 'Magic: The Gathering', 'Geral', NULL),
(5644, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dádiva dos Fios', 'Gift of Strands', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.40, 0.40, 'Magic: The Gathering', 'Geral', NULL),
(5645, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Darkness Descends', 'Darkness Descends', 'Lorwyn Eclipsed', 1, 0.51, 0.51, 'Magic: The Gathering', 'Geral', NULL),
(5646, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Dawn-Blessed Pennant', 'Dawn-Blessed Pennant', 'Lorwyn Eclipsed', 1, 0.33, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5647, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dawn-Blessed Pennant', 'Dawn-Blessed Pennant', 'Lorwyn Eclipsed', 3, 2.14, 0.71, 'Magic: The Gathering', 'Geral', NULL),
(5648, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Dawnhand Dissident', 'Dawnhand Dissident', 'Lorwyn Eclipsed', 1, 6.13, 6.13, 'Magic: The Gathering', 'Geral', NULL),
(5649, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Deepchannel Duelist', 'Deepchannel Duelist', 'Lorwyn Eclipsed', 4, 1.60, 0.40, 'Magic: The Gathering', 'Geral', NULL),
(5650, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Deepway Navigator', 'Deepway Navigator', 'Lorwyn Eclipsed', 3, 20.37, 6.79, 'Magic: The Gathering', 'Geral', NULL),
(5651, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Derrubar os Profanos', 'Fell the Profane', 'Modern Horizons 3', 1, 35.65, 35.65, 'Magic: The Gathering', 'Geral', NULL),
(5652, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Diamond Weapon', 'Diamond Weapon', 'FINAL FANTASY', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5653, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Disruptor of Currents', 'Disruptor of Currents', 'Lorwyn Eclipsed', 2, 9.20, 4.60, 'Magic: The Gathering', 'Geral', NULL),
(5654, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Don\'t Make a Sound', 'Don\'t Make a Sound', 'Noctumbra: A Casa dos Horrores', 1, 0.07, 0.07, 'Magic: The Gathering', 'Geral', NULL),
(5655, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Doomsday Excruciator', 'Doomsday Excruciator', 'Noctumbra: A Casa dos Horrores', 2, 3.88, 1.94, 'Magic: The Gathering', 'Geral', NULL),
(5656, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Doran, Besieged by Time', 'Doran, Besieged by Time', 'Lorwyn Eclipsed', 1, 6.87, 6.87, 'Magic: The Gathering', 'Geral', NULL),
(5657, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dose of Dawnglow', 'Dose of Dawnglow', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5658, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dragão Mandibular', 'Mandibular Kite', 'Modern Horizons 3', 1, 0.10, 0.10, 'Magic: The Gathering', 'Geral', NULL),
(5659, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dream Harvest', 'Dream Harvest', 'Lorwyn Eclipsed', 1, 2.69, 2.69, 'Magic: The Gathering', 'Geral', NULL),
(5660, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Dredger\'s Insight', 'Dredger\'s Insight', 'Aetherdrift', 1, 0.29, 0.29, 'Magic: The Gathering', 'Geral', NULL),
(5661, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dundoolin Weaver', 'Dundoolin Weaver', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5662, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Earthen Ally', 'Earthen Ally', 'Avatar: The Last Airbender', 1, 0.77, 0.77, 'Magic: The Gathering', 'Geral', NULL),
(5663, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Eclipsed Elf', 'Eclipsed Elf', 'Lorwyn Eclipsed (Fable Frame)', 1, 1.35, 1.35, 'Magic: The Gathering', 'Geral', NULL),
(5664, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Eclipsed Flamekin', 'Eclipsed Flamekin', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5665, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Eclipsed Realms', 'Eclipsed Realms', 'Lorwyn Eclipsed', 4, 5.44, 1.36, 'Magic: The Gathering', 'Geral', NULL),
(5666, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Enviada dos Ancestrais', 'Envoy of the Ancestors', 'Modern Horizons 3', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5667, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Esmagar Cerco', 'Siege Smash', 'Modern Horizons 3', 1, 0.22, 0.22, 'Magic: The Gathering', 'Geral', NULL),
(5668, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Espécime Hidroelétrico', 'Hydroelectric Specimen', 'Modern Horizons 3', 1, 5.69, 5.69, 'Magic: The Gathering', 'Geral', NULL),
(5669, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Evershrike\'s Gift', 'Evershrike\'s Gift', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5670, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Extinguisher Battleship', 'Extinguisher Battleship', 'Edge of Eternities', 1, 1.00, 1.00, 'Magic: The Gathering', 'Geral', NULL),
(5671, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Faebloom Trick', 'Faebloom Trick', 'Foundations', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5672, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Fatia de Lumespectro', 'Ghostfire Slice', 'Modern Horizons 3', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5673, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Figure of Fable', 'Figure of Fable', 'Lorwyn Eclipsed', 1, 1.12, 1.12, 'Magic: The Gathering', 'Geral', NULL),
(5674, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Firdoch Core', 'Firdoch Core', 'Lorwyn Eclipsed', 4, 0.64, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5675, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Fire Nation Attacks', 'Fire Nation Attacks', 'Avatar: The Last Airbender (Scene Cards)', 1, 0.90, 0.90, 'Magic: The Gathering', 'Geral', NULL),
(5676, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Fire Nation Palace', 'Fire Nation Palace', 'Avatar: The Last Airbender', 1, 8.63, 8.63, 'Magic: The Gathering', 'Geral', NULL),
(5677, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Flexible Waterbender', 'Flexible Waterbender', 'Avatar: The Last Airbender', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5678, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Floodpits Drowner', 'Floodpits Drowner', 'Noctumbra: A Casa dos Horrores', 1, 0.52, 0.52, 'Magic: The Gathering', 'Geral', NULL),
(5679, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Floresta (#280)', 'Forest (#280)', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 2.85, 2.85, 'Magic: The Gathering', 'Geral', NULL),
(5680, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Foggy Bottom Swamp', 'Foggy Bottom Swamp', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5681, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Fonte Santificada', 'Hallowed Fountain', 'Lorwyn Eclipsed', 1, 31.43, 31.43, 'Magic: The Gathering', 'Geral', NULL),
(5682, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Força da Colheita', 'Strength of the Harvest', 'Modern Horizons 3', 1, 0.74, 0.74, 'Magic: The Gathering', 'Geral', NULL),
(5683, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Fundição Sagrada', 'Sacred Foundry', 'Port&otilde;es Violados', 1, 29.78, 29.78, 'Magic: The Gathering', 'Geral', NULL),
(5684, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'G\'raha Tia', 'G\'raha Tia', 'FINAL FANTASY', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5685, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Gathering Stone', 'Gathering Stone', 'Lorwyn Eclipsed', 3, 3.06, 1.02, 'Magic: The Gathering', 'Geral', NULL),
(5686, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Gathering Stone', 'Gathering Stone', 'Lorwyn Eclipsed', 1, 1.02, 1.02, 'Magic: The Gathering', 'Geral', NULL),
(5687, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Giantfall', 'Giantfall', 'Lorwyn Eclipsed', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5688, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Glen Elendra Guardian', 'Glen Elendra Guardian', 'Lorwyn Eclipsed', 1, 8.61, 8.61, 'Magic: The Gathering', 'Geral', NULL),
(5689, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Glister Bairn', 'Glister Bairn', 'Lorwyn Eclipsed', 1, 0.33, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5690, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Gloom Ripper', 'Gloom Ripper', 'Lorwyn Eclipsed', 1, 1.49, 1.49, 'Magic: The Gathering', 'Geral', NULL),
(5691, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Goliath Daydreamer', 'Goliath Daydreamer', 'Lorwyn Eclipsed', 1, 3.32, 3.32, 'Magic: The Gathering', 'Geral', NULL),
(5692, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Grub, Storied Matriarch', 'Grub, Storied Matriarch', 'Lorwyn Eclipsed', 1, 6.22, 6.22, 'Magic: The Gathering', 'Geral', NULL),
(5693, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Hakoda, Selfless Commander', 'Hakoda, Selfless Commander', 'Avatar: The Last Airbender', 1, 3.43, 3.43, 'Magic: The Gathering', 'Geral', NULL),
(5694, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Harmonized Crescendo', 'Harmonized Crescendo', 'Lorwyn Eclipsed', 2, 13.11, 6.56, 'Magic: The Gathering', 'Geral', NULL),
(5695, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Haste Magic', 'Haste Magic', 'FINAL FANTASY', 1, 0.23, 0.23, 'Magic: The Gathering', 'Geral', NULL),
(5696, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'High Perfect Morcant', 'High Perfect Morcant', 'Lorwyn Eclipsed', 1, 31.05, 31.05, 'Magic: The Gathering', 'Geral', NULL),
(5697, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Honor', 'Honor', 'Edge of Eternities', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5698, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Hydro-Man, Fluid Felon', 'Hydro-Man, Fluid Felon', 'Marvel\'s Spider-Man', 1, 1.84, 1.84, 'Magic: The Gathering', 'Geral', NULL),
(5699, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ilha (#275)', 'Island (#275)', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 3.32, 3.32, 'Magic: The Gathering', 'Geral', NULL),
(5700, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Incubador de Urza', 'Urza\'s Incubator', 'Modern Horizons 3', 1, 67.85, 67.85, 'Magic: The Gathering', 'Geral', NULL),
(5701, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Iroh, Grande Lótus', 'Iroh, Grand Lotus', 'Avatar: The Last Airbender', 1, 3.53, 3.53, 'Magic: The Gathering', 'Geral', NULL),
(5702, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Iron-Shield Elf', 'Iron-Shield Elf', 'Lorwyn Eclipsed', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5703, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'It\'ll Quench Ya!', 'It\'ll Quench Ya!', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5704, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Jardim do Templo', 'Temple Garden', 'Lorwyn Eclipsed', 2, 64.28, 32.14, 'Magic: The Gathering', 'Geral', NULL),
(5705, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Jasmine Dragon Tea Shop', 'Jasmine Dragon Tea Shop', 'Avatar: The Last Airbender', 1, 4.59, 4.59, 'Magic: The Gathering', 'Geral', NULL),
(5706, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Katara, a Destemida', 'Katara, the Fearless', 'Avatar: The Last Airbender', 1, 7.92, 7.92, 'Magic: The Gathering', 'Geral', NULL),
(5707, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Katara, Bending Prodigy', 'Katara, Bending Prodigy', 'Avatar: The Last Airbender', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5708, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kinbinding', 'Kinbinding', 'Lorwyn Eclipsed', 1, 2.29, 2.29, 'Magic: The Gathering', 'Geral', NULL),
(5709, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Kindle the Inner Flame', 'Kindle the Inner Flame', 'Lorwyn Eclipsed', 1, 1.71, 1.71, 'Magic: The Gathering', 'Geral', NULL),
(5710, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kindle the Inner Flame', 'Kindle the Inner Flame', 'Lorwyn Eclipsed', 1, 0.71, 0.71, 'Magic: The Gathering', 'Geral', NULL),
(5711, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kinscaer Sentry', 'Kinscaer Sentry', 'Lorwyn Eclipsed', 1, 7.98, 7.98, 'Magic: The Gathering', 'Geral', NULL),
(5712, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Kirol, Attentive First-Year', 'Kirol, Attentive First-Year', 'Lorwyn Eclipsed', 2, 7.40, 3.70, 'Magic: The Gathering', 'Geral', NULL),
(5713, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kithkeeper', 'Kithkeeper', 'Lorwyn Eclipsed', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(5714, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kraven\'s Last Hunt', 'Kraven\'s Last Hunt', 'Marvel\'s Spider-Man (Panel Cards)', 1, 1.86, 1.86, 'Magic: The Gathering', 'Geral', NULL),
(5715, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kyoshi Village', 'Kyoshi Village', 'Avatar: The Last Airbender', 2, 0.24, 0.12, 'Magic: The Gathering', 'Geral', NULL),
(5716, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lasting Tarfire', 'Lasting Tarfire', 'Lorwyn Eclipsed', 1, 0.21, 0.21, 'Magic: The Gathering', 'Geral', NULL),
(5717, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lavaleaper', 'Lavaleaper', 'Lorwyn Eclipsed', 1, 3.62, 3.62, 'Magic: The Gathering', 'Geral', NULL),
(5718, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Leyline Axe', 'Leyline Axe', 'Foundations', 1, 11.48, 11.48, 'Magic: The Gathering', 'Geral', NULL),
(5719, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Leyline of Transformation', 'Leyline of Transformation', 'Noctumbra: A Casa dos Horrores', 1, 1.17, 1.17, 'Magic: The Gathering', 'Geral', NULL),
(5720, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Liderança da Legião', 'Legion Leadership', 'Modern Horizons 3', 1, 0.80, 0.80, 'Magic: The Gathering', 'Geral', NULL),
(5721, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lionheart Glimmer', 'Lionheart Glimmer', 'Noctumbra: A Casa dos Horrores', 1, 0.10, 0.10, 'Magic: The Gathering', 'Geral', NULL),
(5722, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Lluwen, Imperfect Naturalist', 'Lluwen, Imperfect Naturalist', 'Lorwyn Eclipsed', 1, 4.65, 4.65, 'Magic: The Gathering', 'Geral', NULL),
(5723, 3, 23, 'Pokemon', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lombre', 'Lombre (#006/094)', 'Fogo Fantasmag&oacute;rico', 1, 0.11, 0.11, 'Pokemon', 'Geral', NULL),
(5724, 3, 23, 'Pokemon', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lotad', 'Lotad (#005/094)', 'Fogo Fantasmag&oacute;rico', 1, 0.15, 0.15, 'Pokemon', 'Geral', NULL),
(5725, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Lotho, Condestável Corrupto', 'Lotho, Corrupt Shirriff', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 74.64, 74.64, 'Magic: The Gathering', 'Geral', NULL),
(5726, 3, 23, 'Pokemon', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ludicolo', 'Ludicolo (#007/094)', 'Fogo Fantasmag&oacute;rico', 1, 0.16, 0.16, 'Pokemon', 'Geral', NULL),
(5727, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Magistrado de Drannith', 'Drannith Magistrate', 'Ikoria: Terra de Colossos', 1, 57.38, 57.38, 'Magic: The Gathering', 'Geral', NULL),
(5728, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Maralen, Fae Ascendant', 'Maralen, Fae Ascendant', 'Lorwyn Eclipsed', 1, 11.27, 11.27, 'Magic: The Gathering', 'Geral', NULL),
(5729, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Marvin, Murderous Mimic', 'Marvin, Murderous Mimic', 'Noctumbra: A Casa dos Horrores', 1, 5.16, 5.16, 'Magic: The Gathering', 'Geral', NULL),
(5730, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Master Piandao', 'Master Piandao', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5731, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Meanders Guide', 'Meanders Guide', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5732, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Meditation Pools', 'Meditation Pools', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5733, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Midnight Tilling', 'Midnight Tilling', 'Lorwyn Eclipsed', 4, 0.64, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5734, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Mindspring Merfolk', 'Mindspring Merfolk', 'Aetherdrift', 1, 1.60, 1.60, 'Magic: The Gathering', 'Geral', NULL),
(5735, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Misty Palms Oasis', 'Misty Palms Oasis', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5736, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Montanha (#277)', 'Mountain (#277)', 'Lorwyn Eclipsed', 4, 3.04, 0.76, 'Magic: The Gathering', 'Geral', NULL),
(5737, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Moon-Vigil Adherents', 'Moon-Vigil Adherents', 'Lorwyn Eclipsed', 1, 0.33, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5738, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Morcant\'s Eyes', 'Morcant\'s Eyes', 'Lorwyn Eclipsed', 1, 0.29, 0.29, 'Magic: The Gathering', 'Geral', NULL),
(5739, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Morcegos da Floresta das Trevas', 'Mirkwood Bats', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 3.45, 3.45, 'Magic: The Gathering', 'Geral', NULL),
(5740, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Mountain (#282)', 'Mountain (#282)', 'Lorwyn Eclipsed', 2, 1.54, 0.77, 'Magic: The Gathering', 'Geral', NULL),
(5741, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Mudbutton Cursetosser', 'Mudbutton Cursetosser', 'Lorwyn Eclipsed', 3, 1.35, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5742, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Mutable Explorer', 'Mutable Explorer', 'Lorwyn Eclipsed', 1, 17.41, 17.41, 'Magic: The Gathering', 'Geral', NULL),
(5743, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Mysidian Elder', 'Mysidian Elder', 'FINAL FANTASY', 2, 1.38, 0.69, 'Magic: The Gathering', 'Geral', NULL),
(5744, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Nascer do Dia', 'Rising of the Day', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 4.48, 4.48, 'Magic: The Gathering', 'Geral', NULL),
(5745, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Nibelheim Aflame', 'Nibelheim Aflame', 'FINAL FANTASY', 1, 28.46, 28.46, 'Magic: The Gathering', 'Geral', NULL),
(5746, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Noggle Robber', 'Noggle Robber', 'Lorwyn Eclipsed', 1, 0.32, 0.32, 'Magic: The Gathering', 'Geral', NULL),
(5747, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'North Pole Gates', 'North Pole Gates', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5748, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Omashu City', 'Omashu City', 'Avatar: The Last Airbender', 2, 0.30, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(5749, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Omni-Changeling', 'Omni-Changeling', 'Lorwyn Eclipsed', 4, 1.94, 0.49, 'Magic: The Gathering', 'Geral', NULL),
(5750, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ondulações de Morte-Vida', 'Ripples of Undeath', 'Modern Horizons 3', 1, 28.03, 28.03, 'Magic: The Gathering', 'Geral', NULL),
(5751, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Origin of Spider-Man', 'Origin of Spider-Man', 'Marvel\'s Spider-Man', 1, 1.14, 1.14, 'Magic: The Gathering', 'Geral', NULL),
(5752, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pântano (#276)', 'Swamp (#276)', 'Lorwyn Eclipsed', 4, 2.28, 0.57, 'Magic: The Gathering', 'Geral', NULL),
(5753, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Pequenina Deliciada', 'Delighted Halfling', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 132.13, 132.13, 'Magic: The Gathering', 'Geral', NULL),
(5754, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Perfurar Mágica', 'Spell Pierce', 'Aetherdrift', 1, 0.91, 0.91, 'Magic: The Gathering', 'Geral', NULL),
(5755, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pestered Wellguard', 'Pestered Wellguard', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5756, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Peter Parker\'s Camera', 'Peter Parker\'s Camera', 'Marvel\'s Spider-Man (Extended Art)', 2, 15.18, 7.59, 'Magic: The Gathering', 'Geral', NULL),
(5757, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Piromante Experiente', 'Seasoned Pyromancer', 'Modern Horizons', 1, 51.50, 51.50, 'Magic: The Gathering', 'Geral', NULL),
(5758, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pirossurfista Imprudente', 'Reckless Pyrosurfer', 'Modern Horizons 3', 1, 0.13, 0.13, 'Magic: The Gathering', 'Geral', NULL),
(5759, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pitiless Fists', 'Pitiless Fists', 'Lorwyn Eclipsed', 1, 0.29, 0.29, 'Magic: The Gathering', 'Geral', NULL),
(5760, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Planície (#272)', 'Plains (#272)', 'Noctumbra: A Casa dos Horrores', 3, 2.70, 0.90, 'Magic: The Gathering', 'Geral', NULL),
(5761, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Plasma Bolt', 'Plasma Bolt', 'Edge of Eternities', 1, 0.06, 0.06, 'Magic: The Gathering', 'Geral', NULL),
(5762, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Príncipe Imrahil, o Belo', 'Prince Imrahil the Fair', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.21, 0.21, 'Magic: The Gathering', 'Geral', NULL),
(5763, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Praia Inundada', 'Flooded Strand', 'Khans de Tarkir', 1, 59.90, 59.90, 'Magic: The Gathering', 'Geral', NULL),
(5764, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Price of Freedom', 'Price of Freedom', 'Avatar: The Last Airbender', 1, 1.00, 1.00, 'Magic: The Gathering', 'Geral', NULL),
(5765, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Prideful Parent', 'Prideful Parent', 'Foundations', 1, 0.12, 0.12, 'Magic: The Gathering', 'Geral', NULL),
(5766, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Prismabasher', 'Prismabasher', 'Lorwyn Eclipsed', 1, 0.24, 0.24, 'Magic: The Gathering', 'Geral', NULL),
(5767, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Prismatic Undercurrents', 'Prismatic Undercurrents', 'Lorwyn Eclipsed', 1, 0.76, 0.76, 'Magic: The Gathering', 'Geral', NULL),
(5768, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Puca\'s Eye', 'Puca\'s Eye', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5769, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Radioactive Spider', 'Radioactive Spider', 'Marvel\'s Spider-Man', 1, 2.88, 2.88, 'Magic: The Gathering', 'Geral', NULL),
(5770, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ragost, Deft Gastronaut', 'Ragost, Deft Gastronaut', 'Edge of Eternities', 1, 1.03, 1.03, 'Magic: The Gathering', 'Geral', NULL),
(5771, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Raiding Schemes', 'Raiding Schemes', 'Lorwyn Eclipsed', 1, 3.31, 3.31, 'Magic: The Gathering', 'Geral', NULL),
(5772, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ral e o Labirinto Implícito', 'Ral and the Implicit Maze', 'Modern Horizons 3', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5773, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Reaping Willow', 'Reaping Willow', 'Lorwyn Eclipsed', 1, 0.32, 0.32, 'Magic: The Gathering', 'Geral', NULL),
(5774, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Reluctant Role Model', 'Reluctant Role Model', 'Noctumbra: A Casa dos Horrores', 1, 0.78, 0.78, 'Magic: The Gathering', 'Geral', NULL),
(5775, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Requiting Hex', 'Requiting Hex', 'Lorwyn Eclipsed', 3, 6.03, 2.01, 'Magic: The Gathering', 'Geral', NULL),
(5776, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Requiting Hex', 'Requiting Hex', 'Lorwyn Eclipsed', 1, 1.15, 1.15, 'Magic: The Gathering', 'Geral', NULL),
(5777, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Rhys, the Evermore', 'Rhys, the Evermore', 'Lorwyn Eclipsed', 1, 9.17, 9.17, 'Magic: The Gathering', 'Geral', NULL),
(5778, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ritual Sombrio', 'Dark Ritual', 'The List', 1, 22.88, 22.88, 'Magic: The Gathering', 'Geral', NULL),
(5779, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Riverpyre Verge', 'Riverpyre Verge', 'Aetherdrift', 1, 80.37, 80.37, 'Magic: The Gathering', 'Geral', NULL),
(5780, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Rocket-Powered Goblin Glider', 'Rocket-Powered Goblin Glider', 'Marvel\'s Spider-Man', 1, 0.90, 0.90, 'Magic: The Gathering', 'Geral', NULL),
(5781, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sacerdote de Titânia', 'Priest of Titania', 'Modern Horizons 3', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5782, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Safewright Cavalry', 'Safewright Cavalry', 'Lorwyn Eclipsed', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5783, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Samurai\'s Katana', 'Samurai\'s Katana', 'FINAL FANTASY', 1, 0.23, 0.23, 'Magic: The Gathering', 'Geral', NULL),
(5784, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Sanar, Innovative First-Year', 'Sanar, Innovative First-Year', 'Lorwyn Eclipsed', 1, 2.00, 2.00, 'Magic: The Gathering', 'Geral', NULL),
(5785, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Scarblade\'s Malice', 'Scarblade\'s Malice', 'Lorwyn Eclipsed', 3, 0.51, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5786, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Scuzzback Scrounger', 'Scuzzback Scrounger', 'Lorwyn Eclipsed', 1, 2.88, 2.88, 'Magic: The Gathering', 'Geral', NULL),
(5787, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Seam Rip', 'Seam Rip', 'Edge of Eternities', 2, 8.96, 4.48, 'Magic: The Gathering', 'Geral', NULL),
(5788, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Sear', 'Sear', 'Lorwyn Eclipsed', 3, 6.84, 2.28, 'Magic: The Gathering', 'Geral', NULL),
(5789, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Seismic Sense', 'Seismic Sense', 'Avatar: The Last Airbender', 1, 1.66, 1.66, 'Magic: The Gathering', 'Geral', NULL),
(5790, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Selfless Safewright', 'Selfless Safewright', 'Lorwyn Eclipsed', 3, 27.57, 9.19, 'Magic: The Gathering', 'Geral', NULL),
(5791, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sequestro de Bode', 'Goatnap', 'Lorwyn Eclipsed', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5792, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Serpent\'s Pass', 'Serpent\'s Pass', 'Avatar: The Last Airbender', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5793, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Shagrat, Carregador de Espólios', 'Shagrat, Loot Bearer', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.86, 0.86, 'Magic: The Gathering', 'Geral', NULL),
(5794, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Shimmercreep', 'Shimmercreep', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5795, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Shimmerwilds Growth', 'Shimmerwilds Growth', 'Lorwyn Eclipsed', 1, 0.86, 0.86, 'Magic: The Gathering', 'Geral', NULL),
(5796, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sidequest: Catch a Fish', 'Sidequest: Catch a Fish', 'FINAL FANTASY', 1, 0.20, 0.20, 'Magic: The Gathering', 'Geral', NULL),
(5797, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Silvergill Mentor', 'Silvergill Mentor', 'Lorwyn Eclipsed', 4, 2.64, 0.66, 'Magic: The Gathering', 'Geral', NULL),
(5798, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sizzling Changeling', 'Sizzling Changeling', 'Lorwyn Eclipsed', 1, 0.32, 0.32, 'Magic: The Gathering', 'Geral', NULL),
(5799, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Skyknight Squire', 'Skyknight Squire', 'Foundations', 1, 1.70, 1.70, 'Magic: The Gathering', 'Geral', NULL),
(5800, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sodden Verdure', 'Sodden Verdure', 'Lorwyn Eclipsed Commander', 1, 10.52, 10.52, 'Magic: The Gathering', 'Geral', NULL),
(5801, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sokka, Lateral Strategist', 'Sokka, Lateral Strategist', 'Avatar: The Last Airbender', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5802, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'South Pole Voyager', 'South Pole Voyager', 'Avatar: The Last Airbender', 1, 2.28, 2.28, 'Magic: The Gathering', 'Geral', NULL),
(5803, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Spider-Man No More', 'Spider-Man No More', 'Marvel\'s Spider-Man', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5804, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Spider-Woman, Stunning Savior', 'Spider-Woman, Stunning Savior', 'Marvel\'s Spider-Man', 1, 10.18, 10.18, 'Magic: The Gathering', 'Geral', NULL),
(5805, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Springleaf Parade', 'Springleaf Parade', 'Lorwyn Eclipsed Commander', 1, 44.56, 44.56, 'Magic: The Gathering', 'Geral', NULL),
(5806, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sting-Slinger', 'Sting-Slinger', 'Lorwyn Eclipsed', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(5807, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Suki, Kyoshi Warrior', 'Suki, Kyoshi Warrior', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5808, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sun Warriors', 'Sun Warriors', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5809, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sun-Blessed Peak', 'Sun-Blessed Peak', 'Avatar: The Last Airbender', 2, 0.34, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5810, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Superior Spider-Man', 'Superior Spider-Man', 'Marvel\'s Spider-Man (Extended Art)', 2, 38.26, 19.13, 'Magic: The Gathering', 'Geral', NULL),
(5811, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Swat Away', 'Swat Away', 'Lorwyn Eclipsed', 1, 0.51, 0.51, 'Magic: The Gathering', 'Geral', NULL),
(5812, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sygg\'s Command', 'Sygg\'s Command', 'Lorwyn Eclipsed', 1, 6.89, 6.89, 'Magic: The Gathering', 'Geral', NULL),
(5813, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Symbiote Spider-Man', 'Symbiote Spider-Man', 'Marvel\'s Spider-Man (Web-Slinger)', 1, 5.63, 5.63, 'Magic: The Gathering', 'Geral', NULL),
(5814, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tambor das Folhas Vernais', 'Springleaf Drum', 'Lorwyn Eclipsed', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5815, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tanufel Rimespeaker', 'Tanufel Rimespeaker', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5816, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Terras em Desenvolvimento', 'Evolving Wilds', 'Foundations', 1, 0.12, 0.12, 'Magic: The Gathering', 'Geral', NULL),
(5817, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Clone Saga', 'The Clone Saga', 'Marvel\'s Spider-Man', 1, 1.01, 1.01, 'Magic: The Gathering', 'Geral', NULL),
(5818, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Death of Gwen Stacy', 'The Death of Gwen Stacy', 'Marvel\'s Spider-Man', 1, 1.61, 1.61, 'Magic: The Gathering', 'Geral', NULL),
(5819, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Unagi of Kyoshi Island', 'The Unagi of Kyoshi Island', 'Avatar: The Last Airbender (Field Notes)', 1, 19.26, 19.26, 'Magic: The Gathering', 'Geral', NULL),
(5820, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Unagi of Kyoshi Island', 'The Unagi of Kyoshi Island', 'Avatar: The Last Airbender', 1, 11.76, 11.76, 'Magic: The Gathering', 'Geral', NULL),
(5821, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Thoughtweft Charge', 'Thoughtweft Charge', 'Lorwyn Eclipsed', 1, 0.23, 0.23, 'Magic: The Gathering', 'Geral', NULL),
(5822, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Thoughtweft Imbuer', 'Thoughtweft Imbuer', 'Lorwyn Eclipsed', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5823, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tidus, Blitzball Star', 'Tidus, Blitzball Star', 'FINAL FANTASY', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5824, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Timeline Culler', 'Timeline Culler', 'Edge of Eternities', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5825, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Toph, the First Metalbender', 'Toph, the First Metalbender', 'Avatar: The Last Airbender', 1, 18.39, 18.39, 'Magic: The Gathering', 'Geral', NULL),
(5826, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Torre Phyrexiana', 'Phyrexian Tower', 'Modern Horizons 3', 1, 119.60, 119.60, 'Magic: The Gathering', 'Geral', NULL),
(5827, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Trainadora Papão', 'Boggart Trawler', 'Modern Horizons 3', 1, 8.77, 8.77, 'Magic: The Gathering', 'Geral', NULL),
(5828, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Transit Mage', 'Transit Mage', 'Aetherdrift', 1, 0.46, 0.46, 'Magic: The Gathering', 'Geral', NULL),
(5829, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Trystan\'s Command', 'Trystan\'s Command', 'Lorwyn Eclipsed', 1, 2.28, 2.28, 'Magic: The Gathering', 'Geral', NULL),
(5830, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Tumba Abandonada', 'Overgrown Tomb', 'Lorwyn Eclipsed', 1, 33.75, 33.75, 'Magic: The Gathering', 'Geral', NULL),
(5831, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tumbamorfo', 'Graveshifter', 'Lorwyn Eclipsed', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(5832, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Twilight Diviner', 'Twilight Diviner', 'Lorwyn Eclipsed', 2, 12.64, 6.32, 'Magic: The Gathering', 'Geral', NULL),
(5833, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Twinflame Travelers', 'Twinflame Travelers', 'Lorwyn Eclipsed', 1, 0.85, 0.85, 'Magic: The Gathering', 'Geral', NULL),
(5834, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Um Anel Para Todos Governar', 'One Ring to Rule Them All', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 11.21, 11.21, 'Magic: The Gathering', 'Geral', NULL),
(5835, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Unlucky Cabbage Merchant', 'Unlucky Cabbage Merchant', 'Avatar: The Last Airbender', 1, 0.82, 0.82, 'Magic: The Gathering', 'Geral', NULL),
(5836, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Valfenda', 'Rivendell', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 14.65, 14.65, 'Magic: The Gathering', 'Geral', NULL),
(5837, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vanish from Sight', 'Vanish from Sight', 'Noctumbra: A Casa dos Horrores', 1, 0.04, 0.04, 'Magic: The Gathering', 'Geral', NULL);
INSERT INTO `vendas_ligamagic` (`id_venda_liga`, `id_loja`, `id_lote`, `tipo_produto`, `status_venda`, `forma_envio`, `forma_pagamento`, `nome_produto_pt`, `nome_produto_en`, `categoria_completa`, `quantidade`, `preco_total`, `preco_medio`, `jogo_base`, `subcategoria`, `edicao_categoria_limpa`) VALUES
(5838, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vastidão Morfoterrena', 'Terramorphic Expanse', 'Noctumbra: A Casa dos Horrores', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(5839, 3, 23, 'Magic: The Gathering', 'Pedido Separado - Aguardando retirada no Balcão', 'Retirada no balcão', 'Pix', 'Vibrance', 'Vibrance', 'Lorwyn Eclipsed', 1, 60.51, 60.51, 'Magic: The Gathering', 'Geral', NULL),
(5840, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vibrant Cityscape', 'Vibrant Cityscape', 'Marvel\'s Spider-Man', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5841, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vinebred Brawler', 'Vinebred Brawler', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5842, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vingadora Espada Veloz', 'Swiftblade Vindicator', 'Foundations', 1, 0.38, 0.38, 'Magic: The Gathering', 'Geral', NULL),
(5843, 3, 23, 'Magic: The Gathering', 'Retirado no Balcão', 'Retirada no balcão', 'Créditos', 'Violent Urge', 'Violent Urge', 'Noctumbra: A Casa dos Horrores', 3, 0.71, 0.24, 'Magic: The Gathering', 'Geral', NULL),
(5844, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Virulent Emissary', 'Virulent Emissary', 'Lorwyn Eclipsed', 2, 2.06, 1.03, 'Magic: The Gathering', 'Geral', NULL),
(5845, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vitimar', 'Victimize', 'Modern Horizons 3', 1, 1.71, 1.71, 'Magic: The Gathering', 'Geral', NULL),
(5846, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Voracious Tome-Skimmer', 'Voracious Tome-Skimmer', 'Lorwyn Eclipsed', 1, 1.00, 1.00, 'Magic: The Gathering', 'Geral', NULL),
(5847, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Wanderbrine Trapper', 'Wanderbrine Trapper', 'Lorwyn Eclipsed', 3, 0.60, 0.20, 'Magic: The Gathering', 'Geral', NULL),
(5848, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Warren Torchmaster', 'Warren Torchmaster', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5849, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Waterbending Lesson', 'Waterbending Lesson', 'Avatar: The Last Airbender', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5850, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Watery Grasp', 'Watery Grasp', 'Avatar: The Last Airbender', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5851, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'White Auracite', 'White Auracite', 'FINAL FANTASY', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5852, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'White Lotus Hideout', 'White Lotus Hideout', 'Avatar: The Last Airbender', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5853, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Winnowing', 'Winnowing', 'Lorwyn Eclipsed', 2, 8.30, 4.15, 'Magic: The Gathering', 'Geral', NULL),
(5854, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Yue, the Moon Spirit', 'Yue, the Moon Spirit', 'Avatar: The Last Airbender', 1, 1.71, 1.71, 'Magic: The Gathering', 'Geral', NULL),
(5855, 3, 23, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Zuko\'s Exile', 'Zuko\'s Exile', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5856, 1, 24, 'Produto', 'Retirado no Balcão', 'Retirada no balcão', 'Pagamento Balcão em até 10x sem juros', '(PT-BR) Blister Unitário - Megaevolução 1 - Megaevolução', '', 'Pokemon > Boosters Avulsos', 2, 25.80, 12.90, 'Pokemon', 'Boosters Avulsos', NULL),
(5857, 1, 24, 'Produto', 'Retirado no Balcão', 'Retirada no balcão', 'Pagamento Balcão em até 10x sem juros', '(PT-BR) Blister Unitário - Megaevolução 2 - Fogo Fantasmagórico', '', 'Pokemon > Boosters Avulsos', 2, 25.80, 12.90, 'Pokemon', 'Boosters Avulsos', NULL),
(5858, 1, 24, 'Produto', 'Retirado no Balcão', 'Retirada no balcão', 'Pagamento Balcão em até 10x sem juros', 'Booster Avulso - Lorwyn Eclipsed - Booster de Jogo', '', 'Produtos Selados de Magic > Boosters e Caixa de Boosters', 1, 35.00, 35.00, 'Magic: The Gathering', 'Boosters e Caixa de Boosters', NULL),
(5859, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Éomer da Marca dos Cavaleiros', 'Éomer of the Riddermark', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5860, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'A Criação de Avacyn', 'The Creation of Avacyn', 'Modern Horizons 3', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5861, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'A Realm Reborn', 'A Realm Reborn', 'FINAL FANTASY', 1, 3.78, 3.78, 'Magic: The Gathering', 'Geral', NULL),
(5862, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aang\'s Iceberg', 'Aang\'s Iceberg', 'Avatar: The Last Airbender', 1, 2.52, 2.52, 'Magic: The Gathering', 'Geral', NULL),
(5863, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aang\'s Journey', 'Aang\'s Journey', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5864, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aang, o Último Dobrador de Ar', 'Aang, the Last Airbender', 'Avatar: The Last Airbender', 1, 0.22, 0.22, 'Magic: The Gathering', 'Geral', NULL),
(5865, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Abigale, Eloquent First-Year', 'Abigale, Eloquent First-Year', 'Lorwyn Eclipsed', 1, 9.05, 9.05, 'Magic: The Gathering', 'Geral', NULL),
(5866, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Afundar em Estupor', 'Sink into Stupor', 'Modern Horizons 3', 1, 47.81, 47.81, 'Magic: The Gathering', 'Geral', NULL),
(5867, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Airship Engine Room', 'Airship Engine Room', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5868, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ajani Derruba o Sacrogenitor', 'Ajani Fells the Godsire', 'Modern Horizons 3', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5869, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Altar Argentado', 'Argent Dais', 'Modern Horizons 3', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5870, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Aprisionados na Lua', 'Imprisoned in the Moon', 'Avatar: The Last Airbender Eternal (Source Material)', 1, 3.21, 3.21, 'Magic: The Gathering', 'Geral', NULL),
(5871, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Arahbo, the First Fang', 'Arahbo, the First Fang', 'Foundations', 1, 3.91, 3.91, 'Magic: The Gathering', 'Geral', NULL),
(5872, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ashling\'s Command', 'Ashling\'s Command', 'Lorwyn Eclipsed', 2, 6.88, 3.44, 'Magic: The Gathering', 'Geral', NULL),
(5873, 1, 24, 'Magic: The Gathering', 'Retirado no Balcão', 'Retirada no balcão', 'Créditos', 'Aurora Awakener', 'Aurora Awakener', 'Lorwyn Eclipsed', 2, 73.38, 36.69, 'Magic: The Gathering', 'Geral', NULL),
(5874, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ba Sing Se', 'Ba Sing Se', 'Avatar: The Last Airbender', 1, 15.64, 15.64, 'Magic: The Gathering', 'Geral', NULL),
(5875, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Badgermole', 'Badgermole', 'Avatar: The Last Airbender', 2, 0.34, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5876, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Balthier and Fran', 'Balthier and Fran', 'FINAL FANTASY', 1, 1.60, 1.60, 'Magic: The Gathering', 'Geral', NULL),
(5877, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Batida da Meia-noite', 'Stroke of Midnight', 'Foundations', 1, 1.70, 1.70, 'Magic: The Gathering', 'Geral', NULL),
(5878, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Behold the Sinister Six!', 'Behold the Sinister Six!', 'Marvel\'s Spider-Man', 1, 16.21, 16.21, 'Magic: The Gathering', 'Geral', NULL),
(5879, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Beifong\'s Bounty Hunters', 'Beifong\'s Bounty Hunters', 'Avatar: The Last Airbender', 1, 1.99, 1.99, 'Magic: The Gathering', 'Geral', NULL),
(5880, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bile-Vial Boggart', 'Bile-Vial Boggart', 'Lorwyn Eclipsed', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5881, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Black Cat, Cunning Thief', 'Black Cat, Cunning Thief', 'Marvel\'s Spider-Man', 1, 1.15, 1.15, 'Magic: The Gathering', 'Geral', NULL),
(5882, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bloodline Bidding', 'Bloodline Bidding', 'Lorwyn Eclipsed', 1, 9.22, 9.22, 'Magic: The Gathering', 'Geral', NULL),
(5883, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Bloodline Bidding', 'Bloodline Bidding', 'Lorwyn Eclipsed', 1, 9.22, 9.22, 'Magic: The Gathering', 'Geral', NULL),
(5884, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Boggart Cursecrafter', 'Boggart Cursecrafter', 'Lorwyn Eclipsed', 4, 1.32, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5885, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Boggart Mischief', 'Boggart Mischief', 'Lorwyn Eclipsed', 3, 0.78, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5886, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Boiling Rock Prison', 'Boiling Rock Prison', 'Avatar: The Last Airbender', 4, 0.68, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5887, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Bounce Off', 'Bounce Off', 'Aetherdrift', 3, 0.51, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5888, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bre of Clan Stoutarm', 'Bre of Clan Stoutarm', 'Lorwyn Eclipsed', 2, 5.58, 2.79, 'Magic: The Gathering', 'Geral', NULL),
(5889, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Brigid, Clachan\'s Heart', 'Brigid, Clachan\'s Heart', 'Lorwyn Eclipsed', 1, 10.23, 10.23, 'Magic: The Gathering', 'Geral', NULL),
(5890, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Bristlebane Battler', 'Bristlebane Battler', 'Lorwyn Eclipsed', 1, 5.12, 5.12, 'Magic: The Gathering', 'Geral', NULL),
(5891, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Broadside Barrage', 'Broadside Barrage', 'Aetherdrift', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5892, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Bueiros de Vapor', 'Steam Vents', 'Lorwyn Eclipsed', 2, 73.48, 36.74, 'Magic: The Gathering', 'Geral', NULL),
(5893, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Calca-toco', 'Stump Stomp', 'Modern Horizons 3', 1, 0.56, 0.56, 'Magic: The Gathering', 'Geral', NULL),
(5894, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Carnage, Crimson Chaos', 'Carnage, Crimson Chaos', 'Wizards Play Network 2025', 1, 36.12, 36.12, 'Magic: The Gathering', 'Geral', NULL),
(5895, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Catástrofe', 'Catastrophe', 'A Saga de Urza', 1, 14.95, 14.95, 'Magic: The Gathering', 'Geral', NULL),
(5896, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Chama da Duplicação', 'Flare of Duplication', 'Modern Horizons 3', 1, 9.49, 9.49, 'Magic: The Gathering', 'Geral', NULL),
(5897, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Chamado da Ilha Perdida', 'Lost Isle Calling', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 1.14, 1.14, 'Magic: The Gathering', 'Geral', NULL),
(5898, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Champion of the Path', 'Champion of the Path', 'Lorwyn Eclipsed', 1, 1.55, 1.55, 'Magic: The Gathering', 'Geral', NULL),
(5899, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Champions of the Perfect', 'Champions of the Perfect', 'Lorwyn Eclipsed', 1, 9.17, 9.17, 'Magic: The Gathering', 'Geral', NULL),
(5900, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Chomping Changeling', 'Chomping Changeling', 'Lorwyn Eclipsed', 2, 1.86, 0.93, 'Magic: The Gathering', 'Geral', NULL),
(5901, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Chomping Changeling', 'Chomping Changeling', 'Lorwyn Eclipsed', 2, 3.11, 1.56, 'Magic: The Gathering', 'Geral', NULL),
(5902, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Chuva de Escórias', 'Slagstorm', 'Foundations', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5903, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Cilada Mágica', 'Spell Snare', 'Lorwyn Eclipsed', 3, 20.03, 6.68, 'Magic: The Gathering', 'Geral', NULL),
(5904, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Colete de Mithril', 'Mithril Coat', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 97.64, 97.64, 'Magic: The Gathering', 'Geral', NULL),
(5905, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Collective Inferno', 'Collective Inferno', 'Lorwyn Eclipsed', 1, 5.09, 5.09, 'Magic: The Gathering', 'Geral', NULL),
(5906, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Coro Élfico', 'Elven Chorus', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 2, 49.49, 24.75, 'Magic: The Gathering', 'Geral', NULL),
(5907, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Costume Closet', 'Costume Closet', 'Marvel\'s Spider-Man', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(5908, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Cripta de Sangue', 'Blood Crypt', 'Lorwyn Eclipsed', 2, 66.68, 33.34, 'Magic: The Gathering', 'Geral', NULL),
(5909, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Cynical Loner', 'Cynical Loner', 'Noctumbra: A Casa dos Horrores', 1, 0.18, 0.18, 'Magic: The Gathering', 'Geral', NULL),
(5910, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dádiva dos Fios', 'Gift of Strands', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.40, 0.40, 'Magic: The Gathering', 'Geral', NULL),
(5911, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Darkness Descends', 'Darkness Descends', 'Lorwyn Eclipsed', 1, 0.51, 0.51, 'Magic: The Gathering', 'Geral', NULL),
(5912, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Dawn-Blessed Pennant', 'Dawn-Blessed Pennant', 'Lorwyn Eclipsed', 1, 0.33, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5913, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dawn-Blessed Pennant', 'Dawn-Blessed Pennant', 'Lorwyn Eclipsed', 3, 2.14, 0.71, 'Magic: The Gathering', 'Geral', NULL),
(5914, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Dawnhand Dissident', 'Dawnhand Dissident', 'Lorwyn Eclipsed', 1, 6.13, 6.13, 'Magic: The Gathering', 'Geral', NULL),
(5915, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Deepchannel Duelist', 'Deepchannel Duelist', 'Lorwyn Eclipsed', 4, 1.60, 0.40, 'Magic: The Gathering', 'Geral', NULL),
(5916, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Deepway Navigator', 'Deepway Navigator', 'Lorwyn Eclipsed', 3, 20.37, 6.79, 'Magic: The Gathering', 'Geral', NULL),
(5917, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Derrubar os Profanos', 'Fell the Profane', 'Modern Horizons 3', 1, 35.65, 35.65, 'Magic: The Gathering', 'Geral', NULL),
(5918, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Diamond Weapon', 'Diamond Weapon', 'FINAL FANTASY', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5919, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Disruptor of Currents', 'Disruptor of Currents', 'Lorwyn Eclipsed', 2, 9.20, 4.60, 'Magic: The Gathering', 'Geral', NULL),
(5920, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Don\'t Make a Sound', 'Don\'t Make a Sound', 'Noctumbra: A Casa dos Horrores', 1, 0.07, 0.07, 'Magic: The Gathering', 'Geral', NULL),
(5921, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Doomsday Excruciator', 'Doomsday Excruciator', 'Noctumbra: A Casa dos Horrores', 2, 3.88, 1.94, 'Magic: The Gathering', 'Geral', NULL),
(5922, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Doran, Besieged by Time', 'Doran, Besieged by Time', 'Lorwyn Eclipsed', 1, 6.87, 6.87, 'Magic: The Gathering', 'Geral', NULL),
(5923, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dose of Dawnglow', 'Dose of Dawnglow', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5924, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dragão Mandibular', 'Mandibular Kite', 'Modern Horizons 3', 1, 0.10, 0.10, 'Magic: The Gathering', 'Geral', NULL),
(5925, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dream Harvest', 'Dream Harvest', 'Lorwyn Eclipsed', 1, 2.69, 2.69, 'Magic: The Gathering', 'Geral', NULL),
(5926, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Dredger\'s Insight', 'Dredger\'s Insight', 'Aetherdrift', 1, 0.29, 0.29, 'Magic: The Gathering', 'Geral', NULL),
(5927, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Dundoolin Weaver', 'Dundoolin Weaver', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5928, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Earthen Ally', 'Earthen Ally', 'Avatar: The Last Airbender', 1, 0.77, 0.77, 'Magic: The Gathering', 'Geral', NULL),
(5929, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Eclipsed Elf', 'Eclipsed Elf', 'Lorwyn Eclipsed (Fable Frame)', 1, 1.35, 1.35, 'Magic: The Gathering', 'Geral', NULL),
(5930, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Eclipsed Flamekin', 'Eclipsed Flamekin', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5931, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Eclipsed Realms', 'Eclipsed Realms', 'Lorwyn Eclipsed', 4, 5.44, 1.36, 'Magic: The Gathering', 'Geral', NULL),
(5932, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Enviada dos Ancestrais', 'Envoy of the Ancestors', 'Modern Horizons 3', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5933, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Esmagar Cerco', 'Siege Smash', 'Modern Horizons 3', 1, 0.22, 0.22, 'Magic: The Gathering', 'Geral', NULL),
(5934, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Espécime Hidroelétrico', 'Hydroelectric Specimen', 'Modern Horizons 3', 1, 5.69, 5.69, 'Magic: The Gathering', 'Geral', NULL),
(5935, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Evershrike\'s Gift', 'Evershrike\'s Gift', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5936, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Extinguisher Battleship', 'Extinguisher Battleship', 'Edge of Eternities', 1, 1.00, 1.00, 'Magic: The Gathering', 'Geral', NULL),
(5937, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Faebloom Trick', 'Faebloom Trick', 'Foundations', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(5938, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Fatia de Lumespectro', 'Ghostfire Slice', 'Modern Horizons 3', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5939, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Figure of Fable', 'Figure of Fable', 'Lorwyn Eclipsed', 1, 1.12, 1.12, 'Magic: The Gathering', 'Geral', NULL),
(5940, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Firdoch Core', 'Firdoch Core', 'Lorwyn Eclipsed', 4, 0.64, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5941, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Fire Nation Attacks', 'Fire Nation Attacks', 'Avatar: The Last Airbender (Scene Cards)', 1, 0.90, 0.90, 'Magic: The Gathering', 'Geral', NULL),
(5942, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Fire Nation Palace', 'Fire Nation Palace', 'Avatar: The Last Airbender', 1, 8.63, 8.63, 'Magic: The Gathering', 'Geral', NULL),
(5943, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Flexible Waterbender', 'Flexible Waterbender', 'Avatar: The Last Airbender', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(5944, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Floodpits Drowner', 'Floodpits Drowner', 'Noctumbra: A Casa dos Horrores', 1, 0.52, 0.52, 'Magic: The Gathering', 'Geral', NULL),
(5945, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Floresta (#280)', 'Forest (#280)', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 2.85, 2.85, 'Magic: The Gathering', 'Geral', NULL),
(5946, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Foggy Bottom Swamp', 'Foggy Bottom Swamp', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5947, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Fonte Santificada', 'Hallowed Fountain', 'Lorwyn Eclipsed', 1, 31.43, 31.43, 'Magic: The Gathering', 'Geral', NULL),
(5948, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Força da Colheita', 'Strength of the Harvest', 'Modern Horizons 3', 1, 0.74, 0.74, 'Magic: The Gathering', 'Geral', NULL),
(5949, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Fundição Sagrada', 'Sacred Foundry', 'Port&otilde;es Violados', 1, 29.78, 29.78, 'Magic: The Gathering', 'Geral', NULL),
(5950, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'G\'raha Tia', 'G\'raha Tia', 'FINAL FANTASY', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(5951, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Gathering Stone', 'Gathering Stone', 'Lorwyn Eclipsed', 3, 3.06, 1.02, 'Magic: The Gathering', 'Geral', NULL),
(5952, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Gathering Stone', 'Gathering Stone', 'Lorwyn Eclipsed', 1, 1.02, 1.02, 'Magic: The Gathering', 'Geral', NULL),
(5953, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Giantfall', 'Giantfall', 'Lorwyn Eclipsed', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5954, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Glen Elendra Guardian', 'Glen Elendra Guardian', 'Lorwyn Eclipsed', 1, 8.61, 8.61, 'Magic: The Gathering', 'Geral', NULL),
(5955, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Glister Bairn', 'Glister Bairn', 'Lorwyn Eclipsed', 1, 0.33, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(5956, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Gloom Ripper', 'Gloom Ripper', 'Lorwyn Eclipsed', 1, 1.49, 1.49, 'Magic: The Gathering', 'Geral', NULL),
(5957, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Goliath Daydreamer', 'Goliath Daydreamer', 'Lorwyn Eclipsed', 1, 3.32, 3.32, 'Magic: The Gathering', 'Geral', NULL),
(5958, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Grub, Storied Matriarch', 'Grub, Storied Matriarch', 'Lorwyn Eclipsed', 1, 6.22, 6.22, 'Magic: The Gathering', 'Geral', NULL),
(5959, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Hakoda, Selfless Commander', 'Hakoda, Selfless Commander', 'Avatar: The Last Airbender', 1, 3.43, 3.43, 'Magic: The Gathering', 'Geral', NULL),
(5960, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Harmonized Crescendo', 'Harmonized Crescendo', 'Lorwyn Eclipsed', 2, 13.11, 6.56, 'Magic: The Gathering', 'Geral', NULL),
(5961, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Haste Magic', 'Haste Magic', 'FINAL FANTASY', 1, 0.23, 0.23, 'Magic: The Gathering', 'Geral', NULL),
(5962, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'High Perfect Morcant', 'High Perfect Morcant', 'Lorwyn Eclipsed', 1, 31.05, 31.05, 'Magic: The Gathering', 'Geral', NULL),
(5963, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Honor', 'Honor', 'Edge of Eternities', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(5964, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Hydro-Man, Fluid Felon', 'Hydro-Man, Fluid Felon', 'Marvel\'s Spider-Man', 1, 1.84, 1.84, 'Magic: The Gathering', 'Geral', NULL),
(5965, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ilha (#275)', 'Island (#275)', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 3.32, 3.32, 'Magic: The Gathering', 'Geral', NULL),
(5966, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Incubador de Urza', 'Urza\'s Incubator', 'Modern Horizons 3', 1, 67.85, 67.85, 'Magic: The Gathering', 'Geral', NULL),
(5967, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Iroh, Grande Lótus', 'Iroh, Grand Lotus', 'Avatar: The Last Airbender', 1, 3.53, 3.53, 'Magic: The Gathering', 'Geral', NULL),
(5968, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Iron-Shield Elf', 'Iron-Shield Elf', 'Lorwyn Eclipsed', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(5969, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'It\'ll Quench Ya!', 'It\'ll Quench Ya!', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5970, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Jardim do Templo', 'Temple Garden', 'Lorwyn Eclipsed', 2, 64.28, 32.14, 'Magic: The Gathering', 'Geral', NULL),
(5971, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Jasmine Dragon Tea Shop', 'Jasmine Dragon Tea Shop', 'Avatar: The Last Airbender', 1, 4.59, 4.59, 'Magic: The Gathering', 'Geral', NULL),
(5972, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Katara, a Destemida', 'Katara, the Fearless', 'Avatar: The Last Airbender', 1, 7.92, 7.92, 'Magic: The Gathering', 'Geral', NULL),
(5973, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Katara, Bending Prodigy', 'Katara, Bending Prodigy', 'Avatar: The Last Airbender', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(5974, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kinbinding', 'Kinbinding', 'Lorwyn Eclipsed', 1, 2.29, 2.29, 'Magic: The Gathering', 'Geral', NULL),
(5975, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Kindle the Inner Flame', 'Kindle the Inner Flame', 'Lorwyn Eclipsed', 1, 1.71, 1.71, 'Magic: The Gathering', 'Geral', NULL),
(5976, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kindle the Inner Flame', 'Kindle the Inner Flame', 'Lorwyn Eclipsed', 1, 0.71, 0.71, 'Magic: The Gathering', 'Geral', NULL),
(5977, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kinscaer Sentry', 'Kinscaer Sentry', 'Lorwyn Eclipsed', 1, 7.98, 7.98, 'Magic: The Gathering', 'Geral', NULL),
(5978, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Kirol, Attentive First-Year', 'Kirol, Attentive First-Year', 'Lorwyn Eclipsed', 2, 7.40, 3.70, 'Magic: The Gathering', 'Geral', NULL),
(5979, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kithkeeper', 'Kithkeeper', 'Lorwyn Eclipsed', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(5980, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kraven\'s Last Hunt', 'Kraven\'s Last Hunt', 'Marvel\'s Spider-Man (Panel Cards)', 1, 1.86, 1.86, 'Magic: The Gathering', 'Geral', NULL),
(5981, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Kyoshi Village', 'Kyoshi Village', 'Avatar: The Last Airbender', 2, 0.24, 0.12, 'Magic: The Gathering', 'Geral', NULL),
(5982, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lasting Tarfire', 'Lasting Tarfire', 'Lorwyn Eclipsed', 1, 0.21, 0.21, 'Magic: The Gathering', 'Geral', NULL),
(5983, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lavaleaper', 'Lavaleaper', 'Lorwyn Eclipsed', 1, 3.62, 3.62, 'Magic: The Gathering', 'Geral', NULL),
(5984, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Leyline Axe', 'Leyline Axe', 'Foundations', 1, 11.48, 11.48, 'Magic: The Gathering', 'Geral', NULL),
(5985, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Leyline of Transformation', 'Leyline of Transformation', 'Noctumbra: A Casa dos Horrores', 1, 1.17, 1.17, 'Magic: The Gathering', 'Geral', NULL),
(5986, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Liderança da Legião', 'Legion Leadership', 'Modern Horizons 3', 1, 0.80, 0.80, 'Magic: The Gathering', 'Geral', NULL),
(5987, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lionheart Glimmer', 'Lionheart Glimmer', 'Noctumbra: A Casa dos Horrores', 1, 0.10, 0.10, 'Magic: The Gathering', 'Geral', NULL),
(5988, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Lluwen, Imperfect Naturalist', 'Lluwen, Imperfect Naturalist', 'Lorwyn Eclipsed', 1, 4.65, 4.65, 'Magic: The Gathering', 'Geral', NULL),
(5989, 1, 24, 'Pokemon', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lombre', 'Lombre (#006/094)', 'Fogo Fantasmag&oacute;rico', 1, 0.11, 0.11, 'Pokemon', 'Geral', NULL),
(5990, 1, 24, 'Pokemon', 'Enviado', 'Melhor envio', 'LigaSegura', 'Lotad', 'Lotad (#005/094)', 'Fogo Fantasmag&oacute;rico', 1, 0.15, 0.15, 'Pokemon', 'Geral', NULL),
(5991, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Lotho, Condestável Corrupto', 'Lotho, Corrupt Shirriff', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 74.64, 74.64, 'Magic: The Gathering', 'Geral', NULL),
(5992, 1, 24, 'Pokemon', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ludicolo', 'Ludicolo (#007/094)', 'Fogo Fantasmag&oacute;rico', 1, 0.16, 0.16, 'Pokemon', 'Geral', NULL),
(5993, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Magistrado de Drannith', 'Drannith Magistrate', 'Ikoria: Terra de Colossos', 1, 57.38, 57.38, 'Magic: The Gathering', 'Geral', NULL),
(5994, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Maralen, Fae Ascendant', 'Maralen, Fae Ascendant', 'Lorwyn Eclipsed', 1, 11.27, 11.27, 'Magic: The Gathering', 'Geral', NULL),
(5995, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Marvin, Murderous Mimic', 'Marvin, Murderous Mimic', 'Noctumbra: A Casa dos Horrores', 1, 5.16, 5.16, 'Magic: The Gathering', 'Geral', NULL),
(5996, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Master Piandao', 'Master Piandao', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5997, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Meanders Guide', 'Meanders Guide', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(5998, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Meditation Pools', 'Meditation Pools', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(5999, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Midnight Tilling', 'Midnight Tilling', 'Lorwyn Eclipsed', 4, 0.64, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(6000, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Mindspring Merfolk', 'Mindspring Merfolk', 'Aetherdrift', 1, 1.60, 1.60, 'Magic: The Gathering', 'Geral', NULL),
(6001, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Misty Palms Oasis', 'Misty Palms Oasis', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6002, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Montanha (#277)', 'Mountain (#277)', 'Lorwyn Eclipsed', 4, 3.04, 0.76, 'Magic: The Gathering', 'Geral', NULL),
(6003, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Moon-Vigil Adherents', 'Moon-Vigil Adherents', 'Lorwyn Eclipsed', 1, 0.33, 0.33, 'Magic: The Gathering', 'Geral', NULL),
(6004, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Morcant\'s Eyes', 'Morcant\'s Eyes', 'Lorwyn Eclipsed', 1, 0.29, 0.29, 'Magic: The Gathering', 'Geral', NULL),
(6005, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Morcegos da Floresta das Trevas', 'Mirkwood Bats', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 3.45, 3.45, 'Magic: The Gathering', 'Geral', NULL),
(6006, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Mountain (#282)', 'Mountain (#282)', 'Lorwyn Eclipsed', 2, 1.54, 0.77, 'Magic: The Gathering', 'Geral', NULL),
(6007, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Mudbutton Cursetosser', 'Mudbutton Cursetosser', 'Lorwyn Eclipsed', 3, 1.35, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(6008, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Mutable Explorer', 'Mutable Explorer', 'Lorwyn Eclipsed', 1, 17.41, 17.41, 'Magic: The Gathering', 'Geral', NULL),
(6009, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Mysidian Elder', 'Mysidian Elder', 'FINAL FANTASY', 2, 1.38, 0.69, 'Magic: The Gathering', 'Geral', NULL),
(6010, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Nascer do Dia', 'Rising of the Day', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 4.48, 4.48, 'Magic: The Gathering', 'Geral', NULL),
(6011, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Nibelheim Aflame', 'Nibelheim Aflame', 'FINAL FANTASY', 1, 28.46, 28.46, 'Magic: The Gathering', 'Geral', NULL),
(6012, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Noggle Robber', 'Noggle Robber', 'Lorwyn Eclipsed', 1, 0.32, 0.32, 'Magic: The Gathering', 'Geral', NULL),
(6013, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'North Pole Gates', 'North Pole Gates', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6014, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Omashu City', 'Omashu City', 'Avatar: The Last Airbender', 2, 0.30, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(6015, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Omni-Changeling', 'Omni-Changeling', 'Lorwyn Eclipsed', 4, 1.94, 0.49, 'Magic: The Gathering', 'Geral', NULL),
(6016, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ondulações de Morte-Vida', 'Ripples of Undeath', 'Modern Horizons 3', 1, 28.03, 28.03, 'Magic: The Gathering', 'Geral', NULL),
(6017, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Origin of Spider-Man', 'Origin of Spider-Man', 'Marvel\'s Spider-Man', 1, 1.14, 1.14, 'Magic: The Gathering', 'Geral', NULL),
(6018, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pântano (#276)', 'Swamp (#276)', 'Lorwyn Eclipsed', 4, 2.28, 0.57, 'Magic: The Gathering', 'Geral', NULL),
(6019, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Pequenina Deliciada', 'Delighted Halfling', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 132.13, 132.13, 'Magic: The Gathering', 'Geral', NULL),
(6020, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Perfurar Mágica', 'Spell Pierce', 'Aetherdrift', 1, 0.91, 0.91, 'Magic: The Gathering', 'Geral', NULL),
(6021, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pestered Wellguard', 'Pestered Wellguard', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(6022, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Peter Parker\'s Camera', 'Peter Parker\'s Camera', 'Marvel\'s Spider-Man (Extended Art)', 2, 15.18, 7.59, 'Magic: The Gathering', 'Geral', NULL),
(6023, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Piromante Experiente', 'Seasoned Pyromancer', 'Modern Horizons', 1, 51.50, 51.50, 'Magic: The Gathering', 'Geral', NULL),
(6024, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pirossurfista Imprudente', 'Reckless Pyrosurfer', 'Modern Horizons 3', 1, 0.13, 0.13, 'Magic: The Gathering', 'Geral', NULL),
(6025, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Pitiless Fists', 'Pitiless Fists', 'Lorwyn Eclipsed', 1, 0.29, 0.29, 'Magic: The Gathering', 'Geral', NULL),
(6026, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Planície (#272)', 'Plains (#272)', 'Noctumbra: A Casa dos Horrores', 3, 2.70, 0.90, 'Magic: The Gathering', 'Geral', NULL),
(6027, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Plasma Bolt', 'Plasma Bolt', 'Edge of Eternities', 1, 0.06, 0.06, 'Magic: The Gathering', 'Geral', NULL),
(6028, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Príncipe Imrahil, o Belo', 'Prince Imrahil the Fair', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.21, 0.21, 'Magic: The Gathering', 'Geral', NULL),
(6029, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Praia Inundada', 'Flooded Strand', 'Khans de Tarkir', 1, 59.90, 59.90, 'Magic: The Gathering', 'Geral', NULL),
(6030, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Price of Freedom', 'Price of Freedom', 'Avatar: The Last Airbender', 1, 1.00, 1.00, 'Magic: The Gathering', 'Geral', NULL),
(6031, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Prideful Parent', 'Prideful Parent', 'Foundations', 1, 0.12, 0.12, 'Magic: The Gathering', 'Geral', NULL),
(6032, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Prismabasher', 'Prismabasher', 'Lorwyn Eclipsed', 1, 0.24, 0.24, 'Magic: The Gathering', 'Geral', NULL),
(6033, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Prismatic Undercurrents', 'Prismatic Undercurrents', 'Lorwyn Eclipsed', 1, 0.76, 0.76, 'Magic: The Gathering', 'Geral', NULL),
(6034, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Puca\'s Eye', 'Puca\'s Eye', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(6035, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Radioactive Spider', 'Radioactive Spider', 'Marvel\'s Spider-Man', 1, 2.88, 2.88, 'Magic: The Gathering', 'Geral', NULL),
(6036, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ragost, Deft Gastronaut', 'Ragost, Deft Gastronaut', 'Edge of Eternities', 1, 1.03, 1.03, 'Magic: The Gathering', 'Geral', NULL),
(6037, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Raiding Schemes', 'Raiding Schemes', 'Lorwyn Eclipsed', 1, 3.31, 3.31, 'Magic: The Gathering', 'Geral', NULL),
(6038, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ral e o Labirinto Implícito', 'Ral and the Implicit Maze', 'Modern Horizons 3', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(6039, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Reaping Willow', 'Reaping Willow', 'Lorwyn Eclipsed', 1, 0.32, 0.32, 'Magic: The Gathering', 'Geral', NULL),
(6040, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Reluctant Role Model', 'Reluctant Role Model', 'Noctumbra: A Casa dos Horrores', 1, 0.78, 0.78, 'Magic: The Gathering', 'Geral', NULL),
(6041, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Requiting Hex', 'Requiting Hex', 'Lorwyn Eclipsed', 3, 6.03, 2.01, 'Magic: The Gathering', 'Geral', NULL),
(6042, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Requiting Hex', 'Requiting Hex', 'Lorwyn Eclipsed', 1, 1.15, 1.15, 'Magic: The Gathering', 'Geral', NULL),
(6043, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Rhys, the Evermore', 'Rhys, the Evermore', 'Lorwyn Eclipsed', 1, 9.17, 9.17, 'Magic: The Gathering', 'Geral', NULL),
(6044, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Ritual Sombrio', 'Dark Ritual', 'The List', 1, 22.88, 22.88, 'Magic: The Gathering', 'Geral', NULL),
(6045, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Riverpyre Verge', 'Riverpyre Verge', 'Aetherdrift', 1, 80.37, 80.37, 'Magic: The Gathering', 'Geral', NULL),
(6046, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Rocket-Powered Goblin Glider', 'Rocket-Powered Goblin Glider', 'Marvel\'s Spider-Man', 1, 0.90, 0.90, 'Magic: The Gathering', 'Geral', NULL),
(6047, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sacerdote de Titânia', 'Priest of Titania', 'Modern Horizons 3', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(6048, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Safewright Cavalry', 'Safewright Cavalry', 'Lorwyn Eclipsed', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(6049, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Samurai\'s Katana', 'Samurai\'s Katana', 'FINAL FANTASY', 1, 0.23, 0.23, 'Magic: The Gathering', 'Geral', NULL),
(6050, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Sanar, Innovative First-Year', 'Sanar, Innovative First-Year', 'Lorwyn Eclipsed', 1, 2.00, 2.00, 'Magic: The Gathering', 'Geral', NULL),
(6051, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Scarblade\'s Malice', 'Scarblade\'s Malice', 'Lorwyn Eclipsed', 3, 0.51, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6052, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Scuzzback Scrounger', 'Scuzzback Scrounger', 'Lorwyn Eclipsed', 1, 2.88, 2.88, 'Magic: The Gathering', 'Geral', NULL),
(6053, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Seam Rip', 'Seam Rip', 'Edge of Eternities', 2, 8.96, 4.48, 'Magic: The Gathering', 'Geral', NULL),
(6054, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Sear', 'Sear', 'Lorwyn Eclipsed', 3, 6.84, 2.28, 'Magic: The Gathering', 'Geral', NULL),
(6055, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Seismic Sense', 'Seismic Sense', 'Avatar: The Last Airbender', 1, 1.66, 1.66, 'Magic: The Gathering', 'Geral', NULL),
(6056, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Selfless Safewright', 'Selfless Safewright', 'Lorwyn Eclipsed', 3, 27.57, 9.19, 'Magic: The Gathering', 'Geral', NULL),
(6057, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sequestro de Bode', 'Goatnap', 'Lorwyn Eclipsed', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(6058, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Serpent\'s Pass', 'Serpent\'s Pass', 'Avatar: The Last Airbender', 1, 0.14, 0.14, 'Magic: The Gathering', 'Geral', NULL),
(6059, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Shagrat, Carregador de Espólios', 'Shagrat, Loot Bearer', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 0.86, 0.86, 'Magic: The Gathering', 'Geral', NULL),
(6060, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Shimmercreep', 'Shimmercreep', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(6061, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Shimmerwilds Growth', 'Shimmerwilds Growth', 'Lorwyn Eclipsed', 1, 0.86, 0.86, 'Magic: The Gathering', 'Geral', NULL),
(6062, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sidequest: Catch a Fish', 'Sidequest: Catch a Fish', 'FINAL FANTASY', 1, 0.20, 0.20, 'Magic: The Gathering', 'Geral', NULL),
(6063, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Silvergill Mentor', 'Silvergill Mentor', 'Lorwyn Eclipsed', 4, 2.64, 0.66, 'Magic: The Gathering', 'Geral', NULL),
(6064, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sizzling Changeling', 'Sizzling Changeling', 'Lorwyn Eclipsed', 1, 0.32, 0.32, 'Magic: The Gathering', 'Geral', NULL),
(6065, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Skyknight Squire', 'Skyknight Squire', 'Foundations', 1, 1.70, 1.70, 'Magic: The Gathering', 'Geral', NULL),
(6066, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sodden Verdure', 'Sodden Verdure', 'Lorwyn Eclipsed Commander', 1, 10.52, 10.52, 'Magic: The Gathering', 'Geral', NULL),
(6067, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sokka, Lateral Strategist', 'Sokka, Lateral Strategist', 'Avatar: The Last Airbender', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(6068, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'South Pole Voyager', 'South Pole Voyager', 'Avatar: The Last Airbender', 1, 2.28, 2.28, 'Magic: The Gathering', 'Geral', NULL),
(6069, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Spider-Man No More', 'Spider-Man No More', 'Marvel\'s Spider-Man', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(6070, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Spider-Woman, Stunning Savior', 'Spider-Woman, Stunning Savior', 'Marvel\'s Spider-Man', 1, 10.18, 10.18, 'Magic: The Gathering', 'Geral', NULL),
(6071, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Springleaf Parade', 'Springleaf Parade', 'Lorwyn Eclipsed Commander', 1, 44.56, 44.56, 'Magic: The Gathering', 'Geral', NULL),
(6072, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sting-Slinger', 'Sting-Slinger', 'Lorwyn Eclipsed', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(6073, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Suki, Kyoshi Warrior', 'Suki, Kyoshi Warrior', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6074, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sun Warriors', 'Sun Warriors', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6075, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sun-Blessed Peak', 'Sun-Blessed Peak', 'Avatar: The Last Airbender', 2, 0.34, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6076, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Superior Spider-Man', 'Superior Spider-Man', 'Marvel\'s Spider-Man (Extended Art)', 2, 38.26, 19.13, 'Magic: The Gathering', 'Geral', NULL),
(6077, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Swat Away', 'Swat Away', 'Lorwyn Eclipsed', 1, 0.51, 0.51, 'Magic: The Gathering', 'Geral', NULL),
(6078, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Sygg\'s Command', 'Sygg\'s Command', 'Lorwyn Eclipsed', 1, 6.89, 6.89, 'Magic: The Gathering', 'Geral', NULL),
(6079, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Symbiote Spider-Man', 'Symbiote Spider-Man', 'Marvel\'s Spider-Man (Web-Slinger)', 1, 5.63, 5.63, 'Magic: The Gathering', 'Geral', NULL),
(6080, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tambor das Folhas Vernais', 'Springleaf Drum', 'Lorwyn Eclipsed', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(6081, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tanufel Rimespeaker', 'Tanufel Rimespeaker', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(6082, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Terras em Desenvolvimento', 'Evolving Wilds', 'Foundations', 1, 0.12, 0.12, 'Magic: The Gathering', 'Geral', NULL),
(6083, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Clone Saga', 'The Clone Saga', 'Marvel\'s Spider-Man', 1, 1.01, 1.01, 'Magic: The Gathering', 'Geral', NULL),
(6084, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Death of Gwen Stacy', 'The Death of Gwen Stacy', 'Marvel\'s Spider-Man', 1, 1.61, 1.61, 'Magic: The Gathering', 'Geral', NULL),
(6085, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Unagi of Kyoshi Island', 'The Unagi of Kyoshi Island', 'Avatar: The Last Airbender (Field Notes)', 1, 19.26, 19.26, 'Magic: The Gathering', 'Geral', NULL);
INSERT INTO `vendas_ligamagic` (`id_venda_liga`, `id_loja`, `id_lote`, `tipo_produto`, `status_venda`, `forma_envio`, `forma_pagamento`, `nome_produto_pt`, `nome_produto_en`, `categoria_completa`, `quantidade`, `preco_total`, `preco_medio`, `jogo_base`, `subcategoria`, `edicao_categoria_limpa`) VALUES
(6086, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'The Unagi of Kyoshi Island', 'The Unagi of Kyoshi Island', 'Avatar: The Last Airbender', 1, 11.76, 11.76, 'Magic: The Gathering', 'Geral', NULL),
(6087, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Thoughtweft Charge', 'Thoughtweft Charge', 'Lorwyn Eclipsed', 1, 0.23, 0.23, 'Magic: The Gathering', 'Geral', NULL),
(6088, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Thoughtweft Imbuer', 'Thoughtweft Imbuer', 'Lorwyn Eclipsed', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(6089, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tidus, Blitzball Star', 'Tidus, Blitzball Star', 'FINAL FANTASY', 1, 0.28, 0.28, 'Magic: The Gathering', 'Geral', NULL),
(6090, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Timeline Culler', 'Timeline Culler', 'Edge of Eternities', 1, 0.45, 0.45, 'Magic: The Gathering', 'Geral', NULL),
(6091, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Toph, the First Metalbender', 'Toph, the First Metalbender', 'Avatar: The Last Airbender', 1, 18.39, 18.39, 'Magic: The Gathering', 'Geral', NULL),
(6092, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Torre Phyrexiana', 'Phyrexian Tower', 'Modern Horizons 3', 1, 119.60, 119.60, 'Magic: The Gathering', 'Geral', NULL),
(6093, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Trainadora Papão', 'Boggart Trawler', 'Modern Horizons 3', 1, 8.77, 8.77, 'Magic: The Gathering', 'Geral', NULL),
(6094, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Transit Mage', 'Transit Mage', 'Aetherdrift', 1, 0.46, 0.46, 'Magic: The Gathering', 'Geral', NULL),
(6095, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Trystan\'s Command', 'Trystan\'s Command', 'Lorwyn Eclipsed', 1, 2.28, 2.28, 'Magic: The Gathering', 'Geral', NULL),
(6096, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Pix', 'Tumba Abandonada', 'Overgrown Tomb', 'Lorwyn Eclipsed', 1, 33.75, 33.75, 'Magic: The Gathering', 'Geral', NULL),
(6097, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Tumbamorfo', 'Graveshifter', 'Lorwyn Eclipsed', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(6098, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Twilight Diviner', 'Twilight Diviner', 'Lorwyn Eclipsed', 2, 12.64, 6.32, 'Magic: The Gathering', 'Geral', NULL),
(6099, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Twinflame Travelers', 'Twinflame Travelers', 'Lorwyn Eclipsed', 1, 0.85, 0.85, 'Magic: The Gathering', 'Geral', NULL),
(6100, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Um Anel Para Todos Governar', 'One Ring to Rule Them All', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 11.21, 11.21, 'Magic: The Gathering', 'Geral', NULL),
(6101, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'Cartão de Crédito', 'Unlucky Cabbage Merchant', 'Unlucky Cabbage Merchant', 'Avatar: The Last Airbender', 1, 0.82, 0.82, 'Magic: The Gathering', 'Geral', NULL),
(6102, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Valfenda', 'Rivendell', 'O Senhor dos An&eacute;is: Contos da Terra M&eacute;dia', 1, 14.65, 14.65, 'Magic: The Gathering', 'Geral', NULL),
(6103, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vanish from Sight', 'Vanish from Sight', 'Noctumbra: A Casa dos Horrores', 1, 0.04, 0.04, 'Magic: The Gathering', 'Geral', NULL),
(6104, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vastidão Morfoterrena', 'Terramorphic Expanse', 'Noctumbra: A Casa dos Horrores', 1, 0.15, 0.15, 'Magic: The Gathering', 'Geral', NULL),
(6105, 1, 24, 'Magic: The Gathering', 'Pedido Separado - Aguardando retirada no Balcão', 'Retirada no balcão', 'Pix', 'Vibrance', 'Vibrance', 'Lorwyn Eclipsed', 1, 60.51, 60.51, 'Magic: The Gathering', 'Geral', NULL),
(6106, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vibrant Cityscape', 'Vibrant Cityscape', 'Marvel\'s Spider-Man', 1, 0.16, 0.16, 'Magic: The Gathering', 'Geral', NULL),
(6107, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vinebred Brawler', 'Vinebred Brawler', 'Lorwyn Eclipsed', 1, 0.30, 0.30, 'Magic: The Gathering', 'Geral', NULL),
(6108, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vingadora Espada Veloz', 'Swiftblade Vindicator', 'Foundations', 1, 0.38, 0.38, 'Magic: The Gathering', 'Geral', NULL),
(6109, 1, 24, 'Magic: The Gathering', 'Retirado no Balcão', 'Retirada no balcão', 'Créditos', 'Violent Urge', 'Violent Urge', 'Noctumbra: A Casa dos Horrores', 3, 0.71, 0.24, 'Magic: The Gathering', 'Geral', NULL),
(6110, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Virulent Emissary', 'Virulent Emissary', 'Lorwyn Eclipsed', 2, 2.06, 1.03, 'Magic: The Gathering', 'Geral', NULL),
(6111, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Vitimar', 'Victimize', 'Modern Horizons 3', 1, 1.71, 1.71, 'Magic: The Gathering', 'Geral', NULL),
(6112, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Voracious Tome-Skimmer', 'Voracious Tome-Skimmer', 'Lorwyn Eclipsed', 1, 1.00, 1.00, 'Magic: The Gathering', 'Geral', NULL),
(6113, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Wanderbrine Trapper', 'Wanderbrine Trapper', 'Lorwyn Eclipsed', 3, 0.60, 0.20, 'Magic: The Gathering', 'Geral', NULL),
(6114, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Warren Torchmaster', 'Warren Torchmaster', 'Lorwyn Eclipsed', 1, 0.25, 0.25, 'Magic: The Gathering', 'Geral', NULL),
(6115, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Waterbending Lesson', 'Waterbending Lesson', 'Avatar: The Last Airbender', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(6116, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Watery Grasp', 'Watery Grasp', 'Avatar: The Last Airbender', 1, 0.11, 0.11, 'Magic: The Gathering', 'Geral', NULL),
(6117, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'White Auracite', 'White Auracite', 'FINAL FANTASY', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL),
(6118, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'White Lotus Hideout', 'White Lotus Hideout', 'Avatar: The Last Airbender', 1, 0.26, 0.26, 'Magic: The Gathering', 'Geral', NULL),
(6119, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Winnowing', 'Winnowing', 'Lorwyn Eclipsed', 2, 8.30, 4.15, 'Magic: The Gathering', 'Geral', NULL),
(6120, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Yue, the Moon Spirit', 'Yue, the Moon Spirit', 'Avatar: The Last Airbender', 1, 1.71, 1.71, 'Magic: The Gathering', 'Geral', NULL),
(6121, 1, 24, 'Magic: The Gathering', 'Enviado', 'Melhor envio', 'LigaSegura', 'Zuko\'s Exile', 'Zuko\'s Exile', 'Avatar: The Last Airbender', 1, 0.17, 0.17, 'Magic: The Gathering', 'Geral', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin_lojas`
--
ALTER TABLE `admin_lojas`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices de tabela `cardgames`
--
ALTER TABLE `cardgames`
  ADD PRIMARY KEY (`id_cardgame`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Índices de tabela `clientes_cardgames`
--
ALTER TABLE `clientes_cardgames`
  ADD PRIMARY KEY (`id_cliente`,`id_cardgame`),
  ADD KEY `id_cardgame` (`id_cardgame`);

--
-- Índices de tabela `clientes_lojas`
--
ALTER TABLE `clientes_lojas`
  ADD PRIMARY KEY (`id_cliente`,`id_loja`),
  ADD KEY `id_loja` (`id_loja`);

--
-- Índices de tabela `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_loja` (`id_loja`);

--
-- Índices de tabela `estoque_movimentacoes`
--
ALTER TABLE `estoque_movimentacoes`
  ADD PRIMARY KEY (`id_mov`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `logs_pedidos`
--
ALTER TABLE `logs_pedidos`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Índices de tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id_loja`);

--
-- Índices de tabela `lojas_contratos_historico`
--
ALTER TABLE `lojas_contratos_historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_loja` (`id_loja`),
  ADD KEY `idx_contrato` (`id_contrato`);

--
-- Índices de tabela `lotes_importacao`
--
ALTER TABLE `lotes_importacao`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_loja` (`id_loja`),
  ADD KEY `data_importacao` (`data_importacao`);

--
-- Índices de tabela `notas_fiscais`
--
ALTER TABLE `notas_fiscais`
  ADD PRIMARY KEY (`id_nf`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_loja` (`id_loja`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `pedido_pagamento`
--
ALTER TABLE `pedido_pagamento`
  ADD PRIMARY KEY (`id_pedido`,`id_pagamento`),
  ADD KEY `id_pagamento` (`id_pagamento`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `id_loja` (`id_loja`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices de tabela `tipos_pagamento`
--
ALTER TABLE `tipos_pagamento`
  ADD PRIMARY KEY (`id_pagamento`);

--
-- Índices de tabela `torneios`
--
ALTER TABLE `torneios`
  ADD PRIMARY KEY (`id_torneio`),
  ADD KEY `id_loja` (`id_loja`),
  ADD KEY `id_cardgame` (`id_cardgame`);

--
-- Índices de tabela `torneio_debug_logs`
--
ALTER TABLE `torneio_debug_logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `torneio_participantes`
--
ALTER TABLE `torneio_participantes`
  ADD PRIMARY KEY (`id_torneio`,`id_cliente`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `torneio_partidas`
--
ALTER TABLE `torneio_partidas`
  ADD PRIMARY KEY (`id_partida`),
  ADD KEY `id_rodada` (`id_rodada`),
  ADD KEY `id_jogador1` (`id_jogador1`),
  ADD KEY `id_jogador2` (`id_jogador2`),
  ADD KEY `fk_vencedor` (`vencedor_id`);

--
-- Índices de tabela `torneio_resultados_finais`
--
ALTER TABLE `torneio_resultados_finais`
  ADD PRIMARY KEY (`id_torneio`,`id_cliente`),
  ADD KEY `fk_res_cliente` (`id_cliente`);

--
-- Índices de tabela `torneio_rodadas`
--
ALTER TABLE `torneio_rodadas`
  ADD PRIMARY KEY (`id_rodada`),
  ADD KEY `id_torneio` (`id_torneio`);

--
-- Índices de tabela `usuarios_loja`
--
ALTER TABLE `usuarios_loja`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_loja` (`id_loja`);

--
-- Índices de tabela `vendas_ligamagic`
--
ALTER TABLE `vendas_ligamagic`
  ADD PRIMARY KEY (`id_venda_liga`),
  ADD KEY `id_loja` (`id_loja`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `jogo_base` (`jogo_base`),
  ADD KEY `tipo_produto` (`tipo_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin_lojas`
--
ALTER TABLE `admin_lojas`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cardgames`
--
ALTER TABLE `cardgames`
  MODIFY `id_cardgame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `estoque_movimentacoes`
--
ALTER TABLE `estoque_movimentacoes`
  MODIFY `id_mov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `logs_pedidos`
--
ALTER TABLE `logs_pedidos`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id_loja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `lojas_contratos_historico`
--
ALTER TABLE `lojas_contratos_historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `lotes_importacao`
--
ALTER TABLE `lotes_importacao`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `notas_fiscais`
--
ALTER TABLE `notas_fiscais`
  MODIFY `id_nf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tipos_pagamento`
--
ALTER TABLE `tipos_pagamento`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `torneios`
--
ALTER TABLE `torneios`
  MODIFY `id_torneio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de tabela `torneio_debug_logs`
--
ALTER TABLE `torneio_debug_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `torneio_partidas`
--
ALTER TABLE `torneio_partidas`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de tabela `torneio_rodadas`
--
ALTER TABLE `torneio_rodadas`
  MODIFY `id_rodada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `usuarios_loja`
--
ALTER TABLE `usuarios_loja`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `vendas_ligamagic`
--
ALTER TABLE `vendas_ligamagic`
  MODIFY `id_venda_liga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6122;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `clientes_cardgames`
--
ALTER TABLE `clientes_cardgames`
  ADD CONSTRAINT `clientes_cardgames_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `clientes_cardgames_ibfk_2` FOREIGN KEY (`id_cardgame`) REFERENCES `cardgames` (`id_cardgame`);

--
-- Restrições para tabelas `clientes_lojas`
--
ALTER TABLE `clientes_lojas`
  ADD CONSTRAINT `clientes_lojas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `clientes_lojas_ibfk_2` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`);

--
-- Restrições para tabelas `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`);

--
-- Restrições para tabelas `estoque_movimentacoes`
--
ALTER TABLE `estoque_movimentacoes`
  ADD CONSTRAINT `estoque_movimentacoes_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Restrições para tabelas `logs_pedidos`
--
ALTER TABLE `logs_pedidos`
  ADD CONSTRAINT `logs_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

--
-- Restrições para tabelas `lojas_contratos_historico`
--
ALTER TABLE `lojas_contratos_historico`
  ADD CONSTRAINT `fk_historico_contrato` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id_contrato`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_historico_loja` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`) ON DELETE CASCADE;

--
-- Restrições para tabelas `notas_fiscais`
--
ALTER TABLE `notas_fiscais`
  ADD CONSTRAINT `notas_fiscais_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id_fornecedor`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Restrições para tabelas `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  ADD CONSTRAINT `pedidos_itens_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `pedidos_itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Restrições para tabelas `pedido_pagamento`
--
ALTER TABLE `pedido_pagamento`
  ADD CONSTRAINT `pedido_pagamento_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `pedido_pagamento_ibfk_2` FOREIGN KEY (`id_pagamento`) REFERENCES `tipos_pagamento` (`id_pagamento`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id_fornecedor`);

--
-- Restrições para tabelas `torneios`
--
ALTER TABLE `torneios`
  ADD CONSTRAINT `torneios_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`),
  ADD CONSTRAINT `torneios_ibfk_2` FOREIGN KEY (`id_cardgame`) REFERENCES `cardgames` (`id_cardgame`);

--
-- Restrições para tabelas `torneio_participantes`
--
ALTER TABLE `torneio_participantes`
  ADD CONSTRAINT `torneio_participantes_ibfk_1` FOREIGN KEY (`id_torneio`) REFERENCES `torneios` (`id_torneio`),
  ADD CONSTRAINT `torneio_participantes_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Restrições para tabelas `torneio_partidas`
--
ALTER TABLE `torneio_partidas`
  ADD CONSTRAINT `fk_vencedor` FOREIGN KEY (`vencedor_id`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `torneio_partidas_ibfk_1` FOREIGN KEY (`id_rodada`) REFERENCES `torneio_rodadas` (`id_rodada`),
  ADD CONSTRAINT `torneio_partidas_ibfk_2` FOREIGN KEY (`id_jogador1`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `torneio_partidas_ibfk_3` FOREIGN KEY (`id_jogador2`) REFERENCES `clientes` (`id_cliente`);

--
-- Restrições para tabelas `torneio_resultados_finais`
--
ALTER TABLE `torneio_resultados_finais`
  ADD CONSTRAINT `fk_res_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `fk_res_torneio` FOREIGN KEY (`id_torneio`) REFERENCES `torneios` (`id_torneio`);

--
-- Restrições para tabelas `torneio_rodadas`
--
ALTER TABLE `torneio_rodadas`
  ADD CONSTRAINT `torneio_rodadas_ibfk_1` FOREIGN KEY (`id_torneio`) REFERENCES `torneios` (`id_torneio`);

--
-- Restrições para tabelas `usuarios_loja`
--
ALTER TABLE `usuarios_loja`
  ADD CONSTRAINT `usuarios_loja_ibfk_1` FOREIGN KEY (`id_loja`) REFERENCES `lojas` (`id_loja`);

--
-- Restrições para tabelas `vendas_ligamagic`
--
ALTER TABLE `vendas_ligamagic`
  ADD CONSTRAINT `fk_venda_lote` FOREIGN KEY (`id_lote`) REFERENCES `lotes_importacao` (`id_lote`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

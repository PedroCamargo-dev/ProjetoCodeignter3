-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.33 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para manyminds
CREATE DATABASE IF NOT EXISTS `manyminds` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `manyminds`;

-- Copiando estrutura para tabela manyminds.adresses
CREATE TABLE IF NOT EXISTS `adresses` (
  `idAddress` int(10) NOT NULL AUTO_INCREMENT,
  `idUser` int(10) NOT NULL DEFAULT '0',
  `street` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `postalCode` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idAddress`),
  KEY `FK_adresses_users` (`idUser`),
  CONSTRAINT `FK_adresses_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela manyminds.adresses: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `adresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `adresses` ENABLE KEYS */;

-- Copiando estrutura para tabela manyminds.functions
CREATE TABLE IF NOT EXISTS `functions` (
  `idFunction` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idFunction`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela manyminds.functions: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `functions` DISABLE KEYS */;
INSERT INTO `functions` (`idFunction`, `name`, `status`) VALUES
	(1, 'Administrador', 1),
	(2, 'Colaborador', 1),
	(3, 'Colaborador/Fornecedor', 1);
/*!40000 ALTER TABLE `functions` ENABLE KEYS */;

-- Copiando estrutura para tabela manyminds.products
CREATE TABLE IF NOT EXISTS `products` (
  `idProduct` int(10) NOT NULL AUTO_INCREMENT,
  `idUser` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `description` text,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`idProduct`) USING BTREE,
  KEY `idUser` (`idUser`),
  CONSTRAINT `FK_products_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela manyminds.products: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`idProduct`, `idUser`, `name`, `value`, `amount`, `description`, `status`) VALUES
	(21, 4, 'Carro', 12333.32, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1),
	(22, 4, 'Carro', 32433.43, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1),
	(23, 5, 'Teste', 4.33, 34, 'aSDASDASADSADSADSASD', 1),
	(24, 5, 'Teste2asdasdasd', 12341.23, 23, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 1),
	(25, 5, 'asd', 343.44, 34, 'asdasdada', 1),
	(26, 4, 'Pedro', 3432.45, 434, 'Teste', 1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando estrutura para tabela manyminds.users
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(10) NOT NULL AUTO_INCREMENT,
  `idFunction` int(10) NOT NULL DEFAULT '0',
  `userName` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idUser`) USING BTREE,
  KEY `FK_users_functions` (`idFunction`) USING BTREE,
  CONSTRAINT `FK_users_functions` FOREIGN KEY (`idFunction`) REFERENCES `functions` (`idFunction`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela manyminds.users: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`idUser`, `idFunction`, `userName`, `firstName`, `lastName`, `email`, `password`, `phone`, `status`) VALUES
	(1, 1, 'adm', 'Pedro', 'Camargo', 'pedrocamargo3008@gmail.com', 'adm@123', '35999468945', 1),
	(2, 3, 'rebeca', 'Rebeca', 'Jeieli', 'rebecaaajeieli@gmail.com', 'rebeca', '35999468945', 0),
	(3, 1, 'asd', 'asd', 'asd', 'asd@aasd.com', 'asd', '12345678910', 1),
	(4, 3, 'pedrocamargo', 'Pedro', 'Camargo', 'pedrocamargo3008@gmail.com', 'pedrocamargo', '35999468945', 1),
	(5, 3, 'rebeca', 'Rebeca', 'Jeieli', 'pedrocamargo300@gmail.com', 'rebeca', '12345678910', 1),
	(6, 2, 'colaborador', 'colaborador', 'colaborador', 'colaborador3008@gmail.com', 'colaborador', '12345678910', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

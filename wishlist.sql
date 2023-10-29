/* Script de criação do banco de dados, usuários e tabelas */

-- BANCO DE DADOS
DROP DATABASE IF EXISTS wishlist;
CREATE DATABASE wishlist;
USE wishlist;

-- USUÁRIO
DROP USER 'etecia'@'localhost';
CREATE USER 'etecia'@'localhost' IDENTIFIED BY 'api@etec.com';
GRANT ALL ON * . * TO 'etecia'@'localhost';
FLUSH PRIVILEGES;

-- TABELA
CREATE TABLE IF NOT EXISTS `wishlist` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `produto` VARCHAR(255) NOT NULL,
    `link` VARCHAR(255) NOT NULL,
    `preco` DECIMAL(10,2) NOT NULL,
    `categoria` VARCHAR(60) NOT NULL,
    PRIMARY KEY(id)
);

-- DADOS
INSERT INTO `wishlist` (id, produto, link, preco, categoria)
VALUES
(NULL, 'Camiseta', 'amazon.com', '15.00', 'Roupas'),
(NULL, 'Playstation 5', 'casasbahia.com', '3000.00', 'Jogos'),
(NULL, 'Fogão', 'pontofrio.com', '1500.00', 'Cozinha');

-- SELECT
SELECT * FROM wishlist;
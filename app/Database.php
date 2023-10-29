<?php

namespace App;

use \PDO;
use \PDOException;

/**
 * Classe responsável por realizar a conexão e operações com o banco de dados
 */
class Database
{
    /**
     * HOST de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'wishlist';

    /**
     * Usuário do banco de dados
     * @var string
     */
    const USER = 'etecia';

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = 'api@etec.com';

    /**
     * Nome da tabela que será manipulada
     * @var string
     */
    private $table;

    /**
     * Instância de conexão com o banco de dados
     * @var PDO
     */
    private $connection;
}
<?php

namespace App\Database;

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

    /**
     * Define a tabela que será utilizada e realiza a conexão
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por realizar a conexão com o banco de dados
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('OCORREU UM ERRO: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por executar as consultas ao banco de dados
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('OCORREU UM ERRO: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por insetir as informações no banco de dados
     * @param array $values
     * @return integer
     */
    public function insert($values)
    {
        $fields = array_keys(($values));

        // DEFINE AS POSIÇÕES / COLUNAS DA TABELA
        $binds = array_pad([], count($fields), '?');

        // MONTA A QUERY
        $query = 'INSERT INTO ' . $this->table . '(' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        // EXECUTA O INSERT
        $this->execute($query, array_values($values));

        // RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // DADOS DA QUERY
        $where = strlen($where ?? '') ? 'WHERE ' . $where : '';
        $order = strlen($order ?? '') ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit ?? '') ? 'LIMIT ' . $limit : '';

        // MONTA A QUERY
        $query = 'SELECT' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        // EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Método responsável por atualizar o registro no banco de dados
     * @param string $where
     * @param array $values [ field => values ]
     * @return boolean
     */
    public function update($where, $values)
    {
        // DADOS DA QUERY
        $fields = array_keys($values);

        // MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        // EXECUTA A QUERY
        $this->execute($query, array_values($values));

        return true;
    }

    /**
     * Método responsável por excluir dados no banco
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        // MONTA A QUERY
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        // EXECUTA A QUERY
        $this->execute($query);

        // RETORNA SUCESSO
        return true;
    }
}

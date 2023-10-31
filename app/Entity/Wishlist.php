<?php

namespace App\Entity;

use App\Database\Database;
use \PDO;

class Wishlist
{
    /**
     * Número deregistro do pedido na lista
     * @var integer
     */
    public $id;

    /**
     * Nome do produto
     * @var string
     */
    public $produto;

    /**
     * Link do produto
     * @var string
     */
    public $link;

    /**
     * Valor do produto
     * @var integer
     */
    public $preco;

    /**
     * Categoria que pertence o produto
     * @var string
     */
    public $categoria;

    /**
     * Método responsável por realizar o cadastro do produto
     * no banco de dados
     * @return boolean
     */
    public function cadastrar()
    {
    }

    /**
     * Método responsável por realizar a atualização das informações
     * do produto no banco de dados
     *
     * @return boolean
     */
    public function atualizar()
    {
    }

    /**
     * Método responsável por excluir o produto do banco de dados
     *
     * @return boolean
     */
    public function excluir()
    {
    }
}

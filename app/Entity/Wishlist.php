<?php

namespace App\Entity;

use App\Database\Database;
use \PDO;

/**
 * Classe responsável por realizar as operações com o banco de dados
 * realizando as manipulações necessárias com os valores
 * @author LBorgess
 */
class Wishlist
{
    /**
     * Número do registro do pedido na lista
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
        $obDatabase = new Database('wishlist');

        $this->id = $obDatabase->insert([
            'produto'   => $this->produto,
            'link'      => $this->link,
            'preco'     => $this->preco,
            'categoria' => $this->categoria
        ]);

        return true;
    }

    /**
     * Método responsável por realizar a atualização das informações
     * do produto no banco de dados
     *
     * @return boolean
     */
    public function atualizar()
    {
        return (new Database('wishlist'))->update('id = ' . $this->id, [
            'produto'   => $this->produto,
            'link'      => $this->link,
            'preco'     => $this->preco,
            'categoria' => $this->categoria
        ]);
    }

    /**
     * Método responsável por excluir o produto do banco de dados
     *
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('wishlist'))->delete('id = ' . $this->id);
    }

    /**
     * Método responsável por obter todas os produtos do banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getProdutos($where = null, $order = null, $limit = null)
    {
        return (new Database('wishlist'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Método responsável por realizar a busca de uma lista com base em seu ID
     * @param integer $id
     * @return Wishlist
     */
    public static function getProduto($id)
    {
        return (new Database('wishlist'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }
}

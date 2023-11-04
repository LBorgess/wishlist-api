<?php

namespace App\API;

use App\Database\Database;
use App\Entity\Wishlist;

/**
 * Classe responsável por realizar as operações da API
 * @author LBorgess
 */
class API
{
    /**
     * Váriavel para controlar o response.
     * @var array
     */
    public $response = array();

    /**
     * Váriavel para avisar se está disponivel os parâmetros
     * @var boolean
     */
    public $available = true;

    /**
     * Váriavel para informar o erro.
     * @var string
     */
    public $missing = '';

    /**
     * Método responsável por verificar se todos os parâmetros estão
     * disponíveis
     * @param array $parameters
     * @return array
     */
    public function verify($parameters)
    {
        foreach ($parameters as $parameter) {
            if (!isset($_POST[$parameter]) || strlen($_POST[$parameter] <= 0)) {
                $available = false;
                $this->missing = $this->missing . ", " . $parameter;
            }
        }

        if (!$available) {
            $response['error'] = true;
            $response['message'] = "Parameters " . substr($this->missing, 1, strlen($this->missing)) . " missing";

            echo json_encode($response);

            die;
        }
    }

    /**
     * Método responsável por realizar a chamada de API
     * @param string $method
     * @return void
     */
    public function apicall($method)
    {
        switch ($_GET[$method]) {
            case 'post':
                self::post();
                break;
            case 'put':
                self::put();
                break;
            case 'delete':
                self::delete();
                break;
            case 'get':
                self::get();
                break;
            default:
                $response['error'] = true;
                $response['message'] = 'Chamada inválida.';
                break;
        }
    }

    /**
     * Método responsável por realizar a criação de um item na
     * lista de desejos
     * @return void
     */
    public function post()
    {
        self::verify(array('produto', 'link', 'preco', 'categoria'));

        $obWishlist = new Wishlist();

        $result = $obWishlist->cadastrar();

        if ($result) {
            $response['error'] = false;
            $response['message'] = 'Produto cadastrado com sucesso.';
            $response['wishlist'] = $obWishlist->getProdutos();
        } else {
            $response['error'] = true;
            $response['message'] = 'Ocorreu um erro durante a criação.';
        }
    }

    /**
     * Método responsável por realizar a atualização da lista de
     * desejos
     * @return void
     */
    public function put()
    {
        self::verify(array('produto', 'link', 'preco', 'categoria'));

        $obWishlist = new Wishlist();

        $result = $obWishlist->atualizar();

        if ($result) {
            $response['error'] = false;
            $response['message'] = 'Produto atualizado com sucesso.';
            $response['wishlist'] = $obWishlist->getProdutos();
        } else {
            $response['error'] = true;
            $response['message'] = 'Ocorreu um erro durante a atualização.';
        }
    }

    /**
     * Método responsável por realizar a exclusão de um produto
     * da lista de desejos
     * @return void
     */
    public function delete()
    {
        if (isset($_GET['id'])) {
            $obWishlist = new Wishlist();
            if ($obWishlist->excluir()) {
                $response['error'] = false;
                $response['message'] = 'Produto excluido com sucesso';
                $response['wishlist'] = $obWishlist->getProdutos();
            } else {
                $response['error'] = true;
                $response['message'] = 'Ocorreu algum erro durante a exclusão';
            }
        } else {
            $response['error'] = true;
            $response['message'] = 'Não foi possível excluir, forneça um ID.';
        }
    }

    /**
     * Método responsável por obter todos os itens da lista de
     * desejos.
     * @return void
     */
    public function get()
    {
        $obWishlist = new Wishlist();
        $response['error'] = false;
        $response['message'] = "Pedido executado com sucesso";
        $response['wishlist'] = $obWishlist->getProdutos();
    }
}

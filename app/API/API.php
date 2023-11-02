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

    public function apicall()
    {
    }
    public function post()
    {
    }
    public function put()
    {
    }
    public function delete()
    {
    }

    public function get()
    {
        $obWishlist = new Wishlist();
        $response['error'] = false;
        $response['message'] = "Pedido executado com sucesso";
        $response['wishlist'] = $obWishlist->getProdutos();
    }
}

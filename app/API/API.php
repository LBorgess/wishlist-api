<?php

namespace App\API;

use App\Database\Database;

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

    

}
<?php

namespace App\Controllers;

use App\Models\Dao\ProdutoDao;

class BaseController
{
    function index()
    {
        $produtos = (new ProdutoDao())->listarTodos();
        require_once 'Views/home/index.php';
    }
}
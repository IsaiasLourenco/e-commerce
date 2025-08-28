<?php

namespace App\Controllers;

use App\Models\Dao\CategoriaDao;
use App\Models\Dao\ProdutoDao;

class BaseController
{
    function index()
    {
        $produtos = (new ProdutoDao())->listarTodos();

        $categorias = (new CategoriaDao())->listarTodos();


        require_once 'Views/home/index.php';
    }

    public function listarProdutoPorCategoria()
    {
        $categorias = (new CategoriaDao())->listarTodos();

        $id = $_GET['id'] ?? null;
        $produtos = (new ProdutoDao())->obterPorCategoria($id);
        require_once 'Views/home/index.php';
    }
}

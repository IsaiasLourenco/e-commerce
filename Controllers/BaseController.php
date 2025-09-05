<?php

namespace App\Controllers;

use App\Models\Dao\CategoriaDao;
use App\Models\Dao\ProdutoDao;

class BaseController
{
    public function index()
    {
        $produtoDao = new ProdutoDao();
        $categoriaDao = new CategoriaDao();

        $paginaAtual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 12;
        $offset = ($paginaAtual - 1) * $limit;

        $produtos = $produtoDao->listarPaginadoNaHome($limit, $offset);
        $total = $produtoDao->contarTodosNaHome();
        $categorias = $categoriaDao->listarTodos();

        require_once __DIR__ . '/../Views/home/index.php';
    }

    public function listarProdutoPorCategoria()
    {
        $categoriaDao = new CategoriaDao();
        $produtoDao = new ProdutoDao();

        $id = $_GET['id'] ?? null;
        $produtos = $produtoDao->obterPorCategoria($id);
        $categorias = $categoriaDao->listarTodos();

        require_once __DIR__ . '/../Views/home/index.php';
    }
}

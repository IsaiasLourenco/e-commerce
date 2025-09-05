<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Models\Dao\CategoriaDao;
use App\Models\Dao\ProdutoDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\ProdutoService;

class ProdutoController extends Notifications
{
    private ProdutoDao $produtoDao;
    private CategoriaDao $categoriaDao;
    private FileUploadService $fileUploadService;
    private ProdutoService $produtoService;

    public function __construct()
    {
        $this->produtoDao = new ProdutoDao();
        $this->categoriaDao = new CategoriaDao();
        $this->fileUploadService = new FileUploadService("lib/img/upload");
        $this->produtoService = new ProdutoService($this->produtoDao);
        if (!isset($_SESSION)) session_start();
    }

    public function listar(): void
    {
        $produtos = $this->produtoDao->listarComCategoria();
        $controller = "produto";
        $metodo = "listar";
        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function index(): void
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $produto = $this->produtoDao->obterPorid($id);
        }

        if ($_POST) {
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->alterar($_POST, $_FILES);
            }
        }

        $produtos = $this->produtoDao->listarComCategoria();
        $categorias = $this->categoriaDao->listarTodos();
        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function inserir(array $dados, array $files): void
    {
        $dados['preco'] = str_replace(['R$', ',', ' '], ['', '.', ''], $dados['preco']);
        $dados['preco_custo'] = str_replace(['R$', ',', ' '], ['', '.', ''], $dados['preco_custo']);
        $imagem = $this->fileUploadService->upload($files['imagem']);
        $this->produtoService->adicionarProduto($dados, $imagem);
        echo $this->Success("Produto", "Cadastrado", "Listar");
    }

    public function alterar(array $dados, array $files): void
    {
        $dados['preco'] = str_replace(['R$', ',', ' '], ['', '.', ''], $dados['preco']);
        $dados['preco_custo'] = str_replace(['R$', ',', ' '], ['', '.', ''], $dados['preco_custo']);
        $imagem = $this->fileUploadService->upload($files['imagem']);
        $this->produtoService->alterarProduto($dados, $imagem);
        echo $this->Success("Produto", "Alterado", "Listar");
    }

    public function deleteConfirm(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->Confirm("Excluir", "Produto", "", $id);
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function excluir(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->produtoDao->excluir($id);
            echo $this->Success("Produto", "Excluido", "Listar");
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function alterarStatus(): void
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id) {
            $produto = new Produto();
            $produto->__set('id', $id);
            $produto->__set('status_produto', $ativo);
            $this->produtoDao->alterar($produto);
        }
    }
}

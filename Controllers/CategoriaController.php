<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Dao\CategoriaDao;
use App\Models\Notifications;
use App\Services\CategoriaService;

class CategoriaController extends Notifications
{
    private Categoria $categoria;
    private CategoriaDao $categoriaDao;
    private CategoriaService $categoriaService;

    public function __construct()
    {
        $this->categoria = new Categoria();
        $this->categoriaDao = new CategoriaDao();
        $this->categoriaService = new CategoriaService($this->categoriaDao);
    }

    public function index(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if ($id) {
            $categorias = $this->categoriaDao->obterPorid($id);
        }

        if ($_POST) {
            if (!empty($_POST['id'])) {
                $this->alterar($_POST);                
            } else {
                $this->inserir($_POST);
            }
        }

        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function listar(): void
    {
        $categorias = $this->categoriaDao->listarTodos();        
        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function inserir(array $dados): void
    {
        $retorno = $this->categoriaService->adicionarCategoria($dados);
        echo $this->Success("Categoria", "Cadastrado", "Listar");
    }

    public function alterar(array $dados): void
    {
        $retorno = $this->categoriaService->alterarCategoria($dados);
        echo $this->Success("Categoria", "Alterado", "Listar");
    }

    public function deleteConfirm(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        if ($id) {
            echo $this->confirm('Excluir', 'Categoria', '', $id);
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function excluir(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        if ($id) {
            $this->categoriaDao->excluir($id);
            echo $this->success('Categoria', 'Excluido', 'listar');
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function alterarStatus(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id) {
            $categoria = new Categoria($id, "", $ativo);
            $this->categoriaDao->alterar($categoria);
        }
    }
}

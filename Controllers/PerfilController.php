<?php

namespace App\Controllers;

use App\Models\Notifications;
use App\Models\Perfil;
use App\Models\Dao\PerfilDao;
use App\Services\PerfilService;

class PerfilController extends Notifications
{
    private Perfil $perfil;
    private PerfilDao $perfilDao;
    private PerfilService $perfilService;

    public function __construct()
    {
        $this->perfil = new Perfil();
        $this->perfilDao = new PerfilDao();
        $this->perfilService = new PerfilService($this->perfilDao);
    }

    public function index(): void
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $perfil = $this->perfilDao->obterPorid($id);
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
        $perfis = $this->perfilDao->listarTodos();
        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function inserir(array $dados): void
    {
        $this->perfilService->adicionarPerfil($dados);
        echo $this->Success("Perfil", "Cadastrado", "Listar");
    }

    public function alterar(array $dados): void
    {
        $this->perfilService->alterarPerfil($dados);
        echo $this->Success("Perfil", "Alterado", "Listar");
    }

    public function deleteConfirm(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->confirm('Excluir', 'Perfil', '', $id);
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function excluir(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->perfilDao->excluir($id);
            echo $this->success('Perfil', 'Excluido', 'listar');
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }
}

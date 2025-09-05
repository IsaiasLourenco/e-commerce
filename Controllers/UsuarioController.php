<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Dao\PerfilDao;
use App\Models\Dao\UsuarioDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\UserService;

class UsuarioController extends Notifications
{
    private UsuarioDao $usuarioDao;
    private PerfilDao $perfilDao;
    private FileUploadService $fileUploadService;
    private UserService $usuarioService;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
        $this->perfilDao = new PerfilDao();
        $this->fileUploadService = new FileUploadService("lib/img/users");
        $this->usuarioService = new UserService($this->usuarioDao);
        if (!isset($_SESSION)) session_start();
    }

    public function listar(): void
    {
        $usuarios = $this->usuarioDao->listarComPerfil();
        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function index(): void
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $usuario = $this->usuarioDao->obterPorid($id);
        }

        if ($_POST) {
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->alterar($_POST, $_FILES);
            }
        }

        $usuarios = $this->usuarioDao->listarComPerfil();
        $perfis = $this->perfilDao->listarTodos();
        require_once __DIR__ . '/../views/painel/index.php';
    }

    public function inserir(array $dados, array $files): void
    {
        $imagem = $this->fileUploadService->upload($files['imagem']);
        $this->usuarioService->adicionarUsuario($dados, $imagem);
        echo $this->Success("Usuario", "Cadastrado", "Listar");
    }

    public function alterar(array $dados, array $files): void
    {
        $imagem = $this->fileUploadService->upload($files['imagem']);
        $this->usuarioService->alterarUsuario($dados, $imagem);
        echo $this->Success("Usuario", "Alterado", "Listar");
    }

    public function deleteConfirm(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->Confirm("Excluir", "Usuario", "", $id);
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function excluir(): void
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->usuarioDao->excluir($id);
            echo $this->Success("Usuario", "Excluido", "Listar");
        }
        require_once __DIR__ . '/../views/shared/header.php';
    }

    public function alterarStatus(): void
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id) {
            $usuario = new Usuario();
            $usuario->__set('id', $id);
            $usuario->__set('ativo', $ativo);
            $this->usuarioDao->alterar($usuario);
        }
    }
}

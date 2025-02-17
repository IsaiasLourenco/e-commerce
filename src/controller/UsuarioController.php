<?php

namespace App\Controllers;

session_start();

use App\Models\Usuario;
use App\Models\PerfilDao;
use App\Models\UsuarioDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\UserService;

class UsuarioController extends Notifications
{
    private $usuarioDao;
    private $perfilDao;
    private $fileUploadService;
    private $userService;

    // Injeção de dependências para melhor testabilidade e organização
    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
        $this->perfilDao = new PerfilDao();
        $this->fileUploadService = new FileUploadService("lib/img/users-images");
        $this->userService = new UserService($this->usuarioDao, $this->fileUploadService);
    }

    // Função responsável por listar todos os usuários
    public function listar()
    {
        // Separação da responsabilidade de buscar os dados e exibir a view
        $usuarios = $this->usuarioDao->ListarTodos();
        require_once "views/painel/index.php";
    }

    // Função principal de gerenciamento de usuários (inserção, alteração e listagem)
    public function index()
    {
        /*
        Este operador de coelescencias verifica se a parte à esquerda está definida e não é null.
        Se $_GET['id'] estiver definida e não for null, o valor de $_GET['id'] será atribuído a $id.
         */
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Recupera dados para edição de usuário
            $usuario = $this->usuarioDao->obterPorId($id);
        }

        if ($_POST) {
            // Determina se será uma inserção ou alteração com base no ID
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->alterar($_POST, $_FILES);
            }
        }

        $usuarios = $this->usuarioDao->ListarTodos();
        $perfis = $this->perfilDao->listarTodos();
        require_once "views/painel/index.php";
    }

    // Função responsável por inserir um usuário
    public function inserir($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->userService->adicionarUsuario($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Usuario", "Cadastrado", "Listar");
    }

    // Função responsável por alterar os dados de um usuário
    public function alterar($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Atualiza o usuário via serviço dedicado
        $retorno = $this->userService->alterarUsuario($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Usuario", "Alterado", "Listar");
    }

    // Confirmação de exclusão de usuário
    public function deleteConfirm()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->Confirm("Excluir", "Usuario", "", $id);
        }
        require_once "views/shared/header.php";
    }

    // Função responsável por excluir um usuário
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->usuarioDao->deletar($id);
            echo $this->Success("Usuario", "Excluido", "Listar");
        }

        require_once "views/shared/header.php";
    }

    // FUNÇÃO RESPONSAVEL POR VALIDAR OS DADOS DO USUÁRIO
    public function login()
    {
        require_once "views/usuario/login.php";
        // Incluindo a view inicial da página de login

        // Verificando se o formulário foi enviado com o operador de coalescencia
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Validando entrada de dados básica
            if (empty($usuario) || empty($senha)) :
                echo $this->loginError("Usuário ou senha não podem estar vazios.");
                return;
            endif;
            // Instanciando o DAO para autenticação
            $usuario = $this->usuarioDao->autenticarUsuario($usuario);

            // Validando resultado da autenticação
            if (!empty($usuario) && password_verify($senha, $usuario[0]->SENHA)) :
                $this->iniciarSessao($usuario[0]);
                header("Location: index.php?controller=PainelController&metodo=index");
                exit;
            else :
                echo $this->loginError("Usuário ou senha incorretos.");
            endif;
            
        }
    }
    // FUNÇÃO RESPONSAVEL POR CRIAR A SESSÃO DE USUARIO
    private function iniciarSessao($usuario)
    {
        $_SESSION['permissao'] = -1;
        $_SESSION['id'] = $usuario->ID;
        $_SESSION['nome'] = $usuario->NOME;
        $_SESSION['imagem'] = $usuario->IMAGEM;
    }

    // Função responsável por encerrar a sessão de login
    public function sair()
    {
        $_SESSION = [];
        session_destroy();
        header("location:index.php");
    }
}

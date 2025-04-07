<?php

namespace App\Controllers;

session_start();

use App\Models\Cliente;
use App\Models\Dao\PerfilDao;
use App\Models\Dao\ClienteDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\ClienteService;

class UsuarioController extends Notifications
{
    private $clienteDao;
    private $perfilDao;
    private $fileUploadService;
    private $clienteService;

    // Injeção de dependências para melhor testabilidade e organização
    public function __construct()
    {
        $this->clienteDao = new clienteDao();
        $this->perfilDao = new PerfilDao();
        $this->fileUploadService = new FileUploadService("lib/img/users");
        $this->clienteService = new ClienteService($this->clienteDao);
    }

    // Função responsável por listar todos os usuários
    public function listar()
    {
        // Separação da responsabilidade de buscar os dados e exibir a view
        $clientes = (new ClienteDao())->ListarTodos();
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
            $cliente = $this->clienteDao->obterPorId($id);
        }

        if ($_POST) {
            // Determina se será uma inserção ou alteração com base no ID
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->alterar($_POST, $_FILES);
            }
        }

        $clientes = $this->clienteDao->ListarTodos();
        $perfis = $this->perfilDao->listarTodos();
        require_once "views/painel/index.php";
    }

    // Função responsável por inserir um usuário
    public function inserir($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->clienteService->adicionarCliente($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Usuario", "Cadastrado", "Listar");
    }

    // Função responsável por alterar os dados de um usuário
    public function alterar($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Atualiza o usuário via serviço dedicado
        $retorno = $this->clienteService->alterarCliente($dados, $imagem);

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
    public function excluir()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->clienteDao->excluir($id);
            echo $this->Success("Usuario", "Excluido", "Listar");
        }

        require_once "views/shared/header.php";
    }
    public function alterarStatus()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id):
            $cliente = new  Cliente($id, "","","","","","","","","","","","","",$ativo,"");
            $this->clienteDao->alterar($cliente);
        #$this->success("Imovel", "Atualizado", "listar");
        endif;
    }
   
}

<?php

namespace App\Controllers;
use App\Models\Notifications;
use App\Models\Perfil;
use App\Models\Dao\PerfilDao;
use App\Services\PerfilService;


class PerfilController extends Notifications
{
    private $perfil;
    private $perfilDao;
    private $perfilService;

    public function __construct()
    {
        $this->perfil = new Perfil();
        $this->perfilDao = new PerfilDao();
        $this->perfilService = new PerfilService($this->perfilDao);
    }
    // METODO RESPONSAVEL POR VALIDAR OS DADOS E ENVIAR PARA SEU METODO RESPONSAVEL
    public function index()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Recupera dados para edição de usuário
            $perfil = $this->perfilDao->obterPorId($id);
        }

        if ($_POST) {
            // Determina se será uma inserção ou alteração com base no ID
            if (!empty($_POST['id'])) {
                $this->alterar($_POST);
            } else {
                $this->inserir($_POST);               
            }
        }

        require_once "views/painel/index.php";
    }

    public function listar()
    {
        $perfis = $this->perfilDao->listarTodos();
        require_once "Views/painel/index.php";
    }
    // metodo responsavel por inserir registros no banco de dados
    public function inserir($dados)
    {
        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->perfilService->adicionarPerfil($dados);

        // Exibe mensagem de sucesso
        echo $this->Success("Perfil", "Cadastrado", "Listar");
    }
    // metodo responsavel por atualizar registros no banco de dados
    public function alterar($dados)
    {
 // Atualiza o usuário via serviço dedicado
        $retorno = $this->perfilService->alterarPerfil($dados);

        // Exibe mensagem de sucesso
        echo $this->Success("Perfil", "Alterado", "Listar");
    }

    function deleteConfirm()
    {
        $id = $_GET['id'] ?? null;
        if ($id):
            echo $this->confirm('Excluir', 'Perfil', '', $id);
        endif;
        require_once "Views/shared/header.php";
    }
// metodo responsavel por excluir um objeto no banco de dados
    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id):            //  $ret = $this->proprietarioDao->excluir($id);
            $this->perfilDao->excluir($id);
            echo $this->success('Perfil', 'Excluido', 'listar');
        endif;

        require_once "Views/shared/header.php";
    }
}

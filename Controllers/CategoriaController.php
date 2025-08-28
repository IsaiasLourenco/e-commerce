<?php

namespace App\Controllers;
use App\Models\Categoria;
use App\Models\Dao\CategoriaDao;
use App\Models\Notifications;
use App\Services\CategoriaService;

class CategoriaController extends Notifications
{
    private $categoria;
    private $categoriaDao;
    private $categoriaService;

    public function __construct(){
        $this->categoria = new Categoria();
        $this->categoriaDao = new CategoriaDao();
        $this->categoriaService = new CategoriaService($this->categoriaDao);
    }
    // METODO RESPONSAVEL POR VALIDAR OS DADOS E ENVIAR PARA SEU METODO RESPONSAVEL
    public function index()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            // Recupera dados para edição de usuário
            $categorias = $this->categoriaDao->obterPorId($id);
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

    public function listar(){
        $categorias = $this->categoriaDao->listarTodos();        
        require_once "Views/painel/index.php";
    }
// metodo responsavel por inserir registros no banco de dados
    public function inserir($dados){
        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->categoriaService->adicionarCategoria($dados);

        // Exibe mensagem de sucesso
        echo $this->Success("Categoria", "Cadastrado", "Listar");
    }
// metodo responsavel por atualizar registros no banco de dados
    public function alterar($dados){
        // Atualiza o usuário via serviço dedicado
        $retorno = $this->categoriaService->alterarCategoria($dados);
        // Exibe mensagem de sucesso
        echo $this->Success("Categoria", "Alterado", "Listar");
    }

    function deleteConfirm()
    {
        $id = $_GET['id'] ?? null;
        if ($id):
            echo $this->confirm('Excluir', 'Categoria', '', $id);
        endif;
        require_once "Views/shared/header.php";
    }
// metodo responsavel por excluir um objeto no banco de dados
    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id):            //  $ret = $this->proprietarioDao->excluir($id);
            $this->categoriaDao->excluir($id);
            echo $this->success('Categoria', 'Excluido', 'listar');
        endif;

        require_once "Views/shared/header.php";
    }

    public function alterarStatus()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id):
            $categoria = new Categoria($id, "",$ativo);
            $this->categoriaDao->alterar($categoria);
        #$this->success("Imovel", "Atualizado", "listar");
        endif;
    }



}

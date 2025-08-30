<?php

namespace App\Controllers;

session_start();

use App\Models\Produto;
use App\Models\Dao\CategoriaDao;
use App\Models\Dao\ProdutoDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\ProdutoService;

class ProdutoController extends Notifications
{
    private $produtoDao;
    private $categoriaDao;
    private $fileUploadService;
    private $produtoService;

    // Injeção de dependências para melhor testabilidade e organização
    public function __construct()
    {
        $this->produtoDao = new ProdutoDao();
        $this->categoriaDao = new CategoriaDao();
        $this->fileUploadService = new FileUploadService("lib/img/upload");
        $this->produtoService = new ProdutoService($this->produtoDao);
    }

    // Função responsável por listar todos os usuários
    public function listar()
    {
        // Separação da responsabilidade de buscar os dados e exibir a view
        // $produtos = (new ProdutoDao())->listarComCategoria();
        // require_once "views/painel/index.php";
        $produtos = $this->produtoDao->listarComCategoria();
        $controller = "produto";
        $metodo = "listar";
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
            $produto = $this->produtoDao->obterPorid($id);
        }

        if ($_POST) {
            // Determina se será uma inserção ou alteração com base no id
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->alterar($_POST, $_FILES);
            }
        }

        $produtos = $this->produtoDao->listarComCategoria();
        $categorias = $this->categoriaDao->listarTodos();
        require_once "views/painel/index.php";
    }

    // Função responsável por inserir um usuário
    public function inserir($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->produtoService->adicionarProduto($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Produto", "Cadastrado", "Listar");
    }

    // Função responsável por alterar os dados de um usuário
    public function alterar($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Atualiza o usuário via serviço dedicado
        $retorno = $this->produtoService->alterarProduto($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Produto", "Alterado", "Listar");
    }

    // Confirmação de exclusão de usuário
    public function deleteConfirm()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            echo $this->Confirm("Excluir", "Produto", "", $id);
        }
        require_once "views/shared/header.php";
    }

    // Função responsável por excluir um usuário
    public function excluir()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->produtoDao->excluir($id);
            echo $this->Success("Produto", "Excluido", "Listar");
        }

        require_once "views/shared/header.php";
    }

    public function alterarStatus()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id):
            $produto = new Produto();
            $produto->__set('id', $id);
            $produto->__set('status_produto', $ativo);
            $this->produtoDao->alterar($produto);
        endif;
    }
}

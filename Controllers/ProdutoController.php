<?php

namespace App\Controllers;

use App\Models\Dao\CategoriaDao;
use App\Models\Notifications;
use App\Models\Produto;
use App\Models\Dao\ProdutoDao;
use App\Services\FileUploadService;
use App\Services\ProdutoService;


class ProdutoController extends Notifications
{
    private $produto;
    private $produtoDao;
    private $categoriaDao;
    private $produtoService;
    private $fileUploadService;

    public function __construct()
    {
        $this->produto = new Produto();
        $this->produtoDao = new ProdutoDao();
        $this->categoriaDao = new CategoriaDao();
        $this->categoriaDao = new CategoriaDao();
        $this->produtoService = new ProdutoService($this->produtoDao);
        $this->fileUploadService = new FileUploadService('lib/img/upload/produtos');
    }

    public function index()
    {
        $categorias = $this->categoriaDao->listarTodos();

        $id = $_GET['id'] ?? null;

        if ($id) {
            // Recupera dados para edição de usuário
            $produtos = $this->produtoDao->obterPorid($id);
        }

        if ($_POST) {
            // Determina se será uma inserção ou alteração com base no id
            if (empty($_POST['id'])) {
                $this->inserir($_POST, $_FILES);
            } else {
                $this->alterar($_POST,$_FILES);
            }
        }

        require_once "views/painel/index.php";
    }

    public function listar()
    {
        $produtos = $this->produtoDao->listarTodos();
        require_once "Views/painel/index.php";
    }

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
        $picture = '';
        // Utiliza o serviço de upload para lidar com a imagem
        if(!is_null($files)):
            $picture = $files['imagem'];
        endif;
        
        $imagem = $this->fileUploadService->upload($picture);

        // Atualiza o usuário via serviço dedicado
        $retorno = $this->produtoService->alterarProduto($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Produto", "Alterado", "Listar");
    }
// metodo responsavel por avisar o usuario da exclusão
    function deleteConfirm()
    {
        $id = $_GET['id'] ?? null;
        if ($id):
            echo $this->confirm('Excluir', 'Produto', '', $id);
        endif;
        require_once "Views/shared/header.php";
    }
// metodo responsavel por excluir um objeto no banco de dados
    function excluir()
    {
        $id = $_GET['id'] ?? null;
        if ($id):            //  $ret = $this->proprietarioDao->excluir($id);
            $this->produtoDao->excluir($id);
            echo $this->success('Produto', 'Excluido', 'listar');
        endif;

        require_once "Views/shared/header.php";
    }

    public function alterarStatus()
    {
        $id = $_GET['id'] ?? null;
        $ativo = $_GET['ativo'] ?? null;

        if ($id):
            $produto = new Produto($id, "","","","","","","","","",$ativo,"");
            $this->produtoDao->alterar($produto);
        #$this->success("Imovel", "Atualizado", "listar");
        endif;
    }

}

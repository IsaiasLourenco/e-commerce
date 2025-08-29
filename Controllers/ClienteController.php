<?php

namespace App\Controllers;

use App\Configurations\Formater;

session_start();

use App\Models\Cliente;
use App\Models\Dao\ClienteDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\ClienteService;

class ClienteController extends Notifications
{
  private $clienteDao;
  private $fileUploadService;
  private $clienteService;

  // Injeção de dependências para melhor testabilidade e organização
  public function __construct()
  {
    $this->clienteDao = new ClienteDao();
    $this->fileUploadService = new FileUploadService("lib/img/clientes");
    $this->clienteService = new ClienteService($this->clienteDao);
  }

  // Função responsável por listar todos os usuários
  public function listar()
  {
    // Separação da responsabilidade de buscar os dados e exibir a view
    $clientes = $this->clienteDao->ListarTodos();
    require_once "Views/painel/index.php";
  }

  // Função principal de gerenciamento de usuários (inserção, alteração e listagem)
  public function index()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      // Recupera dados para edição de usuário
      $usuario = $this->clienteDao->obterPorid($id);
    }

    if ($_POST) {
      // Determina se será uma inserção ou alteração com base no id
      if (!empty($_POST['id'])) {
        $this->alterar($_POST, $_FILES);
      } else {
        $this->inserir($_POST, $_FILES);
      }
    }
    require_once "views/cliente/index.php";
  }

  // Função responsável por inserir um usuário
  public function inserir($dados, $files)
  {
    // Utiliza o serviço de upload para lidar com a imagem
    $imagem = $this->fileUploadService->upload($files['imagem']);

    // Valida e cria o usuário via serviço dedicado
    $retorno = $this->clienteService->adicionarCliente($dados, $imagem);

    // Exibe mensagem de sucesso
    echo $this->Success("Cliente", "Cadastrado", "index");
  }

  // Função responsável por alterar os dados de um usuário
  public function alterar($dados, $files)
  {
    // Utiliza o serviço de upload para lidar com a imagem
    $imagem = $this->fileUploadService->upload($files['imagem']);

    // Atualiza o usuário via serviço dedicado
    $retorno = $this->clienteService->alterarCliente($dados, $imagem);

    // Exibe mensagem de sucesso
    echo $this->Success("Cliente", "Alterado", "Listar");
  }

  // Confirmação de exclusão de usuário
  public function deleteConfirm()
  {
    $id = $_GET['id'] ?? null;
    if ($id) {
      echo $this->Confirm("Excluir", "Cliente", "", $id);
    }
    require_once "views/shared/header.php";
  }

  // Função responsável por excluir um usuário
  public function delete()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      $this->clienteDao->excluir($id);
      echo $this->Success("Cliente", "Excluido", "Listar");
    }

    require_once "views/shared/header.php";
  }
  public function autenticar()
  {

    require_once "Views/cliente/autenticar.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST'):

      $cliente = $_POST['cliente'] ?? '';
      $senha = $_POST['senha'] ?? '';

      $dadosCliente = $this->clienteDao->autenticar($cliente);

      if (!empty($dadosCliente) && password_verify($senha, $dadosCliente[0]->SENHA)):
        $this->gerarSessao($dadosCliente);
        if ($dadosCliente[0]->PERFIL === '1'):
          header("location:index.php?controller=PainelController&metodo=index");
        else:
          header("location:index.php");
        endif;
        exit;
      else :
        echo $this->loginError('Usuario ou senha incorreto!');
      endif;

    endif;
  }

  private function gerarSessao($cliente)
  {
    $_SESSION['cliente'] = true;
    $_SESSION['idcliente'] = $cliente[0]->id;
    $_SESSION['nome'] = $cliente[0]->NOME;
    $_SESSION['email'] = $cliente[0]->EMAIL;
    $_SESSION['imagem'] = $cliente[0]->IMAGEM;
    $_SESSION['ultimo_acesso'] = time();
  }

  private function verificarSessaoInativa()
  {
    $tempoLimite = 600;

    if (isset($_SESSION['ultimo_acesso'])) {
      $tempoInativo = time() - $_SESSION['ultimo_acesso'];

      if ($tempoInativo > $tempoLimite) {
        $this->logout();
        exit;
      }
    }

    $_SESSION['ultimo_acesso'] = time(); // Atualizar o tempo de acesso
  }

  public function logout()
  {
    session_destroy();
    header("location:index.php");
    exit;
  }

  public function validarDadosCliente()
  {

    header("Content-Type: application/json; charset=UTF-8");
    $dados = json_decode(file_get_contents("php://input"), true);

    if (!isset($dados['campo']) || !isset($dados["valor"])):
      echo (json_encode(["erro" => "Dados Invalidos"]));
      exit;
    endif;

    $campo = trim($dados['campo']);
    $valor = trim($dados['valor']);

    $existe = $this->clienteDao->validarDados($campo, $valor);

    echo json_encode(["existe" => $existe ? true : false]);
    exit;
  }
}

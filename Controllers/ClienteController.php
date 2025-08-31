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
    $this->fileUploadService = new FileUploadService("lib/img/users");
    $this->clienteService = new ClienteService($this->clienteDao);
  }


  public function listar()
  {
    // Separação da responsabilidade de buscar os dados e exibir a view
    $clientes = $this->clienteDao->ListarTodos();
    require_once "Views/painel/index.php";
  }

  public function index()
  {
    $id = $_GET['id'] ?? null;

    if ($id) {
      $cliente = $this->clienteDao->obterPorid($id);
    }

    if ($_POST) {
      $id = isset($_POST['id']) && $_POST['id'] !== '' ? intval($_POST['id']) : null;

      // Validação condicional: ignora o próprio ID se estiver editando
      if (
        $this->clienteDao->validarDados('email', $_POST['email'], $id) ||
        $this->clienteDao->validarDados('cpf', $_POST['cpf'], $id)
      ) {
        echo $this->Error("Cliente", "CPF ou e-mail já existem — VALIDAÇÃO", "index");
        return;
      }

      // Fluxo de cadastro ou edição
      if (!empty($id)) {
        $this->alterar($_POST, $_FILES);
      } else {
        $this->inserir($_POST, $_FILES);
      }
    }
    require_once "views/cliente/index.php";
  }

  public function inserir($dados, $files)
  {
    // Utiliza o serviço de upload para lidar com a imagem
    $imagem = $this->fileUploadService->upload($files['imagem']);

    $retorno = $this->clienteService->adicionarCliente($dados, $imagem);

    // Exibe mensagem de sucesso
    echo $this->Success("Cliente", "Cadastrado", "index");
  }

  public function alterar($dados, $files)
  {
    // Validação e hash da nova senha — ANTES de enviar para o service
    if (!empty($dados['senha_atual']) && !empty($dados['nova_senha'])) {
      $cliente = $this->clienteDao->obterPorid($dados['id']);
      if (!password_verify($dados['senha_atual'], $cliente[0]->senha)) {
        echo $this->Error("Cliente", "Senha atual incorreta", "index");
        return;
      }

      $dados['senha'] = password_hash($dados['nova_senha'], PASSWORD_DEFAULT);
    }

    // Preserva o valor atual de 'ativo'
    $clienteAtual = $this->clienteDao->obterPorid($dados['id']);
    $dados['ativo'] = $clienteAtual[0]->ativo;

    // Upload da imagem
    $imagem = $this->fileUploadService->upload($files['imagem']);

    // Envia os dados completos
    $retorno = $this->clienteService->alterarCliente($dados, $imagem);

    echo $this->Success("Cliente", "Alterado", "Listar");
  }

  public function deleteConfirm()
  {
    require_once "views/shared/header.php";

    $id = $_GET['id'] ?? null;

    if ($id) {
      echo $this->Confirm("Excluir", "Cliente", "", $id);
    } else {
      echo $this->Error("Cliente", "ID não informado", "listar");
    }
  }

  public function excluir()
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

      if (!empty($dadosCliente) && password_verify($senha, $dadosCliente[0]->senha)):
        $this->gerarSessao($dadosCliente);
        if ($dadosCliente[0]->perfil === '1'):
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

    if (!isset($dados['campo']) || !isset($dados["valor"])) {
      echo json_encode(["erro" => "Dados inválidos"]);
      exit;
    }

    $campo = trim($dados['campo']);
    $valor = trim($dados['valor']);
    $id = isset($dados['id']) && $dados['id'] !== '' ? intval($dados['id']) : null;

    $existe = $this->clienteDao->validarDados($campo, $valor, $id);

    echo json_encode(["existe" => $existe]);
    exit;
  }

  public function alterarStatus()
  {
    $id = $_GET['id'] ?? null;
    $ativo = $_GET['ativo'] ?? null;

    if ($id):
      $cliente = new Cliente();
      $cliente->__set('id', $id);
      $cliente->__set('ativo', $ativo);
      $this->clienteDao->alterar($cliente);
    endif;
  }

  public function validarSenhaAtual()
  {
    header("Content-Type: application/json; charset=UTF-8");

    $dados = json_decode(file_get_contents("php://input"), true);
    $id = $dados['id'] ?? null;
    $senha = $dados['senha'] ?? '';

    if (!$id || !$senha) {
      echo json_encode(["valida" => false]);
      return;
    }

    $cliente = $this->clienteDao->obterPorid($id);
    $valida = password_verify($senha, $cliente[0]->senha);

    echo json_encode(["valida" => $valida]);
  }
}

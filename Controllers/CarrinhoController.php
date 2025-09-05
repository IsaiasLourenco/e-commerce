<?php

namespace App\Controllers;

use App\Models\Dao\ProdutoDao;
use App\Models\PagamentoMercadoPago;

class CarrinhoController
{
    public function inserirProdutoCarrinho(): void
    {
        if (!isset($_GET['id']) || $_GET['id'] == 0) {
            require_once __DIR__ . '/../views/venda/carrinho-compras.php';
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $idProduto = (int) ($_GET['id'] ?? 0);
        $produto = (new ProdutoDao())->obterPorid($idProduto);

        if (!$produto) {
            return;
        }

        if (!isset($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = [];
        }

        $indiceProduto = array_search($idProduto, array_column($_SESSION["carrinho"], 'id'));

        if ($indiceProduto === false) {
            $_SESSION["carrinho"][] = [
                "id"        => $produto[0]->id,
                "nome"      => $produto[0]->nome,
                "preco"     => $produto[0]->preco,
                "desc"      => $produto[0]->desconto,
                "imagem"    => $produto[0]->imagem,
                "qtde"      => 1
            ];
        }

        $_SESSION['quantidade_carrinho'] = array_sum(array_column($_SESSION["carrinho"], 'qtde'));

        require_once __DIR__ . '/../views/venda/carrinho-compras.php';
        exit;
    }

    public function atualizarCarrinho(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['linha'])) {
            $linha = (int) $_GET['linha'];

            if (isset($_SESSION["carrinho"][$linha])) {
                $_SESSION['quantidade_carrinho'] -= $_SESSION["carrinho"][$linha]["qtde"];
                unset($_SESSION["carrinho"][$linha]);
                $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);

                if (empty($_SESSION["carrinho"])) {
                    $_SESSION['quantidade_carrinho'] = 0;
                }
                header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
            }
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['linha'], $_POST['quantidade'])) {
            $linha = (int) $_POST['linha'];
            $qtde = max(1, (int) $_POST['quantidade']);

            if (isset($_SESSION["carrinho"][$linha])) {
                $_SESSION["carrinho"][$linha]["qtde"] = $qtde;
            }

            $_SESSION['quantidade_carrinho'] = array_sum(array_column($_SESSION["carrinho"], 'qtde'));
            echo json_encode(["status" => "success"]);
            exit;
        }
    }

    public function finalizarCarrinho(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['carrinho'])) {
            header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
            exit;
        }

        $email = $_SESSION['email'] ?? null;
        $cliente = $_SESSION['idcliente'] ?? null;

        if (!$cliente) {
            header("location:index.php?controller=ClienteController&metodo=autenticar");
            exit;
        }

        $total = 0.0;
        foreach ($_SESSION['carrinho'] as $item) {
            $subTotal = $item['preco'] * $item['qtde'];
            $desconto = ($item['preco'] * $item['desc']) / 100;
            $subTotal -= $desconto;
            $total += $subTotal;
        }

        // Agora o PagamentoMercadoPago já lê direto do .env
        $pagamento = new PagamentoMercadoPago();
        $linkPagamento = $pagamento->criarPagamento($_SESSION['carrinho'], $email);

        header("location: $linkPagamento");
        exit;
    }
}

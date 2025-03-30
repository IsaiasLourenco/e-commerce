<?php

namespace App\Controllers;

use App\Models\Dao\ProdutoDao;
use App\Models\PagamentoMercadoPago;

class CarrinhoController
{
    public function inserirProdutoCarrinho()
    {

        if (!isset($_GET['id']) || $_GET['id'] == 0) {
            require_once "Views/venda/carrinho-compras.php";
        }

        if (!isset($_SESSION)):
            session_start();
        endif;

        $idProduto = $_GET['id'];
        $produto = (new ProdutoDao())->obterPorId($idProduto);

        if (!$produto) {
            return;
        }

        // Inicializa o carrinho se não existir
        if (!isset($_SESSION["carrinho"])) {
            $_SESSION["carrinho"] = [];
        }

        // Verifica se o produto já está no carrinho
        $indiceProduto = array_search($idProduto, array_column($_SESSION["carrinho"], 'id'));

        if ($indiceProduto === false) :
            // Adiciona um novo produto ao carrinho
            $_SESSION["carrinho"][] = [
                "id"        => $produto[0]->ID,
                "nome"      => $produto[0]->NOME,
                "preco"     => $produto[0]->PRECO,
                "desc"      => $produto[0]->DESCONTO,
                "imagem"    => $produto[0]->IMAGEM,
                "qtde"      => 1
            ];
        endif;

        // Atualiza a quantidade total de itens no carrinho
        $_SESSION['quantidade_carrinho'] = array_sum(array_column($_SESSION["carrinho"], 'qtde'));

        // header("Location: index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho");
        require_once "Views/venda/carrinho-compras.php";
        exit;
    }

    public function atualizarCarrinho()
    {

        if (!isset($_SESSION)):
            session_start();
        endif;


        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['linha'])):
            $linha = $_GET['linha'];

            if (isset($_SESSION["carrinho"][$linha])):
                // Atualiza a quantidade total e remove o item do carrinho
                $_SESSION['quantidade_carrinho'] -= $_SESSION["carrinho"][$linha]["qtde"];
                unset($_SESSION["carrinho"][$linha]);

                // Reindexa o array para evitar buracos nos índices
                $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);

                if (empty($_SESSION["carrinho"])) :
                    $_SESSION['quantidade_carrinho'] = 0;
                endif;
                header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
            endif;
            exit;
        endif;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['linha'], $_POST['quantidade'])) {
            $linha = (int) $_POST['linha']; // Converte para inteiro
            $qtde = max(1, (int) $_POST['quantidade']); // Garante que a quantidade seja pelo menos 1

            if (isset($_SESSION["carrinho"][$linha])) {
                $_SESSION["carrinho"][$linha]["qtde"] = $qtde;
            }

            // Atualiza a quantidade total de itens no carrinho
            $_SESSION['quantidade_carrinho'] = array_sum(array_column($_SESSION["carrinho"], 'qtde'));

            echo json_encode(["status" => "success"]); // Retorna uma resposta JSON válida
            exit;
        }
    }

    public function finalizarCarrinho()
    {

        if (!isset($_SESSION)):
            session_start();
        endif;

        if (empty($_SESSION['carrinho'])):
            header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
        endif;
        
        $email = $_SESSION['email'] ?? null;
        $cliente = $_SESSION['idcliente'] ?? null;
        if(!$cliente):
            header("location:index.php?controller=ClienteController&metodo=autenticar");
        endif;

        $total = 0.00;
        foreach($_SESSION['carrinho'] as $item):
            $subTotal = $item['preco'] * $item['qtde'];
            $desconto = ($item['preco'] * $item['desc']) / 100;
            $subTotal -= $desconto;
            $total += $subTotal;
        endforeach;

       $pagamento = new PagamentoMercadoPago("TEST-eaf65f0e-21ff-4a44-8140-a87013777f32","TEST-2850965892227914-032301-bce4718671a828a5cff6a829d3bf3584-97829515");
       $linkPagamento = $pagamento->criarPagamento($_SESSION['carrinho'], $email);

       header("location: $linkPagamento");
       exit;
    }
}

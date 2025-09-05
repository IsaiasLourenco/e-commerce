<?php

namespace App\Controllers;

use App\Models\Notifications;
use App\Services\VendaService;
use FFI\Exception;

class VendaController extends Notifications
{
    private VendaService $vendaService;

    public function __construct()
    {
        if (!isset($_SESSION)) session_start();
        $this->vendaService = new VendaService();
    }

    public function sucesso(): void
    {
        if (!isset($_GET['status']) || $_GET['status'] !== 'approved') return;

        if (empty($_SESSION['carrinho'])) {
            header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
            exit;
        }

        $cliente = $_SESSION['idcliente'] ?? null;
        if (!$cliente) {
            header("location:index.php?controller=ClienteController&metodo=autenticar");
            exit;
        }

        $itensVenda = [];
        $total = 0.0;

        foreach ($_SESSION['carrinho'] as $item) {
            $subTotal = $item['preco'] * $item['qtde'];
            $desconto = round(($item['preco'] * $item['desc']) / 100, 2);
            $subTotal = round($subTotal - $desconto, 2);
            $total = round($total + $subTotal, 2);

            $itensVenda[] = [
                'produto' => $item['id'],
                'quantidade' => $item['qtde'],
                'valorunitario' => $item['preco']
            ];
        }

        $dadosVenda = [
            "valor" => $total,
            "cliente" => $cliente,
            "status" => "APROVADO",
            "itensvenda" => $itensVenda
        ];

        try {
            $this->vendaService->inserirVenda($dadosVenda);
            unset($_SESSION['carrinho']);
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir Venda: " . $e->getMessage());
        }

        echo $this->defaultMessage("Pagamento realizado com sucesso!", "", "Base", "index");
    }

    public function pendente(): void
    {
        if (empty($_SESSION['carrinho'])) {
            header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
            exit;
        }

        $cliente = $_SESSION['idcliente'] ?? null;
        if (!$cliente) {
            header("location:index.php?controller=ClienteController&metodo=autenticar");
            exit;
        }

        $itensVenda = [];
        $total = 0.0;

        foreach ($_SESSION['carrinho'] as $item) {
            $subTotal = $item['preco'] * $item['qtde'];
            $desconto = round(($item['preco'] * $item['desc']) / 100, 2);
            $subTotal = round($subTotal - $desconto, 2);
            $total = round($total + $subTotal, 2);

            $itensVenda[] = [
                'produto' => $item['id'],
                'quantidade' => $item['qtde'],
                'valorunitario' => $item['preco']
            ];
        }

        $dadosVenda = [
            "valor" => $total,
            "cliente" => $cliente,
            "status" => "PENDENTE",
            "itensvenda" => $itensVenda
        ];

        try {
            $this->vendaService->inserirVenda($dadosVenda);
            unset($_SESSION['carrinho']);
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir Venda pendente: " . $e->getMessage());
        }

        echo $this->defaultMessage("Pagamento pendente!", "Aguardando confirmação", "Base", "index");
    }

// Compatível com Notifications
public function Error($obj, $mensagem = '', $metodo = '')
{
    echo $this->defaultMessage("Erro ao realizar pagamento!", "Tente novamente", "Base", "index");
}

}

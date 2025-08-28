<?php

namespace App\Controllers;

use App\Models\Notifications;
use App\Services\VendaService;
use FFI\Exception;

class VendaController extends Notifications
{

    public function sucesso()
    {
        // $tipo_pagamento = $_GET['payment_type'];

        if ($_GET['status'] === 'approved'):

            if (!isset($_SESSION)):
                 session_start();
             endif;

             if (empty($_SESSION['carrinho'])):
                 header("location:index.php?controller=CarrinhoController&metodo=inserirProdutoCarrinho&id=0");
             endif;

             $cliente = $_SESSION['idcliente'];
             if (!$cliente):
                 header("location:index.php?controller=ClienteController&metodo=autenticar");
             endif;

            $itensVenda = [];
            $total = 0.00;
            foreach ($_SESSION['carrinho'] as $item):
                $subTotal = $item['preco'] * $item['qtde'];
                $desconto = round(($item['preco'] * $item['desc']) / 100, 2);
                $subTotal = round($subTotal - $desconto, 2);
                $total = round($total + $subTotal, 2);

                $itensVenda[] = [
                    'produto' => $item['id'],
                    'quantidade' => $item['qtde'],
                    'valorunitario' => $item['preco']
                ];
            endforeach;

            $dadosVenda = [
                "valor" => $total,
                "cliente" =>  $cliente,
                "status" => "APROVADO",
                "itensvenda" => $itensVenda
            ];

            $vendaService = new VendaService();

            try {

                $vendaService->inserirVenda($dadosVenda);
                unset($_SESSION['carrinho']);

            } catch (Exception $e) {
                throw new Exception("Erro ao inserir Venda: ". $e->getMessage());
            }
            echo $this->defaultMessage("Pagamento realizado com sucesso!", "", "Base", "index");
        endif;
    }

    public function error()
    {
        echo $this->defaultMessage("Erro ao realizar pagamento!", "Tente novamente", "Base", "index");
    }
}

/*
collection_id=1333811521
&collection_status=approved
&payment_id=1333811521
&status=approved
&external_reference=PEDIDO123
&payment_type=credit_card
&merchant_order_id=29877509947
&preference_id=97829515-7f2ab716-61e8-4ea4-9b10-d8ab70ffa9c1&site_id=MLB
&processing_mode=aggregator
&merchant_account_id=null
*/
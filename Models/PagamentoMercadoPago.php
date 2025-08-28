<?php

namespace App\Models;

use Exception;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use stdClass;

class PagamentoMercadoPago
{
    private string $accessToken;
    private string $publicKey;

    public function __construct(string $publicKey, string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->publicKey = $publicKey;
        // Certifique-se de que o SDK está configurado corretamente
        SDK::setAccessToken($this->accessToken);
        SDK::setPublicKey($this->publicKey);
    }

    public function criarPagamento(array $carrinho, string $emailCliente)
    {
        $preference = new Preference();

        $itens = [];
        $total = 0;

        foreach ($carrinho as $item) {
            $itemMP = new Item();
            $itemMP->title = $item['nome'];
            $itemMP->quantity = (int) $item['qtde'];
            $itemMP->unit_price = (float) $item['preco'];
            $itemMP->currency_id = "BRL";
            $itens[] = $itemMP;

            $total += $item['preco'] * $item['qtde'];
        }

        $preference->items = $itens;   

        $preference->payment_method = [
            "excluded_payment_methods" => [
                ["id" => "bolbradesco"]
            ],
            "excluded_payment_types" => [],
            "installments" => 12
        ];
        
        $payer = new stdClass();
        $payer->email = $emailCliente;
        $preference->payer =$payer;

        $preference->back_urls = [
            "success" => "localhost/git/e-compras/src/index.php?controller=VendaController&metodo=sucesso",
            "failure" => "localhost/git/e-compras/src/index.php?controller=VendaController&metodo=error"
        ];

        $preference->auto_return = "approved";
        $preference->external_reference = "PEDIDO123";
        $preference->sandbox_mode = true;

        try{
            $preference->save();
            return $preference->init_point;

        }catch(Exception $e){
            echo "Erro ao finalizar pagamento ". $e->getMessage();
            exit;
        }


        
       
    }
}

<?php

namespace App\Models;

use Exception;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class PagamentoMercadoPago
{
    private $accessToken;

    public function __construct($publicKey, $accessToken)
    {
        $this->accessToken = $accessToken;
        MercadoPagoConfig::setAccessToken($this->accessToken);
    }

    public function criarPagamento(array $carrinho, string $emailCliente)
    {
        $client = new PreferenceClient();

        $items = [];
        foreach ($carrinho as $item) {
            $items[] = [
                "title" => $item['nome'],
                "quantity" => (int) $item['qtde'],
                "unit_price" => (float) $item['preco'],
                "currency_id" => "BRL"
            ];
        }

        $preferenceData = [
            "items" => $items,
            "payer" => [
                "email" => $emailCliente
            ],
            "back_urls" => [
                "success" => "http://localhost/e-commerce/index.php?controller=VendaController&metodo=sucesso",
                "failure" => "http://localhost/e-commerce/index.php?controller=VendaController&metodo=error",
                "pending" => "http://localhost/e-commerce/index.php?controller=VendaController&metodo=pendente"
            ],
            "auto_return" => "approved",
            "external_reference" => "PEDidO123",
            "payment_methods" => [
                "excluded_payment_methods" => [
                    ["id" => "bolbradesco"]
                ],
                "installments" => 12
            ]
        ];

        try {
            $preference = $client->create($preferenceData);
            return $preference->sandbox_init_point;
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $body = $apiResponse ? $apiResponse->getContent() : 'sem conteúdo';

            echo "Erro ao finalizar pagamento:<br>";
            echo "<pre>" . print_r($body, true) . "</pre>";
            exit;
        }
    }
}

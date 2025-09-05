<?php

namespace App\Models;

use Exception;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use Dotenv\Dotenv;

class PagamentoMercadoPago
{
    private string $accessToken;
    private string $publicKey;

    public function __construct()
    {
        // Carrega .env
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
        $dotenv->safeLoad();

        $this->accessToken = $_ENV['MERCADOPAGO_ACCESS_TOKEN'] ?? '';
        $this->publicKey   = $_ENV['MERCADOPAGO_PUBLIC_KEY'] ?? '';

        if (empty($this->accessToken)) {
            throw new Exception("Access Token do Mercado Pago não configurado no .env");
        }

        // Configura SDK
        MercadoPagoConfig::setAccessToken($this->accessToken);
    }

    public function criarPagamento(array $carrinho, string $emailCliente): string
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
                "success" => $_ENV['MERCADOPAGO_SUCCESS_URL'],
                "failure" => $_ENV['MERCADOPAGO_FAILURE_URL'],
                "pending" => $_ENV['MERCADOPAGO_PENDING_URL']
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
            // Em produção você pode trocar por $preference->init_point
        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $body = $apiResponse ? $apiResponse->getContent() : 'sem conteúdo';

            throw new Exception("Erro ao finalizar pagamento: " . print_r($body, true));
        }
    }
}

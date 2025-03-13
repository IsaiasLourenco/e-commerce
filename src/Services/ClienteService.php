<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Dao\ClienteDao;

class ClienteService
{
    private $clienteDao;
    private $fileUploadService;

    public function __construct(ClienteDao $clienteDao)
    {
        $this->clienteDao = $clienteDao;
    }

    public function adicionarCliente($dados, $imagem)
    {
        $cliente = new Cliente();
        $dados['imagem'] = $imagem;

        foreach ($dados as $chave => $valor) {
            if ($chave === 'senha') {
                $valor = password_hash($valor, PASSWORD_BCRYPT);
            }
            $cliente->$chave = $valor;
        }

        return $this->clienteDao->Adicionar($cliente);
    }

    public function alterarCliente($dados, $imagem)
    {
        $cliente = new Cliente();
        $dados['imagem'] = $imagem;

        foreach ($dados as $chave => $valor) {
            $cliente->$chave = $valor;
        }
        return $this->clienteDao->Alterar($cliente);
    }
}
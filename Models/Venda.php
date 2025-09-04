<?php

namespace App\Models;

use DateTime;
use App\Models\ItensVenda;

class Venda
{
    private $id;
    private $data_venda;
    private $valor;
    private $cliente;
    private $status_venda;
    private $itens_venda = [];

public function __construct($id = '', 
                            $data_venda = '', 
                            $valor = 0.00, 
                            $cliente = '', 
                            $status_venda = 'Pendente')
{
    $this->id = $id;
    $this->data_venda = $data_venda ?: date('Y-m-d H:i:s');
    $this->valor = $valor;
    $this->cliente = $cliente;
    $this->status_venda = $status_venda;
}

    // Getters
    public function getid()
    {
        return $this->id;
    }

    public function getDatavenda()
    {
        return $this->data_venda;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getStatus()
    {
        return $this->status_venda;
    }

    public function getItens()
    {
        return $this->itens_venda;
    }
    // Setters
    public function setid($id)
    {
        $this->id = $id;
    }

    public function setDatavenda($data_venda)
    {
        $this->data_venda = $data_venda;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function setStatus($status_venda)
    {
        $this->status_venda = $status_venda;
    }

    // Adicionar itens à venda
    public function adicionarItem($itemVenda)
    {
        $this->itens_venda[] = $itemVenda;
    }

    // Converter para array
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "data_venda" => $this->data_venda,
            "valor" => $this->valor,
            "cliente" => $this->cliente,
            "status_venda" => $this->status_venda,
            "itensVenda" => array_map(fn($item) => $item->toArray(), $this->itens_venda)
        ];
    }

    // Verifica atributos preenchidos
    public function atributosPreenchidos(): array
    {
        return array_filter($this->toArray(), fn($value) => !empty($value));
    }
}

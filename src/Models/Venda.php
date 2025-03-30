<?php

namespace App\Models;

use DateTime;
use App\Models\ItensVenda;

class Venda
{
    private ?string $id;
    private string $datavenda;
    private float $valor;
    private string $cliente;
    private string $status;
    private array $itensVenda = [];

    public function __construct(
        ?string $id = '',
        float $valor = 0.00,
        string $cliente = '',
        string $status = 'Pendente'
    ) {
        date_default_timezone_set('America/Sao_Paulo');
        $this->id = $id;
        $this->datavenda =  date('Y-m-d H:i:s');
        $this->valor = $valor;
        $this->cliente = $cliente;
        $this->status = $status;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getDatavenda()
    {
        return $this->datavenda;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getItens(): array
    {
        return $this->itensVenda;
    }
    // Setters
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setDatavenda($datavenda): void
    {
        $this->datavenda = $datavenda;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    // Adicionar itens à venda
    public function adicionarItem($itemVenda): void
    {
        $this->itensVenda[] = $itemVenda;
    }

    // Converter para array
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "datavenda" => $this->datavenda,
            "valor" => $this->valor,
            "cliente" => $this->cliente,
            "status" => $this->status,
            "itensVenda" => array_map(fn($item) => $item->toArray(), $this->itensVenda)
        ];
    }

    // Verifica atributos preenchidos
    public function atributosPreenchidos(): array
    {
        return array_filter($this->toArray(), fn($value) => !empty($value));
    }
}

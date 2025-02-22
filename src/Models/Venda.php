<?php

namespace App\Models;

class Venda
{
    private string $id;
    private string $datavenda;
    private string $valor;
    private string $usuario;
    private string $precounitario;

    public function __construct($id = '', $datavenda = '', $valor = '', $usuario = '')
    {
        $this->id = $id;
        $this->datavenda = $datavenda;
        $this->valor = $valor;
        $this->usuario = $usuario;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }

    public function __set($chave, $valor)
    {
        if (property_exists($this, $chave)):
            $this->$chave = $valor;
        endif;
    }


    public function toArray()
    {
        return  [
            "id" => $this->id,
            "datavenda" => $this->datavenda,
            "valor" => $this->valor,
            "usuario" => $this->usuario
        ];
    }
    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}

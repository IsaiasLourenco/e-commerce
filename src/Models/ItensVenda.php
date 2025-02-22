<?php

namespace App\Models;

class ItensVenda
{
    private string $id;
    private string $venda;
    private string $produto;
    private string $quantidade;
    private string $precounitario;

    public function __construct($id = '', $venda = '', $produto = '', $qtde = '', $precoUni = ''){
      $this->id = $id;
      $this->venda = $venda;
      $this->produto = $produto;
      $this->quantidade = $qtde;
      $this->precounitario = $precoUni;
    }
     public function getId(){
        return $this->id;
     }
     public function setId($id){
        return $this->id = $id;
     }

     public function __set($chave, $valor)
    {
       if (property_exists($this, $chave)):
          $this->$chave = $valor;
       endif;
    }


     public function toArray(){
        return  [
             "id" => $this->id,
             "venda" => $this->venda,
             "produto" => $this->produto,
             "quantidade" => $this->quantidade,
             "precounitario" => $this->precounitario
        ];
     }
     public function atributosPreenchidos()
     {
         return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
     }
}

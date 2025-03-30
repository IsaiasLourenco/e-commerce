<?php

namespace App\Models;

class ItensVenda
{
   private ?string $id;
   private ?string $venda;
   private ?string $produto;
   private ?string $quantidade;
   private ?string $precounitario;
   private ?string $subTotal;

   public function __construct($id = '', $venda = '', $produto = '', $qtde = '', $precoUni = '', $subTotal = '')
   {
      $this->id = $id;
      $this->venda = $venda;
      $this->produto = $produto;
      $this->quantidade = $qtde;
      $this->precounitario = $precoUni;
      $this->subTotal = $subTotal;
   }
   public function getId()
   {
      $this->id;
   }
   public function getVenda()
   {
      $this->venda;
   }
   public function getProduto()
   {
      $this->produto;
   }
   public function getQtde()
   {
      $this->quantidade;
   }
   public function getPrecoUni()
   {
      $this->precounitario;
   }
   public function getSubTotal()
   {
      $this->subTotal;
   }
   public function setId($id)
   {
      $this->id = $id;
   }
   public function setVenda($venda)
   {
      $this->venda = $venda;
   }
   public function setProduto($produto)
   {
      $this->produto = $produto;
   }
   public function setQtde($qtde)
   {
      $this->quantidade = $qtde;
   }
   public function setPrecoUni($precoUni)
   {
      $this->precounitario = $precoUni;
   }

   public function setSubTotal($subTotal)
   {
      $this->subTotal = $subTotal;
   }

   //   public function __set($chave, $valor)
   //  {
   //     if (property_exists($this, $chave)):
   //        $this->$chave = $valor;
   //     endif;
   //  }


   public function toArray()
   {
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

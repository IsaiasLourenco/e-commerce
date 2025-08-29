<?php

namespace App\Models;

class Produto
{
   private string $id;
   private string $codigo;
   private string $data_cadastro;
   private string $nome;
   private string $descricao;
   private string $quantidade;
   private string $cor;
   private string $preco;
   private string $desconto;
   private ?string $imagem;
   private string $categoria;
   private string $status_produto;
   private string $preco_custo;

   public function __construct(
      $id = '',
      $codigo = '',
      $nome = '',
      $descricao = '',
      $quantidade = '',
      $cor = '',
      $preco = '',
      $desconto = '',
      $imagem = '',
      $categoria = '',
      $status_produto = '',
      $preco_custo = ''
   ) {
      date_default_timezone_set('America/Sao_Paulo');
      $this->id = $id;
      $this->codigo = $codigo;
      $this->nome = $nome;
      $this->descricao = $descricao;
      $this->quantidade = $quantidade;
      $this->cor = $cor;
      $this->preco = $preco;
      $this->desconto = $desconto;
      $this->imagem = $imagem;
      $this->categoria = $categoria;
      $this->status_produto = $status_produto ?: 'A';
      $this->preco_custo = $preco_custo;
      $this->data_cadastro = date('Y-m-d H:i:s');
   }
   public function getid()
   {
      return $this->id;
   }
   public function setid($id)
   {
      return $this->id = $id;
   }
   public function __set($chave, $valor)
   {
      if (property_exists($this, $chave)):
         $this->$chave = $valor ?: '';
      endif;
   }

   public function toArray()
   {
      return  [
         "id" => $this->id,
         "codigo" => $this->codigo,
         "nome" => $this->nome,
         "descricao" => $this->descricao,
         "quantidade" => $this->quantidade,
         "cor" => $this->cor,
         "preco" => $this->preco,
         "desconto" => $this->desconto,
         "imagem" => $this->imagem,
         "categoria" => $this->categoria,
         "status_produto" => $this->status_produto,
         "preco_custo" => $this->preco_custo,
         "data_cadastro" => $this->data_cadastro,
      ];
   }

   public function atributosPreenchidos()
   {
      return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
   }
}

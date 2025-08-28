<?php

namespace App\Models;

class Produto
{
   private string $id;
   private string $codigo;
   private string $datacadastro;
   private string $nome;
   private string $descricao;
   private string $quantidade;
   private string $cor;
   private string $preco;
   private string $desconto;
   private ?string $imagem;
   private string $categoria;
   private string $estatus;
   private string $precodecusto;

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
      $estatus = '',
      $precodecusto = ''
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
      $this->estatus = $estatus ?: 'A';
      $this->precodecusto = $precodecusto;
      $this->datacadastro = date('Y-m-d H:i:s');
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
         "estatus" => $this->estatus,
         "precodecusto" => $this->precodecusto,
         "datacadastro" => $this->datacadastro,
      ];
   }

   public function atributosPreenchidos()
   {
      return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
   }
}

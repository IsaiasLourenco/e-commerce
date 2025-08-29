<?php

namespace App\Models;

class Categoria
{
    private string $id;
    private string $descricao;
    private string $status_categoria;

    public function __construct($id = '', $descricao = '', $status_categoria = ''){
      $this->id = $id;
      $this->descricao = $descricao;
      $this->status_categoria = $status_categoria ?: 'A';
    }
     public function getid(){
        return $this->id;
     }
     public function setid($id){
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
             "descricao" => $this->descricao,
             "status_categoria" => $this->status_categoria
        ];
     }
     public function atributosPreenchidos()
     {
         return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
     }


}

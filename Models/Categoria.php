<?php

namespace App\Models;

class Categoria
{
    private string $id;
    private string $descricao;
    private string $estatus;

    public function __construct($id = '', $descricao = '', $estatus = ''){
      $this->id = $id;
      $this->descricao = $descricao;
      $this->estatus = $estatus ?: 'A';
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
             "descricao" => $this->descricao,
             "estatus" => $this->estatus
        ];
     }
     public function atributosPreenchidos()
     {
         return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
     }


}

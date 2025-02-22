<?php

namespace App\Models;

class Categoria
{
    private string $id;
    private string $descricao;
    private string $status;

    public function __construct($id = '', $descricao = ''){
      $this->id = $id;
      $this->descricao = $descricao;
      $this->status = 'A';
    }
     public function getId(){
        return $this->id;
     }
     public function setId($id){
        return $this->id = $id;
     }


     public function toArray(){
        return  [
             "id" => $this->id,
             "descricao" => $this->descricao,
             "status" => $this->status
        ];
     }
     public function atributosPreenchidos()
     {
         return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
     }


}

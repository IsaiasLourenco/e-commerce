<?php

namespace App\Models;

class Perfil
{
    private $id;
    private $descricao;
    
    function __construct($id = null, $descricao=null) {
        $this->id = $id;
        $this->descricao = $descricao;
    }
    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdperfil($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
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
            "descricao" => $this->descricao
       ];
    }
    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}

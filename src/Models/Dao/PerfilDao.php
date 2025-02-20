<?php

namespace App\Models\Dao;
use App\Models\Contexto;

class PerfilDao extends Contexto
{
    public function listarTodos(){
        return $this->listar('PERFIL');
    }
}
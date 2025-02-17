<?php

namespace App\Models;

class PerfilDao extends Contexto
{
    public function listarTodos(){
        return $this->listar('PERFIL');
    }
}
<?php

namespace App\Models\Dao;
use App\Models\Contexto;
use App\Models\Perfil;

class PerfilDao extends Contexto
{public function listarTodos()
    {
        return $this->listar('perfil');
    }
    public function obterPorid($id)
    {
        return $this->listar('perfil', "WHERE id = ?", [$id]);
    }

    public function adicionar(Perfil $perfil)
    {
        $atributos = array_keys($perfil->atributosPreenchidos());
        $valores = array_values($perfil->atributosPreenchidos());
        return $this->inserir('perfil', $atributos, $valores);
    }

    public function alterar(Perfil $perfil)
    {
        $atributos = array_keys($perfil->atributosPreenchidos());
        $valores = array_values($perfil->atributosPreenchidos());
        return $this->atualizar('perfil', $atributos, $valores, $perfil->getid());
    }
    public function excluir($id)    
    {
       return $this->deletar('perfil', $id);
    }
}
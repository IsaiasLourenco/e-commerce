<?php

namespace App\Models\Dao;
use App\Models\Contexto;
use App\Models\Perfil;

class PerfilDao extends Contexto
{public function listarTodos()
    {
        return $this->listar('PERFIL');
    }
    public function obterPorId($id)
    {
        return $this->listar('PERFIL', "WHERE ID = ?", [$id]);
    }

    public function adicionar(Perfil $perfil)
    {
        $atributos = array_keys($perfil->atributosPreenchidos());
        $valores = array_values($perfil->atributosPreenchidos());
        return $this->inserir('PERFIL', $atributos, $valores);
    }

    public function alterar(Perfil $perfil)
    {
        $atributos = array_keys($perfil->atributosPreenchidos());
        $valores = array_values($perfil->atributosPreenchidos());
        return $this->atualizar('PERFIL', $atributos, $valores, $perfil->getId());
    }
    public function excluir($id)    
    {
       return $this->deletar('PERFIL', $id);
    }
}
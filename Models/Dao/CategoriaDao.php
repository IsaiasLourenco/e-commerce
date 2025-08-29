<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use App\Models\Categoria;

class CategoriaDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('categoria');
    }
    public function obterPorid($id)
    {
        return $this->listar('categoria', "WHERE id = ?", [$id]);
    }

    public function adicionar(Categoria $categoria)
    {
        $atributos = array_keys($categoria->atributosPreenchidos());
        $valores = array_values($categoria->atributosPreenchidos());
        return $this->inserir('categoria', $atributos, $valores);
    }

    public function alterar(Categoria $categoria)
    {
        $atributos = array_keys($categoria->atributosPreenchidos());
        $valores = array_values($categoria->atributosPreenchidos());
        return $this->atualizar('categoria', $atributos, $valores, $categoria->getid());
    }
    public function excluir($id)    
    {
       return $this->deletar('categoria', $id);
    }

}

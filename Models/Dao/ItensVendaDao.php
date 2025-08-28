<?php

namespace App\Models\Dao;
use App\Models\Contexto;
use App\Models\ItensVenda;

class ItensVendaDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('ITENSVENDA');
    }
    public function obterPorId($id)
    {
        return $this->listar('ITENSVENDA', "WHERE ID = ?", [$id]);
    }

    public function adicionar(ItensVenda $itensvenda)
    {
        $atributos = array_keys($itensvenda->atributosPreenchidos());
        $valores = array_values($itensvenda->atributosPreenchidos());
        return $this->inserir('ITENSVENDA', $atributos, $valores);
    }

    public function alterar(ItensVenda $itensvenda)
    {
        $atributos = array_keys($itensvenda->atributosPreenchidos());
        $valores = array_values($itensvenda->atributosPreenchidos());
        return $this->atualizar('ITENSVENDA', $atributos, $valores, $itensvenda->getId());
    }
    public function excluir($id)    
    {
       return $this->deletar('ITENSVENDA', $id);
    }

}

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
    public function obterPorid($id)
    {
        return $this->listar('ITENSVENDA', "WHERE id = ?", [$id]);
    }

    public function adicionar(itens_venda $itensvenda)
    {
        $atributos = array_keys($itensvenda->atributosPreenchidos());
        $valores = array_values($itensvenda->atributosPreenchidos());
        return $this->inserir('ITENSVENDA', $atributos, $valores);
    }

    public function alterar(itens_venda $itensvenda)
    {
        $atributos = array_keys($itensvenda->atributosPreenchidos());
        $valores = array_values($itensvenda->atributosPreenchidos());
        return $this->atualizar('ITENSVENDA', $atributos, $valores, $itensvenda->getid());
    }
    public function excluir($id)    
    {
       return $this->deletar('ITENSVENDA', $id);
    }

}

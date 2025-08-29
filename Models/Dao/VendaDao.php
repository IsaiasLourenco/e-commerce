<?php

namespace App\Models\Dao;
use App\Models\Contexto;
use App\Models\ItensVenda;
use App\Models\Venda;
class VendaDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('VENDA');
    }
    public function obterPorid($id)
    {
        return $this->listar('VENDA', "WHERE id = ?", [$id]);
    }
    public function adicionar(Venda $venda)
    {
        $atributos = array_keys($venda->atributosPreenchidos());
        $valores = array_values($venda->atributosPreenchidos());
        return $this->inserir('VENDA', $atributos, $valores);
    }

    public function adicionarItens(itens_venda $itensVenda)
    {
        $atributos = array_keys($itensVenda->atributosPreenchidos());
        $valores = array_values($itensVenda->atributosPreenchidos());
        return $this->inserir('ITENSVENDA', $atributos, $valores);
    }

    public function alterar(Venda $venda)
    {
        $atributos = array_keys($venda->atributosPreenchidos());
        $valores = array_values($venda->atributosPreenchidos());
        return $this->atualizar('VENDA', $atributos, $valores, $venda->getid());
    }
    public function excluir($id)    
    {
       return $this->deletar('VENDA', $id);
    }

}

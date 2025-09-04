<?php

namespace App\Models\Dao;
use App\Models\Contexto;
use App\Models\ItensVenda;
use App\Models\Venda;
class VendaDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('venda');
    }
    public function obterPorid($id)
    {
        return $this->listar('venda', "WHERE id = ?", [$id]);
    }
    public function adicionar(Venda $venda)
    {
        $atributos = array_keys($venda->atributosPreenchidos());
        $valores = array_values($venda->atributosPreenchidos());
        return $this->inserir('Venda', $atributos, $valores);
    }

    public function adicionarItens(ItensVenda $itensVenda)
    {
        $atributos = array_keys($itensVenda->atributosPreenchidos());
        $valores = array_values($itensVenda->atributosPreenchidos());
        return $this->inserir('itens_venda', $atributos, $valores);
    }

    public function alterar(Venda $venda)
    {
        $atributos = array_keys($venda->atributosPreenchidos());
        $valores = array_values($venda->atributosPreenchidos());
        return $this->atualizar('Venda', $atributos, $valores, $venda->getid());
    }
    public function excluir($id)    
    {
       return $this->deletar('Venda', $id);
    }

}

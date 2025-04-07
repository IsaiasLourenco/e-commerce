<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use App\Models\Produto;

class ProdutoDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('PRODUTO');
    }
    public function obterPorId($id)
    {
        return $this->listar('PRODUTO', "WHERE ID = ?", [$id]);
    }

    public function obterPorCategoria($id)
    {
        return $this->listar('PRODUTO', "WHERE CATEGORIA = ?", [$id]);
    }
    public function ObterUltimoRegistro($campo)
    {
        return $this->listarUltimoRegistro('PRODUTO', $campo);
    }

    public function adicionar(Produto $produto)
    {
        $atributos = array_keys($produto->atributosPreenchidos());
        $valores = array_values($produto->atributosPreenchidos());
        return $this->inserir('PRODUTO', $atributos, $valores);
    }

    public function alterar(Produto $produto)
    {
        $atributos = array_keys($produto->atributosPreenchidos());
        $valores = array_values($produto->atributosPreenchidos());
        return $this->atualizar('PRODUTO', $atributos, $valores, $produto->getId());
    }
    public function excluir($id)
    {
        return $this->deletar('PRODUTO', $id);
    }
}

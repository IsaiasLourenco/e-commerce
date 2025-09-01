<?php

namespace App\Models\Dao;

use App\Models\Contexto;
use App\Models\Produto;

class ProdutoDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('produto');
    }

    public function obterPorid($id)
    {
        return $this->listar('produto', "WHERE id = ?", [$id]);
    }

    public function obterPorCategoria($id)
    {
        return $this->listar('produto', "WHERE categoria = ?", [$id]);
    }

    public function ObterUltimoRegistro($campo)
    {
        return $this->listarUltimoRegistro('produto', $campo);
    }

    public function adicionar(Produto $produto)
    {
        $atributos = array_keys($produto->atributosPreenchidos());
        $valores = array_values($produto->atributosPreenchidos());
        return $this->inserir('produto', $atributos, $valores);
    }

    public function alterar(Produto $produto)
    {
        $atributos = array_keys($produto->atributosPreenchidos());
        $valores = array_values($produto->atributosPreenchidos());
        return $this->atualizar('produto', $atributos, $valores, $produto->getid());
    }

    public function excluir($id)
    {
        return $this->deletar('produto', $id);
    }

    public function listarComCategoria()
    {
        $sql = "SELECT p.*, c.descricao AS categoria_nome
            FROM produto p
            LEFT JOIN categoria c ON p.categoria = c.id";

        $stmt = self::getConexao()->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $lista = [];

        foreach ($resultados as $linha) {
            $produto = new Produto();
            foreach ($linha as $chave => $valor) {
                $produto->__set($chave, $valor);
            }
            $produto->categoria_nome = $linha['categoria_nome'];
            $lista[] = $produto;
        }

        return $lista;
    }

    public function listarPaginadoNaHome($limit, $offset)
    {
        $sql = "SELECT * FROM produto LIMIT ? OFFSET ?";
        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(1, $limit, \PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function contarTodosNaHome()
    {
        $sql = "SELECT COUNT(*) as total FROM produto";
        return self::getConexao()->query($sql)->fetch(\PDO::FETCH_OBJ)->total;
    }
}

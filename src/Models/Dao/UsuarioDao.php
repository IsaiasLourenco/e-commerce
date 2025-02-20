<?php

namespace App\Models\Dao;
use PDOException;
use PDO;
use App\Models\Contexto;
use App\Models\Usuario;

class UsuarioDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('USUARIO');
    }
    public function autenticar($usuario){
        return $this->listar("USUARIO","WHERE USUARIO = '".$usuario."'"); 
    }

    public function obterPorId($id)
    {
        return $this->listar('USUARIO', "WHERE ID = ?", [$id]);
    }

    public function adicionar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->inserir('USUARIO', $atributos, $valores);
    }

    public function alterar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->atualizar('USUARIO', $atributos, $valores, $usuario->getId());
    }
    public function excluir($id)    
    {
       return $this->deletar('USUARIO', $id);
    }
}
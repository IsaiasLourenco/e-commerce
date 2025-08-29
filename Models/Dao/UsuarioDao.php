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
        return $this->listar('usuario');
    }
    public function autenticar($usuario){
        return $this->listar("usuario","WHERE usuario = '".$usuario."'"); 
    }

    public function obterPorid($id)
    {
        return $this->listar('usuario', "WHERE id = ?", [$id]);
    }

    public function adicionar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->inserir('usuario', $atributos, $valores);
    }

    public function alterar(Usuario $usuario)
    {
        $atributos = array_keys($usuario->atributosPreenchidos());
        $valores = array_values($usuario->atributosPreenchidos());
        return $this->atualizar('usuario', $atributos, $valores, $usuario->getid());
    }
    public function excluir($id)    
    {
       return $this->deletar('usuario', $id);
    }
}
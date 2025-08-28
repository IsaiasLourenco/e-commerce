<?php

namespace App\Services;
use App\Models\Dao\CategoriaDao;
use App\Models\Categoria;

class CategoriaService
{
    private $categoriaDao;

    public function __construct(CategoriaDao $categoriaDao)
    {
        $this->categoriaDao = $categoriaDao;
    }

    public function adicionarCategoria($dados)
    {
        $categoria = new Categoria();

        foreach ($dados as $chave => $valor) {
            $categoria->$chave = $valor;
        }

        return $this->categoriaDao->Adicionar($categoria);
    }

    public function alterarCategoria($dados)
    { 
        $categoria = new Categoria();

        foreach ($dados as $chave => $valor) {
            $categoria->$chave = $valor;
        }
        return $this->categoriaDao->Alterar($categoria);
    }
}
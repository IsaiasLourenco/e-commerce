<?php

namespace App\Services;
use App\Models\Dao\PefilDao;
use App\Models\Dao\PerfilDao;
use App\Models\Perfil;

class PerfilService
{
    private $perfilDao;

    public function __construct(PerfilDao $perfilDao)
    {
        $this->perfilDao = $perfilDao;
    }

    public function adicionarPerfil($dados)
    {
        $perfil = new Perfil();

        foreach ($dados as $chave => $valor) {
            $perfil->$chave = $valor;
        }

        return $this->perfilDao->Adicionar($perfil);
    }

    public function alterarPerfil($dados)
    { 
        $perfil = new Perfil();

        foreach ($dados as $chave => $valor) {
            $perfil->$chave = $valor;
        }
        return $this->perfilDao->Alterar($perfil);
    }
}
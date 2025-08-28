<?php

namespace App\Services;

use App\Models\Usuario;
use App\Models\Dao\UsuarioDao;

class UserService
{
    private $usuarioDao;
    private $fileUploadService;

    public function __construct(UsuarioDao $usuarioDao)
    {
        $this->usuarioDao = $usuarioDao;
    }

    public function adicionarUsuario($dados, $imagem)
    {
        $usuario = new Usuario();
        $dados['imagem'] = $imagem;

        foreach ($dados as $chave => $valor) {
            if ($chave === 'senha') {
                $valor = password_hash($valor, PASSWORD_BCRYPT);
            }
            $usuario->$chave = $valor;
        }

        return $this->usuarioDao->Adicionar($usuario);
    }

    public function alterarUsuario($dados, $imagem)
    {
        $usuario = new Usuario();
        $dados['imagem'] = $imagem;

        foreach ($dados as $chave => $valor) {
            $usuario->$chave = $valor;
        }
        return $this->usuarioDao->Alterar($usuario);
    }
}
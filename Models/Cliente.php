<?php

namespace App\Models;

class Cliente
{
    private ?string $id;
    private ?string  $nome;
    private ?string  $cpf;
    private ?string  $data_nascimento;
    private ?string  $email;
    private ?string  $senha;
    private ?string  $cep;
    private ?string  $logradouro;
    private ?string  $numero;
    private ?string  $bairro;
    private ?string  $uf;
    private ?string  $cidade;
    private ?string  $imagem;
    private ?string  $data_cadastro;
    private ?string  $ativo;
    private ?string  $perfil;

    public function __construct($id = '', $nome = '', $cpf = '', $data_nascimento = '', $email = '',  $senha = '',   $cep = '',   $logradouro = '',    $numero = '', $bairro = '', $uf = '', $cidade = '', $imagem = '', $data_cadastro = '', $ativo = '', $perfil = '')
    {
        date_default_timezone_set('America/Sao_Paulo');
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->data_nascimento = $data_nascimento;
        $this->email = $email;
        $this->senha = $senha;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->uf = $uf;
        $this->cidade = $cidade;
        $this->imagem = $imagem;
        $this->data_cadastro = $data_cadastro ?: date("Y-m-d H:i:s");
        $this->ativo = $ativo ?: '0';
        $this->perfil = $perfil;
    }

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
    }

    public function __set($chave, $valor)
    {
        if (property_exists($this, $chave)) {
            $this->$chave = $valor;
        }
    }    
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'email' => $this->email,
            'senha' => $this->senha,
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'bairro' => $this->bairro,
            'uf' => $this->uf,
            'cidade' => $this->cidade,
            'imagem' => $this->imagem,
            'data_cadastro' => $this->data_cadastro,
            'ativo' => $this->ativo,
            'perfil' => $this->perfil,
        ];
    }

    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}

<?php

namespace App\Services;
use App\Models\Dao\ProdutoDao;
use App\Models\Produto;

class ProdutoService
{
    private $produtoDao;
    private $fileUploadService;

    public function __construct(ProdutoDao $produtoDao)
    {
        $this->produtoDao = $produtoDao;
    }

    public function adicionarProduto($dados, $imagem)
    {
         $codigo = $this->produtoDao->ObterUltimoRegistro('CODIGO');

        $produto = new Produto();
        $dados['imagem'] = $imagem;
        $dados['codigo'] = str_pad($codigo[0]->ULTIMOVALOR + 1, 6, '0', STR_PAD_LEFT);

        foreach ($dados as $chave => $valor) {
            $produto->$chave = $valor;
        }

        return $this->produtoDao->Adicionar($produto);
    }

    public function alterarProduto($dados, $imagem)
    {
        $produto = new Produto();
        $dados['imagem'] = $imagem ?: '';

        foreach ($dados as $chave => $valor) {
            $produto->$chave = $valor;
        }
        return $this->produtoDao->Alterar($produto);
    }
}
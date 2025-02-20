<?php

namespace App\Models;

abstract class Notifications
{
    // A URL do CSS pode ser centralizada, evitando repetição de código
    private function getCssLink()
    {
        return "<link rel='stylesheet' type='text/css' href='lib/css/aurora.css' />";
    }

    // Gera uma mensagem de sucesso e a retorna como string
    protected function success($obj, $acao, $metodo)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class='fonte12 poppins-black fnc-sucesso'>
                        %s %s com sucesso!
                    </h2>
                        <a href='index.php?controller=%sController&metodo=%s' class='btn-msg fnc-cinza-claro'> Fechar Sair </a>                    
                </div>
            </div>",
            $css,
            htmlspecialchars($obj),
            htmlspecialchars($acao),
            htmlspecialchars($obj),
            htmlspecialchars($metodo)
        );
        return $mensagem;
    }

    // Solicita confirmação para exclusão de dados
    protected function confirm($mensagem, $obj, $nome, $id)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class='fonte12 poppins-medium fnc-preto-azulado'>
                        Deseja realmente %s %s %s definitivamente?
                    </h2>
                    <div class='botoes mg-t-1 flex justify-between'>
                        <a href='index.php?controller=%sController&metodo=excluir&id=%s' class='btn-mini fnc-branco bg-azul mg-auto'> Sim </a>
                        <a href='index.php?controller=%sController&metodo=listar' class='btn-mini fnc-branco bg-vermelho mg-auto'> Não </a>
                    </div>
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem),
            htmlspecialchars($obj),
            htmlspecialchars($nome),
            htmlspecialchars($obj),
            htmlspecialchars($id),
            htmlspecialchars($obj)
        );
        return $mensagem;
    }

    // Retorna uma mensagem de erro no login
    protected function loginError($mensagem)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class='fonte12 poppins-black fnc-secundario'>
                      %s!
                    </h2>
                        <a href='index.php' class='btn-msg fnc-secundario'> Fechar Sair </a>                    
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem)
        );
        return $mensagem;
    }

    // Alerta para exclusão de múltiplos registros
    protected function alertExclusao($controller, $metodo)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='mensagem'>
                <div class='span animated bounceInDown mg-t-2 bg-p5-watermelon'>
                    <h2 class='fw-300 espaco-letra txt-c fnc-preto-1 fonte14 mg-t-2'>
                        Necessário selecionar mais de 1 registro!
                    </h2>
                    <a href='index.php?controller=%s&metodo=%s' class='fnc-branco block mg-t-1 mg-auto fonte12 txt-c'> Sair </a>
                </div>
            </div>",
            $css,
            htmlspecialchars($controller),
            htmlspecialchars($metodo)
        );
        return $mensagem;
    }

    // Retorna uma mensagem padrão
    protected function defaultMessage($mensagem,$submensagem, $controller, $metodo)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class=' fonte10 poppins-medium fnc-preto-azulado'>
                       <i class='fa-solid fa-check fonte18 fnc-sucesso'></i>  %s <br> %s <i class='fa-regular fa-face-smile-beam fonte18 fnc-sucesso'></i>
                    </h2>
                    <a href='index.php' class='btn-msg bg-vermelho-claro fnc-preto-azulado'> Fechar e Sair </a>
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem),
            htmlspecialchars($submensagem),
            htmlspecialchars($controller),
            htmlspecialchars($metodo)
        );
        return $mensagem;
    }
}

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const campoCep = document.getElementById('cep');

    if (!campoCep) return; // Se não tiver campo de CEP, não faz nada

    const exibirMensagemErro = (mensagem) => {
        const mensagemErro = document.createElement('div');
        mensagemErro.textContent = mensagem;
        mensagemErro.style.color = 'red';
        mensagemErro.style.marginTop = '5px';
        mensagemErro.id = 'mensagem-erro';

        campoCep.parentNode.insertBefore(mensagemErro, campoCep.nextSibling);

        setTimeout(() => {
            const erro = document.getElementById('mensagem-erro');
            if (erro) erro.remove();
        }, 3000);
    };

    const limparCampos = () => {
        const campos = ['cep', 'rua', 'numero', 'bairro', 'cidade', 'estado'];
        campos.forEach(id => {
            const campo = document.getElementById(id);
            if (campo) campo.value = '';
        });
        campoCep.focus();
    };

    const preencherForm = (endereco) => {
        const mapa = {
            cep: endereco.cep,
            rua: endereco.logradouro,
            bairro: endereco.bairro,
            cidade: endereco.localidade,
            estado: endereco.uf
        };
        for (const id in mapa) {
            const campo = document.getElementById(id);
            if (campo) campo.value = mapa[id];
        }
    };

    const cepsUnicos = [
        '37576-000', // Inconfidentes
        '37570-000', // Ouro Fino
        '37564-000', // Borda da Mata
        '37590-000'  // Jacutinga
    ];

    const ajustarCamposEditaveis = (cep) => {
        const rua = document.getElementById('rua');
        const bairro = document.getElementById('bairro');

        if (!rua || !bairro) return;

        if (cepsUnicos.includes(cep)) {
            rua.readOnly = false;
            bairro.readOnly = false;
        } else {
            rua.readOnly = true;
            bairro.readOnly = true;
        }
    };

    const cepValido = (cep) => cep.length === 9;

    const pesquisarCEP = async () => {
        const cep = campoCep.value;
        console.log('Buscando CEP:', cep);
        const url = `https://viacep.com.br/ws/${cep}/json`;

        if (cepValido(cep)) {
            try {
                const dados = await fetch(url);
                const endereco = await dados.json();

                if (endereco.erro) {
                    exibirMensagemErro('CEP Inexistente!');
                    limparCampos();
                } else {
                    preencherForm(endereco);
                    ajustarCamposEditaveis(cep); 
                }
            } catch (error) {
                exibirMensagemErro('Erro ao buscar o CEP.');
                limparCampos();
            }
        } else {
            exibirMensagemErro('CEP Incorreto!');
            limparCampos();
        }
    };

    campoCep.addEventListener('focusout', pesquisarCEP);
});
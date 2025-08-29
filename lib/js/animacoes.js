

// CARREGAR IMAGEM

function mostrar(imagem) {
    if (imagem.files && imagem.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#foto')//id <img>
                .attr('src', e.target.result)
                .width(170)
        };
        reader.readAsDataURL(imagem.files[0]);
    }
}

// FORMATAR CAMPOS
function formata_mascara(campo_passado, mascara) {
    let campo = campo_passado.value.length;
    let saida = mascara.substring(0, 1);
    let texto = mascara.substring(campo);

    if (texto.substring(0, 1) != saida) {
        campo_passado.value += texto.substring(0, 1);
    }
}

function exibirMensagem() {
    let bloco = document.getElementById("blocoMensagens");
    bloco.classList.toggle("mod-visivel");
}
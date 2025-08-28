document.addEventListener("DOMContentLoaded", function () {
    // Seleciona os campos de CPF e e-mail no formulário
    const cpfInput = document.getElementById("cpf");
    const emailInput = document.getElementById("email");
    const form = document.getElementById("formCadastro");
    const cpfFeedback = document.getElementById("cpfFeedback");
    const emailFeedback = document.getElementById("emailFeedback");

    // Função para verificar se o CPF ou e-mail já existem
    async function verificarExistencia(campo, valor) {
        if (!valor) return false; // Retorna falso se o valor estiver vazio
        try {
            const response = await fetch("index.php?controller=ClienteController&metodo=validarDadosCliente", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ campo, valor })
            });
            
            if (!response.ok) {
                console.error("Erro na resposta do servidor");
                return false;
            }

            const data = await response.json();
            return data && data.existe === true; // Certifica-se de que existe seja booleano
        } catch (error) {
            console.error("Erro ao verificar", campo, error);
            return false;
        }
    }

    // Função para exibir feedback ao usuário
    function exibirFeedback(elemento, mensagem, existe) {
        if (existe) {
            elemento.textContent = mensagem;
            elemento.style.color = "red";
        } else {
            elemento.textContent = "";
        }
    }

    // Adiciona evento de perda de foco (blur) para verificar CPF
    cpfInput.addEventListener("blur", async function () {
        const cpf = cpfInput.value.trim();
        if (cpf !== "") {
            const existe = await verificarExistencia("cpf", cpf);
            exibirFeedback(cpfFeedback, "Este CPF já está cadastrado.", existe);
        } else {
            cpfFeedback.textContent = "";
        }
    });

    // Adiciona evento de perda de foco (blur) para verificar E-mail
    emailInput.addEventListener("blur", async function () {
        const email = emailInput.value.trim();
        if (email !== "") {
            const existe = await verificarExistencia("email", email);
            exibirFeedback(emailFeedback, "Este e-mail já está cadastrado.", existe);
        } else {
            emailFeedback.textContent = "";
        }
    });

    // Validação antes de enviar o formulário
    form.addEventListener("submit", async function (event) {
        event.preventDefault(); // Impede o envio imediato

        const cpf = cpfInput.value.trim();
        const email = emailInput.value.trim();

        const cpfExiste = await verificarExistencia("cpf", cpf);
        const emailExiste = await verificarExistencia("email", email);

        if (cpfExiste || emailExiste) {
            alert("Não é possível cadastrar, CPF ou e-mail já existem.");
            return;
        }

        form.submit(); // Envia o formulário caso não haja duplicatas
    });
});
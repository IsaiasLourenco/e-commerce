document.addEventListener("DOMContentLoaded", function () {
    const senhaAtualInput = document.getElementById("senha_atual");
    const novaSenhaInput = document.getElementById("nova_senha");
    const novaSenhaBloco = document.getElementById("novaSenhaBloco");

    const toggleSenhaAtual = document.getElementById("toggleSenhaAtual");
    const toggleNovaSenha = document.getElementById("toggleNovaSenha");

    // Mostrar/ocultar senha atual
    toggleSenhaAtual.addEventListener("click", function () {
        const tipo = senhaAtualInput.type === "password" ? "text" : "password";
        senhaAtualInput.type = tipo;
        toggleSenhaAtual.textContent = tipo === "password" ? "👁️" : "🙈";
    });

    // Mostrar/ocultar nova senha
    toggleNovaSenha.addEventListener("click", function () {
        const tipo = novaSenhaInput.type === "password" ? "text" : "password";
        novaSenhaInput.type = tipo;
        toggleNovaSenha.textContent = tipo === "password" ? "👁️" : "🙈";
    });

    // Validação da senha atual ao sair do campo
    senhaAtualInput.addEventListener("blur", async function () {
        const senha = senhaAtualInput.value.trim();
        const id = document.querySelector("input[name='id']").value;

        if (senha !== "") {
            const response = await fetch("index.php?controller=ClienteController&metodo=validarSenhaAtual", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id, senha })
            });

            const data = await response.json();
            if (data.valida === true) {
                novaSenhaBloco.style.display = "block";
            } else {
                novaSenhaBloco.style.display = "none";
                alert("Senha atual incorreta.");
            }
        }
    });
});
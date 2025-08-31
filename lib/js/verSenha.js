document.addEventListener("DOMContentLoaded", function () {
    const senhaInput = document.getElementById("senha");
    const toggle = document.getElementById("toggleSenha");

    if (senhaInput && toggle) {
        toggle.addEventListener("click", function () {
            const tipo = senhaInput.type === "password" ? "text" : "password";
            senhaInput.type = tipo;
            toggle.textContent = tipo === "password" ? "👁️" : "🙈";
        });
    }
});
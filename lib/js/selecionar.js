document.addEventListener('DOMContentLoaded', () => {
    const camposEditaveis = document.querySelectorAll('input[type="text"]:not([readonly])');

    camposEditaveis.forEach(campo => {
        campo.addEventListener('focus', function () {
            this.select();
        });
    });
});
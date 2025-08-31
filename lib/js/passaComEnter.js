document.addEventListener("DOMContentLoaded", function () {
    const focusables = Array.from(document.querySelectorAll("[tabindex]"))
        .sort((a, b) => a.tabIndex - b.tabIndex);

    focusables.forEach((el, index) => {
        el.addEventListener("keydown", function (e) {
            if (e.key === "Enter" && el.type !== "email") {
                e.preventDefault();
                const next = focusables[index + 1];
                if (next && next.type !== "submit") {
                    next.focus();
                }
            }
        });
    });
});
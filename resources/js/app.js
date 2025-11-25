import "./bootstrap";

import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const flash = document.getElementById("flash-message");

    if (flash) {
        // mulai fade setelah 2 detik
        setTimeout(() => {
            flash.classList.add("opacity-0", "translate-y-2");
            setTimeout(() => {
                flash.remove();
            }, 500);
        }, 2000);
    }
});

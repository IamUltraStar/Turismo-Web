const button_login = document.getElementById("button_login");
const button_sign_up = document.getElementById("button_sign_up");
const button_profile_user = document.getElementById("button_profile_user");
const button_login_mobile = document.getElementById("button_login_mobile");
const button_sign_up_mobile = document.getElementById("button_sign_up_mobile");
const button_profile_user_mobile = document.getElementById(
    "button_profile_user_mobile"
);
const menu_profile_user = document.getElementById("menu_profile_user");
const sidebar = document.getElementById("dynamic_sidebar");
const burger_container = document.getElementById("dynamic_burger_container");
const burger_input = document.getElementById("dynamic_burger_input");
const header = document.getElementById("dynamic_header");

document.addEventListener("DOMContentLoaded", async () => {
    // Mostrar/ocultar el menú al hacer clic en el ícono
    button_profile_user.addEventListener("click", () => {
        menu_profile_user.classList.toggle("hidden");
    });

    // Ocultar el menú al hacer clic fuera de él
    document.addEventListener("click", (event) => {
        if (
            !sidebar.contains(event.target) &&
            !event.target.closest("#dynamic_burger_input") &&
            !event.target.closest("#dynamic_burger_button")
        ) {
            burger_input.checked = false;
        }

        if (
            !menu_profile_user.contains(event.target) &&
            event.target !== button_profile_user
        ) {
            menu_profile_user.classList.add("hidden");
        }
    });

    window.addEventListener("scroll", () => {
        if (window.scrollY > 0) {
            burger_container.classList.add("scrolled");
            header.classList.add("scrolled");
            menu_profile_user.classList.add("scrolled");
        } else {
            burger_container.classList.remove("scrolled");
            header.classList.remove("scrolled");
            menu_profile_user.classList.remove("scrolled");
        }
    });

    window.addEventListener("resize", () => {
        if (window.getComputedStyle(burger_container).display === "none") {
            burger_input.checked = false;
        }
    });

    try {
        const response = await fetch("./verifyExistSession");
        const data = await response.text();

        if (data) {
            button_login.classList.add("hidden");
            button_sign_up.classList.add("hidden");
            button_profile_user.innerText = data;

            button_login_mobile.classList.add("hidden");
            button_sign_up_mobile.classList.add("hidden");
            button_profile_user_mobile.innerText = data;
        } else {
            button_profile_user.classList.add("hidden");
            button_profile_user_mobile.classList.add("hidden");
        }
    } catch (error) {
        console.error("Error al cargar los destinos:", error);
    }
});

function burger_buttonClicked() {
    burger_input.checked = !burger_input.checked;
}

document.addEventListener('DOMContentLoaded', () => {
    const button_login = document.getElementById('button_login');
    const button_sing_up = document.getElementById('button_sing_up');
    const button_profile_user = document.getElementById('button_profile_user');
    const menu_profile_user = document.getElementById('menu_profile_user');
    const header = document.getElementById('dynamic_header');

    // Mostrar/ocultar el menú al hacer clic en el ícono
    button_profile_user.addEventListener('click', () => {
        menu_profile_user.classList.toggle('hidden');
    });

    // Ocultar el menú al hacer clic fuera de él
    document.addEventListener('click', (event) => {
        if (!menu_profile_user.contains(event.target) && event.target !== button_profile_user) {
            menu_profile_user.classList.add('hidden');
        }
    });

    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            header.classList.add('scrolled');
            menu_profile_user.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
            menu_profile_user.classList.remove('scrolled');
        }
    });

    fetch("data.php?action=verify-exist-session", {
        method: "GET",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.text();
    })
    .then(data => {
        if (data) {
            button_login.classList.add('hidden');
            button_sing_up.classList.add('hidden');
            button_profile_user.innerText = data;
        } else {
            button_profile_user.classList.add('hidden');
        }
    })
    .catch(error => {console.error("Error al verificar la sesión:", error);});
});
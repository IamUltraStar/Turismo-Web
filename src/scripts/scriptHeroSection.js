document.addEventListener('DOMContentLoaded', () => {
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

});
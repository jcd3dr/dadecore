/**
 * DadeCore Theme - Main JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
    console.log('DadeCore Theme Scripts Loaded!');

    // Manejo del toggle de menú responsive
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryMenuContainer = document.querySelector('.primary-menu-container');

    if (menuToggle && primaryMenuContainer) {
        menuToggle.addEventListener('click', () => {
            // Verifica el estado actual de 'aria-expanded' para accesibilidad
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !expanded); // Esto actualiza el atributo aria-expanded

            // Añade o quita la clase 'active' para controlar la visibilidad del menú
            primaryMenuContainer.classList.toggle('active');
        });
    }

    // Cookie consent banner
    const cookieBanner = document.querySelector('.cookie-banner');
    const cookieAccept = document.querySelector('.cookie-accept');
    if (cookieBanner && cookieAccept) {
        if (!localStorage.getItem('dc_cookie_consent')) {
            cookieBanner.style.display = 'block';
        }
        cookieAccept.addEventListener('click', () => {
            localStorage.setItem('dc_cookie_consent', '1');
            cookieBanner.style.display = 'none';
        });
    }
});
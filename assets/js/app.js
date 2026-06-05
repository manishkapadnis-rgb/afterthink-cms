document.addEventListener('DOMContentLoaded', function () {
    // Mobile off-canvas navigation
    var toggle = document.getElementById('mobile-menu-toggle');
    var menu = document.getElementById('mobile-menu');

    if (toggle && menu) {
        function openMenu() {
            menu.classList.add('open');
            document.body.classList.add('menu-open');
            toggle.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-hidden', 'false');
        }
        function closeMenu() {
            menu.classList.remove('open');
            document.body.classList.remove('menu-open');
            toggle.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');
        }

        toggle.addEventListener('click', openMenu);
        menu.querySelectorAll('[data-menu-close], a').forEach(function (el) {
            el.addEventListener('click', closeMenu);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
    }
});

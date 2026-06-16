/**
 * Navbar scroll & mobile toggle behaviour
 */
(function () {
    const navbar = document.getElementById('masthead');
    const toggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.navbar .nav-links');

    if (!navbar) return;

    /* ── Scroll: shrunk + is-top ── */
    const SHRINK_OFFSET = 80;

    function onScroll() {
        const y = window.scrollY;

        // shrunk → show mini brand
        navbar.classList.toggle('shrunk', y > SHRINK_OFFSET);

        // is-top → thicker top border when at very top
        navbar.classList.toggle('is-top', y === 0);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // run once on load

    /* ── Mobile: toggle drawer ── */
    if (toggle && navLinks) {
        toggle.addEventListener('click', function () {
            const isOpen = navLinks.classList.toggle('open');
            toggle.classList.toggle('open', isOpen);   // animasi CSS lines → X
            toggle.setAttribute('aria-expanded', isOpen);
        });

        // close drawer on link click
        navLinks.querySelectorAll('a.nl').forEach(function (link) {
            link.addEventListener('click', function () {
                navLinks.classList.remove('open');
                toggle.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    /* ── Active link: mark current page ── */
    const currentUrl = window.location.href;
    document.querySelectorAll('.navbar a.nl').forEach(function (link) {
        if (link.href === currentUrl) {
            link.classList.add('active');
        }
    });
})();

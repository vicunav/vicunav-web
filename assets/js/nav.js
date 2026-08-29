(function () {
  var toggle = document.querySelector('[data-nav-toggle]');
  var menu = document.getElementById('site-nav-mobile');
  if (!toggle || !menu) return;

  toggle.addEventListener('click', function () {
    var open = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!open));
    toggle.setAttribute('aria-label', open ? 'Abrir menú' : 'Cerrar menú');
    menu.classList.toggle('is-open', !open);
  });
})();

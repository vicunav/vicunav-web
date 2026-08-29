(function () {
  var chips = document.querySelectorAll('[data-filter-chip]');
  var cards = document.querySelectorAll('[data-article-category]');
  var featured = document.querySelector('[data-featured-article]');
  if (!chips.length) return;

  function applyFilter(category) {
    cards.forEach(function (card) {
      var match = category === 'Todos' || card.getAttribute('data-article-category') === category;
      card.hidden = !match;
    });
    if (featured) {
      featured.hidden = !(category === 'Todos' || category === 'Restaurantes');
    }
  }

  chips.forEach(function (chip) {
    chip.addEventListener('click', function () {
      chips.forEach(function (c) { c.setAttribute('aria-pressed', 'false'); });
      chip.setAttribute('aria-pressed', 'true');
      applyFilter(chip.getAttribute('data-filter-chip'));
    });
  });
})();

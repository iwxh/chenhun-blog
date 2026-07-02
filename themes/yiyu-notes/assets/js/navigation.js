(function () {
  'use strict';
  document.documentElement.classList.add('has-js');
  var button = document.querySelector('.menu-toggle');
  var navigation = document.querySelector('.site-navigation');
  if (!button || !navigation) return;

  button.addEventListener('click', function () {
    var open = button.getAttribute('aria-expanded') === 'true';
    button.setAttribute('aria-expanded', String(!open));
    navigation.classList.toggle('is-open', !open);
  });

  document.addEventListener('click', function (event) {
    if (!navigation.contains(event.target) && !button.contains(event.target)) {
      button.setAttribute('aria-expanded', 'false');
      navigation.classList.remove('is-open');
    }
  });
}());

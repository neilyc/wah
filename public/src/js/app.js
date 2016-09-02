'use strict';
class App {
  constructor() {
    self = this;
    self._init();
  }

  _init() {
    document.querySelector('.toggle-nav').addEventListener('click', () => {
      document.querySelector('.topnav').classList.toggle("responsive");
    });

    window.onload = () => {
      self._menuCheckActive();
      document.body.removeChild(document.querySelector('.preloader'));
    }
  }

  _menuCheckActive() {
    var urlMatch = false,
        path = decodeURIComponent(window.location.pathname),
        href;

    Array.prototype.forEach.call(document.querySelectorAll('.topnav li a'), (elem) => {
      href = elem.getAttribute('href');
      if (path.substring(0, href.length) === href && href != '/') {
        elem.classList.add('active');
      }
    });
  }
}
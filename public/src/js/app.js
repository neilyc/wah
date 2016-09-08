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
      document.body.classList.add("loaded");
    }
    window.onscroll = (e) => {  
      self._toggleTopNav();
    } 
  }

  _toggleTopNav() {
    var scrollTop = Math.abs(document.body.getBoundingClientRect().top),
        header = document.querySelector('.header'),
        headerHeight = header.clientHeight - document.querySelector('.topnav-container').clientHeight;
        
    if(scrollTop > headerHeight) {
      header.classList.add('down');
    }
    if (scrollTop < header.clientHeight) {
      header.classList.remove('down');
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
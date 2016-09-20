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
      document.body.classList.add("loaded");
    }

    window.onscroll = (e) => {  
      self._toggleTopNav();
    } 
    self._menuCheckActive();

    if(document.querySelector('.photos')) {
      new Modal('.img');
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

  initMap() {
    var map = new google.maps.Map(document.querySelector('.map-container'), {
      center: COORD,
      zoom: 16
    });

    new google.maps.Marker({
      position: COORD,
      map: map
    });
  }
}
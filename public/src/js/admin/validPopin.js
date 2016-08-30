;(function(window) {
  'use strict';
  var self;
  function ValidPopin() {
    self = this;
    self.popup = document.createElement('div');
    self.yes = document.createElement('a');
    self.no = document.createElement('a');
    self.close = document.createElement('a');
    self.url;

    self._init();
  };
  ValidPopin.prototype = {
    _init: function() {

      Array.prototype.forEach.call(document.querySelectorAll('a.delete'), function(btn) {
        console.log('ici');
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          self.url = this.href;
          self._openPopin();
        });
      });

      self.popup.addEventListener('click', function(e) {
        var close = true;
        Array.prototype.forEach.call(e.path, function(p) {
          if(p.className == 'cd-popup-container') close = false;
        });

        if(close) {
          self._closePopin();
        }
      }); 

      self.no.addEventListener('click', function(e) {
        self._closePopin();
      }); 

      self.close.addEventListener('click', function(e) {
        self._closePopin();
      }); 

      self.yes.addEventListener('click', function(e) {
        document.location.href = self.url;
      }); 

      self._initPopin();
    },
    _openPopin: function() {
      self.popup.classList.add('is-visible');
    },
    _closePopin: function() {
      self.popup.classList.remove('is-visible');
    },
    _initPopin: function() {
      var container = document.createElement('div'),
          text = document.createElement('p'),
          buttons = document.createElement('ul'),
          liYes = document.createElement('li'),
          liNo = document.createElement('li');


      self.popup.className = 'cd-popup';
      container.className = 'cd-popup-container';
      buttons.className = 'cd-buttons';
      self.close.className = 'cd-popup-close img-replace';

      text.innerHTML = 'Voulez-vous valider cette action ?';
      self.yes.innerHTML = 'Oui';
      self.no.innerHTML = 'Non';

      container.appendChild(text);
      container.appendChild(buttons);
      container.appendChild(self.close);

      liYes.appendChild(self.yes);
      liNo.appendChild(self.no);

      buttons.appendChild(liYes);
      buttons.appendChild(liNo);



      self.popup.appendChild(container);


      document.querySelector('body').appendChild(self.popup);
    }
  }
  window.ValidPopin = ValidPopin;

})(window);
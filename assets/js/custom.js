/**
 * Beko front-end behaviour, without jQuery.
 *
 * The plugin calls keep the options they always had; ColorlibUI provides
 * drop-in versions of Owl Carousel, Magnific Popup, Masonry and AjaxChimp
 * that build the same markup, so the theme's stylesheets apply unchanged.
 */
(function () {
  'use strict';

  var UI = window.ColorlibUI;
  if (!UI) return;

  UI.enhanceSelects('select');

  // menu fixed js code
  UI.ready(function () {
    var menus = UI.toElements('.main_menu');
    if (!menus.length) return;
    window.addEventListener('scroll', function () {
      var windowTop = window.pageYOffset + 1;
      menus.forEach(function (menu) {
        if (windowTop > 50) {
          menu.classList.add('menu_fixed', 'animated', 'fadeInDown');
        } else {
          menu.classList.remove('menu_fixed', 'animated', 'fadeInDown');
        }
      });
    }, { passive: true });
  });

  UI.masonry('.grid', {
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });

  // The old script initialised .client_logo_slider twice with the same
  // options; Owl ignored the second call.
  UI.owl('.client_logo_slider', {
    items: 6,
    loop: true,
    responsive: {
      0: {
        items: 3,
        margin: 15
      },
      600: {
        items: 3,
        margin: 15
      },
      991: {
        items: 5,
        margin: 15
      },
      1200: {
        items: 6,
        margin: 15
      }
    }
  });

  // .popup-youtube is bound twice, as before: the second call replaces the
  // first for those links, so a video link opens its iframe, while the
  // .img-gal gallery still lists the video links among its items.
  UI.magnific('.img-gal, .popup-youtube', {
    type: 'image',
    gallery: {
      enabled: true
    }
  });
  UI.magnific('.popup-youtube', {
    type: 'iframe'
  });

  UI.owl('.live_stareams_slide', {
    items: 2,
    loop: true,
    dots: false,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    nav: true,
    navText: [
      '<i class="fa-solid fa-caret-left"></i>',
      '<i class="fa-solid fa-caret-right"></i>'
    ],
    margin: 15,
    responsive: {
      0: {
        items: 1,
        margin: 15
      },
      600: {
        items: 1,
        margin: 15
      },
      991: {
        items: 1,
        margin: 15
      },
      1200: {
        items: 2,
        margin: 15
      }
    }
  });

  // Upcoming war countdown: days and hours to data-war-date. The elements are
  // looked up on every tick, so a widget the Elementor editor renders later
  // counts down too.
  function makeTimer() {
    var counter = document.querySelector('.upcomming_war_counter');
    if (!counter) return;
    var endTime = Date.parse(new Date(counter.getAttribute('data-war-date'))) / 1000;
    var now = Date.parse(new Date()) / 1000;
    var timeLeft = endTime - now;

    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - (days * 86400)) / 3600);

    if (hours < 10) {
      hours = '0' + hours;
    }

    var daysEl = document.getElementById('days');
    var hoursEl = document.getElementById('hours');
    if (daysEl) daysEl.innerHTML = days + '<span>Days</span>';
    if (hoursEl) hoursEl.innerHTML = hours + '<span>Hours</span>';
  }

  UI.ready(function () {
    makeTimer();
    setInterval(makeTimer, 1000);
  });

  //------- Mailchimp js --------//
  UI.ajaxChimp('#mc_embed_signup form');
}());

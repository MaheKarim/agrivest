'use strict';
(function ($) {

  /* ==================== Ready Function Start =================== */
  $(document).ready(function () {
    /* ==================== Header Button Click JS Start =================== */
    $('.header-button').on('click', function () {
      $('.body-overlay').toggleClass('show');
      $('body').toggleClass('scroll-hide-sm');
    });
    
    $('.body-overlay').on('click', function () {
      $('.header-button').trigger('click');
      $(this).removeClass('show');
      $('body').removeClass('scroll-hide-sm');
    });
    /* ==================== Header Button Click JS End ===================== */
    
    /* ==================== Add Background Image Js Start ===================== */
    $('.bg-img').css('background-image', function () {
      var bg = 'url(' + $(this).data('background-image') + ')';
      return bg;
    });
    /* ==================== Add Background Image Js End ======================= */

    /* ==================== Dynamically Add 'active' class based on current Page Start ======================= */
    function dynamicActiveMenuClass(selector) {
      let fileName = window.location.pathname.split('/').reverse()[0];

      selector.find('li').each(function () {
        let anchor = $(this).find('a');
        if ($(anchor).attr('href') == fileName) {
          $(this).addClass('active');
        }
      });

      // if any li has active element add class
      selector.children('li').each(function () {
        if ($(this).find('.active').length) {
          $(this).addClass('active');
        }

        //if any li.active has bootstrap's collapse component open it  
        if ($(this).hasClass('active')) {
          $(this).find('.collapse').addClass('show');
          $(this).find('[data-bs-toggle="collapse"]').removeClass('collapsed');
          $(this).find('[data-bs-toggle="collapse"]').attr('aria-expanded', 'false');
        }
      });

      // if no file name return
      if (fileName == '') {
        selector.find('li').eq(0).addClass('active');
      }
    }
    if ($('.header ul.nav-menu').length) {
      dynamicActiveMenuClass($('.header ul.nav-menu'));
    }

    if ($('ul.offcanvas-sidebar-menu').length) {
      dynamicActiveMenuClass($('ul.offcanvas-sidebar-menu'));
    }
    /* ==================== Dynamically Add 'active' class based on current Page End ======================= */
    
    /* ==================== Password Toggle JS Start ======================= */
    $('.input--group-password').each(function (index, inputGroup) {
      var inputGroupBtn = $(inputGroup).find('.input-group-btn');
      var formControl = $(inputGroup).find('.form-control.form--control');

      inputGroupBtn.on('click', function () {
        if (formControl.attr('type') === 'password') {
          formControl.attr('type', 'text');
          $(this).find('i').removeClass('fa-eye -slash').addClass('fa-eye');
        } else {
          formControl.attr('type', 'password');
          $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        }
      });
    });
    /* ==================== Password Toggle JS End ========================= */
    
    /* ==================== Slick Slider JS Start ========================== */
    $('.feedback-slider').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 2000,
      dots: true,
      pauseOnHover: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ],
    })

    $('.offer-slider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      speed: 1000,
      arrows: true,
      prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            arrows: false,
            dots: true
          }
        },
        {
          breakpoint: 425,
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: true
          }
        }
      ],
    })

    $('.project-slider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      speed: 1000,
      arrows: true,
      prevArrow: '<button type="button" class="slick-prev"><i class="las la-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="las la-arrow-right"></i></button>',
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            arrows: false,
            dots: true
          }
        },
        {
          breakpoint: 425,
          settings: {
            slidesToShow: 1,
            arrows: false,
            dots: true
          }
        }
      ],
    })

    $('.brands-slider').slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      speed: 1000,
      dots: false,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 1000,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 5,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 425,
          settings: {
            slidesToShow: 2,
          }
        }
      ]
    })

    $('.testimonial-slider').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 1500,
      dots: true,
      pauseOnHover: true,
      arrows: false,
      prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            arrows: false,
            slidesToShow: 2,
            dots: true,
          },
        },
        {
          breakpoint: 991,
          settings: {
            arrows: false,
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 464,
          settings: {
            arrows: false,
            slidesToShow: 1,
          },
        },
      ],
    });

    $('.offer-details-thumb-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
      dots: false,
      arrows: false,
      pauseOnHover: true,
      asNavFor: '.offer-details-preview-slider'
    });

    $('.offer-details-preview-slider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
      dots: false,
      arrows: false,
      pauseOnHover: true,
      asNavFor: '.offer-details-thumb-slider',
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 3,
          }
        }
      ]
    });
    /* ==================== Slick Slider JS End ============================ */
    
    /* ==================== Add Active Class in Custom Accordion Item JS Start ====================== */
    $('.custom--accordion .accordion-item').each(function (index, accordionItem) {
      var collapse = $(accordionItem).find('.collapse')[0];
      collapse.addEventListener('show.bs.collapse', () => $(accordionItem).addClass('active'));
      collapse.addEventListener('hide.bs.collapse', () => $(accordionItem).removeClass('active'))
    });
    /* ==================== Add Active Class in Custom Accordion Item JS End ======================== */

    /* ==================== Offcanvas Sidebar JS Start ======================== */
    $('[data-toggle="offcanvas-sidebar"]').each(function (index, toggler) {
      var id = $(toggler).data('target');
      var sidebar = $(id);
      var sidebarClose = sidebar.find('.btn--close');
      var sidebarOverlay = $('.sidebar-overlay');

      var showSidebar = function () {
        $(this).addClass('show');
        sidebar.addClass('show');
        sidebarOverlay.addClass('show');
      }

      var hideSidebar = function () {
        sidebar.removeClass('show');
        sidebarOverlay.removeClass('show');
        $(toggler).removeClass('show');
      }

      $(toggler).on('click', showSidebar);
      $(sidebarOverlay).on('click', hideSidebar);
      $(sidebarClose).on('click', hideSidebar);
    });
    /* ==================== Offcanvas Sidebar JS End ========================== */

    // ==================== Play Button Lightbox Open JS Start ====================
    $('.play-btn').magnificPopup({
      type: 'iframe',
    });
    // ==================== Play Button Lightbox Open JS End ======================

    // ==================== Navbar Horizontal Scrolling JS Start ==================
    $('.nav-horizontal').each(function (index, nav) {
      var navPrev = $(nav).find('.nav-horizontal__btn.prev');
      var navNext = $(nav).find('.nav-horizontal__btn.next');
      var navMenu = $(nav).find('.nav-horizontal-menu');
      var navMenuItems = $(nav).find('.nav-horizontal-menu .nav-horizontal-menu__item');
      var navMenuItemFirst = $(nav).find('.nav-horizontal-menu .nav-horizontal-menu__item:first-child');
      var navMenuItemLast = $(nav).find('.nav-horizontal-menu .nav-horizontal-menu__item:last-child');
      var navMenuItemTotalWidth = 0;
      var navMenuScrollLeft = 0;
      var observerOptions = {
        root: navMenu[0],
        rootMargin: '1px',
        threshold: 1
      }

      var setIntersectionObserver = function (element, btn) {

        let observer = new IntersectionObserver((entries) => {

          entries.forEach(entry => {

            if (entry.intersectionRatio >= 1) {

              $(btn).removeClass('show');

            } else {

              $(btn).addClass('show');
            }

          });

        }, observerOptions);

        return observer.observe(element);
      }

      navMenu[0].scrollLeft = 0;

      setIntersectionObserver(navMenuItemFirst[0], navPrev[0]);
      setIntersectionObserver(navMenuItemLast[0], navNext[0]);

      navMenuItems.each((index, element) => navMenuItemTotalWidth += element.scrollWidth);
      navMenuScrollLeft = Math.floor(navMenuItemTotalWidth / navMenuItems.length);

      navNext.on('click', function () {
        navMenu[0].scrollLeft += navMenuScrollLeft;
      })

      navPrev.on('click', function () {
        if (navMenu[0].scrollLeft === 0) {
          return;
        }

        navMenu[0].scrollLeft -= navMenuScrollLeft;
      })

    });
    // ==================== Navbar Horizontal Scrolling JS End ====================

    // ==================== Product QTY JS Start ==================================
    $(".product-qty").each(function () {
      var qtyIncrement = $(this).find(".product-qty__increment");
      var qtyDecrement = $(this).find(".product-qty__decrement");
      var qtyValue = $(this).find(".product-qty__value");
      qtyIncrement.on("click", function () {
        var oldValue = parseFloat(qtyValue.val());
        var newVal = oldValue + 1;
        qtyValue.val(newVal).trigger("change");
      });

      qtyDecrement.on("click", function () {
        var oldValue = parseFloat(qtyValue.val());
        if (oldValue <= 0) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        qtyValue.val(newVal).trigger("change");
      });
    });
    // ==================== Product QTY JS End ====================================

    // ==================== Add A Class In Select Input JS Start ====================================
    $('.form-select.form--select').each(function (index, select) {
      $(select).on('change', function () {
        if ($(this).val()) {
          $(this).addClass('selected')
        } else {
          $(this).removeClass('selected')
        }
      });
    });
    // ==================== Add A Class In Select Input JS End ====================================
  });
  /* ==================== Ready Function End ===================== */

  /* ==================== Scroll Top JS Start ==================== */
  var scrollTopBtn = $('.scroll-top');

  scrollTopBtn.on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, '300');
  });

  $(window).scroll(function () {
    if ($(window).scrollTop() > 300) {
      scrollTopBtn.addClass('show');
    } else {
      scrollTopBtn.removeClass('show');
    }
  });
  /* ==================== Scroll Top JS End ====================== */

  /* ==================== Header Sticky JS Start ================= */
  $(window).on('scroll', function () {
    if ($(window).scrollTop() >= 300) {
      $('.header').addClass('fixed-header');
    } else {
      $('.header').removeClass('fixed-header');
    }
  });
  /* ==================== Header Sticky JS End =================== */

  /* ==================== Preloader JS Start ===================== */
  $(window).on('load', function () {
    $('.preloader').fadeOut();
  });
  /* ==================== Preloader JS End ======================= */

  /* ==================== Initialize Odometer JS Start ===================== */
  function InitOdometer() {
    $('.odometer').each(function (index, element) {

      var odometer = new Odometer({
        el: element,
        value: 0,
      })

      odometer.update($(element).data('odometer-stop'))

      $(element).isInViewport(function (status) {

        if (status === 'entered') {
          odometer.update($(element).data('odometer-stop'))
        }

        if (status === 'leaved') {
          odometer.update(0)
        }
      })
    });
  }

  $(window).on('load', InitOdometer);
  /* ==================== Initialize Odometer JS End ======================= */
})(jQuery);
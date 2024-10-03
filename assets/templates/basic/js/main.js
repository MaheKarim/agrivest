"use strict";
(function ($) {
  /* ==================== Ready Function Start =================== */

  $(document).ready(function () {
    /* ==================== Header Navbar Collapse JS Start ===================== */
    function hideNavbarCollapse() {
      new bootstrap.Collapse($(".navbar-collapse")[0]).hide();
      $(".navbar-collapse").trigger("hide.bs.collapse");
    }
    $(".navbar-collapse").on({
      "show.bs.collapse": function () {
        $("body").addClass("scroll-hide");
        $(".body-overlay").addClass("show").on("click", hideNavbarCollapse);
      },
      "hide.bs.collapse": function () {
        $("body").removeClass("scroll-hide");
        $(".body-overlay")
          .removeClass("show")
          .unbind("click", hideNavbarCollapse);
      },
    });
    /* ==================== Header Navbar Collapse JS End ======================= */

    /* ==================== Add Background Image Js Start ===================== */
    $(".bg-img").css("background-image", function () {
      var bg = "url(" + $(this).data("background-image") + ")";
      return bg;
    });
    /* ==================== Add Background Image Js End ======================= */

    /* ==================== Dynamically Add 'active' class based on current Page Start ======================= */
    function dynamicActiveMenuClass(selector) {
      let fileName = window.location.pathname.split("/").reverse()[0];

      selector.find("li").each(function () {
        let anchor = $(this).find("a");
        if ($(anchor).attr("href") == fileName) {
          $(this).addClass("active");
        }
      });

      // if any li has active element add class
      selector.children("li").each(function () {
        if ($(this).find(".active").length) {
          $(this).addClass("active");
        }

        //if any li.active has bootstrap's collapse component open it
        if ($(this).hasClass("active")) {
          $(this).find(".collapse").addClass("show");
          $(this).find('[data-bs-toggle="collapse"]').removeClass("collapsed");
          $(this)
            .find('[data-bs-toggle="collapse"]')
            .attr("aria-expanded", "false");
        }
      });

      // if no file name return
      if (fileName == "") {
        selector.find("li").eq(0).addClass("active");
      }
    }

    if ($(".header ul.nav-menu").length) {
      dynamicActiveMenuClass($(".header ul.nav-menu"));
    }

    if ($("ul.offcanvas-sidebar-menu").length) {
      dynamicActiveMenuClass($("ul.offcanvas-sidebar-menu"));
    }
    /* ==================== Dynamically Add 'active' class based on current Page End ======================= */

    /* ==================== Password Toggle JS Start ======================= */
    $(".input--group-password").each(function (index, inputGroup) {
      var inputGroupBtn = $(inputGroup).find(".input-group-btn");
      var formControl = $(inputGroup).find(".form-control.form--control");

      inputGroupBtn.on("click", function () {
        if (formControl.attr("type") === "password") {
          formControl.attr("type", "text");
          $(this).find("i").removeClass("fa-eye -slash").addClass("fa-eye");
        } else {
          formControl.attr("type", "password");
          $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");
        }
      });
    });
    /* ==================== Password Toggle JS End ========================= */

    /* ==================== Add Active Class in Custom Accordion Item JS Start ====================== */
    $(".custom--accordion .accordion-item").each(function (
      index,
      accordionItem
    ) {
      var collapse = $(accordionItem).find(".collapse")[0];
      collapse.addEventListener("show.bs.collapse", () =>
        $(accordionItem).addClass("active")
      );
      collapse.addEventListener("hide.bs.collapse", () =>
        $(accordionItem).removeClass("active")
      );
    });
    /* ==================== Add Active Class in Custom Accordion Item JS End ======================== */

    /* ==================== Offcanvas Sidebar JS Start ======================== */
    $('[data-toggle="offcanvas-sidebar"]').each(function (index, toggler) {
      var id = $(toggler).data("target");
      var sidebar = $(id);
      var sidebarClose = sidebar.find(".btn--close");
      var sidebarOverlay = $(".sidebar-overlay");

      var showSidebar = function () {
        $(this).addClass("show");
        sidebar.addClass("show");
        sidebarOverlay.addClass("show");
        $("body").addClass("scroll-hide");
      };

      var hideSidebar = function () {
        sidebar.removeClass("show");
        sidebarOverlay.removeClass("show");
        $(toggler).removeClass("show");
        $("body").removeClass("scroll-hide");
      };

      $(toggler).on("click", showSidebar);
      $(sidebarOverlay).on("click", hideSidebar);
      $(sidebarClose).on("click", hideSidebar);
    });
    /* ==================== Offcanvas Sidebar JS End ========================== */

    // ==================== Add A Class In Select Input JS Start ====================================
    $(".form-select.form--select").each(function (index, select) {
      $(select).on("change", function () {
        if ($(this).val()) {
          $(this).addClass("selected");
        } else {
          $(this).removeClass("selected");
        }
      });
    });
    // ==================== Add A Class In Select Input JS End ====================================

    // ========================== Overflow Content Js Start ======================
    $('[data-toggle="overflow-content"]').each((index, element) => {
      let content = $(element);
      let button = $(content.data("target"));
      if (content[0].scrollHeight > content[0].clientHeight) {
        button.addClass("show");
      }
      button.on("click", function () {
        content.toggleClass("show");
        if (content.hasClass("show")) {
          button.find("span").text("See less");
          button.find("i").removeClass("la-angle-up").addClass("la-angle-down");
        } else {
          button.find("span").text("See more");
          button.find("i").removeClass("la-angle-down").addClass("la-angle-up");
        }
      });
    });
    // ========================== Overflow Content Js End ========================
  });

  /* ==================== Ready Function End ===================== */

  /* ==================== Scroll Top JS Start ==================== */
  var scrollTopBtn = $(".scroll-top");

  scrollTopBtn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });

  $(window).scroll(function () {
    if ($(window).scrollTop() >= 350) {
      scrollTopBtn.addClass("show");
    } else {
      scrollTopBtn.removeClass("show");
    }
  });

  /* ==================== Scroll Top JS End ====================== */

  /* ==================== Header Sticky JS Start ================= */

  $(window).on("scroll", function () {
    if ($(window).scrollTop() >= 185) {
      $(".header").addClass("fixed-header");
    } else {
      $(".header").removeClass("fixed-header");
    }
  });

  /* ==================== Header Sticky JS End =================== */

  /* ==================== Preloader JS Start ===================== */
  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });
  /* ==================== Preloader JS End ======================= */

  /* ==================== Initialize Odometer JS Start ===================== */

  /* ==================== Initialize Odometer JS End ======================= */
})(jQuery);

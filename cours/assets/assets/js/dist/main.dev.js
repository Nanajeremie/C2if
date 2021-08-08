"use strict";

(function ($) {
  "use strict"; // Start of use strict
  // Toggle the side navigation

  $("#sidebarToggle, #sidebarToggleTop, #sidebarToggleTop1").on('click', function (e) {
    e.preventDefault();
    $(".sidebar").toggleClass("toggled");
  });

  if ($(window).width() < 768) {
    $('.sidebar').toggleClass("toggled");
  }

  ; // Close any open menu accordions when window is resized below 768px

  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    }

    ;
  });
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar').toggleClass("toggled");
    }

    ;
  }); // Prevent the content wrapper from scrolling when the fixed side navigation hovered over

  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  }); // Scroll to top button appear

  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();

    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  }); // Smooth scrolling using jQuery easing

  $(document).on('click', 'a.scroll-to-top', function (e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: $($anchor.attr('href')).offset().top
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });
})(jQuery); 

var wow = new WOW({
  boxClass: 'wow',
  // animated element css class (default is wow)
  animateClass: 'animated',
  // animation css class (default is animated)
  offset: 0,
  // distance to the element when triggering the animation (default is 0)
  mobile: true,
  // trigger animations on mobile devices (default is true)
  live: true,
  // act on asynchronously loaded content (default is true)
  callback: function callback(box) {// the callback is fired every time an animation is started
    // the argument that is passed in is the DOM node being animated
  },
  scrollContainer: null,
  // optional scroll container selector, otherwise use window,
  resetAnimation: true // reset animation on end (default is true)

});
wow.init();
/*
// -----------------------------------------Data Tables--------------------------------------
function data(identifiant) 
{
$(document).ready(function() {
  $('#'+identifiant).DataTable( {

    lengthMenu : [[10, 20, 30, 40 , 50, 60, 70, 80, 90, 100, -1], [10, 20, 30, 40 , 50, 60, 70, 80, 90, 100, "Tous"]],

          "ordering" : true,
          "info": true,
          "autoWidth": false,
          "responsive": true,

    initComplete: function (){
      this.api().columns().every(function (){
        var column = this;
        var select = $('<select class="custom-select"><option value=""></option> </select>').appendTo($(column.footer()).empty()).on('change', function (){
          var val = $.fn.dataTable.util.escapeRegex( $(this).val() );
          column.search(val ? '^' + val + '$' : '', true, false).draw();
        });
        column.data().unique().sort().each(function (d, j){
          select.append('<option value="' +d+ '">' +d+ '</option>')
        });
      });
    },
    //Choix du language
    "language": {"url": "////cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"}
  });
});
}

data('table_classe');

*/
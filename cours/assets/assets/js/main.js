(function($) {
    "use strict"; // Start of use strict
  
    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop, #sidebarToggleTop1").on('click', function(e) {
        e.preventDefault();
      $(".sidebar").toggleClass("toggled");
     
    });

    if ($(window).width() < 768) {
      $('.sidebar').toggleClass("toggled");
    };

    // Close any open menu accordions when window is resized below 768px
    // $(window).resize(function() {
    //     if ($(window).width() < 768) {
    //       $('.sidebar .collapse').collapse('hide');
    //     };
    //   }); 

    // $(window).resize(function() {
    //     if ($(window).width() < 768) {
    //       $('.sidebar').toggleClass("toggled");
    //     };
    //   });
    
      
        
     
    
    //   // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    //   $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    //     if ($(window).width() > 768) {
    //       var e0 = e.originalEvent,
    //         delta = e0.wheelDelta || -e0.detail;
    //       this.scrollTop += (delta < 0 ? 1 : -1) * 30;
    //       e.preventDefault();
    //     }
    //   });
      
    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
          $('.scroll-to-top').fadeIn();
        } else {
          $('.scroll-to-top').fadeOut();
        }
      });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
          scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
      });

})(jQuery);

var wow = new WOW(
  {
      boxClass:     'wow',      // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated)
      offset:       0,          // distance to the element when triggering the animation (default is 0)
      mobile:       true,       // trigger animations on mobile devices (default is true)
      live:         true,       // act on asynchronously loaded content (default is true)
      callback:     function(box) {
          // the callback is fired every time an animation is started
          // the argument that is passed in is the DOM node being animated
      },
      scrollContainer: null,    // optional scroll container selector, otherwise use window,
      resetAnimation: true,     // reset animation on end (default is true)
  }
);
wow.init();

// -----------------------------------------Data Tables--------------------------------------
function data(identifiant) 
{
    $(document).ready(function() {
        $('#'+identifiant).DataTable( {

            lengthMenu : [[10, 20, 30, 40 , 50, 60, 70, 80, 90, 100, -1], [10, 20, 30, 40 , 50, 60, 70, 80, 90, 100, "Tous"]],

                "info": true,
                "autoWidth" : true,
                "responsive" : true,
                "buttons": ["copy", "csv", "excel", "print", "colvis"],

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
            //"language": {"url": "////cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"}
        }).buttons().container().appendTo('#table_wrapper .row:eq(0)');
    });
}

function data1(identifiant) 
{
    $(document).ready(function() {
        $('#'+identifiant).DataTable( {

            lengthMenu : [[10, 20, 30, 40 , 50, 60, 70, 80, 90, 100, -1], [10, 20, 30, 40 , 50, 60, 70, 80, 90, 100, "Tous"]],

                "ordering" : true,
                "info": true,
                "autoWidth" : true,
                "responsive" : true,

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
            //"language": {"url": "////cdn.datatables.net/plug-ins/1.10.20/i18n/French.json"}
        })
    });
}

data("table");
data1("table1");



// -----------------------------------------Impression--------------------------------------

(function($) {
  function appendContent($el, content) {
      if (!content) return;

      // Simple test for a jQuery element
      $el.append(content.jquery ? content.clone() : content);
  }

  function appendBody($body, $element, opt) {
      // Clone for safety and convenience
      // Calls clone(withDataAndEvents = true) to copy form values.
      var $content = $element.clone(opt.formValues);

      if (opt.formValues) {
          // Copy original select and textarea values to their cloned counterpart
          // Makes up for inability to clone select and textarea values with clone(true)
          copyValues($element, $content, 'select, textarea');
      }

      if (opt.removeScripts) {
          $content.find('script').remove();
      }

      if (opt.printContainer) {
          // grab $.selector as container
          $content.appendTo($body);
      } else {
          // otherwise just print interior elements of container
          $content.each(function() {
              $(this).children().appendTo($body)
          });
      }
  }

  // Copies values from origin to clone for passed in elementSelector
  function copyValues(origin, clone, elementSelector) {
      var $originalElements = origin.find(elementSelector);

      clone.find(elementSelector).each(function(index, item) {
          $(item).val($originalElements.eq(index).val());
      });
  }

  var opt;
  $.fn.printThis = function(options) {
      opt = $.extend({}, $.fn.printThis.defaults, options);
      var $element = this instanceof jQuery ? this : $(this);

      var strFrameName = "printThis-" + (new Date()).getTime();

      if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {
          // Ugly IE hacks due to IE not inheriting document.domain from parent
          // checks if document.domain is set by comparing the host name against document.domain
          var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";
          var printI = document.createElement('iframe');
          printI.name = "printIframe";
          printI.id = strFrameName;
          printI.className = "MSIE";
          document.body.appendChild(printI);
          printI.src = iframeSrc;

      } else {
          // other browsers inherit document.domain, and IE works if document.domain is not explicitly set
          var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");
          $frame.appendTo("body");
      }

      var $iframe = $("#" + strFrameName);

      // show frame if in debug mode
      if (!opt.debug) $iframe.css({
          position: "absolute",
          width: "0px",
          height: "0px",
          left: "-600px",
          top: "-600px"
      });

      // before print callback
      if (typeof opt.beforePrint === "function") {
          opt.beforePrint();
      }

      // $iframe.ready() and $iframe.load were inconsistent between browsers
      setTimeout(function() {

          // Add doctype to fix the style difference between printing and render
          function setDocType($iframe, doctype){
              var win, doc;
              win = $iframe.get(0);
              win = win.contentWindow || win.contentDocument || win;
              doc = win.document || win.contentDocument || win;
              doc.open();
              doc.write(doctype);
              doc.close();
          }

          if (opt.doctypeString){
              setDocType($iframe, opt.doctypeString);
          }

          var $doc = $iframe.contents(),
              $head = $doc.find("head"),
              $body = $doc.find("body"),
              $base = $('base'),
              baseURL;

          // add base tag to ensure elements use the parent domain
          if (opt.base === true && $base.length > 0) {
              // take the base tag from the original page
              baseURL = $base.attr('href');
          } else if (typeof opt.base === 'string') {
              // An exact base string is provided
              baseURL = opt.base;
          } else {
              // Use the page URL as the base
              baseURL = document.location.protocol + '//' + document.location.host;
          }

          $head.append('<base href="' + baseURL + '">');

          // import page stylesheets
          if (opt.importCSS) $("link[rel=stylesheet]").each(function() {
              var href = $(this).attr("href");
              if (href) {
                  var media = $(this).attr("media") || "all";
                  $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");
              }
          });

          // import style tags
          if (opt.importStyle) $("style").each(function() {
              $head.append(this.outerHTML);
          });

          // add title of the page
          if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");

          // import additional stylesheet(s)
          if (opt.loadCSS) {
              if ($.isArray(opt.loadCSS)) {
                  jQuery.each(opt.loadCSS, function(index, value) {
                      $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");
                  });
              } else {
                  $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");
              }
          }

          var pageHtml = $('html')[0];

          // CSS VAR in html tag when dynamic apply e.g.  document.documentElement.style.setProperty("--foo", bar);
          $doc.find('html').prop('style', pageHtml.style.cssText);

          // copy 'root' tag classes
          var tag = opt.copyTagClasses;
          if (tag) {
              tag = tag === true ? 'bh' : tag;
              if (tag.indexOf('b') !== -1) {
                  $body.addClass($('body')[0].className);
              }
              if (tag.indexOf('h') !== -1) {
                  $doc.find('html').addClass(pageHtml.className);
              }
          }

          // print header
          appendContent($body, opt.header);

          if (opt.canvas) {
              // add canvas data-ids for easy access after cloning.
              var canvasId = 0;
              // .addBack('canvas') adds the top-level element if it is a canvas.
              $element.find('canvas').addBack('canvas').each(function(){
                  $(this).attr('data-printthis', canvasId++);
              });
          }

          appendBody($body, $element, opt);

          if (opt.canvas) {
              // Re-draw new canvases by referencing the originals
              $body.find('canvas').each(function(){
                  var cid = $(this).data('printthis'),
                      $src = $('[data-printthis="' + cid + '"]');

                  this.getContext('2d').drawImage($src[0], 0, 0);

                  // Remove the markup from the original
                  if ($.isFunction($.fn.removeAttr)) {
                      $src.removeAttr('data-printthis');
                  } else {
                      $.each($src, function(i, el) {
                          el.removeAttribute('data-printthis');
                      });
                  }
              });
          }

          // remove inline styles
          if (opt.removeInline) {
              // Ensure there is a selector, even if it's been mistakenly removed
              var selector = opt.removeInlineSelector || '*';
              // $.removeAttr available jQuery 1.7+
              if ($.isFunction($.removeAttr)) {
                  $body.find(selector).removeAttr("style");
              } else {
                  $body.find(selector).attr("style", "");
              }
          }

          // print "footer"
          appendContent($body, opt.footer);

          // attach event handler function to beforePrint event
          function attachOnBeforePrintEvent($iframe, beforePrintHandler) {
              var win = $iframe.get(0);
              win = win.contentWindow || win.contentDocument || win;

              if (typeof beforePrintHandler === "function") {
                  if ('matchMedia' in win) {
                      win.matchMedia('print').addListener(function(mql) {
                          if(mql.matches)  beforePrintHandler();
                      });
                  } else {
                      win.onbeforeprint = beforePrintHandler;
                  }
              }
          }
          attachOnBeforePrintEvent($iframe, opt.beforePrintEvent);

          setTimeout(function() {
              if ($iframe.hasClass("MSIE")) {
                  // check if the iframe was created with the ugly hack
                  // and perform another ugly hack out of neccessity
                  window.frames["printIframe"].focus();
                  $head.append("<script>  window.print(); </s" + "cript>");
              } else {
                  // proper method
                  if (document.queryCommandSupported("print")) {
                      $iframe[0].contentWindow.document.execCommand("print", false, null);
                  } else {
                      $iframe[0].contentWindow.focus();
                      $iframe[0].contentWindow.print();
                  }
              }

              // remove iframe after print
              if (!opt.debug) {
                  setTimeout(function() {
                      $iframe.remove();

                  }, 1000);
              }

              // after print callback
              if (typeof opt.afterPrint === "function") {
                  opt.afterPrint();
              }

          }, opt.printDelay);

      }, 333);

  };
$.fn.printThis.defaults = {
  debug: false,               // show the iframe for debugging
  importCSS: true,            // import parent page css
  importStyle: false,         // import style tags
  printContainer: true,       // print outer container/$.selector
  loadCSS: "",                // path to additional css file - use an array [] for multiple
  pageTitle: "",              // add title to print page
  removeInline: false,        // remove inline styles from print elements
  removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
  printDelay: 33,            // variable print delay
  header: null,               // prefix to html
  footer: null,               // postfix to html
  base: false,                // preserve the BASE tag or accept a string for the URL
  formValues: true,           // preserve input/form values
  canvas: false,              // copy canvas content
  doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
  removeScripts: false,       // remove script tags from print content
  copyTagClasses: false,      // copy classes from the html & body tag
  beforePrintEvent: null,     // callback function for printEvent in iframe
  beforePrint: null,          // function called before iframe is filled
  afterPrint: null          // function called before iframe is removed
};
})(jQuery);

function print(id_button , zone_a_imprimer) 
{
  $('#'+id_button).click(function () {
    $('#'+zone_a_imprimer).printThis({
          debug: false,
          importCSS: true,
          importStyle: false,
          printContainer: true,
          loadCSS: ["http://localhost/Opensch_final_version/Web-Application-Coding/assets/library/bootstrap4/css/bootstrap.min.css", "http://localhost/Opensch_final_version/Web-Application-Coding/assets/css/style.css"],
          pageTitle: "",
          removeInline: false,
          printDelay: 333,
          header: null,
          footer: null,
          base: false,
          formValues: true,
          canvas: false,
          doctypeString: '',
          removeScripts: false,
          copyTagClasses: false
    });

  })
}

// ---------------------------------------------- Chart Js ----------------------------------------

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

  
function chart_multi(id , x_data , x_label_1 , x_label_2 = '' , data_1 = [] , data_2 =[] , cfa = '' , type_1 , type_2) {
    // Statistique du niveau des administrateurs
    id = document.getElementById(id);
    var users = new Chart(id, 
    {
        type: type_1,

        data: 
        {
            labels: x_data,
            
            datasets: 
            [ 
                {
                    label: x_label_1,
                    backgroundColor: "rgba(114, 230, 93, .0)",
                    borderColor: "#72e65d",
                    data: data_1,
                        pointBackgroundColor: "rgba(255, 255, 255)",
                        pointBorderColor: "rgba(114, 240, 93, .8)",
                        pointHoverBackgroundColor: "rgba(114, 240, 93, .8)",
                        pointHoverBorderColor: "rgba(255, 255, 255)",
                        type: type_2,
                        order:1,
                },

                {
                    label: x_label_2,
                    data: data_2,
                    backgroundColor: "rgba(0, 191, 255, .3)",
                    borderColor: "#00bfff",
                    order:2,
                }
            
            ],
        },

        options: 
        {
            maintainAspectRatio: false,
            layout: 
            {
                padding: 
                {
                    left: 10, right: 25, top: 25, bottom: 0
                }
            },

            scales: 
            {
                xAxes: 
                [
                    {
                        time: 
                        {
                        unit: 'date'
                        },

                        gridLines: 
                        {
                        display: true,
                        drawBorder: false
                        },

                        ticks: 
                        {
                        maxTicksLimit: 12
                        }
                    }
                ],

                yAxes: 
                [
                    {
                        ticks: 
                        {
                            beginAtZero: true,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) 
                            {
                                return number_format(value) + ' ' + cfa;
                            }
                        },

                        gridLines: 
                        {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        display: true,
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                        }
                    }
                ],
            },

            legend: 
            {
                display: true,
                position: 'bottom',
                padding: 30,
            },

            tooltips: 
            {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                
            }

        }
    })
}

function chart(id , x_data , x_label , data , cfa = '' ,type) {
    // Statistique du niveau des administrateurs
    id = document.getElementById(id);
    var users = new Chart(id , 
    {
        type: type,

        data: 
        {
            labels: x_data,
            
            datasets: 
            [ 
                {
                    label: x_label,
                    backgroundColor: "rgba(0, 191, 255, .3)",
                    borderColor: "#00bfff",
                    data: data,
                        pointBackgroundColor: "rgba(255, 255, 255)",
                        pointBorderColor: "rgba(114, 240, 93, .8)",
                        pointHoverBackgroundColor: "rgba(114, 240, 93, .8)",
                        pointHoverBorderColor: "rgba(255, 255, 255)",
                        type: 'line',
                        order:1,
                },
            
            ],
        },

        options: 
        {
            maintainAspectRatio: false,
            layout: 
            {
                padding: 
                {
                    left: 10, right: 25, top: 25, bottom: 0
                }
            },

            scales: 
            {
                xAxes: 
                [
                    {
                        time: 
                        {
                        unit: 'date'
                        },

                        gridLines: 
                        {
                        display: true,
                        drawBorder: false
                        },

                        ticks: 
                        {
                        maxTicksLimit: 12
                        }
                    }
                ],

                yAxes: 
                [
                    {
                        ticks: 
                        {
                            beginAtZero: true,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) 
                            {
                                return number_format(value) + ' ' + cfa;
                            }
                        },

                        gridLines: 
                        {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        display: true,
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                        }
                    }
                ],
            },

            legend: 
            {
                display: true,
                position: 'bottom',
                padding: 30,
            },

            tooltips: 
            {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
              
            }

        }
    })
}

function chart_pie(id , labels , data ,type = 'doughnut') {
    // Statistique du niveau des administrateurs
    id = document.getElementById(id);
    var myPieChart = new Chart(id , {
      type: type,
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: ['#1cc88a', '#dc3545'],
          hoverBackgroundColor: ['#17a673', '#c82333'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,

        animation : {
            animateRotate :true,
        },

        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },

        legend: {
          display: true
        },

        cutoutPercentage: 0,
      },
    });
    
}



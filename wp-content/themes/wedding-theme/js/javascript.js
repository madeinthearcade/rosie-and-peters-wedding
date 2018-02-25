/* =======================================================
  Scripts
  ======================================================= */

(function ($, root, undefined) {

  	$(function () {

      $("#menu-btn ").on('click',function(e){
         e.preventDefault();
         $(".main-header__nav").slideToggle();
      });

      $("a[href*=#]:not([href=#])").click(function() {
         if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
            var target = $(this.hash),
            headerHeight = $(".main-header").height() + 5; // Get fixed header height
            target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
               $("html,body").animate({ scrollTop: target.offset().top - headerHeight }, 500);
               return false;
            }
         }
      });

      $(window).scroll(function() {
         var scroll = $(window).scrollTop();
         if (scroll >= 50) {
            $(".main-header").addClass("main-header--fixed");
         } else {
            $(".main-header").removeClass("main-header--fixed");
         }
      });

      $(".animsition").animsition({
         inClass: "fade-in",
         outClass: "fade-out-",
         inDuration: 1500,
         outDuration: 800,
         linkElement: "#main-navigation > ul > li > a",
         loading: true,
         loadingParentElement: "body",
         loadingClass: "animsition-loading",
         loadingInner: "",
         timeout: true,
         timeoutCountdown: 5000,
         onLoadEvent: true,
         browser: ["animation-duration", "-webkit-animation-duration"],
         overlay: false,
         overlayClass: "animsition-overlay-slide",
         overlayParentElement: "body",
         transition: function(url) {
            window.location.href = url;
         }
      });      

      var wow = new WOW(
         {
            boxClass:     'wow',
            animateClass: 'animated',
            offset:       0,
            mobile:       false,
            live:         true,
            callback:     function(box) {
               // the callback is fired every time an animation is started
               // the argument that is passed in is the DOM node being animated
            },
            scrollContainer: null
         }
      );
      wow.init();

  	});
})(jQuery, this);

if (!Modernizr.objectfit) {
   $(".flex__item").each(function() {
   var $container = $(this),
      imgUrl = $container.find("img").prop("src");
      if (imgUrl) {
         $container
         .css("backgroundImage", "url(" + imgUrl + ")")
         .addClass("compat-object-fit");
      }
   });
}
/* =======================================================
  Scripts
  ======================================================= */

  (function ($, root, undefined) {

  	$(function () {

  		$("li.menu-item-has-children").unbind('click').click(function(){
  			$(this).siblings().children(".sub-menu").hide("fast");
  			$(this).children(".sub-menu").slideToggle("fast");
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
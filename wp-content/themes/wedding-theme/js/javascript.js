/* =======================================================
  Vendor Scripts
  ======================================================= */

/*! modernizr 3.3.1 (Custom Build) | MIT *
* https://modernizr.com/download/?-mq-setclasses !*/
!function(e,n,t){function o(e,n){return typeof e===n}function a(){var e,n,t,a,s,i,r;for(var l in d)if(d.hasOwnProperty(l)){if(e=[],n=d[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(a=o(n.fn,"function")?n.fn():n.fn,s=0;s<e.length;s++)i=e[s],r=i.split("."),1===r.length?Modernizr[r[0]]=a:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=a),f.push((a?"":"no-")+r.join("-"))}}function s(e){var n=u.className,t=Modernizr._config.classPrefix||"";if(p&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),p?u.className.baseVal=n:u.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):p?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function r(){var e=n.body;return e||(e=i(p?"svg":"body"),e.fake=!0),e}function l(e,t,o,a){var s,l,f,d,c="modernizr",p=i("div"),m=r();if(parseInt(o,10))for(;o--;)f=i("div"),f.id=a?a[o]:c+(o+1),p.appendChild(f);return s=i("style"),s.type="text/css",s.id="s"+c,(m.fake?m:p).appendChild(s),m.appendChild(p),s.styleSheet?s.styleSheet.cssText=e:s.appendChild(n.createTextNode(e)),p.id=c,m.fake&&(m.style.background="",m.style.overflow="hidden",d=u.style.overflow,u.style.overflow="hidden",u.appendChild(m)),l=t(p,e),m.fake?(m.parentNode.removeChild(m),u.style.overflow=d,u.offsetHeight):p.parentNode.removeChild(p),!!l}var f=[],d=[],c={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){d.push({name:e,fn:n,options:t})},addAsyncTest:function(e){d.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=c,Modernizr=new Modernizr;var u=n.documentElement,p="svg"===u.nodeName.toLowerCase(),m=function(){var n=e.matchMedia||e.msMatchMedia;return n?function(e){var t=n(e);return t&&t.matches||!1}:function(n){var t=!1;return l("@media "+n+" { #modernizr { position: absolute; } }",function(n){t="absolute"==(e.getComputedStyle?e.getComputedStyle(n,null):n.currentStyle).position}),t}}();c.mq=m,a(),s(f),delete c.addTest,delete c.addAsyncTest;for(var h=0;h<Modernizr._q.length;h++)Modernizr._q[h]();e.Modernizr=Modernizr}(window,document);

// DOM.event.move
//
// 2.0.0
//
// Stephen Band
//
// Triggers 'movestart', 'move' and 'moveend' events after
// mousemoves following a mousedown cross a distance threshold,
// similar to the native 'dragstart', 'drag' and 'dragend' events.
// Move events are throttled to animation frames. Move event objects
// have the properties:
//
// pageX:
// pageY:     Page coordinates of pointer.
// startX:
// startY:    Page coordinates of pointer at movestart.
// distX:
// distY:     Distance the pointer has moved since movestart.
// deltaX:
// deltaY:    Distance the finger has moved since last event.
// velocityX:
// velocityY: Average velocity over last few events.


(function(fn) {
  if (typeof define === 'function' && define.amd) {
        define([], fn);
    } else if ((typeof module !== "undefined" && module !== null) && module.exports) {
        module.exports = fn;
  } else {
    fn();
  }
})(function(){
  var assign = Object.assign || window.jQuery && jQuery.extend;

  // Number of pixels a pressed pointer travels before movestart
  // event is fired.
  var threshold = 8;

  // Shim for requestAnimationFrame, falling back to timer. See:
  // see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
  var requestFrame = (function(){
    return (
      window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimationFrame ||
      function(fn, element){
        return window.setTimeout(function(){
          fn();
        }, 25);
      }
    );
  })();

  var ignoreTags = {
      textarea: true,
      input: true,
      select: true,
      button: true
    };

  var mouseevents = {
    move:   'mousemove',
    cancel: 'mouseup dragstart',
    end:    'mouseup'
  };

  var touchevents = {
    move:   'touchmove',
    cancel: 'touchend',
    end:    'touchend'
  };

  var rspaces = /\s+/;


  // DOM Events

  var eventOptions = { bubbles: true, cancelable: true };

  var eventsSymbol = Symbol('events');

  function createEvent(type) {
    return new CustomEvent(type, eventOptions);
  }

  function getEvents(node) {
    return node[eventsSymbol] || (node[eventsSymbol] = {});
  }

  function on(node, types, fn, data, selector) {
    types = types.split(rspaces);

    var events = getEvents(node);
    var i = types.length;
    var handlers, type;

    function handler(e) { fn(e, data); }

    while (i--) {
      type = types[i];
      handlers = events[type] || (events[type] = []);
      handlers.push([fn, handler]);
      node.addEventListener(type, handler);
    }
  }

  function off(node, types, fn, selector) {
    types = types.split(rspaces);

    var events = getEvents(node);
    var i = types.length;
    var type, handlers, k;

    if (!events) { return; }

    while (i--) {
      type = types[i];
      handlers = events[type];
      if (!handlers) { continue; }
      k = handlers.length;
      while (k--) {
        if (handlers[k][0] === fn) {
          node.removeEventListener(type, handlers[k][1]);
          handlers.splice(k, 1);
        }
      }
    }
  }

  function trigger(node, type, properties) {
    // Don't cache events. It prevents you from triggering an event of a
    // given type from inside the handler of another event of that type.
    var event = createEvent(type);
    if (properties) { assign(event, properties); }
    node.dispatchEvent(event);
  }


  // Constructors

  function Timer(fn){
    var callback = fn,
        active = false,
        running = false;

    function trigger(time) {
      if (active){
        callback();
        requestFrame(trigger);
        running = true;
        active = false;
      }
      else {
        running = false;
      }
    }

    this.kick = function(fn) {
      active = true;
      if (!running) { trigger(); }
    };

    this.end = function(fn) {
      var cb = callback;

      if (!fn) { return; }

      // If the timer is not running, simply call the end callback.
      if (!running) {
        fn();
      }
      // If the timer is running, and has been kicked lately, then
      // queue up the current callback and the end callback, otherwise
      // just the end callback.
      else {
        callback = active ?
          function(){ cb(); fn(); } :
          fn ;

        active = true;
      }
    };
  }


  // Functions

  function noop() {}

  function preventDefault(e) {
    e.preventDefault();
  }

  function isIgnoreTag(e) {
    return !!ignoreTags[e.target.tagName.toLowerCase()];
  }

  function isPrimaryButton(e) {
    // Ignore mousedowns on any button other than the left (or primary)
    // mouse button, or when a modifier key is pressed.
    return (e.which === 1 && !e.ctrlKey && !e.altKey);
  }

  function identifiedTouch(touchList, id) {
    var i, l;

    if (touchList.identifiedTouch) {
      return touchList.identifiedTouch(id);
    }

    // touchList.identifiedTouch() does not exist in
    // webkit yet… we must do the search ourselves...

    i = -1;
    l = touchList.length;

    while (++i < l) {
      if (touchList[i].identifier === id) {
        return touchList[i];
      }
    }
  }

  function changedTouch(e, data) {
    var touch = identifiedTouch(e.changedTouches, data.identifier);

    // This isn't the touch you're looking for.
    if (!touch) { return; }

    // Chrome Android (at least) includes touches that have not
    // changed in e.changedTouches. That's a bit annoying. Check
    // that this touch has changed.
    if (touch.pageX === data.pageX && touch.pageY === data.pageY) { return; }

    return touch;
  }


  // Handlers that decide when the first movestart is triggered

  function mousedown(e){
    // Ignore non-primary buttons
    if (!isPrimaryButton(e)) { return; }

    // Ignore form and interactive elements
    if (isIgnoreTag(e)) { return; }

    on(document, mouseevents.move, mousemove, e);
    on(document, mouseevents.cancel, mouseend, e);
  }

  function mousemove(e, data){
    checkThreshold(e, data, e, removeMouse);
  }

  function mouseend(e, data) {
    removeMouse();
  }

  function removeMouse() {
    off(document, mouseevents.move, mousemove);
    off(document, mouseevents.cancel, mouseend);
  }

  function touchstart(e) {
    // Don't get in the way of interaction with form elements
    if (ignoreTags[e.target.tagName.toLowerCase()]) { return; }

    var touch = e.changedTouches[0];

    // iOS live updates the touch objects whereas Android gives us copies.
    // That means we can't trust the touchstart object to stay the same,
    // so we must copy the data. This object acts as a template for
    // movestart, move and moveend event objects.
    var data = {
      target:     touch.target,
      pageX:      touch.pageX,
      pageY:      touch.pageY,
      identifier: touch.identifier,

      // The only way to make handlers individually unbindable is by
      // making them unique.
      touchmove:  function(e, data) { touchmove(e, data); },
      touchend:   function(e, data) { touchend(e, data); }
    };

    on(document, touchevents.move, data.touchmove, data);
    on(document, touchevents.cancel, data.touchend, data);
  }

  function touchmove(e, data) {
    var touch = changedTouch(e, data);
    if (!touch) { return; }
    checkThreshold(e, data, touch, removeTouch);
  }

  function touchend(e, data) {
    var touch = identifiedTouch(e.changedTouches, data.identifier);
    if (!touch) { return; }
    removeTouch(data);
  }

  function removeTouch(data) {
    off(document, touchevents.move, data.touchmove);
    off(document, touchevents.cancel, data.touchend);
  }

  function checkThreshold(e, data, touch, fn) {
    var distX = touch.pageX - data.pageX;
    var distY = touch.pageY - data.pageY;

    // Do nothing if the threshold has not been crossed.
    if ((distX * distX) + (distY * distY) < (threshold * threshold)) { return; }

    triggerStart(e, data, touch, distX, distY, fn);
  }

  function triggerStart(e, data, touch, distX, distY, fn) {
    var touches = e.targetTouches;
    var time = e.timeStamp - data.timeStamp;

    // Create a movestart object with some special properties that
    // are passed only to the movestart handlers.
    var template = {
      altKey:     e.altKey,
      ctrlKey:    e.ctrlKey,
      shiftKey:   e.shiftKey,
      startX:     data.pageX,
      startY:     data.pageY,
      distX:      distX,
      distY:      distY,
      deltaX:     distX,
      deltaY:     distY,
      pageX:      touch.pageX,
      pageY:      touch.pageY,
      velocityX:  distX / time,
      velocityY:  distY / time,
      identifier: data.identifier,
      targetTouches: touches,
      finger: touches ? touches.length : 1,
      enableMove: function() {
        this.moveEnabled = true;
        this.enableMove = noop;
        e.preventDefault();
      }
    };

    // Trigger the movestart event.
    trigger(data.target, 'movestart', template);

    // Unbind handlers that tracked the touch or mouse up till now.
    fn(data);
  }


  // Handlers that control what happens following a movestart

  function activeMousemove(e, data) {
    var timer  = data.timer;

    data.touch = e;
    data.timeStamp = e.timeStamp;
    timer.kick();
  }

  function activeMouseend(e, data) {
    var target = data.target;
    var event  = data.event;
    var timer  = data.timer;

    removeActiveMouse();

    endEvent(target, event, timer, function() {
      // Unbind the click suppressor, waiting until after mouseup
      // has been handled.
      setTimeout(function(){
        off(target, 'click', preventDefault);
      }, 0);
    });
  }

  function removeActiveMouse() {
    off(document, mouseevents.move, activeMousemove);
    off(document, mouseevents.end, activeMouseend);
  }

  function activeTouchmove(e, data) {
    var event = data.event;
    var timer = data.timer;
    var touch = changedTouch(e, event);

    if (!touch) { return; }

    // Stop the interface from gesturing
    e.preventDefault();

    event.targetTouches = e.targetTouches;
    data.touch = touch;
    data.timeStamp = e.timeStamp;

    timer.kick();
  }

  function activeTouchend(e, data) {
    var target = data.target;
    var event  = data.event;
    var timer  = data.timer;
    var touch  = identifiedTouch(e.changedTouches, event.identifier);

    // This isn't the touch you're looking for.
    if (!touch) { return; }

    removeActiveTouch(data);
    endEvent(target, event, timer);
  }

  function removeActiveTouch(data) {
    off(document, touchevents.move, data.activeTouchmove);
    off(document, touchevents.end, data.activeTouchend);
  }


  // Logic for triggering move and moveend events

  function updateEvent(event, touch, timeStamp) {
    var time = timeStamp - event.timeStamp;

    event.distX =  touch.pageX - event.startX;
    event.distY =  touch.pageY - event.startY;
    event.deltaX = touch.pageX - event.pageX;
    event.deltaY = touch.pageY - event.pageY;

    // Average the velocity of the last few events using a decay
    // curve to even out spurious jumps in values.
    event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
    event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
    event.pageX =  touch.pageX;
    event.pageY =  touch.pageY;
  }

  function endEvent(target, event, timer, fn) {
    timer.end(function(){
      trigger(target, 'moveend', event);
      return fn && fn();
    });
  }


  // Set up the DOM

  function movestart(e) {
    if (e.defaultPrevented) { return; }
    if (!e.moveEnabled) { return; }

    var event = {
      startX:        e.startX,
      startY:        e.startY,
      pageX:         e.pageX,
      pageY:         e.pageY,
      distX:         e.distX,
      distY:         e.distY,
      deltaX:        e.deltaX,
      deltaY:        e.deltaY,
      velocityX:     e.velocityX,
      velocityY:     e.velocityY,
      identifier:    e.identifier,
      targetTouches: e.targetTouches,
      finger:        e.finger
    };

    var data = {
      target:    e.target,
      event:     event,
      timer:     new Timer(update),
      touch:     undefined,
      timeStamp: e.timeStamp
    };

    function update(time) {
      updateEvent(event, data.touch, data.timeStamp);
      trigger(data.target, 'move', event);
    }

    if (e.identifier === undefined) {
      // We're dealing with a mouse event.
      // Stop clicks from propagating during a move
      on(e.target, 'click', preventDefault);
      on(document, mouseevents.move, activeMousemove, data);
      on(document, mouseevents.end, activeMouseend, data);
    }
    else {
      // In order to unbind correct handlers they have to be unique
      data.activeTouchmove = function(e, data) { activeTouchmove(e, data); };
      data.activeTouchend = function(e, data) { activeTouchend(e, data); };

      // We're dealing with a touch.
      on(document, touchevents.move, data.activeTouchmove, data);
      on(document, touchevents.end, data.activeTouchend, data);
    }
  }

  on(document, 'mousedown', mousedown);
  on(document, 'touchstart', touchstart);
  on(document, 'movestart', movestart);


  // jQuery special events
  //
  // jQuery event objects are copies of DOM event objects. They need
  // a little help copying the move properties across.

  if (!window.jQuery) { return; }

  var properties = ("startX startY pageX pageY distX distY deltaX deltaY velocityX velocityY").split(' ');

  function enableMove1(e) { e.enableMove(); }
  function enableMove2(e) { e.enableMove(); }
  function enableMove3(e) { e.enableMove(); }

  function add(handleObj) {
    var handler = handleObj.handler;

    handleObj.handler = function(e) {
      // Copy move properties across from originalEvent
      var i = properties.length;
      var property;

      while(i--) {
        property = properties[i];
        e[property] = e.originalEvent[property];
      }

      handler.apply(this, arguments);
    };
  }

  jQuery.event.special.movestart = {
    setup: function() {
      // Movestart must be enabled to allow other move events
      on(this, 'movestart', enableMove1);

      // Do listen to DOM events
      return false;
    },

    teardown: function() {
      off(this, 'movestart', enableMove1);
      return false;
    },

    add: add
  };

  jQuery.event.special.move = {
    setup: function() {
      on(this, 'movestart', enableMove2);
      return false;
    },

    teardown: function() {
      off(this, 'movestart', enableMove2);
      return false;
    },

    add: add
  };

  jQuery.event.special.moveend = {
    setup: function() {
      on(this, 'movestart', enableMove3);
      return false;
    },

    teardown: function() {
      off(this, 'movestart', enableMove3);
      return false;
    },

    add: add
  };
});

(function($){

  $.fn.twentytwenty = function(options) {
    var options = $.extend({default_offset_pct: 0.5, orientation: 'horizontal', before_label: 'Before', after_label: 'After', no_overlay: false}, options);
    return this.each(function() {

      var sliderPct = options.default_offset_pct;
      var container = $(this);
      var sliderOrientation = options.orientation;
      var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
      var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';


      container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
      if(!options.no_overlay) {
        container.append("<div class='twentytwenty-overlay'></div>");
      }
      var beforeImg = container.find("img:first");
      var afterImg = container.find("img:last");
      container.append("<div class='twentytwenty-handle'></div>");
      var slider = container.find(".twentytwenty-handle");
      slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
      slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
      container.addClass("twentytwenty-container");
      beforeImg.addClass("twentytwenty-before");
      afterImg.addClass("twentytwenty-after");

      var overlay = container.find(".twentytwenty-overlay");
      overlay.append("<div class='twentytwenty-before-label' data-content='"+options.before_label+"'></div>");
      overlay.append("<div class='twentytwenty-after-label' data-content='"+options.after_label+"'></div>");

      var calcOffset = function(dimensionPct) {
        var w = beforeImg.width();
        var h = beforeImg.height();
        return {
          w: w+"px",
          h: h+"px",
          cw: (dimensionPct*w)+"px",
          ch: (dimensionPct*h)+"px"
        };
      };

      var adjustContainer = function(offset) {
        if (sliderOrientation === 'vertical') {
          beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
          afterImg.css("clip", "rect("+offset.ch+","+offset.w+","+offset.h+",0)");
        }
        else {
          beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
          afterImg.css("clip", "rect(0,"+offset.w+","+offset.h+","+offset.cw+")");
      }
        container.css("height", offset.h);
      };

      var adjustSlider = function(pct) {
        var offset = calcOffset(pct);
        slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
        adjustContainer(offset);
      };

      $(window).on("resize.twentytwenty", function(e) {
        adjustSlider(sliderPct);
      });

      var offsetX = 0;
      var offsetY = 0;
      var imgWidth = 0;
      var imgHeight = 0;
      
      slider.on("movestart", function(e) {
        if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
          e.preventDefault();
        }
        else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
          e.preventDefault();
        }
        container.addClass("active");
        offsetX = container.offset().left;
        offsetY = container.offset().top;
        imgWidth = beforeImg.width(); 
        imgHeight = beforeImg.height();          
      });

      slider.on("moveend", function(e) {
        container.removeClass("active");
      });

      slider.on("move", function(e) {
        if (container.hasClass("active")) {
          sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
          if (sliderPct < 0) {
            sliderPct = 0;
          }
          if (sliderPct > 1) {
            sliderPct = 1;
          }
          adjustSlider(sliderPct);
        }
      });
      
      slider.on("touchmove", function(e) {
        e.preventDefault();
      });

      container.find("img").on("mousedown", function(event) {
        event.preventDefault();
      });

      $(window).trigger("resize.twentytwenty");
    });
  };

})(jQuery);

/* =======================================================
  Scripts
  ======================================================= */


  $(window).on('load', function(){

  	var owl = $('.banner-container > .owl-carousel');
  	owl.on('initialized.owl.carousel' , function(event) {
  		var current = event.item.index;
  		var src = $(event.target).find(".owl-item").eq(current).find("li").attr('data-color');
  		$(".dotted-nav").addClass(src);
  	});
  	owl.owlCarousel({
  		items:1,
  		autoHeight:true,
  		mouseDrag:false,
  		nav:true,
  		loop:true,
  		navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
  		navSpeed:500,
  		dotsSpeed:500,
  		dotsContainer: '.dotted-nav',
  		autoplay:true,
      autoplaySpeed:2000,
      autoplayTimeout:8000,
  		lazyLoad:true
  	});
	// When a property is about to change its value
	owl.on('change.owl.carousel', function(event) {
		var current = event.item.index;
		//var src = $(event.target).find(".owl-item").eq(current).find("img").attr('src');
		var src = $(event.target).find(".owl-item").eq(current).find("li").attr('data-color');
		$(".dotted-nav").removeClass(src);
	});
	// When a property has changed its value
	owl.on('changed.owl.carousel', function(event) {
		var current = event.item.index;
		var src = $(event.target).find(".owl-item").eq(current).find("li").attr('data-color');
		$(".dotted-nav").addClass(src);
	});


	$(".latest-posts-slider").owlCarousel({
		items:4,
		slideBy:1,
		margin:30,
		mouseDrag:false,
		nav:true,
		navContainer:'.latest-posts-slider-nav',
		navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
		navSpeed:500,
		dots:false,
		responsive:{
			0:{
				items:1
			},
			992:{
				items:4
			}
		}
	});

	$(".image-gallery-slider").owlCarousel({
		items:5,
		slideBy:1,
		margin:30,
		mouseDrag:true,
		nav:true,
		navContainer:'.image-gallery-slider-nav',
		navText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
		navSpeed:500,
		dots:false,
		responsive:{
			0:{
				items:1
			},
			992:{
				items:5
			}
		}
	});

});

  (function ($, root, undefined) {

  	$(function () {
  		'use strict';

  		$('.image-popup').magnificPopup({
  			type:'image',
  			gallery:{
  				enabled:true
  			}
  		});

  		$("li.menu-item-has-children").unbind('click').click(function(){
  			$(this).siblings().children(".sub-menu").hide("fast");
  			$(this).children(".sub-menu").slideToggle("fast");
  		});

  		$(".logo-carousel").owlCarousel({
  			items:5,
  			slideBy:1,
  			nav:false,
  			dots:false,
  			responsive:{
  				0:{
  					items:1
  				},
  				768:{
  					items:5
  				}
  			}
  		});

  		$(".accordion-btn").on('click', function(e){
  			e.preventDefault();
  			$(this).toggleClass("open");
  			if ( $(this).hasClass("open") ) {
  				$(this).text('Close');
  			} else {
  				$(this).text('This is a button');
  			}
  			$(this).siblings(".accordion-content").slideToggle('fast');
  		});

      $(".visual-difference-slider").twentytwenty();

  		var wow = new WOW(
  		{
				boxClass:     'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset:       0,          // distance to the element when triggering the animation (default is 0)
				mobile:       false,       // trigger animations on mobile devices (default is true)
				live:         true,       // act on asynchronously loaded content (default is true)
				callback:     function(box) {
				// the callback is fired every time an animation is started
				// the argument that is passed in is the DOM node being animated
			},
			scrollContainer: null // optional scroll container selector, otherwise use window
		}
		);
  		wow.init();

  	});

  })(jQuery, this);

  function goBack() {
  	window.history.back();
  }
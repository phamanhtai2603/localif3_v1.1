 AOS.init({
 	duration: 800,
 	easing: 'slide',
 	once: true
 });

jQuery(document).ready(function($) {

	"use strict";

	

	var siteMenuClone = function() {

		$('.js-clone-nav').each(function() {
			var $this = $(this);
			$this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
		});


		setTimeout(function() {
			
			var counter = 0;
      $('.site-mobile-menu .has-children').each(function(){
        var $this = $(this);
        
        $this.prepend('<span class="arrow-collapse collapsed">');

        $this.find('.arrow-collapse').attr({
          'data-toggle' : 'collapse',
          'data-target' : '#collapseItem' + counter,
        });

        $this.find('> ul').attr({
          'class' : 'collapse',
          'id' : 'collapseItem' + counter,
        });

        counter++;

      });

    }, 1000);

		$('body').on('click', '.arrow-collapse', function(e) {
      var $this = $(this);
      if ( $this.closest('li').find('.collapse').hasClass('show') ) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();  
      
    });

		$(window).resize(function() {
			var $this = $(this),
				w = $this.width();

			if ( w > 768 ) {
				if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		})

		$('body').on('click', '.js-menu-toggle', function(e) {
			var $this = $(this);
			e.preventDefault();

			if ( $('body').hasClass('offcanvas-menu') ) {
				$('body').removeClass('offcanvas-menu');
				$this.removeClass('active');
			} else {
				$('body').addClass('offcanvas-menu');
				$this.addClass('active');
			}
		}) 

		// click outisde offcanvas
		$(document).mouseup(function(e) {
	    var container = $(".site-mobile-menu");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	      if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
	    }
		});
	}; 
	siteMenuClone();


	var sitePlusMinus = function() {
		$('.js-btn-minus').on('click', function(e){
			e.preventDefault();
			if ( $(this).closest('.input-group').find('.form-control').val() != 0  ) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(0));
			}
		});
		$('.js-btn-plus').on('click', function(e){
			e.preventDefault();
			$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
		});
	};
	// sitePlusMinus();


	var siteSliderRange = function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
      " - $" + $( "#slider-range" ).slider( "values", 1 ) );
	};
	// siteSliderRange();


	var siteMagnificPopup = function() {
		$('.image-popup').magnificPopup({
	    type: 'image',
	    closeOnContentClick: true,
	    closeBtnInside: false,
	    fixedContentPos: true,
	    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
	     gallery: {
	      enabled: true,
	      navigateByImgClick: true,
	      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	    },
	    image: {
	      verticalFit: true
	    },
	    zoom: {
	      enabled: true,
	      duration: 300 // don't foget to change the duration also in CSS
	    }
	  });

	  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
	    disableOn: 700,
	    type: 'iframe',
	    mainClass: 'mfp-fade',
	    removalDelay: 160,
	    preloader: false,

	    fixedContentPos: false
	  });
	};
	siteMagnificPopup();


	var siteCarousel = function () {
		if ( $('.nonloop-block-13').length > 0 ) {
			$('.nonloop-block-13').owlCarousel({
		    center: false,
		    items: 1,
		    loop: true,
				stagePadding: 0,
		    margin: 0,
		    autoplay: true,
		    nav: true,
				navText: ['<span class="icon-arrow_back">', '<span class="icon-arrow_forward">'],
		    responsive:{
	        600:{
	        	margin: 0,
	          items: 1
	        },
	        1000:{
	        	margin: 0,
	        	stagePadding: 0,
	          items: 1
	        },
	        1200:{
	        	margin: 0,
	        	stagePadding: 0,
	          items: 1
	        }
		    }
			});
		}

		$('.slide-one-item').owlCarousel({
	    center: false,
	    items: 1,
	    loop: true,
			stagePadding: 0,
	    margin: 0,
	    autoplay: true,
	    pauseOnHover: false,
	    nav: true,
	    navText: ['<span class="icon-keyboard_arrow_left">', '<span class="icon-keyboard_arrow_right">']
	  });
	};
	siteCarousel();

	var siteStellar = function() {
		$(window).stellar({
	    responsive: false,
	    parallaxBackgrounds: true,
	    parallaxElements: true,
	    horizontalScrolling: false,
	    hideDistantElements: false,
	    scrollProperty: 'scroll'
	  });
	};
	siteStellar();

	var siteCountDown = function() {

		$('#date-countdown').countdown('2020/10/10', function(event) {
		  var $this = $(this).html(event.strftime(''
		    + '<span class="countdown-block"><span class="label">%w</span> weeks </span>'
		    + '<span class="countdown-block"><span class="label">%d</span> days </span>'
		    + '<span class="countdown-block"><span class="label">%H</span> hr </span>'
		    + '<span class="countdown-block"><span class="label">%M</span> min </span>'
		    + '<span class="countdown-block"><span class="label">%S</span> sec</span>'));
		});
				
	};
	siteCountDown();

	var siteDatePicker = function() {

		if ( $('.datepicker').length > 0 ) {
			$('.datepicker').datepicker();
		}

	};
	siteDatePicker();
	$(document).scroll(function(){
		var $nav = $(".site-navbar");
		$nav.toggleClass("changefixed", $(this).scrollTop() > $nav.height());
	});

	var x = document.getElementsByClassName("splitName");
	for(var i = 0; i < x.length ; i ++)
	{
		x[i].textContent = x[i].textContent.split('@')[0];
	}

	var absoluteValue = document.getElementById('price-tourmanage');
	if (absoluteValue != null)
	{
		absoluteValue.onblur = inputBlur;
	}
	function inputBlur(){
		if (parseInt(absoluteValue.value, 10) < 0 )
		{
			absoluteValue.value = Math.abs(parseInt(absoluteValue.value, 10));
		}
	}
	


	var formatMoney = document.getElementsByClassName('format-money');
	for (var i = 0; i < formatMoney.length; i++)
	{
		var n = parseInt(formatMoney[i].textContent, 10).toFixed(0).replace(/(\d)(?=(\d{3})+\b)/g,'$1 ');
		formatMoney[i].textContent = n;
	}
		  var $nav = $(".site-navbar");
		  $nav.toggleClass("changefixed", $(this).scrollTop() > $nav.height());

	var validateInputMoney = document.getElementById("price-tourmanage");
	validateInputMoney.value = parseInt(validateInputMoney.value, 10).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

	$("input[data-type='currency']").on({
		keyup: function() {
		  formatCurrency($(this));
		},
		blur: function() { 
		  formatCurrency($(this), "blur");


	function formatNumber(n) {
		// format number 1000000 to 1,234,567
		return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
	  }
	  function formatCurrency(input, blur) {
		// appends $ to value, validates decimal side
		// and puts cursor back in right position.
		
		// get input value
		var input_val = input.val();
		
		// don't validate empty input
		if (input_val === "") { return; }
		
		// original length
		var original_len = input_val.length;
	  
		// initial caret position 
		var caret_pos = input.prop("selectionStart");
		  
		// check for decimal
		if (input_val.indexOf(".") >= 0) {
	  
		  // get position of first decimal
		  // this prevents multiple decimals from
		  // being entered
		  var decimal_pos = input_val.indexOf(".");
	  
		  // split number by decimal point
		  var left_side = input_val.substring(0, decimal_pos);
		//   var right_side = input_val.substring(decimal_pos);
	  
		  // add commas to left side of number
		  left_side = formatNumber(left_side);
	  
		  // validate right side
		//   right_side = formatNumber(right_side);
		  
		  // On blur make sure 2 numbers after decimal
		//   if (blur === "blur") {
		// 	right_side += "00";
		//   }
		  
		  // Limit decimal to only 2 digits
		//   right_side = right_side.substring(0, 2);
	  
		  // join number by .
		  input_val = left_side 
		//   input_val = left_side + "." + right_side;
	  
		} else {
		  // no decimal entered
		  // add commas to number
		  // remove all non-digits
		  input_val = formatNumber(input_val);
		  input_val = input_val;
		  
		  // final formatting
		//   if (blur === "blur") {
		// 	input_val += ".00";
		//   }
		}
		
		// send updated string to input
		input.val(input_val);
	  
		// put caret back in the right position
		var updated_len = input_val.length;
		caret_pos = updated_len - original_len + caret_pos;
		input[0].setSelectionRange(caret_pos, caret_pos);
	  }
});
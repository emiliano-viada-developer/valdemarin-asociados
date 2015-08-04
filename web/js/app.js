$(function() {
	// Homepage Slider
	$('.bxslider').bxSlider({
        auto: false,
        pager: true,
        nextSelector: '.slider-next',
        prevSelector: '.slider-prev',
        nextText: '<img src="img/slider-next.png" alt="slider next" />',
        prevText: '<img src="img/slider-prev.png" alt="slider prev" />'
    });

    //Setup price slider
	var Link = $.noUiSlider.Link,
		$priceSlider = $(".priceSlider");

	if ($priceSlider.length) {
		var priceMinField = $("#building_searcher_price_min"),
			priceMin = (priceMinField.val())? priceMinField.val() : 15000,
			priceMaxField = $("#building_searcher_price_max"),
			priceMax = (priceMaxField.val())? priceMaxField.val() : 550000;

		$priceSlider.noUiSlider({
		     range: {
		      'min': 0,
		      'max': 2000000
		    }
		    ,start: [priceMin, priceMax]
		    ,step: 1000
		    ,margin: 100000
		    ,connect: true
		    ,direction: 'ltr'
		    ,orientation: 'horizontal'
		    ,behaviour: 'tap-drag'
		    ,serialization: {
		        lower: [
		            new Link({
		                target: priceMinField
		            })
		        ],
		        upper: [
		            new Link({
		                target: priceMaxField
		            })
		        ],
		        format: {
		        	// Set formatting
		            decimals: 0,
		            thousand: '',
		            prefix: '$',
		            encoder: function( value ){
		                return value;
		            }
		        }
		    }
		});
	}

	// Setup images slider
	var $imgsSlider = $(".bxslider2");

	if ($imgsSlider.length) {
		$imgsSlider.bxSlider({
		    pagerCustom: '#bx-pager',
		    nextSelector: '.slider-next',
		    prevSelector: '.slider-prev',
		    nextText: '<img src="/img/slider-next2.png" alt="Siguiente" />',
		    prevText: '<img src="/img/slider-prev2.png" alt="Anterior" />'
	    });
	}

	// Auction Search Form validation
	var $auctionForm = $('#auction-searcher-form');
	if ($auctionForm.length) {
		$('#auction_searcher_status, #auction_searcher_location').on('change', function(e) {
			var empty = true,
				$btn = $('#auction-search');
			$auctionForm.find('.formDropdown').each(function(i, el) {
				if ($(el).val() != '') {
					empty = false;
				}
			});
			if (empty) {
				$btn.addClass('disabled').attr('disabled', 'disabled');
			} else {
				$btn.removeClass('disabled').removeAttr('disabled');
			}
		});
	}

	// Validate Contact form
	var $contactForm = $('#contact-us');
	if ($contactForm.length) {
		$contactForm.validate({
			messages: {
			    'contact[name]': {
			      required: "Campo requerido."
			    },
			    'contact[email]': {
			      required: "Campo requerido."
			    },
			    'contact[phone]': {
			      required: "Campo requerido."
			    },
			    'contact[message]': {
			      required: "Campo requerido."
			    },
			    'make_request[name]': {
			      required: "Campo requerido."
			    },
			    'make_request[email]': {
			      required: "Campo requerido."
			    },
			    'make_request[phone]': {
			      required: "Campo requerido."
			    },
			    'make_request[message]': {
			      required: "Campo requerido."
			    },
			    'offer_property[name]': {
			      required: "Campo requerido."
			    },
			    'offer_property[email]': {
			      required: "Campo requerido."
			    },
			    'offer_property[phone]': {
			      required: "Campo requerido."
			    },
			    'offer_property[message]': {
			      required: "Campo requerido."
			    }
		    }
		});
	}

	// Validate Get Info form
	var $getInfoForm = $('#get-info');
	if ($getInfoForm.length) {
		$getInfoForm.validate({
			messages: {
			    'get_info[name]': {
			      required: "Campo requerido."
			    },
			    'get_info[email]': {
			      required: "Campo requerido."
			    },
			    'get_info[phone]': {
			      required: "Campo requerido."
			    },
			    'get_info[locality]': {
			      required: "Campo requerido."
			    },
			    'get_info[message]': {
			      required: "Campo requerido."
			    }
		    }
		});
	}

	// Close Flash messages
	$('.close-flash').on('click', function(e) {
		var _this = $(e.currentTarget),
			box = _this.closest('.alertBox');
		box.fadeOut(300);
	});
});

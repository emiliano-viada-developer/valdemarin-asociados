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
});

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
});
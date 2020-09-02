jQuery.fn.isInViewport = function() {
	var elementTop = jQuery(this).offset().top;
	var elementBottom = elementTop + jQuery(this).outerHeight();

	var viewportTop = jQuery(window).scrollTop();
	var viewportBottom = viewportTop + jQuery(window).height();

	return elementBottom > viewportTop && elementTop < viewportBottom;
};
function tetimonialJsTest() {
	console.log( 'tetimonial js' );
}
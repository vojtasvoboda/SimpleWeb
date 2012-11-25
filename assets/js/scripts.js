$(document).ready(function(){

	/* photos lazyload */
	$(".galerie img").lazyload({
		threshold : 200
	});

	/* colorbox */
	$("a[rel^='lightbox']").colorbox();

	/* skryti non-js */
	$(".non-js").each(function (i) {
		$(this).css({
			'display': 'none'
		});
	});

});
$(document).ready(function(){

	/* colorbox */
	$("a[rel^='lightbox']").colorbox();

	/* hide all items with class .non-js */
	$(".non-js").each(function (i) {
		$(this).css({
			'display': 'none'
		});
	});

});
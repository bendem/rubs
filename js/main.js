jQuery(function($) {
	// TODO : Modéliser le cube en 3D / le faire tourner...

	// Filters
	$('.filters li a').click(function(e) {
		e.preventDefault();
		var target;

		target = $(this).attr('href').substring(1);
		$('.filters li a').removeClass('active');
		$(this).addClass('active');

		if(target == 'all') {
			$('.callout').stop().show(400);
		} else {
			$('.callout:not(.callout-' + target + ')').slideUp(400);
			$('.callout.callout-' + target).slideDown(300);
		}
	});

	// Close button
	$('.close').click(function(e) {
		$(this).parent().slideUp();
	})
});

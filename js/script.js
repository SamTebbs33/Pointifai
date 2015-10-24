$(document).ready(function () {
	var name = '';
	console.log('yolo swag');

	// check to see if the page is a controller
	if ($('body').hasClass('mobile-controller')) {
		// show the form to enter the name
		$('.mobile-name').show();
		// setup the go button
		$('.mobile-name a').click(function (e) {
			// prevent the button from working
			e.preventDefault();
			// output swag
			console.log('very swag');
			// store the name
			name = $('.mobile-name > input').val();

			$('.mobile-name').hide();
			$('.mobile-message .message').html('Waiting...');
			$('.mobile-message').show();

			setTimeout(function () {
				$('.mobile-message').hide();
				$('.mobile-enter-tag').show();
			}, 2000);
		});
	};
});
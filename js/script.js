$(document).ready(function () {
	var name = '';
	console.log('yolo swag');

	// check to see if the page is a controller
	if ($('body').hasClass('mobile-controller')) {
	    var pusher = new Pusher('c834feb77fbe7f552f26', {
	      encrypted: true
	    });
	    var channel = pusher.subscribe('contoller-channel');
	    console.log('the doge has connected to the meme');
	    channel.bind('new-q', function(data) {
	    	console.log('#rekt');
	     	$('.mobile').hide();
	     	$('.mobile-enter-tag').show();
	    });

		// show the form to enter the name
		$('.mobile-name').show();
		// setup the go button
		$('.mobile-name a').click(function (e) {
			// prevent the button from working
			e.preventDefault();
			$.post('/register.php', {
				'name': $('.mobile-name > input').val()
			}, function () {
				// output swag
				console.log('the doge has registered with the meme, very swag');
				// store the name
				name = $('.mobile-name > input').val();

				$('.mobile-name').hide();
				$('.mobile-message .message').html('Waiting for the game to start...');
				$('.mobile-message').show();
			});
		});
	}

	if ($('body').hasClass('host')) {
		var pusher = new Pusher('c834feb77fbe7f552f26', {
	      encrypted: true
	    });
	    var channel = pusher.subscribe('host-channel');
	    console.log('the doge has connected to the meme');
	    channel.bind('new-registration', function(data) {
	    	$('ul.player-list').append('<li>' + data + '</li>');
	    });
	}
});
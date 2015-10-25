$(document).ready(function () {
	var name = '';
	console.log('yolo swag');
	var has_registered = false;
	var question_number = 0;

	// check to see if the page is a controller
	if ($('body').hasClass('mobile-controller')) {
	    var pusher = new Pusher('c834feb77fbe7f552f26', {
	      encrypted: true
	    });
	    var channel = pusher.subscribe('client-channel');
	    console.log('the doge has connected to the meme');
	    channel.bind('new-q', function(data) {
	    	console.log('#rekt');
	    	question_number = data;
	    	$('.mobile-enter-tag input[type=text]').val('');
	     	$('.mobile').hide();
	     	$('.mobile-enter-tag').show();
	    });

	    channel.bind('end-q', function(data) {
	    	console.log('stop. hammer time');
	     	$('.mobile').hide();
			$('.mobile-message .message').html('Waiting for the next question...');
	     	$('.mobile-message').show();
	    });

	    $('.mobile-enter-tag a.button').click(function (e) {
	    	e.preventDefault();
	    	var blah = ($('body').data('state') + 1) / 2;
	    	$('.mobile').hide();
			$('.mobile-message .message').html('Waiting for the next question...');
	     	$('.mobile-message').show();
	    	$.post('/register.php', {
				'name': name,
				'q_id': question_number,
				'tag': $('.mobile-enter-tag input[type=text]').val()
			}, function () {
				// output doge bants
				console.log('the doge has sent epic banter to the meme');
			});
	    });

		// show the form to enter the name
		$('.mobile-name').show();
		// setup the go button
		$('.mobile-name a').click(function (e) {
			// prevent the button from working
			e.preventDefault();
			if (!has_registered) {
				has_registered = true;
				$.post('/register.php', {
					'name': $('.mobile-name > input').val()
				}, function () {
					// output swag
					console.log('the doge has registered with the meme, very swag');
					// store the name
					name = $('.mobile-name > input').val();
					$('.user-name').text(name);

					$('.mobile-name').hide();
					$('.mobile-message .message').html('Waiting for the game to start...');
					$('.mobile-message').show();
				});
			}
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
	    if ($('body').hasClass('timer')) {
	    	$('.timer .seconds').text('20');
	     	var secs = 20;
	     	var timer = setInterval(function () {
	     		secs--;
	     		$('.timer .seconds').text(secs);
	     		if (secs < 1) {
	     			clearInterval(timer);
	     			var game_state = $('body').data('state') + 1;
	     			window.location = "/start.php?state=" + game_state;
	     		}
	     	}, 1000);
	    }
	}
});
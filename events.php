<?php

require_once "config.php";

$pusher = new Pusher($key_pusher_id, $key_pusher_secret, $key_pusher_app_id);

// Client
function push_new_q($pusher){
	$pusher->trigger("client-channel", "new-q", "");
}

function push_score_update($pusher){
	$pusher->trigger("client-channel", "score-update", get_leaderboard());	
}

function push_game_end($pusher){
	$pusher->trigger("client-channel", "game-end", "");
}

function push_end_q($pusher){
	$pusher->trigger("client-channel", "end-q", "");
}

// Host
function push_new_registration($pusher, $user){
	$pusher->trigger("host-channel", "new-registration", $user);
}

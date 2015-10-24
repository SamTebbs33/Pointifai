<?php

require "Pusher.php";
require "config.php"
$pusher = new Pusher($key_pusher_id, $key_pusher_secret, $key_pusher_app_id);

function push_new_q(){
	$pusher->trigger("client-channel", "new_q", "");
}

function push_score_update(){
	$pusher->trigger("client-channel", "score_update", get_leaderboard());	
}

function push_game_end(){
	$pusher->trigger("client-channel", "game_end", "");
}

?>

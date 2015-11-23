<?php
require_once("twitteroauth/twitteroauth.php");
 
$twitter_un = "vikimanish";
$num_tweets = 15;
$consumerkey = "4r4cDQjudxroNgJvXyCyQ";
$consumersecret = "GAh4aYzJG3gpybhCyyAsgBMhUOIV4D0KtMsaczp7k";
$accesstoken = "163033188-AnlzeEbiClKm7BPxo7N4iaqqIaeqNh6mBZHm2ACc";
$accesstokensecret = "xDXHrwcNNjrkgllKhPsf8j2jHKhFR2ozD4SxUDDf9X2xm";
 
$connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_un."&count=".$num_tweets);
foreach($tweets as $tweet) {
	echo "<p>".$tweet->text."</p>";
}?>
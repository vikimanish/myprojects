<?php require_once('codebird.php');
\Codebird\Codebird::setConsumerKey("4r4cDQjudxroNgJvXyCyQ", "GAh4aYzJG3gpybhCyyAsgBMhUOIV4D0KtMsaczp7k");
$cb =\Codebird\Codebird::getInstance();
$cb->setToken($access_token['oauth_token'],$access_token['oauth_token_secret']);
 
$params = array(
  'status' => 'gud ni8'
);
$reply = $cb->statuses_update($params);
?>
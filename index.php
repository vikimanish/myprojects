<?php 
session_start(); 
include ('db_con.php');
ini_set( "display_errors", 0);
?>
<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

require_once('codebird.php');
\Codebird\Codebird::setConsumerKey("4r4cDQjudxroNgJvXyCyQ", "GAh4aYzJG3gpybhCyyAsgBMhUOIV4D0KtMsaczp7k");
$cb =\Codebird\Codebird::getInstance();
$cb->setToken($access_token['oauth_token'],$access_token['oauth_token_secret']);
 
$tbl_name="members";
if(!isset($_SESSION['myusername']))
{
header("location:sigin.html?msg=session expired");  
}
ini_set( "display_errors", 0);
$name=$_SESSION['myusername'];
echo $_SESSION['myusername'];
echo $name;
$sql="SELECT userid FROM `members` WHERE username='".$name."'";
$result= mysqli_query($dbc, $sql);
	while ($row = mysqli_fetch_object($result)) {
    $urlnew=$row->userid;
}
mysqli_free_result($result);
$params = array(
  'status' => 'http://127.0.0.1/twt1/signup.php?id='.$urlnew.'');
$reply = $cb->statuses_update($params);



/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');

/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* Include HTML to display on the page */
header('Location: ./adminportal.php');

<?php
include ('db_con.php');
session_start();
$myusername=$_POST['uname']; 
$mypassword=$_POST['pass']; 
$tbl_name="members";

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($dbc,$myusername);
$mypassword = mysqli_real_escape_string($dbc,$mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($dbc,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"

//session_register("myusername");
//session_register("mypassword"); 
$_SESSION['myusername'] =$myusername;
$_SESSION['mypassword'] =$mypassword;
header("location:adminportal.php");
}
else {

header("location:sigin.html?msg=wrong username or password");
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
session_start(); 
 if(!isset($_SESSION['myusername']))
{
header("location:sigin.html?msg=session expired");  
}?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ProDat-SignIn</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="maincont">
<div class="header">
<img src="images/header.jpg">
</div>
<div class="nav">
<ul>
<li><a href="upload.php">Upload New files</a></li>
<li><a href="existing.php">View Existing Files</a></li>
<li><a href="sendfiles.php">Send Files</a></li>
<li><a href="redirect.php">Follow Us</a></li>
<li><a href="changepaswd.php">Change Password</a></li>
<li><a href="logout.php">Logout</a></li>
</ul
></div>
<div class="content">
<h1>Welcome to Pro Dat</h1>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

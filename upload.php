<?php 
ini_set( "display_errors", 0);
if(isset($_POST['sub']))
{
 $target = "upload/"; 
 $target = $target . basename( $_FILES['fname']['name']) ; 
 $ok=1; 
 if(move_uploaded_file($_FILES['fname']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['fname']['name']). " has been uploaded";
 } 
 else {
 echo "Sorry, there was a problem uploading your file.";
 }
  
}
?>
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
<li><a href="changepaswd.php">Change Password</a></li>
<li><a href="logout.php">Logout</a></li>
</ul
></div>
<div class="content">
<h1>File Upload</h1>
<form name="fileupload" action="upload.php" method="post" enctype="multipart/form-data">
<label for="fname">Choose Your File</label>
<input type="file" name="fname">
<input type="submit" name="sub" id="sub">
</form>
<h2>Uploaded File Info:</h2>

 <?php echo "<h4>Sent file:".$_FILES['fname']['name'];  ?>
 <?php echo "<h4>File size:".$_FILES['fname']['size'];  ?> bytes
 <?php echo "<h4>File type:".$_FILES['fname']['type'];  ?>
</ul></div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

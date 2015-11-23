<?php
session_start(); 
ini_set( "display_errors", 0);
if(!isset($_SESSION['myusername']))
{
header("location:index.php?msg=session expired");  
}

include ('db_con.php');
if (isset($_POST['psub'])) 
{
	$error = array();
   
    if (empty($_POST['oldpas'])) 
	{
       
		$error[] = 'Please Enter a old password ';
    } 
	else 
	{
        $oldpas = $_POST['oldpas'];
		//else assign it a variable
    }
if (empty($_POST['newpas']))
 {//if no name has been supplied 
        
		$error[] = 'Please Enter a new password ';
    }
	 else 
	{
        $newpas = $_POST['newpas'];//else assign it a variable
    }
     if (empty($_POST['newpass']))
 {//if no name has been supplied 
        
		$error[] = 'Please Re-Enter a new password';
    }
	 else 
	{
        $newpass = $_POST['newpass'];//else assign it a variable
    }
   
	
      if (empty($error)) //send to Database if there's no error '

    { // If everything's OK...

 $username=$_SESSION['myusername'];
/*echo"$username";
echo"$oldpas";
echo"$newpas";*/
 $tbl_name="Members";
$pquery="SELECT password FROM $tbl_name WHERE username='$username'";
$presult=mysqli_query($dbc,$pquery);
if (!$presult) {
               $msg="wrong username";
            }
			$pinfo= mysqli_fetch_array($presult);
			
			if($pinfo['password']!=$oldpas)
			{
			$msg="wrong password";
			
			}
			else if(strlen($newpas)>=12 and strlen($newpas)<=5)
			{
				$msg="password length mismatched";}
				else if($newpas!=$newpass)
			{
				$msg="password mismatched";
				}
				
				else{
					
					$nquery="UPDATE $tbl_name SET password='$newpas' where username='$username'";
                    $nresult=mysqli_query($dbc,$nquery);
					$msg="password changed sucessfully";
					}
	}
    mysqli_close($dbc);//Close the DB Connection
//If the "error" array contains error msg , display them
        
        

echo '<div class="errormsgbox"> <ol>';
        foreach ($error as $key => $values) {
            
            echo '	<li>'.$values.'</li>';


       
        
        echo '</ol></div>';

    }
 // End of the main Submit conditional.
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
</ul></div>
<div class="content">
<h1>Change Password</h1>
<form name="cpassword" action="changepaswd.php" method="post">
                 
                  Enter old password
                  
                  <input type="password" name="oldpas" id="oldpas" class="textfields"/><br><br>
                  Enter new password
                  
                  <input type="password" name="newpas" id="newpas" class="textfields"/>(Max 12 characters)<br><br>
                  
                  Enter new password again
                  
                  <input type="password" name="newpass" id="newpass" class="textfields" /><br><br>
                  <input type="submit" value="change password"  name="psub" id="psub" class="button"/>
                  <?php
				  echo"<h3>".$msg;?>
                  
                  </form>
                  
     </div>             
</div>
</div>
</div>
</div>
</div>
</body>
</html>

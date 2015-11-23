<?php
include ('db_con.php');
ini_set( "display_errors", 0);
session_start();
if(isset($_POST['login']))
{
	 $reff = $_POST['reff'];
	$error = array();
	$name=array();
$name[]=$_POST['name'];	
if (empty($_POST['name'])) 
	{
        $error[] = 'Please Enter a name ';
    } 
	else if(!ctype_alpha(str_replace(' ', '', $name))==false)
	{
		$error[]="please enter a valid name";
		} 
		else if(strlen($_POST['name']>15) AND strlen($_POST['name']<3))
		{
			$error[]="please enter a valid name";
			}
	else 
	{
        $name = $_POST['name'];
    }
	
if (empty($_POST['uname'])) 
	{
        $error[] = 'Please Enter a name ';
    } 
	
		else if(strlen($_POST['uname']>10)  and strlen($_POST['uname']<3))
		{
			$error[]="please enter a valid name";}
	else 
	{
        $uname = $_POST['uname'];
    }

if (empty($_POST['pass'])) 
	{
        $error[] = 'Please Enter a password ';
    } 
	
		else if(strlen($_POST['pass']>10) and $_POST['pass']<3)
		{$error[]="please enter a valid password";}
	else 
	{
        $pass = $_POST['pass'];
    }


if($pass==$_POST['rpass'])
{
	$rpass=$_POST['rpass'];
	
}
else
{
	$error[] = 'Passwords not matched';
	}
	
	if(empty($error))
	{
$email=$_POST['email'];
$checkquery="SELECT * FROM `Members` WHERE username='$uname'";
$res=mysqli_query($dbc,$checkquery);
$count=mysqli_num_rows($res);
if($count>1)
{
	$error[]="Username Already Existing";
}
else
{
	
$unique_ref_length = 4;


$unique_ref_found = false;


$possible_chars = "123456789";

// Until we find a unique reference, keep generating new ones
while (!$unique_ref_found)
 {

	
	$unique_ref = "";
	
	
	$i = 0;
	
	
	while ($i < $unique_ref_length) {
	
		
		$char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);
		
		$unique_ref .= $char;
		
		$i++;
	
	}
	
	
	$query = "SELECT `userid` FROM `Members`
		      WHERE `userid`='".$unique_ref."'";
	$result = mysqli_query($dbc,$query); 
	if (mysqli_num_rows($result)==0) {
		$unique_ref_found = true;
	
	}

}	
	
	
	
	
	$_SESSION['id']=$ref;
	
$query="INSERT INTO `Members` VALUES('$unique_ref','$reff','$name','$uname','$pass','$email')";
$result= mysqli_query($dbc, $query);
 if (!$result) {
                $msg= 'Query Failed ';
            }

            if (mysqli_affected_rows($dbc) == 1) {
				$msg="sucessfully inserted";
	}
}

	
	}
	else
	{
		$error[]="Error";
		}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ProDat-SignUp</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="centercont">
<h2>SignUp</h2>
<form action="signup.php" method="post" name="Signupform" title="Sign Up">
  <label for="name" class="labels">Name</label>
    <input type="text" name="name" id="name" class="textfields"><br><br>
    <label for="uname" class="labels">
    UserName
    </label>
    <input type="text" name="uname" id="uname" class="textfields">  <br><br>
 
    <label for="email" class="labels">Email</label>
    <input type="email" name="email" id="email" class="textfields"><br><br>
    <label for="pass" class="labels">
      
      Password</label> 
    <input type="password" name="pass" id="pass" class="textfields"><br><br>
    <label for="rpass" class="labels">
    Re-Enter Password</label>
    <input type="password" name="rpass" id="pass" class="textfields"><br><br>
<?php    
$ref =$_GET['id'];
  print ("<input type=hidden value=$ref name=reff id=reff>");

?>
    <input type="submit" value="sign up" name="login" id="form_button"></form>
    
   <?php
	echo"<h4 align=left>".$msg."</h4>";
	if($msg)
	{
		echo"<a href='sigin.html'>Sign In</a>";
		}
	foreach ($error as $key => $values) {
            
            echo '	<li>'.$values.'</li>';}

	?>
</div>
</div>
</body>
</html>

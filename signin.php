<?php
	session_start();
	if(isset($_SESSION['user']))
		header("location:Dashboard/"); // edit later
	
	error_reporting('0');
	include('config.php');
	require_once "variables.php";
	$con = mysqli_connect("$server","$root","$password","$dbms");
	if(!empty($_POST['user'])&&(!empty($_POST['pass'])))
	{
		$user = mysqli_real_escape_string($con,$_POST['user']);
		if (!preg_match("/^[a-zA-Z0-9_ ]*$/",$user)) {
			$userErr = "Invalid Username , only letters and numbers allowed";
							  
		}
		$pass = sha1($_POST['pass']);
						
		if(empty($userErr)){
			$result = mysqli_query($con,"SELECT `user`,`password`,`level` FROM `Player`");
			$flag=0;
			if($result){
				while($result2=mysqli_fetch_array($result)){
					if($flag==0){
						if(($user==$result2['user'])&&($pass==$result2['password'])){
							$_SESSION['user'] = $user;
							$_SESSION['pass'] = $pass;
							$_SESSION['loggedin']= 1;
							$flag=1;
							header("location:Dashboard/");
						}
						else{
							$Err = "Username and Password did not Match";
							$_SESSION['UErr'] = $Err;
							header("location:index.php");
						}
					}
				}
			}
		}
	}
	else if(empty($_POST['user'])&&empty($_POST['pass'])){
		$Err = "Enter Both the fields";
        $_SESSION['UErr'] = $Err;
		header("location:index.php");
	}
	else if(empty($_POST['user'])) {
		$userErr = "Enter Username";
		$_SESSION['UErr'] = $userErr;
		header("location:index.php");
	}
	else if(empty($_POST['pass'])) {
		$passErr = "Enter Password";
		$_SESSION['UErr'] = $passErr;
		header("location:index.php");
	}
	var_dump($_SESSION);
?>
<html>
<body>
</body>
</html>
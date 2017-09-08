<?php
	session_start();
	$score=1;
	$level=1;
	require_once "../variables.php";
	error_reporting(0);
	$con = mysqli_connect("$server","$root","$password","$dbms");
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$Err = "";
	$Alert = "";
	if(!empty($_SESSION['user'])&&!empty($_SESSION['pass'])){
		$row = mysqli_fetch_array(mysqli_query($con,"SELECT `score` , `level`,`password` from `player` WHERE `user` = '$user'"));
		$score = $row['score'];
		$level = $row['level'];
		$pass = $row['password'];
		$row = mysqli_fetch_array(mysqli_query($con,"SELECT `path` from `questions` WHERE `no` = '$level'"));
		$path = $row['path'];
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		$_SESSION['score'] = $score;
		$_SESSION['level'] = $level;
		if(!empty($_POST['ans1'])){
			$ans2 = ($_POST['ans1']);
			$ans1 = sha1($_POST['ans1']);
			if (!preg_match("/^[a-zA-Z0-9]*$/",$ans1)) {
				$_SESSION['Err']="Invalid characters";
				header("location:../Dashboard/");
			}
			$res = mysqli_query($con,"SELECT `ans` from `questions` WHERE `no` = '$level'");
			while($row = mysqli_fetch_array($res))
			{
				$ans = $row['ans'];
			}
			// Check connection
			if($ans1==$ans)
			{	
				$time = time();
				$sql1 = "INSERT INTO `log`(`user`,`ans`,`time`,`level`,`correct`) VALUES ('$user','$ans2',$time,'$level',1) ";
				if (!mysqli_query($con,$sql1)) {
					die('Error: ' . mysqli_error($con));
				}
				$row = mysqli_fetch_array(mysqli_query($con,"SELECT `count` from `questions` WHERE `no` = '$level'"));
				$count = $row['count'];
				$row1 = mysqli_fetch_array(mysqli_query($con,"SELECT `pri` from `player` WHERE `user` = '$user'"));
				
				// i dont know the logic
				/*if(($count>0)&&($row1['pri']=='0')){
					$score = $score + 2;
					$count = $count - 1;
					$sql = "UPDATE `questions` SET `count` = $count where `no` = $level ";
					if (!mysqli_query($con,$sql)) {
						die('Error: ' . mysqli_error($con));
					}					
				}
	
				else {
					$score = $score + 1;
				}*/
				$score = $score + 1;
				$level = $level + 1;
				$time = time();
				$sql = "UPDATE `player` SET `score` = $score,`level` = $level,`time` = $time WHERE `user`='$user' ";
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}					
				$_SESSION['Alert']="Verified";
				$_SESSION['Err']="";
				header("location:../Dashboard/");
			}
			else
			{	 
				$_SESSION['Err'] = "Wrong Answer";
				$time = time();
				$sql2 = "INSERT INTO `log`(`user`,`ans`,`time`,`level`,`correct`) VALUES ('$user','$ans2',$time,'$level',0) ";
				if (!mysqli_query($con,$sql2)) {
					die('Error: ' . mysqli_error($con));
				}	
				header("location:../Dashboard/");
			}
		}
		else{
			$_SESSION['Err'] = "Enter an answer";
			$time = time();
			$sql2 = "INSERT INTO `log`(`user`,`ans`,`time`,`level`,`correct`) VALUES ('$user','$ans2',$time,'$level',0) ";
			if (!mysqli_query($con,$sql2)) {
				die('Error: ' . mysqli_error($con));
			}	
			header("location:../Dashboard/");
		}
	}		
	else {
		$_SESSION['logout'] = 1;
		header("location:../logout.php");						 
	}
	mysqli_close($con);
?>
<html>
<body>
</body>
</html>
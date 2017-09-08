<?php
	session_start();
	require_once "variables.php";
	include('config.php');
	$con = mysqli_connect("$server","$root","$password","$dbms");
	// Passkey that got from link 
	$passkey=$_GET['passkey'];
	$tbl_name1="player";
	$msg="";
	// Retrieve data from table where row that match this passkey 
	$sql1="SELECT * FROM `$tbl_name1` WHERE conf_code ='$passkey'";
	$result1=mysqli_query($db,$sql1);
	//$user="";
	// If successfully queried 
	if($result1){
		// Count how many row has this passkey
		//$count=mysqli_num_rows($result1);
		//echo $result1;
		$row = mysqli_fetch_assoc($result1);
		$user = $row['user'];
		$pass = $row['password'];
		$active = $row['activated'];
		
		if($active == 0){
			// if found this passkey in our database, retrieve data from table "temp_members_db"
			//$rows=mysql_fetch_array($result1);
			$time = time();
			$level = 1;
			$score = 0;
			$flag = 1;
			// Insert data that retrieves from "temp_members_db" into table "players" 
			$result3 = mysqli_query($con,"SELECT * FROM `player` ;");
			while($row = mysqli_fetch_array($result3))
			{
				if($email == $row['email']||$user == $row['user'])
				{
					$flag = 0 ;
				}
			}

			$sql2="UPDATE `player` SET level = $level, score = $score, time = '$time', activated = 1 WHERE conf_code ='$passkey'";
			$result2=mysqli_query($db,$sql2);

			// if successfully moved data from table"temp_members_db" to table "players" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"
			if(($result2) && ($flag==1)){
				$_SESSION['user']=$user;
				$_SESSION['pass']=$pass;
				$_SESSION['active']=$active;
				$_SESSION['Alert']="Account activated";
				header("location:Dashboard/");
			}
			else {
				$msg="duplicate entry for email or  Username!";
				$_SESSION['Err']=$msg;
				header("location:../DeCrypto/");
			}
		}
		else{
			$_SESSION['user']=$user;
			$_SESSION['pass']=$pass;
			$_SESSION['active']=$active;
			header("location:Dashboard/");
		}
	}
	else{
		$_SESSION['Err']=mysqli_error($result1);
	}
?>

<html>
<body>
</body>
</html>
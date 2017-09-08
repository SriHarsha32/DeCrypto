<?php
	session_start();
	if(!empty($_SESSION['user'])){
		$user=$_SESSION['user'];
		echo "Signed in as ".$user;
	}
	else{
		echo "not signed in";
		header("location:logout.php");
	}
	var_dump($_SESSION);
?>
<html>
<body>
<a href="logout.php">Logout Now</a>
</body>
</html>
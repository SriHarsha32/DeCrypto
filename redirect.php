<?php
	session_start();
	if(isset($_SESSION['user']))
		header("location:signedin.php");
	if(!empty($_SESSION['to'])){
		$to=$_SESSION['to'];
		$sub=$_SESSION['sub'];
		$mesg=$_SESSION['mesg'];
		$link=$_SESSION['link'];
		//echo "Signed in as ".$user;
	}
	else{
		echo "Could not register";
		//header("location:logout.php");
	}
	//var_dump($_SESSION);
?>
<html>
<body>
<?php
	echo $to."</br>";
	echo $sub."</br>";
	echo $mesg."<br>";
?>
<a href="<?php
	echo $link;
?>">Confirm Now</a>
</body>
</html>
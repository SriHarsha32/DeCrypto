<?php
	session_start();
	if(!empty($_SESSION['user'])){
		session_destroy();
	}
	else
		echo "not signed in";
	header("location:index.php");
?>
<html>
<body>
</body>
</html>
<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="Onida-250"; // Mysql password 
	$db_name="DeCrypto"; // Database name 

	//Connect to server and select database.
	$db = mysqli_connect("$host", "$username", "$password")or die("cannot connect to server"); 
	mysqli_select_db($db,"$db_name")or die("cannot select DB");
?>
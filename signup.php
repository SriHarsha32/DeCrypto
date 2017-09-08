<?php
	session_start();
	if(isset($_SESSION['user']))
		header("location:Dashboard/");
	include('config.php');

	$msg="";
	$sentmail ="";
	if(!empty($_POST['name'])&&!empty($_POST['user'])&&!empty($_POST['colg'])&&!empty($_POST['email'])&&!empty($_POST['num'])&&!empty($_POST['pass']))
	{
		$user = $name = $pass = $colg = $email = "";
		$num = 0;
		$user = $_POST['user'];	 
		
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$user)) {
			$userErr = "Invalid Username , only letters and numbers allowed";
			$_SESSION['extErr'] = $userErr;
		}
		else {
			$user = mysqli_real_escape_string($db,$_POST['user']);
			$preuser = mysqli_fetch_assoc(mysqli_query($db,"SELECT `user` FROM `player` WHERE `user`='$user'"));
			if(!empty($preuser['user']) && $preuser['user']==$user){
				$userErr = "Username already exists.";
				$_SESSION['extErr'] = $userErr;
			}
		}
		 
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white space allowed";
			$_SESSION['extErr'] = $nameErr;
		}
		else {
			$name = mysqli_real_escape_string($db,$_POST["name"]);
		}
		
		if (!preg_match("/^[a-zA-Z ]*$/",$colg)) {
			$colgErr = "Enter a valid college name";
			$_SESSION['extErr'] = $colgErr;
		}
		else {
			$colg = mysqli_real_escape_string($db,$_POST["colg"]);
		}
		
		$email = $_POST["email"];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			$_SESSION['extErr'] = $emailErr;
		}
		else{
			$preemail = mysqli_fetch_assoc(mysqli_query($db,"SELECT `email` FROM `player` WHERE `email`='$email'"));
			if(!empty($preemail['email']) && $preemail['email']==$email){
				$emailErr = "Email is already registered.";
				$_SESSION['extErr'] = $emailErr;
			}
		}
		
		/*if (!preg_match("/^[0-9]*$/",$num)) {
			$numErr = "Only numbers allowed ";
		}
		else {
			$num = mysqli_real_escape_string($db,$_POST["num"]);
		}*/
		if(isset($_SESSION['extErr'])){
			header("location:index.php");
		}
		$num = $_POST["num"];
		$pass = sha1($_POST['pass']);
		$time = time();
		$conf_code=md5(uniqid(rand()));
		// Insert data into database 
		if((empty($emailErr))&&(empty($userErr))&&(empty($nameErr))&&(empty($colgErr))){
			$sql="INSERT INTO `player`(name,user,password,email,time,number,college,conf_code) VALUES 
											('$name','$user','$pass','$email','$time','$num','$colg','$conf_code')";
		}
		else {
			$Err = "Enter all the fields";
			$_SESSION['Err'] = $Err;
			header("location:index.php");
		}
		$result=mysqli_query($db,$sql);
		
		// if suceesfully inserted data into database, send confirmation link to email 
		if($result){
			// ---------------- SEND MAIL FORM ----------------
			$to=$email;
			$subject="Your confirmation link here";
			$header="from: LCC-SJCE ";
			
			$message="Your Comfirmation link \r\n";
			$message.="Click on this link to activate your account \r\n";
			$message2="confirm.php?passkey=$conf_code";
			//$message.="https://www.lccsjce.org/fossbytes16/brainiac/confirm.php?passkey=$conf_code";
			//$sentmail = mail($to,$subject,$message,$header);
			
			//dummy redirect
				$_SESSION['to']=$to;
				$_SESSION['sub']=$subject;
				$_SESSION['mesg']=$message;
				$_SESSION['link']=$message2;
				header("location:redirect.php");
			//comment the above
		}
		/*else {
			$Err3 = mysqli_error($db);
			$_SESSION['Err3'] = $Err3 ;
			header("location:index.php");
		}*/
		// if your email succesfully sent
		/*if($sentmail){
			$msg="Your Confirmation link Has Been Sent To Your Email Address.";
			$_SESSION['Alert'] = $msg;
		}
		else {
			$msg="Confirmation not sent !";
			$_SESSION['Err3'] = $msg;
		}*/
		
	}
	else {
		$Err = "Enter all the fields";
		$_SESSION['Err'] = $Err;
		header("location:index.php");
	}
	//header("location:error.php");
?>
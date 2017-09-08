<?php
	session_start();
	//$score=1;
	//$level=1;
	//$path="";
	//$Err="";
	require_once "../variables.php";
	error_reporting(0);
	$con = mysqli_connect("$server","$root","$password","$dbms");
	if(!empty($_SESSION['user'])&&!empty($_SESSION['pass'])){
		$user=$_SESSION['user'];
		if(!empty($_SESSION['Err'])){
			if(!$Err == "Username and Password did not Match")
				$Err = $_SESSION['Err'];
		}
		$row = mysqli_fetch_array(mysqli_query($con,"SELECT `score` , `level`,`password` from `player` WHERE `user` = '$user'"));
		$score = $row['score'];
		$level = $row['level'];
		$pass = $row['password'];
		echo mysqli_error($row);
		$row = mysqli_fetch_array(mysqli_query($con,"SELECT `path` from `questions` WHERE `no` = '$level'"));
		$path = $row['path'];
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		$_SESSION['score'] = $score;
		$_SESSION['level'] = $level;
		echo mysqli_error($row);
	}		
	else {
		$_SESSION['logout'] = 1;
		header("location:../logout.php");						 
	}
	mysqli_close($con);
	//var_dump(get_defined_vars());
?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Shubhashree Hebbar">

    <title>DeCrypto - Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/freelancer.min.css" rel="stylesheet">
    <link href="../css/tablestyle.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">
	
	<!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="../Dashboard/">DeCrypto</a>
				
            </div>
			
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					<li><a href="index.php"><i class="fa fa-bullseye"></i> Playground</a></li>
                    <li><a href="rules.php"><i class="fa fa-globe"></i> Rules</a></li>
					<li><a href="leaderboard.php"><i class="fa fa-list-ol"></i> Leaderboard</a></li>
					<li ><a href="stats.php"><i class="fa fa-bar-chart"></i> Stats</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
	<section id="userDets">
        <div class="container">
			<div class="row">
				<div class="col-lg-4 text-center">
                    <h5><a  class="dropdown-toggle" data-toggle="dropdown"> Level <span class="badge"><?php echo $level;?></span> </a></h5>
                </div>
				<div class="col-lg-4 text-center">
                    <h5><a  class="dropdown-toggle" data-toggle="dropdown"> Score <span class="badge"><?php echo $score;?></span> </a></h5>
                </div>
				<div class="col-lg-4 text-center">
                    <h5><a href="../logout.php"><span class="badge"><?php echo $user?></span> | logout </a></h5>
                </div>
			</div>
		</div>
	</section>
	
    <section style="padding:10px 0 0 0;">
		<div>
		<?php	//$Err = $_SESSION['Err'];
				if(!empty($Err)){
				echo "<center><div class='alert alert-danger' style='max-width:400px;height:50px;vertical-align:middle'>".
					$Err."
				</div></center>";
				}
				?> 
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<center>
							<img class="img-responsive" style="width:600px;height:400px" src="<?php echo $path ?>"></img>
							<br>
							<form class="form col-md-12 center-block" method="POST" action="verify.php">
								<div style="max-width:600px">
									<input class="form-control" type="text" name="ans1" style="color:#000000" placeholder="Answer" autocomplete="off"></input>
								</div>
								<br>
								<div style="max-width:200px">
									<input id="btn_signin" class="btn btn-primary btn-sm btn-block" type="submit" value="Submit"></input>
								</div>
							</form>
						</center>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	
	<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript-->
	<script src="../js/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/freelancer.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=ABeeZee:400,400italic">
</body>
</html>
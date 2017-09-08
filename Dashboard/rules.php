<?php
	session_start();
	//include_once '../session.php';
	error_reporting(0);
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	if(!empty($user))
	{
		$score = $_SESSION['score'];
		$level = $_SESSION['level'];
	}	
	else
		header("location: ../");
	/*$user='harsha32';
	$pass='Onida-250';
	$score=1;
	$level=1;*/
?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Shubhashree Hebbar">

    <title>DeCrypto - Leaderboard</title>

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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
					<br><br>
                    <h2>Rules</h2>
                    <br>
                    <ol style="font-size:18pt">
                        <li>Every level has a set of images and/or text.</li>

                        <li>You are free to use anything from your brains to Google to solve the questions.</li> 

                        <li>Type in your answers in the box provided. Answers contain only small letters and numbers.</li>
                         
                        <b>No space to separate words:</b> <u>likethis</u> and don't use any special characters/ symbols in the answer.<br>(Just skip them if they are part of the answer) 
 
                        <li>Typing the correct answer will take you to the next level. Wrong answers take you no where!</li>

                        <li>Spoilers of any form are not allowed!!</li>

                        <li>All activities will be closely monitored. Admin's decision will be final.</li>

                    </ol>
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
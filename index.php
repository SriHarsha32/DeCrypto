<?php
	session_start();
	if(isset($_SESSION['user']))
		header("location:Dashboard/"); // edit later
	error_reporting('0');
	if(isset($_SESSION['extErr'])){
		$Err=$_SESSION['extErr'];
		$_SESSION['extErr']="";
	}
	else if(isset($_SESSION['Err3'])){
		$Err=$_SESSION['Err3'];
		$_SESSION['Err3']="";
	}
	else if(isset($_SESSION['UErr'])){
		$Err=$_SESSION['UErr'];
		$_SESSION['UErr']="";
	}
	else{
		$Err=$_SESSION['Err'];
		$_SESSION['Err']="";
	}
	if(isset($_SESSION['Alert'])){
		$Alert = $_SESSION['Alert'];
		$_SESSION['Alert']="";
	}
	//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="SriHarsha S">

    <title>DeCrypto - Login/Register</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.min.css" rel="stylesheet">
	

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><span class="light">LCC</span>-SJCE</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#login">Login/Register</a>
                    </li>
					<li class="page-scroll">
                        <a href="#howto">How to Play?</a>
                    </li>
					<li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Login Section -->
    <section id="login">
		<?php 
		if($Alert){
			echo "<div id=\"myAlert\">".$Alert."</div>";
			$_SESSION['Alert'] = "";
		}
		if($Err){
			echo "<div id=\"myError\">".$Err."</div>";
			$_SESSION['Err'] = "";
		}
		?>
		<div id="mainPart">
				<div id="slide-panel">
					<a href="#" class="btn btn-danger" id="opener">Login</a>
						<div id="loginpanel">
						<div class="container">
							<div id="content-login2">
								<div class="form col-md-4 center-block">
								<div class="text-center">
									<h3>Login</h3>
									<a href="#" class="slidelink" id="showregister">Don't Have An Account? &rarr;</a>
								</div>
								<form id="signin"  method="POST" action="signin.php">
									<div class="form-group">
										<input type="user" class="form-control input-lg" placeholder="Username" name="user" autocomplete="off">
									</div>
									<div class="form-group">
										<input type="password" class="form-control input-lg" placeholder="Password" name="pass" autocomplete="off">
									</div>
									<div class="form-group">
										<input id="btn_signin" type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in"> </input>
									</div>
								</form>
								
							  </div>
							</div>
						</div>
					</div>
				</div>
				<div id="slide-panel2">
					<a href="#" class="btn btn-danger" id="opener2">Register</a>
					<div id="registerpanel">
						<div class="container">
							<div id="content-register2">
								<div class="form col-md-4">
								<div class="text-center">
									<h3>Register</h3>
									<a href="#" class="leftsidelink" id="showlogin">&larr; Already Have an Account? Login Now!</a>
								</div>
								<form id="signup" method="POST" action="signup.php">
									<div class="form-group">
									  <input type="text" class="form-control input-lg" placeholder="Name" name="name" autocomplete="off">
									</div>
									<div class="form-group">
									  <input type="text" class="form-control input-lg" placeholder="Username" name="user" autocomplete="off">
									</div>
									<div class="form-group">
									  <input type="text" class="form-control input-lg" placeholder="College" name="colg" autocomplete="off">
									</div>
									<div class="form-group">
									  <input type="number" class="form-control input-lg" placeholder="Number" min="1000000000" max="9999999999" name="num" autocomplete="off">
									</div>
									<div class="form-group">
									  <input type="email" class="form-control input-lg" placeholder="Email" name="email" autocomplete="off">
									</div>
									<div class="form-group">
									  <input type="password" class="form-control input-lg" placeholder="Password" name="pass" autocomplete="off">
										</div>
									<div class="form-group" style="margin-top:50px">
									  <button id="btn_signup" class="btn btn-primary btn-lg btn-block">Sign Up <i class="fa fa-sign-in"></i></button>
									</div>
								</form>
								</div>
							</div>
						</div>
				  </div>
				</div><!-- /end #w -->
		</div>
    </section>

	<!-- How to Play Section-->
	<section class="success" id="howto">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>How to Play ?</h2>
                    <hr class="star-light">
					<p>
                Sign up using the link provided. <br>
				A confirmation link will be sent to your mail. Use it to login.<br> 
                Dive into the "Playground"<br>Put on your reading glasses and search for answers.<br> Remember, Google is your friend.
                <br>Not that good with Google? Just ping us in the forum and Voila! Clues....
                <br>
Thrust yourself beyond your friends and be the crown holder.<br>
Cheers.
                <br>ALL THE BEST!!
                </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="text-center" id="contact">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-6">
                        <h3>About LCC-SJCE</h3>
						<p>Linux Campus Club (LCC) is an organization under the department of Computer Science SJCE, Mysore. Its primary goal is fostering the use of free and open source software among the students.</p> 
                    </div>
                    <div class="footer-col col-md-6">
                        <h3>Part of FOSS BYTES SJCE'16</h3>
                        <p>For other exciting events, visit our webpage @ <a href="http://www.lccsjce.org/fossbytes-16">LCC-SJCE</a>
							or through facebook</p>
							<ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/LCCSJCE" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
							</ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <p style="color:#a0a0a0">Congregate. Create. Contribute.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript-->
	<script src="../js/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=ABeeZee:400,400italic">
	<script type="text/javascript" src="js/formslider.js"></script>

</body>

</html>

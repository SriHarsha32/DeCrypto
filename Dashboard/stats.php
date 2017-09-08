<?php
	session_start();
	require_once "../variables.php";
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$score = $_SESSION['score'];
	$level = $_SESSION['level'];
	//$user='harsha321';
	//$pass='Onida-250';
	//$score=1;
	//$level=1;
	if(!empty($user)){
		$con = mysqli_connect("$server","$root","$password","$dbms");
		$result = mysqli_query($con,"select max(`level`) from `player`");
		$row = mysqli_fetch_array($result);
		$max = $row[0];
		$i = 1;
		$k = 0;
		if($max>10){
			while($i<=$max){
				$j = $i+9;
				$result1 = mysqli_query($con,"select count(*) from `player` where `level` BETWEEN $i and $j");
				$row = mysqli_fetch_array($result1);
				$arr[$k] = $row[0];
				$tuple[$k] = "['level $i to $j',$arr[$k]]";
				//echo $arr[$k]."<br>";
				$i = $i+10;
				$k++;
			}
		}
		else {
			while($i<=$max){
				$result1 = mysqli_query($con,"select count(*) from `player` where `level`= $i ");
				$row = mysqli_fetch_array($result1);
				$arr[$k] = $row[0];
				$tuple[$k] = "['level $i',$arr[$k]]";
				//echo $arr[$k]."<br>";
				$i++;
				$k++;
			}
		}
		$result2 = mysqli_query($con,"select count(*) from `log` WHERE `user` = '$user' ");
		$row1 = mysqli_fetch_array($result2);
		$tries = $row1[0];
		if($tries==0)
			$tries=1;
		$win = (($level-1)/$tries)*100;
		$result3 = mysqli_query($con,"select max(`time`) from `log` WHERE `user` = '$user' ");
		$row2 = mysqli_fetch_array($result3);
		$maxt = $row2[0];
		$timet1 = time();
		$result4 = mysqli_query($con,"select min(`time`) from `log` WHERE `user` = '$user' ");
		$row3 = mysqli_fetch_array($result4);
		$mint = $row3[0];
		 
		$timediff = $timet1 - $mint;
		$lastattemtime = $timet1 - $maxt ;


		$days = floor($timediff / (60 * 60 * 24));
		$timediff -= $days * (60 * 60 * 24);
		$hours = floor($timediff / (60 * 60));
		$timediff -= $hours * (60 * 60);
		$minutes = floor($timediff / 60);
		$timediff -= $minutes * 60;

		$days1 = floor($lastattemtime / (60 * 60 * 24));
		$lastattemtime -= $days1 * (60 * 60 * 24);
		$hours1 = floor($lastattemtime / (60 * 60));
		$lastattemtime -= $hours1 * (60 * 60);
		$minutes1 = floor($lastattemtime / 60);
		$lastattemtime -= $minutes1 * 60;

		$result5 = mysqli_query($con,"select max(`score`) from `player` ");
		$row4 = mysqli_fetch_array($result5);
		$maxscore = $row4[0];
		$result6 = mysqli_query($con,"select count(*) from `player` where `level`= $level ");
		$row5 = mysqli_fetch_array($result6);
		$curr_num_of_users = $row5[0];
		$result7 = mysqli_query($con,"select count(*) from `log` where `level`= $level ");
		$row6 = mysqli_fetch_array($result7);
		$curr_num_of_attempts=$row6[0];
		$result8 = mysqli_query($con,"select count(*) from `player`");
		$row7 = mysqli_fetch_array($result8);
		$num_of_players=$row7[0];
		$result9 = mysqli_query($con,"select count(*) from `log`");
		$row8 = mysqli_fetch_array($result9);
		$num_of_attempts=$row8[0];
		$result10 = mysqli_query($con,"select max(`level`) from `player`");
		$row9 = mysqli_fetch_array($result10);
		$max_level = $row9[0];
		$progress=($level/$max_level)*100;
		
		//var declaration
		$days2=0;
		$hours2=0;
		$minutes2=0;
		//SELECT count( * ) AS cnt2 FROM log GROUP BY user HAVING cnt2 = ( SELECT count( * ) AS cnt FROM log WHERE user = '$user' GROUP BY user ORDER BY cnt DESC LIMIT 1 );
		$result11 = mysqli_query($con,"SELECT count(*) AS cnt2 FROM log GROUP BY user HAVING cnt2 = ( SELECT count(*) AS cnt FROM log WHERE user = '$user' GROUP BY user ORDER BY cnt DESC LIMIT 1 )");
		if($result11)
		{
			$row10 = mysqli_fetch_array($result11);
			$highattem = $row10[0];
			$result12 = mysqli_query($con,"select max(`time`) from `log` WHERE `user` = '$user' and `correct` = 1");
			$row11 = mysqli_fetch_array($result12);
			$thisq2 = $row11[0];

			$thisq = $timet1 - $thisq2;
			$days2 = floor($thisq / (60 * 60 * 24));
			$thisq -= $days2 * (60 * 60 * 24);
			$hours2 = floor($thisq / (60 * 60));
			$thisq -= $hours2 * (60 * 60);
			$minutes2 = floor($thisq / 60);
			$thisq -= $minutes2 * 60;
		}
		$result13 = mysqli_query($con,"SELECT * FROM `player` order by level desc,score desc,time asc ;");
		$count = 1;
		while($row12 = mysqli_fetch_array($result13)){
			if($row12['user'] != $user)
				$count++;
			else break;
		}
	}
	else {
		header("location:../logout.php");
	}
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
                    <h3>Statistics and more</h3>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 block-center">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Number of users in different levels </h3>
                        </div>
                        <div class="panel-body">
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-database"></i> Overall Stats </h3>
                        </div>
                        <div class="panel-body">
                            <div id="" style=""><center>
                                Current position in the leaderboard: <?php echo $count; ?><br>
                                Total number of attempts made: <?php echo $tries; ?><br>
                                Win percentage: <?php echo sprintf("%.4s",$win); ?>%<br>
                               <!-- Total time spent in game: <?php echo "$days day $hours hours $minutes minutes"; ?><br>-->
                                 </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-flag"></i> General</h3>
                        </div>
                        <div class="panel-body">
                            <div id="">
                                 Total number of players: <?php echo $num_of_players; ?><br>
                                 Total number of attempts: <?php echo $num_of_attempts; ?><br>
                                <!-- Highest number of attempts for a question: <br>-->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-magnet"></i> Overview</h3>
                        </div>
                        <div class="panel-body">
                            <div class="key pull-right"><?php echo $progress?>%</div>
								<div class="stat">
									<div class="info">Relative Progress<br>(current level / highest level)*100</div>
									<div class="progress progress-small">
										<div style="width: <?php echo $progress?>%;" class="progress-bar"></div>
									</div>
								</div>
                        </div>
                    </div>

                </div>
                 <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Current Question</h3>
                        </div>
                        <div class="panel-body">
                            <div id="">
                                <!-- Number of attempts: <?php echo $curr_num_of_attempts; ?> <br> -->
                                Time spent: <?php echo "$days2 day $hours2 hours $minutes2 minutes";?><br>
                                number of players: <?php echo $curr_num_of_users; ?><br>
                                 
                            </div>
                        </div>
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
	
	<script src="http://code.highcharts.com/highcharts.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/shieldui-all.min.css" />
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <link id="gridcss" rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/dark-bootstrap/all.min.css" />

    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>
	
	<script type="text/javascript">
        $(function () {

    // Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });
    //var json="[ [name: 'Chrome', y: 25], [name:'Firefox', y: 20] ]";
  // $.getJSON("url",function(json){
    // Build the chart
    
    //$jsonstring = json_encode($json1);
    //$json=JSON.parseInt($jsonstring);
    $('#piechart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: "Levels",
            data: [ <?php echo join($tuple,',') ?>]
        }]
    });
//});
          
        });        
    </script>
	
	
</body>
</html>
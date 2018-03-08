<!DOCTYPE html>
<html>
<head>
	<title>Installation Page</title>
	<link rel="stylesheet" href="stylesheet/bootstrap.css">
	<style type="text/css">
		body{ width: 100%; }
		#main{
			position: absolute;
			top:50%;
			margin-top: -175px;
			left:50%;
			margin-left: -270px;
			width: 500px;
			height: 250px;
		}
		#success{
			position: absolute;
			top:50%;
			margin-top: -120px;
			left:50%;
			margin-left: -460px;
			height: 120px;
			width: 800px;
			text-align: center;
		}
		.hero-unit {
			background-color: white;
		}
	</style>
</head>
<body>
	<?php
		error_reporting(0);
		$q = htmlspecialchars($_GET['q'] ,ENT_QUOTES);
		if($q != 1){ 
	?>
			<div id="main">
				<h1 align="center">- Installation -</h1><br>
				<form class="form-horizontal" method="post">
				    	<label class="control-label" for="database">Database</label>
					    <div class="controls">
					    	<input type="text" name="database" required></input>
					    </div><br>
					    <label class="control-label" for="host">Host</label>
				    	<div class="controls">
				      		<input type="text" placeholder="localhost" name="host"  required></input>
				    	</div><br>
				    	<label class="control-label" for="username">Username</label>
				    	<div class="controls">
				      		<input type="text" name="username" placeholder="root"  required></input>
				    	</div><br>
				    	<label class="control-label" for="password">Password</label>
				    	<div class="controls">
				      		<input type="password" name="password"  required></input>
				    	</div><br>
				    	<div class="controls">
				      		<button class="btn btn-large btn-success" type="submit">INSTALL</button>	    
				    	</div>
				</form>
			</div>
	<?php
		}else if($q == 1){
	?>
		<h1></h1>
		<p class="text-error"></p>
		<div class="hero-unit" id="success">
		  	<h1>Installation Successful</h1>
		  	<p class="text-error">Please remove or change name file: install.php</p>
		</div>
	<?php
		}
	?>
</body>
</html>



<?php	

$db = htmlspecialchars($_POST["database"] ,ENT_QUOTES);
$host = htmlspecialchars($_POST["host"] ,ENT_QUOTES);
$username = htmlspecialchars($_POST["username"] ,ENT_QUOTES);
$password = htmlspecialchars($_POST["password"] ,ENT_QUOTES);

if(!empty($db) && !empty($host) && !empty($username) && !empty($password)){

	$text = '
			<?php
				$status = mysqli_connect("'.$host.'","'.$username.'","'.$password.'","'.$db.'") or die("Cannot Connect Database");
				if(!$status) die("Could not connect: " . mysqli_error());
				mysqli_query($status,"SET NAMES utf8"); 
			?>
			';

	$my_file = 'sic_sql_config.php';
	$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
	fwrite($handle, $text);

	require 'sic_sql_config.php';

	$sql =  "
			CREATE TABLE IF NOT EXISTS `clubenrollment` (
			  `idUser` int(11) NOT NULL,
			  `club` int(11) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	$sql =  "
			CREATE TABLE IF NOT EXISTS `data_club` (
			  	`ID` tinyint(4) NOT NULL AUTO_INCREMENT,
			  	`club` text NOT NULL,
			  	`member` int(11) NOT NULL DEFAULT '0',
			  	`limit_member` int(11) NOT NULL,
			  	`teacher` text NOT NULL,
			  	`des` text NOT NULL,
			  	`condition_m` varchar(10) DEFAULT NULL,
			  	`condition_s_m` int(11) NOT NULL,
			  	`condition_s_fm` int(11) NOT NULL,
			  	PRIMARY KEY (`ID`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	$sql =  "
			CREATE TABLE IF NOT EXISTS `data_sbj` (
			  	`ID` tinyint(4) NOT NULL AUTO_INCREMENT,
			  	`sbj` text NOT NULL,
			  	`member` int(11) NOT NULL,
			  	`limit_member` int(11) NOT NULL,
			  	`teacher` text NOT NULL,
			  	`des` text NOT NULL,
			  	`condition_m` varchar(10) DEFAULT NULL,
			  	`condition_s_m` int(11) NOT NULL,
			  	`condition_s_fm` int(11) NOT NULL,
			  	PRIMARY KEY (`ID`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	$sql =  "
			CREATE TABLE IF NOT EXISTS `data_std` (
			  	`user` varchar(100) NOT NULL,
			  	`name` varchar(100) NOT NULL,
			  	`surname` varchar(100) NOT NULL,
			  	`nickname` varchar(40) NOT NULL,
				`birthday` date NOT NULL,
				`address` varchar(1000) NOT NULL,
				`email` varchar(255) NOT NULL,
				`phone` varchar(15) NOT NULL,
				`class` varchar(4) NOT NULL,
				`title` varchar(10) NOT NULL,
				`sex` varchar(15) NOT NULL,
				`number` varchar(10) NOT NULL,
				`number_class` varchar(5) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	$sql =  "
			CREATE TABLE IF NOT EXISTS `log_file` (
			 	`ID` varchar(5) NOT NULL,
			  	`user` varchar(250) NOT NULL,
			  	`page` varchar(250) NOT NULL,
			  	`time` varchar(250) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;
			";
	mysqli_query($status,$sql) or die(mysqli_error());		

	$sql =  "
			CREATE TABLE IF NOT EXISTS `sbjenrollment` (
			  	`idUser` int(11) NOT NULL,
			  	`sbj` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	$sql =  "
			CREATE TABLE IF NOT EXISTS `sic_options` (
				`num_student` int(11) NOT NULL DEFAULT '0',
			  	`max_club` int(11) NOT NULL DEFAULT '0',
			  	`max_sbj` int(11) NOT NULL DEFAULT '0',
			  	`club_maintenance_mode` int(11) NOT NULL DEFAULT '0',
			  	`subject_maintenance_mode` int(11) NOT NULL DEFAULT '0'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	$sql =  "
			INSERT INTO `sic_options` (`num_student`, `max_club`, `max_sbj`, `club_maintenance_mode`, `subject_maintenance_mode`) VALUES(0, 0, 0, 0, 0);
			";
	mysqli_query($status,$sql) or die(mysqli_error());

	//echo '<script>alert("Installation Success!");</script>';
	echo '<script>window.location.href="install.php?q=1"</script>';
}
?>
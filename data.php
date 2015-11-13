<?php
	// laeme funktsiooni failis
	require_once("functions.php");
	
	// kontrollin, kas kasutaja on sisse loginud
	if(!isset($_SESSION["id_from_db"])){
			// suunan login.php lehele
			header("Location: login_sample.php");
	}
	// login v2lja
	if(isset($_GET["logout"])){
			session_destroy();
		
		header("Location: login_sample.php");
	}
	
	
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>
	<a href ="?logout=1">Logi välja</a>

</p>


<?php
	// laeme funktsiooni failis
	require_once("functions.php");
	require_once("InterestsManager.class.php");
	
	// kontrollin, kas kasutaja on sisse loginud
	if(!isset($_SESSION["id_from_db"])){
			// suunan login.php lehele
			header("Location: login_sample.php");
			
			exit();
			
	}
	// login v2lja
	if(isset($_GET["logout"])){
			session_destroy();
		
		header("Location: login_sample.php");
	}
	
	// teen uue instansti class IM
	$InterestsManager = new InterestsManager($mysqli);
	
	
	
	if(isset($_GET["new_interest"])){
		
		
		$added_interest = $InterestsManager->addInterest($_GET["new_interest"]);
		
	}
	
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>
	<a href ="?logout=1">Logi välja</a>

</p>
  

<h2>Lisa uus huviala</h2>
  <?php if(isset($added_interest->error)): ?>
  
	<p style="color:red;">
		<?=$added_interest->error->message;?>
	</p>
  
  <?php elseif(isset($added_interest->success)): ?>
  
	<p style="color:green;">
		<?=$added_interest->success->message;?>
	</p>
  
  <?php endif; ?>  
<form>
	<input name="new_interest">
	<input type="submit">
</form>

<h2>Minu huvialad</h2>
<form>
	<!-- SIIA TULEB RIPPMENÜÜ -->
	<?php echo $InterestsManager->createDropDown();?>
	<input type="submit">
</form>


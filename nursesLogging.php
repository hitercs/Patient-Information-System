<?php session_start(); ?>
<html>
	<?php
		if (isset($_POST["email"]) and isset($_POST["password"]))
		{
			$url = "nursesMain.php";	
			$_SESSION['email']= $_POST["email"];
			header("Location: $url");
		}
		else 
		{
			echo "Loging in failed";
		}
	?>
</html>
<html>
	<?php
		if (isset($_POST["email"]) and isset($_POST["password"]))
		{
			$url = "doctorsMain.php";	
			header("Location: $url");
		}
		else 
		{
			echo "Loging in failed";
		}
	?>
</html>
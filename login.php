<?php
$dtag = $_GET['dtag'];
?>
<html>
	<head>
		<title>Login To LHS Discord</title>
		<link rel="stylesheet" href="loginpage.css">
	</head>	
	<body>
		<div class="header">
			<h1>Login To Lexington High School Discord Server</h1>
			
		</div>
		<br><br>
		<div class="center">
		<center><p><i>Please use your Aspen credentials to log in.</i></p></center>
			<form name="login" action="done.php" method="post" autocomplete="off">
				<input type="hidden" name="dtag" value="<?php echo (isset($dtag))?$dtag:'';?>">
				<br>
				<label for="lid">Login ID</label>
				<br>
				<input type="text" id="lid" name="lid" required></input>
				<br><br>
				<label for="pwd">Password</label>
				<br>
				<input type="text" id="pwd" name="pwd" style="-webkit-text-security: disc;" autocomplete="new-password" required></input> <br><br>
					<input type="checkbox" name="tos" id= "tos" required>
					<label for="tos"> I accept the <a href="https://tinyurl.com/y2kg63fa" target="_blank">Terms of Service</a></label>
				<br><br>
				<input type="submit" value="Login" class="submitbutton">
			</form>
		</div>
	</body>

</html>

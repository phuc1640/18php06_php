<!DOCTYPE html>
<html>
<head>
	<title>Add News</title>
</head>
<body>
	
	<h1>Login</h1>
	<form action="#" method='post' enctype="multipart/form-data">
		<p>Username : <input type="text" name="username" value="<?php echo $username;?>"></p>
		<p>
			<?php
			echo $errUsername;
			?>
		</p>

		<p>Password : <input type="password" name="password" value="<?php echo $password;?>"></p>
		<p>
			<?php
			echo $errPassword;
			?>
		</p>

		<input type="submit" name="login" value="Login">
	</form>

</body>
</html>
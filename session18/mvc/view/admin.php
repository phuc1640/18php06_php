<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<body>
	<?php
		echo "Hello " . $_SESSION['username'];
	?>
	<form action="#" method='post' enctype="multipart/form-data">
		<input type="submit" name="logout" value="Logout">
	</form>
</body>
</html>
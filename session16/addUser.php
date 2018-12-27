<?php ob_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
</head>
<body>
	<?php
	include 'connectDb.php';
	function insertUser($username ,$password, $fullName, $address) {
		$message = "";
		$conn = connectDb();		 
		$sql = "INSERT INTO users (username, password, fullName, address)
		VALUES ('$username', '$password', '$fullName', '$address')";

		if ($conn->query($sql) === TRUE) {
		    $message = "Thanh cong";
		} else {
		    $message = "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
		return $message;
	}
	
	?>

	<?php
	$errUsername = $errPassword = $errFullName = $errAddress = "";
	$username = $password = $fullName = $address = "";
	
	$message = "";
	$isSuccess = true;
	if(isset($_POST['save'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullName = $_POST['fullName'];
		$address = $_POST['address'];		
		if ($username == '') {
			$errUsername = "Please input username";
			$isSuccess = false;
		}
		if ($password == '') {
			$errPassword = "Please input password";
			$isSuccess = false;
		}
		if ($fullName == '') {
			$errFullName = "Please input full name";
			$isSuccess = false;
		}
		if ($address == '') {
			$errAddress = "Please input address";
			$isSuccess = false;
		}
		
		if ($isSuccess) {
			insertUser($username ,$password, $fullName, $address);
			echo "Success";
			header("Location: displayListUser.php");
		}
		
	}


	?>
	<h1>Add User</h1>
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
		<p>Full Name : <input type="text" name="fullName" value="<?php echo $fullName;?>"></p>
		<p>
			<?php
			echo $errFullName;
			?>
		</p>
		<p>Address : <input type="text" name="address" value="<?php echo $address;?>"></p>
		<p>
			<?php
			echo $errAddress;
			?>
		</p>
		<input type="submit" name="save" value="Save">
	</form>

</body>
</html>